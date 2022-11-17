<?

CModule::IncludeModule('iblock');

//xmp($arResult);

$res = CIBlock::GetList(
	Array(), 
	Array(
		"CODE"=>'series_images'
	), true
);
$arIblock = $res->Fetch();

$arOrder = array(
	"PROPERTY_series"=>"ASC"
);
$arFilter = array(
	"IBLOCK_ID" => 43,
	"INCLUDE_SUBSECTIONS" => "Y",
	"PROPERTY_producer" => $arResult["ID"],
);
$arSelect = array(
	"ID",
	"IBLOCK_ID",
	"PROPERTY_series",
	"NAME",
	"ID",
);

//xmp(111);

$obj_element = new CIBlockElement;

$arResult["SERIES"] = array();
$rs = CIBlockElement::GetList($arOrder, $arFilter, array("PROPERTY_series"), false, $arSelect);
while($arItem = $rs->GetNext()){
	 
	if(strlen(trim($arItem["PROPERTY_SERIES_VALUE"]))<=0){
		continue;
	}
	xmp($arItem["NAME"]);
	$rsSeries = CIBlockElement::GetList(array(),array("IBLOCK_CODE"=>"series_images","NAME"=>$arItem["PROPERTY_SERIES_VALUE"], "!PREVIEW_PICTURE"=>false));
	if($arImage = $rsSeries->GetNext()){
		$arImage["SERIES_ID"] = $arItem["ID"];
		$arFile = CFIle::GetFileArray($arImage["PREVIEW_PICTURE"]);
		$arImage["IMAGE"] = $arFile;
		$arResult["SERIES"][] = $arImage;
	}
	
}

?>