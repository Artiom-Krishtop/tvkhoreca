<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if(isset($arResult['ELEMENT_H1']) && !empty($arResult['ELEMENT_H1']))
{
	//$APPLICATION->SetPageProperty("title", $arResult['ELEMENT_H1']);
	$APPLICATION->SetTitle($arResult['ELEMENT_H1']);
	$this->SetViewTarget("sotbit_seometa_h1");
	echo $arResult['ELEMENT_H1'];
	$this->EndViewTarget();
}
if(isset($arResult['ELEMENT_TOP_DESC']) && !empty($arResult['ELEMENT_TOP_DESC']))
{
	$APPLICATION->SetPageProperty("sotbit_seometa_top_desc", $arResult['ELEMENT_TOP_DESC']);
	$this->SetViewTarget("sotbit_seometa_top_desc");
	echo $arResult['ELEMENT_TOP_DESC'];
	$this->EndViewTarget();
}
if(isset($arResult['ELEMENT_BOTTOM_DESC']) && !empty($arResult['ELEMENT_BOTTOM_DESC']))
{
	$APPLICATION->SetPageProperty("sotbit_seometa_bottom_desc", $arResult['ELEMENT_BOTTOM_DESC']);
	$this->SetViewTarget("sotbit_seometa_bottom_desc");
	echo $arResult['ELEMENT_BOTTOM_DESC'];
	$this->EndViewTarget();
}
if(isset($arResult['ELEMENT_ADD_DESC']) && !empty($arResult['ELEMENT_ADD_DESC']))
{
	$APPLICATION->SetPageProperty("sotbit_seometa_add_desc", $arResult['ELEMENT_ADD_DESC']);
	$this->SetViewTarget("sotbit_seometa_add_desc");
	echo $arResult['ELEMENT_ADD_DESC'];
	$this->EndViewTarget();
}
$this->SetViewTarget("sotbit_seometa_linked_conditons");
$APPLICATION->IncludeComponent(
	"sotbit:seo.meta.tags", 
	"seo_tags_list", 
	array(
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_TYPE" => "A",
		"CNT_TAGS" => "",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_TYPE" => "aspro_allcorp_catalog",
		"INCLUDE_SUBSECTIONS" => "N",
		"SECTION_ID" => $arParams["SECTION_ID"],
		"SORT" => "CONDITIONS",
		"SORT_ORDER" => "asc",
		"COMPONENT_TEMPLATE" => "seo_tags_list",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"RULE_ID" => $arResult["CURRENT_COND_ID"]
	),
	false
);
$this->EndViewTarget();
?>