<?php get_header();?>
<div id="wrapper">
	<div class="container_16" id="bg">
		<section class="grid_16">
			<article>
				<h1><?php _e('Error 404 - Not Found', 'sketchbook');?></h1>
				<p>
					<?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'sketchbook');?>
				</p>
				<?php get_search_form();?>
				<div class="grid_5">
					<?php the_widget('WP_Widget_Recent_Posts', array('number' => 5));?>
				</div>
				<div class="grid_5">
					<?php the_widget('WP_Widget_Categories', array('dropdown' => 1));?>
				</div>
				<div class="grid_5">
					<?php the_widget('WP_Widget_Tag_Cloud');?>
				</div>
			</article>
		</section>
	</div>
</div>
<?php wp_footer();?>
</body>
</html>