<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<table><tr>
<td id="login"><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"popup",
	Array(
		"REGISTER_URL" => "",
		"FORGOT_PASSWORD_URL" => "",
		"PROFILE_URL" => "",
		"SHOW_ERRORS" => "N"
	)
);?>
</td>
<td style="vertical-align: middle">
<a href="/" title="Главная"><img width="12" height="11" src="<?=BX_PERSONAL_ROOT?>/templates/tvk-retail/images/icons/home.gif" alt="Главная" border="0" /></a>

</td>
<td style="vertical-align: middle">
	<a href="/retail/contacts/feedback.php" title="Написать сообщение"><img width="14" height="9" src="<?=BX_PERSONAL_ROOT?>/templates/tvk-retail/images/icons/letter.gif" alt="Написать сообщение" vspace="2px" border="0" /></a>

</td style="vertical-align: middle">
<td>
<noindex><a href="<?=htmlspecialchars($APPLICATION->GetCurUri("print=Y"));?>" title="Версия для печати" rel="nofollow"><img width="12" height="12" src="<?=BX_PERSONAL_ROOT?>/templates/tvk-retail/images/icons/printer.gif" alt="Версия для печати" border="0" /></a></noindex>
</td>
</tr></table>