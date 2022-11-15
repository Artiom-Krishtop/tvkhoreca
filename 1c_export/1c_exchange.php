<?
set_time_limit(0);
ini_set('memory_limit', '4096M');
//$_SERVER["DOCUMENT_ROOT"] = "/home/bitrix/ext_www/foroom.by";
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");

AddMessage2Log($_REQUEST);

if ($_REQUEST['exchange'] == 'yes') {

	//$IBLOCK_ID = intval($_REQUEST['iblockid']);
	$IBLOCK_ID = 54;

	$i = 0;
	$k = 0;
	$j = 0;

	CModule::IncludeModule("iblock");
	Cmodule::IncludeModule('catalog');
	$bs = new CIBlockSection;
	
	if ($_REQUEST['propupdate'] == 'yes') {
		//делаем пустые разделы неактивными
		/*$db_list = CIBlockSection::GetList(Array('name' => 'asc'), array('IBLOCK_ID' => $IBLOCK_ID), true);
		while ($arSect = $db_list->GetNext()) {
			$arSelect = Array("ID", "ACTIVE");
			$arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "SECTION_ID" => $arSect['ID'], "INCLUDE_SUBSECTIONS" => "Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			$i = 0;
			$sum = 0;
			while ($ob = $res->GetNextElement()) {
				$arFields = $ob->GetFields();
				$sum++;
				if ($arFields['ACTIVE'] != 'Y') {
					$i++;
				}
			}
			if ($sum == $i && $arSect['DEPTH_LEVEL']) {
				$arFields = Array(
					"ACTIVE" => 'N',
				);
				$bs->Update(intval($arSect['ID']), $arFields);
			}
		}
		$db_list = null;
		$i = null;
		$sum = null;
		$arFields = null;
		$arSect = null;
		$res = null;
		$ob = null;*/
		//конец деактивации разделов без элементов
		
		//все значения реквизитов по одноименным полям
		$arSelect = Array("ID");
		$arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "DATE_MODIFY_FROM" => date('d.m.Y H:i:s', strtotime("-4 hours")));
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while ($ob = $res->GetNextElement()) {
			$ar_res = $ob->GetFields();
			$CML2_ATTRIBUTES = CIBlockElement::GetProperty($IBLOCK_ID, $ar_res["ID"], array("sort" => "asc"), Array("CODE" => "CML2_TRAITS"));
			while ($CML2_ATTRIBUTE = $CML2_ATTRIBUTES->GetNext()) {
				$VALUE = $CML2_ATTRIBUTE['VALUE'];
				$DESCRIPTION = $CML2_ATTRIBUTE['DESCRIPTION'];
				if (!empty($VALUE)) {
					$PROP = CIBlockElement::GetProperty($IBLOCK_ID, $ar_res["ID"], array("sort" => "asc"), Array("NAME" => $DESCRIPTION));
					if ($ar_props = $PROP->Fetch()) {
						CIBlockElement::SetPropertyValuesEx($ar_res["ID"], $IBLOCK_ID, array($ar_props['CODE'] => $VALUE));
					}
	
					// картинки
					if ($_REQUEST['picture1'] == 'yes') {
						/*if ($ar_props['CODE'] == "FAYL_DOKUMENTATSII_K_TOVARU") {
						
							$arFile_doc = CFile::MakeFileArray('/upload/tvk_images/'.$VALUE);
							
							$doc = CIBlockElement::GetProperty($IBLOCK_ID, $ELEMENT_ID, array("sort" => "asc"), Array("CODE" => "DOCS"));
							$delDoc = $doc->Fetch();
							$delDoc = $delDoc['VALUE'];
							CFile::Delete($delDoc);
							unset($delDoc, $doc);
							
							CIBlockElement::SetPropertyValueCode($ELEMENT_ID, "DOCS", $arFile_doc);
							
							unset($arFile_doc);
						}*/
	
						if ($ar_props['CODE'] == "FAYL_KARTINKI_TOVARA") {
							AddMessage2Log('FAYL_KARTINKI_TOVARA '.$ELEMENT_ID);
							$el = new CIBlockElement;
							$arFile_image = CIBlock::ResizePicture(
								CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . '/upload/tvk_images/new_images/' . $VALUE), 
								array(
									"WIDTH" => 700,
									"HEIGHT" => 700,
									"METHOD" => "resample",
									"COMPRESSION" => "75",
								)
							);
							if ($arFile_image == null) {
								$arFile_image = CIBlock::ResizePicture(
								CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . '/upload/tvk_images/new_images/' . mb_strtolower($VALUE)),
								array(
									"WIDTH" => 700,
									"HEIGHT" => 700,
									"METHOD" => "resample",
									"COMPRESSION" => "75",
								));
							}
							$arLoadProductArray = Array(
								"DETAIL_PICTURE" => $arFile_image
							);
	
							if ($arFile_image != null) {
								$el->Update($ELEMENT_ID, $arLoadProductArray);
								//CFile::Delete(intval($ar_res['DETAIL_PICTURE']));
							}
	
							$arFile_image = null;
							$arLoadProductArray = null;
							$el = null;
							$k++;
						}
	
						/*if ($ar_props['CODE'] == "FAYL_LOGOTIPA_PROIZVODITELYA") {
							AddMessage2Log('FAYL_LOGOTIPA_PROIZVODITELYA '.$ELEMENT_ID);
	
							$arFile_logo = CFile::MakeFileArray('/upload/tvk_images/' . $VALUE);
	
							$logo = CIBlockElement::GetProperty($IBLOCK_ID, $ELEMENT_ID, array("sort" => "asc"), Array("CODE" => "MAKER_LOGO"));
							$delLogo = $logo->Fetch();
							$delLogo = $delLogo['VALUE'];
	
							if ($arFile_logo != null) {
								CIBlockElement::SetPropertyValueCode($ELEMENT_ID, "MAKER_LOGO", $arFile_logo);
								CFile::Delete(intval($delLogo));
							}
	
							$delLogo = null;
							$logo = null;
							$arFile_logo = null;
							$j++;
						}*/
					}
				}
				$CML2_ATTRIBUTE = null;
				$PROP = null;
				$ar_props = null;
			}
			$i++;
			$ar_res = null;
			$ob = null;
		}
		AddMessage2Log('всего товаров: ' . $i . ' всего товаров с детальной картинкой: ' . $k . ' всего товаров с логотипом: ' . $j, 'update_prop');
		echo 'всего товаров: ' . $i . ' всего товаров с детальной картинкой: ' . $k . ' всего товаров с логотипом: ' . $j;
		$res = null;
	}

	// начало ставки НДС
	if ($_REQUEST['ndsupdate'] == 'yes') {
		
		$arSelect = Array("ID", "PROPERTY_CML2_TAXES");
		$arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "DATE_MODIFY_FROM" => date('d.m.Y H:i:s', strtotime("-4 hours")) );
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while ($ob = $res->GetNextElement()) {
			$ar_res = $ob->GetFields();
	
			//ставка ндс
			if($ar_res["PROPERTY_CML2_TAXES_VALUE"]){
				$CML2_TAXES = $ar_res["PROPERTY_CML2_TAXES_VALUE"];
				$vat = CCatalogVat::GetList(array('CSORT' => 'ASC'), array('RATE' => intval($CML2_TAXES)), array());
	
				if ($t = $vat->Fetch()) {
					$arFields = array('VAT_ID' => intval($t['ID']));
					CCatalogProduct::Update(intval($ar_res['ID']), $arFields);
				}else{
					$IDVat = CCatalogVat::Add(
						array(
							'ACTIVE' => 'Y',
							'NAME' => 'НДС ' . $CML2_TAXES . '%',
							'RATE' => intval($CML2_TAXES)
						)
					);
					$arFields = array('VAT_ID' => intval($IDVat));
					CCatalogProduct::Update(intval($ar_res['ID']), $arFields);
				}
			}
			AddMessage2Log('Обновлено НДС товаров: '.$t, 'NDS_update');
			echo 'Обновлено НДС товаров: '.$t;
			
			$db_props = null;
			$ar_props = null;
			$vat = null;
			$t = null;
			$CML2_TAXES = null;
			$arFields = null;
			$IDVat = null;
		}
	}
	// конец ставки НДС

	// начало выгрузки картинок	
	if ($_REQUEST['picture'] == 'yes') {
			
		$dir = "/upload/tvk_images/new_images/";
		$path = $_SERVER['DOCUMENT_ROOT'].$dir;
		$handle = opendir($path);
		if ($handle) {
			//получаем список всех картинок
			while (false !== ($file = readdir($handle))) { 
				if ($file != "." && $file != "..") { 
					$article = substr($file, 0, -4);
					$images[$article] = $file;
					$articles[] = $article;
				} 
			}
			//начало обработки
			$el = new CIBlockElement;
			if(is_array($articles)){
				$arSelect = Array("ID", "DETAIL_PICTURE", "PROPERTY_KOD");
				$arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "PROPERTY_KOD" => $articles);
				$res = CIBlockElement::GetList(Array("PROPERTY_KOD"=>"ASC"), $arFilter, false, false, $arSelect);
			
				while ($ob = $res->GetNextElement()) {
					$ar_res = $ob->GetFields();
		
					$imgPath = $path.$images[$ar_res["PROPERTY_KOD_VALUE"]];
					$arFile_image = CFile::MakeFileArray($imgPath);
					
					if ($arFile_image == null) {
						$arFile_image = CFile::MakeFileArray($imgPath);
					}
					
					if ($arFile_image) {
						$arLoadProductArray = Array(
							"MODIFIED_BY"    => $USER->GetID(),
							"DETAIL_PICTURE" => $arFile_image,
							"PREVIEW_PICTURE" => $arFile_image
						);
					
						$updResult = $el->Update($ar_res["ID"], $arLoadProductArray, false, false, true, true);
						//CFile::Delete(intval($ar_res['DETAIL_PICTURE']));
					}
		
					$arFile_image = null;
					$arLoadProductArray = array();
					$k++;
				}
				AddMessage2Log('Обновлено товаров с картинкой: '.$k, 'image_update');
				echo 'Обновлено товаров с картинкой: '.$k;
			}
			
			//удаляем файлы
			if(is_array($images)){
				foreach($images as $key=>$dfile){
					unlink($path.$dfile);
					//echo $path.$dfile;
				}
			}
			closedir($handle); 
		}else{
			AddMessage2Log('директория с картинками пуста');
			echo 'директория с картинками пуста';
		}
	}
	// конец выгрузки картинок
}
?>