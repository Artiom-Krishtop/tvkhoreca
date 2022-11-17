<?php
if(!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)){die();}
$webformatLangPrefix = 'WEBFORMAT_SECTIONDETAIL_';

$arComponentDescription = array(
	'NAME' => GetMessage($webformatLangPrefix.'NAME'),
	'DESCRIPTION' => GetMessage($webformatLangPrefix.'DESCRIPTION'),
	'ICON' => '/images/image.gif',
	'CACHE_PATH' => 'Y',
	'SORT' => 40,
	'PATH' => array(
		'ID' => 'wf',
		'NAME' => 'WebFormat'
	),
);

?>