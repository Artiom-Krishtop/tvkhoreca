<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$frame = $this->createFrame()->begin('')?>
<?
$bLeftAndRight = false;
if(is_array($arResult["QUESTIONS"])){
	foreach($arResult["QUESTIONS"] as $arQuestion){
		if($arQuestion["STRUCTURE"][0]["FIELD_PARAM"] == 'left'){
			$bLeftAndRight = true;
			break;
		}
	}
}
?>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackRecap&render=<?=GoogleReCaptcha::getPublicKey();?>" async defer></script>
    <script>
        var onloadCallbackRecap = function() {
            grecaptcha.ready(function () {
                grecaptcha.execute('<?=GoogleReCaptcha::getPublicKey();?>', { action: 'contact_callback' }).then(function (token) {
                    var recaptchaResponse = document.getElementById('recaptchaResponse');
                    if (recaptchaResponse != null && recaptchaResponse.value == '') {
                        recaptchaResponse.value = token;
                    }
                });
            });
        };
    </script>
<div class="maxwidth-theme">
<div class="form inline <?=$arResult["arForm"]["SID"]?>">
	<!--noindex-->
	<div class="form_head">
		<?if($arResult["isFormTitle"] == "Y"):?>
			<h4><?=$arResult["FORM_TITLE"]?></h4>
		<?endif;?>
		<?if($arResult["isFormDescription"] == "Y"):?>
			<div class="form_desc"><?=$arResult["FORM_DESCRIPTION"]?></div>
		<?endif;?>
	</div>
	<?if($arResult["isFormErrors"] == "Y" || strlen($arResult["FORM_NOTE"])):?>
		<div class="form_result <?=($arResult["isFormErrors"] == "Y" ? 'error' : 'success')?>">
			<?if($arResult["isFormErrors"] == "Y"):?>
				<?=$arResult["FORM_ERRORS_TEXT"]?>
			<?else:?>
				<?$successNoteFile = SITE_DIR."include/form/success_{$arResult["arForm"]["SID"]}.php";?>
				<?if(file_exists($_SERVER["DOCUMENT_ROOT"].$successNoteFile)):?>
				<?$APPLICATION->IncludeFile($successNoteFile, array(), array("MODE" => "html", "NAME" => "Form success note"));?>
				<?else:?>
					<?=GetMessage("FORM_SUCCESS");?>
				<?endif;?>
				<script>
					if(arMShopOptions['THEME']['USE_FORMS_GOALS'] !== 'NONE')
					{
						var eventdata = {goal: 'goal_webform_success' + (arMShopOptions['THEME']['USE_FORMS_GOALS'] === 'COMMON' ? '' : '_<?=$arResult["arForm"]["ID"]?>')};
						BX.onCustomEvent('onCounterGoals', [eventdata]);
					}
				</script>
			<?endif;?>
		</div>
	<?endif;?>
	<?if($arParams['HIDE_SUCCESS'] != 'Y' || ($arParams['HIDE_SUCCESS'] == 'Y' && !strlen($arResult["FORM_NOTE"]))):?>
		<?=$arResult["FORM_HEADER"]?>
		<?=bitrix_sessid_post();?>
		<div class="form_body">
			<?if(is_array($arResult["QUESTIONS"])):?>
				<?if(!$bLeftAndRight):?>
					<?foreach($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
						<?CMShop::drawFormField($FIELD_SID, $arQuestion);?>
					<?endforeach;?>
				<?else:?>
					<div class="row">
						<div class="col-md-7">
							<?foreach($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
								<?if($arQuestion["STRUCTURE"][0]["FIELD_PARAM"] == 'left'):?>
									<?CMShop::drawFormField($FIELD_SID, $arQuestion);?>
								<?endif;?>
							<?endforeach;?>
						</div>
						<div class="col-md-5">
							<?foreach($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
								<?if($arQuestion["STRUCTURE"][0]["FIELD_PARAM"] != 'left'):?>
									<?CMShop::drawFormField($FIELD_SID, $arQuestion);?>
								<?endif;?>
							<?endforeach;?>
						</div>
					</div>
				<?endif;?>
			<?endif;?>
			<div class="clearboth"></div>
			<?$bHiddenCaptcha = (isset($arParams["HIDDEN_CAPTCHA"]) ? $arParams["HIDDEN_CAPTCHA"] : COption::GetOptionString("aspro.max", "HIDDEN_CAPTCHA", "Y"));
            //$arResult["isUseCaptcha"] = "N";
            ?>
			<?if($arResult["isUseCaptcha"] == "Y"):?>
                <?
                // reCAPTCHA v3
                ?><input type="hidden" name="recaptcha_response" id="recaptchaResponse"><?
                global $DB;
                $sid = htmlspecialcharsbx($arResult["CAPTCHACode"]);
                $userCode = '';
                if (strlen($sid) > 0)
                {
                    $res = $DB->Query("SELECT CODE FROM b_captcha WHERE ID = '".$DB->ForSQL($sid,32)."' ");
                    if ($ar = $res->Fetch())
                        $userCode = $ar["CODE"];
                }
                ?>
                <input type="hidden" name="captcha_sid" value="<?=$sid;?>" />
                <input type="hidden" name="captcha_word" value="<?=$userCode;?>" />
                <?
                ?>
				<!--<div class="form-control captcha-row clearfix">
					<label><span><?/*=GetMessage("FORM_CAPRCHE_TITLE")*/?>&nbsp;<span class="star">*</span></span></label>
					<div class="captcha_image">
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?/*=htmlspecialcharsbx($arResult["CAPTCHACode"])*/?>" border="0" />
						<input type="hidden" name="captcha_sid" value="<?/*=htmlspecialcharsbx($arResult["CAPTCHACode"])*/?>" />
						<div class="captcha_reload"></div>
					</div>
					<div class="captcha_input">
						<input type="text" class="inputtext captcha" name="captcha_word" size="30" maxlength="50" value="" required />
					</div>
				</div>-->
			<?elseif($bHiddenCaptcha == "Y"):?>
				<textarea name="nspm" style="display:none;"></textarea>
			<?endif;?>
			<div class="clearboth"></div>
		</div>
		<div class="form_footer">
            <input type="hidden" class="btn btn-default" value="<?=$arResult["arForm"]["BUTTON"]?>" name="web_form_submit">
			<button type="submit" class="button medium" value="submit" ><span><?=$arResult["arForm"]["BUTTON"]?></span></button>
			<button type="reset" class="button medium transparent" value="reset" name="web_form_reset" ><span><?=GetMessage('FORM_RESET')?></span></button>
			<script type="text/javascript">
			$(document).ready(function(){
				$('form[name="<?=$arResult["arForm"]["VARNAME"]?>"]').validate({
					highlight: function( element ){
						$(element).parent().addClass('error');
					},
					unhighlight: function( element ){
						$(element).parent().removeClass('error');
					},
					submitHandler: function( form ){
                        if( $('form[name="<?=$arResult["arForm"]["VARNAME"]?>"]').valid() ){
                            setTimeout(function() {
                                $(form).find('button[type="submit"]').attr("disabled", "disabled");
                            }, 500);
                            var eventdata = {type: 'form_submit', form: form, form_name: '<?=$arResult["arForm"]["VARNAME"]?>'};
                            BX.onCustomEvent('onSubmitForm', [eventdata]);
                        }
					},
					errorPlacement: function( error, element ){
						error.insertBefore(element);
					},
					messages:{
				      licenses_inline: {
				        required : BX.message('JS_REQUIRED_LICENSES')
				      }
					}
				});

				if(arMShopOptions['THEME']['PHONE_MASK'].length){
					var base_mask = arMShopOptions['THEME']['PHONE_MASK'].replace( /(\d)/g, '_' );
					$('form[name=<?=$arResult["arForm"]["VARNAME"]?>] input.phone, form[name=<?=$arResult["arForm"]["VARNAME"]?>] input[data-sid=PHONE]').inputmask('mask', {'mask': arMShopOptions['THEME']['PHONE_MASK'] });
					$('form[name=<?=$arResult["arForm"]["VARNAME"]?>] input.phone, form[name=<?=$arResult["arForm"]["VARNAME"]?>] input[data-sid=PHONE]').blur(function(){
						if( $(this).val() == base_mask || $(this).val() == '' ){
							if( $(this).hasClass('required') ){
								$(this).parent().find('label.error').html(BX.message('JS_REQUIRED'));
							}
						}
					});
				}
			});
			</script>
		</div>
		<?=$arResult["FORM_FOOTER"]?>
	<?else:?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('body, html').animate({scrollTop: 0}, 500);
			});
		</script>
	<?endif;?>
	<!--/noindex-->
</div>
</div>
<?$frame->end()?>