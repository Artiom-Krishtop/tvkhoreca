<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
if(!CModule::IncludeModule("contentmonster.contentmonster") || !CModule::IncludeModule("iblock")) return;
global $APPLICATION;
$APPLICATION->RestartBuffer();
$service = new CContentmonsterContentmonster();
$service->site_id = SITE_ID;
$data = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : @file_get_contents('php://input');
$xmlrpc_request = $service->XMLRPC_parse($data);
$methodName = $service->XMLRPC_getMethodName($xmlrpc_request);
$params = $service->XMLRPC_getParams($xmlrpc_request);
if(!isset($service->methods[$methodName])){ 
     $service->method_not_found($methodName);
}else{
	$func = $service->methods[$methodName];
	$service->$func($params);
}
die();
?>