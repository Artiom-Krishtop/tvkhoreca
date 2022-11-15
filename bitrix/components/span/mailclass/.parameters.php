<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
<div align="center" style="background-color: #FFFFFF; height: 30px; padding: 7px; margin-bottom: 5px;">
        <a href="http://www.spanltd.ru"><img src="/bitrix/components/span/mailclass/images/logo.jpg" height="30px" align="left" /></a>
        <div style="margin: 13px 0px 0px 0px">
        <a href="http://www.spanltd.ru" style="color: #000; font-size: 10px;"><?=GetMessage("SPAN_IS")?></a>
        </div>
</div>
$arMailButton = array(
                        "1"        => GetMessage("LNG_LIKE"), 
                        "2"          => GetMessage("LNG_SHARE"), 
                        "3"           => GetMessage("LNG_RECOMEND")
                        );

$arClassButton = array(
                        "1"    => GetMessage("LNG_CLASS"), 
                        "2"     => GetMessage("LNG_SHARE"), 
                        "3"    => GetMessage("LNG_LIKE") 
);

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
        "ClassButton"    => array(
                                    "PARENT" => "BASE",
                                    "NAME" => GetMessage("LNG_CLASS_BUTTON"),
                                    "TYPE" => "LIST",
                                    "VALUES" => $arClassButton,
                                    "DEFAULT" => "1"                                    
                                   ),
        "MailButton"    => array(
                                    "PARENT" => "BASE",
                                    "NAME" => GetMessage("LNG_MAIL_BUTTON"),
                                    "TYPE" => "LIST",
                                    "VALUES" => $arMailButton,
                                    "DEFAULT" => "1"                                    
                                   ),
	),
);
?>