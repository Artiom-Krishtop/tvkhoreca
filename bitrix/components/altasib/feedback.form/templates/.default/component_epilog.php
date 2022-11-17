<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$ALX = "FID".$arParams["FORM_ID"];

if($arParams['JQUERY_EN'] != 'N') {
	if (strlen($arParams['JQUERY_EN'])==1) $arParams['JQUERY_EN'] = 'jquery3';
	CJSCore::Init(array($arParams['JQUERY_EN']));
}

if(is_array($arParams["PROPERTY_FIELDS"]) && !empty($arParams["MASKED_INPUT_PHONE"]) && is_array($arParams["MASKED_INPUT_PHONE"]))
{
	$APPLICATION->AddHeadScript('/bitrix/js/altasib.feedback/jquery.maskedinput/jquery.maskedinput.min.js');
}

if($arParams["USE_CAPTCHA"] == "Y" && $arParams["CAPTCHA_TYPE"] == "recaptcha" && $arParams['ALX_LINK_POPUP']!='Y')
{
	$APPLICATION->AddHeadScript('https://www.google.com/recaptcha/api.js?onload=AltasibFeedbackOnload_'.$ALX.'&render=explicit&hl='.LANGUAGE_ID);
}

if(!empty($arParams['COLOR_OTHER']) || !empty($arParams['COLOR_THEME']))
{
	$this->Generate($arParams['COLOR_OTHER'], $arParams['COLOR_THEME'], $arParams['COLOR_SCHEME'], $ALX, $this->__template->__folder, GetMessage("AFBF_STYLE_GENERATE"));
}

?>