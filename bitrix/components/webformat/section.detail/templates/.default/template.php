<?if(!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)){die();}?>
<?php
    $filled = false;
    foreach($arResult['fields'] as $fieldName){
        if(isset($arResult['section'][$fieldName]) && (bool)$arResult['section'][$fieldName]){
            $filled = true;
            break;
        }
    }
    if($filled){
?>
<div class="webformat-section-detail">

    <?php if((bool)trim($arResult['section']['NAME'])){echo ('<h1>'.$arResult['section']['NAME'].'</h1>');}?>
    <?php
        $pic = (isset($arResult['section']['PICTURE']) && (bool)$arResult['section']['PICTURE']) ? $arResult['section']['PICTURE'] :
                ((isset($arResult['section']['DETAIL_PICTURE']) && (bool)$arResult['section']['DETAIL_PICTURE']) ? $arResult['section']['DETAIL_PICTURE'] : 
                false);
        if((bool)$pic){
            if(isset($arResult['section']['DETAIL_PICTURE']) && (bool)$arResult['section']['DETAIL_PICTURE']){
                echo ('<a href="'.$arResult['section']['DETAIL_PICTURE']['SRC'].'" class="pic" target="_blank">');
            }
            echo ('<img src="'.$pic['SRC'].'" width="'. $pic['WIDTH'].'" height="'.$pic['HEIGHT'].'" alt="'.$arResult['section']['NAME'].'"/>');
            if(isset($arResult['section']['DETAIL_PICTURE']) && (bool)$arResult['section']['DETAIL_PICTURE']){
                echo ('</a>');
            }
        }
    ?>
    <?php
	    if((bool)trim($arResult['section']['DESCRIPTION'])){
		    echo '<div class="description">';
			    echo $arResult['section']['DESCRIPTION'];
		    echo '</div>';
	    }
    ?>
    <div class="clear:both;"><!-- --></div>
</div>
<?php }?>