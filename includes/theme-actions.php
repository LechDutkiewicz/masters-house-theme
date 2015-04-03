<?php

function shandora_get_listing_price( $echo = true, $total = true ) {
	global $post;
	$currency = bon_get_option( 'currency' );
	$placement = bon_get_option( 'currency_placement' );
	if ( $total ) {
// edited by Lech Dutkiewicz
		$price = shandora_get_meta( $post->ID, 'listing_price', true );
	} else {
		$price = shandora_get_meta( $post->ID, 'listing_monprice', true );
	}
	$price = '<span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="price">' . $price . '</span>';
	$price .= '<meta itemprop="priceCurrency" content="' . $currency . '" /></span>';
	$o = '';

	switch ( $placement ) {

		case 'left-space':
		$format = $currency . ' ' . $price;
		break;

		case 'right':
		$format = $price . $currency;
		break;

		case 'right-space':
		$format = $price . ' ' . $currency;
		break;

		default:
		$format = $currency . $price;
		break;
	}

	$o .= shandora_get_rent_period( $format );

	if ( $echo ) {
		echo $o;
	} else {
		return $o;
	}
}

function shandora_get_price_meta( $postID ) {


	$currency = bon_get_option( 'currency' );
	$placement = bon_get_option( 'currency_placement' );
	$price = shandora_get_meta( $postID, 'listing_price', true );

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
			echo __( 'Please Activate Your IDX Account.', 'bon' );
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
		return '<p style="margin-top: 50px">' . __( 'Please setup your search fields in Shandora > Theme Settings > Listing Settings > Custom Search Field', 'bon' ) . '</p>';
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
		$output .= $form->form_submit( '', $search_label, 'class="button expand small flat ' . $button_color . ' radius"' );
	} else {
		$output .= '<div class="column large-12 small-11 large-uncentered small-centered" style="margin-top: 1em;">';
		$output .= wp_nonce_field( 'search-panel-submit', 'search_nonce', false, false );
		$output .= $form->form_submit( '', $search_label, 'class="button small flat ' . $button_color . ' radius"' );
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
function shandora_get_meta( $postID, $args, $is_number = false ) {
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
	} else {
		$meta = esc_attr( get_post_meta( $postID, $prefix . $args, true ) );
	}

	return $meta;
}

function shandora_get_price_range( $type = '' ) {

	$o = array();

	if ( empty( $type ) && $type != 'rent' ) {

		$min_val = bon_get_option( 'price_range_min', '0' );
		$max_val = bon_get_option( 'price_range_max', '2000000' );
		$step = bon_get_option( 'price_range_step', '5000' );
	} else {

		$min_val = bon_get_option( 'price_range_min_rent', '0' );
		$max_val = bon_get_option( 'price_range_max_rent', '1000' );
		$step = bon_get_option( 'price_range_step_rent', '50' );
	}
	$o['min'] = $min_val;
	$o['max'] = $max_val;
	$o['step'] = $step;

//wp_send_json($o);

	return $o;
}

function shandora_get_cottagesize_range() {

	$o = array();

	$min_val = bon_get_option( 'size_range_min', '0' );
	$max_val = bon_get_option( 'size_range_max', '2000000' );
	$step = bon_get_option( 'size_range_step', '5000' );

	$o['min'] = $min_val;
	$o['max'] = $max_val;
	$o['step'] = $step;

//wp_send_json($o);

	return $o;
}

function shandora_get_idx_price_range() {

	$o = array();

	$min_val = bon_get_option( 'price_range_min', '0' );
	$max_val = bon_get_option( 'price_range_max', '2000000' );
	$step = bon_get_option( 'price_range_step', '5000' );

	$o['min_val'] = $min_val;
	$o['max_val'] = $max_val;
	$o['step'] = $step;

	wp_send_json( $o );
}

function shandora_get_size_range( $type = 'lotsize' ) {

	$o = array();

	$min_val = bon_get_option( 'minimum_' . $type, '0' );
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

	if ( !wp_script_is( 'fitvids', 'registered' ) ) {
		wp_register_script( 'fitvids', trailingslashit( BON_JS ) . 'jquery.fitvids.min.js', array( 'jquery' ), false, false );
	}
	if ( !wp_script_is( 'fitvs', 'queue' ) ) {
		wp_enqueue_script( 'fitvids' );
	}
	if ( !wp_script_is( 'jplayer', 'registered' ) ) {
		wp_register_script( 'jplayer', trailingslashit( BON_JS ) . '/frontend/jplayer/jquery.jplayer.min.js', array( 'jquery' ), false, false );
	}
	if ( !wp_script_is( 'jplayer', 'queue' ) ) {
		wp_enqueue_script( 'jplayer' );
	}
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

			if ( isset( $_GET['search_orderby'] ) ) {
				$orderby = $_GET['search_orderby'];
			}

			if ( isset( $_GET['search_order'] ) ) {
				$order = $_GET['search_order'];
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
		$class = 'small-block-grid-' . $mobile . ' medium-block-grid-2 large-block-grid-4';
	} else {
		$class = 'small-block-grid-' . $mobile . ' medium-block-grid-2 large-block-grid-3';
	}

	if ( $echo ) {
		echo $class;
	} else {
		return $class;
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

	$phone = isset( $_POST['phone'] ) ? esc_attr( $_POST['phone'] ) : '';

	$subject = esc_html( $_POST['subject'] );
	$listing_id = absint( $_POST['listing_id'] );

	$messages = esc_textarea( $_POST['messages'] );

	if ( empty( $messages ) ) {
		$return_data['value'] = __('Please enter your messages.', 'bon');
		die( json_encode( $return_data ) );
	}

	if ( function_exists( 'akismet_http_post' ) && trim( get_option( 'wordpress_api_key' ) ) != '' ) {
		global $akismet_api_host, $akismet_api_port;
		$c['user_ip'] = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
		$c['blog'] = home_url();
		$c['comment_author'] = $name;
		$c['comment_author_email'] = $email;
		$c['comment_content'] = $messages;

		$query_string = '';
		foreach ( $c as $key => $data ) {
			if ( is_string( $data ) )
				$query_string .= $key . '=' . urlencode( stripslashes( $data ) ) . '&';
		}

		$response = akismet_http_post( $query_string, $akismet_api_host, '/1.1/comment-check', $akismet_api_port );

		if ( 'true' == $response[1] ) { // Akismet says it's SPAM
		$return_data['value'] = __( 'Cheatin Huh?!', 'bon' );
		die( json_encode( $return_data ) );
	}
}

/* Email configuration */

$receiver = $_POST['receiver'];

$body .= '<p style = "margin-bottom:1em">' . sprintf( __( "You have received a new contact form message via %s \n", "bon" ), get_bloginfo( 'name' ) ) . '</p>';
$body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Sender Name : %s \n", "bon" ), $name ) . '</p>';
$body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Sender Email : %s \n", "bon" ), $email ) . '</p>';
$body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Subject : %s \n", "bon" ), $subject ) . '</p>';
$body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Sender Phone Number : %s \n", "bon" ), $phone ) . '</p>';
$body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Email Send From : %s \n", "bon" ), get_permalink( $listing_id ) ) . '</p>';
$body .= '<p style = "margin-bottom:1em">' . sprintf( __( "Message : %s \n", "bon" ), $messages ) . '</p>';

$headers[] = "From: " . __( "Masters House", "bon" );
$headers[] = "Reply-To: " . $email;
$headers[] = "Content-Type: text/html";

add_filter( 'wp_mail_from', function() {
	return $email;
} );
add_filter( 'wp_mail_from_name', function() {
	return __( "Masters House", 'bon' );
} );

$subject = sprintf( "%s %s", $subject, __( "Masters House", 'bon' ) );

/* Responsne email configuration */

$response_receiver = $email;

$response_body = '<p style = "margin-bottom:1em">' . __( 'We succesfully received your request. Our representative will contact you within one hour.', 'bon' ) . '</p>';
$response_body .= '<p style = "margin-bottom:1em">' . __( 'Kind regards', 'bon' ) . ', <br>' . esc_attr( get_bloginfo( 'name' ) ) . '</p>';

$response_headers[] = "From: " . __( "Masters House", "bon" );
$response_headers[] = "Reply-To: " . __( 'no-reply@mastershouse.com', 'bon' );
$response_headers[] = "Content-Type: text/html";

$response_subject = __( 'Thank you for contacting us', 'bon' );

if ( wp_mail( $receiver, $subject, $body, $headers ) ) {
	add_filter( 'wp_mail_from', function() {
		return __( 'no-reply@mastershouse.com', 'bon' );
	} );
	add_filter( 'wp_mail_from_name', function() {
		return __( "Masters House", 'bon' );
	} );

	wp_mail( $response_receiver, $response_subject, $response_body, $response_headers );

	$return_data['success'] = '1';
	$return_data['value'] = __( 'Email was sent successfully.', 'bon' );
	die( json_encode( $return_data ) );
} else {

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

	if ( function_exists( 'akismet_http_post' ) && trim( get_option( 'wordpress_api_key' ) ) != '' ) {
		global $akismet_api_host, $akismet_api_port;
		$c['user_ip'] = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
		$c['blog'] = home_url();
		$c['comment_author'] = $name;
		$c['comment_author_email'] = $email;
		$c['comment_content'] = $messages;

		$query_string = '';
		foreach ( $c as $key => $data ) {
			if ( is_string( $data ) )
				$query_string .= $key . '=' . urlencode( stripslashes( $data ) ) . '&';
		}

		$response = akismet_http_post( $query_string, $akismet_api_host, '/1.1/comment-check', $akismet_api_port );

		if ( 'true' == $response[1] ) { // Akismet says it's SPAM
		$return_data['value'] = __( 'Cheatin Huh?!', 'bon' );
		die( json_encode( $return_data ) );
	}
}

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
$body .= '<p style = "margin-bottom:1em" >Hi&nbsp;' . $name . ',</p>';
$body .= '<p style = "margin-bottom:1em">' . __( "Thank you for downloading our ebook.", "bon" ) . ' ' . $subject . '</p>';
$body .= '<p style = "margin-bottom:1em">' . __( "You can download it here", "bon" ) . '-' . '&nbsp;<a href = "' . $link . '" target = "_blank">' . $anchor . '</a></p>';
$body .= '<p style = "margin-bottom:1em">' . __( "We hope you find this helpful!", "bon" ) . '</p>';
$body .= '<p style = "margin-bottom:1em;">';
$body .= '<a style = "display:inline-block;padding-top:0.86667em;padding-right:1.2em;padding-bottom:0.86667em;padding-left:1.2em;font-size:1.06667em;background-color: #27AE60;border-color: #0E9547;border-radius:5px;border-style:solid;border-width:0 0 5px;color:#FFF;text-decoration:none" href = "' . $link . '">' . $anchor . '</a>';
$body .= '</p>';
$body .= '<p style = "margin-bottom:1em">' . __( "All the best", "bon" ) . ', <br>' . esc_attr( get_bloginfo( 'name' ) ) . '</p>';
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
$headers[] = "Reply-To: " . __( 'no-reply@mastershouse.com', 'bon' );
$headers[] = "Content-Type: text/html";

add_filter( 'wp_mail_from', function() {
	return __( 'no-reply@mastershouse.com', 'bon' );
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

function shandora_get_dimensions( $args ) {
	$measurement = bon_get_option( 'length_measure' );
	$sizemeasurement = bon_get_option( 'measurement' );

	$prefix = bon_get_prefix();

	$suffix = SHANDORA_MB_SUFFIX;

	$string = '';
	foreach ( $args[0] as $arg ) {
		if ( $arg[$prefix . $suffix . 'dimensionsarea'] != 0 ) {
			if ( count( $args[0] ) > 1 )
				$string.=$arg[$prefix . $suffix . 'dimensionfloor'] . ': ';
			$string.=$arg[$prefix . $suffix . 'dimensionsarea'] . " $sizemeasurement";
		} else {
			if ( count( $args[0] ) > 1 )
				$string.=$arg[$prefix . $suffix . 'dimensionfloor'] . ': ';
			$string.=$arg[$prefix . $suffix . 'dimensionswidth'] . " $measurement x " . $arg[$prefix . $suffix . 'dimensionsheight'] . " $measurement";
		}
		if ( $arg !== end( $args[0] ) )
			$string.= ', ';
	}
	return $string;
}

function shandora_get_windows( $args ) {
	return shandora_get_doors_or_windows( $args, 'window' );
}

function shandora_get_doors( $args ) {
	return shandora_get_doors_or_windows( $args, 'door' );
}

function shandora_get_doors_or_windows( $args, $element ) {
	$measurement = bon_get_option( 'height_measure' );
	$string = '';
	foreach ( $args[0] as $arg ) {
		if ( $arg['shandora_listing_' . $element . 'amount'] > 0 ) {
			$string.= $arg['shandora_listing_' . $element . 'amount'] . 'x ' . $arg['shandora_listing_' . $element . 'width'] . " $measurement x " . $arg['shandora_listing_' . $element . 'height'] . " $measurement";
			if ( $arg !== end( $args[0] ) )
				$string.= ', ';
		}
	}
	return $string;
}

function shandora_home_cta( $args, $visited = 0 ) {
	foreach ( $args as $cta ) :
		if ( $visited != 3 ) {
			$onClick = '';
			$show = TRUE;
			if ( $cta['enable_home_cta_tool'] ) {
				$destination = 'open-tool';
				$link = bon_get_option( 'tool_section_cta_link_url' );
				$onClick = 'onclick="window.open(\'' . $link . '\', \'VPWindow\', \'width=1035,height=690,toolbar=0,resizable=1,scrollbars=1,status=0,location=0\'); return false;"';
				if ( $_SESSION['layoutType'] === 'mobile' )
					$show = FALSE;
			}
			if ( $cta['enable_home_cta_page'] ) {
				$destination = 'browse-all';
				$link = get_permalink( $cta['home_cta_link_page'] );
			}
			if ( $cta['enable_home_cta_post'] ) {
				$destination = 'open-post';
				$link = get_permalink( $cta['home_cta_link_post'] );
			}
			if ( $cta['enable_home_cta_url'] ) {
				$destination = 'custom-url';
				$link = $cta['home_cta_link_link_url'];
			}
		} else {
			$destination = 'request-visit';
			$link = '#visit-modal';
			$onClick = "role='button' data-toggle='modal'";
			$show = TRUE;
		}
		if ( $show ) :
			echo "<a href='$link' data-function='" . $destination . "' class='flat button large " . $cta['home_cta_color'] . " radius' $onClick>" . $cta['home_cta_text'] . "</a>";
		endif;
		endforeach;
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
		$args['columns'] = 2;
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

	function get_thumbnail_src() {

		$img = get_the_image(array(
			'link_to_post' => false,
			'meta_key' => false,
			'size' => 'post-featured',
			'format' => 'array'
			)
		);

		return $img['src'];
	}
	?>