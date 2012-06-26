<?php
/*
 * Theme Settings
 * 
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */
 
add_action( 'admin_menu', 'path_theme_admin_setup' );

function path_theme_admin_setup() {
    
	global $theme_settings_page;
	
	/* Get the theme settings page name */
	$theme_settings_page = 'appearance_page_theme-settings';

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* Create a settings meta box only on the theme settings page. */
	add_action( 'load-appearance_page_theme-settings', 'path_theme_settings_meta_boxes' );

	/* Add a filter to validate/sanitize your settings. */
	add_filter( "sanitize_option_{$prefix}_theme_settings", 'path_theme_validate_settings' );

}

/* Adds custom meta boxes to the theme settings page. */
function path_theme_settings_meta_boxes() {

	/* Add a custom meta box. */
	add_meta_box(
		'path-theme-meta-box-logo',			// Name/ID
		__( 'Logo Upload', 'path' ),		// Label
		'path_theme_meta_box_logo',			// Callback function
		'appearance_page_theme-settings',	// Page to load on, leave as is
		'normal',							// Which meta box holder?
		'high'								// High/low within the meta box holder
	);
	
	/* Add a custom meta box. */
	add_meta_box(
		'path-theme-meta-box-background',	// Name/ID
		__( 'Background', 'path' ),			// Label
		'path_theme_meta_box_background',	// Callback function
		'appearance_page_theme-settings',	// Page to load on, leave as is
		'normal',							// Which meta box holder?
		'high'								// High/low within the meta box holder
	);
	
	/* Add a custom meta box. */
	add_meta_box(
		'path-theme-meta-box-layout',		// Name/ID
		__( 'Layout', 'path' ),				// Label
		'path_theme_meta_box_layout',		// Callback function
		'appearance_page_theme-settings',	// Page to load on, leave as is
		'normal',							// Which meta box holder?
		'high'								// High/low within the meta box holder
	);	

	/* Add additional add_meta_box() calls here. */
}

/* Function for displaying the logo meta box. */
function path_theme_meta_box_logo() { ?>

	<table class="form-table">

		<!-- Featured Slider -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'path_custom_logo' ); ?>"><?php _e( 'Custom logo:', 'path' ); ?></label>
			</th>
			<td>
				<p><?php printf( __( 'Want to replace or remove default logo? <a href="%s">Go to Appearance &gt;&gt; Header</a>. ', 'path' ), admin_url( 'themes.php?page=custom-header' ) ); ?></p>
			</td>
		</tr>

		<!-- End custom form elements. -->
	</table><!-- .form-table --><?php
	
}

/* Function for displaying the background meta box. */
function path_theme_meta_box_background() { ?>

	<table class="form-table">

		<!-- Featured Slider -->
		<tr>
			<th>
				<label for="<?php echo hybrid_settings_field_id( 'path_custom_background' ); ?>"><?php _e( 'Custom background:', 'path' ); ?></label>
			</th>
			<td>
				<p><?php printf( __( 'Want to replace or remove default background? <a href="%s">Go to Appearance &gt;&gt; Background</a>. ', 'path' ), admin_url( 'themes.php?page=custom-background' ) ); ?></p>
			</td>
		</tr>

		<!-- End custom form elements. -->
	</table><!-- .form-table --><?php
	
}

/* Function for displaying the layout meta box. */
function path_theme_meta_box_layout() { ?>

	<table class="form-table">
		
		<!-- Global Layout -->
		<tr>
			<th>
			    <label for="<?php echo esc_attr( hybrid_settings_field_id( 'path_global_layout' ) ); ?>"><?php _e( 'Global Layout:', 'path' ); ?></label>
			</th>
			<td>
			    <select id="<?php echo esc_attr( hybrid_settings_field_id( 'path_global_layout' ) ); ?>" name="<?php echo esc_attr( hybrid_settings_field_name( 'path_global_layout' ) ); ?>">
					<option value="layout-default" <?php selected( hybrid_get_setting( 'path_global_layout' ), 'layout-default' ); ?>> <?php echo __( 'Default', 'path' ) ?> </option>
					<option value="layout-1c" <?php selected( hybrid_get_setting( 'path_global_layout' ), 'layout-1c' ); ?>> <?php echo __( 'One Column', 'path' ) ?> </option>
					<option value="layout-2c-l" <?php selected( hybrid_get_setting( 'path_global_layout' ), 'layout-2c-l' ); ?>> <?php echo __( 'Two Columns, Left', 'path' ) ?> </option>
					<option value="layout-2c-r" <?php selected( hybrid_get_setting( 'path_global_layout' ), 'layout-2c-r' ); ?>> <?php echo __( 'Two Columns, Right', 'path' ) ?> </option>
					<option value="layout-3c-l" <?php selected( hybrid_get_setting( 'path_global_layout' ), 'layout-3c-l' ); ?>> <?php echo __( 'Three Columns, Left', 'path' ) ?> </option>
					<option value="layout-3c-r" <?php selected( hybrid_get_setting( 'path_global_layout' ), 'layout-3c-r' ); ?>> <?php echo __( 'Three Columns, Right', 'path' ) ?> </option>
					<option value="layout-3c-c" <?php selected( hybrid_get_setting( 'path_global_layout' ), 'layout-3c-c' ); ?>> <?php echo __( 'Three Columns, Center', 'path' ) ?> </option>
			    </select>
			    <p><span class="description"><?php _e( 'Set the layout for the entire site. The default layout is 2 columns with content on the left. You can overwrite this value in individual post or page. Note! Three column layouts will only work if you use Primary and Secondary Widget areas and browser window is wide enough.', 'path' ); ?></span></p>
			</td>
		</tr>	
		
		<!-- End custom form elements. -->
	</table><!-- .form-table -->		
	
<?php }		

/* Validate theme settings. */
function path_theme_validate_settings( $input ) {

	$input['path_global_layout'] = wp_filter_nohtml_kses( $input['path_global_layout'] );

    /* Return the array of theme settings. */
    return $input;
	
}

?>