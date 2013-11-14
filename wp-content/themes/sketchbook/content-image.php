<?php if (have_posts()) : the_post();
?>
<section class=" grid_11 content">
	<?php sketchbook_breadcrumb(); ?>
	<article <?php post_class('post') ?>>
		<header>
			<?php	the_title('<h1>', '</h1>');?>
		    <?php sketchbook_comments_info(); ?>
			<?php	sketchbook_posted_on();?>
		</header>
		<?php		   
if((function_exists('add_theme_support')) && ( has_post_thumbnail())) :
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		echo '
		<div class="sketchbook_post_icons">
			<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
			the_post_thumbnail('large');
			echo '</a>
		</div>
		';	
		else :
		$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 1 ) );	
		if ( $images ) :
		$total_images = count( $images );
		$image = array_shift( $images );
		$image_img_tag = wp_get_attachment_image( $image->ID, 'large' );
			echo $image_img_tag;
		endif; endif;?>
		<div class="entry">
			<?php	the_content();?>
		</div>
		<footer>
			<?php	wp_link_pages(array('before' => '<div class="page-link">' . __('<em>Pages</em>:', 'sketchbook'), 'after' => '</div>'));?>
			<?php sketchbook_posted_footer();?>
			<?php sketchbook_author_desc();?>
			<?php if ( is_active_sidebar( 'post-widget' ) ) :?>		
			<ul class="widget">
				<?php dynamic_sidebar('post-widget');?>
			</ul>
<?php  endif?>
		</footer>
	</article>
	<?php comments_template('', true);?>
</section>
<?php  endif;?>
	<?php get_sidebar();?>