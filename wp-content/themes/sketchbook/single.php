<?php get_header();?>
<div id="wrapper">
<div class="container_16" id="bg">
	<?php get_template_part('content', get_post_format());?>
	<div class="wp-pagenavi">
			<?php previous_post_link('<div class="alignleft">%link</div>');?>	
			<?php next_post_link('<div class="alignright">%link</div>');?>		
		<div class="clear"></div>
	</div>
</div>
</div>
<?php get_footer();?>