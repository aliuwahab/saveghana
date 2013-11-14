<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.  If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).  Friends don't let 
 * friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package Sukelius
 * @subpackage Functions
 * @version 0.1
 * @author SIN <sin2384@gmail.com>
 * @copyright Copyright (c) 2012, Sinisa Nikolic
 * @link 
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();
 
/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'sukelius_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function sukelius_theme_setup() {
    
	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();
	
	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-menus', array( 'primary', 'secondary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'primary', 'secondary', 'header', 'subsidiary', 'after-singular' ) );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
        add_theme_support( 'hybrid-core-scripts', array( 'drop-downs' ) );
        add_theme_support( 'hybrid-core-seo' );
	add_theme_support( 'hybrid-core-template-hierarchy' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'footer', 'about') ); // Enables settings page
	
	/* Add theme support for framework extensions. */
	add_theme_support( 'theme-layouts', array( '1c', '2c-l', '2c-r', '3c-l', '3c-r', '3c-c' ) );
	add_theme_support( 'post-stylesheets' );
        add_theme_support( 'hybrid-core-styles', array( 'style' ) );
        add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'cleaner-gallery' );               
        
	/* Load Theme Settings */
	if ( is_admin() ) 
                require_once( trailingslashit ( get_template_directory() ) . 'admin/functions-admin.php' );
                
	/* Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );
        
        /* Add support for post formats. */
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'gallery', 'link', 'quote', 'status', 'video', 'chat' ) );	        
	
        /* Add support for a custom background. */
	add_theme_support( 'custom-background', array( 'default-color' => 'D5D5D5', ) );        
	
	/* Add support for a custom header background image. */
        $args = array(
                'width'         => 960,
                'height'        => 112,
                'flex-height'  => true,
                'header-text' => false,
                'wp-head-callback' => 'sukelius_header_bg',
        );
        
        add_theme_support( 'custom-header', $args );
	
	/* Set default layout. */
	add_filter( 'get_theme_layout', 'sukelius_theme_layout' );
        
	/* Filter the sidebar widgets. */
	add_filter( 'sidebars_widgets', 'sukelius_disable_sidebars' );
	add_action( 'template_redirect', 'sukelius_one_column' );	

        /* Add additional body classes */
        add_filter( 'body_class', 'sukelius_additional_body_classes' );        
        
	/* Additional css classes for widgets */
	add_filter( 'dynamic_sidebar_params', 'sukelius_widget_classes' );
        
	/* Custom excerpt length */
	add_filter( 'excerpt_length', 'sukelius_excerpt_length' );
            
        /* Add <blockquote> for quote post format if user didn't. */
        add_filter( 'the_content', 'sukelius_quote_content' );
        
	/* Set the content width  */
	hybrid_set_content_width( 620 );
        
	/* Embed width/height defaults. */
	add_filter( 'embed_defaults', 'sukelius_embed_defaults' );        
        
	/* Register shortcodes */
	add_action( 'init', 'sukelius_register_shortcodes' );        

	/* Exclude sticky posts from home page. */
	add_action( 'pre_get_posts', 'sukelius_exclude_sticky' );
        
        /* Add custom image sizes. */
	add_action( 'init', 'sukelius_add_image_sizes' );
	
	/* Add js scripts */
	add_action( 'wp_enqueue_scripts', 'sukelius_scripts' );
        
        /* Fix WP conditional !IE */        
        add_filter( 'style_loader_tag', 'style_loader_tag_ccs', 10, 2 );
        
        /* Add fonts to wp_head */
        add_action( 'wp_enqueue_scripts', 'sukelius_fonts' );
        
        /* Register popular widget. */
        add_action( 'widgets_init', 'sukelius_load_widgets' );
                
        /* Add social icons to top menu */
        add_action( "{$prefix}_close_menu_primary", 'sukelius_social_networks' );
        
        /* Featured image widths on different layouts */        
        add_filter( 'get_the_image_args', 'featured_image_widths' );        
        
	/* Load the customizer functions */
        require_once( trailingslashit ( get_template_directory() ) . 'admin/customize.php' );
        
}

/**
 * Add shortcodes for read more and custom comments
 * @since 0.1.0
 */
function sukelius_register_shortcodes() {
	add_shortcode( 'custom_comments', 'sukelius_custom_comments' );
	add_shortcode( 'read_more', 'sukelius_read_more' );    
}
 /**
 * Set default layout from theme settings page
 * @since 0.1.0
 */
function sukelius_theme_layout( $layout ) {

	/* Get global layout. */
	$sukelius_default_layout = hybrid_get_setting( 'sukelius_global_layout' );
	
	if ( !$sukelius_default_layout )
		return $layout;

	if ( 'layout-default' == $layout )
		$layout = $sukelius_default_layout;

	return $layout;
	
}

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since 0.1.0
 */ 
function sukelius_one_column() {

	if ( !is_active_sidebar( 'primary' ) && !is_active_sidebar( 'secondary' ) )
		add_filter( 'get_theme_layout', 'sukelius_theme_layout_one_column' );

	elseif ( is_attachment() && 'layout-default' == theme_layouts_get_layout() )
		add_filter( 'get_theme_layout', 'sukelius_theme_layout_one_column' );
}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since 0.2.0
 */
function sukelius_theme_layout_one_column( $layout ) {
	return 'layout-1c';
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since 0.1.0
 */
function sukelius_disable_sidebars( $sidebars_widgets ) {
	
	global $wp_query;

	if ( current_theme_supports( 'theme-layouts' ) ) {

		if ( 'layout-1c' == theme_layouts_get_layout() || is_attachment() ) {
			$sidebars_widgets['primary'] = false;
			$sidebars_widgets['secondary'] = false;
		}
		elseif ( 'layout-2c-l' == theme_layouts_get_layout() || 'layout-default' == theme_layouts_get_layout() || 'layout-2c-r' == theme_layouts_get_layout() ) {
			$sidebars_widgets['secondary'] = false;
		}
                
	}

	return $sidebars_widgets;
}

/**
 * Additional body classes
 * 
 * Counts widgets number in subsidiary sidebar and ads css class (.sidebar-subsidiary-$number) to body_class.
 * Used to increase / decrease widget size according to number of widgets.
 * Example: if there's one widget in subsidiary sidebar - widget width is 100%, if two widgets, 48.5% each...
 *
 * Check if secondary menu is used, if not, add class to fix header bottom margin
 * @since 0.1.0
 */
function sukelius_additional_body_classes( $classes ) {
        
        /* Add class sidebar-subsidiary-$num to body ($num is number of active widgets in subsidiary sidebar) */
        if ( is_active_sidebar( 'subsidiary' ) ) {
                $the_sidebars = wp_get_sidebars_widgets();
                $num = count( $the_sidebars['subsidiary'] );
                $classes[] = 'sidebar-subsidiary-'.$num;
        }
        
        /* Fixing long titles with active sidebar header */
        if ( is_active_sidebar( 'header' ) )
            $classes[] = 'sidebar-header-active'; 
        
        if ( !has_nav_menu( 'secondary' ) ) 
                $classes[] = 'no-sec-menu';
                
        /* Add has-icons class if any of social profiles are active */
        $twitter = hybrid_get_setting( 'sukelius_input_twitter' );
        $facebook = hybrid_get_setting( 'sukelius_input_facebook' );
        $pinterest = hybrid_get_setting( 'sukelius_input_pinterest' );
        $rss = hybrid_get_setting( 'sukelius_input_rss' );
        
        if ( $twitter || $facebook || $pinterest || $rss  ) {
            $classes[] = 'has-icons';
        }
    
    return $classes;
    
}

/**
 * Adding .widget-first and .widget-last classes to widgets.
 * Class .widget-last used to reset margin-right to zero in subsidiary sidebar for the last widget.
 *
 * @since 0.1.0
 */
function sukelius_widget_classes( $params ) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets

	if ( !$my_widget_num ) { // If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if ( !isset( $arr_registered_widgets[$this_id] ) || !is_array( $arr_registered_widgets[$this_id] ) ) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if ( isset($my_widget_num[$this_id] ) ) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	} else {  // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' ';  // Add a widget number class for additional styling options

	if ( $my_widget_num[$this_id] == 1 ) {  // If this is the first widget
		$class .= 'widget-first ';
	} elseif( $my_widget_num[$this_id] == count( $arr_registered_widgets[$this_id] ) ) { // If this is the last widget
		$class .= 'widget-last ';
	}

	$params[0]['before_widget'] = str_replace( 'class="', $class, $params[0]['before_widget'] ); // Insert our new classes into "before widget"

	return $params;

}

/**
 * Custom excerpt lenght
 * 
 * @since 0.1
 */
function sukelius_excerpt_length( $length ) {    
	return 100;    
}

/**
 * Post format - Quote. Check if user added <blockqoute> to content, if not - add it.
 * 
 * @since 0.1
 */
function sukelius_quote_content( $content ) {
        
	if ( has_post_format( 'quote' ) ) {

		preg_match( '/<blockquote.*?>/', $content, $matches );

		if ( empty( $matches ) )
			$content = "<blockquote>{$content}</blockquote>";
	}

	return $content;
}

/**
 * Overwrites the default widths for embeds.  This is especially useful for making sure videos properly
 * expand the full width on video pages.  This function overwrites what the $content_width variable handles
 * with context-based widths.
 *
 * @since 0.1.0
 */
function sukelius_embed_defaults( $args ) {

	if ( current_theme_supports( 'theme-layouts' ) ) {

		$layout = theme_layouts_get_layout();

		if ( 'layout-3c-l' == $layout || 'layout-3c-r' == $layout || 'layout-3c-c' == $layout )
			$args['width'] = 520;
		elseif ( 'layout-1c' == $layout )
			$args['width'] = 920;
	}

	return $args;
}

/**
 * Custom number of comments shortcode. Replaces default hybrid-core text "Leave reply" with "0 comments" etc...
 *
 * @since 0.1.0
 */
function sukelius_custom_comments( $attr ) {

	$comments_link = '';
	$number = doubleval( get_comments_number() );
	$attr = shortcode_atts( array( 'zero' => __( '0 comments', 'sukelius-magazine' ), 'one' => __( '%1$s comment', 'sukelius-magazine' ), 'more' => __( '%1$s comments', 'sukelius-magazine' ), 'css_class' => 'comments-link', 'none' => '', 'before' => '', 'after' => '' ), $attr );

	if ( 0 == $number && !comments_open() && !pings_open() ) {
		if ( $attr['none'] )
			$comments_link = '<span class="' . esc_attr( $attr['css_class'] ) . '">' . sprintf( $attr['none'], number_format_i18n( $number ) ) . '</span>';
	}
	elseif ( 0 == $number )
		$comments_link = '<a class="' . esc_attr( $attr['css_class'] ) . '" href="' . get_permalink() . '#respond" title="' . sprintf( esc_attr__( 'Comment on %1$s', 'sukelius-magazine' ), the_title_attribute( 'echo=0' ) ) . '">' . sprintf( $attr['zero'], number_format_i18n( $number ) ) . '</a>';
	elseif ( 1 == $number )
		$comments_link = '<a class="' . esc_attr( $attr['css_class'] ) . '" href="' . get_comments_link() . '" title="' . sprintf( esc_attr__( 'Comment on %1$s', 'sukelius-magazine' ), the_title_attribute( 'echo=0' ) ) . '">' . sprintf( $attr['one'], number_format_i18n( $number ) ) . '</a>';
	elseif ( 1 < $number )
		$comments_link = '<a class="' . esc_attr( $attr['css_class'] ) . '" href="' . get_comments_link() . '" title="' . sprintf( esc_attr__( 'Comment on %1$s', 'sukelius-magazine' ), the_title_attribute( 'echo=0' ) ) . '">' . sprintf( $attr['more'], number_format_i18n( $number ) ) . '</a>';

	if ( $comments_link )
		$comments_link = $attr['before'] . $comments_link . $attr['after'];

	return $comments_link;

}

/**
 * Custom read more shortcode for read more button
 *
 * @since 0.1
 */
function sukelius_read_more( $attr ) {

	$attr = shortcode_atts( array( 'text' => __( 'Read More', 'sukelius-magazine' ) ), $attr );

	return "<a class='more-link' href=" . get_permalink() . ">{$attr['text']}</a>";
}
/**
 * Excluding sticky posts from home page if slider enabled. Sticky posts are in a slider.
 * 
 * @since 0.1
 */
function sukelius_exclude_sticky( $query ) {
	
	/* Exclude if is home and is main query. */
	if ( is_home() && $query->is_main_query() && hybrid_get_setting( 'slider_display' ) == 1 )
		$query->set( 'post__not_in', get_option( 'sticky_posts' ) );
	
}

/**
 * Adds custom image sizes for thumbnail images. 
 *
 * @since 0.1
 */
function sukelius_add_image_sizes() {    
	add_image_size( 'sukelius-slider-image', 940, 385, true );        
}

/**
 * Add slider js files
 * 
 * @since 0.1
 */
function sukelius_scripts() {
	
	$sticky = get_option( 'sticky_posts' );
	
		/* Enqueue NivoSlider js only when it's used. */
		if ( ! empty( $sticky ) && !is_paged() && ( is_home() || is_front_page() ) && hybrid_get_setting( 'slider_display' ) == 1 ) {
			wp_enqueue_script( 'sukelius-nivo', trailingslashit( get_template_directory_uri() ) . 'js/nivoSlider.js', array( 'jquery' ), '20120907', true );
			wp_enqueue_script( 'sukelius-nivo-settings', trailingslashit( get_template_directory_uri() ) . 'js/nivoSettings.js', array( 'sukelius-nivo' ), '20120907', true );
		}
		
}

/**
 * Grabs the first URL from the post content of the current post.  This is meant to be used with the link post 
 * format to easily find the link for the post. 
 *
 * @since 0.1.0
 * @return string The link if found.  Otherwise, the permalink to the post.
 *
 * @note This is a modified version of the twentyeleven_url_grabber() function in the TwentyEleven theme.
 * @author wordpressdotorg
 * @copyright Copyright (c) 2011 - 2012, wordpressdotorg
 * @link http://wordpress.org/extend/themes/twentyeleven
 * @license http://wordpress.org/about/license
 */
function sukelius_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return get_permalink( get_the_ID() );

	return esc_url_raw( $matches[1] );
}

/**
 * Returns the number of images attached to the current post in the loop.
 *
 * @since 0.1.0
 * @return int
 */
function sukelius_get_image_attachment_count() {
	$images = get_children( array( 'post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => -1 ) );
	return count( $images );
}

/**
 * Fixing Wordpress negative IE conditional tag <!--[if !IE]> stylesheet link <![endif]--> to be <!--[if !IE]><!--> stylesheet link <!--<![endif]-->.
 * Non IE browser will apply stylesheet only with <!--> <!-- if negative [!IE] conditional used.
 * @link http://core.trac.wordpress.org/ticket/16118
 * @since 0.1.0
 */
function style_loader_tag_ccs( $tag, $handle ) {
    
        global $wp_styles;
        $obj = $wp_styles->registered[ $handle ];
        if ( isset( $obj->extra[ 'adv_conditional' ] ) && $obj->extra[ 'adv_conditional' ] ) {
                $cc = "<!--[if {$obj->extra['adv_conditional']}]>";
                $end_cc = '';
                if ( strstr( $obj->extra['adv_conditional'], '!IE' ) ) {
                        $cc .= '<!-->';
                        $end_cc = '<!--';
                }
                $end_cc .= "<![endif]-->\n";
 
                $tag = $cc . "\n" . $tag . $end_cc;
        }
        return $tag;
}

 /**
 * Adding Google font Overlock
 * Theme uses 2 fonts - Overlock 900 (bold) and Overlock 900 (bold) italic.
 * Fonts have to load separately for IE and other browsers. For non-ie browsers both fonts will be loaded in group "Overlock:900,900italic",
 * otherwise Opera renders the last font weight and style served.
 *
 * @link http://www.smashingmagazine.com/2012/07/11/avoiding-faux-weights-styles-google-web-fonts/
 * @since 0.1.0
 */
function sukelius_fonts() {
    
        // For non IE browsers Overlock:900,900italic
        wp_register_style( 'non-ie-fonts', 'http://fonts.googleapis.com/css?family=Overlock:900,900italic&subset=latin,latin-ext' );
        // using "adv_conditional" instead of "conditional" from filtered function style_loader_tag_ccs to add <!--> and <!-- and enable !IE conditional in WP
        $GLOBALS['wp_styles']->add_data( 'non-ie-fonts', 'adv_conditional', '!IE' ); 
        wp_enqueue_style( 'non-ie-fonts' );
        
        // For IE Overlock:900
        wp_register_style( 'ie-fonts-900', 'http://fonts.googleapis.com/css?family=Overlock:900&subset=latin,latin-ext' );
        $GLOBALS['wp_styles']->add_data( 'ie-fonts-900', 'conditional', 'IE' );
        wp_enqueue_style( 'ie-fonts-900' );
    
        // For IE Overlock:900italic    
        wp_register_style( 'ie-fonts-900italic', 'http://fonts.googleapis.com/css?family=Overlock:900italic&subset=latin,latin-ext' );
        $GLOBALS['wp_styles']->add_data( 'ie-fonts-900italic', 'conditional', 'IE' );
        wp_enqueue_style( 'ie-fonts-900italic' );
    
}

/**
 * Register popular posts widget.
 *
 * @since 0.1
 */
function sukelius_load_widgets() {
    	
        /* Load popular posts widget. */
	require_once( trailingslashit( get_template_directory() ) . 'admin/widget-popular-posts.php' );
	register_widget( 'Sukelius_Widget_Posts' );
}

 
/**
 * Add custom header background image
 * @since 0.1.0
 */
function sukelius_header_bg() {
        
        $header_img = get_header_image();       
                        
        if ( $header_img ) { ?>
 
            <style type="text/css">                
                #header .wrap {
                    background: url('<?php echo $header_img; ?>') no-repeat;
                    height: <?php echo get_custom_header()->height; ?>px;
                }
            </style>        
        <?php }            
}
/**
 * Displays social icons in primary menu
 * 
 * @since 0.1.0
 */
function sukelius_social_networks() {
        
        $twitter = hybrid_get_setting( 'sukelius_input_twitter' );
        $facebook = hybrid_get_setting( 'sukelius_input_facebook' );
        $pinterest = hybrid_get_setting( 'sukelius_input_pinterest' );
        $rss = hybrid_get_setting( 'sukelius_input_rss' );
        
        if ( $twitter || $facebook || $pinterest || $rss  ) {
        
                echo '<ul id="social">';
                            
                    if ( $facebook )
                            echo '<li><a id="facebook" href="'. $facebook .'" title="'. __( 'Facebook', 'sukelius-magazine') .'">'. __( 'Facebook', 'sukelius-magazine') .'</a></li>';                                                                                   

                    if ( $twitter )
                            echo '<li><a id="twitter" href="'. $twitter .'" title="'. __( 'Twitter', 'sukelius-magazine') .'">'. __( 'Twitter', 'sukelius-magazine') .'</a></li>';                            

                    if ( $pinterest )
                            echo '<li><a id="pinterest" href="'. $pinterest .'" title="'. __( 'Pinterest', 'sukelius-magazine') .'">'. __( 'Pinterest', 'sukelius-magazine') .'</a></li>';                            
                            
                    if ( $rss )
                            echo '<li><a id="rss" href="'. $rss .'" title="'. __( 'RSS', 'sukelius-magazine') .'">'. __( 'RSS', 'sukelius-magazine') .'</a></li>';
                                                                                                                                                                                                                                                        
                echo '</ul>';

        }        
}

/**
 * Returns a set of image attachment links based on size.
 *
 * @since 0.1.0
 * @return string Links to various image sizes for the image attachment.
 */
function sukelius_get_image_size_links() {

	/* If not viewing an image attachment page, return. */
	if ( !wp_attachment_is_image( get_the_ID() ) )
		return;

	/* Set up an empty array for the links. */
	$links = array();

	/* Get the intermediate image sizes and add the full size to the array. */
	$sizes = get_intermediate_image_sizes();
	$sizes[] = 'full';

	/* Loop through each of the image sizes. */
	foreach ( $sizes as $size ) {

		/* Get the image source, width, height, and whether it's intermediate. */
		$image = wp_get_attachment_image_src( get_the_ID(), $size );

		/* Add the link to the array if there's an image and if $is_intermediate (4th array value) is true or full size. */
		if ( !empty( $image ) && ( true === $image[3] || 'full' == $size ) )
			$links[] = "<a class='image-size-link' href='" . esc_url( $image[0] ) . "'>{$image[1]} &times; {$image[2]}</a>";
	}

	/* Join the links in a string and return. */
	return join( ' <span class="sep">/</span> ', $links );
}

/**
 * Image widths on different layouts - 1 column & 3 column
 *
 * @since 0.1.5
 * @return string image width and height
 */
function featured_image_widths( $args ) {

        $layout = theme_layouts_get_layout();        
        
	if ( $layout == 'layout-3c-r' || $layout == 'layout-3c-l' || $layout == 'layout-3c-c' ) {
                    $args['width'] = '510';
                    $args['height'] = '200';
	}
        elseif ( $layout == 'layout-1c' ) {
                    $args['width'] = '910';
                    $args['height'] = '350';                
        }

	return $args;    
}

?>