<?php
/**
 * Init Styles & scripts
 *
 * @return void
*/
function lasaphire_ingredients_public_styles_scripts(){
	wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css', '', '4.6.0', 'all');
	wp_enqueue_style( 'lasaphire-ingredients-public-style', LASAPHIRE_INGREDIENTS_URL . 'public/css/public.css', '', rand());
	wp_enqueue_script( 'lasaphire-ingredients-public-script', LASAPHIRE_INGREDIENTS_URL . 'public/js/public.js', array(), rand(), true );
}
add_action( 'wp_enqueue_scripts', 'lasaphire_ingredients_public_styles_scripts' );