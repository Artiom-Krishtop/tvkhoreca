<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?><div class="top-slider flexslider unstyled" data-plugin-options='{"animation": "slide", "directionNav": true, "animationLoop": true, "slideshow": true, "touch" : true, "controlNav" :true}'>
    <ul class="slides">
        <?foreach( $arResult["ITEMS"] as $key => $arItem ){
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
        <?$img = is_array( $arItem["DETAIL_PICTURE"] ) ? $arItem["DETAIL_PICTURE"]["SRC"] : $this->GetFolder()."/images/background.jpg"?>
        <li id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="background: url('<?=$img?>') center center no-repeat !important;">
            <div class="container">
                <div class="row <?=$arItem["PROPERTIES"]["TEXTCOLOR"]["VALUE_XML_ID"]?>">
                <?$type = $arItem["PROPERTIES"]["BANNERTYPE"]["VALUE_XML_ID"];?>
                <?ob_start();?>
                <?if( !empty( $arItem["PROPERTIES"]["LINKIMG"]["VALUE"] ) && $type != "T1" ){?>
                <a href="<?=$arItem["PROPERTIES"]["LINKIMG"]["VALUE"]?>" class="title-link">
                <?}?>
                <div class="title"><?=$arItem["NAME"]?></div>
                <?if( !empty( $arItem["PROPERTIES"]["LINKIMG"]["VALUE"] ) && $type != "T1" ){?>
                </a>
                <?}?>
                <div class="text-block">
                    <?if( $arItem["PREVIEW_TEXT_TYPE"] == "text" ){?>
                    <p>
                        <?}?>
                        <?=$arItem["PREVIEW_TEXT"]?>
                        <?if( $arItem["PREVIEW_TEXT_TYPE"] == "text" ){?>
                    </p>
                    <?}?>
                </div>
                <?if( !empty( $arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"] ) && !empty( $arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"] ) ){?>
                <a href="<?=$arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"]?>" class="btn <?=!empty( $arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"] ) ? $arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"] : "btn-primary"?>">
                <?=$arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]?>
                </a>
                <?}?>
                <?if( !empty( $arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"] ) && !empty( $arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"] ) ){?>
                <a href="<?=$arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"]?>" class="btn <?=!empty( $arItem["PROPERTIES"]["BUTTON2CLASS"]["VALUE"] ) ? $arItem["PROPERTIES"]["BUTTON2CLASS"]["VALUE"] : "btn-transparent"?>">
                <?=$arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"]?>
                </a>
                <?}?>
                <?$text = ob_get_clean();?>

                <?if( is_array( $arItem["PREVIEW_PICTURE"] ) ){

							ob_start();?>
                <?if( !empty( $arItem["PROPERTIES"]["LINKIMG"]["VALUE"] ) && $type != "T1" ){?>
                <a href="<?=$arItem["PROPERTIES"]["LINKIMG"]["VALUE"]?>" class="image">
                <?}?>
                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
                <?if( !empty( $arItem["PROPERTIES"]["LINKIMG"]["VALUE"] ) && $type != "T1" ){?>
                </a>
                <?}?>
                <?$img = ob_get_clean();?>

                <div class="col-md-6">
                <div class="inner">


                </div>
            </div>

            <div class="col-md-6">
            <div class="inner">
				

            </div>
</div>
<?}else{?>
<div class="col-md-12">
	<?=$text?>

</div>
<?}?>
</div>
</div>
</li>
<?}?>
</ul>
</div>