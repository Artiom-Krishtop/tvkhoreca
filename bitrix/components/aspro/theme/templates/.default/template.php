<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="style-switcher <?=$_COOKIE["styleSwitcher"] == 'open' ? 'active' : ''?>">
	<div class="header"><?=GetMessage("THEME_MODIFY")?><span class="switch"><i class="icon icon-cogs"></i></span></div>
	<div class="block clearfix">
		<div class="block-title"><?=GetMessage("THEME_COLOR")?></div>
		<ul class="colors">
			<?foreach($arResult["COLOR"]["LIST"] as $arColor):?>
				<?$hex = CAllCorp::GetBaseColorHexByCode($arColor["CODE"]);?>
				<li <?=$arColor["CURRENT"] == "Y" ? 'class="active"' : ''?>><a href="<?=$APPLICATION->GetCurPageParam('color='.$arColor["CODE"], array('color', 'theme'))?>" title="<?=$arColor["NAME"]?>" style="background-color: <?=$hex?>;"><i></i></a></li>
			<?endforeach;?>
		</ul>
	</div>
	<div class="block">
		<div class="block-title"><?=GetMessage("THEME_TYPE")?></div>
		<div class="options">
			<?foreach( $arResult["WIDTH"]["LIST"] as $arWidth ){?>
				<a href="<?=$APPLICATION->GetCurPageParam('width='.$arWidth["CODE"], array('width', 'theme'))?>" class="<?=$arWidth["CURRENT"] == "Y" ? 'active' : ''?>"><?=$arWidth["NAME"]?></a>
			<?}?>
		</div>
	</div>
	<div class="block">
		<div class="block-title"><?=GetMessage("THEME_MENUTYPE")?></div>
		<div class="options">
			<?foreach( $arResult["MENU"]["LIST"] as $arMenu ){?>
				<a href="<?=$APPLICATION->GetCurPageParam('menu='.$arMenu["CODE"], array('menu', 'theme'))?>" class="<?=$arMenu["CURRENT"] == "Y" ? 'active' : ''?>"><?=$arMenu["NAME"]?></a>
			<?}?>
		</div>
	</div>
	<div class="block">
		<div class="block-title"><?=GetMessage("THEME_SIDEMENUTYPE")?></div>
		<div class="options">
			<?foreach( $arResult["SIDEMENU"]["LIST"] as $arMenu ){?>
				<a href="<?=$APPLICATION->GetCurPageParam('sidemenu='.$arMenu["CODE"], array('sidemenu', 'theme'))?>" class="<?=$arMenu["CURRENT"] == "Y" ? 'active' : ''?>"><?=$arMenu["NAME"]?></a>
			<?}?>
		</div>
	</div>
	<div class="block">
		<div class="block-title"><?=GetMessage("THEME_CATALOG_INDEX")?></div>
		<div class="options">
			<?foreach($arResult["CATALOG_INDEX"]["LIST"] as $arMenu ){?>
				<a href="<?=$APPLICATION->GetCurPageParam('catalog_index='.$arMenu["CODE"], array('catalog_index', 'theme'))?>" class="<?=$arMenu["CURRENT"] == "Y" ? 'active' : ''?>"><?=$arMenu["NAME"]?></a>
			<?}?>
		</div>
	</div>
	<div class="block">
		<div class="block-title"><?=GetMessage("THEME_SERVICES_INDEX")?></div>
		<div class="options">
			<?foreach($arResult["SERVICES_INDEX"]["LIST"] as $arMenu ){?>
				<a href="<?=$APPLICATION->GetCurPageParam('services_index='.$arMenu["CODE"], array('services_index', 'theme'))?>" class="<?=$arMenu["CURRENT"] == "Y" ? 'active' : ''?>"><?=$arMenu["NAME"]?></a>
			<?}?>
		</div>
	</div>
	<div class="block">
		<div class="buttons">
			<a class="reset" href="<?=$APPLICATION->GetCurPageParam('theme=default', array('theme', 'color', 'width', 'menu', 'sidemenu'))?>"><?=GetMessage("THEME_RESET")?><i class="icon icon-refresh"></i></a>
		</div>
	</div>
</div>