<?php
/**
 * Template Name: Archives
 **/
?>
<?php get_header();?>
<div id="wrapper">
<div id="bg" class="container_16">
	<section class="grid_16">
			<?php sketchbook_breadcrumb();?>
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
		<?php the_post();?>
		<h1 class="entry-title"><?php the_title();?></h1>
	<ul class="entry">
		<li class="grid_5 omega">	
		<h2><?php _e('Archives by Month', 'sketchbook');?></h2>
		<ul>
			<?php wp_get_archives('type=monthly');?>
		</ul>	
		</li>


		<li class="grid_5">
		<h2><?php _e('Archives by Subject', 'sketchbook');?></h2>
		<ul>
			 <?php wp_list_categories('title_li=');?>
		</ul>	
</li>
		<li class="grid_6 alpha">	
<h2><?php _e('Our latest 50 Posts', 'sketchbook');?></h2>
            <ul>
            <?php wp_get_archives('type=postbypost&limit=50&format=custom&before=<li>&after=</li>');?>
            </ul>
            		</li>
	</ul>
		</article>
		<?php  endif;?>
	</section>
</div>
<?php get_footer();?>