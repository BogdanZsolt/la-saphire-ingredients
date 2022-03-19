<?php

/**
 * Custom Admin Menu
*/
function lasaphire_ingredients_custom_admin_menu(){
	add_menu_page(
		esc_html__( 'Custom Menu', 'lasaphire-ingredients' ),
		esc_html__( 'Custom Menu', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-menu',
		'lasaphire_ingredients_custom_submenu_template_callback',
		'dashicons-admin-plugins',
		10
	);

	add_submenu_page(
		'custom-menu',
		esc_html__( 'Custom Submenu', 'lasaphire-ingredients' ),
		esc_html__( 'Custom Submenu', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-menu',
		'lasaphire_ingredients_custom_submenu_template_callback'
	);

	add_submenu_page(
		'custom-menu',
		esc_html__( 'Custom Submenu 2', 'lasaphire-ingredients' ),
		esc_html__( 'Custom Submenu 2', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-submenu-2',
		'lasaphire_ingredients_custom_submenu_template_callback_2'
	);

	add_submenu_page(
		'admin.php',
		esc_html__( 'Custom Link', 'lasaphire-ingredients' ),
		esc_html__( 'Custom Link', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-link',
		'lasaphire_ingredients_custom_link_template_callback'
	);

	add_submenu_page(
		'tools.php',
		esc_html__( 'Custom Link', 'lasaphire-ingredients' ),
		esc_html__( 'Custom Link', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-tool-link',
		'lasaphire_ingredients_custom_tool_link_template_callback'
	);

	add_submenu_page(
		'options-general.php',
		esc_html__( 'Custom Link', 'lasaphire-ingredients' ),
		esc_html__( 'Custom Link', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-option-link',
		'lasaphire_ingredients_custom_option_link_template_callback'
	);

	add_submenu_page(
		'plugins.php',
		esc_html__( 'Custom Link', 'lasaphire-ingredients' ),
		esc_html__( 'Custom Link', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-theme-link',
		'lasaphire_ingredients_custom_option_link_template_callback'
	);
}
add_action( 'admin_menu', 'lasaphire_ingredients_custom_admin_menu' );

/**
 * Custom Submenu Callback Function
*/
function lasaphire_ingredients_custom_submenu_template_callback(){
	?>
	<h4><?php	esc_html_e( 'Hi I am from custom submenu!', 'lasaphire-ingredients' ); ?></h4>
	<?php
}

/**
 * Custom Submenu 2 Callback Function
*/
function lasaphire_ingredients_custom_submenu_template_callback_2(){
	?>
	<h4><?php	esc_html_e( 'Hi I am from custom submenu 2!!!', 'lasaphire-ingredients' ); ?></h4>
	<a href="<?php echo admin_url('/admin.php?page=custom-link'); ?>">Custom Link</a>
	<?php
}

/**
 * Custom Link Template Callback Function
*/
function lasaphire_ingredients_custom_link_template_callback(){
	?>
		<h4><?php	esc_html_e( 'Hello, I am from the custom link template!!!', 'lasaphire-ingredients' ); ?></h4>
	<?php
}

/**
 * Custom Tool Link Template Callback Function
*/
function lasaphire_ingredients_custom_tool_link_template_callback(){
	?>
	<h2><?php	esc_html_e( 'Hey I am from custom tool link!!!', 'lasaphire-ingredients' ); ?></h2>
	<?php
}

/**
 * Custom Option Link Template Callback Function
*/
function lasaphire_ingredients_custom_option_link_template_callback(){
	?>
	<h2><?php	esc_html_e( 'Hey I am from custom option link!!!', 'lasaphire-ingredients' ); ?></h2>
	<?php
}