$( document ).ready(function() {
	$(".style-switcher .switch").on("click", function(e){
		e.preventDefault();
		var styleswitcher = $(this).closest(".style-switcher");
		if(styleswitcher.hasClass("active")){
			styleswitcher.animate({ left: "-" + styleswitcher.width() + "px" }, 300).removeClass("active");
			$.removeCookie('styleSwitcher', { path: '/' });
		}
		else{
			styleswitcher.animate({ left: "0" }, 300).addClass("active");
			$.cookie('styleSwitcher', 'open', { path: '/' });
		}
	});
});