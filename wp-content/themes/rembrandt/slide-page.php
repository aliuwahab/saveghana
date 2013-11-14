<?php /**
 * Template Name: Slideshow
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
						<?php if ( (function_exists( 'add_theme_support' ))  && ( has_post_thumbnail() )):
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
<section class="sixteen columns">
		<?php if (have_posts()) :  the_post();
		?>
		<article <?php post_class('post slide_page') ?>>
			<header>
				<?php the_title('<h1 class="title">', '</h1>'); ?>
			</header>
							<?php
							if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
								the_post_thumbnail('rembrandt_slide');
							}
				?>
				<div class="post-content">
			<?php	the_content(); ?>
			</div>
		</article>
		<?php endif; ?>
	</section>
</div>
<?php get_footer(); ?>
