<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "новости, выставки");
$APPLICATION->SetPageProperty("keywords_inner", "новости, выставки");
$APPLICATION->SetPageProperty("title", "Новости от компании «ТВК»");
$APPLICATION->SetPageProperty("keywords", "новости, выставки");
$APPLICATION->SetPageProperty("description", "Важные события в мире посуды и хозяйственно бытовых товаров. Выставки, форумы и масса другой полезной информации.");
$APPLICATION->SetTitle("Новости от компании «ТВК»");?><?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"main_template", 
	array(
		"IBLOCK_TYPE" => "aspro_allcorp_content",
		"IBLOCK_ID" => "57",
		"NEWS_COUNT" => "10",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"NUM_NEWS" => "150",
		"NUM_DAYS" => "90",
		"YANDEX" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "DATE_ACTIVE_FROM",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/info/news/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "j F Y",
		"LIST_FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "DATE_ACTIVE_FROM",
			2 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "N",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "j F Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "DATE_ACTIVE_FROM",
			2 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "MORE_PHOTO",
			2 => "",
		),
		"IBLOCK_CATALOG_TYPE" => "aspro_mshop_catalog",
		"CATALOG_IBLOCK_ID1" => "81",
		"CATALOG_IBLOCK_ID2" => "",
		"CATALOG_IBLOCK_ID3" => "",
		"DISPLAY_DATE" => "Y",
		"SHOW_FAQ_BLOCK" => "N",
		"SHOW_BACK_LINK" => "Y",
		"GALLERY_PROPERTY" => "MORE_PHOTO",
		"SHOW_GALLERY" => "Y",
		"LINKED_PRODUCTS_PROPERTY" => "LINK",
		"SHOW_LINKED_PRODUCTS" => "N",
		"PRICE_PROPERTY" => "PRICE",
		"SHOW_PRICE" => "N",
		"PERIOD_PROPERTY" => "PERIOD",
		"SHOW_PERIOD" => "N",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"CATALOG_FILTER_NAME" => "arrProductsFilter",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "main_template",
		"SET_LAST_MODIFIED" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"IS_VERTICAL" => "N",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SHOW_SERVICES_BLOCK" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"STRICT_SECTION_CHECK" => "N",
		"SEF_URL_TEMPLATES" => array(
			"news" => "/info/news/",
			"section" => "#YEAR#/",
			"detail" => "#YEAR#/#ELEMENT_CODE#/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>