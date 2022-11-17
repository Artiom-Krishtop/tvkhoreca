<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?$curpage = $APPLICATION->GetCurUri();?>

<? //show($arResult["SECTIONS"])?>

<ul id="vertical-menu" name="horeca_copy">

<?
$count = 0;
foreach($arResult["SECTIONS"] as $arSection):
?>

	<?//xmp($arSection)?>
	
<li>
<a href="<?=$arSection["SECTION_PAGE_URL"]?>" 
	class="<?if (substr_count($curpage, strtolower($arSection["CODE"]))>0):?>
	root-item-selected<?else:?>root-item<?endif?>"><?=$arSection["NAME"]?></a>



<?if(count($arSection["SUBSECTIONS"])>0):?>
				<ul>		
					<?foreach ($arSection["SUBSECTIONS"] as $subSection):?>
					<li><a <?if($_REQUEST["class"] == $subSection["ID"]):?>class="item-selected"<?endif;?> href="<?=$arSection["SECTION_PAGE_URL"]?>list/?class=<?=$subSection["ID"]?>"><?=$subSection["NAME"]?></a></li>
					<?endforeach;?>
				</ul>
<?endif;?>				
</li>	
	
<? $count++; ?>
<?endforeach?>
</ul>

<? /*show($arResult["SECTIONS_COUNT"]); 
echo "<p>".$count."</p>";*/?>

<?/*?>
<!--
<div id="vertical-menu">
<ul>
<?
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	if($CURRENT_DEPTH<$arSection["DEPTH_LEVEL"])
		echo "<ul>";
	elseif($CURRENT_DEPTH>$arSection["DEPTH_LEVEL"])
		echo str_repeat("</ul>", $CURRENT_DEPTH - $arSection["DEPTH_LEVEL"]);
	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
?>
	<li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?></a></li>
<?endforeach?>
</ul>
</div>
-->
<?*/?>