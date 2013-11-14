<?php if (have_posts()) : the_post();
?>
<section class=" grid_11 content">
	<?php sketchbook_breadcrumb(); ?>
	<article <?php post_class('post') ?>>
		<header>
			<?php	the_title('<h1>', '</h1>');?>
		    <?php sketchbook_comments_info(); ?>
			<?php	sketchbook_posted_on();?>
		</header>
		<?php sketchbook_img_icons(); ?>
		<div class="entry">
			<?php	the_content();?>
			<?php sketchbook_post_quote();?>
		</div>
		<footer>
			<?php	wp_link_pages(array('before' => '<div class="page-link">' . __('<em>Pages</em>:', 'sketchbook'), 'after' => '</div>'));?>
			<?php sketchbook_posted_footer();?>
			<?php sketchbook_author_desc();?>
<?php if ( is_active_sidebar( 'post-widget' ) ) :?>		
			<ul class="widget">
				<?php dynamic_sidebar('post-widget');?>
			</ul>
<?php  endif?>
		
		</footer>
	</article>
	<?php comments_template('', true);?>
</section>
<?php  endif;?>
	<?php get_sidebar();?>