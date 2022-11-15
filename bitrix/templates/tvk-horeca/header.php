<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<!--[if IE 6 ]><html class="ie6"><![endif]-->
<!--[if IE 7 ]><html class="ie7"><![endif]-->
<!--[if IE 8 ]><html class="ie8"><![endif]-->
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html><!--<![endif]-->
<head>
<?$APPLICATION->ShowHead()?>
<title><?$APPLICATION->ShowTitle()?></title>

<??>
<script type="text/javascript" src="http://tvk.by/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="/js/jquery.jcarousel.js"></script>
<link href="/js/jcarousel.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="/favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<??>

</head>

<body> 
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div class="page"> 
	<? /*echo $_COOKIE["screen_width"];echo $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/header.php";*/ ?>
  <div id="header"> 
    <div id="company-contacts"> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "inc",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_MODE" => "html",
		"EDIT_TEMPLATE" => "sect_inc.php"
	)
);?> </div>
   
    <div id="header_menu"><?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("include_areas/header_icons.php"),
			Array(),
			Array("MODE"=>"php")
		);?> </div>
   
    <div id="top-menu"><?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "3",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "N",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?></div>
   <a href="/horeca/" title="На главную" >
      <div id="company_logo"></div>
    </a> 

    <div id="search"><?$APPLICATION->IncludeComponent("bitrix:search.form", "flat", array(
	"PAGE" => "/horeca/search/index.php",
	"USE_SUGGEST" => "N"
	),
	false
);?> </div> 
<div id="targets">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	Array(
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "sect-inc",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_MODE" => "html",
		"EDIT_TEMPLATE" => "sect_inc.php"
	)
);?>
 </div>
   </div>
 
  <div class="work-area"> 
    <div id="l-col">
     <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "left-menu", array(
	"IBLOCK_TYPE" => "products",
	"IBLOCK_ID" => "3",
	"SECTION_ID" => "",
	"SECTION_CODE" => "",
	"COUNT_ELEMENTS" => "N",
	"TOP_DEPTH" => "1",
	"SECTION_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"SECTION_URL" => "",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"ADD_SECTIONS_CHAIN" => "Y"
),
false
);?> </div>
   	
    <div id="r-col">   
<div id="navigation"> <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", array(
	"START_FROM" => "2",
	"PATH" => "",
	"SITE_ID" => "-"
	),
	false
);?></div>

<?if($APPLICATION->GetCurPage(false)!==SITE_DIR):?>
      <h1 id="page-title"><?$APPLICATION->ShowTitle(false);?></h1>
 <?endif?> 