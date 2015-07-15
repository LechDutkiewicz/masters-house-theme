<?php

// hook to include colors for custom taxonomy
// added by Lech Dutkiewicz
// created by pippin https://pippinsplugins.com/adding-custom-meta-fields-to-taxonomies/
// Add term page
function pippin_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	$options = get_colors_list();
	$output .= '<ul class="meta_box_items">';

	foreach ( $options as $val => $option ) {
		$output .= '<li class="radio-img" style="display:inline-block;margin-right:5px"><input class="radio-img-radio" style="display:none" type="radio" name="term_meta[color]" id="color-' . $val . '" value="' . $val . '" />
							<label class="radio-img-label" style="display:none" for="term_meta[color]">' . $val . '</label>
							<img src="' . esc_url( $option ) . '" alt="' . $val . '" class="radio-img-img ' . $selected . '" style="border:3px solid #F9F9F9;margin:0 5px 10px 0;cursor:pointer;' . $selected_style . '" onclick="document.getElementById(\'color-' . $val . '\').checked=true;" />
								</li>';
	}
	$output .= '</ul>';
	
	echo $output;
}

add_action( 'property-type_add_form_fields', 'pippin_taxonomy_add_new_meta_field', 10, 2 );
add_action( 'category_add_form_fields', 'pippin_taxonomy_add_new_meta_field', 10, 2 );

// Edit term page
function pippin_taxonomy_edit_meta_field( $term ) {

	// put the term ID into a variable
	$t_id = $term->term_id;

	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" );
	$options = get_colors_list();
	$output .= '<ul class="meta_box_items">';
	foreach ( $options as $val => $option ) {

		$selected = '';
		if ( $term_meta['color'] != '' && $term_meta['color'] == $val ) {
			$selected = ' radio-img-selected';
			$selected_style = ' border-color:#ccc';
			$checked = 'checked';
		} else {
			$selected = '';
			$selected_style = '';
			$checked = '';
		}
		$output .= '<li class="radio-img" style="display:inline-block;margin-right:5px"><input class="radio-img-radio" style="display:none" type="radio" name="term_meta[color]" id="color-' . $val . '" value="' . $val . '" ' . $checked . ' />
							<label class="radio-img-label" style="display:none" for="term_meta[color]">' . $val . '</label>
							<img src="' . esc_url( $option ) . '" alt="' . $val . '" class="radio-img-img ' . $selected . '" style="border:3px solid #F9F9F9;margin:0 5px 10px 0;cursor:pointer;' . $selected_style . '" onclick="document.getElementById(\'color-' . $val . '\').checked=true;"  />
								</li>';
	}
	$output .= '</ul>' . $desc;
	echo $output;
}

add_action( 'property-type_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );
add_action( 'category_edit_form_fields', 'pippin_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}

add_action( 'edited_property-type', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_property-type', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'edited_category', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_category', 'save_taxonomy_custom_meta', 10, 2 );
