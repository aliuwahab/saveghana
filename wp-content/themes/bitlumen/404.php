<?php get_header(); ?>

		<div id="content">
			<div id="entry-error" class="entry error 404 no-results">
			<h2 class="entry-title">404 - Not Found</h2>
				<div class="entry-content">
					<p>Out apologies, but the page you we're looking for doesn't exist.</p>
					<p>Perhaps this search box can help.</p>
					<div><?php get_search_form( true ); ?></div>
				</div><!-- /.entry-content -->
	
			<div class="clear"></div>
			</div><!-- /#post-<?php the_ID(); ?> -->

		</div><!-- /#content -->

<?php get_footer(); ?>