<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arAdditionalFields = Array(
	"EMAIL" => GetMessage("USER_EMAIL"),
	"COMMENTS" => GetMessage("USER_COMMENT"),
	"TIME" => GetMessage("USER_TIME"),
);

$arComponentParameters = Array(
	"PARAMETERS" => Array(
		"JQUERY_ON" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("JQUERY_ON"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"BOOTSTRAP_ON" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("BOOTSTRAP_ON"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"JQUERYUI_ON" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("JQUERYUI_ON"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"ADDITIONAL_FIELDS" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("ADDITIONAL_FIELDS"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "N",
			"VALUES" => $arAdditionalFields,
			"MULTIPLE" => "Y",
		)
	)
);
?>