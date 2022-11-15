<?
$arParams["LINE_ELEMENT_COUNT"] = 4;

$current_section_id = intval($_REQUEST["section_id"])>0?intval($_REQUEST["section_id"]):intval($arResult["ID"]); 
$current_producer_id = intval($_REQUEST["producer_id"])>0?$_REQUEST["producer_id"]:intval($_REQUEST["producer_id"]);
$current_serie_id = strlen($_REQUEST["serie_id"])>0?$_REQUEST["serie_id"]:''; 
$current_material_id = strlen($_REQUEST["material_id"])>0?$_REQUEST["material_id"]:''; 

if($_REQUEST['tp'] == 'Y'){
	$current_producer_id = 0;
	$current_serie_id = '';
	$current_material_id = '';
}

$arResult["current_section_id"] = $current_section_id;
$arResult["current_producer_id"] = $current_producer_id;
$arResult["current_serie_id"] = $current_serie_id;
$arResult["current_material_id"] = $current_material_id;


/**
*
* Get current sections list
* 
**/

$arOrder = array(
	"NAME" => "ASC",
);
$arFilter = array(
	"ACTIVE" => "Y",	
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"INCLUDE_SUBSECTIONS" => "Y",
);

$arResult["FILTER_SECTIONS"] = array();
$rs = CIBlockSection::GetList(Array("left_margin"=>"asc"), $arFilter);
while($arSection = $rs->GetNext()){
	if($arSection["DEPTH_LEVEL"] == 2)
		$arSection["NAME"] = '--> '.$arSection["NAME"];
	$arResult["FILTER_SECTIONS"][] = $arSection;
}

/**
*
* Get current producers list
* 
**/

$arOrder = array(
	"PROPERTY_producer.NAME" => "ASC",
);
$arFilter = array(
	"ACTIVE" => "Y",
	//"SECTION_ID" => $arResult["ID"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"INCLUDE_SUBSECTIONS" => "Y",
);
if(intval($current_section_id)){
	$arFilter["SECTION_ID"] = $current_section_id;
}
$arSelect = array(
	"ID",
	"IBLOCK_ID",
	"PROPERTY_producer.ID",
	"PROPERTY_producer.NAME",
);

$arResult["FILTER_PRODUCERS"] = array();
$rs = CIBlockElement::GetList($arOrder, $arFilter, array("PROPERTY_producer"), false, $arSelect);
while($arItem = $rs->GetNext()){
	if(strlen(trim($arItem["PROPERTY_PRODUCER_VALUE"]))==0) continue;
	$arResult["FILTER_PRODUCERS"][] = $arItem;
}

/**
*
* Get current series list
* 
**/

$arOrder = array(
	"PROPERTY_series" => "ASC",
);
$arFilter = array(
	"ACTIVE" => "Y",
	//"SECTION_ID" => $arResult["ID"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"INCLUDE_SUBSECTIONS" => "Y",
);
if(intval($current_section_id)){
	$arFilter["SECTION_ID"] = $current_section_id;
}
if(intval($current_producer_id)){
	$arFilter["PROPERTY_producer"] = $current_producer_id;
}
$arSelect = array(
	"ID",
	"IBLOCK_ID",
	"PROPERTY_series",
);



$arResult["FILTER_SERIES"] = array();
$rs = CIBlockElement::GetList($arOrder, $arFilter, array("PROPERTY_series"), false, $arSelect);
while($arItem = $rs->GetNext()){
	if(strlen(trim($arItem["PROPERTY_SERIES_VALUE"]))==0) continue;
	$arResult["FILTER_SERIES"][] = $arItem;
}



/**
*
* Get current materials list
* 
**/

$arOrder = array(
	"PROPERTY_material" => "ASC",
);
$arFilter = array(
	"ACTIVE" => "Y",
	//"SECTION_ID" => $arResult["ID"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"INCLUDE_SUBSECTIONS" => "Y",
);

if(intval($current_section_id)){
	$arFilter["SECTION_ID"] = $current_section_id;
}
if(intval($current_producer_id)){
	$arFilter["PROPERTY_producer"] = $current_producer_id;
}

$arSelect = array(
	"ID",
	"IBLOCK_ID",
	"PROPERTY_material",
);

$arResult["FILTER_MATERIAL"] = array();
$rs = CIBlockElement::GetList($arOrder, $arFilter, array("PROPERTY_material"), false, $arSelect);
while($arItem = $rs->GetNext()){
	if(strlen(trim($arItem["PROPERTY_MATERIAL_VALUE"]))==0) continue;
	$arResult["FILTER_MATERIAL"][] = $arItem;
}

?>