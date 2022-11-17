<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$arParams['TITLE_BLOCK'] = strlen($arParams['TITLE_BLOCK']) ? $arParams['TITLE_BLOCK'] : GetMessage('CATALOG_VIEWED_TITLE');
?>
<!-- noindex -->
<?if(strlen($arResult['ERROR'])):?>
	<?ShowError($arResult['ERROR']);?>
<?else:?>
	<?if($arResult['ITEMS']):?>
		<?if(!($bVIEW_TYPE_IN_TAB = $arParams['VIEW_TYPE_IN_TAB'] !== 'N')):?>
			<?$sliderID = "specials_slider_wrapp_".$this->randString();?>
			<?if(strlen($arParams['TITLE_BLOCK'])):?>
				<div class="top_block">
					<div class="title_block"><?=$arParams['TITLE_BLOCK']?></div>
				</div>
			<?endif;?>
			<div class="common_product wrapper_block top_border1" id="<?=$sliderID?>">
				<ul class="slider_navigation top_big"></ul>
				<div class="all_wrapp">
					<div class="content_inner tab">
						<ul class="specials_slider slides VIEWED_slides wr">
		<?endif;?>
		<?foreach($arResult['ITEMS'] as $arItem):?>
			<?
			$this->AddEditAction($arItem['PRODUCT_ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'));
			$this->AddDeleteAction($arItem['PRODUCT_ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
			?>
			<li class="catalog_item" id="<?=$this->GetEditAreaId($arItem['PRODUCT_ID'])?>" data-id=<?=$arItem['PRODUCT_ID']?> data-picture='<?=str_replace('\'', '"', CUtil::PhpToJSObject($arItem['PICTURE']))?>'></li>
		<?endforeach;?>
		<script type="text/javascript">
		$(document).ready(function() {
			var dieTime = <?=$arResult['DIETIME']?>;
			var lastViewedTime = <?=$arResult['LAST_ACTIVE_FROM']?>;
			var bShowOldPrice = <?=($arParams['SHOW_OLD_PRICE'] !== 'N' ? 'true' : 'false')?>;
			var bShowWishButton = <?=($arParams['DISPLAY_WISH_BUTTONS'] !== 'N' ? 'true' : 'false')?>;
			var bShowCompareButton = <?=($arParams['DISPLAY_COMPARE'] !== 'N' ? 'true' : 'false')?>;
			var bShowMeasure = <?=($arParams['SHOW_MEASURE'] !== 'N' ? 'true' : 'false')?>;
			var bShowDiscountPercent = <?=($arParams['SHOW_DISCOUNT_PERCENT'] !== 'N' ? 'true' : 'false')?>;
			var $viewedSlider = $('ul.VIEWED_slides');

			if($viewedSlider.length){
				// save $.cookie option
				var bCookieJson = $.cookie.json;
				$.cookie.json = true;

				var arViewedLocal = {};
				var arViewedCookie = {};

				try{
					if(typeof BX.localStorage !== 'undefined'){
						var localKey = 'MARKET_VIEWED_ITEMS_<?=SITE_ID?>';
						var cookieParams = {path: '/', expires: 30};
						arViewedLocal = BX.localStorage.get(localKey) ? BX.localStorage.get(localKey) : {};
						arViewedCookie = $.cookie(localKey) ? $.cookie(localKey) : {};

						for(var PRODUCT_ID in arViewedLocal){
							var $item = $viewedSlider.find('li[data-id=' + PRODUCT_ID + ']');
							if($item.length){
								var item = arViewedLocal[PRODUCT_ID];
								var picture = (typeof $item.attr('data-picture') !== 'undefined') ? JSON.parse($item.attr('data-picture')) : {ID: false, SRC: '<?=SITE_TEMPLATE_PATH.'/images/no_photo_medium.png'?>', ALT: item.NAME, TITLE: item.NAME};
								var percent = item.MIN_PRICE ? (Math.round(item.MIN_PRICE.DISCOUNT_DIFF * 100 / item.MIN_PRICE.VALUE)) : false;
								var bIsOffer = (typeof item.IS_OFFER !== 'undefined') ? (item.IS_OFFER === 'Y') : false;
								var bWithOffers = (typeof item.WITH_OFFERS !== 'undefined') ? (item.WITH_OFFERS === 'Y') : false;

								$item.html(
									'<div class="image_wrapper_block">'+
										'<a href="' + item.DETAIL_PAGE_URL + '" class="thumb">'+
											((!bWithOffers && (bShowCompareButton || (bShowWishButton && item.CAN_BUY === 'Y'))) ?
												'<div class="like_icons">'+
													(bShowWishButton && item.CAN_BUY === 'Y' ?
														'<div class="wish_item_button">'+
															'<span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to" data-item="' + item.ID + '"><i></i></span>'+
															'<span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added" style="display:none;" data-item="' + item.ID + '"><i></i></span>'+
														'</div>'
													: '')+
													(bShowCompareButton ?
														'<div class="compare_item_button">'+
															'<span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to" data-iblock="' + item.IBLOCK_ID + '" data-item="' + item.ID + '" ><i></i></span>'+
															'<span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added" style="display: none;" data-iblock="' + item.IBLOCK_ID + '" data-item="' + item.ID + '"><i></i></span>'+
														'</div>'
													: '')+
												'</div>'
											: '')+
											'<img border="0" src="' + picture.SRC + '" alt="' + (picture.ALT.length ? picture.ALT : item.NAME) + '" title="' + (picture.TITLE.length ? picture.ALT : item.NAME) + '" />'+
										'</a>'+
									'</div>'+
									'<div class="item_info">'+
										'<div class="item-title">'+
											'<a href="' + item.DETAIL_PAGE_URL + '"><span>' + item.NAME + '</span></a>'+
										'</div>'+
										'<div class="cost prices clearfix">'+
											(item.MIN_PRICE ?
												((((item.MIN_PRICE.VALUE * 1) > (item.MIN_PRICE.DISCOUNT_VALUE * 1)) && bShowOldPrice) ?
													'<div class="price">' + (bWithOffers ? '<?=GetMessage('CATALOG_FROM')?> ' : '') + item.MIN_PRICE.PRINT_DISCOUNT_VALUE + (bShowMeasure && item.CATALOG_MEASURE_NAME.length ? '/' + item.CATALOG_MEASURE_NAME : '') + '</div>'+
													'<div class="price discount">'+
														'<strike>' + item.MIN_PRICE.PRINT_VALUE + '</strike>'+
													'</div>'+
													(bShowDiscountPercent ?
														'<div class="sale_block">'+
															((percent && (percent < 100)) ?
																'<div class="value">-' + percent +'%</div>'
															: '')+
															'<div class="text"><?=GetMessage('CATALOG_ECONOMY')?> '+ item.MIN_PRICE.PRINT_DISCOUNT_DIFF + '</div>'+
															'<div class="clearfix"></div>'+
														'</div>'
													: '')
												: '<div class="price">' + (bWithOffers ? '<?=GetMessage('CATALOG_FROM')?> ' : '') + item.MIN_PRICE.PRINT_VALUE + (bShowMeasure && item.CATALOG_MEASURE_NAME.length ? '/' + item.CATALOG_MEASURE_NAME : '') + '</div>')
											: '')+
										'</div>'+
										'<div class="buttons_block clearfix" style="display: none; opacity: 1;">'+
											'<a class="button basket read_more" data-item="' + PRODUCT_ID + '" href="' + item.DETAIL_PAGE_URL + '" rel="nofollow"><?=GetMessage('CATALOG_SHOW_MORE')?></a>'+
										'</div>'+
									'</div>'
								);
							}
							else{
								// item not finded
								// may be if it`s new item (it`s detail page), than ACTIVE_FROM > last viewed exists item
								// or it`s old died item and quantity limit
								var ACTIVE_FROM = (typeof arViewedLocal[PRODUCT_ID].ACTIVE_FROM !== 'undefined') ? arViewedLocal[PRODUCT_ID].ACTIVE_FROM : ((typeof arViewedCookie[PRODUCT_ID] !== 'undefined') ? arViewedCookie[PRODUCT_ID][0] : false);
								if(!ACTIVE_FROM || ACTIVE_FROM < lastViewedTime){
									// get actual for save
									var _arViewedLocal = BX.localStorage.get(localKey) ? BX.localStorage.get(localKey) : {};
									var _arViewedCookie = $.cookie(localKey) ? $.cookie(localKey) : {};
									delete _arViewedLocal[PRODUCT_ID];
									delete _arViewedCookie[PRODUCT_ID];
									BX.localStorage.set(localKey, _arViewedLocal, 2592000);  // 30 days
									$.cookie(localKey, _arViewedCookie, cookieParams);
								}
							}
						}
					}

					// remove some items
					$viewedSlider.find('li').each(function() {
						var PRODUCT_ID = (typeof $(this).attr('data-id') !== 'undefined') ? $(this).attr('data-id') : false;
						if(!PRODUCT_ID || (typeof arViewedLocal[PRODUCT_ID] === 'undefined')){
							$(this).remove();
						}
					});

					// if no items than remove slider
					if(!$viewedSlider.find('li').length){
						if($viewedSlider.closest('.detail_footer').length){
							// detail page
							$('.detail_footer').remove();
						}
						else if($viewedSlider.closest('.wrapper_inner').length){
							// index main page
							$viewedSlider.closest('.wrapper_inner').remove();
						}
						else{
							// sections|section page
							var $tabs = $('.tabs li[data-code="VIEWED"]').closest('.tabs');
							$viewedSlider.closest('.tab').remove();
							$('.tabs li[data-code="VIEWED"]').remove();
							if($tabs.find('li').length){
								$tabs.find('li').first().trigger('click');
							}
							else{
								$('.tab_slider_wrapp').remove();
							}
						}
					}
				}
				catch(e){
					console.error(e);
				}
				finally{
					// restore $.cookie option
					$.cookie.json = bCookieJson;
				}
			}

			setBasketAspro();
		});
		</script>
		<?if(!$bVIEW_TYPE_IN_TAB):?>
						</ul>
					</div>
				</div>
				<script type="text/javascript">
				$(document).ready(function(){
					var flexsliderItemWidth = 210;
					var flexsliderItemMargin = 20;
					var sliderWidth = $('#<?=$sliderID?>').outerWidth();
					var flexsliderMinItems = Math.floor(sliderWidth / (flexsliderItemWidth + flexsliderItemMargin));

					$('#<?=$sliderID?> .content_inner').flexslider({
						animation: 'slide',
						selector: '.slides > li',
						slideshow: false,
						animationSpeed: 600,
						directionNav: true,
						controlNav: false,
						pauseOnHover: true,
						animationLoop: true,
						itemWidth: flexsliderItemWidth,
						itemMargin: flexsliderItemMargin,
						minItems: flexsliderMinItems,
						controlsContainer: '#<?=$sliderID?> .slider_navigation',
						start: function(slider){
							slider.find('li').css('opacity', 1);
						}
					});

					$(window).resize(function(){
						var itemsButtonsHeight = $('.wrapper_block#<?=$sliderID;?> .wr > li .buttons_block').height();
						$('.wrapper_block#<?=$sliderID;?> .wr .buttons_block').hide();
						if($('.wrapper_block#<?=$sliderID;?> .all_wrapp .content_inner').attr('data-hover') ==undefined){
							var tabsContentUnhover = ($('.wrapper_block#<?=$sliderID;?> .all_wrapp').height() * 1)+20;
							var tabsContentHover = tabsContentUnhover + itemsButtonsHeight+50;
							$('.wrapper_block#<?=$sliderID;?> .all_wrapp .content_inner').attr('data-unhover', tabsContentUnhover);
							$('.wrapper_block#<?=$sliderID;?> .all_wrapp .content_inner').attr('data-hover', tabsContentHover);
							$('.wrapper_block#<?=$sliderID;?> .all_wrapp').height(tabsContentUnhover);
							$('.wrapper_block#<?=$sliderID;?> .all_wrapp .content_inner').addClass('absolute');
						}
					});
					if($('#<?=$sliderID?> .slider_navigation .flex-disabled').length > 1){
						$('#<?=$sliderID?> .slider_navigation').hide();
					}
					$('.wrapper_block#<?=$sliderID;?> .wr > li').hover(
						function(){
							var tabsContentHover = $(this).closest('.content_inner').attr('data-hover') * 1;
							$(this).closest('.content_inner').fadeTo(100, 1);
							$(this).closest('.content_inner').stop().css({'height': tabsContentHover});
							$(this).find('.buttons_block').fadeIn(750, 'easeOutCirc');
						},
						function(){
							var tabsContentUnhoverHover = $(this).closest('.content_inner').attr('data-unhover') * 1;
							$(this).closest('.content_inner').stop().animate({'height': tabsContentUnhoverHover}, 100);
							$(this).find('.buttons_block').stop().fadeOut(203);
						}
					);
				});
				</script>
				<?$frame = $this->createFrame()->begin('');?>
				<script type="text/javascript">
				$("#<?=$sliderID?>").ready(function(){
					$(window).resize();
				});
				</script>
				<?$frame->end();?>
			</div>
		<?else:?>
			<?if(strlen($arParams['TITLE_BLOCK'])):?>
				<script type="text/javascript">
				$(document).ready(function() {
					$('.tabs li[data-code="VIEWED"] > span').text('<?=$arParams['TITLE_BLOCK']?>');
				});
				</script>
			<?endif;?>
		<?endif;?>
	<?endif;?>
<?endif;?>
<!-- /noindex -->