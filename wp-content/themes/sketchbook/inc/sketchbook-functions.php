<?php
/*----------*/
/*		THEME OPTIONS - functions  
-----------------------------------------------------------------------------------
	1.	Theme options
	2.	Theme options - toggle effect
	3.	Social Media 
    4.	Author description 
	5.	Comments
 * 	6.	Login
    7.	Favicon
    8.	Featured image
    9. Featured image - link
    10. Custom Avatar
    11. Sidebar position
    12. Link to documentation
    13. Widgets in the footer
    14. Css style
        15.1 Links color, Header color, Footer background color, fonts(text, headers)
        15.2 Sidebar background 
        15.3 Container background 
        15.4 Primery navigation background
        15.5 Google Fonts - Headers
        15.6 Google Fonts - links to the source
-----------------------------------------------------------------------------------*/
/*----------*/
/*  1.  Theme options  */
/*----------*/

/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
	get_template_part('admin/options','framework');
	/////require_once ( get_template_directory() . '/admin/options-framework.php' );
}

		/*
		* This is an example of how to add custom scripts to the options panel.
		* This one shows/hides the an option when a checkbox is clicked.
		*/
/*----------*/
/*  2.  Theme options - toggle effect */
/*----------*/
		add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

		function optionsframework_custom_scripts() {
 ?>
<script type="text/javascript">
	jQuery(document).ready(function() {

		jQuery('#slide').click(function() {
			jQuery('#section-slide_select, #section-slide_effect, #section-slide_play').fadeToggle(400);
		});
		if(jQuery('#slide:checked').val() !== undefined) {
			jQuery('#section-slide_select, #section-slide_effect, #section-slide_play').show();
		}
		
		jQuery('#font_google_web').click(function() {
			jQuery('#section-font_web').fadeToggle(400);
		});
		if(jQuery('#font_google_web:checked').val() !== undefined) {
			jQuery('#section-font_web').show();
		}
	});

</script>
<?php
}
/*----------*/
/*	3.	Social Media  */
/*--------*/
/*
Plugin Name:  Pinterest Pin It Button
Plugin URI:   http://pleer.co.uk/wordpress/plugins/pinterest-pin-it-button/
Description:  A simple plugin that lets you output a Pinterest "Pin It" button via shortcode
Version:      1.0
Author:       Alex Moss
Author URI:   http://alex-moss.co.uk/
Contributors: pleer, ShaneJones

Copyright (C) 2010-2010, Alex Moss
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
Neither the name of Alex Moss or pleer nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/
function pinterestJS(){
echo  <<<EOT
<script type="text/javascript">
(function() {
    window.PinIt = window.PinIt || { loaded:false };
    if (window.PinIt.loaded) return;
    window.PinIt.loaded = true;
    function async_load(){
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        if (window.location.protocol == "https:")
            s.src = "https://assets.pinterest.com/js/pinit.js";
        else
            s.src = "http://assets.pinterest.com/js/pinit.js";
        var x = document.getElementsByTagName("script")[0];
        x.parentNode.insertBefore(s, x);
    }
    if (window.attachEvent)
        window.attachEvent("onload", async_load);
    else
        window.addEventListener("load", async_load, false);
})();
</script>
<script>
function exec_pinmarklet() {
    var e=document.createElement('script');
    e.setAttribute('type','text/javascript');
    e.setAttribute('charset','UTF-8');
    e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r=' + Math.random()*99999999);
    document.body.appendChild(e);
}
</script>
EOT;
}

/*----------*/
function pinterestCSS(){
echo "<link rel=\"stylesheet\" href=\"".get_template_directory_uri( )."/css/pin-it.css\" type=\"text/css\" />";
}
add_action('wp_head', 'pinterestCSS');
/*----------*/
add_filter('the_content', 'sketchbook_social',90);
		if ( ! function_exists( 'sketchbook_social' ) ) :
function sketchbook_social($content) {
if (of_get_option('social') && is_singular() ) {
$content .='<ul class="sketchbook_social">
<li><em>'.__('Share', 'sketchbook').'</em></li>
<li><a href="'.esc_url('https://twitter.com/share').'" class="twitter-share-button" data-related="@'.get_the_author().'">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</li>
<li class="pinterest-btn">
	<a href="javascript:exec_pinmarklet();" class="pin-it-btn" title="Pin It on Pinterest"></a>
<li>
<!-- Place this tag where you want the su badge to render -->
<su:badge layout="2"></su:badge>

<!-- Place this snippet wherever appropriate --> 
 <script type="text/javascript"> 
 (function() { 
     var li = document.createElement(\'script\'); li.type = \'text/javascript\'; li.async = true; 
      li.src =\''.esc_url('https://platform.stumbleupon.com/1/widgets.js').'\'; 
      var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(li, s); 
 })(); 
 </script></li>
<li>
<div class="plusone"><g:plusone  href="'.get_permalink().'"></g:plusone></div>
<script src="'.esc_url('https://apis.google.com/js/plusone.js').'" type="text/javascript" charset="utf-8"></script></li> 
</ul>';
add_action('wp_footer', 'pinterestJS', 100);
}
return $content;
}
endif;
/*----------*/
/*	 4.	Author description  */
/*----------*/
add_action( 'show_user_profile', 'sketchbook_profile_fields' );
add_action( 'edit_user_profile', 'sketchbook_profile_fields' );
function sketchbook_profile_fields( $user) {
?>
    <h3><?php	_e('Social media', 'sketchbook');?></h3>
    <table class="form-table">
        <tr>
            <th><label for="sketchbook_twitter_url"><?php	_e('Twitter URL', 'sketchbook');?></label></th>
            <td>
                <input style="width:500px" type="text" name="sketchbook_twitter_url" value="<?php	echo esc_url(get_the_author_meta('sketchbook_twitter_url', $user -> ID));?>" /><br />
            </td>
        </tr>
        <tr>
            <th><label for="sketchbook_facebook_url"><?php	_e('Facebook URL', 'sketchbook');?></label></th>
            <td>
                <input style="width:500px" type="text" name="sketchbook_facebook_url" value="<?php	echo esc_url(get_the_author_meta('sketchbook_facebook_url', $user -> ID));?>" /><br />
            </td>
        </tr>
         <tr>
            <th><label for="sketchbook_google_url"><?php	_e('Google plus URL', 'sketchbook');?></label></th>
            <td>
                <input style="width:500px" type="text" name="sketchbook_google_url" value="<?php	echo esc_url(get_the_author_meta('sketchbook_google_url', $user -> ID));?>" /><br />
            </td>
        </tr>
    </table>
<?php	}
		add_action( 'personal_options_update', 'sketchbook_save_profile_fields' );
		add_action( 'edit_user_profile_update', 'sketchbook_save_profile_fields' );

		function sketchbook_save_profile_fields( $user_id ) {
		if ( ! current_user_can( 'edit_user', $user_id ) )
		return false;
		update_user_meta( $user_id, 'sketchbook_twitter_url', $_POST['sketchbook_twitter_url'] );
		update_user_meta( $user_id, 'sketchbook_facebook_url', $_POST['sketchbook_facebook_url'] );
		update_user_meta( $user_id, 'sketchbook_google_url', $_POST['sketchbook_google_url'] );
		}		
/*********************/
		if ( ! function_exists( 'sketchbook_author_desc' ) ) :
function sketchbook_author_desc(){
	
	if (of_get_option('author_desc') && get_the_author_meta( 'description' ) ) :
			?>
			<div id="author-info">
								<?php	echo get_avatar(get_the_author_meta('user_email'));?>
					<?php echo'<ul id="s_social">';
		if ( get_the_author_meta( 'user_url' ) ) :
		printf( __( '<li><a href="%1$s" title="%2$s">%2$s</a></li>', 'sketchbook' ), esc_url(get_the_author_meta('user_url')),
		esc_attr__(__( 'Website', 'sketchbook')));
		endif;
		
		if ( get_the_author_meta( 'sketchbook_twitter_url' ) ) :
		printf( __( '<li id="sketchbook_t"><a href="%1$s" title="%2$s">%2$s</a></li>', 'sketchbook' ), esc_url(get_the_author_meta('sketchbook_twitter_url')),
		esc_attr__(__( 'Twitter Profile', 'sketchbook')));
		endif;

		if ( get_the_author_meta( 'sketchbook_facebook_url' ) ) :
		printf( __( '<li id="sketchbook_f"><a href="%1$s" title="%2$s">%2$s</a></li>', 'sketchbook' ), esc_url(get_the_author_meta('sketchbook_facebook_url')),
		esc_attr__(__( 'Facebook Proflie', 'sketchbook')));
		endif;

		if ( get_the_author_meta( 'sketchbook_google_url' ) ) :
		printf( __( '<li id="sketchbook_g"><a href="%1$s" title="%2$s">%2$s</a></li>', 'sketchbook' ), esc_url(get_the_author_meta('sketchbook_google_url')),
		esc_attr__(__( 'Google Plus Profile', 'sketchbook')));
		endif;
		echo'<li></li></ul>'; ?>


				<h2><?php	printf(__('%s', 'sketchbook'), get_the_author());?></h2>
				<p>
					<?php	the_author_meta('description');?>
				</p>
<?php	if(!is_author()) :?>				
				<p><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>" rel="author"> <?php printf(__('View all posts by %s &rarr;', 'sketchbook'), get_the_author());?></a>
				</p>
				<div class="clear"></div>
				<?php endif; ?>
			</div>
			<?php	endif;
}
 endif;
/*----------*/
/*	 5.	Comments */
/*----------*/
if ( ! function_exists( 'sketchbook_comments_info' ) ) :
function sketchbook_comments_info(){
if (of_get_option('icons_comments')) :
?> <?php if ( comments_open() && ! post_password_required()) {
?>
<div class="post-comments-list">
	<?php	comments_popup_link(__('0 Comment', 'sketchbook'), __('1 Comment', 'sketchbook'), __('% Comments', 'sketchbook'));
	?>
</div>
<?php }
?>
<?php else :
?>
<?php if ( comments_open() && ! post_password_required()) {
?>
<div class="post-comments">
	<?php	comments_popup_link(__('0', 'sketchbook'), __('1', 'sketchbook'), __('% ', 'sketchbook'));
	?>
</div>
<?php }
?>

<?php	endif;
}
endif;
/*----------*/
/*	 6.	Login  */
/*----------*/
		if ( ! function_exists( 'sketchbook_login_head' ) ) :
function sketchbook_login_head() {
if (of_get_option('logo_img') ) :
?>
<style>
	body.login #login h1 a {
	background: url("<?php echo esc_url(of_get_option('logo_img'));?>") no-repeat scroll center top transparent;
	}
</style>
<?php
add_filter ('login_headerurl', 'sketchbook_login_url');
add_filter('login_headertitle', 'sketchbook_login_title');
endif;
}
endif;
add_action('login_head', 'sketchbook_login_head');

function sketchbook_login_url () {
 site_url();
}
function sketchbook_login_title() {
 get_option('blogname');
}
/*----------*/
/*	 7.	Favicon  */
/*----------*/
		if ( ! function_exists( 'sketchbook_favicon_head' ) ) :
function sketchbook_favicon_head() {
if (of_get_option('favicon_img') ) :
?>
<link rel="shortcut icon" href="<?php echo esc_url(of_get_option('favicon_img'));?>" />
<?php
endif;
}
endif;
add_action('wp_head', 'sketchbook_favicon_head');
/*----------*/
/*	 8.	Featured image  */
/*----------*/
		if ( ! function_exists( 'sketchbook_img_icons' ) ) :
function sketchbook_img_icons() {
	if (of_get_option('img_icons')) {
		if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
			   $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
   echo '<div class="sketchbook_post_icons"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
   the_post_thumbnail('sketchbook_post-thumb');
   echo '</a></div>';
		}
	}
}
endif;
/*----------*/
/*	 10. Featured image - link */
/*----------*/
		if ( ! function_exists( 'sketchbook_img_icons_links' ) ) :
function sketchbook_img_icons_links() {
	 if ( has_post_thumbnail()) {
if (of_get_option('img_i_effect')=='one') {
   $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
   echo '<div class="sketchbook_post_icons"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
   the_post_thumbnail('sketchbook_post-thumb');
   echo '</a></div>';

} elseif (of_get_option('img_i_effect')=='two') {
   echo '<div class="sketchbook_post_icons"><a href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '" >';
   the_post_thumbnail('sketchbook_post-thumb');
   echo '</a></div>'; 
 } else{
   the_post_thumbnail('sketchbook_post-thumb');
 }
}
}
endif;
/*----------*/
/*	 11. Custom Avatar */
/*----------*/
add_filter( 'avatar_defaults', 'sketchbook_avatar' );
function sketchbook_avatar($avatar_defaults){
	if (of_get_option('avatar_img')) {
$new_avatar = esc_url(of_get_option('avatar_img'));
$avatar_defaults[$new_avatar] = "Sketchbook Avatar";
}
return $avatar_defaults;
}
/*----------*/
/*	 12. Sidebar position */
/*----------*/
function sketchbook_sidebar_position($classes) {
	if (of_get_option('sidebar_position') == 'left') :
		$classes[] = 'sidebar-left';
	else :
		$classes[] = 'sidebar-right';
	endif;
	return $classes;
}
add_filter('body_class', 'sketchbook_sidebar_position');
/*----------*/
/*	 13. Link to documentation */
/*----------*/
function sketchbook_admin_bar_render() {
	global $wp_admin_bar;
        $wp_admin_bar->add_menu( array(
        'parent' => false,
        'id' => 'sketchbook_docs_txt',
        'title' => __('Sketchbook documentation ', 'sketchbook'),
        'href' => false
    ) );
	     $wp_admin_bar->add_menu( array(
        'parent' => false,
        'id' => 'sketchbook_docs',
        'title' => __(' en', 'sketchbook'),
        'href' => get_template_directory_uri() . '/doc/index.html'
    ) );
		     $wp_admin_bar->add_menu( array(
        'parent' => false,
        'id' => 'sketchbook_docspl',
        'title' => __(' pl', 'sketchbook'),
        'href' => get_template_directory_uri() . '/doc/indexpl.html'
    ) );
}
add_action( 'wp_before_admin_bar_render', 'sketchbook_admin_bar_render' );
/*----------*/
/*	 14. Widgets in the footer */
/*----------*/
function sketchbook_footer_widgets_init() {
		register_sidebar( array(
		'name' => __( 'Widget in the footer', 'sketchbook' ),
		'id' => 'center-footer-widget-area',
		'description' => __( 'Widget  in the center part of the footer.', 'sketchbook' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );   
}
if (of_get_option('footer_widgets') == 'threeleft' || of_get_option('footer_widgets') == 'threeright') :
add_action( 'widgets_init', 'sketchbook_footer_widgets_init' );
endif;

		if ( ! function_exists( 'sketchbook_footer_widgets' ) ) :
function sketchbook_footer_widgets() {
		 if	( of_get_option('footer_widgets') == 'threeleft' ):
		?>
		<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) :
		?>
		<div class="grid_8">
			<ul class="widget">
				<?php dynamic_sidebar('first-footer-widget-area');?>
			</ul>
		</div>
		<?php  endif;
		if ( is_active_sidebar( 'center-footer-widget-area' ) ) :
		?>
		<div class="grid_4">
			<ul class="widget">
				<?php dynamic_sidebar('center-footer-widget-area');?>
			</ul>
		</div>
		<?php  endif;
		if ( is_active_sidebar( 'second-footer-widget-area' ) ) :
		?>
		<div class="grid_4">
			<ul class="widget">
				<?php dynamic_sidebar('second-footer-widget-area');?>
			</ul>
		</div>
		<?php  endif;
		elseif	( of_get_option('footer_widgets') == 'threeright' ):
		?>
				<?php	if ( is_active_sidebar( 'second-footer-widget-area' ) ) :
		?>
		<div class="grid_4">
			<ul class="widget">
				<?php dynamic_sidebar('second-footer-widget-area');?>
			</ul>
		</div>
		<?php  endif;
			if ( is_active_sidebar( 'center-footer-widget-area' ) ) :
		?>
		<div class="grid_4">
			<ul class="widget">
				<?php dynamic_sidebar('center-footer-widget-area');?>
			</ul>
		</div>
		<?php  endif;
		 if ( is_active_sidebar( 'first-footer-widget-area' ) ) :
		?>
		<div class="grid_8">
			<ul class="widget">
				<?php dynamic_sidebar('first-footer-widget-area');?>
			</ul>
		</div>
		<?php  endif;
else:	
		if ( is_active_sidebar( 'first-footer-widget-area' )) :
		?>
		<div class="grid_8">
			<ul class="widget">
				<?php dynamic_sidebar('first-footer-widget-area');?>
			</ul>
		</div>
		<?php  endif?>
		<?php	if ( is_active_sidebar( 'second-footer-widget-area' ) ) :
		?>
		<div class="grid_8" id="floatright">
			<ul class="widget">
				<?php dynamic_sidebar('second-footer-widget-area');?>
			</ul>
		</div>
		<?php  
		endif;  
		endif;
}
endif;
/*----------*/
/*	 15. Css style  */
/*----------*/
add_action( 'wp_head', 'sketchbook_theme_css' );
		if ( ! function_exists( 'sketchbook_theme_css' ) ) :
	function sketchbook_theme_css() {
	echo '<style type="text/css">';	
/*----------*/
/*	 15.1 Links color, Header color, Footer background color, fonts(text, headers), post formats background  */
/*----------*/
$typography = of_get_option('font_type');
	if(of_get_option('font_type') ): echo 'body {font:'.$typography['size'] . '    ' . $typography['face']. ';
	color:'.$typography['color'].';
	font-style:' . $typography['style'] . '; line-height:1.5;}';  endif;
	if(of_get_option('font_type_header')=='two' ): echo 'h1, h2, h3, h4, h5, h6 {font-family: "Helvetica Neue", Helvetica, Arial, Geneva, sans-serif;}';  endif;
	if(of_get_option('headers_color') !='#7F7F7F'): echo 'h1, h2, h3, h4, h5, h6 { color:'.of_get_option('headers_color').'; }'; endif;
	if(of_get_option('links_color') !='#AF3E00'): echo 'a { color:'.of_get_option('links_color').';}';  endif;
	if(of_get_option('footer_color') !='#EFEFEF'): echo '#footer {background-color:'.of_get_option('footer_color').';}'; endif;

	if(of_get_option('post_format')): echo '.format-aside, .format-link, .format-quote, .format-video, .format-gallery, .format-image 
	{background-color: '.of_get_option('post_format').';}'; endif;

/*----------*/
/*	 15.2 Sidebar background  */
/*----------*/
if(of_get_option('sidebar') =='brown'): echo '
#sidebar{
	margin-top: 10px;
	background: url('.get_template_directory_uri() . '/images/sidebar.jpg);
}
#sidebar .widget_top{
	background: url('.get_template_directory_uri() . '/images/sidebar-top.png) no-repeat top center;
	margin-top: -10px;
}
#sidebar .widget_bottom{
	background: url('.get_template_directory_uri() . '/images/sidebar-bottom.png) no-repeat bottom center;
	margin-bottom: -14px;
	padding-bottom: 25px;
}	
#sidebar .widget li{
	border-bottom:none;
	padding-top:20px;
	margin-top: -10px;
    background: url('.get_template_directory_uri() . '/images/sidebar-top.png) no-repeat top center;
}
#sidebar .widget li li{
	padding-top:0;
	margin-top: 0;
    background: url('.get_template_directory_uri() . '/images/icon.png) no-repeat -260px -459px;
}	
#sidebar .widget {
	border-left:none
}
	.sidebar-left	#sidebar .widget {
		border-left: none;
		border-right: none;
	}
';
elseif(of_get_option('sidebar') =='dark'): echo '
#sidebar{
	background: url('.get_template_directory_uri() . '/images/sidebar-dark.jpg);
    color: #aaa;
}
#searchform {
    margin:0;
}
#sidebar .widget_bottom{
	background: url('.get_template_directory_uri() . '/images/sidebar_dark_bottom.png) no-repeat bottom center;
	margin-bottom: -10px;
	padding-bottom: 35px;
}	
#sidebar .widget li{
	border-bottom:none;
	padding-top:20px;
    background: url('.get_template_directory_uri() . '/images/sidebar_dark_ornament.jpg) no-repeat top center;
}

#sidebar .widget li li{
	padding-top:0;
    background: url('.get_template_directory_uri() . '/images/icon.png) no-repeat -260px -459px;
}	
#sidebar .widget {
	border:none;
	padding-top:10px
}
	.sidebar-left	#sidebar .widget {
		border-left: none;
		border-right: none;
	}
'; 
elseif(of_get_option('sidebar') =='black'): echo '
#sidebar{
	margin-top: 10px;
	background: #222;
    color:#aaa;
}
#sidebar .widget{
	   border: none
}		
#sidebar .widget li{
	border-bottom:1px dotted #aaa;
}
	.sidebar-left	#sidebar .widget {
		border-left: none;
		border-right: none;
	}
'; 
endif;
/*----------*/
/*	 15.3 Container background  */
/*----------*/
if(of_get_option('wrapper') =='grey'): echo '
#wrapper{
    background: url('.get_template_directory_uri() . '/images/wrapper.png) no-repeat top center;
    padding: 20px 0 0 0;
	margin-top:-10px;
}
#bg{
	padding: 0;
	background:#fff url('.get_template_directory_uri() . '/images/wrapper.png) no-repeat -20px -20px;
}
';
elseif(of_get_option('wrapper') =='brown'): echo '
#wrapper{
    background: url('.get_template_directory_uri() . '/images/wrapperbrown.png) no-repeat top center;
    padding: 25px 0 0 0;
	margin-top:-5px;
}
#bg{
	padding: 0;
	background:#fff url('.get_template_directory_uri() . '/images/wrapperbrown.png) no-repeat -20px -20px;
}
	.sticky {
		background: url('.get_template_directory_uri() . '/images/sticky_2.png) no-repeat top center;
	}
'; 
endif;
/*----------*/
/*	 15.4 Primery navigation background  */
/*----------*/
if(of_get_option('nav') =='dark'): echo '
#nav{
    background: #2D2D2D url('.get_template_directory_uri() . '/images/nav.jpg);
}
#nav a,  #nav ul ul a,  #nav .current_page_item li li a, #nav .current-menu-item li li a {
    color: #BFB1A7;
}
#nav .current_page_item a, #nav a:hover, #nav li li a:hover, #nav .current-menu-item a{
    color:#fff;
}
#nav li li {
    background: #fff url('.get_template_directory_uri() . '/images/nav.jpg);
}
#nav ul ul {
	background:  url('.get_template_directory_uri() . '/images/icon.png) no-repeat -70px -350px;
}

#nav ul ul ul {
    background:  url('.get_template_directory_uri() . '/images/icon.png) no-repeat 0 -388px;
}
';
/*----------*/
elseif(of_get_option('nav') =='white'): echo '
#nav{
    background: #fff url('.get_template_directory_uri() . '/images/nav-white.jpg);
}
#nav a,  #nav ul ul a, #nav .current_page_item a, #nav li .current-menu-item a {
    color:#777;
}
#nav .current_page_item a, #nav .current-menu-item a, #nav a:hover, #nav li li a:hover, #nav li .current_page_item a, #nav li .current-menu-item a {
    color:#000;
}
#nav li li {
    background: #fff url('.get_template_directory_uri() . '/images/nav-white.jpg);
}
#nav ul ul {
	background:  url('.get_template_directory_uri() . '/images/icon.png) no-repeat -70px -600px;
}

#nav ul ul ul {
    background:  url('.get_template_directory_uri() . '/images/icon.png) no-repeat 0 -646px;
}
'; 
/*----------*/
elseif(of_get_option('nav') =='black'): echo '
#nav{
    background: #000;
    -webkit-box-shadow: #584232 0 0 4px;
	-moz-box-shadow: #584232 0 0 4px;
	box-shadow: #584232 0 0 4px;
}
#nav a {
    color: #aaa;
}
#nav a:hover {
    color: #fff;
}
#nav .current_page_item a, #nav .current-menu-item a {
    color:#fff
}
'; 
endif;
/*----------*/
/*----------*/
/*	 15.5 Google Fonts - Headers  */
/*----------*/	
	if(of_get_option('font_web')=='2' && of_get_option('font_google_web')): echo ' h1, h2, h3, h4, h5, h6{font-family: "Ribeye Marrow";}';  
	elseif(of_get_option('font_web')=='3' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: Lobster;}';  
    elseif(of_get_option('font_web')=='4' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Abril Fatface";}'; 
    elseif(of_get_option('font_web')=='5' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Open Sans";}'; 
    elseif(of_get_option('font_web')=='6' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Droid Sans";}'; 
    elseif(of_get_option('font_web')=='7' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: Oswald;}'; 
    elseif(of_get_option('font_web')=='8' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: Vollkorn;}'; 
    elseif(of_get_option('font_web')=='9' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Droid Sans Mono";}'; 
    elseif(of_get_option('font_web')=='10' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Special Elite";}'; 
    elseif(of_get_option('font_web')=='11' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Old Standard TT";}'; 
    elseif(of_get_option('font_web')=='12' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Lobster Two";}'; 
    elseif(of_get_option('font_web')=='13' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Maven Pro";}'; 
    elseif(of_get_option('font_web')=='14' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: Bevan;}'; 
    elseif(of_get_option('font_web')=='15' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: Poly;}'; 
	elseif(of_get_option('font_web')=='16' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: Lato;}'; 
	elseif(of_get_option('font_web')=='17' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Gravitas One";}'; 
	elseif(of_get_option('font_web')=='18' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "PT Serif";}'; 
	elseif(of_get_option('font_web')=='19' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: Ubuntu;}'; 
	elseif(of_get_option('font_web')=='20' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Playfair Display";}';
	elseif(of_get_option('font_web')=='21' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Abril Fatface";}'; 
	elseif(of_get_option('font_web')=='22' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Hammersmith One";}'; 
	elseif(of_get_option('font_web')=='23' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: Raleway;}'; 
	elseif(of_get_option('font_web')=='24' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: "Cabin Sketch";}'; 
	elseif(of_get_option('font_web')=='25' && of_get_option('font_google_web')): echo 'h1, h2, h3, h4, h5, h6{font-family: Cabin;}'; 
	 endif;
echo '</style>';
}
endif;
/*----------*/
/*	 15.6 Google Fonts - links to the source */
/*----------*/
/*********************/
function sketchbook_fonts_css() {
	if (!is_admin()) {
		if(of_get_option('font_web')=='2' ):
		wp_register_style('css_ribeye', 'http://fonts.googleapis.com/css?family=Ribeye+Marrow');
		wp_enqueue_style('css_ribeye');
		
		elseif(of_get_option('font_web')=='3' ):
		wp_register_style('css_lobster', 'http://fonts.googleapis.com/css?family=Lobster&subset=latin,latin-ext,cyrillic');
		wp_enqueue_style('css_lobster');
       
        elseif(of_get_option('font_web')=='4' ):
		wp_register_style('css_abril', 'http://fonts.googleapis.com/css?family=Abril+Fatface&subset=latin,latin-ext');
		wp_enqueue_style('css_abril');
		
		elseif(of_get_option('font_web')=='5' ):		
				wp_register_style('css_open', 'http://fonts.googleapis.com/css?family=Open+Sans:700,400,400italic&subset=latin,cyrillic,vietnamese,cyrillic-ext,greek-ext,greek,latin-ext');
		wp_enqueue_style('css_open');
		
		elseif(of_get_option('font_web')=='6' ):		
				wp_register_style('css_droid', 'http://fonts.googleapis.com/css?family=Droid+Sans');
		wp_enqueue_style('css_droid');
		
		elseif(of_get_option('font_web')=='7' ):		
				wp_register_style('css_oswald', 'http://fonts.googleapis.com/css?family=Oswald');
		wp_enqueue_style('css_oswald');
		
		elseif(of_get_option('font_web')=='8' ):		
				wp_register_style('css_vollkorn', 'http://fonts.googleapis.com/css?family=Vollkorn:400,400italic,700');
		wp_enqueue_style('css_vollkorn');
		
		elseif(of_get_option('font_web')=='9' ):		
				wp_register_style('css_droid_mono', 'http://fonts.googleapis.com/css?family=Droid+Sans+Mono');
		wp_enqueue_style('css_droid_mono');
		
		elseif(of_get_option('font_web')=='10' ):		
				wp_register_style('css_special', 'http://fonts.googleapis.com/css?family=Special+Elite');
		wp_enqueue_style('css_special');
		
		elseif(of_get_option('font_web')=='11' ):		
				wp_register_style('css_old', 'http://fonts.googleapis.com/css?family=Old+Standard+TT:400,700,400italic');
		wp_enqueue_style('css_old');
	
		elseif(of_get_option('font_web')=='12' ):		
				wp_register_style('css_lobster_two', 'http://fonts.googleapis.com/css?family=Lobster+Two');
		wp_enqueue_style('css_lobster_two');
		
		elseif(of_get_option('font_web')=='13' ):		
				wp_register_style('css_maven', 'http://fonts.googleapis.com/css?family=Maven+Pro');
		wp_enqueue_style('css_maven');

		elseif(of_get_option('font_web')=='14' ):		
				wp_register_style('css_bevan', 'http://fonts.googleapis.com/css?family=Bevan');
		wp_enqueue_style('css_bevan');

		elseif(of_get_option('font_web')=='15' ):		
				wp_register_style('css_covered', 'http://fonts.googleapis.com/css?family=Poly:400,400italic');
		wp_enqueue_style('css_covered');
		
		elseif(of_get_option('font_web')=='16' ):		
				wp_register_style('css_lato', 'http://fonts.googleapis.com/css?family=Lato:400italic,400,900');
		wp_enqueue_style('css_lato');
		
		elseif(of_get_option('font_web')=='17' ):		
				wp_register_style('css_gravitas', 'http://fonts.googleapis.com/css?family=Gravitas+One');
		wp_enqueue_style('css_gravitas');
		
		elseif(of_get_option('font_web')=='18' ):		
				wp_register_style('css_pt', 'http://fonts.googleapis.com/css?family=PT+Serif:400,400italic&subset=latin,cyrillic');
		wp_enqueue_style('css_pt');
		
		elseif(of_get_option('font_web')=='19' ):		
				wp_register_style('css_ubuntu', 'http://fonts.googleapis.com/css?family=Ubuntu:400,400italic,700&subset=latin,latin-ext');
		wp_enqueue_style('css_ubuntu');
		
		elseif(of_get_option('font_web')=='20' ):		
				wp_register_style('css_play', 'http://fonts.googleapis.com/css?family=Playfair+Display:400,400italic&subset=latin,latin-ext');
		wp_enqueue_style('css_play');
		
		elseif(of_get_option('font_web')=='21' ):		
				wp_register_style('css_abril', 'http://fonts.googleapis.com/css?family=Abril+Fatface&subset=latin,latin-ext');
		wp_enqueue_style('css_abril');
		
		elseif(of_get_option('font_web')=='22' ):		
				wp_register_style('css_hammer', 'http://fonts.googleapis.com/css?family=Hammersmith+One');
		wp_enqueue_style('css_hammer');
		
		elseif(of_get_option('font_web')=='23' ):		
				wp_register_style('css_uni', 'http://fonts.googleapis.com/css?family=Raleway:100');
		wp_enqueue_style('css_uni');
		
		elseif(of_get_option('font_web')=='24' ):		
				wp_register_style('css_cabins', 'http://fonts.googleapis.com/css?family=Cabin+Sketch:400,700');
		wp_enqueue_style('css_cabins');
		
		elseif(of_get_option('font_web')=='25' ):		
				wp_register_style('css_cabin', 'http://fonts.googleapis.com/css?family=Cabin:400');
		wp_enqueue_style('css_cabin');
		endif;
	}
}
add_action('wp_print_styles', 'sketchbook_fonts_css');	

?>