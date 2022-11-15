<?if(!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)){die();}?>
<?php if((bool)$arResult['section']['NAME']){
	echo ('<h1>'.$arResult['section']['NAME'].'</h1>');
}else{
	echo ('<h1>'.GetMessage('WEBFORMAT_CATALOG_SECTION_DETAIL_DEFAULT_TITLE').'</h1>');
}