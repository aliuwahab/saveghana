<article <?php post_class() ?>>
	<?php
	if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) :
		$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		echo '<span class="sketchbook_post_icons"><a class="img_full_w" href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >
	Full width</a></span>';
	endif;
	?>

	<?php if((function_exists('add_theme_support')) && ( has_post_thumbnail())) :
	?>
	<a href="<?php the_permalink();?>"><?php the_post_thumbnail('large');?></a>
	<?php	 else :
		$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
		if ( $images ) :
		$total_images = count( $images );
		$image = array_shift( $images );
		$image_img_tag = wp_get_attachment_image( $image->ID, 'large' );
	?>
	<a href="<?php the_permalink();?>"><?php echo $image_img_tag;?></a>
	<?php  endif;   endif;?>
	<div class=" grid_1 omega">
		<a class="format_post" href="<?php echo get_post_format_link(get_post_format()) ?>" title="<?php _e('Image', 'sketchbook');?>" > <?php _e('Image', 'sketchbook');?></a>
	</div>
	<div class="grid_10 alpha">
		<?php	the_excerpt();?>
		<?php edit_post_link(__('Edit This', 'sketchbook'));?>
		<h2><a class="link_more" href="<?php	the_permalink();?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'sketchbook'), the_title_attribute('echo=0')));?>" rel="bookmark"> <?php the_title();?></a></h2>
		<?php sketchbook_comments_info();?>
		<?php	sketchbook_posted_on();?>
	</div>
	<div class="clear"></div>
</article>