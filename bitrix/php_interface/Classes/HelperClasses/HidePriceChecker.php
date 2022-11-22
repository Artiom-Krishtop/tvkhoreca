<?php

namespace ITG\Classes\HelperClasses;

use \Bitrix\Main\Loader;

class HidePriceChecker
{
    protected const CATALOG_IBLOCK_ID = 54;
    protected const BRANDS_IBLOCK_ID = 48;

    protected static $instance;

    protected $arHidePriceSections = [];
    protected $arHidePriceBrands = [];

    public static function getInstance()
    {
        if(!is_object(self::$instance) || !(self::$instance instanceof self)){
            self::$instance = new self();
        }
        
        return self::$instance;
    }

    protected function __construct()
    {
        $this->arHidePriceSections = $this->getHidePriceSections();
        $this->arHidePriceBrands = $this->getHidePriceBrands();
    }

    protected function getHidePriceSections()
    {
        if(Loader::includeModule('iblock')){
            $arHidePriceSectionsIds = [];
            $dbRes = \CIBlockSection::getList(
                array(), 
                array(
                    'IBLOCK_ID' => self::CATALOG_IBLOCK_ID, 
                    'UF_HIDE_PRICE_SECTION' => true
                ), 
                false, 
                array(
                    'ID'
                )
            );

            while ($res = $dbRes->fetch()) {
                $arHidePriceSectionsIds[]  = $res['ID'];
            }

            return $arHidePriceSectionsIds;
        }else {
            return [];
        }
    }

    protected function getHidePriceBrands()
    {
        if(Loader::includeModule('iblock')){
            $arHidePriceBrandsIds = [];
            $dbRes = \CIBlockElement::getList(
                array(), 
                array(
                    'IBLOCK_ID' => self::BRANDS_IBLOCK_ID,
                    'PROPERTY_HIDE_PRICE_FOR_BRAND_VALUE' => 'Y'
                ), 
                false, 
                false, 
                array(
                    'ID'
                )
            );

            while ($res = $dbRes->fetch()) {
                $arHidePriceBrandsIds[]  = $res['ID'];
            }
            
            return $arHidePriceBrandsIds;
        }else {
            return [];
        }
    }

    public function isHidePrice($arItem)
    {
        if($this->checkHidePriceForGood($arItem)){
            return true;       
        }elseif($this->checkHidePriceForBrand($arItem)) {
            return true;
        }elseif ($this->checkHidePriceForSection($arItem)) {
            return true;
        }
        
        return false;
    }

    public function isHidePriceByID($id)
    {
        if(Loader::includeModule('iblock')){
            $dbRes = \CIBlockElement::getList(
                array(), 
                array(
                    'ID' => intval($id)
                ), 
                false, 
                false, 
                array(
                    '*',
                    'PROPERTY_BRAND',
                    'PROPERTY_HIDE_PRICE'
                )
            );

            if ($res = $dbRes->fetch()) {
               $arItem = $res;
               $arItem['PROPERTIES']['HIDE_PRICE']['VALUE'] = $res['PROPERTY_HIDE_PRICE_VALUE'];
               $arItem['PROPERTIES']['BRAND']['VALUE'] = $res['PROPERTY_BRAND_VALUE'];
               
               return $this->isHidePrice($arItem);
            }

            return false;
        }
    }

    public function checkHidePriceForGood($arItem)
    {
        if(!empty($arItem['PROPERTIES']['HIDE_PRICE']['VALUE']) && $arItem['PROPERTIES']['HIDE_PRICE']['VALUE'] == 'Y'){
            return true;       
        }

        return false;
    }

    public function checkHidePriceForBrand($arItem)
    {
        if(
            !empty($this->arHidePriceBrands) && 
            !empty($arItem['PROPERTIES']['BRAND']['VALUE']) && 
            in_array($arItem['PROPERTIES']['BRAND']['VALUE'], $this->arHidePriceBrands)
        ){
            return true;
        }

        return false;
    }

    public function checkHidePriceForSection($arItem)
    {
        if(!empty($this->arHidePriceSections) && Loader::includeModule('iblock')){
            if(in_array($arItem['~IBLOCK_SECTION_ID'], $this->arHidePriceSections)){
                return true;
            }else {
                $arSectionChain = [];
                $dbRes = \CIBlockSection::GetNavChain(self::CATALOG_IBLOCK_ID, $arItem['~IBLOCK_SECTION_ID'], array('ID'));
                
                while ($res = $dbRes->fetch()) {
                    $arSectionChain[] = $res['ID'];
                }

                if(!empty(array_intersect($arSectionChain, $this->arHidePriceSections))){
                    return true;
                }
            }
        }

        return false;
    }
}