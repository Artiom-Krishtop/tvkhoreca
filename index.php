<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Посуда и инвентарь для ресторанов, кафе, баров. Оптовая продажа и поставка посуды, хозяйственно-бытовых товаров, оборудования, кондитерского инвентаря и столовых предметов");
$APPLICATION->SetPageProperty("title", "Посуда для ресторанов, кафе, баров. Купить профессиональную посуду и инвентарь оптом. Низкие цены, доставка по РБ");
$APPLICATION->SetTitle("Посуда для ресторанов и кафе");
?><?global $SITE_THEME, $TEMPLATE_OPTIONS;?>
<div class="grey_bg">
    <?$APPLICATION->IncludeComponent(
        "aspro:com.banners.mshop",
        "top_slider_banners",
        array(
            "BANNER_TYPE_THEME" => "TOP",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "Y",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO",
            "IBLOCK_ID" => "70",
            "IBLOCK_TYPE" => "aspro_mshop_adv",
            "NEWS_COUNT" => "10",
            "PROPERTY_CODE" => array(
                0 => "TEXT_POSITION",
                1 => "TARGETS",
                2 => "TEXTCOLOR",
                3 => "URL_STRING",
                4 => "BUTTON1TEXT",
                5 => "BUTTON1LINK",
                6 => "BUTTON2TEXT",
                7 => "BUTTON2LINK",
                8 => "",
            ),
            "SET_BANNER_TYPE_FROM_THEME" => "N",
            "SITE_THEME" => $SITE_THEME,
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "ID",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "DESC",
            "TYPE_BANNERS_IBLOCK_ID" => "69",
            "COMPONENT_TEMPLATE" => "top_slider_banners"
        ),
        false
    );?>

<!--	 --><?//$APPLICATION->IncludeComponent(
//	"aspro:com.banners.mshop",
//	"top_slider_banners",
//	Array(
//		"BANNER_TYPE_THEME" => "TOP",
//		"CACHE_TIME" => "36000000",
//		"CACHE_TYPE" => "A",
//		"CHECK_DATES" => "Y",
//		"COMPONENT_TEMPLATE" => "top_slider_banners",
//		"COMPOSITE_FRAME_MODE" => "A",
//		"COMPOSITE_FRAME_TYPE" => "AUTO",
//		"HIDE_ACTIONS" => "Y",
//		"IBLOCK_ID" => "70",
//		"IBLOCK_TYPE" => "aspro_mshop_adv",
//		"NEWS_COUNT" => "10",
//		"PROPERTY_CODE" => array(0=>"TEXT_POSITION",1=>"TARGETS",2=>"TEXTCOLOR",3=>"URL_STRING",4=>"BUTTON1TEXT",5=>"BUTTON1LINK",6=>"BUTTON2TEXT",7=>"BUTTON2LINK",8=>"",),
//		"SET_BANNER_TYPE_FROM_THEME" => "N",
//		"SITE_THEME" => $SITE_THEME,
//		"SORT_BY1" => "SORT",
//		"SORT_BY2" => "ID",
//		"SORT_ORDER1" => "ASC",
//		"SORT_ORDER2" => "DESC",
//		"TYPE_BANNERS_IBLOCK_ID" => "69"
//	)
//);?>
</div>
<div class="wrapper_inner">
<?$APPLICATION->IncludeComponent("bitrix:news.list", "mshop", array(
	"ACTIVE_DATE_FORMAT" => "j F Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "PREVIEW_PICTURE",
			2 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "45",
		"IBLOCK_TYPE" => "aspro_allcorp_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "LINK",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "mshop"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>
</div>
<div class="grey_bg">
	<div class="wrapper_inner">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.top", 
	"new_items_main_slider", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "new_items_main_slider",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:54:588\",\"DATA\":{\"logic\":\"Equal\",\"value\":19554}}]}",
		"DETAIL_URL" => "",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_WISH_BUTTONS" => "N",
		"ELEMENT_COUNT" => "24",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrTopFilter",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"IBLOCK_ID" => "54",
		"IBLOCK_TYPE" => "aspro_allcorp_catalog",
		"INIT_SLIDER" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"OFFERS_LIMIT" => "5",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "Отпускная цена с НДС №2",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SECTION_URL" => "",
		"SEF_MODE" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_MEASURE" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"SPECIALS_CODE1" => "STOCK",
		"SPECIALS_CODE2" => "HIT",
		"SPECIALS_CODE3" => "RECOMMEND",
		"SPECIALS_CODE4" => "NEW",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	),
	false
);?>
	</div>
</div>
<div class="wrapper_inner">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"mshop",
	Array(
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "mshop",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "71",
		"IBLOCK_TYPE" => "aspro_mshop_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"ICON",2=>"",),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?>
</div>
<div class="title_inner_banners">
	<div class="h2">
		 Популярные категории
	</div>
</div>
<div class="wrapper_inner wides">
	 <?$APPLICATION->IncludeComponent(
	"aspro:com.banners.mshop",
	"mshop",
	Array(
		"BANNER_TYPE_THEME" => "FLOAT",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CATALOG" => "/catalog/",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "mshop",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"IBLOCK_ID" => "70",
		"IBLOCK_TYPE" => "aspro_mshop_adv",
		"NEWS_COUNT" => "8",
		"PROPERTY_CODE" => array(0=>"TEXT_POSITION",1=>"TARGETS",2=>"TEXTCOLOR",3=>"URL_STRING",4=>"BUTTON1TEXT",5=>"BUTTON1LINK",6=>"BUTTON2TEXT",7=>"BUTTON2LINK",8=>"",),
		"SET_BANNER_TYPE_FROM_THEME" => "N",
		"SITE_THEME" => $SITE_THEME,
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"TYPE_BANNERS_IBLOCK_ID" => "69"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?>
</div>
<div class="grey_bg">
	<div class="wrapper_inner">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"news_akc_slider_actions", 
	array(
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALL_URL" => "info/stock/",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "news_akc_slider_actions",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "56",
		"IBLOCK_TYPE" => "aspro_allcorp_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "140",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"TITLE_BLOCK" => "Акции"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
	</div>
</div>
<div class="wrapper_inner">
	<div class="wrap_md">
		 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"news_akc_slider", 
	array(
		"ACTIVE_DATE_FORMAT" => "SHORT",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALL_URL" => "../info/articles/",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "news_akc_slider",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "58",
		"IBLOCK_TYPE" => "aspro_allcorp_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "8",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "140",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"TITLE_BLOCK" => "Новости и статьи"
	),
	false
);?>
	</div>
</div>
<hr class="grey">
<div class="grey_bg">
	<div class="wrapper_inner">
		<div class="wrap_md">
			<div class="md-50 img">
				 <?$APPLICATION->IncludeFile(SITE_DIR."include/front_img.php", Array(), Array( "MODE" => "html", "NAME" => GetMessage("FRONT_IMG"), )); ?>
			</div>
			<div class="md-50 big">
				<h1><?$APPLICATION->ShowTitle(false);?></h1>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"front",
	Array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_DIR."include/front_info.php"
	)
);?>
			</div>
		</div>
	</div>
</div>
<div class="wrapper_inner">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"brands_slider",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "brands_slider",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"PREVIEW_PICTURE",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "48",
		"IBLOCK_TYPE" => "aspro_allcorp_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "9999",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	)
);?>
</div>
<div class="grey_bg">
	<div class="wrapper_inner">
		 <?$APPLICATION->IncludeComponent(
	"aspro:tabs.mshop",
	"main",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BASKET_URL" => "/basket/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "250000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "main",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISCOUNT_PRICE_CODE" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_WISH_BUTTONS" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "arrFilterProp",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "81",
		"IBLOCK_TYPE" => "aspro_mshop_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "5",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => "",
		"OFFERS_FIELD_CODE" => array(0=>"ID",1=>"",),
		"OFFERS_LIMIT" => "10",
		"OFFERS_PROPERTY_CODE" => array(0=>"",1=>"",),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "20",
		"PRICE_CODE" => array(0=>"BASE",),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => "",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_NAME_FILTER" => "",
		"SECTION_SLIDER_FILTER" => "21",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_ADD_FAVORITES" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_MEASURE" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TABS_CODE" => "HIT",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?>
	</div>
</div>
<?if($TEMPLATE_OPTIONS["STORES"]["CURRENT_VALUE"] != 'NO'):?>
	<?if($TEMPLATE_OPTIONS["STORES_SOURCE"]["CURRENT_VALUE"] != 'IBLOCK'):?>
		<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.store.list",
	"mshop",
	Array(
		"ALL_URL" => "contacts/stores/",
		"CACHE_TIME" => "86400",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "mshop",
		"MAP_TYPE" => "1",
		"PATH_TO_ELEMENT" => "contacts/stores/#store_id#/",
		"PHONE" => "Y",
		"SCHEDULE" => "Y",
		"SEF_MODE" => "N",
		"SET_TITLE" => "N",
		"SITE_THEME" => $SITE_THEME,
		"TITLE" => "",
		"TITLE_BLOCK" => "Наши магазины",
		"TYPE" => "LIGHT"
	)
);?>
	<?else:?>
		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"shops_front",
	Array(
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "shops_front",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0=>"NAME",1=>"",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "72",
		"IBLOCK_TYPE" => "aspro_mshop_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "100",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "140",
		"PROPERTY_CODE" => array(0=>"ADDRESS",1=>"PHONE",2=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"TITLE_BLOCK" => "Наши магазины"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'N'
)
);?>
	<?endif;?>
<?endif;?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>