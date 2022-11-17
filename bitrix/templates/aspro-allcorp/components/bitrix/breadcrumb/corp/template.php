<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();

if( empty( $arResult ) )
	return "";

$strReturn = '<ul class="breadcrumb">';

for( $index = 0, $itemSize = count($arResult); $index < $itemSize; $index++ ){
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	if( $arResult[$index]["LINK"] <> "" && $arResult[$index]['LINK'] != GetPagePath() && $arResult[$index]['LINK']."index.php" != GetPagePath())
		$strReturn .= '<li><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
	else{
		$strReturn .= '<li class="active">'.$title.'</li>';
		break;
	}
}

$strReturn .= '</ul>';
return $strReturn;?>