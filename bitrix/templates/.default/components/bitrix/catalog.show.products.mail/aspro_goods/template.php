<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Main\Localization\Loc;

$skuTemplate = array();
?>
<? if(!empty($arResult['ITEMS'])):?>
	<div class="products_block" style="font-size:0px;margin:20px 0px 0px;text-align:left;border-top:1px solid #dedede;padding-top:8px;">
		<div style="color:#1d2029;font-size:18px;padding: 22px 0px 18px;font-weight:600;"><?=($arParams["TITLE"] ? $arParams["TITLE"] : GetMessage("PRODUCTS_TITLE") );?></div>
		<?$i = 1;?>
		<div style="text-align: center;">
			<?foreach($arResult['ITEMS'] as $arItem):?>
				<div class="item" style="display: inline-block;vertical-align: top;font-size: 0px;width: 100%;max-width: 179px;color: #000;box-sizing: border-box;padding: 0px 7px 0px 7px;margin: 0px 0px 59px;margin: 14px 0px 0px;white-space: nowrap;">
					<div class="inner-wrapper" style="border:1px solid #e7e7e7;padding:20px 16px 15px;font-size:12px;text-align: center;overflow: hidden;">
						<?if($arItem["PROPERTIES"]["HIT"]){?>
							<div class="stickers" style="position:absolute;">
								<?foreach($arItem["PROPERTIES"]["HIT"]["VALUE_XML_ID"] as $key=>$class){?>
									<div class="sticker_<?=strtolower($class);?>" title="<?=$arItem["PROPERTIES"]["HIT"]["VALUE"][$key]?>"></div>
								<?}?>
							</div>
						<?}?>
						<?if($arItem["~PREVIEW_PICTURE"]){
							$img = CFile::ResizeImageGet($arItem["~PREVIEW_PICTURE"], array("width" => 130, "height" => 130), BX_RESIZE_PROPORTIONAL_ALT);
							$src= str_replace(array("//", ":/"), array("/", "://"), $arParams["SITE_ADDRESS"].$img["src"]);?>
							<a class="name" href="<?=$arItem["DETAIL_PAGE_URL"];?>">
								<div class="img" style="overflow:hidden;height:100px;line-height:97px;text-align:center;margin: 0px 0px 10px 0px;white-space:normal;font-size: 12px;">
									<img src="<?=$src;?>" alt="<?=$arItem["NAME"];?>" title="<?=$arItem["NAME"];?>" style="display: inline-block;max-height: 100%;max-width: 100%;vertical-align:middle;"/>
								</div>
							</a>
						<?}?>
						<div class="title" style="white-space: normal;font-size: 13px;height:37px;overflow:hidden;">
							<a class="name" href="<?=$arItem["DETAIL_PAGE_URL"];?>" style="color:<?=$arParams["THEME_COLOR"]?>"><?=$arItem["NAME"];?></a>
						</div>
						<?if($arItem["MIN_PRICE"]):?>
							<div class="prices">
								<?if( $arItem["MIN_PRICE"]["DISCOUNT_VALUE"] && (!$arItem["MIN_PRICE"]["DISCOUNT_DIFF"] && !$arItem["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"]) || ($arItem["MIN_PRICE"]["DISCOUNT_VALUE"] != $arItem["MIN_PRICE"]["VALUE"]) ):?>
									<div style="color:#1d2029;font-size:15px;font-weight:600;padding: 4px 0px 2px;"><?=$arItem["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"];?></div>
									<?if( ($arItem["MIN_PRICE"]["DISCOUNT_DIFF"] > 0 && $arItem["MIN_PRICE"]["DISCOUNT_DIFF_PERCENT"] > 0) ):?>
										<div style="font-size:13px;color:#555555;text-decoration:line-through;"><?=$arItem["MIN_PRICE"]["PRINT_VALUE"];?></div>
									<?endif;?>
								<?endif;?>
							</div>
						<?endif;?>
					</div>
				</div>
				<?$i++;?>
			<?endforeach;?>
		</div>
		<?if($arParams["SHOW_CATALOG"] == "Y" && $arParams["CATALOG_PAGE"]):?>
			<div style="text-align:center;"><a href="<?=$arParams["CATALOG_PAGE"];?>" style="display:inline-block;font-size:14px;border-radius:3px;margin: 25px 0px 5px;padding: 11px 19px;color:<?=$arParams["THEME_COLOR"]?>;background:#fff;border:1px solid <?=$arParams["THEME_COLOR"]?>;"><?=GetMessage("CATALOG_TITLE");?></a></div>
		<?endif;?>
	</div>	
<? endif ?>