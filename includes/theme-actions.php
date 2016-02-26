<?php

function get_ga_keys()
{

	$keys = array('cat', 'act', 'lbl', 'val');
	return $keys;

}

function get_formatted_event($event)
{

	$keys = get_ga_keys();
	$temp = array();

	foreach ( $event as $key => $description )
	{

		$temp[$keys[$key]] = $description;

	}

	$event = $temp;
	unset($temp);

	return $event;

}

function get_ga_event() {

	$args = func_get_args();

	// remove unnecessary array outside array with args from the_ga_event() call
	if ( is_array($args) && count($args) === 1 )
	{
		$args = $args[0];
	}
	
	// get analytics keys for event description
	$keys = get_ga_keys();

	// check if there are multiple events assigned to single DOM element
	if ( is_array($args[0]) )
	{

		// variable to hold highest amount of attributes
		$attr_amount = 0;

		// assign event keys for each array element with single event
		foreach ( $args as $key => $arg )
		{

			$args[$key] = get_formatted_event($args[$key]);
			$attr_amount = count($args[$key]) > $attr_amount ? count($args[$key]) : $attr_amount;

		}

		// create array which will contain multiple events
		$combined_events = array();

		for ( $i = 0; $i < $attr_amount; $i++ )
		{

			// create adequate keys
			$combined_events[$keys[$i]] = array();

		}

	} else
	{

		$args = get_formatted_event($args);

	}

	// create an empty output varialbe
	$output = '';

	foreach ( $args as $key => $arg )
	{

		// check if there is array with multiple events to run
		if ( is_array($arg) )
		{

			foreach ( $arg as $arg_key => $single_arg )
			{
				
				array_push( $combined_events[$arg_key], $single_arg );

			}

		} else if ( $arg !== '' )
		{

			$output .= 'data-ga-' . $key . '="' . $arg . '" ';

		}

	}

	if ( isset($combined_events) && is_array($combined_events) )
	{
		foreach ( $combined_events as $key => $event )
		{

			if ( $event !== '' )
			{

				$output .= 'data-ga-' . $key . '=\'' . json_encode( $event ) . '\' ';

			}

		}
	}

	
	return $output;

}

function the_ga_event() {

	$args = func_get_args();
	echo get_ga_event( $args );

}

function shandora_get_listing_price( $echo = true, $total = true, $itemprop = false ) {
	global $post;
	$currency = bon_get_option( 'currency' );
	$placement = bon_get_option( 'currency_placement' );
	$prefix = bon_get_prefix();

	if ( $total ) {
// edited by Lech Dutkiewicz
		$price = shandora_get_meta( $post->ID, 'listing_price', true );
		$data_price = get_post_meta( $post->ID, $prefix . 'listing_price', true );
	} else {
		$price = shandora_get_meta( $post->ID, 'listing_monprice', true );
		$data_price = get_post_meta( $post->ID, $prefix . 'listing_monprice', true );
	}

	if ( $itemprop ) {
		// setup microdata parameters
		$itemprop_1 = ' itemprop="offers" itemscope itemtype="http://schema.org/Offer"';
		$itemprop_2 = ' itemprop="price"';
		$itemprop_3 = '<meta itemprop="priceCurrency" content="' . $currency . '" />';
	} else {
		$itemprop_1 = '';
		$itemprop_2 = '';
		$itemprop_3 = '';
	}
	
	$priceBegin = '<span class="item-price"' . $itemprop_1 . '><span' . $itemprop_2 . ' data-value="' . $data_price . '">' . $price . '</span>';
	$priceBegin .= $itemprop_3;

	$priceEnd = '</span>';


	$o = '';

	switch ( $placement ) {

		case 'left-space':
		$format = $currency . ' ' . $priceBegin . $priceEnd;
		break;

		case 'right':
		$format = $priceBegin . $currency . $priceEnd;
		break;

		case 'right-space':
		$format = $priceBegin . ' ' . $currency . $priceEnd;
		break;

		default:
		$format = $currency . $priceBegin . $priceEnd;
		break;
	}

	$o .= shandora_get_rent_period( $format );

	if ( $echo ) {
		echo $o;
	} else {
		return $o;
	}
}

function shandora_get_price_meta( $postID, $price = NULL ) {


	$currency = bon_get_option( 'currency' );
	$placement = bon_get_option( 'currency_placement' );
	if ( $price === NULL ) {
		$price = shandora_get_meta( $postID, 'listing_price', true );		
	}

	switch ( $placement ) {

		case 'left-space':
		$price = $currency . ' ' . $price;
		break;

		case 'right':
		$price = $price . $currency;
		break;

		case 'right-space':
		$price = $price . ' ' . $currency;
		break;

		default:
		$price = $currency . $price;
		break;
	}

	return $price;
}

function shandora_get_rent_period( $price ) {
	global $post;

	$status = shandora_get_meta( $post->ID, 'listing_status' );
	$period = shandora_get_meta( $post->ID, 'listing_period' );

	$show_period = shandora_get_meta( $post->ID, 'listing_show_period' );

	if ( $status === 'for-sale' || $status === 'sold' ) {
		return $price;
	}

	if ( ( $status === 'for-rent' || $show_period == 'yes' ) ) {

		switch ( $period ) {
			case 'per-day':
			$price .= ' <span class="rent-period">/' . __( 'day', 'bon' ) . '</span>';
			break;

			case 'per-week':
			$price .= ' <span class="rent-period">/' . __( 'week', 'bon' ) . '</span>';
			break;

			case 'per-year':
			$price .= ' <span class="rent-period">/' . __( 'year', 'bon' ) . '</span>';
			break;

			case 'per-month':
			$price .= ' <span class="rent-period">/' . __( 'month', 'bon' ) . '</span>';
			break;

			default:
			$price;
			break;
		}
	}

	return $price;
}

/**
 * =====================================================================================================
 *
 * Setup a search listing form
 * Created using global $bon->form() instance
 *
 *
 * @since 1.0
 *
 * ======================================================================================================
 */
function shandora_search_listing_form() {

	$show_idx = bon_get_option( 'use_idx_search' );

	if ( defined( "DSIDXPRESS_OPTION_NAME" ) && $show_idx == 'yes' ) {
		$options = get_option( DSIDXPRESS_OPTION_NAME );
		if ( $options["Activated"] ) {
			shandora_get_search_listing_form_idx();
		} else {
			echo 'Please Activate Your IDX Account.';
		}
	} else {
		echo shandora_get_search_listing_form();
	}
}

function shandora_get_search_page_url() {

	$search_page = bon_get_option( 'search_listing_page' );
	$permalink_active = get_option( 'permalink_structure' );

	if ( $permalink_active != '' ) {

		if ( function_exists( 'icl_get_languages' ) ):

			$languages = icl_get_languages( 'skip_missing=0&orderby=custom' );

		if ( count( $languages ) >= 1 ):

			foreach ( (array) $languages as $language ):

				if ( $language['active'] == 1 ) :

					$id = icl_object_id( $search_page, 'post', false, ICL_LANGUAGE_CODE );
				if ( $id ) {
					$page = get_post( $id );
					$slug = $page->post_name;
					$search_permalink = trailingslashit( home_url() ) . $language['code'] . $slug;
				} else {
					$search_permalink = get_permalink( $search_page );
				}

				endif;

				endforeach;

				endif;

				else :

					$search_permalink = get_permalink( $search_page );

				endif;
			} else {

				return;
			}

			return $search_permalink;
		}

		function shandora_get_search_listing_form( $is_widget = false ) {

			global $bon;

			$values = array();
			$values['property_type'] = isset( $_COOKIE['property_type'] ) ? $_COOKIE['property_type'] : '';
			$values['title'] = isset( $_COOKIE['title'] ) ? $_COOKIE['title'] : '';
			$values['property_location'] = isset( $_COOKIE['property_location'] ) ? $_COOKIE['property_location'] : '';
			$values['property_location_level1'] = isset( $_COOKIE['property_location_level1'] ) ? $_COOKIE['property_location_level1'] : '';
			$values['property_location_level2'] = isset( $_COOKIE['property_location_level2'] ) ? $_COOKIE['property_location_level2'] : '';
			$values['property_location_level3'] = isset( $_COOKIE['property_location_level3'] ) ? $_COOKIE['property_location_level3'] : '';
			$values['dealer_location_level1'] = isset( $_COOKIE['dealer_location_level1'] ) ? $_COOKIE['dealer_location_level1'] : '';
			$values['dealer_location_level2'] = isset( $_COOKIE['dealer_location_level2'] ) ? $_COOKIE['dealer_location_level2'] : '';
			$values['dealer_location_level3'] = isset( $_COOKIE['dealer_location_level3'] ) ? $_COOKIE['dealer_location_level3'] : '';
			$values['property_status'] = isset( $_COOKIE['property_status'] ) ? $_COOKIE['property_status'] : '';
			$values['property_bath'] = isset( $_COOKIE['property_bath'] ) ? $_COOKIE['property_bath'] : '';
			$values['property_bed'] = isset( $_COOKIE['property_bed'] ) ? $_COOKIE['property_bed'] : '';
			$values['max_price'] = isset( $_COOKIE['max_price'] ) ? $_COOKIE['max_price'] : '';
			$values['min_price'] = isset( $_COOKIE['min_price'] ) ? $_COOKIE['min_price'] : '';
			$values['max_lotsize'] = isset( $_COOKIE['max_lotsize'] ) ? $_COOKIE['max_lotsize'] : '';
			$values['min_lotsize'] = isset( $_COOKIE['min_lotsize'] ) ? $_COOKIE['min_lotsize'] : '';
			$values['max_buildingsize'] = isset( $_COOKIE['max_buildingsize'] ) ? $_COOKIE['max_buildingsize'] : '';
			$values['min_buildingsize'] = isset( $_COOKIE['min_buildingsize'] ) ? $_COOKIE['min_buildingsize'] : '';
			$values['property_mls'] = isset( $_COOKIE['property_mls'] ) ? $_COOKIE['property_mls'] : '';
			$values['property_zip'] = isset( $_COOKIE['property_zip'] ) ? $_COOKIE['property_zip'] : '';
			$values['property_feature'] = isset( $_COOKIE['property_feature'] ) ? $_COOKIE['property_feature'] : '';
			$values['property_agent'] = isset( $_COOKIE['property_agent'] ) ? $_COOKIE['property_agent'] : '';
			$values['property_floor'] = isset( $_COOKIE['property_floor'] ) ? $_COOKIE['property_floor'] : '';
			$values['property_basement'] = isset( $_COOKIE['property_basement'] ) ? $_COOKIE['property_basement'] : '';
			$values['property_garage'] = isset( $_COOKIE['property_garage'] ) ? $_COOKIE['property_garage'] : '';
			$values['property_mortgage'] = isset( $_COOKIE['property_mortgage'] ) ? $_COOKIE['property_mortgage'] : '';

			$values['reg_number'] = isset( $_COOKIE['reg_number'] ) ? $_COOKIE['reg_number'] : '';
			$values['dealer_location'] = isset( $_COOKIE['dealer_location'] ) ? $_COOKIE['dealer_location'] : '';
			$values['car_feature'] = isset( $_COOKIE['car_feature'] ) ? $_COOKIE['car_feature'] : '';
			$values['body_type'] = isset( $_COOKIE['body_type'] ) ? $_COOKIE['body_type'] : '';
			$values['manufacturer'] = isset( $_COOKIE['manufacturer'] ) ? $_COOKIE['manufacturer'] : '';
			$values['manufacturer_level1'] = isset( $_COOKIE['manufacturer_level1'] ) ? $_COOKIE['manufacturer_level1'] : '';
			$values['manufacturer_level2'] = isset( $_COOKIE['manufacturer_level2'] ) ? $_COOKIE['manufacturer_level2'] : '';
			$values['manufacturer_level3'] = isset( $_COOKIE['manufacturer_level3'] ) ? $_COOKIE['manufacturer_level3'] : '';

			$values['car_status'] = isset( $_COOKIE['car_status'] ) ? $_COOKIE['car_status'] : '';
			$values['fuel_type'] = isset( $_COOKIE['fuel_type'] ) ? $_COOKIE['fuel_type'] : '';
			$values['transmission'] = isset( $_COOKIE['transmission'] ) ? $_COOKIE['transmission'] : '';
			$values['ancap'] = isset( $_COOKIE['ancap'] ) ? $_COOKIE['ancap'] : '';
			$values['min_mileage'] = isset( $_COOKIE['min_mileage'] ) ? $_COOKIE['min_mileage'] : '';
			$values['max_mileage'] = isset( $_COOKIE['max_mileage'] ) ? $_COOKIE['max_mileage'] : '';
			$values['exterior_color'] = isset( $_COOKIE['exterior_color'] ) ? $_COOKIE['exterior_color'] : '';
			$values['interior_color'] = isset( $_COOKIE['interior_color'] ) ? $_COOKIE['interior_color'] : '';
			$values['yearbuilt'] = isset( $_COOKIE['yearbuilt'] ) ? $_COOKIE['yearbuilt'] : '';

			$values['min_yearbuilt'] = isset( $_COOKIE['min_yearbuilt'] ) ? $_COOKIE['min_yearbuilt'] : '';
			$values['max_yearbuilt'] = isset( $_COOKIE['max_yearbuilt'] ) ? $_COOKIE['max_yearbuilt'] : '';

			$output = apply_atomic( 'search_listing_form', '', $values, $is_widget );

			if ( !empty( $output ) ) {
				return $output;
			}

			$button_color = bon_get_option( 'search_button_color', 'red' );
			$form = $bon->form();

	$ro = '<div class="row search-listing-form">'; // row open
	$rc = '</div>';  // row close
	$cc = $rc; //column close

	if ( !$is_widget ) {
		$co = '<div class="large-4 column form-column small-11 small-centered large-uncentered">'; // column open
	} else {
		$co = '<div class="large-12 column form-column small-11 small-centered large-uncentered">';
	}

	$row_1 = bon_get_option( 'search_row_1' );
	$row_2 = bon_get_option( 'search_row_2' );
	$row_3 = bon_get_option( 'search_row_3' );
	$row_count = 3;

	if ( !$row_1 && !$row_2 && !$row_3 ) {
		return '<p style="margin-top: 50px">' . 'Please setup your search fields in Shandora > Theme Settings > Listing Settings > Custom Search Field' . '</p>';
	}

	$search_permalink = shandora_get_search_page_url();

	$output = $form->form_open( $search_permalink, 'method="get" class="custom" id="search-listing-form"' );

	$output .= $ro;

	if ( !$is_widget ) {
		$output .= '<div class="column large-10 small-12 large-uncentered small-centered">';
	} else {
		$output .= '<div class="column large-12 small-12 large-uncentered small-centered">';
	}


	for ( $row_i = 1; $row_i <= $row_count; $row_i++ ) {

		if ( ${"row_{$row_i}"} ) {

			for ( $col_i = 1; $col_i <= 3; $col_i++ ) {

				if ( $col_i == 1 ) {
					$output .= $ro;
				}

				$field_type = bon_get_option( 'search_row_' . $row_i . '_col_' . $col_i );
				if ( $field_type != 'none' ) {
					$func = "shandora_search_" . $field_type . "_field";
				} else {
					$func = '';
				}


				$class = '';

				$select_field = array(
					'status',
					'location',
					'location_level1',
					'location_level2',
					'location_level3',
					'dealer_location_level1',
					'dealer_location_level2',
					'dealer_location_level3',
					'feature',
					'mortgage',
					'type',
					'agent',
					'car_status',
					'dealer_location',
					'body_type',
					'car_feature',
					'manufacturer',
					'transmission',
					'manufacturer_level1',
					'manufacturer_level2',
					'manufacturer_level3',
					'yearbuilt',
					'fuel_type',
					);

				if ( !$is_widget ) {

					if ( $row_i >= 3 ) {
						$class = 'no-mbot';
					}

					if ( in_array( $field_type, $select_field ) ) {
						$class .= ' select-dark';
					}
				}

				$output .= $co;
				if ( function_exists( $func ) ) {
					$output .= $func( $values, $class );
				}
				$output .= $cc;

				if ( $col_i >= 3 ) {
					$output .= $rc;
				}
			}

			if ( $col_i < 3 ) {
				$output .= $rc;
			}
		}
	}


	$output .= $cc;

	$search_label = bon_get_option( 'search_button_label', __( 'Find Property', 'bon' ) );

	if ( !$is_widget ) {
		$output .= '<div class="column large-2 small-11 large-uncentered small-centered" id="submit-button">';
		$output .= wp_nonce_field( 'search-panel-submit', 'search_nonce', false, false );
		$output .= $form->form_submit( '', $search_label, 'class="button expand flat ' . $button_color . ' radius"' );
	} else {
		$output .= '<div class="column large-12 small-11 large-uncentered small-centered" style="margin-top: 1em;">';
		$output .= wp_nonce_field( 'search-panel-submit', 'search_nonce', false, false );
		$output .= $form->form_submit( '', $search_label, 'class="button flat ' . $button_color . ' radius"' . get_ga_event( "Sidebar", "Search Products" ) );
	}

	if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
		$output .= '<input type="hidden" name="lang" value="' . ICL_LANGUAGE_CODE . '"/>';
	}

	$permalink_active = get_option( 'permalink_structure' );

	if ( $permalink_active == '' ) {
		$search_page = bon_get_option( 'search_listing_page' );
		$output .= '<input type="hidden" name="page_id" value="' . $search_page . '"/>';
	}

	$output .= $cc . $rc;

	$output .= $form->form_close();

	return $output;
}

function shandora_get_search_listing_form_idx() {

	global $bon;

	$options = get_option( DSIDXPRESS_OPTION_NAME );

	if ( !$options["Activated"] )
		return;

	$pluginUrl = plugins_url() . '/dsidxpress/';

	wp_enqueue_script( 'dsidxpress_widget_search_view', $pluginUrl . 'js/widget-client.js', array( 'jquery' ), DSIDXPRESS_PLUGIN_VERSION, true );

	$formAction = get_home_url() . "/idx/";

	$defaultSearchPanels = dsSearchAgent_ApiRequest::FetchData( "AccountSearchPanelsDefault", array(), false, 60 * 60 * 24 );
	$defaultSearchPanels = $defaultSearchPanels["response"]["code"] == "200" ? json_decode( $defaultSearchPanels["body"] ) : null;
	$propertyTypes = dsSearchAgent_ApiRequest::FetchData( "AccountSearchSetupFilteredPropertyTypes", array(), false, 60 * 60 * 24 );
	$propertyTypes = $propertyTypes["response"]["code"] == "200" ? json_decode( $propertyTypes["body"] ) : null;

	$account_options = dsSearchAgent_ApiRequest::FetchData( "AccountOptions", array(), false );
	if ( $account_options && isset( $account_options['response'] ) ) {
		$account_options = $account_options["response"]["code"] == "200" ? json_decode( $account_options["body"] ) : null;
	}

	$autoload_options = bon_get_option( 'idx_enable_search_autoload' );


	if ( $autoload_options == 'no' ) {

		$manual_city = explode( "\n", bon_get_option( 'idx_manual_city' ) );
		sort( $manual_city );

		$manual_community = explode( "\n", bon_get_option( 'idx_manual_community' ) );
		sort( $manual_community );

		$manual_tract = explode( "\n", bon_get_option( 'idx_manual_tract' ) );
		sort( $manual_tract );

		$manual_zip = explode( "\n", bon_get_option( 'idx_manual_zip' ) );
		sort( $manual_zip );



		$searchOptions = array(
			'cities' => $manual_city,
			'communities' => $manual_community,
			'tracts' => $manual_tract,
			'zips' => $manual_zip,
			);
	} else {
		$searchOptions = array(
			'cities' => shandora_get_idx_options( 'City' ),
			'communities' => shandora_get_idx_options( 'Community' ),
			'tracts' => shandora_get_idx_options( 'Tract' ),
			'zips' => shandora_get_idx_options( 'Zip' ),
			);
	}

	$ro = '<div class="row search-listing-form">'; // row open
	$rc = '</div>';  // row close
	$cc = $rc; //column close
	$co = '<div class="large-4 column form-column small-11 small-centered large-uncentered">'; // column open
	?>

	<form id="search-listing-form" action="<?php echo $formAction; ?>" method="get" class="custom" onsubmit="return dsidx_w.searchWidget.validate();" >
		<?php echo $ro . '<div class="column large-10 small-12 large-uncentered small-centered">' . $ro; ?>


		<?php echo $co; ?>
		<label for="idx-q-PropertyTypes"><?php _e( 'Property Type', 'bon' ); ?></label>
		<select name="idx-q-PropertyTypes" class="select-dark dsidx-search-widget-propertyTypes">
			<option value=""><?php _e( 'All Property Types', 'bon' ); ?></option>

			<?php
			if ( is_array( $propertyTypes ) ) {
				foreach ( $propertyTypes as $propertyType ) {
					$name = htmlentities( $propertyType->DisplayName );
					?>
					<option value="<?php echo $propertyType->SearchSetupPropertyTypeID; ?>" <?php selected( 'idx-q-PropertyTypes', $propertyType->SearchSetupPropertyTypeID ); ?>><?php echo $name; ?></option>
					<?php
				}
			}
			?>
		</select>
		<label id="idx-search-invalid-msg" style="color:red"></label>
		<?php echo $cc; ?>
		<?php echo $co; ?>
		<label for="idx-q-Cities"><?php _e( 'City', 'bon' ); ?></label>
		<select id="idx-q-Cities" name="idx-q-Cities" class="select-dark idx-q-Location-Filter">
			<option value=""><?php _e( 'Any', 'bon' ); ?></option>
			<?php
			if ( !empty( $searchOptions['cities'] ) ) {
				foreach ( $searchOptions["cities"] as $city ) {
					// there's an extra trim here in case the data was corrupted before the trim was added in the update code below
					$city = ($autoload_options == 'no') ? htmlentities( trim( $city ) ) : htmlentities( trim( $city->Name ) );
					?>

					<option value="<?php echo $city; ?>" <?php selected( 'idx-q-Cities', $city ); ?>><?php echo $city; ?></option>
					<?php
				}
			}
			?>
		</select>
		<?php echo $cc; ?>
		<?php echo $co; ?>
		<?php
		$bed_opt = absint( bon_get_option( 'maximum_bed', 5 ) );
		if ( !is_int( $bed_opt ) ) {
			$bed_opt = 5;
		}
		?>

		<label for="idx-q-BedsMin"><?php _e( 'Beds', 'bon' ); ?></label>
		<!--<input id="idx-q-BedsMin" name="idx-q-BedsMin" type="text" class="dsidx-beds" placeholder="min bedrooms" /> -->
		<div class="ui-slider-wrapper-custom beds-wrapper">
			<select name="idx-q-BedsMin" id="idx-q-BedsMin" class="bon-dsidx-beds2 dsidx-beds no-custom select-slider">
				<option value=""><?php _e( 'Any', 'bon' ); ?></option>
				<?php
				for ( $i = 1; $i <= $bed_opt; $i++ ) {
					?>
					<option value="<?php echo $i; ?>" <?php selected( 'idx-q-BedsMin', $i ); ?>><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</div>
			<?php echo $cc . $rc; ?>

			<?php echo $ro . $co; ?>
			<label for="idx-q-TractIdentifiers"><?php _e( 'Tract', 'bon' ); ?></label>
			<select id="idx-q-TractIdentifiers" name="idx-q-TractIdentifiers" class="select-dark idx-q-Location-Filter">
				<option value=""><?php _e( 'Any', 'bon' ); ?></option>
				<?php
				if ( !empty( $searchOptions['tracts'] ) ) {
					foreach ( $searchOptions["tracts"] as $tract ) {
					// there's an extra trim here in case the data was corrupted before the trim was added in the update code below
						$tract = ($autoload_options == 'no') ? htmlentities( trim( $tract ) ) : htmlentities( trim( $tract->Name ) );
						?>
						<option value="<?php echo $tract; ?>" <?php selected( 'idx-q-TractIdentifiers', $tract ); ?>><?php echo $tract; ?></option>
						<?php
					}
				}
				?>
			</select>
			<?php echo $cc; ?>
			<?php echo $co; ?>
			<label for="idx-q-ZipCodes"><?php _e( 'Zip', 'bon' ); ?></label>
			<select id="idx-q-ZipCodes" name="idx-q-ZipCodes" class="select-dark idx-q-Location-Filter">
				<option value=""><?php _e( 'Any', 'bon' ); ?></option>
				<?php
				if ( !empty( $searchOptions['zips'] ) ) {
					foreach ( $searchOptions["zips"] as $zip ) {
					// there's an extra trim here in case the data was corrupted before the trim was added in the update code below
						$zip = ($autoload_options == 'no') ? htmlentities( trim( $zip ) ) : htmlentities( trim( $zip->Name ) );
						?>
						<option value="<?php echo $zip; ?>" <?php selected( 'idx-q-ZipCodes', $zip ); ?>><?php echo $zip; ?></option>
						<?php
					}
				}
				?>
			</select>
			<?php echo $cc; ?>
			<?php echo $co; ?>
			<?php
			$bath_opt = absint( bon_get_option( 'maximum_bath', 5 ) );
			if ( !is_int( $bath_opt ) ) {
				$bath_opt = 5;
			}
			?>
			<label for="idx-q-BathsMin"><?php _e( 'Baths', 'bon' ); ?></label>
			<div class="ui-slider-wrapper-custom baths-wrapper">
				<select name="idx-q-BathsMin" id="idx-q-BathsMin" class="bon-dsidx-baths2 dsidx-baths no-custom select-slider">
					<option value=""><?php _e( 'Any', 'bon' ); ?></option>
					<?php
					for ( $i = 1; $i <= $bath_opt; $i++ ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( 'idx-q-BathsMin', $i ); ?>><?php echo $i; ?></option>
						<?php } ?>
					</select>
				</div>
				<?php echo $cc . $rc; ?>

				<?php echo $ro . $co; ?>
				<label for="idx-q-Communities"><?php _e( 'Community', 'bon' ); ?></label>
				<select id="idx-q-Communities" name="idx-q-Communities" class="select-dark idx-q-Location-Filter">
					<option value=""><?php _e( 'Any', 'bon' ); ?></option>
					<?php
					if ( !empty( $searchOptions['communities'] ) ) {
						foreach ( $searchOptions["communities"] as $community ) {
					// there's an extra trim here in case the data was corrupted before the trim was added in the update code below
							$community = ($autoload_options == 'no') ? htmlentities( trim( $community ) ) : htmlentities( trim( $community->Name ) );
							?>
							<option value="<?php echo $community; ?>" <?php selected( 'idx-q-Communities', $community ); ?>><?php echo $community; ?></option>
							<?php
						}
					}
					?>
				</select>
				<?php echo $cc; ?>
				<?php echo $co; ?>
				<label for="idx-q-MlsNumbers"><?php _e( 'MLS #', 'bon' ); ?></label>
				<input id="idx-q-MlsNumbers" name="idx-q-MlsNumbers" type="text" class="dsidx-mlsnumber" value="<?php isset( $_GET['idx-q-MlsNumbers'] ) ? $_GET['idx-q-MlsNumbers'] : ''; ?>" />

				<?php echo $cc; ?>
				<?php echo $co; ?>

				<label for="idx-q-PriceMin"><?php _e( 'Price Range', 'bon' ); ?>
					<span class="price-text" id="idx-min-price-text"></span>
					<span class="price-text" id="idx-max-price-text"></span>
				</label>
				<div class="price-slider-wrapper ui-slider-wrapper-custom">
					<div id="idx-slider-range2"></div>
				</div>
				<input id="idx-q-PriceMin" name="idx-q-PriceMin" type="hidden" class="dsidx-price bon-dsidx-price-min2" value="<?php isset( $_GET['idx-q-PriceMin'] ) ? $_GET['idx-q-PriceMin'] : ''; ?>" placeholder="min price" />
				<input id="idx-q-PriceMax" name="idx-q-PriceMax" type="hidden" class="dsidx-price bon-dsidx-price-max2" value="<?php isset( $_GET['idx-q-PriceMax'] ) ? $_GET['idx-q-PriceMax'] : ''; ?>" placeholder="max price" />

				<?php echo $cc . $rc . $cc; ?>
				<div class="column large-2 small-11 large-uncentered small-centered" id="submit-button">
					<?php
					$button_color = bon_get_option( 'search_button_color', 'red' );
					$search_label = bon_get_option( 'search_button_label', __( 'Find Property', 'bon' ) );
					?>
					<input type="submit" class="button flat <?php echo $button_color; ?> expand small radius submit" value="<?php echo $search_label; ?>" />
				</div>
			</div>
		</form>

		<?php
	}

	function shandora_get_searchform( $location = "", $button = false ) {

		if ( $location != "header" ) {
			$output = "";
		} else {
			$output = '
			<div class="searchform">
			<form role="search" method="get" class="search hidden-phone" id="searchform" action="' . home_url( '/' ) . '" >
			<i class="icon sha-zoom"></i><input class="input-medium" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr( __( 'Search the Site...', 'bon' ) ) . '" />
			</form></div>';
		}

		echo $output;
	}

	function shandora_get_social_icons( $header = true ) {
		if ( $header ) {
			$id = 'top-social-icons';
			$class = 'right social-icons';
			$navclass = 'large-6 column right';
		} else {
			$id = 'footer-social-icons';
			$class = 'social-icons';
			$navclass = '';
		}

		$output = '<nav class="' . $navclass . '">
		<ul class="' . $class . '" id="' . $id . '">';

		if ( function_exists( 'icl_get_languages' ) ) {
			$output .= shandora_get_country_selection();
		}

		if ( bon_get_option( 'social_facebook' ) ) {
			$output .= '<li><a href="http://facebook.com/' . bon_get_option( 'social_facebook' ) . '" title="' . __( 'Follow us on Facebook', 'bon' ) . '"><span class="sha-facebook"></span></a></li>';
		}
		if ( bon_get_option( 'social_twitter' ) ) {
			$output .= '<li><a href="http://twitter.com/' . bon_get_option( 'social_twitter' ) . '" title="' . __( 'Follow us on Twitter', 'bon' ) . '"><span class="sha-twitter"></span></a></li>';
		}
		if ( bon_get_option( 'social_google_plus' ) ) {
			$output .= '<li><a href="http://plus.google.com/' . bon_get_option( 'social_google_plus' ) . '" title="' . __( 'Follow us on Google Plus', 'bon' ) . '"><span class="sha-googleplus"></span></a></li>';
		}
		if ( bon_get_option( 'social_pinterest' ) ) {
			$output .= '<li><a href="http://pinterest.com/' . bon_get_option( 'social_pinterest' ) . '" title="' . __( 'Follow us on Pinterest', 'bon' ) . '"><span class="sha-pinterest"></span></a></li>';
		}
		if ( bon_get_option( 'social_flickr' ) ) {
			$output .= '<li><a href="http://flickr.com/photos/' . bon_get_option( 'social_flickr' ) . '" title="' . __( 'Follow us on Flickr', 'bon' ) . '"><span class="sha-flickr"></span></a></li>';
		}
		if ( bon_get_option( 'social_vimeo' ) ) {
			$output .= '<li><a href="http://vimeo.com/' . bon_get_option( 'social_vimeo' ) . '" title="' . __( 'Find us on Vimeo', 'bon' ) . '"><span class="sha-vimeo"></span></a></li>';
		}
		if ( bon_get_option( 'social_youtube' ) ) {
			$output .= '<li><a href="http://youtube.com/' . bon_get_option( 'social_youtube' ) . '" title="' . __( 'Find us on YouTube', 'bon' ) . '"><span class="sha-youtube"></span></a></li>';
		}
		if ( bon_get_option( 'social_linkedin' ) ) {
			$output .= '<li><a href="http://linkedin.com/' . bon_get_option( 'social_linkedin' ) . '" title="' . __( 'Find us on LinkedIn', 'bon' ) . '"><span class="sha-linkedin"></span></a></li>';
		}

		$output .= '</ul></nav>';

		echo $output;
	}

/**
 * =====================================================================================================
 *
 * Setup Helper Function
 *
 *
 * @since 1.0
 *
 * ======================================================================================================
 */
function shandora_get_meta( $postID, $args, $is_number = false, $esc_attr = true ) {
	$prefix = bon_get_prefix();

	$price_format = bon_get_option( 'price_format', 'comma' );


	if ( $is_number ) {

		$m = get_post_meta( $postID, $prefix . $args, true ) + 0;

		if ( is_float( $m ) ) {
			if ( $price_format == 'comma' ) {
				$meta = esc_attr( number_format( (double) $m, 2, '.', ',' ) );
			} else {
				$meta = esc_attr( number_format( (double) $m, 2, ',', '.' ) );
			}
		} else {
			if ( $price_format == 'comma' ) {
				$meta = esc_attr( number_format( (double) $m, 0, '.', ',' ) );
			} else {
				$meta = esc_attr( number_format( (double) $m, 0, ',', '.' ) );
			}
		}
	} elseif ( $esc_attr === true ) {
		$meta = esc_attr( get_post_meta( $postID, $prefix . $args, true ) );
	} elseif ( $esc_attr === false ) {
		$meta = get_post_meta( $postID, $prefix . $args, true );
	}

	return $meta;
}

function shandora_get_price_range( $type = '' ) {

	$o = array();

	$step = bon_get_option( 'price_range_step', '5000' );

	$o['min'] = shandora_get_searchfield_range( 'price', $step, false );
	$o['max'] = shandora_get_searchfield_range( 'price', $step, true );
	$o['step'] = $step;

	return $o;
}

function shandora_get_searchfield_range( $fieldtype, $step, $highest = true ) {

	$val = "";

	// Find highest / lowest in range
	// query post with highest / lowest meta value

	$loop_args = array(
		'post_type' => 'listing',
		'posts_per_page' => 1,
		'orderby' => 'meta_value_num',
		'order' => $highest ? 'DESC' : 'ASC',
		'meta_query' => array(
			array(
				'key' => bon_get_prefix() . 'listing_' . $fieldtype
				),
			),
		);

	$loop = new WP_Query( $loop_args );

	// print_r($loop);

	if ( $loop->have_posts() ) {

		$post = $loop->post;

		// assign max size to variable
		$val = get_post_meta( $post->ID, bon_get_prefix() . 'listing_' . $fieldtype, true );
		$val = ceil($val/$step)*$step;

	}

	wp_reset_query();

	return $val;

}

function shandora_get_cottagesize_range() {

	$o = array();

	$step = bon_get_option( 'size_range_step', '5' );

	$o['min'] = shandora_get_searchfield_range( 'lotsize', $step, false );
	$o['max'] = shandora_get_searchfield_range( 'lotsize', $step, true );
	$o['step'] = $step;

	return $o;
}

function shandora_get_idx_price_range() {

	$o = array();

	$min_val = bon_get_option( 'price_range_min', '000' );
	$max_val = bon_get_option( 'price_range_max', '2000000' );
	$step = bon_get_option( 'price_range_step', '5000' );

	$o['min_val'] = $min_val;
	$o['max_val'] = $max_val;
	$o['step'] = $step;

	wp_send_json( $o );
}

function shandora_get_size_range( $type = 'lotsize' ) {

	$o = array();

	$min_val = bon_get_option( 'minimum_' . $type, '000' );
	$max_val = bon_get_option( 'maximum_' . $type, '10000' );
	$step = bon_get_option( 'step_' . $type, '100' );

	$o['min'] = $min_val;
	$o['max'] = $max_val;
	$o['step'] = $step;

	return $o;
}

add_action( 'wp_ajax_price-range', 'shandora_get_idx_price_range' );
add_action( 'wp_ajax_nopriv_price-range', 'shandora_get_idx_price_range' );

function shandora_column_class( $large = 'large-12', $with_small = true ) {

	$small = '';
	if ( $with_small ) {
		$small = 'small-11 small-centered';
	}

	return 'column ' . $large . ' large-uncentered ' . $small;
}

/* Filter the sidebar widgets. */
add_filter( 'sidebars_widgets', 'shandora_disable_sidebars' );
add_action( 'template_redirect', 'shandora_set_theme_column' );

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function shandora_set_theme_column() {

	if ( !is_active_sidebar( 'primary' ) && !is_active_sidebar( 'secondary' ) ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_one_column' );
	} else if ( is_tax( 'property-type' ) ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_property_type' );
	} else if ( is_tax( 'property-feature' ) ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_property_feature' );
	} else if ( is_tax( 'property-location' ) ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_property_location' );
	} else if ( is_tax( 'body-type' ) ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_body_type' );
	} else if ( is_tax( 'car-feature' ) ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_car_feature' );
	} else if ( is_tax( 'dealer-location' ) ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_dealer_location' );
	} else if ( is_tax( 'manufacturer' ) ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_manufacturer' );
	} else if ( is_category() ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_category' );
	} else if ( is_archive() ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_archive' );
	} else if ( is_tag() ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_tag' );
	} else if ( is_page_template( 'page-templates/page-template-idx.php' ) ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_idx' );
	} else if ( is_page_template( 'page-templates/page-template-idx-details.php' ) ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_idx_details' );
	} else if ( is_page_template( 'page-templates/page-template-home.php' ) ||
		is_page_template( 'page-templates/page-template-compare-listings.php' ) ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_one_column' );
	} else if ( is_attachment() && wp_attachment_is_image() ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_theme_layout_one_column' );
	} else if ( get_post_layout( get_queried_object_id() ) == 'default' ) {
		add_filter( 'theme_mod_theme_layout', 'shandora_default_column' );
	}
}

function shandora_default_column() {
	return '2c-l';
}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since  0.1.0
 * @param  string $layout The layout of the current page.
 * @return string
 */
function shandora_theme_layout_one_column( $layout ) {
	return '1c';
}

function shandora_theme_layout_property_type() {
	$layout = bon_get_option( 'property_type_layout' );
	return $layout;
}

function shandora_theme_layout_property_feature() {
	$layout = bon_get_option( 'property_feature_layout' );
	return $layout;
}

function shandora_theme_layout_property_location() {
	$layout = bon_get_option( 'property_location_layout' );
	return $layout;
}

function shandora_theme_layout_category() {
	$layout = bon_get_option( 'category_layout' );
	return $layout;
}

function shandora_theme_layout_archive() {
	$layout = bon_get_option( 'archive_layout' );
	return $layout;
}

function shandora_theme_layout_tag() {
	$layout = bon_get_option( 'tag_layout' );
	return $layout;
}

function shandora_theme_layout_idx() {
	$layout = bon_get_option( 'idx_layout' );
	return $layout;
}

function shandora_theme_layout_idx_details() {
	$layout = bon_get_option( 'idx_details_layout' );
	return $layout;
}

function shandora_theme_layout_dealer_location() {
	$layout = bon_get_option( 'dealer_location_layout' );
	return $layout;
}

function shandora_theme_layout_car_feature() {
	$layout = bon_get_option( 'car_feature_layout' );
	return $layout;
}

function shandora_theme_layout_manufacturer() {
	$layout = bon_get_option( 'manufacturer_layout' );
	return $layout;
}

function shandora_theme_layout_body_type() {
	$layout = bon_get_option( 'body_type_layout' );
	return $layout;
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since  0.1.0
 * @param  array $sidebars_widgets A multidimensional array of sidebars and widgets.
 * @return array $sidebars_widgets
 */
function shandora_disable_sidebars( $sidebars_widgets ) {
	global $wp_customize;

	$customize = ( is_object( $wp_customize ) && $wp_customize->is_preview() ) ? true : false;

	if ( !is_admin() && !$customize && '1c' == get_theme_mod( 'theme_layout' ) )
		$sidebars_widgets['primary'] = false;

	return $sidebars_widgets;
}

add_action( 'admin_enqueue_scripts', 'shandora_admin_script', 10 );

function shandora_admin_script( $hook ) {

	if ( $hook == 'post-new.php' || $hook == 'post.php' ) {

		global $post;

		if ( $post->post_type === 'page' ) :

			wp_register_script( 'shandora-page-script', BON_THEME_URI . '/assets/js/admin/page.js', array( 'jquery' ) );

		wp_enqueue_script( 'shandora-page-script' );

		endif;
	}
}

function shandora_get_video() {

	global $post;

	$prefix = bon_get_prefix();

	$embed = esc_url( get_post_meta( $post->ID, $prefix . 'videoembed', true ) );
	$poster = get_post_meta( $post->ID, $prefix . 'videocover', true );

	if ( $poster ) {
		$src = wp_get_attachment_image_src( $poster, 'large' );
	}

	$m4v = get_post_meta( $post->ID, $prefix . 'videom4v', true );
	$ogv = get_post_meta( $post->ID, $prefix . 'videoogv', true );

	$o = '';

	if ( !empty( $embed ) ) {
		$o .= '<div class="video-container">';
		$o.= '<div class="video-embed">';
		$embed_code = wp_oembed_get( $embed );
		$o.= $embed_code;
		$o.= '</div>';
		$o.= '</div>';

		return $o;
	} else if ( !empty( $m4v ) && !empty( $ogv ) ) {
		$o .= '<div class="video-container">';
		$o .= '<div id="jp-video-embed" class="bon-jplayer jp-jplayer jp-jplayer-video" data-poster="' . $poster . '" data-m4v="' . $m4v . '" data-ogv="' . $ogv . '"></div>';

		$o .= '<div class="jp-video-container">
		<div class="jp-video">
		<div class="jp-type-single">
		<div id="jp-interface-video-embed" class="jp-interface">
		<div class="jp-controls">
		<div class="jp-play" tabindex="1">
		<span class="bonicons bi-play icon"></span>
		</div>
		<div class="jp-pause" tabindex="1">
		<span class="bonicons bi-pause icon"></span>
		</div>
		<div class="jp-progress-container">
		<div class="jp-progress">
		<div class="jp-seek-bar">
		<div class="jp-play-bar"></div>
		</div>
		</div>
		</div>
		<div class="jp-mute" tabindex="1"><span class="bonicons bi-volume-up icon"></span></div>
		<div class="jp-unmute" tabindex="1"><span class="bonicons bi-volume-off icon"></span></div>
		<div class="jp-volume-bar-container">
		<div class="jp-volume-bar">
		<div class="jp-volume-bar-value"></div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>';

		$o.= '</div>';
	}

	return $o;
}

add_action( 'wp_enqueue_scripts', 'shandora_register_script' );

function shandora_register_script() {

	// if ( !wp_script_is( 'fitvids', 'registered' ) ) {
	// 	wp_register_script( 'fitvids', trailingslashit( BON_JS ) . 'jquery.fitvids.min.js', array( 'jquery' ), false, false );
	// }
	// if ( !wp_script_is( 'fitvs', 'queue' ) ) {
	// 	wp_enqueue_script( 'fitvids' );
	// }
	// if ( !wp_script_is( 'jplayer', 'registered' ) ) {
	// 	wp_register_script( 'jplayer', trailingslashit( BON_JS ) . '/frontend/jplayer/jquery.jplayer.min.js', array( 'jquery' ), false, false );
	// }
	// if ( !wp_script_is( 'jplayer', 'queue' ) ) {
	// 	wp_enqueue_script( 'jplayer' );
	// }
}

function shandora_listing_post_per_page( $query ) {
	if ( !is_admin() ) {

		if ( ( $query->is_tax( get_object_taxonomies( 'listing' ) ) || $query->is_tax( get_object_taxonomies( 'product' ) ) || $query->is_tax( get_object_taxonomies( 'boat-listing' ) ) ) && $query->is_main_query() ) {

			$numberposts = (bon_get_option( 'listing_per_page' )) ? bon_get_option( 'listing_per_page' ) : 8;

			$orderby = bon_get_option( 'listing_orderby' );
			$order = bon_get_option( 'listing_order', 'DESC' );
			$key = '';

			switch ( $orderby ) {
				case 'price':
				$orderby = 'meta_value_num';
				$key = bon_get_prefix() . 'listing_price';
				break;

				case 'title':
				$orderby = 'title';

				break;

				case 'size':
				$orderby = 'meta_value_num';

				if ( $query->is_tax( get_object_taxonomies( 'listing' ) ) ) {
					$key = bon_get_prefix() . 'listing_buildingsize';
				} else if ( $query->is_tax( get_object_taxonomies( 'product' ) ) ) {
					$key = bon_get_prefix() . 'listing_mileage';
				}

				break;

				default:
				$orderby = 'date';
				break;
			}

			if ( isset( $_GET['search_order'] ) ) {
				switch ( $_GET['search_order'] ) {
					case 'PRICE_ASC':
					$order = 'ASC';
					break;
					case 'PRICE_DESC':
					$order = 'DESC';
					break;
					case 'SIZE_ASC':
					$key = bon_get_prefix() . 'listing_lotsize';
					$order = 'ASC';
					break;
					case 'SIZE_DESC':
					$key = bon_get_prefix() . 'listing_lotsize';
					$order = 'DESC';
					break;
				}
			}

			if ( $query->is_tax( get_object_taxonomies( 'listing' ) ) ) {
				$query->set( 'post_type', 'listing' );
			} else if ( $query->is_tax( get_object_taxonomies( 'product' ) ) ) {
				$query->set( 'post_type', 'product' );
			} else if ( $query->is_tax( get_object_taxonomies( 'boat-listing' ) ) ) {
				$query->set( 'post_type', 'boat-listing' );
			}

			$paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
			$query->set( 'meta_key', $key );
			$query->set( 'orderby', $orderby );
			$query->set( 'order', $order );
			$query->set( 'paged', $paged );
			$query->set( 'posts_per_page', $numberposts );
		}
	}
}

add_action( 'pre_get_posts', 'shandora_listing_post_per_page' );

function shandora_block_grid_column_class( $echo = true ) {

	$layout = get_theme_mod( 'theme_layout' );
	if ( empty( $layout ) ) {
		$layout = get_post_layout( get_queried_object_id() );
	}

	$mobile = bon_get_option( 'mobile_layout', '1' );
	if ( $layout == '1c' ) {
		$class = 'mobile-block-grid-' . $mobile . ' xsmall-block-grid-2 small-block-grid-3';
	} else {
		$class = 'mobile-block-grid-' . $mobile . ' xsmall-block-grid-2 small-block-grid-3';
	}

	if ( $echo ) {
		echo $class;
	} else {
		return $class;
	}
}

add_action( 'wp_ajax_get-cot-details', 'shandora_get_cot_details' );
add_action( 'wp_ajax_nopriv_get-cot-details', 'shandora_get_cot_details' );

function shandora_get_cot_details() {

	if ( !isset( $_POST ) || empty( $_POST ) ) {

		$return_data['value'] = __( 'Cannot get object. No parameter receive form AJAX call.', 'bon' );
		die( json_encode( $return_data ) );

	} else {

		$postID = esc_html( $_POST['id'] );
		$thumb_size = esc_html( $_POST['thumbSize'] );

		$return_data['thumbnail'] = get_the_post_thumbnail( $postID, $thumb_size );
		die( json_encode( $return_data ) );

	}

}

add_action( 'wp_ajax_process-package', 'shandora_process_packageform' );
add_action( 'wp_ajax_nopriv_process-package', 'shandora_process_packageform' );

function shandora_process_packageform() {

	if ( !isset( $_POST ) || empty( $_POST ) ) {
		$return_data['value'] = __( 'Cannot update package values. No parameter receive form AJAX call.', 'bon' );
		die( json_encode( $return_data ) );
	} else {	

		$return_data['success'] = '1';

		$suffix = SHANDORA_MB_SUFFIX;

		// Uncomment this if each product would have it's own package descriptions

		/*$package = esc_html( $_POST['package_form'] );*/

		$chosenPackage = esc_html( $_POST['package_form'] );

		$packages = get_packages_list();

		foreach ( $packages as $key => $package ) {
			if ( $package['package_name'] !== $chosenPackage )
				continue;
			$thickness = $packages[$key]['package_wall_thickness'];
		}

		// Uncomment this if each product would have it's own package descriptions

		/*if ( empty( $package ) ) {
			$return_data['value'] = __( 'Cannot update package values. No parameter receive form AJAX call.', 'bon' );
			die( json_encode( $return_data ) );
		} else {
			$package_prefix = $suffix . $package;
		}

		$postID = esc_html( $_POST['post_id'] );

		if ( empty( $postID ) ) {
			$return_data['value'] = __( 'Cannot update package values. No parameter receive form AJAX call.', 'bon' );
			die( json_encode( $return_data ) );
		} else {
			$return_data['price'] = shandora_get_meta( $postID, $package_prefix . '_price', true);
			$return_data['wall'] = shandora_get_meta( $postID, $package_prefix . '_wall_thickness', true);
		}*/

		if ( empty( $chosenPackage ) ) {
			$return_data['value'] = __( 'Cannot update package values. No parameter receive form AJAX call.', 'bon' );
			die( json_encode( $return_data ) );
		} else {
			$package_prefix = $suffix . $chosenPackage;
		}

		$postID = esc_html( $_POST['post_id'] );

		if ( empty( $postID ) ) {
			$return_data['value'] = __( 'Cannot update package values. No parameter receive form AJAX call.', 'bon' );
			die( json_encode( $return_data ) );
		} else {
			$return_data['price'] = shandora_get_meta( $postID, sanitize_title( $package_prefix ) . '_price', true);
			$return_data['wall'] = $thickness;
		}

		die( json_encode( $return_data ) );

	}

}

add_action( 'wp_ajax_process-newsletter-subscribe', 'shandora_process_newsletter_subscribe' );
add_action( 'wp_ajax_nopriv_process-newsletter-subscribe', 'shandora_process_newsletter_subscribe' );

function shandora_process_newsletter_subscribe() {

	if ( !isset( $_POST ) || empty( $_POST ) ) {
		$return_data['value'] = __( 'Cannot send email to destination. No parameter receive form AJAX call.', 'bon' );
		die( json_encode( $return_data ) );
	}

	$name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';

	if ( empty( $name ) ) {
		$return_data['value'] = __( 'Please enter your name.', 'bon' );
		die( json_encode( $return_data ) );
	}

	$email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';

	if ( empty( $email ) ) {
		$return_data['value'] = __( 'Please enter your email.', 'bon' );
		die( json_encode( $return_data ) );
	}

	$receiver = $_POST['receiver'];
	$country = $_POST['country'];

// setup email to admin body

	$body .= '<p style = "margin-bottom:1em">' . sprintf( "You have received a new newsletter subscription via %s \n", get_bloginfo( 'name' ) ) . '</p>';
	$body .= '<p style = "margin-bottom:1em">' . sprintf( "Sender Name : %s \n", $name ) . '</p>';
	$body .= '<p style = "margin-bottom:1em">' . sprintf( "Sender Email : %s \n", $email ) . '</p>';
	$body .= '<p style = "margin-bottom:1em">' . sprintf( "Country : %s \n", $country ) . '</p>';

// setup email to admin headers
// set email reply to header to admin if contact form was filled without email
	$reply_email = 'no-reply@' . __('domainname.com', 'bon');
	
// set content type header
	$headers[] = "Content-Type: text/html";

// add WP filters for correct email headers
	$headers[] = "From: Newsletter signup <" . $reply_email . ">";
	$headers[] = "Reply-To: " . $reply_email;

	$subject = sprintf( "%s %s", 'Newsletter signup' . ": [" . $country . "]", "Newsletter signup" );


// setup response email body if email was filled in contact form
	$response_receiver = $email;

	$response_body = '<p style = "margin-bottom:1em">' . __( 'You have successfully subscribed to our newsletter.', 'bon' ) . '</p>';
	$response_body .= '<p style = "margin-bottom:1em">' . __( 'Kind regards', 'bon' ) . ', <br>' . esc_attr( get_bloginfo( 'name' ) ) . '</p>';

	$response_headers[] = "From: " . __('Newsletter', 'bon') . " <". __('domainname.com', 'bon') . ">";
	$response_headers[] = "Reply-To: " . $reply_email;
	$response_headers[] = "Content-Type: text/html";

	$response_subject = __( 'Thank you for subscribing to us', 'bon' );


// send email to admin
	if ( wp_mail( $receiver, $subject, $body, $headers ) && wp_mail( $response_receiver, $response_subject, $response_body, $response_headers ) ) {

	// set return data if email was sent successfully
		$return_data['success'] = '1';
		$return_data['value'] = __( 'Thank you for subscribing to us', 'bon' );
		die( json_encode( $return_data ) );

	} else {

	// set return data if there was an error with sending email
		$return_data['value'] = __( 'There is an error sending subscription request', 'bon' );
		die( json_encode( $return_data ) );

	}

}

add_action( 'wp_ajax_process-agent-contactform', 'shandora_process_contactform' );
add_action( 'wp_ajax_nopriv_process-agent-contactform', 'shandora_process_contactform' );
add_action( 'wp_ajax_process-contact-requestform', 'shandora_process_contactform' );
add_action( 'wp_ajax_nopriv_process-contact-requestform', 'shandora_process_contactform' );
add_action( 'wp_ajax_process-visit-requestform', 'shandora_process_contactform' );
add_action( 'wp_ajax_nopriv_process-visit-requestform', 'shandora_process_contactform' );
add_action( 'wp_ajax_process-customize-requestform', 'shandora_process_contactform' );
add_action( 'wp_ajax_nopriv_process-customize-requestform', 'shandora_process_contactform' );

function shandora_process_contactform() {

	if ( !isset( $_POST ) || empty( $_POST ) ) {
		$return_data['value'] = __( 'Cannot send email to destination. No parameter receive form AJAX call.', 'bon' );
		die( json_encode( $return_data ) );
	}

	$email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';

	$phone = isset( $_POST['phone'] ) ? esc_attr( $_POST['phone'] ) : '';

	if ( empty( $email ) && empty( $phone ) ) {
		$return_data['value'] = __( 'Please enter either your email or phone number.', 'bon' );
		die( json_encode( $return_data ) );		
	}

	$subject = esc_html( $_POST['subject'] );
	$listing_id = absint( $_POST['listing_id'] );

	$messages = esc_textarea( $_POST['messages'] );

	if (!$messages) {
		$messages = isset( $_POST['messages_default'] ) ? esc_attr( $_POST['messages_default'] ) : '';
	}

	if ( empty( $messages ) ) {
		$return_data['value'] = __('Please enter your messages.', 'bon');
		die( json_encode( $return_data ) );
	}

	if ( function_exists( 'akismet_http_post' ) && trim( get_option( 'wordpress_api_key' ) ) != '' ) {
		global $akismet_api_host, $akismet_api_port;
		$c['user_ip'] = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
		$c['blog'] = home_url();
		if ( $email ) { $c['comment_author_email'] = $email; }
		$c['comment_content'] = $messages;

		$query_string = '';
		foreach ( $c as $key => $data ) {
			if ( is_string( $data ) )
				$query_string .= $key . '=' . urlencode( stripslashes( $data ) ) . '&';
		}

		$response = akismet_http_post( $query_string, $akismet_api_host, '/1.1/comment-check', $akismet_api_port );

		if ( 'true' == $response[1] ) {
			$return_data['value'] = __( 'Cheatin Huh?!', 'bon' );
			die( json_encode( $return_data ) );
		}
	}



/************************
*						*
* Email configuration	*
*						*
************************/

$receiver = $_POST['receiver'];

// setup email to admin body

$body .= '<p style = "margin-bottom:1em">' . sprintf( __( "You have received a new contact form message via %s \n", "bon" ), get_bloginfo( 'name' ) ) . '</p>';
//$body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Sender Name : %s \n", "bon" ), $name ) . '</p>';
if ( $email ) { $body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Sender Email : %s \n", "bon" ), $email ) . '</p>'; }
if ( $phone ) { $body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Sender Phone Number : %s \n", "bon" ), $phone ) . '</p>'; }
$body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Subject : %s \n", "bon" ), $subject ) . '</p>';
if ( $listing_id) { $body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Email Send From : %s \n", "bon" ), get_permalink( $listing_id ) ) . '</p>'; }
$body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Message : %s \n", "bon" ), $messages ) . '</p>';



// setup email to admin headers

// set email reply to header to admin if contact form was filled without email
if ( $email ) {
	$reply_email = $email;
} else {
	$reply_email = get_bloginfo( 'admin_email' );
}
// set content type header
$headers[] = "Content-Type: text/html";

// add WP filters for correct email headers
if ( $email ) {
// set from header
	$headers[] = "From: " . __( 'Customer', 'bon' ) . ": " . $reply_email;
	$headers[] = "Reply-To: " . $reply_email;
	// add_filter( 'wp_mail_from', function() {
	// 	return $reply_email;
	// } );
} else {
// set from header
	$headers[] = "From: " . __( "Customer", "bon" ) . ": " . $reply_email;
}
// add_filter( 'wp_mail_from_name', function() {
// 	return __( "Masters House", 'bon' );
// } );

$subject = sprintf( "%s %s", $subject, __( "Masters House", 'bon' ) );



/********************************
*								*
* Responsne email configuration	*
*								*
********************************/


// setup response email body if email was filled in contact form
if ( $email ) {

	$response_receiver = $email;

	$response_body = '<p style = "margin-bottom:1em">' . __( 'We succesfully received your request. Our representative will contact you within one hour.', 'bon' ) . '</p>';
	$response_body .= '<p style = "margin-bottom:1em">' . __( 'Kind regards', 'bon' ) . ', <br>' . esc_attr( get_bloginfo( 'name' ) ) . '</p>';

	$response_headers[] = "From: " . __( "Masters House", "bon" );
	$response_headers[] = "Reply-To: " . 'no-reply@mastershouse.com';
	$response_headers[] = "Content-Type: text/html";

	$response_subject = __( 'Thank you for contacting us', 'bon' );

}



// send email to admin
if ( wp_mail( $receiver, $subject, $body, $headers ) ) {

	// add necessary WP filters
	add_filter( 'wp_mail_from', function() {
		return 'no-reply@mastershouse.com';
	} );
	add_filter( 'wp_mail_from_name', function() {
		return __( "Masters House", 'bon' );
	} );

	// send response if email to admin was sent succesfully
	if ( $email ) { wp_mail( $response_receiver, $response_subject, $response_body, $response_headers ); }

	// set return data if email was sent successfully
	$return_data['success'] = '1';
	$return_data['value'] = __( 'Email was sent successfully.', 'bon' );
	die( json_encode( $return_data ) );

} else {

	// set return data if there was an error with sending email
	$return_data['value'] = __( 'There is an error sending email.', 'bon' );
	die( json_encode( $return_data ) );

}
}

add_action( 'wp_ajax_process-ebook-downloadform', 'shandora_process_ebook_downloadform' );
add_action( 'wp_ajax_nopriv_process-ebook-downloadform', 'shandora_process_ebook_downloadform' );

function shandora_process_ebook_downloadform() {

	if ( !isset( $_POST ) || empty( $_POST ) ) {
		$return_data['value'] = __( 'Cannot send email to destination. No parameter receive form AJAX call.', 'bon' );
		die( json_encode( $return_data ) );
	}

	$name = esc_html( $_POST['name'] );

	if ( empty( $name ) ) {
		$return_data['value'] = __( 'Please enter your name.', 'bon' );
		die( json_encode( $return_data ) );
	}

	$email = sanitize_email( $_POST['email'] );

	if ( empty( $email ) ) {
		$return_data['value'] = __( 'Please enter a valid email address.', 'bon' );
		die( json_encode( $return_data ) );
	}

	$subject = esc_html( $_POST['title'] );

	$link = $_POST['ebook_url'];

	$anchor = esc_html( $_POST['anchor'] );

	$body .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate!important;border-radius:4px;background-color:#ffffff;padding:30px;border:1px solid #ffffff;border-bottom:1px solid #acacac" bgcolor="#ffffff">';
	$body .= '<tbody>';
	$body .= '<tr>';
	$body .= '<td align="center" valign="top">';
	$body .= '<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse!important;width:600px" width="600">';
	$body .= '<tbody>';
	$body .= '<tr>';
	$body .= '<td align="left" valign="top" width="100%" colspan="12" style="color:#444444;font-family:sans-serif;font-size:15px;line-height:150%;text-align:left">';
	$body .= '<table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse!important">';
	$body .= '<tbody>';
	$body .= '<tr>';
	$body .= '<td align="left" valign="top" colspan="12" width="100.0%" style="text-align:left;font-family:sans-serif;font-size:15px;line-height:1.5em;color:#444444">';
	$body .= '<div>';
	$body .= '<div>';
	$body .= '<div style="color:inherit;font-size:inherit;line-height:inherit;margin:inherit;padding:inherit">';
	$body .= '<p style="margin-bottom:1em">';
	$body .= '<a href="' . get_home_url() . '" title="' . esc_attr( get_bloginfo( "name", "display" ) ) . '">';

	if ( bon_get_option( 'logo' ) ) {
		$body .= '<img src = "' . (bon_get_option( 'logo_dark', get_template_directory_uri() . "/assets/images/logo.png" )) . '" alt = "' . esc_attr( get_bloginfo( "name", "display" ) ) . '"/>';
	} else {
		$body .= esc_attr( get_bloginfo( 'name' ) );
	}

	$body .= '</a>';
	$body .= '</p>';
	$body.='</div>';
	$body.='</div>';
	$body.='</div>';
	$body.='</td>';
	$body.='</tr>';
	$body.='</tbody>';
	$body.='</table>';
	$body.='</td>';
	$body.='</tr>';
	$body .= '<tr>';
	$body .= '<td align = "left" valign = "top" width = "100%" colspan = "12" style = "color:#444444;font-family:sans-serif;font-size:15px;line-height:150%;text-align:left">';
	$body .= '<table cellpadding = "0" cellspacing = "0" border = "0" width = "100%" style = "border-collapse:collapse!important">';
	$body .= '<tbody>';
	$body .= '<tr>';
	$body .= '<td align = "left" valign = "top" colspan = "12" width = "100.0%" style = "text-align:left;font-family:sans-serif;font-size:15px;line-height:1.5em;color:#444444">';
	$body .= '<div>';
	$body .= '<div style = "color:inherit;font-size:inherit;line-height:inherit;margin:inherit;padding:inherit">';
	$body .= '<p style = "margin-bottom:1em" >'. __( 'Hi', 'bon') . '&nbsp;' . $name . ',</p>';
	$body .= '<p style = "margin-bottom:1em">' . __( "Thank you for downloading our ebook.", "bon" ) . '</p>';
	$body .= '<p style = "margin-bottom:1em">' . __( "You can download it with this link", "bon" ) . '&nbsp;-' . '&nbsp;<a href = "' . $link . '" target = "_blank">' . $anchor . '</a></p>';
	$body .= '<p style = "margin-bottom:1em">' . __( "We wish you a pleasant read!", "bon" ) . '</p>';
	$body .= '<p style = "margin:4em 0;">';
	$body .= '<a style = "display:inline-block;padding-top:0.86667em;padding-right:1.2em;padding-bottom:0.86667em;padding-left:1.2em;font-size:1.06667em;background-color: #27AE60;border-color: #0E9547;border-radius:5px;border-style:solid;border-width:0 0 5px;color:#FFF;text-decoration:none" href = "' . $link . '">' . __( 'Download', 'bon') . ' ' . $anchor . '</a>';
	$body .= '</p>';
	$body .= '<p style = "margin-bottom:1em">' . __( "All the best", "bon" ) . ', <br></p>';
	$body .= '<a href="' . get_home_url() . '" title="' . esc_attr( get_bloginfo( "name", "display" ) ) . '">';
	$body .= '<small>' . esc_attr( get_bloginfo( 'name' ) ) . '</small>';
	$body .= '</a>';
	$body .= '</div>';
	$body .= '</div>';
	$body .= '</td>';
	$body .= '</tr>';
	$body .= '</tbody>';
	$body .= '</table>';
	$body .= '</td>';
	$body .= '</tr>';
	$body .= '</tbody>';
	$body .= '</table>';
	$body .= '</td>';
	$body .= '</tr>';
	$body .= '</tbody>';
	$body .= '</table>';

	$headers[] = "From: " . __( "Masters House", 'bon' );
	$headers[] = "Reply-To: " . 'no-reply@mastershouse.com';
	$headers[] = "Content-Type: text/html";

	add_filter( 'wp_mail_from', function() {
		return 'no-reply@mastershouse.com';
	} );
	add_filter( 'wp_mail_from_name', function() {
		return __( "Masters House", 'bon' );
	} );

	if ( wp_mail( $email, $subject, $body, $headers ) ) {
		$return_data['success'] = '1';
		$return_data['value'] = __( 'Email was sent successfully.', 'bon' );
		die( json_encode( $return_data ) );
	} else {
		$return_data['value'] = __( 'There is an error sending email.', 'bon' );
		die( json_encode( $return_data ) );
	}
}

function shandora_get_listing_hover_action( $post_id = '' ) {

	$o = '';
	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
	}

	$data_imageset = array();
	$_overlay_btns = bon_get_option( 'overlay_buttons', array( 'link' => true, 'gallery' => true, 'compare' => true ) );

	if ( isset( $_overlay_btns['gallery'] ) && $_overlay_btns['gallery'] == true ) :

		$args = array(
			'post_type' => 'attachment',
			'numberposts' => 5,
			'post_parent' => $post_id,
			);

	$listing_gal = shandora_get_meta( $post_id, 'listing_gallery' );

	$imageset = '';

	if ( $listing_gal ) {
		$attachments = array_filter( explode( ', ', $listing_gal ) );
		if ( $attachments ) {
			$i = 0;
			foreach ( $attachments as $attachment_id ) {

				$image_src = wp_get_attachment_image_src( $attachment_id, 'full' );
				$data_imageset[$i]['src'] = $image_src[0];
				$data_imageset[$i]['title'] = get_the_title( $attachment_id );
				$i++;
			}
		}
	}

	$imageset = json_encode( $data_imageset );

	endif;

	if ( !empty( $_overlay_btns ) ) :

		$o = '<div class = "hover-icon-wrapper">';
	if ( isset( $_overlay_btns['link'] ) && $_overlay_btns['link'] == true ) :
		$o .= '<a data-tooltip data-options = "disable-for-touch: true" title = "' . sprintf( __( 'Permalink to %s', 'bon' ), get_the_title( $post_id ) ) . '" href = "' . get_permalink( $post_id ) . '" class = "hover-icon has-tip tip-top tip-centered-top"><i class = "sha-link"></i></a>';
	endif;

	if ( !empty( $data_imageset ) && isset( $_overlay_btns['gallery'] ) && $_overlay_btns['gallery'] == true ) :
		$o .= '<a data-tooltip data-options = "disable-for-touch: true" data-imageset = \'' . $imageset . '\' title="' . __( 'View Image', 'bon' ) . '" class="has-tip tip-top top-centered-top hover-icon listing-gallery"><i class="sha-zoom"></i></a>';
	endif;

	if ( isset( $_overlay_btns['compare'] ) && $_overlay_btns['compare'] == true ) :
		$o .= '<a data-tooltip data-options="disable-for-touch: true" title="' . __( 'Compare Listing', 'bon' ) . '" data-id=' . $post_id . ' class="hover-icon has-tip tip-top tip-centered-top listing-compare"><i class="sha-paperclip"></i></a>';
	endif;

	$o .= '</div>';

	endif;

	return $o;
}

function shandora_get_dimensions( $args, $lotsize = null ) {
	$measurement = bon_get_option( 'length_measure' );
	$sizemeasurement = bon_get_option( 'measurement' );

	$prefix = bon_get_prefix();

	$suffix = SHANDORA_MB_SUFFIX;

	$string = '';
	if ( !empty($args) ) {
		foreach ( $args[0] as $arg ) {

			$dimensionarea = $arg[$prefix . $suffix . 'dimensionsarea'];
			$dimensionfloor = $arg[$prefix . $suffix . 'dimensionfloor'];
			$dimensionwidth = $arg[$prefix . $suffix . 'dimensionswidth'];
			$dimensionheight = $arg[$prefix . $suffix . 'dimensionsheight'];

			switch ( $dimensionfloor ) {

				case 'ground_floor':
				$dimensionfloor = __( 'Ground floor', 'bon' );
				break;

				case 'first_floor':
				$dimensionfloor = __( 'First floor', 'bon' );
				break;

				default:
				break;
			}

			if ( $dimensionarea ) {
			// when total area is set up

				if ( count( $args[0] ) > 1 )
				// when there is more than 1 floor
					$string.=$dimensionfloor . ': ';

				$string.=$dimensionarea . " $sizemeasurement";

			} else if ( $dimensionwidth && $dimensionheight ) {
			// when total area is not set up but there are dimensions

				if ( count( $args[0] ) > 1 )
				// when there is more than 1 floor
					$string.=$dimensionfloor . ': ';

				$string.=$dimensionwidth . " $measurement x " . $dimensionheight . " $measurement";

			} else if ( $lotsize ) {
			// when total area and dimensions are not set up

				if ( count( $args[0] ) > 1 )
				// when there is more than 1 floor
					$string.=$dimensionfloor . ': ';

				$string.=$lotsize . " $sizemeasurement";

			} else {

				return;
				
			}

			if ( $arg !== end( $args[0] ) )
				$string.= ', ';

		}
	}
	return $string;
}

function shandora_get_windows( $args ) {
	return shandora_get_doors_or_windows( $args, 'window' );
}

function shandora_get_doors( $args ) {
	return shandora_get_doors_or_windows( $args, 'door' );
}

function shandora_get_columns( $args ) {
	return shandora_get_doors_or_windows( $args, 'column' );
}

function shandora_get_rafters( $args ) {
	return shandora_get_doors_or_windows( $args, 'rafter' );
}

function shandora_get_doors_or_windows( $args, $element ) {
	$measurement = bon_get_option( 'height_measure' );
	$string = '';
	if ( !empty($args) ) {
		foreach ( $args[0] as $arg ) {
			
			$amount = $arg['shandora_listing_' . $element . 'amount'];
			$width = $arg['shandora_listing_' . $element . 'width'];
			$height = $arg['shandora_listing_' . $element . 'height'];

			if ( $amount > 0 ) {

				$type = $arg['shandora_listing_' . $element . 'type'];

				if ( $type || $width || $height) {

					$string.= $amount . 'x ';

					$string.= ( $type ) ? $type . ' ' : '';

					$string.= ( $width ) ? $width . " $measurement x " : '';

					$string.= ( $height ) ? $height . " $measurement" : '';

					if ( $arg !== end( $args[0] ) )
						$string.= ', ';

				}
			} else if ( $width > 0 && $height > 0) {

				$string.= ( $width ) ? $width . " $measurement x " : '';

				$string.= ( $height ) ? $height . " $measurement" : '';

				if ( $arg !== end( $args[0] ) )
					$string.= ', ';

			}
		}
	}
	return $string;
}

/* get ids of addons excluded from single building */

function shandora_get_excluded_addons( $id = NULL ) {

	/* use current post id if no id was passed */
	if ( !$id ) {
		$id = get_the_ID();
	}

	$excluded_addons = get_post_meta( $id, bon_get_prefix() . 'listing_excluded_addons' );

	/* setup array for ids of excluded addons */
	$ids = array();

	foreach ( $excluded_addons as $addons_array ) {

		foreach ( $addons_array as $addons ) {

			foreach ( $addons as $addon ) {

				$ids[] = $addon;
			}

		}
	}

	return($ids);

}

/*
*
*	Function to print home call to action button
*	Parameters:
*	show - wheather show or hide button, depending on device type ( it mostly receives show for desktop and tablet, hide for mobile )
*	link - href for link
*	destination - element ID if it's a link that triggers modal window to show
*	button_color - color of element
*	onClick - url if it should open desired url in new window after click
*	text - anchor
*
*/

function shandora_print_home_cta ( $show, $link, $destination, $button_size, $button_color, $onClick, $text ) {

	if ( $show ) {

		if ( $destination === 'Open drawing tool' ) {
			$exClass = " class='cta-headline'";
			$arrow = NULL;
			$ga_event_args = get_ga_event( array( 'CTA', 'Click on Home Page', $destination ), array( "Customize", "Open Tool" ) );
		} else {
			$exClass = NULL;
			$arrow = "<i class='bonicons bi-chevron-right'></i>";

			if ( $destination === 'Request a visit' )
			{
				$ga_event_args = get_ga_event( array( 'CTA', 'Click on Home Page', $destination ), array( "Contact", "Open Visit Request", "Home CTA" ) );
			} else
			{
				$ga_event_args = get_ga_event( 'CTA', 'Click on Home Page', $destination );
			}
		}
		$output = "<a href='$link' class='table-cell align-middle cta flat button " . $button_size . " " . $button_color . " radius' $onClick " . $ga_event_args . "><span" . $exClass . ">" . $text . "</span>" . $arrow . "</a>";
		echo $output;
	}

}

/*
*
*	Function to get and setup home call to action buttons
*	Parameters:
*	args - array of buttons parameters
*	tool - array of button for drawing tool parameters
*	visited - true or false determining if it's a returning users or new visitor
*
*/

function shandora_home_cta( $args, $tool = 0, $visited = 0 ) {

	$show = TRUE;

	foreach ( $args as $cta ) {

		if ( !$cta['disable_home_cta'] ) {

			if ( $visited != 3 )
			{
				if ( $cta['enable_home_cta_page'] )
				{
					$destination = 'Browse all Cottages';
					$link = get_permalink( $cta['home_cta_link_page'] );
				} else if ( $cta['enable_home_cta_post'] )
				{
					$destination = 'Open Post';
					$link = get_permalink( $cta['home_cta_link_post'] );
				} else if ( $cta['enable_home_cta_url'] )
				{
					$destination = 'Custom Link';
					$link = $cta['home_cta_link_link_url'];
				}
			} else
			{
				$destination = 'Request a visit';
				$link = '#';
				$onClick = "data-reveal-id='visit-modal'";
			}

		// echo call to action
			shandora_print_home_cta( $show, $link, $destination, "", "main", $onClick, $cta['home_cta_text'] );

		}

	}

	if ( $tool ) {

		foreach ( $tool as $cta ) {

			if ( !$cta['disable_home_cta'] ) {

				// $button_color = bon_get_option( 'tool_button_color', 'peterRiver' );
				$subline = $cta['home_cta_subline'];
				if ( $subline != "" ) {
					$cta['home_cta_text'] = $cta['home_cta_text'] . "</span><span class='cta-subline'>" . $subline;
				}
				$destination = 'Open drawing tool';
				$link = bon_get_option( 'tool_section_cta_link_url' );
				$onClick = 'onclick="window.open(\'' . $link . '\', \'VPWindow\', \'width=1024,height=768,toolbar=0,resizable=1,scrollbars=1,status=0,location=0\'); return false;"';
				if ( $_SESSION['layoutType'] === 'mobile' )
					$show = FALSE;

		// echo call to action
				shandora_print_home_cta( $show, $link, $destination, "small", "clouds", $onClick, $cta['home_cta_text'] );

			}

		}

	}
}

/*
* Function to render call to action button for build your house tool. Tool opens in new window.
*/
function shandora_tool_cta() {

	$link = bon_get_option( 'tool_section_cta_link_url' );

	if ( $link != "" ) {

		// $button_color = bon_get_option( 'tool_button_color', 'peterRiver' );
		$onClick = 'onclick="window.open(\'' . $link . '\', \'VPWindow\', \'width=1024,height=768,toolbar=0,resizable=1,scrollbars=1,status=0,location=0\'); return false;"';
		echo "<a href='$link' data-function='open-tool' class='flat button clouds radius' $onClick ". get_ga_event( "Customize", "Open Tool" ) . ">" . __( 'Build your own', 'bon' ) . "</a>";

	}
	
}

function extra_class( $id ) {
	$term_meta = wp_get_post_terms( $id, 'property-type' );
	return $term_meta[0]->slug;
}

function get_cat_color( $id ) {
	$property_taxonomies = get_terms( 'property-type', array( 'slug' => extra_class( $id ) ) );
	$color = $property_taxonomies[0]->term_id;
	$color = get_option( "taxonomy_$color" );
	return $color['color'];
}

add_filter( 'cleaner_gallery_defaults', 'shandora_cleaner_gallery_defaults', 10 );

function shandora_cleaner_gallery_defaults( $args ) {

	$detect = new Mobile_Detect;
	if ( $detect->isMobile() && !$detect->isTablet() ) {
		$args['size'] = 'thumbnail';
	} else {
		$args['size'] = 'blog_small';
	}
	$args['link'] = 'file';

	return $args;
}

function shandora_remove_attachment_comment() {
	remove_post_type_support( 'attachment', 'comments' );
}

add_action( 'init', 'shandora_remove_attachment_comment' );

function shandora_get_idx_options( $type = '', $r_array = false ) {

	if ( empty( $type ) ) {
		return;
	}


	$return = false;
	$limit = bon_get_option( 'idx_search_option_limit', 100 );
	$options = get_option( DSIDXPRESS_OPTION_NAME );
	$setup_id = $options['SearchSetupID'];

	$url = 'http://api-c.idx.diversesolutions.com/api/';

	$results = wp_remote_get( $url . 'LocationsByType?searchSetupID=' . $setup_id . '&type=' . $type . '&minListingCount=1', array( 'decompress' => false ) );

	if ( is_wp_error( $results ) ) {

		$error_message = $results->get_error_message();
		return false;
	}

	$return = $results["response"]["code"] == "200" ? array_slice( json_decode( $results["body"] ), 0, $limit ) : null;

	if ( $return ) {
		if ( $r_array ) {
			$new_return = array();
			foreach ( $return as $r ) {
				$new_return[] = $r->Name;
			}
			return $new_return;
		} else {
			return $return;
		}
	} else {
		return;
	}
}

function shandora_get_country_selection() {
	$languages = icl_get_languages( 'skip_missing=0&orderby=code' );
	if ( !empty( $languages ) ) {
		$o = '';
		foreach ( $languages as $l ) {
			$o .= '<li class="language-selector">';
			if ( !$l['active'] ) {
				$o .= '<a href="' . $l['url'] . '">';
			} else {
				$o .= '<a>';
			}
			$o .= '<img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" />';
			$o .= '</a>';
			$o .= '</li>';
		}
		return $o;
	}
}

function get_thumbnail_src( $id = null, $size = 'listing_large' ) {

	if ( $id ) {
		
		$img = get_the_image(array(
			'post_id' => $id,
			'link_to_post' => false,
			'meta_key' => false,
			'size' => $size,
			'format' => 'array'
			)
		);

	} else {

		$img = get_the_image(array(
			'link_to_post' => false,
			'meta_key' => false,
			'size' => 'post-featured',
			'format' => 'array'
			)
		);

	}

	return $img['src'];
}

function get_open_graph_title() {

	if ( is_page() ) {

		global $post;
		return get_the_title( $post->ID );

	} elseif ( is_tax() || is_category() ) {

		return single_cat_title() . ' | ' . get_bloginfo( 'name' );

	} elseif ( is_tag() ) {

		return single_tag_title() . ' | ' . get_bloginfo( 'name' );

	} else {

		return get_bloginfo( 'name' );

	}

}

function get_open_graph_description() {	

	/* Set an empty $description variable. */
	$description = '';

	/* If viewing the home/posts page, get the site's description. */
	if ( is_home() ) {
		$description = get_bloginfo( 'description' );
	}

	/* If viewing a singular post. */
	elseif ( is_singular() ) {

		/* Get the meta value for the 'Description' meta key. */
		$description = get_post_meta( get_queried_object_id(), 'Description', true );

		/* If no description was found and viewing the site's front page, use the site's description. */
		if ( empty( $description ) && is_front_page() )
			$description = get_bloginfo( 'description' );

		/* For all other singular views, get the post excerpt. */
		elseif ( empty( $description ) )
			$description = get_post_field( 'post_content', get_queried_object_id() );
	}

	/* If viewing an archive page. */
	elseif ( is_archive() ) {

		/* If viewing a user/author archive. */
		if ( is_author() ) {

			/* Get the meta value for the 'Description' user meta key. */
			$description = get_user_meta( get_query_var( 'author' ), 'Description', true );

			/* If no description was found, get the user's description (biographical info). */
			if ( empty( $description ) )
				$description = get_the_author_meta( 'description', get_query_var( 'author' ) );
		}

		/* If viewing a taxonomy term archive, get the term's description. */
		elseif ( is_category() || is_tag() || is_tax() )
			$description = term_description( '', get_query_var( 'taxonomy' ) );

		/* If viewing a custom post type archive. */
		elseif ( is_post_type_archive() ) {

			/* Get the post type object. */
			$post_type = get_post_type_object( get_query_var( 'post_type' ) );

			/* If a description was set for the post type, use it. */
			if ( isset( $post_type->description ) )
				$description = $post_type->description;
		}
	}

	return str_replace( array( "\r", "\n", "\t" ), '', esc_attr( strip_tags( $description ) ) );

}

function get_cottages_name( $plural = NULL ) {

	return ( $plural = 'plural' ? __( 'Cottages', 'bon' ) : __( 'Cottage', 'bon' ) );


}

function get_cottages_slug() {

	return (_x( 'wooden-cottage', 'product url slug', 'bon' ));

}

function get_cottages_category_slug() {

	return ( _x( 'type', 'products category url slug', 'bon' ) );

}

function the_badge() {
	// prints item's badge for it's status
	global $post;

	// setup variables
	$status = shandora_get_meta( $post->ID, 'listing_status' );
	$badge = shandora_get_meta( $post->ID, 'listing_badge' );
	$badgeclr = shandora_get_meta( $post->ID, 'listing_badge_color' );
	$size = ( isset( $_GET['view'] ) && $_GET['view'] == 'list' ) ? 'listing_list' : 'listing_small';
	$status_opt = shandora_get_search_option( 'status' );

	if ( get_post_type() == 'listing' ) { ?>
	<div class="badge <?php echo $status; echo ($size == 'listing_list') ? ' hide-for-small' : '';?>">
		<span>
			<?php if ( $status != 'none' ) { ?>
			<?php if ( array_key_exists( $status, $status_opt ) ) { ?>
			<?php echo $status_opt[$status]; ?>
			<?php } ?>
			<?php } ?>
		</span>
	</div>
	<?php } else { ?>
	<div class="badge <?php echo $badgeclr; echo ($size == 'listing_list') ? ' hide-for-small' : '';?>">
		<span>
			<?php if ( $badgeclr != 'none' && !empty( $badge ) ) { ?>
			<?php echo $badge; ?>
			<?php }	?>
		</span>
	</div>
	<?php } ?>
	<?php
}

function the_contact_form_content() {

	$phone_html = '';
	$phone = explode( ',', esc_attr( bon_get_option( 'hgroup1_content' ) ) );

		// check how many phone numbers are set
	$phone_count = count( $phone );

	if ( $phone_count > 1 ) {
		foreach ( $phone as $number ) {
			$phone_html .= get_formatted_phone_number();
		}
	} else {
		$phone_html = get_formatted_phone_number();
	}
	?>
	<p><?php _e( 'Call us directly at:', 'bon' ); ?><span class="phone phone-<?php echo $phone_count; ?>"> <?php echo $phone_html; ?> </span><?php _e( 'or leave us your details data, so our representative can contact you.', 'bon' ); ?></p>
	<p><?php _e( 'We work from Monday to Friday 8 am to 4 pm. During this time we contact you back within one hour', 'bon' ); ?></p>

	<?php
}

// function to render email input for contact forms
function the_email_input( $required=NULL ) { ?>

<div class='column large-12 small-11 input-container-inner mail'>
	<input class="attached-input email<?php echo $required ? ' ' . $required : ''; ?>" type="email" placeholder="<?php echo __( 'Your email address', 'bon' ) . ' (' . __( 'optional', 'bon' ) . ')'; ?>"  name="email" id="email" value="" />
	<div class="contact-form-error" ><?php _e( 'Please enter either your email or phone number.', 'bon' ); ?></div>
</div>

<?php
}

// function to render phone input for contact forms
function the_phone_input( $required=NULL ) { ?>

<div class='column large-12 small-11 input-container-inner phone'>
	<input class="attached-input<?php echo $required ? ' ' . $required : ''; ?>" type="text" placeholder="<?php echo __( 'Your phone number', 'bon' ) . ' (' . __( 'optional', 'bon' ) . ')'; ?>"  name="phone" id="phone" value="" />
	<div class="contact-form-error" ><?php _e( 'Please enter either your email or phone number.', 'bon' ); ?></div>
</div>

<?php
}

// function to render textarea for contact forms
function the_textarea( $required=NULL ) { ?>

<div class='column large-12 small-11 input-container-inner pencil'>
	<textarea class="attached-input<?php echo $required ? ' ' . $required : ''; ?>" placeholder="<?php _e( "In case you want to ask us about something, type it here. You can also leave it empty and we'll contact you soon.", 'bon' ); ?>"  name="messages" id="messages" value="" cols="58" rows="10" /></textarea>
</div>

<?php
}

function get_meta_items() {

	$meta_items = array(
		array(
			'name'			=>	'room',
			'color'			=>	'alizarin',
			'post_meta'		=>	'listing_rooms',
			),
		array(
			'name'			=>	'size',
			'color'			=>	'carrot',
			'post_meta'		=>	'listing_lotsize',
			'measurement'	=>	'measurement',
			'dependency'	=>	'listing_terracesqmt',
			),
		array(
			'name'			=>	'wall',
			'color'			=>	'turquoise',
			'post_meta'		=>	'listing_wallthickness',
			'measurement'	=>	'height_measure'
			),
		array(
			'name'			=>	'thick-wall',
			'color'			=>	'turquoise',
			'package'		=>	'package_wall_thickness',
			'measurement'	=>	'height_measure'
			),
		array(
			'name'			=>	'client',
			'color'			=>	'peter-river'
			),
		array(
			'name'			=>	'drill',
			'color'			=>	'amethyst'
			),
		array(
			'name'			=>	'star',
			'color'			=>	'sun-flower'
			),
		array(
			'name'			=>	'timer',
			'color'			=>	'green-sea'
			),
		array(
			'name'			=>	'skeleton',
			'color'			=>	'wisteria'
			),
		array(
			'name'			=>	'wood',
			'color'			=>	'belize-hole'
			),
		array(
			'name'			=>	'roof',
			'color'			=>	'peter-river'
			),
		);

return $meta_items;

}

function get_related_meta_items() {

	global $post;
	// get post terms to look for meta descriptions assigned to same terms
	$terms = wp_get_post_terms( $post->ID, 'property-type' );
	// set array to store matching results
	$output = array();

	foreach ( get_meta_items() as $meta_item ) {
		// set allowed taxonomies for each meta description
		$meta_allowed_tax = bon_get_option( sanitize_title( $meta_item['name'] ) . '_taxonomies' );

		// run throught post terms and seek for taxonomies with same id as allowed
		foreach ( $terms as $term ) {
			if ( isset( $meta_allowed_tax[$term->term_id] ) && $meta_allowed_tax[$term->term_id] == 1 && is_singular( 'listing' ) ) {
				// check for possible duplicates for posts with more than 1 matching taxonomy assigned
				if ( !array_key_exists( $meta_item['name'], $output) ) {
					$output[$meta_item['name']] = $meta_item;
				}
			}
		}
	}

	return $output;

}

function render_meta_value( $meta ) {

	// check function get_meta_items() for more information about each $meta array structure

	global $post;

	$name = array_key_exists( 'name', $meta ) ? bon_get_option( sanitize_title( $meta['name'] ) . '_name' ) : null;
	$post_meta = array_key_exists( 'post_meta', $meta ) ? $meta['post_meta'] : null;
	// check if current icon requires to fetch for cottages package information
	// $package_info = array_key_exists( 'package', $meta ) ? $meta['package'] : null;
	if ( array_key_exists( 'package', $meta ) && shandora_get_meta( $post->ID, 'listing_enable_packages' ) ) {
		$package_info = true;
	}
	// check if current icon requires measurement data to display properly
	$measurement = array_key_exists( 'measurement', $meta ) ? $meta['measurement'] : null;

	// setup info from cottages package information only for products that allow to display package information
	if ( isset($package_info) ) {
		// get all packages
		$packages = get_packages_list();
		// get wall thickness from first package, which is displayed by default
		$meta_value = $packages[0]['package_wall_thickness'];
	}

	// add aditional span for wall thickness meta for compatibility with js method to update in
	$output = isset($package_info) ? '<span class="wall">' . $name : $name;
	
	// add meta value based on current $meta reference to post's meta
	if ( isset( $package_info ) ) {
		$output .= ': <span data-meta="thickness">' . $meta_value . '</span>';
	} else if ( isset( $post_meta ) ) {
		$output .= ': ' . shandora_get_meta( $post->ID, $post_meta );
	}

	// add additional measurement unit for icons which require this information
	$output .= $measurement ? ' ' . bon_get_option( $measurement ) : '';
	
	// close additional span for wall thickness meta
	$output .= isset($package_info) ? '</span>' : '';

	return $output;

}

// function to get array with quality items descriptions for quality section
function get_qualities() {

	$quality_items = array(
		array(
			'name' 			=> 'wooden profile around the door',
			'top'			=> '55',
			'left'			=> '62',
			'tablet-top'	=> '150',
			'tablet-left'	=> '350'
			),
		array(
			'name' 			=> 'roof beams splines',
			'top'			=> '5',
			'left'			=> '65',
			'tablet-top'	=> '0',
			'tablet-left'	=> '375'
			),
		array(
			'name' 			=> 'impregnated floor joints',
			'top'			=> '65',
			'left'			=> '50',
			'tablet-top'	=> '200',
			'tablet-left'	=> '300'
			),
		array(
			'name' 			=> 'pins on the joints',
			'top'			=> '50',
			'left'			=> '39',
			'tablet-top'	=> '175',
			'tablet-left'	=> '225'
			),
		array(
			'name'			=> 'roof boards',
			'top'			=> '5',
			'left'			=> '40',
			'tablet-top'	=> '25',
			'tablet-left'	=> '200'
			),
		array(
			'name' 			=> 'three-point lock',
			'top'			=> '40',
			'left'			=> '50',
			'tablet-top'	=> '125',
			'tablet-left'	=> '275'
			),
		array(
			'name' 			=> 'doors and windows',
			'top'			=> '25',
			'left'			=> '70',
			'tablet-top'	=> '75',
			'tablet-left'	=> '400'
			),
		array(
			'name' 			=> 'glued wood',
			'top'			=> '25',
			'left'			=> '30',
			'tablet-top'	=> '75',
			'tablet-left'	=> '150',
			'arrow'			=> true
			),
		array(
			'name' 			=> 'glass packages',
			'top'			=> '50',
			'left'			=> '25',
			'tablet-top'	=> '150',
			'tablet-left'	=> '150'
			),
		);

return $quality_items;

}

// function to get array with data of single cottages drawn on cottage village svg for page template village-map.
function get_village_map() {
	global $post;

	$cottages = array();
	for ( $i = 1; $i <=11; $i++ )
	{
		if ( shandora_get_meta( $post->ID, 'cottage_' . $i ) )
		{
			$cottages[$i] = array(
				"id"		=> shandora_get_meta( $post->ID, 'cottage_' . $i ),
				"format"	=> get_post_format( shandora_get_meta( $post->ID, 'cottage_' . $i ) ),
				"url"		=> get_the_permalink( shandora_get_meta( $post->ID, 'cottage_' . $i ) ),
				"title"		=> get_the_title( shandora_get_meta( $post->ID, 'cottage_' . $i ) )
				);
		}
	}

	return $cottages;

}

// fuction to get array of thumbnail sizes
function get_image_sizes( $size = '' ) {

	global $_wp_additional_image_sizes;

	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {

		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

			$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
			$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
			$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

			$sizes[ $_size ] = array( 
				'width' => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
				);

		}

	}

        // Get only 1 size if found
	if ( $size ) {

		if( isset( $sizes[ $size ] ) ) {
			return $sizes[ $size ];
		} else {
			return false;
		}

	}

	return $sizes;
}

// function to list all 360 view items list
function get_360_view_items() {	

// create empty array
	$output = array();

	if (WP_ENV === 'production') {

		if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . '/360-view' ) )
		{

			$handle = opendir( $_SERVER['DOCUMENT_ROOT'] . '/360-view' );

		} else
		{

			mkdir( $_SERVER['DOCUMENT_ROOT'] . '/360-view' );

		}
		
	}
	if ($handle) {

		while (false !== ($file = readdir($handle))) {
			$folder_path = $_SERVER['DOCUMENT_ROOT'] . '/360-view/' . $file;
			if ( $file != "." && $file != ".." && is_dir($folder_path)) {
				$folder = array(
					$file => $folder_path
					);
				$output[$file] = $file;
			}
		}

		closedir($handle);
	}

	return $output;

}

// Rotate 13 encrypting emails

function encrypt_email( $email = null ) { ?>

<script type="text/javascript">
document.write("<?php coded_email($email); ?>".replace(/[a-zA-Z]/g, function(c){
	return String.fromCharCode((c<="Z"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);
})
);
</script>

<?php }

function coded_email( $email = null ) {
	echo get_coded_email ($email);

}

function get_coded_email( $email = null ) {

	$email = $email ? $email : get_field('blog_root_email', 'options');

	$output = str_rot13("<a href='mailto: " . $email . "'>" . $email . "</a><br />");

	return $output;
}

function shandora_get_related_query( $current_post ) {

	$types = wp_get_object_terms( $current_post, 'property-type' );

	$price = shandora_get_meta( $current_post, 'listing_price' );
	$size = shandora_get_meta( $current_post, 'listing_lotsize' );
	$price_min = $price - ( $price * 20 / 100 );
	$price_max = $price + ( $price * 20 / 100 );
	$size_min = $size - ( $size * 20 / 100 );
	$size_max = $size + ( $size * 20 / 100 );

	$type_query = array();
	$tax_query = array();

	if ( $types ) {
		foreach ( $types as $type ) {
			$type_query[] = $type->slug;
		}
		$tax_query[] = array(
			'taxonomy' => 'property-type',
			'field' => 'slug',
			'terms' => $type_query,
			);
	}

	if ( $tax_query && count( $tax_query ) > 1 ) {
		$tax_query['relation'] = 'OR';
	}

	$layout = get_theme_mod( 'theme_layout' );
	if ( empty( $layout ) ) {
		$layout = get_post_layout( get_queried_object_id() );
		if ( $layout == '1c' ) {
			$posts_per_page = 4;
		}
	}

	$args = array(
		'posts_per_page' => 3,
		'post_type' => 'listing',
		'post_status' => 'publish',
		'post__not_in' => (array) $current_post,
		'tax_query' => $tax_query,
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => bon_get_prefix() . 'listing_price',
				'compare' => 'BETWEEN',
				'value' => array( $price_min, $price_max ),
				'type' => 'NUMERIC',
				),
			array(
				'key' => bon_get_prefix() . 'listing_lotsize',
				'compare' => 'BETWEEN',
				'value' => array( $size_min, $size_max ),
				'type' => 'NUMERIC',
				)
			)
		);

	if ( $_SESSION['layoutType'] === 'mobile' ) {
		$size = 'mobile_tall';
	} else {
		$size = 'listing_small';
	}

	$related_query = get_posts( $args );

	return $related_query;
}