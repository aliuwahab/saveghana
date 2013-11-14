<?php
	
	function themezee_sections_colors() {
		$themezee_sections = array();
		
		$themezee_sections[] = array('id' => 'themeZee_colors_schemes',
					'name' => __('Predefined Color Schemes', 'zeeMinty_language'));
		
		return $themezee_sections;
	}
	
	function themezee_settings_colors() {
	
		$color_schemes = array(
			'#151515' => __('Black', 'zeeMinty_language'),
			'#0067dd' => __('Blue', 'zeeMinty_language'),
			'#725639' => __('Brown', 'zeeMinty_language'),
			'#777777' => __('Gray', 'zeeMinty_language'),
			'#e07000' => __('Orange', 'zeeMinty_language'),
			'#9215a5' => __('Purple', 'zeeMinty_language'),
			'#dd3333' => __('Red', 'zeeMinty_language'),
			'#008b9b' => __('Teal', 'zeeMinty_language'),
			'default' => __('Standard', 'zeeMinty_language'));
		
		$themezee_settings = array();
	
		### COLOR SETTINGS
		#######################################################################################
							
		$themezee_settings[] = array('name' => __('Set Color Scheme', 'zeeMinty_language'),
						'desc' => __('Please select your color scheme here.', 'zeeMinty_language'),
						'id' => 'themeZee_color_scheme',
						'std' => 'default',
						'type' => 'select',
						'choices' => $color_schemes,
						'section' => 'themeZee_colors_schemes'
						);
		
		return $themezee_settings;
	}

?>