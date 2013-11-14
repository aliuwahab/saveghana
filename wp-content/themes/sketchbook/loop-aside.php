<article <?php post_class() ?>>
	<div class=" grid_1 omega">
	<a class="format_post" href="<?php echo get_post_format_link(get_post_format()) ?>" title="<?php _e('Aside', 'sketchbook');?>" > <?php _e('Aside', 'sketchbook');?></a>
	</div>	
	<div class="grid_10 alpha">
		<?php	the_content(__('Continue reading &rarr;', 'sketchbook'));?>
		<?php sketchbook_comments_info(); ?>
        <?php sketchbook_format_posted_on();?>
	</div>
	<div class="clear"></div>
</article>