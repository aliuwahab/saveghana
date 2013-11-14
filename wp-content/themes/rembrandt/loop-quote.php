<article <?php post_class() ?>>
	<a class="format_post alignleft" href="<?php echo get_post_format_link(get_post_format()) ?>" title="<?php _e('Quotes', 'rembrandt'); ?>" > <?php _e('Quotes', 'rembrandt'); ?></a>	
    <div class="post-content">
        <?php the_content(); ?>
    </div>
		<?php edit_post_link(__('Edit This', 'rembrandt')); ?>
        <?php
            if (comments_open() && !post_password_required()) :
                comments_popup_link(__('0', 'rembrandt'), __('1', 'rembrandt'), __('%', 'rembrandt'), 'post-comments', __('Comments are off for this post', 'rembrandt'));
            endif;
        ?>  		
		<?php rembrandt_posted_on();?>
</article>