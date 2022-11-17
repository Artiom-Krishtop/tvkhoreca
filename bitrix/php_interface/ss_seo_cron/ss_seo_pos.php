<?
define("BASEPATH", substr(__FILE__, 0, strripos(__FILE__, '/')));
include(BASEPATH.'/header.php');

use Ss\Seo\GetPosition;

GetPosition::GetAllPosition();

include(BASEPATH.'/footer.php');
?>