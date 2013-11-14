<?php
/*
 * Plugin Name: Post Options API Example
 * Description: This plugin demonstrates the usage of the Post Options API
 * Author: Konstantin Kovshenin
 * Version 1.0.1
 * License: GPLv2
 */

// We'll do everything inside init.
add_action( 'init', 'post_options_api_example' );

// Let's test out the above
function post_options_api_example() {
	
	// Include the Post Options API Library bundled with this plugin
	 get_template_part('inc/post-options-api.1.0.1');
	//// //require_once ( get_template_directory() . '/inc/post-1.0.1.php' );

	// Initialize the Post Options API and Fields
	$post_options = get_post_options_api( '1.0.1' );
	$post_fields = get_post_options_api_fields( '1.0.1' );	
	
	// Register two sections and add them both to the 'post' post type
	$post_options->register_post_options_section( 'post-f', __( 'Post formats options', 'sketchbook' ),1 );
	$post_options->add_section_to_post_type( 'post-f', 'post' );
	
	// The showing off section

/*    Post Format - Link  */
	$post_options->register_post_option( array( 
		'id' => 'pf-link',
		'title' => __( 'Post format - Link', 'sketchbook' ),
		'section' => 'post-f',
		'callback' => $post_fields->text( array(
			'description' => __( 'Paste link', 'sketchbook' )
		) )
	) );
/*    Post Format - Quote Author  */
	$post_options->register_post_option( array( 
		'id' => 'pf-quote-title',
		'title' => __( 'Post format - Quote - Author', 'sketchbook' ),
		'section' => 'post-f',
		'callback' => $post_fields->text( array(
			'description' => __( 'If you choose the format of the post - quotation - and you want to add the author you must write his name.', 'sketchbook' )
		) )
	) );
/*    Post Format - Quote link  */		
	$post_options->register_post_option( array( 
		'id' => 'pf-quote',
		'title' => __( 'Post format - Quote - Link', 'sketchbook' ),
		'section' => 'post-f',
		'callback' => $post_fields->text( array(
			'description' => __( 'Past the link into the source of quotation. The author of the quotation will be the link to the source, to make the link available fill in \"the Author quotation\" field.', 'sketchbook' )
		) )
	) );
/*    Post Format - Gallery  */
	$post_options->register_post_option( array( 
		'id' => 'pf-gallery',
		'title' => __( 'Post Format - Gallery', 'sketchbook' ),
		'section' => 'post-f',
		'std'=>'option-1',
		'callback' => $post_fields->radio( array(	
			'description' => __( 'You can use the two kinds of presentation of the gallery on the main page and in the archive. The first display the pictures in the thumbnail form, the second display the single pictures (featured image or the first  picture which was added to gallery ). After entering the entry page Gallery is presented in the same way regardless of the settings.', 'sketchbook' ),
			'radio_data' => array(
				'option-1' => __( 'Display the whole gallery in the thumbnail form', 'sketchbook' ),
				'option-2' => __( 'Single pictures from the gallery', 'sketchbook' )
			)
		) )
	) );
/*    Post Format - Video  */
	$post_options->register_post_option( array( 
		'id' => 'pf-video',
		'title' => __( 'Post format - Video', 'sketchbook' ),
		'section' => 'post-f',
		'callback' => $post_fields->text( array(
			'description' => __( 'If you choose the video post format, you must be sure that you insert the option in Settings>Media> When possible, embed the media content from a URL directly onto the page. For example: links to Flickr and YouTube. Then past the link to the website of the film in the field above e.g. http://vimeo.com/33420937, the same link past in the visual editor field and. The list of the services from which you can add films are at the following address http://codex.wordpress.org/Embeds', 'sketchbook' )
		) )
	) );	
}

/*----------*/
/*    Post Format - Link  */
/*----------*/
	if(!function_exists('sketchbook_link_format')) {	
		function sketchbook_link_format() {
global $post;
$post_options = get_post_options_api( '1.0.1' );
$link = $post_options->get_post_option( $post->ID, 'pf-link' );	
if ( ! empty($link) ) : 
	    return esc_url_raw($link);
elseif(preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches)):
		return esc_url_raw($matches[1]);
else :
		return esc_url_raw(get_permalink());
endif;
	}
	}
/*----------*/
/*    Post Format - Quote  */
/*----------*/
function sketchbook_post_quote() {
global $post;
$post_options = get_post_options_api( '1.0.1' );
$quote = $post_options->get_post_option( $post->ID, 'pf-quote' );
$quoteauthor = $post_options->get_post_option( $post->ID, 'pf-quote-title' );

if ( ! empty( $quoteauthor) && empty( $quote) ) 
echo '<h2><cite>'.$quoteauthor.'</cite></h2>';	

elseif ( ! empty( $quoteauthor) && ! empty( $quote) )  
echo '<h2><cite><a href="'.$quote.'" title="'.esc_attr(sprintf(__('%s', 'sketchbook'), the_title_attribute('echo=0'))).'" rel="bookmark">'.$quoteauthor.'</a></cite></h2>';
}
/*----------*/
/*    Post Format - Gallery  */
/*----------*/
function sketchbook_post_format_gallery() {
global $post;
$post_options = get_post_options_api( '1.0.1' );
$gallery = $post_options->get_post_option( $post->ID, 'pf-gallery' );

if (  $gallery == 'option-2') { 
if((function_exists('add_theme_support')) && ( has_post_thumbnail())) :

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
<?php  endif;   endif;
	}
	else{
	echo do_shortcode('[gallery link="file" size="sketchbook_post-thumb" columns="3"]');
	}
	}
?>