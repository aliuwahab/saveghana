<article <?php post_class() ?>>
<?php sketchbook_img_icons_links(); ?>
	<header>
		<h2><a href="<?php	the_permalink();?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'sketchbook'), the_title_attribute('echo=0')));?>" rel="bookmark"><?php the_title();?></a></h2>
		<?php if (!is_search() ) :
		?>
		<?php sketchbook_comments_info(); ?>		
		<?php sketchbook_posted_on();?>
		<?php edit_post_link(__('Edit This', 'sketchbook'), '<p>', '</p>');?>
		<?php 
			endif;
		?>
	</header>
	<?php  the_content(); ?>
	<footer>
		<?php	wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'sketchbook'), 'after' => '</div>'));?>
		<?php sketchbook_posted_footer();?>
	</footer>
</article>