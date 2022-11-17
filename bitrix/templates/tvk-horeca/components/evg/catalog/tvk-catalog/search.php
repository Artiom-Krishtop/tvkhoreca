<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
/*if($_REQUEST["producer_id"] > 0 && $_REQUEST["section_id"] > 0) {
	header("Location: ?section_id=".$_REQUEST["section_id"]."&producer_id=0&serie_id=0&material_id=0");

}*/
//echo "<p>Total items ".count($arResult["ITEMS"])."</p>"; // my code

$top_section_code = (strlen($arResult["VARIABLES"]["SECTION_1_CODE"])>0?$arResult["VARIABLES"]["SECTION_1_CODE"]:$arResult["VARIABLES"]["SECTION_CODE"]);

global $search_page;
$search_page = true;
?>
<? //echo "<p>running script: ".$_SERVER["PHP_SELF"].". components/evg/catalog/tvk-catalog/search.php</p>";
//echo "<h3>".$APPLICATION->GetCurPageParam()."</h3>";  //my code
?>
<?
//echo '<pre>'.print_r($_REQUEST, true).'</pre>';

	$arVariables["section_id"] = $_REQUEST["section_id"];
//$arVariables["producer_id"] = intval($_REQUEST["producerID"])>0?$_REQUEST["producerID"]:$_REQUEST["producer_id"];

if(intval($_REQUEST["producerID"]) > 0)
	$arVariables["producer_id"] = $_REQUEST["producerID"];
else
	$arVariables["producer_id"] = $_REQUEST["producer_id"];

$arVariables["serie_id"] = $_REQUEST["serie_id"];
	$arVariables["material_id"] = $_REQUEST["material_id"];
	
	global $arrFilter;

	if(intval($arVariables["section_id"])>0){
		$arrFilter["SECTION_ID"] = intval($arVariables["section_id"]);
		$arResult["VARIABLES"]["SECTION_ID"] = intval($arVariables["section_id"]);
	} else {
		//$arrFilter["SECTION_ID"] = 0;
		$arrFilter["INCLUDE_SUBSECTIONS"] = "Y";
	}
	
	if($_REQUEST['tp'] == 'Y'){
		$arVariables["producer_id"] = 0;
		$arVariables["material_id"] = '';
		$arVariables["serie_id"] = '';
	}	

/*foreach($arResult["VARIABLES"] as $ar)
echo print_r($ar);*/

	if(intval($arVariables["producer_id"])>0){
		$arrFilter["PROPERTY_producer"] = intval($arVariables["producer_id"]);
	}

	if(strlen($arVariables["serie_id"])>0 && $arVariables["serie_id"]!='0'){
		$arrFilter["PROPERTY_series"] = $arVariables["serie_id"];
	}

	if(strlen($arVariables["material_id"])>0 && $arVariables["material_id"]!='0'){
		$arrFilter["PROPERTY_material"] = $arVariables["material_id"];
	}
?>

<?$APPLICATION->IncludeComponent(
	"evg:catalog.section",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
 		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
		"INCLUDE_SUBSECTIONS" => "Y",
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"FILTER_NAME" => "arrFilter",
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"CACHE_TYPE" => "N",//$arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
		"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],

		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
		"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["VARIABLES"]["SECTION_1_CODE"].'/'.$arResult["VARIABLES"]["SECTION_CODE"].'/#ELEMENT_ID#/',
	),
	$component
); 
?>

