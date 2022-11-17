<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<?	$APPLICATION->IncludeFile("/bitrix/components/wlcomponents/callback/lang/ru/ajax.php"); 
	if(empty($_POST["fio"]) or strlen($_POST["fio"]) < 2)
		$json["error"][] = GetMessage("ERROR_NAME");
		
	if(empty($_POST["phone"]) or strlen($_POST["phone"]) < 2)
		$json["error"][] = GetMessage("ERROR_PHONE");
		
	if(empty($json["error"]))
	{
		
		CModule::IncludeModule("iblock");
		
		$MESSAGE_TEXT = GetMessage("PHONE") . htmlspecialcharsEx($_POST["phone"]);
		if (!empty($_POST["email"]))
			$MESSAGE_TEXT .= GetMessage("EMAIL") . htmlspecialcharsEx($_POST["email"]);
		if (!empty($_POST["question"]))
			$MESSAGE_TEXT .= GetMessage("COMMENT") . $APPLICATION->ConvertCharset(htmlspecialcharsEx($_POST["question"]),'UTF-8',SITE_CHARSET);
		if (!empty($_POST["time"]))
			$MESSAGE_TEXT .= GetMessage("TIME") . htmlspecialcharsEx($_POST["time"]);
		
		// получаем ID инфоблока
		$rsIBlock = CIBlock::GetList(Array(), Array("CODE" => "wlcallback", "ACTIVE" => "Y", "CHECK_PERMISSIONS" => "N"));
		if($arIBlock = $rsIBlock->GetNext())
		{
			$arFields = array(
						"NAME" => $APPLICATION->ConvertCharset(htmlspecialcharsEx($_POST["fio"]),'UTF-8',SITE_CHARSET),
						"ACTIVE" => "Y",
						"IBLOCK_ID" => $arIBlock["ID"],
						"DETAIL_TEXT" => $MESSAGE_TEXT,
					);
					
			$el = new CIBlockElement;
			$ID = $el->Add($arFields);
		}
		
		if (!empty($ID))
		{
			$json["success"][] = "1";
			
			// работаем с письмами
			$admEmails = '';
			if(COption::GetOptionString('wl.callback', 'ADMIN_NOTIFICATION') == "Y")
			{
				$adminEmail = COption::GetOptionString('main', 'email_from');
				if(!empty($adminEmail))
					$admEmails .= $adminEmail . ', ';
			}
			$addEmails = COption::GetOptionString('wl.callback', 'ADDITIONAL_EMAILS');
			if(!empty($addEmails))
				$admEmails .= $addEmails;
				
			if(!empty($admEmails) || !empty($_POST["email"]))
			{
				$arLetter = Array(
					"ID" => $ID,
					"ADMIN_EMAIL" => $admEmails,
					"USER_EMAIL" => $_POST["email"],
					"NAME" => $APPLICATION->ConvertCharset($_POST["fio"],'UTF-8',SITE_CHARSET),
					"PHONE" => $APPLICATION->ConvertCharset($_POST["phone"],'UTF-8',SITE_CHARSET),
					"QUESTION" => $APPLICATION->ConvertCharset($_POST["question"],'UTF-8',SITE_CHARSET),
					"TIME" => $_POST["time"]
				);
				CEvent::Send("WL_CALLBACK", "s1", $arLetter);
			}
			
		} else
			$json["error"][] = "Error";
	}
	
	print_r(json_encode($json));
?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>
