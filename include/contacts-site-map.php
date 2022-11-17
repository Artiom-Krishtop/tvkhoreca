<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"map",
	array(
		"API_KEY" => "AIzaSyCTTEzffmCg5cdHj-buOBQudckytUTM4Tc",
		"CONTROLS" => array("ZOOM","TYPECONTROL","SCALELINE"),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:53.877731564859495;s:10:\"yandex_lon\";d:27.584311169311015;s:12:\"yandex_scale\";i:15;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:27.584311169311;s:3:\"LAT\";d:53.877731564867;s:4:\"TEXT\";s:61:\"ЗАО «ТВК»###RN###Минск, ул. Ванеева, 48\";}}}",
		"MAP_HEIGHT" => "100%",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array("ENABLE_DBLCLICK_ZOOM","ENABLE_DRAGGING"),
		"USE_REGION_DATA" => "Y"
	)
);?>