<?php

	function shandora_register_widgets() {
		/* Load the archives widget class. */
		require_once( trailingslashit( BON_INC ) . 'widgets/widget-featured-listing.php' );
		// require_once( trailingslashit( BON_INC ) . 'widgets/widget-related-listing.php' );
		require_once( trailingslashit( BON_INC ) . 'widgets/widget-related-cottages.php' );
		//require_once( trailingslashit( BON_INC ) . 'widgets/widget-featured-car.php' );
		require_once( trailingslashit( BON_INC ) . 'widgets/widget-search-listing.php' );
		// require_once( trailingslashit( BON_INC ) . 'widgets/widget-calculator.php' );
		require_once( trailingslashit( BON_INC ) . 'widgets/widget-custom-image.php' );
		//require_once( trailingslashit( BON_INC ) . 'widgets/widget-custom-numbers.php' );
		require_once( trailingslashit( BON_INC ) . 'widgets/widget-newsletter-form.php' );
		register_widget( 'Shandora_Featured_Listing_Widget' );
		//register_widget( 'Shandora_Featured_Car_Listing_Widget' );
		// register_widget( 'Shandora_Related_Listing_Widget' );
		register_widget( 'Shandora_Related_Cottages_Widget' );
		register_widget( 'Shandora_Search_Listing_Widget' );
		// register_widget( 'Shandora_Calculator_Widget' );
		// added by Lech Dutkiewicz
		register_widget( 'Custom_Image_Widget' );
		//register_widget( 'Widget_Custom_Numbers' );
		register_widget( 'Newsletter_Form' );
	}

	add_action( 'widgets_init', 'shandora_register_widgets' );

?>