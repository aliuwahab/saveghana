<?php 

/* =THEME INIT
------------------------------------------------------------------------- */

// define theme consts
define( 'BITLUMEN_OPTIONS_NAME', 'bitLumen-theme-options' );
define( 'BITLUMEN_OPTIONS_GROUP', BITLUMEN_OPTIONS_NAME . '-group' );
define( 'BITLUMEN_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );
define( 'BITLUMEN_THEME_URI', trailingslashit( get_stylesheet_directory_uri() ) );
define( 'BITLUMEN_SF_URI', BITLUMEN_THEME_URI . 'lib/superfish/' );

// theme includes
require_once( BITLUMEN_THEME_DIR . 'functions-settings.php' );

// set theme support
if( !isset( $content_width ) ) $content_width = bitLumen_get_option( 'content_width' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'menus' );
add_theme_support( 'custom-background', array( 'default-color' => 'eeeeee' ) );
add_theme_support( 'custom-header', array(
	'default-image' => BITLUMEN_THEME_URI . 'img/header/default.png',
	'random-default' => false,
	'width' => 435,
	'height' => 90,
	'flex-height' => true,
	'flex-width' => true,
	'default-text-color' => '',
	'header-text' => true,
	'uploads' => true,
	'admin-preview-callback' => 'bitLumen_preview_header_cb' ) );

/* =HEADERS
------------------------------------------------------------------------- */

// custom header preview
function bitLumen_preview_header_cb() { 
	// variables
	$text_color = get_header_textcolor();
	$header_img = get_header_image();
	$bg_color = get_background_color();
	$height = get_custom_header()->height;
	$width = get_custom_header()->width;
	$site_width = bitLumen_get_option( 'content_width' ) + bitLumen_get_option( 'sidebar_width' ) + 33;

	// background color
	$style = 'background-color:' . ( empty( $bg_color ) ? 'transparent' : '#' . $bg_color ) . ';'; 	

	// header image
	$style .= ( empty( $header_img ) ? 'min-height:' . $height . 'px; width:' . $site_width . 'px;' : 'background-image:url(\'' . $header_img . '\');background-size:' . $width . 'px ' . $height . 'px;background-position:top left;background-repeat:no-repeat;' );	

	// header font
	$style .= 'font-family:' . ( bitLumen_get_options( 'web_fonts' ) == 'none' ? 'Verdana,Geneva,sans-serif;' : '\'Droid Sans\';' );

	// header text color
	$color = 'color:#' . $text_color . ';text-decoration:none;';
	
	// title & desc
	$class = ( $text_color == 'blank' || empty( $text_color ) ? 'assistive-text display-none' : 'fake-masthead' );
 ?>
 	
	<div id="fake-masthead" class="preview" style="<?php echo $style; ?>">
		<h1 id="site-title" class="<?php echo $class; ?>"><a href="#" style="<?php echo $color; ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="site-description" class="<?php echo $class; ?>"><a href="#" style="<?php echo $color; ?>"><?php bloginfo( 'description' ); ?></a></h2>
		<div class="clear">&nbsp;</div>
	</div>
<?php
}

// registers default custom header options 
function bitLumen_register_headers() {
	$headers = array (
		'default' => array (
			'url' => BITLUMEN_THEME_URI . 'img/header/default.png',
			'thumbnail_url' => BITLUMEN_THEME_URI . 'img/header/default-thumb.png',
			'description' => 'Default header image' ) );
		
	return register_default_headers( $headers );
}


/* =HELPER FUNCTIONS
------------------------------------------------------------------------- */

// pluralize conditionally
function bitLumen_plural( $count, $noun, $echo=true, $irregular_suffix=false ) {
	if( $count !== 1 ) 
		$suffix = ( $irregular_suffix ? $irregular_suffix : 's' ); // special suffix
	else $suffix = '';
	$output = $count . ' ' . $noun . $suffix;
	if( $echo ) echo $output; 
	else return $output;
}

// get attachment data
function bitLumen_get_attachment( $attachment_id='' ) {
	if( empty( $attachment_id ) ) $attachment_id = get_the_ID(); // use current id if none
	if( !wp_attachment_is_image( $attachment_id ) ) return false; // check if image
	
	$attachment = get_post( $attachment_id ); // get attachment
	
	if( !$attachment ) return false;
	else return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'id' => $attachment->ID,
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'parent_id' => $attachment->post_parent,
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

// print settings error message
function bitLumen_settings_message( $message ) { ?>
	<div class="updated settings-error">
		<p><strong><?php echo $message; ?></strong></p>
	</div>
<?php }


/* =ENQUEUE SCRIPTS AND STYLES
------------------------------------------------------------------------- */

// enqueue core style & comments popup
function bitLumen_enqueue_core() {
	wp_enqueue_style( 'bitLumen-core', BITLUMEN_THEME_URI . 'style.css' ); 
	if( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
}

// enqueues the admin section styles
function bitLumen_enqueue_admin() {
	return wp_enqueue_style( 'bitLumen-options', BITLUMEN_THEME_URI . 'style-admin.css' );
}

// enqueus the dynamic style sheet with bootstraped arguments
function bitLumen_enqueue_dynamic() {
	wp_enqueue_style( 'bitLumen-dyn', BITLUMEN_THEME_URI . 'style.php?css=' . bitLumen_get_dynamic_options(true), 'bitLumen-core' );
}

// bitLumen superfish integration
function bitLumen_enqueue_superfish() {
	$reload_jquery = false;
	
	// load local jquery version
	if( $reload_jquery ) {
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', BITLUMEN_SF_URI . 'jquery-1.8.1.min.js', '	json2', '1.8.1' );
	}
	
	// queue up superfish
	wp_enqueue_script( 'hoverIntent', BITLUMEN_SF_URI . 'hoverIntent.js', 'jquery' );
	wp_enqueue_script( 'superfish', BITLUMEN_SF_URI . 'superfish.js', 'jquery', '1.4.8' );
	wp_enqueue_style( 'superfish', BITLUMEN_SF_URI . 'superfish.css', false, '1.4.8' );
}

// load jquery on page ready
function bitLumen_init_superfish() { ?>

<script type="text/javascript">
	jQuery(document).ready(function(){jQuery('ul.sf-menu').superfish();});
</script>

<?php
}

/* =NAVIGATION
------------------------------------------------------------------------- */

// modify wp-admin bar
function bitLumen_admin_bar_theme_options() {
    global $wp_admin_bar;

	if( !is_admin() ) :
		$theme_options = array(
			'parent' => 'site-name',
			'id' => 'theme_options',
			'title' => 'Theme Options',
			'href' => admin_url( 'themes.php?page=' . BITLUMEN_OPTIONS_NAME ),
			'meta' => false );
	   	$wp_admin_bar->add_menu( $theme_options );
	endif;
}

// index page next/previous posts links
function bitLumen_index_nav( $older_text='&laquo; Older posts', $newer_text='Newer posts &raquo;' ) {
	$older = get_next_posts_link( $older_text );
	$newer = get_previous_posts_link( $newer_text );
	$output = '';
	
	if( !empty( $older ) ) $output .= '<div class="post-nav-next post-nav-older">' . $older . '</div>';
	if( !empty( $newer ) ) $output .= '<div class="post-nav-prev post-nav-newer">' . $newer  . '</div>'; 
	
	if( !empty( $output ) ) {
		$output = '<div class="post-nav-wrapper">' . $output . '</div><!-- /.post-nav-wrapper -->';
		echo $output;
	}
}

// registers nav menu locations
function bitLumen_register_nav_menus() {
	$nav_menus = array(
		'primary-menu' => 'Primary navigation menu'
	);
	register_nav_menus( $nav_menus );
}

// prints a nav menu
function bitLumen_nav_menu( $menu_id = 'primary-menu' ) {
	$nav_menus = array( 
		'primary-menu' => array(
			'theme_location'  => 'primary-menu',
			'menu'            => '', 
			'container_id'    => 'navwrap', 
			'menu_class'      => 'sf-menu', 
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'bitLumen_nav_menu_fb',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		)
	);
	
	if( !isset( $nav_menus[$menu_id] ) )
		return false;
	else
		wp_nav_menu( $nav_menus[$menu_id] );
}

// fallback function for the nav menu
function bitLumen_nav_menu_fb() { 
/* <!--preview menu -->
	<ul id="default-menu-container" class="sf-menu">
		<li id="menu-item-default-1" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-default-1"><a href="#">Parent Page</a>
			<ul class="sub-menu">
				<li id="menu-item-default-2" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-default-2"><a href="#">Level 1</a>
					<ul class="sub-menu">
						<li id="menu-item-default-3" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-default-3"><a href="#">Level 2</a>
							<ul class="sub-menu">
								<li id="menu-item-default-4" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-default-4"><a href="#">Level 3</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
				<li id="menu-item-default-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-default-8"><a href="#">Another Child</a></li>
				<li id="menu-item-default-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-default-9"><a href="#">Yet Another Child</a></li>
			</ul>
		</li>
		<li id="menu-item-default-5" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-default-5"><a href="#">Childless Page</a></li>
		<li id="menu-item-default-6" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-default-6"><a href="#">Another Link</a></li>
</ul>			*/

}


/* =SIDEBAR
------------------------------------------------------------------------- */

// registers sidebar locations
function bitLumen_register_sidebars() {
	$sidebars = array(
		'primary-sidebar' => array(
			'name'          => 'Primary Sidebar',
			'id'            => 'primary-sidebar',
			'description'   => 'The primary sidebar',
			'class'         => '',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>' )
		);
	register_sidebar( $sidebars['primary-sidebar'] );
}

// print default sidebar
function bitLumen_default_sidebar() {
	$args = array(
		'before_widget' => '<li id="text-bitlumen-default" class="widget widget_text">',
		'after_widget'  => '</li>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>'
	);
	
	$admin = '<strong>Hi there Administrator!</strong>
<ul>
	<li>Thanks for adding the bitLumen theme!</li>
	<li>You will probably want to add some custom <a href="' . admin_url( 'widgets.php' ) . '">widgets</a> and <a href="' . admin_url( 'nav-menus.php' ) . '">menus</a> to get rid of the default ones.</li>
	<li>You should also checkout the special <a href="' . admin_url( 'themes.php?page=' . BITLUMEN_OPTIONS_NAME ) . '">theme options</a>.</li>
</ul>';
	
	$normal = '<ul><li>The bitLumen theme!</li></ul>';
	
	$instance = array( 'title' => 'BitLumen Theme', 'text' => ( current_user_can( 'manage_options' ) ? $admin : $normal ) );
	$args['before_widget'] = '<li id="text-bitlumen-default" class="widget widget_text">';
	the_widget( 'WP_Widget_Text', $instance, $args );
}


/* =FILTERS
------------------------------------------------------------------------- */

// wp_title filter
function bitLumen_title_filter( $title, $sep, $seplocation ) {
	$ssep = ' ' . $sep . ' ';
	$pre = $num = '';

	if( !is_single() ) {
		if( is_category() ) $pre = $ssep . 'Category';
		elseif( is_tag() ) $pre = $ssep . 'Tag';
		elseif( is_author() ) $pre = $ssep . 'Author';
		elseif( is_year() || is_month() || is_day() ) $pre = $ssep . 'Archives';
	}

// get the page number (index format)
	if( get_query_var( 'paged' ) )
		$num = $ssep . get_query_var( 'paged' );

// get the page number (multipage post format)
	elseif( get_query_var( 'page' ) )
		$num = $ssep . get_query_var( 'page' );

// concoct and return title
	return get_bloginfo( 'name' ) . $pre . $title . $num;
}

// wp_foot filter
function bitLumen_footer_filter() { 
	$items = array(
		'Powered by <a href="http://wordpress.org" rel="generator" target="_blank">WordPress</a>',
		'<span class="bitLumen-theme">bitLumen theme</span>',
		'created by <a href="http://shinraholdings.com" target="_blank">Shinra Web Holdings</a>' );
	$user_foot = bitLumen_get_option( 'extra_footer' );
	if( !empty( $user_foot ) )
		array_push( $items, bitLumen_get_option( 'extra_footer' ) );
	
	// build footer links
	$output = implode( bitLumen_get_option( 'footer_sep' ), $items ); ?>

<div id="footer"><?php echo $output; ?></div><!-- /#footer -->
<?php 
}


/* =TEMPLATE
------------------------------------------------------------------------- */

// comment status message
function bitLumen_comment_status() {
	global $post;
	$po = $post->comment_status;
	$pi = $post->ping_status; 
	$pa = ( $post->post_type == 'page' ? true : false );
	

	if( $po == 'open' && $pi == 'open' ) :
		$msg = '<a class="comment-link" href="#respond" title="Post a comment">Post a comment</a> or <a class="trackback-link" href="' . get_trackback_url() . '" title="Trackback URL for your post" rel="trackback">leave a trackback</a>.';

	elseif( $po != 'open' && $pi == 'open' ) :
		if( $pa ) $msg = '<a class="trackback-link" href="' . get_trackback_url() . '" title="Trackback URL for your post" rel="trackback">Leave a trackback</a>.';
		else $msg = '<span>Comments are closed, but you can <a class="trackback-link" href="' . get_trackback_url() . '" title="Trackback URL for your post" rel="trackback">leave a trackback</a>.';

	elseif( $po == 'open'  &&  $pi != 'open' ) :
		if( $pa ) $msg = '<a class="comment-link" href="#respond" title="Leave a comment">Leave a comment</a>.';
		else $msg = 'Trackbacks are closed, but you can <a class="comment-link" href="#respond" title="Leave a comment">Leave a comment</a>.';

	else :
		if( $pa ) $msg = '&nbsp;';
		else $msg = 'Both comments and trackbacks are currently closed.';
endif;
	
	$msg = '<span>' . $msg . '</span>';
}

// safely print post title and link
function bitLumen_post_title( $echo=true ) {
	$post_id = get_the_ID();
	
	$permalink = get_permalink( $post_id );
	$post_title = get_the_title( $post_id );
	$post_title_clean = esc_attr( strip_tags( $post_title ) );
		
	if( empty( $post_title_clean ) ) {
		$post_title_clean = 'this post';
		$post_title = '<em>(no title)</em>';
	}

	$output = sprintf( '<a href="%1$s" title="Permalink to &ldquo;%2$s&rdquo;" rel="bookmark">%3$s</a>', $permalink, $post_title_clean, $post_title );
		if( $echo ) echo $output;
		else return $output;
}

// safely get (attachment) post title 
function bitLumen_attachment_title( $echo=true ) {
	$parent_title = get_the_title( $post->post_parent );
	if( empty( $parent_title ) ) $parent_title = '(no title)';

		$output = sprintf( '<a href="%1$s" title="Permalink to &ldquo;%3$s&rdquo;" rel="bookmark">From %4$s</a>: <a href="%2$s" title="Permalink to this %5$s from &ldquo;%3$s&rdquo;" rel="bookmark">%3$s</a></h2>',
			get_permalink( $post->post_parent ),
			get_permalink(),
			$parent_title,
			( is_page( $post->post_parent ) ? 'Page' : 'Post' ),
			( wp_attachment_is_image() ? 'image' : 'file' ) );

	if( $echo ) echo $output;
	else return $output;
}

// selectively returns the chosen parts of the entry meta
function bitLumen_entry_meta( $echo=true ) {
	$items = array(
		bitLumen_post_author(),
		bitLumen_post_date(),
		( bitLumen_get_option( 'entry_edit_link' ) ? bitLumen_edit_post_link() : false ),
		( bitLumen_get_option( 'entry_trash_link' ) ? bitLumen_trash_post_link() : false )
	);
	$items = array_filter( $items );
	$output = implode( '<span class="meta-sep"> ' . bitLumen_get_option( 'entry_meta_sep' ) . ' </span>', $items );
	echo $output;
}

// post author meta item
function bitLumen_post_author() {
	if( bitLumen_get_option( 'entry_post_author' ) == 'none' ) return false;

	$author_id = get_the_author_meta( 'ID' );
	$author_name = get_the_author();
	$author_nicename = get_the_author_meta( 'user_nicename' );
	$author_url = get_author_posts_url( $author_id, $author_nicename );
	
	if( bitLumen_get_option( 'entry_post_author' ) == 'link' )
		$output = '<a href="' . $author_url . '" title="View all posts by &ldquo;' . $author_nicename . '&rdquo;" rel="author">' . $author_name . '</a>';
	else
		$output = '<span>' . $author_name . '</span>';
	return $output;
}

// post date
function bitLumen_post_date() {
	if( bitLumen_get_option( 'entry_post_date' ) == 'none' ) return false;
	elseif( bitLumen_get_option( 'entry_post_date' ) == 'updated' ) {
		$date = get_the_modified_date();
		$time = get_the_modified_time();
	}
	else {
		$date = get_the_date();
		$time = get_the_time();
	}
	if( !bitLumen_get_option( 'entry_post_time' ) ) $time = '';
	else $time = ' at ' . $time;
	
	$output = $date . $time;
	if( !empty( $output ) )
		return '<span>' . $output . '</span>';
}

// edit link
function bitLumen_edit_post_link() {
	if( current_user_can( 'edit_posts' ) ) 
		return '<span class="edit-post-link-wrapper"><a href="' . get_edit_post_link() . '" class="edit-post-link">Edit</a></span>';
}
	
// trash link
function bitLumen_trash_post_link() {
	if( current_user_can( 'delete_posts' ) )
		return '<span class="trash-post-link-wrapper"><a class="trash-post-link" href="' . wp_nonce_url( home_url() . '/wp-admin/post.php?action=delete&amp;post=' . $post->ID, 'delete-post_' . $post->ID ) . '">Trash</a></span>';
}

// equivalent of get_comments_popup_link
function bitLumen_get_comments_popup_link() {
	if( !comment_open() ) return '<span class="comments-link-wrapper">Comments Off</span>';
	
	$num = get_comments_number(); 
	if( $num == 0 ) $text = 'Leave a Comment';
	elseif( $num > 1 ) $text = $num . ' Comments';
	else $text = '1 Comment';
	
	return '<span class="comments-link-wrapper"><a href="' . get_comments_link( get_the_ID() ) . '">' . $text . '</a></span>';
}

// special index page type
function bitLumen_special_index_type( $post ) { 
	if( is_category( $post ) ) { // category
		$title = 'Category';
		$item =  single_cat_title( '', false );
		$message = 'You are now browsing all items filed in the &ldquo;' . $item . '&rdquo; category.';
	}

	elseif( is_tag( $post ) ) { // tag
		$title = 'Tag'; 
		$item = single_tag_title( '', false );
		$message = 'You are now browsing all items tagged with &ldquo;' . $item . '&rdquo;';
	}

	elseif( is_author() ) { // author
		$title = 'Author'; 
		$item = get_the_author();
		$message = 'You are now browsing all items authored by &ldquo;' . $item . '.&rdquo;'; 
	}
	
	elseif( is_month() || is_day() ) { // archives (month or day)
		$title = 'Archives'; 
		$item = substr( single_month_title(', ', false ), 2 );
		$message = 'You are now browsing the archives for items from &ldquo;' . $item . '.&rdquo;';
	}

	elseif( is_year() ) { // archive (year)
		$title = 'Archives'; 
		$item = get_the_date( 'Y');
		$message = 'You are now browsing the archives for posts from the year &ldquo;' . $item . '.&rdquo;'; 
	}
	
	elseif( is_search() ) { // search
		$title = 'Search'; 
		$item = get_search_query();
		$message= 'You are now browsing our search results for &ldquo;' . $item . '.&rdquo;';
	}

	else return false;
	
	// print content ?>
	<li class="widget bitLumen-index-type-widget">
		<h2 class="widget-title bitLumen-index-type"><?php echo $title; ?> Index</h2>
		<p><?php echo $message; ?></p>
	</li>
	<?php
}

// print featured image
function bitLumen_the_post_thumbnail( $post_id=null ) {
	$post_id = ( $post_id === null ? get_the_ID() : $post_id );
	
	if( !has_post_thumbnail( $post_id ) ) return false;
	
	// post data
	$permalink = get_permalink( $post_id );
	$post_title = esc_attr( get_the_title( $post_id ) );

	// thumb data
	$thumb_id = get_post_thumbnail_id( $post_id );
	$thumb_html = get_the_post_thumbnail( $post_id, 'medium', array( 'class' => 'post-thumbnail' ) );
	$thumb = bitLumen_get_attachment( $thumb_id );
		if( !empty( $thumb['caption'] ) ) $caption = $thumb['caption'];
		elseif( !empty( $thumb['description'] ) ) $caption = $thumb['description'];
		elseif( !empty( $thumb['title'] ) ) $caption = $thumb['title'];
		else $caption = $post_title;

	printf( '<div id="post-thumbnail-%1$s" class="wp-caption alignleft"><a href="%2$s" title="Continue reading &quot;%3$s&quot;">%4$s</a><p class="wp-caption-text">%5$s</p></div>',
	$thumb_id, $permalink, $post_title, $thumb_html, $caption );
}

// add custom avatar callback
function bitLumen_custom_avatar_cb( $avatar_defaults ) {
    $theme_image = BITLUMEN_THEME_URI . 'img/avatar.png';
    $avatar_defaults[$theme_image] = 'bitLumen Avatar';
    return $avatar_defaults;
}  

// adds meta description (in header) if found
function bitLumen_meta_description_filter() {
	if( !is_single() ) $meta_description = get_bloginfo( 'description' );
	else $meta_description = bitLumen_get_meta_description();
	if( !empty( $meta_description ) ) :
?>
<meta name="description" content="<?php echo esc_attr( strip_tags( $meta_description ) ); ?>" />
<?php endif;
}

// gets the meta description of a page or post
function bitLumen_get_meta_description( $post_id='' ){
	if( empty( $post_id ) ) $post_id = get_the_ID();
	return get_post_meta( $post_id, 'meta_description', true );
}

// draws the inner HTML for the meta description meta box
function bitLumen_draw_meta_description_meta_box() {
	wp_nonce_field( plugin_basename( __FILE__ ), 'bitLumen_meta_description_noncename' ); 
?>

<textarea id="bitLumen_meta_description_text" name="bitLumen_meta_description_text" style="height:4em;width:98%;"><?php echo bitLumen_get_meta_description( $post->ID ); ?></textarea>

<?php
}

function bitLumen_save_meta_description( $post_id ) {
	// verify
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !wp_verify_nonce( $_POST['bitLumen_meta_description_noncename'], plugin_basename( __FILE__ ) ) ) return;
	if ( $_POST['post_type'] == 'page' ) { if ( !current_user_can( 'edit_page', $post_id ) ) return; }
	else { if ( !current_user_can( 'edit_post', $post_id ) ) return; }

	// update
	update_post_meta( $post_id, 'meta_description', esc_attr( strip_tags( $_POST['bitLumen_meta_description_text'] ) ) );
}

// register the meta boxes
function bitLumen_add_meta_boxes() {
	add_meta_box( 'add_meta_description_meta_box', 'Meta Description', 'bitLumen_draw_meta_description_meta_box', 'post', 'normal', 'high' );
	add_meta_box( 'add_meta_description_meta_box', 'Meta Description', 'bitLumen_draw_meta_description_meta_box', 'page', 'normal', 'high' );
}

// FILTERS
add_filter( 'avatar_defaults', 'bitLumen_custom_avatar_cb', 10, 1 );
add_filter( 'wp_title', 'bitLumen_title_filter', 10, 3 );

// ACTIONS
add_action( 'admin_enqueue_scripts', 'bitLumen_enqueue_admin', 10 ); // admin style
add_action( 'after_setup_theme', 'bitLumen_register_nav_menus', 10 );
add_action( 'after_setup_theme', 'bitLumen_register_headers', 10 );
add_action( 'widgets_init', 'bitLumen_register_sidebars', 10 );
add_action( 'wp_enqueue_scripts', 'bitLumen_enqueue_core', 10 );
add_action( 'wp_enqueue_scripts', 'bitLumen_enqueue_dynamic', 10 );
add_action( 'wp_enqueue_scripts', 'bitLumen_enqueue_superfish', 11 );
add_action( 'wp_head', 'bitLumen_init_superfish', 99999 );
add_action( 'wp_footer', 'bitLumen_footer_filter', 99999 );

if( bitLumen_get_option( 'meta_descriptions' ) ) {
	add_action( 'add_meta_boxes', 'bitLumen_add_meta_boxes', 10 );
	add_action( 'save_post', 'bitLumen_save_meta_description', 10, 1 );
	add_action( 'wp_head', 'bitLumen_meta_description_filter', 10 );
}

if( bitLumen_get_option( 'wpadminbar_theme_options' ) )
	add_action( 'wp_before_admin_bar_render', 'bitLumen_admin_bar_theme_options' );

?>