	var menu = $('.catalog_menu ul.menu.full');
	var extendedItemsContainer = $(menu).find('li.more');
	var extendedItemsSubmenu = $(extendedItemsContainer).find('.child_wrapp');
	var extendedItemsContainerWidth = $(extendedItemsContainer).outerWidth();
	
	var reCalculateMenu = function(){
		$(menu).find('li:not(.stretch)').show();
		$(extendedItemsSubmenu).html('');
		$(extendedItemsContainer).removeClass('visible');
		calculateMenu();
	}
	
	var calculateMenu = function(){
		var menuWidth = $(menu).outerWidth();	
		$(menu).css('display', '');			
		$('.catalog_menu .menu > li').each(function(index, element){
			if(!$(element).is('.more')&&!$(element).is('.stretch')){
				var itemOffset = $(element).position().left;
				var itemWidth = $(element).outerWidth();
				var submenu = $(element).find('.submenu'); 
				var submenuWidth = $(submenu).outerWidth();
				var depthlvl3 = $(element).find('.depth3');
				$(depthlvl3).each(function() {
						$(this).css({'marginLeft': (submenuWidth - 15)});
				});

				if($(submenu).length){
					if(index != 0){
						$(submenu).css({'marginLeft': (itemWidth - submenuWidth) / 2});
					}
				}
				var bLast = index == $('.catalog_menu .menu > li').length - 3;
				
				if(itemOffset + itemWidth + (bLast ? 0 : extendedItemsContainerWidth) > menuWidth || $(extendedItemsContainer).is('.visible')){
					if(!$(extendedItemsContainer).is('.visible')){
						$(extendedItemsContainer).addClass('visible').css('display', '');
					}
					var menuItem = $(element).clone();
					
					var menuItemTitleA = $(menuItem).find('> a');
					$(menuItem).find('.depth3').find('a:not(.title)').remove();
					$(menuItem).wrapInner('<ul ' + (($(extendedItemsSubmenu).find('> ul').length % 3 == 2) ? 'class="last"' : '') + '></ul>');
					$(menuItem).find('ul').prepend('<li class="menu_title ' + $(menuItem).attr('class') + '"><a href="' + menuItemTitleA.attr('href') + '">' + menuItemTitleA.text() + '</a></li>');
					$(menuItem).find('ul > li').removeClass('menu_item_l1');
					menuItemTitleA.remove();
					$(menuItem).find('.child_wrapp > a').each(function() {
						$(this).wrap('<li class="menu_item"></li>');
					});
					$(menuItem).find('.child_wrapp > .depth3').each(function() {
						$(this).find('a.title').wrap('<li class="menu_item"></li>');
					});
					$(menuItem).find('li.menu_item').each(function() {
						$(menuItem).find('ul').append('<li class="menu_item ' + $(this).find('> a').attr('class') +'" style="' + $(this).find('> a').attr('style') +'">' + $(this).html() + '</li>');
					});
					$(menuItem).find('.child.submenu').remove();
					
					
					$(extendedItemsSubmenu).append($(menuItem).html());
					$(element).hide();
				}
				else{
					$(element).show();
					if(bLast){
						$(element).css('border-right-width', '0px');
					}
				}
			}
			if(!extendedItemsSubmenu.html().length){
				extendedItemsContainer.hide();
			}
		});
		$('.catalog_menu .menu .see_more a.see_more').removeClass('see_more');
		$('.catalog_menu .menu li.menu_item a').removeClass('d');
		$('.catalog_menu .menu li.menu_item a').removeAttr('style');
	}
	
	if($(window).outerWidth() > 600){
		calculateMenu();
		$(window).load(function(){
			reCalculateMenu();
		});
	}
	
	$(document).ready(function() {
		$('.catalog_menu .menu > li:not(.current):not(.more):not(.stretch) > a').click(function(){
			$(this).parents('li').siblings().removeClass('current');
			$(this).parents('li').addClass('current');
		});
		
		$('.catalog_menu .menu .child_wrapp a').click(function(){
			$(this).siblings().removeClass('current');
			$(this).addClass('current');
		});
	});