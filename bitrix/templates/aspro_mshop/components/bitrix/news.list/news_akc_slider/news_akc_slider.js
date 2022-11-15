		var timeoutSlide1;
		InitFlexSliderNews = function() {
			var flexsliderItemWidth1 = 268,
				flexsliderItemMargin1 = 20;
			$(".untnews_slider_wrapp").flexslider({
				animation: "slide",
				selector: ".news_slider > li",
				slideshow: false,
				slideshowSpeed: 6000,
				animationSpeed: 600,
				directionNav: true,
				//controlNav: false,
				pauseOnHover: true,
				animationLoop: true, 
				controlsContainer: ".untnews_slider_navigation",
				itemWidth: flexsliderItemWidth1,
				itemMargin: flexsliderItemMargin1, 
				// manualControls: ".block_wr .flex-control-nav.flex-control-paging li a"
				start:function(){
					$('.untnews_slider_wrapp .flex-viewport .news_slider').equalize({children: '.item .info'});
					$('.untnews .flex-control-nav li a').on('touchend', function(){
						$(this).addClass('touch');
					});
					$('.untnews_slider_wrapp li').css('opacity', 1);
				}
			});
			$('.stores').equalize({children: '.wrapp_block', reset: true});
		}
		$(document).ready(function(){
			$(window).resize(function(){
				clearTimeout(timeoutSlide1);
				timeoutSlide1 = setTimeout(InitFlexSliderNews(),50);
			})
		});
		/*$(document).ready(function(){
			var flexsliderItemWidth = 268,
				flexsliderItemMargin = 20;
			$(".news_slider_wrapp").flexslider({
				animation: "slide",
				selector: ".news_slider > li",
				slideshow: false,
				slideshowSpeed: 6000,
				animationSpeed: 600,
				directionNav: true,
				//controlNav: true,
				pauseOnHover: true,
				animationLoop: true, 
				controlsContainer: ".news_slider_navigation",
				itemWidth: flexsliderItemWidth,
				itemMargin: flexsliderItemMargin, 
				manualControls: ".news_akc_block .flex-control-nav.flex-control-paging li a",
				start: function(){
					$('.news_slider_wrapp .flex-viewport .news_slider').equalize({children: '.item .info'});
				}
			});
			$(window).resize(function(){
				//$('.news_slider_wrapp .flex-viewport .news_slider').equalize({children: '.item'});
			})
		})*/ 	