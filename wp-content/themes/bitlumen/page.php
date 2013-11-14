<?php get_header(); ?>

	<div id="content">
		
	<?php while( have_posts() ): the_post(); ?>
	
		<div id="entry-<?php the_ID(); ?>" <?php post_class( 'entry page' ); ?>>
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
				<?php bitLumen_comment_status(); ?>
	
				<div class="entry-navigation">
					<?php wp_link_pages( 'before=<div class="page-link">Pages: &after=</div>' ); ?>
				</div><!-- /.entry-navigation -->
			
				<div class="clear"></div>
			</div><!-- /.entry-utility -->
		
		</div><!-- /#post-<?php the_ID(); ?> -->

	<?php endwhile; ?>
	
	<?php comments_template( '', true ); ?>
	<?php bitLumen_index_nav(); ?>

</div><!-- /#content -->

<?php get_footer(); ?>