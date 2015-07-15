<?php

require_once( 'post-types/property.php');

function shandora_video_metabox_args() {

	$prefix = bon_get_prefix();

	$video_opts = array(

		array( 

			'label'	=> __('Embed Code', 'bon'),
			'desc'	=> __('Use the third party URL such Youtube, Vimeo, etc? Please input the URL', 'bon'), 
			'id'	=> $prefix.'videoembed',
			'type'	=> 'textarea',
		),

		array( 

			'label'	=> __('Use Self Hosted Video', 'bon'),
			'desc'	=> __('Using self uploaded and hosted video', 'bon'), 
			'id'	=> $prefix.'videoself',
			'type'	=> 'checkbox',
			'class' => 'collapsed',
		),


		array(
			'label' => __('M4V Video File', 'framework'),
			'desc' => __('The URL to the .m4v video file (required for use both in html5 / flash player)', 'bon'),
			'type' => 'file',
			'id' => $prefix . 'videom4v',
			'class' => 'hidden',
		),

		array(
			'label' => __('OGV Video File', 'framework'),
			'desc' => __('The URL to the .ogv video file ( HTML5 Only )', 'bon'),
			'type' => 'file',
			'id' => $prefix . 'videoogv',
			'class' => 'hidden',
		),

		array(
			'label' => __('Video Cover', 'framework'),
			'desc' => __('The image use for the video thumbnail', 'bon'),
			'type' => 'image',
			'id' => $prefix . 'videocover',
			'class' => 'hidden last',
		),

		
	);

	return $video_opts;

}

function shandora_gallery_metabox_args() {

	$prefix = bon_get_prefix();
	$suffix = SHANDORA_MB_SUFFIX;

	$gallery_options = array(
		array( 
			'label'	=> __('Listings Gallery', 'bon'),
			'desc'	=> __('Choose image to use in this listing gallery.', 'bon'), 
			'id'	=> $prefix . $suffix . 'gallery',
			'type'	=> 'gallery',
		),
	);

	return $gallery_options;
}

add_action( 'after_setup_theme', 'shandora_add_post_type', 2 );

/**
 * Init the Post Type
 * 
 * @see shandora_setup_listing_post_type()
 * @see shandora_setup_agent_post_type()
 * @see shandora_setup_car_dealer_post_type()
 * @see shandora_setup_sales_rep_post_type()()
 * @see shandora_setup_boat_dealer_post_type()
 *
 * @filesource shandora/includes/post-types/
 *
 */
function shandora_add_post_type(){

	if(bon_get_option('enable_property_listing', 'yes') == 'yes') {
		add_action('init', 'shandora_setup_listing_post_type', 1);
		add_action('init', 'shandora_setup_agent_post_type', 1);
		// Added by Lech Dutkiewicz
		add_action('init', 'shandora_setup_addon_post_type', 1);
		//add_action('init', 'shandora_setup_service_post_type', 1);
		add_action('init', 'shandora_setup_home_feature_post_type', 1);
		add_action('init', 'shandora_setup_additional_service_post_type', 1);
		add_action('init', 'shandora_setup_faq_post_type', 1);
		add_action('init', 'shandora_setup_testimonials_post_type', 1);
		add_action('init', 'shandora_setup_ebooks_post_type', 1);
		add_action('init', 'shandora_setup_promotions_post_type', 1);
		add_action('init', 'shandora_setup_regular_post_type', 1);
	}
	
}


add_action( 'init', 'shandora_page_meta' );

if( !function_exists('shandora_page_meta') ) {

	function shandora_page_meta() {

		$prefix = bon_get_prefix();

		if(is_admin()) {

			global $bon;

			$mb = $bon->mb();

			$fields = array(

				array(
					'id' => $prefix . 'slideshow_type',
					'type' => 'select',
					'label' => __('Slide Show Type', 'bon'),
					'options' => array(
						'full' => __('Full', 'bon'),
						'boxed' => __('Boxed', 'bon')
					)
				),


				array(
					'id' => $prefix . 'slideshow_ids',
					'type' => 'text',
					'label' => __('Slide show IDs to Show (optional)', 'bon'),
					'desc' => __('Input the slideshow ids you want to show separated by commas, if empty all latest slider post will be used.', 'bon')
				),

			);

			$mb->create_box('slider-opt', __('Slider Options', 'bon'), $fields, array('page'));
		}
	}
}

add_action('init', 'shandora_property_page_meta', 50 );
if( !function_exists( 'shandora_property_page_meta' ) ) {
	function shandora_property_page_meta() {
		if(is_admin() && bon_get_option('enable_property_listing') == 'yes') {

			global $bon;

			$mb = $bon->mb();

			$opts = shandora_get_search_option( 'status' );
			$opts['featured'] = __('Featured', 'bon');

			$fields = array(
				array(
					'id' => 'shandora_status_query',
					'type' => 'select',
					'label' => __('Property Status to Query','bon'),
					'options' => $opts
				),
				array(
					'id' => 'shandora_location_query',
					'type' => 'select',
					'label' => __('Property Location to Query','bon'),
					'desc' => __( 'Optional - leave empty to not include location' ,'bon'),
					'options' => shandora_get_search_option('location'),
				),

				array(
					'id' => 'shandora_type_query',
					'type' => 'select',
					'label' => __('Property Type to Query','bon'),
					'desc' => __( 'Optional - leave empty to not include location' ,'bon'),
					'options' => shandora_get_search_option('type'),
				),
			);

			$mb->create_box('status-opt', __('Property Status', 'bon'), $fields, array('page'));

		}
	}
}

add_action( 'init', 'shandora_car_page_meta', 50 );
if( !function_exists('shandora_car_page_meta') ) {
	function shandora_car_page_meta() {
		if(is_admin() && bon_get_option('enable_car_listing') == 'yes' ) {
			global $bon;

			$mb = $bon->mb();

			$opts = shandora_get_car_search_option( 'status' );
			$opts['featured'] = __('Featured', 'bon');

			$fields = array(
				array(
					'id' => 'shandora_car_status_query',
					'type' => 'select',
					'label' => __('Car Status to Query','bon'),
					'options' => $opts
				),
				array(
					'id' => 'shandora_dealer_location_query',
					'type' => 'select',
					'label' => __('Dealer Location to Query','bon'),
					'desc' => __( 'Optional - leave empty to not include location' ,'bon'),
					'options' => shandora_get_car_search_option('dealer_location'),
				),

				array(
					'id' => 'shandora_body_type_query',
					'type' => 'select',
					'label' => __('Body Type to Query','bon'),
					'desc' => __( 'Optional - leave empty to not include location' ,'bon'),
					'options' => shandora_get_car_search_option('body_type'),
				),

				array(
					'id' => 'shandora_manufacturer_query',
					'type' => 'select',
					'label' => __('Manufacturer to Query','bon'),
					'desc' => __( 'Optional - leave empty to not include location' ,'bon'),
					'options' => shandora_get_car_search_option('manufacturer'),
				),
			);

			$mb->create_box('car-status-opt', __('Car Status', 'bon'), $fields, array('page'));
		}
	}
}


/**
 * 
 * Defining new table column in All Polls View
 * 
 **/
if( !function_exists('shandora_listing_custom_columns') ) {

	function shandora_listing_custom_columns($columns){  

	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />",  
	            "title" => __( 'Poll Title','bon' ),
	            "price" => __( 'Price','bon' ),
	            "type" => __( 'Type', 'bon' ),
	            "status" => __( 'Status','bon' ),
	            "date" => __( 'Date','bon' ),
	        );  
	  
	        return $columns;  
	}   

	add_filter("manage_edit-listing_columns", "shandora_listing_custom_columns");

}

/**
 * 
 * Defining new table column in All Polls View
 * 
 **/
if( !function_exists('shandora_car_custom_columns') ) {

	function shandora_car_custom_columns($columns){  

	        $columns = array(  
	            "cb" => "<input type=\"checkbox\" />",  
	            "title" => __( 'Poll Title','bon' ),
	            "price" => __( 'Price','bon' ),
	            "car_status" => __( 'Status','bon' ),
	            "yearbuilt" => __( 'Year Built','bon' ),
	            "date" => __( 'Date','bon' )
	        );  
	  
	        return $columns;  
	}   

	add_filter("manage_edit-car-listing_columns", "shandora_car_custom_columns");

}

/**
 * 
 * Adding output to new table column in All Polls View
 * 
 **/
if( !function_exists('shandora_manage_columns') ) {
	
	function shandora_manage_columns($name) {
		global $post;

		switch ($name) {
			case 'status':
				$s_opt = shandora_get_search_option( 'status' );
				$status = shandora_get_meta( $post->ID, 'listing_status' );
				if( array_key_exists( $status, $s_opt) ) {
					$status = $s_opt[$status];
				}
				echo $status;
			break;

			case 'car_status':
				$s_opt = shandora_get_car_search_option( 'status' );
				$status = shandora_get_meta( $post->ID, 'listing_status' );
				if( array_key_exists( $status, $s_opt) ) {
					$status = $s_opt[$status];
				}
				echo $status;
			break;

			case 'yearbuilt':
				$year = shandora_get_meta( $post->ID, 'listing_yearbuild' );
				echo $year;
			break;

			case 'price':
				$price = shandora_get_meta( $post->ID, 'listing_price', true);
				echo $price;
			break;

			case 'type':
					/* Get the genres for the post. */
				$terms = get_the_terms( $post_id, 'property-type' );

				/* If terms were found. */
				if ( !empty( $terms ) ) {

					$out = array();

					/* Loop through each term, linking to the 'edit posts' page for the specific term. */
					foreach ( $terms as $term ) {
						$out[] = sprintf( '<a href="%s">%s</a>',
							esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'property-type' => $term->slug ), 'edit.php' ) ),
							esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'Property Type', 'display' ) )
						);
					}

					/* Join the terms, separating them with a comma. */
					echo join( ', ', $out );

					//print_r($out);
				}

				/* If no terms were found, output a default message. */
				else {
					_e( 'No category found' );
				}

			break;

		}
	}

	add_action('manage_posts_custom_column',  'shandora_manage_columns');

}






















?>
