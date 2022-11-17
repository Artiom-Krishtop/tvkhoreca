<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
	'PARAMETERS' => array(
		'TITLE_BLOCK' => array(
			'NAME' => GetMessage('T_TITLE_BLOCK'),
			'TYPE' => 'TEXT',
			'DEFAULT' => GetMessage('T_TITLE_BLOCK_DEFAULT'),
		),
		'VIEW_TYPE_IN_TAB' => array(
			'NAME' => GetMessage('T_VIEW_TYPE_IN_TAB'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'Y',
		),
		'DISPLAY_WISH_BUTTONS' => array(
			'NAME' => GetMessage('T_DISPLAY_WISH_BUTTONS'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'Y',
		),
		'DISPLAY_COMPARE' => array(
			'NAME' => GetMessage('T_DISPLAY_COMPARE'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'Y',
		),
		'SHOW_OLD_PRICE' => array(
			'NAME' => GetMessage('T_SHOW_OLD_PRICE'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'Y',
		),
		'SHOW_DISCOUNT_PERCENT' => array(
			'NAME' => GetMessage('T_SHOW_DISCOUNT_PERCENT'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'Y',
		),
		'SHOW_MEASURE' => array(
			'NAME' => GetMessage('T_SHOW_MEASURE'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'Y',
		),
	)
);