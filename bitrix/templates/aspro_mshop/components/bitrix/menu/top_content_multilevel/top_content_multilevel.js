		$(".content_menu .menu > li:not(.current) > a").click(function()
		{
			$(this).parents("li").siblings().removeClass("current");
			$(this).parents("li").addClass("current");
		});
		$(".content_menu .menu .child_wrapp a").click(function()
		{
			$(this).siblings().removeClass("current");
			$(this).addClass("current");
		});
