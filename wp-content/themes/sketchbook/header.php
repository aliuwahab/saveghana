<!DOCTYPE html>
<html <?php	language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<title><?php wp_title(); ?></title>
		<meta name="viewport" content="width=device-width" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php wp_head(); ?>
</head>
	<body <?php	body_class(); ?>>
		<nav id="nav">
			<div class="container_16">
				<?php wp_nav_menu(array('sort_column' => 'menu_order', 'Primary Navigation', 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'grid_16')); ?>
			<div class="clear"></div>
			</div>
		</nav>
<?php if (function_exists('sketchbook_header'))  sketchbook_header(); ?>	               	