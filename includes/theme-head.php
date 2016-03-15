<?php


if(!function_exists('shandora_print_dynamic_styles')) {

	function shandora_print_dynamic_styles() {

		$styles = bon_get_option('custom_css');
		
		if(!empty($styles)) { ?>
			<style type="text/css" id="shandora-custom-styles">
			
				<?php echo $styles; ?>

			</style>

			<?php 
		}

	}

	add_action('wp_head', 'shandora_print_dynamic_styles', 100);

}


if(!function_exists('shandora_print_dynamic_scripts')) {

	function shandora_print_dynamic_scripts() {

		$scripts = bon_get_option('custom_js');
		
		if(!empty($scripts)) { ?>
			<script>
			
				<?php echo $scripts; ?>

			</script>

			<?php 
		}

	}

	add_action('wp_head', 'shandora_print_dynamic_scripts', 100);

}


if(!function_exists('shandora_print_analytics_tracking_code')) {

	function shandora_print_analytics_tracking_code() {

		if ( WP_ENV === 'production' && !is_user_logged_in() ) {

			$scripts = bon_get_option('google_analytics');
			
			if(!empty($scripts)) { ?>
				
					<?php echo $scripts; ?>


				<?php 
			}

		}

	}

	add_action('wp_head', 'shandora_print_analytics_tracking_code', 101);

}


if(!function_exists('shandora_print_adwords_tracking_code')) {

	function shandora_print_adwords_tracking_code() {

		if ( WP_ENV === 'production' && !is_user_logged_in() ) {

			$scripts = bon_get_option('google_adwords');
			
			if(!empty($scripts)) { ?>
				
					<?php echo $scripts; ?>


				<?php 
			}

		}

	}

	add_action('wp_head', 'shandora_print_adwords_tracking_code', 101);

}


if(!function_exists('shandora_print_facebook_tracking_code')) {

	function shandora_print_facebook_tracking_code() {

		if ( WP_ENV === 'production' && !is_user_logged_in() ) {

			$scripts = bon_get_option('facebook_tracking');
			
			if(!empty($scripts)) { ?>
				
					<?php echo $scripts; ?>


				<?php 
			}

		}

	}

	add_action('wp_head', 'shandora_print_facebook_tracking_code', 101);

}


if(!function_exists('shandora_print_site_verification')) {

	function shandora_print_site_verification() {

		if ( WP_ENV === 'production' ) {

			$code = bon_get_option('site_verification');
			
			if(!empty($code)) { ?>
				
					<?php echo '<meta name="google-site-verification" content="' . $code . '" />'; ?>


				<?php 
			}

		}

	}

	add_action('wp_head', 'shandora_print_site_verification', 102);

}

?>