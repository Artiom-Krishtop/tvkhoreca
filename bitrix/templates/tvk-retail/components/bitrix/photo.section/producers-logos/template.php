<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="producers-logos">


<?if(intval($arResult["CNT"])>6):?>
	<style>
		.producers-logos .left-arrow:hover{
			background: url(/bitrix/templates/tvk-retail/images/left-arrow-act.png) no-repeat;
		}
		.producers-logos .right-arrow:hover{
			background: url(/bitrix/templates/tvk-retail/images/right-arrow-act.png) no-repeat;
		}
	</style>
<?endif;?> 

<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#mycarouse2').jcarousel({buttonNextHTML: '<div><a class="right-arrow"><br></a></div>', buttonPrevHTML: '<div><a class="left-arrow"><br></a></div>', scroll: 1, auto: 3<?if(intval($arResult["CNT"])>6):?>, wrap: 'circular'<?endif;?> })
});

</script>


<?foreach($arResult["ROWS"] as $arItems):?>


<ul id="mycarouse2" class="jcarousel-skin-tango-SMALL">

<?foreach($arItems as $arItem):?>
<?if(strlen($arItem["PICTURE"]["SRC"])==0){ continue; }?>
	<li>
		<?if($arResult["USER_HAVE_ACCESS"]):?>
			<?if(is_array($arItem["PICTURE"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arItem["PICTURE"]["SRC"]?>" width="<?=$arItem["PICTURE"]["WIDTH"]?>" height="<?=$arItem["PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
			<?endif?>
		<?else:?>
			<?if(is_array($arItem["PICTURE"])):?>
				<img border="0" src="<?=$arItem["PICTURE"]["SRC"]?>" width="<?=$arItem["PICTURE"]["WIDTH"]?>" height="<?=$arItem["PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
			<?endif?>
		<?endif?>				
	</li>
<?endforeach;?>

</ul>
<?endforeach;?>
  
</div>

