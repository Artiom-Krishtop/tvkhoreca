<?php

//in infoblock settings property code MUST BY typed in CAPITALS!!!

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$time_start = microtime(true); 
@ini_set('max_execution_time', '2400');
set_time_limit(2400);

global $APPLICATION;

CModule::IncludeModule('iblock');

error_reporting(E_ALL ^ E_NOTICE);


/*require_once 'Excel/oleread.php';
require_once 'Excel/reader.php';

$data = new Spreadsheet_Excel_Reader();

$data->setOutputEncoding('UTF-8');*/

/**
 * 
 * Настраиваемые параметры
 * 
 */

$iblock_id = 54;
$document_root = $_SERVER["DOCUMENT_ROOT"];
$excelFile = 'Export1C.xls';

require_once $document_root.'/tools/Classes/PHPExcel/IOFactory.php';
require_once $document_root.'/tools/Classes/PHPExcel.php';

$validLocale = PHPExcel_Settings::setLocale('ru');
$objPHPExcel = PHPExcel_IOFactory::load($excelFile);

/** 
 * * Деактивируем элементы и разделы каталога BEGIN
 */

global $DB;
$strSQL = "UPDATE b_iblock_element SET ACTIVE='N' WHERE IBLOCK_ID=".$iblock_id;
$DB->query($strSQL);
$strSQL = "UPDATE b_iblock_section SET ACTIVE='N' WHERE IBLOCK_ID=".$iblock_id;
$DB->query($strSQL);


/**
 * * Деактивируем элементы и разделы каталога END
 */


//$data->read('Export1C-HoReCa.xls');
$arr = array();

foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
{
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // например, 10
    $highestColumn      = $worksheet->getHighestColumn(); // например, 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;

/**
 * *
 * Читаем поля
 * 
 */    

	  
	$arFields = array();
	
    for ($col = 0; $col < $highestColumnIndex; $col++) 
    {
        $cell = $worksheet->getCellByColumnAndRow($col, 1);
        $val = iconv('utf-8', 'utf-8', $cell->getValue());
        $arFields[$col] = strtoupper(trim($val));
    }	
		
    //xmp($arFields);

	//Читаем данные

	$arData = array();

	$current_top_section = false;
	$current_sub_section = false;
	$current_sub_sub_section = false;
	$current_top_section_ID = 0;
	$current_sub_section_ID = 0;
	$current_sub_sub_section_ID = 0;

	$section_sort = 0;
	$sub_section_sort = 0;
	$sub_sub_section_sort = 0;


	$top_section_key = array_search('SECTION1_CODE', $arFields);
	$sub_section_key = array_search('SECTION2_CODE', $arFields);
	$sub_sub_section_key = array_search('SECTION3_CODE', $arFields);

	$obj_element = new CIBlockElement();
	$obj_section = new CIBlockSection();


	for ($row = 2; $row <= $highestRow; ++ $row)
	{
		//xmp($top_section_key);

		$top_section_code = iconv('utf-8', 'utf-8', $worksheet->getCellByColumnAndRow($top_section_key, $row)->getValue()); 
		$sub_section_code = iconv('utf-8', 'utf-8', $worksheet->getCellByColumnAndRow($sub_section_key, $row)->getValue());
		$sub_sub_section_code = iconv('utf-8', 'utf-8', $worksheet->getCellByColumnAndRow($sub_sub_section_key, $row)->getValue()); 

				
		$first_cell_value = trim(iconv('utf-8', 'utf-8', $worksheet->getCellByColumnAndRow(0, $row)->getValue()));    
		$second_cell_value = trim(iconv('utf-8', 'utf-8', $worksheet->getCellByColumnAndRow(1, $row)->getValue()));    
		$third_cell_value = trim(iconv('utf-8', 'utf-8', $worksheet->getCellByColumnAndRow(2, $row)->getValue()));    
		$fourth_cell_value = trim(iconv('utf-8', 'utf-8', $worksheet->getCellByColumnAndRow(3, $row)->getValue()));
		
		
		if (strlen($first_cell_value) == 0){
			//xmp(2);
			continue;
		}
		
		if ((strlen($second_cell_value) == 0 || substr_count($first_cell_value,'#') > 0) && strlen($third_cell_value) == 0)
		{
			// это раздел

			//xmp('---------------------------------------------');
			//xmp($data->sheets[0]['cells'][$i]);
			
			//xmp($data->sheets[0]['cells'][$i]);
			//xmp($top_section_code.' ---- '.$sub_section_code);
			//xmp($sub_section_code);
			
						
			if (strlen($top_section_code) > 0)
			{			
				//xmp($top_section_code);
				
				if (strlen($sub_section_code) == 0 || (!$current_top_section_ID || ($top_section_code != $current_top_section)))
				{
					// Новый раздел верхнего уровня
					
					/*xmp($top_section_code);
					xmp($sub_section_code);
					xmp('-------------------');*/
					
					$current_top_section = false;
					$current_sub_section = false;
					$current_top_section_ID = 0;
					$current_sub_section_ID = 0;

					$top_section_code = $top_section_code;
					$current_top_section = $top_section_code;
					
					//Проверить, есть ли такой раздел, если нет, надо добавить
					
					$arFilter = array(
						"IBLOCK_ID" => $iblock_id,
						"CODE" => $top_section_code,
					);
					
					$rs = CIBlockSection::GetList(array("ID"=>"ASC"), $arFilter);
					
					if ($rs->SelectedRowsCount())
					{
						$arSection = $rs->GetNext();
						$current_top_section_ID = $arSection["ID"];
						
						//Надо активировать раздел
						
						$arUpdateSectionFields = array(
						  "ACTIVE" => "Y",
						  "IBLOCK_ID" => $iblock_id,
						  "NAME" => $arSection["NAME"],
						  "SORT" => $section_sort,
						);
						
						//xmp($current_top_section_ID);
						
						$obj_section->Update($current_top_section_ID, $arUpdateSectionFields);
						
						//xmp($current_top_section_ID);
					} 
					else 
					{					
						//Надо добавить новый раздел
						
						$section_name = iconv('utf-8', 'utf-8', $worksheet->getCellByColumnAndRow(0, $row)->getValue());
						$section_name = trim(str_replace('#','',$section_name));
						//$section_name = trim(str_replace('#','',iconv('utf-8', 'utf-8', $cell->getValue())));
						
						/*xmp(222);
						xmp($cell->getValue());
						die();*/
						
						if (strlen($section_name) > 0)
						{
							$arSectionFields = Array(
							  "ACTIVE" => "Y",
							  //"IBLOCK_SECTION_ID" => $IBLOCK_SECTION_ID,
							  "IBLOCK_ID" => $iblock_id,
							  "NAME" => $section_name,
							  "CODE" => $top_section_code,
							  "SORT" => $section_sort,
							);
							//xmp($arSectionFields);
							$current_top_section_ID = $obj_section->Add($arSectionFields);
							//xmp($current_top_section_ID);					
						}					
					}
					$section_sort = $section_sort + 100;
				}
							
				if (strlen($sub_section_code) > 0 && $current_top_section_ID > 0)
				{								
					$sub_section_code = $sub_section_code;
					$current_sub_section = $sub_section_code;
					
					//Проверить, есть ли такой ПОДРАЗДЕЛ, если нет, надо добавить
					
					$arFilter = array(
						"IBLOCK_ID" => $iblock_id,
						"SECTION_ID" => $current_top_section_ID,
						"CODE" => $sub_section_code,
					);
									
					$rs = CIBlockSection::GetList(array("ID"=>"ASC"), $arFilter);
					if ($rs->SelectedRowsCount() > 0)
					{					
						$arSection = $rs->GetNext();
						$current_sub_section_ID = $arSection["ID"];
						
						/**
						 * Нужно активировать подраздел
						 */
						
						$arUpdateSectionFields = array(
						  "ACTIVE" => "Y",
						  "IBLOCK_ID" => $iblock_id,
						  "NAME" => $arSection["NAME"],
						  "SORT" => $sub_section_sort,
						);					
						
						//xmp($current_sub_section_ID);
						
						$obj_section->Update($current_sub_section_ID, $arUpdateSectionFields);					
					} 
					else 
					{					
						//Надо добавить новый подраздел
											
						$section_name = trim(str_replace('#','',iconv('utf-8', 'utf-8', $worksheet->getCellByColumnAndRow(0, $row)->getValue())));
						$section_name = trim(str_replace('#','',$section_name));
						//$section_name = trim($data->sheets[0]['cells'][$i][1]);
						
						//xmp($section_name.' / '.$sub_section_code);
						
						if (strlen($section_name) > 0)
						{
							$arSectionFields = Array(
							  "ACTIVE" => "Y",
							  "IBLOCK_SECTION_ID" => $current_top_section_ID,
							  "IBLOCK_ID" => $iblock_id,
							  "NAME" => $section_name,
							  "CODE" => $sub_section_code,
							  "SORT" => $sub_section_sort,
							);
							$current_sub_section_ID = $obj_section->Add($arSectionFields);					
						}					
					}
					$sub_section_sort = $sub_section_sort + 100;				
				}
				////////////////////////////////  SECTION3  ///////////////////////////////////
				if (strlen($sub_sub_section_code) > 0 && $current_sub_section_ID > 0)
				{								
					$sub_sub_section_code = $sub_sub_section_code;
					$current_sub_sub_section = $sub_sub_section_code;
					
					//Проверить, есть ли такой ПОД-ПОДРАЗДЕЛ, если нет, надо добавить
					
					$arFilter = array(
						"IBLOCK_ID" => $iblock_id,
						"SECTION_ID" => $current_sub_section_ID,
						"CODE" => $sub_sub_section_code,
					);
									
					$rs = CIBlockSection::GetList(array("ID"=>"ASC"), $arFilter);
					if ($rs->SelectedRowsCount() > 0)
					{					
						$arSection = $rs->GetNext();
						$current_sub_sub_section_ID = $arSection["ID"];
						
						/**
						 * Нужно активировать подраздел
						 */
						
						$arUpdateSection3Fields = array(
						  "ACTIVE" => "Y",
						  "IBLOCK_ID" => $iblock_id,
						  "NAME" => $arSection["NAME"],
						  "SORT" => $sub_sub_section_sort
						);					
						
						//xmp($current_sub_section_ID);
						
						$obj_section->Update($current_sub_sub_section_ID, $arUpdateSection3Fields);					
					} 
					else 
					{					
						//Надо добавить новый под-подраздел

						$sub_section_name = trim(str_replace('#','',iconv('utf-8', 'utf-8', $worksheet->getCellByColumnAndRow(0, $row)->getValue())));
						$sub_section_name = trim(str_replace('#','',$sub_section_name));
						//$section_name = trim($data->sheets[0]['cells'][$i][1]);
						
						//xmp($section_name.' / '.$sub_section_code);
						
						if (strlen($sub_section_name) > 0)
						{
							$arSection3Fields = Array(
							  "ACTIVE" => "Y",
							  "IBLOCK_SECTION_ID" => $current_sub_section_ID,
							  "IBLOCK_ID" => $iblock_id,
							  "NAME" => $sub_section_name,
							  "CODE" => $sub_sub_section_code,
							  "SORT" => $sub_sub_section_sort
							);
							$current_sub_sub_section_ID = $obj_section->Add($arSection3Fields);	
							$arr[] = $current_sub_sub_section_ID;
						}					
					}
					$sub_sub_section_sort = $sub_sub_section_sort + 100;				
				}
			} 
			/*else {
				if(!$current_top_section_ID || !$current_sub_section_ID){
					// Раздел не найден и не добавлен
					continue;
				}			
			}*/
			// переходим к след. записи, это подраздел
		} 
		else 
		{
			//Это элемент

			//echo $current_sub_sub_section_ID . '<br>';
			//echo $worksheet->getCellByColumnAndRow(0, $row) . '<br>';

			if (!$current_top_section_ID || !$current_sub_section_ID || !$current_sub_sub_section_ID)
            {
				//xmp($row);
				// Текущщий раздел не задан
				continue;
			}			
			
			////////////////////////////////////////////////////////////////////////////////////
			// Формируем массив полей
					
			$picture_url_key = array_search('IMAGE', $arFields);
			$cell = $worksheet->getCellByColumnAndRow($picture_url_key, $row);
			$picture_url = trim(iconv('utf-8', 'utf-8', $cell->getValue()));

			//$picture_url = trim($data->sheets[0]['cells'][$i][$picture_url_key]);
			
			if (strlen($picture_url)>0){}
			
			//Формируем массив свойств	
			
			$arItemProperties = array();
			foreach ($arFields as $key => $fields_name)
			{
				if (!in_array(strtoupper($fields_name), array("SORT","NAME", "SECTION1_CODE", "SECTION2_CODE", "SECTION3_CODE")))
				{
					$cell = $worksheet->getCellByColumnAndRow($key, $row);
					//$arItemProperties[strtolower($fields_name)] = trim(iconv('utf-8', 'utf-8', $cell->getValue()));
					$arItemProperties[strtoupper($fields_name)] = trim(iconv('utf-8', 'utf-8', $cell->getValue()));
					
					//$arItemProperties[strtolower($fields_name)] = trim($data->sheets[0]['cells'][$row][$key]);
				}
			}
			$arItemProperties["FORM_QUESTION"] = array("VALUE_XML_ID" => "YES", "XML_ID" => "68");
			//xmp($arItemProperties); //continue;
			
			//Ищем текущий товар в инфоблоке
			
	/*		xmp($arItemFields);
			xmp($arItemProperties);
			if($row == 10) die();  */
					
			$arFilter = array(
				"IBLOCK_ID" => $iblock_id,
				//"NAME" => $arItemFields["NAME"],
				"SECTION_ID" => $current_sub_sub_section_ID,
                "INCLUDE_SUBSECTIONS" => "Y",
				//"PROPERTY_item_id" => $arItemProperties["item_id"],
				"PROPERTY_item_id" => $arItemProperties["ITEM_ID"],
			);
			$rs = CIBlockElement::GetList(array("ID"=>"ASC"), $arFilter);
			if ($arElement = $rs->GetNextElement())
			{
				//show($arElement);
				// Товар найден, нужно обновить, если отличается
					
				$sort_key = array_search('SORT', $arFields);
				$cell = $worksheet->getCellByColumnAndRow($sort_key, $row);
				$sort = trim(iconv('utf-8', 'utf-8', $cell->getValue()));
				
				$cell = $worksheet->getCellByColumnAndRow(0, $row);
				$arItemFields = array(
					"ACTIVE"=> "Y",
					"NAME"=> trim(iconv('utf-8', 'utf-8', $cell->getValue())),
					"IBLOCK_ID" => $iblock_id,
					"SORT"=>$sort,
					"IBLOCK_SECTION" => $current_sub_sub_section_ID,
				);
				
				$arElementFields = $arElement->GetFields();
				$arElementProperties = $arElement->GetProperties();
				
				$elementID = $arElementFields["ID"];
				$bNeedUpdatePicture = false;
				$bNeedUpdate = false;
				
				$UpdatePropertiesArray = array();
				
				foreach ($arElementProperties as $pCode=>$pArray)
				{				
					//xmp($arItemProperties[strtolower($pCode)]);
					//$UpdatePropertiesArray[$pCode] = $pArray["VALUE"];
					
					if (trim($pArray["VALUE"]) != trim($arItemProperties[strtoupper($pCode)]) && 
					strlen(trim($arItemProperties[strtoupper($pCode)])) >0 )
					{
						$bNeedUpdate = true;
						$UpdatePropertiesArray[$pCode] = trim($arItemProperties[strtoupper($pCode)]);
					}
				}

				
				$arimageUrl = '';
				if (strlen($arItemProperties["IMAGE"]) > 0 && $arElementProperties["IMAGE"]["VALUE"] != $arItemProperties["IMAGE"])
				{
					// Нужно обновить картинку
							
					$arFile = CFile::MakeFileArray($document_root.str_replace(' ', '', $arItemProperties["IMAGE"]));
					if (is_array($arFile)){
						/*xmp($arItemProperties);
						xmp($arFile);
						die();*/
					}
					if (strlen($arFile["tmp_name"]) > 0)
					{
						$arItemFields["DETAIL_PICTURE"] = $arFile;
						$arItemFields["PREVIEW_PICTURE"] = $arFile;
						$bNeedUpdatePicture = true;
					} 
					else {
						unset($arItemProperties["IMAGE"]);
					}
				} 
				else {
					unset($arItemProperties["IMAGE"]);
				}
				
				$arItemFields["ACTIVE"] = "Y";
				$obj_element->Update($elementID, $arItemFields);

				if($bNeedUpdate){
					foreach ($UpdatePropertiesArray as $pCode => $newValue){
						CIBlockElement::SetPropertyValueCode($elementID, $pCode, $newValue);
					}
				}
				
				/*
				xmp($arItemProperties);
				xmp($UpdatePropertiesArray);
				xmp($arElementFields);
				xmp($arElementProperties);
				if(!$bNeedUpdate) xmp(111);
				die();
				*/
						
			} 
			else 
			{
				// Товар не найден, надо добавить
				
				$sort_key = array_search('SORT', $arFields);
				$cell = $worksheet->getCellByColumnAndRow($sort_key, $row);
				$sort = trim(iconv('utf-8', 'utf-8', $cell->getValue()));
				$cell = $worksheet->getCellByColumnAndRow(0, $row);
				
				//echo $current_sub_sub_section_ID . '<br>';
				$arItemFields = array(
					"ACTIVE"=> "Y",
					"NAME"=> trim(iconv('utf-8', 'utf-8', $cell->getValue())),
					"IBLOCK_ID" => $iblock_id,
					//"IBLOCK_SECTION" => $current_sub_section_ID,
					"IBLOCK_SECTION_ID" => $current_sub_sub_section_ID,
					"SORT"=>$sort,
				);
				if (strlen($arItemProperties["IMAGE"]) > 0)
				{
					// Надо обновить картинку
					$arFile = CFile::MakeFileArray($document_root.str_replace(' ','',$arItemProperties["IMAGE"]));
					if (strlen($arFile["tmp_name"]) > 0)
					{
						$arItemFields["DETAIL_PICTURE"] = $arFile;
						$arItemFields["PREVIEW_PICTURE"] = $arFile;
					} 
					else
						unset($arItemProperties["IMAGE"]);
				}
				$arItemFields["PROPERTY_VALUES"] = $arItemProperties;
				//xmp($arItemFields);
				$PRODUCT_ID = $obj_element->Add($arItemFields);
				if($PRODUCT_ID)
					  echo "New ID: ".$PRODUCT_ID;
				else
echo "Error: ".$obj_element->LAST_ERROR;
			}
			
			/*xmp('---------------------------------------------');
			xmp($current_top_section_ID);
			xmp($current_sub_section_ID);
			xmp($data->sheets[0]['cells'][$i]);*/
			
		}
	}
}
//show($arr);
$time_end = microtime(true);
$execution_time = ($time_end - $time_start);
echo '<b>Total Execution Time:</b> '. round($execution_time, 2).' sec';

?>
