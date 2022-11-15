<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("hide_title_inner", "Каталог посуды, инвентаря и оборудования для HoReCa");
$APPLICATION->SetPageProperty("description", "Каталог профессиональных товаров для ресторанов, кафе, баров. Оптовая продажа и поставка посуды, хозяйственно-бытовых товаров, оборудования, кондитерского инвентаря и столовых предметов");
$APPLICATION->SetPageProperty("title", "Посуда и инвентарь для общепита");
$APPLICATION->SetTitle("Каталог посуды для общепита");
global $USERPRICES;
$USERPRICES = userPricesList();
?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"main", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_FILTER_CATALOG" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALSO_BUY_ELEMENT_COUNT" => "5",
		"ALSO_BUY_MIN_BUYES" => "2",
		"ASK_FORM_ID" => "4",
		"BASKET_URL" => "/basket/",
		"BIG_DATA_RCM_TYPE" => "similar",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "250000",
		"CACHE_TYPE" => "A",
		"COMPARE_ELEMENT_SORT_FIELD" => "shows",
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",
		"COMPARE_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "",
		),
		"COMPARE_OFFERS_PROPERTY_CODE" => array(
			0 => "ARTICLE",
			1 => "SIZES",
			2 => "COLOR_REF",
			3 => "",
		),
		"COMPARE_PROPERTY_CODE" => array(
			0 => "",
			1 => "PROP_2033",
			2 => "COLOR_REF2",
			3 => "PROP_159",
			4 => "PROP_2052",
			5 => "PROP_2027",
			6 => "PROP_2053",
			7 => "PROP_2083",
			8 => "PROP_2049",
			9 => "PROP_2026",
			10 => "PROP_2044",
			11 => "PROP_162",
			12 => "PROP_2065",
			13 => "PROP_2054",
			14 => "PROP_2017",
			15 => "PROP_2055",
			16 => "PROP_2069",
			17 => "PROP_2062",
			18 => "PROP_2061",
			19 => "",
		),
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "main",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => "BYN",
		"DEFAULT_COUNT" => "1",
		"DEFAULT_LIST_TEMPLATE" => "block",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_PAGE_URL",
			3 => "",
		),
		"DETAIL_OFFERS_LIMIT" => "0",
		"DETAIL_OFFERS_PROPERTY_CODE" => array(
			0 => "ARTICLE",
			1 => "SIZES",
			2 => "COLOR_REF",
			3 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "KOD",
			1 => "BRAND",
			2 => "CML2_ARTICLE",
			3 => "TORGOVAYA_MARKA",
			4 => "APPOINTMENT",
			5 => "MATERIAL_1",
			6 => "VOLUME",
			7 => "DIAMETER",
			8 => "LENGTH",
			9 => "LENGTH_BLADE",
			10 => "WIDTH",
			11 => "HEIGHT",
			12 => "THICKNESS",
			13 => "INDUKCIJA",
			14 => "POWER",
			15 => "VOLTAGE",
			16 => "TSVET",
			17 => "COUNTRY",
			18 => "ARTICLE",
			19 => "SERIES",
			20 => "MATERIAL",
			21 => "COLOR",
			22 => "VIDEO_YOUTUBE",
			23 => "PROP_2033",
			24 => "COLOR_REF2",
			25 => "PROP_159",
			26 => "PROP_2052",
			27 => "PROP_2027",
			28 => "PROP_2053",
			29 => "PROP_2083",
			30 => "PROP_2049",
			31 => "PROP_2026",
			32 => "PROP_2044",
			33 => "PROP_162",
			34 => "PROP_2065",
			35 => "PROP_2054",
			36 => "PROP_2017",
			37 => "PROP_2055",
			38 => "PROP_2069",
			39 => "PROP_2062",
			40 => "PROP_2061",
			41 => "RECOMMEND",
			42 => "NEW",
			43 => "STOCK",
			44 => "VIDEO",
			45 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"DETAIL_STRICT_SECTION_CHECK" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_ELEMENT_SELECT_BOX" => "N",
		"DISPLAY_ELEMENT_SLIDER" => "3",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_WISH_BUTTONS" => "N",
		"ELEMENT_SORT_FIELD" => "DATE_CREATE",
		"ELEMENT_SORT_FIELD2" => "name",
		"ELEMENT_SORT_FIELD_BOX" => "name",
		"ELEMENT_SORT_FIELD_BOX2" => "id",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"ELEMENT_SORT_ORDER_BOX" => "asc",
		"ELEMENT_SORT_ORDER_BOX2" => "desc",
		"FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FILE_404" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "ID",
			1 => "NAME",
			2 => "",
		),
		"FILTER_NAME" => "MSHOP_SMART_FILTER",
		"FILTER_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "",
		),
		"FILTER_OFFERS_PROPERTY_CODE" => array(
			0 => "ARTICLE",
			1 => "SIZES",
			2 => "COLOR_REF",
			3 => "COLOR",
			4 => "CML2_LINK",
			5 => "",
		),
		"FILTER_PRICE_CODE" => array(
			0 => "Отпускная цена с НДС №2",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"FORUM_ID" => "1",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"IBLOCK_BANNERS_ID" => "70",
		"IBLOCK_BANNERS_TYPE" => "aspro_mshop_adv",
		"IBLOCK_BANNERS_TYPE_ID" => "69",
		"IBLOCK_ID" => "54",
		"IBLOCK_SMALL_BANNERS_TYPE_ID" => "36",
		"IBLOCK_STOCK_ID" => "79",
		"IBLOCK_TYPE" => "aspro_allcorp_catalog",
		"INCLUDE_SUBSECTIONS" => "A",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_DISPLAY_POPUP_IMAGE" => "Y",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_META_KEYWORDS" => "-",
		"LIST_OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "CML2_LINK",
			2 => "DETAIL_PAGE_URL",
			3 => "",
		),
		"LIST_OFFERS_LIMIT" => "10",
		"LIST_OFFERS_PROPERTY_CODE" => array(
			0 => "SIZES",
			1 => "COLOR_REF",
			2 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "KOD",
			1 => "BRAND",
			2 => "CML2_ARTICLE",
			3 => "TORGOVAYA_MARKA",
			4 => "SERIYA",
			5 => "STATUS",
			6 => "PROP_2033",
			7 => "COLOR_REF2",
			8 => "PROP_159",
			9 => "PROP_2052",
			10 => "PROP_2027",
			11 => "PROP_2053",
			12 => "PROP_2083",
			13 => "PROP_2049",
			14 => "PROP_2026",
			15 => "PROP_2044",
			16 => "PROP_162",
			17 => "PROP_2065",
			18 => "PROP_2054",
			19 => "PROP_2017",
			20 => "PROP_2055",
			21 => "PROP_2069",
			22 => "PROP_2062",
			23 => "PROP_2061",
			24 => "CML2_LINK",
			25 => "",
		),
		"MAIN_TITLE" => "Наличие на складах",
		"MAX_AMOUNT" => COption::GetOptionString("aspro.mshop","MAX_AMOUNT","10",SITE_ID),
		"MESSAGES_PER_PAGE" => "10",
		"MESSAGE_404" => "",
		"MIN_AMOUNT" => COption::GetOptionString("aspro.mshop","MIN_AMOUNT","2",SITE_ID),
		"OFFERS_CART_PROPERTIES" => array(
			0 => "SIZES",
			1 => "COLOR_REF",
		),
		"OFFERS_SORT_FIELD" => "shows",
		"OFFERS_SORT_FIELD2" => "shows",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "asc",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_TREE_PROPS" => array(
			0 => "SIZES",
			1 => "COLOR_REF",
		),
		"PAGER_BASE_LINK" => "",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_PARAMS_NAME" => "arrPager",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "main",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"POST_FIRST_MESSAGE" => "N",
		"PRICE_CODE" => array(
			0 => "Отпускная цена с НДС №2",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
			0 => "TORGOVAYA_MARKA,SERIYA",
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTIES_DISPLAY_LOCATION" => "DESCRIPTION",
		"PROPERTIES_DISPLAY_TYPE" => "BLOCK",
		"REVIEW_AJAX_POST" => "Y",
		"SECTIONS_LIST_PREVIEW_PROPERTY" => "UF_SECTION_SEO_DESCR",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"SECTION_COUNT_ELEMENTS" => "N",
		"SECTION_DISPLAY_PROPERTY" => "UF_VIEWTYPE",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_PREVIEW_PROPERTY" => "UF_SECTION_SEO_DESCR",
		"SECTION_TOP_BLOCK_TITLE" => "Лучшие предложения",
		"SECTION_TOP_DEPTH" => "2",
		"SEF_FOLDER" => "/catalog/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SHOW_ADDITIONAL_TAB" => "N",
		"SHOW_ASK_BLOCK" => "N",
		"SHOW_BRAND_PICTURE" => "Y",
		"SHOW_DEACTIVATED" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GENERAL_STORE_INFORMATION" => "N",
		"SHOW_HINTS" => "Y",
		"SHOW_KIT_PARTS" => "Y",
		"SHOW_KIT_PARTS_PRICES" => "Y",
		"SHOW_LINK_TO_FORUM" => "Y",
		"SHOW_MEASURE" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_ONE_CLICK_BUY" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_QUANTITY" => "Y",
		"SHOW_QUANTITY_COUNT" => "Y",
		"SHOW_SECTION_LIST_PICTURES" => "Y",
		"SHOW_SECTION_PICTURES" => "Y",
		"SHOW_SECTION_SIBLINGS" => "Y",
		"SHOW_SKU_DESCRIPTION" => "N",
		"SHOW_TOP_ELEMENTS" => "Y",
		"SKU_DETAIL_ID" => "oid",
		"SORT_BUTTONS" => array(
			0 => "NAME",
			1 => "PRICE",
		),
		"SORT_PRICES" => "Отпускная цена с НДС №2",
		"STORES" => "",
		"STORE_PATH" => "/contacts/stores/#store_id#/",
		"TOP_ELEMENT_COUNT" => "12",
		"TOP_ELEMENT_SORT_FIELD" => "shows",
		"TOP_ELEMENT_SORT_FIELD2" => "name",
		"TOP_ELEMENT_SORT_ORDER" => "desc",
		"TOP_ELEMENT_SORT_ORDER2" => "asc",
		"TOP_LINE_ELEMENT_COUNT" => "4",
		"TOP_OFFERS_FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"TOP_OFFERS_LIMIT" => "10",
		"TOP_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_PROPERTY_CODE" => array(
			0 => "TORGOVAYA_MARKA",
			1 => "SERIYA",
			2 => "",
		),
		"URL_TEMPLATES_READ" => "",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"USE_ALSO_BUY" => "N",
		"USE_BIG_DATA" => "N",
		"USE_CAPTCHA" => "Y",
		"USE_COMPARE" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "Y",
		"USE_GIFTS_DETAIL" => "N",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "N",
		"USE_GIFTS_SECTION" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"USE_MIN_AMOUNT" => "N",
		"USE_ONLY_MAX_AMOUNT" => "Y",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_STORE" => "N",
		"USE_STORE_PHONE" => "Y",
		"USE_STORE_SCHEDULE" => "Y",
		"VIEWED_BLOCK_TITLE" => "Ранее вы смотрели",
		"VIEWED_ELEMENT_COUNT" => "10",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"element" => "#SECTION_CODE_PATH#/#ELEMENT_ID#/",
			"compare" => "compare.php?action=#ACTION_CODE#",
			"smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>