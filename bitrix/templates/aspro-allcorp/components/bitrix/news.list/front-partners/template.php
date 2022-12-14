<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>

<div class="partners">
	<div class="flexslider unstyled" data-plugin-options='{"animation": "slide", "directionNav": true, "animationLoop": true, "slideshow": true}'>
		<ul class="slides">
			<li>
				<div class="row">
					<?$i = 1;
					foreach( $arResult["ITEMS"] as $key => $arItem ){
						if( !is_array( $arItem["PREVIEW_PICTURE"] ) ) continue;
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
						<div class="col-md-<?=floor( 12 / $arParams["ITEM_IN_BLOCK"] )?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<?$img = CFile::ResizeImageGet( $arItem["PREVIEW_PICTURE"], array('width' => 160, 'height' => 120), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true );?>
							<?if( $arParams["SHOW_LINK"] == "Y" ){?>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
							<?}?>
									<img src="<?=$img["src"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" />
							<?if( $arParams["SHOW_LINK"] == "Y" ){?>
								</a>
							<?}?>
						</div>
						<?if( $i % $arParams["ITEM_IN_BLOCK"] == 0 && $i < count( $arResult["ITEMS"] ) ){?>
								</div>
							</li>
							<li>
								<div class="row">
						<?}
						$i++;
					}?>
				</div>
			</li>
		</ul>
	</div>
</div>