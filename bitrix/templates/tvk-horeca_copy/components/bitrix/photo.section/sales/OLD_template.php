<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="sales-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<table cellpadding="0" cellspacing="0" border="0" >
	<?foreach($arResult["ROWS"] as $arItems):?>
		<tr>
			<td style="padding-right: 5px;"><a class="left-arrow" href="#"><br></a></td>
		<?foreach($arItems as $arItem):?>
			<?if(is_array($arItem)):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BPS_ELEMENT_DELETE_CONFIRM')));
				?>
				<td width="<?=$arResult["TD_WIDTH"]?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" valign="top">
<div style="position: relative;">					
					<?if($arResult["USER_HAVE_ACCESS"]):?>
						<?if(is_array($arItem["PICTURE"])):?>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arItem["PICTURE"]["SRC"]?>" width="<?=$arItem["PICTURE"]["WIDTH"]?>" height="<?=$arItem["PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
						<?endif?>
					<?else:?>
						<?if(is_array($arItem["PICTURE"])):?>
							<img border="0" src="<?=$arItem["PICTURE"]["SRC"]?>" width="<?=$arItem["PICTURE"]["WIDTH"]?>" height="<?=$arItem["PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						<?endif?>
					<?endif?>
<div class="sale-size">
<?foreach($arItem["DISPLAY_PROPERTIES"] as $arProperty):?>
						<?
							if(is_array($arProperty["DISPLAY_VALUE"]))
								echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
							else
								echo $arProperty["DISPLAY_VALUE"];?>
					<?endforeach?>
</div>
</div>
				</td>
			<?else:?>
				<td width="<?=$arResult["TD_WIDTH"]?>" rowspan="<?=$arResult["nRowsPerItem"]?>" valign="top">
					<div class="sale-size">
<?foreach($arItem["DISPLAY_PROPERTIES"] as $arProperty):?>
						<?
							if(is_array($arProperty["DISPLAY_VALUE"]))
								echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
							else
								echo $arProperty["DISPLAY_VALUE"];?>
					<?endforeach?>
</div>
				</td>
			<?endif;?>
		<?endforeach?>
		<td style="padding-right: 5px;"><a class="right-arrow" href="#"><br></a></td> 
		</tr>
<!--
		<tr class="data-row">
		<?foreach($arItems as $arItem):?>
			<?if(is_array($arItem)):?>
				<th valign="top" width="<?=$arResult["TD_WIDTH"]?>" class="data-cell">
					&nbsp;
					<?if($arResult["USER_HAVE_ACCESS"]):?>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?><?if($arParams["USE_RATING"] && $arItem["PROPERTIES"]["rating"]["VALUE"]) echo "(".$arItem["PROPERTIES"]["rating"]["VALUE"].")"?></a><br />
					<?else:?>
						<?=$arItem["NAME"]?><?if($arParams["USE_RATING"] && $arItem["PROPERTIES"]["rating"]["VALUE"]) echo "(".$arItem["PROPERTIES"]["rating"]["VALUE"].")"?><br />
					<?endif?>
				</th>
			<?endif;?>
		<?endforeach?>
		</tr>

		<?if($arResult["bDisplayFields"]):?>
		<tr>
		<?foreach($arItems as $arItem):?>
			<?if(is_array($arItem)):?>
				<th valign="top" width="<?=$arResult["TD_WIDTH"]?>" class="data-cell">
					<?foreach($arParams["FIELD_CODE"] as $code):?>
						<small><?=GetMessage("IBLOCK_FIELD_".$code)?>&nbsp;:&nbsp;<?=$arItem[$code]?></small><br />
					<?endforeach?>
					<?foreach($arItem["DISPLAY_PROPERTIES"] as $arProperty):?>
						<small><?=$arProperty["NAME"]?>:&nbsp;<?
							if(is_array($arProperty["DISPLAY_VALUE"]))
								echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
							else
								echo $arProperty["DISPLAY_VALUE"];?></small><br />
					<?endforeach?>
				</th>
			<?endif;?>
		<?endforeach?>
		</tr>
-->
		<?endif;?>
	<?endforeach?>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>