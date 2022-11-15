<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("main");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
	
$IBLOCK_ID = 54;	
	
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/csv_data.php");
$csvFile = new CCSVData('R', false);
$uploadfile = $_SERVER["DOCUMENT_ROOT"]."/LoadFileHoReCa03112016_120000.csv";
	
$csvFile->LoadFile($uploadfile);
//$header = $csvFile->GetFirstHeader();
$csvFile->SetDelimiter(';');
$header = $csvFile->FetchDelimiter();
array_shift($header);
$user = array();
foreach($header as $num=>$arValue){
	$user[$num]["XML_ID"] = $arValue;
	$user[$num]["GROUP_XML_ID"] = $user[$num]["XML_ID"]."_group";
	
	$rsGroups = CGroup::GetList(($by="c_sort"), ($order="desc"), array("STRING_ID"=> $user[$num]["GROUP_XML_ID"])); // выбираем группы
	while ($arGroup = $rsGroups->Fetch())
	{
	   $user[$num]["GROUP_ID"] = $arGroup["ID"];
	}
	
	/*$rsUsers = CUser::GetList(($by="XML_ID"), ($order="asc"), array("XML_ID" => "usertest2"), array("FIELDS"=>array("ID","XML_ID","NAME"))); // выбираем пользователей
	while ($arUsers = $rsUsers->Fetch())
	{
		$arGroups = CUser::GetUserGroup($arUsers['ID']);
	   print_r($arGroups);
	}*/
	
	$db_res = CCatalogGroup::GetGroupsList(array("GROUP_ID"=>$user[$num]["GROUP_ID"], "BUY"=>"Y"));
	while ($ar_res = $db_res->Fetch())
	{
	   $user[$num]["CATALOG_GROUP_ID"] = $ar_res["CATALOG_GROUP_ID"];
	}
}

while ($arRes = $csvFile->Fetch()) {
	//print_r($arRes);
	$ProductXmlId = array_shift($arRes);
	//print_r($ProductXmlId);
	
	$rsProducts = CCatalogProduct::GetList(
		array(),
		array('ELEMENT_IBLOCK_ID' => $IBLOCK_ID, 'ELEMENT_XML_ID' => $ProductXmlId),
		false,
		false,
		array('ID')
	);
	if ($arParentProduct = $rsProducts->Fetch())
		$arProductCache[$ProductXmlId] = $arParentProduct['ID'];
		
	foreach($arRes as $priceID=>$price){
		$arFields = Array(
		    "PRODUCT_ID" => $arProductCache[$ProductXmlId],
		    "CATALOG_GROUP_ID" => $user[$priceID]["CATALOG_GROUP_ID"],
		    "PRICE" => $price,
		    "CURRENCY" => "BYN",
		    "QUANTITY_FROM" => false,
		    "QUANTITY_TO" => false,
		);
		$res = CPrice::GetList(
		        array(),
		        array(
						"PRODUCT_ID" => $arProductCache[$ProductXmlId],
						"CATALOG_GROUP_ID" => $user[$priceID]["CATALOG_GROUP_ID"],
		            )
		    );
		echo "<pre>";
		print_r($user[$priceID]["CATALOG_GROUP_ID"]);
		echo "</pre>";
		if ($arr = $res->Fetch())
		{
		    CPrice::Update($arr["ID"], $arFields, false);
		}
		else
		{
		    CPrice::Add($arFields);
		}
	}
}
echo "<pre>";
//print_r($user);
echo "</pre>";
?>
