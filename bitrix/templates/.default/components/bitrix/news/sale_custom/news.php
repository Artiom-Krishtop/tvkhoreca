<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>

<?
/*if($arParams["SIDE_LEFT_BLOCK"]=='LEFT'){
	$APPLICATION->SetDirProperty("side_left_block", "user_side_LEFT");
}elseif($arParams["SIDE_LEFT_BLOCK"]=='RIGHT'){
	$APPLICATION->SetDirProperty("side_left_block", "user_side_RIGHT");
}*/
?>

<?global $isHideLeftBlock, $arTheme;?>
	
<?
if(isset($arParams["TYPE_LEFT_BLOCK"]) && $arParams["TYPE_LEFT_BLOCK"]!='FROM_MODULE'){
	$arTheme['LEFT_BLOCK']['VALUE'] = $arParams["TYPE_LEFT_BLOCK"];
}

if(isset($arParams["SIDE_LEFT_BLOCK"]) && $arParams["SIDE_LEFT_BLOCK"]!='FROM_MODULE'){
	$arTheme['SIDE_MENU']['VALUE'] = $arParams["SIDE_LEFT_BLOCK"];
}
?>

<?
if(!$isHideLeftBlock && $APPLICATION->GetProperty("HIDE_LEFT_BLOCK_LIST") == "Y"){
	$APPLICATION->SetPageProperty("HIDE_LEFT_BLOCK", "Y");
}
?>

<?
$isLeftBlock = ($APPLICATION->GetProperty("HIDE_LEFT_BLOCK") != "Y" ? true : false);
?>

<?// intro text?>
<div class="text_before_items"><?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "page",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => ""
		)
	);?></div>
<?
$arItemFilter = CMax::GetIBlockAllElementsFilter($arParams);

if($arParams['CACHE_GROUPS'] == 'Y')
{
	$arItemFilter['CHECK_PERMISSIONS'] = 'Y';
	$arItemFilter['GROUPS'] = $GLOBALS["USER"]->GetGroups();
}

$itemsCnt = CMaxCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CMaxCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());?>

<?if(!$itemsCnt):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
<?else:?>
	
	<?$this->SetViewTarget('product_share');?>
		<?if($arParams['USE_RSS'] !== 'N'):?>
			<div class="colored_theme_hover_bg-block">
				<?=CMax::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);?>
			</div>
		<?endif;?>
	<?$this->EndViewTarget();?>

	
	<?/* start tags */?>
	<?
	if(isset($arItemFilter['CODE']))
	{
		unset($arItemFilter['CODE']);
		unset($arItemFilter['SECTION_CODE']);
	}
	if(isset($arItemFilter['ID']))
	{
		unset($arItemFilter['ID']);
		unset($arItemFilter['SECTION_ID']);
	}
	?>
	<?
	$arTags = array();
	
	$arElements = CMaxCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CMaxCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y')), $arItemFilter, false, false, array('ID', 'TAGS'));

	foreach($arElements as $arElement)
	{
		if($arElement['TAGS'])
		{
			$arTags[] = explode(',', $arElement['TAGS']);
		}
	}
	?>
	<?$this->__component->__template->SetViewTarget('under_sidebar_content');?>
	<div>
		<?$APPLICATION->IncludeComponent(
			"bitrix:search.tags.cloud",
			"main",
			Array(
				"CACHE_TIME" => "86400",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"COLOR_NEW" => "3E74E6",
				"COLOR_OLD" => "C0C0C0",
				"COLOR_TYPE" => "N",
				"TAGS_ELEMENT" => $arTags,
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"FONT_MAX" => "50",
				"FONT_MIN" => "10",
				"PAGE_ELEMENTS" => "150",
				"PERIOD" => "",
				"PERIOD_NEW_TAGS" => "",
				"SHOW_CHAIN" => "N",
				"SORT" => "NAME",
				"TAGS_INHERIT" => "Y",
				"URL_SEARCH" => SITE_DIR."search/index.php",
				"WIDTH" => "100%",
				"arrFILTER" => array("iblock_aspro_max_content"),
				"arrFILTER_iblock_aspro_max_content" => array($arParams["IBLOCK_ID"])
			), $component, array('HIDE_ICONS' => 'Y')
		);?>
	</div>
	<?$this->__component->__template->EndViewTarget();?>
	<?/* end tags */?>
	
	
	<? if($arParams['USE_FILTER'] != 'N') {
		$active = !isset($_GET['active']) || (isset($_GET['active']) && $_GET['active'] != 'N');?>

		<div class="select_head_wrap">
			<div class="menu_item_selected font_upper_md rounded3 bordered visible-xs font_xs darken"><span></span>
				<?=CMax::showIconSvg("down", SITE_TEMPLATE_PATH.'/images/svg/trianglearrow_down.svg', '', '', true, false);?>
			</div>
			<div class="head-block top bordered-block rounded3 clearfix srollbar-custom">
				<div class="item-link font_upper_md  <?=($active ? '' : 'active');?>">
					<div class="title">
						<?if($active):?>
							<span class="btn-inline darken"><?=GetMessage('ACTIVE_ACTION')?></span>
						<?else:?>
							<a class="btn-inline dark_link" href="<?=$arResult['FOLDER'];?>"><?=GetMessage('ACTIVE_ACTION')?></a>
						<?endif;?>
					</div>
				</div>
				<div class="item-link font_upper_md <?=(!$active ? 'active' : '');?>">
					<div class="title btn-inline darken">
						<?if($active):?>
							<a class="btn-inline dark_link" href="<?=$APPLICATION->GetCurPageParam('active=N', array('active'));?>"><?=GetMessage('NOT_ACTIVE_ACTION')?></a>
						<?else:?>
							<span class="btn-inline darken"><?=GetMessage('NOT_ACTIVE_ACTION')?></span>
						<?endif;?>
					</div>
				</div>
			</div>
		</div>

		<? if (!$active){
			$GLOBALS[$arParams["FILTER_NAME"]] = array("ACTIVE_DATE" => "", "<DATE_ACTIVE_TO" =>ConvertDateTime(date('d.m.Y'), FORMAT_DATE,''));
		}
	}?>

	
	
	<div class="sub_container fixed_wrapper">
	<div class="row">
		<div class="col-md-12">
			    
	<?if((isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") || (strtolower($_REQUEST['ajax']) == 'y'))
	{
		$APPLICATION->RestartBuffer();
	}?>
	<?// section elements?>
	<?$sViewElementsTemplate = ($arParams["SECTION_ELEMENTS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["SALE_PAGE"]["VALUE"] : $arParams["SECTION_ELEMENTS_TYPE_VIEW"]);?>
	<?@include_once('page_blocks/'.$sViewElementsTemplate.'.php');?>
	<?if((isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") || (strtolower($_REQUEST['ajax']) == 'y'))
	{
		die();
	}?>	
	    </div>
	    
    </div>
    </div>
	

<?endif;?>