<?php 
if (of_get_option('slide')) {
	
wp_enqueue_script('flex-slide');
?>


	<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery('.flexslider').flexslider({
				controlsContainer : ".flex-container",
				slideDirection : "horizontal",
		<?php	if (of_get_option('slide_effect') == 'two'):
		echo'animation : "slide"';
else :
	echo'animation : "fade"';
endif; ?>	,
		<?php	if (of_get_option('slide_play')):
		echo'directionNav : false, slideshow: true';					
else :
	echo'slideshow: false';
endif; ?>,              

				controlNav : true,
				pauseOnHover : true,
				slideshowSpeed : 6000,
				animationDuration : 600
			});
		});
	</script>	
				<div class=" flex-container">
			<div class="flexslider">
				<ul class="slides">
<?php
$pfaside = array('posts_per_page' => 10,'tax_query' => array(array('taxonomy' => 'post_format','terms' => array( 'post-format-aside'),'field' => 'slug',
			),),);
$pfimage = array('posts_per_page' => 10,'tax_query' => array(array('taxonomy' => 'post_format','terms' => array( 'post-format-image'),'field' => 'slug',
			),),);
$pfgallery = array('posts_per_page' => 10,'tax_query' => array(array('taxonomy' => 'post_format','terms' => array( 'post-format-gallery'),'field' => 'slug',
			),),);
$pflink = array('posts_per_page' => 10,'tax_query' => array(array('taxonomy' => 'post_format','terms' => array( 'post-format-link'),'field' => 'slug',
			),),);
$pfquote = array('posts_per_page' => 10,'tax_query' => array(array('taxonomy' => 'post_format','terms' => array( 'post-format-quote'),'field' => 'slug',
			),),);
$pfsticky = array('posts_per_page' => 10,'post__in'  => get_option( 'sticky_posts' ),'ignore_sticky_posts' => 1			
			);
$cat  = array('cat' => of_get_option('slide_select'));
$args_not = array('posts_per_page' => 4);

	if (of_get_option('slide_select')=='1') :
	    $the_query = new WP_Query( $pfsticky );
	elseif (of_get_option('slide_select')=='2') :
	    $the_query = new WP_Query( $pfaside );		
	elseif (of_get_option('slide_select')=='3') :
		$the_query = new WP_Query( $pfimage );
	elseif (of_get_option('slide_select')=='4') :
		$the_query = new WP_Query( $pfgallery );
	elseif (of_get_option('slide_select')=='5') :
		$the_query = new WP_Query( $pflink );
	elseif (of_get_option('slide_select')=='6') :
		$the_query = new WP_Query( $pfquote );
	elseif (of_get_option('slide_select')>'6') :
	    $the_query = new WP_Query( $cat ); 
    elseif (of_get_option('slide_select')=='0') :
	    $the_query = new WP_Query( $args_not);
		endif;
?>

<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<li>	
						<?php 
if ( (function_exists( 'add_theme_support' ))  && ( has_post_thumbnail() )):
the_post_thumbnail('sketchbook_slide');?>
						<div class="flex-caption">
							<h2><a href="<?php	the_permalink();?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'sketchbook'), the_title_attribute('echo=0')));?>" > 
								<?php	the_title();?></a></h2>			
						</div>
							<?php else :?>
						<div class="flex-caption flex-caption_no_img">
							<h2><a  href="<?php	the_permalink();?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'sketchbook'), the_title_attribute('echo=0')));?>" > 
								<?php	the_title();?></a></h2>
							<?php 								global $post;
		$post_options = get_post_options_api('1.0.1');
		$video = $post_options -> get_post_option($post -> ID, 'pf-video');
		if (!empty($video)) :
			$var = apply_filters('the_content', "[embed height=\"180\" width=\"320\" ]" . $video . "[/embed]");
			echo $var;
		else : the_excerpt(); endif;
							?>
						</div>
							<?php endif;?>
					</li>
					<?php endwhile;  wp_reset_postdata();
					?>
				</ul>
			</div>
		</div>
<?php } ?>