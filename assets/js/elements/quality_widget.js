(function($) {

	var placeDots = function(dots) {

		width = container.width();

		if ( width >= 940 ) {

			dots.each(function() {
				$(this).css({
					'top'	:$(this).data('top') + "%",
					'left'	:$(this).data('left') + "%",
				});
			});

		} else if ( width >= 520 ) {

			dots.each(function() {
				$(this).css({
					'top'	:$(this).data('top') + "%",
					'left'	:$(this).data('left') + "%",
				});
			});

		}

	};

	/* Modal with quality description */
	var container = $('#quality-modal'),
	dots = $('.quality-icon', container),
	descriptionsContainer = $('.desc-container', container);

	$('#quality-modal').on('opened.fndtn.reveal', function() {
		placeDots(dots);
	});

	$(window).resize(function(){
		placeDots(dots);
	});

	// dots.hover(function(){
	// 	$(this).toggleClass('active').find('.icon-desc-container').fadeIn();
	// }, function(){
	// 	$(this).toggleClass('active').find('.icon-desc-container').hide();
	// });

	dots.click(function(){
		
		container.find('.click-arrow').hide();

		var target = $(this).data('target');
		descriptionsContainer.find('.active .description-img').fadeOut(500, function(){

			descriptionsContainer.find('.active').fadeOut(500, function(){

				$(this).removeClass('active');

				var chosenItem = descriptionsContainer.find("[data-target='" + target + "']");
				if ( !chosenItem.hasClass('active') ) {
					chosenItem.fadeIn(500, function(){
						chosenItem.find('.description-img').fadeIn();	
					}).addClass('active');
				}

			});

		});
	});

	/* End of modal with quality description */

})(jQuery);