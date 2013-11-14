<?php if (have_posts()) : the_post();
?>
<section class="grid_11 content">
	<?php sketchbook_breadcrumb();?>
	<article <?php post_class('post') ?>>
		<header>
<h1><a href="<?php	echo sketchbook_link_format();?>"  rel="bookmark"><?php	the_title();?></a></h1>
		    <?php sketchbook_comments_info(); ?>						
			<?php	sketchbook_posted_on();?>
		</header>
		<div class="entry">
			<?php	the_content();?>
		</div>
		<footer>
			<?php	wp_link_pages(array('before' => '<div class="page-link">' . __('<em>Pages</em>:', 'sketchbook'), 'after' => '</div>'));?>
			<?php sketchbook_posted_footer();?>
			<?php sketchbook_author_desc();?>
			<?php if ( is_active_sidebar( 'post-widget' ) ) :
			?>
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