<?php

function shandora_setup_theme_hook() {

	$prefix = bon_get_prefix();
	$show_search = bon_get_option( 'enable_search_panel', 'yes' );
	$show_top_menu = bon_get_option( 'show_top_menu', 'show' );
	$show_footer_widget = bon_get_option( 'show_footer_widget', 'show' );
	$show_footer_copyright = bon_get_option( 'show_footer_copyright', 'hide' );

	if ( !is_admin() ) {

		add_action( "{$prefix}head", "shandora_document_info", 1 );

		add_action( "{$prefix}before_loop", "shandora_get_page_header", 1 );

		if ( $show_search == 'yes' ) {
			add_action( "{$prefix}before_loop", "shandora_search_get_listing", 2 );
		}

		add_action( "{$prefix}before_loop", "shandora_open_main_content_row", 5 );

		add_action( "{$prefix}before_loop", "shandora_open_360_iframe", 7 );

		add_action( "{$prefix}before_loop", "shandora_get_left_sidebar", 10 );

		add_action( "{$prefix}before_loop", "shandora_open_main_content_column", 15 );

		add_action( "{$prefix}before_loop", "shandora_listing_open_ul", 50 );

		add_action( "{$prefix}before_pagination", "shandora_listing_close_ul", 1 );

		add_action( "{$prefix}after_loop", "shandora_close_main_content_column", 1 );

		add_action( "{$prefix}after_loop", "shandora_get_right_sidebar", 5 );

		add_action( "{$prefix}after_loop", "shandora_close_main_content_row", 10 );

		// add_action( "{$prefix}after_loop", "shandora_add_slidebox", 15 );

		add_action( "{$prefix}before_home", "shandora_home_banners_slider", 3 );

		add_action( "{$prefix}before_home", "shandora_home_promotion", 4 );

		add_action( "{$prefix}before_home", "shandora_home_toolsection", 5 );

		// add_action( "{$prefix}before_home", "shandora_featured_slider", 6 );

		add_action( "{$prefix}before_home", "shandora_chosen_categories", 7 );

		add_action( "{$prefix}before_home", "shandora_home_we_are", 10 );

		add_action( "{$prefix}before_home", "shandora_testimonials_slider", 20 );

		add_action( "{$prefix}before_home", "shandora_ebook_section", 25 );

		if ( shandora_woocommerce_plugin_active() ) {

			add_action( "{$prefix}before_home", "shandora_shop_slider", 30 );

		}

		add_action( "{$prefix}before_home", "shandora_home_bottom_cta", 35 );

		if ( $show_top_menu == 'show' ) {
			add_action( "{$prefix}header_content", "shandora_get_topbar_navigation", 1 );
		}

		add_action( "{$prefix}header_content", "shandora_get_main_header", 5 );

		add_action( "{$prefix}header_content", "shandora_get_main_navigation", 10 );

		add_action( "{$prefix}after_header", "shandora_get_custom_header", 1 );

		add_action( "{$prefix}footer", "shandora_get_footer", 1 );

		if ( $show_footer_widget != 'hide' || $show_footer_copyright != 'hide' ) {
			add_action( "{$prefix}footer_widget", "shandora_get_footer_backtop", 1 );
		}

		if ( $show_footer_widget == 'show' ) {
			add_action( "{$prefix}footer_widget", "shandora_get_footer_widget", 5 );
		}

		if ( $show_footer_copyright == 'show' ) {
			add_action( "{$prefix}footer_widget", "shandora_get_footer_copyright", 10 );
		}

		add_action( "{$prefix}before_single_entry_content", "shandora_listing_gallery", 5 );

		add_action( "{$prefix}before_single_entry_content", "shandora_listing_meta", 6 );

	// removed by Lech Dutkiewicz add_action("{$prefix}after_single_entry_content", "shandora_listing_meta", 5);

		add_action( "{$prefix}after_single_entry_content", "shandora_social_counter", 10 );

		add_action( "{$prefix}after_single_entry_content", "shandora_listing_packages", 12 );

		add_action( "{$prefix}after_single_entry_content", "shandora_listing_spec_open", 15 );

		add_action( "{$prefix}after_single_entry_content", "shandora_listing_detail_tabs", 20 );

		// add_action( "{$prefix}after_single_entry_content", "shandora_listing_video", 25 );

		add_action( "{$prefix}after_single_entry_content", "shandora_listing_spec_close", 25 );

		// add_action( "{$prefix}after_single_entry_content", "shandora_listing_addon", 30 );

		add_action( "{$prefix}after_single_entry_content", "shandora_listing_services", 35 );

		add_action( "{$prefix}after_single_entry_content", "shandora_listing_toolsection", 40 );

		// add_action("{$prefix}after_single_entry_content", "shandora_car_listing_video", 30);

		//add_action( "{$prefix}after_single_entry_content", "shandora_listing_dpe_ges", 32 );

		//add_action("{$prefix}after_single_entry_content", "shandora_listing_map", 35);

		// add_action( "{$prefix}after_single_entry_content", "shandora_quality_section", 45 );

		add_action( "{$prefix}after_single_entry_content", "shandora_testimonials_slider", 57 );

		//add_action( "{$prefix}after_single_entry_content", "shandora_listing_agent", 50 );

		// add_action( "{$prefix}after_single_entry_content", "shandora_listing_related", 51 );

		add_action( "{$prefix}after_single_entry_content", "shandora_listing_faq", 55 );

		add_action( "{$prefix}after_single_entry_content", "shandora_listing_cta", 60 );

		add_action( "{$prefix}after_single_entry_content", "shandora_social_counter", 61 );

		add_action( "{$prefix}after_single_entry_content", "shandora_listing_modal", 8 );

		add_action( "{$prefix}after_single_post_entry", "shandora_post_comments", 3 );

		add_action( "{$prefix}after_single_post_entry", "shandora_post_related", 5 );

		add_action( "{$prefix}entry_summary", "shandora_listing_entry_title", 5 );

		add_action( "{$prefix}entry_summary", "shandora_listing_entry_meta", 10 );

		add_action( "{$prefix}entry_summary", "shandora_listing_list_view_summary", 15 );

		add_filter( 'posts_where', 'shandora_posts_where', 10, 2 );

		if ( bon_get_option( 'exclude_sold_rented', 'no' ) == 'yes' ) {
			add_filter( 'posts_where', 'shandora_exclude_sold_rented', 50, 2 );
		}

		/*		 * ***************************** */
		/* 								 */
		/* 	WOOCOMMERCE PLUGIN HOOKS	 */
		/* 								 */
		/*		 * ***************************** */

		if ( shandora_woocommerce_plugin_active() ) {

			/* REMOVE ACTIONS THAT WILL GET OVERRIDDEN */

		// Sidebar
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		// Main Content Structure
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		//Products & Tax content wrapper
			remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
			remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
		// Demo Store
			remove_action( 'wp_footer', 'woocommerce_demo_store' );
		// Breadcrumbs
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		// Shop Loop
			remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
		// Shop Loop Item
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		// Single Product
			remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
		// Cart
			remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

			/* ADD OVERRIDES TO WOOCOMMERCE ACTIONS */

		// Main Content Structure
			add_action( 'woocommerce_before_template_part', 'shandora_woo_before_template_part', 10, 4 );
			add_action( 'woocommerce_after_template_part', 'shandora_woo_after_template_part', 10, 4 );
			add_action( 'woocommerce_before_main_content', 'shandora_woo_wrapper_start', 10 );
			add_action( 'woocommerce_before_main_content', 'shandora_woo_breadcrumbs_bar', 15 );
			add_action( 'woocommerce_after_main_content', 'shandora_woo_wrapper_end', 10 );
		// Shop Loop
			add_action( 'woocommerce_before_shop_loop', 'shandora_woo_before_shop_loop', 10 );
			add_action( 'woocommerce_before_shop_loop', 'shandora_woo_open_result_header', 15 );
			add_action( 'woocommerce_before_shop_loop', 'shandora_woo_result_count', 20 );
			add_action( 'woocommerce_before_shop_loop', 'shandora_woo_catalog_ordering', 30 );
			add_action( 'woocommerce_before_shop_loop', 'shandora_woo_close_result_header', 35 );
			add_action( 'woocommerce_after_shop_loop', 'shandora_woo_pagination', 10 );
			add_action( 'woocommerce_after_shop_loop', 'shandora_woo_after_shop_loop', 10 );
		// Shop Loop Item
			add_action( 'woocommerce_before_shop_loop_item', 'shandora_woo_product_open', 10 );
			add_action( 'woocommerce_after_shop_loop_item', 'shandora_before_add_to_cart', 5 );
			add_action( 'woocommerce_after_shop_loop_item', 'shandora_woo_template_loop_price', 10 );
			add_action( 'woocommerce_after_shop_loop_item', 'shandora_after_add_to_cart', 15 );
			add_action( 'woocommerce_after_shop_loop_item', 'shandora_woo_product_close', 20 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'shandora_woo_get_product_thumbnail', 10 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'shandora_woo_product_summary_open', 20 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'shandora_woo_product_summary_close', 10 );
		// Single Product
			add_action( 'woocommerce_before_single_product', 'shandora_woo_before_shop_loop', 10 );
			add_action( 'woocommerce_after_single_product', 'shandora_woo_after_shop_loop', 10 );
			add_action( 'woocommerce_before_single_product_summary', 'shandora_row_open', 10 );
			add_action( 'woocommerce_before_single_product_summary', 'shandora_column_medium_open', 15 );
			add_action( 'woocommerce_before_single_product_summary', 'shandora_column_close', 25 );
			add_action( 'woocommerce_before_single_product_summary', 'shandora_column_medium_open', 30 );
			add_action( 'woocommerce_after_single_product_summary', 'shandora_column_close', 10 );
			add_action( 'woocommerce_after_single_product_summary', 'shandora_row_close', 10 );
			add_action( 'woocommerce_after_single_product_summary', 'shandora_woo_product_data_tabs', 11 );
		// Cart
			add_action( 'woocommerce_after_shipping_calculator', 'woocommerce_cross_sell_display', 10 );
			add_action( 'woocommerce_checkout_before_customer_details', 'shandora_row_open', 10 );
			add_action( 'woocommerce_checkout_after_customer_details', 'shandora_row_close', 10 );
			add_action( 'woocommerce_checkout_billing', 'shandora_column_medium_open', 5 );
			add_action( 'woocommerce_checkout_billing', 'shandora_column_close', 15 );
			add_action( 'woocommerce_checkout_shipping', 'shandora_column_medium_open', 5 );
			add_action( 'woocommerce_checkout_shipping', 'shandora_column_close', 15 );

		// Title removal:
			add_filter( 'woocommerce_show_page_title', 'override_page_title' );
			add_filter( 'woocommerce_enqueue_styles', 'override_page_title' );
			add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 );

			/* WOOCOMMERCE OVERRIDE FUNCTIONS */

		// Main Content Structure

			if ( !function_exists( 'shandora_woo_before_template_part' ) ) {

				function shandora_woo_before_template_part( $template_name, $template_path, $located, $args ) {
					if ( 'loop/no-products-found.php' == $template_name ) {
						echo '<div class="wpb_row vc_row-fluid shandora-row-notfull shandora-row_notsection"><div class="shandora-vc_row_inner">';
					}
				}

			}

			if ( !function_exists( 'shandora_woo_after_template_part' ) ) {

				function shandora_woo_after_template_part( $template_name, $template_path, $located, $args ) {

					if ( 'loop/no-products-found.php' == $template_name ) {
						echo '</div></div>';
					}
				}

			}

			if ( !function_exists( 'shandora_woo_wrapper_start' ) ) {

				function shandora_woo_wrapper_start() {

					$shop_page_id = null;

					if ( is_shop() ) {
						$shop_page_id = woocommerce_get_page_id( 'shop' );
						$page_title = get_the_title( $shop_page_id );
						$shandora_woo_id = $shop_page_id;
					} else {
						$shandora_woo_id = get_the_ID();
					}

					echo '<div id="inner-wrap"><div id="body-container" class="container">';
				}

			}

			if ( !function_exists( 'shandora_woo_breadcrumbs_bar' ) ) {

				function shandora_woo_breadcrumbs_bar() {
					$show_page_header = bon_get_option( 'show_page_header' );

					if ( $show_page_header == 'show' ) {
						bon_get_template_part( 'block', 'pageheader' );
					}
				}

				if ( !function_exists( 'shandora_woo_wrapper_end' ) ) {

					function shandora_woo_wrapper_end() {

						$shop_page_id = null;

						if ( is_shop() ) {
							$shop_page_id = woocommerce_get_page_id( 'shop' );
							$page_title = get_the_title( $shop_page_id );
							$shandora_woo_id = $shop_page_id;
						} else {
							$shandora_woo_id = get_the_ID();
						}
						if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
							get_sidebar( 'woocommerce' );
						}

						echo '</div></div></div>';
					}

				}

			// Shop Loop

				if ( !function_exists( 'shandora_woo_before_shop_loop' ) ) {

					function shandora_woo_before_shop_loop() {

						echo '<div id="main-content" class="row"><div class="' . shandora_column_class( 'large-8' ) . '">';
					}

				}

				if ( !function_exists( 'shandora_woo_open_result_header' ) ) {

					function shandora_woo_open_result_header() {
						echo '<div class="listing-header"><div class="row">';
					}

				}

				if ( !function_exists( 'shandora_woo_result_count' ) ) {

					function shandora_woo_result_count() {
						echo '<div class="column large-6">';
						bon_get_template_part( 'woocommerce', 'result-count' );
						echo '</div>';
					}

				}

				if ( !function_exists( 'shandora_woo_catalog_ordering' ) ) {

					function shandora_woo_catalog_ordering() {
						echo '<div class="column large-6 right">';
						woocommerce_catalog_ordering();
						echo '</div>';
					}

				}

				if ( !function_exists( 'shandora_woo_close_result_header' ) ) {

					function shandora_woo_close_result_header() {
						echo '</div></div>';
					}

				}

				if ( !function_exists( 'shandora_woo_pagination' ) ) {

					function shandora_woo_pagination() {
						if ( !is_singular() && current_theme_supports( 'bon-pagination' ) ) {
							bon_pagination( array( 'container_class' => 'pagination-centered', 'disabled_class' => 'unavailable', 'current_class' => 'current' ) );
						}
					}

				}

				if ( !function_exists( 'shandora_woo_after_shop_loop' ) ) {

					function shandora_woo_after_shop_loop() {

						echo '</div>';
					}

				}

			// Shop Loop Item

				if ( !function_exists( 'shandora_woo_product_open	' ) ) {

					function shandora_woo_product_open() {
						echo '<article class="single product peter-river">';
					}

				}

				if ( !function_exists( 'shandora_before_add_to_cart' ) ) {

					function shandora_before_add_to_cart() {
						echo '<footer class="entry-footer">';
					}

				}

				if ( !function_exists( 'shandora_woo_template_loop_price' ) ) {

					function shandora_woo_template_loop_price() {
						bon_get_template_part( 'woocommerce', 'price' );
					}

				}

				if ( !function_exists( 'shandora_after_add_to_cart' ) ) {

					function shandora_after_add_to_cart() {
						echo '</footer>';
					}

				}

				if ( !function_exists( 'shandora_woo_product_close' ) ) {

					function shandora_woo_product_close() {
						echo '</article>';
					}

				}
				if ( !function_exists( 'shandora_woo_get_product_thumbnail' ) ) {

					function shandora_woo_get_product_thumbnail() {
						bon_get_template_part( 'woocommerce', 'product-thumbnail' );
					}

				}

				if ( !function_exists( 'shandora_woo_product_summary_open' ) ) {

					function shandora_woo_product_summary_open() {
						echo '<div class="entry-summary">';
					}

				}

				if ( !function_exists( 'shandora_woo_product_summary_close' ) ) {

					function shandora_woo_product_summary_close() {
						echo '</div>';
					}

				}

			// Single Product

				if ( !function_exists( 'shandora_row_open' ) ) {

					function shandora_row_open() {

						echo '<div class="row">';
					}

				}

				if ( !function_exists( 'shandora_row_close' ) ) {

					function shandora_row_close() {

						echo '</div>';
					}

				}

				if ( !function_exists( 'shandora_column_small_open' ) ) {

					function shandora_column_small_open() {

						echo '<div class="' . shandora_column_class( 'large-4' ) . '">';
					}

				}

				if ( !function_exists( 'shandora_column_medium_open' ) ) {

					function shandora_column_medium_open() {

						echo '<div class="' . shandora_column_class( 'large-6' ) . '">';
					}

				}

				if ( !function_exists( 'shandora_column_large_open' ) ) {

					function shandora_column_large_open() {

						echo '<div class="' . shandora_column_class( 'large-8' ) . '">';
					}

				}

				if ( !function_exists( 'shandora_column_full_open' ) ) {

					function shandora_column_full_open() {

						echo '<div class="' . shandora_column_class( 'large-12' ) . '">';
					}

				}

				if ( !function_exists( 'shandora_column_close' ) ) {

					function shandora_column_close() {

						echo '</div>';
					}

				}

				if ( !function_exists( 'shandora_woo_product_data_tabs' ) ) {

					function shandora_woo_product_data_tabs() {
						bon_get_template_part( 'woocommerce', 'tabs' );
					}

				}

			//

			/* if ( !function_exists( 'shandora_woo_add_to_cart' ) ) {

			  function shandora_woo_add_to_cart( $message ) {
			  return '<div class="wpb_row vc_row-fluid shandora-row-notfull shandora-row_notsection"><div class="shandora-vc_row_inner">' . $message . '</div></div>';
			  }

			} */

			/* function shandora_woo_product_archive_description() {
			  if ( is_post_type_archive( 'product' ) && get_query_var( 'paged' ) == 0 ) {
			  $shop_page = get_post( wc_get_page_id( 'shop' ) );
			  if ( $shop_page ) {
			  $description = apply_filters( 'the_content', $shop_page->post_content );
			  if ( $description ) {
			  echo $description;
			  }
			  }
			  }
			} */

			/* if ( !function_exists( 'shandora_woo_taglines' ) ) {

			  function shandora_woo_taglines() {

			  $shop_page_id = null;

			  if ( is_shop() ) {
			  $shop_page_id = woocommerce_get_page_id( 'shop' );
			  $page_title = get_the_title( $shop_page_id );
			  $shandora_woo_id = $shop_page_id;
			  } else {
			  $shandora_woo_id = get_the_ID();
			  }

			  shandora_get_part_tagline( $shop_page_id );
			  }

			  }
			} */

			/* if ( !function_exists( 'shandora_woo_hide_title' ) ) {

			  function shandora_woo_hide_title( $show ) {
			  return false;
			  }

			} */

			/* if ( !function_exists( 'shandora_woocommerce_demo_store' ) ) {

			  function shandora_woocommerce_demo_store() {
			  if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_woocommerce_page() ) ) {
			  woocommerce_demo_store();
			  }
			  }

			} */

			/* if ( !function_exists( 'shandora_woo_loop_add_to_cart' ) ) {

			  function shandora_woo_loop_add_to_cart( $args = array() ) {
			  bon_get_template_part( 'woocommerce', 'add-to-cart' );
			  }

			} */

			if ( !function_exists( 'is_woocommerce_page' ) ) {

				function is_woocommerce_page() {

					if ( !function_exists( 'is_woocommerce' ) ) {
						return false;
					}

					return ( is_cart() || is_checkout() || is_account_page() || is_order_received_page() || is_product_category() || is_product_tag() || is_product() ) ? true : false;
				}

			}
		}
	}
}
}

add_action( 'after_setup_theme', 'shandora_setup_theme_hook', 100 );

function shandora_posts_where( $where, &$wp_query ) {
	global $wpdb;

	if ( $post_title = $wp_query->get( 'post_title' ) ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $post_title ) ) . '%\'';
	}
	return $where;
}

function shandora_exclude_sold_rented( $where, &$wp_query ) {
	global $wpdb;

	$where .= ' AND ' . $wpdb->posts . '.ID NOT IN (SELECT DISTINCT post_id FROM ' . $wpdb->postmeta . ' WHERE meta_key = \'' . esc_sql( esc_attr( bon_get_prefix() . 'listing_status' ) ) . '\' AND ( meta_value = \'' . esc_sql( esc_attr( 'sold' ) ) . '\'  OR meta_value = \'' . esc_sql( esc_attr( 'rented' ) ) . '\' ) )';
	return $where;
}

function shandora_listing_list_view_summary() {
	global $post;

	if ( !isset( $_GET['view'] ) || $_GET['view'] == 'grid' ) {
		return '';
	}

	echo '<div class="hide-for-small">';

	the_excerpt();

	echo '</div>';

	$meta = shandora_entry_meta();

	echo apply_atomic( 'listing_list_view_entry_meta', $meta );
}

function shandora_entry_meta() {

	global $post;

	$suffix = 'listing_';

	$html = apply_atomic( 'entry_meta_icon', '' );

	if ( $html != '' ) {
		return $html;
	}

	$view = isset( $_GET['view'] ) ? $_GET['view'] : 'grid';

	if ( get_post_type() === 'listing' ) {

		$sizemeasurement = bon_get_option( 'measurement' );
	/* $bed = shandora_get_meta( $post->ID, 'listing_bed' );
	$bath = shandora_get_meta( $post->ID, 'listing_bath' ); */
	$lotsize = shandora_get_meta( $post->ID, 'listing_lotsize' );
	$terrace = shandora_get_meta( $post->ID, 'listing_terracesqmt' );
	$rooms = shandora_get_meta( $post->ID, 'listing_rooms' );
	/* $garage = shandora_get_meta( $post->ID, 'listing_garage' ); */


	$html = '<div class="entry-meta">';

	// if ( $bed ) {

	// 	$html .= '<div class="icon bed"><i class="' . apply_atomic( 'bed_icon', 'sha-bed' ) . '"></i>';
	// 	$html .= '<span>';
	// 	$html .= sprintf( _n( '%s Bed', '%s Beds', $bed, 'bon' ), $bed );
	// 	$html .= '</span>';
	// 	$html .= '</div>';
	// }

	// if ( $bath ) {
	// 	$html .= '<div class="icon bath"><i class="' . apply_atomic( 'bath_icon', 'sha-bath' ) . '"></i>';
	// 	$html .= '<span>';
	// 	$html .= sprintf( _n( '%s Bath', '%s Baths', $bath, 'bon' ), $bath );
	// 	$html .= '</span>';
	// 	$html .= '</div>';
	// }

	/* if ( $view == 'list' ) { */

		// if ( $garage ) {
		// 	$html .= '<div class="icon garage"><i class="' . apply_atomic( 'garage_icon', 'sha-car' ) . '"></i>';
		// 	$html .= '<span>';
		// 	$html .= sprintf( _n( '%s Garage', '%s Garages', $garage, 'bon' ), $garage );
		// 	$html .= '</span>';
		// 	$html .= '</div>';
		// }

		if ( $rooms ) {
			$html .= '<div class="icon room text-asbestos" title="' . __( "Number of rooms", "bon" ). '"><i class="' . apply_atomic( 'room_icon', 'sha-bed' ) . '"></i>';
			$html .= '<span>';
			$html .= sprintf( _n( '%s room', '%s rooms', $rooms, 'bon' ), $rooms );
			$html .= '</span>';
			$html .= '</div>';
		}
		/* } */

		if ( $lotsize ) {

			$html .= '<div class="icon size text-asbestos" title="' . __( "Cottage size", "bon" ). '"><i class="' . apply_atomic( 'size_icon', 'sha-area' ) . '"></i>';
			$html .= '<span>';
			$html .= ($lotsize) ? $lotsize . ' ' . $sizemeasurement : __( 'Unspecified', 'bon' );
			$html .= '</span>';
			$html .= '</div>';
		}

		if ( $terrace ) {

			$html .= '<div class="icon terrace text-asbestos" title="' . __( "Terrace size", "bon" ). '"><i class="' . apply_atomic( 'terrace_icon', 'sha-coffee' ) . '"></i>';
			$html .= '<span>';
			$html .= ($terrace) ? $terrace . ' ' . $sizemeasurement : __( 'Unspecified', 'bon' );
			$html .= '</span>';
			$html .= '</div>';
		}

		$html .= '</div>';
	} else if ( get_post_type() == 'product' ) {

		$transmission = shandora_get_meta( $post->ID, $suffix . 'transmission' );
		$engine = shandora_get_meta( $post->ID, $suffix . 'enginesize' );
		$mileage = shandora_get_meta( $post->ID, $suffix . 'mileage' );

		$trans_opt = shandora_get_car_search_option( 'transmission' );
		if ( array_key_exists( $transmission, $trans_opt ) ) {
			$transmission = $trans_opt[$transmission];
		}

		$html = '<div class="entry-meta">';

		$html .= '<div class="icon engine"><i class="' . apply_atomic( 'engine_icon', 'sha-engine' ) . '"></i>';
		$html .= '<span>';
		$html .= ($engine) ? $engine : __( 'Unspecified', 'bon' );
		$html .= '</span>';
		$html .= '</div>';

		$html .= '<div class="icon transmission"><i class="' . apply_atomic( 'transmission_icon', 'sha-gear-shifter' ) . '"></i>';
		$html .= '<span>';
		$html .= ($transmission) ? $transmission : __( 'Unspecified', 'bon' );
		$html .= '</span>';
		$html .= '</div>';

		$html .= '<div class="icon mileage"><i class="' . apply_atomic( 'mileage_icon', 'bonicons bi-dashboard' ) . '"></i>';
		$html .= '<span>';
		$html .= ($mileage) ? $mileage : __( 'Unspecified', 'bon' );
		$html .= '</span>';
		$html .= '</div>';

		$html .= '</div>';
	} else if ( get_post_type() == 'boat-listing' ) {

		$length = shandora_get_meta( $post->ID, 'listing_length' );
		$speed = shandora_get_meta( $post->ID, 'listing_speed' );
		$fuel = shandora_get_meta( $post->ID, 'listing_fuelcaps' );
		$people = shandora_get_meta( $post->ID, 'listing_people_cap' );
		$terms = get_the_terms( $post->ID, 'boat-engine' );
		$engine_types = array();
		$engine_type = '';
		if ( $terms && !is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$engine_types[] = $term->name;
				break;
			}
		}

		if ( count( $engine_types ) > 0 ) {
			$engine_type = join( ' ', $engine_types );
		}

		$html = '<div class="entry-meta">';

		if ( $engine_type ) {

			$html .= '<div class="icon engine"><i class="' . apply_atomic( 'engine_icon', 'sha-engine' ) . '"></i> ';
			$html .= '<span>';
			$html .= $engine_type;
			$html .= '</span>';
			$html .= '</div>';
		}

		if ( $length ) {
			$html .= '<div class="icon transmission"><i class="' . apply_atomic( 'length_icon', 'sha-ruler' ) . '"></i> ';
			$html .= '<span>';
			$html .= $length . ' ' . bon_get_option( 'length_measure' );
			$html .= '</span>';
			$html .= '</div>';
		}

		if ( $speed ) {

			$html .= '<div class="icon speed"><i class="' . apply_atomic( 'speed_icon', 'bonicons bi-dashboard' ) . '"></i>';
			$html .= '<span>';
			$html .= $speed . ' ' . bon_get_option( 'speed_measure' );
			$html .= '</span>';
			$html .= '</div>';
		}

		if ( $view == 'list' ) {

			if ( $people ) {
				$html .= '<div class="icon people"><i class="' . apply_atomic( 'people_icon', 'sha-users' ) . '"></i>';
				$html .= '<span>';
				$html .= $people . ' ' . __( 'People', 'bon' );
				$html .= '</span>';
				$html .= '</div>';
			}

			if ( $fuel ) {
				$html .= '<div class="icon room"><i class="' . apply_atomic( 'fuel_icon', 'sha-tint' ) . '"></i>';
				$html .= '<span>';
				$html .= $fuel . ' ' . bon_get_option( 'volume_measure' );
				$html .= '</span>';
				$html .= '</div>';
			}
		}

		$html .= '</div>';
	}

	return $html;
}

/**
* Get Entry Title
*
* @since 1.3.5
* @return void
*
*/
function shandora_listing_entry_title() {

	global $post;

	$price = '';

	if ( isset( $_GET['view'] ) && $_GET['view'] == 'list' ) {
		$price = '<a href="' . get_permalink( $post->ID ) . '" title="' . the_title_attribute( array( 'before' => __( 'Permalink to ', 'bon' ), 'echo' => false ) ) . '"><span class="price">' . shandora_get_listing_price( false ) . '</span></a>';
	}

	echo apply_atomic_shortcode( 'entry_title', the_title( '<h3 class="entry-title like-h4"><a href="' . get_permalink() . '" class="product-link" title="' . the_title_attribute( array( 'before' => __( 'Permalink to ', 'bon' ), 'echo' => false ) ) . '" ' . get_ga_event( 'Cottage List', 'Pick single cottage', 'Title' ) . '>', '</a>' . $price . '</h3>', false ) );
}

/**
* Get Entry Meta
*
* @since 1.3.5
* @return void
*
*/
function shandora_listing_entry_meta() {
	if ( isset( $_GET['view'] ) && $_GET['view'] == 'list' ) {
		return '';
	}

	$meta = shandora_entry_meta();


	echo apply_atomic( 'listing_entry_meta', $meta );
}

/**
* Get Gallery Template
*
* @since 1.3.5
* @return void
*
*/
function shandora_listing_gallery() {
	bon_get_template_part( 'block', 'listinggallery' );
}

/**
* Get Listing Meta Icons
*
* @since 1.3.5
* @return void
*
*/
function shandora_listing_meta() {

	// if ( $_SESSION['layoutType'] !== 'mobile' && ( shandora_get_meta( get_the_ID(), 'listing_enable_packages' ) || shandora_get_meta( get_the_ID(), 'listing_enable_construction' ) ) ) {

	?>

	<div class="entry-meta" itemprop="description">
		<?php
		bon_get_template_part( 'block', trailingslashit( get_post_type() ) . 'meta' );
		?>
	</div>

	<?php
	// }
}

/**
* Get Listing Packages
* Added by Lech Dutkiewicz
* @since 1.4.0
* @return void
*
*/
function shandora_listing_packages() {

	if ( shandora_get_meta( get_the_ID(), 'listing_enable_packages' ) && $_SESSION['layoutType'] !== 'mobile' ) {

		?>

		<section class="row">
			<?php
			bon_get_template_part( 'block', trailingslashit( get_post_type() ) . 'packages' );
			?>
		</section>

		<?php
	}
}

/**
* Get Listing Meta Services
* Added by Lech Dutkiewicz
* @since 1.4.0
* @return void
*
*/
function shandora_listing_services() {	

	if ( $_SESSION['layoutType'] !== 'mobile' ) {
		?>

		<section itemprop="description" class="padding-large bottom">
			<?php
			bon_get_template_part( 'block', trailingslashit( get_post_type() ) . 'services' );
			?>
		</section>

		<?php
	}
}

/**
* Get Listing Meta Services
* Added by Lech Dutkiewicz
* @since 1.4.0
* @return void
*
*/
function shandora_listing_addon() {
	?>

	<div class="price-included row padding-medium top bottom">
		<?php bon_get_template_part( 'block', trailingslashit( get_post_type() ) . 'addon' ); ?>
	</div>

	<?php
}

/**
* Get Listing Video
*
* @since 1.3.5
* @return void
*
*/
function shandora_listing_video() {
	$vid = shandora_get_video();
	?>

	<?php if ( is_singular( 'listing' ) ) { ?>
	<div id="listing-video"  class="column large-6">
		<?php echo $vid; ?>
	</div>
	<?php } ?>

	<?php
}

/**
* Get Listing Video
*
* @since 1.3.5
* @return void
*
*/
function shandora_car_listing_video() {
	?>

	<?php if ( get_post_type() == 'product' || get_post_type() == 'boat-listing' ) { ?>

	<div class="row">
		<?php $vid = shandora_get_video(); ?>
		<div id="listing-video"  class="column large-12">
			<?php echo $vid; ?>
		</div>
	</div>

	<?php } ?>

	<?php
}

function shandora_social_counter() {

	bon_toolkit_render_social_counter( true );

}

/**
* Get Details Tab
*
* @since 1.3.5
* @return void
*
*/
function shandora_listing_detail_tabs() {

	$vid = shandora_get_video();
	$detail_class = 'large-6';
	if ( empty( $vid ) || is_singular( 'product' ) || is_singular( 'boat-listing' ) ) {
		$detail_class = "large-12";
	}
	?>
	<div id="detail-tab" class="column tabs-container <?php echo $detail_class; ?>">
		<?php
		bon_get_template_part( 'block', trailingslashit( get_post_type() ) . 'tab' );
		?>
	</div>
	<?php
}

/**
* Get Before Specification open div
*
* @since 1.3.5
* @return void
*
*/
function shandora_listing_spec_open() {
	echo '<section class="row padding-large top bottom">';
}

/**
* Close Specification div
*
* @since 1.3.5
* @return void
*
*/
function shandora_listing_spec_close() {
	echo '</section>';
}

/**
* Get Listing Map
*
* @since 1.3.5
* @return void
*
*/
function shandora_listing_map() {
	if ( is_singular( 'listing' ) ) {

		global $post;
		?>
		<div class="listing-map">
			<?php
			$latitude = shandora_get_meta( $post->ID, 'listing_maplatitude' );
			$longitude = shandora_get_meta( $post->ID, 'listing_maplongitude' );

			if ( !empty( $latitude ) && !empty( $longitude ) ) {
				echo apply_atomic_shortcode( 'listing_map', '[bt-map color="blue" latitude="' . $latitude . '" longitude="' . $longitude . '" zoom="16" width="100%" height="400px"]' );
			}
			?>
		</div>
		<?php
	}
}

/**
* Get Related Listing
*
* @since 1.3.5
* @return void
*
*/
function shandora_listing_related() {
	if ( is_singular( 'listing' ) ) {
		bon_get_template_part( 'block', 'related' );
	}
}

/**
* Get FAQ Listing
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/
function shandora_listing_faq() {

	if ( is_singular( 'listing' ) && $_SESSION['layoutType'] !== 'mobile' ) {

		bon_get_template_part( 'block', trailingslashit( get_post_type() ) . 'faq' );

	}

}

/**
* Get Listing CTA
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/
function shandora_listing_cta() {

	if ( is_singular( 'listing' ) && $_SESSION['layoutType'] !== 'mobile' ) {

		bon_get_template_part( 'block', 'block-cta' );

	}
	
}

/**
* Get Listing CTA
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/
function shandora_listing_modal() {
	if ( is_singular( 'listing' ) ) {
		bon_get_template_part( 'block', 'block-modal-contact' );
	}
}

/**
* Get comments
* Added by Lech Dutkiewicz
* @since 1.3.7
* @return void
*
*/
function shandora_post_comments() {

// remove comments from WooCommerce pages
	if ( is_singular() && !is_front_page() && post_type_supports( get_post_type(), 'comments' ) ) {
		if (shandora_woocommerce_plugin_active()) {
			if ( is_woocommerce() || is_cart() || is_checkout() ) {
			} else {
				shandora_get_comments_template();
			}
		} else {
			shandora_get_comments_template();	
		}

	} // Loads the comments.php template. 

}

function shandora_get_comments_template() {

	?>

	<section id="comments-section" class="margin-large top">

		<div>
			<h3><?php _e( 'Comment', 'bon'); ?></h3>
			<hr>
		</div>

		<?php

		if ( bon_get_option( 'enable_disqus' ) ) {
			bon_get_template_part( 'block', 'block-disqus-comments' );
		} else {
			comments_template();
		} ?>

	</section>

	<?php

}

/**
* Get Related posts for blog post
* Added by Lech Dutkiewicz
* @since 1.3.7
* @return void
*
*/
function shandora_post_related() {

	if (isset($post)) { $orig_post = $post; }
	global $post;
	$tags = wp_get_post_tags($post->ID);

	if ( $tags && !defined('RELATED_POSTS') ) {

		define('RELATED_POSTS', true);

		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'caller_get_posts'=>1,
			'posts_per_page'=>4
			);

		$my_query = new wp_query( $args );

		if ( $my_query->have_posts() ) {

			?>

			<section id="related-posts" class="margin-large top">

				<header class="post-section-header">
					<h3><?php _e( 'You may also like', 'bon'); ?></h3>
					<hr>
				</header>

				<?php if ( $my_query->have_posts() ) { ?>
				<ul class="mobile-block-grid-1 xsmall-block-grid-2 small-block-grid-4 medium-block-grid-2">
					<?php while( $my_query->have_posts() ) { $my_query->the_post(); ?>
					<li>
						<?php bon_get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() . 'related' : get_post_type() . 'related' ) ); ?>
					</li>
					<?php } ?>
				</ul>
				<?php }	?>

			</section>

			<?php

		}

	}

	if (isset($orig_post)) { $post = $orig_post; }
	wp_reset_query();

}

/**
* Get Tool Section
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/
function shandora_listing_toolsection() {

	$display = bon_get_option( 'tool_section_display' );

	global $post;
	// get taxonomies marked to display tool section
	$toolsection_tax = bon_get_option( 'tool_section_taxonomies' );
	// get current post term
	$terms = wp_get_post_terms( $post->ID, 'property-type' );

	// look if any of current post's terms is marked as checked
	foreach ( $terms as $term ) {
		if ( isset( $toolsection_tax[$term->term_id] ) &&
			$toolsection_tax[$term->term_id] == 1 &&
			$display === '1' &&
			$_SESSION['layoutType'] !== 'mobile' &&
			is_singular( 'listing' )
			) {
			bon_get_template_part( 'block', 'block-toolsection' );
	}
}

}

/**
* Get Banners Slider Home
* Added by Lech Dutkiewicz
* @since 1.3.7
* @return void
*
*/

function shandora_home_banners_slider() {

	if ( bon_get_option( 'home_banners' ) && $_SESSION['layoutType'] !== 'mobile' )
		bon_get_template_part( 'loop', 'banner' );

}

/**
* Get Promotion Section Home
* Added by Lech Dutkiewicz
* @since 1.3.7
* @return void
*
*/

function shandora_home_promotion() {
	if ( bon_get_option( 'home_promotion' ) )
		bon_get_template_part( 'block', 'block-promotion-home' );
}

/**
* Get Tool Section Home
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/

function shandora_home_toolsection() {
	if ( bon_get_option( 'tool_section_display_home' ) ) {
		if ( shandora_is_home() ) {
			bon_get_template_part( 'block', 'block-toolsection-home' );
		}
	}
}

/**
* Get We Are Section
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/
function shandora_home_we_are() {

	bon_get_template_part( 'block', 'listing/home-features' );

}

/**
* Get Quality Section
* Added by Lech Dutkiewicz
* @since 1.3.7
* @return void
*
*/
function shandora_quality_section() {

	if ( $_SESSION['layoutType'] !== 'mobile' ) {
		bon_get_template_part( 'block', 'block-quality-section' );
	}

}

/**
* Get Testimonials Slider
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/
function shandora_testimonials_slider() {
	if ( bon_get_option( 'home_testimonials' ) )
		bon_get_template_part( 'block', 'block-testimonials-slider' );
}

/**
* Get Featured Cottages Slider
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/
function shandora_featured_slider() {
	bon_get_template_part( 'block', 'block-featured-slider' );
}

/**
* Get Featured Cottages Slider
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/
function shandora_chosen_categories() {
	bon_get_template_part( 'block', 'block-chosen-categories' );
}

/**
* Get Ebook Section
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/
function shandora_ebook_section() {
	if ( bon_get_option( 'home_ebook' ) && is_user_logged_in() )
		bon_get_template_part( 'block', 'block-ebook' );
}

/**
* Get Home Bottom CTA
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/
function shandora_home_bottom_cta() {
	bon_get_template_part( 'block', 'block-home-bottom-cta' );
}

/**
* Get Products Slider
* Added by Lech Dutkiewicz
* @since 1.3.6
* @return void
*
*/
function shandora_shop_slider() {
	if ( bon_get_option( 'home_eshop' ) )
		bon_get_template_part( 'block', 'block-shop-slider' );
}

/**
* Get Listing Footer
*
* @since 1.3.5
* @return void
*
*/
function shandora_listing_agent() {

	$show_agent_details = bon_get_option( 'show_agent_details', 'yes' );
	$show_contact_form = bon_get_option( 'show_contact_form', 'yes' );

	if ( $show_agent_details == 'no' && $show_contact_form == 'no' )
		return;

	bon_get_template_part( 'block', 'agent' );
}

if ( !function_exists( 'shandora_document_info' ) ) {

	function shandora_document_info() {
		?>
		<!DOCTYPE html>
		<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo trailingslashit( BON_JS ) . 'frontend/jquery.selectivizr.min.js'; ?>"></script>
		<![endif]-->
		<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
		<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
		<!--[if (gte IE 9)|!(IE)]><!-->
		<html <?php language_attributes(); ?>>
		<head>

			<?php if ( is_singular() && !is_singular( 'page' ) ) { ?>
			<!-- setup open graph for single post page -->
			<?php
			global $post;
			//$img = get_the_image( array( 'post_id' => $post->ID, 'attachment' => true, 'image_scan' => true, 'size' => 'thumbnail', 'format' => 'array', 'echo' => false ) );
			$content = wp_trim_words( $post->post_content, $num_words = 50, $more = null );
			$title = $post->post_title;
			if ( $post->post_type == 'listing' ) {
				$price = shandora_get_price_meta( $post->ID );
				$title = $title . ' - ' . $price;
			}
			?>
			<meta property="og:type" content="article" />
			<meta property="og:title" content="<?php echo $title; ?>" />
			<meta property="og:description" content="<?php echo strip_tags( strip_shortcodes( $content ) ); ?>" />
			<meta property="og:image" content="<?php echo get_thumbnail_src(); ?>" />
			<meta property="og:url" content="<?php the_permalink(); ?>" />
			<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />

			<?php } else { ?>
			<!-- setup open graph for single page and category, taxonomy and archive pages -->
			<?php global $wp_query; ?>
			<meta property="og:type" content="website" />
			<meta property="og:title" content="<?php echo get_open_graph_title(); ?>" />
			<meta property="og:description" content="<?php echo get_open_graph_description(); ?>" />

			<?php if ( is_tax() || is_category() ) { ?>
			<!-- additional parameters for taxonomy and category pages -->

			<!-- fetch more images for open graph from posts loop -->
			<?php foreach ( $wp_query->posts as $featured_post ) { ?>
			<meta property="og:image" content="<?php echo get_thumbnail_src($featured_post->ID, 'listing_large'); ?>" />

			<?php } ?>

			<meta property="og:url" content="<?php echo shandora_get_site_url() . strtok( $_SERVER["REQUEST_URI"], '?' ); ?>" />

			<?php } else { ?>
			<!-- additional parameters for all other pages -->

			<meta property="og:image" content="<?php echo get_thumbnail_src(); ?>" />
			<meta property="og:url" content="<?php the_permalink(); ?>" />

			<?php } ?>

			<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />

			<?php } ?>

			<!-- END opengraph -->

			<?php bon_doctitle(); ?>
			<link rel="profile" href="http://gmpg.org/xfn/11" />

			<!-- favicon -->
			<?php $favico = bon_get_option( 'favicon', trailingslashit( BON_THEME_URI ) . 'assets/images/icon.png' ); ?>
			<link rel="shortcut icon" href="<?php echo $favico; ?>" type="image/x-icon" />

			<?php if ( !is_singular() || is_page() ) { ?>
			<!-- share link image -->
			<link rel="image_src" href="<?php echo get_thumbnail_src(); ?>" />
			<?php } ?>

			<?php if ( !is_singular() ) { ?>
			<!-- canonical link for category pages -->
			<link rel="canonical" href="<?php echo shandora_get_site_url() . strtok( $_SERVER["REQUEST_URI"], '?' ); ?>" />
			<?php } ?>

			<?php wp_head(); // wp_head           ?>

		</head>
		<?php
	}

}


if ( !function_exists( 'shandora_get_page_header' ) ) {

	function shandora_get_page_header() {
		if ( !shandora_is_home() ) {
			$show_page_header = bon_get_option( 'show_page_header' );

			if ( $show_page_header == 'show' ) {
				bon_get_template_part( 'block', 'pageheader' );
			}
		} else if ( shandora_is_home() && bon_get_option( 'show_slider', 'show' ) == 'hide' ) {
			$show_page_header = bon_get_option( 'show_page_header' );

			if ( $show_page_header == 'show' ) {
				bon_get_template_part( 'block', 'pageheader' );
			}
		}
	}

}

if ( !function_exists( 'shandora_search_get_listing' ) ) {

	function shandora_search_get_listing() {

		if ( shandora_is_home() ||
			is_singular( 'listing' ) || is_singular( 'agent' ) || is_singular( 'product' ) || is_singular( 'boat-listing' ) ||
			is_page_template( 'page-templates/page-template-all-agent.php' ) ||
			is_page_template( 'page-templates/page-template-all-listings.php' ) ||
			is_page_template( 'page-templates/page-template-all-car-listings.php' ) ||
			is_page_template( 'page-templates/page-template-compare-car-listings.php' ) ||
			is_page_template( 'page-templates/page-template-search-car-listings.php' ) ||
			is_page_template( 'page-templates/page-template-idx.php' ) ||
			is_page_template( 'page-templates/page-template-idx-details.php' ) ||
			is_page_template( 'page-templates/page-template-search-listings.php' ) ||
			is_page_template( 'page-templates/page-template-compare-listings.php' ) ||
			is_page_template( 'page-templates/page-template-property-status.php' ) ||
			is_page_template( 'page-templates/page-template-car-status.php' ) ||
			is_page_template( 'page-templates/page-template-all-boats.php' ) ||
			is_page_template( 'page-templates/page-template-search-boat.php' ) ||
			is_page_template( 'page-templates/page-template-compare-boat.php' ) ||
			is_tax( get_object_taxonomies( 'listing' ) ) ||
			is_tax( get_object_taxonomies( 'product' ) ) ||
			is_tax( get_object_taxonomies( 'boat-listing' ) ) ) {

	bon_get_template_part( 'block', 'searchlisting' );
}
}

}

if ( !function_exists( 'shandora_open_main_content_row' ) ) {


	function shandora_open_main_content_row() {

		echo '<div id="main-content" class="row">';
	}

}

if ( !function_exists( 'shandora_open_360_iframe' ) ) {

	function shandora_open_360_iframe() {

		$virtual_tour = shandora_get_meta( get_the_ID(), 'listing_360_view' );
		if ($virtual_tour) {
			bon_get_template_part( 'block', 'virtual-tour');
		}
	}

}

if ( !function_exists( 'shandora_get_left_sidebar' ) ) {


	function shandora_get_left_sidebar() {
		$layout = get_theme_mod( 'theme_layout' );
		if ( empty( $layout ) ) {
			$layout = get_post_layout( get_queried_object_id() );
		}
		if ( $layout == '2c-r' ) {

			if ( get_post_type() == 'listing' || get_post_type() == 'product' || get_post_type() == 'promotions' || get_post_type() == 'portfolio' ||
				is_page_template( 'page-templates/page-template-all-listings.php' ) ||
				is_page_template( 'page-templates/page-template-all-car-listings.php' ) ||
				is_page_template( 'page-templates/page-template-search-car-listings.php' ) ||
				is_page_template( 'page-templates/page-template-property-status.php' ) ||
				is_page_template( 'page-templates/page-template-car-status.php' ) ||
				is_page_template( 'page-templates/page-template-search-listings.php' ) ||
				is_page_template( 'page-templates/page-template-testimonials.php' )  ) {

				get_sidebar( 'secondary' );

		} else if ( is_page_template( 'page-templates/page-template-about-us.php' ) ) {

			get_sidebar( 'about-us' );

		} else if ( shandora_woocommerce_plugin_active() && is_woocommerce_page() ) {

			get_sidebar( 'woocommerce' );

		} else if ( !is_page_template( 'page-templates/page-template-village-map.php' ) ) {

			get_sidebar( 'primary' );

		}
	}
}

}

if ( !function_exists( 'shandora_open_main_content_column' ) ) {


	function shandora_open_main_content_column() {

		if ( is_page_template( 'page-templates/page-template-home.php' ) ||
			is_page_template( 'page-templates/page-template-village-map.php' ) ) {
			echo '<div class="column large-12">';
	} else {

		$layout = get_theme_mod( 'theme_layout' );
		if ( empty( $layout ) ) {
			$layout = get_post_layout( get_queried_object_id() );
		}
		if ( $layout == '1c' ) {
			echo '<div class="' . shandora_column_class() . '">';
		} else {
			echo '<div class="' . shandora_column_class( 'large-8' ) . '">';
		}
	}
}

}

function shandora_get_site_url() {

	$protocol = (!empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domain = $_SERVER['HTTP_HOST'];

	return $protocol . $domain;
}

if ( !function_exists( 'shandora_listing_open_ul' ) ) {


	function shandora_listing_open_ul() {

		$compare_page = bon_get_option( 'compare_page' );

		if (
			(
				is_page_template( 'page-templates/page-template-property-status.php' ) ||
				is_page_template( 'page-templates/page-template-car-status.php' ) ||
				get_post_type() == 'listing'||
				get_post_type() == 'boat-listing'||
				get_post_type() == 'product'||
				is_page_template( 'page-templates/page-template-all-listings.php' ) ||
				is_page_template( 'page-templates/page-template-all-car-listings.php' ) ||
				is_page_template( 'page-templates/page-template-search-listings.php' ) ||
				is_page_template( 'page-templates/page-template-search-boat.php' ) ||
				is_page_template( 'page-templates/page-template-all-boats.php' ) ||
				is_page_template( 'page-templates/page-template-search-car-listings.php' )
				) &&
			!is_singular( 'listing' ) &&
			!is_singular( 'product' ) &&
			!is_singular( 'boat-listing' ) &&
			!is_search()
			) {

			$show_map = 'no';
		$show_listing_count = bon_get_option( 'show_listing_count', 'no' );

		if ( ( is_page_template( 'page-templates/page-template-property-status.php' ) || get_post_type() == 'listing' || is_page_template( 'page-templates/page-template-all-listings.php' ) || is_page_template( 'page-templates/page-template-search-listings.php' )) && !is_singular( 'listing' ) && !is_singular( 'product' ) && !is_singular( 'boat-listing' ) ) {
			$show_map = bon_get_option( 'show_listings_map' );
		}

		if ( !is_page_template( 'page-templates/page-template-all-listings.php' ) ) {
			// don't display listing header for all listings page
			?>
			<div class="listing-header">
				<div class="row">

					<?php
					if ( $show_listing_count ) {
						echo '<div class="column small-12 medium-6 show-for-medium-up"><h3 id="listed-property"></h3></div>';
					}
					?>

					<?php
					$search_order = isset( $_GET['search_order'] ) ? $_GET['search_order'] : bon_get_option( 'listing_order', 'PRICE_ASC' );
					// $search_orderby = isset( $_GET['search_orderby'] ) ? $_GET['search_orderby'] : bon_get_option( 'listing_orderby', 'date' );
					?>

					<div class="column small-12 medium-6 right">

						<div class="row">
							<div class="column small-3">
								<?php
								$view = isset( $_GET['view'] ) ? $_GET['view'] : 'grid';
								$newurl = '';
								foreach ( $_GET as $variable => $value ) {
									if ( $variable != 'view' ) {
										$newurl .= $variable . '=' . $value . '&';
									}
								}
								$newurl = rtrim( $newurl, '&' );
								if ( empty( $newurl ) ) {
									$uri = shandora_get_site_url() . strtok( $_SERVER["REQUEST_URI"], '?' );
									$newurl = $uri . '?view=';
								} else {
									$uri = shandora_get_site_url() . strtok( $_SERVER["REQUEST_URI"], '?' );
									$newurl = $uri . '?' . $newurl . '&view=';
								}
								?>
								<a class="view-button button concrete flat view-grid <?php echo ( $view == 'grid' ) ? 'selected' : ''; ?> " href="<?php echo $newurl . 'grid'; ?>" data-analytics-category="Cottage List" data-analytics-action="Switch View" data-analytics-label="grid" title="<?php _e( "View as grid", "bon"); ?>"><i class="bonicons bi-th-large"></i></a>
								<a class="view-button button concrete flat view-list <?php echo ( $view == 'list' ) ? 'selected' : ''; ?>" href="<?php echo $newurl . 'list'; ?>" data-analytics-category="Cottage List" data-analytics-action="Switch View" data-analytics-label="list" title="<?php _e( "View as list", "bon"); ?>"><i class="bonicons bi-th-list"></i></a>
							</div>
							<div class="column small-9">
								<form class="custom" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get" id="orderform" name="orderform">

									<div class="row">
										<div class="column small-12 search-order">
											<select class="no-mbot" name="search_order" onChange="document.forms['orderform'].submit()">
												<option value="PRICE_ASC" <?php selected( $search_order, 'PRICE_ASC' ); ?> ><?php _e( 'Price', 'bon' ); ?> <?php _e( 'Ascending', 'bon' ); ?></option>
												<option value="PRICE_DESC" <?php selected( $search_order, 'PRICE_DESC' ); ?> ><?php _e( 'Price', 'bon' ); ?> <?php _e( 'Descending', 'bon' ); ?></option>
												<option value="SIZE_ASC" <?php selected( $search_order, 'SIZE_ASC' ); ?> ><?php _e( 'Size', 'bon' ); ?> <?php _e( 'Ascending', 'bon' ); ?></option>
												<option value="SIZE_DESC" <?php selected( $search_order, 'SIZE_DESC' ); ?> ><?php _e( 'Size', 'bon' ); ?> <?php _e( 'Descending', 'bon' ); ?></option>
											</select>
										</div>
										<!-- <div class="column large-5 search-orderby">
											<select class="no-mbot" name="search_orderby">
												<option value="<?php _e( 'Price', 'bon' ); ?>" <?php selected( $search_orderby, 'Price' ); ?> ><?php _e( 'Price', 'bon' ); ?></option>
												<?php // edited by Lech Dutkiewicz           ?>
												<option value="<?php _e( 'Size', 'bon' ); ?>" <?php selected( $search_orderby, 'Size' ); ?> >
													<?php
													if ( get_post_type() == 'listing' || is_page_template( 'page-templates/page-template-search-listings.php' ) || is_page_template( 'page-templates/page-template-all-listings.php' ) ) {
														echo __( 'Size', 'bon' );
													} else if ( get_post_type() == 'product' || is_page_template( 'page-templates/page-template-search-car-listings.php' ) || is_page_template( 'page-templates/page-template-all-car-listings.php' ) ) {
														echo __( 'Mileage', 'bon' );
													} else if ( get_post_type() == 'boat-listing' || is_page_template( 'page-templates/page-template-search-boat.php' ) || is_page_template( 'page-templates/page-template-all-boats.php' ) ) {
														echo __( 'Length', 'bon' );
													}
													?>
												</option>
											</select>
										</div> -->
										<?php
										foreach ( $_GET as $name => $value ) {
											if ( $name != 'search_order' && $name != 'search_orderby' ) {
												$name = htmlspecialchars( $name );
												$value = htmlspecialchars( $value );
												echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
											}
										}
										?>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			if ( $show_map == 'show' ) {
				$show_zoom = bon_get_option( 'show_listings_map_zoom', 'false' );
				if ( $show_zoom == 'show' ) {
					$show_zoom = 'true';
				}

				$show_type = bon_get_option( 'show_listings_map_type', 'false' );
				if ( $show_type == 'show' ) {
					$show_type = 'true';
				}

				echo '<div id="listings-map" data-show-zoom="' . $show_zoom . '" data-show-map-type="' . $show_type . '"></div>';
			}
		}
	// end of don't display listing header for all listings page
		?>
		<ul class="listings <?php echo ( isset( $_GET['view'] ) && $_GET['view'] == 'list' ) ? 'list-view' : shandora_block_grid_column_class( false ); ?>" data-compareurl="<?php echo trailingslashit( get_permalink( $compare_page ) ); ?>">
			<?php
		}
	}

}

if ( !function_exists( 'shandora_listing_close_ul' ) ) {

	function shandora_listing_close_ul() {

		if ( (get_post_type() == 'listing' || get_post_type() == 'product' || get_post_type() == 'boat-listing' || is_page_template( 'page-templates/page-template-all-listings.php' ) ||
			is_page_template( 'page-templates/page-template-search-boat.php' ) || is_page_template( 'page-templates/page-template-all-boats.php' ) ||
			is_page_template( 'page-templates/page-template-all-car-listings.php' ) || is_page_template( 'page-templates/page-template-car-status.php' ) || is_page_template( 'page-templates/page-template-property-status.php' ) ||
			is_page_template( 'page-templates/page-template-search-car-listings.php' ) || is_page_template( 'page-templates/page-template-search-listings.php' )) && !is_singular( 'listing' ) && !is_singular( 'product' ) && !is_singular( 'boat-listing' ) && !is_search() ) {
				?>
			</ul>

			<?php
		}
	}
}


if ( !function_exists( 'shandora_close_main_content_column' ) ) {



	function shandora_close_main_content_column() {
		echo '</div><!-- close column -->';
	}

}

if ( !function_exists( 'shandora_get_right_sidebar' ) ) {

	function shandora_get_right_sidebar() {
		$layout = get_theme_mod( 'theme_layout' );
		if ( empty( $layout ) ) {
			$layout = get_post_layout( get_queried_object_id() );
		}

		if ( $layout == '2c-l' ) {

			if ( get_post_type() == 'listing' || get_post_type() == 'product' || get_post_type() == 'promotions' || get_post_type() == 'portfolio' ||
				is_page_template( 'page-templates/page-template-all-listings.php' ) ||
				is_page_template( 'page-templates/page-template-all-car-listings.php' ) ||
				is_page_template( 'page-templates/page-template-search-car-listings.php' ) ||
				is_page_template( 'page-templates/page-template-property-status.php' ) ||
				is_page_template( 'page-templates/page-template-car-status.php' ) ||
				is_page_template( 'page-templates/page-template-search-listings.php' ) ||
				is_page_template( 'page-templates/page-template-testimonials.php' ) ||
				is_page_template( 'page-templates/page-template-team.php' ) ) {

				get_sidebar( 'secondary' );

		} else if ( is_page_template( 'page-templates/page-template-about-us.php' ) ) {

			get_sidebar( 'about-us' );

		} else if ( shandora_woocommerce_plugin_active() && is_woocommerce_page() ) {

			get_sidebar( 'woocommerce' );

		} else if ( !is_page_template( 'page-templates/page-template-village-map.php' ) && get_post_type() != 'portfolio' ) {

			get_sidebar( 'primary' );

		}
	}
}

}

if ( !function_exists( 'shandora_close_main_content_row' ) ) {

	function shandora_close_main_content_row() {

		echo '</div><!-- close row -->';
	}

}

if ( !function_exists( 'shandora_add_slidebox' ) ) {

	function shandora_add_slidebox() {

		if ( $_SESSION['layoutType'] !== 'mobile' ) {
			// show slidebox just for tablets and desktops

			bon_get_template_part( 'block', 'block-slidebox' );

		}
	}

}


if ( !function_exists( 'shandora_get_topbar_navigation' ) ) {


	function shandora_get_topbar_navigation() {

	}

}

if ( !function_exists( 'shandora_get_main_header' ) ) {

	function shandora_get_main_header() {
		$header_style = bon_get_option( 'main_header_style', 'dark' );
		$state = bon_get_option( 'show_main_header', 'show' );
		$header_col_1 = bon_get_option( 'enable_header_col_1' );
		$header_col_2 = bon_get_option( 'enable_header_col_2' );
		$center_logo = bon_get_option( 'centering_logo' );

		$header_col_class = 'large-9';
		$col_class = 'large-6';
		$logo_class = 'uncentered';
		$logo_col_class = 'large-3';
		if ( $header_col_1 == true && $header_col_2 == true ) {
			$header_col_class = 'large-9 small-12';
			$col_class = 'large-6 small-12';
		} else if ( $header_col_1 == true && $header_col_2 == false ) {
			$header_col_class = 'large-5 small-12';
			$col_class = 'large-12';
		} else if ( $header_col_1 == false && $header_col_2 == true ) {
			$header_col_class = 'large-5 small-12';
			$col_class = 'large-12';
		} else {

			$logo_class = 'full';
			$logo_col_class = 'large-12';
			if ( $center_logo == true ) {
				$logo_class = 'centered';
			}
		}
		?>
		<hgroup id="main-header" class="<?php echo $header_style; ?> slide <?php echo $state; ?>">
			<div class="row">
				<?php $is_text = ((bon_get_option( 'logo' ) != '') ? false : true); ?>
				<div class="<?php echo $logo_col_class; ?> column small-centered large-<?php echo $logo_class; ?> <?php echo ($is_text) ? 'text-logo' : ''; ?>" id="logo">
					<div id="nav-toggle" class="navbar-handle show-for-small"></div>
					<?php
					$tag = 'h1';
					if ( is_singular() && !is_home() && !is_front_page() ) {
						$tag = 'h3';
					}
					?>
					<<?php echo $tag; ?> itemprop="name" class="<?php echo $logo_class; ?>"><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php if ( bon_get_option( 'logo' ) ) { ?><img itemprop="image" src="<?php echo bon_get_option( 'logo', get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/><?php
				} else {
					echo esc_attr( get_bloginfo( 'name', 'display' ) );
				}
				?></a></<?php echo $tag; ?>>
				<?php if ( $is_text ) { ?>
				<span class="site-description <?php echo $logo_class; ?> hide-for-desktop hide-for-small"><?php echo get_bloginfo( 'description', 'display' ); ?></span>
				<?php } ?>
			</div>

			<?php if ( $header_col_1 == true || $header_col_2 == true ) : ?>
			<div class="<?php echo $header_col_class; ?> column" id="company-info">
				<div class="row">
					<?php if ( $header_col_1 ) : ?>
					<div class="<?php echo $col_class; ?> column small-text-center small-margin medium bottom">
						<div class="icon hide-for-small">
							<span class="sha-phone"></span>
						</div>
						<span class="info-title"><?php echo esc_attr( bon_get_option( 'hgroup1_title' ) ); ?></span>
						<?php
						$phone_html = '';
						$phone = explode( ',', esc_attr( bon_get_option( 'hgroup1_content' ) ) );
						$phone_count = count( $phone );
						if ( $phone_count > 1 ) {
							foreach ( $phone as $number ) {
								$phone_html .= '<strong>' . $number . '</strong>';
							}
						} else {
							$phone_html .= get_formatted_phone_number();
						}
						?>
						<span class="phone phone-<?php echo $phone_count; ?>"><?php echo $phone_html; ?></span>
					</div>
				<?php endif; ?>
				<?php if ( $header_col_2 ) : ?>
				<div class="<?php echo $col_class; ?> column hide-for-small small-text-center">
					<div class="icon">
						<span class="sha-calendar"></span>
					</div>
					<span class="info-title"><?php echo bon_get_option( 'hgroup2_title' ); ?></span>
					<span class="phone visit"><strong><a href="#" data-reveal-id="<?php echo bon_get_option( 'form_type' ); ?>-modal" title="<?php echo esc_attr( bon_get_option( 'hgroup2_line1' ) ); ?>" <?php the_ga_event( "Contact", "Open Visit Request", "Menu Bar" ); ?>><?php echo esc_attr( bon_get_option( 'hgroup2_line1' ) ); ?></a></strong></span>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

</div>
</hgroup> 
<?php
}

}

if ( !function_exists( 'shandora_get_main_navigation' ) ) {



	function shandora_get_main_navigation() {

		$nav_style = bon_get_option( 'main_header_nav_style', 'dark' );
		$no_search = 'no-search';
		?>
		<hgroup id="main-navigation" class="<?php echo $nav_style; ?>">
			<?php
			if ( bon_get_option( 'show_header_search', 'yes' ) == 'yes' ) {
				$no_search = '';
				?>
				<div class="searchform-container">
					<?php shandora_get_searchform( 'header' ); ?>
				</div>
				<?php } ?>
				<div class="nav-block <?php echo $no_search; ?>">
					<?php bon_get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template.           ?>
				</div>
				<?php //<div class="header-toggler hide-for-small"><div class="toggler-button"></div></div>           ?>
			</hgroup>

			<?php
		}

	}

	if ( !function_exists( 'shandora_get_custom_header' ) ) {

		function shandora_get_custom_header() {
			if ( !shandora_is_home() ) :
				?>
			<div id="header-background" class="show-for-medium-up"></div>
			<?php elseif ( shandora_is_home() && bon_get_option( 'show_slider', 'show' ) == 'hide' ) :
			?>
			<div id="header-background" class="show-for-medium-up"></div>
			<?php
			endif;
		}

	}

	if ( !function_exists( 'shandora_get_footer' ) ) {


		function shandora_get_footer() {
			$header_col_2 = bon_get_option( 'enable_header_col_2' );
			?>
			<div id="action-compare" class="action-compare" data-count="0" data-compare=""></div>

			<?php
			// scroll to top button
			shandora_scroll_top_button();
			// render wordpress footer
			wp_footer();
			// render modal with visit request
			bon_get_template_part( 'block', 'block-modal-' . bon_get_option( 'form_type' ) . '-request' );
			// render modal with newsletter
			if ( bon_get_option( 'newsletter_modal' ) ) {
				bon_get_template_part( 'block', 'block-modal-newsletter' );
			}
			// render disqus comments count if they are enabled
			if ( is_singular() && bon_get_option( 'enable_disqus' ) ) {
				bon_get_template_part( 'block', 'block-disqus-comment-count' );
			}
			?>

		</body>
		</html>
		<?php
	}

}

if ( !function_exists( 'shandora_get_footer_backtop' ) ) {


	function shandora_get_footer_backtop() {
		?>

		<a href="#totop" class="backtop circle" id="backtop" title="<?php _e( 'Back to Top', 'bon' ); ?>"><i class="icon bonicons bi-chevron-up"></i></a>

		<?php
	}

}

if ( !function_exists( 'shandora_get_footer_widget' ) ) {



	function shandora_get_footer_widget() {
		?>
		<div class="footer-widgets footer-inner">

			<div class="container">

				<div class="row">

					<?php for ( $i = 1; $i <= 4; $i++ ) { ?>

					<div id="footer-widget-<?php echo $i; ?>" class="column small-11 small-centered medium-3 medium-uncentered">

						<?php if ( is_active_sidebar( 'footer' . $i ) ) : ?>

						<?php dynamic_sidebar( 'footer' . $i ); ?>

					<?php else : ?>

					<!-- This content shows up if there are no widgets defined in the backend. -->

					<p><?php _e( "Please activate some Widgets.", "framework" ); ?></p>

				<?php endif; ?>

			</div>

			<?php } ?>

		</div>

	</div>

</div>

<?php
}

}

if ( !function_exists( 'shandora_get_footer_copyright' ) ) {


	function shandora_get_footer_copyright() {
		?>
		<div class="footer-copyright footer-inner">

			<div class="container">

				<div class="row">
					<div class="column large-12 footer-column"><div class="row">
						<div id="social-icon-footer" class="large-4 column large-uncentered small-11 small-centered">
							<?php
							$enable_footer_social = bon_get_option( 'enable_footer_social', 'yes' );

							if ( $enable_footer_social == 'yes' ) {
								shandora_get_social_icons( false );
							} else if ( $enable_footer_social != 'yes' && function_exists( 'icl_get_languages' ) ) {
								echo '<nav><ul id="footer-social-icons" class="social-icons">' . shandora_get_country_selection() . '</ul></nav>';
							} else {
								echo "&nbsp;";
							}
							?>

						</div>

						<div id="copyright-text" class="large-8 column large-uncentered small-11 small-centered">
							<div><?php echo bon_get_option( 'footer_copyright', apply_atomic_shortcode( 'footer_content', '<div class="credit">' . __( 'Copyright &copy; [the-year] [site-link]. Powered by [theme-link].', 'bon' ) . '</div>' ) ); ?></div>
						</div>
					</div></div>
				</div>

			</div>

		</div>
		<?php
	}

}

add_filter( 'body_class', 'shandora_filter_body_class' );

function shandora_filter_body_class( $classes ) {

	global $post;

	if ( !isset( $post->ID ) ) {
		return $classes;
	}
	$id = $post->ID;

	$class = shandora_get_meta( $id, 'slideshow_type' );

	if ( !empty( $class ) && shandora_is_home() && bon_get_option( 'show_slider', 'show' ) == 'show' ) {
		$class = 'slider-' . $class;
		$classes[] = $class;
	} else {
		if ( shandora_is_home() && bon_get_option( 'show_slider', 'show' ) == 'show' ) {
			$classes[] = 'slider-full';
		}
	}

	return $classes;
}

function shandora_is_home() {
	if ( is_page_template( 'page-templates/page-template-home.php' ) || is_front_page() ) {
		return true;
	}

	return false;
}

function shandora_scroll_top_button() {
	echo '<a id="scroll-top" class="backtop" href="#totop"><i class="bonicons bi-chevron-up"></i></a>';
}

// Added by Lech Dutkiewicz
// source: https://pippinsplugins.com/retrieve-attachment-id-from-image-url/

function pippin_get_image_id( $image_url ) {
	global $wpdb;
	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
	if ( isset($attachment) && array_key_exists(0, $attachment) ) {
		return $attachment[0];
	} else {
		return;
	}
}

function get_package_details( $id, $package_prefix ) {

	$output = array(
		shandora_get_meta($id, $package_prefix . '_price', true) => __( 'Price', 'bon' ),
		shandora_get_meta($id, $package_prefix . '_material') => __( 'Wall material', 'bon' ),
		shandora_get_meta($id, $package_prefix . '_wall_thickness', true) => __( 'Wall thickness', 'bon' ),
		shandora_get_meta($id, $package_prefix . '_windows_thickness', true) => __( 'Windows thickness', 'bon' )
		);

	return ($output);
}

function get_packages_details( $id, $package_prefix, $package ) {

	$heightmeasurement = bon_get_option( 'height_measure' );

	$output = array(
		shandora_get_price_meta( NULL, shandora_get_meta($id, sanitize_title( $package_prefix ) . '_price', true) ) => __( 'Price', 'bon' ),
		$package['package_material'] => __( 'Wall material', 'bon' ),
		$package['package_wall_thickness'] . ' ' . strtolower($heightmeasurement) => __( 'Wall thickness', 'bon' ),
		$package['package_windows_thickness'] . ' ' . strtolower($heightmeasurement) => __( 'Windows thickness', 'bon' )
		);

	return $output;

}

function packages_details( $id, $package_prefix, $name = NULL ) {

	if ( $name !== NULL ) {

		$details = bon_get_option( 'cottage_packages' );

		foreach ( $details as $key => $detail ) {

			if ( $detail['package_name'] !== $name )
				continue;

			$detailMeta = get_packages_details( $id, $package_prefix, $detail );

			foreach ( $detailMeta as $value => $name ) { ?>

			<li>
				<strong><?php echo $name; ?></strong>
				<span><?php echo $value; ?></span>
			</li>

			<?php }
		}

	}

}

if ( !function_exists( 'override_page_title' ) ) {

	function override_page_title() {

		return false;

	}

}

if ( !function_exists( 'get_slider_thumbnails' ) ) {

	function get_slider_thumbnails( $loop ) { ?>

	<div id="testimonials-pager">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<a href="#" data-slide-index="<?php echo $loop->current_post; ?>"><?php echo $loop->current_post + 1; ?></a>
	<?php endwhile; ?>
</div>

<?php }

}

if ( !function_exists( 'open_testimonials_slider_container' ) ) {

	function open_testimonials_slider_container() { ?>

	<div class="row padding-large top bottom clearfix">
		<div class="column large-12 testimonials-slider-container">
			<div id="testimonials-slider">

				<?php }

			}

			if ( !function_exists( 'open_testimonials_slider' ) ) {

				function open_testimonials_slider( $loop ) { ?>

				<ul class="slides testimonial-slides <?php if ( $loop->post_count > 1 ) { echo $_SESSION['layoutType'] !== 'mobile' ? 'bxslider-thumbs-only autostart' : 'bxslider-no-thumb-no-controls autostart'; } ?>"<?php if ( $loop->post_count > 1 ) { echo 'data-pause="8000" data-pager="testimonials-pager"'; } ?>>

					<?php }

				}

				if ( !function_exists( 'close_testimonials_slider' ) ) {

					function close_testimonials_slider() { ?>

				</ul>

				<?php }

			}

			if ( !function_exists( 'close_testimonials_slider_container' ) ) {

				function close_testimonials_slider_container() { ?>

			</div>
		</div>
	</div>

	<?php }

}

if ( !function_exists( 'render_single_testimonial' ) ) {

	function render_single_testimonial( $post ) { ?>

	<li>
		<div class="testimonial-container">
			<div class="row">
				<?php if ( shandora_is_home() ) : ?>
				<div class="column large-2 blank"></div>
			<?php endif; ?>
			<div class="testimonial column large-<?php echo shandora_is_home() ? '8' : '12'; ?><?php echo $_SESSION['layoutType'] !== 'mobile' ? ' text-center' : ''; ?>">
				<i class="bonicons bi-quote-left"></i><span><?php echo shandora_get_meta( $post->ID, 'testimonial' ); ?></span><i class="bonicons bi-quote-right"></i>
			</div>	
			<?php if ( shandora_is_home() ) : ?>
			<div class="column large-2 blank"></div>
		<?php endif; ?>
	</div>
	<div class="row">			
		<?php if ( shandora_is_home() ) : ?>				
		<div class="column large-2 blank"></div>
	<?php endif; ?>
	<div class="testimonial-author column large-<?php echo shandora_is_home() ? '8' : '12'; ?> text-right<?php if ( current_theme_supports( 'get-the-image' ) && $imgID = shandora_get_meta( $post->ID, 'user_img' ) ) echo ' has-img'; ?>">
		<span><?php echo shandora_get_meta( $post->ID, 'full_name' ); ?><?php if ( current_theme_supports( 'get-the-image' ) && $imgID = shandora_get_meta( $post->ID, 'user_img' ) ) get_the_image( array( 'post_id' => $imgID, 'size' => 'user_small', 'link_to_post' => false, 'image_class' => array( 'circle', 'auto' ) ) ); ?></span>
		<?php
		if ( $post->post_content != "" && !is_singular( 'testimonial' ) ) {
			?>
			<div class="testimonial-link">
				<a href="<?php echo get_permalink(); ?>"><?php _e( 'Read full story', 'bon' ); ?></a>
			</div>
			<?php } ?>
		</div>
		<?php if ( shandora_is_home() ) : ?>
		<div class="column large-2 blank"></div>
	<?php endif; ?>
</div>
</div>
</li>

<?php }

}

if ( !function_exists( 'shandora_get_testimonial' ) ) {

	function shandora_get_testimonial( $loop, $post ) {

		open_testimonials_slider( $loop );
		render_single_testimonial( $post );
		close_testimonials_slider();

	}

}

if ( !function_exists( 'shandora_sanitize_content' ) ) {

	function shandora_sanitize_content( $content ) {

		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		echo $content;

	}

}

if ( !function_exists( 'shandora_get_banner_opening_tag' ) ) {

	function shandora_get_banner_opening_tag( $name ) {

		$page = bon_get_option( $name . '_slide_page' );
		$destination_page = bon_get_option( $name . '_slide_page_destination' );
		$tool = bon_get_option( $name . '_slide_tool' );
		$modal = bon_get_option( $name . '_slide_modal' );
		$destination_modal = bon_get_option( $name . '_slide_modal_destination' );
		$output = '';

		if ( $page && $destination_page ) {
			$output .= '<a href="' . get_the_permalink( $destination_page ) . '" class="hover-mask" title="' . __( 'Link to ', 'bon') . get_the_title( $destination_page) . '"' . get_ga_event( "Banners", "Click", "FAQ Banner" ) . '>';
			return $output;
		}

		if ( $tool ) {

			$link = bon_get_option( 'tool_section_cta_link_url' );

			if ( $link != "" ) {

				$onClick = 'onclick="window.open(\'' . $link . '\', \'VPWindow\', \'width=1024,height=768,toolbar=0,resizable=1,scrollbars=1,status=0,location=0\'); return false;"';

				$output .= "<a href='$link' data-function='open-tool' class='hover-mask' $onClick " . get_ga_event( array( "Banners", "Click", "Tool Banner" ), array( "Customize", "Open Tool" ) ) . ">";
				return $output;
			}

		}

		if ( $modal && $destination_modal ) {

			$output .= "<a href='#" . $destination_modal . "-modal' role='button' data-toggle='modal' class='hover-mask' title='" . __( 'Open window with more information', 'bon') . "'" . get_ga_event( "Banners", "Click", "Quality Banner" ) . ">";
			return $output;

		}

	}

}

if ( !function_exists( 'shandora_get_banner_closing_tag' ) ) {

	function shandora_get_banner_closing_tag( $name ) {

		$page = bon_get_option( $name . '_slide_page');
		$destination_page = bon_get_option( $name . '_slide_page_destination');
		$tool = bon_get_option( $name . '_slide_tool');
		$modal = bon_get_option( $name . '_slide_modal');
		$destination_modal = bon_get_option( $name . '_slide_modal_destination');
		$output = '';

		if ( ( bon_get_option( $name . '_slide_page') && $destination_page ) || $tool || ( $modal && $destination_modal ) ) {
			$output .= '</a>';
			echo $output;
		}

	}

}

if ( !function_exists( 'get_modal' ) ) {

	function get_modal( $name ) {

		$modal = bon_get_option( $name . '_slide_modal');
		$destination_modal = bon_get_option( $name . '_slide_modal_destination');

		if ( $modal && $destination_modal ) {

			bon_get_template_part( 'block', 'block-modal-' . $destination_modal );

		}

	}

}

if ( !function_exists( 'shandora_get_content_color' ) ) {

	function shandora_get_content_color() {
		global $post;
		$term_meta = wp_get_post_terms( $post->ID, 'category' ); //get post term meta
		$ex_class = $term_meta[0]->slug; // get first term slug
		$post_taxonomies = get_terms( 'category', array( 'slug' => $ex_class ) ); // get term from all terms that equals chosen slug
		$color = get_option( "taxonomy_$color" ); // get taxonomy color
		$color = $color['color']; // save color name as varialbe

		return $color;
	}

}

