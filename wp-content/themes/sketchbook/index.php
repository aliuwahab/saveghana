<?php get_header();?>
<div id="wrapper">
<div class="container_16" id="bg">
	<section class="grid_11 content">
		<?php if ( have_posts() ) : while (have_posts()) : the_post();
		?>
		<?php get_template_part('loop', get_post_format());?>
		<?php endwhile; endif;?>
	</section>
	<?php get_sidebar();?>
	
	<?php
	if(function_exists('wp_pagenavi')) { wp_pagenavi();
	} else { echo  sketchbook_pagination();
	}
	?>
</div>
<?php get_footer();?>
