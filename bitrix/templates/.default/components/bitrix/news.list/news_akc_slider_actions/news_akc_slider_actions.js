var timeoutSlide2;

InitFlexSliderAcntions = function() {

	var flexsliderItemWidth2 = 268,
		flexsliderItemMargin2 = 20;

	$(".actions_slider_wrapp").flexslider({
		animation: "slide",
		selector: ".actions_slider > li",
		slideshow: false,
		slideshowSpeed: 6000,
		animationSpeed: 600,
		directionNav: true,
		//controlNav: false,
		pauseOnHover: true,
		animationLoop: true,
		controlsContainer: ".actions_slider_navigation",
		itemWidth: flexsliderItemWidth2,
		itemMargin: flexsliderItemMargin2,
		// manualControls: ".block_wr .flex-control-nav.flex-control-paging li a"
		start:function(){
			$('.actions_slider_wrapp .flex-viewport .news_slider').equalize({children: '.item .info'});
			$('.actions .flex-control-nav li a').on('touchend', function(){
				$(this).addClass('touch');
			});
			$('.actions_slider_wrapp li').css('opacity', 1);
		}
	});

	$('.stores').equalize({children: '.wrapp_block', reset: true});

}

$(document).ready(function(){
	$(window).resize(function(){
		clearTimeout(timeoutSlide2);
		timeoutSlide2 = setTimeout(InitFlexSliderAcntions(),50);
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
