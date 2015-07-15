<?php

function get_colors_list() {
	$alt_colors_path = get_template_directory() . '/assets/images/element-colors/';
	$alt_colors = array();
	if ( $alt_colors_path = opendir( $alt_colors_path ) ) {
		while ( ($alt_color_file = readdir( $alt_colors_path )) !== false ) {
			if ( stristr( $alt_color_file, '.jpg' ) !== false ) {
				$color = str_replace( '.jpg', '', $alt_color_file );
				$alt_colors[$color] = trailingslashit( BON_THEME_URI ) . 'assets/images/element-colors/' . $color . '.jpg';
			}
		}
	}
	return($alt_colors);
}

/* Function to get list of all available packages */

function get_packages_list( $to_lower = false ) {
	$packages = bon_get_option('cottage_packages', false);
	if ($to_lower) {
		foreach ($packages as $key => $package) {
			$packages[$key]['package_name'] = strtolower($package['package_name']);
		}
	}
	return ($packages);
}

/* Function to get list of all available addons for buildings (items included in price) */

function get_addons_list() {

	if ( $addons = get_addons() ) {

		$addons_names_and_ids = array();

		while ( $addons->have_posts() ) : $addons->the_post();

		$addons_names_and_ids[get_the_ID()] = get_the_title();

		endwhile;

	}

	return $addons_names_and_ids;

}

function get_addons() {

	$args = array(
		'post_type' => 'addon',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		);

	$loop = new WP_Query( $args );

	return $loop;

	wp_reset_query();

}

if ( !function_exists( 'shandora_setup_listing_post_type' ) ) {

	function shandora_setup_listing_post_type() {
		global $bon;

		$prefix = bon_get_prefix();

		$suffix = SHANDORA_MB_SUFFIX;

		$cpt = $bon->cpt();

		$use_rewrite = bon_get_option( 'use_rewrite', 'no' );

		$settings = array();
		$slug = '';

		$settings['rewrite_root'] = bon_get_option( 'rewrite_root' );
		$settings['realestate_root'] = bon_get_option( 'realestate_root', 'real-estate' );


		$settings['realestate_property_type_root'] = bon_get_option( 'realestate_property_type_root', 'manufacturer' );
		$settings['realestate_property_location_root'] = bon_get_option( 'realestate_property_location_root', 'body-type' );
		$settings['realestate_property_feature_root'] = bon_get_option( 'realestate_property_feature_root', 'dealer-location' );


		if ( !empty( $settings['rewrite_root'] ) ) {
			$slug = "{$settings['rewrite_root']}/{$settings['realestate_root']}";
		} else {
			$slug = "{$settings['realestate_root']}";
		}

		$property_type_slug = "{$settings['realestate_root']}/{$settings['realestate_property_type_root']}";
		$property_location_slug = "{$settings['realestate_root']}/{$settings['realestate_property_location_root']}";
		$property_feature_slug = "{$settings['realestate_root']}/{$settings['realestate_property_feature_root']}";

		$has_archive = ( $use_rewrite == 'no' ) ? false : $slug;

		$rewrite_var = array(
			'slug' => $slug,
			'with_front' => false,
			'pages' => true,
			'feeds' => true,
			'ep_mask' => EP_PERMALINK,
			);

		$rewrite = ( $use_rewrite == 'no' ) ? true : $rewrite_var;



		$name = get_cottages_name();
		$plural = get_cottages_name( 'plural' );
		$args = array(
			'has_archive' => $has_archive,
			'rewrite' => array(
				'slug' => get_cottages_slug(),
				),
			'supports' => array( 'editor', 'title', 'excerpt', 'thumbnail', 'front-end-editor' ),
			// added by Lech Dutkiewicz
			'show_in_nav_menus' => TRUE,
			'menu_position' => 6,
			'menu_icon' => 'dashicons-admin-home'
			);

		$cpt->create( 'Listing', $args, array(), $name, $plural );

/********************************
*								*
* Gallery options 				*
*								*
********************************/

$build_gallery_options = array(
	array(
		'label' => __( 'Listings Gallery', 'bon' ),
		'desc' => __( 'Choose image to use in this listing gallery.', 'bon' ),
		'id' => $prefix . $suffix . 'gallery',
		'type' => 'gallery',
		),
	);

/********************************
*								*
* Basic options 				*
*								*
********************************/

$build_options = array(
	array(
		'label' => __( 'Featured Property', 'bon' ),
		'desc' => __( 'Make the property featured for featured property widget', 'bon' ),
		'id' => $prefix . $suffix . 'featured',
		'type' => 'checkbox'
		),
	array(
		'label' => __( 'Total price', 'bon' ),
		'desc' => __( 'Product total price, without currency', 'bon' ),
		'id' => $prefix . $suffix . 'price',
		'type' => 'number',
		),

	array(
		'label' => __( 'Cottage Status', 'bon' ),
		'desc' => __( 'The status for the cottage, used for badge, etc.', 'bon' ),
		'id' => $prefix . $suffix . 'status',
		'type' => 'select',
		'options' => shandora_get_search_option()
		),
	);

/********************************
*								*
* Options for constructions 	*
*								*
********************************/

$build_constructions_options = array(
	array(
		'label' => __( 'Enable construction parameters', 'bon' ),
		'id' => $prefix . $suffix . 'enable_construction',
		'std' => 1,
		'class' => 'collapsed',
		'type' => 'checkbox'
		),
	array(
		'label' => __( 'Roof size', 'bon' ),
		'desc' => __( 'Product roof size in meters, ex: 5.5', 'bon' ),
		'id' => $prefix . $suffix . 'constructionroofsize',
		'type' => 'text',
		'class' => 'hidden',
		),
	array(
		'label' => __( 'Columns size', 'bon' ),
		'desc' => __( 'Add columns size', 'bon' ),
		'id' => $prefix . $suffix . 'columnssizes',
		'type' => 'repeatable',
		'class' => 'hidden',
		'sanitize' => array(
			'name' => 'sanitize_text_field',
			),
		'repeatable_fields' => array(
			array(
				'label' => __( 'Width', 'bon' ),
				'id' => $prefix . $suffix . 'columnwidth',
				'type' => 'number',
				),
			array(
				'label' => __( 'Height', 'bon' ),
				'id' => $prefix . $suffix . 'columnheight',
				'type' => 'number',
				),
			),
		),
	array(
		'label' => __( 'Rafters size', 'bon' ),
		'desc' => __( 'Add rafters size', 'bon' ),
		'id' => $prefix . $suffix . 'rafterssizes',
		'type' => 'repeatable',
		'class' => 'hidden last',
		'sanitize' => array(
			'name' => 'sanitize_text_field',
			),
		'repeatable_fields' => array(
			array(
				'label' => __( 'Width', 'bon' ),
				'id' => $prefix . $suffix . 'rafterwidth',
				'type' => 'number',
				),
			array(
				'label' => __( 'Height', 'bon' ),
				'id' => $prefix . $suffix . 'rafterheight',
				'type' => 'number',
				),
			),
		),
	);

/********************************
*								*
* Options for big houses 		*
*								*
********************************/

$build_big_size_options = array(
	array(
		'label' => __( 'Enable pricing packages', 'bon' ),
		'id' => $prefix . $suffix . 'enable_packages',
		'std' => 1,
		'class' => 'collapsed',
		'type' => 'checkbox'
		),
	);

/********************************
*								*
* Options for size parameters	*
*								*
********************************/

$build_size_options = array(
	array(
		'label' => __( 'Size', 'bon' ),
		'desc' => __( 'Product size in square meters, without unit', 'bon' ),
		'id' => $prefix . $suffix . 'lotsize',
		'type' => 'text',
		),
	array(
		'label' => __( 'Terrace', 'bon' ),
		'desc' => __( 'Product terrace size in square meters, without unit', 'bon' ),
		'id' => $prefix . $suffix . 'terracesqmt',
		'type' => 'text',
		),
	array(
		'label' => __( 'Floors', 'bon' ),
		'desc' => __( 'Number of floors', 'bon' ),
		'id' => $prefix . $suffix . 'floors',
		'type' => 'number',
		),
	array(
		'label' => __( 'Rooms', 'bon' ),
		'desc' => __( 'Total number of rooms', 'bon' ),
		'id' => $prefix . $suffix . 'rooms',
		'type' => 'number',
		),
	array(
		'label' => __( 'Plan dimensions', 'bon' ),
		'desc' => __( 'Add floor', 'bon' ),
		'id' => $prefix . $suffix . 'plandimensions',
		'sanitize' => array(
			'name' => 'sanitize_text_field',
			),
		'repeatable_fields' => array(
			array(
				'label' => __( 'Plan width', 'bon' ),
				'desc' => __( 'Product plan width in meters, ex: 5.5', 'bon' ),
				'id' => $prefix . $suffix . 'dimensionswidth',
				'type' => 'text',
				),
			array(
				'label' => __( 'Plan height', 'bon' ),
				'desc' => __( 'Product plan height in meters, ex: 5.5', 'bon' ),
				'id' => $prefix . $suffix . 'dimensionsheight',
				'type' => 'text',
				),
			array(
				'label' => __( 'Floor', 'bon' ),
				'desc' => __( 'Pick which floor dimensions are you describing', 'bon' ),
				'id' => $prefix . $suffix . 'dimensionfloor',
				'std' => __( 'Ground floor', 'bon' ),
				'options' => array(
					'ground_floor' => __( 'Ground floor', 'bon' ),
					'first_floor' => __( 'First floor', 'bon' ),
					),
				'type' => 'select',
				),
			),
		'type' => 'repeatable',
		),
array(
	'label' => __( 'Total height', 'bon' ),
	'desc' => __( 'Product total height in milimeters, without unit', 'bon' ),
	'id' => $prefix . $suffix . 'height',
	'type' => 'number',
	),
array(
	'label' => __( 'Wall height', 'bon' ),
	'desc' => __( 'Product wall height in milimeters, without unit', 'bon' ),
	'id' => $prefix . $suffix . 'wallheight',
	'type' => 'number',
	),
array(
	'label' => __( 'Wall thickness', 'bon' ),
	'desc' => __( 'Product wall thickness in milimeters, without unit', 'bon' ),
	'id' => $prefix . $suffix . 'wallthickness',
	'type' => 'number',
	),
array(
	'label' => __( 'Floor thickness', 'bon' ),
	'desc' => __( 'Product floor thickness in milimeters, without unit', 'bon' ),
	'id' => $prefix . $suffix . 'floorthickness',
	'type' => 'number',
	),
array(
	'label' => __( 'Roof thickness', 'bon' ),
	'desc' => __( 'Product roof thickness in milimeters, without unit', 'bon' ),
	'id' => $prefix . $suffix . 'roofthickness',
	'type' => 'number',
	),
);

/********************************
*								*
* Options for doors and windows *
*								*
********************************/

$build_doors_options = array(
	array(
		'label' => __( 'Windows', 'bon' ),
		'desc' => __( 'Add windows', 'bon' ),
		'id' => $prefix . $suffix . 'windowssizes',
		'sanitize' => array(
			'name' => 'sanitize_text_field',
			),
		'repeatable_fields' => array(
			array(
				'label' => __( 'Window width', 'bon' ),
				'desc' => __( 'Window width in milimeters, without unit', 'bon' ),
				'id' => $prefix . $suffix . 'windowwidth',
				'type' => 'number',
				),
			array(
				'label' => __( 'Window height', 'bon' ),
				'desc' => __( 'Window height in milimeters, without unit', 'bon' ),
				'id' => $prefix . $suffix . 'windowheight',
				'type' => 'number',
				),
			array(
				'label' => __( 'Windows amount', 'bon' ),
				'desc' => __( 'Amount of windows of the chosen size', 'bon' ),
				'id' => $prefix . $suffix . 'windowamount',
				'type' => 'number',
				),
			array(
				'label' => __( 'Windows type', 'bon' ),
				'desc' => __( 'Single or double', 'bon' ),
				'id' => $prefix . $suffix . 'windowtype',
				'type' => 'text',
				),
			),
		'type' => 'repeatable',
		),
array(
	'label' => __( 'Doors', 'bon' ),
	'desc' => __( 'Add doors', 'bon' ),
	'id' => $prefix . $suffix . 'doorssizes',
	'sanitize' => array(
		'name' => 'sanitize_text_field',
		),
	'repeatable_fields' => array(
		array(
			'label' => __( 'Door width', 'bon' ),
			'desc' => __( 'Door width in milimeters, without unit', 'bon' ),
			'id' => $prefix . $suffix . 'doorwidth',
			'type' => 'number',
			),
		array(
			'label' => __( 'Door height', 'bon' ),
			'desc' => __( 'Door height in milimeters, without unit', 'bon' ),
			'id' => $prefix . $suffix . 'doorheight',
			'type' => 'number',
			),
		array(
			'label' => __( 'Doors amount', 'bon' ),
			'desc' => __( 'Amount of doors of the chosen size', 'bon' ),
			'id' => $prefix . $suffix . 'dooramount',
			'type' => 'number',
			),
		array(
			'label' => __( 'Door type', 'bon' ),
			'desc' => __( 'Single or double', 'bon' ),
			'id' => $prefix . $suffix . 'doortype',
			'type' => 'text',
			),
		),
	'type' => 'repeatable',
	),
);

$prop_options = array(

	);

/* Add options for all packages defined in theme listing options */

if ( $packages = get_packages_list() ) {
	
	foreach ( $packages as $key => $package ) {
		$exclass = ( $key + 1 === count( $packages ) ) ? ' last' : '';
		$build_big_size_options[] = array(
			'label' => $package['package_name'],
			'id' => $prefix . $suffix . sanitize_title($package['package_name']),
			'type' => 'info',
			'class' => $package['package_color'] . ' bg hidden'
			);
		$build_big_size_options[] = array(
			'label' => __( 'Price', 'bon' ),
			'id' => $prefix . $suffix . sanitize_title($package['package_name']) . '_price',
			'type' => 'number',
			'class' => 'hidden' . $exclass
			);



		// Uncomment this if each product would have it's own package descriptions

		/*$prop_options[] = array(
			'label' => __( 'Wall material', 'bon' ),
			'id' => $prefix . $suffix . $package['package_name'] . '_material',
			'type' => 'text',
			'class' => 'hidden'
			);
		$prop_options[] = array(
			'label' => __( 'Wall thickness', 'bon' ),
			'desc' => __( 'Product wall thickness in milimeters, without unit', 'bon' ),
			'id' => $prefix . $suffix . $package['package_name'] . '_wall_thickness',
			'type' => 'number',
			'class' => 'hidden'
			);
		$prop_options[] = array(
			'label' => __( 'Windows and doors thickness', 'bon' ),
			'desc' => __( 'Product windows and door thickness in milimeters, without unit', 'bon' ),
			'id' => $prefix . $suffix . $package['package_name'] . '_windows_thickness',
			'type' => 'number',
			'class' => 'hidden'
			);
		$prop_options[] = array(
			'label' => __( 'Package description', 'bon' ),
			'id' => $prefix . $suffix . $package['package_name'] . '_content',
			'type' => 'editor',
			'class' => 'hidden',
			'settings' => array(
				'media_buttons' => false,
				'tinymce' => true,
				'teeny' => false,
				'wpautop' => true,
				'textarea_rows' => 30
				),
);*/
}

}

$build_addon_options = array(
	array(
		'desc' => __( 'Exclude another item', 'bon' ),
		'id' => $prefix . $suffix . 'excluded_addons',
		'sanitize' => array(
			'name' => 'sanitize_text_field',
			),
		'repeatable_fields' => array(
			array(
				'label' => __( 'Item to exclude', 'bon' ),
				'id' => $prefix . $suffix . 'exclude',
				'type' => 'select',
				'options' => get_addons_list()
				),
			),
		'type' => 'repeatable'
		),
	);




/*$fr_opt = array();

if ( bon_get_option( 'enable_dpe_ges', false ) == 'yes' ) {

	$fr_opt[] = array(
		'label' => __( 'DPE', 'bon' ),
		'desc' => __( 'Diagnostic de Performance énergétiqueg', 'bon' ),
		'id' => $prefix . $suffix . 'dpe',
		'type' => 'number',
		);

	$fr_opt[] = array(
		'label' => __( 'GES', 'bon' ),
		'desc' => __( 'Gaz à effet de serre', 'bon' ),
		'id' => $prefix . $suffix . 'ges',
		'type' => 'number',
		);
}

$prop_options = array_merge( $fr_opt, $prop_options );*/




/* The rewrite handles the URL structure. */
$property_type_rewrite_var = array(
	'slug' => $property_type_slug,
	'with_front' => false,
	'hierarchical' => false,
	'ep_mask' => EP_NONE
	);


/* The rewrite handles the URL structure. */
$property_location_rewrite_var = array(
	'slug' => $property_location_slug,
	'with_front' => false,
	'hierarchical' => true,
	'ep_mask' => EP_NONE
	);

/* The rewrite handles the URL structure. */
$property_feature_rewrite_var = array(
	'slug' => $property_feature_slug,
	'with_front' => false,
	'hierarchical' => false,
	'ep_mask' => EP_NONE
	);

if ( $use_rewrite == 'no' ) {

	$property_feature_rewrite = true;
	$property_location_rewrite = true;
	$property_type_rewrite = array( 'slug' => get_cottages_category_slug() );
} else {

	$property_feature_rewrite = $property_feature_rewrite_var;
	$property_location_rewrite = $property_location_rewrite_var;
	$property_type_rewrite = $property_type_rewrite_var;
}

$cpt->add_taxonomy( "Property Type", array( 'rewrite' => $property_type_rewrite, 'hierarchical' => true, 'label' => __( 'Property Types', 'bon' ), 'labels' => array( 'menu_name' => __( 'Types', 'bon' ) ) ) );

		/* $cpt->add_taxonomy( "Property Location", array( 'rewrite' => $property_location_rewrite, 'hierarchical' => true, 'label' => __( 'Property Locations', 'bon' ), 'labels' => array( 'menu_name' => __( 'Locations', 'bon' ) ) ) );

		$cpt->add_taxonomy( "Property Feature", array( 'rewrite' => $property_feature_rewrite, 'label' => __( 'Property Features', 'bon' ), 'labels' => array( 'menu_name' => __( 'Features', 'bon' ) ) ) ); */

		$cpt->add_meta_box(
			'gallery-options', 'Gallery Options', $build_gallery_options
			);

		$cpt->add_meta_box(
			'building-options', 'Building options', $build_options
			);

		$cpt->add_meta_box(
			'constructions-options', 'Options for constructions', $build_constructions_options
			);

		$cpt->add_meta_box(
			'big-building-options', 'Options for big houses with packages', $build_big_size_options
			);

		$cpt->add_meta_box(
			'building-size', 'Building size', $build_size_options
			);

		$cpt->add_meta_box(
			'building-doors-and-windows', 'Building doors and windows', $build_doors_options
			);

		$cpt->add_meta_box(
			'building-remove-addons', 'Manage what is included in price', $build_addon_options
			);

		/* $cpt->add_meta_box(
		  'video-options', 'Video Options', shandora_video_metabox_args()
		  ); */
}

}

if ( !function_exists( 'shandora_setup_agent_post_type' ) ) {

	function shandora_setup_agent_post_type() {
		global $bon;

		$prefix = bon_get_prefix();

		$cpt = $bon->cpt();

		$name = __( 'Agent', 'bon' );
		$plural = __( 'Agents', 'bon' );


		$cpt->create( 'Agent', array( 'supports' => array( 'editor', 'title' ), 'exclude_from_search' => true, 'menu_position' => 20, 'menu_icon' => 'dashicons-businessman' ), array(), $name, $plural );


		$agent_opt1 = array(
			array(
				'label' => __( 'Job Title', 'bon' ),
				'desc' => '',
				'id' => $prefix . 'agentjob',
				'type' => 'text',
				),
			array(
				'label' => __( 'Facebook Username', 'bon' ),
				'desc' => '',
				'id' => $prefix . 'agentfb',
				'type' => 'text',
				),
			array(
				'label' => __( 'Twitter Username', 'bon' ),
				'desc' => '',
				'id' => $prefix . 'agenttw',
				'type' => 'text',
				),
			array(
				'label' => __( 'LinkedIn Username', 'bon' ),
				'desc' => '',
				'id' => $prefix . 'agentlinkedin',
				'type' => 'text',
				),
			array(
				'label' => __( 'Agent Profile Photo', 'bon' ),
				'desc' => '',
				'id' => $prefix . 'agentpic',
				'type' => 'image',
				),
			array(
				'label' => __( 'Email Address', 'bon' ),
				'desc' => '',
				'id' => $prefix . 'agentemail',
				'type' => 'text',
				),
			array(
				'label' => __( 'Office Phone Number', 'bon' ),
				'desc' => '',
				'id' => $prefix . 'agentofficephone',
				'type' => 'text',
				),
			array(
				'label' => __( 'Mobile Phone Number', 'bon' ),
				'desc' => '',
				'id' => $prefix . 'agentmobilephone',
				'type' => 'text',
				),
			array(
				'label' => __( 'Fax Number', 'bon' ),
				'desc' => '',
				'id' => $prefix . 'agentfax',
				'type' => 'text',
				),
			);


$cpt->add_meta_box(
	'agent-options', 'Agent Options', $agent_opt1
	);
}

}

// Added by Lech Dutkiewicz for details post type

if ( !function_exists( 'shandora_setup_addon_post_type' ) ) {

	function shandora_setup_addon_post_type() {
		global $bon;

		$prefix = bon_get_prefix();

		$cpt = $bon->cpt();

		$name = __( 'Addon', 'bon' );
		$plural = __( 'Addons', 'bon' );


		$cpt->create( 'Addon', array( 'supports' => array( 'title', 'page-attributes' ), 'exclude_from_search' => true, 'menu_position' => 75, 'menu_icon' => 'dashicons-welcome-add-page' ), array(), $name, $plural );

		$addon_opt1 = array(
			array(
				'label' => __( 'Enable for', 'bon') . ' ' . __( 'Constructions', 'bon' ),
				'id' => $prefix . 'enabled_construction',
				'type' => 'checkbox',
				),
			array(
				'label' => __( 'Enable for', 'bon') . ' ' . __( 'Cottages', 'bon' ),
				'id' => $prefix . 'enabled_cottage',
				'type' => 'checkbox',
				),
			array(
				'label' => __( 'Enable for', 'bon') . ' ' . __( 'Big houses', 'bon' ),
				'id' => $prefix . 'enabled_big',
				'type' => 'checkbox',
				),
			);

		$cpt->add_meta_box(
			'addon-options', 'Addon Options', $addon_opt1
			);
	}

}

if ( !function_exists( 'shandora_setup_service_post_type' ) ) {

	function shandora_setup_service_post_type() {
		global $bon;

		$prefix = bon_get_prefix();

		$cpt = $bon->cpt();

		$name = __( 'Service', 'bon' );
		$plural = __( 'Services', 'bon' );


		$cpt->create( 'Service', array( 'supports' => array( 'editor', 'title', 'page-attributes' ), 'exclude_from_search' => true, 'menu_position' => 75, 'menu_icon' => 'dashicons-hammer' ), array(), $name, $plural );


		$service_opt1 = array(
			array(
				'label' => __( 'Font awesome icon', 'bon' ),
				'id' => $prefix . 'serviceicon',
				'type' => 'icon',
				),
			array(
				'label' => __( 'Icon color', 'bon' ),
				'id' => $prefix . 'serviceiconcolor',
				'type' => 'radio-img',
				'options' => get_colors_list()
				),
			);

		$service_opt2 = array(
			array(
				'label' => __( 'Title', 'bon' ),
				'id' => $prefix . 'service_more_title',
				'type' => 'text',
				),
			array(
				'label' => __( 'Content', 'bon' ),
				'id' => $prefix . 'service_more_content',
				'type' => 'editor',
				'settings' => array(
					'media_buttons' => true,
					'tinymce' => true,
					'teeny' => false,
					'wpautop' => true,
					'textarea_rows' => 30
					),
				),
			array(
				'label' => __( 'Content', 'bon' ),
				'id' => $prefix . 'service_more_paragraphs',
				'type' => 'repeatable',
				'sanitize' => array(
					'name' => 'sanitize_text_field',
					),
				'repeatable_fields' => array(
					array(
						'label' => __( 'Header', 'bon' ),
						'id' => $prefix . 'header',
						'type' => 'text',
						),
					array(
						'label' => __( 'Subeader', 'bon' ),
						'id' => $prefix . 'subheader',
						'type' => 'text',
						),
					array(
						'label' => __( 'Image', 'bon' ),
						'id' => $prefix . 'img',
						'type' => 'upload',
						),
					),
				),
			);

$cpt->add_meta_box(
	'service-options', 'Icon options', $service_opt1
	);

$cpt->add_meta_box(
	'service-more', 'Extended information', $service_opt2
	);
}

}

if ( !function_exists( 'shandora_setup_home_feature_post_type' ) ) {

	function shandora_setup_home_feature_post_type() {
		global $bon;

		$prefix = bon_get_prefix();

		$cpt = $bon->cpt();

		$name = __( 'Home feature', 'bon' );
		$plural = __( 'Home features', 'bon' );


		$cpt->create( 'Home-feature', array( 'supports' => array( 'editor', 'title', 'page-attributes' ), 'exclude_from_search' => true, 'menu_position' => 20, 'menu_icon' => 'dashicons-star-filled' ), array(), $name, $plural );


		$service_opt1 = array(
			array(
				'label' => __( 'Font awesome icon', 'bon' ),
				'id' => $prefix . 'featureicon',
				'type' => 'icon',
				),
			array(
				'label' => __( 'Icon color', 'bon' ),
				'id' => $prefix . 'featureiconcolor',
				'type' => 'radio-img',
				'options' => get_colors_list()
				),
			array(
				'label' => __( 'Scroll to FAQ?', 'bon' ),
				'id' => $prefix . 'feature_scroll_to',
				'type' => 'checkbox',
				),
			);

		$cpt->add_meta_box(
			'Feature-options', 'Feature Options', $service_opt1
			);
	}

}

if ( !function_exists( 'shandora_setup_additional_service_post_type' ) ) {

	function shandora_setup_additional_service_post_type() {
		global $bon;

		$prefix = bon_get_prefix();

		$cpt = $bon->cpt();

		$name = __( 'Additional service', 'bon' );
		$plural = __( 'Additional services', 'bon' );


		$cpt->create( 'Additional-service', array( 'supports' => array( 'editor', 'title', 'page-attributes' ), 'exclude_from_search' => true, 'menu_position' => 75, 'menu_icon' => 'dashicons-admin-appearance' ), array(), $name, $plural );
	}

}

if ( !function_exists( 'shandora_setup_faq_post_type' ) ) {

	function shandora_setup_faq_post_type() {
		global $bon;

		$prefix = bon_get_prefix();

		$cpt = $bon->cpt();

		$name = __( 'FAQ', 'bon' );


		$cpt->create( 'FAQ', array( 'supports' => array( 'editor', 'title', 'page-attributes' ), 'exclude_from_search' => true, 'menu_position' => 75, 'menu_icon' => 'dashicons-welcome-learn-more' ), array(), $name );
	}

}

if ( !function_exists( 'shandora_setup_testimonials_post_type' ) ) {

	function shandora_setup_testimonials_post_type() {
		global $bon;

		$prefix = bon_get_prefix();

		$cpt = $bon->cpt();

		$name = __( 'Testimonial', 'bon' );
		$plural = __( 'Testimonials', 'bon' );


		$cpt->create( 'Testimonial', array( 'supports' => array( 'editor', 'title', 'thumbnail', 'page-attributes' ), 'exclude_from_search' => true, 'menu_position' => 15, 'menu_icon' => 'dashicons-smiley' ), array(), $name, $plural );

		$prop_options = array(
			array( 
				'label'	=> __('Testimonial', 'bon'),
				'id'	=> $prefix . $suffix .'testimonial',
				'type'	=> 'text',				
				),
			array( 
				'label'	=> __('Full name of client', 'bon'),
				'id'	=> $prefix . $suffix .'full_name',
				'type'	=> 'text',				
				),
			array(
				'label' => __( 'Author image', 'bon' ),
				'desc' => __( 'Upload author image to display it on testimonials carousel', 'bon' ),
				'id' => $prefix . $suffix . 'user_img',
				'type' => 'image'
				),
			);

		$prop_options_2 = array(
			array( 
				'label'	=> __('Map Latitude', 'bon'),
				'desc'	=> __('The Map Latitude. You can easily find it <a href="http://www.itouchmap.com/latlong.html">here</a>. Copy and paste the latitude value generated there', 'bon'), 
				'id'	=> $prefix . $suffix .'maplatitude',
				'type'	=> 'text',				
				),
			array( 
				'label'	=> __('Map Longitude', 'bon'),
				'desc'	=> __('The Map Longitude. You can easily find it <a href="http://www.itouchmap.com/latlong.html">here</a>. Copy and paste the longitude value generated there', 'bon'), 
				'id'	=> $prefix . $suffix .'maplongitude',
				'type'	=> 'text',				
				),
			array(
				'label' => __( 'Building image', 'bon' ),
				'desc' => __( 'Image that will be used on page with map of all buildings', 'bon' ),
				'id' => $prefix . $suffix . 'map_img',
				'type' => 'image'
				),
			array(
				'label' => __( 'Related cottage', 'bon' ),
				'desc' => __( 'Pick cottage if theres a related one', 'bon' ),
				'id' => $prefix . $suffix . 'related_cottage',
				'post_type' => 'Listing',
				'type' => 'post_chosen'
				),
			);

$cpt->add_meta_box(
	'building', 'Building', $prop_options_2
	);

$cpt->add_meta_box(
	'author', 'Author', $prop_options
	);
}

}

if ( !function_exists( 'shandora_setup_ebooks_post_type' ) ) {

	function shandora_setup_ebooks_post_type() {
		global $bon;

		$prefix = bon_get_prefix();

		$cpt = $bon->cpt();

		$name = __( 'Ebook', 'bon' );
		$plural = __( 'Ebooks', 'bon' );


		$cpt->create( 'Ebook', array( 'supports' => array( 'editor', 'title', 'thumbnail', 'page-attributes' ), 'exclude_from_search' => true, 'menu_position' => 15, 'menu_icon' => 'dashicons-media-default' ), array(), $name, $plural );

		$prop_options = array(
			array(
				'label' => __( 'Cta header', 'bon' ),
				'desc' => __( 'Ex: Get your free ebook', 'bon' ),
				'id' => $prefix . $suffix . 'cta_header',
				'type' => 'text'
				),
			array(
				'label' => __( 'Cta subheader', 'bon' ),
				'desc' => __( 'Ex: And learn more about roofing', 'bon' ),
				'id' => $prefix . $suffix . 'cta_subheader',
				'type' => 'text'
				),
			array(
				'label' => __( 'Cta color', 'bon' ),
				'desc' => __( 'Color of cta', 'bon' ),
				'id' => $prefix . $suffix . 'cta_color',
				'type' => 'radio-img',
				'options' => get_colors_list()
				)
			);

		$ebook = array(
			array(
				'label' => __( 'Ebook file', 'bon' ),
				'desc' => __( 'Upload pdf', 'bon' ),
				'id' => $prefix . $suffix . 'cta_file',
				'type' => 'file'
				)
			);

		$cpt->add_meta_box(
			'CTA settings', 'CTA settings', $prop_options
			);

		$cpt->add_meta_box(
			'Ebook ', 'Ebook', $ebook
			);
	}

}

if ( !function_exists( 'shandora_setup_promotions_post_type' ) ) {

	function shandora_setup_promotions_post_type() {
		global $bon;

		$prefix = bon_get_prefix();

		$cpt = $bon->cpt();

		$name = __( 'Promotion', 'bon' );
		$plural = __( 'Promotions', 'bon' );


		$cpt->create( 'Promotions', array( 'supports' => array( 'editor', 'title', 'thumbnail', 'page-attributes' ), 'exclude_from_search' => true, 'menu_position' => 15, 'menu_icon' => 'dashicons-tickets' ), array(), $name, $plural );

		$prop_options = array(
			array(
				'label' => __( 'Cta text', 'bon' ),
				'desc' => __( 'Text displayed on cta button', 'bon' ),
				'id' => $prefix . $suffix . 'cta_anchor',
				'type' => 'text'
				),
			array(
				'label' => __( 'Cta link', 'bon' ),
				'desc' => __( 'Where should cta link to', 'bon' ),
				'id' => $prefix . $suffix . 'cta_link',
				'type' => 'page_chosen'
				),
			array(
				'label' => __( 'Cta color', 'bon' ),
				'desc' => __( 'Color of cta', 'bon' ),
				'id' => $prefix . $suffix . 'cta_color',
				'type' => 'radio-img',
				'options' => get_colors_list()
				)
			);

		$cpt->add_meta_box(
			'CTA settings', 'CTA settings', $prop_options
			);
	}

}

if ( !function_exists( 'shandora_setup_regular_post_type' ) ) {

	function shandora_setup_regular_post_type() {
		global $bon;

		$prefix = bon_get_prefix();

		$mb = new BON_Metabox();

		$page = 'Post';

		$fields = array(
			array(
				'label' => __( 'Related cottage', 'bon' ),
				'desc' => __( 'Pick cottage if theres a related one', 'bon' ),
				'id' => $prefix . $suffix . 'related_cottage',
				'post_type' => 'Listing',
				'type' => 'post_chosen'
				),
			);

		$mb->create_box( 'related-post', 'Related post', $fields, $page, $context = 'normal', $priority = 'high' );

	}

}