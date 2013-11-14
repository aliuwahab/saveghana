<article <?php post_class() ?>>	
	<?php edit_post_link(__('Edit This', 'rembrandt'));?>		
	<a class="format_post alignleft" href="<?php echo get_post_format_link(get_post_format()) ?>" title="<?php _e('Aside', 'rembrandt');?>" > <?php _e('Aside', 'rembrandt');?></a>		
		<?php	the_content(__('Continue reading &rarr;', 'rembrandt'));?>
        <?php
            if (comments_open() && !post_password_required()) :
                comments_popup_link(__('0', 'rembrandt'), __('1', 'rembrandt'), __('%', 'rembrandt'), 'post-comments', __('Comments are off for this post', 'rembrandt'));
            endif;
        ?>  
		<?php	rembrandt_posted_on();?>
</article>