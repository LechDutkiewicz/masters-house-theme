//Foundation Carousel
(function($){$.fn.foundationCarousel=function(settings){var container=$(this);var defaults={gutter:30,controlContainer:"carousel-control",itemSelector:"item",slidesContainer:"slides",prevText:"Previous",nextText:"Next",prevClass:"carousel-prev",nextClass:"carousel-next",};var options=$.extend(defaults,settings);var slides=container.children(options.slidesContainer);var item=container.find(options.itemSelector);var controlPrev='<a class="'+options.prevClass+'" href="#">'+options.prevText+'</a>';var controlNext='<a class="'+options.nextClass+'" href="#">'+options.nextText+'</a>';var control=container.children(options.controlContainer);control.append(controlPrev);control.append(controlNext);var prev=control.children('.'+options.prevClass);var next=control.children('.'+options.nextClass);var child_size;var marginBase=parseInt(options.gutter)/2;$(window).resize(function(){init()}).resize();function init(){item.css('float','left');if(item.filter(':first').hasClass('large-3')){slides.attr('data-num',4);child_size=container.parents('.row').width()/4}else if(item.filter(':first').hasClass('large-4')){slides.attr('data-num',3);child_size=container.parents('.row').width()/3}else if(item.filter(':first').hasClass('large-6')){slides.attr('data-num',2);child_size=container.parents('.row').width()/2}if(jQuery('html').filter(':first').width()<='767'){slides.attr('data-num',1);child_size=container.parents('.row').width()}item.css('width',child_size);slides.attr('data-width',child_size);slides.attr('data-max',item.length);slides.width(item.length*child_size);var cur_index=parseInt(slides.attr('data-index'));slides.css({'margin-left':-(cur_index*child_size+marginBase)})}prev.click(function(e){e.preventDefault();movePrevious()});next.click(function(e){e.preventDefault();moveNext()});function movePrevious(){var cur_index=parseInt(slides.attr('data-index'));if(cur_index>0){cur_index--}slides.attr('data-index',cur_index);slides.animate({'margin-left':-(cur_index*parseInt(slides.attr('data-width'))+marginBase)})}function moveNext(){var cur_index=parseInt(slides.attr('data-index'));if(cur_index+parseInt(slides.attr('data-num'))<parseInt(slides.attr('data-max'))){cur_index++}slides.attr('data-index',cur_index);slides.animate({'margin-left':-(cur_index*parseInt(slides.attr('data-width'))+marginBase)})}}})(jQuery);
!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)}(function(t){function e(t){return n.raw?t:decodeURIComponent(t.replace(s," "))}function i(t){0===t.indexOf('"')&&(t=t.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\")),t=e(t);try{return n.json?JSON.parse(t):t}catch(i){}}var s=/\+/g,n=t.cookie=function(s,o,a){if(void 0!==o){if(a=t.extend({},n.defaults,a),"number"==typeof a.expires){var r=a.expires,l=a.expires=new Date;l.setDate(l.getDate()+r)}return o=n.json?JSON.stringify(o):String(o),document.cookie=[n.raw?s:encodeURIComponent(s),"=",n.raw?o:encodeURIComponent(o),a.expires?"; expires="+a.expires.toUTCString():"",a.path?"; path="+a.path:"",a.domain?"; domain="+a.domain:"",a.secure?"; secure":""].join("")}for(var d=document.cookie.split("; "),c=s?void 0:{},f=0,h=d.length;h>f;f++){var u=d[f].split("="),p=e(u.shift()),m=u.join("=");if(s&&s===p){c=i(m);break}s||(c[p]=i(m))}return c};n.defaults={},t.removeCookie=function(e,i){return void 0!==t.cookie(e)?(t.cookie(e,"",t.extend({},i,{expires:-1})),!0):!1}});
!function(t){t.flexslider=function(e,i){var n=t(e);n.vars=t.extend({},t.flexslider.defaults,i);var s,a=n.vars.namespace,o=window.navigator&&window.navigator.msPointerEnabled&&window.MSGesture,r=("ontouchstart"in window||o||window.DocumentTouch&&document instanceof DocumentTouch)&&n.vars.touch,l="click touchend MSPointerUp",c="",d="vertical"===n.vars.direction,u=n.vars.reverse,p=n.vars.itemWidth>0,f="fade"===n.vars.animation,h=""!==n.vars.asNavFor,v={},m=!0;t.data(e,"flexslider",n),v={init:function(){n.animating=!1,n.currentSlide=parseInt(n.vars.startAt?n.vars.startAt:0),isNaN(n.currentSlide)&&(n.currentSlide=0),n.animatingTo=n.currentSlide,n.atEnd=0===n.currentSlide||n.currentSlide===n.last,n.containerSelector=n.vars.selector.substr(0,n.vars.selector.search(" ")),n.slides=t(n.vars.selector,n),n.container=t(n.containerSelector,n),n.count=n.slides.length,n.syncExists=t(n.vars.sync).length>0,"slide"===n.vars.animation&&(n.vars.animation="swing"),n.prop=d?"top":"marginLeft",n.args={},n.manualPause=!1,n.stopped=!1,n.started=!1,n.startTimeout=null,n.transitions=!n.vars.video&&!f&&n.vars.useCSS&&function(){var t=document.createElement("div"),e=["perspectiveProperty","WebkitPerspective","MozPerspective","OPerspective","msPerspective"];for(var i in e)if(void 0!==t.style[e[i]])return n.pfx=e[i].replace("Perspective","").toLowerCase(),n.prop="-"+n.pfx+"-transform",!0;return!1}(),""!==n.vars.controlsContainer&&(n.controlsContainer=t(n.vars.controlsContainer).length>0&&t(n.vars.controlsContainer)),""!==n.vars.manualControls&&(n.manualControls=t(n.vars.manualControls).length>0&&t(n.vars.manualControls)),n.vars.randomize&&(n.slides.sort(function(){return Math.round(Math.random())-.5}),n.container.empty().append(n.slides)),n.doMath(),n.setup("init"),n.vars.controlNav&&v.controlNav.setup(),n.vars.directionNav&&v.directionNav.setup(),n.vars.keyboard&&(1===t(n.containerSelector).length||n.vars.multipleKeyboard)&&t(document).bind("keyup",function(t){var e=t.keyCode;if(!n.animating&&(39===e||37===e)){var i=39===e?n.getTarget("next"):37===e?n.getTarget("prev"):!1;n.flexAnimate(i,n.vars.pauseOnAction)}}),n.vars.mousewheel&&n.bind("mousewheel",function(t,e){t.preventDefault();var i=0>e?n.getTarget("next"):n.getTarget("prev");n.flexAnimate(i,n.vars.pauseOnAction)}),n.vars.pausePlay&&v.pausePlay.setup(),n.vars.slideshow&&n.vars.pauseInvisible&&v.pauseInvisible.init(),n.vars.slideshow&&(n.vars.pauseOnHover&&n.hover(function(){!n.manualPlay&&!n.manualPause&&n.pause()},function(){!n.manualPause&&!n.manualPlay&&!n.stopped&&n.play()}),n.vars.pauseInvisible&&v.pauseInvisible.isHidden()||(n.vars.initDelay>0?n.startTimeout=setTimeout(n.play,n.vars.initDelay):n.play())),h&&v.asNav.setup(),r&&n.vars.touch&&v.touch(),(!f||f&&n.vars.smoothHeight)&&t(window).bind("resize orientationchange focus",v.resize),n.find("img").attr("draggable","false"),setTimeout(function(){n.vars.start(n)},200)},asNav:{setup:function(){n.asNav=!0,n.animatingTo=Math.floor(n.currentSlide/n.move),n.currentItem=n.currentSlide,n.slides.removeClass(a+"active-slide").eq(n.currentItem).addClass(a+"active-slide"),o?(e._slider=n,n.slides.each(function(){var e=this;e._gesture=new MSGesture,e._gesture.target=e,e.addEventListener("MSPointerDown",function(t){t.preventDefault(),t.currentTarget._gesture&&t.currentTarget._gesture.addPointer(t.pointerId)},!1),e.addEventListener("MSGestureTap",function(e){e.preventDefault();var i=t(this),s=i.index();t(n.vars.asNavFor).data("flexslider").animating||i.hasClass("active")||(n.direction=n.currentItem<s?"next":"prev",n.flexAnimate(s,n.vars.pauseOnAction,!1,!0,!0))})})):n.slides.click(function(e){e.preventDefault();var i=t(this),s=i.index(),o=i.offset().left-t(n).scrollLeft();0>=o&&i.hasClass(a+"active-slide")?n.flexAnimate(n.getTarget("prev"),!0):t(n.vars.asNavFor).data("flexslider").animating||i.hasClass(a+"active-slide")||(n.direction=n.currentItem<s?"next":"prev",n.flexAnimate(s,n.vars.pauseOnAction,!1,!0,!0))})}},controlNav:{setup:function(){n.manualControls?v.controlNav.setupManual():v.controlNav.setupPaging()},setupPaging:function(){var e,i,s="thumbnails"===n.vars.controlNav?"control-thumbs":"control-paging",o=1;if(n.controlNavScaffold=t('<ol class="'+a+"control-nav "+a+s+'"></ol>'),n.pagingCount>1)for(var r=0;r<n.pagingCount;r++){if(i=n.slides.eq(r),e="thumbnails"===n.vars.controlNav?'<img src="'+i.attr("data-thumb")+'"/>':"<a>"+o+"</a>","thumbnails"===n.vars.controlNav&&!0===n.vars.thumbCaptions){var d=i.attr("data-thumbcaption");""!=d&&void 0!=d&&(e+='<span class="'+a+'caption">'+d+"</span>")}n.controlNavScaffold.append("<li>"+e+"</li>"),o++}n.controlsContainer?t(n.controlsContainer).append(n.controlNavScaffold):n.append(n.controlNavScaffold),v.controlNav.set(),v.controlNav.active(),n.controlNavScaffold.delegate("a, img",l,function(e){if(e.preventDefault(),""===c||c===e.type){var i=t(this),s=n.controlNav.index(i);i.hasClass(a+"active")||(n.direction=s>n.currentSlide?"next":"prev",n.flexAnimate(s,n.vars.pauseOnAction))}""===c&&(c=e.type),v.setToClearWatchedEvent()})},setupManual:function(){n.controlNav=n.manualControls,v.controlNav.active(),n.controlNav.bind(l,function(e){if(e.preventDefault(),""===c||c===e.type){var i=t(this),s=n.controlNav.index(i);i.hasClass(a+"active")||(n.direction=s>n.currentSlide?"next":"prev",n.flexAnimate(s,n.vars.pauseOnAction))}""===c&&(c=e.type),v.setToClearWatchedEvent()})},set:function(){var e="thumbnails"===n.vars.controlNav?"img":"a";n.controlNav=t("."+a+"control-nav li "+e,n.controlsContainer?n.controlsContainer:n)},active:function(){n.controlNav.removeClass(a+"active").eq(n.animatingTo).addClass(a+"active")},update:function(e,i){n.pagingCount>1&&"add"===e?n.controlNavScaffold.append(t("<li><a>"+n.count+"</a></li>")):1===n.pagingCount?n.controlNavScaffold.find("li").remove():n.controlNav.eq(i).closest("li").remove(),v.controlNav.set(),n.pagingCount>1&&n.pagingCount!==n.controlNav.length?n.update(i,e):v.controlNav.active()}},directionNav:{setup:function(){var e=t('<ul class="'+a+'direction-nav"><li><a class="'+a+'prev" href="#">'+n.vars.prevText+'</a></li><li><a class="'+a+'next" href="#">'+n.vars.nextText+"</a></li></ul>");n.controlsContainer?(t(n.controlsContainer).append(e),n.directionNav=t("."+a+"direction-nav li a",n.controlsContainer)):(n.append(e),n.directionNav=t("."+a+"direction-nav li a",n)),v.directionNav.update(),n.directionNav.bind(l,function(e){e.preventDefault();var i;(""===c||c===e.type)&&(i=t(this).hasClass(a+"next")?n.getTarget("next"):n.getTarget("prev"),n.flexAnimate(i,n.vars.pauseOnAction)),""===c&&(c=e.type),v.setToClearWatchedEvent()})},update:function(){var t=a+"disabled";1===n.pagingCount?n.directionNav.addClass(t).attr("tabindex","-1"):n.vars.animationLoop?n.directionNav.removeClass(t).removeAttr("tabindex"):0===n.animatingTo?n.directionNav.removeClass(t).filter("."+a+"prev").addClass(t).attr("tabindex","-1"):n.animatingTo===n.last?n.directionNav.removeClass(t).filter("."+a+"next").addClass(t).attr("tabindex","-1"):n.directionNav.removeClass(t).removeAttr("tabindex")}},pausePlay:{setup:function(){var e=t('<div class="'+a+'pauseplay"><a></a></div>');n.controlsContainer?(n.controlsContainer.append(e),n.pausePlay=t("."+a+"pauseplay a",n.controlsContainer)):(n.append(e),n.pausePlay=t("."+a+"pauseplay a",n)),v.pausePlay.update(n.vars.slideshow?a+"pause":a+"play"),n.pausePlay.bind(l,function(e){e.preventDefault(),(""===c||c===e.type)&&(t(this).hasClass(a+"pause")?(n.manualPause=!0,n.manualPlay=!1,n.pause()):(n.manualPause=!1,n.manualPlay=!0,n.play())),""===c&&(c=e.type),v.setToClearWatchedEvent()})},update:function(t){"play"===t?n.pausePlay.removeClass(a+"pause").addClass(a+"play").html(n.vars.playText):n.pausePlay.removeClass(a+"play").addClass(a+"pause").html(n.vars.pauseText)}},touch:function(){function t(t){n.animating?t.preventDefault():(window.navigator.msPointerEnabled||1===t.touches.length)&&(n.pause(),m=d?n.h:n.w,x=Number(new Date),y=t.touches[0].pageX,C=t.touches[0].pageY,v=p&&u&&n.animatingTo===n.last?0:p&&u?n.limit-(n.itemW+n.vars.itemMargin)*n.move*n.animatingTo:p&&n.currentSlide===n.last?n.limit:p?(n.itemW+n.vars.itemMargin)*n.move*n.currentSlide:u?(n.last-n.currentSlide+n.cloneOffset)*m:(n.currentSlide+n.cloneOffset)*m,c=d?C:y,h=d?y:C,e.addEventListener("touchmove",i,!1),e.addEventListener("touchend",s,!1))}function i(t){y=t.touches[0].pageX,C=t.touches[0].pageY,g=d?c-C:c-y,b=d?Math.abs(g)<Math.abs(y-h):Math.abs(g)<Math.abs(C-h);var e=500;(!b||Number(new Date)-x>e)&&(t.preventDefault(),!f&&n.transitions&&(n.vars.animationLoop||(g/=0===n.currentSlide&&0>g||n.currentSlide===n.last&&g>0?Math.abs(g)/m+2:1),n.setProps(v+g,"setTouch")))}function s(){if(e.removeEventListener("touchmove",i,!1),n.animatingTo===n.currentSlide&&!b&&null!==g){var t=u?-g:g,a=t>0?n.getTarget("next"):n.getTarget("prev");n.canAdvance(a)&&(Number(new Date)-x<550&&Math.abs(t)>50||Math.abs(t)>m/2)?n.flexAnimate(a,n.vars.pauseOnAction):f||n.flexAnimate(n.currentSlide,n.vars.pauseOnAction,!0)}e.removeEventListener("touchend",s,!1),c=null,h=null,g=null,v=null}function a(t){t.stopPropagation(),n.animating?t.preventDefault():(n.pause(),e._gesture.addPointer(t.pointerId),w=0,m=d?n.h:n.w,x=Number(new Date),v=p&&u&&n.animatingTo===n.last?0:p&&u?n.limit-(n.itemW+n.vars.itemMargin)*n.move*n.animatingTo:p&&n.currentSlide===n.last?n.limit:p?(n.itemW+n.vars.itemMargin)*n.move*n.currentSlide:u?(n.last-n.currentSlide+n.cloneOffset)*m:(n.currentSlide+n.cloneOffset)*m)}function r(t){t.stopPropagation();var i=t.target._slider;if(i){var n=-t.translationX,s=-t.translationY;return w+=d?s:n,g=w,b=d?Math.abs(w)<Math.abs(-n):Math.abs(w)<Math.abs(-s),t.detail===t.MSGESTURE_FLAG_INERTIA?(setImmediate(function(){e._gesture.stop()}),void 0):((!b||Number(new Date)-x>500)&&(t.preventDefault(),!f&&i.transitions&&(i.vars.animationLoop||(g=w/(0===i.currentSlide&&0>w||i.currentSlide===i.last&&w>0?Math.abs(w)/m+2:1)),i.setProps(v+g,"setTouch"))),void 0)}}function l(t){t.stopPropagation();var e=t.target._slider;if(e){if(e.animatingTo===e.currentSlide&&!b&&null!==g){var i=u?-g:g,n=i>0?e.getTarget("next"):e.getTarget("prev");e.canAdvance(n)&&(Number(new Date)-x<550&&Math.abs(i)>50||Math.abs(i)>m/2)?e.flexAnimate(n,e.vars.pauseOnAction):f||e.flexAnimate(e.currentSlide,e.vars.pauseOnAction,!0)}c=null,h=null,g=null,v=null,w=0}}var c,h,v,m,g,x,b=!1,y=0,C=0,w=0;o?(e.style.msTouchAction="none",e._gesture=new MSGesture,e._gesture.target=e,e.addEventListener("MSPointerDown",a,!1),e._slider=n,e.addEventListener("MSGestureChange",r,!1),e.addEventListener("MSGestureEnd",l,!1)):e.addEventListener("touchstart",t,!1)},resize:function(){!n.animating&&n.is(":visible")&&(p||n.doMath(),f?v.smoothHeight():p?(n.slides.width(n.computedW),n.update(n.pagingCount),n.setProps()):d?(n.viewport.height(n.h),n.setProps(n.h,"setTotal")):(n.vars.smoothHeight&&v.smoothHeight(),n.newSlides.width(n.computedW),n.setProps(n.computedW,"setTotal")))},smoothHeight:function(t){if(!d||f){var e=f?n:n.viewport;t?e.animate({height:n.slides.eq(n.animatingTo).height()},t):e.height(n.slides.eq(n.animatingTo).height())}},sync:function(e){var i=t(n.vars.sync).data("flexslider"),s=n.animatingTo;switch(e){case"animate":i.flexAnimate(s,n.vars.pauseOnAction,!1,!0);break;case"play":!i.playing&&!i.asNav&&i.play();break;case"pause":i.pause()}},pauseInvisible:{visProp:null,init:function(){var t=["webkit","moz","ms","o"];if("hidden"in document)return"hidden";for(var e=0;e<t.length;e++)t[e]+"Hidden"in document&&(v.pauseInvisible.visProp=t[e]+"Hidden");if(v.pauseInvisible.visProp){var i=v.pauseInvisible.visProp.replace(/[H|h]idden/,"")+"visibilitychange";document.addEventListener(i,function(){v.pauseInvisible.isHidden()?n.startTimeout?clearTimeout(n.startTimeout):n.pause():n.started?n.play():n.vars.initDelay>0?setTimeout(n.play,n.vars.initDelay):n.play()})}},isHidden:function(){return document[v.pauseInvisible.visProp]||!1}},setToClearWatchedEvent:function(){clearTimeout(s),s=setTimeout(function(){c=""},3e3)}},n.flexAnimate=function(e,i,s,o,l){if(!n.vars.animationLoop&&e!==n.currentSlide&&(n.direction=e>n.currentSlide?"next":"prev"),h&&1===n.pagingCount&&(n.direction=n.currentItem<e?"next":"prev"),!n.animating&&(n.canAdvance(e,l)||s)&&n.is(":visible")){if(h&&o){var c=t(n.vars.asNavFor).data("flexslider");if(n.atEnd=0===e||e===n.count-1,c.flexAnimate(e,!0,!1,!0,l),n.direction=n.currentItem<e?"next":"prev",c.direction=n.direction,Math.ceil((e+1)/n.visible)-1===n.currentSlide||0===e)return n.currentItem=e,n.slides.removeClass(a+"active-slide").eq(e).addClass(a+"active-slide"),!1;n.currentItem=e,n.slides.removeClass(a+"active-slide").eq(e).addClass(a+"active-slide"),e=Math.floor(e/n.visible)}if(n.animating=!0,n.animatingTo=e,i&&n.pause(),n.vars.before(n),n.syncExists&&!l&&v.sync("animate"),n.vars.controlNav&&v.controlNav.active(),p||n.slides.removeClass(a+"active-slide").eq(e).addClass(a+"active-slide"),n.atEnd=0===e||e===n.last,n.vars.directionNav&&v.directionNav.update(),e===n.last&&(n.vars.end(n),n.vars.animationLoop||n.pause()),f)r?(n.slides.eq(n.currentSlide).css({opacity:0,zIndex:1}),n.slides.eq(e).css({opacity:1,zIndex:2}),n.wrapup(b)):(n.slides.eq(n.currentSlide).css({zIndex:1}).animate({opacity:0},n.vars.animationSpeed,n.vars.easing),n.slides.eq(e).css({zIndex:2}).animate({opacity:1},n.vars.animationSpeed,n.vars.easing,n.wrapup));else{var m,g,x,b=d?n.slides.filter(":first").height():n.computedW;p?(m=n.vars.itemMargin,x=(n.itemW+m)*n.move*n.animatingTo,g=x>n.limit&&1!==n.visible?n.limit:x):g=0===n.currentSlide&&e===n.count-1&&n.vars.animationLoop&&"next"!==n.direction?u?(n.count+n.cloneOffset)*b:0:n.currentSlide===n.last&&0===e&&n.vars.animationLoop&&"prev"!==n.direction?u?0:(n.count+1)*b:u?(n.count-1-e+n.cloneOffset)*b:(e+n.cloneOffset)*b,n.setProps(g,"",n.vars.animationSpeed),n.transitions?(n.vars.animationLoop&&n.atEnd||(n.animating=!1,n.currentSlide=n.animatingTo),n.container.unbind("webkitTransitionEnd transitionend"),n.container.bind("webkitTransitionEnd transitionend",function(){n.wrapup(b)})):n.container.animate(n.args,n.vars.animationSpeed,n.vars.easing,function(){n.wrapup(b)})}n.vars.smoothHeight&&v.smoothHeight(n.vars.animationSpeed)}},n.wrapup=function(t){!f&&!p&&(0===n.currentSlide&&n.animatingTo===n.last&&n.vars.animationLoop?n.setProps(t,"jumpEnd"):n.currentSlide===n.last&&0===n.animatingTo&&n.vars.animationLoop&&n.setProps(t,"jumpStart")),n.animating=!1,n.currentSlide=n.animatingTo,n.vars.after(n)},n.animateSlides=function(){!n.animating&&m&&n.flexAnimate(n.getTarget("next"))},n.pause=function(){clearInterval(n.animatedSlides),n.animatedSlides=null,n.playing=!1,n.vars.pausePlay&&v.pausePlay.update("play"),n.syncExists&&v.sync("pause")},n.play=function(){n.playing&&clearInterval(n.animatedSlides),n.animatedSlides=n.animatedSlides||setInterval(n.animateSlides,n.vars.slideshowSpeed),n.started=n.playing=!0,n.vars.pausePlay&&v.pausePlay.update("pause"),n.syncExists&&v.sync("play")},n.stop=function(){n.pause(),n.stopped=!0},n.canAdvance=function(t,e){var i=h?n.pagingCount-1:n.last;return e?!0:h&&n.currentItem===n.count-1&&0===t&&"prev"===n.direction?!0:h&&0===n.currentItem&&t===n.pagingCount-1&&"next"!==n.direction?!1:t!==n.currentSlide||h?n.vars.animationLoop?!0:n.atEnd&&0===n.currentSlide&&t===i&&"next"!==n.direction?!1:n.atEnd&&n.currentSlide===i&&0===t&&"next"===n.direction?!1:!0:!1},n.getTarget=function(t){return n.direction=t,"next"===t?n.currentSlide===n.last?0:n.currentSlide+1:0===n.currentSlide?n.last:n.currentSlide-1},n.setProps=function(t,e,i){var s=function(){var i=t?t:(n.itemW+n.vars.itemMargin)*n.move*n.animatingTo,s=function(){if(p)return"setTouch"===e?t:u&&n.animatingTo===n.last?0:u?n.limit-(n.itemW+n.vars.itemMargin)*n.move*n.animatingTo:n.animatingTo===n.last?n.limit:i;switch(e){case"setTotal":return u?(n.count-1-n.currentSlide+n.cloneOffset)*t:(n.currentSlide+n.cloneOffset)*t;case"setTouch":return u?t:t;case"jumpEnd":return u?t:n.count*t;case"jumpStart":return u?n.count*t:t;default:return t}}();return-1*s+"px"}();n.transitions&&(s=d?"translate3d(0,"+s+",0)":"translate3d("+s+",0,0)",i=void 0!==i?i/1e3+"s":"0s",n.container.css("-"+n.pfx+"-transition-duration",i)),n.args[n.prop]=s,(n.transitions||void 0===i)&&n.container.css(n.args)},n.setup=function(e){if(f)n.slides.css({width:"100%","float":"left",marginRight:"-100%",position:"relative"}),"init"===e&&(r?n.slides.css({opacity:0,display:"block",webkitTransition:"opacity "+n.vars.animationSpeed/1e3+"s ease",zIndex:1}).eq(n.currentSlide).css({opacity:1,zIndex:2}):n.slides.css({opacity:0,display:"block",zIndex:1}).eq(n.currentSlide).css({zIndex:2}).animate({opacity:1},n.vars.animationSpeed,n.vars.easing)),n.vars.smoothHeight&&v.smoothHeight();else{var i,s;"init"===e&&(n.viewport=t('<div class="'+a+'viewport"></div>').css({overflow:"hidden",position:"relative"}).appendTo(n).append(n.container),n.cloneCount=0,n.cloneOffset=0,u&&(s=t.makeArray(n.slides).reverse(),n.slides=t(s),n.container.empty().append(n.slides))),n.vars.animationLoop&&!p&&(n.cloneCount=2,n.cloneOffset=1,"init"!==e&&n.container.find(".clone").remove(),n.container.append(n.slides.first().clone().addClass("clone").attr("aria-hidden","true")).prepend(n.slides.last().clone().addClass("clone").attr("aria-hidden","true"))),n.newSlides=t(n.vars.selector,n),i=u?n.count-1-n.currentSlide+n.cloneOffset:n.currentSlide+n.cloneOffset,d&&!p?(n.container.height(200*(n.count+n.cloneCount)+"%").css("position","absolute").width("100%"),setTimeout(function(){n.newSlides.css({display:"block"}),n.doMath(),n.viewport.height(n.h),n.setProps(i*n.h,"init")},"init"===e?100:0)):(n.container.width(200*(n.count+n.cloneCount)+"%"),n.setProps(i*n.computedW,"init"),setTimeout(function(){n.doMath(),n.newSlides.css({width:n.computedW,"float":"left",display:"block"}),n.vars.smoothHeight&&v.smoothHeight()},"init"===e?100:0))}p||n.slides.removeClass(a+"active-slide").eq(n.currentSlide).addClass(a+"active-slide")},n.doMath=function(){var t=n.slides.first(),e=n.vars.itemMargin,i=n.vars.minItems,s=n.vars.maxItems;n.w=void 0===n.viewport?n.width():n.viewport.width(),n.h=t.height(),n.boxPadding=t.outerWidth()-t.width(),p?(n.itemT=n.vars.itemWidth+e,n.minW=i?i*n.itemT:n.w,n.maxW=s?s*n.itemT-e:n.w,n.itemW=n.minW>n.w?(n.w-e*(i-1))/i:n.maxW<n.w?(n.w-e*(s-1))/s:n.vars.itemWidth>n.w?n.w:n.vars.itemWidth,n.visible=Math.floor(n.w/n.itemW),n.move=n.vars.move>0&&n.vars.move<n.visible?n.vars.move:n.visible,n.pagingCount=Math.ceil((n.count-n.visible)/n.move+1),n.last=n.pagingCount-1,n.limit=1===n.pagingCount?0:n.vars.itemWidth>n.w?n.itemW*(n.count-1)+e*(n.count-1):(n.itemW+e)*n.count-n.w-e):(n.itemW=n.w,n.pagingCount=n.count,n.last=n.count-1),n.computedW=n.itemW-n.boxPadding},n.update=function(t,e){n.doMath(),p||(t<n.currentSlide?n.currentSlide+=1:t<=n.currentSlide&&0!==t&&(n.currentSlide-=1),n.animatingTo=n.currentSlide),n.vars.controlNav&&!n.manualControls&&("add"===e&&!p||n.pagingCount>n.controlNav.length?v.controlNav.update("add"):("remove"===e&&!p||n.pagingCount<n.controlNav.length)&&(p&&n.currentSlide>n.last&&(n.currentSlide-=1,n.animatingTo-=1),v.controlNav.update("remove",n.last))),n.vars.directionNav&&v.directionNav.update()},n.addSlide=function(e,i){var s=t(e);n.count+=1,n.last=n.count-1,d&&u?void 0!==i?n.slides.eq(n.count-i).after(s):n.container.prepend(s):void 0!==i?n.slides.eq(i).before(s):n.container.append(s),n.update(i,"add"),n.slides=t(n.vars.selector+":not(.clone)",n),n.setup(),n.vars.added(n)},n.removeSlide=function(e){var i=isNaN(e)?n.slides.index(t(e)):e;n.count-=1,n.last=n.count-1,isNaN(e)?t(e,n.slides).remove():d&&u?n.slides.eq(n.last).remove():n.slides.eq(e).remove(),n.doMath(),n.update(i,"remove"),n.slides=t(n.vars.selector+":not(.clone)",n),n.setup(),n.vars.removed(n)},v.init()},t(window).blur(function(){focused=!1}).focus(function(){focused=!0}),t.flexslider.defaults={namespace:"flex-",selector:".slides > li",animation:"fade",easing:"swing",direction:"horizontal",reverse:!1,animationLoop:!0,smoothHeight:!1,startAt:0,slideshow:!0,slideshowSpeed:7e3,animationSpeed:600,initDelay:0,randomize:!1,thumbCaptions:!1,pauseOnAction:!0,pauseOnHover:!1,pauseInvisible:!0,useCSS:!0,touch:!0,video:!1,controlNav:!0,directionNav:!0,prevText:"Previous",nextText:"Next",keyboard:!0,multipleKeyboard:!1,mousewheel:!1,pausePlay:!1,pauseText:"Pause",playText:"Play",controlsContainer:"",manualControls:"",sync:"",asNavFor:"",itemWidth:0,itemMargin:0,minItems:1,maxItems:0,move:0,allowOneSlide:!0,start:function(){},before:function(){},after:function(){},end:function(){},added:function(){},removed:function(){}},t.fn.flexslider=function(e){if(void 0===e&&(e={}),"object"==typeof e)return this.each(function(){var i=t(this),n=e.selector?e.selector:".slides > li",s=i.find(n);1===s.length&&e.allowOneSlide===!0||0===s.length?(s.fadeIn(400),e.start&&e.start(i)):void 0===i.data("flexslider")&&new t.flexslider(this,e)});var i=t(this).data("flexslider");switch(e){case"play":i.play();break;case"pause":i.pause();break;case"stop":i.stop();break;case"next":i.flexAnimate(i.getTarget("next"),!0);break;case"prev":case"previous":i.flexAnimate(i.getTarget("prev"),!0);break;default:"number"==typeof e&&i.flexAnimate(e,!0)}}}(jQuery);

/*! Magnific Popup - v0.9.3 - 2013-07-16
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2013 Dmitry Semenov; */
(function(e){var t,i,n,o,a,r,s,l="Close",c="BeforeClose",d="AfterClose",u="BeforeAppend",p="MarkupParse",f="Open",m="Change",g="mfp",v="."+g,h="mfp-ready",C="mfp-removing",y="mfp-prevent-close",w=function(){},b=!!window.jQuery,I=e(window),x=function(e,i){t.ev.on(g+e+v,i)},k=function(t,i,n,o){var a=document.createElement("div");return a.className="mfp-"+t,n&&(a.innerHTML=n),o?i&&i.appendChild(a):(a=e(a),i&&a.appendTo(i)),a},T=function(i,n){t.ev.triggerHandler(g+i,n),t.st.callbacks&&(i=i.charAt(0).toLowerCase()+i.slice(1),t.st.callbacks[i]&&t.st.callbacks[i].apply(t,e.isArray(n)?n:[n]))},E=function(){(t.st.focus?t.content.find(t.st.focus).eq(0):t.wrap).trigger("focus")},S=function(i){return i===s&&t.currTemplate.closeBtn||(t.currTemplate.closeBtn=e(t.st.closeMarkup.replace("%title%",t.st.tClose)),s=i),t.currTemplate.closeBtn},P=function(){e.magnificPopup.instance||(t=new w,t.init(),e.magnificPopup.instance=t)},_=function(i){if(!e(i).hasClass(y)){var n=t.st.closeOnContentClick,o=t.st.closeOnBgClick;if(n&&o)return!0;if(!t.content||e(i).hasClass("mfp-close")||t.preloader&&i===t.preloader[0])return!0;if(i===t.content[0]||e.contains(t.content[0],i)){if(n)return!0}else if(o&&e.contains(document,i))return!0;return!1}},O=function(){var e=document.createElement("p").style,t=["ms","O","Moz","Webkit"];if(void 0!==e.transition)return!0;for(;t.length;)if(t.pop()+"Transition"in e)return!0;return!1};w.prototype={constructor:w,init:function(){var i=navigator.appVersion;t.isIE7=-1!==i.indexOf("MSIE 7."),t.isIE8=-1!==i.indexOf("MSIE 8."),t.isLowIE=t.isIE7||t.isIE8,t.isAndroid=/android/gi.test(i),t.isIOS=/iphone|ipad|ipod/gi.test(i),t.supportsTransition=O(),t.probablyMobile=t.isAndroid||t.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),n=e(document.body),o=e(document),t.popupsCache={}},open:function(i){var n;if(i.isObj===!1){t.items=i.items.toArray(),t.index=0;var a,s=i.items;for(n=0;s.length>n;n++)if(a=s[n],a.parsed&&(a=a.el[0]),a===i.el[0]){t.index=n;break}}else t.items=e.isArray(i.items)?i.items:[i.items],t.index=i.index||0;if(t.isOpen)return t.updateItemHTML(),void 0;t.types=[],r="",t.ev=i.mainEl&&i.mainEl.length?i.mainEl.eq(0):o,i.key?(t.popupsCache[i.key]||(t.popupsCache[i.key]={}),t.currTemplate=t.popupsCache[i.key]):t.currTemplate={},t.st=e.extend(!0,{},e.magnificPopup.defaults,i),t.fixedContentPos="auto"===t.st.fixedContentPos?!t.probablyMobile:t.st.fixedContentPos,t.st.modal&&(t.st.closeOnContentClick=!1,t.st.closeOnBgClick=!1,t.st.showCloseBtn=!1,t.st.enableEscapeKey=!1),t.bgOverlay||(t.bgOverlay=k("bg").on("click"+v,function(){t.close()}),t.wrap=k("wrap").attr("tabindex",-1).on("click"+v,function(e){_(e.target)&&t.close()}),t.container=k("container",t.wrap)),t.contentContainer=k("content"),t.st.preloader&&(t.preloader=k("preloader",t.container,t.st.tLoading));var l=e.magnificPopup.modules;for(n=0;l.length>n;n++){var c=l[n];c=c.charAt(0).toUpperCase()+c.slice(1),t["init"+c].call(t)}T("BeforeOpen"),t.st.showCloseBtn&&(t.st.closeBtnInside?(x(p,function(e,t,i,n){i.close_replaceWith=S(n.type)}),r+=" mfp-close-btn-in"):t.wrap.append(S())),t.st.alignTop&&(r+=" mfp-align-top"),t.fixedContentPos?t.wrap.css({overflow:t.st.overflowY,overflowX:"hidden",overflowY:t.st.overflowY}):t.wrap.css({top:I.scrollTop(),position:"absolute"}),(t.st.fixedBgPos===!1||"auto"===t.st.fixedBgPos&&!t.fixedContentPos)&&t.bgOverlay.css({height:o.height(),position:"absolute"}),t.st.enableEscapeKey&&o.on("keyup"+v,function(e){27===e.keyCode&&t.close()}),I.on("resize"+v,function(){t.updateSize()}),t.st.closeOnContentClick||(r+=" mfp-auto-cursor"),r&&t.wrap.addClass(r);var d=t.wH=I.height(),u={};if(t.fixedContentPos&&t._hasScrollBar(d)){var m=t._getScrollbarSize();m&&(u.paddingRight=m)}t.fixedContentPos&&(t.isIE7?e("body, html").css("overflow","hidden"):u.overflow="hidden");var g=t.st.mainClass;t.isIE7&&(g+=" mfp-ie7"),g&&t._addClassToMFP(g),t.updateItemHTML(),T("BuildControls"),e("html").css(u),t.bgOverlay.add(t.wrap).prependTo(document.body),t._lastFocusedEl=document.activeElement,setTimeout(function(){t.content?(t._addClassToMFP(h),E()):t.bgOverlay.addClass(h),o.on("focusin"+v,function(i){return i.target===t.wrap[0]||e.contains(t.wrap[0],i.target)?void 0:(E(),!1)})},16),t.isOpen=!0,t.updateSize(d),T(f)},close:function(){t.isOpen&&(T(c),t.isOpen=!1,t.st.removalDelay&&!t.isLowIE&&t.supportsTransition?(t._addClassToMFP(C),setTimeout(function(){t._close()},t.st.removalDelay)):t._close())},_close:function(){T(l);var i=C+" "+h+" ";if(t.bgOverlay.detach(),t.wrap.detach(),t.container.empty(),t.st.mainClass&&(i+=t.st.mainClass+" "),t._removeClassFromMFP(i),t.fixedContentPos){var n={paddingRight:""};t.isIE7?e("body, html").css("overflow",""):n.overflow="",e("html").css(n)}o.off("keyup"+v+" focusin"+v),t.ev.off(v),t.wrap.attr("class","mfp-wrap").removeAttr("style"),t.bgOverlay.attr("class","mfp-bg"),t.container.attr("class","mfp-container"),!t.st.showCloseBtn||t.st.closeBtnInside&&t.currTemplate[t.currItem.type]!==!0||t.currTemplate.closeBtn&&t.currTemplate.closeBtn.detach(),t._lastFocusedEl&&e(t._lastFocusedEl).trigger("focus"),t.currItem=null,t.content=null,t.currTemplate=null,t.prevHeight=0,T(d)},updateSize:function(e){if(t.isIOS){var i=document.documentElement.clientWidth/window.innerWidth,n=window.innerHeight*i;t.wrap.css("height",n),t.wH=n}else t.wH=e||I.height();t.fixedContentPos||t.wrap.css("height",t.wH),T("Resize")},updateItemHTML:function(){var i=t.items[t.index];t.contentContainer.detach(),t.content&&t.content.detach(),i.parsed||(i=t.parseEl(t.index));var n=i.type;if(T("BeforeChange",[t.currItem?t.currItem.type:"",n]),t.currItem=i,!t.currTemplate[n]){var o=t.st[n]?t.st[n].markup:!1;T("FirstMarkupParse",o),t.currTemplate[n]=o?e(o):!0}a&&a!==i.type&&t.container.removeClass("mfp-"+a+"-holder");var r=t["get"+n.charAt(0).toUpperCase()+n.slice(1)](i,t.currTemplate[n]);t.appendContent(r,n),i.preloaded=!0,T(m,i),a=i.type,t.container.prepend(t.contentContainer),T("AfterChange")},appendContent:function(e,i){t.content=e,e?t.st.showCloseBtn&&t.st.closeBtnInside&&t.currTemplate[i]===!0?t.content.find(".mfp-close").length||t.content.append(S()):t.content=e:t.content="",T(u),t.container.addClass("mfp-"+i+"-holder"),t.contentContainer.append(t.content)},parseEl:function(i){var n=t.items[i],o=n.type;if(n=n.tagName?{el:e(n)}:{data:n,src:n.src},n.el){for(var a=t.types,r=0;a.length>r;r++)if(n.el.hasClass("mfp-"+a[r])){o=a[r];break}n.src=n.el.attr("data-mfp-src"),n.src||(n.src=n.el.attr("href"))}return n.type=o||t.st.type||"inline",n.index=i,n.parsed=!0,t.items[i]=n,T("ElementParse",n),t.items[i]},addGroup:function(e,i){var n=function(n){n.mfpEl=this,t._openClick(n,e,i)};i||(i={});var o="click.magnificPopup";i.mainEl=e,i.items?(i.isObj=!0,e.off(o).on(o,n)):(i.isObj=!1,i.delegate?e.off(o).on(o,i.delegate,n):(i.items=e,e.off(o).on(o,n)))},_openClick:function(i,n,o){var a=void 0!==o.midClick?o.midClick:e.magnificPopup.defaults.midClick;if(a||2!==i.which&&!i.ctrlKey&&!i.metaKey){var r=void 0!==o.disableOn?o.disableOn:e.magnificPopup.defaults.disableOn;if(r)if(e.isFunction(r)){if(!r.call(t))return!0}else if(r>I.width())return!0;i.type&&(i.preventDefault(),t.isOpen&&i.stopPropagation()),o.el=e(i.mfpEl),o.delegate&&(o.items=n.find(o.delegate)),t.open(o)}},updateStatus:function(e,n){if(t.preloader){i!==e&&t.container.removeClass("mfp-s-"+i),n||"loading"!==e||(n=t.st.tLoading);var o={status:e,text:n};T("UpdateStatus",o),e=o.status,n=o.text,t.preloader.html(n),t.preloader.find("a").on("click",function(e){e.stopImmediatePropagation()}),t.container.addClass("mfp-s-"+e),i=e}},_addClassToMFP:function(e){t.bgOverlay.addClass(e),t.wrap.addClass(e)},_removeClassFromMFP:function(e){this.bgOverlay.removeClass(e),t.wrap.removeClass(e)},_hasScrollBar:function(e){return(t.isIE7?o.height():document.body.scrollHeight)>(e||I.height())},_parseMarkup:function(t,i,n){var o;n.data&&(i=e.extend(n.data,i)),T(p,[t,i,n]),e.each(i,function(e,i){if(void 0===i||i===!1)return!0;if(o=e.split("_"),o.length>1){var n=t.find(v+"-"+o[0]);if(n.length>0){var a=o[1];"replaceWith"===a?n[0]!==i[0]&&n.replaceWith(i):"img"===a?n.is("img")?n.attr("src",i):n.replaceWith('<img src="'+i+'" class="'+n.attr("class")+'" />'):n.attr(o[1],i)}}else t.find(v+"-"+e).html(i)})},_getScrollbarSize:function(){if(void 0===t.scrollbarSize){var e=document.createElement("div");e.id="mfp-sbm",e.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(e),t.scrollbarSize=e.offsetWidth-e.clientWidth,document.body.removeChild(e)}return t.scrollbarSize}},e.magnificPopup={instance:null,proto:w.prototype,modules:[],open:function(e,t){return P(),e||(e={}),e.isObj=!0,e.index=t||0,this.instance.open(e)},close:function(){return e.magnificPopup.instance.close()},registerModule:function(t,i){i.options&&(e.magnificPopup.defaults[t]=i.options),e.extend(this.proto,i.proto),this.modules.push(t)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&times;</button>',tClose:"Close (Esc)",tLoading:"Loading..."}},e.fn.magnificPopup=function(i){P();var n=e(this);if("string"==typeof i)if("open"===i){var o,a=b?n.data("magnificPopup"):n[0].magnificPopup,r=parseInt(arguments[1],10)||0;a.items?o=a.items[r]:(o=n,a.delegate&&(o=o.find(a.delegate)),o=o.eq(r)),t._openClick({mfpEl:o},n,a)}else t.isOpen&&t[i].apply(t,Array.prototype.slice.call(arguments,1));else b?n.data("magnificPopup",i):n[0].magnificPopup=i,t.addGroup(n,i);return n};var z,M,B,H="inline",L=function(){B&&(M.after(B.addClass(z)).detach(),B=null)};e.magnificPopup.registerModule(H,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){t.types.push(H),x(l+"."+H,function(){L()})},getInline:function(i,n){if(L(),i.src){var o=t.st.inline,a=e(i.src);if(a.length){var r=a[0].parentNode;r&&r.tagName&&(M||(z=o.hiddenClass,M=k(z),z="mfp-"+z),B=a.after(M).detach().removeClass(z)),t.updateStatus("ready")}else t.updateStatus("error",o.tNotFound),a=e("<div>");return i.inlineElement=a,a}return t.updateStatus("ready"),t._parseMarkup(n,{},i),n}}});var A,F="ajax",j=function(){A&&n.removeClass(A)};e.magnificPopup.registerModule(F,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){t.types.push(F),A=t.st.ajax.cursor,x(l+"."+F,function(){j(),t.req&&t.req.abort()})},getAjax:function(i){A&&n.addClass(A),t.updateStatus("loading");var o=e.extend({url:i.src,success:function(n,o,a){var r={data:n,xhr:a};T("ParseAjax",r),t.appendContent(e(r.data),F),i.finished=!0,j(),E(),setTimeout(function(){t.wrap.addClass(h)},16),t.updateStatus("ready"),T("AjaxContentAdded")},error:function(){j(),i.finished=i.loadError=!0,t.updateStatus("error",t.st.ajax.tError.replace("%url%",i.src))}},t.st.ajax.settings);return t.req=e.ajax(o),""}}});var N,W=function(i){if(i.data&&void 0!==i.data.title)return i.data.title;var n=t.st.image.titleSrc;if(n){if(e.isFunction(n))return n.call(t,i);if(i.el)return i.el.attr(n)||""}return""};e.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><div class="mfp-img"></div><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var e=t.st.image,i=".image";t.types.push("image"),x(f+i,function(){"image"===t.currItem.type&&e.cursor&&n.addClass(e.cursor)}),x(l+i,function(){e.cursor&&n.removeClass(e.cursor),I.off("resize"+v)}),x("Resize"+i,t.resizeImage),t.isLowIE&&x("AfterChange",t.resizeImage)},resizeImage:function(){var e=t.currItem;if(e.img&&t.st.image.verticalFit){var i=0;t.isLowIE&&(i=parseInt(e.img.css("padding-top"),10)+parseInt(e.img.css("padding-bottom"),10)),e.img.css("max-height",t.wH-i)}},_onImageHasSize:function(e){e.img&&(e.hasSize=!0,N&&clearInterval(N),e.isCheckingImgSize=!1,T("ImageHasSize",e),e.imgHidden&&(t.content&&t.content.removeClass("mfp-loading"),e.imgHidden=!1))},findImageSize:function(e){var i=0,n=e.img[0],o=function(a){N&&clearInterval(N),N=setInterval(function(){return n.naturalWidth>0?(t._onImageHasSize(e),void 0):(i>200&&clearInterval(N),i++,3===i?o(10):40===i?o(50):100===i&&o(500),void 0)},a)};o(1)},getImage:function(i,n){var o=0,a=function(){i&&(i.img[0].complete?(i.img.off(".mfploader"),i===t.currItem&&(t._onImageHasSize(i),t.updateStatus("ready")),i.hasSize=!0,i.loaded=!0,T("ImageLoadComplete")):(o++,200>o?setTimeout(a,100):r()))},r=function(){i&&(i.img.off(".mfploader"),i===t.currItem&&(t._onImageHasSize(i),t.updateStatus("error",s.tError.replace("%url%",i.src))),i.hasSize=!0,i.loaded=!0,i.loadError=!0)},s=t.st.image,l=n.find(".mfp-img");if(l.length){var c=new Image;c.className="mfp-img",i.img=e(c).on("load.mfploader",a).on("error.mfploader",r),c.src=i.src,l.is("img")&&(i.img=i.img.clone()),i.img[0].naturalWidth>0&&(i.hasSize=!0)}return t._parseMarkup(n,{title:W(i),img_replaceWith:i.img},i),t.resizeImage(),i.hasSize?(N&&clearInterval(N),i.loadError?(n.addClass("mfp-loading"),t.updateStatus("error",s.tError.replace("%url%",i.src))):(n.removeClass("mfp-loading"),t.updateStatus("ready")),n):(t.updateStatus("loading"),i.loading=!0,i.hasSize||(i.imgHidden=!0,n.addClass("mfp-loading"),t.findImageSize(i)),n)}}});var R,Z=function(){return void 0===R&&(R=void 0!==document.createElement("p").style.MozTransform),R};e.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(e){return e.is("img")?e:e.find("img")}},proto:{initZoom:function(){var e=t.st.zoom,i=".zoom";if(e.enabled&&t.supportsTransition){var n,o,a=e.duration,r=function(t){var i=t.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),n="all "+e.duration/1e3+"s "+e.easing,o={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},a="transition";return o["-webkit-"+a]=o["-moz-"+a]=o["-o-"+a]=o[a]=n,i.css(o),i},s=function(){t.content.css("visibility","visible")};x("BuildControls"+i,function(){if(t._allowZoom()){if(clearTimeout(n),t.content.css("visibility","hidden"),image=t._getItemToZoom(),!image)return s(),void 0;o=r(image),o.css(t._getOffset()),t.wrap.append(o),n=setTimeout(function(){o.css(t._getOffset(!0)),n=setTimeout(function(){s(),setTimeout(function(){o.remove(),image=o=null,T("ZoomAnimationEnded")},16)},a)},16)}}),x(c+i,function(){if(t._allowZoom()){if(clearTimeout(n),t.st.removalDelay=a,!image){if(image=t._getItemToZoom(),!image)return;o=r(image)}o.css(t._getOffset(!0)),t.wrap.append(o),t.content.css("visibility","hidden"),setTimeout(function(){o.css(t._getOffset())},16)}}),x(l+i,function(){t._allowZoom()&&(s(),o&&o.remove())})}},_allowZoom:function(){return"image"===t.currItem.type},_getItemToZoom:function(){return t.currItem.hasSize?t.currItem.img:!1},_getOffset:function(i){var n;n=i?t.currItem.img:t.st.zoom.opener(t.currItem.el||t.currItem);var o=n.offset(),a=parseInt(n.css("padding-top"),10),r=parseInt(n.css("padding-bottom"),10);o.top-=e(window).scrollTop()-a;var s={width:n.width(),height:(b?n.innerHeight():n[0].offsetHeight)-r-a};return Z()?s["-moz-transform"]=s.transform="translate("+o.left+"px,"+o.top+"px)":(s.left=o.left,s.top=o.top),s}}});var q="iframe",D="//about:blank",K=function(e){if(t.currTemplate[q]){var i=t.currTemplate[q].find("iframe");i.length&&(e||(i[0].src=D),t.isIE8&&i.css("display",e?"block":"none"))}};e.magnificPopup.registerModule(q,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){t.types.push(q),x("BeforeChange",function(e,t,i){t!==i&&(t===q?K():i===q&&K(!0))}),x(l+"."+q,function(){K()})},getIframe:function(i,n){var o=i.src,a=t.st.iframe;e.each(a.patterns,function(){return o.indexOf(this.index)>-1?(this.id&&(o="string"==typeof this.id?o.substr(o.lastIndexOf(this.id)+this.id.length,o.length):this.id.call(this,o)),o=this.src.replace("%id%",o),!1):void 0});var r={};return a.srcAction&&(r[a.srcAction]=o),t._parseMarkup(n,r,i),t.updateStatus("ready"),n}}});var Y=function(e){var i=t.items.length;return e>i-1?e-i:0>e?i+e:e},U=function(e,t,i){return e.replace("%curr%",t+1).replace("%total%",i)};e.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var i=t.st.gallery,n=".mfp-gallery",a=Boolean(e.fn.mfpFastClick);return t.direction=!0,i&&i.enabled?(r+=" mfp-gallery",x(f+n,function(){i.navigateByImgClick&&t.wrap.on("click"+n,".mfp-img",function(){return t.items.length>1?(t.next(),!1):void 0}),o.on("keydown"+n,function(e){37===e.keyCode?t.prev():39===e.keyCode&&t.next()})}),x("UpdateStatus"+n,function(e,i){i.text&&(i.text=U(i.text,t.currItem.index,t.items.length))}),x(p+n,function(e,n,o,a){var r=t.items.length;o.counter=r>1?U(i.tCounter,a.index,r):""}),x("BuildControls"+n,function(){if(t.items.length>1&&i.arrows&&!t.arrowLeft){var n=i.arrowMarkup,o=t.arrowLeft=e(n.replace("%title%",i.tPrev).replace("%dir%","left")).addClass(y),r=t.arrowRight=e(n.replace("%title%",i.tNext).replace("%dir%","right")).addClass(y),s=a?"mfpFastClick":"click";o[s](function(){t.prev()}),r[s](function(){t.next()}),t.isIE7&&(k("b",o[0],!1,!0),k("a",o[0],!1,!0),k("b",r[0],!1,!0),k("a",r[0],!1,!0)),t.container.append(o.add(r))}}),x(m+n,function(){t._preloadTimeout&&clearTimeout(t._preloadTimeout),t._preloadTimeout=setTimeout(function(){t.preloadNearbyImages(),t._preloadTimeout=null},16)}),x(l+n,function(){o.off(n),t.wrap.off("click"+n),t.arrowLeft&&a&&t.arrowLeft.add(t.arrowRight).destroyMfpFastClick(),t.arrowRight=t.arrowLeft=null}),void 0):!1},next:function(){t.direction=!0,t.index=Y(t.index+1),t.updateItemHTML()},prev:function(){t.direction=!1,t.index=Y(t.index-1),t.updateItemHTML()},goTo:function(e){t.direction=e>=t.index,t.index=e,t.updateItemHTML()},preloadNearbyImages:function(){var e,i=t.st.gallery.preload,n=Math.min(i[0],t.items.length),o=Math.min(i[1],t.items.length);for(e=1;(t.direction?o:n)>=e;e++)t._preloadItem(t.index+e);for(e=1;(t.direction?n:o)>=e;e++)t._preloadItem(t.index-e)},_preloadItem:function(i){if(i=Y(i),!t.items[i].preloaded){var n=t.items[i];n.parsed||(n=t.parseEl(i)),T("LazyLoad",n),"image"===n.type&&(n.img=e('<img class="mfp-img" />').on("load.mfploader",function(){n.hasSize=!0}).on("error.mfploader",function(){n.hasSize=!0,n.loadError=!0,T("LazyLoadError",n)}).attr("src",n.src)),n.preloaded=!0}}}});var G="retina";e.magnificPopup.registerModule(G,{options:{replaceSrc:function(e){return e.src.replace(/\.\w+$/,function(e){return"@2x"+e})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var e=t.st.retina,i=e.ratio;i=isNaN(i)?i():i,i>1&&(x("ImageHasSize."+G,function(e,t){t.img.css({"max-width":t.img[0].naturalWidth/i,width:"100%"})}),x("ElementParse."+G,function(t,n){n.src=e.replaceSrc(n,i)}))}}}}),function(){var t=1e3,i="ontouchstart"in window,n=function(){I.off("touchmove"+a+" touchend"+a)},o="mfpFastClick",a="."+o;e.fn.mfpFastClick=function(o){return e(this).each(function(){var r,s=e(this);if(i){var l,c,d,u,p,f;s.on("touchstart"+a,function(e){u=!1,f=1,p=e.originalEvent?e.originalEvent.touches[0]:e.touches[0],c=p.clientX,d=p.clientY,I.on("touchmove"+a,function(e){p=e.originalEvent?e.originalEvent.touches:e.touches,f=p.length,p=p[0],(Math.abs(p.clientX-c)>10||Math.abs(p.clientY-d)>10)&&(u=!0,n())}).on("touchend"+a,function(e){n(),u||f>1||(r=!0,e.preventDefault(),clearTimeout(l),l=setTimeout(function(){r=!1},t),o())})})}s.on("click"+a,function(){r||o()})})},e.fn.destroyMfpFastClick=function(){e(this).off("touchstart"+a+" click"+a),i&&I.off("touchmove"+a+" touchend"+a)}}()})(window.jQuery||window.Zepto);

/**
 * BxSlider v4.1.1 - Fully loaded, responsive content slider
 * http://bxslider.com
 *
 * Copyright 2012, Steven Wanderski - http://stevenwanderski.com - http://bxcreative.com
 * Written while drinking Belgian ales and listening to jazz
 *
 * Released under the WTFPL license - http://sam.zoy.org/wtfpl/
 */
 !function(t){var e={},s={mode:"horizontal",slideSelector:"",infiniteLoop:!0,hideControlOnEnd:!1,speed:500,easing:null,slideMargin:0,startSlide:0,randomStart:!1,captions:!1,ticker:!1,tickerHover:!1,adaptiveHeight:!1,adaptiveHeightSpeed:500,video:!1,useCSS:!0,preloadImages:"visible",responsive:!0,touchEnabled:!0,swipeThreshold:50,oneToOneTouch:!0,preventDefaultSwipeX:!0,preventDefaultSwipeY:!1,pager:!0,pagerType:"full",pagerShortSeparator:" / ",pagerSelector:null,buildPager:null,pagerCustom:null,controls:!0,nextText:"Next",prevText:"Prev",nextSelector:null,prevSelector:null,autoControls:!1,startText:"Start",stopText:"Stop",autoControlsCombine:!1,autoControlsSelector:null,auto:!1,pause:4e3,autoStart:!0,autoDirection:"next",autoHover:!1,autoDelay:0,minSlides:1,maxSlides:1,moveSlides:0,slideWidth:0,onSliderLoad:function(){},onSlideBefore:function(){},onSlideAfter:function(){},onSlideNext:function(){},onSlidePrev:function(){}};t.fn.bxSlider=function(n){if(0==this.length)return this;if(this.length>1)return this.each(function(){t(this).bxSlider(n)}),this;var o={},r=this;e.el=this;var a=t(window).width(),l=t(window).height(),d=function(){o.settings=t.extend({},s,n),o.settings.slideWidth=parseInt(o.settings.slideWidth),o.children=r.children(o.settings.slideSelector),o.children.length<o.settings.minSlides&&(o.settings.minSlides=o.children.length),o.children.length<o.settings.maxSlides&&(o.settings.maxSlides=o.children.length),o.settings.randomStart&&(o.settings.startSlide=Math.floor(Math.random()*o.children.length)),o.active={index:o.settings.startSlide},o.carousel=o.settings.minSlides>1||o.settings.maxSlides>1,o.carousel&&(o.settings.preloadImages="all"),o.minThreshold=o.settings.minSlides*o.settings.slideWidth+(o.settings.minSlides-1)*o.settings.slideMargin,o.maxThreshold=o.settings.maxSlides*o.settings.slideWidth+(o.settings.maxSlides-1)*o.settings.slideMargin,o.working=!1,o.controls={},o.interval=null,o.animProp="vertical"==o.settings.mode?"top":"left",o.usingCSS=o.settings.useCSS&&"fade"!=o.settings.mode&&function(){var t=document.createElement("div"),e=["WebkitPerspective","MozPerspective","OPerspective","msPerspective"];for(var i in e)if(void 0!==t.style[e[i]])return o.cssPrefix=e[i].replace("Perspective","").toLowerCase(),o.animProp="-"+o.cssPrefix+"-transform",!0;return!1}(),"vertical"==o.settings.mode&&(o.settings.maxSlides=o.settings.minSlides),r.data("origStyle",r.attr("style")),r.children(o.settings.slideSelector).each(function(){t(this).data("origStyle",t(this).attr("style"))}),c()},c=function(){r.wrap('<div class="bx-wrapper"><div class="bx-viewport"></div></div>'),o.viewport=r.parent(),o.loader=t('<div class="bx-loading" />'),o.viewport.prepend(o.loader),r.css({width:"horizontal"==o.settings.mode?100*o.children.length+215+"%":"auto",position:"relative"}),o.usingCSS&&o.settings.easing?r.css("-"+o.cssPrefix+"-transition-timing-function",o.settings.easing):o.settings.easing||(o.settings.easing="swing"),f(),o.viewport.css({width:"100%",overflow:"hidden",position:"relative"}),o.viewport.parent().css({maxWidth:v()}),o.settings.pager||o.viewport.parent().css({margin:"0 auto 0px"}),o.children.css({"float":"horizontal"==o.settings.mode?"left":"none",listStyle:"none",position:"relative"}),o.children.css("width",u()),"horizontal"==o.settings.mode&&o.settings.slideMargin>0&&o.children.css("marginRight",o.settings.slideMargin),"vertical"==o.settings.mode&&o.settings.slideMargin>0&&o.children.css("marginBottom",o.settings.slideMargin),"fade"==o.settings.mode&&(o.children.css({position:"absolute",zIndex:0,display:"none"}),o.children.eq(o.settings.startSlide).css({zIndex:50,display:"block"})),o.controls.el=t('<div class="bx-controls" />'),o.settings.captions&&P(),o.active.last=o.settings.startSlide==x()-1,o.settings.video&&r.fitVids();var e=o.children.eq(o.settings.startSlide);"all"==o.settings.preloadImages&&(e=o.children),o.settings.ticker?o.settings.pager=!1:(o.settings.pager&&T(),o.settings.controls&&C(),o.settings.auto&&o.settings.autoControls&&E(),(o.settings.controls||o.settings.autoControls||o.settings.pager)&&o.viewport.after(o.controls.el)),g(e,h)},g=function(e,i){var s=e.find("img, iframe").length;if(0==s)return i(),void 0;var n=0;e.find("img, iframe").each(function(){t(this).is("img")&&t(this).attr("src",t(this).attr("src")+"?timestamp="+(new Date).getTime()),t(this).load(function(){setTimeout(function(){++n==s&&i()},0)})})},h=function(){if(o.settings.infiniteLoop&&"fade"!=o.settings.mode&&!o.settings.ticker){var e="vertical"==o.settings.mode?o.settings.minSlides:o.settings.maxSlides,i=o.children.slice(0,e).clone().addClass("bx-clone"),s=o.children.slice(-e).clone().addClass("bx-clone");r.append(i).prepend(s)}o.loader.remove(),S(),"vertical"==o.settings.mode&&(o.settings.adaptiveHeight=!0),o.viewport.height(p()),r.redrawSlider(),o.settings.onSliderLoad(o.active.index),o.initialized=!0,o.settings.responsive&&t(window).bind("resize",B),o.settings.auto&&o.settings.autoStart&&H(),o.settings.ticker&&L(),o.settings.pager&&I(o.settings.startSlide),o.settings.controls&&W(),o.settings.touchEnabled&&!o.settings.ticker&&O()},p=function(){var e=0,s=t();if("vertical"==o.settings.mode||o.settings.adaptiveHeight)if(o.carousel){var n=1==o.settings.moveSlides?o.active.index:o.active.index*m();for(s=o.children.eq(n),i=1;i<=o.settings.maxSlides-1;i++)s=n+i>=o.children.length?s.add(o.children.eq(i-1)):s.add(o.children.eq(n+i))}else s=o.children.eq(o.active.index);else s=o.children;return"vertical"==o.settings.mode?(s.each(function(){e+=t(this).outerHeight()}),o.settings.slideMargin>0&&(e+=o.settings.slideMargin*(o.settings.minSlides-1))):e=Math.max.apply(Math,s.map(function(){return t(this).outerHeight(!1)}).get()),e},v=function(){var t="100%";return o.settings.slideWidth>0&&(t="horizontal"==o.settings.mode?o.settings.maxSlides*o.settings.slideWidth+(o.settings.maxSlides-1)*o.settings.slideMargin:o.settings.slideWidth),t},u=function(){var t=o.settings.slideWidth,e=o.viewport.width();return 0==o.settings.slideWidth||o.settings.slideWidth>e&&!o.carousel||"vertical"==o.settings.mode?t=e:o.settings.maxSlides>1&&"horizontal"==o.settings.mode&&(e>o.maxThreshold||e<o.minThreshold&&(t=(e-o.settings.slideMargin*(o.settings.minSlides-1))/o.settings.minSlides)),t},f=function(){var t=1;if("horizontal"==o.settings.mode&&o.settings.slideWidth>0)if(o.viewport.width()<o.minThreshold)t=o.settings.minSlides;else if(o.viewport.width()>o.maxThreshold)t=o.settings.maxSlides;else{var e=o.children.first().width();t=Math.floor(o.viewport.width()/e)}else"vertical"==o.settings.mode&&(t=o.settings.minSlides);return t},x=function(){var t=0;if(o.settings.moveSlides>0)if(o.settings.infiniteLoop)t=o.children.length/m();else for(var e=0,i=0;e<o.children.length;)++t,e=i+f(),i+=o.settings.moveSlides<=f()?o.settings.moveSlides:f();else t=Math.ceil(o.children.length/f());return t},m=function(){return o.settings.moveSlides>0&&o.settings.moveSlides<=f()?o.settings.moveSlides:f()},S=function(){if(o.children.length>o.settings.maxSlides&&o.active.last&&!o.settings.infiniteLoop){if("horizontal"==o.settings.mode){var t=o.children.last(),e=t.position();b(-(e.left-(o.viewport.width()-t.width())),"reset",0)}else if("vertical"==o.settings.mode){var i=o.children.length-o.settings.minSlides,e=o.children.eq(i).position();b(-e.top,"reset",0)}}else{var e=o.children.eq(o.active.index*m()).position();o.active.index==x()-1&&(o.active.last=!0),void 0!=e&&("horizontal"==o.settings.mode?b(-e.left,"reset",0):"vertical"==o.settings.mode&&b(-e.top,"reset",0))}},b=function(t,e,i,s){if(o.usingCSS){var n="vertical"==o.settings.mode?"translate3d(0, "+t+"px, 0)":"translate3d("+t+"px, 0, 0)";r.css("-"+o.cssPrefix+"-transition-duration",i/1e3+"s"),"slide"==e?(r.css(o.animProp,n),r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(){r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"),D()})):"reset"==e?r.css(o.animProp,n):"ticker"==e&&(r.css("-"+o.cssPrefix+"-transition-timing-function","linear"),r.css(o.animProp,n),r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",function(){r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"),b(s.resetValue,"reset",0),N()}))}else{var a={};a[o.animProp]=t,"slide"==e?r.animate(a,i,o.settings.easing,function(){D()}):"reset"==e?r.css(o.animProp,t):"ticker"==e&&r.animate(a,speed,"linear",function(){b(s.resetValue,"reset",0),N()})}},w=function(){for(var e="",i=x(),s=0;i>s;s++){var n="";o.settings.buildPager&&t.isFunction(o.settings.buildPager)?(n=o.settings.buildPager(s),o.pagerEl.addClass("bx-custom-pager")):(n=s+1,o.pagerEl.addClass("bx-default-pager")),e+='<div class="bx-pager-item"><a href="" data-slide-index="'+s+'" class="bx-pager-link">'+n+"</a></div>"}o.pagerEl.html(e)},T=function(){o.settings.pagerCustom?o.pagerEl=t(o.settings.pagerCustom):(o.pagerEl=t('<div class="bx-pager" />'),o.settings.pagerSelector?t(o.settings.pagerSelector).html(o.pagerEl):o.controls.el.addClass("bx-has-pager").append(o.pagerEl),w()),o.pagerEl.delegate("a","click",q)},C=function(){o.controls.next=t('<a class="bx-next" href="">'+o.settings.nextText+"</a>"),o.controls.prev=t('<a class="bx-prev" href="">'+o.settings.prevText+"</a>"),o.controls.next.bind("click",y),o.controls.prev.bind("click",z),o.settings.nextSelector&&t(o.settings.nextSelector).append(o.controls.next),o.settings.prevSelector&&t(o.settings.prevSelector).append(o.controls.prev),o.settings.nextSelector||o.settings.prevSelector||(o.controls.directionEl=t('<div class="bx-controls-direction" />'),o.controls.directionEl.append(o.controls.prev).append(o.controls.next),o.controls.el.addClass("bx-has-controls-direction").append(o.controls.directionEl))},E=function(){o.controls.start=t('<div class="bx-controls-auto-item"><a class="bx-start" href="">'+o.settings.startText+"</a></div>"),o.controls.stop=t('<div class="bx-controls-auto-item"><a class="bx-stop" href="">'+o.settings.stopText+"</a></div>"),o.controls.autoEl=t('<div class="bx-controls-auto" />'),o.controls.autoEl.delegate(".bx-start","click",k),o.controls.autoEl.delegate(".bx-stop","click",M),o.settings.autoControlsCombine?o.controls.autoEl.append(o.controls.start):o.controls.autoEl.append(o.controls.start).append(o.controls.stop),o.settings.autoControlsSelector?t(o.settings.autoControlsSelector).html(o.controls.autoEl):o.controls.el.addClass("bx-has-controls-auto").append(o.controls.autoEl),A(o.settings.autoStart?"stop":"start")},P=function(){o.children.each(function(){var e=t(this).find("img:first").attr("title");void 0!=e&&(""+e).length&&t(this).append('<div class="bx-caption"><span>'+e+"</span></div>")})},y=function(t){o.settings.auto&&r.stopAuto(),r.goToNextSlide(),t.preventDefault()},z=function(t){o.settings.auto&&r.stopAuto(),r.goToPrevSlide(),t.preventDefault()},k=function(t){r.startAuto(),t.preventDefault()},M=function(t){r.stopAuto(),t.preventDefault()},q=function(e){o.settings.auto&&r.stopAuto();var i=t(e.currentTarget),s=parseInt(i.attr("data-slide-index"));s!=o.active.index&&r.goToSlide(s),e.preventDefault()},I=function(e){var i=o.children.length;return"short"==o.settings.pagerType?(o.settings.maxSlides>1&&(i=Math.ceil(o.children.length/o.settings.maxSlides)),o.pagerEl.html(e+1+o.settings.pagerShortSeparator+i),void 0):(o.pagerEl.find("a").removeClass("active"),o.pagerEl.each(function(i,s){t(s).find("a").eq(e).addClass("active")}),void 0)},D=function(){if(o.settings.infiniteLoop){var t="";0==o.active.index?t=o.children.eq(0).position():o.active.index==x()-1&&o.carousel?t=o.children.eq((x()-1)*m()).position():o.active.index==o.children.length-1&&(t=o.children.eq(o.children.length-1).position()),"horizontal"==o.settings.mode?b(-t.left,"reset",0):"vertical"==o.settings.mode&&b(-t.top,"reset",0)}o.working=!1,o.settings.onSlideAfter(o.children.eq(o.active.index),o.oldIndex,o.active.index)},A=function(t){o.settings.autoControlsCombine?o.controls.autoEl.html(o.controls[t]):(o.controls.autoEl.find("a").removeClass("active"),o.controls.autoEl.find("a:not(.bx-"+t+")").addClass("active"))},W=function(){1==x()?(o.controls.prev.addClass("disabled"),o.controls.next.addClass("disabled")):!o.settings.infiniteLoop&&o.settings.hideControlOnEnd&&(0==o.active.index?(o.controls.prev.addClass("disabled"),o.controls.next.removeClass("disabled")):o.active.index==x()-1?(o.controls.next.addClass("disabled"),o.controls.prev.removeClass("disabled")):(o.controls.prev.removeClass("disabled"),o.controls.next.removeClass("disabled")))},H=function(){o.settings.autoDelay>0?setTimeout(r.startAuto,o.settings.autoDelay):r.startAuto(),o.settings.autoHover&&r.hover(function(){o.interval&&(r.stopAuto(!0),o.autoPaused=!0)},function(){o.autoPaused&&(r.startAuto(!0),o.autoPaused=null)})},L=function(){var e=0;if("next"==o.settings.autoDirection)r.append(o.children.clone().addClass("bx-clone"));else{r.prepend(o.children.clone().addClass("bx-clone"));var i=o.children.first().position();e="horizontal"==o.settings.mode?-i.left:-i.top}b(e,"reset",0),o.settings.pager=!1,o.settings.controls=!1,o.settings.autoControls=!1,o.settings.tickerHover&&!o.usingCSS&&o.viewport.hover(function(){r.stop()},function(){var e=0;o.children.each(function(){e+="horizontal"==o.settings.mode?t(this).outerWidth(!0):t(this).outerHeight(!0)});var i=o.settings.speed/e,s="horizontal"==o.settings.mode?"left":"top",n=i*(e-Math.abs(parseInt(r.css(s))));N(n)}),N()},N=function(t){speed=t?t:o.settings.speed;var e={left:0,top:0},i={left:0,top:0};"next"==o.settings.autoDirection?e=r.find(".bx-clone").first().position():i=o.children.first().position();var s="horizontal"==o.settings.mode?-e.left:-e.top,n="horizontal"==o.settings.mode?-i.left:-i.top,a={resetValue:n};b(s,"ticker",speed,a)},O=function(){o.touch={start:{x:0,y:0},end:{x:0,y:0}},o.viewport.bind("touchstart",X)},X=function(t){if(o.working)t.preventDefault();else{o.touch.originalPos=r.position();var e=t.originalEvent;o.touch.start.x=e.changedTouches[0].pageX,o.touch.start.y=e.changedTouches[0].pageY,o.viewport.bind("touchmove",Y),o.viewport.bind("touchend",V)}},Y=function(t){var e=t.originalEvent,i=Math.abs(e.changedTouches[0].pageX-o.touch.start.x),s=Math.abs(e.changedTouches[0].pageY-o.touch.start.y);if(3*i>s&&o.settings.preventDefaultSwipeX?t.preventDefault():3*s>i&&o.settings.preventDefaultSwipeY&&t.preventDefault(),"fade"!=o.settings.mode&&o.settings.oneToOneTouch){var n=0;if("horizontal"==o.settings.mode){var r=e.changedTouches[0].pageX-o.touch.start.x;n=o.touch.originalPos.left+r}else{var r=e.changedTouches[0].pageY-o.touch.start.y;n=o.touch.originalPos.top+r}b(n,"reset",0)}},V=function(t){o.viewport.unbind("touchmove",Y);var e=t.originalEvent,i=0;if(o.touch.end.x=e.changedTouches[0].pageX,o.touch.end.y=e.changedTouches[0].pageY,"fade"==o.settings.mode){var s=Math.abs(o.touch.start.x-o.touch.end.x);s>=o.settings.swipeThreshold&&(o.touch.start.x>o.touch.end.x?r.goToNextSlide():r.goToPrevSlide(),r.stopAuto())}else{var s=0;"horizontal"==o.settings.mode?(s=o.touch.end.x-o.touch.start.x,i=o.touch.originalPos.left):(s=o.touch.end.y-o.touch.start.y,i=o.touch.originalPos.top),!o.settings.infiniteLoop&&(0==o.active.index&&s>0||o.active.last&&0>s)?b(i,"reset",200):Math.abs(s)>=o.settings.swipeThreshold?(0>s?r.goToNextSlide():r.goToPrevSlide(),r.stopAuto()):b(i,"reset",200)}o.viewport.unbind("touchend",V)},B=function(){var e=t(window).width(),i=t(window).height();(a!=e||l!=i)&&(a=e,l=i,r.redrawSlider())};return r.goToSlide=function(e,i){if(!o.working&&o.active.index!=e)if(o.working=!0,o.oldIndex=o.active.index,o.active.index=0>e?x()-1:e>=x()?0:e,o.settings.onSlideBefore(o.children.eq(o.active.index),o.oldIndex,o.active.index),"next"==i?o.settings.onSlideNext(o.children.eq(o.active.index),o.oldIndex,o.active.index):"prev"==i&&o.settings.onSlidePrev(o.children.eq(o.active.index),o.oldIndex,o.active.index),o.active.last=o.active.index>=x()-1,o.settings.pager&&I(o.active.index),o.settings.controls&&W(),"fade"==o.settings.mode)o.settings.adaptiveHeight&&o.viewport.height()!=p()&&o.viewport.animate({height:p()},o.settings.adaptiveHeightSpeed),o.children.filter(":visible").fadeOut(o.settings.speed).css({zIndex:0}),o.children.eq(o.active.index).css("zIndex",51).fadeIn(o.settings.speed,function(){t(this).css("zIndex",50),D()});else{o.settings.adaptiveHeight&&o.viewport.height()!=p()&&o.viewport.animate({height:p()},o.settings.adaptiveHeightSpeed);var s=0,n={left:0,top:0};if(!o.settings.infiniteLoop&&o.carousel&&o.active.last)if("horizontal"==o.settings.mode){var a=o.children.eq(o.children.length-1);n=a.position(),s=o.viewport.width()-a.outerWidth()}else{var l=o.children.length-o.settings.minSlides;n=o.children.eq(l).position()}else if(o.carousel&&o.active.last&&"prev"==i){var d=1==o.settings.moveSlides?o.settings.maxSlides-m():(x()-1)*m()-(o.children.length-o.settings.maxSlides),a=r.children(".bx-clone").eq(d);n=a.position()}else if("next"==i&&0==o.active.index)n=r.find("> .bx-clone").eq(o.settings.maxSlides).position(),o.active.last=!1;else if(e>=0){var c=e*m();n=o.children.eq(c).position()}if("undefined"!=typeof n){var g="horizontal"==o.settings.mode?-(n.left-s):-n.top;b(g,"slide",o.settings.speed)}}},r.goToNextSlide=function(){if(o.settings.infiniteLoop||!o.active.last){var t=parseInt(o.active.index)+1;r.goToSlide(t,"next")}},r.goToPrevSlide=function(){if(o.settings.infiniteLoop||0!=o.active.index){var t=parseInt(o.active.index)-1;r.goToSlide(t,"prev")}},r.startAuto=function(t){o.interval||(o.interval=setInterval(function(){"next"==o.settings.autoDirection?r.goToNextSlide():r.goToPrevSlide()},o.settings.pause),o.settings.autoControls&&1!=t&&A("stop"))},r.stopAuto=function(t){o.interval&&(clearInterval(o.interval),o.interval=null,o.settings.autoControls&&1!=t&&A("start"))},r.getCurrentSlide=function(){return o.active.index},r.getSlideCount=function(){return o.children.length},r.redrawSlider=function(){o.children.add(r.find(".bx-clone")).outerWidth(u()),o.viewport.css("height",p()),o.settings.ticker||S(),o.active.last&&(o.active.index=x()-1),o.active.index>=x()&&(o.active.last=!0),o.settings.pager&&!o.settings.pagerCustom&&(w(),I(o.active.index))},r.destroySlider=function(){o.initialized&&(o.initialized=!1,t(".bx-clone",this).remove(),o.children.each(function(){void 0!=t(this).data("origStyle")?t(this).attr("style",t(this).data("origStyle")):t(this).removeAttr("style")}),void 0!=t(this).data("origStyle")?this.attr("style",t(this).data("origStyle")):t(this).removeAttr("style"),t(this).unwrap().unwrap(),o.controls.el&&o.controls.el.remove(),o.controls.next&&o.controls.next.remove(),o.controls.prev&&o.controls.prev.remove(),o.pagerEl&&o.pagerEl.remove(),t(".bx-caption",this).remove(),o.controls.autoEl&&o.controls.autoEl.remove(),clearInterval(o.interval),o.settings.responsive&&t(window).unbind("resize",B))},r.reloadSlider=function(t){void 0!=t&&(n=t),r.destroySlider(),d()},d(),this}}(jQuery);

/*!
 * Bootstrap v3.3.2 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

/*!
 * Generated using the Bootstrap Customizer (http://getbootstrap.com/customize/?id=b88d5efbf105d81476e3)
 * Config saved to config.json and https://gist.github.com/b88d5efbf105d81476e3
 */
 if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(t){"use strict";var e=t.fn.jquery.split(" ")[0].split(".");if(e[0]<2&&e[1]<9||1==e[0]&&9==e[1]&&e[2]<1)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher")}(jQuery),+function(t){"use strict";function e(e,s){return this.each(function(){var n=t(this),o=n.data("bs.modal"),a=t.extend({},i.DEFAULTS,n.data(),"object"==typeof e&&e);o||n.data("bs.modal",o=new i(this,a)),"string"==typeof e?o[e](s):a.show&&o.show(s)})}var i=function(e,i){this.options=i,this.$body=t(document.body),this.$element=t(e),this.$backdrop=this.isShown=null,this.scrollbarWidth=0,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,t.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};i.VERSION="3.3.2",i.TRANSITION_DURATION=300,i.BACKDROP_TRANSITION_DURATION=150,i.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},i.prototype.toggle=function(t){return this.isShown?this.hide():this.show(t)},i.prototype.show=function(e){var s=this,n=t.Event("show.bs.modal",{relatedTarget:e});this.$element.trigger(n),this.isShown||n.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',t.proxy(this.hide,this)),this.backdrop(function(){var n=t.support.transition&&s.$element.hasClass("fade");s.$element.parent().length||s.$element.appendTo(s.$body),s.$element.show().scrollTop(0),s.options.backdrop&&s.adjustBackdrop(),s.adjustDialog(),n&&s.$element[0].offsetWidth,s.$element.addClass("in").attr("aria-hidden",!1),s.enforceFocus();var o=t.Event("shown.bs.modal",{relatedTarget:e});n?s.$element.find(".modal-dialog").one("bsTransitionEnd",function(){s.$element.trigger("focus").trigger(o)}).emulateTransitionEnd(i.TRANSITION_DURATION):s.$element.trigger("focus").trigger(o)}))},i.prototype.hide=function(e){e&&e.preventDefault(),e=t.Event("hide.bs.modal"),this.$element.trigger(e),this.isShown&&!e.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),t(document).off("focusin.bs.modal"),this.$element.removeClass("in").attr("aria-hidden",!0).off("click.dismiss.bs.modal"),t.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",t.proxy(this.hideModal,this)).emulateTransitionEnd(i.TRANSITION_DURATION):this.hideModal())},i.prototype.enforceFocus=function(){t(document).off("focusin.bs.modal").on("focusin.bs.modal",t.proxy(function(t){this.$element[0]===t.target||this.$element.has(t.target).length||this.$element.trigger("focus")},this))},i.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",t.proxy(function(t){27==t.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},i.prototype.resize=function(){this.isShown?t(window).on("resize.bs.modal",t.proxy(this.handleUpdate,this)):t(window).off("resize.bs.modal")},i.prototype.hideModal=function(){var t=this;this.$element.hide(),this.backdrop(function(){t.$body.removeClass("modal-open"),t.resetAdjustments(),t.resetScrollbar(),t.$element.trigger("hidden.bs.modal")})},i.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},i.prototype.backdrop=function(e){var s=this,n=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var o=t.support.transition&&n;if(this.$backdrop=t('<div class="modal-backdrop '+n+'" />').prependTo(this.$element).on("click.dismiss.bs.modal",t.proxy(function(t){t.target===t.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus.call(this.$element[0]):this.hide.call(this))},this)),o&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!e)return;o?this.$backdrop.one("bsTransitionEnd",e).emulateTransitionEnd(i.BACKDROP_TRANSITION_DURATION):e()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var a=function(){s.removeBackdrop(),e&&e()};t.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",a).emulateTransitionEnd(i.BACKDROP_TRANSITION_DURATION):a()}else e&&e()},i.prototype.handleUpdate=function(){this.options.backdrop&&this.adjustBackdrop(),this.adjustDialog()},i.prototype.adjustBackdrop=function(){this.$backdrop.css("height",0).css("height",this.$element[0].scrollHeight)},i.prototype.adjustDialog=function(){var t=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&t?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!t?this.scrollbarWidth:""})},i.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},i.prototype.checkScrollbar=function(){this.bodyIsOverflowing=document.body.scrollHeight>document.documentElement.clientHeight,this.scrollbarWidth=this.measureScrollbar()},i.prototype.setScrollbar=function(){var t=parseInt(this.$body.css("padding-right")||0,10);this.bodyIsOverflowing&&this.$body.css("padding-right",t+this.scrollbarWidth)},i.prototype.resetScrollbar=function(){this.$body.css("padding-right","")},i.prototype.measureScrollbar=function(){var t=document.createElement("div");t.className="modal-scrollbar-measure",this.$body.append(t);var e=t.offsetWidth-t.clientWidth;return this.$body[0].removeChild(t),e};var s=t.fn.modal;t.fn.modal=e,t.fn.modal.Constructor=i,t.fn.modal.noConflict=function(){return t.fn.modal=s,this},t(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(i){var s=t(this),n=s.attr("href"),o=t(s.attr("data-target")||n&&n.replace(/.*(?=#[^\s]+$)/,"")),a=o.data("bs.modal")?"toggle":t.extend({remote:!/#/.test(n)&&n},o.data(),s.data());s.is("a")&&i.preventDefault(),o.one("show.bs.modal",function(t){t.isDefaultPrevented()||o.one("hidden.bs.modal",function(){s.is(":visible")&&s.trigger("focus")})}),e.call(o,a,this)})}(jQuery),+function(t){"use strict";function e(e){var i,s=e.attr("data-target")||(i=e.attr("href"))&&i.replace(/.*(?=#[^\s]+$)/,"");return t(s)}function i(e){return this.each(function(){var i=t(this),n=i.data("bs.collapse"),o=t.extend({},s.DEFAULTS,i.data(),"object"==typeof e&&e);!n&&o.toggle&&"show"==e&&(o.toggle=!1),n||i.data("bs.collapse",n=new s(this,o)),"string"==typeof e&&n[e]()})}var s=function(e,i){this.$element=t(e),this.options=t.extend({},s.DEFAULTS,i),this.$trigger=t(this.options.trigger).filter('[href="#'+e.id+'"], [data-target="#'+e.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};s.VERSION="3.3.2",s.TRANSITION_DURATION=350,s.DEFAULTS={toggle:!0,trigger:'[data-toggle="collapse"]'},s.prototype.dimension=function(){var t=this.$element.hasClass("width");return t?"width":"height"},s.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var e,n=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(!(n&&n.length&&(e=n.data("bs.collapse"),e&&e.transitioning))){var o=t.Event("show.bs.collapse");if(this.$element.trigger(o),!o.isDefaultPrevented()){n&&n.length&&(i.call(n,"hide"),e||n.data("bs.collapse",null));var a=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[a](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var r=function(){this.$element.removeClass("collapsing").addClass("collapse in")[a](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!t.support.transition)return r.call(this);var l=t.camelCase(["scroll",a].join("-"));this.$element.one("bsTransitionEnd",t.proxy(r,this)).emulateTransitionEnd(s.TRANSITION_DURATION)[a](this.$element[0][l])}}}},s.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var e=t.Event("hide.bs.collapse");if(this.$element.trigger(e),!e.isDefaultPrevented()){var i=this.dimension();this.$element[i](this.$element[i]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var n=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};return t.support.transition?void this.$element[i](0).one("bsTransitionEnd",t.proxy(n,this)).emulateTransitionEnd(s.TRANSITION_DURATION):n.call(this)}}},s.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},s.prototype.getParent=function(){return t(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(t.proxy(function(i,s){var n=t(s);this.addAriaAndCollapsedClass(e(n),n)},this)).end()},s.prototype.addAriaAndCollapsedClass=function(t,e){var i=t.hasClass("in");t.attr("aria-expanded",i),e.toggleClass("collapsed",!i).attr("aria-expanded",i)};var n=t.fn.collapse;t.fn.collapse=i,t.fn.collapse.Constructor=s,t.fn.collapse.noConflict=function(){return t.fn.collapse=n,this},t(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(s){var n=t(this);n.attr("data-target")||s.preventDefault();var o=e(n),a=o.data("bs.collapse"),r=a?"toggle":t.extend({},n.data(),{trigger:this});i.call(o,r)})}(jQuery),+function(t){"use strict";function e(){var t=document.createElement("bootstrap"),e={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var i in e)if(void 0!==t.style[i])return{end:e[i]};return!1}t.fn.emulateTransitionEnd=function(e){var i=!1,s=this;t(this).one("bsTransitionEnd",function(){i=!0});var n=function(){i||t(s).trigger(t.support.transition.end)};return setTimeout(n,e),this},t(function(){t.support.transition=e(),t.support.transition&&(t.event.special.bsTransitionEnd={bindType:t.support.transition.end,delegateType:t.support.transition.end,handle:function(e){return t(e.target).is(this)?e.handleObj.handler.apply(this,arguments):void 0}})})}(jQuery);

/*
 * jQuery UI Touch Punch 0.2.2
 *
 */
 (function(b){b.support.touch="ontouchend" in document;if(!b.support.touch){return;}var c=b.ui.mouse.prototype,e=c._mouseInit,a;function d(g,h){if(g.originalEvent.touches.length>1){return;}g.preventDefault();var i=g.originalEvent.changedTouches[0],f=document.createEvent("MouseEvents");f.initMouseEvent(h,true,true,window,1,i.screenX,i.screenY,i.clientX,i.clientY,false,false,false,false,0,null);g.target.dispatchEvent(f);}c._touchStart=function(g){var f=this;if(a||!f._mouseCapture(g.originalEvent.changedTouches[0])){return;}a=true;f._touchMoved=false;d(g,"mouseover");d(g,"mousemove");d(g,"mousedown");};c._touchMove=function(f){if(!a){return;}this._touchMoved=true;d(f,"mousemove");};c._touchEnd=function(f){if(!a){return;}d(f,"mouseup");d(f,"mouseout");if(!this._touchMoved){d(f,"click");}a=false;};c._mouseInit=function(){var f=this;f.element.bind("touchstart",b.proxy(f,"_touchStart")).bind("touchmove",b.proxy(f,"_touchMove")).bind("touchend",b.proxy(f,"_touchEnd"));e.call(f);};})(jQuery);


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
				$(this).val($.cookie(name))
			}
			$(this).change(function () {
				$.cookie(name, $(this).val(), {
					path: '/',
					expires: 365
				})
			})
		})
	};

	var addCommaCur = function (nStr) {
		nStr += '';
		var x = nStr.split('.');
		var x1 = x[0];
		var x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2')
		}
		return x1 + x2
	};

	var captionAnimation = function (args) {
		if (args.slides != undefined) {
			var caption = $(args.slides).find('.flex-caption'),
			currentCaption = $(args.slides.eq(args.currentSlide)).find('.flex-caption'),
			animTitle, animSubTitle;
			caption.find('.secondary-title, .caption-content, .flex-readmore').attr('style', '');
			caption.each(function () {
				if ($(this).hasClass('caption-right')) {
					caption.find('.primary-title').css({
						'margin-right': '',
						'opacity': 0
					})
				} else {
					caption.find('.primary-title').css({
						'margin-left': '',
						'opacity': 0
					})
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
					}
				} else {
					animSubTitle = {
						left: 0,
						opacity: 1
					};
					animTitle = {
						opacity: 1,
						'margin-left': 0
					}
				}
			}
			currentCaption.find('.flex-readmore').animate(animSubTitle, 300, 'easeOutQuint');
			currentCaption.find('.secondary-title').delay(100).animate(animSubTitle, 400, 'easeOutQuint');
			currentCaption.find('.caption-content').delay(200).animate(animSubTitle, 400, 'easeOutQuint');
			currentCaption.find('.primary-title').delay(300).animate(animTitle, 400, 'easeOutQuint')
		} else {
			var caption = args.find('.flex-caption'),
			animSubTitle, animTitle;
			if (caption.length > 0) {
				caption.find('.secondary-title, .caption-content, .flex-readmore').attr('style', '');
				if (caption.hasClass('caption-right')) {
					caption.find('.primary-title').css({
						'margin-right': '',
						'opacity': 0
					})
				} else {
					caption.find('.primary-title').css({
						'margin-left': '',
						'opacity': 0
					})
				} if (caption.hasClass('caption-right')) {
					animSubTitle = {
						right: 0,
						opacity: 1
					};
					animTitle = {
						opacity: 1,
						'margin-right': 0
					}
				} else {
					animSubTitle = {
						left: 0,
						opacity: 1
					};
					animTitle = {
						opacity: 1,
						'margin-left': 0
					}
				}
				caption.find('.flex-readmore').animate(animSubTitle, 300, 'easeOutQuint');
				caption.find('.secondary-title').delay(100).animate(animSubTitle, 400, 'easeOutQuint');
				caption.find('.caption-content').delay(200).animate(animSubTitle, 400, 'easeOutQuint');
				caption.find('.primary-title').delay(300).animate(animTitle, 400, 'easeOutQuint')
			}
		}
	};

	var makeSelectToSlider = function (selector) {
		var label_count = '';
		var opt_len = $("#" + selector + " option").length;
		if (opt_len < 10) {
			label_count = opt_len
		} else {
			label_count = opt_len / 2
		}
		$("select#" + selector).selectToUISlider({
			labels: label_count,
			tooltip: false,
			labelSrc: 'text',
			sliderOptions: {
				create: function (e, ui) {
					var filterSelected = $("select#" + selector).val();
					if (filterSelected != '') {
						$(".ui-slider-label:contains(" + filterSelected + ")", this).addClass("filter-active")
					}
				},
				change: function (e, ui) {
					var filterSelected = $("select#" + selector + " option").eq(ui.values[0]).val();
					$(this).find(".ui-slider-label").removeClass("filter-active");
					$(".ui-slider-label:contains(" + filterSelected + ")", this).addClass("filter-active")
				}
			}
		}).hide()
	};


	var matchHeight = function () {
		$("[data-match-height]").each(function () {
			var parentRow = $(this),
			childrenCols = $(this).find("[data-height-watch]"),
			childHeights = childrenCols.map(function () {
				return $(this).height()
			}).get(),
			tallestChild = Math.max.apply(Math, childHeights);
			childrenCols.css('min-height', tallestChild);
			if (parentRow.hasClass('textarea-container')) {
				var padT = childrenCols.find('textarea').css('padding-top');
				var padB = childrenCols.find('textarea').css('padding-bottom');
				var pad = parseInt(padT) + parseInt(padB);
				childrenCols.find('.attached-label').css('min-height', tallestChild).end().find('textarea').css('min-height', tallestChild)
			}
		})
	};


	var makeRangeSlider = function(selector, min, max, step) {
		var $t = $("#" + selector);
		var min_val = parseInt(min),
		max_val = parseInt(max),
		type = $t.data('type'),
		step = parseInt(step),
		initial_min_val = (parseInt($('#min_' + type).val())) ? parseInt($('#min_' + type).val()) : min_val,
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
				$t.append(labelComponent)
			},
			slide: function (event, ui) {
				$("#min_" + type + "_text").text(addCommaCur(ui.values[0]));
				$("#max_" + type + "_text").text(addCommaCur(ui.values[1]))
			},
			stop: function (event, ui) {
				$("#min_" + type).val(ui.values[0]);
				$("#max_" + type).val(ui.values[1])
			}
		});
		$("#min_" + type + "_text").text(addCommaCur($t.slider("values", 0)));
		$("#max_" + type + "_text").text(addCommaCur($t.slider("values", 1)));
		$("#min_" + type).val($t.slider("values", 0));
		$("#max_" + type).val($t.slider("values", 1))
	};

	var set_idx_price_slider = function (data) {
		var min_val = parseInt(data.min_val),
		max_val = parseInt(data.max_val),
		step = parseInt(data.step),
		initial_min_val = (parseInt($('#idx-q-PriceMin-widget').val())) ? parseInt($('#idx-q-PriceMin-widget').val()) : min_val,
		initial_max_val = (parseInt($('#idx-q-PriceMax-widget').val())) ? parseInt($('#idx-q-PriceMax-widget').val()) : max_val;
		$("#idx-slider-range-widget").slider({
			range: true,
			min: min_val,
			max: max_val,
			values: [initial_min_val, initial_max_val],
			step: step,
			create: function (event, ui) {
				var $target = $(event.target);
				var li_min = '<li class="min-val"><span class="ui-slider-label ui-slider-label-show">' + addCommaCur(min_val) + '</span></li>';
				var li_max = '<li class="max-val"><span class="ui-slider-label ui-slider-label-show">' + addCommaCur(max_val) + '</span></li>';
				var labelComponent = '<ol role="presentation">' + li_min + li_max + '</ol>';
				$target.append(labelComponent)
			},
			slide: function (event, ui) {
				$("#idx-min-price-text-widget").text(addCommaCur(ui.values[0]));
				$("#idx-max-price-text-widget").text(addCommaCur(ui.values[1]))
			},
			stop: function (event, ui) {
				$("#idx-q-PriceMin-widget").val(ui.values[0]);
				$("#idx-q-PriceMax-widget").val(ui.values[1])
			}
		});
		$("#idx-min-price-text-widget").text(addCommaCur($('#idx-slider-range-widget').slider("values", 0)));
		$("#idx-max-price-text-widget").text(addCommaCur($('#idx-slider-range-widget').slider("values", 1)));
		$("#idx-min-price-text-widget").val($("#idx-slider-range-widget").slider("values", 0));
		$("#idx-max-price-text-widget").val($("#idx-slider-range-widget").slider("values", 1))
	};

	var set_idx_price_slider2 = function (data) {
		var min_val = parseInt(data.min_val),
		max_val = parseInt(data.max_val),
		step = parseInt(data.step),
		initial_min_val = (parseInt($('#idx-q-PriceMin').val())) ? parseInt($('#idx-q-PriceMin').val()) : min_val,
		initial_max_val = (parseInt($('#idx-q-PriceMax').val())) ? parseInt($('#idx-q-PriceMax').val()) : max_val;
		$("#idx-slider-range2").slider({
			range: true,
			min: min_val,
			max: max_val,
			values: [initial_min_val, initial_max_val],
			step: step,
			create: function (event, ui) {
				var $target = $(event.target);
				var li_min = '<li class="min-val"><span class="ui-slider-label ui-slider-label-show">' + addCommaCur(min_val) + '</span></li>';
				var li_max = '<li class="max-val"><span class="ui-slider-label ui-slider-label-show">' + addCommaCur(max_val) + '</span></li>';
				var labelComponent = '<ol role="presentation">' + li_min + li_max + '</ol>';
				$target.append(labelComponent)
			},
			slide: function (event, ui) {
				$("#idx-min-price-text").text(addCommaCur(ui.values[0]));
				$("#idx-max-price-text").text(addCommaCur(ui.values[1]))
			},
			stop: function (event, ui) {
				$("#idx-q-PriceMin").val(ui.values[0]);
				$("#idx-q-PriceMax").val(ui.values[1])
			}
		});
		$("#idx-min-price-text").text(addCommaCur($('#idx-slider-range2').slider("values", 0)));
		$("#idx-max-price-text").text(addCommaCur($('#idx-slider-range2').slider("values", 1)));
		$("#idx-min-price-text").val($("#idx-slider-range2").slider("values", 0));
		$("#idx-max-price-text").val($("#idx-slider-range2").slider("values", 1))
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

			if (typeof shandora_data_count != 'undefined') {
				$('h3#listed-property').text(shandora_data_count)
			}
			if (Modernizr.touch) {
				$('.listings .entry-header').click(function () {
					if ($(this).hasClass('active')) {
						$(this).removeClass('active');
						$(this).find('.listing-hover').css({
							'opacity': 0
						}).end().find('.mask').css({
							'margin-top': '100%'
						}).end().find('.hover-icon-wrapper').hide()
					} else {
						$(this).addClass('active');
						$(this).find('.listing-hover').css({
							'opacity': 1
						}).end().find('.mask').css({
							'margin-top': '0'
						}).end().find('.hover-icon-wrapper').show()
					}
				})
			}
			if (Modernizr.mq('only screen and (min-width: 781px)')) {
				$('.panel.callaction').each(function () {
					var mT = ($(this).outerHeight() - $(this).find('.panel-button a').outerHeight()) / 2;
					$(this).find('.panel-button a').css({
						"margin-top": mT + "px"
					})
				})
			} else {
				$('.panel.callaction').each(function () {
					$(this).find('.panel-button a').removeAttr('style')
				})
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
						$ac.data('count', data_count)
					}
				} else {
					if (data_count < 2) {
						$t.addClass('checked').children('i').removeClass();
						$t.children('i').addClass(icon_checked);
						data_count++;
						$ac.data('count', data_count);
						if (data_count == 1) {
							data_return = post_id
						} else if (data_count > 1) {
							data_return = data_compare_id + "," + post_id
						}
						$ac.data('compare', data_return)
					}
				} if (data_count == 2) {
					window.location = compare_url + '?compare=' + $ac.data('compare')
				}
			});




$('#search-listing-form').submit(function () {
	var post_data = $(this).serializeArray();
	name = $(this).attr('id');
	$(post_data).each(function (e) {
		$.cookie(this.name, this.value, {
			path: '/',
			expires: 365
		})
	})
});

$('#backtop').click(function () {
	jQuery('body,html').animate({
		scrollTop: 0
	}, 600, "easeInSine");
	return false
});

		    /*$('.header-toggler .toggler-button').click(function () {
		        $(this).parent().parent().prev().slideToggle(function () {
		            $(this).toggleClass('hide');
		            var state = $(this).hasClass('hide') ? 'hide' : 'show';
		            $.cookie( 'header_state', state, {
		            	path: '/',
		            	expires: 365
		            });
		        })
});*/

var items = $('.slide');
var content = $('#inner-wrap');
var open = function () {
	$(items).removeClass('close').addClass('open')
};
var close = function () {
	$(items).removeClass('open').addClass('close')
};
$('#nav-toggle').click(function () {
	if (content.hasClass('open')) {
		$(close)
	} else {
		$(open)
	}
});
content.click(function () {
	if (content.hasClass('open')) {
		$(close)
	}
});
$('.menu-items .menu-has-children .menu-toggle').click(function (e) {
	if ($(this).hasClass('bi-angle-down')) {
		$(this).removeClass('bi-angle-down').addClass('bi-angle-up')
	} else {
		$(this).removeClass('bi-angle-up').addClass('bi-angle-down')
	}
	$(this).siblings('.sub-menu').slideToggle();
	$(this).parent().toggleClass('sub-menu-active')
});

$('.bon-mega-menu-items .menu-has-children .menu-toggle').click( function() {
	$(this).parent().toggleClass('sub-menu-active')
});

if ($('#property_location_level1').length > 0) {
	$("property_location_level1").trigger('change');
	$("property_location_level3").trigger('change');
	$("#property_location_level1").change(function () {
		if ($("#property_location_level2").length > 0) {
			$("#property_location_level2").parent().find('a.current').text('Loading...');
			var opt_val = $(this).val();
			$.ajax({
				type: "POST",
				url: bon_ajax.url,
				data: {
					action: "location-level",
					term_slug: opt_val,
					nonce: $(this).parents('.search-listing').find('#search_nonce').val()
				},
				success: function (data) {
					var select, name, option;
					select = $('#property_location_level2');
					if (select.prop) {
						var options = select.prop('options')
					} else {
						var options = select.attr('options')
					}
					$(select).find('option').remove();
					$.each(data, function (val, text) {
						options[options.length] = new Option(text, val)
					});
					Foundation.libs.forms.refresh_custom_select($('#property_location_level2'), true)
				}
			})
		}
	})
}

if ($('#property_location_level2').length > 0) {
	$("property_location_level2").trigger('change');
	$("#property_location_level2").change(function () {
		if ($("#property_location_level3").length > 0) {
			$("#property_location_level3").parent().find('a.current').text('Loading...');
			var opt_val = $(this).val();
			$.ajax({
				type: "POST",
				url: bon_ajax.url,
				data: {
					action: "location-level",
					term_slug: opt_val,
					nonce: $(this).parents('.search-listing').find('#search_nonce').val()
				},
				success: function (data) {
					var select, name, option;
					select = $('#property_location_level3');
					if (select.prop) {
						var options = select.prop('options')
					} else {
						var options = select.attr('options')
					}
					$(select).find('option').remove();
					$.each(data, function (val, text) {
						options[options.length] = new Option(text, val)
					});
					Foundation.libs.forms.refresh_custom_select($('#property_location_level3'), true)
				}
			})
		}
	})
}

if ($('#dealer_location_level1').length > 0) {
	$("dealer_location_level1").trigger('change');
	$("dealer_location_level3").trigger('change');
	$("#dealer_location_level1").change(function () {
		if ($("#dealer_location_level2").length > 0) {
			$("#dealer_location_level2").parent().find('a.current').text('Loading...');
			var opt_val = $(this).val();
			$.ajax({
				type: "POST",
				url: bon_ajax.url,
				data: {
					action: "dealer-location-level",
					term_slug: opt_val,
					nonce: $(this).parents('.search-listing').find('#search_nonce').val()
				},
				success: function (data) {
					var select, name, option;
					select = $('#dealer_location_level2');
					if (select.prop) {
						var options = select.prop('options')
					} else {
						var options = select.attr('options')
					}
					$(select).find('option').remove();
					$.each(data, function (val, text) {
						options[options.length] = new Option(text, val)
					});
					Foundation.libs.forms.refresh_custom_select($('#dealer_location_level2'), true)
				}
			})
		}
	})
}

if ($('#dealer_location_level2').length > 0) {
	$("dealer_location_level2").trigger('change');
	$("#dealer_location_level2").change(function () {
		if ($("#dealer_location_level3").length > 0) {
			$("#dealer_location_level3").parent().find('a.current').text('Loading...');
			var opt_val = $(this).val();
			$.ajax({
				type: "POST",
				url: bon_ajax.url,
				data: {
					action: "dealer-location-level",
					term_slug: opt_val,
					nonce: $(this).parents('.search-listing').find('#search_nonce').val()
				},
				success: function (data) {
					var select, name, option;
					select = $('#dealer_location_level3');
					if (select.prop) {
						var options = select.prop('options')
					} else {
						var options = select.attr('options')
					}
					$(select).find('option').remove();
					$.each(data, function (val, text) {
						options[options.length] = new Option(text, val)
					});
					Foundation.libs.forms.refresh_custom_select($('#dealer_location_level3'), true)
				}
			})
		}
	})
}

if ($('#manufacturer_level1').length > 0) {
	$("manufacturer_level1").trigger('change');
	$("manufacturer_level3").trigger('change');
	$("#manufacturer_level1").change(function () {
		if ($("#manufacturer_level2").length > 0) {
			$("#manufacturer_level2").parent().find('a.current').text('Loading...');
			var opt_val = $(this).val();
			$.ajax({
				type: "POST",
				url: bon_ajax.url,
				data: {
					action: "manufacturer-level",
					term_slug: opt_val,
					nonce: $(this).parents('.search-listing').find('#search_nonce').val()
				},
				success: function (data) {
					var select, name, option;
					select = $('#manufacturer_level2');
					if (select.prop) {
						var options = select.prop('options')
					} else {
						var options = select.attr('options')
					}
					$(select).find('option').remove();
					$.each(data, function (val, text) {
						options[options.length] = new Option(text, val)
					});
					Foundation.libs.forms.refresh_custom_select($('#manufacturer_level2'), true)
				}
			})
		}
	})
}

if ($('#manufacturer_level2').length > 0) {
	$("manufacturer_level2").trigger('change');
	$("#manufacturer_level2").change(function () {
		if ($("#manufacturer_level3").length > 0) {
			$("#manufacturer_level3").parent().find('a.current').text('Loading...');
			var opt_val = $(this).val();
			$.ajax({
				type: "POST",
				url: bon_ajax.url,
				data: {
					action: "manufacturer-level",
					term_slug: opt_val,
					nonce: $(this).parents('.search-listing').find('#search_nonce').val()
				},
				success: function (data) {
					var select, name, option;
					select = $('#manufacturer_level3');
					if (select.prop) {
						var options = select.prop('options')
					} else {
						var options = select.attr('options')
					}
					$(select).find('option').remove();
					$.each(data, function (val, text) {
						options[options.length] = new Option(text, val)
					});
					Foundation.libs.forms.refresh_custom_select($('#manufacturer_level3'), true)
				}
			})
		}
	})
}


$('#agent-contactform, #contact-requestform, #ebook-downloadform, #visit-requestform, #customize-requestform').submit(function () {
	var $t = $(this),
	formID = $(this).attr('id');
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
	$.post(bon_toolkit_ajax.url, 'action=process-' + formID + '&' + send_data, function (data) {
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
		$('.format-video').fitVids()
	}
}
$('#detail-tab .tab-nav a').click(function (e) {
	e.preventDefault();
	$(this).siblings().removeClass('active');
	$(this).addClass('active');
	var target = $(this).attr('href');
	$(this).parent().parent().find('.tab-content').removeClass('active');
	$(this).parent().parent().find(target).addClass('active')
});

onResize.init()
}
};

var onLoad = {
	init: function(){



		$(window).scroll(function () {
			if ($(this).scrollTop() > 800) {
				$('#scroll-top').fadeIn()
			} else {
				$('#scroll-top').fadeOut()
			}
		});
		$('#scroll-top').click(function (e) {
			e.preventDefault();
			$('body,html').animate({
				scrollTop: 0
			}, 800);
		});

		$.ajax({
			type: "POST",
			url: bon_ajax.url,
			data: {
				action: "price-range"
			},
			success: function (data) {
				if ($('#idx-slider-range2').length > 0) {
					set_idx_price_slider2(data)
				}
				if ($('#idx-slider-range-widget').length > 0) {
					set_idx_price_slider(data)
				}
			}
		});
		$('.select-slider').each(function (e) {
			var id = $(this).attr('id');
			makeSelectToSlider(id)
		});
		$('.range-slider').each(function (e) {
			var id = $(this).attr('id');
			makeRangeSlider(id, $(this).data('min'), $(this).data('max'), $(this).data('step'))
		});
		if ($('#property_status').length > 0) {
			$('#property_status').change(function (e) {
				var t = $('.range-slider[data-type="price"]');
				var id = t.attr('id');
				if ($('#property_status').length > 0 && t.data('type') == 'price' && t.slider) {
					if ($('#property_status').val() == 'for-rent') {
						var data_min = t.data('min-r');
						var data_max = t.data('max-r');
						var data_step = t.data('step-r');
						t.removeClass('active-sell').addClass('active-rent');
						t.slider("destroy");
						t.find('ol[role="presentation"]').remove();
						$('#min_price').val(data_min);
						$('#max_price').val(data_max);
						makeRangeSlider(id, data_min, data_max, data_step);
		                    //var a = $('#' + id).slider('value');
		                } else {
		                	var data_min = t.data('min');
		                	var data_max = t.data('max');
		                	var data_step = t.data('step');
		                	t.removeClass('active-rent').addClass('active-sell');
		                	t.slider("destroy");
		                	t.find('ol[role="presentation"]').remove();
		                	$('#min_price').val(data_min);
		                	$('#max_price').val(data_max);
		                	makeRangeSlider(id, data_min, data_max, data_step)
		                }
		            }
		        }).change()
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
	})
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
				$(el).find('li').eq(index).addClass('active-list')
			})
		},
		onSlideBefore: function (selector) {
			var index = selector.index();
			$(this.pagerCustom).find('li').removeClass('active-list');
			$(this.pagerCustom).each(function (i, el) {
				$(el).find('li').eq(index).addClass('active-list')
			})
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
				$(el).find('li').eq(index).addClass('active-list')
			})
		},
		onSlideBefore: function (selector) {
			var index = selector.index();
			$(this.pagerCustom).find('li').removeClass('active-list');
			$(this.pagerCustom).each(function (i, el) {
				$(el).find('li').eq(index).addClass('active-list')
			})
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
			$(this).addClass('hovered')
		}
		$(this).hover(function () {
			$(this).siblings().removeClass('hovered');
			$(this).addClass('hovered')
		}, function () {
			if ($(this).siblings().hasClass('post-carousel-next')) {
				$(this).siblings().addClass('hovered');
				$(this).removeClass('hovered')
			}
		})
	})
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
				$(this).siblings('.jp-video-container').find('.jp-progress').css('width', progressWidth + "px")
			},
			size: {
				width: "100.05%",
				height: "auto"
			},
			swfPath: "/libs/jplayer",
			cssSelectorAncestor: "#" + id,
			supplied: "m4v,ogv,all"
		})
	})
}

if ($('#listings-map').length > 0 && typeof shandora_data != 'undefined') {

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
		google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
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
				infowindow.open(map, marker)
			}
		})(marker, i))
	}

	if( e.length > 1 ) {
		map.fitBounds(bounds);
	}

	if( $(mapContainer).data('show-zoom') == true ) {
		$(mapContainer).append(zoomMore).append(zoomLess)
	}
	if( $(mapContainer).data('show-map-type') == true ) {
		$(mapContainer).append(typeBox);
	}

	$('#listings-map .less').click(function () {
		mapOptions.zoom--;
		if (mapOptions.zoom <= 0) mapOptions.zoom = 0;
		map.setZoom(mapOptions.zoom);
		$(this).blur()
	});
	$('#listings-map .more').click(function () {
		mapOptions.zoom++;
		if (mapOptions.zoom >= 21) mapOptions.zoom = 21;

		map.setZoom(mapOptions.zoom);
		$(this).blur()
	});
	$('#listings-map .maptype.plain').click(function () {
		map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
		$('.maptype').removeClass('selected');
		$(this).addClass('selected')
	});
	$('#listings-map .maptype.hyb').click(function () {
		map.setMapTypeId(google.maps.MapTypeId.HYBRID);
		$('.maptype').removeClass('selected');
		$(this).addClass('selected')
	});
	$('#listings-map .maptype.sat').click(function () {
		map.setMapTypeId(google.maps.MapTypeId.SATELLITE);
		$('.maptype').removeClass('selected');
		$(this).addClass('selected')
	});
	$('.more, .less').hover(function (e) {
		$(this).addClass('hovered')
	}, function (e) {
		$(this).removeClass('hovered')
	});


} else {
	$('#listings-map').css({
		'min-height': 0
	});
}

$('.listing-gallery').each(function () {
	var imageset = $(this).data('imageset');
	if (imageset != '') {
		$(this).magnificPopup({
			items: imageset,
			gallery: {
				enabled: true
			},
			image: {
				markup: '<div class="mfp-figure">' + '<div class="mfp-title"></div>' + '<div class="mfp-close"></div>' + '<div class="mfp-img"></div>' + '<div class="mfp-bottom-bar">' + '<div class="mfp-counter"></div>' + '</div>' + '</div>',
			},
			type: 'image'
		})
	}
});
$('.gallery-link-file a').magnificPopup({
	type: 'image',
	gallery: {
		enabled: true
	}
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
	return false
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
			$('html').addClass('offcanvas-nav')
		} else {
			$('html').removeClass('offcanvas-nav')
		} if (Modernizr.mq('only screen and (min-width: 781px)')) {

			$('.menu-items .menu-has-children .menu-toggle').each(function () {
				$(this).parent().removeClass('sub-menu-active');
	                //$(this).parent().find('.bon-menu-selected .sub-menu').hide();
	                //$(this).parent().find('.sub-menu-1').hide();
	                //$(this).parent().removeClass('bon-menu-selected');
	                $(this).siblings('.sub-menu').removeAttr('style');
	                $(this).removeClass().addClass('icon bonicons bi-angle-down menu-toggle')
	            });

			$('.panel.callaction').each(function () {
				var mT = ($(this).outerHeight() - $(this).find('.panel-button a').outerHeight()) / 2;
				$(this).find('.panel-button a').css({
					"margin-top": mT + "px"
				})
			})
		} else {

			$('.panel.callaction').each(function () {

				$(this).find('.panel-button a').removeAttr('style');
	               /* var mT = ($(this).outerHeight() - $(this).find('.panel-button a').outerHeight()) / 2;
	                $(this).find('.panel-button a').css({
	                    "margin-top": mT + "px"
	                })*/
		})
		}

	}
};


$(document).ready(onReady.init);
$(window).load(onLoad.init);
$(window).resize(onResize.init);

var launchGoogleEvents = function() {

	var googleElements = {
		1: {
			name: 'Home_CTA',
			label: 'top_browse_all',
			selector: $('.home-ctas-container.top a[data-function="browse-all"]'),
		},
		2: {
			name: 'Home_CTA',
			label: 'top_open_tool',
			selector: $('.home-ctas-container.top a[data-function="open-tool"]'),
		},
		3: {
			name: 'Home_CTA',
			label: 'bottom_browse_all',
			selector: $('.home-ctas-container.bottom a[data-function="browse-all"]'),
		},
		4: {
			name: 'Home_CTA',
			label: 'bottom_open_tool',
			selector: $('.home-ctas-container.bottom a[data-function="open-tool"'),
		},
		5: {
			name: 'Home_products',
			label: 'click',
			selector: $('#featured-listing-slider a.product-link'),
		},
		6: {
			name: 'Home_products_navi',
			label: 'click',
			selector: $('#featured-listing-slider .bx-controls-direction a'),
		},
		7: {
			name: 'Header_click',
			label: 'request_a_visit',
			selector: $('#main-header .phone.visit'),
			value: document.title
		},
		8: {
			name: 'Header_click',
			label: 'phone',
			selector: $('#main-header .phone.phone-1'),
			value: document.title
		},
		/* Category pages */
		9: {
			name: 'Category_list',
			label: 'switch_view',
			selector: $('a.view-grid, a.view-list'),
		},
		10: {
			name: 'Category_list',
			label: 'filter',
			selector: $('.search-order ul li'),
		},
		11: {
			name: 'Sidebar',
			label: 'search_cottages',
			selector: $('#search-listing-form input[type="submit"]'),
		},
		12: {
			name: 'Sidebar',
			label: 'click_social_media_profile',
			selector: $('.bon-toolkit-social-widget a'),
			value: $('.bon-toolkit-social-widget a').attr('title')
		},
		13: {
			name: 'Sidebar',
			label: 'click_featured_listing',
			selector: $('.widget.featured-listing .featured-item a'),
		},
		/* Single product pages */
		14: {
			name: 'Buy_cottage',
			label: 'click_top_cta',
			selector: $('.top-cta a'),
			value: $('h1.entry-title').html(),
		},
		15: {
			name: 'Buy_cottage',
			label: 'click_bottom_cta',
			selector: $('.bottom-cta a'),
			value: $('h1.entry-title').html(),
		},
		16: {
			name: 'Contact_form',
			label: 'from_product_page',
			selector: $('.listing-contact form, #contact-modal form'),
			value: $('h1.entry-title').html(),
		},
		17: {
			name: 'Open_faq',
			label: 'on_product_page',
			selector: $('a[aria-controls="faqCollapse"]'),
		},
		18: {
			name: 'Product_page_related',
			label: 'click',
			selector: $('.listings.related .product-link'),
		},
		19: {
			name: 'Product_page_additional_information',
			label: 'switch_specification_tabs',
			selector: $('.entry-specification .tab-nav a'),
		},
		20: {
			name: 'Product_page_additional_information',
			label: 'click_additional_services',
			selector: $('.entry-specification #accordion-services .accordion-section-title'),
		},
		21: {
			name: 'Contact_form',
			label: 'from_about_us_page',
			selector: $('#tab-target-contact form'),
		},
		22: {
			name: 'Open_faq',
			label: 'on_about_us_page',
			selector: $('#detail-tab .tab-nav a[href="#tab-target-faq"]'),
		},
		23: {
			name: 'Blog_page',
			label: 'use_gallery_nav',
			selector: $('.blog article .carousel-control'),
		},
		24: {
			name: 'Blog_page',
			label: 'launch_video',
			selector: $('.blog article iframe .html5-video-content'),
		},
		25: {
			name: 'Blog_page',
			label: 'choose_category',
			selector: $('.blog article .entry-post-meta a[ref="category"]'),
		},
		26: {
			name: 'Blog_page',
			label: 'choose_category_from_sidebar',
			selector: $('.blog .sidebar .widget_categories .cat-item a'),
		},
		27: {
			name: 'Blog_page',
			label: 'choose_tag',
			selector: $('.blog article .entry-footer .entry-tag a'),
		},
		28: {
			name: 'Blog_page',
			label: 'single_post_navigation',
			selector: $('.blog .loop-nav a'),
		},
	};

	$.each(googleElements, function() {
		var event = this;
		if ( event.name === 'Contact_form' ) {
			$(event.selector.selector).submit(function() {
				if (event.value) {
					ga( 'send', 'event', event.name, event.label, event.value );	
				} else {
					ga( 'send', 'event', event.name, event.label );			
				}
			});
		} else {
			$(event.selector.selector).bind( 'click', function() {
				if (event.value) {
					ga( 'send', 'event', event.name, event.label, event.value );	
				} else {
					ga( 'send', 'event', event.name, event.label );			
				}
			});
		}
	});

	setTimeout("ga( 'send', 'event', '40_seconds', 'read' )", 40000);

};

$(launchGoogleEvents);



})(jQuery);