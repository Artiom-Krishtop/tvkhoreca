<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arItems = aspro::cacheElement(false, array( "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"], "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => "N" ), false, false, array("ID"));

$arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y");
if($arResult["VARIABLES"]["SECTION_ID"]) $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
elseif($arResult["VARIABLES"]["SECTION_CODE"]) $arFilter["CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

$arSections = aspro::cacheSection(false, $arFilter, false, array("ID", "NAME"),true);
$arSubSections = aspro::cacheSection(false, array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"]), false, array("ID"), true);
?>

<?$sectionID=$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"catalog-sections",
	Array(
		"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
		"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"COUNT_IN_LINE" => $arParams["COUNT_IN_LINE"],
		"COUNT_LIST_LINE" => $arParams["COUNT_LIST_LINE"],
		"VIEW_TYPE" => $arParams["VIEW_TYPE"],
		"SHOW_TABS" => $arParams["SHOW_TABS"],
		"SHOW_NAME" => $arParams["SHOW_NAME"],
		"SHOW_DETAIL" => $arParams["SHOW_DETAIL"],
		"SHOW_IMAGE" => $arParams["SHOW_IMAGE"],
		"IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
		"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
		"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
		"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
		"SORT_BY1"	=>	$arParams["SORT_BY1"],
		"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
		"SORT_BY2"	=>	$arParams["SORT_BY2"],
		"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
		"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
		"SET_TITLE"	=>	"Y",
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
		"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
		"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
		"DISPLAY_NAME"	=>	"Y",
		"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
	),
	$component
);?>
<?
if($arItems){
	include_once("include_sort.php");
}
$display_template=$display?'catalog-'.$display:'catalog';
?>
<?
/*???????????????? ?? ???????????????????? ???????????????????? ???????????????????? ???????????? ??????????, ?????????? ???????????????????????? ???????????? ??.??.
?????????? ?????????? ???????????????????? ?????????????? ???? ????????????????*/

$target_url = $_SERVER["REQUEST_URI"];
$target_url = explode("/", $target_url);
$count = count($target_url);
global $sub;

if ($count == 6) {
    $sub = "Y";
} else $sub = "N";
?>

<?//var_dump($display_template);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	$display_template,
	Array(
		"DISPLAY" => $display,
		"COUNT_IN_LINE" => $arParams["COUNT_IN_LINE"],
		"COUNT_LIST_LINE" => $arParams["COUNT_LIST_LINE"],
		"VIEW_TYPE" => $arParams["VIEW_TYPE"],
		"SHOW_TABS" => $arParams["SHOW_TABS"],
		"SHOW_NAME" => $arParams["SHOW_NAME"],
		"SHOW_DETAIL" => $arParams["SHOW_DETAIL"],
		"SHOW_IMAGE" => $arParams["SHOW_IMAGE"],
		"IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
		"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
		"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
		"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
        "SORT_BY1" => "HAS_PREVIEW_PICTURE",
        "SORT_ORDER1" => "DESC",
		//"SORT_BY1"	=>	$arAvailableSort[$sort][0],
		//"SORT_ORDER1"	=>	strtoupper($order),
		//"SORT_BY2"	=>	$arParams["SORT_BY2"],
		//"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
		"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
		"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
		"SET_TITLE"	=>	$arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN"	=>	$arParams["ADD_SECTIONS_CHAIN"],
		"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
		"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
		"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
		"DISPLAY_NAME"	=>	"Y",
		"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
		"INCLUDE_SUBSECTIONS" => "$sub",

        /*_______________???????????????????? _____________________*/

		"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
		"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
	),
	$component
);?>
<?

if( !$arItems && !$arSubSections){?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
<?}?>
<?
if( strlen($APPLICATION->GetPageProperty('title') ) > 1){
	$title = $APPLICATION->GetPageProperty('title');
} else {
	$title = $arSections["NAME"];
}
$APPLICATION->SetPageProperty("title", $title );
$APPLICATION->SetTitle( $title );
?>