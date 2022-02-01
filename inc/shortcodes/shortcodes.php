<?php

/**
 * La Saphire Ingredients Wordpress Shortcode list ingredients
*/

function get_ingredient_product_list( $ingr ){
	$args = array(
		'post_type' 			=> 'product',
		'post_status'			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' 		=> -1,
		'orderby'				=> 'title',
		'order'					=> 'ASC',
		'meta_query'			=> array(
			array(
				'key'				=> '_ingredients',
				'value'				=> 'yes',
				'compare'			=> '=',
			),
		),
	);
	$loop = new WP_Query( $args );
	$product_list = [];
	$index = 0;
	if( !empty( $loop->posts ) ){
		foreach( $loop->posts as $post){
			$selected_ingredients = get_post_meta( $post->ID, '_ingredient_select', true);
			if(!empty($selected_ingredients)){
				foreach($selected_ingredients as $selected_ingredient){
					if ($selected_ingredient == $ingr->ID)	{
						$product_list[$index] = $post->ID;
						$index++;
					}
				}
			}
		}
		wp_reset_postdata();
	}
	return $product_list;
}

function lasaphire_ingredients_get_list(){
	$azRange = range('A', 'Z');
	$return_html = '';
	$return_html .= '<div class="container">';
	$return_html .= '
			<ul class="clearfix glassmorph row px-3 mb-3">
				<li>
					<a class="active" title="' . __('Az összes összetevő megtekintése', 'lasaphire-ingredients') . '" data-filter="*">
				'	.	__( 'Mind', 'lasaphire-ingredients' ) . '
					</a>
				</li>';

	foreach( range( 'A', 'Z' ) as $letter ){
		$return_html .= '
				<li>
					<a class="disabled" title="' . __('Betűvel kezdődő összetevő megtekintése', 'lasaphire-ingredients') . ' ' . $letter .'" data-filter="cat-' . strtolower($letter) . '">'
						. $letter .
					'</a>
				</li>';
	}
	$return_html .= '
			</ul>';

	$args = array(
		'paged'				=> get_query_var( 'paged', 1 ),
		'post_type' 		=> 'ingredient',
		'posts_per_page' 	=> -1,
		'orderby'			=> 'title',
		'order'				=> 'ASC'
	);

	$query = new WP_Query( $args );

	if( !empty( $query->posts ) ) {
		foreach( $query->posts as $post ){
			$lname = get_post_meta( $post->ID, '_ingredient_latin_name', true );
			$photo = get_the_post_thumbnail( $post->ID, array( '75' ), array( 'class' => 'img-fluid' ) );
			$ing_products = get_ingredient_product_list( $post );
			$return_html .= '<div class="item-wrapper glassmorph row mb-3 p-3" style="display: flex">
				<div class="col-md-2 col-12">'
					. $photo .
				'</div>
				<div class="col-md-3 col-12">
					<h4 class="title">' . $post->post_title . '</h4>
					<p>' . $lname . '</p>
				</div>
				<div class="col-md-5 col-12">'
					. $post->post_content .
				'</div>
				<div class="col-md-2 col-12">
					<h6>' . __('Található', 'lasaphire-ingredients') . ':</h6>
						<ul class="found-in">';
			foreach( $ing_products as $ing_product ){
				$product = wc_get_product( $ing_product );
				$return_html .= '<li><a href="' . $product->get_permalink() . '">' . $product->get_title() . '</a></li>';
			}
			$return_html .=	'</ul></div></div>';
		}
	}

	$return_html .= '<div>';

	return $return_html;
}
add_shortcode( 'lasaphire_ingredients_list', 'lasaphire_ingredients_get_list' );