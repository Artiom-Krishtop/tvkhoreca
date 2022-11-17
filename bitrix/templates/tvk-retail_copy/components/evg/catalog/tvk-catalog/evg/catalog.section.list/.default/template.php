<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="tvk-catalog-section-list">
<table width="100%">
	<tr>
		<td>
<?
$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
$CURRENT_DEPTH = $TOP_DEPTH;
$first_level = 0;
foreach($arResult["SECTIONS"] as $arSection):
	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
	$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
	if($arSection["DEPTH_LEVEL"] == 1){
		$first_level ++;
	}
	
	if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
		echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH),"<ul>";
	elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
		echo "</li>";
	else
	{
		while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
		{
			echo "</li>";
			echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
			$CURRENT_DEPTH--;
		}
		echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</li>";

		if($first_level == 6){
			?></ul></td><td><ul><?
		}		
	}

	echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);
	?><li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?></a><?

	$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
	

	
endforeach;

while($CURRENT_DEPTH > $TOP_DEPTH)
{
	echo "</li>";
	echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
	$CURRENT_DEPTH--;
}
?>		
		</td>
	</tr>
</table>

</div>