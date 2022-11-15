<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div class="catalog-element">
	<? /*if(CModule::IncludeModule("iblock"))
{
echo "<h1>We are in IncludeModule</h1>";
	// $arProducers = GetIBlockSection(5, "producers");
$arP = GetIBlockElementList(5, 0, Array("SORT"=>"ASC"), 30);

	//echo $arProducers["IBLOCK_NAME"];
	print_r($arP);
	while($p = $arP->GetNext())
	{
		//echo "<h1>".$p["ID"] ."</h1>"; // it works
		if($p["ID"] == $arResult["PROPERTIES"]["producer"]["VALUE"]) {
//echo "<p>".$p["NAME"]."</p>";  // it works
			echo "<p>".$arResult["PROPERTIES"]["producer"]["NAME"].": ".$p["NAME"]."</p>";
		}

}
echo "<p>Uknown producer</p>";
}*/
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr>
			<?/***** Picture output *****/?>
		<?if(is_array($arResult["PREVIEW_PICTURE"]) || is_array($arResult["DETAIL_PICTURE"])):?>
			<td width="0%" valign="top">
				<?if(is_array($arResult["PREVIEW_PICTURE"]) && is_array($arResult["DETAIL_PICTURE"])):?>
					<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" id="image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>" style="display:block;cursor:pointer;cursor: hand;" OnClick="document.getElementById('image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>').style.display='none';document.getElementById('image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>').style.display='block'" />
					<img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" id="image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>" style="display:none;cursor:pointer; cursor: hand;" OnClick="document.getElementById('image_<?=$arResult["DETAIL_PICTURE"]["ID"]?>').style.display='none';document.getElementById('image_<?=$arResult["PREVIEW_PICTURE"]["ID"]?>').style.display='block'" />
				<?elseif(is_array($arResult["DETAIL_PICTURE"])):?>
					<img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
				<?elseif(is_array($arResult["PREVIEW_PICTURE"])):?>
					<img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
				<?endif?>
				<?if(count($arResult["MORE_PHOTO"])>0):?>
					<br /><a href="#more_photo"><?=GetMessage("CATALOG_MORE_PHOTO")?></a>
				<?endif;?>
			</td>

		<?endif;?>
<td>
<?echo "<p>".$arResult["PROPERTIES"]["item_type"]["NAME"].": "
.$arResult["PROPERTIES"]["item_type"]["VALUE"]."</p>"?>

<?echo "<p>".$arResult["PROPERTIES"]["item"]["NAME"].": "
.$arResult["PROPERTIES"]["item"]["VALUE"]."</p>"?>

<?echo "<p>".$arResult["PROPERTIES"]["material"]["NAME"].": "
.$arResult["PROPERTIES"]["material"]["VALUE"]."</p>"?>

<?echo "<p>".$arResult["PROPERTIES"]["series"]["NAME"].": "
.$arResult["PROPERTIES"]["series"]["VALUE"]."</p>"?>


<? if(CModule::IncludeModule("iblock"))
{
$arP = GetIBlockElementList(5, 0, Array("SORT"=>"ASC"), 30);
$prID = 0;
$prNAME = "";
	//print_r($arP);
	while($p = $arP->GetNext())
	{
		if($p["ID"] == $arResult["PROPERTIES"]["producer"]["VALUE"])
			//echo "<p>".$p["NAME"]."</p>";
			//echo "<p>".$arResult["PROPERTIES"]["producer"]["NAME"].": ".$p["NAME"]."</p>";
			$prID = $p["ID"];
			$prNAME = $p["NAME"];
	}
if ($prID != 0)
	echo "<p>".$arResult["PROPERTIES"]["producer"]["NAME"].": ".$prNAME."</p>";
else
	echo "<p>".$arResult["PROPERTIES"]["producer"]["NAME"].": неизвестен</p>";
}
?>

<?/*echo "<p>".$arResult["PROPERTIES"]["producer"]["NAME"].": "
.$arResult["PROPERTIES"]["producer"]["VALUE"]."</p>";*/?>



<?echo "<p>".$arResult["PROPERTIES"]["country"]["NAME"].": "
.$arResult["PROPERTIES"]["country"]["VALUE"]."</p>"?>

<?echo "<p>".$arResult["PROPERTIES"]["quantity"]["NAME"].": "
.$arResult["PROPERTIES"]["quantity"]["VALUE"]."</p>"?>
</td>
	</tr>
	</table>
	<? /*print_r($arResult);*/?>

