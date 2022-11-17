<?
$siteProt = CMain::IsHTTPS() ? 'https' : 'http';
$siteDomain = "://".SITE_SERVER_NAME;
$siteUrl = $siteProt.$siteDomain;
//$APPLICATION->AddHeadString('<link href="https://'.SITE_SERVER_NAME.$arResult["CANONICAL"].'" rel="canonical" />',true);
$APPLICATION->SetPageProperty('canonical', $siteUrl.$arResult["CANONICAL"]);
$APPLICATION->SetPageProperty('real_page_number', $arResult['REAL_PAGE_NUMBER']);
?>