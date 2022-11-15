<!DOCTYPE html>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	IncludeTemplateLangFile(__FILE__);
?>
<!doctype html>
<!--[if IE 7 ]><html lang="<?=ToLower(LANGUAGE_ID).'-'.ToUpper(LANGUAGE_ID)?>" class="ie78 ie7"><![endif]-->
<!--[if IE 8 ]><html lang="<?=ToLower(LANGUAGE_ID).'-'.ToUpper(LANGUAGE_ID)?>" class="ie78 ie8"><![endif]-->
<!--[if IE 9 ]><html lang="<?=ToLower(LANGUAGE_ID).'-'.ToUpper(LANGUAGE_ID)?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="<?=ToLower(LANGUAGE_ID).'-'.ToUpper(LANGUAGE_ID)?>"><!--<![endif]-->
<head>
	<meta charset="<?=SITE_CHARSET?>" />
	<title><?=GetMessage("DB_MSG_404_TPL_ADD_TITLE")?></title>
	<link rel="shortcut icon" href="/favicon.ico"></link>
<?$APPLICATION->ShowHead();?>
</head>
<body class="ru">
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	<div class="wrapperBlock">
		<div class="page-error404">
			<div class="left-error404">
				<a href="<?=SITE_DIR?>" class="logo lang-<?=ToLower(LANGUAGE_ID)?>"></a>
			</div>
			<div class="content-error404">
				<div class="error404"><?=GetMessage("DB_MSG_404_TPL_BIG_INF")?></div>
				<div class="cnt-error404">
					<h1><?=GetMessage("DB_MSG_404_TPL_PAGE_TITLE")?></h1>
<div class="menu-error404">
						<p><?=GetMessage("DB_MSG_404_TPL_PAGE_1")?>:</p>
							<?$APPLICATION->IncludeComponent("bitrix:main.map", ".default", array(
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"SET_TITLE" => "N",
	"LEVEL" => "0",
	"COL_NUM" => "1",
	"SHOW_DESCRIPTION" => "N"
	),
	false
);?>
							
					</div>
					<div class="info-error404">
						<p><?=GetMessage("DB_MSG_404_TPL_PAGE_2")?></p>
						<p><?=GetMessage("DB_MSG_404_TPL_PAGE_3")?>:</p>
						<ul class="mdash">
<?=GetMessage("DB_MSG_404_TPL_PAGE_4")?>
							
						</ul>
					</div>
					