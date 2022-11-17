<?
$siteProt = CMain::IsHTTPS() ? 'https' : 'http';
$siteDomain = "://".SITE_SERVER_NAME;
$siteUrl = $siteProt.$siteDomain;
$APPLICATION->SetPageProperty('canonical', $siteUrl.$arResult["CANONICAL"]);
?>