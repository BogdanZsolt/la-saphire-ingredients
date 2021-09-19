<?php

/**
 * Plugin Name: La Saphire Ingredients
 * Plugin URI: https://pegazusdesigns.hu/
 * Author: Shiru
 * Author URI: https://www.zsoltbogdan.hu
 * version: 1.0.0
 * Text Domain: lasaphire-ingredients
 * Description: A plugin for beauty ingredients
*/

if ( !defined( 'ABSPATH' ) ){
	exit(); // No direct access allowed
}

/**
 * define plugin constants
*/
define( 'LASAPHIRE_INGREDIENTS_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'LASAPHIRE_INGREDIENTS_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );

/**
 * Include admin.php
*/
if ( is_admin() ){
	require_once LASAPHIRE_INGREDIENTS_PATH . '/admin/admin.php';
}

/**
 * Include public.php
*/
if ( !is_admin() ){
	require_once LASAPHIRE_INGREDIENTS_PATH . '/public/public.php';
}

/**
 * Include Post Types
*/
require_once LASAPHIRE_INGREDIENTS_PATH . '/inc/post-types/ingredient.php';

/**
 * Include Metaboxes
*/
require_once LASAPHIRE_INGREDIENTS_PATH . '/inc/metaboxes/ingredient-metaboxes.php';

/**
 * Include Data Table
*/
require_once LASAPHIRE_INGREDIENTS_PATH . '/inc/data-tables/ingredient-data-table.php';

/**
 * Include Admin Menu
 *require_once LASAPHIRE_INGREDIENTS_PATH . '/inc/menus/menus.php';
 */

/**
 * Include Settings
 */
 require_once LASAPHIRE_INGREDIENTS_PATH . '/inc/settings/settings.php';

/**
 * Include Shortcodes
*/
require_once LASAPHIRE_INGREDIENTS_PATH . '/inc/shortcodes/shortcodes.php';


/**
 * If WooCommerce exist
*/
function lasaphire_woocommerce_init(){
	if( class_exists( 'WooCommerce' )){
		/**
		 * Include woocommerce modifications
		*/
		require_once LASAPHIRE_INGREDIENTS_PATH . '/inc/wc-modifications/wc-modifications.php';
	}
}
add_action( 'plugins_loaded', 'lasaphire_woocommerce_init' );