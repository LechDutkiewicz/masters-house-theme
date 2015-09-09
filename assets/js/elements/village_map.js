(function($) {

	$(document).ready(function(){
		var plots = $('.plot');

		Object.keys(cottages).forEach(function(key) {
			var plot = $('#plot-' + key),
			cottage = $('#cottage-' + key),
			link = cottage.find('.cottage-link'),
			fence = plot.find('.fence'),
			camera = cottage.find('.camera-holder');

			camera.attr('class', 'camera-holder ' + cottages[key]['format']);

			setTimeout(function () {
				fence.fadeIn(500, 'easeInQuart');						
			}, key * 200 + 600 );

			setTimeout(function () {
				cottage.fadeIn(500, 'easeInQuart');						
			}, key * 200 + 600 );

			link.attr('xlink:href', cottages[key]['url']);
			camera.addClass(cottages[key]['format']);
		});
	});

})(jQuery);