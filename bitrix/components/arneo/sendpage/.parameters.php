<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arFilter = Array("TYPE_ID" => "SENDPAGE_FORM", "ACTIVE" => "Y");
if($site !== false)
	$arFilter["LID"] = $site;

$arEvent = Array();
$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
while($arType = $dbType->GetNext())
	$arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];

$arComponentParameters = array(
	"PARAMETERS" => array(
		"USE_CAPTCHA" => Array(
			"NAME" => GetMessage("SP_CAPTCHA"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"PARENT" => "BASE",
		),
		"OK_TEXT" => Array(
			"NAME" => GetMessage("SP_OK_MESSAGE"),
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("SP_OK_TEXT"),
			"PARENT" => "BASE",
		),
		"EVENT_MESSAGE_ID" => Array(
			"NAME" => GetMessage("SP_EMAIL_TEMPLATES"),
			"TYPE"=>"LIST",
			"VALUES" => $arEvent,
			"DEFAULT"=>"",
			"MULTIPLE"=>"Y",
			"COLS"=>25,
			"PARENT" => "BASE",
		),
		"INCLUDE_JQUERY" => Array(
			"NAME" => GetMessage("SP_JQUERY"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"PARENT" => "BASE",
		),
		"ID" => Array(
			"NAME" => GetMessage("SP_ELEMENT_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => 1,
			"PARENT" => "BASE",
		),

	)
);


?>