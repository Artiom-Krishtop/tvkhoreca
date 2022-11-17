		$(document).ready(function(){

			$('.tab_slider_wrapp.<?=$class_block;?> .tabs > li').first().addClass('cur');
			$('.tab_slider_wrapp.<?=$class_block;?> .slider_navigation > li').first().addClass('cur');
			$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content > li').first().addClass('cur');

			var flexsliderItemWidth = 210;
			var flexsliderItemMargin = 20;

			var sliderWidth = $('.tab_slider_wrapp.<?=$class_block;?>').outerWidth();
			var flexsliderMinItems = Math.floor(sliderWidth / (flexsliderItemWidth + flexsliderItemMargin));
			$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content > li.cur').flexslider({
				animation: 'slide',
				selector: '.tabs_slider .catalog_item',
				slideshow: false,
				animationSpeed: 600,
				directionNav: true,
				controlNav: false,
				pauseOnHover: true,
				animationLoop: true,
				itemWidth: flexsliderItemWidth,
				itemMargin: flexsliderItemMargin,
				minItems: flexsliderMinItems,
				controlsContainer: '.tabs_slider_navigation.cur',
				start: function(slider){
					slider.find('li').css('opacity', 1);
				}
			});

			$('.tab_slider_wrapp.<?=$class_block;?> .tabs > li').on('click', function(){
				if(!$(this).hasClass('active')){
					var sliderIndex = $(this).index();
					$(this).addClass('active').addClass('cur').siblings().removeClass('active').removeClass('cur');
					$('.tab_slider_wrapp.<?=$class_block;?> .slider_navigation > li:eq(' + sliderIndex + ')').addClass('cur').show().siblings().removeClass('cur');
					$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content > li:eq(' + sliderIndex + ')').addClass('cur').siblings().removeClass('cur');
					if(!$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content > li.cur .flex-viewport').length){
						$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content > li.cur').flexslider({
							animation: 'slide',
							selector: '.tabs_slider .catalog_item',
							slideshow: false,
							animationSpeed: 600,
							directionNav: true,
							controlNav: false,
							pauseOnHover: true,
							animationLoop: true,
							itemWidth: flexsliderItemWidth,
							itemMargin: flexsliderItemMargin,
							minItems: flexsliderMinItems,
							controlsContainer: '.tabs_slider_navigation.cur',
						});
					}
					$(window).resize();
				}
			});

			$(window).resize(function(){
				var sliderWidth = $('.tab_slider_wrapp.<?=$class_block;?>').outerWidth();
				$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content > li.cur').css('height', '');
				$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content .tab.cur .tabs_slider .buttons_block').hide();
				$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content > li.cur').equalize({children: '.item-title'});
				$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content > li.cur').equalize({children: '.item_info'});
				$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content > li.cur').equalize({children: '.catalog_item'});
				var itemsButtonsHeight = $('.tab_slider_wrapp.<?=$class_block;?> .tabs_content .tab.cur .tabs_slider li .buttons_block').height();
				var tabsContentUnhover = $('.tab_slider_wrapp.<?=$class_block;?> .tabs_content .tab.cur').height() * 1;
				var tabsContentHover = tabsContentUnhover + itemsButtonsHeight+50;
				$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content .tab.cur').attr('data-unhover', tabsContentUnhover);
				$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content .tab.cur').attr('data-hover', tabsContentHover);
				$('.tab_slider_wrapp.<?=$class_block;?> .tabs_content').height(tabsContentUnhover);
			});

			$(window).resize();
			$(document).on({
				mouseover: function(e){
					var tabsContentHover = $(this).closest('.tab').attr('data-hover') * 1;
					$(this).closest('.tab').fadeTo(100, 1);
					$(this).closest('.tab').stop().css({'height': tabsContentHover});
					$(this).find('.buttons_block').fadeIn(450, 'easeOutCirc');
				},
				mouseleave: function(e){
					var tabsContentUnhoverHover = $(this).closest('.tab').attr('data-unhover') * 1;
					$(this).closest('.tab').stop().animate({'height': tabsContentUnhoverHover}, 100);
					$(this).find('.buttons_block').stop().fadeOut(233);
				}
			}, '.<?=$class_block;?> .tabs_slider li');
		})
	