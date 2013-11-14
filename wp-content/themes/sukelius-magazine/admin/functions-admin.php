<?php
/**
 * Creates theme settings
 *
 * @package Sukelius
 * @subpackage Functions
 * @link http://themehybrid.com/hybrid-core/features/theme-settings
 * @since 0.1.0
 */

add_action( 'admin_menu', 'sukelius_theme_admin_setup' );

function sukelius_theme_admin_setup() {

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Create a settings meta box only on the theme settings page. */
	add_action( 'load-appearance_page_theme-settings', 'sukelius_theme_settings_meta_boxes' );

	/* Add a filter to validate/sanitize your settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'sukelius_theme_validate_settings' );
}

/* Adds custom meta boxes to the theme settings page. */
function sukelius_theme_settings_meta_boxes() {
	
	/* Add a custom meta box. */
	add_meta_box(
		'tb-theme-meta-box',			// Custom meta box ID
		__( 'General Settings', 'sukelius-magazine' ),	// Custom label
		'sukelius_layout',			// Custom callback function
		'appearance_page_theme-settings',		// Page to load on, leave as is
		'normal',					// normal / advanced / side
		'high'					// high / low
	);	
	
	/* Add a custom meta box. */
	add_meta_box(
		'tb-theme-meta-box-social',			// Custom meta box ID
		__( 'Social Networks', 'sukelius-magazine' ),	// Custom label
		'sukelius_social',			// Custom callback function
		'appearance_page_theme-settings',		// Page to load on, leave as is
		'normal',					// normal / advanced / side
		'high'					// high / low
	);
	
	/* Add additional add_meta_box() calls here. */
}

/* Function for default layout. */
function sukelius_layout() {

	/* Get theme layouts. */
	$sukelius_supported_layouts = get_theme_support( 'theme-layouts' );
	$sukelius_layouts = $sukelius_supported_layouts[0]; // Array of all layouts without the 'layout-' prefix. ?>

	<table class="form-table">
		
		<!-- Global Layout -->
		<tr>
			<th>
			    <label for="<?php echo esc_attr( hybrid_settings_field_id( 'sukelius_global_layout' ) ); ?>"><?php _e( 'Global Layout:', 'sukelius-magazine' ); ?></label>
			</th>
			<td>
			    <select id="<?php echo esc_attr( hybrid_settings_field_id( 'sukelius_global_layout' ) ); ?>" name="<?php echo esc_attr( hybrid_settings_field_name( 'sukelius_global_layout' ) ); ?>">
					<option value="layout-default" <?php selected( hybrid_get_setting( 'sukelius_global_layout' ), 'layout-default' ); ?>> <?php echo esc_html( theme_layouts_get_string( 'default' ) ); ?> </option>
					<?php
					foreach ( $sukelius_layouts as $sukelius_layout ) { ?>
						<option value="<?php echo esc_attr( "layout-{$sukelius_layout}" ); ?>" <?php selected( hybrid_get_setting( 'sukelius_global_layout' ), "layout-{$sukelius_layout}" ); ?>> <?php echo esc_html( theme_layouts_get_string( $sukelius_layout ) ); ?> </option>
					<?php } ?>
			    </select>
			    <p><span class="description"><?php _e( 'Set the layout for the entire site. The default layout is 2 columns with content on the left. You can overwrite this value in individual post or page. Note! Three column layouts will only work if you use Primary and Secondary Widget areas and browser window is wide enough.', 'sukelius-magazine' ); ?></span></p>
			</td>
		</tr>
		
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'slider_display' ); ?>"><?php _e( 'Show content slider?', 'sukelius-magazine' ); ?></label>
			</th>

			<td>
				<p><input id="slider_show" name="<?php echo hybrid_settings_field_name( 'slider_display' ); ?>" type="checkbox" value="0" <?php checked( hybrid_get_setting( 'slider_display' ), 1 ); ?> /> <?php _e( 'Check this box to enable content slider', 'sukelius-magazine' ); ?></p>
				<p><span class="description"><?php _e( 'To add posts to content slider - just make them "sticky", and set featured image (940x385) for that post. After you upload image, select <b>sukelius-slider-image</b> under <b>Sizes:</b> in uploader. If image is bigger, theme will resize it.', 'sukelius-magazine' ); ?></span></p>
			</td>
		</tr>		
		
		<!-- End custom form elements. -->
	</table><!-- .form-table -->		
	
<?php }		


/* Function for displaying the meta box. */
function sukelius_social() { ?>

	<table class="form-table">
		<!-- Add custom form elements below here. -->
		
		<tr>
			<th>
				<b><?php _e( 'Note:', 'sukelius-magazine'); ?></b>
			</th>
			<td>
				<p><?php _e( 'You can add links to your online social profiles like Twitter, Facebook, Pinterest and RSS link. Please include <b>http://</b>  to all URL\'s.', 'sukelius-magazine'); ?></p>
			</td>
		</tr>
		
 		<!-- Facebook input box -->
 		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'sukelius_input_facebook' ); ?>"><?php _e( 'Facebook URL:', 'sukelius-magazine' ); ?></label>
			</th>
			<td>
				<p><input type="text" id="<?php echo hybrid_settings_field_id( 'sukelius_input_facebook' ); ?>" name="<?php echo hybrid_settings_field_name( 'sukelius_input_facebook' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'sukelius_input_facebook' ) ); ?>" /></p>
				<p><?php _e( 'Enter your Facebook Page URL', 'sukelius-magazine' ); ?></p>
			</td>
		</tr>		
		
		<!-- Twitter input box -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'sukelius_input_twitter' ); ?>"><?php _e( 'Twitter URL:', 'sukelius-magazine' ); ?></label>
			</th>
			<td>
				<p><input type="text" id="<?php echo hybrid_settings_field_id( 'sukelius_input_twitter' ); ?>" name="<?php echo hybrid_settings_field_name( 'sukelius_input_twitter' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'sukelius_input_twitter' ) ); ?>" /></p>
				<p><?php _e( 'Enter your Twitter ID', 'sukelius-magazine' ); ?></p>
			</td>
		</tr>

		<!-- Pinterest input box -->
 		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'sukelius_input_pinterest' ); ?>"><?php _e( 'Pinterest URL:', 'sukelius-magazine' ); ?></label>
			</th>
			<td>
				<p><input type="text" id="<?php echo hybrid_settings_field_id( 'sukelius_input_pinterest' ); ?>" name="<?php echo hybrid_settings_field_name( 'sukelius_input_pinterest' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'sukelius_input_pinterest' ) ); ?>" /></p>
				<p><?php _e( 'Enter your Pinterest URL', 'sukelius-magazine' ); ?></p>
			</td>
		</tr>
		
 		<!-- RSS input box -->
 		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'sukelius_input_rss' ); ?>"><?php _e( 'RSS URL:', 'sukelius-magazine' ); ?></label>
			</th>
			<td>
				<p><input type="text" id="<?php echo hybrid_settings_field_id( 'sukelius_input_rss' ); ?>" name="<?php echo hybrid_settings_field_name( 'sukelius_input_rss' ); ?>" value="<?php echo esc_attr( hybrid_get_setting( 'sukelius_input_rss' ) ); ?>" /></p>
				<p><?php _e( 'Enter RSS URL', 'sukelius-magazine' ); ?></p>
			</td>
		</tr>		
		
		<!-- End custom form elements. -->
	</table><!-- .form-table --><?php
}



/* Validates theme settings. */
function sukelius_theme_validate_settings( $input ) {

	/* Validate and/or sanitize the textarea. */
	$input['slider_display']     = ( isset( $input['slider_display'] ) ? 1 : 0 );
		
	$input['sukelius_global_layout'] = wp_filter_nohtml_kses( $input['sukelius_global_layout'] );	
	$input['sukelius_input_twitter'] = wp_filter_nohtml_kses( $input['sukelius_input_twitter'] );
	$input['sukelius_input_facebook'] = wp_filter_nohtml_kses( $input['sukelius_input_facebook'] );
	$input['sukelius_input_pinterest'] = wp_filter_nohtml_kses( $input['sukelius_input_pinterest'] );
	$input['sukelius_input_rss'] = wp_filter_nohtml_kses( $input['sukelius_input_rss'] );

	/* Return the array of theme settings. */
	return $input;
}

?>