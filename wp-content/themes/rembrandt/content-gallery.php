<?php if (have_posts()) : the_post();
?>
<section class="sixteen columns">
		<?php rembrandt_breadcrumb(); ?>
	<article <?php post_class('post') ?>>
		<header>
			<?php 	the_title('<h1>', '</h1>');?>
        <?php
            if (comments_open() && !post_password_required()) :
                comments_popup_link(__('0', 'rembrandt'), __('1', 'rembrandt'), __('%', 'rembrandt'), 'post-comments', __('Comments are off for this post', 'rembrandt'));
            endif;
        ?> 
			<?php 	rembrandt_posted_on();?>
		</header>
		<div class="post-content">
			<?php the_content(__('Continue reading &rarr;', 'rembrandt'));?>
		</div>
		<footer>
			<?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'rembrandt'), 'after' => '</div>'));?>
			<?php rembrandt_posted_footer();?>
		</footer>
	</article>
</section>
<div class="ten offset-by-three  columns">
	<?php  	rembrandt_author_info();?>
	<?php comments_template('', true);?>
</div>
<?php  endif;?>