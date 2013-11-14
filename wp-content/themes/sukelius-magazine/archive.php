<?php
/**
 * Archive Template
 *
 * The archive template is the default template used for archives pages without a more specific template. 
 *
 * @package Sukelius
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // sukelius_before_content ?>

	<div id="content">

		<?php if ( current_theme_supports( 'breadcrumb-trail' ) ) breadcrumb_trail( array( 'before' => __( 'You are here:', 'sukelius-magazine' ) ) ); ?>		
	
		<?php do_atomic( 'open_content' ); // sukelius_open_content ?>	
	
		<div class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php do_atomic( 'before_entry' ); // sukelius_before_entry ?>				

					<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>
					
					<?php do_atomic( 'after_entry' ); // sukelius_after_entry ?>					

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

		</div><!-- .hfeed -->
		
		<?php do_atomic( 'close_content' ); // sukelius_close_content ?>		

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // sukelius_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>