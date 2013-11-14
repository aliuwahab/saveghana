<?php
/***
 * Custom Color Options
 *
 * Get custom colors from theme options and embed CSS color settings 
 * in the <head> area of the theme. 
 *
 */


// Add Custom Colors
add_action('wp_head', 'themezee_custom_colors');
function themezee_custom_colors() { 
	
	// Get Theme Options
	$options = get_option('zeeminty_options');
	
	// Get Color Scheme and set color scheme to default if nothing is selected)
	$color_scheme = $options['themeZee_color_scheme'] <> '' ? esc_attr($options['themeZee_color_scheme']) : 'default';
	
	$link_color = $color_scheme;
	$navi_color = $color_scheme;
	$post_title_color = $color_scheme;
	$sidebar_title_color =  $color_scheme;
	$sidebar_link_color = $color_scheme;
	$frontpage_title_color = $color_scheme;
	$frontpage_link_color = $color_scheme;
	
	// Set CSS settings except color scheme is default (=> default colors are already defined in style.css)
	if( $color_scheme <> 'default') :
	
		$color_css = '<style type="text/css">';
		$color_css .= '
			a, a:link, a:visited, .comment a:link, .comment a:visited {
				color: '. $link_color .';
			}
			input[type="submit"], .more-link, #commentform #submit, .wp-pagenavi .current {
				background-color: '. $link_color .';
			}
			#mainnav-menu a:hover, #mainnav-menu li.current_page_item a, #mainnav-menu li.current-menu-item a, #mainnav-icon:hover {
				color: '. $navi_color .';
			}
			#mainnav-menu ul {
				background: '. $navi_color .';
			}
			#logo .site-title, .page-title, .post-title, .post-title a:link, .post-title a:visited,
			#frontpage-slider .zeeslide .slide-title, #frontpage-slider .zeeslide .slide-link {
				color: '. $post_title_color .';
			}
			.post-title a:hover, .post-title a:active {
				color: #333333;
			}
			#header-image-wrap, #frontpage-slider-wrap, .bypostauthor .fn, .comment-author-admin .fn {
				background: '. $post_title_color .';
			}
			#sidebar a:link, #sidebar a:visited{
				color: '. $sidebar_link_color .';
			}
			#sidebar .widgettitle {
				color: '. $sidebar_title_color .';
			}
			#sidebar .widget-tabnav li a {
				background-color: '. $sidebar_title_color .';
			}
			#sidebar .widget-tabnavi li a:hover, #sidebar .widget-tabnavi li a:active {  
				background-color: #303030;
			}
			.frontpage-widgets a:link, .frontpage-widgets a:visited{
				color: '. $frontpage_link_color .';
			}
			.frontpage-widgets .widgettitle {
				color: '. $frontpage_title_color .';
			}
			.frontpage-widgets .widget-tabnav li a, #frontpage-widgets-one .widget .widgettitle {
				background-color: '. $frontpage_title_color .';
			}
		';
		$color_css .= '</style>';
		
		// Print Color CSS
		echo $color_css;
	
	endif;
}