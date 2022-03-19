<?php
/**
 * Init Styles & scripts
 *
 * @return void
*/
function lasaphire_ingredients_admin_styles_scripts(){
	wp_register_style( 'lasaphire-ingredients-image-uploader-style', LASAPHIRE_INGREDIENTS_URL . 'admin/image-uploader.css', '', rand() );
	wp_enqueue_style( 'lasaphire-ingredients-admin-style', LASAPHIRE_INGREDIENTS_URL . 'admin/admin.css', '', rand() );
	wp_register_script( 'lasaphire-ingredients-image-uploader-script', LASAPHIRE_INGREDIENTS_URL . 'admin/image-uploader.js', array( 'jquery' ), rand(), true );
	wp_enqueue_script( 'lasaphire-ingredients-admin-script', LASAPHIRE_INGREDIENTS_URL . 'admin/admin.js', array(), rand(), true );
}
add_action( 'admin_enqueue_scripts', 'lasaphire_ingredients_admin_styles_scripts' );