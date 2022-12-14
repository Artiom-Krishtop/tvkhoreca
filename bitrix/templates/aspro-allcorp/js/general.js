(function($){
	/*$.extend({
		scrollToTop: function(){
			var _isScrolling = false;
			
			// Append Button
			$("body").append( $("<a />").addClass("scroll-to-top").attr({ "href": "#", "id": "scrollToTop" }).append( $("<i />").addClass("icon icon-chevron-up icon-white") ) );
			$("#scrollToTop").click(function(e){
				e.preventDefault();
				$("body, html").animate({scrollTop : 0}, 500);
				return false;
			});
			
			// Show/Hide Button on Window Scroll event.
			$(window).scroll(function(){
				if(!_isScrolling) {
					_isScrolling = true;
					if( $(window).scrollTop() > 150 ){
						$("#scrollToTop").stop(true, true).addClass("visible");
						_isScrolling = false;
					}else{
						$("#scrollToTop").stop(true, true).removeClass("visible");
						_isScrolling = false;
					}
				}
			});
		}
	});*/
	
	$.fn.equalizeHeights = function( outer ){
		var maxHeight = this.map( function( i, e ){
			$(e).css('height', 'inherit');
			if( outer == true ){
				return $(e).actual('outerHeight');
			}else{
				return $(e).actual('height');
			}
		}).get();
		return this.height( Math.max.apply( this, maxHeight ) );
	}

	$.fn.sliceHeight = function( options ){
		function _slice(el){
			if( options.slice ){
				for( var i = 0; i < el.length; i += options.slice ){
					$(el.slice(i, i + options.slice)).equalizeHeights( options.outer );
				}
			}
			if( options.lineheight ){
				el.each(function() {
					$(this).css("line-height", $(this).outerHeight() + "px");
				});
			}
		}
		
		var options = $.extend({
			slice: null,
			outer: false,
			lineheight: false
		}, options);
		var el = $(this);
		_slice(el);
		$(window).resize(function() {
			_slice(el);
		});
	}
})(jQuery);

function onLoadjqm(hash){
	var name = $(hash.t).data('name'), top = $(document).scrollTop() + ( $(window).height() - hash.w.height() ) / 2 + 'px';
	top = (parseInt(top) < 0 ? 0 : top);
	$.each( $(hash.t).get(0).attributes, function( index, attr ){
		if( /^data\-autoload\-(.+)$/.test( attr.nodeName ) ){
			var key = attr.nodeName.match(/^data\-autoload\-(.+)$/)[1];
			var el = $('input[name="'+key.toUpperCase()+'"]');
			el.val( $(hash.t).data('autoload-'+key) ).attr('readonly', 'readonly');
			el.attr('title', el.val());
		}
	});
	if($(hash.t).data('autohide')){
		$(hash.w).data('autohide', $(hash.t).data('autohide'));
	}
	if(name == 'order_product'){
		$('input[name="PRODUCT"]').val($(hash.t).data('product')).attr('readonly', 'readonly').attr('title', $('input[name="PRODUCT"]').val());
	}
	if(name == 'question'){
		if($(hash.t).data('product')) $('input[name="NEED_PRODUCT"]').val( $(hash.t).data('product')).attr('readonly', 'readonly').attr('title', $('input[name="NEED_PRODUCT"]').val());
	}
	hash.w.addClass('show').css({'margin-left': '-' + hash.w.width() / 2+'px', 'top': top, 'opacity': 1});
}

function onHide(hash){
	if($(hash.w).data('autohide')){
		eval($(hash.w).data('autohide'));
	}
	hash.w.css('opacity', 0).hide();
	hash.w.empty();
	hash.o.remove();
	hash.w.removeClass('show');
}
 

$.fn.jqmEx = function(){
	$(this).each(function(){
		var _this = $(this);
		var name = _this.data('name');
		if(!$('.' + name + '_frame').length){
			//var script = "/home/ajax/form.php";
			var script = "/home/ajax/form.php";
			$.each(_this.get(0).attributes, function(index, attr){
				if(/^data\-param\-(.+)$/.test(attr.nodeName)){
					var key = attr.nodeName.match(/^data\-param\-(.+)$/)[1];
					//if(script == "/home/ajax/form.php"){
					if(script == "/home/ajax/form.php"){
						script += '?';
					}
					else{
						script += '&';
					}
					script += key + '=' + _this.data('param-' + key);
				}
			});
			
			if(_this.attr('disabled') != 'disabled'){
				$('body').find('.' + name + '_frame').remove();
				$('body').append('<div class="' + name + '_frame jqmWindow" style="width:500px"></div>');
				$('.' + name + '_frame').jqm({trigger: '*[data-name="' + name + '"]', onLoad: function(hash){onLoadjqm(hash);}, onHide: function(hash){onHide(hash);}, ajax:script});
			}
		}
	})
}

$(window).resize(function(){
	$('html.bx-no-touch .jqmWindow.show').css('top', $(document).scrollTop() + ( $(window).height() - $('.jqmWindow.show').height() ) / 2 + 'px');
})

$(document).ready(function(){
	$.extend( $.validator.messages, {
		required: BX.message("JS_REQUIRED"),
		email: BX.message("JS_FORMAT"),
		extension: BX.message("JS_FILE_EXT"),
		equalTo: BX.message("JS_PASSWORD_COPY"),
		minlength: BX.message("JS_PASSWORD_LENGTH"),
		remote: BX.message("JS_ERROR")
	});
	
	$.validator.addMethod(
		'regexp', function( value, element, regexp ){
			var re = new RegExp( regexp );
			return this.optional( element ) || re.test( value );
		},
		BX.message("JS_FORMAT")
	);
	
	$.validator.addMethod(
		'filesize', function( value, element, param ){
			return this.optional( element ) || ( element.files[0].size <= param )
		},
		BX.message("JS_FILE_SIZE")
	);
	
	$.validator.addMethod(
          'captcha', function( value, element, params ){
               return $.validator.methods.remote.call(this, value, element,{
                    url: '/home/ajax/check-captcha.php',
                    type: 'post',
                    data:{
                         captcha_word: value,
                         captcha_sid: function(){
                              return $(element).closest('.form-body').find('input[name="captcha_sid"]').val();
                         }
                    }
               });
          },
		  BX.message("JS_ERROR")
          
     );
	 
	/*reload captcha*/
	$('body').on( 'click', '.refresh', function(e){
		e.preventDefault();
		$.ajax({
			url: "/home/ajax/captcha.php"
		}).done(function(text){
			$('.captcha_sid').val(text);
			$('.captcha_img').attr("src", "/bitrix/tools/captcha.php?captcha_sid=" + text);
		});
	})
	
	$.validator.addClassRules({
		'phone':{
			regexp: validate_phone_mask
		},
		'confirm_password':{
			equalTo: 'input[name="REGISTER\[PASSWORD\]"]',
			minlength: 6
		},
		'password':{
			minlength: 6
		},
		'inputfile':{
			extension: validate_file_ext,
			filesize: 5000000
		},
		 'captcha':{
			captcha: ''
		}
	});
	
	$("input[type=file]").uniform({fileDefaultHtml:'tratata'});
	
	/*check mobile device*/
	
	if(jQuery.browser.mobile){
		$('*[data-event="jqm"]').live('click', function(){
			location.href = '/form/?FORM_ID='+$(this).data('param-id')+'&SERVICE='+$(this).data('service');
		})
		$('.services.detail .galery .galery').each(function(){
			var item = $(this).find('.item');
			item.addClass('mobile');
			item.find('a').removeClass('fancybox');
		})
		$('.catalog.detail .slides li').each(function(){
			$(this).find('a').removeClass('fancybox');
		})
		$('.style-switcher').addClass('hidden');
		$('.hint span').remove();
	}else{	
		$('*[data-event="jqm"]').jqmEx();
	}
	
	$('a.fancybox:has(img)').fancybox();
	
	// Responsive Menu Events
	var addActiveClass = false;
	
	$("#mainMenu li.dropdown > a, #mainMenu li.dropdown-submenu > a").on( "click", function(e){
		e.preventDefault();
		if( $(window).width() > 979 ) return;
		
		addActiveClass = $(this).parent().hasClass("resp-active");
		
		$("#mainMenu").find(".resp-active").removeClass("resp-active");
		
		if( !addActiveClass ){
			$(this).parents("li").addClass("resp-active");
		}
	});
	
	$(document).on('click', '.mega-menu .dropdown-menu', function(e){
		e.stopPropagation()
	});
	
	$(document).on('click', '.mega-menu .dropdown-toggle.more-items', function(e){
		e.preventDefault();
	});
	
	$(".flexslider:not(.thmb)").each(function(){
		var slider = $(this);
		var options;
		var defaults = {
			animationLoop: false,
			controlNav: false,
			directionNav: true
		}
		var config = $.extend({}, defaults, options, slider.data("plugin-options"));
				
		slider.flexslider(config).addClass("flexslider-init");
		
		if( config.controlNav )
			slider.addClass("flexslider-control-nav");
		
		if( config.directionNav )
			slider.addClass("flexslider-direction-nav");
	});
	
	/* toggle */
	
	var $this = this,
		previewParClosedHeight = 25;
	
	$("section.toggle > label").prepend($("<i />").addClass("icon icon-plus"));
	$("section.toggle > label").prepend($("<i />").addClass("icon icon-minus"));
	$("section.toggle.active > p").addClass("preview-active");
	$("section.toggle.active > div.toggle-content").slideDown(350, function() {});
	
	$("section.toggle > label").click(function(e){
		var parentSection = $(this).parent(),
			parentWrapper = $(this).parents("div.toogle"),
			previewPar = false,
			isAccordion = parentWrapper.hasClass("toogle-accordion");
			
		if(isAccordion && typeof(e.originalEvent) != "undefined") {
			parentWrapper.find("section.toggle.active > label").trigger("click");
		}
		
		parentSection.toggleClass("active");
		
		// Preview Paragraph
		if( parentSection.find("> p").get(0) ){
			previewPar = parentSection.find("> p");
			var previewParCurrentHeight = previewPar.css("height");
			previewPar.css("height", "auto");
			var previewParAnimateHeight = previewPar.css("height");
			previewPar.css("height", previewParCurrentHeight);
		}
		
		// Content
		var toggleContent = parentSection.find("> div.toggle-content");
		
		if( parentSection.hasClass("active") ){
			$(previewPar).animate({
				height: previewParAnimateHeight
			}, 350, function() {
				$(this).addClass("preview-active");
			});
			toggleContent.slideDown(350, function() {});
		}else{
			$(previewPar).animate({
				height: previewParClosedHeight
			}, 350, function() {
				$(this).removeClass("preview-active");
			});
			toggleContent.slideUp(350, function() {});
		}
	});
	
	/* /toogle */
	
	/* accordion */
	
	$('.accordion-head').on('click', function(e){
		e.preventDefault();
		if( $(this).hasClass('accordion-open') ){
			$(this).addClass('accordion-close').removeClass('accordion-open');
		}else{
			$(this).addClass('accordion-open').removeClass('accordion-close');
		}
	})
	
	/* /accordion */
	
	/* progress bar */
	
	$("[data-appear-progress-animation]").each(function(){
		var $this = $(this);
		$this.appear(function(){
			var delay = ($this.attr("data-appear-animation-delay") ? $this.attr("data-appear-animation-delay") : 1);
			if( delay > 1 )
				$this.css("animation-delay", delay + "ms");
			$this.addClass($this.attr("data-appear-animation"));

			setTimeout(function(){
				$this.animate({
					width: $this.attr("data-appear-progress-animation")
				}, 1500, "easeOutQuad", function() {
					$this.find(".progress-bar-tooltip").animate({
						opacity: 1
					}, 500, "easeOutQuad");
				});
			}, delay);
		}, {accX: 0, accY: -50});
	});
	
	/* /progress bar */
	
	$("a[rel=tooltip]").tooltip();
	$("span[data-toggle=tooltip]").tooltip();
	
	$("select.sort").change(function(){
		location.href=$(this).val();
	})
	/*$(".side-menu .submenu > li.active > a").click(function(e){
		e.preventDefault();
	})*/
	setTimeout(function(th){
		$('.catalog.group.list .item').each( function(){
			var th=$(this);				
			if( th.find('.image').actual('height') > th.find('.text_info').height() ){
				th.find('.text_info .titles').height(th.find('.image').actual('height')-61);
			}
			
		})
	},700)

	/*item galery*/
	$('.thumbs .item a').live("click", function(e){
		e.preventDefault();
		$('.thumbs .item').removeClass('current');
		$(this).closest('.item').toggleClass('current');
		$('.slides li'+$(this).attr('href')).addClass("current").siblings().removeClass("current");
	});


})