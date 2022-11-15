<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY'])){
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
		$loadCurrency = Loader::includeModule('currency');
	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
	if ($loadCurrency){?>
	<script type="text/javascript">
		BX.Currency.setCurrencies(<? echo $templateData['CURRENCIES']; ?>);
	</script>
	<?}
}?>
<?
$siteProt = CMain::IsHTTPS() ? 'https' : 'http';
$siteDomain = "://".SITE_SERVER_NAME;
$siteUrl = $siteProt.$siteDomain;
//$APPLICATION->AddHeadString('<link href="https://'.SITE_SERVER_NAME.$arResult["CANONICAL"].'" rel="canonical" />',true);
$APPLICATION->SetPageProperty('canonical', $siteUrl.$arResult["CANONICAL"]);
$APPLICATION->SetPageProperty('real_page_number', $arResult['REAL_PAGE_NUMBER']);
?>