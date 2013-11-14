<?php 
/*
BitLumen Theme
Settings Functions
*/


/* =SETTINGS
------------------------------------------------------------------------- */

// register theme options
function bitLumen_register_options() {
	register_setting( BITLUMEN_OPTIONS_GROUP, BITLUMEN_OPTIONS_NAME, 'bitLumen_sanatize_input' );
}

// validate/sanatize options input
function bitLumen_sanatize_input( $input ) {
	$types = array();
	$options = array();
	$struct = bitLumen_options_struct();
	$defaults = bitLumen_get_defaults();
	
	// get option types & suboptions
	foreach( $struct as $bundle ) {
		if( array_key_exists( 'id', $bundle ) )
			$types = array_merge( $types, array( $bundle['id'] => $bundle['type'] ) );
		if( array_key_exists( 'options', $bundle ) )
			$options = array_merge( $options, array( $bundle['id'] => $bundle['options'] ) );
	}
	
	// check by type
	foreach( $input as $key => $value ) :

		// check boxes
		if( $types[$key] == 'checkbox' ) :
			$input[$key] = ( $value ? 1 : '' );
		
		// text boxes
		elseif( $types[$key] == 'text' || $types[$key] == 'text-short' || $types[$key] == 'textarea' ) :
			$input[$key] = esc_attr( $value );
		
		// number only textbox
		elseif( $types[$key] == 'text-number' || $types[$key] == 'text-numbers' || $types[$key] == 'text-num' ) :
			$input[$key] = preg_replace( '/[^0-9]/', '', $value );
	
		// radio / select boxes
		elseif( $types[$key] == 'radio' || $types[$key] == 'select' ) :
			if( !array_key_exists( $value, $options[$key] ) )
				$input[$key] = $defaults[$key];
		endif;
	endforeach;
	
	if( $input['content_width'] < 200 ) $input['content_width'] = 200;
	if( $input['sidebar_width'] < 120 ) $input['sidebar_width'] = 120;
	if( $input['content_width'] < 6 ) $input['padding'] = 6;
	
	return $input;
}

// gets array of all theme options
function bitLumen_get_options( $use_global=true ) {
	if( $use_global ) global $bitLumen_options;
	
	if( !isset( $bitLumen_options ) )
		$bitLumen_options = get_option( BITLUMEN_OPTIONS_NAME );
		if( !$bitLumen_options ) 
			$bitLumen_options = bitLumen_get_defaults();
	return $bitLumen_options;
}

// get an option value from the theme's options array
function bitLumen_get_option( $option_slug, $use_global=true ) {
	if( $use_global ) global $bitLumen_options;
	if( !isset( $bitLumen_options ) )
		$bitLumen_options = bitLumen_get_options();
	
	if( !array_key_exists( $option_slug, $bitLumen_options ) ) return false;
	else return $bitLumen_options[$option_slug];
}

// delete theme options
function bitLumen_delete_options() {
	delete_option( BITLUMEN_OPTIONS_NAME );
}

// adds theme options page
function bitLumen_create_menu() {
	add_theme_page( 'bitLumen Theme Options', 'Theme Options', 'edit_theme_options', BITLUMEN_OPTIONS_NAME, 'bitLumen_do_options_page' );
}

// draws options pageadd_action( 'wp_head', 'add_our_scripts',0);
function bitLumen_do_options_page() {
	global $bitLumen_options;
	
	// reset options?
	if( array_key_exists( 'special-action', $_POST ) && $_POST['special-action'] == 'reset' ) : 
		bitLumen_delete_options();
		$bitLumen_options =  bitLumen_get_defaults();
		add_option( BITLUMEN_OPTIONS_NAME, $bitLumen_options );
		bitLumen_settings_message( 'Theme settings restored to default state.' ); 
			
	// echo updated message
	elseif( isset( $_REQUEST['settings-updated'] ) ) :
		bitLumen_settings_message( 'Theme options successfully saved.' ); 
	
	endif;
?>
<!-- begin options page -->
<div class="wrap bitlumen-wrap">
	<?php screen_icon(); ?><h2>BitLumen Theme Options</h2>
	<form method="post" action="options.php">
		<?php settings_fields( BITLUMEN_OPTIONS_GROUP ); ?>
		
<?php 
$struct = bitLumen_options_struct();
foreach( $struct as $item ) :

	// prepare options variables
	unset( $type, $id, $desc, $name, $slug, $option, $notice, $key, $suboption );
	extract( $item ); 

	// fix notice
	if( !isset( $notice ) ) $notice = '';
	
	// if proper option:
	if( isset( $id ) ) :  
		$option = bitLumen_get_option( $id );
		$slug = BITLUMEN_OPTIONS_NAME . '[' . $id . ']'; 
		$name_id = 'name="' . $slug . '" id="' . $slug . '"';
		$label = '<tr>' . "\r\n\t" . '<th scope="row"><label for="' . $slug .'">' . $name . '</label></th>';
		
		// notice and close
		if( isset( $notice ) && !empty( $notice ) ) $notice = '<p class="description">' . $notice . '</p>';
		if( $type != 'checkbox' ) $notice .= '</tr>';
	endif; // endif proper option ?>


	<?php // different options types switch
	switch ( $type ) : 
	

case 'section' : ?>
		<h3 class="title" title="<?php echo $desc; ?>"><?php echo $name; ?></h3>
		<table class="form-table">
		<tbody>
		<?php break; ?>


<?php case 'fieldset' : ?>
		<tr><th scope="row"><label><?php echo $name; ?></label></th>
		<td><fieldset>
		<?php break; ?>				

<?php case 'text' :  echo $label; ?>
		<td><input class="regular-text" <?php echo $name_id; ?> type="text" value="<?php echo esc_attr( $option ); ?>" />
		<?php echo $notice; ?></td>
		<?php break; ?>


<?php case 'text-short' : echo $label; ?>
		<td><input class="small-text" <?php echo $name_id; ?> type="text" value="<?php echo esc_attr( $option ); ?>" />
		<?php echo $notice; ?></td>
		<?php break; ?>

<?php case 'text-numbers' : echo $label; ?>
		<td><input class="small-text" <?php echo $name_id; ?> type="text" value="<?php echo esc_attr( $option ); ?>" />
		<?php echo $notice; ?></td>
		<?php break; ?>


<?php case 'textarea' : echo $label; ?>
		<td><textarea class="large-text code" <?php echo $name_id; ?>><?php echo esc_attr( $option ); ?></textarea>
		
		<?php echo $notice; ?></td>
		<?php break; ?>
	
	
<?php case 'select' : echo $label; ?>
		<td><select <?php echo $name_id; ?>>

			<?php foreach( $options as $suboption ) : if( $option == $suboption ) $selected = 'selected="selected"'; ?>
					<option <?php echo $selected; ?>><?php echo $suboption; ?></option>
			<?php endforeach; ?>

		</select><?php echo $notice; ?></td>
		<?php break; ?>


<?php case "radio" : echo $label; ?>
		<td><fieldset>
		<?php foreach ( $options as $key => $suboption ) : ?>
				<label><input <?php echo $name_id; ?> type="radio" value="<?php echo $key; ?>" <?php checked( $option, $key ); ?> /><?php echo $suboption; ?></label><br />
		<?php endforeach; ?>

		</fieldset><?php echo $notice; ?></td>
		<?php break; ?>


<?php case "checkbox" : ?>
		<label><input <?php echo $name_id; ?> type="checkbox" value="1" <?php checked( $option ); ?> /><?php echo $name; ?></label><br />
		<?php echo $notice; ?>
		<?php break; ?>


<?php case "close-fieldset" : ?>

	</fieldset><?php echo $notice; ?></td>
	<?php break; ?>


<?php case "close" : ?>
	</tbody>
	</table>
	<?php break; ?>

<?php endswitch; ?>
<?php endforeach; ?>

	<div class="submit bitlumen-submit-div">
		<input class="button button-primary" type="submit" name="save" value="Save Changes" />
	</div>
	</form>
	
	<form action="" method="post">
		<input type="hidden" name="special-action" value="reset" />
	<div class="submit bitlumen-submit-div">
		<input class="button button-primary bitlumen-submit" type="submit" name="reset" value="Reset" />
	</div>
	</form>

</div><!-- /.wrap -->

<?php 
}

// gets array of default theme options
function bitLumen_get_defaults() {
	$struct = bitLumen_options_struct();
	$defaults = array();
	
	foreach( $struct as $bundle )
		if( array_key_exists( 'id', $bundle ) )
			$defaults = array_merge( $defaults, array( $bundle['id'] => $bundle['default'] ) );
	return $defaults;
}

// options structure
function bitLumen_options_struct() {
	$output = array (
	
		// POST INFORMATION
		array( 
			'type' => 'section',
			'name' => 'Post Information', 
			'desc' => 'Set the post information shown at the top of each post' ),
	
		// show authors
		array( 
			'id' => 'entry_post_author',
			'type' => 'radio',
			'name' => 'Post Author',
			'desc' => 'Display post author name or link',			
			'options' => array(
				'none' => 'Don\'t display any author information', 
				'text' => 'Display name as text', 
				'link' => 'Display name as link to author page' ),
			'default' => 'link' ),
	
		// show post date
		array( 
			'id' => 'entry_post_date',
			'type' => 'radio',
			'name' => 'Post date',
			'desc' => 'Display the date when each post or page was last created/updated',
			'options' => array( 
				'none' => 'Don\'t display any post date', 
				'created' => 'Display date post was first published', 
				'updated' => 'Display date post was last updated' ),			
			'default' => 'created' ),
			
		// additional post options fieldset
		array(
			'type' => 'fieldset',
			'name' => 'Additional Post Options',
			'desc' => 'More settings for post meta information' ),

		// show post times
		array( 
			'id' => 'entry_post_time',
			'type' => 'checkbox',
			'name' => 'Include the time in post date',
			'desc' => 'Display the date when each post or page was last created/updated',
			'default' => '' ),
		
		// hide edit link
		array( 
			'id' => 'entry_edit_link',
			'type' => 'checkbox',
			'name' => 'Include "edit post" link for administrators',
			'desc' => 'Show the edit post link to logged in admin users',
			'default' => 1 ),
		
		// hide trash link
		array( 
			'id' => 'entry_trash_link',
			'type' => 'checkbox',
			'name' => 'Include "trash post" link for administrators',
			'desc' => 'Show a trash post link to logged in admin users',
			'default' => '' ),
		
		array( 'type' => 'close-fieldset' ),
		
		array( 'type' => 'close' ),


		// SITE TEXT		
		array( 
			'type' => 'section',
			'name' => 'Site text',
			'desc' => 'Custom text used on your site' ),

		// header fieldset
		array(
			'type' => 'fieldset',
			'name' => 'Header',
			'desc' => 'Text settings for the site header' ),

		// subtitle
		array(
			'id' => 'blog_subtitle',
			'type' => 'checkbox',
			'name' => 'Show blog description under title in the header',
			'desc' => 'Should the description be shown under the title in the header',
			'notice' => 'This option is ignored if &ldquo;Show header text with your image&rdquo; is unchecked on the <a href="' . admin_url(  'themes.php?page=custom-header ') . '">Header</a> options page.',
			'default' => 1 ),
		
		// close fieldset header	
		array( 'type' => 'close-fieldset' ),

		// title separator		
		array( 
			'id' => 'title_sep',
			'type' => 'text-short',
			'name' => 'Title Separator',
			'desc' => 'The character used to seperate pieces of information in the title',
			'default' => '&raquo;' ),
		
		array( 
			'id' => 'entry_meta_sep',
			'type' => 'text-short',
			'name' => 'Post Meta Separator',
			'desc' => 'The character used to seperate text or links in the post information',
			'default' => '|' ),
			
		array( 
			'id' => 'footer_sep',
			'type' => 'text-short',
			'name' => 'Footer Seperator',
			'desc' => 'The character used to seperate strings of text or links in the footer.',
			'default' => '|' ),
		
		array( 
			'id' => 'keep_reading_text',
			'type' => 'text',
			'name' => '&ldquo;Continue Reading&rdquo; Text',
			'desc' => 'The text used for the &ldquo;continue reading&rdquo; link when using the &lt;--more--&gt; tag.',
			'default' => 'Keep reading' ),
		
	array( 'type' => 'close' ),
	
	// META TAGS	
		array( 
			'type' => 'section',
			'name' => 'Meta Tags',
			'desc' => 'HTML meta tag settings' ),
	
	// meta descriptions
	
	// meta desc fieldset
		array(
			'type' => 'fieldset',
			'name' => 'Meta Descriptions',
			'desc' => '' ),
			
		array( 
			'id' => 'meta_descriptions',
			'type' => 'checkbox',
			'name' => 'Insert meta descriptions',
			'desc' => 'Insert the description meta tag if provided for a post or page.',
			'default' => 1 ),

		array( 'type' => 'close-fieldset' ),
	
		array( 'type' => 'close' ),
	
	// SITE LAYOUT		
		array( 
			'type' => 'section',
			'name' => 'Site Layout',
			'desc' => 'Styling and layout settings' ),
			
		// web fonts
		array( 
			'id' => 'web_fonts',
			'type' => 'radio',
			'name' => 'Web Fonts',
			'desc' => 'Use local or remote web fonts, or web safe fonts.',			
			'options' => array(
				'none' => 'Don\'t use web fonts', 
				'local' => 'Use local web fonts', 
				'remote' => 'Use remote Google Web Fonts' ),
			'default' => 'local',
			'notice' => 'The &ldquo;local web fonts&rdquo; option uses the same web fonts as Google, but uses locally hosted files included in the theme instead of those on Google\'s servers.' ),
		
		// sidebar location
		array( 
			'id' => 'sidebar_location',
			'type' => 'radio',
			'name' => 'Sidebar Location',
			'desc' => 'Left or right floated sidebar.',			
			'options' => array(
				'left' => 'Left', 
				'right' => 'Right' ), 
			'default' => 'right' ),
		
		// content width
		array( 
			'id' => 'content_width',
			'type' => 'text-numbers',
			'name' => 'Content Width (in pixels)',
			'desc' => 'How many pixels wide the main content area should be?',
			'default' => 700 ),
		
		// sidebar width
		array( 
			'id' => 'sidebar_width',
			'type' => 'text-numbers',
			'name' => 'Sidebar Width (in pixels)',
			'desc' => 'How many pixels wide the sidebar should be?',
			'default' => 180 ),
		
		// padding
		array( 
			'id' => 'padding',
			'type' => 'text-numbers',
			'name' => 'Padding (in pixels)',
			'desc' => 'How many pixels of space should the content and sidebar be from the edges of the layout?',
			'default' => 6 ),
				
		array( 'type' => 'close' ),
		
		// NAVIGATION
		array( 
			'type' => 'section',
			'name' => 'Navigation',
			'desc' => 'Navigation and menu options' ),
		
		// adminbar fieldset
		array(
			'type' => 'fieldset',
			'name' => 'Admin Bar',
			'desc' => 'Options for changing the WP-Admin Bar' ),
			
		array( 
			'id' => 'wpadminbar_theme_options',
			'type' => 'checkbox',
			'name' => 'Add theme options link to admin bar',
			'desc' => 'Adds a link to this options page along with the other theme modification links.',
			'default' => 1 ),

		array( 'type' => 'close-fieldset' ),
		
		
		array( 'type' => 'close' ),
		
	);

	return $output; 
}

// returns dynamic style sheet options struct
function bitLumen_get_dynamic_options( $urlencode_and_serialize=false ) {
	$output = array(
		'src' => get_header_image(),
		'height' => get_custom_header()->height,
		'width' => get_custom_header()->width,
		'text_color' => get_header_textcolor(),
		'bg_color' => get_background_color(),
		'web_fonts' => bitLumen_get_option( 'web_fonts' ),
		'content_width' => bitLumen_get_option( 'content_width' ),
		'sidebar_width' => bitLumen_get_option( 'sidebar_width' ),
		'sidebar_location' => bitLumen_get_option( 'sidebar_location' ),
		'padding' => bitLumen_get_option( 'padding' )
	);
	
	if( $urlencode_and_serialize ) return urlencode( serialize( $output ) );
	else return $output;
}

// ACTIONS
add_action( 'admin_init', 'bitLumen_register_options' ); // register theme settings
add_action( 'admin_menu', 'bitLumen_create_menu' ); // add link to settings