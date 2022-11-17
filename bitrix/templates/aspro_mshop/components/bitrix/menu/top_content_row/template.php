<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode( true ); ?>
<?
$firstNavCount = count($arResult);
$i=1;
?>
<?if( !empty( $arResult ) ){?>
    <div class="menu-mobi">
        <ul class="menu adaptive">
            <li class="menu_opener_top"><!--<a><?/*=GetMessage('MENU_NAME')*/?></a>--><i class="icon"></i></li>
        </ul>
        <ul class="menu full_top">
            <?foreach($arResult as $arItem):?>
                <li class="menu_item_l1 <?=($arItem["SELECTED"] ? ' current' : '')?><?=($arItem["LINK"] == $arParams["IBLOCK_CATALOG_DIR"] ? ' catalog' : '')?>">
                    <a href="<?=$arItem["LINK"]?>">
                        <span><?=$arItem["TEXT"]?></span>
                    </a>
                </li>
            <?endforeach;?>
        </ul>
    </div>
	<ul class="menu orange-sliding">
		<?foreach( $arResult as $key => $arItem ){?>
			<li class="menu_item_l1<?if($i==1):?> first<?elseif($firstNavCount==$i):?> last<?endif;?><?if( $arItem["SELECTED"] ):?> current<?endif?>">
				<a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a>
			</li>
            <?$i++;?>
		<?}?>
        <li class="more menu_item_l1">
            <a>Ещё<i></i></a>
            <div class="child cat_menu"><div class="child_wrapp"></div></div>
        </li>
        <li class="stretch"></li>
	</ul>
	<script src="/bitrix/templates/aspro_mshop/components/bitrix/menu/top_content_row/top_content_row.js"></script>
<?}?>