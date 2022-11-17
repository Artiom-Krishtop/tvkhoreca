<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult["FORM_TYPE"] == "login"):?>



<div id="login-form-window-float">

<a href="" onclick="$('#login-form-window-float').toggle(); $('#login-form-window-float').offset({ top: 0, left: 0}); return false;" style="float:right; z-index: 999999;"><?=GetMessage("AUTH_CLOSE_WINDOW")?></a>

<p>Для просмотра этой страницы Вам необходимо авторизоваться как дилер</p>

<span id="auth-result"></span>
<span style="color: red;" id="login-form-window-float-err"></span>
<span id="login-form-window-float-ok" style="color: green;"></span>
<?
if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
	ShowMessage($arResult['ERROR_MESSAGE']);
?>

<form id="login-form-float" method="post" target="_top" action="<?=$arResult["BACKURL"]?>">

	<?
	
	if (strlen($arResult["BACKURL"]) > 0)
	{
	
	?>
		<input type='hidden' name='backurl' value='<?=$arResult["BACKURL"]?>' />
	<?
	}
	?>
	<?
	foreach ($arResult["POST"] as $key => $value)
	{
	?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
	<?
	}
	?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
	<input type="hidden" name="DEALER" value="Y" />

	<table width="95%">
			<tr>
				<td colspan="2">
				<?=GetMessage("AUTH_LOGIN")?>:<br />
				<input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" /></td>
			</tr>
			<tr>
				<td colspan="2">
				<?=GetMessage("AUTH_PASSWORD")?>:<br />
				<input type="password" name="USER_PASSWORD" maxlength="50" size="17" /></td>
			</tr>
		<?
		if ($arResult["STORE_PASSWORD"] == "Y") 
		{
		?>
			<tr>
				<td valign="top"><input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" /></td>
				<td width="100%"><label for="USER_REMEMBER"><?=GetMessage("AUTH_REMEMBER_ME")?></label></td>
			</tr>
		<?
		}
		?>
			<tr>
				<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
			</tr>

			<tr>
				<td colspan="2"><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></td>
			</tr>
<!--		<?

		if($arResult["NEW_USER_REGISTRATION"] == "Y")
		{
		?>
			<tr>
				<td colspan="2"><a href="<?=$arResult["AUTH_REGISTER_URL"]?>"><?=GetMessage("AUTH_REGISTER")?></a><br /></td>
			</tr>
		<?
		}
		?>
-->
	</table>	
</form>
</div>

<?else:?>



<div id="login-form-window-float">

<a href="" onclick=" if(!bx_auth) { $('#login-form-window-float').toggle(); $('#login-form-window-float').offset({ top: 0, left: 0}); return false; }" style="float:right; z-index: 999999;"><?=GetMessage("AUTH_CLOSE_WINDOW")?></a>

<p>Для просмотра этой страницы Вам необходимо авторизоваться как дилер</p>

<form action="<?=$arResult["AUTH_URL"]?>">

<?=$arResult["USER_NAME"]?>

<?foreach ($arResult["GET"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="logout" value="yes" />
	<input type="image" src="<?=$templateFolder?>/images/login.gif" alt="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>">
</form>

</div>


<?endif?>