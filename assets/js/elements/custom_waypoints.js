/*
*
*	WAYPOINTS
*
*/

(function($) {

	var startWaypoint = function(selector) {

		var bannersSlider = $("#banners-slider");
		var difference = 0;

		if ( bannersSlider )
		{
			// fix offset position of there is banners slider on the page, which affects window height
			var imgHeight = bannersSlider.find('img').height(),
			sliderHeight = bannersSlider.height();
			difference = sliderHeight - imgHeight;
		}

		var waypoint = new Waypoint({
			element: selector,
			handler: function() {
				$('.service-container').each(function(k){
					var el = $(this);

					setTimeout(function () {
						el.find('.like-h4').addClass('animated bounceIn').css({
							'opacity': 1
						});
					}, k * 1000 );
				});
			},
			offset: $(window).height() / 1.5 + difference
		});

	};

// Animation for services container

var servicesContainer = document.getElementById('services-container');

if ( servicesContainer ) {

	startWaypoint( servicesContainer );

}

})(jQuery);