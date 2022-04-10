<?php

/**
 * Create Settings Menu
*/
function lasaphire_ingredients_settings_submenu(){

	$hook = add_submenu_page(
		'edit.php?post_type=ingredient',
		esc_html__( 'Settings', 'ls-ingredients' ),
		esc_html__( 'Settings', 'ls-ingredients' ),
		'manage_options',
		'ingredients-option-link',
		'lasaphire_ingredients_settings_template_callback',
		'',
		null
	);

	add_action( 'admin_head-'.$hook, 'lasaphire_ingredients_image_uploader_assets', 10, 1 );
}
add_action( 'admin_menu', 'lasaphire_ingredients_settings_submenu' );

/**
 * Enqueue Image Uploader Assets
*/
function lasaphire_ingredients_image_uploader_assets(){
	wp_enqueue_media();
	wp_enqueue_style( 'ls-ingredients-image-uploader-style' );
	wp_enqueue_script( 'ls-ingredients-image-uploader-script');
}

/**
 * Settings Template Page
*/
function lasaphire_ingredients_settings_template_callback(){
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<form action="options.php" method="post">
			<?php
				// Security field
				settings_fields( 'ls-ingredients-settings-page' );

				// output settings section here
				do_settings_sections( 'ls-ingredients-settings-page' );

				// Save Settings button
				submit_button( 'Save Settings' );
			?>
		</form>
	</div>
	<?php
}

/**
 * Settings Template
*/
function lasaphire_ingredients_settings_init(){

	// Setup settings section
	add_settings_section(
		'lasaphire_ingredients_settings_section',
		'La Saphire Ingredients Settings Page',
		'',
		'ls-ingredients-settings-page'
	);

	// Register input field
	register_setting(
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_input_field',
		array(
			'type'				=> 'string',
			'sanitize_callback'	=> 'sanitize_text_field',
			'default'			=> ''
		)
	);

	// Add text fields
	add_settings_field(
		'lasaphire_ingredients_input_field',
		__( 'Input Field', 'my-plugin' ),
		'lasaphire_ingredients_settings_input_field_callback',
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_settings_section',
	);

	// Register textarea field
	register_setting(
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_textarea_field',
		array(
			'type'				=> 'string',
			'sanitize_callback'	=> 'sanitize_textarea_field',
			'default'			=> ''
		)
	);

	// Add textarea fields
	add_settings_field(
		'lasaphire_ingredients_textarea_field',
		__( 'Textarea Field', 'my-plugin' ),
		'lasaphire_ingredients_settings_textarea_field_callback',
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_settings_section',
	);

	// Register select option field
	register_setting(
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_select_field',
		array(
			'type'				=> 'string',
			'sanitize_callback'	=> 'sanitize_text_field',
			'default'			=> ''
		)
	);

	// Add select fields
	add_settings_field(
		'lasaphire_ingredients_select_field',
		__( 'Select Field', 'my-plugin' ),
		'lasaphire_ingredients_settings_select_field_callback',
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_settings_section',
	);

	// Register radio field
	register_setting(
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_radio_field',
		array(
			'type'				=> 'string',
			'sanitize_callback'	=> 'sanitize_text_field',
			'default'			=> 'value1'
		)
	);

	// Add radio fields
	add_settings_field(
		'lasaphire_ingredients_radio_field',
		__( 'Radio Field', 'my-plugin' ),
		'lasaphire_ingredients_settings_radio_field_callback',
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_settings_section',
	);

	// Register checkbox field
	register_setting(
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_checkbox_field',
		array(
			'type'				=> 'string',
			'sanitize_callback'	=> 'sanitize_key',
			'default'			=> 'value1'
		)
	);

	// Add checkbox fields
	add_settings_field(
		'lasaphire_ingredients_checkbox_field',
		__( 'Checkbox Field', 'my-plugin' ),
		'lasaphire_ingredients_settings_checkbox_field_callback',
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_settings_section',
	);

	// Register image uploader field
	register_setting(
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_image_uploader_field',
		array(
			'type'				=> 'integer',
			'sanitize_callback'	=> 'sanitize_image_uploader',
			'default'			=> ''
		)
	);

	// Add image uploader fields
	add_settings_field(
		'lasaphire_ingredients_image_uploader_field',
		__( 'Image Uploader', 'my-plugin' ),
		'lasaphire_ingredients_settings_checkboximage_uploader_field_callback',
		'ls-ingredients-settings-page',
		'lasaphire_ingredients_settings_section',
	);
}
add_action( 'admin_init', 'lasaphire_ingredients_settings_init' );

/**
 * Sanitize Image Uploader
*/
function sanitize_image_uploader( $value ){
	if( isset( $value ) ){
		return intval( $value );
	} else {
		return false;
	}
}

/**
 * text template
 */
function lasaphire_ingredients_settings_input_field_callback(){
	$lasaphire_ingredients_input_field = get_option( 'lasaphire_ingredients_input_field' );
	?>
	<input type="text" name="lasaphire_ingredients_input_field" class="regular-text" value="<?php echo isset( $lasaphire_ingredients_input_field) ? esc_attr( $lasaphire_ingredients_input_field ) : ''; ?>" />
	<?php
}

/**
 * textarea template
*/
function lasaphire_ingredients_settings_textarea_field_callback(){
	$lasaphire_ingredients_textarea_field = get_option( 'lasaphire_ingredients_textarea_field' );
	?>
	<textarea name="lasaphire_ingredients_textarea_field" class="large-text" rows="10"><?php echo isset( $lasaphire_ingredients_textarea_field ) ? esc_textarea( $lasaphire_ingredients_textarea_field ) : ''; ?></textarea>
	<?php
}

/**
 * select template
*/
function lasaphire_ingredients_settings_select_field_callback(){
	$lasaphire_ingredients_select_field = get_option( 'lasaphire_ingredients_select_field' );
	?>
	<select name="lasaphire_ingredients_select_field" class="regular-text">
		<option value="">Select One</option>
		<option value="option1" <?php selected( 'option1', $lasaphire_ingredients_select_field ); ?> >Option 1</option>
		<option value="option2" <?php selected( 'option2', $lasaphire_ingredients_select_field ); ?> >Option 2</option>
	</select>
	<?php
}

/**
 * Radio template
*/
function lasaphire_ingredients_settings_radio_field_callback(){
	$lasaphire_ingredients_radio_field = get_option( 'lasaphire_ingredients_radio_field' );
	?>
	<label for="value1">
		<input type="radio" name="lasaphire_ingredients_radio_field" value="value1" <?php checked( 'value1', $lasaphire_ingredients_radio_field ); ?> /> Value 1
	</label>
	<label for="value2">
		<input type="radio" name="lasaphire_ingredients_radio_field" value="value2" <?php checked( 'value2', $lasaphire_ingredients_radio_field ); ?>/> Value 2
	</label>
	<?php
}

/**
 * Checkbox template
*/
function lasaphire_ingredients_settings_checkbox_field_callback(){
	$lasaphire_ingredients_checkbox_field = get_option( 'lasaphire_ingredients_checkbox_field' );
	?>
	<label for="">
		<input type="checkbox" name="lasaphire_ingredients_checkbox_field" value="yes" <?php checked( 'yes', $lasaphire_ingredients_checkbox_field ); ?> /> Please check to confirm!
	</label>
	<?php
}

/**
 * Image Uploader template
*/
function lasaphire_ingredients_settings_checkboximage_uploader_field_callback(){
	$lasaphire_ingredients_image_id = get_option( 'lasaphire_ingredients_image_uploader_field' );
	?>
	<div class="ls-ingredients-uploader-wrap">
		<img data-src="" src="<?php echo esc_url( wp_get_attachment_url( $lasaphire_ingredients_image_id ) ); ?>" width="250" />
		<div class="ls-ingredients-upload-action">
			<input type="hidden" name="lasaphire_ingredients_image_uploader_field" value="<?php echo esc_attr( isset( $lasaphire_ingredients_image_id ) ? ( int ) $lasaphire_ingredients_image_id : 0 ); ?>" />
			<button type="button" class="upload-image-button"><span class="dashicons dashicons-plus"></span></button>
			<button type="button" class="remove-image-button"><span class="dashicons dashicons-minus"></span></button>
		</div>
	</div>
	<?php
}