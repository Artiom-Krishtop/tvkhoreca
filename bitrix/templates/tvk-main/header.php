<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<!--[if IE 6 ]><html class="ie6"><![endif]-->
<!--[if IE 7 ]><html class="ie7"><![endif]-->
<!--[if IE 8 ]><html class="ie8"><![endif]-->
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html><!--<![endif]-->
<head>
<?$APPLICATION->ShowHead(false)?>
<title><?$APPLICATION->ShowTitle()?></title>
<meta name="Author" content="Julia Agapova">
<!-- JavaScript codes -->
	<script type="text/javascript" src="/bitrix/js/main/jquery/jquery-1.8.3.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.fullscreenr.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/jquery.cookie.js"></script>
	<script type="text/javascript">  
		<!--
			// You need to specify the size of your background image here (could be done automatically by some PHP code)
			var FullscreenrOptions = {  width: 2400, height: 1200, bgID: '#bgimg' };
			// This will activate the full screen background!
			jQuery.fn.fullscreenr(FullscreenrOptions);
		//-->
	</script>
<?$APPLICATION->ShowMeta("robots")?>
<?$APPLICATION->ShowMeta("keywords")?>
<?$APPLICATION->ShowMeta("description")?>
<?$APPLICATION->ShowCSS();?>
<?$APPLICATION->ShowHeadStrings()?>
<?$APPLICATION->ShowHeadScripts()?>
<script>
	$(document).ready(function(){
		//alert("w: " + screen.width + " " + window.innerWidth);
		$.cookie('screen_width', screen.width, {expires: 5, path: '/'});
		var wind = $(window).width();
		$.cookie('window_width', wind, {expires: 1, path: '/'});
	});
	</script>
</head>

<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<img id="bgimg" src="<?=SITE_TEMPLATE_PATH?>/images/tvkby.jpg" />
<div id="work-area">
