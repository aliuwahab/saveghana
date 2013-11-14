<?php /**
 * Template Name: Slideshow with posts
 *  */
?>
<?php get_header();
?>
<div class="container" id="wrapper">
	<div id="container" class="sixteen columns slajd">
<div class="flexslider">
	<ul class="slides">
						<?php
						global $post;
						$post_options = get_post_options_api('1.0.1');
						$sticky = get_option('sticky_posts');
						$args = array('meta_key' => 'slide-page', 'post_type' => array('post', 'page'), 'p=' . $sticky, 'ignore_sticky_posts' => 0);
						$args_not = array('posts_per_page' => 4);
						if ($sticky || empty($slide)) :
							query_posts($args);
						else :
							query_posts($args_not);
						endif;
						?>
						<?php   if (have_posts()) : while (have_posts()) : the_post();
						?>
					<li class="slide">
						<?php if ( has_post_thumbnail()):
the_post_thumbnail('rembrandt_slide');
						?>
						<div class="captionslide caption">
							<h2><a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'matisse'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php	the_title(); ?></a></h2>
							<?php the_excerpt(); ?>
						</div>
						<?php else : ?>
						<div class="slide-no-image caption">
							<h2><a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'matisse'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php	the_title(); ?></a></h2>
							<?php the_excerpt(); ?>
						</div>
						<?php endif; ?>
					</li>
					<?php endwhile; endif; wp_reset_query(); ?>
				
</ul>
</div>

	</div>
	<section id="content" class="eleven columns">
		<?php rembrandt_breadcrumb(); ?>
		<?php
		global $more;
$more = 0;
$sticky = get_option( 'sticky_posts' );
$args=array(
'paged' =>   get_query_var( 'page' ),
'post__not_in' => $sticky
);
$wp_query = new WP_Query($args);
while ($wp_query->have_posts()) : $wp_query->the_post();
		?>
		<?php get_template_part('loop', get_post_format()); ?>
		<?php endwhile; ?>
	</section>
	<?php get_sidebar(); ?>
	<?php
	if (function_exists('wp_pagenavi')) { wp_pagenavi();
	} else {  rembrandt_pagination();
	}
	?>
</div>
<?php get_footer(); ?>
