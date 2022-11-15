<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("S_INF_CMP_NAME"),
	"DESCRIPTION" => GetMessage("S_INF_CMP_DESCRIPTION"),
	"ICON" => "/images/icon.gif",
	"SORT" => 100,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => GetMessage("S_INF_CMP_GLOBAL_DIR_ID"),
		"NAME" => GetMessage("S_INF_CMP_GLOBAL_DIR_ID"),
		"CHILD" => array(
			"ID" => "softinform_url_image_uploader",
			"NAME" => GetMessage("S_INF_CMP_DIR_NAME")
		),

	),
);

?>