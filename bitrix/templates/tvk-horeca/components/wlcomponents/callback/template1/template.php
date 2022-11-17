<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>	
<a href="#" onclick="return openCallBackModal();" id="order-call"><?=GetMessage("ORDER_CALL")?></a>
<div class="modal fade" id="callBack">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<div class="modal-title"><?=GetMessage("CALLBACK")?></div>
	  </div>
	  <form method="POST" action="/bitrix/components/wlcomponents/callback/ajax.php" id="callBackForm">
	  <div class="modal-body">
		<div id="form">
			<label><?=GetMessage("PHONE_NUMBER")?></label>
			<input type="text" id="phone" name="phone" placeholder="<?=GetMessage("INPUT_PHONE_NUMBER")?>" />
			<label><?=GetMessage("FIO")?></label>
			<input type="text" id="fio" name="fio" placeholder="<?=GetMessage("INPUT_FIO")?>" />
			<?if (in_array("EMAIL", $arParams["ADDITIONAL_FIELDS"])) {?>
				<label><?=GetMessage("EMAIL")?></label>
				<input type="text" id="email" name="email" placeholder="<?=GetMessage("INPUT_EMAIL")?>"></input>
			<? } ?>
			<?if (in_array("COMMENTS", $arParams["ADDITIONAL_FIELDS"])) {?>
				<label><?=GetMessage("COMMENTS")?></label>
				<textarea id="question" name="question"></textarea>
			<? } ?>
			<?if (in_array("TIME", $arParams["ADDITIONAL_FIELDS"])) {?>
				<label><?=GetMessage("TIME")?></label>
				<input type="hidden" id="time" name="time"></input>
				<div id="slider-range" class="ui-slider"></div>
			<? } ?>
		</div>
		<div id="thanks" class="hide">
			<p><?=GetMessage("THANKS")?></p>
		</div>
	  </div>
	  </form>
	  <div class="modal-footer">
		<button type="submit" class="btn" id="send_btn"><?=GetMessage("REQUEST")?></button>
		<button type="button" class="btn hide" id="close_btn" data-dismiss="modal" aria-hidden="true"><?=GetMessage("CLOSE")?></button>
	  </div>
	</div>
  </div>
</div>