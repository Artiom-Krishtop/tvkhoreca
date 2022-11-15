<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<? //show($arResult);
ini_set('display_errors', false);
//show($arResult["DISPLAY_PROPERTIES"]["PRODUCER"]["LINK_ELEMENT_VALUE"]);
$val = $arResult["PROPERTIES"]["PRODUCER"]["VALUE"];
//echo $arResult["DISPLAY_PROPERTIES"]["PRODUCER"]["LINK_ELEMENT_VALUE"][$val]["DETAIL_PAGE_URL"];
?>
<div class="catalog detail">
	<div class="row">
		<?if($arResult["GALLERY"]){?>
			<div class="col-md-4 item_slider">
				<ul class="slides">
					<?foreach( $arResult["GALLERY"] as $key => $arPhoto ){?>
						<li id="photo-<?=$key?>" <?=$key == 0 ? 'class="current"' : ''?>>
							<a href="<?=$arPhoto["DETAIL"]["SRC"]?>" target="_blank" alt="<?=($arPhoto["TITLE"]["DESCRIPTION"] ? $arPhoto["TITLE"]["DESCRIPTION"] : $arResult["NAME"])?>" title="<?=($arPhoto["TITLE"]["DESCRIPTION"] ? $arPhoto["TITLE"]["DESCRIPTION"] : $arResult["NAME"])?>" rel="item_slider" class="fancybox">
								<span class="lupa" style="display: none;" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>"></span>
								<img border="0" class="img-responsive inline" src="<?=$arPhoto["PREVIEW"]["src"]?>" alt="<?=($arPhoto["TITLE"]["DESCRIPTION"] ? $arPhoto["TITLE"]["DESCRIPTION"] : $arResult["NAME"])?>" title="<?=($arPhoto["TITLE"]["DESCRIPTION"] ? $arPhoto["TITLE"]["DESCRIPTION"] : $arResult["NAME"])?>" />
							</a>
						</li>
					<?}?>
					<?if( count($arResult["GALLERY"] ) == 0 ){?>
						<li class="current">
							<img border="0" class="img-responsive inline" src="<?=SITE_TEMPLATE_PATH?>/images/noimage.png" alt="<?=($arPhoto["TITLE"]["DESCRIPTION"] ? $arPhoto["TITLE"]["DESCRIPTION"] : $arResult["NAME"])?>" title="<?=($arPhoto["TITLE"]["DESCRIPTION"] ? $arPhoto["TITLE"]["DESCRIPTION"] : $arResult["NAME"])?>" />
						</li>
					<?}?>
				</ul>
				<?if( count($arResult["GALLERY"] ) > 1 ){?>
					<div class="thumbs">
						<div class="row item">
							<?foreach( $arResult["GALLERY"] as $key => $arPhoto ){?>
								<div class="col-md-4 col-sm-3 thumb">
									<div class="item <?=$key == 0 ? 'current' : ''?>">
										<a href="#photo-<?=$key?>">
											<img border="0" src="<?=$arPhoto["THUMB"]["src"]?>" alt="<?=($arPhoto["TITLE"]["DESCRIPTION"] ? $arPhoto["TITLE"]["DESCRIPTION"] : $arResult["NAME"])?>" title="<?=($arPhoto["TITLE"]["DESCRIPTION"] ? $arPhoto["TITLE"]["DESCRIPTION"] : $arResult["NAME"])?>" />
										</a>
									</div>
								
								</div>
							<?}?>
						</div>
					</div>
				<?}?>
			</div>
		<?}?>
		<div class="col-md-<?=($arResult["GALLERY"] ? '5' : '9');?> content">
			<div class="section_title"><?=$arResult["SECTION_NAME"]?></div>
			<div class="row prop">
				<?if( $arResult["PROPERTIES"]["ARTICLE"]["VALUE"] ){?>
					<div class="col-md-4 item">
						<?=GetMessage("ARTICLE")?><span><?=$arResult["PROPERTIES"]["ARTICLE"]["VALUE"];?></span>
					</div>
				<?}?>
				<?if( $arResult["PROPERTIES"]["BRAND"]["VALUE"] ){?>
					<div class="col-md-4 <?=( $arResult["PROPERTIES"]["ARTICLE"]["VALUE"] ? 'col-md-offset-4 text-right' : '' );?> item">
						<?=GetMessage("BRAND")?><a href="<?=$arResult["DISPLAY_PROPERTIES"]["PRODUCER"]["LINK_ELEMENT_VALUE"][$val]["DETAIL_PAGE_URL"];?>"><span><?=$arResult["PROPERTIES"]["BRAND"]["VALUE"];?></span></a>
					</div>
				<?}?>
			</div>
			<hr/>
			<?if( $arResult["PROPERTIES"]["STATUS"]["VALUE"] ){?>
				<div class="wrap">
					<?if( $arResult["PROPERTIES"]["STATUS"]["VALUE"] == "В наличии" ){?>
						<span class="label label-instock noradius"><?=$arResult["PROPERTIES"]["STATUS"]["VALUE"];?></span>
					<?}?>
					<?if( $arResult["PROPERTIES"]["STATUS"]["VALUE"] == "Под заказ" ){?>
						<span class="label label-order noradius"><?=$arResult["PROPERTIES"]["STATUS"]["VALUE"];?></span>
					<?}?>
					<?if( $arResult["PROPERTIES"]["STATUS"]["VALUE"] == "Ожидается" ){?>
						<span class="label label-pending noradius"><?=$arResult["PROPERTIES"]["STATUS"]["VALUE"];?></span>
					<?}?>
				</div>
				<hr/>
			<?}?>
			<?/*if( $arResult["PREVIEW_TEXT"] ){?>
				<div class="preview">
					<?=$arResult["PREVIEW_TEXT"];?>
				</div>
<?}*/?>
<?if($arResult["CHARACTERISTICS"] ){?>
			<div class="chars">
				<h4 class="char"><?=GetMessage('T_CHARACTERISTICS')?></h4>
				<div class="char-wrapp">
					<table class="props_table">
						<?foreach( $arResult["CHARACTERISTICS"] as $arProp){?>
							<tr class="char">
								<td class="char_name">
								<?if ($arProp["HINT"]):?><div class="hint"><span class="icons" data-toggle="tooltip" data-placement="top" title="<?=$arProp["HINT"]?>"></span></div><?endif;?>
								<span><?=$arProp["NAME"]?></span></td>
								<td class="char_value">
									<span>
										<?if(count($arProp["DISPLAY_VALUE"])>1) 
											{ foreach($arProp["DISPLAY_VALUE"] as $key => $value) { if ($arProp["DISPLAY_VALUE"][$key+1]) {echo $value.", ";} else {echo $value;} }} 
										else 
											{ echo $arProp["DISPLAY_VALUE"]; }
										?>
									</span>
								</td>
							</tr>
						<?}?>
					</table>
				</div>
			</div>
		<?}?>
		</div>
		<div class="col-md-3">
			<div class="info">
				<?/*<div class="price">
					<div class="price_new"><span class="price_val"><?=$arResult["PROPERTIES"]["PRICE"]["VALUE"]?></span></div>
					<?if( $arResult["PROPERTIES"]["PRICEOLD"]["VALUE"] ){?>
						<div class="price_old"><?=GetMessage("DISCOUNT_PRICE")?> <span class="price_val"><?=$arResult["PROPERTIES"]["PRICEOLD"]["VALUE"]?></span></div>
					<?}?>
				</div>*/?>
				<?if($arResult["PROPERTIES"]["FORM_ORDER"]["VALUE_XML_ID"]=="YES" || $arResult["PROPERTIES"]["FORM_QUESTION"]["VALUE_XML_ID"]=="YES"){?>
					<div class="order">
						<?if($arResult["PROPERTIES"]["FORM_ORDER"]["VALUE_XML_ID"]=="YES"){?>
							<span class="btn btn-primary btn-sm" data-event="jqm" data-param-id="61" data-name="order_product" data-product="<?=$arResult["NAME"]?>"><?=GetMessage("TO_ORDER")?></span>
							<br/>
				<?}?>
						<?if($arResult["PROPERTIES"]["FORM_QUESTION"]["VALUE_XML_ID"]=="YES"){?>
							<span class="btn btn-primary btn-sm" data-event="jqm" data-param-id="64" data-name="question" data-product="<?=$arResult["NAME"]?>"><?=GetMessage("TO_CALL")?></span>
						<?}?>
						<div class="text"><?=GetMessage("MORE_TEXT")?></div>
					</div>
				<?}?>
				<div class="share">
					<div class="text"><?=GetMessage("SHARE_TEXT")?></div>
					<script type="text/javascript" src="//yandex.st/share/share.js"
					charset="utf-8"></script>
					<div class="yashare-auto-init" data-yashareL10n="ru"
					 data-yashareType="none" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir"></div>
				</div>
			</div>
			<!--<div class="info">
					<?$APPLICATION->IncludeComponent("bitrix:photo.random", "", array(
	"IBLOCK_TYPE" => "aspro_allcorp_content",
		"IBLOCKS" => "56",
		"PARENT_SECTION" => "",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "180",
		"CACHE_NOTES" => "",
		"CACHE_GROUPS" => "Y"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>
				<div style="clear: left;"></div>
				</div>-->
			</div>
		</div>
	</div>
	<?if( $arResult["DETAIL_TEXT"] ){?>
		<div class="description">
			<?=$arResult["DETAIL_TEXT"];?>
		</div>
	<?}?>
	<?if($arResult["PROPERTIES"]["FORM_QUESTION"]["VALUE_XML_ID"]=="YES"){?>
		<div class="styled-block catalog">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-5 valign">
					<span class="btn btn-primary btn-sm" data-event="jqm" data-param-id="64" data-param-captcha="yes" data-name="question" data-product="<?=$arResult["NAME"]?>"><span><?=GetMessage("TO_CALL")?></span></span>
				</div>
				<div class="col-md-9 col-sm-9 col-xs-7 valign">
					<div class="right">
						<?$APPLICATION->IncludeComponent(
							 "bitrix:main.include",
							 "",
							 Array(
								  "AREA_FILE_SHOW" => "file",
								 "PATH" => "/include/ask_services.php",
								  "EDIT_TEMPLATE" => ""
							 )
						);?>
					</div>
				</div>
			</div>
		</div>
	<?}?>
	<div class="row">
		<?/*if($arResult["CHARACTERISTICS"] ){?>
			<div class="col-md-6 chars">
				<h4 class="char"><?=GetMessage('T_CHARACTERISTICS')?></h4>
				<div class="char-wrapp">
					<table class="props_table">
						<?foreach( $arResult["CHARACTERISTICS"] as $arProp){?>
							<tr class="char">
								<td class="char_name">
								<?if ($arProp["HINT"]):?><div class="hint"><span class="icons" data-toggle="tooltip" data-placement="top" title="<?=$arProp["HINT"]?>"></span></div><?endif;?>
								<span><?=$arProp["NAME"]?></span></td>
								<td class="char_value">
									<span>
										<?if(count($arProp["DISPLAY_VALUE"])>1) 
											{ foreach($arProp["DISPLAY_VALUE"] as $key => $value) { if ($arProp["DISPLAY_VALUE"][$key+1]) {echo $value.", ";} else {echo $value;} }} 
										else 
											{ echo $arProp["DISPLAY_VALUE"]; }
										?>
									</span>
								</td>
							</tr>
						<?}?>
					</table>
				</div>
			</div>
<?}*/?>
		<?if($arResult["PROPERTIES"]["DOCUMENTS"]["VALUE"]){?>
			<div class="col-md-12 docs">
				<h4 class="char"><?=GetMessage('T_DOCS')?></h4>
				<?foreach( $arResult["PROPERTIES"]["DOCUMENTS"]["VALUE"] as $docID ){?>
					<?$arItem = aspro::get_file_info($docID);?>
					<div class="<?=$arItem["TYPE"]?>">
						<?$FileName = substr($arItem["ORIGINAL_NAME"], 0, strrpos($arItem["ORIGINAL_NAME"], '.'));?>
						<a href="<?=$arItem["SRC"]?>" target="_blank"><?if($arItem["DESCRIPTION"]){echo $arItem["DESCRIPTION"];} else {echo $FileName;}?></a>
						<?=GetMessage('CT_NAME_SIZE')?>:
						<?=aspro::filesize_format($arItem["FILE_SIZE"]);?>
					</div>
			<?}?>
			</div>
		<?}?>
	</div>
	<?if($arResult["PROJECTS"]["ITEMS"]){?>
		<div class="wraps nomargin">
			<div class="row projects">
				<div class="col-md-12"><h4><?=GetMessage("T_PROJECTS")?></h4></div>
				<?foreach($arResult["PROJECTS"]["ITEMS"] as $arProject){?>
					<div class="col-md-3 col-sm-4 projects">
						<div class="item">
							<?$src=($arProject["DETAIL"]['SRC'] ? $arProject["DETAIL"]['SRC'] : $arProject["PREVIEW"]['src']);?>
							<a href="<?=$arProject["DETAIL_PAGE_URL"]?>" class="fancybox" rel="gallery" title="<?=($arProject["DETAIL"]['DESCRIPTION'] ? $arProject["DETAIL"]['DESCRIPTION'] : $arProject["NAME"])?>">
								<?$previewSRC = $arProject["PREVIEW"]['src'] ? $arProject["PREVIEW"]['src'] : SITE_TEMPLATE_PATH."/images/noimage.png";?>
								<img src="<?=$previewSRC ?>" class="img-responsive inline <?=(!$arProject["PREVIEW"]['src'] ? "noimage" : "")?>" alt="<?=($arProject["DETAIL"]['DESCRIPTION'] ? $arProject["DETAIL"]['DESCRIPTION'] : $arProject["NAME"])?>"/>
								<div class="projects">
									<span class="icons"></span>
									<div class="title"><?=($arProject["DETAIL"]['DESCRIPTION'] ? $arProject["DETAIL"]['DESCRIPTION'] : $arProject["NAME"])?></div>
									<?if($arProject["PREVIEW_TEXT"]){?>
										<div class="preview_text"><?=$arProject["PREVIEW_TEXT"];?></div>
									<?}?>
								</div>
							</a>
						</div>
					</div>
				<?}?>
			</div>
		</div>
	<?}?>
</div>