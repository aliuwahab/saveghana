<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other templates call it 
 * somewhere near the top of the file. It is used mostly as an opening wrapper, which is closed with the 
 * footer.php file. It also executes key functions needed by the theme, child themes, and plugins. 
 *
 * @package Sukelius
 * @subpackage Template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php hybrid_document_title(); ?></title>

<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); // wp_head ?>
	
</head>

<body class="<?php hybrid_body_class(); ?>">

	<?php do_atomic( 'open_body' ); // sukelius_open_body ?>

	<div id="container">

		<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

		<?php do_atomic( 'before_header' ); // sukelius_before_header ?>
		
		<div id="header">

			<?php do_atomic( 'open_header' ); // sukelius_open_header ?>		
		
			<div class="wrap">

				<div id="branding">
					<?php hybrid_site_title(); ?>
					<?php hybrid_site_description(); ?>
				</div><!-- #branding -->

				<?php get_sidebar( 'header' ); // Loads the sidebar-header.php template. ?>

				<?php do_atomic( 'header' ); // sukelius_header ?>

			</div><!-- .wrap -->
				
			<?php do_atomic( 'close_header' ); // sukelius_close_header ?>				
				
		</div><!-- #header -->
		
		<?php do_atomic( 'after_header' ); // sukelius_after_header ?>		

		<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>
	
		<?php if ( ( is_home() || is_front_page() )&& !is_paged() ) get_template_part( 'slider' ); // Loads slider.php template ?>

		<?php do_atomic( 'before_main' ); // sukelius_before_main ?>
		
		<div id="main">

			<div class="wrap">
				
			<?php do_atomic( 'open_main' ); // sukelius_open_main ?>				
				