<?php
/*
Plugin Name: Captcha
Plugin URI:  http://bestwebsoft.com/plugin/
Description: Plugin Captcha intended to prove that the visitor is a human being and not a spam robot. Plugin asks the visitor to answer a math question.
Author: BestWebSoft
Version: 3.8.7
Author URI: http://bestwebsoft.com/
License: GPLv2 or later
*/

/*  © Copyright 2013  BestWebSoft  ( http://support.bestwebsoft.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
require_once( dirname( __FILE__ ) . '/bws_menu/bws_menu.php' );

if ( ! function_exists( 'add_cptch_admin_menu' ) ) {
	function add_cptch_admin_menu() {
		add_menu_page( 'BWS Plugins', 'BWS Plugins', 'manage_options', 'bws_plugins', 'bws_add_menu_render', WP_CONTENT_URL."/plugins/captcha/images/px.png", 1001); 
		add_submenu_page('bws_plugins', __( 'Captcha Settings', 'captcha' ), __( 'Captcha', 'captcha' ), 'manage_options', "captcha.php", 'cptch_settings_page');

		//call register settings function
		add_action( 'admin_init', 'register_cptch_settings' );
	}
}

/* Function check if plugin is compatible with current WP version  */
if ( ! function_exists ( 'cptch_version_check' ) ) {
	function cptch_version_check() {
		global $wp_version;
		$plugin_data	=	get_plugin_data( __FILE__, false );
		$require_wp		=	"3.0"; /* Wordpress at least requires version */
		$plugin			=	plugin_basename( __FILE__ );
	 	if ( version_compare( $wp_version, $require_wp, "<" ) ) {
			if( is_plugin_active( $plugin ) ) {
				deactivate_plugins( $plugin );
				wp_die( "<strong>" . $plugin_data['Name'] . " </strong> " . __( 'requires', 'captcha' ) . " <strong>WordPress " . $require_wp . "</strong> " . __( 'or higher, that is why it has been deactivated! Please upgrade WordPress and try again.', 'captcha') . "<br /><br />" . __( 'Back to the WordPress', 'captcha') . " <a href='" . get_admin_url( null, 'plugins.php' ) . "'>" . __( 'Plugins page', 'captcha') . "</a>." );
			}
		}
	}
}

// These fields for the 'Enable CAPTCHA on the' block which is located at the admin setting captcha page
$cptch_admin_fields_enable = array (
		array( 'cptch_login_form', __( 'Login form', 'captcha' ), __( 'Login form', 'captcha' ) ),
		array( 'cptch_register_form', __( 'Registration form', 'captcha' ), __( 'Register form', 'captcha' ) ),
		array( 'cptch_lost_password_form', __( 'Reset Password form', 'captcha' ), __( 'Lost password form', 'captcha' ) ),
		array( 'cptch_comments_form', __( 'Comments form', 'captcha' ), __( 'Comments form', 'captcha') ),
		array( 'cptch_hide_register', __( 'Hide CAPTCHA for registered users', 'captcha' ), __( 'Hide CAPTCHA for registered users', 'captcha' ) ),		
);

// These fields for the 'Arithmetic actions for CAPTCHA' block which is located at the admin setting captcha page
$cptch_admin_fields_actions = array (
		array( 'cptch_math_action_plus', __( 'Plus (&#43;)', 'captcha' ), __( 'Plus', 'captcha' ) ),
		array( 'cptch_math_action_minus', __( 'Minus (&minus;)', 'captcha' ), __( 'Minus', 'captcha' ) ),
		array( 'cptch_math_action_increase', __( 'Multiplication (&times;)', 'captcha' ), __( 'Multiply', 'captcha' ) ),
);

// This fields for the 'Difficulty for CAPTCHA' block which is located at the admin setting captcha page
$cptch_admin_fields_difficulty = array (
		array( 'cptch_difficulty_number', __( 'Numbers', 'captcha' ), __( 'Numbers', 'captcha' ) ),
		array( 'cptch_difficulty_word', __( 'Words', 'captcha' ), __( 'Words', 'captcha' ) ),
);

// register settings function
if ( ! function_exists( 'register_cptch_settings' ) ) {
	function register_cptch_settings() {
		global $wpmu, $cptch_options;

		$cptch_option_defaults = array(
			'cptch_login_form'				=> '1',
			'cptch_register_form'			=> '1',
			'cptch_lost_password_form'		=> '1',
			'cptch_comments_form'			=> '1',
			'cptch_hide_register'			=> '1',
			'cptch_contact_form'			=> '0',
			'cptch_math_action_plus'		=> '1',
			'cptch_math_action_minus'		=> '1',
			'cptch_math_action_increase'	=> '1',
			'cptch_label_form'				=> '',
			'cptch_required_symbol'			=> '*',
			'cptch_difficulty_number'		=> '1',
			'cptch_difficulty_word'			=> '1'
		);

		// install the option defaults
		if ( 1 == $wpmu ) {
			if ( !get_site_option( 'cptch_options' ) ) {
				add_site_option( 'cptch_options', $cptch_option_defaults, '', 'yes' );
			}
		} else {
			if ( !get_option( 'cptch_options' ) )
				add_option( 'cptch_options', $cptch_option_defaults, '', 'yes' );
		}

		// get options from the database
		if ( 1 == $wpmu )
			$cptch_options = get_site_option( 'cptch_options' ); // get options from the database
		else
			$cptch_options = get_option( 'cptch_options' );// get options from the database

		// array merge incase this version has added new options
		$cptch_options = array_merge( $cptch_option_defaults, $cptch_options );
	}
}

// Add global setting for Captcha
global $wpmu, $str_key, $cptch_time;
$str_key = "bws_3110013";
$cptch_time = time();

if ( 1 == $wpmu )
   $cptch_options = get_site_option( 'cptch_options' ); // get the options from the database
  else
   $cptch_options = get_option( 'cptch_options' );// get the options from the database

// Add captcha into login form
if ( 1 == $cptch_options['cptch_login_form'] ) {
	add_action( 'login_form', 'cptch_login_form' );
	add_filter( 'login_errors', 'cptch_login_post' );
	add_filter( 'login_redirect', 'cptch_login_check', 10, 3 ); 
}
// Add captcha into comments form
if ( 1 == $cptch_options['cptch_comments_form'] ) {
	global $wp_version;
	if ( version_compare( $wp_version,'3','>=' ) ) { // wp 3.0 +
		add_action( 'comment_form_after_fields', 'cptch_comment_form_wp3', 1 );
		add_action( 'comment_form_logged_in_after', 'cptch_comment_form_wp3', 1 );
	}
	// for WP before WP 3.0
	add_action( 'comment_form', 'cptch_comment_form' );
	add_filter( 'preprocess_comment', 'cptch_comment_post' );	
}
// Add captcha in the register form
if ( 1 == $cptch_options['cptch_register_form'] ) {
	add_action( 'register_form', 'cptch_register_form' );
	add_action( 'register_post', 'cptch_register_post', 10, 3 );
	add_action( 'signup_extra_fields', 'cptch_register_form' );
	add_filter( 'wpmu_validate_user_signup', 'cptch_register_validate' );
}
// Add captcha into lost password form
if ( 1 == $cptch_options['cptch_lost_password_form'] ) {
	add_action( 'lostpassword_form', 'cptch_register_form' );
	add_action( 'lostpassword_post', 'cptch_lostpassword_post', 10, 3 );
}

if ( ! function_exists( 'cptch_plugin_action_links' ) ) {
	function cptch_plugin_action_links( $links, $file ) {
		//Static so we don't call plugin_basename on every plugin row.
		static $this_plugin;
		if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);

		if ( $file == $this_plugin ){
				 $settings_link = '<a href="admin.php?page=captcha.php">' . __( 'Settings', 'captcha' ) . '</a>';
				 array_unshift( $links, $settings_link );
			}
		return $links;
	}
}
// end function cptch_plugin_action_links

if ( ! function_exists( 'cptch_register_plugin_links' ) ) {
	function cptch_register_plugin_links( $links, $file ) {
		$base = plugin_basename(__FILE__);
		if ( $file == $base ) {
			$links[] = '<a href="admin.php?page=captcha.php">' . __( 'Settings', 'captcha' ) . '</a>';
			$links[] = '<a href="http://wordpress.org/extend/plugins/captcha/faq/" target="_blank">' . __( 'FAQ', 'captcha' ) . '</a>';
			$links[] = '<a href="http://support.bestwebsoft.com">' . __( 'Support', 'captcha' ) . '</a>';
		}
		return $links;
	}
}

// Function for display captcha settings page in the admin area
if ( ! function_exists( 'cptch_settings_page' ) ) {
	function cptch_settings_page() {
		global $cptch_admin_fields_enable, $cptch_admin_fields_actions, $cptch_admin_fields_difficulty, $cptch_options;
		$error = "";

		$plugin_info = get_plugin_data( __FILE__ );
		
		// Save data for settings page
		if ( isset( $_REQUEST['cptch_form_submit'] ) && check_admin_referer( plugin_basename(__FILE__), 'cptch_nonce_name' ) ) {
			$cptch_request_options = array();
			
			foreach( $cptch_options as $key => $val ) {
				if ( isset( $_REQUEST[ $key ] ) ) {
					if ( $key == 'cptch_label_form' || $key == 'cptch_required_symbol' )						
						$cptch_request_options[ $key ] = trim( $_REQUEST[ $key ] );
					else
						$cptch_request_options[ $key ] = 1;
				} else {
					if ( $key == 'cptch_label_form' || $key == 'cptch_required_symbol' ) {
						$cptch_request_options['cptch_label_form'] = "";
						$cptch_request_options['cptch_required_symbol'] = "*";
					} else						
						$cptch_request_options[ $key ] = 0;
				}
				if ( isset( $_REQUEST['cptch_contact_form'] ) ) {
					$cptch_request_options['cptch_contact_form'] = $_REQUEST['cptch_contact_form'];
				} else {
					$cptch_request_options['cptch_contact_form'] = 0;
				}
			}

			// array merge incase this version has added new options
			$cptch_options = array_merge( $cptch_options, $cptch_request_options );

			// Check select one point in the blocks Arithmetic actions and Difficulty on settings page
			if ( ( ! isset ( $_REQUEST['cptch_difficulty_number'] ) && ! isset ( $_REQUEST['cptch_difficulty_word'] ) ) || 	
				( ! isset ( $_REQUEST['cptch_math_action_plus'] ) && ! isset ( $_REQUEST['cptch_math_action_minus'] ) && ! isset ( $_REQUEST['cptch_math_action_increase'] ) ) ) {
				$error = __( "Please select one item in the block Arithmetic and Complexity for CAPTCHA", 'captcha' );
			} else {
				// Update options in the database
				update_option( 'cptch_options', $cptch_request_options, '', 'yes' );
				$message = __( "Settings saved.", 'captcha' );
			}
		}
		// Display form on the setting page
		?>
		<div class="wrap">
			<div class="icon32 icon32-bws" id="icon-options-general"></div>
			<h2><?php _e('Captcha Settings', 'captcha' ); ?></h2>
			<div class="updated fade" <?php if( ! isset( $_REQUEST['cptch_form_submit'] ) || $error != "" ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
			<div class="error" <?php if( "" == $error ) echo "style=\"display:none\""; ?>><p><strong><?php echo $error; ?></strong></p></div>
			<form method="post" action="admin.php?page=captcha.php">
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e('Enable CAPTCHA for:', 'captcha' ); ?> </th>
						<td>
					<?php foreach( $cptch_admin_fields_enable as $fields ) { ?>
							<label><input type="checkbox" name="<?php echo $fields[0]; ?>" value="<?php echo $fields[0]; ?>" <?php if( 1 == $cptch_options[$fields[0]] ) echo "checked=\"checked\""; ?> /> <?php echo __( $fields[1], 'captcha' ); ?></label><br />
					<?php }
					if ( ! function_exists( 'is_plugin_active_for_network' ) )
						require_once( ABSPATH . '/wp-admin/includes/plugin.php' );						
					$all_plugins = get_plugins();
					$active_plugins = get_option('active_plugins');
					if ( array_key_exists('contact-form-plugin/contact_form.php', $all_plugins ) || array_key_exists('contact-form-pro/contact_form_pro.php', $all_plugins ) ) {
						if ( 0 < count( preg_grep( '/contact-form-plugin\/contact_form.php/', $active_plugins ) ) || 0 < count( preg_grep( '/contact-form-pro\/contact_form_pro.php/', $active_plugins ) ) ||
							is_plugin_active_for_network( 'contact-form-plugin/contact_form.php' ) || is_plugin_active_for_network( 'contact-form-pro/contact_form_pro.php' ) ) { ?>
							<label><input type="checkbox" name="cptch_contact_form" value="1" <?php if( 1 == $cptch_options['cptch_contact_form'] ) echo "checked=\"checked\""; ?> /> <?php _e( 'Contact form', 'captcha' ); ?></label> <span style="color: #888888;font-size: 10px;">(<?php _e( 'powered by', 'captcha' ); ?> <a href="http://bestwebsoft.com/plugin/">bestwebsoft.com</a>)</span><br />
					<?php } else { ?>
							<label><input disabled='disabled' type="checkbox" name="cptch_contact_form" value="1" <?php if( 1 == $cptch_options['cptch_contact_form'] ) echo "checked=\"checked\""; ?> /> <?php _e( 'Contact form', 'captcha' ); ?></label> <span style="color: #888888;font-size: 10px;">(<?php _e( 'powered by', 'captcha' ); ?> <a href="http://bestwebsoft.com/plugin/">bestwebsoft.com</a>) <a href="<?php echo bloginfo("url"); ?>/wp-admin/plugins.php"><?php _e( 'Activate contact form', 'captcha' ); ?></a></span><br />
						<?php }
					} else { ?>
							<label><input disabled='disabled' type="checkbox" name="cptch_contact_form" value="1" <?php if( 1 == $cptch_options['cptch_contact_form'] ) echo "checked=\"checked\""; ?> /> <?php _e( 'Contact form', 'captcha' ); ?></label> <span style="color: #888888;font-size: 10px;">(<?php _e( 'powered by', 'captcha' ); ?> <a href="http://bestwebsoft.com/plugin/">bestwebsoft.com</a>) <a href="http://bestwebsoft.com/plugin/contact-form-pro/?k=d70b58e1739ab4857d675fed2213cedc&pn=75&v=<?php echo $plugin_info["Version"]; ?>"><?php _e( 'Download contact form', 'captcha' ); ?></a></span><br />
					<?php } ?>
							<span style="color: #888888;font-size: 10px;"><?php _e( 'If you would like to customize this plugin for a custom form, please see', 'captcha' ); ?> <a href="http://bestwebsoft.com/plugin/captcha-plugin/#faq" target="_blank">FAQ</a></span>
						</td>
					</tr>
				</table>
				<table class="form-table bws_pro_version">
					<tr valign="top">
						<th scope="row">
							<strong>Buddypress</strong><br/>
							<?php _e( 'Enable CAPTCHA for:', 'captcha' ); ?>
						</th>
						<td><br/>
							<input disabled='disabled' type="checkbox" name="cptchpr_buddypress_register_form" value="1" /> <label for="cptchpr_buddypress_register_form"><?php _e( 'Registration form', 'captcha' ); ?></label><br />
							<input disabled='disabled' type="checkbox" name="cptchpr_buddypress_comment_form" value="1" /> <label for="cptchpr_buddypress_comment_form"><?php _e( 'Comments form', 'captcha' ); ?></label><br />
							<input disabled='disabled' type="checkbox" name="cptchpr_buddypress_group_form" value="1"  /> <label for="cptchpr_buddypress_group_form"><?php _e( '"Create a Group" form', 'captcha' ); ?></label>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<strong>Contact Form 7</strong><br/>
							<?php _e( 'Enable CAPTCHA:', 'captcha' ); ?>
						</th>
						<td><br/>
							<input disabled='disabled' type="checkbox" name="cptchpr_cf7" value="1" /><br />
						</td>
					</tr>
				</table> 
				<div class="bws_pro_version_tooltip">				
					<?php _e( 'This functionality is available in the Pro version of the plugin. For more details, please follow the link', 'captcha' ); ?> 
					<a href="http://bestwebsoft.com/plugin/captcha-pro/?k=9701bbd97e61e52baa79c58c3caacf6d&pn=75&v=<?php echo $plugin_info["Version"]; ?>" target="_blank" title="Captcha Pro">
						Captcha Pro
					</a>	
				</div>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e( 'Title for CAPTCHA in the form', 'captcha' ); ?></th>
						<td><input type="text" name="cptch_label_form" value="<?php echo stripslashes( $cptch_options['cptch_label_form'] ); ?>" <?php if( 1 == $cptch_options['cptch_label_form'] ) echo "checked=\"checked\""; ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row" style="width:200px;"><?php _e( "Required symbol", 'captcha' ); ?></th>
						<td colspan="2">
							<input type="text" name="cptch_required_symbol" value="<?php echo $cptch_options['cptch_required_symbol']; ?>" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e( 'Arithmetic actions for CAPTCHA', 'captcha' ); ?></th>
						<td>
					<?php foreach( $cptch_admin_fields_actions as $actions ) { ?>
							<div style="float:left; width:150px;clear: both;">
								<label><input type="checkbox" name="<?php echo $actions[0]; ?>" value="<?php echo $cptch_options[$actions[0]]; ?>" <?php if( 1 == $cptch_options[$actions[0]] ) echo "checked=\"checked\""; ?> /> <?php echo __( $actions[1], 'captcha' ); ?></label>
							</div>
							<div class="cptch_help_box">
								<div class="cptch_hidden_help_text" style="display: none;width: auto;"><?php cptch_display_example( $actions[0] ); ?></div>
							</div>							
							<br />
					<?php } ?>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e( 'CAPTCHA complexity level', 'captcha' ); ?></th>
						<td>
					<?php foreach( $cptch_admin_fields_difficulty as $diff ) { ?>
							<div style="float:left; width:150px;clear: both;">
								<label><input type="checkbox" name="<?php echo $diff[0]; ?>" value="<?php echo $cptch_options[$diff[0]]; ?>" <?php if( 1 == $cptch_options[$diff[0]] ) echo "checked=\"checked\""; ?> /> <?php echo __( $diff[1], 'captcha' ); ?></label>
							</div>
							<div class="cptch_help_box">
								<div class="cptch_hidden_help_text" style="display: none;width: auto;"><?php cptch_display_example( $diff[0] ); ?></div>
							</div>
							<br />
					<?php } ?>
						</td>
					</tr>
				</table>    
				<input type="hidden" name="cptch_form_submit" value="submit" />
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" />
				</p>
				<?php wp_nonce_field( plugin_basename(__FILE__), 'cptch_nonce_name' ); ?>
			</form>
		</div>
	<?php } 
}

// this function adds captcha to the login form
if ( ! function_exists( 'cptch_login_form' ) ) {
	function cptch_login_form() {
		if( session_id() == "" )
			@session_start();
		global $cptch_options;
		if ( isset( $_SESSION["cptch_login"] ) ) 
			unset( $_SESSION["cptch_login"] );
		// captcha html - login form
		echo '<p class="cptch_block">';
		if ( "" != $cptch_options['cptch_label_form'] )	
			echo '<label for="cptch_input">'. stripslashes( $cptch_options['cptch_label_form'] ) .'</label><br />';
		if ( isset( $_SESSION['cptch_error'] ) ) {
			echo "<br /><span style='color:red'>". $_SESSION['cptch_error'] ."</span><br />";
			unset( $_SESSION['cptch_error'] );
		}
		echo '<br />';
		cptch_display_captcha();
		echo '</p>
		<br />';
		return true;
	}
} //  end function cptch_login_form

// this function checks captcha posted with a login
if ( ! function_exists( 'cptch_login_post' ) ) {
	function cptch_login_post( $errors ) {
		global $str_key;
		// Delete errors, if they set
		if ( isset( $_SESSION['cptch_error'] ) )
			unset( $_SESSION['cptch_error'] );

		if ( isset( $_REQUEST['action'] ) && 'register' == $_REQUEST['action'] )
			return( $errors );

		// If captcha not complete, return error
		if ( isset( $_REQUEST['cptch_number'] ) && "" ==  $_REQUEST['cptch_number'] ) {	
			return $errors.'<strong>'. __( 'ERROR', 'captcha' ) .'</strong>: '. __( 'Please fill the form.', 'captcha' );
		}

		if ( isset( $_REQUEST['cptch_result'] ) && isset( $_REQUEST['cptch_number'] ) && isset( $_REQUEST['cptch_time'] )
		 && 0 == strcasecmp( trim( decode( $_REQUEST['cptch_result'], $str_key, $_REQUEST['cptch_time'] ) ), $_REQUEST['cptch_number'] ) ) {
			// captcha was matched						
		} else {
			return $errors.'<strong>'. __( 'ERROR', 'captcha' ) .'</strong>: '. __( 'Please enter a valid CAPTCHA value.', 'captcha' );
		}
		return( $errors );
	}
} // end function cptch_login_post

// this function checks the captcha posted with a login when login errors are absent
if ( ! function_exists( 'cptch_login_check' ) ) {
	function cptch_login_check( $url ) {
		global $str_key;
		if( session_id() == "" )
			@session_start();

		// Add error if captcha is empty
		if( isset( $_SESSION["cptch_login"] ) && $_SESSION["cptch_login"] === true )
			return $url;		// captcha was matched						
		if ( ( !isset( $_REQUEST['cptch_number'] ) || "" ==  $_REQUEST['cptch_number'] ) && ! isset( $_SESSION["cptch_login"] ) && isset( $_REQUEST['loggedout'] )) {
			$_SESSION['cptch_error'] = __( 'Please fill the form.', 'captcha' );
			// Redirect to wp-login.php
			wp_clear_auth_cookie();
			return $_SERVER["REQUEST_URI"];
		}
		if ( isset( $_REQUEST['cptch_result'] ) && isset( $_REQUEST['cptch_number'] ) && isset( $_REQUEST['cptch_time'] ) ) {
			if ( 0 == strcasecmp( trim( decode( $_REQUEST['cptch_result'], $str_key, $_REQUEST['cptch_time'] ) ), $_REQUEST['cptch_number'] ) ) {
			 $_SESSION['cptch_login'] = true;
				return $url;		// captcha was matched						
			} else {
				// Add error if captcha is incorrect
				$_SESSION['cptch_error'] = __('Please enter a valid CAPTCHA value.', 'captcha');
				// Redirect to wp-login.php
				$_SESSION['cptch_login'] = false;
				wp_clear_auth_cookie();
				return $_SERVER["REQUEST_URI"];
			}
		} else {
			return $url;		// captcha was matched
		}						
	}
} // end function cptch_login_post

// this function adds captcha to the comment form
if ( ! function_exists( 'cptch_comment_form' ) ) {
	function cptch_comment_form() {
		global $cptch_options;
		// skip captcha if user is logged in and the settings allow
		if ( is_user_logged_in() && 1 == $cptch_options['cptch_hide_register'] ) {
			return true;
		}

		// captcha html - comment form
		echo '<p class="cptch_block">';
		if( "" != $cptch_options['cptch_label_form'] )	
			echo '<label for="cptch_input">'. stripslashes( $cptch_options['cptch_label_form'] ) .'<span class="required"> ' . $cptch_options['cptch_required_symbol'] . '</span></label>';
		echo '<br />';
		cptch_display_captcha();
		echo '</p>';

		return true;
	}
} // end function cptch_comment_form

// this function adds captcha to the comment form
if ( ! function_exists( 'cptch_comment_form_default_wp3' ) ) {
	function cptch_comment_form_default_wp3( $args ) {
		global $cptch_options;

		// skip captcha if user is logged in and the settings allow
		if ( is_user_logged_in() && 1 == $cptch_options['cptch_hide_register'] ) {
			return $args;
		}
		// captcha html - comment form
		$args['comment_notes_after'] .= cptch_custom_form( "" );

		remove_action( 'comment_form', 'cptch_comment_form' );

		return $args;
	}
} // end function cptch_comment_form_default_wp3

// this function adds captcha to the comment form
if ( ! function_exists( 'cptch_comment_form_wp3' ) ) {
	function cptch_comment_form_wp3() {
		global $cptch_options;

		// skip captcha if user is logged in and the settings allow
		if ( is_user_logged_in() && 1 == $cptch_options['cptch_hide_register'] ) {
			return true;
		}

		// captcha html - comment form
		echo '<p class="cptch_block">';
		if( "" != $cptch_options['cptch_label_form'] )	
			echo '<label for="cptch_input">'. stripslashes( $cptch_options['cptch_label_form'] ) .'<span class="required"> ' . $cptch_options['cptch_required_symbol'] . '</span></label>';
		echo '<br />';
		cptch_display_captcha();
		echo '</p>';

		remove_action( 'comment_form', 'cptch_comment_form' );

		return true;
	}
} // end function cptch_comment_form_wp3


// this function checks captcha posted with the comment
if ( ! function_exists( 'cptch_comment_post' ) ) {
	function cptch_comment_post( $comment ) {	
		global $cptch_options;

		if ( is_user_logged_in() && 1 == $cptch_options['cptch_hide_register'] ) {
			return $comment;
		}
	    
		global $str_key;

		// added for compatibility with WP Wall plugin
		// this does NOT add CAPTCHA to WP Wall plugin,
		// it just prevents the "Error: You did not enter a Captcha phrase." when submitting a WP Wall comment
		if ( function_exists( 'WPWall_Widget' ) && isset( $_REQUEST['wpwall_comment'] ) ) {
			// skip capthca
			return $comment;
		}

		// skip captcha for comment replies from the admin menu
		if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'replyto-comment' &&
		( check_ajax_referer( 'replyto-comment', '_ajax_nonce', false ) || check_ajax_referer( 'replyto-comment', '_ajax_nonce-replyto-comment', false ) ) ) {
			// skip capthca
			return $comment;
		}

		// Skip captcha for trackback or pingback
		if ( $comment['comment_type'] != '' && $comment['comment_type'] != 'comment' ) {
							 // skip captcha
							 return $comment;
		}
		
		// If captcha is empty
		if ( isset( $_REQUEST['cptch_number'] ) && "" ==  $_REQUEST['cptch_number'] )
			wp_die( __('Please fill the form.', 'captcha' ) );

		if ( isset( $_REQUEST['cptch_result'] ) && isset( $_REQUEST['cptch_number'] ) && isset( $_REQUEST['cptch_time'] ) && 0 == strcasecmp( trim( decode( $_REQUEST['cptch_result'], $str_key, $_REQUEST['cptch_time'] ) ), $_REQUEST['cptch_number'] ) ) {
			// captcha was matched
			return($comment);
		} else {
			wp_die( __('Error: You have entered an incorrect CAPTCHA value. Click the BACK button on your browser, and try again.', 'captcha'));
		}
	}
} // end function cptch_comment_post

// this function adds the captcha to the register form
if ( ! function_exists( 'cptch_register_form' ) ) {
	function cptch_register_form() {
		global $cptch_options;

		// the captcha html - register form
		echo '<p class="cptch_block" style="text-align:left;">';
		if ( "" != $cptch_options['cptch_label_form'] )	
			echo '<label for="cptch_input">'. stripslashes( $cptch_options['cptch_label_form'] ) .'</label><br />';
		echo '<br />';
		cptch_display_captcha();
		echo '</p>
		<br />';

		return true;
	}
} // end function cptch_register_form

// this function checks captcha posted with registration
if ( ! function_exists( 'cptch_register_post' ) ) {
	function cptch_register_post( $login,$email,$errors ) {
		global $str_key;

		// If captcha is blank - add error
		if ( isset( $_REQUEST['cptch_number'] ) && "" ==  $_REQUEST['cptch_number'] ) {
			$errors->add('captcha_blank', '<strong>'.__('ERROR', 'captcha').'</strong>: '.__('Please fill the form.', 'captcha'));
			return $errors;
		}

		if ( isset( $_REQUEST['cptch_result'] ) && isset( $_REQUEST['cptch_number'] ) && isset( $_REQUEST['cptch_time'] )
		 && 0 == strcasecmp( trim( decode( $_REQUEST['cptch_result'], $str_key, $_REQUEST['cptch_time'] ) ), $_REQUEST['cptch_number'] ) ) {
			// captcha was matched						
		} else {
			$errors->add('captcha_wrong', '<strong>'.__('ERROR', 'captcha').'</strong>: '.__('Please enter a valid CAPTCHA value.', 'captcha'));
		}
		return( $errors );
	}
} // end function cptch_register_post

if ( ! function_exists( 'cptch_register_validate' ) ) {
	function cptch_register_validate( $results ) {
		global $str_key, $current_user;
		if ( ! isset( $current_user->data ) ) {
			// If captcha is blank - add error
			if ( isset( $_REQUEST['cptch_number'] ) && "" == $_REQUEST['cptch_number'] ) {
				$results['errors']->add( 'captcha_blank', '<strong>'   .__( 'ERROR', 'captcha' ) . '</strong>: ' . __( 'Please fill the form.', 'captcha' ) );
				return $results;
			}

			if ( isset( $_REQUEST['cptch_result'] ) && isset( $_REQUEST['cptch_number'] ) && isset( $_REQUEST['cptch_time'] )
				&& 0 == strcasecmp( trim( decode( $_REQUEST['cptch_result'], $str_key, $_REQUEST['cptch_time'] ) ), $_REQUEST['cptch_number'] ) ) {
				// captcha was matched						
			} else {
				$results['errors']->add( 'captcha_wrong', '<strong>' . __( 'ERROR', 'captcha' ) . '</strong>: ' . __( 'Please enter a valid CAPTCHA value.', 'captcha' ) );
			}
			return( $results );
		} else
			return( $results );
	}
} // end function cptch_register_post

// this function checks the captcha posted with lostpassword form
if ( ! function_exists( 'cptch_lostpassword_post' ) ) {
	function cptch_lostpassword_post() {
		global $str_key;

		// If field 'user login' is empty - return
		if( isset( $_REQUEST['user_login'] ) && "" == $_REQUEST['user_login'] )
			return;

		// If captcha doesn't entered
		if ( isset( $_REQUEST['cptch_number'] ) && "" ==  $_REQUEST['cptch_number'] ) {
			wp_die( __( 'Please fill the form.', 'captcha' ) );
		}
		
		// Check entered captcha
		if ( isset( $_REQUEST['cptch_result'] ) && isset( $_REQUEST['cptch_number'] ) && isset( $_REQUEST['cptch_time'] ) 
			&& 0 == strcasecmp( trim( decode( $_REQUEST['cptch_result'], $str_key, $_REQUEST['cptch_time'] ) ), $_REQUEST['cptch_number'] ) ) {
			return;
		} else {
			wp_die( __( 'Error: You have entered an incorrect CAPTCHA value. Click the BACK button on your browser, and try again.', 'captcha' ) );
		}
	}
} // function cptch_lostpassword_post

// Functionality of the captcha logic work
if ( ! function_exists( 'cptch_display_captcha' ) ) {
	function cptch_display_captcha() {
		global $cptch_options, $str_key, $cptch_time;
		
		// In letters presentation of numbers 0-9
		$number_string = array(); 
		$number_string[0] = __( 'zero', 'captcha' );
		$number_string[1] = __( 'one', 'captcha' );
		$number_string[2] = __( 'two', 'captcha' );
		$number_string[3] = __( 'three', 'captcha' );
		$number_string[4] = __( 'four', 'captcha' );
		$number_string[5] = __( 'five', 'captcha' );
		$number_string[6] = __( 'six', 'captcha' );
		$number_string[7] = __( 'seven', 'captcha' );
		$number_string[8] = __( 'eight', 'captcha' );
		$number_string[9] = __( 'nine', 'captcha' ); 
		// In letters presentation of numbers 11 -19
		$number_two_string = array();
		$number_two_string[1] = __( 'eleven', 'captcha' );
		$number_two_string[2] = __( 'twelve', 'captcha' );
		$number_two_string[3] = __( 'thirteen', 'captcha' );
		$number_two_string[4] = __( 'fourteen', 'captcha' );
		$number_two_string[5] = __( 'fifteen', 'captcha' );
		$number_two_string[6] = __( 'sixteen', 'captcha' );
		$number_two_string[7] = __( 'seventeen', 'captcha' );
		$number_two_string[8] = __( 'eighteen', 'captcha' );
		$number_two_string[9] = __( 'nineteen', 'captcha' );
		// In letters presentation of numbers 10, 20, 30, 40, 50, 60, 70, 80, 90
		$number_three_string = array();
		$number_three_string[1] = __( 'ten', 'captcha' );
		$number_three_string[2] = __( 'twenty', 'captcha' );
		$number_three_string[3] = __( 'thirty', 'captcha' );
		$number_three_string[4] = __( 'forty', 'captcha' );
		$number_three_string[5] = __( 'fifty', 'captcha' );
		$number_three_string[6] = __( 'sixty', 'captcha' );
		$number_three_string[7] = __( 'seventy', 'captcha' );
		$number_three_string[8] = __( 'eighty', 'captcha' );
		$number_three_string[9] = __( 'ninety', 'captcha' );
		// The array of math actions
		$math_actions = array();

		// If value for Plus on the settings page is set
		if( 1 == $cptch_options['cptch_math_action_plus'] )
			$math_actions[] = '&#43;';
		// If value for Minus on the settings page is set
		if( 1 == $cptch_options['cptch_math_action_minus'] )
			$math_actions[] = '&minus;';
		// If value for Increase on the settings page is set
		if( 1 == $cptch_options['cptch_math_action_increase'] )
			$math_actions[] = '&times;';
			
		// Which field from three will be the input to enter required value
		$rand_input = rand( 0, 2 );
		// Which field from three will be the letters presentation of numbers
		$rand_number_string = rand( 0, 2 );
		// If don't check Word in setting page - $rand_number_string not display
		if( 0 == $cptch_options["cptch_difficulty_word"])
			$rand_number_string = -1;
		// Set value for $rand_number_string while $rand_input = $rand_number_string
		while($rand_input == $rand_number_string) {
			$rand_number_string = rand( 0, 2 );
		}
		// What is math action to display in the form
		$rand_math_action = rand( 0, count($math_actions) - 1 );

		$array_math_expretion = array();

		// Add first part of mathematical expression
		$array_math_expretion[0] = rand( 1, 9 );
		// Add second part of mathematical expression
		$array_math_expretion[1] = rand( 1, 9 );
		// Calculation of the mathematical expression result
		switch( $math_actions[$rand_math_action] ) {
			case "&#43;":
				$array_math_expretion[2] = $array_math_expretion[0] + $array_math_expretion[1];
				break;
			case "&minus;":
				// Result must not be equal to the negative number
				if($array_math_expretion[0] < $array_math_expretion[1]) {
					$number										= $array_math_expretion[0];
					$array_math_expretion[0]	= $array_math_expretion[1];
					$array_math_expretion[1]	= $number;
				}
				$array_math_expretion[2] = $array_math_expretion[0] - $array_math_expretion[1];
				break;
			case "&times;":
				$array_math_expretion[2] = $array_math_expretion[0] * $array_math_expretion[1];
				break;
		}
		
		// String for display
		$str_math_expretion = "";
		// First part of mathematical expression
		if ( 0 == $rand_input )
			$str_math_expretion .= "<input id=\"cptch_input\" type=\"text\" autocomplete=\"off\" name=\"cptch_number\" value=\"\" maxlength=\"2\" size=\"2\" aria-required=\"true\" required=\"required\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 30px;\" />";
		else if ( 0 == $rand_number_string || 0 == $cptch_options["cptch_difficulty_number"] )
			$str_math_expretion .= $number_string[$array_math_expretion[0]];
		else
			$str_math_expretion .= $array_math_expretion[0];
		
		// Add math action
		$str_math_expretion .= " ".$math_actions[$rand_math_action];
		
		// Second part of mathematical expression
		if ( 1 == $rand_input )
			$str_math_expretion .= " <input id=\"cptch_input\" type=\"text\" autocomplete=\"off\" name=\"cptch_number\" value=\"\" maxlength=\"2\" size=\"2\" aria-required=\"true\" required=\"required\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 30px;\" />";
		else if ( 1 == $rand_number_string || 0 == $cptch_options["cptch_difficulty_number"] )
			$str_math_expretion .= " ".$number_string[$array_math_expretion[1]];
		else
			$str_math_expretion .= " ".$array_math_expretion[1];
		
		// Add =
		$str_math_expretion .= " = ";
		
		// Add result of mathematical expression
		if ( 2 == $rand_input ) {
			$str_math_expretion .= " <input id=\"cptch_input\" type=\"text\" autocomplete=\"off\" name=\"cptch_number\" value=\"\" maxlength=\"2\" size=\"2\" aria-required=\"true\" required=\"required\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 30px;\" />";
		} else if ( 2 == $rand_number_string || 0 == $cptch_options["cptch_difficulty_number"] ) {
			if( $array_math_expretion[2] < 10 )
				$str_math_expretion .= " ".$number_string[$array_math_expretion[2]];
			else if( $array_math_expretion[2] < 20 && $array_math_expretion[2] > 10 )
				$str_math_expretion .= " ".$number_two_string[ $array_math_expretion[2] % 10 ];
			else {
				if ( get_bloginfo( 'language', 'Display' ) == "nl-NL" ) {
					$str_math_expretion .= " ".( 0 != $array_math_expretion[2] % 10 ? $number_string[ $array_math_expretion[2] % 10 ]. __( "and", 'captcha' ) : '').$number_three_string[ $array_math_expretion[2] / 10 ];
				} else {
					$str_math_expretion .= " ".$number_three_string[ $array_math_expretion[2] / 10 ]." ".( 0 != $array_math_expretion[2] % 10 ? $number_string[ $array_math_expretion[2] % 10 ] : '');
				}
			}
		} else {
			$str_math_expretion .= $array_math_expretion[2];
		}
		// Add hidden field with encoding result
		?>
		<input type="hidden" name="cptch_result" value="<?php echo $str = encode( $array_math_expretion[$rand_input], $str_key, $cptch_time ); ?>" />
		<input type="hidden" name="cptch_time" value="<?php echo $cptch_time; ?>" />
		<input type="hidden" value="Version: 2.4" />
		<?php echo $str_math_expretion; ?>
	<?php
	}
}

// Function for encodinf number
if ( ! function_exists( 'encode' ) ) {
	function encode( $String, $Password, $cptch_time ) {
		// Check if key for encoding is empty
		if ( ! $Password ) die ( __( "Encryption password is not set", 'captcha' ) );

		$Salt = md5( $cptch_time, true );
		$String = substr( pack( "H*", sha1( $String ) ), 0, 1 ).$String;
		$StrLen = strlen( $String );
		$Seq = $Password;
		$Gamma	= '';
		while ( strlen( $Gamma ) < $StrLen ) {
				$Seq = pack( "H*", sha1( $Seq . $Gamma . $Salt ) );
				$Gamma.=substr( $Seq, 0, 8 );
		}

		return base64_encode( $String ^ $Gamma );
	}
}

// Function for decoding number
if ( ! function_exists( 'decode' ) ) {
	function decode( $String, $Key, $cptch_time ) {
		// Check if key for encoding is empty
		if ( ! $Key ) die ( __( "Decryption password is not set", 'captcha' ) );

		$Salt = md5( $cptch_time, true );
		$StrLen = strlen( $String );
		$Seq = $Key;
		$Gamma	= '';
		while ( strlen( $Gamma ) < $StrLen ) {
				$Seq = pack( "H*", sha1( $Seq . $Gamma . $Salt ) );
				$Gamma.= substr( $Seq, 0, 8 );
		}

		$String = base64_decode( $String );
		$String = $String^$Gamma;

		$DecodedString = substr( $String, 1 );
		$Error = ord( substr( $String, 0, 1 ) ^ substr( pack( "H*", sha1( $DecodedString ) ), 0, 1 )); 

		if ( $Error ) 
			return false;
		else 
			return $DecodedString;
	}
}

// this function adds captcha to the custom form
if ( ! function_exists( 'cptch_custom_form' ) ) {
	function cptch_custom_form( $error_message ) {
		$cptch_options = get_option( 'cptch_options' );
		$content = "";
		
		// captcha html - login form
		$content .= '<p class="cptch_block" style="text-align:left;">';
		if ( "" != $cptch_options['cptch_label_form'] )	
			$content .= '<label for="cptch_input">'. stripslashes( $cptch_options['cptch_label_form'] ) .'<span class="required"> ' . $cptch_options['cptch_required_symbol'] . '</span></label><br />';
		else
			$content .= '<br />';
		if ( isset( $error_message['error_captcha'] ) ) {
			$content .= "<span class='cptch_error' style='color:red'>". $error_message['error_captcha'] ."</span><br />";
		}
		$content .= cptch_display_captcha_custom();
		$content .= '</p>';
		return $content;
	}
} //  end function cptch_contact_form

// this function check captcha in the custom form
if ( ! function_exists( 'cptch_check_custom_form' ) ) {
	function cptch_check_custom_form() {
		global $str_key;

		if ( isset( $_REQUEST['cntctfrm_contact_action'] ) || isset( $_REQUEST['cntctfrmpr_contact_action'] ) ) {
			// If captcha doesn't entered
			if ( isset( $_REQUEST['cptch_number'] ) && "" ==  $_REQUEST['cptch_number'] ) {
				return false;
			}
			
			// Check entered captcha
			if ( isset( $_REQUEST['cptch_result'] ) && isset( $_REQUEST['cptch_number'] ) && isset( $_REQUEST['cptch_time'] )
				&& 0 == strcasecmp( trim( decode( $_REQUEST['cptch_result'], $str_key, $_REQUEST['cptch_time'] ) ), $_REQUEST['cptch_number'] ) ) {
				return true;
			} else {
				return false;
			}
		} else
			return false;
	}
} //  end function cptch_check_contact_form

// Functionality of the captcha logic work for custom form
if ( ! function_exists( 'cptch_display_captcha_custom' ) ) {
	function cptch_display_captcha_custom() {
		global $cptch_options, $str_key, $cptch_time;
		$content = "";
		
		// In letters presentation of numbers 0-9
		$number_string = array(); 
		$number_string[0] = __( 'zero', 'captcha' );
		$number_string[1] = __( 'one', 'captcha' );
		$number_string[2] = __( 'two', 'captcha' );
		$number_string[3] = __( 'three', 'captcha' );
		$number_string[4] = __( 'four', 'captcha' );
		$number_string[5] = __( 'five', 'captcha' );
		$number_string[6] = __( 'six', 'captcha' );
		$number_string[7] = __( 'seven', 'captcha' );
		$number_string[8] = __( 'eight', 'captcha' );
		$number_string[9] = __( 'nine', 'captcha' ); 
		// In letters presentation of numbers 11 -19
		$number_two_string = array();
		$number_two_string[1] = __( 'eleven', 'captcha' );
		$number_two_string[2] = __( 'twelve', 'captcha' );
		$number_two_string[3] = __( 'thirteen', 'captcha' );
		$number_two_string[4] = __( 'fourteen', 'captcha' );
		$number_two_string[5] = __( 'fifteen', 'captcha' );
		$number_two_string[6] = __( 'sixteen', 'captcha' );
		$number_two_string[7] = __( 'seventeen', 'captcha' );
		$number_two_string[8] = __( 'eighteen', 'captcha' );
		$number_two_string[9] = __( 'nineteen', 'captcha' );
		// In letters presentation of numbers 10, 20, 30, 40, 50, 60, 70, 80, 90
		$number_three_string = array();
		$number_three_string[1] = __( 'ten', 'captcha' );
		$number_three_string[2] = __( 'twenty', 'captcha' );
		$number_three_string[3] = __( 'thirty', 'captcha' );
		$number_three_string[4] = __( 'forty', 'captcha' );
		$number_three_string[5] = __( 'fifty', 'captcha' );
		$number_three_string[6] = __( 'sixty', 'captcha' );
		$number_three_string[7] = __( 'seventy', 'captcha' );
		$number_three_string[8] = __( 'eighty', 'captcha' );
		$number_three_string[9] = __( 'ninety', 'captcha' );
		// The array of math actions
		$math_actions = array();

		// If value for Plus on the settings page is set
		if( 1 == $cptch_options['cptch_math_action_plus'] )
			$math_actions[] = '&#43;';
		// If value for Minus on the settings page is set
		if( 1 == $cptch_options['cptch_math_action_minus'] )
			$math_actions[] = '&minus;';
		// If value for Increase on the settings page is set
		if( 1 == $cptch_options['cptch_math_action_increase'] )
			$math_actions[] = '&times;';
			
		// Which field from three will be the input to enter required value
		$rand_input = rand( 0, 2 );
		// Which field from three will be the letters presentation of numbers
		$rand_number_string = rand( 0, 2 );
		// If don't check Word in setting page - $rand_number_string not display
		if( 0 == $cptch_options["cptch_difficulty_word"])
			$rand_number_string = -1;
		// Set value for $rand_number_string while $rand_input = $rand_number_string
		while($rand_input == $rand_number_string) {
			$rand_number_string = rand( 0, 2 );
		}
		// What is math action to display in the form
		$rand_math_action = rand( 0, count($math_actions) - 1 );

		$array_math_expretion = array();

		// Add first part of mathematical expression
		$array_math_expretion[0] = rand( 1, 9 );
		// Add second part of mathematical expression
		$array_math_expretion[1] = rand( 1, 9 );
		// Calculation of the mathematical expression result
		switch( $math_actions[$rand_math_action] ) {
			case "&#43;":
				$array_math_expretion[2] = $array_math_expretion[0] + $array_math_expretion[1];
				break;
			case "&minus;":
				// Result must not be equal to the negative number
				if($array_math_expretion[0] < $array_math_expretion[1]) {
					$number										= $array_math_expretion[0];
					$array_math_expretion[0]	= $array_math_expretion[1];
					$array_math_expretion[1]	= $number;
				}
				$array_math_expretion[2] = $array_math_expretion[0] - $array_math_expretion[1];
				break;
			case "&times;":
				$array_math_expretion[2] = $array_math_expretion[0] * $array_math_expretion[1];
				break;
		}
		
		// String for display
		$str_math_expretion = "";
		// First part of mathematical expression
		if( 0 == $rand_input )
			$str_math_expretion .= "<input type=\"text\" autocomplete=\"off\" name=\"cptch_number\" value=\"\" maxlength=\"1\" size=\"1\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 30px;\" />";
		else if ( 0 == $rand_number_string || 0 == $cptch_options["cptch_difficulty_number"] )
			$str_math_expretion .= $number_string[$array_math_expretion[0]];
		else
			$str_math_expretion .= $array_math_expretion[0];
		
		// Add math action
		$str_math_expretion .= " ".$math_actions[$rand_math_action];
		
		// Second part of mathematical expression
		if( 1 == $rand_input )
			$str_math_expretion .= " <input type=\"text\" autocomplete=\"off\" name=\"cptch_number\" value=\"\" maxlength=\"1\" size=\"1\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 30px;\" />";
		else if ( 1 == $rand_number_string || 0 == $cptch_options["cptch_difficulty_number"] )
			$str_math_expretion .= " ". $number_string[$array_math_expretion[1]];
		else
			$str_math_expretion .= " ".$array_math_expretion[1];
		
		// Add =
		$str_math_expretion .= " = ";
		
		// Add result of mathematical expression
		if( 2 == $rand_input ) {
			$str_math_expretion .= " <input type=\"text\" autocomplete=\"off\" name=\"cptch_number\" value=\"\" maxlength=\"2\" size=\"1\" style=\"margin-bottom:0;display:inline;font-size: 12px;width: 30px;\" />";
		} else if ( 2 == $rand_number_string || 0 == $cptch_options["cptch_difficulty_number"] ) {
			if( $array_math_expretion[2] < 10 )
				$str_math_expretion .= " ". $number_string[$array_math_expretion[2]];
			else if( $array_math_expretion[2] < 20 && $array_math_expretion[2] > 10 )
				$str_math_expretion .= " ". $number_two_string[ $array_math_expretion[2] % 10 ];
			else {
				if ( get_bloginfo( 'language','Display' ) == "nl-NL" ) {
					$str_math_expretion .= " ".( 0 != $array_math_expretion[2] % 10 ? $number_string[ $array_math_expretion[2] % 10 ] . __( "and", 'captcha' ) : '' ) . $number_three_string[ $array_math_expretion[2] / 10 ];
				} else {
					$str_math_expretion .= " " . $number_three_string[ $array_math_expretion[2] / 10 ]." ".( 0 != $array_math_expretion[2] % 10 ? $number_string[ $array_math_expretion[2] % 10 ] : '');
				}
			}
		} else {
			$str_math_expretion .= $array_math_expretion[2];
		}
		// Add hidden field with encoding result
		$content .= '<input type="hidden" name="cptch_result" value="'.$str = encode( $array_math_expretion[$rand_input], $str_key, $cptch_time ).'" />
		<input type="hidden" name="cptch_time" value="'. $cptch_time.'" />
		<input type="hidden" value="Version: 2.4" />';
		$content .= $str_math_expretion; 
		return $content;
	}
}

if ( ! function_exists( 'cptch_contact_form_options' ) ) {
	function cptch_contact_form_options() {
		if ( function_exists( 'get_plugins' ) ) {
			$all_plugins = get_plugins();
			if ( array_key_exists( 'contact-form-plugin/contact_form.php', $all_plugins ) ) {
				$cptch_options = get_option( 'cptch_options' );
				if ( $cptch_options['cptch_contact_form'] == 1 ) {
					add_filter('cntctfrm_display_captcha', 'cptch_custom_form');
					add_filter('cntctfrm_check_form', 'cptch_check_custom_form');
				} elseif ( $cptch_options['cptch_contact_form'] == 0 ) {
					remove_filter('cntctfrm_display_captcha', 'cptch_custom_form');
					remove_filter('cntctfrm_check_form', 'cptch_check_custom_form');
				}
			} elseif ( array_key_exists( 'contact-form-pro/contact_form_pro.php', $all_plugins ) ) {
				$cptch_options = get_option( 'cptch_options' );
				if ( $cptch_options['cptch_contact_form'] == 1 ) {
					add_filter('cntctfrmpr_display_captcha', 'cptch_custom_form');
					add_filter('cntctfrmpr_check_form', 'cptch_check_custom_form');
				} elseif ( $cptch_options['cptch_contact_form'] == 0 ) {
					remove_filter('cntctfrmpr_display_captcha', 'cptch_custom_form');
					remove_filter('cntctfrmpr_check_form', 'cptch_check_custom_form');
				}
			}
		} else {
			if ( is_multisite() ) {
				$active_plugins = (array) array_keys( get_site_option( 'active_sitewide_plugins', array() ) );
				$active_plugins = array_merge( $active_plugins , get_option('active_plugins') );
			} else {
				$active_plugins = get_option('active_plugins');
			}
			if ( 0 < count( preg_grep( '/contact-form-plugin\/contact_form.php/', $active_plugins ) ) ) { 
				$cptch_options = get_option( 'cptch_options' );
				if( $cptch_options['cptch_contact_form'] == 1) {
					add_filter('cntctfrm_display_captcha', 'cptch_custom_form');
					add_filter('cntctfrm_check_form', 'cptch_check_custom_form');
				}
				else if( $cptch_options['cptch_contact_form'] == 0 ) {
					remove_filter('cntctfrm_display_captcha', 'cptch_custom_form');
					remove_filter('cntctfrm_check_form', 'cptch_check_custom_form');
				}
			} elseif ( 0 < count( preg_grep( '/contact-form-pro\/contact_form_pro.php/', $active_plugins ) ) ) { 
				$cptch_options = get_option( 'cptch_options' );
				if( $cptch_options['cptch_contact_form'] == 1) {
					add_filter('cntctfrmpr_display_captcha', 'cptch_custom_form');
					add_filter('cntctfrmpr_check_form', 'cptch_check_custom_form');
				}
				else if( $cptch_options['cptch_contact_form'] == 0 ) {
					remove_filter('cntctfrmpr_display_captcha', 'cptch_custom_form');
					remove_filter('cntctfrmpr_check_form', 'cptch_check_custom_form');
				}
			}
		}
	}
}

if ( ! function_exists ( 'cptch_plugin_init' ) ) {
	function cptch_plugin_init() {
		// Internationalization, first(!)
		load_plugin_textdomain( 'captcha', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
		// Other init stuff, be sure to it after load_plugins_textdomain if it involves translated text(!)
		load_plugin_textdomain( 'bestwebsoft', false, dirname( plugin_basename( __FILE__ ) ) . '/bws_menu/languages/' ); 
	}
}

if ( ! function_exists ( 'cptch_display_example' ) ) {
	function cptch_display_example( $action ) {
		echo "<div class='cptch_example_fields_actions'>";
		switch( $action ) {
			case "cptch_math_action_plus":
				echo __( 'seven', 'captcha' ) . ' &#43; 1 = <img src="'.plugins_url( 'images/cptch_input.jpg' , __FILE__ ).'" alt="" title="" width="" height="" />';
				break;
			case "cptch_math_action_minus":
				echo __( 'eight', 'captcha' ) . ' &minus; 6 = <img src="'.plugins_url( 'images/cptch_input.jpg' , __FILE__ ).'" alt="" title="" width="" height="" />';
				break;
			case "cptch_math_action_increase":
				echo '<img src="'.plugins_url( 'images/cptch_input.jpg' , __FILE__ ).'" alt="" title="" width="" height="" /> &times; 1 = '. __( 'seven', 'captcha' );
				break;
			case "cptch_difficulty_number":
				echo '5 &minus; <img src="'.plugins_url( 'images/cptch_input.jpg' , __FILE__ ).'" alt="" title="" width="" height="" /> = 1';
				break;
			case "cptch_difficulty_word":
				echo __( 'six', 'captcha' ) . ' &#43; ' . __( 'one', 'captcha' ) . ' = <img src="'.plugins_url( 'images/cptch_input.jpg' , __FILE__ ).'" alt="" title="" width="" height="" />';
				break;
		}
		echo "</div>";
	}
}

if ( ! function_exists ( 'cptch_admin_head' ) ) {
	function cptch_admin_head() {
		wp_register_style( 'cptchStylesheet', plugins_url( 'css/style.css', __FILE__ ) );
		wp_enqueue_style( 'cptchStylesheet' );

		if ( isset( $_REQUEST['page'] ) && 'captcha.php' == $_REQUEST['page'] ) {
			wp_enqueue_script( 'cptch_script', plugins_url( 'js/script.js', __FILE__ ) );
		}

		if ( isset( $_GET['page'] ) && "bws_plugins" == $_GET['page'] )
			wp_enqueue_script( 'bws_menu_script', plugins_url( 'js/bws_menu.js' , __FILE__ ) );
	}
}

if ( ! function_exists ( 'cptch_plugin_banner' ) ) {
	function cptch_plugin_banner() {
		global $hook_suffix;	
		$plugin_info = get_plugin_data( __FILE__ );		
		if ( $hook_suffix == 'plugins.php' ) {              
	       	echo '<div class="updated" style="padding: 0; margin: 0; border: none; background: none;">
	       		<script type="text/javascript" src="' . plugins_url( 'js/c_o_o_k_i_e.js', __FILE__ ).'"></script>
				<script type="text/javascript">		
					(function($){
						$(document).ready(function(){		
							var hide_message = $.cookie("cptch_hide_banner_on_plugin_page");
							if ( hide_message == "true") {
								$(".cptch_message").css("display", "none");
							};
							$(".cptch_close_icon").click(function() {
								$(".cptch_message").css("display", "none");
								$.cookie( "cptch_hide_banner_on_plugin_page", "true", { expires: 32 } );
							});	
						});
					})(jQuery);				
				</script>					                      
				<div class="cptch_message">
					<a class="button cptch_button" target="_blank" href="http://bestwebsoft.com/plugin/captcha-pro/?k=345f1af66a47b233cd05bc55b2382ff0&pn=75&v=' . $plugin_info["Version"] . '">Learn More</a>				
					<div class="cptch_text">
						It’s time to upgrade your <strong>Captcha plugin</strong> to <strong>PRO</strong> version!<br />
						<span>Extend standard plugin functionality with new great options.</span>
					</div> 					
					<img class="cptch_close_icon" title="" src="' . plugins_url( 'images/close_banner.png', __FILE__ ) . '" alt=""/>
					<img class="cptch_icon" title="" src="' . plugins_url( 'images/banner.png', __FILE__ ) . '" alt=""/>	
				</div>  
			</div>';      
		}
	}
}

// Function for delete delete options
if ( ! function_exists ( 'cptch_delete_options' ) ) {
	function cptch_delete_options() {
		delete_option( 'cptch_options' );
		delete_site_option( 'cptch_options' );
	}
}

// adds "Settings" link to the plugin action page
add_filter( 'plugin_action_links', 'cptch_plugin_action_links', 10, 2 );

//Additional links on the plugin page
add_filter( 'plugin_row_meta', 'cptch_register_plugin_links', 10, 2 );

add_action( 'init', 'cptch_plugin_init' );
add_action( 'admin_init', 'cptch_version_check' );
add_action( 'admin_init', 'cptch_plugin_init' );
add_action( 'admin_init', 'cptch_contact_form_options' );
add_action( 'admin_menu', 'add_cptch_admin_menu' );
add_action( 'after_setup_theme', 'cptch_contact_form_options' );

add_action( 'admin_enqueue_scripts', 'cptch_admin_head' );
add_action( 'wp_enqueue_scripts', 'cptch_admin_head' );

add_action('admin_notices', 'cptch_plugin_banner');

register_uninstall_hook( __FILE__, 'cptch_delete_options' );
?>