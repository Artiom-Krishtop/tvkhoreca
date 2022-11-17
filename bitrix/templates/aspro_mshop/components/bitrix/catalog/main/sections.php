<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
global $TEMPLATE_OPTIONS;
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"subsections_block_list",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"SHOW_SECTIONS_LIST_PREVIEW" => $arParams["SHOW_SECTIONS_LIST_PREVIEW"],
		"SECTIONS_LIST_PREVIEW_PROPERTY" => $arParams["SECTIONS_LIST_PREVIEW_PROPERTY"],
		"SHOW_SECTION_LIST_PICTURES" => $arParams["SHOW_SECTION_LIST_PICTURES"],
	),
	$component
);
?>
<?
$basketAction='';
if($arParams["SHOW_TOP_ELEMENTS"]!="N"){
	if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y'){
		$basketAction = (isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '');
	}else{
		$basketAction = (isset($arParams['TOP_ADD_TO_BASKET_ACTION']) ? $arParams['TOP_ADD_TO_BASKET_ACTION'] : '');
	}
}

$arTab = array();
$IsViewedTypeLocal = $TEMPLATE_OPTIONS['VIEWED_TYPE']['CURRENT_VALUE'] === 'LOCAL';
$arViewedIDs = CMShop::getViewedProducts();
if($arViewedIDs){
	$arTab["VIEWED"] = GetMessage('VIEWED_TITLE');
}
if($arParams['SHOW_TOP_ELEMENTS'] !="N"){
	$arTab["BEST"] = GetMessage('BEST_TITLE');
}
if($arTab){
	$class_block="s_".$this->randString();?>
	<div class="tab_slider_wrapp <?=$class_block;?> best_block">
		<div class="top_blocks">
			<ul class="tabs">
				<?$i=1;
				foreach($arTab as $code=>$title):?>
					<li data-code="<?=$code?>" <?=($i==1 ? "class='cur'" : "")?>><span><?=$title;?></span></li>
					<?$i++;?>
				<?endforeach;?>
				<li class="stretch"></li>
			</ul>
			<ul class="slider_navigation top">
				<?$i=1;
				foreach($arTab as $code=>$title):?>
					<li class="tabs_slider_navigation <?=$code?>_nav <?=($i==1 ? "cur" : "")?>" data-code="<?=$code?>"></li>
					<?$i++;?>
				<?endforeach;?>
			</ul>
		</div>
		<ul class="tabs_content">
			<?foreach($arTab as $code=>$title){?>
				<li class="tab <?=$code?>_wrapp" data-code="<?=$code?>">
					<ul class="tabs_slider <?=$code?>_slides wr">
						<?
						if($code == 'BEST'){
							$GLOBALS[$arParams['FILTER_NAME']] = array('!PROPERTY_HIT' => false);
							if($arParams['TOP_SECTION_ID']){
								$GLOBALS[$arParams['FILTER_NAME']]['SECTION_ID'] = $arParams['TOP_SECTION_ID'];
								$GLOBALS[$arParams['FILTER_NAME']]['INCLUDE_SUBSECTIONS'] = 'Y';
							}
						}
						else{
							if(!$IsViewedTypeLocal){
								$GLOBALS[$arParams['FILTER_NAME']] = array('ID' => $arViewedIDs);
							}
						}
						?>
						<?if($code == "BEST" || !$IsViewedTypeLocal):?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:catalog.top",
								"main",
								array(
									"TITLE_BLOCK" => $arParams["SECTION_TOP_BLOCK_TITLE"],
									"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
									"IBLOCK_ID" => $arParams["IBLOCK_ID"],
									"FILTER_NAME" => $arParams["FILTER_NAME"],
									"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
									"ELEMENT_SORT_FIELD" => $arParams["TOP_ELEMENT_SORT_FIELD"],
									"ELEMENT_SORT_ORDER" => $arParams["TOP_ELEMENT_SORT_ORDER"],
									"ELEMENT_SORT_FIELD2" => $arParams["TOP_ELEMENT_SORT_FIELD2"],
									"ELEMENT_SORT_ORDER2" => $arParams["TOP_ELEMENT_SORT_ORDER2"],
									"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
									"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
									"BASKET_URL" => $arParams["BASKET_URL"],
									"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
									"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
									"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
									"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
									"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
									"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
									"ELEMENT_COUNT" => $arParams["ELEMENT_COUNT"],
									"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
									"PROPERTY_CODE" => $arParams["TOP_PROPERTY_CODE"],
									"PRICE_CODE" => $arParams["PRICE_CODE"],
									"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
									"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
									"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
									"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
									"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
									"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
									"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
									"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
									"CACHE_FILTER" => "Y",
									"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
									"OFFERS_FIELD_CODE" => $arParams["TOP_OFFERS_FIELD_CODE"],
									"OFFERS_PROPERTY_CODE" => $arParams["TOP_OFFERS_PROPERTY_CODE"],
									"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
									"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
									"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
									"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
									"OFFERS_LIMIT" => $arParams["TOP_OFFERS_LIMIT"],
									'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
									'CURRENCY_ID' => $arParams['CURRENCY_ID'],
									'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
									'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
									'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
									'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
									'LABEL_PROP' => $arParams['LABEL_PROP'],
									'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
									'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
									'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
									'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
									'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
									'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
									'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
									"DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
									'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
									'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
									'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
									'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
									'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
									'ADD_TO_BASKET_ACTION' => $basketAction,
									'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
									'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
									'IS_VIEWED' => ($code=="VIEWED" ? "Y" : "N"),
								),
								false, array("HIDE_ICONS"=>"Y")
							);?>
						<?else:?>
							<?$APPLICATION->IncludeComponent(
								"aspro:catalog.viewed.market",
								"slider",
								array(
									"TITLE_BLOCK" => GetMessage('VIEWED_TITLE'),
									"VIEW_TYPE_IN_TAB" => "Y",
									"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
									"DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
									"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
									"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
									"SHOW_DISCOUNT_PERCENT" => $arParams["SHOW_DISCOUNT_PERCENT"],
								),
								false, array("HIDE_ICONS" => "Y")
							);?>
						<?endif;?>
					</ul>
				</li>
			<?}?>
		</ul>
	</div>
	<script src="/bitrix/templates/aspro_mshop/components/bitrix/catalog/main/main.js"></script>
<?}?>
<?$this->SetViewTarget('catalog_title');?>
<h1><?=$APPLICATION->ShowTitle(false);?></h1>
<?$this->EndViewTarget();?> 