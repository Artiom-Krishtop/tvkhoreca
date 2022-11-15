<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?if($arResult):?>
	<ul class="nav nav-list side-menu">
		<?foreach($arResult as $arItem):?>
			<li class="<?=($arItem["SELECTED"] ? "active" : "")?> <?=($arItem["CHILD"] ? "child" : "")?>">
				<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
				<?$arLastSectionSelected = ($arItem["SELECTED"] && !$arItem["PARAMS"]["IS_ITEM"] ? $arItem : false);?>
				<?$arTmp = aspro::isChildsSelected($arItem["CHILD"]);?>
				<?while($arTmp["SELECTED"] && !$arTmp["PARAMS"]["IS_ITEM"]):?>
					<?$arLastSectionSelected = $arTmp;?>
					</li>
					<li class="active <?=($arTmp["CHILD"] ? "child" : "")?>">
						<a href="<?=$arTmp["LINK"]?>"><?=$arTmp["TEXT"]?></a>
					<?$arTmp = aspro::isChildsSelected($arTmp["CHILD"]);?>
				<?endwhile;?>
				<?if($arLastSectionSelected && $arLastSectionSelected["CHILD"]):?>
					<ul class="submenu">
						<?foreach($arLastSectionSelected["CHILD"] as $arSubItem):?>
							<li class="<?if( $arSubItem["SELECTED"] ){?>active<?}?>">
								<a href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
							</li>
						<?endforeach;?>
					</ul>
				<?endif;?>
			</li>
		<?endforeach;?>
	</ul>
<?endif;?>