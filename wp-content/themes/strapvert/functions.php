<?php
/**
 * StrapVert functions and definitions
 *
 * @package StrapVert
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'strapvert_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function strapvert_setup() {

	if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on StrapVert, use a find and replace
	 * to change 'strapvert' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'strapvert', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 280, 136, true );
	add_image_size( 'strapvert-featured', 640, 300, true );
	add_image_size( 'strapvert-single', 840, 300, true );
	add_image_size( 'strapvert-mini', 50, 50, true );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'strapvert' ),
		'secondary' => __( 'Secondary Menu', 'strapvert' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'strapvert_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // strapvert_setup
add_action( 'after_setup_theme', 'strapvert_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function strapvert_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'strapvert' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
		
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'strapvert' ),
		'id' => 'footer-showcase1',
		'description' => __( 'An optional widget area for your site footer', 'strapvert' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'strapvert' ),
		'id' => 'footer-showcase2',
		'description' => __( 'An optional widget area for your site footer', 'strapvert' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'strapvert' ),
		'id' => 'footer-showcase3',
		'description' => __( 'An optional widget area for your site footer', 'strapvert' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Area Four - Above Footer.', 'strapvert' ),
		'id' => 'footer-showcase4',
		'description' => __( 'An optional widget area for your site footer.', 'strapvert' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'strapvert_widgets_init' );

/**
 * Returns number of widgets in a widget position - used in the Footer Showcase widget area.
 *
 * @since StrapVert 1.1.3
 */
function strapvert_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-showcase1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-showcase2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-showcase3' ) )
		$count++;
		
	if ( is_active_sidebar( 'footer-showcase4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

/**
 * Enqueue scripts and styles
 */
function strapvert_scripts() {
	global $wp_styles;
	// Bump this when changes are made to bust cache
    $version = '1.1.7';
	// CSS Scripts
	wp_enqueue_style('strapvert-style', get_template_directory_uri().'/css/style.css', false, $version );
	wp_enqueue_style('strapvert-bootstrap', get_template_directory_uri().'/css/bootstrap.css', false, $version );
    wp_enqueue_style('strapvert-responsive', get_template_directory_uri().'/css/bootstrap-responsive.css', false, $version );
	wp_enqueue_style('strapvert-custom', get_template_directory_uri().'/css/custom.css', false, $version );
	
	// Load style.css from child theme
    if (is_child_theme()) {
      wp_enqueue_style('strapvert_child', get_stylesheet_uri(), false, null);
    }
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    
	wp_enqueue_script('bootstrap.min.js', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), $version, true );

	wp_enqueue_script( 'strapvert-bootstrapnav', get_template_directory_uri() . '/js/twitter-bootstrap-hover-dropdown.js', array(), $version, true );

	wp_enqueue_script( 'strapvert-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), $version, true );
	
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'strapvert-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), $version );
	}
	wp_enqueue_script('strapvert-scroll-top', get_template_directory_uri().'/js/wpstrapcode-scripts.js', array('jquery'), $version, true );
}
add_action( 'wp_enqueue_scripts', 'strapvert_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/strapvert-customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

if ( !wp_is_mobile() ) {
  require get_template_directory() . '/inc/nav-menu-walker.php';
  } else {
  require get_template_directory() . '/inc/nav-mobile-walker.php';
}

if ( ! function_exists( 'strapvert_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own strapvert_entry_meta() to override in a child theme.
 *
 * @since StrapVert 1.0.0
 *
 * @return void
 */
function strapvert_entry_meta() {

	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'strapvert' ) . '</span>';

	if ( ! has_post_format( 'aside' ) && ! has_post_format( 'link' ) && 'post' == get_post_type() )
		strapvert_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'strapvert' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'strapvert' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'strapvert' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'strapvert_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own strapvert_entry_date() to override in a child theme.
 *
 * @since WP StrapSlider Lite 1.0.0
 *
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string
 */
function strapvert_entry_date( $echo = true ) {
	$format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'strapvert' ): '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'strapvert' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

/**
 * Additional helper post classes
 */
function strapvert_post_class( $classes ) {
	if ( has_post_thumbnail() )
		$classes[] = 'has-post-thumbnail';
	return $classes;
}
add_filter('post_class', 'strapvert_post_class' );

/**
 * Ignore and exclude featured posts on the home page.
 */
function strapvert_pre_get_posts( $query ) {
	if ( ! $query->is_main_query() || is_admin() )
		return;

	if ( $query->is_home() ) { // condition should be (almost) the same as in index.php
		$query->set( 'ignore_sticky_posts', true );

		$exclude_ids = array();
		$featured_posts = strapvert_get_featured_posts();

		if ( $featured_posts->have_posts() )
			foreach ( $featured_posts->posts as $post )
				$exclude_ids[] = $post->ID;

		$query->set( 'post__not_in', $exclude_ids );
	}
}
add_action( 'pre_get_posts', 'strapvert_pre_get_posts' );

/**
 * Returns a new WP_Query with featured posts.
 */
function strapvert_get_featured_posts() {
	global $wp_query;

	// Jetpack Featured Content support
	$sticky = apply_filters( 'strapvert_get_featured_posts', array() );
	if ( ! empty( $sticky ) )
		$sticky = wp_list_pluck( $sticky, 'ID' );

	if ( empty( $sticky ) )
		$sticky = (array) get_option( 'sticky_posts', array() );

	if ( empty( $sticky ) ) {
		return new WP_Query( array(
			'posts_per_page' => get_theme_mod( 'strapvert_featured_number' ),
			'orderby' => get_theme_mod( 'strapvert_featured_orderby' ),
			'ignore_sticky_posts' => true,
		) );
	}

	$args = array(
		'posts_per_page' => get_theme_mod( 'strapvert_featured_number' ),
		'orderby' => get_theme_mod( 'strapvert_featured_orderby' ),
		'post__in' => $sticky,
		'ignore_sticky_posts' => true,
	);

	return new WP_Query( $args );
}

/**
 * Returns a new WP_Query with related posts.
 */
function strapvert_get_related_posts() {
	$post = get_post();

	$args = array(
		'posts_per_page' => 3,
		'orderby' => 'rand',
		'ignore_sticky_posts' => true,
		'post__not_in' => array( $post->ID ),
	);

	// Get posts from the same category.
	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
		$category = array_shift( $categories );
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $category->term_id,
			),
		);
	}

	return new WP_Query( $args );
}

// Lets do a separate excerpt length for the blog feed
function strapvert_blogfeed_excerpts () {
	$theContent = trim(strip_tags(get_the_content()));
		$output = str_replace( '"', '', $theContent);
		$output = str_replace( '\r\n', ' ', $output);
		$output = str_replace( '\n', ' ', $output);
			$limit = '80';
			$content = explode(' ', $output, $limit);
			array_pop($content);
		$content = implode(" ",$content)."  ";
	return strip_tags($content, ' ');
}

// Lets do a separate excerpt length for the featured post
function strapvert_featured_excerpt () {
	$theContent = trim(strip_tags(get_the_content()));
		$output = str_replace( '"', '', $theContent);
		$output = str_replace( '\r\n', ' ', $output);
		$output = str_replace( '\n', ' ', $output);
			$limit = '100';
			$content = explode(' ', $output, $limit);
			array_pop($content);
		$content = implode(" ",$content)."  ";
	return strip_tags($content, ' ');
}

// Lets do a separate excerpt length for the secondary featured posts
function strapvert_secondary_featured_excerpt () {
	$theContent = trim(strip_tags(get_the_content()));
		$output = str_replace( '"', '', $theContent);
		$output = str_replace( '\r\n', ' ', $output);
		$output = str_replace( '\n', ' ', $output);
			$limit = '20';
			$content = explode(' ', $output, $limit);
			array_pop($content);
		$content = implode(" ",$content)."  ";
	return strip_tags($content, ' ');
}

/**
 * Retrieves the IDs for images in a gallery.
 *
 * @uses get_post_galleries() first, if available. Falls back to shortcode parsing,
 * then as last option uses a get_posts() call.
 *
 * @since Twenty Eleven 1.6.
 *
 * @return array List of image IDs from the post gallery.
 */
function strapvert_get_gallery_images() {
	$images = array();

	if ( function_exists( 'get_post_galleries' ) ) {
		$galleries = get_post_galleries( get_the_ID(), false );
		if ( isset( $galleries[0]['ids'] ) )
		 	$images = explode( ',', $galleries[0]['ids'] );
	} else {
		$pattern = get_shortcode_regex();
		preg_match( "/$pattern/s", get_the_content(), $match );
		$atts = shortcode_parse_atts( $match[3] );
		if ( isset( $atts['ids'] ) )
			$images = explode( ',', $atts['ids'] );
	}

	if ( ! $images ) {
		$images = get_posts( array(
			'fields'         => 'ids',
			'numberposts'    => 999,
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'post_mime_type' => 'image',
			'post_parent'    => get_the_ID(),
			'post_type'      => 'attachment',
		) );
	}

	return $images;
}