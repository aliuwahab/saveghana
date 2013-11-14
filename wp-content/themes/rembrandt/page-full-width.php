<?php /**
 * Template Name: Full width
 *  */
?>
<?php get_header();?>
<div class="container" id="wrapper">
	<section class="sixteen columns">
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
			<div class="post-content">
        <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
                }
        ?>			    
			<?php the_content();?>
			<?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'rembrandt'), 'after' => '</div>'));?>
			<?php edit_post_link(__('Edit This', 'rembrandt'));?>
			</div>
		</article>
		<?php comments_template('', true);?>
		<?php  endif;?>
	</section>
</div>
<?php get_footer();?>