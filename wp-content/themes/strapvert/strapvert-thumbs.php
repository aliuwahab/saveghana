		<?php if (has_post_format('gallery') ) { ?>	    
		<?php if (has_post_thumbnail()) {
			$imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'medium');
			$imgsrc = $imgsrc[0];
		} elseif ($postimages = get_children("post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=0")) {
			foreach($postimages as $postimage) {
			$imgsrc = wp_get_attachment_image_src($postimage->ID, 'medium');
			$imgsrc = $imgsrc[0];
		}
			} elseif (preg_match('/<img [^>]*src=["|\']([^"|\']+)/i', get_the_content(), $match) != FALSE) {
			$imgsrc = $match[1];
		} else {
			return "";
		}
		?>
		<div class="entry-thumbnail">
		   <a href="<?php the_permalink(); ?>">
			 <img src="<?php echo $imgsrc; $imgsrc = ''; ?>" />
		   </a>	
	    </div>
	    <?php } else { ?>
		<?php if (has_post_thumbnail()) {
			$imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'large');
			$imgsrc = $imgsrc[0];
		} elseif ($postimages = get_children("post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=0")) {
			foreach($postimages as $postimage) {
			$imgsrc = wp_get_attachment_image_src($postimage->ID, 'large');
			$imgsrc = $imgsrc[0];
		}
			} elseif (preg_match('/<img [^>]*src=["|\']([^"|\']+)/i', get_the_content(), $match) != FALSE) {
			$imgsrc = $match[1];
		} else {
			return "";
		}
		?>
		<div class="summary-thumbnail">
		   <a href="<?php the_permalink(); ?>">
			 <img src="<?php echo $imgsrc; $imgsrc = ''; ?>" />
		   </a>	
	    </div>
		<?php } ?>
