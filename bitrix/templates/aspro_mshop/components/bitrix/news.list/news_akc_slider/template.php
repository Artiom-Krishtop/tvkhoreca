<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode( true ); ?>
<?if($arResult["ITEMS"]){?>
	<div class="news_akc_block news untnews">
		<div class="top_block">
			<?
			$title_block=($arParams["TITLE_BLOCK"] ? $arParams["TITLE_BLOCK"] : GetMessage('AKC_TITLE'));
			$url=($arParams["ALL_URL"] ? $arParams["ALL_URL"] : "/info/stock/");
			$count=ceil(count($arResult["ITEMS"])/4);
			?>
			<div class="title_block"><?=$title_block;?></div>
			<a href="<?=SITE_DIR.$url;?>"><?=GetMessage('ALL_AKC')?></a>
		</div>
		<div class="news_slider_navigation untnews_slider_navigation slider_navigation top"></div>
		<div class="news_slider_wrapp untnews_slider_wrapp">
			<ul class="news_slider wr">
				<?foreach($arResult["ITEMS"] as $arItem){
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					$img_source='';
					?>
					<li id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="item">
						<?if($arItem["DETAIL_PICTURE"]){
							$img_source=$arItem["DETAIL_PICTURE"];
						}elseif($arItem["PREVIEW_PICTURE"]){
							$img_source=$arItem["PREVIEW_PICTURE"];
						}?>
						<?if($img_source){?>
							<div class="img">
								<?$img = CFile::ResizeImageGet($img_source, array("width" => 268, "height" => 166), BX_RESIZE_IMAGE_EXACT, true, false, false, 80 );?>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
									<img src="<?=$img["src"]?>" alt="<?=$arItem["NAME"];?>" title="<?=$arItem["NAME"];?>" />
								</a>
							</div>
						<?}?>
						<div class="info">
							<div class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
							<a class="name" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
							<div class="preview"><?=$arItem['PREVIEW_TEXT'];?></div>
						</div>
					</li>
				<?}?>
			</ul>
		</div>
	</div>
	
<?}?>
<script src="/bitrix/templates/aspro_mshop/components/bitrix/news.list/news_akc_slider/news_akc_slider.js" ></script>