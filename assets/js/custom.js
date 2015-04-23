 jQuery(document).ready(function ($) {


 	wrapSelects = function () {
 		$('.search-listing .select-wrap:not(.is-wrapped)')
 		.addClass('is-wrapped')
 		.wrap('<div class="customs dropdowns select-dark" />')
 		.after('<span class="selector"></span>');
 	};
 	$(wrapSelects);

 });

 (function($){

	// USE STRICT
	"use strict";

	var rememberCookie = function (selector) {
		$(selector).each(function () {
			var name = $(this).attr('name');
			if ($.cookie(name)) {
				$(this).val($.cookie(name));
			}
			$(this).change(function () {
				$.cookie(name, $(this).val(), {
					path: '/',
					expires: 365
				});
			});
		});
	};

	var addCommaCur = function (nStr) {
		nStr += '';
		var x = nStr.split('.');
		var x1 = x[0];
		var x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	};

	var captionAnimation = function (args) {
		var caption, animSubTitle, animTitle;
		if (args.slides !== undefined) {
			caption = $(args.slides).find('.flex-caption');
			var currentCaption = $(args.slides.eq(args.currentSlide)).find('.flex-caption');
			caption.find('.secondary-title, .caption-content, .flex-readmore').attr('style', '');
			caption.each(function () {
				if ($(this).hasClass('caption-right')) {
					caption.find('.primary-title').css({
						'margin-right': '',
						'opacity': 0
					});
				} else {
					caption.find('.primary-title').css({
						'margin-left': '',
						'opacity': 0
					});
				}
			});
			if (currentCaption.length > 0) {
				if (currentCaption.hasClass('caption-right')) {
					animSubTitle = {
						right: 0,
						opacity: 1
					};
					animTitle = {
						opacity: 1,
						'margin-right': 0
					};
				} else {
					animSubTitle = {
						left: 0,
						opacity: 1
					};
					animTitle = {
						opacity: 1,
						'margin-left': 0
					};
				}
			}
			currentCaption.find('.flex-readmore').animate(animSubTitle, 300, 'easeOutQuint');
			currentCaption.find('.secondary-title').delay(100).animate(animSubTitle, 400, 'easeOutQuint');
			currentCaption.find('.caption-content').delay(200).animate(animSubTitle, 400, 'easeOutQuint');
			currentCaption.find('.primary-title').delay(300).animate(animTitle, 400, 'easeOutQuint');
		} else {
			caption = args.find('.flex-caption');
			if (caption.length > 0) {
				caption.find('.secondary-title, .caption-content, .flex-readmore').attr('style', '');
				if (caption.hasClass('caption-right')) {
					caption.find('.primary-title').css({
						'margin-right': '',
						'opacity': 0
					});
				} else {
					caption.find('.primary-title').css({
						'margin-left': '',
						'opacity': 0
					});
				} if (caption.hasClass('caption-right')) {
					animSubTitle = {
						right: 0,
						opacity: 1
					};
					animTitle = {
						opacity: 1,
						'margin-right': 0
					};
				} else {
					animSubTitle = {
						left: 0,
						opacity: 1
					};
					animTitle = {
						opacity: 1,
						'margin-left': 0
					};
				}
				caption.find('.flex-readmore').animate(animSubTitle, 300, 'easeOutQuint');
				caption.find('.secondary-title').delay(100).animate(animSubTitle, 400, 'easeOutQuint');
				caption.find('.caption-content').delay(200).animate(animSubTitle, 400, 'easeOutQuint');
				caption.find('.primary-title').delay(300).animate(animTitle, 400, 'easeOutQuint');
			}
		}
	};

	var makeSelectToSlider = function (selector) {
		var label_count = '';
		var opt_len = $("#" + selector + " option").length;
		if (opt_len < 10) {
			label_count = opt_len;
		} else {
			label_count = opt_len / 2;
		}
		$("select#" + selector).selectToUISlider({
			labels: label_count,
			tooltip: false,
			labelSrc: 'text',
			sliderOptions: {
				create: function (e, ui) {
					var filterSelected = $("select#" + selector).val();
					if (filterSelected !== '') {
						$(".ui-slider-label:contains(" + filterSelected + ")", this).addClass("filter-active");
					}
				},
				change: function (e, ui) {
					var filterSelected = $("select#" + selector + " option").eq(ui.values[0]).val();
					$(this).find(".ui-slider-label").removeClass("filter-active");
					$(".ui-slider-label:contains(" + filterSelected + ")", this).addClass("filter-active");
				}
			}
		}).hide();
	};


	var matchHeight = function () {
		$("[data-match-height]").each(function () {
			var parentRow = $(this),
			childrenCols = $(this).find("[data-height-watch]"),
			childHeights = childrenCols.map(function () {
				return $(this).height();
			}).get(),
			tallestChild = Math.max.apply(Math, childHeights);
			childrenCols.css('min-height', tallestChild);
			if (parentRow.hasClass('textarea-container')) {
				var padT = childrenCols.find('textarea').css('padding-top');
				var padB = childrenCols.find('textarea').css('padding-bottom');
				var pad = parseInt(padT) + parseInt(padB);
				childrenCols.find('.attached-label').css('min-height', tallestChild).end().find('textarea').css('min-height', tallestChild);
			}
		});
	};


	var makeRangeSlider = function(selector, min, max, step) {
		var $t = $("#" + selector);
		var min_val = parseInt(min),
		max_val = parseInt(max),
		type = $t.data('type');
		step = parseInt(step);
		var initial_min_val = (parseInt($('#min_' + type).val())) ? parseInt($('#min_' + type).val()) : min_val,
		initial_max_val = (parseInt($('#max_' + type).val())) ? parseInt($('#max_' + type).val()) : max_val;
		$t.slider({
			range: true,
			min: min_val,
			max: max_val,
			values: [initial_min_val, initial_max_val],
			step: step,
			create: function (event, ui) {
				var li_min = '<li class="min-val"><span class="ui-slider-label ui-slider-label-show">' + addCommaCur(min_val) + '</span></li>';
				var li_max = '<li class="max-val"><span class="ui-slider-label ui-slider-label-show">' + addCommaCur(max_val) + '</span></li>';
				var labelComponent = '<ol role="presentation">' + li_min + li_max + '</ol>';
				$t.append(labelComponent);
			},
			slide: function (event, ui) {
				$("#min_" + type + "_text").text(addCommaCur(ui.values[0]));
				$("#max_" + type + "_text").text(addCommaCur(ui.values[1]));
			},
			stop: function (event, ui) {
				$("#min_" + type).val(ui.values[0]);
				$("#max_" + type).val(ui.values[1]);
			}
		});
		$("#min_" + type + "_text").text(addCommaCur($t.slider("values", 0)));
		$("#max_" + type + "_text").text(addCommaCur($t.slider("values", 1)));
		$("#min_" + type).val($t.slider("values", 0));
		$("#max_" + type).val($t.slider("values", 1));
	};

	var onReady = {
		init: function(){

			var is_singular = $('body').hasClass('singular-listing');                        

		            // added by Lech Dutkiewicz

		            if ($.cookie('visited') === null || $.cookie('visited') === "" || $.cookie('visited') === "null" || $.cookie('visited') === undefined)
		            {
		            	$.cookie('visited', 1, {
		            		path: '/',
		            		expires: 7
		            	});
		            }

		            if( is_singular ) {
		            	$('html, body').animate({
		            		scrollTop: $('#main-content').offset().top - parseInt( $('#main-content').css('margin-top') ) - 20
		            	});
		            }

		            $(document).foundation();

			//var handleMove = function (e) {
			//    //if($(e.target).closest('.custom.dropdown ul').length == 0 ) { e.preventDefault(); }
			//}
			//document.addEventListener('touchmove', handleMove, true);

			if (typeof shandora_data_count !== 'undefined') {
				$('h3#listed-property').text(shandora_data_count);
			}
			if (Modernizr.touch) {
				$('.listings .entry-header').click(function () {
					if ($(this).hasClass('active')) {
						$(this).removeClass('active');
						$(this).find('.listing-hover').css({
							'opacity': 0
						}).end().find('.mask').css({
							'margin-top': '100%'
						}).end().find('.hover-icon-wrapper').hide();
					} else {
						$(this).addClass('active');
						$(this).find('.listing-hover').css({
							'opacity': 1
						}).end().find('.mask').css({
							'margin-top': '0'
						}).end().find('.hover-icon-wrapper').show();
					}
				});
			}
			if (Modernizr.mq('only screen and (min-width: 781px)')) {
				$('.panel.callaction').each(function () {
					var mT = ($(this).outerHeight() - $(this).find('.panel-button a').outerHeight()) / 2;
					$(this).find('.panel-button a').css({
						"margin-top": mT + "px"
					});
				});
			} else {
				$('.panel.callaction').each(function () {
					$(this).find('.panel-button a').removeAttr('style');
				});
			}


			$('.listings').on('click', '.listing-compare', function (e) {
				e.preventDefault();
				var $t = $(this);
				var $ac = $('body').find('.action-compare');
				var compare_url = $t.parents('.listings').data('compareurl');
				var post_id = $t.data('id');
				var icon_checked = 'sha-check';
				var icon_not_checked = 'sha-paperclip';
				var data_count = $ac.data('count');
				var data_compare_id = $ac.data('compare');
				var data_return = '';
				if ($t.hasClass('checked')) {
					$t.removeClass('checked').children('i').removeClass();
					$t.children('i').addClass(icon_not_checked);
					if (data_count > 0) {
						data_count--;
						$ac.data('count', data_count);
					}
				} else {
					if (data_count < 2) {
						$t.addClass('checked').children('i').removeClass();
						$t.children('i').addClass(icon_checked);
						data_count++;
						$ac.data('count', data_count);
						if (data_count === 1) {
							data_return = post_id;
						} else if (data_count > 1) {
							data_return = data_compare_id + "," + post_id;
						}
						$ac.data('compare', data_return);
					}
				} if (data_count === 2) {
					window.location = compare_url + '?compare=' + $ac.data('compare');
				}
			});

 $('#search-listing-form').submit(function () {
 	var post_data = $(this).serializeArray();
 	formName = $(this).attr('id');
 	$(post_data).each(function (e) {
 		$.cookie(this.formName, this.value, {
 			path: '/',
 			expires: 365
 		});
 	});
 });

 $('#orderform .search-orderby select').change(function(){
 	var form = $('#orderform'),
 	target = form.find('.order-text'),
 	value = $(this).val();

 	if ( target.length === 0 ) {
 		var targetPlaces = form.find('.search-order a.current, .search-order ul li');
 		targetPlaces.each(function(){
 			$(this).html( '<span class="order-text"></span> ' + $(this).html().toLowerCase() );
 		});
 		target = form.find('.order-text');
 	}

 	target.each(function(){
 		var capitalizedValue = value.charAt(0).toUpperCase() + value.substring(1);
 		$(this).html( capitalizedValue );
 	});

 });

 $('.package-form select').change(function(){

 	var form = $('.package-form');
 	var send_data = form.serialize();
 	console.log(send_data);
 	$.post(bon_toolkit_ajax.url, 'action=process-package&' + send_data, function (data) {
 		if (data.success === '1') {
 			console.log(data);
 			var priceContainer = $('.price-box .price'),
 			priceSpan = $('span[itemprop="price"]'),
 			wallContainer = $('.entry-meta .wall'),
 			wallSpan = $('span[data-meta="thickness"]');

 			priceContainer.fadeOut(300, 'easeInOutSine', function() {
 				priceSpan.html(data.price);
 				priceContainer.fadeIn(300, 'easeInOutSine');
 			});
 			wallContainer.fadeOut(300, 'easeInOutSine', function() {
 				wallSpan.html(data.wall);
 				wallContainer.fadeIn(300, 'easeInOutSine');
 			});

 		}
 	}, 'json');

 });

 $('.backtop').click(function () {
 	jQuery('body,html').animate({
 		scrollTop: 0
 	}, 600, "easeInSine");
 	return false;
 });

 var items = $('.slide');
 var content = $('#inner-wrap');
 var open = function () {
 	$(items).removeClass('close').addClass('open');
 };
 var close = function () {
 	$(items).removeClass('open').addClass('close');
 };
 $('#nav-toggle').click(function () {
 	if (content.hasClass('open')) {
 		$(close);
 	} else {
 		$(open);
 	}
 });
 content.click(function () {
 	if (content.hasClass('open')) {
 		$(close);
 	}
 });
 $('.menu-items .menu-has-children .menu-toggle').click(function (e) {
 	if ($(this).hasClass('bi-angle-down')) {
 		$(this).removeClass('bi-angle-down').addClass('bi-angle-up');
 	} else {
 		$(this).removeClass('bi-angle-up').addClass('bi-angle-down');
 	}
 	$(this).siblings('.sub-menu').slideToggle();
 	$(this).parent().toggleClass('sub-menu-active');
 });

 $('.bon-mega-menu-items .menu-has-children .menu-toggle').click( function() {
 	$(this).parent().toggleClass('sub-menu-active');
 });


 $('#agent-contactform, #contact-requestform, #ebook-downloadform, #visit-requestform, #customize-requestform').submit(function () {
 	var $t = $(this),
 	formID = $(this).attr('id');
 	var error = false;
 	$t.find('.sending-result').fadeOut(200);
 	$t.find('.required').each(function () {
 		if ($.trim($(this).val()) === '') {
 			error = true;
 			$(this).siblings('.contact-form-error').fadeIn(200);
 		} else if ($(this).hasClass('email')) {
 			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
 			if (!emailReg.test($.trim($(this).val()))) {
 				error = true;
 				$(this).siblings('.contact-form-error').fadeIn(200);
 			} else {
 				$(this).siblings('.contact-form-error').fadeOut(200);
 			}
 		} else {
 			$(this).siblings('.contact-form-error').fadeOut(200);
 		}
 	});
 	if (error) {
 		return false;
 	}
 	$(this).find('.contact-loader').fadeIn();
 	var send_data = $(this).serialize();
 	$.post(bon_toolkit_ajax.url, 'action=process-' + formID + '&' + send_data, function (data) {
 		$t.find('.contact-loader').fadeOut();
 		if (data.success === '1') {
 			$t.find('input[type="text"], textarea').val('');
 			$t.find('.sending-result div.bon-toolkit-alert').each(function () {
 				$(this).html(data.value);
 				$(this).removeClass('red').addClass('green').css({
 					'margin-top': '10px',
 					'display': 'block'
 				});
 				$(this).parent().fadeIn(200);
 			});
 		} else {
 			$t.find('.sending-result div.bon-toolkit-alert').each(function () {
 				$(this).html(data.value);
 				$(this).removeClass('green').addClass('red').css({
 					'margin-top': '10px',
 					'display': 'block'
 				});
 				$(this).parent().fadeIn(200);
 			});
 		}
 	}, 'json');
 	return false;
 });


		    /*$('#ebook-downloadform').submit(function () {
		        var $t = $(this),
                        id = $(this).attr('id');
		        var error = false;
		        $t.find('.sending-result').fadeOut(200);
		        $t.find('.required').each(function () {
		            if ($.trim($(this).val()) == '') {
		                error = true;
		                $(this).siblings('.contact-form-error').fadeIn(200)
		            } else if ($(this).hasClass('email')) {
		                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		                if (!emailReg.test($.trim($(this).val()))) {
		                    error = true;
		                    $(this).siblings('.contact-form-error').fadeIn(200)
		                } else {
		                    $(this).siblings('.contact-form-error').fadeOut(200)
		                }
		            } else {
		                $(this).siblings('.contact-form-error').fadeOut(200)
		            }
		        });
		        if (error) {
		            return false
		        }
		        $(this).find('.contact-loader').fadeIn();
		        var send_data = $(this).serialize();
		        $.post(bon_toolkit_ajax.url, 'action=process_ebook_download&' + send_data, function (data) {
		            $t.find('.contact-loader').fadeOut();
		            if (data.success == '1') {
		                $t.find('input[type="text"], textarea').val('');
		                $t.find('.sending-result div.bon-toolkit-alert').each(function () {
		                    $(this).html(data.value);
		                    $(this).removeClass('red').addClass('green').css({
		                        'margin-top': '10px',
		                        'display': 'block'
		                    });
		                    $(this).parent().fadeIn(200)
		                })
		            } else {
		                $t.find('.sending-result div.bon-toolkit-alert').each(function () {
		                    $(this).html(data.value);
		                    $(this).removeClass('green').addClass('red').css({
		                        'margin-top': '10px',
		                        'display': 'block'
		                    });
		                    $(this).parent().fadeIn(200)
		                })
		            }
		        }, 'json');
		        return false
		    });*/


 if ($('.format-video').length > 0) {
 	if ($.fn.fitVids) {
 		$('.format-video').fitVids();
 	}
 }
 $('.tabs-container .tab-nav a').click(function (e) {
 	e.preventDefault();
 	$(this).siblings().removeClass('active');
 	$(this).addClass('active');
 	var target = $(this).attr('href');
 	$(this).parent().parent().find('.tab-content').removeClass('active');
 	$(this).parent().parent().find(target).addClass('active');
 });

 onResize.init();
}
};

var onLoad = {
	init: function(){



		$(window).scroll(function () {
			if ($(window).scrollTop() < 800) {
				$('#scroll-top').fadeOut();
			} else {
				$('#scroll-top').fadeIn();
			}
		});

		$.ajax({
			type: "POST",
			url: bon_ajax.url,
			data: {
				action: "price-range"
			},
			success: function (data) {
				if ($('#idx-slider-range2').length > 0) {
					set_idx_price_slider2(data);
				}
				if ($('#idx-slider-range-widget').length > 0) {
					set_idx_price_slider(data);
				}
			}
		});
		$('.select-slider').each(function (e) {
			var id = $(this).attr('id');
			makeSelectToSlider(id);
		});
		$('.range-slider').each(function (e) {
			var id = $(this).attr('id');
			makeRangeSlider(id, $(this).data('min'), $(this).data('max'), $(this).data('step'));
		});
		if ($('#property_status').length > 0) {
			$('#property_status').change(function (e) {
				var t = $('.range-slider[data-type="price"]');
				var id = t.attr('id');
				if ($('#property_status').length > 0 && t.data('type') === 'price' && t.slider) {
					var data_min, data_max, data_step;
					if ($('#property_status').val() === 'for-rent') {
						data_min = t.data('min-r');
						data_max = t.data('max-r');
						data_step = t.data('step-r');
						t.removeClass('active-sell').addClass('active-rent');
						t.slider("destroy");
						t.find('ol[role="presentation"]').remove();
						$('#min_price').val(data_min);
						$('#max_price').val(data_max);
						makeRangeSlider(id, data_min, data_max, data_step);
		                    //var a = $('#' + id).slider('value');
		                } else {
		                	data_min = t.data('min');
		                	data_max = t.data('max');
		                	data_step = t.data('step');
		                	t.removeClass('active-rent').addClass('active-sell');
		                	t.slider("destroy");
		                	t.find('ol[role="presentation"]').remove();
		                	$('#min_price').val(data_min);
		                	$('#max_price').val(data_max);
		                	makeRangeSlider(id, data_min, data_max, data_step);
		                }
		            }
		        }).change();
}
if ($.flexslider) {
	var interval = $('#main-slider').data('interval') ? $('#main-slider').data('interval') : 12000;
	$('#main-slider').flexslider({
		animation: "fade",
		controlNav: false,
		animationSpeed: 600,
		slideshowSpeed: interval,
		after: captionAnimation,
		start: captionAnimation,
		controlsContainer: "#main-slider",
		prevText: '',
		nextText: ''
	});
}
if ($.fn.bxSlider) {
	$('.bxslider').bxSlider({
		pagerCustom: '#bx-pager',
		controls: false,
		mode: 'fade',
		adaptiveHeight: true,
		onSliderLoad: function (index) {
			$(this.pagerCustom).find('li').removeClass('active-list');
			$(this.pagerCustom).each(function (i, el) {
				$(el).find('li').eq(index).addClass('active-list');
			});
		},
		onSlideBefore: function (selector) {
			var index = selector.index();
			$(this.pagerCustom).find('li').removeClass('active-list');
			$(this.pagerCustom).each(function (i, el) {
				$(el).find('li').eq(index).addClass('active-list');
			});
		}
	});
	$('.bxslider-no-thumb').bxSlider({
		pager: false,
		controls: true,
		adaptiveHeight: true,
		mode: 'fade',
		nextText: '<i class="bonicons bi-angle-right"></i>',
		prevText: '<i class="bonicons bi-angle-left"></i>'
	});
	$('.bxslider-no-thumb-slide').bxSlider({
		pager: false,
		controls: true,
		adaptiveHeight: true,
		mode: 'horizontal',
		nextText: '<i class="bonicons bi-angle-right"></i>',
		prevText: '<i class="bonicons bi-angle-left"></i>'
	});
	$('.bxslider-both').bxSlider({
		pagerCustom: '#bx-pager',
		controls: true,
		adaptiveHeight: true,
		mode: 'fade',
		nextText: '<i class="bonicons bi-angle-right"></i>',
		prevText: '<i class="bonicons bi-angle-left"></i>',
		onSliderLoad: function (index) {
			$(this.pagerCustom).find('li').removeClass('active-list');
			$(this.pagerCustom).each(function (i, el) {
				$(el).find('li').eq(index).addClass('active-list');
			});
		},
		onSlideBefore: function (selector) {
			var index = selector.index();
			$(this.pagerCustom).find('li').removeClass('active-list');
			$(this.pagerCustom).each(function (i, el) {
				$(el).find('li').eq(index).addClass('active-list');
			});
		}
	});
}

var post_carousel = $('.post-carousel');
post_carousel.foundationCarousel({
	itemSelector: ".post-item",
	slidesContainer: ".post-carousel-slides",
	controlContainer: ".post-carousel-control",
	prevText: '',
	nextText: '',
	prevClass: 'post-carousel-prev',
	nextClass: 'post-carousel-next',
});
post_carousel.each(function () {
	$(this).find('.post-carousel-control a').each(function () {
		if ($(this).hasClass('post-carousel-next')) {
			$(this).addClass('hovered');
		}
		$(this).hover(function () {
			$(this).siblings().removeClass('hovered');
			$(this).addClass('hovered');
		}, function () {
			if ($(this).siblings().hasClass('post-carousel-next')) {
				$(this).siblings().addClass('hovered');
				$(this).removeClass('hovered');
			}
		});
	});
});
if ($().jPlayer && $('.bon-jplayer').length > 0) {
	jQuery(".bon-jplayer").each(function () {
		var m4v_url = $(this).data('m4v');
		var ogv_url = $(this).data('ogv');
		var poster_url = $(this).data('poster');
		var id = $(this).siblings('.jp-video-container').find('.jp-interface').attr('id');
		$(this).jPlayer({
			ready: function () {
				$(this).jPlayer("setMedia", {
					m4v: m4v_url,
					ogv: ogv_url,
					poster: poster_url
				});
				var parentWidth = $(this).siblings('.jp-video-container').outerWidth();
				var playWidth = $(this).siblings('.jp-video-container').find('.jp-play').outerWidth(true);
				var muteWidth = $(this).siblings('.jp-video-container').find('.jp-mute').outerWidth(true);
				var volumeWidth = $(this).siblings('.jp-video-container').find('.jp-volume-bar-container').outerWidth(true);
				var minusWidth = playWidth + muteWidth + volumeWidth;
				var progressWidth = parentWidth - minusWidth;
				$(this).siblings('.jp-video-container').find('.jp-progress').css('width', progressWidth + "px");
			},
			size: {
				width: "100.05%",
				height: "auto"
			},
			swfPath: "/libs/jplayer",
			cssSelectorAncestor: "#" + id,
			supplied: "m4v,ogv,all"
		});
	});
}

function renderMarker(marker, i) {
	var cs = '';
	cs += '<div class="listing-map-hover clear">';
	cs += '<div class="listing-map-image">';
	cs += '<img src="' + e[i].photo + '" alt="' + e[i].title + '" />';
	cs += '</div>';
	cs += '<div class="listing-map-details"><h4 class="listing-map-title"><a href="' + e[i].permalink + '" title="' + e[i].title + '">' + e[i].title + '</a></h4>';
	cs += '<div class="listing-map-price">' + e[i].price + '</div>';
	cs += '<ul class="listing-map-meta">';
	cs += '<li class="listing-map-beds">' + e[i].beds + '</li>';
	cs += '<li class="listing-map-beds">' + e[i].baths + '</li>';
	cs += '</ul></div>';
	cs += '</div>';
	return function () {
		infowindow.setContent(cs);
		infowindow.open(map, marker);
	};
}

if ($('#listings-map').length > 0 && typeof shandora_data !== 'undefined') {

	var zoomMore = '<div class="mapbutton mapzoom more">+</div>';
	var zoomLess = '<div class="mapbutton mapzoom less">-</div>';
	var typePlain = '';
	var typeSat = '';
	var typeHyb = '';
	var typeBox = '<div class="maptypebox"><div class="mapbutton maptype plain selected">Plain</div><div class="mapbutton maptype sat">Satellite</div><div class="mapbutton maptype hyb">Hybrid</div></div>';
	var mapContainer = document.getElementById('listings-map');
	var mapOptions = {
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: false,
		scrollwheel: false,
		disableDefaultUI: true,
		disableDoubleClickZoom: true,
		zoom: 12
	};
	var e = shandora_data.results;

	if( e.length < 2 ) {
		mapOptions.center = new google.maps.LatLng(e[0].latitude, e[0].longitude);
	}

	var x = new google.maps.MarkerImage(bon_ajax.toolkit_url + 'assets/images/marker-blue.png');
	var map = new google.maps.Map(mapContainer, mapOptions);
	var infowindow = new google.maps.InfoWindow();
	var marker, i;
	var bounds = new google.maps.LatLngBounds();

	for (i = 0; i < e.length; i++) {
		var pos = new google.maps.LatLng(e[i].latitude, e[i].longitude);

		if( e.length > 1 ) {
			bounds.extend(pos);
		}

		marker = new google.maps.Marker({
			position: pos,
			map: map,
			icon: x,
		});
		google.maps.event.addListener(marker, 'mouseover', renderMarker(marker, i))(marker, i);
	}

	if( e.length > 1 ) {
		map.fitBounds(bounds);
	}

	if( $(mapContainer).data('show-zoom') === true ) {
		$(mapContainer).append(zoomMore).append(zoomLess);
	}
	if( $(mapContainer).data('show-map-type') === true ) {
		$(mapContainer).append(typeBox);
	}

	$('#listings-map .less').click(function () {
		mapOptions.zoom--;
		if (mapOptions.zoom <= 0) {
			mapOptions.zoom = 0;
		}
		map.setZoom(mapOptions.zoom);
		$(this).blur();
	});
	$('#listings-map .more').click(function () {
		mapOptions.zoom++;
		if (mapOptions.zoom >= 21) {
			mapOptions.zoom = 21;
		}

		map.setZoom(mapOptions.zoom);
		$(this).blur();
	});
	$('#listings-map .maptype.plain').click(function () {
		map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
		$('.maptype').removeClass('selected');
		$(this).addClass('selected');
	});
	$('#listings-map .maptype.hyb').click(function () {
		map.setMapTypeId(google.maps.MapTypeId.HYBRID);
		$('.maptype').removeClass('selected');
		$(this).addClass('selected');
	});
	$('#listings-map .maptype.sat').click(function () {
		map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
		$('.maptype').removeClass('selected');
		$(this).addClass('selected');
	});
	$('.more, .less').hover(function (e) {
		$(this).addClass('hovered');
	}, function (e) {
		$(this).removeClass('hovered');
	});


} else {
	$('#listings-map').css({
		'min-height': 0
	});
}

$('.listing-gallery').each(function () {
	var imageset = $(this).data('imageset');
	if (imageset !== '') {
		$(this).magnificPopup({
			items: imageset,
			gallery: {
				enabled: true
			},
			image: {
				markup: '<div class="mfp-figure">' + '<div class="mfp-title"></div>' + '<div class="mfp-close"></div>' + '<div class="mfp-img"></div>' + '<div class="mfp-bottom-bar">' + '<div class="mfp-counter"></div>' + '</div>' + '</div>',
			},
			type: 'image'
		});
	}
});
$('.gallery-link-file a').magnificPopup({
	type: 'image',
	gallery: {
		enabled: true
	}
});

$('.post .gallery').each(function() {
	$(this).magnificPopup({
		delegate: 'a',
		type: 'image',
		gallery: {
			enabled: true
		}
	});
});

$('#loancalculator_cars button').click(function () {
	var LoanAmount = $('#LoanAmount').val();
	var DownPayment = $('#DownPayment').val();
	var AnnualInterestRate = ($('#InterestRate').val()) / 100;
	var Years = $('#NumberOfYears').val();
	var MonthRate = AnnualInterestRate / 12;
	var NumPayments = Years * 12;
	var Prin = LoanAmount - DownPayment;
	var MonthPayment = Math.floor((Prin * MonthRate) / (1 - Math.pow((1 + MonthRate), (-1 * NumPayments))) * 100) / 100;
	$('#NumberOfPayments').val(NumPayments);
	$('#MonthlyPayment').val(MonthPayment);
	$('#MonthlyPayment').addClass('calculatorresult');
	return false;
});

$(".listing-gallery-popup").magnificPopup({
	type: 'image',
	gallery: {
		enabled: true
	}
});

if( $('.input-container-inner').length > 0 ) {
	$('.input-container-inner input, .input-container-inner textarea').focus(function(event) {
		$(this).parents('.input-container-inner').addClass('focus');
	});
	$('.input-container-inner input, .input-container-inner textarea').blur(function(event) {
		$(this).parents('.input-container-inner').removeClass('focus');
	});
}
}
};

var onResize = {
	init: function(){


		if (Modernizr.mq('only screen and (max-width: 780px)')) {
			$('#main-header').show().removeClass('hide');
			$('html').addClass('offcanvas-nav');
		} else {
			$('html').removeClass('offcanvas-nav');
		} if (Modernizr.mq('only screen and (min-width: 781px)')) {

			$('.menu-items .menu-has-children .menu-toggle').each(function () {
				$(this).parent().removeClass('sub-menu-active');
	                //$(this).parent().find('.bon-menu-selected .sub-menu').hide();
	                //$(this).parent().find('.sub-menu-1').hide();
	                //$(this).parent().removeClass('bon-menu-selected');
	                $(this).siblings('.sub-menu').removeAttr('style');
	                $(this).removeClass().addClass('icon bonicons bi-angle-down menu-toggle');
	            });

			$('.panel.callaction').each(function () {
				var mT = ($(this).outerHeight() - $(this).find('.panel-button a').outerHeight()) / 2;
				$(this).find('.panel-button a').css({
					"margin-top": mT + "px"
				});
			});
		} else {

			$('.panel.callaction').each(function () {

				$(this).find('.panel-button a').removeAttr('style');
	               /* var mT = ($(this).outerHeight() - $(this).find('.panel-button a').outerHeight()) / 2;
	                $(this).find('.panel-button a').css({
	                    "margin-top": mT + "px"
	                })*/
		});
		}

	}
};


$(document).ready(onReady.init);
$(window).load(onLoad.init);
$(window).resize(onResize.init);

var launchGoogleEvents = function() {

	var googleElements = {
		1: {
			category: 'Home_CTA',
			action: 'top_browse_all',
			selector: $('.home-ctas-container.top a[data-function="browse-all"]'),
		},
		2: {
			category: 'Home_CTA',
			action: 'top_open_tool',
			selector: $('.home-ctas-container.top a[data-function="open-tool"]'),
		},
		3: {
			category: 'Home_CTA',
			action: 'bottom_browse_all',
			selector: $('.home-ctas-container.bottom a[data-function="browse-all"]'),
		},
		4: {
			category: 'Home_CTA',
			action: 'bottom_open_tool',
			selector: $('.home-ctas-container.bottom a[data-function="open-tool"]'),
		},
		5: {
			category: 'Home_products',
			action: 'click',
			selector: $('#featured-listing-slider a.product-link'),
		},
		6: {
			category: 'Home_products_navi',
			action: 'click',
			selector: $('#featured-listing-slider .bx-controls-direction a'),
		},
		7: {
			category: 'Header_click',
			action: 'request_a_visit',
			selector: $('#main-header .phone.visit'),
			label: document.title
		},
		8: {
			category: 'Header_click',
			action: 'phone',
			selector: $('#main-header .phone.phone-1'),
			label: document.title
		},
		/* Category pages */
		9: {
			category: 'Category_list',
			action: 'switch_view',
			selector: $('a.view-grid, a.view-list'),
		},
		10: {
			category: 'Category_list',
			action: 'filter',
			selector: $('.search-order ul li'),
		},
		11: {
			category: 'Sidebar',
			action: 'search_cottages',
			selector: $('#search-listing-form input[type="submit"]'),
		},
		12: {
			category: 'Sidebar',
			action: 'click_social_media_profile',
			selector: $('.bon-toolkit-social-widget a'),
			label: $('.bon-toolkit-social-widget a').attr('title')
		},
		13: {
			category: 'Sidebar',
			action: 'click_featured_listing',
			selector: $('.widget.featured-listing .featured-item a'),
		},
		/* Single product pages */
		14: {
			category: 'Buy_cottage',
			action: 'click_top_cta',
			selector: $('.top-cta a.cta'),
			label: $('h1.entry-title').html(),
			value: $('span[itemprop="price"]').attr('data-value'),
		},
		15: {
			category: 'Buy_cottage',
			action: 'click_bottom_cta',
			selector: $('.bottom-cta a.cta'),
			label: $('h1.entry-title').html(),
			value: $('span[itemprop="price"]').attr('data-value'),
		},
		16: {
			category: 'Contact_form',
			action: 'from_product_page',
			selector: $('.listing-contact form, #contact-modal form'),
			label: $('h1.entry-title').html(),
			value: $('span[itemprop="price"]').attr('data-value'),
		},
		17: {
			category: 'Open_faq',
			action: 'on_product_page',
			selector: $('a[aria-controls="faqCollapse"]'),
		},
		18: {
			category: 'Product_page_related',
			action: 'click',
			selector: $('.listings.related .product-link'),
		},
		19: {
			category: 'Product_page_additional_information',
			action: 'switch_specification_tabs',
			selector: $('.entry-specification .tab-nav a'),
		},
		20: {
			category: 'Product_page_additional_information',
			action: 'click_additional_services',
			selector: $('.entry-specification #accordion-services .accordion-section-title'),
		},
		21: {
			category: 'Contact_form',
			action: 'from_about_us_page',
			selector: $('#tab-target-contact form'),
		},
		22: {
			category: 'Open_faq',
			action: 'on_about_us_page',
			selector: $('#detail-tab .tab-nav a[href="#tab-target-faq"]'),
		},
		23: {
			category: 'Blog_page',
			action: 'use_gallery_nav',
			selector: $('.blog article .carousel-control'),
		},
		24: {
			category: 'Blog_page',
			action: 'launch_video',
			selector: $('.blog article iframe .html5-video-content'),
		},
		25: {
			category: 'Blog_page',
			action: 'choose_category',
			selector: $('.blog article .entry-post-meta a[ref="category"]'),
		},
		26: {
			category: 'Blog_page',
			action: 'choose_category_from_sidebar',
			selector: $('.blog .sidebar .widget_categories .cat-item a'),
		},
		27: {
			category: 'Blog_page',
			action: 'choose_tag',
			selector: $('.blog article .entry-footer .entry-tag a'),
		},
		28: {
			category: 'Blog_page',
			action: 'single_post_navigation',
			selector: $('.blog .loop-nav a'),
		},
	};

	$.each(googleElements, function() {
		var event = this;
		if ( event.selector ) {

			if ( event.category === 'Contact_form' ) {
				$(event.selector.selector).submit(function() {
					if (event.label) {
						if (event.value) {
							ga( 'send', 'event', event.category, event.action, event.label, event.value );	
						} else {
							ga( 'send', 'event', event.category, event.action, event.label );	
						}
					} else {
						if (event.value) {
							ga( 'send', 'event', event.category, event.action, NULL, event.value );	
						} else {
							ga( 'send', 'event', event.category, event.action );	
						}		
					}
				});
			} else {
				$(event.selector.selector).bind( 'click', function() {
					console.log(event);
					if (event.label) {
						if (event.value) {
							ga( 'send', 'event', event.category, event.action, event.label, event.value );	
						} else {
							ga( 'send', 'event', event.category, event.action, event.label );	
						}
					} else {
						if (event.value) {
							ga( 'send', 'event', event.category, event.action, NULL, event.value );	
						} else {
							ga( 'send', 'event', event.category, event.action );	
						}			
					}
				});
			}

		}
	});

 function gaTimeout() {
 	return ("ga( 'send', 'event', '40_seconds', 'read' )");
 }

 setTimeout(gaTimeout(), 40000);

};

$(launchGoogleEvents);



})(jQuery);