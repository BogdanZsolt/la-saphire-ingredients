<?php

/**
 * Add columns to data table
*/
function add_ingredient_columns( $columns ){

	unset( $columns[ 'date' ]);

	$columns['latin_name']		= __('Latin Name', 'lasaphire-ingredients');
	$columns['featured_image']	= __('Featured Image', 'lasaphire-ingredients');
	$columns['date']			= __('Published On', 'lasaphire-ingredients');

	return $columns;
}
add_action( 'manage_ingredient_posts_columns', 'add_ingredient_columns' );

/**
 * Output Table Column values
*/

function ingredient_output_column_content( $column, $post_id ){

	switch( $column ){
		case 'latin_name':
			echo get_post_meta( $post_id, '_ingredient_latin_name', true);
			break;

		case 'featured_image':
			echo get_the_post_thumbnail( $post_id, 'ingredient_thumbnail' );
			break;

		default:
			break;
	}
}
add_filter( 'manage_ingredient_posts_custom_column', 'ingredient_output_column_content', 10, 2 );
add_image_size( 'ingredient_thumbnail', 50 );

/**
 * Making Columns Sortable
*/
function ingredient_make_columns_sortable( $columns ){
	$columns[ 'latin_name' ] = 'latin_name';
	// $columns[ 'featured_image' ] = 'featured_image';

	return $columns;
}
add_filter( 'manage_edit-ingredient_sortable_columns', 'ingredient_make_columns_sortable' );

/**
 * Columns sorting logic
*/
function ingredient_columns_sorting_logic( $query ){
	if( !is_admin() || !$query->is_main_query() ) {
		return;
	}

	if( 'latin_name' === $query->get( 'orderby' ) ) {
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', '_ingredient_latin_name');
	}
}
add_action( 'pre_get_posts', 'ingredient_columns_sorting_logic' );

/**
 * Add ID to row actions
 */
function my_action_row( $actions, $post ){
	//remove what you don't need
	if( $post->post_type == 'ingredient'){
		unset( $actions['view'] );
		$actions['id'] = 'ID: ' . $post->ID;
	}

	return $actions;
}
add_filter( 'post_row_actions', 'my_action_row', 10, 2 );