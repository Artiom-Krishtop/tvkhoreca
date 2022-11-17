<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if($arResult['ITEMS']){?>
	<ul class="seo-sections">
		<?foreach($arResult['ITEMS'] as $Item){?>
			<?if($Item['TITLE'] && $Item['URL']){?>
				<li class="sotbit-seometa-tag">
					<a class="sotbit-seometa-tag-link" href="<?=$Item['URL'] ?>" title="<?=$Item['TITLE'] ?>"><?=$Item['TITLE'] ?></a>
				</li>
			<?}?>
		<?}?>
	</ul>
<?}?>