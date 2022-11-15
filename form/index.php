<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заполнение формы");
?>
<?$id=(int)$_GET["FORM_ID"];
$service=htmlspecialchars($_GET["SERVICE"]);
if($id){?>
	<?$APPLICATION->IncludeComponent(
		"aspro:form",
		$id == 17 ? "callback" : "popup",
		Array(
			"IBLOCK_TYPE" => "aspro_form",
			"IBLOCK_ID" => $id,
			"USE_CAPTCHA" => COption::GetOptionString("aspro.allcorp", "USE_CAPTCHA_FORM"),
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_JUMP" => "Y",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "100000",
			"AJAX_OPTION_ADDITIONAL" => "",
			//"IS_PLACEHOLDER" => "Y",
			"SUCCESS_MESSAGE" => $id == 17 ? "<p>Наш менеджер перезвонит вам в ближайшее время.</p><p>Спасибо за ваше обращение!</p>" : "Спасибо! Ваше сообщение отправлено!",
			"SEND_BUTTON_NAME" => "Отправить",
			"SEND_BUTTON_CLASS" => "btn btn-primary",
			"DISPLAY_CLOSE_BUTTON" => "N",
			"CLOSE_BUTTON_NAME" => "Закрыть",
			"CLOSE_BUTTON_CLASS" => "jqmClose btn btn-primary bottom-close",
			"SERVICE" => $service
		)
	);?>
<?}else{?>
	<div class="alert alert-warning">Не указан ID формы</div>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>