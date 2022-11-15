<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.cancel",
	"cancel",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ID" => $ID,
		"PATH_TO_DETAIL" => "/personal/history-of-orders/order_detail.php",
		"PATH_TO_LIST" => "/personal/history-of-orders/",
		"SET_TITLE" => "Y"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>