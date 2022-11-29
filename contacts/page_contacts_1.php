<?
$bUseMap = CMax::GetFrontParametrValue('CONTACTS_USE_MAP', SITE_ID) != 'N';
$bUseFeedback = CMax::GetFrontParametrValue('CONTACTS_USE_FEEDBACK', SITE_ID) != 'N';
$showMap = $bUseMap;?>

<?CMax::ShowPageType('page_title');?>

<div class="wrapper_inner_half row flexbox shop-detail1 clearfix" itemscope itemtype="http://schema.org/Organization">
	<div class="col-md-12 col-sm-12 b-top-adress">
		<?CMax::showContactAddr('Компания «ТВК» находится по адресу:', false);?>
	</div>
	<?if($showMap):?>
		<div class="item col-md-12 map-full padding0">
			<div class="right_block_store contacts_map">
				<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-map.php", Array(), Array("MODE" => "html", "TEMPLATE" => "include_area.php", "NAME" => "Карта"));?>
			</div>
		</div>
	<?endif;?>
	<div class="col-md-4 b-company-info">
		<div class="left_block_store">
			<div class="top_block">
				<?CMax::showContactImg();?>
				
				<?if($arPhotos):?>
					<!-- noindex-->
					<div class="gallery_wrap swipeignore">
						<?//gallery?>
						<div class="big-gallery-block text-center">
						    <div class="owl-carousel owl-theme owl-bg-nav short-nav" data-slider="content-detail-gallery__slider" data-plugin-options='{"items": "1", "autoplay" : false, "autoplayTimeout" : "3000", "smartSpeed":1000, "dots": true, "nav": true, "loop": false, "rewind":true, "margin": 10}'>
							<?foreach($arPhotos as $i => $arPhoto):?>
							    <div class="item">
								<a href="<?=$arPhoto['ORIGINAL']?>" class="fancy" data-fancybox="item_slider" target="_blank" title="<?=$arPhoto['DESCRIPTION']?>">
									<img data-src="<?=$arPhoto['PREVIEW']['src']?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($arPhoto['PREVIEW']['src']);?>" class="img-responsive inline lazy" alt="<?=$arPhoto['DESCRIPTION']?>" />
								</a>
							    </div>
							<?endforeach;?>
						    </div>
						</div>
					</div>
					<!-- /noindex-->
				<?endif;?>
			</div>
			<div class="bottom_block">
				<div class="properties clearfix">
					<div class="col-md-12 col-sm-12">
						<div class="property phone">
							<div class="title font_upper muted">
								Телефоны:
							</div>
							<div class="value darken" itemprop="telephone">
								<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-phone.php", Array(), Array("MODE" => "html", "NAME" => "Телефон"));?>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="property phone">
							<div class="title font_upper muted">
								Email:
							</div>
							<div class="value darken" itemprop="email">
								<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-email.php", Array(), Array("MODE" => "html", "NAME" => "Email"));?>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-12">
						<div class="property phone">
							<div class="title font_upper muted">
								Режим работы:
							</div>
							<div class="value darken">
								<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-schedule.php", Array(), Array("MODE" => "html", "NAME" => "Время работы"));?>
							</div>
						</div>
					</div>
				</div>
				<div class="social-block">
					<div class="wrap">
						<?$APPLICATION->IncludeComponent(
						    "aspro:social.info.max",
						    ".default",
						    array(
						        "CACHE_TYPE" => "A",
						        "CACHE_TIME" => "3600000",
						        "CACHE_GROUPS" => "N",
						        "TITLE_BLOCK" => "",
						        "COMPONENT_TEMPLATE" => ".default",
						    ),
						    false, array("HIDE_ICONS" => "Y")
						);?>
					</div>
				</div>
			</div>
			<div class="clearboth"></div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="wrap">
			<blockquote>
				<?CMax::showContactDesc();?>
			</blockquote>
		</div>
		<? $APPLICATION->IncludeComponent(
			"bitrix:form",
			"inline",
			Array(
				"AJAX_MODE" => "Y",
				"SEF_MODE" => "N",
				"WEB_FORM_ID" => 'FEEDBACK',
				"START_PAGE" => "new",
				"SHOW_LIST_PAGE" => "N",
				"SHOW_EDIT_PAGE" => "N",
				"SHOW_VIEW_PAGE" => "N",
				"SUCCESS_URL" => "",
				"SHOW_ANSWER_VALUE" => "N",
				"SHOW_ADDITIONAL" => "N",
				"SHOW_STATUS" => "N",
				"EDIT_ADDITIONAL" => "N",
				"EDIT_STATUS" => "Y",
				"HIDE_SUCCESS" => "Y",
				"NOT_SHOW_FILTER" => "",
				"NOT_SHOW_TABLE" => "",
				"CHAIN_ITEM_TEXT" => "",
				"CHAIN_ITEM_LINK" => "",
				"IGNORE_CUSTOM_TEMPLATE" => "N",
				"USE_EXTENDED_ERRORS" => "Y",
				"CACHE_GROUPS" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600000",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"SHOW_LICENCE" => CMax::GetFrontParametrValue('SHOW_LICENCE'),
				"HIDDEN_CAPTCHA" => CMax::GetFrontParametrValue('HIDDEN_CAPTCHA'),
				"AJAX_OPTION_HISTORY" => "N",
				"VARIABLE_ALIASES" => Array(
					"action" => "action"
				)
			)
		);?>
	</div>
	<?//hidden text for validate microdata?>
	<div class="hidden">
		<?global $arSite;?>
		<span itemprop="name"><?=$arSite["NAME"];?></span>
	</div>
</div>
<div class="row b-company-staff">
	<div class="col-md-12">
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list", 
			"staff_block", 
			array(
				"SHOW_SECTION_NAME" => "Y", 
				"SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
				"SHOW_DETAIL_LINK" => "N",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "Y",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"COMPONENT_TEMPLATE" => "staff",
				"COMPOSITE_FRAME_MODE" => "A",
				"COMPOSITE_FRAME_TYPE" => "AUTO",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(
					0 => "NAME",
					1 => "PREVIEW_PICTURE",
					2 => "",
				),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "103",
				"IBLOCK_TYPE" => "aspro_max_content",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "1000",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "",
				"PAGER_TITLE" => "",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "EMAIL",
					1 => "POST",
					2 => "PHONE",
					3 => "",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "SORT",
				"SORT_BY2" => "NAME",
				"SORT_ORDER1" => "ASC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N"
			),
			false
		);?>
	</div>
</div>
