<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode( true ); ?>
<div class="brands_slider_wrapp">
	<ul class="brands_slider">
		<?foreach($arResult["ITEMS"] as $arItem){?>
			<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<?if( is_array($arItem["PREVIEW_PICTURE"]) ){?>
				<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
					</a>
				</li>
			<?}?>
		<?}?>
	</ul>
	<div class="brands_slider_navigation absolute"></div>
</div>
<script src="/bitrix//templates/aspro_mshop/components/bitrix/news.list/brands_slider/brands_slider.js"></script>