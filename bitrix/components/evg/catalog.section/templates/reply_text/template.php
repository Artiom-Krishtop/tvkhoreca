<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
 <?=$arResult["NAV_STRING"]?><br />
<?endif;?>
  <?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
<?=$arElement["PREVIEW_TEXT"]?>
  <?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
 <br /><?=$arResult["NAV_STRING"]?>

<?endif;?>