/*
*
*	WAYPOINTS
*
*/

(function($) {

	var startWaypoint = function(selector) {

		var waypoint = new Waypoint({
			element: selector,
			handler: function() {
				$('.service-container').each(function(k){
					var el = $(this),
					animation;

					if ( k%2 === 1) {
						animation = 'bounceInRight';
					} else {
						animation = 'bounceInLeft';
					}

					setTimeout(function () {
						el.addClass('animated ' + animation).css({
							'opacity': 1
						}, 1000).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
							el.find('.like-h4').addClass('animated zoomIn').css({
								'opacity': 1
							});
						});
					}, k * 1000 );
				});
			},
			offset: $(window).height() / 4
		});

	};

// Animation for services container

var servicesContainer = document.getElementsByClassName('services-container');

if ( servicesContainer.length > 0 ) {

	startWaypoint( servicesContainer );

}

})(jQuery);