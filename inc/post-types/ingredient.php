<?php

/**
 * Create Ingredient Post Type
*/

// Register Custom Post Type
function lasaphire_ingredients_post_type() {

	$ing_labels = array(
		'name'                  => _x( 'Ingredients', 'Post Type General Name', 'lsingredient' ),
		'singular_name'         => _x( 'Ingredient', 'Post Type Singular Name', 'lsingredient' ),
		'menu_name'             => __( 'Ingredients', 'lsingredient' ),
		'name_admin_bar'        => __( 'Ingredients', 'lsingredient' ),
		'archives'              => __( 'Item Archives', 'lsingredient' ),
		'attributes'            => __( 'Item Attributes', 'lsingredient' ),
		'parent_item_colon'     => __( 'Parent Item:', 'lsingredient' ),
		'all_items'             => __( 'All Items', 'lsingredient' ),
		'add_new_item'          => __( 'Add New Item', 'lsingredient' ),
		'add_new'               => __( 'Add New', 'lsingredient' ),
		'new_item'              => __( 'New Item', 'lsingredient' ),
		'edit_item'             => __( 'Edit Item', 'lsingredient' ),
		'update_item'           => __( 'Update Item', 'lsingredient' ),
		'view_item'             => __( 'View Item', 'lsingredient' ),
		'view_items'            => __( 'View Items', 'lsingredient' ),
		'search_items'          => __( 'Search Item', 'lsingredient' ),
		'not_found'             => __( 'Not found', 'lsingredient' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'lsingredient' ),
		'featured_image'        => __( 'Featured Image', 'lsingredient' ),
		'set_featured_image'    => __( 'Set featured image', 'lsingredient' ),
		'remove_featured_image' => __( 'Remove featured image', 'lsingredient' ),
		'use_featured_image'    => __( 'Use as featured image', 'lsingredient' ),
		'insert_into_item'      => __( 'Insert into item', 'lsingredient' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'lsingredient' ),
		'items_list'            => __( 'Items list', 'lsingredient' ),
		'items_list_navigation' => __( 'Items list navigation', 'lsingredient' ),
		'filter_items_list'     => __( 'Filter items list', 'lsingredient' ),
	);

	$args = array(
		'label'                 => __( 'Ingredient', 'lsingredient' ),
		'description'           => __( 'Ingredients Info', 'lsingredient' ),
		'labels'                => $ing_labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_in_rest'										=> true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'ingredient', $args );

}
add_action( 'init', 'lasaphire_ingredients_post_type', 0 );




// function lasaphire_ingredients_post_type(){
// 	$ing_labels = array(

// 	);


// 	$ing_args = array(
// 		'show_in_rest'								=> true, // Modern block editor
// 		'rewrite'            	=> array( 'slug' => 'ingredient' ),
// 		'labels'             	=> $ing_labels,
// 		'hierarchical'       	=> false,
// 		'public'             	=> true,
// 		'description'									=> esc_html__( 'Ingredient info', 'ls-ingredients' ),
// 		'show_ui'            	=> true,
// 		'show_in_menu'       	=> true,
// 		'query_var'          	=> true,
// 		'capability_type'    	=> 'post',
// 		'has_archive'        	=> false,
// 		'can_export'										=> true,
// 		'menu_position'      	=> null,
// 		'supports'           	=> array( 'title', 'editor', 'thumbnail'),
// 		'menu_icon' 										=> 'dashicons-feedback',
// 	);

// 	register_post_type( 'ingredient', $ing_args );

// }
// add_action( 'init', 'lasaphire_ingredients_post_type' );

/**
 * Update title placeholder
*/
function lasaphire_ingredients_update_ingredient_title_placeholder(){
	$screen = get_current_screen();
	if( 'ingredient' === $screen->post_type ) {
		$title = esc_html__( 'Ingredients', 'ls-ingredients');
	}

	return $title;
}
add_filter( 'enter_title_here', 'lasaphire_ingredients_update_ingredient_title_placeholder' );
