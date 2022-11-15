<?
set_time_limit(0);
ini_set('memory_limit', '4096M');
$_SERVER["DOCUMENT_ROOT"] = "/home/bitrix/ext_www/foroom.by";
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");

AddMessage2Log($_GET);

if ($_GET['exchange'] == 'yes') {

    $i = 0;
    $k = 0;
    $j = 0;

    CModule::IncludeModule("iblock");
    Cmodule::IncludeModule('catalog');
    $bs = new CIBlockSection;

//    делаем пустые разделы неактивными
    $db_list = CIBlockSection::GetList(Array('name' => 'asc'), array('IBLOCK_ID' => 9), true);
    while ($arSect = $db_list->GetNext()) {
        $arSelect = Array("ID", "ACTIVE");
        $arFilter = Array("IBLOCK_ID" => 9, "SECTION_ID" => $arSect['ID'], "INCLUDE_SUBSECTIONS" => "Y");
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
    $ob = null;

    $arSelect = Array("ID", "DETAIL_PICTURE");
    $arFilter = Array("IBLOCK_ID" => 9);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNextElement()) {
        $ar_res = $ob->GetFields();

        //        ставка ндс
        $db_props = CIBlockElement::GetProperty(9, intval($ar_res['ID']), array("sort" => "asc"), Array("CODE" => "CML2_TAXES"));
        if ($ar_props = $db_props->Fetch()) {
            $CML2_TAXES = $ar_props["VALUE"];

            $vat = CCatalogVat::GetList(array('CSORT' => 'ASC'), array('RATE' => intval($CML2_TAXES)), array());

            if ($t = $vat->Fetch()) {
                $arFields = array('VAT_ID' => intval($t['ID']));
                CCatalogProduct::Update(intval($ar_res['ID']), $arFields);
            } else {
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
        $db_props = null;
        $ar_props = null;
        $vat = null;
        $t = null;
        $CML2_TAXES = null;
        $arFields = null;
        $IDVat = null;

//        все значения реквизитов по одноименным полям
        $IBLOCK_ID = 9;
        $ELEMENT_ID = intval($ar_res['ID']);

        $CML2_ATTRIBUTES = CIBlockElement::GetProperty($IBLOCK_ID, $ELEMENT_ID, array("sort" => "asc"), Array("CODE" => "CML2_TRAITS"));

        while ($CML2_ATTRIBUTE = $CML2_ATTRIBUTES->GetNext()) {
            $VALUE = $CML2_ATTRIBUTE['VALUE'];
            $DESCRIPTION = $CML2_ATTRIBUTE['DESCRIPTION'];
            if (!empty($VALUE)) {
                $PROP = CIBlockElement::GetProperty($IBLOCK_ID, $ELEMENT_ID, array("sort" => "asc"), Array("NAME" => $DESCRIPTION));
                if ($ar_props = $PROP->Fetch()) {
                    CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, $IBLOCK_ID, array($ar_props['CODE'] => $VALUE));
                }

                // картинки
                if ($_GET['picture'] == 'yes') {

//                if ($ar_props['CODE'] == "FAYL_DOKUMENTATSII_K_TOVARU") {
//
//                    $arFile_doc = CFile::MakeFileArray('/upload/tvk_images/' . $VALUE);
//
//                    $doc = CIBlockElement::GetProperty($IBLOCK_ID, $ELEMENT_ID, array("sort" => "asc"), Array("CODE" => "DOCS"));
//                    $delDoc = $doc->Fetch();
//                    $delDoc = $delDoc['VALUE'];
//                    CFile::Delete($delDoc);
//                    unset($delDoc, $doc);
//
//                    CIBlockElement::SetPropertyValueCode($ELEMENT_ID, "DOCS", $arFile_doc);
//
//                    unset($arFile_doc);
//                }

                    if ($ar_props['CODE'] == "FAYL_KARTINKI_TOVARA") {
//                        AddMessage2Log('FAYL_KARTINKI_TOVARA '.$ELEMENT_ID);
                        $el = new CIBlockElement;

                        $arFile_image = CIBlock::ResizePicture(CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . '/upload/tvk_images/' . $VALUE), array(
                            "WIDTH" => 700,
                            "HEIGHT" => 700,
                            "METHOD" => "resample",
                            "COMPRESSION" => "75",
                        ));
                        if ($arFile_image == null) {
                            $arFile_image = CIBlock::ResizePicture(CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . '/upload/tvk_images/' . mb_strtolower($VALUE)), array(
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
                            CFile::Delete(intval($ar_res['DETAIL_PICTURE']));
                        }

                        $arFile_image = null;
                        $arLoadProductArray = null;
                        $el = null;
                        $k++;
                    }

                    if ($ar_props['CODE'] == "FAYL_LOGOTIPA_PROIZVODITELYA") {
//                        AddMessage2Log('FAYL_LOGOTIPA_PROIZVODITELYA '.$ELEMENT_ID);

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
                    }
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
    $res = null;

    AddMessage2Log('всего товаров: ' . $i . ' всего товаров с детальной картинкой: ' . $k . ' всего товаров с логотипом: ' . $j);
}

//?exchange=yes&picture=yes
?>