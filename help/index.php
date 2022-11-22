<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Помощь");
LocalRedirect("/help/delivery/",false, "301 Moved permanently");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>