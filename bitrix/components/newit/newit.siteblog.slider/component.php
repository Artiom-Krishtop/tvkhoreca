<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
	return 0;
}
/*************************************************************************
	Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);



/*************************************************************************
			Work with cache
*************************************************************************/

if($this->StartResultCache(false, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups())))
{
        if(!CModule::IncludeModule("iblock"))
        {
            $this->AbortResultCache();
            ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
            return;
        }
		//SELECT
		$arSelect = array(
			"ID",
            "IBLOCK_ID",
			"NAME",
			"CODE",
			"DETAIL_PICTURE",
			"PREVIEW_PICTURE",
            "PREVIEW_TEXT",
            "DETAIL_TEXT", 
            "DETAIL_PICTURE",           
			"PROPERTY_*"
		);
		//WHERE
		$arFilter = array(
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ACTIVE" => "Y",
            "ACTIVE_DATE" => "Y",
            "IBLOCK_ACTIVE" => "Y",
		);
		//ORDER BY
		$arSort = array();
        
        $arResult['ITEMS'] = array();
		$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
		while($obElement = $rsElement->GetNextElement())
		{
			$item = $obElement->GetFields();

            $arButtons = CIBlock::GetPanelButtons(
				$item["IBLOCK_ID"],
				$item["ID"],
				0,
				array("SECTION_BUTTONS"=>false, "SESSID"=>false)
			);
			$item["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
			$item["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

           
			$item["PROPERTIES"] = $obElement->GetProperties();

            
            if($item['PREVIEW_PICTURE']){
                $picture = $item['PREVIEW_PICTURE'];    
            }
            elseif($item['DETAIL_PICTURE']){
                $picture = $item['DETAIL_PICTURE'];        
            }


            if($picture) {
                
                $photo_img = CFile::ResizeImageGet(
                    $picture,
                    array("width" => $arParams["DISPLAY_FOTO_WIDTH"], "height" => $arParams["DISPLAY_FOTO_HEIGHT"]),
                    BX_RESIZE_IMAGE_EXACT,
                    true
                );

                $item["PREVIEW_IMG"]  = $photo_img; 
                             
            }
            
            $arResult['ITEMS'][] = $item;        
		}
         
                   
        $this->SetResultCacheKeys(array(
            "ID",
        ));                          
        $this->IncludeComponentTemplate();   

}








?>
