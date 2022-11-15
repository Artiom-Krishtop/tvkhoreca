<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости и статьи");
?><?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"main_template", 
	array(
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CATALOG_FILTER_NAME" => "",
		"CATALOG_IBLOCK_ID1" => "",
		"CATALOG_IBLOCK_ID2" => "",
		"CATALOG_IBLOCK_ID3" => "",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "main_template",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_ACTIVE_DATE_FORMAT" => "f j, Y",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_FIELD_CODE" => array(
			0 => "DETAIL_TEXT",
			1 => "DETAIL_PICTURE",
			2 => "DATE_ACTIVE_FROM",
			3 => "",
		),
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_TITLE" => "",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "LINK_GOODS",
			1 => "MORE_PHOTO",
			2 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FILE_404" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"FILTER_PROPERTY_CODE" => array(
			0 => "PHOTOPOS",
			1 => "",
		),
		"GALLERY_PROPERTY" => "MORE_PHOTO",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_CATALOG_TYPE" => "",
		"IBLOCK_ID" => "58",
		"IBLOCK_TYPE" => "aspro_allcorp_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"IS_VERTICAL" => "N",
		"LINKED_PRODUCTS_PROPERTY" => "LINK_GOODS",
		"LIST_ACTIVE_DATE_FORMAT" => "f j, Y",
		"LIST_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DATE_ACTIVE_FROM",
			4 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "LINK_GOODS",
			1 => "",
		),
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "main",
		"PAGER_TITLE" => "",
		"PERIOD_PROPERTY" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PRICE_PROPERTY" => "PRICE",
		"SEF_FOLDER" => "/info/articles/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SHOW_BACK_LINK" => "N",
		"SHOW_FAQ_BLOCK" => "N",
		"SHOW_GALLERY" => "Y",
		"SHOW_LINKED_PRODUCTS" => "Y",
		"SHOW_PERIOD" => "N",
		"SHOW_PRICE" => "N",
		"SHOW_SERVICES_BLOCK" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"USE_CATEGORIES" => "Y",
		"USE_FILTER" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_RATING" => "N",
		"USE_REVIEW" => "N",
		"USE_RSS" => "N",
		"USE_SEARCH" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"CATEGORY_IBLOCK" => array(
			0 => "54",
		),
		"CATEGORY_CODE" => "CATEGORY",
		"CATEGORY_ITEMS_COUNT" => "5",
		"CATEGORY_THEME_58" => "list",
		"CATEGORY_THEME_54" => "photo",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>