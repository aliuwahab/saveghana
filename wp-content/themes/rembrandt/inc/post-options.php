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
	require( dirname( __FILE__ ) . '/post-options-api.1.0.1.php' );

	// Initialize the Post Options API and Fields
	$post_options = get_post_options_api( '1.0.1' );
	$post_fields = get_post_options_api_fields( '1.0.1' );	
	
	// Register two sections and add them both to the 'post' post type
//	$post_options->register_post_options_section( 'post-f', __( 'Post Format options', 'rembrandt' ),1 );
	$post_options->register_post_options_section( 'page-o', __( 'Page options', 'rembrandt' ),1 );
//	$post_options->add_section_to_post_type( 'post-f', 'post' );
	$post_options->add_section_to_post_type( 'page-o', 'page' );
	
	// The showing off section

/*    Page slideshow  */
	
	$post_options->register_post_option( array( 
		'id' => 'slide-page',
		'title' => __( 'Featured', 'rembrandt' ),
		'section' => 'page-o',
		'callback' => $post_fields->checkbox( array(
			'label' => __( 'This is a featured post', 'rembrandt' ),
			'description' => __( 'Check this to feature the post in the highlights section on the homepage.', 'rembrandt' )
		) )
	) );
	
}

?>