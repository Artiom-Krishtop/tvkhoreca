
		$(document).ready(function(){
			$('.specials_slider_wrapp .tabs > li').first().addClass('cur');
			$('.specials_slider_wrapp .slider_navigation > li').first().addClass('cur');
			$('.specials_slider_wrapp .tabs_content > li').first().addClass('cur');
			
			var flexsliderItemWidth = 210;
			var flexsliderItemMargin = 20;
			var sliderWidth = $('.specials_slider_wrapp').outerWidth();
			var flexsliderMinItems = Math.floor(sliderWidth / (flexsliderItemWidth + flexsliderItemMargin));
			$('.specials_slider_wrapp .tabs_content > li.cur').flexslider({
				animation: 'slide',
				selector: '.specials_slider > li',
				slideshow: false,
				animationSpeed: 600,
				directionNav: true,
				controlNav: false,
				pauseOnHover: true,
				animationLoop: true, 
				itemWidth: flexsliderItemWidth,
				itemMargin: flexsliderItemMargin, 
				minItems: flexsliderMinItems,
				start: function(slider){
					slider.find('li').css('opacity', 1);
				},
				controlsContainer: '.specials_slider_navigation.cur',
			});
			
			$('.specials_slider_wrapp .tabs > li').click(function(){
				if(!$(this).hasClass('active')){
					var sliderIndex = $(this).index();
					$(this).addClass('active').addClass('cur').siblings().removeClass('active').removeClass('cur');
					$('.specials_slider_wrapp .slider_navigation > li:eq(' + sliderIndex + ')').addClass('cur').show().siblings().removeClass('cur');
					$('.specials_slider_wrapp .tabs_content > li:eq(' + sliderIndex + ')').addClass('cur').siblings().removeClass('cur');
					if(!$('.specials_slider_wrapp .tabs_content > li.cur .flex-viewport').length){
						$('.specials_slider_wrapp .tabs_content > li.cur').flexslider({
							animation: 'slide',
							selector: '.specials_slider > li',
							slideshow: false,
							animationSpeed: 600,
							directionNav: true,
							controlNav: false,
							pauseOnHover: true,
							animationLoop: true, 
							itemWidth: flexsliderItemWidth,
							itemMargin: flexsliderItemMargin, 
							minItems: flexsliderMinItems,
							start: function(slider){
								slider.find('li').css('opacity', 1);
							},
							controlsContainer: '.specials_slider_navigation.cur',
						});
					}
					$(window).resize();
				}
			});
			
			$(window).resize(function(){
				var sliderWidth = $('.specials_slider_wrapp').outerWidth();
				/*$('.specials_slider_wrapp .tabs_content > li.cur').css('height', '');
				$('.specials_slider_wrapp .tabs_content > li.cur .catalog_item').css('height', '');
				$('.specials_slider_wrapp .tabs_content > li.cur .catalog_item .item-title').css('height', '');
				$('.specials_slider_wrapp .tabs_content > li.cur .catalog_item .item_info').css('height', '');*/
				$('.specials_slider_wrapp .tabs_content .tab.cur .specials_slider .buttons_block').hide();
				$('.specials_slider_wrapp .tabs_content > li.cur').equalize({children: '.item-title'}); 
				$('.specials_slider_wrapp .tabs_content > li.cur').equalize({children: '.item_info'}); 
				$('.specials_slider_wrapp .tabs_content > li.cur').equalize({children: '.catalog_item'});
				
				var itemsButtonsHeight = $('.specials_slider_wrapp .tabs_content .tab.cur .specials_slider > li .buttons_block').height();
				var tabsContentUnhover = $('.specials_slider_wrapp .tabs_content .tab.cur').height() * 1;
				var tabsContentHover = tabsContentUnhover + itemsButtonsHeight+50;
				$('.specials_slider_wrapp .tabs_content .tab.cur').attr('data-unhover', tabsContentUnhover);
				$('.specials_slider_wrapp .tabs_content .tab.cur').attr('data-hover', tabsContentHover);
				$('.specials_slider_wrapp .tabs_content').height(tabsContentUnhover);
				if($('.specials_slider_wrapp .tabs_content > li.cur').length && typeof($('.specials_slider_wrapp .tabs_content > li.cur').data('flexslider')) !== 'undefined'){
					$('.specials_slider_wrapp .tabs_content > li.cur').data('flexslider').vars.minItems = flexsliderMinItems = Math.floor(sliderWidth / (flexsliderItemWidth + flexsliderItemMargin));
				//	$('.specials_slider_wrapp .tabs_content > li.cur').data('flexslider').vars.maxItems = 3;
					$('.specials_slider_wrapp .tabs_content > li.cur').flexslider(0);
				}
				if($('.specials_slider_wrapp .tabs_content > li.cur').find('.specials_slider > li').length > flexsliderMinItems){
					$('.specials_slider_wrapp .slider_navigation > li.cur').show();
					$('.specials_slider_wrapp .slider_navigation > li.cur > ul').show();
				}
				else{
					$('.specials_slider_wrapp .slider_navigation > li.cur').hide();
					$('.specials_slider_wrapp .slider_navigation > li.cur > ul').hide();
				}
			});
			
			$(window).resize();
		});
		
		$(document).ready(function(){
			$(window).resize();
			$('.specials_slider > li').hover(
				function(){
					//if($(window).outerWidth()>550){
						var tabsContentHover = $(this).parents('.tab').attr('data-hover') * 1;
						$(this).parents('.tab').fadeTo(100, 1);
						$(this).parents('.tab').stop().css({'height': tabsContentHover});
						$(this).find('.buttons_block').fadeIn(750, 'easeOutCirc');
					//}
				},
				function(){
					//if($(window).outerWidth()>550){
						var tabsContentUnhoverHover = $(this).parents('.tab').attr('data-unhover') * 1;
						$(this).parents('.tab').stop().animate({'height': tabsContentUnhoverHover}, 100);
						$(this).find('.buttons_block').stop().fadeOut(203);
					//}
				}
			);
		});
		