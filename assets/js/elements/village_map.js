(function($) {

	$(document).ready(function(){
		if (typeof cottages !== 'undefined')
		{

			// scroll viewport to top of village image
			$('html, body').animate({
				scrollTop: $("#map-header").offset().top - 50
			}, 2000);

			// setup vars for each cottage from cottage object given in block-village-map.php

			Object.keys(cottages).forEach(function(key) {
				
				var plot = $('[id="plot-' + key + '"]'),
				cottage = $('[id="cottage-' + key + '"]'),
				title = cottage.find('title'),
				link = cottage.find('[class="cottage-link"]'),
				fence = plot.find('[class^="fence"]'),
				camera = cottage.find('[class="camera-holder"]');

				// specify if target contains images or video and apply according class
				camera.attr('class', 'camera-holder ' + cottages[key]['format']);
				camera.addClass(cottages[key]['format']);

				// show svg group with house for each link specified in block-village-map.php
				setTimeout(function () {
					fence.fadeIn(500, 'easeInQuart');						
				}, key * 200 + 600 );

				setTimeout(function () {
					cottage.fadeIn(500, 'easeInQuart');						
				}, key * 200 + 600 );

				// set link attributes for svg element needed for it's ajax call to fetch target's data
				link.attr('xlink:href', cottages[key]['url']);
				link.attr('data-post-title', cottages[key]['title']);
				link.attr('data-post-id', cottages[key]['id']);
				// set title tag according to link target
				title.html(cottages[key]['translatedView'] + ' ' + cottages[key]['title']);
			});
}
});

// bind to hover on each link an action to show preview with target's thumbnail
$('.plot .cottage-link .camera-holder').hover(function() {

	var el = $(this).parent(),
	targetPostTitle = el.data('post-title'),
	canvas = $('#canvas'),
	// html element of thumbnail image holder
	imgHolder = "<div class='cot-details-holder loading'></div>",
	send_data = new Object;

	// setup data for post call
	send_data.action = 'get-cot-details';
	send_data.id = el.data('post-id');
	send_data.thumbSize = thumbSize;

	// determine scale of svg display relative to it's original viewbox size parameter
	var ratio = canvas.width() / 790.9,
	// check canvas height
	canvasHeight = canvas.height(),
	// getBBox method to fetch size of selected svg element
	BBox = $(this).parent().parent()[0].getBBox(),
	// count actial svg .plot element height
	plotHeight = $(this).parent().parent()[0].getBBox().height * ratio,
	position = new Object;

	// setup absolute position of imgHolder element
	position.bottom = canvasHeight - ( BBox.y * ratio );
	position.left = BBox.x * ratio;

	canvas.append(imgHolder);

	var box = canvas.find('.cot-details-holder');
	box.css({
		bottom: position.bottom + "px",
		left: position.left + 'px'
	});

	$.post(bon_toolkit_ajax.url, send_data, function (data) {
		box.removeClass('loading').html(data.thumbnail).attr('title', targetPostTitle);
		setTimeout(function () {
			box.fadeIn(300);						
		}, 100);
	}, 'json');
}, function(){
	var canvas = $('#canvas');
	var box = canvas.find('.cot-details-holder');
	box.fadeOut(100, function(){
		$(this).remove()
	});
});

})(jQuery);