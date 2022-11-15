<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$errorMessages = true;

if($_REQUEST["recaptcha_response"])
    $errorMessages = GoogleReCaptcha::checkClientResponse($_REQUEST["recaptcha_response"]);

return $errorMessages;