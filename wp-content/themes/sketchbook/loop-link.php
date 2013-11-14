<article <?php post_class() ?>>
	<div class=" grid_1 omega">
		<a class="format_post" href="<?php echo get_post_format_link(get_post_format()) ?>" title="<?php _e('Link', 'sketchbook');?>" > <?php _e('Links', 'sketchbook');?></a>
	</div>
	<div class="grid_10 alpha">
		<h2><a href="<?php	echo sketchbook_link_format();?>"  rel="bookmark"><?php	the_title();?></a></h2>
		<?php	the_excerpt();?>
		<?php sketchbook_comments_info();?>
		<?php	sketchbook_format_posted_on();?>
	</div>
	<div class="clear"></div>
</article>