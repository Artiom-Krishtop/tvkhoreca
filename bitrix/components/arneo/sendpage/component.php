<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

if ($arParams["INCLUDE_JQUERY"] == 'Y') $APPLICATION->AddHeadScript('//yandex.st/jquery/2.0.0/jquery.min.js');
$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");

$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);

if(strlen($arParams["EVENT_NAME"]) <= 0)
	$arParams["EVENT_NAME"] = "SENDPAGE_FORM";

$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);

if(strlen($arParams["OK_TEXT"]) <= 0)
	$arParams["OK_TEXT"] = GetMessage("SP_OK_MESSAGE");

if($_SERVER["REQUEST_METHOD"] == "POST" && strlen($_POST["submit"]) > 0)
{
	if(check_bitrix_sessid())
	{
		if(strlen($_POST["from_name"]) <= 1)
			$arResult["ERROR_MESSAGE"][] = GetMessage("SP_REQ_NAME");
		if( strlen($_POST["from_email"]) <= 1)
			$arResult["ERROR_MESSAGE"][] = GetMessage("SP_REQ_EMAIL");
		if(strlen($_POST["from_email"]) > 1 && !check_email($_POST["from_email"]))
			$arResult["ERROR_MESSAGE"][] = GetMessage("SP_EMAIL_NOT_VALID");
		if( strlen($_POST["to_email"]) <= 1)
			$arResult["ERROR_MESSAGE"][] = GetMessage("SP_REQ_TO_EMAIL");
		if(strlen($_POST["to_email"]) > 1 && !check_email($_POST["to_email"]))
			$arResult["ERROR_MESSAGE"][] = GetMessage("SP_TO_EMAIL_NOT_VALID");

		if($arParams["USE_CAPTCHA"] == "Y")
		{
			include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
			$captcha_code = $_POST["captcha_sid"];
			$captcha_word = $_POST["captcha_word"];
			$cpt = new CCaptcha();
			$captchaPass = COption::GetOptionString("main", "captcha_password", "");
			if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0)
			{
				if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
					$arResult["ERROR_MESSAGE"][] = GetMessage("SP_CAPTCHA_WRONG");
			}
			else
				$arResult["ERROR_MESSAGE"][] = GetMessage("SP_CAPTCHA_EMPTY");

		}
		if(empty($arResult))
		{
			$arFields = Array(
				"FROM_NAME" => $_POST["from_name"],
				"FROM_EMAIL" => $_POST["from_email"],
				"TO_EMAIL" => $_POST["to_email"],
				"MESSAGE" => (strlen($_POST["MESSAGE"]) > 0 ? GetMessage("SP_ADD_MESSAGE")."\r\n------------------------\r\n".$_POST["MESSAGE"]."\r\n------------------------\r\n" : ""),
				"SUBJECT" => $_POST["subject"],
				"PAGE_URL" => $_POST["PAGE_URL"],
			);
			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(IntVal($v) > 0)
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v));
			}
			else
				CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);

			$_SESSION["SP_NAME"] = htmlspecialcharsEx($_POST["from_name"]);
			$_SESSION["SP_EMAIL"] = htmlspecialcharsEx($_POST["from_email"]);
			$_SESSION["SP_TO_EMAIL"] = htmlspecialcharsEx($_POST["to_email"]);
			LocalRedirect($APPLICATION->GetCurPageParam("success=Y", Array("success")));
		}

		$arResult["MESSAGE"] = htmlspecialcharsEx($_POST["MESSAGE"]);
		$arResult["FROM_NAME"] = htmlspecialcharsEx($_POST["from_name"]);
		$arResult["FROM_EMAIL"] = htmlspecialcharsEx($_POST["from_email"]);
		$arResult["TO_EMAIL"] = htmlspecialcharsEx($_POST["to_email"]);
	}
	else
		$arResult["ERROR_MESSAGE"][] = GetMessage("SP_SESS_EXP");
}
elseif($_REQUEST["success"] == "Y")
{
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
}

if(empty($arResult["ERROR_MESSAGE"]))
{
	if(strlen($_SESSION["SP_NAME"]) > 0)
		$arResult["FROM_NAME"] = htmlspecialcharsEx($_SESSION["SP_NAME"]);
	if(strlen($_SESSION["SP_EMAIL"]) > 0)
		$arResult["FROM_EMAIL"] = htmlspecialcharsEx($_SESSION["SP_EMAIL"]);
	if(strlen($_SESSION["SP_TO_EMAIL"]) > 0)
		$arResult["TO_EMAIL"] = htmlspecialcharsEx($_SESSION["SP_TO_EMAIL"]);

}

if($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();
?>