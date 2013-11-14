<article <?php post_class() ?>>
	<?php sketchbook_post_format_gallery();?>
	<div class=" grid_1 omega">
		<a class="format_post" href="<?php echo get_post_format_link(get_post_format()) ?>" title="<?php _e('Gallery', 'sketchbook');?>" > <?php _e('Gallery', 'sketchbook');?></a>
	</div>
	<div class="grid_10 alpha">
		<?php	the_excerpt();?>
		<?php edit_post_link(__('Edit This', 'sketchbook'));?>
		<h2><a class="link_more" href="<?php	the_permalink();?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'sketchbook'), the_title_attribute('echo=0')));?>" rel="bookmark"> <?php the_title();?></a></h2>
		<?php sketchbook_comments_info();?>
		<?php	sketchbook_posted_on();?>
	</div>
	<div class="clear"></div>
</article>