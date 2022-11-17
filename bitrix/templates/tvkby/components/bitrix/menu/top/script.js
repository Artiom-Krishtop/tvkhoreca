function menuDotted(){
	if( $(window).width() < 979 ){
		return false;
	}
	
	var menu = $('nav.mega-menu');
	var menu_w = $('nav.mega-menu table').outerWidth(true); // width of menu with padding and margin.
	var block_w = $('nav.mega-menu').closest('div').width(); // width of closest block menu, without! padding and margin.
	
	var save = '';
	if( menu_w > block_w ){
		save += '<li>' + $(menu).find('td').not('.js-dropdown').last().html() + '</li>';
		$(menu).find('td').not('.js-dropdown').last().remove();
	}else{
		return false;
	}
	
	if( save.length > 0 && $(menu).find('table .more-items').length <= 0 ){
		$(menu).find('table tr').append( '<td class="dropdown js-dropdown"><div class="wrap"><a class="dropdown-toggle more-items" href="#"><span>...</span><i class="icon icon-angle-down"></i></a><ul class="dropdown-menu"></ul></div></td>' );
	}
	
	if( save.length > 0 ){
		$(menu).find('table .js-dropdown .dropdown-menu').prepend( save );
	}
	
	menuDotted();
}

$(window).resize(function(){
	menuDotted();
})

$(document).ready(function(){
	//setTimeout(function(){ menuDotted(); }, 100);
	menuDotted();
})