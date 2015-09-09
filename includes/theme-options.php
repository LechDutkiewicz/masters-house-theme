<?php

/**
 * =====================================================================================================
 *
 * Setting Up the main theme options array
 * 
 * @since 1.0
 * @return array()
 *
 * ======================================================================================================
 */
if ( !function_exists( 'bon_set_theme_options' ) ) {

	function bon_set_theme_options() {
		//Stylesheets Reader
		$alt_stylesheet_path = get_template_directory() . '/assets/css/colors/';
		$alt_stylesheets = array();
		if ( is_dir( $alt_stylesheet_path ) ) {
			if ( $alt_stylesheet_dir = opendir( $alt_stylesheet_path ) ) {
				while ( ($alt_stylesheet_file = readdir( $alt_stylesheet_dir )) !== false ) {
					if ( stristr( $alt_stylesheet_file, '.css' ) !== false ) {
						$stylesheet = str_replace( '.css', '', $alt_stylesheet_file );
						$alt_stylesheets[$stylesheet] = trailingslashit( BON_THEME_URI ) . 'assets/images/colors/' . $stylesheet . '.png';
					}
				}
			}
		}

		/* $color_options = apply_filters( 'bon_color_options', array(
		  'blue' => __( 'Blue', 'bon' ),
		  'red' => __( 'Red', 'bon' ),
		  'green' => __( 'Green', 'bon' ),
		  'orange' => __( 'Orange', 'bon' ),
		  'purple' => __( 'Purple', 'bon' ),
		  ) ); */

$search_fields = apply_filters( 'bon_search_field_options', array(
	'none' => __( 'Disable', 'bon' ),
			/* 'title' => __('Post Title Field (Real Estate / Car Dealer)', 'bon'),
			  'mls' => __('MLS Text Field', 'bon'),
			  'zip' => __('Zip Text Field', 'bon'),
			  'status' => __('Status Dropdown', 'bon'),
			  'location' => __('Location Dropdown', 'bon'),
			  'location_level1' => __('Level 1 Location Only', 'bon'),
			  'location_level2' => __('Level 2 Location Only', 'bon'),
			  'location_level3' => __('Level 3 Location Only', 'bon'),
			  'feature' => __('Feature Dropdown', 'bon'), */
			  'lotsize' => __( 'Lot Size Slider', 'bon' ),
			/* 'buildingsize' => __('Building Size Slider', 'bon'),
			  'floor' => __('Floor Slider', 'bon'),
			  'agent' => __('Agent Dropdown', 'bon'),
			  'garage' => __('Garage Slider', 'bon'),
			  'basement' => __('Basement Slider', 'bon'),
			  'mortgage' => __('Mortgage Availability Dropdown', 'bon'),
			  'type' => __('Property Type Dropdown', 'bon'), */
			  'price' => __( 'Price Range Slider', 'bon' ),
			/* 'size' => __('Size Range Slider', 'bon'),
			  'bed' => __('Beds Slider', 'bon'),
			  'bath' => __('Baths Slider', 'bon'), */
			  'type' => __( 'Product category', 'bon' )
			  ) );

$car_search_fields = apply_filters( 'bon_car_search_field_options', array(
	'reg' => __( 'Reg Number Field **Car Listing**', 'bon' ),
	'car_status' => __( 'Car Status Dropdown **Car Listing**', 'bon' ),
	'mileage' => __( 'Mileage Slider **Car Listing**', 'bon' ),
	'exterior_color' => __( 'Exterior Color Field **Car Listing**', 'bon' ),
	'interior_color' => __( 'Interior Color Field **Car Listing**', 'bon' ),
	'fuel_type' => __( 'Fuel Type Field **Car Listing**', 'bon' ),
	'transmission' => __( 'Transmission Dropdown **Car Listing**', 'bon' ),
	'car_price' => __( 'Price Range Slider **Car Listing**', 'bon' ),
	'ancap' => __( 'ANCAP or Safety Slider **Car Listing**', 'bon' ),
	'dealer_location' => __( 'Dealer Location Dropdown **Car Listing**', 'bon' ),
	'car_feature' => __( 'Car Feature Dropdown **Car Listing**', 'bon' ),
	'body_type' => __( 'Body Type Dropdown **Car Listing**', 'bon' ),
	'manufacturer' => __( 'Manufacturer Dropdown **Car Listing**', 'bon' ),
	'manufacturer_level1' => __( 'Manufacturer Dropdown Level 1 **Car Listing**', 'bon' ),
	'manufacturer_level2' => __( 'Manufacturer Dropdown Level 2 **Car Listing**', 'bon' ),
	'manufacturer_level3' => __( 'Manufacturer Dropdown Level 3 **Car Listing**', 'bon' ),
	'dealer_location_level1' => __( 'Level 1 Dealer Location Only **Car Listing**', 'bon' ),
	'dealer_location_level2' => __( 'Level 2 Dealer Location Only **Car Listing**', 'bon' ),
	'dealer_location_level3' => __( 'Level 3 Dealer Location Only **Car Listing**', 'bon' ),
	'yearbuilt' => __( 'Year Built', 'bon' ),
	) );

$boat_search_fields = apply_filters( 'bon_boat_search_field_options', array(
	'reg' => __( 'Reg Number Field', 'bon' ),
	'boat_status' => __( 'Boat Condition Dropdown', 'bon' ),
	'boat_make' => __( 'Make', 'bon' ),
	'boat_model' => __( 'Model', 'bon' ),
	'boat_submodel' => __( 'Sub Model', 'bon' ),
	'boat_engine_make' => __( 'Engine Make', 'bon' ),
	'boat_engine_model' => __( 'Engine Model', 'bon' ),
	'boat_engine_submodel' => __( 'Engine Sub Model', 'bon' ),
	'boat_location' => __( 'Dealer Location Dropdown ', 'bon' ),
	'boat_location_level1' => __( 'Level 1 Dealer Location Only ', 'bon' ),
	'boat_location_level2' => __( 'Level 2 Dealer Location Only ', 'bon' ),
	'boat_location_level3' => __( 'Level 3 Dealer Location Only ', 'bon' ),
	'boat_feature' => __( 'Boat Feature Dropdown', 'bon' ),
	'yearbuilt' => __( 'Year Built', 'bon' ),
	'fuel_capacity' => __( 'Fuel Capacity', 'bon' ),
	'price' => __( 'Price Range Slider', 'bon' ),
	) );

$orderby_options = apply_filters( 'bon_orderby_options', array(
	/* 'date' => __('Date', 'bon'), */
	'price' => __( 'Price', 'bon' ),
	/* 'title' => __('Title', 'bon'), */
	'lotsize' => __( 'Size', 'bon' ),
	) );

$order_options = array(
	'ASC' => __( 'Ascending', 'bon' ),
	'DESC' => __( 'Descending', 'bon' )
	);

if ( bon_get_option( 'enable_car_listing' ) == 'yes' ) {
	$search_fields = array_merge( $search_fields, $car_search_fields );
}


$layouts = get_theme_support( 'theme-layouts' );
$args = theme_layouts_get_args();

/* Set up an array for the layout choices and add in the 'default' layout. */
$layout_choices = array();

/* Only add 'default' if it's the actual default layout. */
if ( 'default' == $args['default'] )
	$layout_choices['default'] = theme_layouts_get_string( 'default' );

/* Loop through each of the layouts and add it to the choices array with proper key/value pairs. */
foreach ( $layouts[0] as $layout ) {
	$layout_choices[$layout] = theme_layouts_get_image_string( $layout );
	if ( $layout != '1c' ) {
		$layout_choices_2[$layout] = theme_layouts_get_image_string( $layout );
	}
}



		// More Options
$slide_options = array();
$total_possible_slides = 10;
for ( $i = 1; $i <= $total_possible_slides; $i++ ) {
	$slide_options[] = $i;
}

		// Setup an array of numbers.
$numbers = array();
for ( $i = 1; $i <= 20; $i++ ) {
	$numbers[$i] = $i;
}


$options = array();
/* General */


$options[] = array( 'slug' => 'bon_options', 'label' => __( 'General Settings', 'bon' ),
	'type' => 'heading',
	'icon' => 'dashicons-admin-generic' );

$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Quick Start', 'bon' ),
	'type' => 'subheading' );


$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Custom Logo', 'bon' ),
	'desc' => __( 'Upload a logo for your theme, or specify an image URL directly. The best size is <strong>140x60 px</strong>', 'bon' ),
	'id' => 'logo',
	'std' => '',
	'type' => 'upload' );

$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Custom Logo for emails (dark version)', 'bon' ),
	'desc' => __( 'Upload a logo for your theme, or specify an image URL directly. The best size is <strong>140x60 px</strong>', 'bon' ),
	'id' => 'logo_dark',
	'std' => '',
	'type' => 'upload' );

$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Custom Favicon', 'bon' ),
	'desc' => __( 'Upload a Favicon', 'bon' ),
	'id' => 'favicon',
	'std' => '',
	'type' => 'upload' );

$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Slider Posts Limit', 'bon' ),
	'desc' => __( 'How many slideshow to show?', 'bon' ),
	'id' => 'slider_post_per_page',
	'std' => '',
	'type' => 'text' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Slider Interval', 'bon' ),
	'desc' => __( 'Slideshow Interval for each auto slide', 'bon' ),
	'id' => 'slider_interval',
	'type' => 'text' );

$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Show BreadCrumb', 'bon' ),
	'desc' => __( 'Show or hide breadcrumb page header', 'bon' ),
	'id' => 'show_page_header',
	'std' => 'show',
	'options' => array(
		'show' => __( 'Show', 'bon' ),
		'hide' => __( 'Hide', 'bon' )
		),
	'type' => 'select' );


$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Show Image Slider in Home', 'bon' ),
	'desc' => __( 'Show or hide image slider in home page template', 'bon' ),
	'id' => 'show_slider',
	'std' => 'show',
	'options' => array(
		'show' => __( 'Show', 'bon' ),
		'hide' => __( 'Hide', 'bon' )
		),
	'type' => 'select' );


$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Tracking Code', 'bon' ),
	'desc' => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'bon' ),
	'id' => 'google_analytics',
	'std' => '',
	'class' => 'code_mirror',
	'type' => 'textarea' );


// $options[] = array( 'slug' => 'bon_options', 'label' => __( 'Conversion Code', 'bon' ),
// 	'desc' => __( 'Paste your conversion tracking code here. This will be added into the footer template of your theme.', 'bon' ),
// 	'id' => 'conversion_code',
// 	'std' => '',
// 	'class' => 'code_mirror',
// 	'type' => 'textarea' );


$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Google Webmasters Center verification code', 'bon' ),
	'desc' => __( 'Paste your Google Webmasters Center verification code.', 'bon' ),
	'id' => 'site_verification',
	'std' => '',
	'class' => 'code_mirror',
	'type' => 'text' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Google Map center point latitude', 'bon' ),
	'desc' => __('The Map Latitude. You can easily find it <a href="http://www.itouchmap.com/latlong.html">here</a>. Copy and paste the latitude value generated there', 'bon'), 
	'id' => 'global_latitude',
	'type' => 'text' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Google Map center point longitude', 'bon' ),
	'desc'	=> __('The Map Longitude. You can easily find it <a href="http://www.itouchmap.com/latlong.html">here</a>. Copy and paste the latitude value generated there', 'bon'), 
	'id' => 'global_longitude',
	'type' => 'text' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Google Map starting zoom level', 'bon' ),
	'id' => 'global_zoom',
	'type' => 'number',
	'std' => '6' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Enable Disqus Comments. You can easily find how to menage it at https://disqus.com/', 'bon' ),
	'id' => 'enable_disqus',
	'type' => 'checkbox',
	'class' => 'collapsed',
	'std' => '0' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Disqus shortname', 'bon' ),
	'id' => 'disqus_shortname',
	'type' => 'text',
	'class' => 'hidden last' );

$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Display Options', 'bon' ),
	'type' => 'subheading' );

$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Custom CSS', 'bon' ),
	'desc' => __( 'Quickly add some CSS to your theme by adding it to this block. Do not use &lt;style&gt; tag', 'bon' ),
	'id' => 'custom_css',
	'std' => '',
	'class' => 'code_mirror',
	'type' => 'textarea' );

$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Custom JS', 'bon' ),
	'desc' => __( 'Quickly add some Javascript to your theme by adding it to this block. Do not use &lt;script&gt; tag ', 'bon' ),
	'id' => 'custom_js',
	'std' => '',
	'class' => 'code_mirror',
	'type' => 'textarea' );

		/**
		 * =====================================================================================================
		 *
		 * Header Settings
		 * 
		 * @category Header
		 *
		 * ======================================================================================================
		 */
		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Header Settings', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-schedule' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Show Top Menu', 'bon' ),
			'desc' => __( 'Show or hide the top menu navigation', 'bon' ),
			'id' => 'show_top_menu',
			'std' => 'show',
			'options' => array(
				'show' => __( 'Show', 'bon' ),
				'hide' => __( 'Hide', 'bon' )
				),
			'type' => 'select' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => '',
			'desc' => '',
			'std' => __( 'This section will handle the columns in the header, the area beside logo. The "Phone Number" Group and the "Address Group"', 'bon' ),
			'type' => 'info' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => sprintf( __( 'Show Header Col 1', 'bon' ), $i ),
			'desc' => __( 'Enable the the heder column 1', 'bon' ),
			'id' => 'enable_header_col_1',
			'std' => 1,
			'class' => 'collapsed',
			'type' => 'checkbox' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Header Column 1 Title', 'bon' ),
			'desc' => __( 'The title for header group 1. eq. <strong>Need help from us? Feel free to call us</strong>', 'bon' ),
			'id' => 'hgroup1_title',
			'std' => '',
			'class' => 'hidden',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Phone Number', 'bon' ),
			'desc' => __( 'The phone number eq. <strong>123-456-789-01</strong>. Separate number by commas (,) if you have more than 1 number. Maximum supported phone number is 3', 'bon' ),
			'id' => 'hgroup1_content',
			'std' => '',
			'class' => 'hidden last',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => sprintf( __( 'Show Header Col 2', 'bon' ), $i ),
			'desc' => __( 'Enable the the heder column 2', 'bon' ),
			'id' => 'enable_header_col_2',
			'std' => 1,
			'class' => 'collapsed',
			'type' => 'checkbox' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Header Column 2 Title', 'bon' ),
			'desc' => __( 'The title for header group 2. eq. <strong>Want to Meet & Talk Directly? Find us here</strong>', 'bon' ),
			'id' => 'hgroup2_title',
			'std' => '',
			'class' => 'hidden',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Call to action', 'bon' ),
			'desc' => __( 'Call to action anchor, ex: Request a free visit', 'bon' ),
			'id' => 'hgroup2_line1',
			'std' => '',
			'class' => 'hidden last',
			'type' => 'text' );

		/* $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Opening Hours', 'bon' ),
		  'desc' => __( 'The opening hour eq. <strong>Monday - Saturday (9AM - 5PM)</strong>', 'bon' ),
		  'id' => 'hgroup2_line2',
		  'std' => '',
		  'class' => 'hidden last',
		  'type' => 'text' ); */

$options[] = array( 'slug' => 'bon_options',
	'label' => sprintf( __( 'Centering Logo', 'bon' ), $i ),
	'desc' => __( 'Centering the logo if both the header column is disabled.', 'bon' ),
	'id' => 'centering_logo',
	'std' => 0,
	'type' => 'checkbox' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Show Header Search Field', 'bon' ),
	'desc' => __( 'Show the search field in the header / menu.', 'bon' ),
	'id' => 'show_header_search',
	'std' => 'yes',
	'options' => array(
		'yes' => __( 'Yes', 'bon' ),
		'no' => __( 'No', 'bon' ),
		),
	'type' => 'select' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Header Default State', 'bon' ),
	'desc' => __( 'Set the header default state to hide or show the main header. Note: this setting will be overriden by cookie setting if header already toggled.', 'bon' ),
	'id' => 'show_main_header',
	'options' => array(
		'show' => __( 'Show', 'bon' ),
		'hide' => __( 'Hide', 'bon' ),
		),
	'type' => 'select' );


		/**
		 * =====================================================================================================
		 *
		 * Color Settings
		 * 
		 * @category Color
		 *
		 * ======================================================================================================
		 */
		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Color Settings', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-admin-appearance' );

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Main Color Style', 'bon' ),
			'desc' => __( 'Choose colorization stylesheet.', 'bon' ),
			'id' => 'main_color_style',
			'std' => 'blue',
			'type' => 'radio-img',
			'options' => $alt_stylesheets,
			);*/

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Main header color Style', 'bon' ),
	'desc' => __( 'Choose main header style.', 'bon' ),
	'id' => 'main_header_style',
	'type' => 'select',
	'options' => array(
		'dark' => __( 'Dark', 'bon' ),
		'light' => __( 'Light', 'bon' )
		),
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Main header navigation color Style', 'bon' ),
	'desc' => __( 'Choose main header navigation style.', 'bon' ),
	'id' => 'main_header_nav_style',
	'type' => 'select',
	'theme_customizer' => array(
		'customizer_section' => 'nav',
		'customizer_section_title' => __( 'Navigation Color', 'bon' ),
		'customizer_section_priority' => 100,
		'customizer_section_theme' => false,
		),
	'options' => array(
		'dark' => __( 'Dark', 'bon' ),
		'light' => __( 'Light', 'bon' )
		),
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'CTA Button Color', 'bon' ),
	'id' => 'cta_button_color',
	'type' => 'radio-img',
	'options' => get_colors_list()
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Build your house tool button color', 'bon' ),
	'id' => 'tool_button_color',
	'type' => 'radio-img',
	'options' => get_colors_list()
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Search Listing Button Color', 'bon' ),
	'id' => 'search_button_color',
	'type' => 'radio-img',
	'options' => get_colors_list()
	);


		/**
		 * =====================================================================================================
		 *
		 * Listing Settings
		 * 
		 * @category Listing
		 *
		 * ======================================================================================================
		 */
		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Listing Settings', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-editor-ul' );


		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'General Options', 'bon' ),
			'type' => 'subheading' );


		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Show Search Panel', 'bon' ),
			'desc' => __( 'If enable there will show the main search panel in all listing related page', 'bon' ),
			'id' => 'enable_search_panel',
			'type' => 'select',
			'options' => array(
				'yes' => __( 'Yes', 'bon' ),
				'no' => __( 'No', 'bon' )
				),
			);

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Multi Search Panel', 'bon' ),
			'desc' => __( 'Choose which search bar you want to show.', 'bon' ),
			'id' => 'search_panel_tab',
			'std' => array(
				'property' => true,
				'car' => false,
				'boat' => false
			),
			'type' => 'multicheck',
			'options' => array(
				'property' => __( 'Real Estate', 'bon' ),
				'car' => __( 'Car Dealer', 'bon' ),
				'boat' => __( 'Boat Dealer', 'bon' )
			)
);*/

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Enable Real Estate Listing', 'bon' ),
	'desc' => __( 'If enable there will be new menu in admin', 'bon' ),
	'id' => 'enable_property_listing',
	'type' => 'select',
	'options' => array(
		'yes' => __( 'Yes', 'bon' ),
		'no' => __( 'No', 'bon' )
		),
	);

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Enable Car Dealership Listing', 'bon' ),
			'desc' => __( 'If enable there will be new menu in admin', 'bon' ),
			'id' => 'enable_car_listing',
			'type' => 'select',
			'options' => array(
				'yes' => __( 'Yes', 'bon' ),
				'no' => __( 'No', 'bon' )
			),
);*/

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Default Order By', 'bon' ),
	'desc' => __( 'Select default listing order by', 'bon' ),
	'id' => 'listing_orderby',
	'type' => 'select',
	'options' => $orderby_options
	);


$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Default Order', 'bon' ),
	'desc' => __( 'Select default listing order', 'bon' ),
	'id' => 'listing_order',
	'type' => 'select',
	'options' => $order_options
	);

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Exclude sold / rented listing', 'bon' ),
			'desc' => __( 'If enabled the listing with sold / rented status will not included in the post lists display', 'bon' ),
			'id' => 'exclude_sold_rented',
			'type' => 'select',
			'options' => array(
				'no' => __( 'No', 'bon' ),
				'yes' => __( 'Yes', 'bon' ),
			),
);*/

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Front End Post Page', 'bon' ),
			'desc' => __( 'The page that hold the front end editor shortcode <code>[bon-fee]</code>. This page will be use as the edit and add new post container.', 'bon' ),
			'id' => 'fee_post_page',
			'type' => 'page_select',
			);*/

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'My Account Page', 'bon' ),
			'desc' => __( 'The page that hold the myaccount shortcode <code>[bon-account]</code>.', 'bon' ),
			'id' => 'my_account_page',
			'type' => 'page_select',
			);*/


		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Compare Page', 'bon' ),
			'desc' => __( 'Page where the listing compare result will be.', 'bon' ),
			'id' => 'compare_page',
			'type' => 'page_select',
			);*/



$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Search Result Page', 'bon' ),
	'desc' => __( 'Page where the listing search result will be.', 'bon' ),
	'id' => 'search_listing_page',
	'type' => 'page_select',
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Number of Listings to Show', 'bon' ),
	'desc' => __( 'How many of listing you want to show for search listing page and browse listing page.', 'bon' ),
	'id' => 'listing_per_page',
	'type' => 'text',
	'std' => '8',
	);



$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Price As Text Label', 'bon' ),
	'desc' => __( 'Use this as text placeholder for place you want to set as text only', 'bon' ),
	'id' => 'price_text',
	'std' => __( 'Call For Quote', 'bon' ),
	'type' => 'text',
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Price Currency', 'bon' ),
	'desc' => __( 'Input the size currency that will be used in listing price.', 'bon' ),
	'id' => 'currency',
	'type' => 'text',
	'std' => '$'
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Currency symbol placement', 'bon' ),
	'desc' => __( 'Choose which format of the currency symbol placement.', 'bon' ),
	'id' => 'currency_placement',
	'type' => 'select',
	'options' => array(
		'left' => '$1,234,567',
		'left-space' => '$ 1,234,567 (with space)',
		'right' => '1,234,567$',
		'right-space' => '1,234,567 $ (with space)'
		)
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Price Format', 'bon' ),
	'desc' => __( 'Choose the price format.', 'bon' ),
	'id' => 'price_format',
	'type' => 'select',
	'options' => array(
		'comma' => '$1,234,567.00 (with comma)',
		'dot' => '$1.234.567.00 (with dot)',
		)
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Cottage package types', 'bon' ),
	'desc' => __( 'Add package for cottages', 'bon' ),
	'id' => 'cottage_packages',
	'type' => 'repeatable',
	'sanitize' => array(
		'name' => 'sanitize_text_field',
		),
	'repeatable_fields' => array(
		array(
			'label' => __( 'Package name', 'bon' ),
			'id' => 'package_name',
			'type' => 'text',
			'std' => '',
			),
		array(
			'options' => get_colors_list(),
			'label' => __( 'Color', 'bon' ),
			'id' => 'package_color',
			'type' => 'radio-img',
			'std' => 'carrot',
			),
		array(
			'label' => __( 'Wall material', 'bon' ),
			'id' => 'package_material',
			'type' => 'text',
			),
		array(
			'label' => __( 'Wall thickness', 'bon' ),
			'desc' => __( 'Product wall thickness in milimeters, without unit', 'bon' ),
			'id' => 'package_wall_thickness',
			'type' => 'number',
			),
		array(
			'label' => __( 'Windows and doors thickness', 'bon' ),
			'desc' => __( 'Product windows and door thickness in milimeters, without unit', 'bon' ),
			'id' => 'package_windows_thickness',
			'type' => 'number',
			),
		array(
			'label' => __( 'Package description', 'bon' ),
			'id' => 'package_desc',
			'type' => 'editor',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => true,
				'textarea_rows' => 30
				),
			),
		) );

$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Template Options', 'bon' ),
	'type' => 'subheading' );

$options[] = array( 'slug' => 'bon_options',
	'label' => '',
	'desc' => '',
	'std' => __( 'The section below will handle the listing map view for the listing generated by page template or the archive and category page for listing.', 'bon' ),
	'type' => 'info' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Show Listing Count in Listing Page', 'bon' ),
	'desc' => __( 'Show the listing count before the listing list', 'bon' ),
	'id' => 'show_listing_count',
	'type' => 'select',
	'options' => array(
		'yes' => __( 'Yes', 'bon' ),
		'no' => __( 'No', 'bon' ),
		)
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => '',
	'desc' => '',
	'std' => __( 'The section below will handle the listing details view.', 'bon' ),
	'type' => 'info' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Show Listing Gallery Thumbnail', 'bon' ),
	'desc' => __( 'Show the listing gallery thumbnail', 'bon' ),
	'id' => 'listing_gallery_thumbnail',
	'type' => 'select',
	'std' => 'yes',
	'options' => array(
		'yes' => __( 'Thumbnail Only', 'bon' ),
		'no' => __( 'Controller Only', 'bon' ),
		'both' => __( 'Both Controller and Thumbnail', 'bon' )
		) );


$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Show Image Caption in Gallery', 'bon' ),
	'desc' => __( 'Show the image caption in gallery image slider.', 'bon' ),
	'id' => 'show_gallery_caption',
	'type' => 'select',
	'options' => array(
		'yes' => __( 'Yes', 'bon' ),
		'no' => __( 'No', 'bon' ),
		)
	);


$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Banner displayed for features section', 'bon' ),
	'id' => 'features_section_image',
	'type' => 'upload',
	);


$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Banner displayed for quality section', 'bon' ),
	'id' => 'quality_section_image',
	'type' => 'upload',
	);


$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Show Related Listings', 'bon' ),
	'desc' => __( 'Show Related Listings in Single Listing Detail Page', 'bon' ),
	'id' => 'show_related',
	'type' => 'select',
	'options' => array(
		'no' => __( 'No', 'bon' ),
		'yes' => __( 'Yes', 'bon' ),
		)
	);


$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Show Agent Detail', 'bon' ),
	'desc' => __( 'Show the agent details in the listing footer / beside the contact form.', 'bon' ),
	'id' => 'show_agent_details',
	'type' => 'select',
	'options' => array(
		'yes' => __( 'Yes', 'bon' ),
		'no' => __( 'No', 'bon' ),
		)
	);


$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Show Contact Form', 'bon' ),
	'desc' => __( 'Show the contact form in the listing footer.', 'bon' ),
	'id' => 'show_contact_form',
	'type' => 'select',
	'std' => 'yes',
	'options' => array(
		'yes' => __( 'Yes', 'bon' ),
		'no' => __( 'No', 'bon' ),
		)
	);


$options[] = array( 'slug' => 'bon_options',
	'label' => '',
	'desc' => '',
	'std' => __( 'The section below will handle the view of the listing lists.', 'bon' ),
	'type' => 'info' );


$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Show Mouse Hover overlay', 'bon' ),
	'desc' => __( 'Show the overlay ( the stuff with permalink, gallery, compare button ) on mouse over ', 'bon' ),
	'id' => 'show_overlay',
	'type' => 'select',
	'std' => 'yes',
	'options' => array(
		'yes' => __( 'Yes', 'bon' ),
		'no' => __( 'No', 'bon' ),
		)
	);


$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Mouse Overlay button', 'bon' ),
	'desc' => __( 'Choose which one of the button you want to show in the listing overlay if enabled.', 'bon' ),
	'id' => 'overlay_buttons',
	'std' => array(
		'link' => true,
		'gallery' => true,
		'compare' => true
		),
	'type' => 'multicheck',
	'options' => array(
		'link' => __( 'Permalink Button', 'bon' ),
		'gallery' => __( 'Gallery Button', 'bon' ),
		'compare' => __( 'Compare Button', 'bon' ),
		)
	);



$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Measurement Options', 'bon' ),
	'type' => 'subheading' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Size Measurement', 'bon' ),
	'desc' => __( 'The size measurement that will be used in lot size and building size.', 'bon' ),
	'id' => 'measurement',
	'type' => 'text',
	'std' => 'Sq Ft'
	);

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Volume Measurement', 'bon' ),
			'desc' => __( 'The length measurement that will be used capacity.', 'bon' ),
			'id' => 'volume_measure',
			'type' => 'text',
			'std' => 'litres'
			);*/

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Speed Measurement', 'bon' ),
			'desc' => __( 'The speed measurement.', 'bon' ),
			'id' => 'speed_measure',
			'type' => 'text',
			'std' => 'knots'
			);*/


$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Height Measurement', 'bon' ),
	'desc' => __( 'The height measurement that will be used in dimension.', 'bon' ),
	'id' => 'height_measure',
	'type' => 'text',
	'std' => 'feet'
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Width Measurement', 'bon' ),
	'desc' => __( 'The width measurement that will be used in dimension.', 'bon' ),
	'id' => 'width_measure',
	'type' => 'text',
	'std' => 'feet'
	);


$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Length Measurement', 'bon' ),
	'desc' => __( 'The length measurement that will be used in dimension.', 'bon' ),
	'id' => 'length_measure',
	'type' => 'text',
	'std' => 'in.'
	);

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Mileage Measurement', 'bon' ),
			'desc' => __( 'The mileage measurement that will be used in mileage.', 'bon' ),
			'id' => 'mileage_measure',
			'type' => 'text',
			'std' => 'miles'
			);*/


$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Search Panel Options', 'bon' ),
	'type' => 'subheading' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Price Slider Minimum Value', 'bon' ),
	'desc' => __( 'Minimum Value for the Price Range slider in the Search Listing Options', 'bon' ),
	'id' => 'price_range_min',
	'std' => '0',
	'type' => 'text' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Price Slider Maximum Value', 'bon' ),
	'desc' => __( 'Maximum Value for the Price Range slider in the Search Listing Options', 'bon' ),
	'id' => 'price_range_max',
	'std' => '1000000',
	'type' => 'text' );

		/* $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Price Slider Minimum Value (Rent Only)', 'bon' ),
		  'desc' => __('Minimum Value for the Price Range slider in the Search Listing Options when user choosing For Rent Status.','bon'),
		  'id' => 'price_range_min_rent',
		  'std' =>  '0',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Price Slider Maximum Value (Rent Only)', 'bon' ),
		  'desc' => __('Maximum Value for the Price Range slider in the Search Listing Options when user choosing For Rent Status.','bon'),
		  'id' => 'price_range_max_rent',
		  'std' =>  '10000',
		  'type' => 'text' ); */

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Price Slider Step Value', 'bon' ),
	'desc' => __( 'Step Value for the Price Range slider when the Slide Event fired', 'bon' ),
	'id' => 'price_range_step',
	'std' => '5000',
	'type' => 'text' );

		/* $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Size Slider Minimum Value', 'bon' ),
		  'desc' => __('Minimum Value for the Price Range slider in the Search Listing Options','bon'),
		  'id' => 'size_range_min',
		  'std' =>  '0',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Size Slider Maximum Value', 'bon' ),
		  'desc' => __('Maximum Value for the Price Range slider in the Search Listing Options','bon'),
		  'id' => 'size_range_max',
		  'std' =>  '1000000',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Price Slider Step Value', 'bon' ),
		  'desc' => __('Step Value for the Price Range slider when the Slide Event fired','bon'),
		  'id' => 'size_range_step',
		  'std' =>  '5000',
		  'type' => 'text' ); */

		/* $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Price Slider Step Value (Rent Only)', 'bon' ),
		  'desc' => __('Step Value for the Price Range slider when the Slide Event fired, for when user choosing Rent Status only.','bon'),
		  'id' => 'price_range_step_rent',
		  'std' =>  '50',
		  'type' => 'text' ); */


		/* $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Maximum Bed Options', 'bon' ),
		  'desc' => __('The maximum bed available for user to select','bon'),
		  'id' => 'maximum_bed',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Maximum Bath Options', 'bon' ),
		  'desc' => __('The maximum bath available for user to select','bon'),
		  'id' => 'maximum_bath',
		  'type' => 'text' ); */

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Size Slider Minimum Value', 'bon' ),
	'desc' => __( 'The minimum lot size available for user to select', 'bon' ),
	'id' => 'minimum_lotsize',
	'std' => '0',
	'type' => 'text' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Size Slider Maximum Value', 'bon' ),
	'desc' => __( 'The maximum lot size available for user to select', 'bon' ),
	'id' => 'maximum_lotsize',
	'std' => '10000',
	'type' => 'text' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Size Slider Step', 'bon' ),
	'desc' => __( 'The step for lot size slider', 'bon' ),
	'id' => 'step_lotsize',
	'std' => '100',
	'type' => 'text' );

		/* $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Minimum Building Size Options', 'bon' ),
		  'desc' => __('The minimum building size available for user to select','bon'),
		  'id' => 'minimum_buildingsize',
		  'std' => '0',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Maximum Building Size Options', 'bon' ),
		  'desc' => __('The maximum building size available for user to select','bon'),
		  'id' => 'maximum_buildingsize',
		  'std' => '10000',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Building Size Slider Step', 'bon' ),
		  'desc' => __('The step for building size slider','bon'),
		  'id' => 'step_buildingsize',
		  'std' => '100',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Maximum Floor Options', 'bon' ),
		  'desc' => __('The maximum floor available for user to select','bon'),
		  'id' => 'maximum_floor',
		  'std' => '5',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Maximum Garage Options', 'bon' ),
		  'desc' => __('The maximum garage available for user to select','bon'),
		  'id' => 'maximum_garage',
		  'std' => '5',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Maximum Basement Options', 'bon' ),
		  'desc' => __('The maximum basement available for user to select','bon'),
		  'id' => 'maximum_basement',
		  'std' => '5',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Minimum Mileage Options', 'bon' ),
		  'desc' => __('The minimum mileage available for user to select','bon'),
		  'id' => 'minimum_mileage',
		  'std' => '0',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Maximum Mileage Options', 'bon' ),
		  'desc' => __('The maximum mileage available for user to select','bon'),
		  'id' => 'maximum_mileage',
		  'std' => '10000',
		  'type' => 'text' );

		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Mileage Slider Step', 'bon' ),
		  'desc' => __('The step for mileage slider','bon'),
		  'id' => 'step_mileage',
		  'std' => '100',
		  'type' => 'text' );


		  $options[] = array( 'slug' => 'bon_options',
		  'label' => __( 'Minimum Year Built value', 'bon' ),
		  'desc' => __('Minimum Value for the year built dropdown in the Search Listing Options','bon'),
		  'id' => 'min_year_range',
		  'std' =>  '2011',
		  'type' => 'text' ); */

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Search Button Label', 'bon' ),
	'desc' => __( 'The search button label', 'bon' ),
	'id' => 'search_button_label',
	'std' => 'Find Property',
	'type' => 'text' );


$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Custom Search Field', 'bon' ),
	'type' => 'subheading' );

for ( $i = 1; $i < 4; $i++ ) {
	$std = 0;
	$options[] = array( 'slug' => 'bon_options',
		'label' => sprintf( __( 'Enable Search Row %s', 'bon' ), $i ),
		'desc' => __( 'Enable the search row', 'bon' ),
		'id' => 'search_row_' . $i,
		'std' => $std,
		'class' => 'collapsed',
		'type' => 'checkbox' );

	for ( $j = 1; $j < 4; $j++ ) {
		$class = 'hidden';
		if ( $j == 3 ) {
			$class = 'hidden last';
		}
		$options[] = array( 'slug' => 'bon_options',
			'label' => sprintf( __( 'Row %1s Column %2s Field', 'bon' ), $i, $j ),
			'desc' => __( 'Choose the field for the search panel', 'bon' ),
			'id' => 'search_row_' . $i . '_col_' . $j,
			'type' => 'select',
			'class' => $class,
			'options' => $search_fields
			);
	}
}

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Location Level 1 Label', 'bon' ),
			'desc' => __( 'If you are using multilevel location define the label here.', 'bon' ),
			'id' => 'location_level1_label',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Location Level 2 Label', 'bon' ),
			'desc' => __( 'If you are using multilevel location define the label here.', 'bon' ),
			'id' => 'location_level2_label',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Location Level 3 Label', 'bon' ),
			'desc' => __( 'If you are using multilevel location define the label here.', 'bon' ),
			'id' => 'location_level3_label',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Manufacturer Level 1 Label', 'bon' ),
			'desc' => __( 'If you are using multilevel manufacturer define the label here. eq: Make', 'bon' ),
			'id' => 'manufacturer_level1_label',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Manufacturer Level 2 Label', 'bon' ),
			'desc' => __( 'If you are using multilevel manufacturer define the label here. eq: Model', 'bon' ),
			'id' => 'manufacturer_level2_label',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Manufacturer Level 3 Label', 'bon' ),
			'desc' => __( 'If you are using multilevel manufacturer define the label here. eq: Sub Model', 'bon' ),
			'id' => 'manufacturer_level3_label',
			'type' => 'text' );*/


		/*$options[] = array( 'slug' => 'bon_options', 'label' => __( 'IDX Search Options', 'bon' ),
			'type' => 'subheading' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Use IDX Search Form', 'bon' ),
			'desc' => __( 'If dsIDXpress Plugin is installed, use the searchform instead.', 'bon' ),
			'id' => 'use_idx_search',
			'std' => 'no',
			'options' => array(
				'no' => __( 'No', 'bon' ),
				'yes' => __( 'Yes', 'bon' ),
			),
			'type' => 'select' );


		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Enabled autoload options from IDX', 'bon' ),
			'desc' => __( 'If you do not want to specify the city please set this to yes. If set to no you need to specify the city.', 'bon' ),
			'id' => 'idx_enable_search_autoload',
			'options' => array(
				'yes' => __( 'Yes', 'bon' ),
				'no' => __( 'No', 'bon' ),
			),
			'type' => 'select' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'IDX Search Options Limit', 'bon' ),
			'desc' => __( 'If auto load options is enabled the idx will automatically query the city, zip, tract, community options by default. Set the limit for the options. This is to prevent resource overload since the queried city can be more than 1000. Default is set to 100', 'bon' ),
			'id' => 'idx_search_option_limit',
			'type' => 'text' );


		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Manual IDX City Options (one per line)', 'bon' ),
			'desc' => __( 'The list of idx city for the search options panel.', 'bon' ),
			'id' => 'idx_manual_city',
			'type' => 'textarea' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Manual IDX Tract Options (one per line)', 'bon' ),
			'desc' => __( 'The list of idx tract for the search options panel.', 'bon' ),
			'id' => 'idx_manual_tract',
			'type' => 'textarea' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Manual IDX Zip Options (one per line)', 'bon' ),
			'desc' => __( 'The list of idx zip for the search options panel.', 'bon' ),
			'id' => 'idx_manual_zip',
			'type' => 'textarea' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Manual IDX Community Options (one per line)', 'bon' ),
			'desc' => __( 'The list of idx community for the search options panel.', 'bon' ),
			'id' => 'idx_manual_community',
			'type' => 'textarea' );*/


$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Agent Options', 'bon' ),
	'type' => 'subheading' );

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Show Contact Form in Agent Page', 'bon' ),
			'desc' => __( 'Show Contact form when viewing agent page?', 'bon' ),
			'id' => 'show_agent_form',
			'type' => 'select',
			'options' => array(
				'yes' => __( 'Yes', 'bon' ),
				'no' => __( 'No', 'bon' ),
			)
		);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Show Agent Latest Listings', 'bon' ),
			'desc' => __( 'Show Agent Latest Listings in Single Agent Page', 'bon' ),
			'id' => 'show_agent_listing',
			'type' => 'select',
			'options' => array(
				'yes' => __( 'Yes', 'bon' ),
				'no' => __( 'No', 'bon' ),
			)
);*/

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Set 1 agent for all Products', 'bon' ),
	'desc' => __( 'Set a global agent to connected in all Products', 'bon' ),
	'id' => 'global_agent',
	'type' => 'old_post_select',
	'post_type' => 'agent',
	);


		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Set 1 Sales Rep for all Car listings', 'bon' ),
			'desc' => __( 'Set a global agent to connected in all car dealer listings', 'bon' ),
			'id' => 'global_sales_rep',
			'type' => 'old_post_select',
			'post_type' => 'sales-representative'
			);*/


		/**
		 * =====================================================================================================
		 *
		 * Layout Settings
		 * 
		 * @category Layout
		 *
		 * ======================================================================================================
		 */
		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Layout Settings', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-align-center' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'How many listing per row in mobile view?', 'bon' ),
			'desc' => __( 'Set the listing per row in mobile view.', 'bon' ),
			'id' => 'mobile_layout',
			'std' => '2',
			'type' => 'select',
			'options' => array(
				'1' => '1',
				'2' => '2',
				),
			);



		$options[] = array( 'slug' => 'bon_options',
			'label' => '',
			'desc' => '',
			'std' => __( 'This section will handle the layout for categories, archives and post type taxonomy archives layout. Layout for page and single post can be set in the post/page edit page.', 'bon' ),
			'type' => 'info' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Archive Layout', 'bon' ),
			'desc' => __( 'Layout for archive page.', 'bon' ),
			'id' => 'archive_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices,
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Category Layout', 'bon' ),
			'desc' => __( 'Layout for category archive page.', 'bon' ),
			'id' => 'category_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices,
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Search Layout', 'bon' ),
			'desc' => __( 'Layout for search page.', 'bon' ),
			'id' => 'search_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices,
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Tags Archive Layout', 'bon' ),
			'desc' => __( 'Layout for tags archive page.', 'bon' ),
			'id' => 'tag_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices,
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Property Type Archive Layout', 'bon' ),
			'desc' => __( 'Layout for property-type listing archive page.', 'bon' ),
			'id' => 'property_type_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices,
			);

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Property Location Archive Layout', 'bon' ),
			'desc' => __( 'Layout for property-location listing archive page.', 'bon' ),
			'id' => 'property_location_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices,
		);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Property Feature Archive Layout', 'bon' ),
			'desc' => __( 'Layout for property-feaure listing archive page.', 'bon' ),
			'id' => 'property_feature_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices,
		);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Car Feature Archive Layout', 'bon' ),
			'desc' => __( 'Layout for car-feature listing archive page.', 'bon' ),
			'id' => 'car_feature_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices,
		);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Dealer Location Archive Layout', 'bon' ),
			'desc' => __( 'Layout for dealer-location listing archive page.', 'bon' ),
			'id' => 'dealer_location_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices,
			);*/

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Body Type Archive Layout', 'bon' ),
	'desc' => __( 'Layout for body-type listing archive page.', 'bon' ),
	'id' => 'body_type_layout',
	'std' => '2c-l',
	'type' => 'radio-img',
	'options' => $layout_choices,
	);

		/*$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Manufactuere Archive Layout', 'bon' ),
			'desc' => __( 'Layout for manufacturer listing archive page.', 'bon' ),
			'id' => 'manufacturer_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices,
		);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'IDX Page Layout', 'bon' ),
			'desc' => __( 'Layout for idx page.', 'bon' ),
			'id' => 'idx_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices,
		);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'IDX Details page Layout', 'bon' ),
			'desc' => __( 'Layout for idx details page.', 'bon' ),
			'id' => 'idx_details_layout',
			'std' => '2c-l',
			'type' => 'radio-img',
			'options' => $layout_choices_2,
			);*/




		/**
		 * =====================================================================================================
		 *
		 * About us page Settings
		 * 
		 * @category Tool
		 *
		 * ======================================================================================================
		 */
		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'About us page settings', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-admin-site' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'First section heading', 'bon' ),
			'desc' => __( 'Type in text displayed in the first section heading', 'bon' ),
			'id' => 'about_us_heading_first',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'First section content', 'bon' ),
			'desc' => __( 'Custom HTML and Text that will appear in the first section.', 'bon' ),
			'id' => 'about_us_content_first',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => false,
				'textarea_rows' => 30
				),
			'type' => 'editor' );
		
		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Advantages section heading', 'bon' ),
			'desc' => __( 'Type in text displayed in the advantages section heading', 'bon' ),
			'id' => 'about_us_heading_advantages',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Advantages records', 'bon' ),
			'id' => 'about_us_advantages',
			'type' => 'repeatable',
			'sanitize' => array(
				'name' => 'sanitize_text_field',
				),
			'repeatable_fields' => array(
				array(
					'type' => 'text',
					'label' => __( 'Advantage name', 'bon' ),
					'id' => 'advantage_name',
					'std' => '',
					)
				) );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Second section heading', 'bon' ),
			'desc' => __( 'Type in text displayed in the second section heading', 'bon' ),
			'id' => 'about_us_heading_second',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Second section content', 'bon' ),
			'desc' => __( 'Custom HTML and Text that will appear in the second section.', 'bon' ),
			'id' => 'about_us_content_second',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => false
				),
			'type' => 'editor' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Second section image', 'bon' ),
			'desc' => __( 'Image displayed in the second section', 'bon' ),
			'id' => 'about_us_img_second',
			'type' => 'upload' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Our team heading', 'bon' ),
			'desc' => __( 'Type in text displayed in the our team section heading', 'bon' ),
			'id' => 'about_us_heading_team',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Our team content', 'bon' ),
			'desc' => __( 'Custom HTML and Text that will appear in the our team section.', 'bon' ),
			'id' => 'about_us_content_team',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => false
				),
			'type' => 'editor' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Contact us heading', 'bon' ),
			'desc' => __( 'Type in text displayed in the contact us section heading', 'bon' ),
			'id' => 'about_us_heading_contact',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Contact content', 'bon' ),
			'desc' => __( 'Custom HTML and Text that will appear in the contact section.', 'bon' ),
			'id' => 'about_us_content_contact',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => false
				),
			'type' => 'editor' );


		/**
		 * =====================================================================================================
		 *
		 * Tool Section Settings
		 * 
		 * @category Tool
		 *
		 * ======================================================================================================
		 */
		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Tool Section Settings', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-image-crop' );

		$options[] = array(
			'type' => 'checkbox',
			'label' => __( 'Display on pages', 'bon' ),
			'desc' => __( 'Choose to show or hide it', 'bon' ),
			'id' => 'tool_section_display'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'label' => __( 'Text displayed as customization section title', 'bon' ),
			'id' => 'customize_section_title',
			'type' => 'text'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'label' => __( 'Customization section images', 'bon' ),
			'desc' => __( 'Image displayed in customization section', 'bon' ),
			'id' => 'customize_section_img_1',
			'type' => 'upload'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Image displayed in customization section', 'bon' ),
			'id' => 'customize_section_img_2',
			'type' => 'upload'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Image displayed in customization section', 'bon' ),
			'id' => 'customize_section_img_3',
			'type' => 'upload'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'label' => __( 'Texts displayed in customization section', 'bon' ),
			'desc' => __( 'First section header', 'bon' ),
			'id' => 'customize_section_header_1',
			'type' => 'text'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'First section content', 'bon' ),
			'id' => 'customize_section_content_1',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => false
				),
			'type' => 'editor'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Second section header', 'bon' ),
			'id' => 'customize_section_header_2',
			'type' => 'text'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Second section content', 'bon' ),
			'id' => 'customize_section_content_2',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => false
				),
			'type' => 'editor'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Third section header', 'bon' ),
			'id' => 'customize_section_header_3',
			'type' => 'text'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Third section content', 'bon' ),
			'id' => 'customize_section_content_3',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => false
				),
			'type' => 'editor'
			);

		/*$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Tool section image', 'bon' ),
			'desc' => __( 'Image displayed in tool section', 'bon' ),
			'id' => 'tool_section_img',
			'type' => 'upload' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Title on product page', 'bon' ),
			'desc' => __( 'Type in text displayed in section title', 'bon' ),
			'id' => 'tool_section_title',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Heading on product page', 'bon' ),
			'desc' => __( 'Type in text displayed in section heading', 'bon' ),
			'id' => 'tool_section_heading',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Content on product page', 'bon' ),
			'desc' => __( 'Custom HTML and Text that will appear in the section of your theme.', 'bon' ),
			'id' => 'tool_section_content',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => false
				),
			'type' => 'editor' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'CTA', 'bon' ),
			'desc' => __( 'Type in text displayed in section CTA on product page', 'bon' ),
			'id' => 'tool_section_cta',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Title on home page', 'bon' ),
			'desc' => __( 'Type in text displayed in section title', 'bon' ),
			'id' => 'tool_section_home_title',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Heading on home page', 'bon' ),
			'desc' => __( 'Type in text displayed in section heading', 'bon' ),
			'id' => 'tool_section_home_heading',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Content on home page', 'bon' ),
			'desc' => __( 'Custom HTML and Text that will appear in the section of your theme.', 'bon' ),
			'id' => 'tool_section_home_content',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => false
				),
			'type' => 'editor' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'CTA', 'bon' ),
			'desc' => __( 'Type in text displayed in section CTA on home page', 'bon' ),
			'id' => 'tool_section_home_cta',
			'type' => 'text' );

		$options[] = array(
			'type' => 'select',
			'label' => __( 'Display on pages', 'bon' ),
			'desc' => __( 'Choose to show or hide it on certaing pages', 'bon' ),
			'options' => array(
				'1' => __( 'Product page only', 'bon' ),
				'2' => __( 'Product page and home page', 'bon' ),
				'3' => __( 'Home page only', 'bon' ),
				'4' => __( 'Neither home, nor product page', 'bon' )
				),
			'id' => 'tool_section_display'
			);

		$options[] = array(
			'type' => 'select',
			'label' => __( 'Contact us button', 'bon' ),
			'desc' => __( 'Choose to show or hide it on certaing pages', 'bon' ),
			'options' => array(
				'1' => __( 'Product page only', 'bon' ),
				'2' => __( 'Product page and home page', 'bon' ),
				'3' => __( 'Home page only', 'bon' ),
				'4' => __( 'Neither home, nor product page', 'bon' )
				),
			'id' => 'tool_section_contact_display'
			);*/

$options[] = array(
	'type' => 'text',
	'label' => __( 'Tool link', 'bon' ),
	'desc' => __( 'Type your own link to the tool', 'bon' ),
	'id' => 'tool_section_cta_link_url'
	);

		/*$options[] = array(
			'options' => get_colors_list(),
			'type' => 'radio-img',
			'label' => __( 'Cta color', 'bon' ),
			'desc' => __( 'Pick cta color', 'bon' ),
			'id' => 'tool_section_cta_color'
			);*/


		/**
		 * =====================================================================================================
		 *
		 * Home Page Settings
		 * 
		 * @category Tool
		 *
		 * ======================================================================================================
		 */
		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Home Page Settings', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-admin-home' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'About us section title', 'bon' ),
			'desc' => __( 'Type in text displayed in home screen about us section title', 'bon' ),
			'id' => 'home_features_title',
			'type' => 'text' );

		/* CALL TO ACTION SETUP */

		$options[] = array(
			'slug' => 'bon_options',
			'label' => __( 'Slogan', 'bon' ),
			'desc' => __( 'Type in text displayed in home screen slogan', 'bon' ),
			'id' => 'home_slogan',
			'type' => 'text' );

		$options[] = array(
			'slug' => 'bon_options',
			'label' => __( 'Home call to action', 'bon' ),
			'desc' => __( 'Add call to action', 'bon' ),
			'id' => 'home_cta',
			'type' => 'repeatable',
			'sanitize' => array(
				'name' => 'sanitize_text_field',
				),
			'repeatable_fields' => array(
				array(
					'type' => 'text',
					'label' => __( 'Call to action text', 'bon' ),
					'id' => 'home_cta_text',
					'std' => '',
					),
				array(
					'slug' => 'bon_options',
					'label' => sprintf( __( 'Link to one of the pages', 'bon' ), $i ),
					'id' => 'enable_home_cta_page',
					'class' => 'collapsed',
					'type' => 'checkbox'
					),
				array(
					'type' => 'page_select',
					'label' => __( 'Call to action link', 'bon' ),
					'desc' => __( 'Choose page', 'bon' ),
					'class' => 'hidden last',
					'id' => 'home_cta_link_page'
					),
				array(
					'slug' => 'bon_options',
					'label' => sprintf( __( 'Link to one of the blog posts', 'bon' ), $i ),
					'id' => 'enable_home_cta_post',
					'class' => 'collapsed',
					'type' => 'checkbox'
					),
				array(
					'type' => 'post_select',
					'label' => __( 'Call to action link', 'bon' ),
					'desc' => __( 'Choose post', 'bon' ),
					'class' => 'hidden last',
					'id' => 'home_cta_link_post'
					),
				array(
					'slug' => 'bon_options',
					'label' => sprintf( __( 'Link to custom URL', 'bon' ), $i ),
					'id' => 'enable_home_cta_url',
					'class' => 'collapsed',
					'type' => 'checkbox'
					),
				array(
					'type' => 'text',
					'label' => __( 'Custom link', 'bon' ),
					'desc' => __( 'Or type your own link', 'bon' ),
					'class' => 'hidden last',
					'id' => 'home_cta_link_url'
					),
				array(
					'options' => get_colors_list(),
					'type' => 'radio-img',
					'label' => __( 'Color', 'bon' ),
					'id' => 'home_cta_color',
					'std' => 'carrot',
					),
				array(
					'slug' => 'bon_options',
					'label' => sprintf( __( 'Make unactive', 'bon' ), $i ),
					'id' => 'disable_home_cta',
					'type' => 'checkbox',
					),
				),
);

/*
*
* CALL TO ACTION SETUP FOR DRAWING TOOL
*
*/

$options[] = array(
	'slug' => 'bon_options',
	'label' => __( 'Slogan for returning users', 'bon' ),
	'desc' => __( 'Type in text displayed in home screen slogan for returning users screen', 'bon' ),
	'id' => 'home_slogan_returning',
	'type' => 'text' );

$options[] = array(
	'slug' => 'bon_options',
	'label' => __( 'Home call to action that opens drawing tool', 'bon' ),
	'desc' => __( 'Add call to action', 'bon' ),
	'id' => 'home_cta_tool',
	'type' => 'repeatable',
	'sanitize' => array(
		'name' => 'sanitize_text_field',
		),
	'repeatable_fields' => array(
		array(
			'type' => 'text',
			'label' => __( 'Call to action text', 'bon' ),
			'id' => 'home_cta_text',
			'std' => '',
			),
		array(
			'type' => 'text',
			'label' => __( 'Additional information in call to action text', 'bon' ),
			'id' => 'home_cta_subline'
			),
		/*array(
			'options' => get_colors_list(),
			'type' => 'radio-img',
			'label' => __( 'Color', 'bon' ),
			'id' => 'home_cta_color',
			'std' => 'carrot',
			),*/
		array(
			'slug' => 'bon_options',
			'label' => sprintf( __( 'Make unactive', 'bon' ), $i ),
			'id' => 'disable_home_cta',
			'type' => 'checkbox',
			),
		),
	);

/* CALL TO ACTION SETUP FOR RETURNING USERS */

$options[] = array(
	'slug' => 'bon_options',
	'label' => __( 'Home call to action for returning users screen', 'bon' ),
	'desc' => __( 'Add call to action', 'bon' ),
	'id' => 'home_cta_returning',
	'type' => 'repeatable',
	'sanitize' => array(
		'name' => 'sanitize_text_field',
		),
	'repeatable_fields' => array(
		array(
			'type' => 'text',
			'label' => __( 'Call to action text', 'bon' ),
			'id' => 'home_cta_text',
			'std' => '',
			),
		array(
			'options' => get_colors_list(),
			'type' => 'radio-img',
			'label' => __( 'Color', 'bon' ),
			'id' => 'home_cta_color',
			'std' => 'carrot',
			),
		array(
			'slug' => 'bon_options',
			'label' => sprintf( __( 'Make unactive', 'bon' ), $i ),
			'id' => 'disable_home_cta',
			'type' => 'checkbox',
			),
		),
	);

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Display rotating banners', 'bon' ),
	'desc' => __( 'Check if you want to display rotating banners', 'bon' ),
	'id' => 'home_banners',
	'type' => 'checkbox' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Display promotion', 'bon' ),
	'desc' => __( 'Check if there is a promotion running', 'bon' ),
	'id' => 'home_promotion',
	'type' => 'checkbox' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Display tool section', 'bon' ),
	'desc' => __( 'Choose to show or hide it', 'bon' ),
	'id' => 'tool_section_display_home',
	'type' => 'checkbox',
	'class' => 'collapsed',
	'std' => '0' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Text displayed as customization section title', 'bon' ),
	'id' => 'customize_section_title_home',
	'type' => 'text',
	'class' => 'hidden' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Text displayed as customization section header', 'bon' ),
	'id' => 'customize_section_header_home',
	'type' => 'text',
	'class' => 'hidden' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Text displayed in customization section', 'bon' ),
	'id' => 'customize_section_content_home',
	'settings' => array(
		'media_buttons' => false,
		'tinymce' => true,
		'teeny' => false,
		'wpautop' => false
		),
	'type' => 'editor',
	'class' => 'hidden' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Customization section images', 'bon' ),
	'id' => 'customize_section_img_4',
	'type' => 'upload',
	'class' => 'hidden last' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Display testimonials', 'bon' ),
	'desc' => __( 'Check if you want to enable testimonials slider', 'bon' ),
	'id' => 'home_testimonials',
	'type' => 'checkbox' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Display ebook download', 'bon' ),
	'desc' => __( 'Check if you want to enable ebook download section', 'bon' ),
	'id' => 'home_ebook',
	'type' => 'checkbox' );

$options[] = array( 'slug' => 'bon_options',
	'label' => __( 'Display e-shop slider', 'bon' ),
	'desc' => __( 'Check if you want to enable e-shop slider', 'bon' ),
	'id' => 'home_eshop',
	'type' => 'checkbox' );


		/**
		 * =====================================================================================================
		 *
		 * All Categories Page Settings
		 * 
		 * @category Tool
		 *
		 * ======================================================================================================
		 */

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Our Cottages Page', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-grid-view' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Choose categories order', 'bon' ),
			'id' => 'cats_order',
			'type' => 'repeatable',
			'sanitize' => array(
				'sidebar_name' => 'sanitize_text_field',
				'is_menu' => 'sanitize_checkbox',
				),
			'repeatable_fields' => array(
				array(
					'type' => 'tax_select',
					'label' => __( 'Category Name', 'bon' ),
					'id' => 'cat_name',
					'std' => '',
					'tax_type' => 'property-type'
					),
				) );


		/**
		 * =====================================================================================================
		 *
		 * Banners settings
		 * 
		 * @category Banners
		 *
		 * ======================================================================================================
		 */
		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Banners Settings', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-format-image' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Banners', 'bon' ),
			'type' => 'subheading',
			);

		$options[] = array(
			'slug' => 'bon_options',
			'label' => __( '1st slide image', 'bon' ),
			//'desc' => __( 'Opens FAQ, image also displayed in services section', 'bon' ),
			'id' => '1_slide',
			'type' => 'upload'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Redirect to a page', 'bon' ),
			'id' => '1_slide_page',
			'type' => 'checkbox',
			'class' => 'collapsed',
			'std' => '0' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Pick a page', 'bon' ),
			'id' => '1_slide_page_destination',
			'type' => 'page_select',
			'class' => 'hidden last' );

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Redirect to drawing tool', 'bon' ),
			'id' => '1_slide_tool',
			'type' => 'checkbox',
			'std' => '0' );

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Open modal window', 'bon' ),
			'id' => '1_slide_modal',
			'type' => 'checkbox',
			'class' => 'collapsed',
			'std' => '0' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Pick a modal', 'bon' ),
			'id' => '1_slide_modal_destination',
			'type' => 'select',
			'options' => array(
				'quality' => __( 'Modal with quality images', 'bon' ),
				'contact' => __( 'Modal with contact form', 'bon' ),
				'visit' => __( 'Modal with visit request', 'bon' ),
				),
			'class' => 'hidden last' );

		$options[] = array(
			'slug' => 'bon_options',
			'label' => __( '2nd slide image', 'bon' ),
			'desc' => __( 'Opens drawing Tool', 'bon' ),
			'id' => '2_slide',
			'type' => 'upload'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Redirect to a page', 'bon' ),
			'id' => '2_slide_page',
			'type' => 'checkbox',
			'class' => 'collapsed',
			'std' => '0' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Pick a page', 'bon' ),
			'id' => '2_slide_page_destination',
			'type' => 'page_select',
			'class' => 'hidden last' );

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Redirect to drawing tool', 'bon' ),
			'id' => '2_slide_tool',
			'type' => 'checkbox',
			'std' => '0' );

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Open modal window', 'bon' ),
			'id' => '2_slide_modal',
			'type' => 'checkbox',
			'class' => 'collapsed',
			'std' => '0' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Pick a modal', 'bon' ),
			'id' => '2_slide_modal_destination',
			'type' => 'select',
			'options' => array(
				'quality' => __( 'Modal with quality images', 'bon' ),
				'contact' => __( 'Modal with contact form', 'bon' ),
				'visit' => __( 'Modal with visit request', 'bon' ),
				),
			'class' => 'hidden last' );

		$options[] = array(
			'slug' => 'bon_options',
			'label' => __( '3rd slide image', 'bon' ),
			'desc' => __( 'Opens quality modal window, also displayed in quality section', 'bon' ),
			'id' => '3_slide',
			'type' => 'upload'
			);

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Redirect to a page', 'bon' ),
			'id' => '3_slide_page',
			'type' => 'checkbox',
			'class' => 'collapsed',
			'std' => '0' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Pick a page', 'bon' ),
			'id' => '3_slide_page_destination',
			'type' => 'page_select',
			'class' => 'hidden last' );

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Redirect to drawing tool', 'bon' ),
			'id' => '3_slide_tool',
			'type' => 'checkbox',
			'std' => '0' );

		$options[] = array(
			'slug' => 'bon_options',
			'desc' => __( 'Open modal window', 'bon' ),
			'id' => '3_slide_modal',
			'type' => 'checkbox',
			'class' => 'collapsed',
			'std' => '0' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Pick a modal', 'bon' ),
			'id' => '3_slide_modal_destination',
			'type' => 'select',
			'options' => array(
				'quality' => __( 'Modal with quality images', 'bon' ),
				'contact' => __( 'Modal with contact form', 'bon' ),
				'visit' => __( 'Modal with visit request', 'bon' ),
				),
			'class' => 'hidden last' );

		/*$options[] = array(
			'slug' => 'bon_options',
			'label' => __( 'Quality section house image', 'bon' ),
			'desc' => __( 'Image displayed in quality section', 'bon' ),
			'id' => 'quality_section_house_image',
			'type' => 'upload'
			);*/

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Quality section items', 'bon' ),
			'type' => 'subheading',
			);

		$options[] = array(
			'slug' => 'bon_options',
			'label' => __( 'Quality section modal window title', 'bon' ),
			'desc' => __( 'Title displayed in top of modal window with quality description', 'bon' ),
			'id' => 'quality_section_title',
			'type' => 'text'
			);

		$options[] = array(
			'std' => 'main paragraph',
			'type' => 'info',
			);

		$options[] = array(
			'desc' => 'main paragraph title',
			'id' => 'main_name',
			'type' => 'text',
			);

		$options[] = array(
			'desc' => 'main paragraph detailed description',
			'id' => 'main_desc',
			'type' => 'text',
			);

		$options[] = array(
			'desc' => 'main paragraph img',
			'id' => 'main_img',
			'type' => 'upload',
			);

		foreach ( get_qualities() as $quality_item ) {

			$options[] = array(
				'label' => $quality_item['name'],
				'type' => 'info-img',
				'subfolder' => 'qualities',
				'file-type' => 'jpg',
				);

			$options[] = array(
				'desc' => $quality_item['name'] . ' name',
				'id' => sanitize_title( $quality_item['name'] ) . '_name',
				'type' => 'text',
				);

			$options[] = array(
				'desc' => $quality_item['name'] . ' short description',
				'id' => sanitize_title( $quality_item['name'] ) . '_desc',
				'type' => 'text',
				);

		}




		/**
		 * =====================================================================================================
		 *
		 * Footer Settings
		 * 
		 * @category Footer
		 *
		 * ======================================================================================================
		 */
		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Footer Settings', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-format-aside' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Show Footer Widgets', 'bon' ),
			'desc' => __( 'Show or hide the footer widgets area', 'bon' ),
			'id' => 'show_footer_widget',
			'std' => 'show',
			'options' => array(
				'show' => __( 'Show', 'bon' ),
				'hide' => __( 'Hide', 'bon' )
				),
			'type' => 'select' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Show Footer Copyright', 'bon' ),
			'desc' => __( 'Show or hide the footer copyright', 'bon' ),
			'id' => 'show_footer_copyright',
			'std' => 'show',
			'options' => array(
				'show' => __( 'Show', 'bon' ),
				'hide' => __( 'Hide', 'bon' )
				),
			'type' => 'select' );


		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Custom Copyright Text', 'bon' ),
			'desc' => __( 'Custom HTML and Text that will appear in the footer of your theme.', 'bon' ),
			'id' => 'footer_copyright',
			'std' => '',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => false
				),
			'type' => 'editor' );


		/**
		 * =====================================================================================================
		 *
		 * Social Settings
		 * 
		 * @category Social
		 *
		 * ======================================================================================================
		 */
		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Social Settings', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-share' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Enable Header Social', 'bon' ),
			'desc' => __( 'Enable Social Icons in Header.', 'bon' ),
			'id' => 'enable_header_social',
			'options' => array(
				'yes' => __( 'Yes', 'bon' ),
				'no' => __( 'No', 'bon' )
				),
			'type' => 'select' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Enable Footer Social', 'bon' ),
			'desc' => __( 'Enable Social Icons in Footer.', 'bon' ),
			'id' => 'enable_footer_social',
			'options' => array(
				'yes' => __( 'Yes', 'bon' ),
				'no' => __( 'No', 'bon' )
				),
			'type' => 'select' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Facebook Username', 'bon' ),
			'desc' => __( 'Your Facebook username.', 'bon' ),
			'id' => 'social_facebook',
			'std' => '',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Twitter Username', 'bon' ),
			'desc' => __( 'Your Twitter username.', 'bon' ),
			'id' => 'social_twitter',
			'std' => '',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'YouTube Username', 'bon' ),
			'desc' => __( 'Your YouTube username.', 'bon' ),
			'id' => 'social_youtube',
			'std' => '',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Vimeo Username', 'bon' ),
			'desc' => __( 'Your Vimeo username.', 'bon' ),
			'id' => 'social_vimeo',
			'std' => '',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Google Plus Username', 'bon' ),
			'desc' => __( 'Your Google Plus username.', 'bon' ),
			'id' => 'social_google_plus',
			'std' => '',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Flickr Username', 'bon' ),
			'desc' => __( 'Your Flickr username.', 'bon' ),
			'id' => 'social_flickr',
			'std' => '',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Pinterest Username', 'bon' ),
			'desc' => __( 'Your Pinterest username.', 'bon' ),
			'id' => 'social_pinterest',
			'std' => '',
			'type' => 'text' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'LinkedIn Username', 'bon' ),
			'desc' => __( 'Your LinkedIn username.', 'bon' ),
			'id' => 'social_linkedin',
			'std' => '',
			'type' => 'text' );


		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Sidebar Generator', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-welcome-widgets-menus' );

		$options[] = array( 'slug' => 'bon_options', 'label' => __( 'Generate Custom Sidebar', 'bon' ),
			'id' => 'sidebars_generator',
			'type' => 'repeatable',
			'sanitize' => array(
				'sidebar_name' => 'sanitize_text_field',
				'is_menu' => 'sanitize_checkbox',
				),
			'repeatable_fields' => array(
				array(
					'type' => 'text',
					'label' => __( 'Sidebar Name', 'bon' ),
					'id' => 'sidebar_name',
					'std' => '',
					),
				array(
					'type' => 'checkbox',
					'label' => __( 'Use in Menu', 'bon' ),
					'id' => 'is_menu',
					'std' => 0,
					)
				) );


		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'URL Rewrite', 'bon' ),
			'type' => 'heading',
			'icon' => 'dashicons-admin-links' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => '',
			'desc' => '',
			'std' => __( 'This section will handle Custom URL Rewrite for the Listing. Default url for real estate is "http://yourdomain.com/listing/post-title" and for car listing is "http://yourdomain.com/car-listing/post-title" you can rewrite it into something else in here.', 'bon' ),
			'type' => 'info' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => '',
			'desc' => '',
			'std' => __( 'Please note that you are required to flush your permalink after enable this feature by going to Settings > Permalink and hit save', 'bon' ),
			'type' => 'info' );

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Enable Custom Url Rewrite', 'bon' ),
			'id' => 'use_rewrite',
			'type' => 'select',
			'options' => array(
				'no' => __( 'No', 'bon' ),
				'yes' => __( 'Yes', 'bon' ),
				)
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Rewrite Root', 'bon' ),
			'id' => 'rewrite_root',
			'type' => 'text',
			'desc' => __( 'The Global listing URL base /listing/real-estate/ (non-required), if not empty will use %rewrite_root%/%real_estate_or_car_base%', 'bon' )
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Real Estate Listing Base', 'bon' ),
			'id' => 'realestate_root',
			'type' => 'text',
			'desc' => __( 'The Property Feature URL base /listing/ (required)', 'bon' )
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Real Estate Property Type Base', 'bon' ),
			'id' => 'realestate_property_type_root',
			'type' => 'text',
			'desc' => __( 'The Property Type URL base /property-type/ (required)', 'bon' )
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Real Estate Property Location Base', 'bon' ),
			'id' => 'realestate_property_location_root',
			'type' => 'text',
			'desc' => __( 'The Property Location URL base /property-location/ (required)', 'bon' )
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Real Estate Property Feature Base', 'bon' ),
			'id' => 'realestate_property_feature_root',
			'type' => 'text',
			'desc' => __( 'The Property Feature URL base /property-feature/ (required)', 'bon' )
			);


		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Car Listing Base', 'bon' ),
			'id' => 'car_root',
			'type' => 'text',
			'desc' => __( 'The Global Car Listing URL base /car-listing/ (required)', 'bon' )
			);


		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Car Manufacturer Base', 'bon' ),
			'id' => 'car_manufacturer_root',
			'type' => 'text',
			'desc' => __( 'The Manufacturer URL base /manufacturer/ (required)', 'bon' )
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Car Body Type Base', 'bon' ),
			'id' => 'car_body_type_root',
			'type' => 'text',
			'desc' => __( 'The Body Type URL base /body-type/ (required)', 'bon' )
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Car Dealer Location Base', 'bon' ),
			'id' => 'car_dealer_location_root',
			'type' => 'text',
			'desc' => __( 'The Dealer Location URL base /dealer-location/ (required)', 'bon' )
			);

		$options[] = array( 'slug' => 'bon_options',
			'label' => __( 'Car Feature Base', 'bon' ),
			'id' => 'car_feature_root',
			'type' => 'text',
			'desc' => __( 'The Car Feature URL base /car-feature/ (required)', 'bon' )
			);

		return apply_filters( 'bon_theme_options', $options );
	}

}
?>