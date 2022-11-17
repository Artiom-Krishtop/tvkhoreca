<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="tvk-catalog-section">
<? 

/*************************************  Andrei code  **********************************************/
//echo "<h3>".$APPLICATION->GetCurPageParam()."</h3>"; 
//echo "<p>Total items ".count($arResult["ITEMS"])."</p>"; // my code

if($_REQUEST["producer_id"] > 0 && $_REQUEST["section_id"] > 0 && count($arResult["ITEMS"]) == 0) {
	/*$page = $APPLICATION->GetCurPageParam("producer_id=0", array("producer_id"));
	echo $page;
	echo $_REQUEST["producer_id"];*/
	header("Location: ?section_id=".$_REQUEST["section_id"]."&producer_id=0&serie_id=0&material_id=0");
}
/***************************************************************************************************/
?>
<?
//echo "<p>/bitrix/templates/tvk-horeca/components/evg/catalog/tvk-catalog/evg/catalog.section/.default/template.php</p>";

global $second_level;
global $search_page;
if($second_level || $search_page):
?>
<div class="catalog-filter" style="margin-bottom: 10px;">

<form id = "catalog-filter-form" action="<?=$arParams["SECTION_URL"]?>search/">
	<input type="hidden" name="tp" id='f_tp' value="N"/>
	<select name="section_id" onchange="$('#f_tp').attr('value','Y'); $('#catalog-filter-form').submit();">
		<option value="0">Все</option>
		<?foreach ($arResult["FILTER_SECTIONS"] as $arSection):?>
			<?
				$strStyle = '';
				if($arSection["DEPTH_LEVEL"]=="1"){
					$strStyle = 'color: red; font-size: 12px;';
				}
			?>
			<option <? if($arResult["current_section_id"] == $arSection["ID"]):?>selected<?endif?> style="<?=$strStyle?>" value="<?=$arSection["ID"]?>"><?=$arSection["NAME"]?></option>
		<?endforeach;?>
	</select>
	<select name="producer_id" onchange="$('#catalog-filter-form').submit()">
		<option value="0">По производителю</option>
		<?foreach ($arResult["FILTER_PRODUCERS"] as $arProducer):?>
			<option <?if($arResult["current_producer_id"] == $arProducer["PROPERTY_PRODUCER_VALUE"]):?>selected<?endif?> value="<?=$arProducer["PROPERTY_PRODUCER_VALUE"]?>"><?=$arProducer["PROPERTY_PRODUCER_NAME"]?></option>
		<?endforeach;?>
	</select>
	<select name="serie_id" onchange="$('#catalog-filter-form').submit()">
		<option value="0">По серии</option>
		<?foreach ($arResult["FILTER_SERIES"] as $arSerie):?>
			<option <?if($arResult["current_serie_id"] == $arSerie["PROPERTY_SERIES_VALUE"] && strlen($arSerie["PROPERTY_SERIES_VALUE"])>0):?>selected<?endif;?> value="<?=$arSerie["PROPERTY_SERIES_VALUE"]?>"><?=$arSerie["PROPERTY_SERIES_VALUE"]?></option>
		<?endforeach;?>
	</select>
	<select name="material_id" onchange="$('#catalog-filter-form').submit()">
		<option value="0">По материалу</option>
		<?foreach ($arResult["FILTER_MATERIAL"] as $arMaterial):?>
			<option <? if($arResult["current_material_id"] == $arMaterial["PROPERTY_MATERIAL_VALUE"] && strlen($arMaterial["PROPERTY_MATERIAL_VALUE"])>0):?>selected<? endif; ?> value="<? echo $arMaterial["PROPERTY_MATERIAL_VALUE"];?>"><?=$arMaterial["PROPERTY_MATERIAL_VALUE"]?></option>
		<?endforeach;?>
	</select>
</form>
</div>
<?endif;?>

	<?/* echo "<p>Total items ".count($arResult["ITEMS"])."</p>"; // my code*/?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<table cellpadding="0" cellspacing="10" border="0">
		<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
		<?
		if($search_page){ 
			
			$arElement["DETAIL_PAGE_URL"] = $arParams["SECTION_URL"].getElementUrl($arElement["IBLOCK_ID"], $arElement["ID"]);
		}
		?>
		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
		<tr align="center">
		<?endif?>

		<td valign="top" width="<?=round(100/$arParams["LINE_ELEMENT_COUNT"])?>%" id="<?=$this->GetEditAreaId($arElement['ID']);?>">

			<table cellpadding="15" cellspacing="5" border="0" >
				<tr>
					<?if(is_array($arElement["PREVIEW_PICTURE"]) || is_array($arElement["DETAIL_PICTURE"])):?>
						<td class="item-photo">
							<a name="<?=$arElement["ID"]?>" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["DETAIL_PICTURE"]["SRC"]?>" width="135" height="auto" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a><br />
						</td>
					<?else:?>
						<td class="item-photo">
							<a name="<?=$arElement["ID"]?>" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="/bitrix/templates/tvk-retail/images/no-photo.jpg" width="135" height="105" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" /></a><br />
						</td>
					<?endif;?>
</tr><tr>
				<td valign="top" align="center"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a><br />
					<small><?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
						<?=$arProperty["NAME"]?>:<br><?
							if(is_array($arProperty["DISPLAY_VALUE"]))
								echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
							else
								echo $arProperty["DISPLAY_VALUE"];?><br />
						<?endforeach;?></small>
					</td>
				</tr>
			</table>
		</td>

		<?$cell++;
		if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
			</tr>
		<?endif;?>

		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>

		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
			<?while(($cell++)%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
				<td>&nbsp;</td>
			<?endwhile;?>
			</tr>
		<?endif?>

</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>