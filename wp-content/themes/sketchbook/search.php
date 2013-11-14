<?php get_header();?>
<div id="wrapper">
	<div class="container_16" id="bg">
		<section class="grid_16">
<h1><?php printf(__('Search Results for: %s', 'sketchbook'), '<span>' . get_search_query() . '</span>');?></h1>	
</section>
		<section class="grid_11 content">
		<?php if ( have_posts() ) : while (have_posts()) : the_post();
		?>	
<?php get_template_part('loop', get_post_format());?>
					<?php endwhile; else :?>
						<article <?php post_class() ?>>
				<header>
					<h1>
						<?php	_e('Nothing Found', 'sketchbook');?>
					</h1>
				</header>
				<p>
					<?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'sketchbook');?>
				</p>
						<?php	endif;?>
			</article>
		</section>
		<?php get_sidebar();?>
		<?php
		if (function_exists('wp_pagenavi')) { wp_pagenavi();
		} else { sketchbook_pagination();
		}
		?>
	</div>
</div>
<?php get_footer();?>