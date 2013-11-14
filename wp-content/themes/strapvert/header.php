<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package StrapVert
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
<div class="container">
	<?php do_action( 'before' ); ?>
	<?php if ( get_theme_mod( 'strapvert_topmenu_visibility' ) != 1 ) { ?>
	<div class="page-top"></div>
	<div class="navbar navbar-inverse" id="main-menu">
        <div class="container">
		<div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <!-- Our menu needs to go here -->
			<?php wp_nav_menu( array(
	           'theme_location'		 => 'primary',
			   'container_class' => 'nav-collapse top-collapse',
	           'menu_class'		=>	'nav',
	           'depth'				=>	0,
	           'fallback_cb'		=>	false,
	           'walker'			=>	new StrapVert_Nav_Walker,
	           )); 
            ?>
		  </div><!-- /.navbar-inner -->
		  </div>
    </div><!-- /.navbar -->
	
	<?php } ?>
	<div class="row" id="top-bar">
		<?php if (get_theme_mod( 'header_logo_image' )) : ?>
		<div class="span6 logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_theme_mod( 'header_logo_image' ); ?>"></a>
			<?php if ( get_theme_mod( 'strapvert_tagline_visibility' ) != 0 ) { ?>
			    <h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>
			<?php } ?>
		</div>
		<?php else : ?>
		<div class="span6 logo">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php if ( get_theme_mod( 'strapvert_tagline_visibility' ) != 0 ) { ?>
			    <h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>
			<?php } ?>
		</div>
		
		<?php endif; ?>
		
	    <?php if ( get_theme_mod( 'strapvert_social_visibility' ) != 0 ) { ?>
		    <?php get_template_part( 'social-icons' ); ?>
		<?php } ?>
		
		
	</div>
	<!-- Start of Main Nav Menu section -->
    
	<div class="navbar navbar-inverse" id="main-menu">
        <div class="container">
		<div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".bottom-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <!-- Our menu needs to go here -->
			<?php wp_nav_menu( array(
	           'theme_location'		 => 'secondary',
			   'container_class' => 'nav-collapse bottom-collapse',
	           'menu_class'		=>	'nav',
	           'depth'				=>	0,
	           'fallback_cb'		=>	false,
	           'walker'			=>	new StrapVert_Nav_Walker,
	           )); 
            ?>
		  </div><!-- /.navbar-inner -->
		  </div>
    </div><!-- /.navbar -->
	
    <!-- End Main Nav section -->
</div>
	<div id="main" class="site-main">
<?php if ( is_front_page() ) : ?>
<div class="container clearfix">
	<?php if ( get_theme_mod( 'strapvert_featured_visibility' ) != 1 ) { ?>
    <div class="row" role="main">
	    <?php
	        if ( is_front_page() && ! is_paged() ) // condition should be same as in pre_get_posts
		    get_template_part( 'featured-content' );
        ?>
	</div>
    <hr />
	<?php } ?>
</div>
<?php endif; ?>