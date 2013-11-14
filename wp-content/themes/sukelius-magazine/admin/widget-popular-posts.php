<?php
/**
 * Random / most popular posts widget.
 *
 * @package Sukelius Magazine
 * @subpackage Classes
 * @since Cakifo 0.1
 * @version 0.1
 * @author Sinisa Nikolic <sin2384@gmail.com>
 * @copyright Copyright (c) 2012, Sinisa Nikolic
 * @link http://themesbros.com/demo/sukeliusmagazine
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 */

/**
 * Popular Posts Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  
 *
 * @since 0.1
 */
class Sukelius_Widget_Posts extends WP_Widget {

	function Sukelius_Widget_Posts() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname' => 'sukelius-posts',
			'description' => esc_html__( 'Use this widget to list related posts to the current viewed post based on category and post format.', 'sukelius-magazine' )
		);

		/* Create the widget. */
		$this->WP_Widget(
			'sukelius-popular-posts',	// $this->id_base
			__( 'Sukelius: Popular Posts', 'sukelius-magazine' ),	// $this->name
			$widget_options			// $this->widget_options
		);
		
	}	

	/**
	 * Display of widget in theme
	 */
	function widget( $args, $instance ) {
		
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$orderby = $instance['orderby'];
		$limit = $instance['limit'];
		$show_thumbs = isset( $instance['show_thumbs'] ) ? $instance['show_thumbs'] : true;

		/* Before widget wrapper. */
		echo $before_widget;

		/* Display the widget title if exists. */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Set up the query */
		$widget_popular_posts = array(
			'posts_per_page'        => $limit,
			'orderby'             	=> $orderby,
			'ignore_sticky_posts'  => true,
			'tax_query'           	=> array(
					array(
						// Exclude posts with the Aside, Link, Quote, and Status format
						'taxonomy' => 'post_format',
						'terms'    => array( 'post-format-aside', 'post-format-link', 'post-format-quote', 'post-format-status' ),
						'field'    => 'slug',
						'operator' => 'NOT IN',
					)
				),
		);			
			
		if ( ! empty( $widget_popular_posts ) ) {

			$sukelius_query_posts = new WP_Query( $widget_popular_posts );
			
			echo '<ul class="popular-posts">';
			
			if ( $sukelius_query_posts->have_posts() ) while ( $sukelius_query_posts->have_posts() ) : $sukelius_query_posts->the_post(); ?>
				
				<li>
					<?php if ( current_theme_supports( 'get-the-image' ) && $show_thumbs == 1 ) get_the_image( array( 'size' => 'thumbnail', 'width' => 60, 'height' => 50, 'image_class' => 'alignleft') ); ?>
					<h4 class="popular-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					<p class="popular-text"><?php echo do_shortcode( '[entry-published]' ); ?></p>
				</li>	
	
			<?php endwhile;
	
			wp_reset_query();
			
			echo '</ul>';
		}

		/* After widget wrapper */
		echo $after_widget;
		
	}	
	
	/**
	 * Update the widget settings.
	 */	
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['orderby']        = strip_tags( $new_instance['orderby'] );
		$instance['limit']          = intval( $new_instance['limit'] );		
		$instance['show_thumbs'] = ( isset( $new_instance['show_thumbs'] ) ? 1 : 0 );

		return $instance;
	
	}

	/**
	 * Widget display in WP Dashboard
	 */	
	function form( $instance ) {

		/* Set up the default form values. */
		$defaults = array(
			'title'          => esc_attr__( 'Random Posts', 'sukelius-magazine' ),
			'limit'          => 4,			
			'orderby'        => 'rand',
			'show_thumbs' => true,
		);

		/* Merge the user-selected arguments with the defaults. */
		$instance = wp_parse_args( (array) $instance, $defaults );

		/* Create an array of orderby types. */
		$orderby = array(
			'rand'        => _x( 'Random', 'order by', 'sukelius-magazine' ),
			'comment_count' => _x( 'Comment count', 'order by', 'sukelius-magazine' ),
		); ?>
	
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'sukelius-magazine' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>	

		<!-- Order by: Select Box -->		
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order by:', 'sukelius-magazine' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
				<?php foreach ( $orderby as $option_value => $option_label ) { ?>
					<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['orderby'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Number of posts: Text Input -->		
		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Number of posts to show:', 'sukelius-magazine' ); ?></label>
			<input type="number" min="1" class="smallfat code" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>" />
		</p>			
		
		<!-- Show thumbnails: Checkbox -->
		<p>
		<label for="<?php echo $this->get_field_id( 'show_thumbs' ); ?>">
		<input class="checkbox" type="checkbox" <?php checked( $instance['show_thumbs'], true ); ?> id="<?php echo $this->get_field_id( 'show_thumbs' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbs' ); ?>" /> <?php _e( 'Show post thumbnails?', 'sukelius-magazine' ); ?></label>
		</p>
			
	<?php
	
	}	

}

?>