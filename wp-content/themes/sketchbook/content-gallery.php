<?php if (have_posts()) : the_post();?>
<section class="grid_16">
	<?php sketchbook_breadcrumb(); ?>
	<article <?php post_class('post') ?>>
		<header>
			<?php	the_title('<h1>', '</h1>');?>
			<?php	sketchbook_posted_on();?>
		</header>
		<div class="entry"><?php	the_content(__('Continue reading &rarr;', 'sketchbook'));?></div>
		<footer>
			<?php	wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'sketchbook'), 'after' => '</div>'));?>
			<?php sketchbook_posted_footer();?>
			<?php if ( is_active_sidebar( 'post-widget' ) ) :?>		
			<ul class="widget">
				<?php dynamic_sidebar('post-widget');?>
			</ul>
<?php  endif?>
		</footer>
	</article>
</section>
<div class="prefix_3 grid_10 suffix_3">
	<?php sketchbook_author_desc();?>
	<?php comments_template('', true);?>
</div>
<?php  endif;?>