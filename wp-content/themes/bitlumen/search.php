<?php get_header(); ?>

	<div id="content">
		
	<?php if( have_posts() ) : ?>	
	
		<?php while( have_posts() ): the_post(); ?>
		<div id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
			<h2 class="entry-title"><?php bitLumen_post_title(); ?></h2>
		
			<div class="entry-meta">
				<?php bitLumen_entry_meta(); ?>
			</div><!-- /.entry-meta -->
		
			<div class="entry-content">
				<?php bitLumen_the_post_thumbnail(); ?>
				<?php the_content( bitLumen_get_option( 'keep_reading_text' ) ); ?>
				<div class="clear"></div>
			</div><!-- /.entry-content -->
							
			<div class="entry-utility">
				<?php $bitLumen_cats = get_the_category_list( ', ' ); if( !empty( $bitLumen_cats ) ) echo '<span>Posted in ' . $bitLumen_cats . '</span>'; ?>
				<?php the_tags( '<span class="meta-sep"> ' . bitLumen_get_option( 'entry_meta_sep' ) . ' </span><span>Tagged ', ', ', '</span>' ) ?>
				<span class="meta-sep"> <?php echo bitLumen_get_option( 'entry_meta_sep' ); ?> </span><span class="comments-link-wrapper"><?php comments_popup_link( 'Leave a comment', '1 Comment', '% Comments' ); ?></span>
	
				<div class="entry-navigation">
					<?php wp_link_pages( 'before=<div class="page-link">Pages: &after=</div>' ); ?>
				</div><!-- /.entry-navigation -->
			
				<div class="clear"></div>
			</div><!-- /.entry-utility -->
		
			<div class="clear"></div>
		</div><!-- /.entry-utility -->
		
	</div><!-- /#post-<?php the_ID(); ?> -->

	<?php endwhile; ?>

	<?php else : ?>
		<div id="entry-error" class="error 404 no-results">
			<h2 class="entry-title">Apologies</h2>
			<div class="entry-content">
				<p>Sorry, but we couldn't locate any results for <?php echo ( array_key_exists( 's', $_GET ) ? '&ldquo;<strong>' . esc_attr( $_GET['s'] ) . '</strong>&rdquo;' : 'that search' ); ?>. Please try a different search: </p>

				<div><?php get_search_form( true ); ?></div>
				<div class="clear"></div>
			</div><!-- /.entry-content -->
	
			<div class="clear"></div>
		</div><!-- /#post-<?php the_ID(); ?> -->
	<?php endif; ?>

	<?php bitLumen_index_nav(); ?>

</div><!-- /#content -->

<?php get_footer(); ?>