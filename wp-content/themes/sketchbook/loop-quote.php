<article <?php post_class() ?>>
	<div class=" grid_1 omega">
		<a class="format_post" href="<?php echo get_post_format_link(get_post_format()) ?>" title="<?php _e('Quote', 'sketchbook');?>" > <?php _e('Quotes', 'sketchbook');?></a>
	</div>
	<div class="grid_10 alpha">
		<?php	the_content(__('Continue reading &rarr;', 'sketchbook'));?>
		<?php sketchbook_post_quote();?>
		<?php sketchbook_comments_info();?>
		<?php sketchbook_format_posted_on();?>
	</div>
	<div class="clear"></div>
</article>