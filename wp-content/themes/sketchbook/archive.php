<?php	get_header();?>
<div id="wrapper">
	<div class="container_16" id="bg">
		<section class="grid_16">
			<?php
			if (is_category()) :
				printf(__('<h1>Category Archives: <em>%s</em></h1>', 'sketchbook'), single_cat_title('', false));
				printf(__('<p>%s</p>', 'sketchbook'), category_description());
			elseif (is_tag()) :
				printf(__('<h1>Tag Archives: <em>%s</em></h1>', 'sketchbook'), single_tag_title('', false));
				printf(__('<p>%s</p>', 'sketchbook'), tag_description());
			elseif (is_day()) :
				printf(__('<h1>Daily Archives: <em>%s</em></h1>', 'sketchbook'), get_the_date());
			elseif (is_month()) :
				printf(__('<h1>Monthly Archives: <em>%s</em></h1>', 'sketchbook'), get_the_date('F Y'));
			elseif (is_year()) :
				printf(__('<h1>Yearly Archives: <em>%s</em></h1>', 'sketchbook'), get_the_date('Y'));
			elseif (has_post_format('gallery')) :
				_e('<h1>Gallery</h1>', 'sketchbook');
			elseif (has_post_format('link')) :
				_e('<h1>Link</h1>', 'sketchbook');
			elseif (has_post_format('aside')) :
				_e('<h1>Aside</h1>', 'sketchbook');
			elseif (has_post_format('quote')) :
				_e('<h1>Quote</h1>', 'sketchbook');
			elseif (has_post_format('video')) :
				_e('<h1>Video</h1>', 'sketchbook');
			elseif (has_post_format('image')) :
				_e('<h1>Images</h1>', 'sketchbook');
			else :
				_e('<h1>Blog Archives</h1>', 'sketchbook');
			endif;
			?>
			<?php sketchbook_breadcrumb();?>
			</section>
	<section class="grid_11 content">
		<?php if ( have_posts() ) : while (have_posts()) : the_post();
		?>
		<?php get_template_part('loop', get_post_format());?>
		<?php endwhile; endif;?>
	</section>
		<?php get_sidebar();?>
		<?php
		if (function_exists('wp_pagenavi')) { wp_pagenavi();
		} else {  sketchbook_pagination();
		}
		?>
	</div>
	<?php get_footer();?>