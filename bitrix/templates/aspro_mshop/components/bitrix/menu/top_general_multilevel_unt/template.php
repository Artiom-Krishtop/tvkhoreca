<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if($arResult):
$firstNavCount = count($arResult);
$i=1;
?>
	<ul class="menu adaptive">
		<li class="menu_opener"><a><?=GetMessage('MENU_NAME')?></a><i class="icon"></i></li>
	</ul>
	<ul class="menu full">
		<?foreach($arResult as $arItem):?>
			<li class="menu_item_l1 <?if($i==1):?>first<?elseif($firstNavCount==$i):?>last<?endif;?><?=($arItem["SELECTED"] ? ' current' : '')?><?=($arItem["LINK"] == $arParams["IBLOCK_CATALOG_DIR"] ? ' catalog' : '')?>">
				<a href="<?=$arItem["LINK"]?>">
					<?=preg_replace('/\w+/',"<br/>", $arItem["TEXT"], 1)?>
				</a>
				<?if($arItem["IS_PARENT"] == 1):?>
					<div class="child submenu line">
						<div class="child_wrapp">
							<?foreach($arItem["CHILD"] as $arSubItem):?>
								<a class="<?=($arSubItem["SELECTED"] ? ' current' : '')?>" href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?><?if($arSubItem["IS_PARENT"] == 1):?><span class="has_sub">&#9658;</span><?endif;?></a>
								<?if($arSubItem["IS_PARENT"] == 1):?>
									<div class="depth3">
											<?foreach($arSubItem["CHILD"] as $arSubIteml3):?>
												<a class="<?=($arSubIteml3["SELECTED"] ? ' current' : '')?>" href="<?=$arSubIteml3["LINK"]?>"><?=$arSubIteml3["TEXT"]?></a>
											<?endforeach;?>
									</div>
								<?endif;?>
							<?endforeach;?>
						</div>
					</div>
				<?endif;?>
				<?//if($arItem["LINK"] == $arParams["IBLOCK_CATALOG_DIR"] || $arItem["LINK"] == SITE_DIR."catalog/retail/"):?>
				<?//if($arItem["LINK"] == SITE_DIR."catalog/retail/"){$arParams["IBLOCK_CATALOG_ID"]=54;}?>
					<?/*$APPLICATION->IncludeComponent(
						"bitrix:catalog.section.list",
						"top_menu",
						Array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_CATALOG_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_CATALOG_ID"],
							"SECTION_ID" => "",
							"SECTION_CODE" => "",
							"COUNT_ELEMENTS" => "N",
							"TOP_DEPTH" => "3",
							"SECTION_FIELDS" => array(0 => "",1 => "",),
							"SECTION_USER_FIELDS" => array(0 => "",1 => "",),
							"SECTION_URL" => "",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "86400",
							"URL" => $_SERVER["REQUEST_URI"],
							"CACHE_GROUPS" => "N",
							"ADD_SECTIONS_CHAIN" => "N"
						)
					);*/?>
				<?//endif;?>
			</li>
		<?
		$i++;
		endforeach;?>
		<li class="more menu_item_l1">
			<a><?=GetMessage("CATALOG_VIEW_MORE_")?><i></i></a>
			<div class="child cat_menu"><div class="child_wrapp"></div></div>
		</li>
		<li class="stretch"></li>
	</ul>
	<script src="/bitrix/templates/aspro_mshop/components/bitrix/menu/top_general_multilevel_unt/top_general_multilevel_unt.js"></script>

<?endif;?>