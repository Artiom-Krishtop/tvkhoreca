<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if($arResult['ITEMS']){?>
	<div class="search-tags-cloud">
		<div class="tags">
			<?foreach($arResult['ITEMS'] as $Item){?>
				<?if($Item['TITLE'] && $Item['URL'] && $arParams["RULE_ID"]!=$Item['COND_ID']){?>
						<?if(strlen($arParams["RULE_ID"]) && $arParams["RULE_ID"]==$Item['COND_ID']){?><span class="sotbit-seometa-tag-link active"><?}else{?><a class="sotbit-seometa-tag-link" href="<?=$Item['URL'] ?>" title="<?=$Item['TITLE'] ?>"><?}?><?=$Item['TITLE'] ?><?if(strlen($arParams["RULE_ID"]) && $arParams["RULE_ID"]==$Item['COND_ID']){?></span><?}else{?></a><?}?>
				<?}?>
			<?}?>
		</div>
	</div>
<?}?>