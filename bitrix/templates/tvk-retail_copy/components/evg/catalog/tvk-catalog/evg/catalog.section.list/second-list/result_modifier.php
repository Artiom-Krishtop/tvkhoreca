<?
$arOrder = array(
	"PROPERTY_producer.NAME" => "ASC",
);
$arFilter = array(
	"ACTIVE" => "Y",
	"SECTION_ID" => $arResult["SECTION"]["ID"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"INCLUDE_SUBSECTIONS" => "Y",
);
$arSelect = array(
	"ID",
	"IBLOCK_ID",
	"PROPERTY_producer.ID",
	"PROPERTY_producer.NAME",
);

$arResult["PRODUCERS"] = array();
$rs = CIBlockElement::GetList($arOrder, $arFilter, array("PROPERTY_producer"), false, $arSelect);
while($arItem = $rs->GetNext()){
	$arResult["PRODUCERS"][] = $arItem;
}
?>