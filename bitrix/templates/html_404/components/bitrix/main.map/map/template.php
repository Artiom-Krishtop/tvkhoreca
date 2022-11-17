<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!is_array($arResult["arMap"]) || count($arResult["arMap"]) < 1)
	return;
?>
<div class="db-sitemap">
<ul class="sitemap-simple">
<?foreach($arResult['arMapStruct'] as $arItem):?>
	<li>
	<a href="<?=$arItem["FULL_PATH"]?>"><?=$arItem['NAME']?></a>
	<?if ($arParams["SHOW_DESCRIPTION"] == "Y" && strlen($arItem["DESCRIPTION"]) > 0):?>
		<div class="sitemap-simple-desc"><?=$arItem["DESCRIPTION"]?></div>
	<?endif?>
	<?if(count($arItem['CHILDREN']) > 0):?>
		<ul class="sitemap-simple-inner">
			<?foreach($arItem['CHILDREN'] as $arChild):?>
				<li>
					<a href="<?=$arChild["FULL_PATH"]?>"><?=$arChild['NAME']?></a>
					<?if ($arParams["SHOW_DESCRIPTION"] == "Y" && strlen($arItem["DESCRIPTION"]) > 0):?>
						<div class="sitemap-simple-desc"><?=$arItem["DESCRIPTION"]?></div>
					<?endif?>
				</li>
			<?endforeach;?>
		</ul>
	<?endif;?>
	</li>
<?endforeach;?>
</ul>
</div>
<?/*/?><pre><?print_r($arResult)?></pre><?//*/?> 