<?php get_header(); ?>

<div id="content">
<?php while( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'entry attachment-entry'); ?>>
	
		<h2 class="entry-title attachment-title"><?php bitLumen_attachment_title(); ?></h2>
 		
		<div class="entry-content">
					
			<p>&laquo; Return to <a href="<?php echo get_permalink( $post->post_parent ); ?>" title="Return to &ldquo;<?php echo get_the_title( $post->post_parent ); ?>&rdquo;"><?php echo get_the_title( $post->post_parent ); ?></a></p>
			
			<p class="attachment aligncenter"><a href="<?php echo wp_get_attachment_url( $post->ID ); ?>" title="<?php echo get_the_title(); ?> from <?php echo get_the_title( $post->post_parent ); ?>" rel="attachment"><?php echo wp_get_attachment_image( $post->ID, 'large', true ); ?></a></p>
									
			<div class="attachment-caption"><?php the_excerpt(); ?></div>
						
		</div><!-- /entry-content -->
 
			<div class="entry-content-footer">
				<div class="gallery-navigation">
					<div class="gallery-navigation-prev gallery-navigation"><?php previous_image_link( false, '&laquo; Previous Image') ?></div>
					<div class="gallery-navigation-next gallery-navigation"><?php next_image_link( false, 'Next Image &raquo;') ?></div>
					
					<div class="clear"></div>
				</div>
				
				<div class="clear"></div>
				
			</div>
 
		<div class="entry-utility">
			<?php $bitLumen_cats = get_the_category_list( ', ' ); if( !empty( $bitLumen_cats ) ) echo '<span>Posted in ' . $bitLumen_cats . '</span>'; ?>
			<?php the_tags( '<span class="meta-sep"> ' . bitLumen_get_option( 'entry_meta_sep' ) . ' </span><span>Tagged ', ', ', '</span>' ) ?>
			<br /><?php bitLumen_comment_status(); ?>
	
			<div class="entry-navigation">
				<?php wp_link_pages( 'before=<div class="page-link">Pages: &after=</div>' ); ?>
			</div><!-- /.entry-navigation -->
			
			<div class="clear"></div>
		</div><!-- /.entry-utility -->
	</div><!-- /.entry ?>-->

<?php endwhile; ?>

	<?php comments_template( '', true ); ?>

</div><!-- /content -->

<?php get_footer(); ?>