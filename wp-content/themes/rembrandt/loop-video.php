<article <?php post_class() ?>>
<?php edit_post_link(__('Edit This', 'rembrandt'));?>	
<?php the_content();?>	
	<header>
	<a class="format_post alignleft" href="<?php echo get_post_format_link(get_post_format()) ?>" title="<?php _e('Video', 'rembrandt');?>" > <?php _e('Video', 'rembrandt');?></a>		

		<h2><a href="<?php	the_permalink();?>" title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'rembrandt'), the_title_attribute('echo=0')));?>" rel="bookmark"><?php	the_title();?></a></h2>
		<?php
			if (comments_open() && !post_password_required()) :
				comments_popup_link(__('0', 'rembrandt'), __('1', 'rembrandt'), __('%', 'rembrandt'), 'post-comments', __('Comments are off for this post', 'rembrandt'));
			endif;
		?>
		<?php	rembrandt_posted_on();?>
	</header>	
</article>