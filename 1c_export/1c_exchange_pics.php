<?
$start_mem = memory_get_usage();
$start_time = time();
$IBLOCK_ID = 54;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");
set_time_limit(0);
ini_set('memory_limit', '1024M');

$dir = "/upload/tvk_images/new_images/";
$path = $_SERVER['DOCUMENT_ROOT'].$dir;

$tmp_file = file_get_contents('tmp');
$arRes = unserialize($tmp_file);

if(empty($arRes['images'])){
	$handle = opendir($path);
	if ($handle) {
		//получаем список всех картинок
	    while (false !== ($file = readdir($handle))) { 
	        if ($file != "." && $file != "..") { 
		        $article = substr($file, 0, -4);
	            $images[$article] = $file;
	            //$articles[] = $article;
	        } 
	    }
	}
	closedir($handle);
	$arRes['counter'] = 0;
} else {
	$images = $arRes['images'];
}

$articles = array_keys($images);


//начало обработки

if(is_array($articles)){
	$not_found = 'Y';
	
    $arSelect = Array("ID", "DETAIL_PICTURE", "PROPERTY_KOD");
    $arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "PROPERTY_KOD" => $articles, 'ACTIVE'=>'Y');
    $res = CIBlockElement::GetList(Array(), $arFilter, false, array('nTopCount' => 100), $arSelect);
    
    while ($ob = $res->GetNextElement()) {
	    $not_found = 'N';

    	$el = new CIBlockElement;                       
        $ar_res = $ob->GetFields();
        $ELEMENT_ID = $ar_res["ID"];
         $imgPath = $path.$images[$ar_res["PROPERTY_KOD_VALUE"]];
        
        $arFile_image = CFile::MakeFileArray($imgPath);

        $arLoadProductArray = Array(
            "DETAIL_PICTURE" => $arFile_image,
            "PREVIEW_PICTURE" => $arFile_image
        );

        if ($arFile_image != null) {
	        $arRes['counter']++;
	        unset($images[$ar_res["PROPERTY_KOD_VALUE"]]);
            $el->Update($ELEMENT_ID, $arLoadProductArray, false, true, true);
            //CFile::Delete(intval($ar_res['DETAIL_PICTURE']));
        }

        $arFile_image = null;
        $arLoadProductArray = null;
        $el = null;
        $k++;	

    }     
}
/*
//удаляем файлы
if(is_array($images)){
	foreach($images as $key=>$dfile){
		//sunlink($path.$dfile);
		//echo $path.$dfile;
	}
}
*/
$arRes['images'] = $images;
$tmp_file = serialize($arRes);
file_put_contents('tmp', $tmp_file);

$end_mem = memory_get_usage();
$end_time = time();	

$total_mem = $end_mem - $start_mem;
$total_time = $end_time - $start_time;

?>
<html>
	<head>
		<?
		CJSCore::Init(array("jquery"));
		$APPLICATION->ShowHead()
		?>
		<?if(!empty($images) && $not_found != 'Y'){?>
			<script>
				function reloadPage(){
					location.reload();
				}
				$(document).ready(function(){
					setTimeout( 
						reloadPage()
					, 1000 );
				});
			</script>
		<?}?>
	</head>
	<body>
		<?
		echo 'Память: '.round($total_mem/1024/1024).' МБ<br>';
		echo 'Время: '.$total_time.' сек<br>';	
		echo 'Обновлено товаров с картинкой: '.$arRes['counter'].'<br>';
		if($not_found == 'Y'){
			echo '<span style="color: red">Элементов не найдено: '.count($images).'</span><br>';
			foreach(array_keys($images) as $art){
				echo $art.'<br>';
			}
		} 
		if($not_found == 'Y' or empty($images)){
			echo '<span style="color: green">Выгрузка закончена</span><br>';
			unlink('tmp');
		} 
		?>	
	</body>
</html>