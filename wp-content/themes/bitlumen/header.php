<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=<?php echo ( bitLumen_get_option( 'content_width' ) + bitLumen_get_option( 'sidebar_width' ) + 33 ); ?>, initial-scale=1, maximum-scale=1" />
<title><?php wp_title( bitLumen_get_option( 'title_sep' ) ); ?></title>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

		<div id="primary-menu" class="wp-nav-menu"><?php bitLumen_nav_menu( 'primary-menu' ); ?></div><!-- /#primary-menu -->

		<div id="container">
			<div id="header">
				<a href="<?php echo home_url( '/' ); ?>" rel="home">
				<div id="masthead">
					<h1 id="site-title"<?php if( get_header_textcolor() == 'blank' ) echo ' class="assistive-text"'; ?>><?php bloginfo( 'name' ); ?></h1>
				
					<?php if( bitLumen_get_option( 'blog_subtitle' ) ) : ?>
					<h2 id="site-description"<?php if( get_header_textcolor() == 'blank' ) echo ' class="assistive-text"'; ?>><?php bloginfo( 'description' ); ?></h2>
					<?php endif; ?>

				<div class="clear"></div>
				</div><!-- /#masthead -->
				</a>
				
		</div><!-- /#header -->
	
	<div id="main">
		<?php if( bitLumen_get_option( 'sidebar_location' ) == 'left' ) get_sidebar(); ?>