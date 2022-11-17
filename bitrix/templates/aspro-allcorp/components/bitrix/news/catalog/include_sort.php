<?



$current_section_id = intval($_REQUEST["section_id"])>0?intval($_REQUEST["section_id"]):intval($arResult["ID"]); 
$current_producer_id = intval($_REQUEST["producer_id"])>0?$_REQUEST["producer_id"]:intval($_REQUEST["producer_id"]);
$current_serie_id = strlen($_REQUEST["serie_id"])>0?$_REQUEST["serie_id"]:''; 
$current_material_id = strlen($_REQUEST["material_id"])>0?$_REQUEST["material_id"]:''; 


if($_REQUEST['tp'] == 'Y'){
	$current_producer_id = 0;
	$current_serie_id = '';
	$current_material_id = '';
}

print_r($arItem["PROPERTY_SERIES_VALUE"]);

if ($current_section_id == "") {
    $ar = $_SERVER['REQUEST_URI'];
    $ar = explode("/", $ar);
    $ar = $ar[count($ar) - 2];
//    print_r($ar);

    $res = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 54, 'CODE' => $ar));
    $section = $res->Fetch();
    $current_section_id = intval($section['ID']);
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
    if($arSection["DEPTH_LEVEL"] == 3)
        $arSection["NAME"] = '----> '.$arSection["NAME"];
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
if(strlen($current_serie_id)>0 && $current_serie_id != "0") {
    $arFilter["PROPERTY_series"] = $current_serie_id;
}

$arSelect = array(
	"ID",
	"IBLOCK_ID",
	"PROPERTY_material",
);

$arResult["FILTER_MATERIAL"] = array();
$rs = CIBlockElement::GetList($arOrder, $arFilter, array("PROPERTY_material"), false, $arSelect);
while($arItem = $rs->GetNext()){
//	if(strlen(trim($arItem["PROPERTY_MATERIAL_VALUE"]))==0) continue;
	$arResult["FILTER_MATERIAL"][] = $arItem;
}

?>

<!-- noindex -->
<div class="row filters-wrap">
	<?

	if($arResult["VARIABLES"]["SECTION_ID"]){
		$arSectiontmp = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arResult["VARIABLES"]["SECTION_ID"] ), false, array( "ID",  "UF_VIEWTYPE"))->GetNext();
	}
	elseif($arResult["VARIABLES"]["SECTION_CODE"]){		 
		 $arSectiontmp = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arResult["VARIABLES"]["SECTION_CODE"] ), false, array( "ID", "UF_VIEWTYPE"))->GetNext();
	}
		
	if($_SESSION["UF_VIEWTYPE_".$arParams["IBLOCK_ID"]] === NULL){
		$arUserFieldViewType = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".$arParams["IBLOCK_ID"]."_SECTION", "FIELD_NAME" => "UF_VIEWTYPE"))->Fetch();
		$resUserFieldViewTypeEnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_ID" => $arUserFieldViewType["ID"]));
		while($arUserFieldViewTypeEnum = $resUserFieldViewTypeEnum->GetNext()){
			$_SESSION["UF_VIEWTYPE_".$arParams["IBLOCK_ID"]][$arUserFieldViewTypeEnum["ID"]] = $arUserFieldViewTypeEnum["XML_ID"];
		}
	}
						
	if( array_key_exists( "display", $_REQUEST ) && !empty( $_REQUEST["display"] ) ){
		setcookie( "display", $_REQUEST["display"] );
		$_COOKIE["display"] = $_REQUEST["display"];
	}
	if( array_key_exists( "sort", $_REQUEST ) && !empty( $_REQUEST["sort"] ) ){
		setcookie( "sort", $_REQUEST["sort"] );
		$_COOKIE["sort"] = $_REQUEST["sort"];
	}
	if( array_key_exists( "order", $_REQUEST ) && !empty( $_REQUEST["order"] ) ){
		setcookie( "order", $_REQUEST["order"] );
		$_COOKIE["order"] = $_REQUEST["order"];
	}
	if( array_key_exists( "show", $_REQUEST ) && !empty( $_REQUEST["show"] ) ){
		setcookie( "show", $_REQUEST["show"] );
		$_COOKIE["show"] = $_REQUEST["show"];
	}

	if($arSectiontmp["UF_VIEWTYPE"] && isset($_SESSION["UF_VIEWTYPE_".$arParams["IBLOCK_ID"]][$arSectiontmp["UF_VIEWTYPE"]])){
		$display = $_SESSION["UF_VIEWTYPE_".$arParams["IBLOCK_ID"]][$arSectiontmp["UF_VIEWTYPE"]];
	}
	else{
		$display = !empty($_COOKIE["display"]) ? $_COOKIE["display"] : $arParams["VIEW_TYPE"];
	}
	$show = !empty($_COOKIE["show"]) ? $_COOKIE["show"] : $arParams["PAGE_ELEMENT_COUNT"];
	?>
	<div class="col-md-3 col-sm-5 ordering-wrap">
		<?
		if($arParams["SORT_PROP"]){
			$sort_direction=$arParams["SORT_DIRECTION"]? $arParams["SORT_DIRECTION"] : "desc";
			foreach($arParams["SORT_PROP"] as $prop){
				if($prop!='name') $propName = "PROPERTY_".$prop;
				$arAvailableSort[$prop]=array($propName, $sort_direction);
			}
		}else{
			$arAvailableSort = array(
				"name" => array( "NAME", $sort_direction )						
			);
		}
		$sort = !empty($_COOKIE["sort"]) ? $_COOKIE["sort"] : $arParams["SORT_PROP_DEFAULT"];
		$order = !empty($_COOKIE["order"]) ? $_COOKIE["order"] : $arAvailableSort[$sort][1];
		?>

<!--      --><?//  global $second_level;
//        global $search_page;
//        if($second_level || $search_page):
//        ?>

            <form id = "catalog-filter-form" action="" method="get">
                <input type="hidden" name="tp" id='f_tp' value="N"/>
                <table>
                    <tr><td>
                <div class="select-outer" style="margin-bottom: 10px;">
                    <i class="icon icon-angle-down"></i>
                <select name="section_id" onchange="$('#f_tp').attr('value','Y'); $('#catalog-filter-form').submit();">

                    <? foreach ($arResult["FILTER_SECTIONS"] as $arSection):?>
                        <?
                        $strStyle = '';
                        if($arSection["DEPTH_LEVEL"]=="1"){
                            $strStyle = 'color: red; font-size: 12px;';
                        }
                        ?>
                        <option <? if($arResult["current_section_id"] == $arSection["ID"]):?>selected<?endif?> style="<?=$strStyle?>" value="<?=$arSection["ID"]?>"><?=$arSection["NAME"]?></option>
                    <?endforeach;?>
                </select>
        </div></td><td>
                <div class="select-outer" style="margin-bottom: 10px; margin-left: 10px;">
                    <i class="icon icon-angle-down"></i>
                <?//if(count($arResult["FILTER_PRODUCERS"])>0):?>
                <select name="producer_id" onchange="$('select[name=serie_id]').val(0); $('select[name=material_id]').val(0); $('#catalog-filter-form').submit()">
                    <option value="0">По производителю</option>
                    <?foreach ($arResult["FILTER_PRODUCERS"] as $arProducer):?>
                        <option <?if($arResult["current_producer_id"] == $arProducer["PROPERTY_PRODUCER_VALUE"]):?>selected<?endif?> value="<?=$arProducer["PROPERTY_PRODUCER_VALUE"]?>"><?=$arProducer["PROPERTY_PRODUCER_NAME"]?></option>
                    <?endforeach;?>
                </select>
                <?//endif;?>
        </div></td>
               </tr>
                </table>

                <table>
                    <tr><td>
                <div class="select-outer" style="margin-bottom: 10px; ">
                    <i class="icon icon-angle-down"></i>
                <?//if(count($arResult["FILTER_SERIES"])>0):?>
                <select name="serie_id" onchange="$('select[name=material_id]').val(0); $('#catalog-filter-form').submit()">
                    <option value="0">По серии</option>
                    <?foreach ($arResult["FILTER_SERIES"] as $arSerie):?>
                        <option <?if($arResult["current_serie_id"] == $arSerie["PROPERTY_SERIES_VALUE"] && strlen($arSerie["PROPERTY_SERIES_VALUE"])>0):?>selected<?endif;?> value="<?=$arSerie["PROPERTY_SERIES_VALUE"]?>"><?=$arSerie["PROPERTY_SERIES_VALUE"]?></option>
                    <?endforeach;?>
                </select>
                <?//endif;?>
    </div></td>
                        <td>
                <div class="select-outer" style="margin-bottom: 10px; margin-left: 10px;">
                    <i class="icon icon-angle-down"></i>
                <?//if(count($arResult["FILTER_MATERIAL"])>0):?>

                <select name="material_id" onchange="$('#catalog-filter-form').submit()">
                    <option value="0">По материалу</option>

                    <?foreach ($arResult["FILTER_MATERIAL"] as $arMaterial):?>

                        <option <? if($arResult["current_material_id"] == $arMaterial["PROPERTY_MATERIAL_VALUE"] && strlen($arMaterial["PROPERTY_MATERIAL_VALUE"])>0):?>selected<? endif; ?> value="<? echo $arMaterial["PROPERTY_MATERIAL_VALUE"];?>"><?=$arMaterial["PROPERTY_MATERIAL_VALUE"]?></option>

                    <?endforeach;?>
                </select>
                <?//endif;?>
</div></td>
                </tr>
                </table>
            </form>

<!--        --><?//endif;?>








		<div class="select-outer">
			<i class="icon icon-angle-down"></i>
			<select class="sort">
			<?foreach( $arAvailableSort as $key => $arSort ){
				$className = $sort == $key ? 'cur' : '';
				$selected = $sort == $key ? 'selected' : '';
				if($className) 
					$className .= $order == 'asc' ? ' asc' : ' desc';
				$newSort = $sort == $key ? $order == 'desc' ? 'asc' : 'desc' : $arAvailableSort[$key][1];?>
				<option <?=($selected ? "selected='selected'" : "")?>  value="<?=$APPLICATION->GetCurPageParam('sort='.$key.'&order='.$newSort, array('sort', 'order'))?>" class="grey-button button-<?=($key=='price' ? 'left' : 'right')?> ordering  <?=$className?>"><span><?=GetMessage('sort_title')?><?=GetMessage('sort_'.$key)?></span></option>
			<?}?>
			</select>
		</div>

	</div>

	<? if (!$arSectiontmp["UF_VIEWTYPE"]){ ?>
	<div class="col-md-5 col-sm-5 display-type pull-right text-right">
		<span class="label_show"><?=GetMessage('T_SORT');?>:</span>
		<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('display=table', array('display'))?>" class="view-button view-tiles <?=$display == 'table' ? 'cur' : '';?>" alt="<?=GetMessage('T_LIST_VIEW');?>" title="<?=GetMessage('T_LIST_VIEW');?>">
			&nbsp;
		</a>
		<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('display=list', array('display'))?>" class="view-button view-list <?=$display == 'list' ? 'cur' : '';?>" alt="<?=GetMessage('T_TABLE_VIEW');?>" title="<?=GetMessage('T_TABLE_VIEW');?>">
			&nbsp;
		</a>
		<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('display=price', array('display'))?>" class="view-button view-price <?=$display == 'price' ? 'cur' : '';?>" alt="<?=GetMessage('T_PRICE_VIEW');?>" title="<?=GetMessage('T_PRICE_VIEW');?>">
			&nbsp;
		</a>
	</div>
	<?}?>
</div>
<!-- /noindex -->
