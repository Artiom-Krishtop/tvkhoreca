<?php
if(!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)){die();}

if(!CModule::IncludeModule('iblock')){return;}
$webformatLangPrefix = 'WEBFORMAT_SECTIONDETAIL_';

$arIBlockType = CIBlockParameters::GetIBlockTypes();
//Get iblock types list
    $iTypesShort = array();
    $iTypesFull = array();
    $res = CIBlockType::GetList(array('NAME' => 'ASC'), array('LANGUAGE_ID' => LANGUAGE_ID));
    while($iType = $res->Fetch()){
        $iTypesShort[$iType['ID']] = '['.$iType['ID'].'] '.$iType['NAME'];
        $iTypesFull[] = $iType;
    }
//---End---Get iblock types list

//Get iblocks list
    $sectionIblocks = array('---');
    $firstIType = current($iTypesFull);
    $rsIBlock = CIBlock::GetList(Array('name' => 'asc'), array('TYPE' => isset($arCurrentValues['IBLOCK_TYPE']) ? $arCurrentValues['IBLOCK_TYPE'] : $firstIType['ID'], 'ACTIVE'=>'Y'));
    while($iblock = $rsIBlock->Fetch()){$sectionIblocks[$iblock['ID']] = '['.$iblock['ID'].'] '.$iblock['NAME'];}
//---End---Get product list


$arComponentParameters = array(
	'GROUPS' => array(),
	'PARAMETERS' => array(
		'IBLOCK_TYPE' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage($webformatLangPrefix.'IBLOCK_TYPE'),
			'TYPE' => 'LIST',
			'VALUES' => $iTypesShort,
			'REFRESH' => 'Y'
		),
		'IBLOCK_ID' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage($webformatLangPrefix.'IBLOCK_ID'),
			'TYPE' => 'LIST',
			'VALUES' => $sectionIblocks,
			'REFRESH' => 'Y'
		),
		'SECTION_ID' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage($webformatLangPrefix.'SECTION_ID'),
			'TYPE' => 'STRING',
			'DEFAULT' => '={$_REQUEST["SECTION_ID"]}'
		),
		'SECTION_CODE' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage($webformatLangPrefix.'SECTION_CODE'),
			'TYPE' => 'STRING',
			'DEFAULT' => '={$_REQUEST["SECTION_CODE"]}'
		),
        'DISPLAY_DATA' => array(
            'PARENT' => 'BASE',
            'NAME' => GetMessage($webformatLangPrefix.'DISPLAY_DATA'),
            'TYPE' => 'LIST',
            'MULTIPLE' => 'Y',
            'VALUES' => array(
                'NAME' => GetMessage($webformatLangPrefix.'DISPLAY_DATA_NAME'),
                'ID' => GetMessage($webformatLangPrefix.'DISPLAY_DATA_ID'),
                'IBLOCK_SECTION_ID' => GetMessage($webformatLangPrefix.'DISPLAY_DATA_PID'),
                'DESCRIPTION' => GetMessage($webformatLangPrefix.'DISPLAY_DATA_DESC'),
                'PICTURE' => GetMessage($webformatLangPrefix.'DISPLAY_DATA_PREVIEW_PIC'),
                'DETAIL_PICTURE' => GetMessage($webformatLangPrefix.'DISPLAY_DATA_DETAIL_PIC')
            )
        ),
        'HIDE_CONDITION' => array(
            'PARENT' => 'ADDITIONAL_SETTINGS',
            'NAME' => GetMessage($webformatLangPrefix.'HIDE_CONDITION'),
            'TYPE' => 'STRING',
            'DEFAULT' => '={$_REQUEST["PAGEN_1"]>0}'
        ),
        'IS_SEF' => array(
            'PARENT' => 'URL_TEMPLATES',
            'NAME' => GetMessage($webformatLangPrefix.'IS_SEF'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N',
            'REFRESH' => 'Y'
        )
	)
);

if((isset($arCurrentValues['IS_SEF'])) && ($arCurrentValues['IS_SEF'] == 'Y')){
    $arComponentParameters['PARAMETERS']['WF_SEF_FOLDER'] = array(
        'PARENT' => 'URL_TEMPLATES',
        'NAME' => GetMessage($webformatLangPrefix.'WF_SEF_FOLDER'),
        'TYPE' => 'STRING',
        'DEFAULT' => '/catalog/'
    );
    $arComponentParameters['PARAMETERS']['WF_SECTION_TEMPLATE'] = array(
        'PARENT' => 'URL_TEMPLATES',
        'NAME' => GetMessage($webformatLangPrefix.'WF_SECTION_TEMPLATE'),
        'TYPE' => 'STRING',
        'DEFAULT' => '#SECTION_CODE#/'
    );
}

$arComponentParameters['PARAMETERS']['CACHE_TIME'] = array();
