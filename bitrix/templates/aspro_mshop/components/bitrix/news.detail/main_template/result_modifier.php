<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$cp = $this->__component; // объект компонента

if (is_object($cp))
{
    $cp->arResult['PROPERTIES'] = $arResult["PROPERTIES"];
    $cp->arResult['AJAX_REQUEST'] = $arParams["AJAX_REQUEST"];
    $cp->SetResultCacheKeys(array('PROPERTIES','AJAX_REQUEST'));
}
?>