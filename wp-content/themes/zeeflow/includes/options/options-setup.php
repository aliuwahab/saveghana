<?php
/***
 * Setup Theme Options
 *
 * Includes all settings from the /includes/options/settings/ folder
 * (setting arrays are splitted in multiple files for reasons of clarity)
 *
 * Defines the theme options array containing all tabs, sections and settings.
 * Contain functions to display the welcome screen and sidebar content on options screen.
 *
 */

// Include all Setting Files
require( get_template_directory() . '/includes/options/settings/settings-general.php' );
require( get_template_directory() . '/includes/options/settings/settings-colors.php' );
require( get_template_directory() . '/includes/options/settings/settings-frontpage.php' );


// Creates theme options array with all sections and settings
function themezee_options_array() {

	/* Section and Setting functions come from setting files included above */
	
	$theme_options = array();
	
	$theme_options['general'] = array(
			"name" => __('General', 'zeeFlow_language'),
			"sections" => themezee_sections_general(),
			"settings" => themezee_settings_general());
	
	$theme_options['colors'] = array(
			"name" => __('Colors', 'zeeFlow_language'),
			"sections" => themezee_sections_colors(),
			"settings" => themezee_settings_colors());
			
	$theme_options['frontpage'] = array(
			"name" => __('Front Page', 'zeeFlow_language'),
			"sections" => themezee_sections_frontpage(),
			"settings" => themezee_settings_frontpage());
	
	return $theme_options;
}
	

// Display Sidebar
function themezee_options_sidebar() {
	$theme_data = wp_get_theme(); 
?>
	<div class="zee_options_sidebar">
	
		<dl><dt><h4><?php _e('Theme Data', 'zeeFlow_language'); ?></h4></dt>
			<dd>
				<p><?php _e('Name', 'zeeFlow_language'); ?>: <?php echo $theme_data->Name; ?><br/>
				<?php _e('Version', 'zeeFlow_language'); ?>: <b><?php echo $theme_data->Version; ?></b>
				<a href="<?php echo get_template_directory_uri(); ?>/changelog.txt" target="_blank"><?php _e('(Changelog)', 'zeeFlow_language'); ?></a><br/>
				<?php _e('Author', 'zeeFlow_language'); ?>: <a href="http://themezee.com/" target="_blank">ThemeZee</a><br/>
				</p>
			</dd>
		</dl>
		
		<dl><dt><h4><?php _e('Upgrade', 'zeeFlow_language'); ?> <?php echo $theme_data->Name; ?></h4></dt>
			<dd>
				<ul>
					<li><a href="http://themezee.com/themes/zeeflow/#PROVersion-1" target="_blank"><?php _e('Check out the PRO Version', 'zeeFlow_language'); ?></a></li>
					<li><a href="http://themezee.com/join-the-theme-club/" target="_blank"><?php _e('Join the Theme Club and get Support', 'zeeFlow_language'); ?></a></li>
				</ul>
			</dd>
		</dl>
		
		<dl><dt><h4><?php _e('Help to translate', 'zeeFlow_language'); ?> </h4></dt>
			<dd>
				<p><?php _e('You want to use this WordPress theme in your native language? Then help out to translate it!', 'zeeFlow_language'); ?></p>
				<ul>
					<li><a href="http://translate.themezee.org/projects/zeeflow" target="_blank"><?php _e('Join the Online Translation Project', 'zeeFlow_language'); ?></a></li>
				</ul>
			</dd>
		</dl>
				
		<dl><dt><h4><?php _e('Subscribe Now', 'zeeFlow_language'); ?></h4></dt>
			<dd>
				<p><?php _e('Subscribe now and get informed about each <b>Theme Release</b> from ThemeZee.', 'zeeFlow_language'); ?></p>
				<ul class="subscribe">
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/rss.png"/><a href="http://themezee.com/feed/" target="_blank"><?php _e('RSS Feed', 'zeeFlow_language'); ?></a></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/email.png"/><a href="http://feedburner.google.com/fb/a/mailverify?uri=Themezee" target="_blank"><?php _e('Email Subscription', 'zeeFlow_language'); ?></a></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/twitter.png"/><a href="http://twitter.com/ThemeZee" target="_blank"><?php _e('Follow me on Twitter', 'zeeFlow_language'); ?></a></li>
					<li><img src="<?php echo get_template_directory_uri(); ?>/includes/options/images/facebook.png"/><a href="http://www.facebook.com/ThemeZee" target="_blank"><?php _e('Become a Facebook Fan', 'zeeFlow_language'); ?></a></li>
				</ul>
			</dd>
		</dl>
	</div>
	<div class="clear"></div>
<?php
}


// Display Welcome Page
function themezee_options_welcome_page() { 
	$theme_data = wp_get_theme();
	$pro_url = 'http://themezee.com/themes/zeeflow/';
	$club_url = 'http://themezee.com/join-the-theme-club/';
?>
	<div id="zee_welcome">
		<h3><?php _e('Thank you for installing this theme!', 'zeeFlow_language'); ?></h3>
		<div class="container">
			<h1><?php _e('Welcome to', 'zeeFlow_language'); ?> <?php echo $theme_data->Name; ?></h1>
			<div class="zee_intro">
				<?php _e("First of all, the theme options might alarm you, <b>but don't panic</b>. Everything is organized and documented well enough for you.", 'zeeFlow_language'); ?>
			</div>
		</div>
		<div class="welcome_halfed">
			<div class="welcome_left">
				<h3><?php _e('Want more features?', 'zeeFlow_language'); ?></h3>
				<div class="container">
					<h2><?php _e('Check out', 'zeeFlow_language'); ?> <?php echo $theme_data->Name; ?>Pro</h2>
					<p><?php _e('The <b>PRO Version</b> provide additional features to <b>customize</b> and configure your Theme.', 'zeeFlow_language'); ?></p>
					<p><h4><?php _e('Some Pro Features:', 'zeeFlow_language'); ?></h4>
						<ul>
							<li><?php _e('+ Custom Color Management', 'zeeFlow_language'); ?></li>
							<li><?php _e('+ several Pro Widgets', 'zeeFlow_language'); ?></li>
							<li><?php _e('+ Custom Font Manager', 'zeeFlow_language'); ?></li>
							<li><?php _e('+ Widgetized Footer Area', 'zeeFlow_language'); ?></li>
							<li><?php _e('+ Header Content Area', 'zeeFlow_language'); ?></li>
							<li><?php _e('+ and a lot more..', 'zeeFlow_language'); ?></li>
						</ul>
						<a class="welcome_button" href="<?php echo $pro_url; ?>#PROVersion-1" target="_blank"><?php _e('Learn more about the PRO Version', 'zeeFlow_language'); ?></a>
					</p>
				</div>
			</div>
			<div class="welcome_right">
				<h3><?php _e('Need support?', 'zeeFlow_language'); ?></h3>
				<div class="container">
					<h2><?php _e('Join the Theme Club', 'zeeFlow_language'); ?></h2>
					<p><?php _e('You want <b>top-notch Support</b> for installing and configuring your Theme? Become a <b>Member</b>!', 'zeeFlow_language'); ?></p>
					<p><h4><?php _e('Theme Club Features:', 'zeeFlow_language'); ?></h4>
						<ul>
							<li><?php _e('+ access to the Support Forum at ThemeZee.com', 'zeeFlow_language'); ?></li>
							<li><?php _e('+ download all Pro Themes', 'zeeFlow_language'); ?></li>
							<li><?php _e('+ advanced online Theme Documentation', 'zeeFlow_language'); ?></li>
							<li><?php _e('+ fast and helpful answers to all your questions', 'zeeFlow_language'); ?></li>
						</ul>
						<a class="welcome_button" href="<?php echo $club_url; ?>" target="_blank"><?php _e('Learn more about the Theme Club', 'zeeFlow_language'); ?></a>
					</p>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		
		<h3><?php _e('Not happy with', 'zeeFlow_language'); ?> <?php echo $theme_data->Name; ?>?</h3>
		<div class="container">
		<p><?php _e('ThemeZee.com provide several other <b>free WordPress Themes</b>.', 'zeeFlow_language'); ?>
		<a href="http://themezee.com/themes/" target="_blank"><?php _e('Click here to browse through all of my themes.', 'zeeFlow_language'); ?></a>
		</p>
		</div>
	</div>
<?php
}
?>