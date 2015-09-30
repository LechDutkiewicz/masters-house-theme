(function($) {

	var slidebox = $('#slidebox');

	$(window).scroll(function() {

		$.doTimeout( 'scroll', 250, function(){

			var distanceTop = ( $(document).height() / 4 ) - $(window).height(),
			slideboxHeight = slidebox.outerHeight();

			if ($(window).scrollTop() > distanceTop)
				slidebox.animate({
					'bottom': '0px'
				}, 400);
			else
				slidebox.stop(true).animate({
					'bottom': - slideboxHeight
				}, 400);

		});

	});

	slidebox.find('.slidebox-close').bind('click', function() {

		if ( slidebox.hasClass('hidden') ) {
			$.cookie('slidebox', 0, {
				path: '/',
				expires: 7
			});
		} else {
			$.cookie('slidebox', 1, {
				path: '/',
				expires: 7
			});
		}
		
		var slideboxHeight = slidebox.outerHeight(),
		icons = slidebox.find('.bonicons');

		slidebox.animate({
			'bottom': - slideboxHeight
		}, 400, function(){
			$(this).toggleClass('hidden');
			icons.each(function(){
				if ( $(this).hasClass('bi-chevron-down') ) {
					$(this).removeClass('bi-chevron-down').addClass('bi-chevron-up');
				} else {
					$(this).removeClass('bi-chevron-up').addClass('bi-chevron-down');
				}
			});
			$(this).animate({
				'bottom': '0px'
			}, 400);
		});
	});

})(jQuery);