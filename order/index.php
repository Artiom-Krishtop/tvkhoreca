<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление предварительного заказа");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	"new", 
	array(
		"PAY_FROM_ACCOUNT" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"COUNT_DELIVERY_TAX" => "Y",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"ALLOW_AUTO_REGISTER" => "N",
		"SEND_NEW_USER_NOTIFY" => "N",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "Y",
		"TEMPLATE_LOCATION" => "popup",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"USE_PREPAYMENT" => "N",
		"PROP_1" => "",
		"PROP_3" => "",
		"PROP_2" => "",
		"PROP_4" => "",
		"SHOW_STORES_IMAGES" => "N",
		"PATH_TO_BASKET" => SITE_DIR."basket/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/history-of-orders/",
		"PATH_TO_PAYMENT" => SITE_DIR."order/payment/",
		"PATH_TO_AUTH" => SITE_DIR."auth/",
		"SET_TITLE" => "Y",
		"PRODUCT_COLUMNS" => "",
		"DISABLE_BASKET_REDIRECT" => "N",
		"DISPLAY_IMG_WIDTH" => "90",
		"DISPLAY_IMG_HEIGHT" => "90",
		"COMPONENT_TEMPLATE" => "new",
		"ALLOW_NEW_PROFILE" => "N",
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"COMPATIBLE_MODE" => "Y",
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "PROPS",
			2 => "DISCOUNT_PRICE_PERCENT_FORMATED",
			3 => "PRICE_FORMATED",
			4 => "PROPERTY_CML2_ARTICLE",
		),
		"ADDITIONAL_PICT_PROP_54" => "-",
		"ADDITIONAL_PICT_PROP_67" => "-",
		"ADDITIONAL_PICT_PROP_81" => "-",
		"ADDITIONAL_PICT_PROP_82" => "-",
		"BASKET_IMAGES_SCALING" => "standard",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"MIN_DELIVERY_PRICE" => "60",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"USE_PRELOAD" => "Y"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>