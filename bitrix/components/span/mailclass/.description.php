<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("LNG_NAME_SSTAT"),
	"DESCRIPTION" => GetMessage("LNG_DESCRIPTION_SSTAT"),
	"ICON" => "/images/icon_mailru.gif",
	"SORT" => 10,
	"LOGOTYPE" => GetMessage("LNG_IMG_SSTAT"),
	"CACHE_PATH" => "N",
    "PATH" => array(
              "ID" => GetMessage("LNG_ID_PARTNER"),
              "CHILD" => array(
                      "ID" => "imstatus",
                      "NAME" => GetMessage("LNG_CAT_STATUS")
                )
        ),
	"COMPLEX" => "N",
);
?>