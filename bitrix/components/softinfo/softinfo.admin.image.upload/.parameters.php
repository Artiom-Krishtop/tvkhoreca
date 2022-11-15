<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock")) return;
Global $USER;
$filter = array();
$res = CGroup::GetList(($by="c_sort"), ($order="desc"), $filter);
$arGroups = array();
$arGroupsCl = array();
while ($group = $res->GetNext()){
$arGroups[$group["ID"]] = "[".$group["ID"]."] ".$group["NAME"];
}

$arTypesEx_IBLOCK_TYPE = array("-" => " ");
$rsIBlockTypes_IBLOCK_TYPE = CIBlockType::GetList(array("SORT" => "ASC"));
while($arIBlockTypes_IBLOCK_TYPE = $rsIBlockTypes_IBLOCK_TYPE->Fetch())
	if ($arIBType_IBLOCK_TYPE = CIBlockType::GetByIDLang($arIBlockTypes_IBLOCK_TYPE["ID"], LANG))
		$arTypesEx_IBLOCK_TYPE[$arIBlockTypes_IBLOCK_TYPE["ID"]] = $arIBType_IBLOCK_TYPE["NAME"];

$arIBlocks_IBLOCK_ID = array();
$arFilter = array("SITE_ID" => $_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"] != "-" ? $arCurrentValues["IBLOCK_TYPE"] : ""));
$rsIBlock_IBLOCK_ID = CIBlock::GetList(array("SORT" =>" ASC"), $arFilter);
while($arIBlock_IBLOCK_ID = $rsIBlock_IBLOCK_ID->Fetch())
	$arIBlocks_IBLOCK_ID[$arIBlock_IBLOCK_ID["ID"]] = $arIBlock_IBLOCK_ID["NAME"];

$arComponentParameters = array(
	"GROUPS" => array(
       	"PANEL_SETTINGS" => array(
			"SORT" => 150,
			"NAME" => GetMessage("S_INF_CMP_PANEL_SETTINGS"),
		),
        "USERS_GROUPS" => array(
			"SORT" => 160,
			"NAME" => GetMessage("S_INF_CMP_GROUP_USERS_GROUP"),
		),
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("S_INF_CMP_PARAM_IBLOCK_TYPE_PRO"),
			"TYPE" => "LIST",
			"VALUES" => $arTypesEx_IBLOCK_TYPE,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("S_INF_CMP_PARAM_IBLOCK_ID_PRO"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlocks_IBLOCK_ID,
            "REFRESH" => "Y",
		),
        "SUBMIT_INPUT_NAME" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("S_INF_CMP_PARAM_SUBMIT_INPUT_NAME"),
			"TYPE" => "STRING",
			"VALUES" => "",
            "DEFAULT" => "DETAIL_PICTURE",
		),
        "DETAIL_PAGE_URL" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("S_INF_CMP_PARAM_DETAIL_PAGE_URL"),
			"TYPE" => "STRING",
			"VALUES" => "",
            "DEFAULT" => "",
		),
        "ELEMENT_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("S_INF_CMP_PARAM_ELEMENT_ID"),
			"TYPE" => "STRING",
			"VALUES" => "",
            "DEFAULT" => "",
		),
/*		"UPLOAD_PROPERTY" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("S_INF_CMP_PARAM_PROPERTY_NAME"),
			"TYPE" => "LIST",
			"VALUES" => array("DETAIL_PICTURE" => GetMessage("S_INF_CMP_PARAM_DETAIL_PICTURE"),
                              "PREVIEW_PICTURE" => GetMessage("S_INF_CMP_PARAM_PREVIEW_PICTURE")),
		),*/
       "FIXED_SLIDE_PANEL" => array(
			"PARENT" => "PANEL_SETTINGS",
			"NAME" => GetMessage("S_INF_CMP_FIXED_SLIDE_PANEL"),
			"TYPE" => "CHECKBOX",
			"VALUES" => "false",
            "REFRESH" => "Y",
		),
       "ADMIN_GROUP" => array(
			"PARENT" => "USERS_GROUPS",
			"NAME" => GetMessage("S_INF_CMP_USERS_GROUP"),
			"TYPE" => "LIST",
			"VALUES" => $arGroups,
            "MULTIPLE" => "Y",
		),
		'CACHE_TIME' => array('DEFAULT' => 8600)
	),
);
if($arCurrentValues["FIXED_SLIDE_PANEL"]=="Y")
{
	$arComponentParameters["PARAMETERS"]["FIXED_SLIDE_ALIGN"] = array(
			"PARENT" => "PANEL_SETTINGS",
			"NAME" => GetMessage("S_INF_CMP_FIXED_SLIDE_ALIGN"),
			"TYPE" => "LIST",
			"VALUES" => array("TOP" => GetMessage("S_INF_CMP_FIXED_SLIDE_TOP"),
                              "BOTTOM" => GetMessage("S_INF_CMP_FIXED_SLIDE_BOTTOM"),
                              "LEFT" => GetMessage("S_INF_CMP_FIXED_SLIDE_LEFT"),
                              "RIGHT" => GetMessage("S_INF_CMP_FIXED_SLIDE_RIGHT"),
                              ),
            "REFRESH" => "Y"
		);

    if($arCurrentValues["FIXED_SLIDE_ALIGN"]=="TOP" || $arCurrentValues["FIXED_SLIDE_ALIGN"]=="BOTTOM"){
        $arComponentParameters["PARAMETERS"]["FIXED_SLIDE_PADDING_TYPE"] = array(
        			"PARENT" => "PANEL_SETTINGS",
        			"NAME" => GetMessage("S_INF_CMP_PANEL_PADDING_TYPE"),
        			"TYPE" => "LIST",
        			"VALUES" => array("LEFT" => GetMessage("S_INF_CMP_FIXED_SLIDE_LEFT"),
                                      "RIGHT" => GetMessage("S_INF_CMP_FIXED_SLIDE_RIGHT"),
                                      ),
                    "REFRESH" => "Y"
        		 );
    }
    if($arCurrentValues["FIXED_SLIDE_ALIGN"]=="LEFT" || $arCurrentValues["FIXED_SLIDE_ALIGN"]=="RIGHT"){
        $arComponentParameters["PARAMETERS"]["FIXED_SLIDE_PADDING_TYPE"] = array(
        			"PARENT" => "PANEL_SETTINGS",
        			"NAME" => GetMessage("S_INF_CMP_PANEL_PADDING_TYPE"),
        			"TYPE" => "LIST",
        			"VALUES" => array("TOP" => GetMessage("S_INF_CMP_FIXED_SLIDE_TOP"),
                                      "BOTTOM" => GetMessage("S_INF_CMP_FIXED_SLIDE_BOTTOM"),
                                      ),
                    "REFRESH" => "Y"
        		 );
    }
    if(isset($arCurrentValues["FIXED_SLIDE_PADDING_TYPE"])){
       $arComponentParameters["PARAMETERS"]["FIXED_SLIDE_PADDING_VALUE"] = array(
        			"PARENT" => "PANEL_SETTINGS",
        			"NAME" => GetMessage("S_INF_CMP_PANEL_PADDING_VALUE"),
                    "TYPE" => "STRING",
                    "VALUES" => "",
                    "DEFAULT" => "0",
        		 );
    }
         }
?>