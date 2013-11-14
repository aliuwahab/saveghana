<article <?php post_class() ?>>
	<header>
	<?php	edit_post_link(__('Edit This', 'rembrandt')); ?>
	<a class="format_post alignleft" href="<?php echo get_post_format_link(get_post_format()) ?>" title="<?php _e('Links', 'rembrandt'); ?>" > <?php _e('Links', 'rembrandt'); ?></a>		
		<h2><a href="<?php	echo rembrandt_link_format(); ?>"  rel="bookmark"><?php	the_title(); ?></a></h2>		
		<?php the_excerpt(); ?>
		<?php
			if (comments_open() && !post_password_required()) :
				comments_popup_link(__('0', 'rembrandt'), __('1', 'rembrandt'), __('%', 'rembrandt'), 'post-comments', __('Comments are off for this post', 'rembrandt'));
			endif;
		?>
		<?php rembrandt_posted_on(); ?>
	</header>
</article>