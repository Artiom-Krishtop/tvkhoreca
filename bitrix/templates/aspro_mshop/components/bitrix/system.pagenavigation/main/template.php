<?$this->setFrameMode(true);?>
<?if($arResult["NavPageCount"] > 1):?>
	<?
	$count_item = 2;
	$arResult["nStartPage"] = $arResult["NavPageNomer"] - $count_item;
	$arResult["nStartPage"] = $arResult["nStartPage"] <= 0 ? 1 : $arResult["nStartPage"];
	$arResult["nEndPage"] = $arResult["NavPageNomer"] + $count_item;
	$arResult["nEndPage"] = $arResult["nEndPage"] > $arResult["NavPageCount"] ? $arResult["NavPageCount"] : $arResult["nEndPage"];
	$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
	$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
	if($arResult["NavPageNomer"] == 1){
		$bPrevDisabled = true;
	}
	elseif($arResult["NavPageNomer"] < $arResult["NavPageCount"]){
		$bPrevDisabled = false;
	}
	if($arResult["NavPageNomer"] == $arResult["NavPageCount"]){
		$bNextDisabled = true;
	}
	else{
		$bNextDisabled = false;
	}
	?>
	<?if(!$bNextDisabled){?>
		<div class="ajax_load_btn">
			<span class="more_text_ajax"><?=GetMessage('PAGER_SHOW_MORE')?></span>
		</div>
	<?}?>
	<div class="module-pagination">
		<ul class="flex-direction-nav">
			<?if(!$bPrevDisabled){?><li class="flex-nav-prev <?if($bPrevDisabled){echo " disabled";}?>"><a href="<?=$arResult["sUrlPath"]?><?if(($arResult["NavPageNomer"]-1)!=1){?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?><?}?>" class="flex-prev"></a></li><?}?>
			<?if(!$bNextDisabled){?><li class="flex-nav-next <?if($bNextDisabled){echo " disabled";}?>"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="flex-next"></a></li><?}?>
		</ul>
		<span class="nums">
			<?if($arResult["nStartPage"] > 1):?>
				<a href="<?=$arResult["sUrlPath"]?>">1</a>
				<?if($arResult["nStartPage"] > 3):?>
					<span class='point_sep'></span>
				<?elseif($arResult["nEndPage"]!=4 && $arResult["nStartPage"]>2):?>
					<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$count_item?>"><?=$count_item?></a>
				<?endif;?>
			<?endif;?>
			<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
				<?if($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
					<span class="cur"><?=$arResult["nStartPage"]?></span>
				<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
					<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
				<?else:?>
					<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
				<?endif;?>
				<?$arResult["nStartPage"]++;?>
			<?endwhile;?>
			<?if($arResult["nEndPage"] < $arResult["NavPageCount"]):?>
				<?if($arResult["nEndPage"] < $arResult["NavPageCount"]-1):?>
					<span class='point_sep'></span>
				<?endif;?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a>
			<?endif;?>
		</span>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".module-pagination span.nums a").live("click", function(){
				if(!$(this).is(".cur")){
					$(".module-pagination span.nums a").removeClass("cur");
					$(this).addClass("cur");
				}
			});
			$(".module-pagination .next").live("click", function(){
				if(!$(this).is(".disabled")){
					element = $(".module-pagination span.nums a.cur");
					$(".module-pagination span.nums a").removeClass("cur");
					element.next("span.nums a").addClass("cur");
				}
			});
			$(".module-pagination .prev").live("click", function(){
				if(!$(this).is(".disabled")){
					element = $(".module-pagination span.nums a.cur");
					$(".module-pagination span.nums a").removeClass("cur");
					element.prev("span.nums a").addClass("cur");
				}
			});
		});
	</script>
<?endif;?>