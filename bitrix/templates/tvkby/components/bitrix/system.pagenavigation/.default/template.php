<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if( $arResult["NavPageCount"] != 1 && empty( $arResult["bShowAll"] ) ){
	?>
	<?
	$headNavString = "";
	if($arResult["NavPageNomer"]==1 && $arResult["NavPageCount"]>1){
		$headNavString .= '<link rel="next" href="'.$arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1).'" />';
	}elseif($arResult["NavPageNomer"]==$arResult["NavPageCount"] && $arResult["NavPageCount"]>1){
		$headNavString .= '<link rel="prev" href="'.$arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1).'" />';
	}else{
			if($arResult["NavPageNomer"]!=2){
				$headNavString .= '<link rel="prev" href="'.$arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1).'" />';
			}else{
				$headNavString .= '<link rel="prev" href="'.$arResult["sUrlPath"].'" />';
			}
		$headNavString .= '<link rel="next" href="'.$arResult["sUrlPath"].'?'.$strNavQueryString.'PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1).'" />';
	}
	$APPLICATION->AddHeadString($headNavString); 
	
	?>
	<?
	$count_item = 5; // Количество выводимых страниц по бокам
	$arResult["nStartPage"] = $arResult["NavPageNomer"] - $count_item;
	$arResult["nStartPage"] = $arResult["nStartPage"] <= 0 ? 1 : $arResult["nStartPage"];
	
	$arResult["nEndPage"] = $arResult["NavPageNomer"] + $count_item;
	$arResult["nEndPage"] = $arResult["nEndPage"] > $arResult["NavPageCount"] ? $arResult["NavPageCount"] : $arResult["nEndPage"];
	
	$strNavQueryString = !empty( $arResult["NavQueryString"] ) ? $arResult["NavQueryString"].'&amp;' : '';
	$strNavQueryStringFull = !empty( $arResult["NavQueryString"] ) ? "?".$arResult["NavQueryString"] : '';?>
	<div class="wrap_pagination">
		<ul class="pagination">
			<?if( $arResult["NavPageNomer"] > 1 ){?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><i class="icon icon-chevron-left"></i></a></li>
			<?}
			if( $arResult["nStartPage"] > 1 ){
				echo "<li><span>...</span></li>";
			}
			while( $arResult["nStartPage"] <= $arResult["nEndPage"] ){
				if( $arResult["nStartPage"] == $arResult["NavPageNomer"] ){?>
					<li class="active"><span><?=$arResult["nStartPage"]?></span></li>
				<?}elseif( $arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false ){?>
					<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
				<?}else{?>
					<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li>
				<?}
				$arResult["nStartPage"]++;
			}
			if( $arResult["nEndPage"] < $arResult["NavPageCount"] ){
				echo "<li><span>...</span></li>";
			}
			if( $arResult["NavPageNomer"] < $arResult["NavPageCount"] ){?>
				<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><i class="icon icon-chevron-right"></i></a></li>
			<?}?>
		</ul>
	</div>
<?}?>