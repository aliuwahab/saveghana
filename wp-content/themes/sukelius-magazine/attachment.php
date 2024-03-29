<?php
/**
 * Attachment Template
 *
 * This is the default attachment template.  It is used when visiting the singular view of a post attachment 
 * page (images, videos, audio, etc.).
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

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // sukelius_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // sukelius_open_entry ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

						<div class="entry-content">
							
							<?php if ( wp_attachment_is_image( get_the_ID() ) ) : ?>

								<p class="attachment-image">
									<?php echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter' ) ); ?>
								</p><!-- .attachment-image -->

							<?php else : ?>

								<?php hybrid_attachment(); // Function for handling non-image attachments. ?>

								<p class="download">
									<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php the_title_attribute(); ?>" rel="enclosure" type="<?php echo get_post_mime_type(); ?>"><?php printf( __( 'Download &quot;%1$s&quot;', 'sukelius-magazine' ), the_title( '<span class="fn">', '</span>', false) ); ?></a>
								</p><!-- .download -->

							<?php endif; ?>

							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sukelius-magazine' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'sukelius-magazine' ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-content -->

						<?php if ( wp_attachment_is_image( get_the_ID() ) ) echo do_shortcode( sprintf( '[gallery id="%1$s" exclude="%2$s" columns="8"]', $post->post_parent, get_the_ID() ) ); ?>

						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . sprintf( __( 'Sizes: %s', 'sukelius-magazine' ), sukelius_get_image_size_links() ) . '</div>' ); ?>
						
						<?php do_atomic( 'close_entry' ); // sukelius_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // sukelius_after_entry ?>

					<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

					<?php do_atomic( 'after_singular' ); // sukelius_after_singular ?>

					<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // sukelius_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // sukelius_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>