(function($) {

var launchGoogleEvents = function() {

	var googleElements = {
		5: {
			category: 'Home_CTA',
			action: 'top_browse_all',
			selector: $('.home-ctas-container.top a[data-function="browse-all"]'),
		},
		10: {
			category: 'Home_CTA',
			action: 'top_open_tool',
			selector: $('.home-ctas-container.top a[data-function="open-tool"]'),
		},
		11: {
			category: 'Home_CTA',
			action: 'top_request_visit',
			selector: $('.home-ctas-container.top a[data-function="request-visit"]'),
		},
		15: {
			category: 'Home_CTA',
			action: 'bottom_browse_all',
			selector: $('.home-ctas-container.bottom a[data-function="browse-all"]'),
		},
		20: {
			category: 'Home_CTA',
			action: 'bottom_open_tool',
			selector: $('.home-ctas-container.bottom a[data-function="open-tool"]'),
		},
		21: {
			category: 'Home_CTA',
			action: 'bottom_request_visit',
			selector: $('.home-ctas-container.bottom a[data-function="request-visit"]'),
		},
		25: {
			category: 'Home_products',
			action: 'click',
			selector: $('#featured-listing-slider a.product-link'),
		},
		30: {
			category: 'Home_products_navi',
			action: 'click',
			selector: $('#featured-listing-slider .bx-controls-direction a'),
		},
		35: {
			category: 'Header_click',
			action: 'request_a_visit',
			selector: $('#main-header .phone.visit'),
			label: document.title
		},
		40: {
			category: 'Header_click',
			action: 'phone',
			selector: $('#main-header .phone.phone-1'),
			label: document.title
		},
		/* Category pages */
		45: {
			category: 'Category_list',
			action: 'switch_view',
			selector: $('a.view-grid, a.view-list'),
		},
		50: {
			category: 'Category_list',
			action: 'filter',
			selector: $('.search-order ul li'),
		},
		55: {
			category: 'Sidebar',
			action: 'search_cottages',
			selector: $('#search-listing-form input[type="submit"]'),
		},
		60: {
			category: 'Sidebar',
			action: 'click_social_media_profile',
			selector: $('.bon-toolkit-social-widget a'),
			label: $('.bon-toolkit-social-widget a').attr('title')
		},
		65: {
			category: 'Sidebar',
			action: 'click_featured_listing',
			selector: $('.widget.featured-listing .featured-item a'),
		},
		/* Single product pages */
		70: {
			category: 'Buy_cottage',
			action: 'click_top_cta',
			selector: $('.top-cta a.cta'),
			label: $('h1.entry-title').html(),
			value: Math.floor($('span[itemprop="price"]').attr('data-value') / 60),
		},
		75: {
			category: 'Buy_cottage',
			action: 'click_bottom_cta',
			selector: $('.bottom-cta a.cta'),
			label: $('h1.entry-title').html(),
			value: Math.floor($('span[itemprop="price"]').attr('data-value') / 60),
		},
		76: {
			category: 'Buy_cottage',
			action: 'click_customize_cta',
			selector: $('.customize a.cta'),
			label: $('h1.entry-title').html(),
			value: Math.floor($('span[itemprop="price"]').attr('data-value') / 60),
		},
		79: {
			category: 'Contact_form',
			action: 'customize_from_product_page',
			selector: $('#customize-modal form'),
			label: $('h1.entry-title').html(),
		},
		80: {
			category: 'Contact_form',
			action: 'from_product_page',
			selector: $('.listing-contact form, #contact-modal form'),
			label: $('h1.entry-title').html(),
			//value: $('span[itemprop="price"]').attr('data-value'),
		},
		81: {
			category: 'Contact_form',
			action: 'visit_request',
			selector: $('#visit-modal form'),
			label: $('h1.entry-title').html(),
		},
		84: {
			category: 'Customization_section',
			action: 'show_more',
			selector: $('a[aria-controls="customizeCollapse"]'),
		},
		85: {
			category: 'Open_faq',
			action: 'on_product_page',
			selector: $('a[aria-controls="faqCollapse"]'),
		},
		90: {
			category: 'Product_page_related',
			action: 'click',
			selector: $('.listings.related .product-link'),
		},
		95: {
			category: 'Product_page_additional_information',
			action: 'switch_specification_tabs',
			selector: $('.entry-specification .tab-nav a'),
		},
		100: {
			category: 'Product_page_additional_information',
			action: 'click_additional_services',
			selector: $('.entry-specification #accordion-services .accordion-section-title'),
		},
		105: {
			category: 'Contact_form',
			action: 'from_about_us_page',
			selector: $('#tab-target-contact form'),
		},
		110: {
			category: 'Open_faq',
			action: 'on_about_us_page',
			selector: $('#detail-tab .tab-nav a[href="#tab-target-faq"]'),
		},
		115: {
			category: 'Blog_page',
			action: 'use_gallery_nav',
			selector: $('.blog article .carousel-control'),
		},
		120: {
			category: 'Blog_page',
			action: 'launch_video',
			selector: $('.blog article iframe .html5-video-content'),
		},
		125: {
			category: 'Blog_page',
			action: 'choose_category',
			selector: $('.blog article .entry-post-meta a[ref="category"]'),
		},
		130: {
			category: 'Blog_page',
			action: 'choose_category_from_sidebar',
			selector: $('.blog .sidebar .widget_categories .cat-item a'),
		},
		135: {
			category: 'Blog_page',
			action: 'choose_tag',
			selector: $('.blog article .entry-footer .entry-tag a'),
		},
		140: {
			category: 'Blog_page',
			action: 'single_post_navigation',
			selector: $('.blog .loop-nav a'),
		},
		145: {
			category: 'Share',
			action: 'social-media-profile',
			selector: $('.social-share-button-container a'),
			label: $('h1.entry-title').html(),			
		},
		150: {
			category: 'Web tool',
			action: 'open',
			selector: $('a[data-function="open-tool"'),
			label: $('h1.entry-title').html(),		
		},
	};

	// fetch Google Analytics events from html data attributes
	var analyticsEvents = $('[data-analytics-category]');
	analyticsEvents.each(function(k){
		googleElements[200+k] = {
			category: $(this).data('analytics-category'),
			action: $(this).data('analytics-action'),
			selector: $('[data-analytics-selector="' + $(this).data('analytics-selector') + '"]')
		};
	});

	$.each(googleElements, function() {

		var event = this;

		if ( event.selector ) {

			if ( event.category === 'Contact_form' ) {
				$(event.selector.selector).submit(function() {
					if (event.label) {
						if (event.value) {
							ga( 'send', 'event', event.category, event.action, event.label, event.value );	
						} else {
							ga( 'send', 'event', event.category, event.action, event.label );	
						}
					} else {
						if (event.value) {
							ga( 'send', 'event', event.category, event.action, NULL, event.value );	
						} else {
							ga( 'send', 'event', event.category, event.action );	
						}		
					}
				});
			} else {
				$(event.selector.selector).bind( 'click', function() {
					if (event.label) {
						if (event.value) {
							ga( 'send', 'event', event.category, event.action, event.label, event.value );	
						} else {
							if (event.action === 'social-media-profile') {
								ga( 'send', 'event', event.category, $(this).attr('class'), event.label );
							} else {
								ga( 'send', 'event', event.category, event.action, event.label );							
							}
						}
					} else {
						if (event.value) {
							ga( 'send', 'event', event.category, event.action, NULL, event.value );	
						} else {
							ga( 'send', 'event', event.category, event.action );	
						}			
					}
				});
			}

		}
	});

 function gaTimeout() {
 	return ("ga( 'send', 'event', '40_seconds', 'read' )");
 }

 setTimeout(gaTimeout(), 40000);

};

$(launchGoogleEvents);

})(jQuery);