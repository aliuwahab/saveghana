<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
    $font_select_header = array("one" => "Georgia","two" =>"Helvetica, Arial");
    $font_select_web = array("1" => "None", "2" => "Ribeye Marrow - Latin","3" => "Lobster - latin, latin-ext, cyrillic", "12" => "Lobster Two - Latin", "4" => "Abril Fatface - latin, latin-ext", "5" => "Open Sans - latin, cyrillic, vietnamese, cyrillic-ext, greek-ext, greek, latin-ext", "6" => "Droid Sans - Latin", "9" => "Droid Sans Mono - Latin", "7" => "Oswald - Latin", "8" => "Vollkorn - Latin",  "10" => "Special Elite - Latin", "11" => "Old Standard TT - Latin", "13" => "Maven Pro - Latin", "14" => "Bevan - Latin", "15" => "Poly - Latin","16" => "Lato - Latin","17" => "Gravitas One - Latin","18" => "PT Serif - Latin, Cyrillic","19" => "Ubuntu - Latin, latin-ex","20" => "Playfair Display - latin, latin-ext","21" => "Abril Fatface - latin, latin-ext","22" => "Hammersmith One - latin","23" => "Raleway - latin","24" => "Cabin Sketch - latin","25" => "Cabin - latin");

	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[0] = 'All';
		$options_categories[1] = 'Sticky Post';
		$options_categories[2] = 'Post Format - Aside';
		$options_categories[3] = 'Post Format - Image';
		$options_categories[4] = 'Post Format - Gallery';
		$options_categories[5] = 'Post Format - Link';
		$options_categories[6] = 'Post Format - Quote';
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}		
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';
		
	$options = array();
		
	$options[] = array( "name" => __( 'Primary settings', 'sketchbook' ),
						"type" => "heading");
						
	$options[] = array( "name" => __( 'Custom Logo', 'sketchbook' ),
						"desc" => __( 'If you want to add a logo instead of the text in the Web title, you should add it by uploader and then you should place url address of the picture into the next text file. The width of the picture should not be more than 380px, a lucent file .PNG. is recommended.', 'sketchbook' ),
						"id" => "logo_img",
						"type" => "upload");
						
	$options[] = array( "name" => __( 'Custom Favicon', 'sketchbook' ),
						"desc" => __( 'If you want to add "Favicon" (a picture which is in breadcrumb bar browser), you can use the website which was resulted from the picture. <strong>http://www.genfavicon.com/</strong> 
						<strong>http://www.degraeve.com/favicon</strong>', 'sketchbook' ),
						"id" => "favicon_img",
						"type" => "upload");
						
   $options[] = array( "name" => __( 'Custom Avatar', 'sketchbook' ),
						"desc" => __( 'If you want to change a default avatar into your own, add the picture (max100x100px), then go into Settings>Discussion and activate it.', 'sketchbook' ),
						"id" => "avatar_img",
						"type" => "upload");
											
	$options[] = array( "name" => __( 'Featured posts slider', 'sketchbook' ),
						"desc" => __( 'Enable homepage featured posts slider.', 'sketchbook' ),
						"id" => "slide",
						"type" => "checkbox");
	
	$options[] = array( "name" => __( 'Select a category', 'sketchbook' ),
						"desc" => __( 'Choose the category which must be displayed as an order.', 'sketchbook' ),
						"id" => "slide_select",
						"std" => "one",
						"class" => "hidden",
						"options" => $options_categories,
						"type" => "select");
						
	$options[] = array( "name" => __( 'Choose the effect (Slide, Fade)', 'sketchbook' ),
						"id" => "slide_effect",
						"std" => "one",
						"class" => "hidden",
						"options" => array("one" => "Fade","two" => "Slide"),
						"type" => "radio");
						
						
	$options[] = array( "name" => __( 'Slider autorotation', 'sketchbook' ),
						"desc" => __( 'Autorotation on', 'sketchbook' ),
						"id" => "slide_play",
						"class" => "hidden",
						"type" => "checkbox");
						
						

	$options[] = array( "name" => __( 'Layout', 'sketchbook' ),
						"type" => "heading");
												
	$options[] = array( "name" => __( 'Breadcrumb', 'sketchbook' ),
						"desc" => __( 'Disable "Breadcrumb".', 'sketchbook' ),
						"id" => "breadcrumb",
						"type" => "checkbox");
																	
	$options[] = array( "name" => __( 'Choose the background for  the main navigation', 'sketchbook' ),
						//"desc" => __( '', 'sketchbook' ),
						"id" => "nav",
						"std" => "none",
						"type" => "images",
						"options" => array(
							'none' => $imagepath . 'nav-none.jpg',
							'black' => $imagepath . 'nav-black.jpg',
							'dark' => $imagepath . 'nav-dark.jpg',
							'white' => $imagepath . 'nav-white-tex.jpg'
							)
						);
						
	$options[] = array( "name" => __( 'Sidebar position', 'sketchbook' ),
						//"desc" => __( 'Choose position', 'sketchbook' ),
						"id" => "sidebar_position",
						"std" => "right",
						"type" => "images",
						"options" => array(
							'right' => $imagepath . '2cr.png',
							'left' => $imagepath . '2cl.png',
							)
						);
						
	$options[] = array( "name" => __( 'Choose the background for the side panel', 'sketchbook' ),
						//"desc" => __( '', 'sketchbook' ),
						"id" => "sidebar",
						"std" => "none",
						"type" => "images",
						"options" => array(
							'none' => $imagepath . 'none.jpg',
							'black' => $imagepath . 'sidebar_black.jpg',
							'brown' => $imagepath . 'sidebar_brown.jpg',
							'dark' => $imagepath . 'sidebar_d.jpg'
							)
						);
						
						
	$options[] = array( "name" => __( 'Choose the background for the container of the web', 'sketchbook' ),
						//"desc" => __( '', 'sketchbook' ),
						"id" => "wrapper",
						"std" => "white",
						"type" => "images",
						"options" => array(
							'white' => $imagepath . 'con_white.jpg',
							'grey' => $imagepath . 'con_grey.jpg',
							'brown' => $imagepath . 'con_brown.jpg')							
						);					
						
	$options[] = array( "name" => __( 'Widgets in the Footer', 'sketchbook' ),
						//"desc" => __( 'Choose position', 'sketchbook' ),
						"id" => "footer_widgets",
						"std" => "two",
						"type" => "images",
						"options" => array(
							'two' => $imagepath . 'f_11.png',
							'threeleft' => $imagepath . 'f_211.png',
							'threeright' => $imagepath . 'f_112.png',
							)
						);

	$options[] = array( "name" => __( 'Content settings', 'sketchbook' ),
						"type" => "heading");						
						
	$options[] = array( "name" => __( 'Social media icon', 'sketchbook' ),
						"desc" => __( 'By choosing this option, you add the icon of social media next to the content of the entry (Google Plus, Twitter, Stumbleupon, Pinterest). If you need to add more "Sexy bookmarks" plug in is recommended.', 'sketchbook' ),
						"id" => "social",
						"type" => "checkbox");
						
	$options[] = array( "name" => __( 'Display the icon of the entry on the web article', 'sketchbook' ),
						"desc" => __( 'By choosing this option you will add  an entry icon inside the post.', 'sketchbook' ),
						"id" => "img_icons",
						"type" => "checkbox");
						
	$options[] = array( "name" => __( 'Comment settings', 'sketchbook' ),
						"desc" => __( 'Choose the style for  link comments, for example "1 Comment".', 'sketchbook' ),
						"id" => "icons_comments",
						"type" => "checkbox");
						
	$options[] = array( "name" => __( 'Display the information about the author', 'sketchbook' ),
						"desc" => __( 'By choosing this option you will display the information about the author of the article on the entry page ( to display the data you must fill in the author profile )', 'sketchbook' ),
						"id" => "author_desc",
						"type" => "checkbox");
						
	$options[] = array( "name" => __( 'An Entry icon link', 'sketchbook' ),
						"desc" => __( 'Choose the place for the entry icon link.', 'sketchbook' ),
						"id" => "img_i_effect",
						"std" => "one",
						"options" => array("one" => "Full size","two" => "Permalink","three" => "None"),
						"type" => "radio");
						
    $options[] = array( "name" => __( 'Disable "Lightbox"', 'sketchbook' ),
						"desc" => __( 'By choosing this option you will on the effects in gallery and single photos.', 'sketchbook' ),
						"id" => "img_lightbox",
						"type" => "checkbox");
						
    $options[] = array( "name" => __( 'Post formats background', 'sketchbook' ),
						"desc" => __( 'Change the colour of the background in the post formats.', 'sketchbook' ),
						"id" => "post_format",
						"std" => "#E0E7EF",
						"type" => "color");
						
												
						
	$options[] = array( "name" => __( 'Colors and Fonts', 'sketchbook' ),
						"type" => "heading");	
						
    $options[] = array( "name" => __( 'Links', 'sketchbook' ),
						"desc" => __( 'Change the colour of the links.', 'sketchbook' ),
						"id" => "links_color",
						"std" => "#AF3E00",
						"type" => "color");
						
	$options[] = array( "name" => __( 'Headers', 'sketchbook' ),
						"desc" => __( 'Change the colour of the headers (h1, h2, h3, h4, h5, h6).', 'sketchbook' ),
						"id" => "headers_color",
						"std" => "#7F7F7F",
						"type" => "color");
						
	$options[] = array( "name" => __( 'Footer', 'sketchbook' ),
						"desc" => __( 'Change the colour of the background in the footer.', 'sketchbook' ),
						"id" => "footer_color",
						"std" => "#D2D5D9",
						"type" => "color");
						
	$options[] = array( "name" => __( 'Choose the type of the front for the text', 'sketchbook' ),
						"desc" => __( 'The default font is "Georgia - 14px, black". *<em>Helvetica is available Only for Mac computer</em>', 'sketchbook' ),
						"id" => "font_type",
						"std" => array('size' => '14px','face' => 'georgia','style' => 'normal','color' => '#000000'),
						"type" => "typography");
						
	$options[] = array( "name" => __( 'Choose the kind of the front for the header', 'sketchbook' ),
						"desc" => __( 'The default font for the headers is "Georgia" this option allow you to change into font sans-serif "Arial".', 'sketchbook' ),
						"id" => "font_type_header",
						"std" => "one",
						"options" => $font_select_header,
						"type" => "radio");

	$options[] = array( "name" => __( 'Google Fonts', 'sketchbook' ),
						"desc" => __( 'If you want to use  non-standard front in the page header, activate the options. In case of other languages before the using of the fonts you should check if the diacritical marks of the language are displayed.', 'sketchbook' ),
						"id" => "font_google_web",				
						"options" => $font_select_web,
						"type" => "checkbox");	
												
	$options[] = array( "name" => __( 'Fonts', 'sketchbook' ),
						"desc" => __( ' All the fonts are from the Google Fonts site.', 'sketchbook' ),
						"id" => "font_web",
						"std" => "1",
						"class" => "hidden",					
						"options" => $font_select_web,
						"type" => "radio");
											
	return $options;
}

