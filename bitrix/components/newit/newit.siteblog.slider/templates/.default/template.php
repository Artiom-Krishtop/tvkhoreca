<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript">
$(document).ready(function(){ 
    $('.carousel').carousel();    
});
</script>
<div id="myCarousel" class="carousel slide">
    <!-- Carousel items -->
    <div class="carousel-inner">
    <?$i=1;?>
    <?foreach($arResult['ITEMS'] as $item):?>
        <?
        $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>       
        <div class="item <?if($i == 1):?>active<?endif;?>" id="<?=$this->GetEditAreaId($item['ID']);?>">
            <?if($item['PREVIEW_IMG']):?>
            <?if($item['PROPERTIES']['LINK']['VALUE']):?>
            <a href="<?=$item['PROPERTIES']['LINK']['VALUE']?>">
                <img src="<?=$item['PREVIEW_IMG']['src']?>" alt="" /> 
            </a>
            <?else:?>
            <img src="<?=$item['PREVIEW_IMG']['src']?>" alt="" />
            <?endif;?>
            <?endif;?>
            <div class="carousel-caption">
                <?=$item['PREVIEW_TEXT']?>
            </div>              
        </div>
        <?$i++;?>
        <?unset($link);?>
    <?endforeach;?>
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>