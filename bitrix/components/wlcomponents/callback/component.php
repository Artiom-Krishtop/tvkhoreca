<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	$arParams["LABELEDSLIDER_ON"] = empty($arParams["LABELEDSLIDER_ON"]) ? "Y" : $arParams["LABELEDSLIDER_ON"];
	$arParams["MASKEDINPUT_ON"] = empty($arParams["MASKEDINPUT_ON"]) ? "Y" : $arParams["MASKEDINPUT_ON"];
	
	if ($arParams["JQUERY_ON"] == "Y")
		$APPLICATION->AddHeadScript('/bitrix/components/wlcomponents/callback/additional/js/jquery-1.9.1.js');
	if ($arParams["JQUERYUI_ON"] == "Y")
		$APPLICATION->AddHeadScript('/bitrix/components/wlcomponents/callback/additional/js/jquery-ui-1.10.3.custom.js');
	if ($arParams["BOOTSTRAP_ON"] == "Y")
	{
		$APPLICATION->SetAdditionalCSS('/bitrix/components/wlcomponents/callback/additional/css/bootstrap.css');
		$APPLICATION->AddHeadScript('/bitrix/components/wlcomponents/callback/additional/js/bootstrap.js');
	}
	if ($arParams["LABELEDSLIDER_ON"] == "Y")
	{
		$APPLICATION->AddHeadScript('/bitrix/components/wlcomponents/callback/additional/js/labeledslider.js');
		$APPLICATION->SetAdditionalCSS('/bitrix/components/wlcomponents/callback/additional/css/labeledslider.css');
	}
	if ($arParams["MASKEDINPUT_ON"] == "Y")
		$APPLICATION->AddHeadScript('/bitrix/components/wlcomponents/callback/additional/js/jquery.maskedinput.js');
	
	
	$this->IncludeComponentTemplate();
?>