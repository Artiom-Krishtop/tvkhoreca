<?
if($arResult["ORDERS"]){
	$arResult["USER_STAT"]["FULL_COAST"] = 0;
	$arResult["USER_STAT"]["FULL_ITEMS"] = 0;
	$arResult["USER_STAT"]["ORDER_COUNT"] = 0;
	foreach($arResult["ORDERS"] as $num=>$arOrder){
		$arResult["USER_STAT"]["FULL_COAST"] = $arOrder[ORDER]['PRICE'] + $arResult["USER_STAT"]["FULL_COAST"];
		$arResult["USER_STAT"]["FULL_ITEMS"] = count($arOrder['BASKET_ITEMS']) + $arResult["USER_STAT"]["FULL_ITEMS"];
	}
	$arResult["USER_STAT"]["ORDER_COUNT"] = count($arResult["ORDERS"]);
	$arResult["USER_STAT"]['USER_INFO'] = CUser::GetByID($arParams['USER_ID'])->Fetch();
	foreach($arResult["ORDERS"] as $key=>$arOrder){
		foreach($arOrder["BASKET_ITEMS"] as $id=>$arProduct){
			$rsSection = CIBlockElement::GetElementGroups($arProduct['PRODUCT_ID'], false, array('ID','NAME'));
			while($ar_group = $rsSection->Fetch())
				$arResult["ORDERS"][$key]["BASKET_ITEMS"][$id]["PRODUCT_SECTION"] = $ar_group['NAME'];
		}
	}
}
?>