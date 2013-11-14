<?php
/**
 * Index Template
 *
 * This is the default template.  It is used when a more specific template can't be found to display
 * posts.  It is unlikely that this template will ever be used, but there may be rare cases.
 *
 * @package Sukelius
 * @subpackage Template
 * @since 0.1.0
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

					<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

					<?php if ( is_singular() ) { ?>

						<?php do_atomic( 'after_singular' ); // sukelius_after_singular ?>
						
						<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>						

						<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

					<?php } ?>				

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