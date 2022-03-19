<?php

/**
 * Create Ingredient Post Type
*/
function lasaphire_ingredients_post_type(){
    $ing_labels = array(
        'name'                  => esc_html__( 'Ingredients', 'lasaphire-ingredients'),
        'singular_name'         => esc_html__( 'Ingredient', 'lasaphire-ingredients'),
								'menu_name'													=> esc_html__( 'Ingredients', 'lasaphire-ingredients'),
								'name_admin_bar'								=> esc_html__( 'Ingredient', 'lasaphire-ingredients'),
								'add_new'															=> esc_html__( 'Add New', 'lasaphire-ingredients'),
								'add_new_item'										=> esc_html__( 'Add New Ingredient', 'lasaphire-ingredients'),
								'all_items'													=> esc_html__( 'All Ingredients', 'lasaphire-ingredients'),
								'search_items'										=> esc_html__( 'Search Ingredients', 'lasaphire-ingredients'),
								'not_found'													=> esc_html__( 'No ingredient found.', 'lasaphire-ingredients'),
								'not_found_in_trash'				=> esc_html__( 'No ingredient in Trash.', 'lasaphire-ingredients'),
								'featured_image'								=> esc_html__( 'Ingredient Cover Image', 'lasaphire-ingredients'),
								'set_featured_image'				=> esc_html__( 'Set cover image', 'lasaphire-ingredients'),
								'remove_featured_image'	=> esc_html__( 'Remove cover image', 'lasaphire-ingredients'),
								'use_featured_image'				=> esc_html__( 'Use as cover image', 'lasaphire-ingredients'),
								'archives'														=> esc_html__( 'Ingredient archives', 'lasaphire-ingredients'),
								'insert_into_item'						=> esc_html__( 'Insert into ingredient', 'lasaphire-ingredients'),
								'uploaded_to_this_item'	=> esc_html__( 'Uploaded to this ingredient', 'lasaphire-ingredients'),
								'filter_items_list'					=> esc_html__( 'Filter ingredients list', 'lasaphire-ingredients'),
								'items_list_navigation'	=> esc_html__( 'Ingredients list navigation', 'lasaphire-ingredients'),
								'items_list'												=> esc_html__( 'Ingredients list', 'lasaphire-ingredients'),
								'new_item'              => esc_html__( 'New Ingredient', 'lasaphire-ingredients'),
        'all_items'             => esc_html__( 'All Ingredients', 'lasaphire-ingredients'),
        'edit_item'             => esc_html__( 'Edit Ingredient', 'lasaphire-ingredients'),
        'view_item'             => esc_html__( 'View Ingredient', 'lasaphire-ingredients'),
        'search_items'          => esc_html__( 'Search Ingredients', 'lasaphire-ingredients'),
    );

    // $ing_labels = array(
    //     'name'                  => __( 'Összetevők', 'lasaphire-ingredients'),
    //     'singular_name'         => __( 'Összetevő', 'lasaphire-ingredients'),
				// 				'menu_name'													=> __( 'Összetevők', 'lasaphire-ingredients'),
				// 				'name_admin_bar'								=> __( 'Összetevő', 'lasaphire-ingredients'),
				// 				'add_new'															=> __( 'Új hozzáadás', 'lasaphire-ingredients'),
				// 				'add_new_item'										=> __( 'Új összetevő hozzáadása', 'lasaphire-ingredients'),
				// 				'all_items'													=> __( 'Összes összetevő', 'lasaphire-ingredients'),
				// 				'search_items'										=> __( 'Keresés az összetevőkben', 'lasaphire-ingredients'),
				// 				'not_found'													=> __( 'Az összetevő nem található', 'lasaphire-ingredients'),
				// 				'not_found_in_trash'				=> __( 'Az összetevő nem található a lomtárben', 'lasaphire-ingredients'),
				// 				'featured_image'								=> __( 'Összetevő Borítókép', 'lasaphire-ingredients'),
				// 				'set_featured_image'				=> __( 'Borítókép beállítása', 'lasaphire-ingredients'),
				// 				'remove_featured_image'	=> __( 'Borítókép törlése', 'lasaphire-ingredients'),
				// 				'use_featured_image'				=> __( 'Használat Borítóképként', 'lasaphire-ingredients'),
				// 				'archives'														=> __( 'Összetevők arhívuma', 'lasaphire-ingredients'),
				// 				'insert_into_item'						=> __( 'Beszúrás az összetevőkhöz', 'lasaphire-ingredients'),
				// 				'uploaded_to_this_item'	=> __( 'Feltöltés az összetevőhöz', 'lasaphire-ingredients'),
				// 				'filter_items_list'					=> __( 'Szűrt összetevő lista', 'lasaphire-ingredients'),
				// 				'items_list_navigation'	=> __( 'Összetevő lista navigáció', 'lasaphire-ingredients'),
				// 				'items_list'												=> __( 'Összetevő lista', 'lasaphire-ingredients'),
				// 				'new_item'              => __( 'Új összetevő', 'lasaphire-ingredients'),
    //     'all_items'             => __( 'Összes összetevő', 'lasaphire-ingredients'),
    //     'edit_item'             => __( 'Összetevő szerkesztése', 'lasaphire-ingredients'),
    //     'view_item'             => __( 'Összetevő megtekintése', 'lasaphire-ingredients'),
    //     'search_items'          => __( 'Összetevő keresése', 'lasaphire-ingredients'),
    // );


				$ing_args = array(
								'show_in_rest'								=> true, // Modern block editor
        'rewrite'            	=> array( 'slug' => 'ingredient' ),
        'labels'             	=> $ing_labels,
        'hierarchical'       	=> false,
								'public'             	=> true,
								'description'									=> __( 'Ingredient info', 'lasaphire-ingredients' ),
        'show_ui'            	=> true,
        'show_in_menu'       	=> true,
        'query_var'          	=> true,
        'capability_type'    	=> 'post',
        'has_archive'        	=> false,
								'can_export'										=> true,
        'menu_position'      	=> null,
        'supports'           	=> array( 'title', 'editor', 'thumbnail'),
								'menu_icon' 										=> 'dashicons-feedback',
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
		$title = __( 'Ingredient name', 'lasaphire-ingredients' );
	}

	return $title;
}
add_filter( 'enter_title_here', 'lasaphire_ingredients_update_ingredient_title_placeholder' );
