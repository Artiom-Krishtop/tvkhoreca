<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent(
	"aspro:catalog.section.list.max",
	"front_sections_only2",
	array(
		"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"COUNT_ELEMENTS" => "N",
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"TOP_DEPTH" => $arParams["TOP_DEPTH"],
		"SECTION_URL" => "",
		"VIEW_MODE" => $arParams["VIEW_MODE"],
		"SHOW_PARENT_NAME" => "N",
		"HIDE_SECTION_NAME" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"SHOW_SECTIONS_LIST_PREVIEW" => "N",
		"SECTIONS_LIST_PREVIEW_PROPERTY" => "N",
		"SECTIONS_LIST_PREVIEW_DESCRIPTION" => "N",
		"SHOW_SECTION_LIST_PICTURES" => "N",
		"DISPLAY_PANEL" => "N",
		"COMPONENT_TEMPLATE" => "front_sections_only2",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"VIEW_TYPE" => $arParams["VIEW_TYPE"],
		"NO_MARGIN" => $arParams["NO_MARGIN"],
		"SHOW_ICONS" => $arParams["SHOW_ICONS"],
		"FILLED" => $arParams["FILLED"],
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_CATALOG_ICON",
			1 => "",
		),
		"TITLE_BLOCK" => $arParams["TITLE_BLOCK"],
		"TITLE_BLOCK_ALL" => $arParams["TITLE_BLOCK_ALL"],
		"ALL_URL" => $arParams["ALL_URL"]
	),
	false
);?>