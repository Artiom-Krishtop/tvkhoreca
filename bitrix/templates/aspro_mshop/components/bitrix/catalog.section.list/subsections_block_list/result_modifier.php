<?
	/*$arSections = array();
	$arSectionsDepth3 = array();
	foreach( $arResult["SECTIONS"] as $arItem ) {
		if( $arItem["DEPTH_LEVEL"] == 1 ) { $arSections[$arItem["ID"]] = $arItem;}
		elseif( $arItem["DEPTH_LEVEL"] == 2 ) {$arSections[$arItem["IBLOCK_SECTION_ID"]]["SECTIONS"][$arItem["ID"]] = $arItem;}
		elseif( $arItem["DEPTH_LEVEL"] == 3 ) {$arSectionsDepth3[] = $arItem;}
	}
	foreach( $arSectionsDepth3 as $arItem) {
		foreach( $arSections as $key => $arSection) {
			if (is_array($arSection["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]]) && !empty($arSection["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]])) {
				$arSections[$key]["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]]["SECTIONS"][$arItem["ID"]] = $arItem;
			}
		}
	}
	$arResult["SECTIONS"] = $arSections;*/
if($arResult["SECTION"][SECTION_PAGE_URL]){
	$arResult["CANONICAL"] = $arResult["SECTION"][SECTION_PAGE_URL];
}else{
	$arResult["CANONICAL"] = $APPLICATION->GetCurPage(false);
}
	$cp = $this->__component; 
	if (is_object($cp))
	$cp->SetResultCacheKeys(array('CANONICAL'));
?>