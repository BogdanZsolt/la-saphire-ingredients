<?php

/**
 * La Saphire WooCommerce Ingredients Product Type Modifications.
*/

function lasaphire_ingredients($tabs){

	$tabs['ingredients'] = array(
		'id'			=> '_ingredients',
		'label'			=> esc_html__('Ingredients', 'ls-ingredients'),
		'description'	=> esc_html__('La Saphire provide access to the ingredient list of products.', 'ls-ingredients'),
		// 'description'	=> __('Lasaphire hozzáférést biztosít a termékek összetevőlistájához.', 'ls-ingredients'),
		'wrapper_class'	=> 'show_if_simple',
		'default'		=> 'no',
	);
	return $tabs;
}
add_filter( 'product_type_options', 'lasaphire_ingredients', 10, 1);

function wcpp_custom_style() {

	?><style>
		#woocommerce-product-data ul.wc-tabs, li.ingredients_options a:before { content: '\f175' !important	; }
	</style><?php

}
add_action( 'admin_head', 'wcpp_custom_style' );

function lasaphire_save_ingredients_product_data($post_id){
	$enable_ingredients = isset( $_POST['_ingredients'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_ingredients', $enable_ingredients);
}
add_action( 'save_post_product', 'lasaphire_save_ingredients_product_data' );

function lasaphire_product_tab( $tabs) {

	$tabs['ingredients'] = array(
		'label'			=> esc_html__('Ingredients', 'ls-ingredients'),
		'target'		=> 'ingredients_product_data',
		'class'  		=> array( 'show_if_ingredients', 'hide_if_virtual', 'hide_if_downloadable' ),
		'priority'		=> 25,
	);
    return $tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'lasaphire_product_tab' );

function woocommerce_wp_select_multiple( $field ) {
    global $thepostid, $post;

    $thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
    $field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
    $field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
    $field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
    $field['value']         = isset( $field['value'] ) ? $field['value'] : ( get_post_meta( $thepostid, $field['id'], true ) ? get_post_meta( $thepostid, $field['id'], true ) : array() );

    echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '" class="' . esc_attr( $field['class'] ) . '" multiple="multiple">';

    foreach ( $field['options'] as $key => $value ) {
        echo '<option value="' . esc_attr( $key ) . '" ' . ( in_array( $key, $field['value'] ) ? 'selected="selected"' : '' ) . '>' . esc_html( $value ) . '</option>';
    }

    echo '</select> ';

    if ( ! empty( $field['description'] ) ) {
        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
            echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . esc_url( WC()->plugin_url() ) . '/assets/images/help.png" height="16" width="16" />';
        } else {
            echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
        }
    }
    echo '</p>';
}

function lasaphire_ingredients_product_data(){
	?>
		<div id="ingredients_product_data" class="panel woocommerce_options_panel">
			<div class="woocommerce_product_tabs wc-metaboxes">
			<?php
			$arg = array(
				'post_type' 		=> 'ingredient',
				'posts_per_page' 	=> -1,
				'orderby'			=> 'title',
				'order'				=> 'ASC'
			);
			$product = wc_get_product();
			// $options = array('' => 'Select Option');
			$ingr = new WP_Query($arg);
			if($ingr->have_posts()){
				// $i=2;
				while($ingr->have_posts()){
					$ingr->the_post();
					$options[get_the_ID()] = get_the_title();
					// $i++;
					wp_reset_postdata();
				}
			}
			woocommerce_wp_select_multiple(
				array(
					'id'			=> '_ingredient_select',
					'name'			=> '_ingredient_select[]',
					'label'			=> esc_html__('Ingredients', 'ls-ingredients'),
					'options'		=> $options,
					'selected'		=> true,
					'value'			=> get_post_meta( $product->id, '_ingredient_select', true ),
					'desc_tip'		=> true,
					'description'	=> 'something super description',
					'wrapper_class' => 'form-field-wide',
					)
				);
				?>
			</div>
		</div>
	<?php
}
add_action( 'woocommerce_product_data_panels', 'lasaphire_ingredients_product_data' );

/**
 * Save Fields
*/
function ingredients_add_custom_general_fields_save( $post_id ){

	// Select
    if( !empty( $_POST['_ingredient_select'] ) ) {
		update_post_meta( $post_id, '_ingredient_select', $_POST['_ingredient_select'] );
	}
    else {
		update_post_meta( $post_id, '_ingredient_select',  [] );
    }
}
add_action( 'woocommerce_process_product_meta', 'ingredients_add_custom_general_fields_save' );

/**
 * Add a ingredient product options Ingredients data tab
 */
function lasaphire_ingredients_product_tab( $tabs ) {

	// Adds the new tab

	$product = wc_get_product();
	$is_ingredient = get_post_meta( $product->id, '_ingredients', true);
	if( $is_ingredient == 'yes' ) {
		$tabs['ingredients'] = array(
			'title' 	=> esc_html__( 'Ingredients', 'ls-ingredients' ),
			'priority' 	=> 15,
			'class'  	=> array( 'show_if_ingredients' ),
			'callback' 	=> 'lasaphire_ingredients_product_tab_content'
		);
	}

	return $tabs;

}
add_filter( 'woocommerce_product_tabs', 'lasaphire_ingredients_product_tab' );

function lasaphire_ingredients_product_tab_content() {

	// The new tab content
	$product = wc_get_product();
	$content_html = '';
	$ingr_ids = get_post_meta( $product->id, '_ingredient_select', true);
	if(!empty($ingr_ids)){
		$content_html .= '<div><h2 class="mb-3">' . esc_html__( 'Product Ingredients', 'ls-ingredients')  . '</h2>';
		foreach( $ingr_ids as $ingr_id){
			$ingredient = get_post( $ingr_id );
			$lname = get_post_meta( $ingr_id, '_ingredient_latin_name', true );
			$content_html .= '
						<div class="row">
							<div class="col-md-4">
								<h4>' . $ingredient->post_title . '</h4>
								<p>' . $lname . '</p>
							</div>
							<div class="col-md-8">'
								. $ingredient->post_content .
							'</div>
						</div>';
		}
		$content_html .= '</div>';
	}
	echo $content_html;
}
