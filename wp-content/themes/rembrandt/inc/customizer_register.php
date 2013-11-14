<?php
function rembrandt_custom_register($wp_customize){
    //  =============================
    //  = Color Link              =
    //  =============================
    $wp_customize->add_setting('link_color', array(
        'default'           => '#dd3333',
        'sanitize_callback' => 'sanitize_hex_color'
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label'    => __('Link Color', 'rembrandt'),
        'section' => 'colors',
        'settings' => 'link_color'
    )));
    //  =============================
    //  = Logo            =
    //  =============================
    $wp_customize->add_setting('link_logo', array(
        'capability'        => 'edit_theme_options',
    ));
    
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'link_logo', array(
        'label' => __('Logo', 'rembrandt'),
        'section' => 'header_image',
        'settings' => 'link_logo'
    )));
}
add_action('customize_register', 'rembrandt_custom_register');
/**************************************************************************************************/
function rembrandt_fonts_register($wp_customize){ 
    $wp_customize->add_section('rembrandt_scheme', array(
        'title'    => __('Fonts', 'rembrandt'),
        'priority' => 125,
    ));

    //  =============================
    //  = text font               =
    //  =============================
     $wp_customize->add_setting('text_font', array(
        'default'        => 'Georgia',
        'capability'     => 'edit_theme_options'
    ));
    $wp_customize->add_control( 'txt_font', array(
        'settings' => 'text_font',
        'label'   =>  __('Select Text Font:', 'rembrandt'),
        'section' => 'rembrandt_scheme',
        'type'    => 'select',
        'choices' => array(
        'Times New Roman' => 'Times New Roman', 
        "Cambria" => "Cambria", 
        "Palatino Linotype" => "Palatino Linotype", 
        "Georgia" => "Georgia", 
        "Helvetica Arial" => "Helvetica Arial", 
        "Verdana" => "Verdana" 
        )   
    ));
    //  =============================
    //  = header font                =
    //  =============================
     $wp_customize->add_setting('header_font', array(
        'default'        => 'Georgia',
        'capability'     => 'edit_theme_options'
    ));
    $wp_customize->add_control( 'header_font', array(
        'settings' => 'header_font',
        'label'   =>  __('Select Header Font:', 'rembrandt'),
        'section' => 'rembrandt_scheme',
        'type'    => 'select',
        'choices'    =>  array(
    'Times New Roman' => 'Times New Roman',
    'Cambria' => 'Cambria',
    'Palatino Linotype' => 'Palatino Linotype',
    'Georgia' => 'Georgia',
    'Helvetica Arial' => 'Helvetica Arial',
    'Verdana' => 'Verdana',
    'Open Sans' => 'Open Sans (Latin Extended, Cyrillic, Greek, Vietnamese)',
    'Droid Sans' => 'Droid Sans',
    'Droid Serif' => 'Droid Serif',
    'Oswald' => 'Oswald (Latin Extended)',
    'Ubuntu' => 'Ubuntu (Latin Extended, Cyrillic, Greek)',
    'PT Sans' => 'PT Sans (Latin Extended, Cyrillic)',
    'PT Serif' => 'PT Serif (Cyrillic)',
    'Arvo' => 'Arvo',
    'Lato' => 'Lato',
    'Source Sans Pro' => 'Source Sans Pro (Latin Extended)',
    'Signika' => 'Signika (Latin Extended)',
    'Vollkorn' => 'Vollkorn',
    'Old Standard TT' => 'Old Standard TT',
    'Cutive' => 'Cutive (Latin Extended)',
    'Amaranth' => 'Amaranth',
    'Merriweather' => 'Merriweather',
    'Abril Fatface' => 'Abril Fatface (Latin Extended)',
    'Sansita One' => 'Sansita One'
    )
    ));
    //  =============================
    //  = Select a language                =
    //  =============================
     $wp_customize->add_setting('header_ext', array(
        'default'        => 'Latin',
        'capability'     => 'edit_theme_options'
    ));
    $wp_customize->add_control( 'header_ext', array(
        'settings' => 'header_ext',
        'label'   =>  __('Add language:', 'rembrandt'),
        'section' => 'rembrandt_scheme',
        'type'    => 'radio',
        'choices'    =>  array(
    'Latin' => 'Latin',
    'Cyrillic' => 'Cyrillic',
    'Greek' => 'Greek',
    'Vietnamese' => 'Vietnamese'
    )
    ));
}
add_action('customize_register', 'rembrandt_fonts_register');
/**************************************************************************************************/
function rembrandt_layout_register($wp_customize){
    
    $wp_customize->add_section('rembrandt_layout', array(
        'title'    => __('Gallery', 'rembrandt'),
        'priority' => 163,
    ));
    //  =============================
    //  = lightbox            =
    //  =============================
     $wp_customize->add_setting('layout_lightbox', array(
        'default'        => 'example1',
        'capability'     => 'edit_theme_options'
    ));
    $wp_customize->add_control( 'layout_lightbox', array(
        'settings' => 'layout_lightbox',
        'label'   =>  __('Select Lightbox Theme:', 'rembrandt'),
        'section' => 'rembrandt_layout',
        'type'    => 'radio',
        'choices' => array( 
        "disabled" => "Disabled", 
        "example1" => "Example 1", 
        "example2" => "Example 2", 
        "example3" => "Example 3", 
        "example4" => "Example 4", 
        "example5" => "Example 5" 
        )       
    ));

}
add_action('customize_register', 'rembrandt_layout_register');
/**************************************************************************************************/    
/**************************************************************************************************/
/**********
* @note: credit goes to TwentyTwelve theme.***********/
function rembrandt_g_fonts() {
        $header_font = get_theme_mod('header_font');
        $header_lang = get_theme_mod('header_ext');
                
        if ( 'Latin' == $header_lang )
        $subsets = 'latin,latin-ext';
        elseif ( 'Cyrillic' == $header_lang )
            $subsets = 'latin,cyrillic,cyrillic-ext';
        elseif ( 'Greek' == $header_lang )
            $subsets = 'latin,greek,greek-ext';
        elseif ( 'Vietnamese' == $header_lang )
            $subsets = 'latin,vietnamese';

        $protocol = is_ssl() ? 'https' : 'http';

switch ($header_font) {
case 'Open Sans':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Open+Sans:400,400italic,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Droid Sans':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Droid+Sans:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Droid Serif':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Droid+Serif:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Oswald':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Oswald:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Ubuntu':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Ubuntu:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'PT Sans':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'PT+Sans', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'PT Serif':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'PT+Serif', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Arvo':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Arvo', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Lato':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Lato:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Source Sans Pro':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Source+Sans+Pro:400,700', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Signika':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Signika', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Vollkorn':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Volkhov:400,400italic', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Old Standard TT':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Old+Standard+TT:400,400italic', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Cutive':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Cutive', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Amaranth':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Amaranth', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Merriweather':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Merriweather', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Abril Fatface':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Abril+Fatface', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
case 'Sansita One':
wp_enqueue_style( 'typo-fonts', add_query_arg( array('family' => 'Sansita+One', 'subset' => $subsets), "$protocol://fonts.googleapis.com/css" ), array(), null );
break;
    }
}
add_action( 'wp_enqueue_scripts', 'rembrandt_g_fonts' );
/**************************************************************************************************/
/**************************************************************************************************/
function rembrandt_wp_head() {
    $color_link = get_theme_mod('link_color','#dd3333');
    
if ( $color_link) {
   echo '<style>';
   echo ' a { color: ' . $color_link . ' }';
   echo '</style>';
}
}
add_action('wp_head', 'rembrandt_wp_head');
 /**************************************************************************************************/
function rembrandt_body_classes($classes) {
        $header_logo = get_theme_mod('link_logo');
        $header_font = get_theme_mod('header_font','Georgia');        
        $txt_font = get_theme_mod('text_font','Georgia');
 
 if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
$classes[] = 'single-author';
if ( is_singular() && ! is_home())
$classes[] = 'singular';    
if (is_active_sidebar('first-footer-widget-area') || is_active_sidebar('second-footer-widget-area'))
$classes[] = 'footer-widget';
else
$classes[] = 'footer-no-widget';
           
    if ($header_logo ) :
        $classes[] = 'logo';
    endif;
   if ($txt_font ) {
       $stringtxt = mb_strtolower($txt_font, 'utf-8');
       $classes[] = str_replace( " ","-",$stringtxt ).'-txt';
   } 
   if ($header_font) {
       $stringheader = mb_strtolower($header_font, 'utf-8');
       $classes[] = str_replace( " ","-",$stringheader ).'-header';
   }    
        return $classes;
    }

    add_filter('body_class', 'rembrandt_body_classes'); 
/*********************/ 
function rembrandt_customize() {
    add_theme_page( 'Customize', __('Customize', 'rembrandt'), 'edit_theme_options', 'customize.php' );
}
add_action ('admin_menu', 'rembrandt_customize');
?>