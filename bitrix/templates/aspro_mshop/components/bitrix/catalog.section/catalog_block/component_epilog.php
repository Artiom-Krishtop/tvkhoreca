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
$arResult["DOMAIN_URL"] = $siteUrl;
//$APPLICATION->AddHeadString('<link href="https://'.SITE_SERVER_NAME.$arResult["CANONICAL"].'" rel="canonical" />',true);
$APPLICATION->SetPageProperty('canonical', $siteUrl.$arResult["CANONICAL"]);
$APPLICATION->SetPageProperty('real_page_number', $arResult['REAL_PAGE_NUMBER']);
if((int)$arResult["NAV_RESULT"]->NavPageCount > 1){
	if((int)$arResult["NAV_RESULT"]->NavPageNomer == 1){
		$bPrevDisabled = true;
	}elseif((int)$arResult["NAV_RESULT"]->NavPageNomer < (int)$arResult["NAV_RESULT"]->NavPageCount){
		$bPrevDisabled = false;
	}
	if((int)$arResult["NAV_RESULT"]->NavPageNomer == (int)$arResult["NAV_RESULT"]->NavPageCount){
		$bNextDisabled = true;
	}else{
		$bNextDisabled = false;
	}
	if(!$bPrevDisabled){
		$bHasPage = (isset($_GET['PAGEN_'.$arResult["NAV_RESULT"]->NavNum]) && $_GET['PAGEN_'.$arResult["NAV_RESULT"]->NavNum]);
		$page = ( $bHasPage ? ((int)$arResult["NAV_RESULT"]->NavPageNomer-1 == 1 ? '' : (int)$arResult["NAV_RESULT"]->NavPageNomer-1) : '' );
		$url = ($page ? '?'.$strNavQueryString.'PAGEN_'.$arResult["NAV_RESULT"]->NavNum.'='.$page : '');
		$urlMeta = ($page ? '?'.'PAGEN_'.$arResult["NAV_RESULT"]->NavNum.'='.$page : '');
		$APPLICATION->AddHeadString('<link rel="prev" href="'.$arResult["DOMAIN_URL"].$arResult['SECTION_PAGE_URL'].$urlMeta.'"  />', true);
	}
	if(!$bNextDisabled){
		$APPLICATION->AddHeadString('<link rel="next" href="'.$arResult["DOMAIN_URL"].$arResult['SECTION_PAGE_URL'].'?'.'PAGEN_'.$arResult["NAV_RESULT"]->NavNum.'='.((int)$arResult["NAV_RESULT"]->NavPageNomer+1).'"  />', true);
	}
}
?>