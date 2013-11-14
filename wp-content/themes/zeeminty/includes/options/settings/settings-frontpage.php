<?php
	
	function themezee_sections_frontpage() {
		$themezee_sections = array();
		
		$themezee_sections[] = array('id' => 'themeZee_frontpage_template',
					'name' => __('Activate Frontpage Template', 'zeeMinty_language'));
					
		$themezee_sections[] = array('id' => 'themeZee_frontpage_image',
					'name' => __('Frontpage Image', 'zeeMinty_language'));
					
		$themezee_sections[] = array('id' => 'themeZee_frontpage_intro',
					'name' => __('Frontpage Intro', 'zeeMinty_language'));
					
		$themezee_sections[] = array('id' => 'themeZee_frontpage_widgets',
					'name' => __('Frontpage Widgets', 'zeeMinty_language'));

		return $themezee_sections;
	}
	
	function themezee_settings_frontpage() {
	
		
		### FRONTPAGE Template
		#######################################################################################
		$themezee_settings[] = array('name' => __('Turn on Frontpage Template?', 'zeeMinty_language'),
						'desc' => __('Check this to automatically display the frontpage template on HOME page. You can also manually create a page and select the "Frontpage Template" page template instead of using this option.', 'zeeMinty_language'),
						'id' => 'themeZee_frontpage_activate',
						'std' => 'false',
						'type' => 'checkbox',
						'section' => 'themeZee_frontpage_template');
		
		### FRONTPAGE Image
		#######################################################################################
		$themezee_settings[] = array('name' => __('Frontpage Image Source', 'zeeMinty_language'),
						'desc' => __('Choose which image(s) the frontpage template should display.', 'zeeMinty_language'),
						'id' => 'themeZee_frontpage_image_source',
						'std' => 'upload',
						'type' => 'radio',
						'choices' => array(
									'header' => __('Custom Header Image (from Appearance > Header)', 'zeeMinty_language'),
									'upload' => __('Individual Image uploaded below', 'zeeMinty_language')),
						'section' => 'themeZee_frontpage_image'
						);
		
		$themezee_settings[] = array('name' => __('Frontpage Image', 'zeeMinty_language'),
						'desc' => __('Upload an individual frontpage image here. You have to select "Individual Image" above to display it. Image should be 1920x550 pixels.', 'zeeMinty_language'),
						'id' => 'themeZee_frontpage_image_upload',
						'std' => get_template_directory_uri() . '/images/default-slider-image.jpg',
						'type' => 'image',
						'section' => 'themeZee_frontpage_image');
			
		### FRONTPAGE INTRO
		#######################################################################################							
		$themezee_settings[] = array('name' => __('Frontpage Intro Text', 'zeeMinty_language'),
						'desc' => __('Enter here the Text of the Frontpage Intro.', 'zeeMinty_language'),
						'id' => 'themeZee_frontpage_intro_text',
						'std' => '',
						'type' => 'editor',
						'section' => 'themeZee_frontpage_intro');

		### FRONTPAGE WIDGETS
		#######################################################################################		
		$themezee_settings[] = array('name' => __('About Frontpage Widgets', 'zeeMinty_language'),
						'desc' => __('Please note: You can configure your widgets to be displayed on the frontpage template on <b>Appearance > Widgets</b>.', 'zeeMinty_language'),
						'id' => 'themeZee_frontpage_widgets_info',
						'type' => 'info',
						'std' => '',
						'section' => 'themeZee_frontpage_widgets');
		
		return $themezee_settings;
	}

?>