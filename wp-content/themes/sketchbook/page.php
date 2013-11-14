<?php get_header();?>
<div id="wrapper">
<div id="bg" class="container_16">
	<section class="grid_11 content">
			<?php sketchbook_breadcrumb(); ?>
		<?php if (have_posts())  : the_post();
		?>
		<article <?php post_class('post') ?>>
			<header>
				<?php if ( is_front_page() ) {
				?>
				<?php the_title('<h2>', '</h2>');?>
				<?php } else {?>
				<?php the_title('<h1>', '</h1>');?>
				<?php }?>
			</header>
		<?php
		if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
			the_post_thumbnail('sketchbook_post-thumb');
		}
		?>
		<div class="entry">
			<?php	the_content(__('Continue reading &rarr;', 'sketchbook'));?>
					<div class="clear"></div>
		</div>
			<?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'sketchbook'), 'after' => '</div>'));?>
			<?php edit_post_link(__('Edit This', 'sketchbook'));?>
		</article>
		<?php comments_template();?>
		<?php  endif;?>
	</section>
	<?php get_sidebar();?>
</div>
<?php get_footer();?>