<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php is_front_page() ? bloginfo('name') : wp_title(''); ?></title>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
        <!--[if IE 8 ]>
            <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" />
        <![endif]-->
        <?php 
        wp_head(); 
        ?>
        <!--[if lt IE 9]>
            <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body <?php body_class(); ?>>
        <div id="header<?php
            if (is_front_page()) {
                echo"_frontpage";
            } ?>">
            <?php 
            get_template_part('parts/header', 'contact_line'); 
            get_template_part('parts/header', 'ribbon');
            if (is_front_page()) {
                get_template_part('parts/banner');
            } else { 
                get_template_part('parts/header', 'title');    
            }
            ?>
            <div class="clear"></div>
        </div>
