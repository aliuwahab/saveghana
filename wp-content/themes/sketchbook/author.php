<?php get_header();?>
<div id="wrapper">
	<div class="container_16" id="bg">
		<section class="grid_11 content">
			<?php if ( have_posts() ) :
			?>
			<?php the_post();?>
			<h1><?php printf(__('%s', 'sketchbook'), '<span class="vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta("ID"))) . '" title="' . esc_attr(get_the_author()) . '" rel="me">' . get_the_author() . '</a></span>');?></h1>
			<?php rewind_posts();?>
			<?php sketchbook_author_desc (); 
			?>
			<?php endif;?>
			
			<?php  while (have_posts()) : the_post();?>
			<?php get_template_part('loop', get_post_format());?>
			<?php endwhile;?>
		</section>
		<?php get_sidebar();?>
		
		<?php
		if (function_exists('wp_pagenavi')) { wp_pagenavi();
		} else {  sketchbook_pagination();
		}
		?>
	</div>
</div>
<?php get_footer();?>