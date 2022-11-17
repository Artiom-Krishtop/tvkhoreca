<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<div class="sales-section">

<?if(($arResult["CNT"])>4):?>
	<style>
		.sales-section .left-arrow:hover {
			background: url(/bitrix/templates/tvk-retail/images/left-arrow-act.png) no-repeat;
		}
		.sales-section .right-arrow:hover {
			background: url(/bitrix/templates/tvk-retail/images/right-arrow-act.png) no-repeat;
		} 
	</style>
<?endif;?>

<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({buttonNextHTML: '<div><a class="right-arrow"><br></a></div>', buttonPrevHTML: '<div><a class="left-arrow"><br></a></div>', scroll: 1, auto: 1<?if(($arResult["CNT"])>4):?>, wrap: 'circular'<?endif;?> })
});

</script>



<?foreach($arItems as $arItem):?>
<?if(strlen($arItem["PICTURE"]["SRC"])==0){ continue; }?>
	<li>
		<div style="position: relative;">					
							<?if($arResult["USER_HAVE_ACCESS"]):?>
								<?if(is_array($arItem["PICTURE"])):?>
									<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arItem["PICTURE"]["SRC"]?>" width="<?=$arItem["PICTURE"]["WIDTH"]?>" height="<?=$arItem["PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" /></a>
								<?endif?>
							<?else:?>
								<?if(is_array($arItem["PICTURE"])):?>
									<img border="0" src="<?=$arItem["PICTURE"]["SRC"]?>" width="<?=$arItem["PICTURE"]["WIDTH"]?>" height="<?=$arItem["PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
								<?endif?>
							<?endif?>
			<div class="sale-size">
			<?foreach($arItem["DISPLAY_PROPERTIES"] as $arProperty):?>
									<?
										if(is_array($arProperty["DISPLAY_VALUE"]))
											echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
										else
											echo $arProperty["DISPLAY_VALUE"];?>
								<?endforeach?>
			</div>
		</div>				
	</li>
<?endforeach;?>

</ul>
<?endforeach;?>
  
</div>

