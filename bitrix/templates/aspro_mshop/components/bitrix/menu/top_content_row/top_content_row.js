$(".content_menu .menu.orange-sliding > li:not(.current) > a").click(function(){
	$(this).parents("li").siblings().removeClass("current");
	$(this).parents("li").addClass("current");
});

$("ul.menu.adaptive .menu_opener_top").click(function(){
	$(this).parents(".menu.adaptive").toggleClass("opened");
	$("ul.menu.full_top").toggleClass("opened").slideToggle(200);
});

var menu_1 = $('.content_menu ul.menu.orange-sliding');
var extendedItemsContainer_1 = $(menu_1).find('li.more');
var extendedItemsSubmenu_1 = $(extendedItemsContainer_1).find('.child_wrapp');
var extendedItemsContainerWidth_1 = $(extendedItemsContainer_1).outerWidth();

var reCalculateMenuTop = function(){
	$(menu_1).find('li:not(.stretch)').show();
	$(extendedItemsSubmenu_1).html('');
	$(extendedItemsContainer_1).removeClass('visible');
	calculateMenuTop();
}

var calculateMenuTop = function(){
	var menuWidth = $(menu_1).outerWidth();
	$(menu_1).css('display', '');
	$('.content_menu .menu.orange-sliding > li').each(function(index, element){
		if(!$(element).is('.more') && !$(element).is('.stretch')){

			var itemOffset = $(element).position().left;
			var itemWidth = $(element).outerWidth();
			var bLast = index == $('.content_menu .menu.orange-sliding > li').length - 3;

			if(itemOffset + itemWidth + (bLast ? 0 : extendedItemsContainerWidth_1) > menuWidth || $(extendedItemsContainer_1).is('.visible')){
				if(!$(extendedItemsContainer_1).is('.visible')){
					$(extendedItemsContainer_1).addClass('visible').css('display', '');
				}
				var menuItem = $(element).clone();

				var menuItemTitleA = $(menuItem).find('> a');
				$(menuItem).find('.depth3').find('a:not(.title)').remove();
				$(menuItem).wrapInner('<ul ' + (($(extendedItemsSubmenu_1).find('> ul').length % 3 == 2) ? 'class="last"' : '') + '></ul>');
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

				$(extendedItemsSubmenu_1).append($(menuItem).html());
				$(element).hide();
			}
			else{
				$(element).show();
				if(bLast){
					$(element).css('border-right-width', '0px');
				}
			}
		}

		if(!extendedItemsSubmenu_1.html().length){
			extendedItemsContainer_1.hide();
		}
	});
	$('.content_menu .menu.orange-sliding .see_more a.see_more').removeClass('see_more');
	$('.content_menu .menu.orange-sliding li.menu_item a').removeClass('d');
	$('.content_menu .menu.orange-sliding li.menu_item a').removeAttr('style');
}

if($(window).outerWidth() > 482){
	calculateMenuTop();
	$(window).load(function(){
		reCalculateMenuTop();
	});
}

$(document).ready(function() {
	$('.content_menu .menu.orange-sliding > li:not(.current):not(.more):not(.stretch) > a').click(function(){
		$(this).parents('li').siblings().removeClass('current');
		$(this).parents('li').addClass('current');
	});

	$('.content_menu .menu.orange-sliding .child_wrapp a').click(function(){
		$(this).siblings().removeClass('current');
		$(this).addClass('current');
	});
    $(window).resize(function(){
		touchMenuTop('ul.menu:not(.opened) > li.menu_item_l1');
        if($(".content_menu .menu.orange-sliding").length && $(".content_menu .menu.orange-sliding").css("display") != "none"){
            if($(window).outerWidth() > 482){
                reCalculateMenuTop();
            }
        }
    });
});
function touchMenuTop(selector){
	if($(window).outerWidth() > 482){
		$(selector).each(function(){
			var th=$(this);
			th.on('touchend', function(e) {
				if (th.find('.child').length && !th.hasClass('hover')) {
					e.preventDefault();
					e.stopPropagation();
					th.siblings().removeClass('hover');
					th.addClass('hover');
					$('.menu .child').css({'display':'none'});
					th.find('.child').css({'display':'block'});
				}
			})
		})
	}else{
		$(selector).off();
	}
}