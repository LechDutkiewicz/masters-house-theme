(function($) {

	var launchGoogleEvents = function() {

	// var googleElements = {
	// 	25: {
	// 		category: 'Home_products',
	// 		action: 'click',
	// 		selector: $('#featured-listing-slider a.product-link'),
	// 	},
	// 	30: {
	// 		category: 'Home_products_navi',
	// 		action: 'click',
	// 		selector: $('#featured-listing-slider .bx-controls-direction a'),
	// 	},
	// 	35: {
	// 		category: 'Header_click',
	// 		action: 'request_a_visit',
	// 		selector: $('#main-header .phone.visit'),
	// 		label: document.title
	// 	},
	// 	40: {
	// 		category: 'Header_click',
	// 		action: 'phone',
	// 		selector: $('#main-header .phone.phone-1'),
	// 		label: document.title
	// 	},
	// 	/* Category pages */
	// 	45: {
	// 		category: 'Category_list',
	// 		action: 'switch_view',
	// 		selector: $('a.view-grid, a.view-list'),
	// 	},
	// 	50: {
	// 		category: 'Category_list',
	// 		action: 'filter',
	// 		selector: $('.search-order ul li'),
	// 	},
	// 	55: {
	// 		category: 'Sidebar',
	// 		action: 'search_cottages',
	// 		selector: $('#search-listing-form input[type="submit"]'),
	// 	},
	// 	60: {
	// 		category: 'Sidebar',
	// 		action: 'click_social_media_profile',
	// 		selector: $('.bon-toolkit-social-widget a'),
	// 		label: $('.bon-toolkit-social-widget a').attr('title')
	// 	},
	// 	65: {
	// 		category: 'Sidebar',
	// 		action: 'click_featured_listing',
	// 		selector: $('.widget.featured-listing .featured-item a'),
	// 	},
	// 	/* Single product pages */
	// 	70: {
	// 		category: 'Buy_cottage',
	// 		action: 'click_top_cta',
	// 		selector: $('.top-cta a.cta'),
	// 		label: $('h1.entry-title').html(),
	// 		value: Math.floor($('span[itemprop="price"]').attr('data-value') / 60),
	// 	},
	// 	75: {
	// 		category: 'Buy_cottage',
	// 		action: 'click_bottom_cta',
	// 		selector: $('.bottom-cta a.cta'),
	// 		label: $('h1.entry-title').html(),
	// 		value: Math.floor($('span[itemprop="price"]').attr('data-value') / 60),
	// 	},
	// 	76: {
	// 		category: 'Buy_cottage',
	// 		action: 'click_customize_cta',
	// 		selector: $('.customize a.cta'),
	// 		label: $('h1.entry-title').html(),
	// 		value: Math.floor($('span[itemprop="price"]').attr('data-value') / 60),
	// 	},
	// 	79: {
	// 		category: 'Contact_form',
	// 		action: 'customize_from_product_page',
	// 		selector: $('#customize-modal form'),
	// 		label: $('h1.entry-title').html(),
	// 	},
	// 	80: {
	// 		category: 'Contact_form',
	// 		action: 'from_product_page',
	// 		selector: $('.listing-contact form, #contact-modal form'),
	// 		label: $('h1.entry-title').html(),
	// 	},
	// 	81: {
	// 		category: 'Contact_form',
	// 		action: 'visit_request',
	// 		selector: $('#visit-modal form'),
	// 		label: $('h1.entry-title').html(),
	// 	},
	// 	84: {
	// 		category: 'Customization_section',
	// 		action: 'show_more',
	// 		selector: $('a[aria-controls="customizeCollapse"]'),
	// 	},
	// 	85: {
	// 		category: 'Open_faq',
	// 		action: 'on_product_page',
	// 		selector: $('a[aria-controls="faqCollapse"]'),
	// 	},
	// 	90: {
	// 		category: 'Product_page_related',
	// 		action: 'click',
	// 		selector: $('.listings.related .product-link'),
	// 	},
	// 	95: {
	// 		category: 'Product_page_additional_information',
	// 		action: 'switch_specification_tabs',
	// 		selector: $('.entry-specification .tab-nav a'),
	// 	},
	// 	100: {
	// 		category: 'Product_page_additional_information',
	// 		action: 'click_additional_services',
	// 		selector: $('.entry-specification #accordion-services .accordion-section-title'),
	// 	},
	// 	105: {
	// 		category: 'Contact_form',
	// 		action: 'from_about_us_page',
	// 		selector: $('#tab-target-contact form'),
	// 	},
	// 	110: {
	// 		category: 'Open_faq',
	// 		action: 'on_about_us_page',
	// 		selector: $('#detail-tab .tab-nav a[href="#tab-target-faq"]'),
	// 	},
	// 	115: {
	// 		category: 'Blog_page',
	// 		action: 'use_gallery_nav',
	// 		selector: $('.blog article .carousel-control'),
	// 	},
	// 	120: {
	// 		category: 'Blog_page',
	// 		action: 'launch_video',
	// 		selector: $('.blog article iframe .html5-video-content'),
	// 	},
	// 	125: {
	// 		category: 'Blog_page',
	// 		action: 'choose_category',
	// 		selector: $('.blog article .entry-post-meta a[ref="category"]'),
	// 	},
	// 	130: {
	// 		category: 'Blog_page',
	// 		action: 'choose_category_from_sidebar',
	// 		selector: $('.blog .sidebar .widget_categories .cat-item a'),
	// 	},
	// 	135: {
	// 		category: 'Blog_page',
	// 		action: 'choose_tag',
	// 		selector: $('.blog article .entry-footer .entry-tag a'),
	// 	},
	// 	140: {
	// 		category: 'Blog_page',
	// 		action: 'single_post_navigation',
	// 		selector: $('.blog .loop-nav a'),
	// 	},
	// 	145: {
	// 		category: 'Share',
	// 		action: 'social-media-profile',
	// 		selector: $('.social-share-button-container a'),
	// 		label: $('h1.entry-title').html(),			
	// 	},
	// 	150: {
	// 		category: 'Web tool',
	// 		action: 'open',
	// 		selector: $('a[data-function="open-tool"'),
	// 		label: $('h1.entry-title').html(),		
	// 	},
	// };

	var googleElements = [];

	// bind Google Analytics Event to selector or array of selectors
	var bindEvent = function( el ) {

		if ( typeof ga == 'function' )
		{

			el.bind( 'click', function(){

				var eventDescription = {'hitType' : 'event'};

				if ( Array.isArray( el.eventCategory ) )
				{
					for ( i = 0; i < el.eventCategory.length; i++ )
					{

						eventDescription = {'hitType' : 'event'};

						if ( el.eventCategory && el.eventCategory[i] ) { eventDescription.eventCategory = el.eventCategory[i]; }
						if ( el.eventAction && el.eventAction[i] ) { eventDescription.eventAction = el.eventAction[i]; }
						if ( el.eventLabel && el.eventLabel[i] ) { eventDescription.eventLabel = el.eventLabel[i]; }
						if ( el.eventValue && el.eventValue[i] ) { eventDescription.eventValue = el.eventValue[i]; }

						ga( 'send', eventDescription );

					}

				} else
				{

					if ( el.eventCategory ) eventDescription.eventCategory = el.eventCategory;
					if ( el.eventAction ) eventDescription.eventAction = el.eventAction;
					if ( el.eventLabel ) eventDescription.eventLabel = el.eventLabel;
					if ( el.eventValue ) eventDescription.eventValue = el.eventValue;

					ga( 'send', eventDescription );

				}

			});

}
}

	// fetch Google Analytics Events data from html data attributes and bind js Events to them
	var analyticsEvents = $('[data-ga-cat]');

	analyticsEvents.each(function(k){

		el = $(this);

		el.eventCategory = el.data('ga-cat');
		el.eventAction = el.data('ga-act');
		el.eventLabel = el.data('ga-lbl');

		if ( el.data('ga-val') )
		{
			el.eventValue = parseInt( el.data('ga-val') );
		}

		// add element to array of registered Google Analytics Events
		googleElements.push(el);

		$(bindEvent(el));

	});

	// $.each(googleElements, function() {

	// 	var event = this;

	// 	if ( event.selector ) {

	// 		if ( event.category === 'Contact_form' ) {
	// 			$(event.selector.selector).submit(function() {
	// 				if (event.label) {
	// 					if (event.value) {
	// 						ga( 'send', 'event', event.category, event.action, event.label, event.value );	
	// 					} else {
	// 						ga( 'send', 'event', event.category, event.action, event.label );	
	// 					}
	// 				} else {
	// 					if (event.value) {
	// 						ga( 'send', 'event', event.category, event.action, NULL, event.value );	
	// 					} else {
	// 						ga( 'send', 'event', event.category, event.action );	
	// 					}		
	// 				}
	// 			});
	// 		} else {
	// 			$(event.selector.selector).bind( 'click', function() {
	// 				if (event.label) {
	// 					if (event.value) {
	// 						ga( 'send', 'event', event.category, event.action, event.label, event.value );	
	// 					} else {
	// 						if (event.action === 'social-media-profile') {
	// 							ga( 'send', 'event', event.category, $(this).attr('class'), event.label );
	// 						} else {
	// 							ga( 'send', 'event', event.category, event.action, event.label );							
	// 						}
	// 					}
	// 				} else {
	// 					if (event.value) {
	// 						ga( 'send', 'event', event.category, event.action, NULL, event.value );	
	// 					} else {
	// 						ga( 'send', 'event', event.category, event.action );	
	// 					}			
	// 				}
	// 			});
	// 		}

	// 	}
	// });

function gaTimeout() {
	return ("ga( 'send', 'event', 'Bounce Rate Optimizer', 'Benn on the page at least 40 seconds' )");
}

setTimeout(gaTimeout(), 40000);

};

$(launchGoogleEvents);

})(jQuery);