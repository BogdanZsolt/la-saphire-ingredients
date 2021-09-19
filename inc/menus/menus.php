<?php

/**
 * Custom Admin Menu
*/
function lasaphire_ingredients_custom_admin_menu(){
	add_menu_page(
		__( 'Custom Menu', 'lasaphire-ingredients' ),
		__( 'Custom Menu', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-menu',
		'lasaphire_ingredients_custom_submenu_template_callback',
		'dashicons-admin-plugins',
		10
	);

	add_submenu_page(
		'custom-menu',
		__( 'Custom Submenu', 'lasaphire-ingredients' ),
		__( 'Custom Submenu', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-menu',
		'lasaphire_ingredients_custom_submenu_template_callback'
	);

	add_submenu_page(
		'custom-menu',
		__( 'Custom Submenu 2', 'lasaphire-ingredients' ),
		__( 'Custom Submenu 2', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-submenu-2',
		'lasaphire_ingredients_custom_submenu_template_callback_2'
	);

	add_submenu_page(
		'admin.php',
		__( 'Custom Link', 'lasaphire-ingredients' ),
		__( 'Custom Link', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-link',
		'lasaphire_ingredients_custom_link_template_callback'
	);

	add_submenu_page(
		'tools.php',
		__( 'Custom Link', 'lasaphire-ingredients' ),
		__( 'Custom Link', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-tool-link',
		'lasaphire_ingredients_custom_tool_link_template_callback'
	);

	add_submenu_page(
		'options-general.php',
		__( 'Custom Link', 'lasaphire-ingredients' ),
		__( 'Custom Link', 'lasaphire-ingredients' ),
		'manage_options',
		'custom-option-link',
		'lasaphire_ingredients_custom_option_link_template_callback'
	);

	add_submenu_page(
		'plugins.php',
		__( 'Custom Link', 'lasaphire-ingredients' ),
		__( 'Custom Link', 'lasaphire-ingredients' ),
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
	<h4>Hi I am from custom submenu!</h4>
	<?php
}

/**
 * Custom Submenu 2 Callback Function
*/
function lasaphire_ingredients_custom_submenu_template_callback_2(){
	?>
	<h4>Hi I am from custom submenu 2!!!</h4>
	<a href="<?php echo admin_url('/admin.php?page=custom-link'); ?>">Custom Link</a>
	<?php
}

/**
 * Custom Link Template Callback Function
*/
function lasaphire_ingredients_custom_link_template_callback(){
	?>
		<h4>Hello, I am from the custom link template!!!</h4>
	<?php
}

/**
 * Custom Tool Link Template Callback Function
*/
function lasaphire_ingredients_custom_tool_link_template_callback(){
	?>
	<h2>Hey I am from custom tool link!!!</h2>
	<?php
}

/**
 * Custom Option Link Template Callback Function
*/
function lasaphire_ingredients_custom_option_link_template_callback(){
	?>
	<h2>Hey I am from custom option link!!!</h2>
	<?php
}