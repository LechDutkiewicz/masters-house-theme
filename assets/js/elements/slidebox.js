(function($) {

	var slidebox = $('#slidebox');

	$(window).scroll(function() {

		$.doTimeout( 'scroll', 250, function(){

			var distanceTop = ( $(document).height() / 4 ) - $(window).height();

			if ($(window).scrollTop() > distanceTop)
				slidebox.animate({
					'bottom': '0px'
				}, 200, 'easeInOutCirc');
			else
				slidebox.stop(true).animate({
					'bottom': - slidebox.outerHeight()
				}, 200, 'easeInOutCirc');

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
		
		var icons = slidebox.find('.bonicons');

		slidebox.animate({
			'bottom': - slidebox.outerHeight()
		}, 200, 'easeInOutCirc', function(){
			$(this).toggleClass('hidden').css({
				'bottom': - slidebox.outerHeight()
			});
			icons.each(function(){
				if ( $(this).hasClass('bi-chevron-down') ) {
					$(this).removeClass('bi-chevron-down').addClass('bi-chevron-up');
				} else {
					$(this).removeClass('bi-chevron-up').addClass('bi-chevron-down');
				}
			});
			$(this).animate({
				'bottom': '0px'
			}, 200, 'easeInOutCirc');
		});
	});

})(jQuery);