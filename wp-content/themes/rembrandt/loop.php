<article <?php post_class() ?>>
	<header>
		<h2><a href="<?php	the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'rembrandt'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <?php
            if (comments_open() && !post_password_required()) :
                comments_popup_link(__('0', 'rembrandt'), __('1', 'rembrandt'), __('%', 'rembrandt'), 'post-comments', __('Comments are off for this post', 'rembrandt'));
            endif;
        ?>  
		<?php	rembrandt_posted_on(); ?>
	</header>
	<div class="post-content">
    <?php
    if (has_post_thumbnail()) {
        the_post_thumbnail('thumbnail',array('class'=>'alignleft'));
    }
    ?>	    
		<?php the_content(__('Continue reading &rarr;', 'rembrandt')); ?>
	</div>
	<footer>
		<?php	wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'rembrandt'), 'after' => '</div>')); ?>
		<?php
		rembrandt_posted_footer();
		?>
	</footer>
</article>
