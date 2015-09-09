(function($) {

	$(document).ready(function(){
		if (cottages)
		{
			$('html, body').animate({
				scrollTop: $("#village-map").offset().top
			}, 2000);

			var plots = $('.plot');

			Object.keys(cottages).forEach(function(key) {

				// var plot = $('#plot-' + key),
				// cottage = $('#cottage-' + key),
				// link = cottage.find('.cottage-link'),
				// fence = plot.find('.fence'),
				// camera = cottage.find('.camera-holder');
				
				var plot = $('[id="plot-' + key + '"]'),
				cottage = $('[id="cottage-' + key + '"]'),
				title = cottage.find('title'),
				link = cottage.find('[class="cottage-link"]'),
				fence = plot.find('[class^="fence"]'),
				camera = cottage.find('[class="camera-holder"]');

				camera.attr('class', 'camera-holder ' + cottages[key]['format']);

				setTimeout(function () {
					fence.fadeIn(500, 'easeInQuart');						
				}, key * 200 + 600 );

				setTimeout(function () {
					cottage.fadeIn(500, 'easeInQuart');						
				}, key * 200 + 600 );

				title.html(cottages[key]['title']);
				link.attr('xlink:href', cottages[key]['url']);
				camera.addClass(cottages[key]['format']);
			});
		}
	});

})(jQuery);