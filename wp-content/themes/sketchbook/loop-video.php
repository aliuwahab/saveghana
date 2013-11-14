<article <?php post_class() ?>>
	<div class=" grid_1 omega">
	<a class="format_post" href="<?php echo get_post_format_link(get_post_format()) ?>" title="<?php _e('Video', 'sketchbook');?>" > <?php _e('Video', 'sketchbook');?></a>
	</div>	
	<div class="grid_10 alpha">
		 <?php
		global $post;
		$post_options = get_post_options_api('1.0.1');
		$video = $post_options -> get_post_option($post -> ID, 'pf-video');
		if (!empty($video)) {
			$var = apply_filters('the_content', "[embed width=\"570\"]" . $video . "[/embed]");
			echo $var;
		}
 ?>
	<?php	the_excerpt();?>
		<h2><a class="link_more" href="<?php	the_permalink();?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'sketchbook'), the_title_attribute('echo=0')));?>" rel="bookmark"> <?php the_title();?></a></h2>
		<?php sketchbook_comments_info(); ?>
		<?php	sketchbook_posted_on();?> 
	</div>
	<div class="clear"></div>
</article>