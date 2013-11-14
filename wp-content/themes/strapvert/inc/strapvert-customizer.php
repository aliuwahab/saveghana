<?php

function strapvert_custom_customize_register($wp_customize) {
   $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
   $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
   $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
   
   // Sitewide General Settings
   $wp_customize->add_section( 'strapvert_general_options' , array(
		'title'      => __('Sitewide General Options','strapvert'),
		'priority'   => 30,
   ) );
   // Setting group for header
   $wp_customize->add_section( 'strapvert_header_options' , array(
		'title'      => __('Logo Options','strapvert'),
		'priority'   => 31,
   ) );
   
   $wp_customize->add_section( 'strapvert_featured_options' , array(
		'title'      => __('Front Page Content Options','strapvert'),
		'priority'   => 32,
   ) );
      
   // Setting group for social icons
   $wp_customize->add_section( 'strapvert_social_options' , array(
		'title'      => __('Social Options','strapvert'),
		'priority'   => 36,
   ) );
   
   $wp_customize->add_section( 'strapvert_footer_options' , array(
		'title'      => __('Footer Options','strapvert'),
		'priority'   => 37,
   ) );

/**
 * Lets begin adding our own settings and controls for this theme
 * Plus organize it in sequence in each setting group with a priority level
 */
		
	// Begin General Settings
	$wp_customize->add_setting(
		'strapvert_layout'
    );

    $wp_customize->add_control(
		'strapvert_layout',
    array(
        'type'     => 'checkbox',
        'label'    => __('Switch Sidebar to the left?', 'strapvert'),
        'section'  => 'strapvert_general_options',
		'priority' => 2,
        )
    );
	
	$wp_customize->add_setting(
		'strapvert_page_title_visibility'
    );

    $wp_customize->add_control(
		'strapvert_page_title_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide Title On Pages?', 'strapvert'),
        'section'  => 'strapvert_general_options',
		'priority' => 3,
        )
    );
	
	$wp_customize->add_setting(
		'strapvert_single_thumb_visibility'
    );

    $wp_customize->add_control(
		'strapvert_single_thumb_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide Thumbnails On Single Post?', 'strapvert'),
        'section'  => 'strapvert_general_options',
		'priority' => 4,
        )
    );
	
	$wp_customize->add_setting(
		'strapvert_attachment_commentform_visibility'
    );

    $wp_customize->add_control(
		'strapvert_attachment_commentform_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide Comment Form on the Attachment page', 'strapvert'),
        'section'  => 'strapvert_general_options',
		'priority' => 5,
        )
    );
	
	// === Begin nav Section Extra Options === //
	$wp_customize->add_setting(
		'strapvert_topmenu_visibility'
    );
	
	$wp_customize->add_control(
		'strapvert_topmenu_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Disable Top Navbar?', 'strapvert'),
        'section' => 'nav',
		'priority' => 1,
        )
    );
	
	// === Begin The Logo Section === //
	
    //  Logo Image Upload
    $wp_customize->add_setting('header_logo_image', array(
        'default-image'  => get_template_directory_uri() . '/img/logo.png',
		'type'           => 'theme_mod',
        'capability'     => 'edit_theme_options',
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'header_logo_image', array(
        'label'    => __('Header Logo Image', 'strapvert'),
        'section'  => 'strapvert_header_options',
		'priority' => 1,
        'settings' => 'header_logo_image',
    )));
	
	$wp_customize->add_setting(
        'strapvert_tagline_visibility'
    );

    $wp_customize->add_control(
        'strapvert_tagline_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Show Tagline below Site Title/Logo?', 'strapvert'),
        'section'  => 'strapvert_header_options',
		'priority' => 2,
        )
    );
		
	// Begin Front Page Content Section
	$wp_customize->add_setting(
        'strapvert_featured_visibility'
    );

    $wp_customize->add_control(
        'strapvert_featured_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Hide The Entire Featured Section?', 'strapvert'),
        'section' => 'strapvert_featured_options',
		'priority' => 1,
        )
    );
	
	$wp_customize->add_setting(
    'strapvert_top_featured_visibility'
    );

    $wp_customize->add_control(
        'strapvert_top_featured_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Hide The Top Featured Section Only?', 'strapvert'),
        'section' => 'strapvert_featured_options',
		'priority' => 2,
        )
    );
	
	$wp_customize->add_setting(
        'strapvert_secondary_featured_visibility'
    );

    $wp_customize->add_control(
        'strapvert_secondary_featured_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Hide Secondary Featured Section Only?', 'strapvert'),
        'section' => 'strapvert_featured_options',
		'priority' => 3,
        )
    );
	
	$wp_customize->add_setting(
        'strapvert_home_content_visibility'
    );

    $wp_customize->add_control(
        'strapvert_home_content_visibility',
    array(
        'type'     => 'checkbox',
        'label'    => __('Hide Page Content on front? Default is "Show" - This will also hide the sidebar', 'strapvert'),
        'section'  => 'strapvert_featured_options',
		'priority' => 4,
        )
    );
	
	$wp_customize->add_setting(
        'strapvert_featured_first_banner_visibility'
    );

    $wp_customize->add_control(
        'strapvert_featured_first_banner_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Hide Featured Banner On Main Featured Post? (Refresh required)', 'strapvert'),
        'section' => 'strapvert_featured_options',
		'priority' => 5,
        )
    );
	
	$wp_customize->add_setting(
        'strapvert_featured_secondary_banner_visibility'
    );

    $wp_customize->add_control(
        'strapvert_featured_secondary_banner_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Hide Featured Banner On Secondary Rows? (Refresh required)', 'strapvert'),
        'section' => 'strapvert_featured_options',
		'priority' => 6,
        )
    );
	
	$wp_customize->add_setting(
        'strapvert_featured_number',
    array(
        'default' => '5',
    ));
	
	$wp_customize->add_control(
        'strapvert_featured_number',
    array(
        'label' => __('Number of Featured posts i.e 9, 13, 17','strapvert'),
        'section' => 'strapvert_featured_options',
		'priority' => 7,
        'type' => 'text',
    ));
	
	// Featured Section Order By.
	$wp_customize->add_setting( 'strapvert_featured_orderby', array(
		'default' => 'none',
	) );
	
	$wp_customize->add_control( 'strapvert_featured_orderby', array(
    'label'   => __( 'Featured Content Order By', 'strapvert' ),
    'section' => 'strapvert_featured_options',
	'priority' => 8,
    'type'    => 'radio',
        'choices' => array(
            'none'             => __( 'Oldest First', 'strapvert' ),
			'rand'             => __( 'Random Sticky Posts', 'strapvert' ),
			'date'             => __( 'Order By Date - Newest First', 'strapvert' ),
        ),
    ));
	    		
	// == Social Links Icons Section == //
    // Begin Header Social Icons	
	$wp_customize->add_setting(
        'strapvert_social_visibility'
    );

    $wp_customize->add_control(
        'strapvert_social_visibility',
    array(
        'type' => 'checkbox',
        'label' => __('Show Social Icons?','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 10,
        )
    );
	$wp_customize->add_setting(
        'strapvert_facebook_url',
    array(
        'default' => '',
    ));
	
	$wp_customize->add_control(
        'strapvert_facebook_url',
    array(
        'label' => __('Facebook URL','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 11,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'strapvert_gplus_url',
    array(
        'default' => '',
    ));
	
	$wp_customize->add_control(
        'strapvert_gplus_url',
    array(
        'label' => __('Google+ URL','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 12,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'strapvert_twitter_url',
    array(
        'default' => '',
    ));
	
	$wp_customize->add_control(
        'strapvert_twitter_url',
    array(
        'label' => __('Twitter URL','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 13,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'strapvert_pinterest_url',
    array(
        'default' => '',
    ));
	
	$wp_customize->add_control(
        'strapvert_pinterest_url',
    array(
        'label' => __('Pinterest URL','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 14,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'strapvert_linkedin_url',
    array(
        'default' => '',
    ));
	
	$wp_customize->add_control(
        'strapvert_linkedin_url',
    array(
        'label' => __('LinkedIn URL','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 15,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'strapvert_youtube_url',
    array(
        'default' => '',
    ));
	
	$wp_customize->add_control(
        'strapvert_youtube_url',
    array(
        'label' => __('YouTube URL','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 16,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'strapvert_flicker_url',
    array(
        'default' => '',
    ));
	
	$wp_customize->add_control(
        'strapvert_flicker_url',
    array(
        'label' => __('Flicker URL','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 17,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'strapvert_wordpress_url',
    array(
        'default' => '',
    ));
	
	$wp_customize->add_control(
        'strapvert_wordpress_url',
    array(
        'label' => __('WordPress URL','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 18,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'strapvert_github_url',
    array(
        'default' => '',
    ));
	
	$wp_customize->add_control(
        'strapvert_github_url',
    array(
        'label' => __('GitHub URL','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 19,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
        'strapvert_dribbble_url',
    array(
        'default' => '',
    ));
	
	$wp_customize->add_control(
		'strapvert_dribbble_url',
    array(
        'label' => __('Dribbble URL','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 20,
        'type' => 'text',
    ));
	
	$wp_customize->add_setting(
		'strapvert_rss_url'
    );

    $wp_customize->add_control(
		'strapvert_rss_url',
    array(
        'type' => 'checkbox',
        'label' => __('Use Default RSS Feed url?', 'strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 21,
        )
    );
	
	$wp_customize->add_setting(
		'strapvert_custom_rss_url',
    array(
        'default' => '',
    ));
	
	$wp_customize->add_control(
		'strapvert_custom_rss_url',
    array(
        'label' => __('Alternative Custom RSS Feed URL - leave blank if above default url checked!','strapvert'),
        'section' => 'strapvert_social_options',
		'priority' => 22,
        'type' => 'text',
    ));
}
add_action( 'customize_register', 'strapvert_custom_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function strapvert_customize_preview_js() {
	wp_enqueue_script( 'strapvert_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'strapvert_customize_preview_js' );

if ( get_theme_mod( 'strapvert_featured_first_banner_visibility' ) != 0 ) { 
function strapvert_featured_first_custom_css() {
?>             
<style>
.featured-content .has-post-thumbnail .entry-thumbnail:before {
   display: none;
}
</style>
<?php }
 
} else {
function strapvert_featured_first_custom_css() { ?>             
<style>
	.featured-content .has-post-thumbnail .entry-thumbnail:before {
	background: url( get_template_directory() . '/img/featured.png' ) center center no-repeat;
	z-index: 999;
	}
</style>
<?php }
}
add_action('wp_head', 'strapvert_featured_first_custom_css');

if ( get_theme_mod( 'strapvert_featured_secondary_banner_visibility' ) != 0 ) { 
function strapvert_featured_secondary_custom_css() {
?>             
<style>
	.featured-content-secondary .has-post-thumbnail .entry-thumbnail:before {
	display: none;
	}
</style>
<?php }
 
} else {
function strapvert_featured_secondary_custom_css() { ?>             
<style>
	.featured-content-secondary .has-post-thumbnail .entry-thumbnail:before {
	background: url( get_template_directory() . '/img/featured.png' ) center center no-repeat;
	z-index: 999;
	}
</style>
<?php }
}
add_action('wp_head', 'strapvert_featured_secondary_custom_css');