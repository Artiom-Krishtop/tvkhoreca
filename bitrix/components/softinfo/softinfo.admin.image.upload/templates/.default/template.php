<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<? if($arParams["ELEMENT_ID"]>0):?>

<?if($arResult["IS_ADMIN"]=="Y"): ?>
<? if($arParams["FIXED_SLIDE_PANEL"]=="Y"){
   $fix_class = $arResult["FIX_CLASS"];
   $style = $arResult["FIX_STYLE"];
}?>
<div class="upload_pic <?= $fix_class ?>" style="<?= $style ?>">
<form name="pic_<?= $arParams["SUBMIT_INPUT_NAME"] ?>" action="<?= $arResult["DETAIL_PAGE_URL"] ?>" method="POST" enctype="multipart/form-data" target="_self">
   <label for="<?= $arParams["SUBMIT_INPUT_NAME"] ?>"><?=GetMessage('SOFTINFORM_FORM_NAME');?></label>
   <input name="<?= $arParams["SUBMIT_INPUT_NAME"] ?>" type="text">
   <input name="load" type="submit" value="<?=GetMessage('SOFTINFORM_BTN_NAME');?>" >
</form>
</div>

<? if($arResult["UPDATE_PAGE"]==true): ?>
  <script>
   window.top.location.href='<?=CUtil::JSEscape($arResult["DETAIL_PAGE_URL"])?>';
  </script>

<? endif;?>

<? endif;?>

<?endif;?>