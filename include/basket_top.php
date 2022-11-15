<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line",
	"normal",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_BASKET" => SITE_DIR."basket/",
		"PATH_TO_ORDER" => SITE_DIR."order/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"SHOW_DELAY" => "N",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_IMAGE" => "Y",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRICE" => "Y",
		"SHOW_PRODUCTS" => "Y",
		"SHOW_SUBSCRIBE" => "N",
		"SHOW_SUMMARY" => "Y",
		"SHOW_TOTAL_PRICE" => "Y"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>