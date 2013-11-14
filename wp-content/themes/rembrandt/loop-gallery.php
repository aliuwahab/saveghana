
<article <?php post_class() ?>>
	<figure  class="gallery-thumb">
<?php
	$args = array(
	'post_type' => 'attachment', 
	'numberposts' => -1, 
	'post_status' => null, 
	'post_parent' => $post -> ID
	);
$attachments = get_posts($args);
				if ($attachments) :
					echo '<div class="flexslider"><ul class="slides">';
					foreach ($attachments as $attachment) :
						echo '<li>';
						echo wp_get_attachment_image($attachment -> ID, 'large');
						echo '</li>';
					endforeach;
					echo '</ul></div>';
				endif;
?>		
		<figcaption>		
			<?php edit_post_link(__('Edit This', 'rembrandt')); ?>	
            <?php the_excerpt(); ?>			
        <?php
            if (comments_open() && !post_password_required()) :
                comments_popup_link(__('0', 'rembrandt'), __('1', 'rembrandt'), __('%', 'rembrandt'), 'post-comments', __('Comments are off for this post', 'rembrandt'));
            endif;
        ?>  	
			<h2><a href="<?php echo get_post_format_link('gallery'); ?>">
					<?php _e('Gallery &raquo;', 'rembrandt'); ?></a>
			 	<a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'rembrandt'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php	the_title(); ?></a>
			</h2>
		</figcaption>
	</figure>
</article>

