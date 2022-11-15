<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="search-form">
<form action="<?=$arResult["FORM_ACTION"]?>">
	<table border="0" cellspacing="0" cellpadding="2" align="right">
		<tr>
			<td><nobr>Поиск: &nbsp; <?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
				"bitrix:search.suggest.input",
				"",
				array(
					"NAME" => "q",
					"VALUE" => "",
					"INPUT_SIZE" => 135,
					"DROPDOWN_SIZE" => 10,
				),
				$component, array("HIDE_ICONS" => "Y")
			);?><?else:?><input type="text" name="q" value="" style="width:500px; height:22px;" maxlength="70" /><?endif;?></nobr></td>
		
			<td align="right">&nbsp;<input name="s" type="submit" value="Найти" style="border: 1px solid #aaaaaa; border-radius:5px; background:#eeeeee; height: 22px; width:60px; cursor: pointer;" /></td>
		</tr>
	</table>
</form>
</div>