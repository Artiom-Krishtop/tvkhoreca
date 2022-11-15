<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="social-icons">
	<ul>
		<?if( !empty( $arParams["VK"] ) ){?>
			<li class="vk"><a href="<?=$arParams["VK"]?>" target="_blank" rel="nofollow" title="<?=GetMessage("SOCIAL_VK")?>"><?=GetMessage("SOCIAL_VK")?></a></li>
		<?}?>
		<?if( !empty( $arParams["FACEBOOK"] ) ){?>
			<li class="facebook"><a href="<?=$arParams["FACEBOOK"]?>" target="_blank" rel="nofollow" title="<?=GetMessage("SOCIAL_FACEBOOK")?>"><?=GetMessage("SOCIAL_FACEBOOK")?></a></li>
		<?}?>
		<?if( !empty( $arParams["TWITTER"] ) ){?>
			<li class="twitter"><a href="<?=$arParams["TWITTER"]?>" target="_blank" rel="nofollow" title="<?=GetMessage("SOCIAL_TWITTER")?>"><?=GetMessage("SOCIAL_TWITTER")?></a></li>
		<?}?>
		<?if( !empty( $arParams["ODNOKLASSNIKI"] ) ){?>
			<li class="odnoklassniki"><a href="<?=$arParams["ODNOKLASSNIKI"]?>" target="_blank" rel="nofollow" title="<?=GetMessage("SOCIAL_ODNOKLASSNIKI")?>"><?=GetMessage("SOCIAL_ODNOKLASSNIKI")?></a></li>
		<?}?>
		<?if( !empty( $arParams["MAILRU"] ) ){?>
			<li class="mail"><a href="<?=$arParams["MAILRU"]?>" target="_blank" rel="nofollow" title="<?=GetMessage("SOCIAL_MAILRU")?>"><?=GetMessage("SOCIAL_MAILRU")?></a></li>
		<?}?>
		<?if( !empty( $arParams["LIVEJOURNAL"] ) ){?>
			<li class="lj"><a href="<?=$arParams["LIVEJOURNAL"]?>" target="_blank" rel="nofollow" title="<?=GetMessage("SOCIAL_LIVEJOURNAL")?>"><?=GetMessage("SOCIAL_LIVEJOURNAL")?></a></li>
		<?}?>
	</ul>
</div>