<?php

/**
 * Create Ingredient Post Type
*/
function lasaphire_ingredients_post_type(){
    $ing_labels = array(
        'name'                  => 'Ingredients',
        'singular_name'         => 'Ingredient',
		'menu_name'				=> 'Ingredients',
		'name_admin_bar'		=> 'Ingredient',
		'add_new'				=> 'Add New',
		'add_new_item'			=> 'Add New Ingredient',
		'all_items'				=> 'All Ingredients',
		'search_items'			=> 'Search Ingredients',
		'not_found'				=> 'No ingredient found.',
		'not_found_in_trash'	=> 'No ingredient in Trash.',
		'featured_image'		=> 'Ingredient Cover Image',
		'set_featured_image'	=> 'Set cover image',
		'remove_featured_image'	=> 'Remove cover image',
		'use_featured_image'	=> 'Use as cover image',
		'archives'				=> 'Ingredient archives',
		'insert_into_item'		=> 'Insert into ingredient',
		'uploaded_to_this_item'	=> 'Uploaded to this ingredient',
		'filter_items_list'		=> 'Filter ingredients list',
		'items_list_navigation'	=> 'Ingredients list navigation',
		'items_list'			=> 'Ingredients list',
		'new_item'              => 'New Ingredient',
        'all_items'             => 'All Ingredients',
        'edit_item'             => 'Edit Ingredient',
        'view_item'             => 'View Ingredient',
        'search_items'          => 'Search Ingredients',
    );

    $ing_args = array(
		'show_in_rest'			=> true, // Modern block editor
        'rewrite'            	=> array( 'slug' => 'ingredient' ),
        'labels'             	=> $ing_labels,
        'hierarchical'       	=> false,
		'public'             	=> true,
		'description'			=> 'Ingredient info',
        'show_ui'            	=> true,
        'show_in_menu'       	=> true,
        'query_var'          	=> true,
        'capability_type'    	=> 'post',
        'has_archive'        	=> false,
		'can_export'			=> true,
        'menu_position'      	=> null,
        'supports'           	=> array( 'title', 'editor', 'thumbnail'),
		'menu_icon' 			=> 'dashicons-feedback',
    );

    register_post_type( 'ingredient', $ing_args );

}
add_action( 'init', 'lasaphire_ingredients_post_type' );

/**
 * Update title placeholder
*/
function lasaphire_ingredients_update_ingredient_title_placeholder(){
	$screen = get_current_screen();
	if( 'ingredient' === $screen->post_type ) {
		$title = 'Add ingredient name';
	}

	return $title;
}
add_filter( 'enter_title_here', 'lasaphire_ingredients_update_ingredient_title_placeholder' );