<?
function rds($uri,$step="start"){
    $new_uri = str_replace("//", "/", $uri);
    if(strpos($new_uri, "//") !== false){
        rds($new_uri,"continue");
    }elseif($step != "start"){
        header("HTTP/1.1 301 Moved Permanently");
        header('Location: https://'.$_SERVER['SERVER_NAME'].$new_uri);
        exit();            
    }
}
$isFrontPage = CSite::InDir(SITE_DIR.'index.php');
if($isFrontPage){
	rds($_SERVER["REQUEST_URI"]);
}
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
ini_set('display_errors', false);
/*error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('error_reporting',  E_ALL);*/
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate","DoNotUpdate"); 
function DoNotUpdate(&$arFields) 
{ 
    if ($_REQUEST['mode']=='import') 
    { 
	    $arFields['NAME'] = $arFields['PREVIEW_TEXT'];
    } 
} 
AddEventHandler("iblock", "OnBeforeIBlockElementAdd","DoNotAdd"); 
function DoNotAdd(&$arFields) 
{ 
    if ($_REQUEST['mode']=='import') 
    { 
	    $arFields['NAME'] = $arFields['PREVIEW_TEXT'];
    } 
} 

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");

function show($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}


function getSectionUrl($iblockID, $sectionID){
	if(intval($sectionID)>0){
		CModule::IncludeModule('iblock');		
		
		$strPath = '';
		$rsPath = GetIBlockSectionPath($iblockID, $sectionID);
		while($arPath=$rsPath->GetNext())
		{
			$strPath .= $arPath["CODE"].'/';
		}		
		return $strPath;
	}
}

function GetItemPage($itemID, $pageCNT = 20){
	
	if($pageCNT <=0){
		$pageCNT = 20;
	}
		
	CModule::IncludeModule('iblock');
	$rs = CIBlockElement::GetByID($itemID);
	if($arItem = $rs->GetNext()){

		$arFilter = array(
			"ACTIVE" => "Y",
			"SECTION_ID" => $arItem["IBLOCK_SECTION_ID"],
			"ACTIVE_DATE" => "Y",
			"IBLOCK_ACTIVE" => "Y",
			"IBLOCK_ID" => $arItem["IBLOCK_ID"],
			"CHECK_PERMISSIONS" => "Y",
		);		
		$arSort = array(
			"ID" => "DESC",
		);		
		$arSelect = Array("ID", "NAME", "IBLOCK_ID");
		$rs = CIBlockElement::GetList($arSort, $arFilter, false, array("nPageSize"=>1, "nElementID"=>$itemID), $arSelect);
		if($arElement = $rs->GetNext()){
			$itemPosition = $arElement["RANK"];
			$itemPage = ceil($itemPosition/$pageCNT);
			return $itemPage;
		}
		
	}
	
}

function getElementUrl($iblockID, $elementID){
	if(intval($elementID)>0){
		CModule::IncludeModule('iblock');		
		
		
		$rs = CIBlockElement::GetByID($elementID);
		$arItem = $rs->GetNext();
		$sectionID = $arItem["IBLOCK_SECTION_ID"];
		
		$strPath = '';
		$rsPath = GetIBlockSectionPath($iblockID, $sectionID);
		while($arPath=$rsPath->GetNext())
		{
			$strPath .= $arPath["CODE"].'/';
		}		
		$strPath .= $arItem["ID"].'/';
		return $strPath;
	}
}

function xmp($obj)
{
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
}

AddEventHandler("main", "OnAfterUserAdd", Array("UserPriceCreate", "OnAfterUserAddHandler"));
AddEventHandler("main", "OnAfterUserUpdate", Array("UserPriceCreate", "OnAfterUserAddHandler"));

class UserPriceCreate
{
    // создаем обработчик события "OnAfterUserAdd"
    function OnAfterUserAddHandler(&$arFields)
    {
        if($arFields["ID"]>0){
	        if($arFields['UF_B2C']==1 && $arFields['XML_ID']){
		        $group = new CGroup;
				$arGroupFields = Array(
				  "ACTIVE"       => "Y",
				  "C_SORT"       => 100,
				  "NAME"         => "Цены для ".$arFields['LOGIN'],
				  "USER_ID"      => array($arFields["ID"]),
				  "STRING_ID"      => $arFields['XML_ID']."_group"
				  );
				$NEW_GROUP_ID = $group->Add($arGroupFields);
				if($NEW_GROUP_ID){
					CModule::IncludeModule("catalog");
					$arPriceFields = array(
					   "NAME" => $arFields['XML_ID']."_price",
					   "SORT" => 155,
					   "USER_GROUP" => array($NEW_GROUP_ID),   // видят цены члены групп 
					   "USER_GROUP_BUY" => array($NEW_GROUP_ID),  // покупают по этой цене
					   "XML_ID" => $arFields['XML_ID']."_price",                              
					   "USER_LANG" => array(
					      "ru" => "Цена для ".$arFields['LOGIN']
					      )
					);
					
					$ID = CCatalogGroup::Add($arPriceFields);
				}
	        }
        }
    }
}

function userPricesList(){
	CModule::IncludeModule("catalog");
	$dbPriceType = CCatalogGroup::GetList(
	        array("NAME" => "ASC"),
	        array("SORT" => "155", "CAN_BUY" => "Y")
	    );
	$arPrices = array();
	while ($arPriceType = $dbPriceType->Fetch())
	{
	    $arPrices[] = $arPriceType["NAME"];
	}
	return $arPrices;
}

AddEventHandler("main", "OnEpilog", "Redirect404");
function Redirect404() {
    if( 
     !defined('ADMIN_SECTION') &&  
     defined("ERROR_404") &&  
     defined("PATH_TO_404") &&  
     file_exists($_SERVER["DOCUMENT_ROOT"].PATH_TO_404) 
   ) {
		//LocalRedirect("/404.php", "404 Not Found");
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        CHTTP::SetStatus("404 Not Found");
        include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/header.php");
        include($_SERVER["DOCUMENT_ROOT"].PATH_TO_404);
        include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/footer.php");
        
    }
}
?><?
/*
For component informunity:feedback
*/
//include_once('/home/tvkby/public_html/bitrix/components/informunity/feedback/attach/add_event_handler.php');
include_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/components/informunity/feedback/attach/add_event_handler.php');

// добавляем тип для инфоблока
AddEventHandler("iblock", "OnIBlockPropertyBuildList", array("UserDataColor", "GetIBlockPropertyDescription"));
// добавляем тип для главного модуля
AddEventHandler("main", "OnUserTypeBuildList", array("UserDataColor", "GetUserTypeDescription"));

// перед добавлением почтового события
AddEventHandler('main', 'OnBeforeEventAdd', array('myEvents', 'sendOrderMessage'));
 
class myEvents
{
    public static function sendOrderMessage(&$event, &$lid, &$arFields)
    {
        // если почтовое событие - Оформление заказа
        if ($event == 'SALE_NEW_ORDER') {
            $orderId = $arFields['ORDER_ID'];
            CModule::IncludeModule('sale');
            // получим свойства заказа
            $result = CSaleOrder::GetByID($orderId);
			$rsUser = CUser::GetByID($result['USER_ID']);
			$arUser = $rsUser->Fetch();
			$rsManager = CUser::GetByID($arUser['UF_USER_MANAGER']);
			$arManager = $rsManager ->Fetch();
			
			$arFields['MANAGER'] = $arManager['NAME'].' '.$arManager['LAST_NAME'].' Телефон:'.$arManager['PERSONAL_PHONE'];
			CModule::IncludeModule("sale");
			$db_props = CSaleOrderPropsValue::GetOrderProps($orderId);
			while ($arProps = $db_props->Fetch())
			{
				if($arProps["CODE"]=="PHONE"){
					$arFields['USER_PHONE'] = $arProps["VALUE"];
				}
			}
        }
        if ($event == 'FORM_FILLING_SIMPLE_FORM_3' || $event == 'FORM_FILLING_TOORDER') {
            $productId = $arFields['PRODUCT_ID'];
            CModule::IncludeModule('iblock');
            // получим свойства заказа
			$res = CIBlockElement::GetByID($productId);
			if($ar_res = $res->GetNext())
				$arFields['DETAIL_PAGE_URL'] = $ar_res['DETAIL_PAGE_URL'];
			$db_props = CIBlockElement::GetProperty($ar_res["IBLOCK_ID"],$ar_res["ID"], array("sort" => "asc"), Array("CODE"=>"CML2_ARTICLE"));
			if($ar_props = $db_props->Fetch())
				$arFields['ARCTICLE'] = "Артикул: ".$ar_props["VALUE"];
        }
    }
}
AddEventHandler('main', 'OnEpilog', array('CMainHandlers', 'OnEpilogHandler'));  
class CMainHandlers { 
   public static function OnEpilogHandler() {
	  $pageNum = $GLOBALS['APPLICATION']->GetPageProperty('real_page_number');
      if (intval($pageNum)>0) {
         $h1 = $GLOBALS['APPLICATION']->GetTitle();
         $title = $GLOBALS['APPLICATION']->GetPageProperty('title');
         $description = $GLOBALS['APPLICATION']->GetPageProperty('description');
         $GLOBALS['APPLICATION']->SetPageProperty('title', $title.', страница - '.$pageNum);
         $GLOBALS['APPLICATION']->SetPageProperty('description', $description.', страница - '.$pageNum);
         $GLOBALS['APPLICATION']->SetTitle($h1.', страница - '.$pageNum);
      }
   }
}

function prent($mas, $prent = true, $show = false, $name = false) {
    global $USER;
    if ($USER->IsAdmin() || $show) {
        if ($name) {
            echo "<div class='h3'>" . $name . "</div>";
        }
        echo "<pre style=\"text-align:left; background-color:#CCC;color:#000; font-size:10px; padding-bottom: 10px; border-bottom:1px solid #000;\">";
        if ($prent)
            print_r($mas);
        else
            var_dump($mas);
        echo "</pre>";
    }
}
function getMinPriceBySectionID($sectionID){

    $CATALOG_ID = 54;
    $rsProducts = CIBlockElement::GetList(
        Array('CATALOG_GROUP_61' => 'ASC'),
        Array('IBLOCK_ID' => $CATALOG_ID, 'SECTION_ID' => $sectionID,'CATALOG_AVAILABLE' => 'Y','>CATALOG_PRICE_ID_61' => 0),
        false,
        Array('nTopCount' => 1),
        Array('IBLOCK_ID', 'ID', 'NAME', 'CATALOG_GROUP_61')
    );

    $arProducts = $rsProducts->Fetch();
    $price = $arProducts["CATALOG_PRICE_61"];
    if (!empty( $price))
         return $price;
    else
        return false;
}
AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", Array("workWithSectionsClass", "OnBeforeIBlockSectionUpdateHandler"));

class workWithSectionsClass{
    // создаем обработчик события "OnBeforeIBlockSectionUpdate"
    function OnBeforeIBlockSectionUpdateHandler(&$arFields){
        if($arFields["IBLOCK_ID"]==54){
	        $arFields["UF_MIN_PRICE"] = getMinPriceBySectionID($arFields["ID"]);
	        $arFields["UF_TOTAL_OFFERS"] = CIBlockSection::GetSectionElementsCount($arFields["ID"], Array("CNT_ACTIVE"=>"Y"));
        }
    }
}

function p( $_mixVar=null, $_intExit=null ) {
	echo "<div align='left' style='background-color:#FFFFFF;color:#000000'><hr><pre>";
	if ( 2==$_intExit||3==$_intExit )
		var_dump( $_mixVar );
	elseif ( is_array( $_mixVar )||is_object( $_mixVar ) )
		print_r( $_mixVar );
	else
		echo $_mixVar;
	echo '</pre><hr></div>';
	if ( 1==$_intExit||3==$_intExit)
		exit;
}

class GoogleReCaptcha
{
	public static function getPublicKey() { return '6LdvEO0bAAAAAGvsJd6Nu4XyFmgA3ByGZF60RXHJ';}
	public static function getSecretKey() { return '6LdvEO0bAAAAABjj05Ez_cx5wUkV-r7Glv8DWIEM';}
	public static function checkClientResponse($response = false)
	{
		if(!$response)
		{
			$context = \Bitrix\Main\Application::getInstance()->getContext();
			$request = $context->getRequest();
			$captchaResponse = $request->getPost("recaptcha_response");
		}
		else
			$captchaResponse = $response;

		if($captchaResponse)
		{
			$url = 'https://www.google.com/recaptcha/api/siteverify';
			$data = array('secret' => static::getSecretKey(), 'response' => $captchaResponse, 'remoteip' => $_SERVER['REMOTE_ADDR'],);
			$httpClient = new Bitrix\Main\Web\HttpClient();
			$response = $httpClient->post($url,$data);
			if($response)
				$response = Bitrix\Main\Web\Json::decode($response,true);
			if(!$response['success'])
				return $response['error-codes'];
			if ($response['score'] <= 0.7)
				return 'no captcha response';
			return array();
		}
		return array('no captcha response');
	}
}

?>
