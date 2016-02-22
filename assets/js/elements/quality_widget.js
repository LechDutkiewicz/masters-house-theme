(function($) {

	var bubbleHouse = {

		args: {
			container: $('#quality-container'),
			dots: $('#quality-container .quality-icon'),
			descriptionsContainer: $('#quality-container .desc-container')
		},
		init: function() {
			bubbleHouse.placeDots();
			bubbleHouse.bindClickEvents();
			bubbleHouse.onResize();
		},
		placeDots: function() {

			var width = bubbleHouse.args.container.width();

			if ( width >= 940 ) {
				bubbleHouse.args.dots.each(function() {
					$(this).css({
						'top'	:$(this).data('top') + "%",
						'left'	:$(this).data('left') + "%",
						'opacity'	: 1
					});
				});
			} else if ( width >= 520 ) {
				bubbleHouse.args.dots.each(function() {
					$(this).css({
						'top'	:$(this).data('top') + "%",
						'left'	:$(this).data('left') + "%",
						'opacity'	: 1
					});
				});
			}
		},
		bindClickEvents: function() {

			bubbleHouse.args.dots.click(function(){

				var target = $(this).data('target');
				
				bubbleHouse.args.container.find('.click-arrow').hide();
				bubbleHouse.args.descriptionsContainer.find('.active .description-img').fadeOut(500, function(){

					bubbleHouse.args.descriptionsContainer.find('.active').fadeOut(500, function(){

						var chosenItem = bubbleHouse.args.descriptionsContainer.find("[data-target='" + target + "']");

						$(this).removeClass('active');
						if ( !chosenItem.hasClass('active') ) {
							chosenItem.fadeIn(500, function(){
								chosenItem.find('.description-img').fadeIn();	
							}).addClass('active');
						}
					});
				});
			});
		},
		onResize: function() {
			$(window).resize(function(){
				bubbleHouse.placeDots();
			});
		},

	};

	$(document).ready(function(){
		bubbleHouse.init();
	});

	/* End of modal with quality description */

})(jQuery);