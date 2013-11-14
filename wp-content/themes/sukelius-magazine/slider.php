<?php
/**
 * Slider content
 *
 * Displays sticky posts in slider.
 *
 * @package Sukelius
 * @subpackage Template
 * @since 0.1
 */

/* Get the sticky posts. */
$sticky = get_option( 'sticky_posts' );

if ( ! empty( $sticky ) && hybrid_get_setting( 'slider_display' ) == 1 ) :
 
	/* Grab all sticky posts */
	$args = array( 'post__in' => $sticky );
	
	$sukelius_slider = new WP_Query( $args );

	if ( $sukelius_slider->have_posts() ) : ?>

		<div id="slider-container">
			
			<div class="wrap">
				
				<div id="slider" class="nivoSlider">
					
					<?php while ( $sukelius_slider->have_posts() ) : $sukelius_slider->the_post(); ?>	

						<?php if ( current_theme_supports( 'get-the-image' ) && has_post_thumbnail() ) { 

							$image = get_the_image( array( 'echo' => false, 'format' => 'array', 'size' => 'sukelius-slider-image', 'image_class' => 'sukelius-slider', 'width' => 940, 'height' => 385 ) ); ?>
											
							<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $image['src'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" title="<?php the_title_attribute(); ?>" /></a>

						<?php } else { ?>
						
							<a href="<?php the_permalink(); ?>"><img src="<?php echo trailingslashit( get_template_directory_uri() ) .'images/slider-default.jpg'; ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" title="<?php the_title_attribute(); ?>" /></a>	
					
					<?php } endwhile; ?>
					
					<?php wp_reset_postdata(); // Restores the $post global to the current post in the main query.  ?>
					
				</div><!-- .nivoSlider -->
				
			</div><!-- .wrap -->
			
		</div><!-- #slider-container -->

	<?php  endif; ?>
		
<?php endif; ?>