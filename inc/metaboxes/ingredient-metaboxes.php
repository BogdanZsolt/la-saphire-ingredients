<?php

/**
 * Add Metabox
*/
function lasaphire_add_ingredient_custom_box() {
    $screens = [ 'post', 'ingredient' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'ingredient_data',				// Unique ID
            'Ingredient Data',      		// Box title
            'lasaphire_ingredient_data_html',  	// Content callback, must be of type callable
            $screen							// Post type
        );
    }
}
add_action( 'add_meta_boxes', 'lasaphire_add_ingredient_custom_box' );


/**
 * Metabox html
*/
function lasaphire_ingredient_data_html( $post ) {
    $lname = get_post_meta( $post->ID, '_ingredient_latin_name', true );
	?>
	<table>
		<tr>
			<td>Latin Name: </td>
			<td>
				<input type="text" value="<?php echo $lname; ?>" id="ingredient_latin_name" name="ingredient_latin_name">
			</td>
		</tr>
	</table>
	<?php
}

/** [
 * Save Metabox Values
*/
function lasaphire_save_ingredient_postdata( $post_id ) {
    if ( array_key_exists( 'ingredient_latin_name', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_ingredient_latin_name',
            sanitize_text_field( $_POST['ingredient_latin_name'] )
        );
    }
}
add_action( 'save_post', 'lasaphire_save_ingredient_postdata' );
