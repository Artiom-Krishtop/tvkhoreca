<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if($arResult["ITEMS"]):?>
	<div class="top_slider_wrapp<?if($arParams["HIDE_ACTIONS"]=="Y"):?> no-actions<?endif;?>">
		<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.flexslider-min.js',true)?>
<?if($arParams["HIDE_ACTIONS"]!="Y"):?>
<div class="actions">
	<div class="top_block">
		<div class="title_block">Действующие акции</div>
		<a href="/company/news/">Все акции</a>
	</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_template", 
	array(
		"IBLOCK_TYPE" => "aspro_mshop_content",
		"IBLOCK_ID" => "79",
		"IS_VERTICAL" => $arParams["IS_VERTICAL"],
		"SHOW_FAQ_BLOCK" => $arParams["SHOW_FAQ_BLOCK"],
		"NEWS_COUNT" => "3",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => array(
			0 => "",
			1 => $arParams["LIST_FIELD_CODE"],
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => $arParams["LIST_PROPERTY_CODE"],
			2 => "",
		),
		"DETAIL_URL" => "",
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"PREVIEW_TRUNCATE_LEN" => "100",
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"CHECK_DATES" => "Y",
		"SHOW_BACK_LINK" => $arParams["SHOW_BACK_LINK"],
		"COMPONENT_TEMPLATE" => "main_template",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
</div>
<?endif;?>
		<div class="flexslider">
			<ul class="slides">
				<?foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					$background = is_array($arItem["DETAIL_PICTURE"]) ? $arItem["DETAIL_PICTURE"]["SRC"] : $this->GetFolder()."/images/background.jpg";
					$target = $arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"];
					?>
					<li class="box<?=($arItem["PROPERTIES"]["TEXTCOLOR"]["VALUE_XML_ID"] ? " ".$arItem["PROPERTIES"]["TEXTCOLOR"]["VALUE_XML_ID"] : "");?><?=($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] ? " ".$arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] : " left");?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="background-image: url('<?=$background?>') !important;">
						<?if(!$arItem["PREVIEW_PICTURE"] && !$arItem["PREVIEW_TEXT"] && $arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
							<a class="target" href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?> style="display:block;height:100%">
						<?endif;?>
							<div class="wrapper_inner">	
								<? 
								$position = "center left";
								if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"]){
									if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "left"){
										$position = "center right";
									}elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "right"){
										$position = "center left";
									}elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "center"){
										$position = "center center";
									}elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "image"){
										$position = "center";
									}
								}
								?>
								<table <?if($arItem["PREVIEW_PICTURE"]):?>style="background: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>) <?=$position;?> no-repeat"<?endif;?>>
									<tbody><tr>
										<?if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] != "image"):?>
											<?ob_start();?>
												<td class="text <?=$arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"];?>">							
													<?if($arItem["NAME"]):?>
														<?if($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
															<a href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
														<?endif;?>
														<div class="banner_title"><span><?=strip_tags($arItem["~NAME"], "<br><br/>");?></span></div>
														<?if($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
															</a>
														<?endif;?>
													<?endif;?>
													<?if($arItem["PREVIEW_TEXT"]):?>
														<div class="banner_text"><?=$arItem["PREVIEW_TEXT"];?></div>
													<?endif;?>
													<?if((!empty($arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"]) && !empty($arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"])) || (!empty($arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]) && !empty($arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"]))):?>
														<div class="banner_buttons">
															<?if(trim($arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]) && trim($arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"])):?>
																<a href="<?=$arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"]?>" class="<?=!empty($arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"]) ? $arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"] : "button wide"?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
																	<?=$arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]?>
																</a>
															<?endif;?>
															<?if(!empty($arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"]) && !empty($arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"])):?>
																<a href="<?=$arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"]?>" class="<?=!empty( $arItem["PROPERTIES"]["BUTTON2CLASS"]["VALUE"]) ? $arItem["PROPERTIES"]["BUTTON2CLASS"]["VALUE"] : "button wide grey"?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
																	<?=$arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"]?>
																</a>
															<?endif;?>
														</div>
													<?endif;?>							
												</td>
											<?$text = ob_get_clean();?>
										<?endif;?>
										<?ob_start();?>
											<td class="img" >
												<?if($arItem["PREVIEW_PICTURE"]):?>
													<?if(!empty($arItem["PROPERTIES"]["URL_STRING"]["VALUE"])):?>
														<a href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
													<?endif;?>
													<?if(!empty($arItem["PROPERTIES"]["URL_STRING"]["VALUE"])):?>
														</a>
													<?endif;?>
												<?endif;?>									
											</td>
										<?$image = ob_get_clean();?>
										<? 
										if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"]){
											if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "left"){
												echo $text.$image;
											}
											elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "right"){
												echo $image.$text;
											}
											elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "center"){
												echo $text;
											}
											elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "image"){
												echo $image;
											}
										}
										else{
											echo $text.$image;
										}
										?>
									</tr></tbody>
								</table>
							</div>
						<?if(!$arItem["PREVIEW_PICTURE"] && !$arItem["PREVIEW_TEXT"] && $arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
							</a>
						<?endif;?>
					</li>
				<?endforeach;?>
			</ul>
		</div>
	</div>
<?endif;?>