<?php
/*********************/
require_once ( get_template_directory() . '/inc/widgets.php' );
require_once ( get_template_directory() . '/inc/customizer_register.php' );
require_once ( get_template_directory() . '/inc/post-options.php' );
/*********************/
add_action( 'after_setup_theme', 'rembrandt_setup' );

if ( ! function_exists( 'rembrandt_setup' ) ):
	function rembrandt_setup() {
		/*********************/
if ( ! isset( $content_width ) )
		$content_width = 640;
/*********************/
load_theme_textdomain( 'rembrandt', get_template_directory() . '/languages' );
/*********************/	
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 500, 340, true );
		add_image_size('rembrandt_slide', 500, 340, true);
		add_theme_support( 'post-formats', array( 'aside', 'gallery','link','quote', 'image', 'video') );
		add_theme_support( 'automatic-feed-links' );
/*********************/
        add_filter('use_default_gallery_style', '__return_false');
/*********************/
		add_editor_style('css/editor-style.css');
/*********************/
		register_nav_menu('primary', __( 'Primary Navigation','rembrandt' ));	
    /*********************/
    add_theme_support( 'custom-background', array(
    'default-color' => 'ffffff'
    ) );
    /*********************/
    register_default_headers( array(
    'header-1' => array(
    'url' => '%s/images/headers/header.jpg',
    'thumbnail_url' => '%s/images/headers/header-thumbnail.jpg',
    'description' => __( 'Header 1', 'rembrandt' ),
    ),
    'header-2' => array(
    'url' => '%s/images/headers/rembrandt3.jpg',
    'thumbnail_url' => '%s/images/headers/rembrandt3-thumbnail.jpg',
    'description' => __( 'Header 2', 'rembrandt' ),
    ),
    'header-3' => array(
    'url' => '%s/images/headers/rembrandt2.jpg',
    'thumbnail_url' => '%s/images/headers/rembrandt2-thumbnail.jpg',
    'description' => __( 'Header 3', 'rembrandt' ),
    )
    ) );
    /*********************/
    $custom_header_support = array(
    'default-image' => '%s/images/headers/header.jpg',
    'default-text-color' => 'dd3333',
    'width' => apply_filters( 'rembrandt_header_image_width', 960 ),
    'height' => apply_filters( 'rembrandt_header_image_height', 170 ),
    'flex-height' => true,
    'flex-width' => true,
    'random-default' => true,
    'wp-head-callback' => 'rembrandt_header_style',
    'admin-head-callback' => 'rembrandt_admin_header_style',
    'admin-preview-callback' => 'rembrandt_header_img',
    );
    add_theme_support( 'custom-header', $custom_header_support );        
/*********************/
}
endif;
/*********************/
// end rembrandt_setup
		function rembrandt_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
		}
		add_filter( 'wp_page_menu_args', 'rembrandt_menu_args' );
/********************Widgets*/
function rembrandt_widgets_init() {
	    register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'rembrandt'),
		'id' => 'sidebar-widget-area-top',
		'description' => __( 'The sidebar widget area, top', 'rembrandt' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		
		register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'rembrandt'),
		'id' => 'sidebar-widget-area-full',
		'description' => __( 'The sidebar widget area, full width', 'rembrandt' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );		
				
		register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'rembrandt'),
		'id' => 'sidebar-widget-area-bottom',
		'description' => __( 'The sidebar widget area, bottom', 'rembrandt' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'rembrandt' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'rembrandt' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'rembrandt' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'rembrandt' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );

		}
add_action( 'widgets_init', 'rembrandt_widgets_init' );
/*********************/
function rembrandt_script() {
	if (!is_admin()) {  
/**************************************************************************************************/        
		$lightbox = get_theme_mod('layout_lightbox','example1');
/**************************************************************************************************/ 		
        if ( comments_open() && get_option( 'thread_comments' ) ) 
	       wp_enqueue_script( 'comment-reply' );
/**************************************************************************************************/                    
        wp_enqueue_style( 'style', get_stylesheet_uri() );
/**************************************************************************************************/        
        wp_register_style('layout', get_template_directory_uri(). '/css/skeleton.css', '', '02052013', 'all');
        wp_enqueue_style('layout');            
/**************************************************************************************************/					
	    wp_register_script('flexslider', get_template_directory_uri() .'/js/jquery.flexslider-min.js', array('jquery'));
		wp_enqueue_script('flexslider');
/**************************************************************************************************/		
	    if ( $lightbox !='disabled') {
		     wp_register_style('cssbox', get_template_directory_uri(). '/gallery/'.$lightbox.'/colorbox.css', '', '02052013', 'all');
	         wp_enqueue_style('cssbox');			 	
			 wp_register_script('colorbox', get_template_directory_uri() .'/js/jquery.colorbox-min.js', array('jquery'));
		     wp_enqueue_script('colorbox');	
    	}			
/**************************************************************************************************/      
        wp_register_style('font', get_template_directory_uri() . '/css/font.css', '', '02052013', 'all');
        wp_enqueue_style('font');                
/**************************************************************************************************/
		global $is_IE;
		if (! is_admin() && $is_IE){
			wp_register_script('rembrandt-ie', get_template_directory_uri() .'/js/html5.js', array('jquery'));
		wp_enqueue_script('rembrandt-ie');		
		}
/**************************************************************************************************/        	
	}
}
add_action('wp_enqueue_scripts', 'rembrandt_script');
/*********************/
function rembrandt_flexslider() {
	if ( ! is_admin()){
		echo '<script>jQuery(document).ready(function($) {
					$(\'.flexslider\').flexslider({
						controlsContainer : ".flex-container",
						animation : "fade",
						directionNav : true,
						slideshow : false,
						controlNav : true,
						pauseOnHover : true
					});
				});</script>';
		}
		}
add_action('wp_head', 'rembrandt_flexslider');
/*********************/
function rembrandt_fancybox() {
		$lightbox = get_theme_mod('layout_lightbox','example1');
		
	if ( ! is_admin() && $lightbox !='disabled'){
        echo '<script>jQuery(document).ready(function($) {
        $(".gallery-icon a").attr("rel", \'gallery\');  
        $(" .post-content a[href$=\'.jpg\'], .post-content a[href$=\'.jpeg\'], .post-content a[href$=\'.gif\'], .post-content a[href$=\'.png\']").colorbox({current:"'.__('Image {current} of {total}', 'rembrandt').'" ,previous: \''.__('Previous', 'rembrandt').'\',next: \''.__('Next', 'rembrandt').'\', maxHeight:"99%", maxWidth:"95%"});        
});</script>';
        }
        }
add_action('wp_head', 'rembrandt_fancybox');
/*********************/
function rembrandt_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory -> widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'rembrandt_recent_comments_style');
/*********************/
function rembrandt_excerpt_more($more) {
	return '&hellip;' . ' <a class="more" href="' . get_permalink() . '">' . __('Continue reading &rarr;', 'rembrandt') . '</a>';
}
add_filter('excerpt_more', 'rembrandt_excerpt_more');
/*********************/
if (!function_exists('rembrandt_posted_on')) :
	function rembrandt_posted_on() {
		if (is_single()) {
			$format_text = __('<p>Posted on %4$s by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s </a></span></p>', 'rembrandt');
		} else {
			$format_text = __('<p>Posted on <a href="%1$s" title="%2$s" rel="bookmark"> <time datetime="%3$s"> %4$s </time></a> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s </a></span></p>', 'rembrandt');
		}
		printf($format_text, esc_url(get_permalink()), esc_attr(get_the_time()), esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_url(get_author_posts_url(get_the_author_meta('ID'))), sprintf(esc_attr__('View all posts by %s', 'rembrandt'), get_the_author()), esc_html(get_the_author()));
	}
endif;
/*********************/
function rembrandt_posted_footer() {
          $categories = get_the_category_list(__(', ', 'rembrandt'));
          $tag = get_the_tag_list('', __(', ', 'rembrandt'));     
if ($tag) {
printf(__('Categories: %1$s,  Tags: %2$s', 'rembrandt'), $categories, $tag); 
} 
elseif($categories) {
printf(__('Categories: %1$s', 'rembrandt'), $categories);
}        
}
/*********************/
function rembrandt_author_info(){
	if ( get_the_author_meta( 'description' ) ) :
	?>
	<div id="author-info" class=" vcard">
		<?php	echo get_avatar(get_the_author_meta('user_email')); ?>
		<h2 class="fn url"><?php the_author_link(); ?></h2>
		<p>
			<?php	the_author_meta('description'); ?>
			<br />
			<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author"> <?php printf(__('View all posts by %s &rarr;', 'rembrandt'), get_the_author()); ?></a>
		</p>
	</div>
	<?php
    endif;
    }
    /*********************/
    function rembrandt_breadcrumb(){
    if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<p id="breadcrumbs"><span>', '</span></p>');
    } elseif (function_exists('bcn_display'))
    { echo '<p id="breadcrumbs"><span>';
    bcn_display();
    echo '</span></p>';
    } else {
    if ( is_home() || is_front_page() ) :
    echo __('<p id="breadcrumbs"><span>Home</span></p>', 'rembrandt');

    elseif ( is_single() ):
    printf(__('
    <p id="breadcrumbs"><span><a href="%1$s" title="Home">Home </a> &raquo; %2$s</span></p>', 'rembrandt'),
    site_url(), get_the_category_list(__(', ', 'rembrandt')));

    elseif ( is_tag() ):
    printf(__('<p id="breadcrumbs"><span><a href="%1$s" title="Home">Home </a> &raquo; %2$s</span></p>', 'rembrandt'),
    site_url(), single_tag_title("", false));

    elseif ( is_category() ):
    printf(__('<p id="breadcrumbs"><span><a href="%1$s" title="Home">Home </a> &raquo; %2$s</span></p>', 'rembrandt'),
    site_url(), single_cat_title("", false));

    else :
    printf(__('<p id="breadcrumbs"><span><a href="%1$s" title="Home">Home </a></span></p>', 'rembrandt'),
    site_url());
    endif;
    }
    }
    /*********************/
    if ( ! function_exists( 'rembrandt_header_style' ) ) :
    function rembrandt_header_style() {
 ?>
<style type="text/css">
<?php if (get_header_image()){
	if ( function_exists( 'get_custom_header' ) ) {
		$header_image_height = get_custom_header()->height;
		$header_image_width = get_custom_header()->width;
} 
	if ($header_image_width > 960) {	
 ?>
#header {	
	background:#612B00 url(<?php header_image(); ?>) no-repeat top center;
    height: <?php echo $header_image_height; ?>px;
        }
<?php
} else {
 ?>
#header .container{	
	background: url(<?php header_image(); ?>) no-repeat top center;
    height: <?php echo $header_image_height; ?>px;
        }
<?php

}
}
 ?>
	<?php  $text_color = get_header_textcolor(); ?>
		<?php
		if ( 'blank' == $text_color ) :
	?>
        #header hgroup h1, #header hgroup h2, #header hgroup h3 {
            display: none;
        }
	<?php else : ?>
#header .container h1 a, #header .container h2 a {
	color: #<?php echo $text_color; ?>!important;
    }
	<?php endif; ?>
</style>
<?php
}
endif;
/*********************/
if(!function_exists('rembrandt_link_format')) {
function rembrandt_link_format() {
if(preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches)):
return esc_url_raw($matches[1]);
else :
return esc_url_raw(get_permalink());
endif;
}
}
/*********************/
function rembrandt_quote_content( $content ) {
if ( has_post_format( 'quote' ) ) {
preg_match( '/<blockquote.*?>/', $content, $matches );
if ( empty( $matches ) )
$content = "<blockquote>{$content}</blockquote>";
}
return $content;
}
add_filter( 'the_content', 'rembrandt_quote_content' );
/*********************/
if ( ! function_exists( 'rembrandt_admin_header_style' ) ) :
function rembrandt_admin_header_style() {
?>
<style type="text/css">
<?php if (get_header_image()) : 
	if ( function_exists( 'get_custom_header' ) ) {
		$header_image_height = get_custom_header()->height;
}
	?>	
	#header {
		background: url(images/bg.jpg)!important;
	}
	#header .container{	
	background: url(<?php header_image(); ?>
        ) no-repeat 0 0;
        height: 
 <?php echo $header_image_height; ?>
        px;
        }
<?php endif; ?>
<?php	$text_color = get_header_textcolor(); ?>
		<?php
		if ( 'blank' == $text_color ) :
	?>
        #header hgroup h1, #header hgroup h2, #header hgroup h3 {
            display: none;
        }
	<?php else : ?>
	#header {
		background: url(images/bg.jpg)!important;
	}
#header .container{
	position: relative;
    text-shadow: none;
    font-family: Georgia!important;
}
#header h2 {
		font-size: 24px;
		margin:10px;
		width: 40%;
}
#header h3 {
		font-size: 14px;
		color: #777;
		margin:0 10px 10px 10px;
		width: 40%;
}
#header h2 a {
	color: #<?php echo $text_color; ?>!important;
    text-decoration: none!important;
    text-shadow: none;
    }
<?php endif; ?>
</style>
<?php
}

endif;
/*********************/
if ( ! function_exists( 'rembrandt_header_img' ) ) :
function rembrandt_header_img() {
?>
<div id="header">
<hgroup class="container">
<?php if (function_exists('rembrandt_header'))  rembrandt_header();
      $site_description = get_bloginfo( 'description' ); 
      if ( $site_description ) {?>
           <h3><?php echo $site_description; ?></h3>
<?php } ?>
</hgroup>
</div>
<?php
}
endif;
/*********************/
function rembrandt_header(){
$header_logo = get_theme_mod('link_logo');
$rembrandt_heading_tag = (is_home() || is_front_page()) ?'h1' : 'h2';
if ($header_logo ) :
?>
<<?php  echo $rembrandt_heading_tag; ?> class="sixteen columns"> <a  href="<?php echo site_url(); ?>"><img id="logo" src="<?php echo esc_url($header_logo); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" /></a></<?php echo $rembrandt_heading_tag; ?>>

<?php else : ?>

<<?php echo $rembrandt_heading_tag; ?> class="sixteen columns"><a href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a></<?php echo $rembrandt_heading_tag; ?>>
<?php endif;
    }
    /**************************************************************************************************/
    /********************Paginations*/

    if ( ! function_exists('rembrandt_pagination') ) {
    function rembrandt_pagination() {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

    $pagination = array(
    'base' => @add_query_arg('paged','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'prev_text' => __('&laquo; Previous', 'rembrandt'),
    'next_text' => __('Next &raquo;', 'rembrandt'),
    'show_all' => false,
    'mid_size' => 4,
    'end_size' => 2,
    'type' => 'plain'
    );

    if( $wp_rewrite->using_permalinks() )
    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

    if( !empty($wp_query->query_vars['s']) )
    $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

    echo '
    <div class="wp-pagenavi">
    ' .paginate_links($pagination).'
    </div>
    ' ;
    }
    }
    /*********************/
    function rembrandt_login_css() {
    wp_register_style('login', get_template_directory_uri(). '/css/login.css', '', '30122012', 'all');
    wp_enqueue_style('login');
    }
    add_action('login_head', 'rembrandt_login_css');
    /*********************/
    add_filter( 'login_headerurl', 'rembrandt_login_header_url' );
    function rembrandt_login_header_url($url) {
    return site_url();
    }
    /*********************/
    if ( ! function_exists( 'screens_login_head' ) ) :
    function rembrandt_login_head() {
    $header_logo = get_theme_mod('link_logo','#dd3333');

    if ($header_logo ) :
?>
<style>
    body.login #login h1 a {
    background: url("<?php echo esc_url($header_logo); ?>") no-repeat scroll center top transparent;
        }
</style>
<?php

endif;
}
endif;
add_action('login_head', 'rembrandt_login_head');
/*********************/
/**********
* @note: credit goes to TwentyTwelve theme.***********/
function rembrandt_wp_title( $title, $sep ) {
global $paged, $page;

if ( is_feed() )
return $title;

// Add the site name.
$title .= get_bloginfo( 'name' );

// Add the site description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
$title = "$title $sep $site_description";

// Add a page number if necessary.
if ( $paged >= 2 || $page >= 2 )
$title = "$title $sep " . sprintf( __( 'Page %s', 'mt-white' ), max( $paged, $page ) );

return $title;
}
add_filter( 'wp_title', 'rembrandt_wp_title', 10, 2 );
/*********************/
if ( ! function_exists( 'custom_comments' ) ) :
function custom_comments( $comment, $args, $depth ) {
$GLOBALS['comment'] = $comment;
switch ( $comment->comment_type ) :
case 'pingback' :
case 'trackback' :
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php _e('Pingback:', 'rembrandt'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('(Edit)', 'rembrandt'), '<span class="edit-link">', '</span>'); ?></p>
    <?php
    break;
    default :
    global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <header class="comment-meta comment-author vcard">
                <?php
                echo get_avatar($comment, 60);
                printf('<cite class="fn">%1$s %2$s</cite>', get_comment_author_link(), ($comment -> user_id === $post -> post_author) ? '<span> ' . __('Post author', 'rembrandt') . '</span>' : '');
                printf(' <a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>', esc_url(get_comment_link($comment -> comment_ID)), get_comment_time('c'),
                /* translators: 1: date, 2: time */
                sprintf(__('%1$s at %2$s', 'rembrandt'), get_comment_date(), get_comment_time()));
                ?>
            <div class="reply">
                <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply <span>&darr;</span>', 'rembrandt'), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            </div>              
            </header>

            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'rembrandt'); ?></p>
            <?php endif; ?>

            <section class="comment post-content">
                <?php comment_text(); ?>
                <?php edit_comment_link(__('Edit', 'rembrandt'), '<p class="edit-link">', '</p>'); ?>
            </section>


        </article>
    <?php
    break;
    endswitch;
    }
    endif;
    /*********************/
?>