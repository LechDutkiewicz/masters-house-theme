<?php
/**
 * Shandora Head Hook
 *
 * @hooke shandora_document_info - 1
 *
 */
	do_atomic('head');

	$class = '';

	if( is_singular('product') ) {
		$class = 'singular-listing';
	}
	
	// Any mobile device (phones or tablets).

?>
<body data-spy="scroll" data-target=".affix-nav-container"  id="totop" <?php body_class( $class ); ?>>
	<a href="#main-content" class="sr-only sr-only-focusable"><?php _e( 'Skip to main content', 'bon'); ?></a>
	<div id="outer-wrap">

	<!-- BEGIN Header -->

	<?php
	/**
	 * Shandora Before Header Hook
	 *
	 *
	 */

	do_atomic('before_header'); ?>

	<header id="header-container" class="container full">

		<div id="header-inner-container" class="container" itemtype="http://schema.org/RealEstateAgent">


			<?php 
			/**
			 * Shandora Header Inner Container Action Hook
			 *
			 * @hooked shandora_close_main_content - 1
			 *
			 */

			do_atomic('header_content'); ?>
			
			
		</div>

	</header>
	

	<?php
	/**
	 * Shandora After Header Hook
	 * 
	 * @hooked shandora_get_custom_header - 1
	 *
	 */

	do_atomic('after_header'); ?>
	
	<!-- END Header -->