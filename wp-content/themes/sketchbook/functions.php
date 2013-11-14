<?php 
/*********************/
require_once ( get_template_directory() . '/inc/widgets.php' );
require_once ( get_template_directory() . '/inc/shortcode.php' );
require_once ( get_template_directory() . '/inc/sketchbook-functions.php' );
require_once ( get_template_directory() . '/inc/sketchbook-post-options.php' );
/*********************/
add_action( 'after_setup_theme', 'sketchbook_setup' );

if ( ! function_exists( 'sketchbook_setup' ) ):
	function sketchbook_setup() {
		/*********************/
if ( ! isset( $content_width ) ){
		$content_width = 620;
}
/*********************/
		load_theme_textdomain( 'sketchbook', get_template_directory() . '/languages' );
/*********************/	
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 200, 200, true );
		add_image_size('sketchbook_post-thumb', 200, 200, true);
		set_post_thumbnail_size( 620, 310, true );
		add_image_size('sketchbook_slide', 620, 310, true);
		add_theme_support( 'post-formats', array( 'aside', 'gallery','link','quote','image','video') );
		add_theme_support( 'automatic-feed-links' );
		/*********************/
		add_editor_style('/css/editor-style.css');
		/*********************/	
        function sketchbook_excerpt_length($length) {
	    return 65;
        }
        add_filter('excerpt_length', 'sketchbook_excerpt_length');
		/*********************/
		if (function_exists('wp_nav_menu')) {
		register_nav_menus(array('primary' =>__( 'Primary Navigation','sketchbook' )));
		}
		/*********************/
		function sketchbook_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
		}
		add_filter( 'wp_page_menu_args', 'sketchbook_menu_args' );
		/********************Default gallery style*/
		add_filter('use_default_gallery_style', '__return_false');
		/*********************/
		add_filter('widget_text', 'do_shortcode');
		/********************Widgets*/
function sketchbook_widgets_init() {
	    register_sidebar( array(
		'name' => __( 'Widget in the header of the page', 'sketchbook'),
		'id' => 'header-widget',
		'description' => __( 'Widget is on the right of the title. The maximal width 540px.', 'sketchbook' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		
	    register_sidebar( array(
		'name' => __( 'Widget is in the side panel', 'sketchbook'),
		'id' => 'sidebar-widget-area-top',
		'description' => __( 'The activation will cause the overwriting of the web search.', 'sketchbook' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
		'name' => __( 'Widget is in the side panel', 'sketchbook'),
		'id' => 'sidebar-widget-area-full',
		'description' => __( 'The activation will cause the overwriting of the category list.', 'sketchbook' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );		
				
		register_sidebar( array(
		'name' => __( 'Widget in the footer', 'sketchbook' ),
		'id' => 'first-footer-widget-area',
		'description' => __( ' Widget is in the left part of the footer.', 'sketchbook' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => __( 'Widget in the footer', 'sketchbook' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'Widget  in the right part of the footer.', 'sketchbook' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
				
	    register_sidebar( array(
		'name' => __( 'Widget in the inside of the post', 'sketchbook'),
		'id' => 'post-widget',
		'description' => __( 'Widget is between some articles and comments.', 'sketchbook' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		
	    register_sidebar( array(
		'name' => __( 'Widget in the side panel on the page', 'sketchbook'),
		'id' => 'page-widget',
		'description' => __( 'If you want to have a different content on the static page than on the side panel , activate the widget.', 'sketchbook' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );

		}
add_action( 'widgets_init', 'sketchbook_widgets_init' );
/*********************/
function sketchbook_scripts(){
if ( ! is_admin() ){
		wp_enqueue_script('jquery');
	
		wp_register_script('fancybox', get_template_directory_uri() .'/js/jquery.fancybox-1.3.4.pack.js', array('jquery'));		

		wp_register_script('flex-slide', get_template_directory_uri() .'/js/jquery.flexslider-min.js', array('jquery'));					
		
        $template_uri = get_template_directory_uri();
		echo "<script>";
		echo "var ADAPT_CONFIG = {\n";
		echo "path: '".$template_uri."/css/',\n";
		echo "dynamic: true,\n";
		echo "range: ['0px to 768px  = mobile.min.css',\n";
		echo "'769px = 960_16_col.css']\n";
		echo "};\n";	
		echo "</script>";	
		
		wp_register_script('adapt', $template_uri .'/js/adapt.min.js');		
		wp_enqueue_script('adapt');
		
		wp_register_script('superfish', $template_uri .'/js/superfish.js');		
		wp_enqueue_script('superfish');
		
		if ( comments_open() && get_option( 'thread_comments' ) ) 
		wp_enqueue_script( 'comment-reply' );
			    
	    global $is_IE;
		if (! is_admin() && $is_IE){
			wp_register_script('ie-html5', get_template_directory_uri() .'/js/html5.js', array('jquery'));
		wp_enqueue_script('ie-html5');		
		}
}
}
add_action('wp_enqueue_scripts', 'sketchbook_scripts');
/*********************/	
function sketchbook_superfish() {
if (! is_admin()) {
echo '<script>
jQuery(document).ready(function($) { $("#nav ul").superfish();});
</script>';
}}
add_action('wp_head', 'sketchbook_superfish');
/*********************/
function sketchbook_css(){
	if ( ! is_admin() ){
		//wp_register_style('960_css', get_template_directory_uri() . '/css/960_16_col.css', '', '1.0', 'all');
		//wp_enqueue_style('960_css');
		wp_register_style('plugins_css', get_template_directory_uri() . '/css/plugins.css', '', '1.0', 'all');
		wp_enqueue_style('plugins_css');
		wp_register_style('print', get_template_directory_uri() . '/css/print.css', '', '1.0', 'print');
		wp_enqueue_style('print');
}
}
add_action('wp_print_styles', 'sketchbook_css');
/*********************/		
		function sketchbook_fancybox() {
				if (!of_get_option('img_lightbox') && ! is_admin() ){
		$id= get_the_ID();
		echo '<script type="text/javascript">jQuery(document).ready(function($){
		$(" .gallery-icon a").attr("rel", \'gallery_'. esc_attr($id) .'\');	
		$(".gallery-icon a[href$=\'.jpg\'], .gallery-icon a[href$=\'.jpeg\'], .gallery-icon a[href$=\'.gif\'], .gallery-icon a[href$=\'.png\']").fancybox({\'transitionIn\' : \'none\',\'transitionOut\' : \'none\',\'titlePosition\' : \'inside\', \'overlayColor\' : \'#000\', \'overlayOpacity\' : 0.9 });

		$(".wp-caption a[href$=\'.jpg\']").fancybox({\'transitionIn\' : \'elastic\',
		\'transitionOut\' : \'elastic\',\'titlePosition\' : \'inside\', \'overlayColor\' : \'#000\', \'overlayOpacity\' : 0.9 });
		$(".wp-caption a[href$=\'.jpeg\']").fancybox({\'transitionIn\' : \'elastic\',
		\'transitionOut\' : \'elastic\',\'titlePosition\' : \'inside\', \'overlayColor\' : \'#000\', \'overlayOpacity\' : 0.9 });
		$(".wp-caption a[href$=\'.png\']").fancybox({\'transitionIn\' : \'elastic\',
		\'transitionOut\' : \'elastic\',\'titlePosition\' : \'inside\', \'overlayColor\' : \'#000\', \'overlayOpacity\' : 0.9 });
		$(".wp-caption a[href$=\'.gif\']").fancybox({\'transitionIn\' : \'elastic\',
		\'transitionOut\' : \'elastic\',\'titlePosition\' : \'inside\', \'overlayColor\' : \'#000\', \'overlayOpacity\' : 0.9 });
				
		
		$(".sketchbook_post_icons a[href$=\'.jpg\']").fancybox({\'transitionIn\' : \'elastic\',
		\'transitionOut\' : \'elastic\',\'titlePosition\' : \'inside\', \'overlayColor\' : \'#000\', \'overlayOpacity\' : 0.9 });
		$(".sketchbook_post_icons a[href$=\'.jpeg\']").fancybox({\'transitionIn\' : \'elastic\',
		\'transitionOut\' : \'elastic\',\'titlePosition\' : \'inside\', \'overlayColor\' : \'#000\', \'overlayOpacity\' : 0.9 });
		$(".sketchbook_post_icons a[href$=\'.gif\']").fancybox({\'transitionIn\' : \'elastic\',
		\'transitionOut\' : \'elastic\',\'titlePosition\' : \'inside\', \'overlayColor\' : \'#000\', \'overlayOpacity\' : 0.9 });
		$(".sketchbook_post_icons a[href$=\'.png\']").fancybox({\'transitionIn\' : \'elastic\',
		\'transitionOut\' : \'elastic\',\'titlePosition\' : \'inside\', \'overlayColor\' : \'#000\', \'overlayOpacity\' : 0.9 });
});</script>';
		wp_enqueue_script('fancybox');
		}
		}
		add_action('wp_head', 'sketchbook_fancybox');
/*********************/
		function sketchbook_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
		}
		add_action( 'widgets_init', 'sketchbook_recent_comments_style' );
/*********************/
		if ( ! function_exists( 'sketchbook_posted_on' ) ) :
		function sketchbook_posted_on() {
			$format_text = __('<p><em>Posted on</em> %4$s <em>by</em> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s </a></span></p>', 'sketchbook' );
			printf( $format_text,
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'sketchbook' ), get_the_author() ),
		esc_html( get_the_author() )
		);
		}
		endif;
/*********************/
		if ( ! function_exists( 'sketchbook_format_posted_on' ) ) :
		function sketchbook_format_posted_on() {
			$format_text = __('<p><a class="link_more" href="%8$s" title="%9$s" rel="bookmark"> 
    &infin;</a><em>Posted</em> on %4$s <em>by</em> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s </a></span></p>', 'sketchbook' );
			printf( $format_text,
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'sketchbook' ), get_the_author() ),
		esc_html( get_the_author() ),
		get_permalink(),
		esc_attr(sprintf(__('Permanent Link to %s', 'sketchbook'), the_title_attribute('echo=0')))
		);
		}
		endif;
/*********************/
		if ( ! function_exists( 'sketchbook_posted_footer' ) ) :
		function sketchbook_posted_footer() {
		  $categories_list = get_the_category_list(__(', ', 'sketchbook'));
		  $tag_list = get_the_tag_list('', __(', ', 'sketchbook'));
		if('' != $tag_list) {
			$utility_text = __('<em>This</em> <a href="%3$s" title="Permalink to %4$s" rel="bookmark">entry</a> <em>was posted in</em> %1$s <em>and tagged</em> %2$s.', 'sketchbook');
		} elseif('' != $categories_list) {
			$utility_text = __('<em>This</em>  <a href="%3$s" title="Permalink to %4$s" rel="bookmark">entry</a> <em>was posted in</em> %1$s.', 'sketchbook');
		} else {
			$utility_text = __('<em>This</em> <a href="%3$s" title="Permalink to %4$s" rel="bookmark">entry</a> <em>was posted by</em> <a href="%6$s">%5$s</a>.', 'sketchbook');
		}
		printf($utility_text, $categories_list, $tag_list, esc_url(get_permalink()), the_title_attribute('echo=0'), get_the_author(), esc_url(get_author_posts_url(get_the_author_meta('ID'))));
		}
		endif;
/*********************/
	// Add support for custom backgrounds.
	add_theme_support( 'custom-background', array('default-color' => 'f1f1f1','default-image' => get_template_directory_uri() . '/images/bg.jpg',) );
	/*********************/
	register_default_headers( array(
	'sketchbook' => array(
	'url' => '%s/images/headers/header.jpg',
	'thumbnail_url' => '%s/images/headers/header-thumbnail.jpg',
	'description' => __( 'Headers 1', 'sketchbook' ),
	),
	'sketchbook2' => array(
	'url' => '%s/images/headers/header2.jpg',
	'thumbnail_url' => '%s/images/headers/header2-thumbnail.jpg',
	'description' => __( 'Headers 2', 'sketchbook' ),
	)
	) );	
/*********************/
	$custom_header_support = array(
		'header-text' => false,
		'width' => apply_filters( 'sketchbook_header_image_width', 960 ),
		'height' => apply_filters( 'sketchbook_header_image_height', 150 ),
		'flex-height' => true,
		'random-default' => true,
		'wp-head-callback' => 'sketchbook_header_style',
		'admin-head-callback' => 'sketchbook_admin_header_style',
		'admin-preview-callback' => 'sketchbook_header',
	);
	
	add_theme_support( 'custom-header', $custom_header_support );
/*********************/	
	if ( ! function_exists( 'get_custom_header' ) ) {
		define( 'HEADER_IMAGE_WIDTH', $custom_header_support['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $custom_header_support['height'] );
	}
/*********************/
	set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );
/*********************/
		if ( ! function_exists( 'sketchbook_header' ) ) :
function sketchbook_header(){
	$typo_heading_tag = (is_home() || is_front_page()) ?'h1' : 'h2';
	if (of_get_option('logo_img') ) :?>
<header id="header" class="container_16">
	<<?php	echo $typo_heading_tag; ?>
	class="grid_7"> <a id="logo" href="<?php	echo site_url(); ?>"> <img src="<?php echo esc_url(of_get_option('logo_img')); ?>" alt="<?php	bloginfo('name'); ?>" title="<?php	bloginfo('name'); ?>" /></a></<?php	echo $typo_heading_tag; ?>>
	
<?php if ( is_active_sidebar( 'header-widget' ) ) : ?>		
			<ul class="widget grid_9">
				<?php dynamic_sidebar('header-widget'); ?>
			</ul>
<?php  endif ?>	

<div class="clear"></div>
</header>
<?php	else : ?>
	
<header id="header" class="container_16">
	<<?php	echo $typo_heading_tag; ?>
	class="grid_7"> <a href="<?php	echo site_url(); ?>"><?php	bloginfo('name'); ?></a></<?php echo $typo_heading_tag; ?>>
	
	<?php if ( is_active_sidebar( 'header-widget' ) ) :?>		
			<ul class="widget grid_9">
				<?php dynamic_sidebar('header-widget'); ?>
			</ul>
<?php  endif ?>	

<div class="clear"></div>
</header>
<?php  endif ?>
<?php  } endif;
			/*********************/
			function sketchbook_header_style() {
			if (get_header_image()){
    ?><style type="text/css">#header{ 
    	background: url("<?php header_image(); ?>") no-repeat;
        width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
        min-height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        _height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;  }	
 		#header h1 a, #header h2 a{
		text-decoration: none;
	}       
    	</style><?php
		}}
		/*********************/
		function sketchbook_admin_header_style() { ?><style type="text/css">
        #header{
        	background: url(<?php header_image(); ?>) no-repeat;
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
        }
        .widget{
        	display:  none;
        }
    #header h1, #header h2 {
		font-size: 30px;
		padding: 15px 10px;
		font-weight: 800;
		font-weight: 900;
	}
	#header h1 a, #header h2 a{
		text-decoration: none;
	}
    </style><?php
	}
/*********************/	

function sketchbook_filter_wp_title( $title ) {
    $site_name = get_bloginfo( 'name' );
    $filtered_title =  $title.' '.$site_name ;
    if ( is_front_page() ) {
        $site_description = get_bloginfo( 'description' );
        $filtered_title .= ' | '.$site_description;
    }
    return $filtered_title;
}
add_filter( 'wp_title', 'sketchbook_filter_wp_title' );	

	/*********************/
	}
	endif;
	/*********************/
	// end sketchbook_setup
	/********************Paginations*/
	if ( ! function_exists('sketchbook_pagination') ) {
	function sketchbook_pagination() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
	'base' => @add_query_arg('paged','%#%'),
	'format' => '',
	'total' => $wp_query->max_num_pages,
	'current' => $current,
	'show_all' => false,
	'mid_size' => 4,
	'end_size'     => 2,
	'type' => 'plain'
	);

	if( $wp_rewrite->using_permalinks() )
	$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if( !empty($wp_query->query_vars['s']) )
	$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

	echo '<div class="wp-pagenavi">' .paginate_links($pagination).'</div>' ;
	}
	}
	/*********************/
	if ( ! function_exists( 'sketchbook_breadcrumb' ) ) {
	function sketchbook_breadcrumb(){
	if(!of_get_option('breadcrumb')):
	if(function_exists('bcn_display'))
	{ echo '<p id="breadcrumbs">';
	bcn_display();
	echo '</p>';
	}
	elseif (function_exists('yoast_breadcrumb')) {
	yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
	} else {
	if ( is_home() || is_front_page() ) :
	echo __('<p id="breadcrumbs">You Are Here: Home</p>', 'sketchbook');

	elseif ( is_single() ):
	printf(__('<p id="breadcrumbs">You Are Here: <a href="%1$s" title="Home">Home </a> &raquo; %2$s &raquo; %3$s</p>', 'sketchbook'),
	site_url(), get_the_category_list(__(', ', 'sketchbook')), get_the_title());

	elseif ( is_tag() ):
	printf(__('<p id="breadcrumbs">You Are Here: <a href="%1$s" title="Home">Home </a> &raquo; %2$s</p>', 'sketchbook'),
	site_url(), single_tag_title("", false));

	elseif ( is_category() ):
	printf(__('<p id="breadcrumbs">You Are Here: <a href="%1$s" title="Home">Home </a> &raquo; %2$s</p>', 'sketchbook'),
	site_url(), single_cat_title("", false));

	else :
	printf(__('<p id="breadcrumbs">You Are Here: <a href="%1$s" title="Home">Home </a></p>', 'sketchbook'),
	site_url());
	endif;
	}
	endif;
	}
	}
	/*********************/
	function sketchbook_footer() {
if (! is_admin()) { ?>
<footer id="footer" class="container_16">
		<?php if (function_exists( 'sketchbook_footer_widgets' ) ) 
		sketchbook_footer_widgets() ?>
		<ul id="footermenu">
			<li>
				<?php wp_register('', ', ');?>
			</li>
			<li>
				<?php wp_loginout();?>,
			</li>
			<li>
				<a href="<?php echo esc_url(__('http://wordpress.org/', 'sketchbook'));?>" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'sketchbook');?>"><abbr title="WordPress">WordPress</abbr></a>,
			</li>
			<li>
				<a href="<?php echo esc_url(__('http://blankcanvas.eu/', 'sketchbook'));?>">BlankCanvas</a> 
			</li>
			<?php wp_meta();?>
		</ul>
</footer>
<?php }}
add_action('wp_footer', 'sketchbook_footer', 1);
	/*********************/
	add_filter('body_class','sketchbook_browser_body_class');
	function sketchbook_browser_body_class($classes) {
	global  $is_gecko, $is_IE, $is_opera, $is_safari, $is_chrome, $is_iphone;
	if($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	elseif($is_iphone) $classes[] = 'iphone';
	else $classes[] = 'unknown';
	return $classes;
	}
	/*********************/
	if ( ! function_exists( 'custom_comments' ) ) :
	function custom_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	case '' :
?>
	<li <?php	comment_class(); ?> id="li-comment-<?php	comment_ID(); ?>">
		<article id="comment-<?php	comment_ID(); ?>">
		<header  class="comment-author vcard">
			<?php	echo get_avatar($comment, 60); ?>
				<div class="comment-meta commentmetadata"><a href="<?php	echo esc_url(get_comment_link($comment -> comment_ID)); ?>">
			<?php	/* translators: 1: date, 2: time */
					printf(__('%1$s at %2$s', 'sketchbook'), get_comment_date(), get_comment_time());
				?></a><?php	edit_comment_link(__('(Edit)', 'sketchbook'), ' '); ?><br />		
			<?php	printf(__('<em>%s <span class="says">says:</span></em>', 'sketchbook'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
				<div class="reply">
			<?php	comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
		</div><!-- .reply -->
	</div>		
		<!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php	_e('Your comment is awaiting moderation.', 'sketchbook'); ?></em>			
		<?php	endif; ?>
		<!-- .comment-meta .commentmetadata -->
</header>
		<div class="comment-body">
		<?php	comment_text(); ?>
		</div>
	</article><!-- #comment-##  -->

	<?php
	break;
	case 'pingback'  :
	case 'trackback' :
?>
	<li <?php	comment_class(); ?>>
		<?php	_e('Pingback:', 'sketchbook'); ?> <?php	comment_author_link(); ?><?php	edit_comment_link(__('(Edit)', 'sketchbook'), ' '); ?>
<?php
break;
endswitch;
}
endif;
?>