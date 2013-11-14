<?php get_header();
?>
<div id="wrapper">
	<div class="container_16" id="bg">
		<?php  $site_description = get_bloginfo( 'description' ); 
		if ( $site_description ) {
		?>
		<h3 class="grid_14 prefix_1 suffix_1 header_desc"><?php	echo $site_description;?></h3>
		<?php } ?>
		<ul>
</ul>
		<section class="grid_11 content">
			<?php get_template_part('slide');?>
			<?php 
			if (of_get_option('slide_select')=='1') 
			query_posts('ignore_sticky_posts=1');
			if ( have_posts() ) : while (have_posts()) : the_post();
			?>
			<?php get_template_part('loop', get_post_format());?>
			<?php endwhile; endif;?>
		</section>
		<?php get_sidebar();?>
		
		<?php
		if (function_exists('wp_pagenavi')) { wp_pagenavi();
		} else { echo sketchbook_pagination();
		}
		?>
		<div class="clear"></div>
	</div>
</div>
<?php get_footer();?>
