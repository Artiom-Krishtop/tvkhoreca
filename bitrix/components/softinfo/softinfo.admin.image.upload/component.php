<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
Global $USER;
if(!isset($arParams["IBLOCK_ID"]) || !CModule::IncludeModule('iblock')) return;
$arResult["IS_ADMIN"]="N";
$arGroups = CUser::GetUserGroup($USER->GetID());
foreach($arGroups as $group){
 if(in_array($group,$arParams["ADMIN_GROUP"]))
  {
  $arResult["IS_ADMIN"]="Y";
   break;
   }
}



if($arResult["IS_ADMIN"]=="Y"){
  $arIblockParamsOrig=CIBlock::GetFields($arParams["IBLOCK_ID"]);
  $arIblockParamsTemp = $arIblockParamsOrig;

  $arIblockParamsTemp["PREVIEW_PICTURE"]["DEFAULT_VALUE"]["UPDATE_WITH_DETAIL"]="Y";
  $arIblockParamsTemp["PREVIEW_PICTURE"]["DEFAULT_VALUE"]["FROM_DETAIL"]="Y";

  CIBlock::SetFields($arParams["IBLOCK_ID"],$arIblockParamsTemp);

 $arResult["UPDATE_PAGE"]=false;
 $arResult["DETAIL_PAGE_URL"] = $arParams["DETAIL_PAGE_URL"];
$io = CBXVirtualIo::GetInstance();
if(array_key_exists($arParams["SUBMIT_INPUT_NAME"], $_FILES))
					$arDETAIL_PICTURE = $_FILES[$arParams["SUBMIT_INPUT_NAME"]];
				elseif(isset($_REQUEST[$arParams["SUBMIT_INPUT_NAME"]]))
				{
					$arDETAIL_PICTURE = CFile::MakeFileArray($io->GetPhysicalName($_REQUEST[$arParams["SUBMIT_INPUT_NAME"]]), false, true);
					$arDETAIL_PICTURE["COPY_FILE"] = "Y";
				}
				else
					$arDETAIL_PICTURE = array();

				$arDETAIL_PICTURE["del"] = ${"DETAIL_PICTURE_del"};
				$arDETAIL_PICTURE["description"] = ${"DETAIL_PICTURE_descr"};

if(isset($_POST[$arParams["SUBMIT_INPUT_NAME"]])){

  $arFields = array(
					"MODIFIED_BY" => $USER->GetID(),
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"DETAIL_PICTURE" => $arDETAIL_PICTURE,
				);
  $bs = new CIBlockElement;
  $res = $bs->Update($arParams['ELEMENT_ID'], $arFields, $WF=="N", true, true);
  if($res){
    $arResult["UPDATE_PAGE"]=true;
  }
}
}

    CIBlock::setFields($arParams["IBLOCK_ID"],$arIblockParamsOrig);
    unset($arIblockParamsTemp);
    unset($arIblockParamsOrig);

if($arParams["FIXED_SLIDE_PANEL"]=="Y"){
  $fix_class = "fixed_uload_panel";
  $style = "";
  switch($arParams["FIXED_SLIDE_ALIGN"]){
    case "TOP": $style.="top:0;";
    break;

    case "BOTTOM": $style.="bottom:0;";
    break;

    case "LEFT": $style.="left:0;";
    break;

    case "RIGHT": $style.="right:0;";
    break;
  }
 switch($arParams["FIXED_SLIDE_PADDING_TYPE"]){
    case "TOP": $style.="top:".$arParams["FIXED_SLIDE_PADDING_VALUE"]."px;";
    break;

    case "BOTTOM": $style.="bottom:".$arParams["FIXED_SLIDE_PADDING_VALUE"]."px;";
    break;

    case "LEFT": $style.="left:".$arParams["FIXED_SLIDE_PADDING_VALUE"]."px;";
    break;

    case "RIGHT": $style.="right:".$arParams["FIXED_SLIDE_PADDING_VALUE"]."px;";
    break;
 }

} else {
  $fix_class = "";
}
   $arResult["FIX_CLASS"] = $fix_class;
   $arResult["FIX_STYLE"] = $style;

	$this->IncludeComponentTemplate();
?>