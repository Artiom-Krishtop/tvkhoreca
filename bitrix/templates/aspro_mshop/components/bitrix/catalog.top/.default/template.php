<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<? $this->setFrameMode( true ); ?>
<?
/*$sliderID  = "specials_slider_wrapp_".$this->randString();
$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
$arNotify = unserialize($notifyOption);*/
?>
<?if($arResult["SECTIONS"]):
$elCount = count($arResult["SECTIONS"]);
$halfCount = ceil($elCount/2);
$i=0;
?>
<div class="wrap_md_row">
<div class="iblock md-50">
<ul>
	<?foreach($arResult["SECTIONS"] as $id=>$arSection):?>
<?
if($halfCount == $i && $i!=$elCount){?>
</ul>
</div>
<div class="iblock md-50">
<ul>
<?}
$i++;?>
		<li><a href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?> (<?=$arSection['ELEMENT_CNT']?>)</a></li>
	<?endforeach;?>
</ul>
</div>
</div>
<?else:?>
	<?$this->setFrameMode(true);?>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".news_detail_wrapp .similar_products_wrapp").remove();
	}); /* dirty hack, remove this code */
	</script>
<?endif;?>