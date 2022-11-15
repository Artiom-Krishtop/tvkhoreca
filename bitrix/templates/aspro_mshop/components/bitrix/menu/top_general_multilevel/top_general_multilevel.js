	$(document).ready(function() {
		
		
		$(".main-nav .menu > li:not(.current):not(.menu_opener) > a").click(function(){
			$(this).parents("li").siblings().removeClass("current");
			$(this).parents("li").addClass("current");
		});
		
		$(".main-nav .menu .child_wrapp a").click(function(){
			$(this).siblings().removeClass("current");
			$(this).addClass("current");
		});
	});
	