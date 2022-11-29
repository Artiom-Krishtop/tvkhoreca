<?php

namespace ITG\Classes\EventHandlers;

use \Bitrix\Main\Loader;

class ImportHandlers
{
    protected const IBLOCK_CATALOG_ID = 54;

    public static function onBeforeIBlockElementUpdate(&$arFields)
    {
        if($arFields['IBLOCK_ID'] == self::IBLOCK_CATALOG_ID && !empty($_REQUEST['mode'] == 'import')){
            $arElementSec = self::getElementSections($arFields['ID']);

            if(!empty($arElementSec) && count($arElementSec) > 1){

                array_shift($arElementSec);

                foreach ($arElementSec as $key => $arSection) {
                    if(in_array($arSection['ID'], $arFields['IBLOCK_SECTION'])){
                        unset($arElementSec[$key]);
                    }
                }

                $arFields['IBLOCK_SECTION'] = array_merge($arFields['IBLOCK_SECTION'], array_keys($arElementSec));
            }
        }
    }

    protected static function getElementSections($elementId)
    {
        $arElementSec = [];

        if(Loader::includeModule('iblock')){
            $dbRes = \CIBlockElement::GetElementGroups($elementId);

            while ($res = $dbRes->Fetch()) {
                $arElementSec[$res['ID']] = $res; 
            }
        }

        return $arElementSec;
    }
}