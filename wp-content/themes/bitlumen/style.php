<?php
// FUNCTIONS
function bitLumen_clean_extract( $key, $get_array='css', $do_global_too=true ) {
	// set global array
	global $bitLumen_dynamic_options;
	if( !isset( $bitLumen_dynamic_options ) ) 
		$bitLumen_dynamic_options = unserialize( urldecode( $_GET[$get_array] ) );

	if( !array_key_exists( $key, $bitLumen_dynamic_options ) ) $output = '';
	else $output = strip_tags( $bitLumen_dynamic_options[$key] );
	
	if( $do_global_too ) $bitLumen_dynamic_options[$key] = $output;
	return $output;
}

// OPTIONS
$expected_options = array(
	'bg_color',
	'text_color',
	'src',
	'height',
	'width',
	'web_fonts',
	'content_width',
	'sidebar_width',
	'sidebar_location',
	'padding'
);

// EXTRACT
foreach( $expected_options as $var ) 
	$$var = bitLumen_clean_extract( $var );

// HEADERS
if( empty( $cache_life_minutes ) ) $cache_life_minutes = 60;
$cache_expires = time() + ( $cache_life_minutes * 60 );
$cache_expires = gmdate( 'D, d M Y H:i:s', $cache_expires ) . ' GMT';

header( 'Content-type: text/css' );
header( 'Expires: ' . $cache_expires );
header( 'Pragma: cache' );
header( 'Cache-Control: max-age=' . ( $cache_life_minutes * 60 ) ); 

// start of CSS output?>
@charset "utf-8"
/* 
BitLumen Theme
Dynamically generated style sheet
Cache Expires: <?php echo $cache_expires; ?> 
*/ 

/* =WEB FONTS & STRONG
-------------------------------------------------------------- */
<?php 

// defaults from google fonts
$droid_sans_url = 'http://themes.googleusercontent.com/static/fonts/droidsans/v3/s-BiyweUPV0v-yRb-cjciBsxEYwM7FgeyaSgU71cLG0.woff';
$droid_sans_bold_url = 'http://themes.googleusercontent.com/static/fonts/droidsans/v3/EFpQQyG9GqCrobXxL-KRMQFhaRv2pGgT5Kf0An0s4MM.woff';
$oswald_url = 'http://themes.googleusercontent.com/static/fonts/oswald/v5/-g5pDUSRgvxvOl5u-a_WHw.woff';
$strong_style = 'font-family:"Droid Sans Bold",DroidSans-Bold;';
	
// none
if( $web_fonts == 'none' ) :
	$use_web_fonts = false;
	$body_font = 'Verdana,Geneva,sans-serif';
	$title_font = '"Lucida Sans Unicode","Lucida Grande",sans-serif';
	$strong_style = 'font-weight:bold;';

// local
elseif( $web_fonts == 'local' ) :
	$use_web_fonts = true;
	$body_font = '"Droid Sans",DroidSans,Verdana,Geneva,sans-serif';
	$title_font = 'Oswald,"Lucida Sans Unicode","Lucida Grande",sans-serif';
	$droid_sans_url = 'font/DroidSans.woff';
	$droid_sans_bold_url = 'font/DroidSans-Bold.woff';
	$oswald_url = 'font/Oswald.woff';

// remote
else :
	$use_web_fonts = true;
	$body_font = '"Droid Sans",DroidSans,Verdana,Geneva,sans-serif';
	$title_font = 'Oswald,"Lucida Sans Unicode","Lucida Grande",sans-serif';
endif; ?>

/* WEB FONTS <?php echo ( $use_web_fonts ? '*/ ' : '' ); ?>
@font-face {
  font-family: 'Droid Sans';
  font-style: normal;
  font-weight: 400;
  src: local('Droid Sans'), local('DroidSans'), url('<?php echo $droid_sans_url; ?>') format('woff');
}

@font-face {
  font-family: 'Droid Sans Bold';
  font-style: normal;
  font-weight: 400;
  src: local('Droid Sans Bold'), local('DroidSans-Bold'), url('<?php echo $droid_sans_bold_url; ?>') format('woff');
}

@font-face {
  font-family: 'Oswald';
  font-style: normal;
  font-weight: 400;
  src: local('Oswald'), local('Oswald'), url('<?php echo $oswald_url; ?>') format('woff');
}
<?php echo ( $use_web_fonts ? '' : '*/ ' ); ?>

body {
	font-family:<?php echo $body_font; ?>;
}
.entry-title,
.widget-title {
	font-family:<?php echo $title_font; ?>;
}

/* STRONG ELEMENTS */
strong,
.widget_calendar caption,
.bitLumen-theme,
.entry-content th,
.comment-body th,
.bypostauthor .comment-author .fn {
	<?php echo $strong_style; ?>;
}


/* =CUSTOM HEADER IMAGE
-------------------------------------------------------------- */

html,
body,
#header {
	background-color: #<?php echo $bg_color; ?>;
}

<?php if( !empty( $src ) ) : ?>
#masthead {
	background-image: url( '<?php echo $src; ?>' );
	background-size: <?php echo $width; ?>px <?php echo $height; ?>px;
	background-position: top left;
	background-repeat: no-repeat;
	min-height:  <?php echo $height; ?>px;
}
<?php endif; ?>

#masthead * {
<?php if( empty( $text_color ) || $text_color == 'blank' ) : ?>
	display: none;
<?php else : ?>
	color: #<?php echo $text_color; ?>;
<?php endif; ?>
}

/* =WIDTHS
-------------------------------------------------------------- */
<?php 
	$outside_width = $content_width + $sidebar_width + 5;
	$inside_width = $content_width + $sidebar_width + 1;
	$padded_content_width = $content_width - ( $padding * 2 );
	$padded_sidebar_width = $sidebar_width - ( $padding * 2 );
?>

#container {
	width: <?php echo $outside_width; ?>px;
}
#header {
	width: <?php echo $outside_width; ?>px;
}
#masthead {
	width: <?php echo $outside_width; ?>px;
}
#main {
	width: <?php echo $inside_width // 4 padding sections + 1px inside border + 4px outside border ?>px;
}
#content {
	width: <?php echo ( $padded_content_width ); ?>px;
	<?php if( $sidebar_location == 'right' ) : ?>
	border-right:1px solid #ccc;
	margin-right:-1px;
	<?php elseif( $sidebar_location == 'left' ) : ?>
	border-left:1px solid #ccc;
	margin-left:-1px;
	<?php endif; ?>
}
#content > * {
	max-width:<?php echo ( $padded_content_width ); ?>px;
}
#content img {
	height:auto;
}
#sidebar {
	width: <?php echo ( $padded_sidebar_width ); ?>px;
	<?php if( $sidebar_location == 'right' ) : ?>
	border-left:1px solid #ccc;
	<?php elseif( $sidebar_location == 'left' ) : ?>
	border-right:1px solid #ccc;
	<?php endif; ?>
}