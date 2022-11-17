<?if($arResult["ID"]):?>
	<?
	CModule::IncludeModule('catalog');
	$dbRes = CCatalogStore::GetList(array('ID' => 'ASC'), array('ID' => $arResult["ID"]), false, false, array("ID", "EMAIL", "UF_METRO", "UF_MORE_PHOTOS", "UF_PHONES"));
	if($arStore = $dbRes->GetNext()){
		$arResult["EMAIL"] = htmlspecialchars_decode($arStore["EMAIL"]);
		$arResult["MORE_PHOTOS"] = unserialize($arStore["UF_MORE_PHOTOS"]);
		$arResult["METRO_PLACEMARK_HTML"] = '';
		if($arResult["METRO"] = unserialize($arStore["~UF_METRO"])){
			foreach($arResult['METRO'] as $metro){
				$arResult["METRO_PLACEMARK_HTML"] .= '<div class="metro"><i></i>'.$metro.'</div>';
			}
		}
		$arResult["PHONE"] = array_merge(explode(",",$arResult["PHONE"]), unserialize($arStore['~UF_PHONES']));
	}
	?>
<?else:?>
	<?LocalRedirect(SITE_DIR.'contacts/');?>
<?endif;?>
