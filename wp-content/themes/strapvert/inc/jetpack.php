<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package StrapVert
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function strapvert_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
	
	// Featured Content: http://jetpack.me/support/featured-content/
	add_theme_support( 'featured-content', array(
    	'featured_content_filter' => 'strapvert_get_featured_posts',
    	'max_posts' => 5,
	) );
}
add_action( 'after_setup_theme', 'strapvert_jetpack_setup' );
