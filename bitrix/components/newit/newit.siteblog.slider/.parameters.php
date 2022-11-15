<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())  {
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}


$arProperty = array();
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
	if($arr["PROPERTY_TYPE"] == "F") {
		$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}



$arAscDesc = array(
	"asc" => GetMessage("IBLOCK_SORT_ASC"),
	"desc" => GetMessage("IBLOCK_SORT_DESC"),
);

$arComponentParameters = array(
	"GROUPS" => array(
		"FULL_SETTINGS" => array(
			"NAME" => GetMessage("FULL_SETTINGS"),
            "SORT" => 100,
		),
	),
	"PARAMETERS" => array(
    
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
        
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
        
		"DISPLAY_FOTO_WIDTH" => array(
			"PARENT" => "FULL_SETTINGS",
			"NAME" => GetMessage("DISPLAY_FOTO_WIDTH"),
			"TYPE" => "STRING",
            "DEFAULT" => "350"
		),
        
		"DISPLAY_FOTO_HEIGHT" => array(
			"PARENT" => "FULL_SETTINGS",
			"NAME" => GetMessage("DISPLAY_FOTO_HEIGHT"),
			"TYPE" => "STRING",
            "DEFAULT" => "850"
		),

		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
        
	),
);


?>