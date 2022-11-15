 <?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MLIFE_CONTENTMONSTER_NAME"),
	"DESCRIPTION" => GetMessage("MLIFE_CONTENTMONSTER_DESCRIPTION"),
	"ICON" => "/images/component.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => GetMessage("CONTENTMONSTER"),
		"CHILD" => array(
			"ID" => 'other',
			"NAME" => GetMessage("CONTENTMONSTER_OTHER"),
			"SORT" => 9,
		),
	),
);
?>