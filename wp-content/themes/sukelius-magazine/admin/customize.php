<?php
/**
 * Theme customizer settings
 *
 * @package Sukelius
 * @subpackage Functions
 * @since 0.1
 */

/* Register custom sections, settings, and controls. */
add_action( 'customize_register', 'sukelius_customize_register' );

/**
 * Registers custom sections, settings, and controls for the $wp_customize instance.
 *
 * @param object $wp_customize
 * @since 0.1
 */
function sukelius_customize_register( $wp_customize ) {

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Get the default theme settings. */
	$defaults = hybrid_get_default_theme_settings();

	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';

	if ( $wp_customize->is_preview() && ! is_admin() )
		add_action( 'wp_footer', 'sukelius_customize_preview', 21 );
}

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 * Used with blogname and blogdescription.
 *
 * @since 0.1
 */
function sukelius_customize_preview() {
	?>
	<script type="text/javascript">
		wp.customize('blogname',function( value ) {
			value.bind(function(to) {
				jQuery('#site-title span').html(to);
			});
		});
		wp.customize('blogdescription',function( value ) {
			value.bind(function(to) {
				jQuery('#site-description').html(to);
			});
		});
	</script>
	<?php
}

?>
