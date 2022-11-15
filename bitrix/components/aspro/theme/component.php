<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/* get color */
aspro::getParam($arResult, "color");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/responsive.css', true);
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/themes/'.$arResult["COLOR"]["CURRENT"].'/style.css', true);
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/custom.css');
if(file_exists(str_replace('//', '/', $_SERVER["DOCUMENT_ROOT"].SITE_DIR."/favicon.ico"))){
	$APPLICATION->AddHeadString('<link rel="shortcut icon" href="'.str_replace('//', '/', SITE_DIR.'/favicon.ico').'" type="image/x-icon" />', true);
	$APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="57x57" href="'.str_replace('//', '/', SITE_DIR.'/favicon_57.png').'" />', true);
	$APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="72x72" href="'.str_replace('//', '/', SITE_DIR.'/favicon_72.png').'" />', true);
}
elseif(file_exists(str_replace('//', '/', $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/favicon.ico"))){
	$APPLICATION->AddHeadString('<link rel="shortcut icon" href="'.str_replace('//', '/', SITE_TEMPLATE_PATH.'/favicon.ico').'" type="image/x-icon" />', true);
	$APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="57x57" href="'.str_replace('//', '/', SITE_TEMPLATE_PATH.'/favicon_57.png').'" />', true);
	$APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="72x72" href="'.str_replace('//', '/', SITE_TEMPLATE_PATH.'/favicon_72.png').'" />', true);
}
else{
	$APPLICATION->AddHeadString('<link rel="shortcut icon" href="'.SITE_TEMPLATE_PATH.'/themes/'.$arResult["COLOR"]["CURRENT"].'/images/favicon.ico" type="image/x-icon" />', true);
	$APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="57x57" href="'.SITE_TEMPLATE_PATH.'/themes/'.$arResult["COLOR"]["CURRENT"].'/images/favicon_57.png" />', true);
	$APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="72x72" href="'.SITE_TEMPLATE_PATH.'/themes/'.$arResult["COLOR"]["CURRENT"].'/images/favicon_72.png" />', true);
}

$active = COption::GetOptionString("aspro.allcorp", "THEME_SWITCHER");

/* get width */
aspro::getParam($arResult, "width");
if( $arResult["WIDTH"]["CURRENT"] == "wide" ){ $width_str = "max-width: 1480px;"; }elseif( $arResult["WIDTH"]["CURRENT"] == "middle" ){ $width_str = "max-width: 1280px;"; }elseif( $arResult["WIDTH"]["CURRENT"] == "narrow" ){ $width_str = "max-width: 1140px; padding: 0 15px;"; }else{ $width_str = "max-width: auto;"; }
$APPLICATION->AddHeadString('<style>.maxwidth-theme{ '.$width_str.' }</style>',true);

/* get menu */
aspro::getParam($arResult, "menu");
aspro::getParam($arResult, "sidemenu");

/* get catalog & services on index page */
aspro::getParam($arResult, "catalog_index");
aspro::getParam($arResult, "services_index");

if($active == "Y"){
	$this->IncludeComponentTemplate();
}

$theme = array(
	"COLOR" => $arResult["COLOR"]["CURRENT"],
	"WIDTH" => $arResult["WIDTH"]["CURRENT"],
	"MENU" => $arResult["MENU"]["CURRENT"],
	"SIDEMENU" => $arResult["SIDEMENU"]["CURRENT"],
	"CATALOG_INDEX" => $arResult["CATALOG_INDEX"]["CURRENT"],
	"SERVICES_INDEX" => $arResult["SERVICES_INDEX"]["CURRENT"],
);

return $theme;?>
