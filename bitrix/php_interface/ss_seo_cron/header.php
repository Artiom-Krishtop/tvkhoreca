<?
$_SERVER["DOCUMENT_ROOT"] = "Enter the path from the root server to the folder of the site.";
$_SERVER["HTTP_HOST"] = "Your domain without http://";
$_SERVER["REQUEST_URI"] = "/";

$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define("BX_CRONTAB", true);
define("SITE_ID", "s1");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

set_time_limit(0);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set("display_errors", false);

if(!is_object($GLOBALS["USER"]))
	$GLOBALS["USER"] = new CUser();
?>