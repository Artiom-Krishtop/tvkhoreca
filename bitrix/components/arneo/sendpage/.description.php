<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SP_NAME"),
	"DESCRIPTION" => GetMessage("SP_DESC"),
	"ICON" => "/images/icon.gif",
	"SORT" => 10,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "utility",
        "CHILD" => array(
         "ID" => "sendpage",
         "NAME" => GetMessage("SP_NAME")
      )
	),
	"COMPLEX" => "N",
);

?>