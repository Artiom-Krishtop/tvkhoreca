<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>

<div class="form <?=$arParams["POPUP"] ? 'popup' : ''?>">
	<?if( $arResult["isFormNote"] == "Y" ){?>
		<div class="form-header">
			<i class="icon icon-check"></i>
			<div class="text">
				<div class="title"><?=GetMessage("SUCCESS_TITLE")?></div>
				<?=$arResult["FORM_NOTE"]?>
			</div>
		</div>
		<?if( $arParams["DISPLAY_CLOSE_BUTTON"] == "Y" ){?>
			<div class="form-footer" style="text-align: center;">
				<?=$arResult["CLOSE_BUTTON"]?>
			</div>
		<?}
	}else{?>
		<?=$arResult["FORM_HEADER"]?>
			<div class="form-header">
				<i class="icon icon-phone"></i>
				<div class="text">
					<?if( $arResult["isIblockTitle"] ){?>
						<div class="title"><?=$arResult["IBLOCK_TITLE"]?></div>
					<?}?>
					<?if( $arResult["isIblockDescription"] ){
						if( $arResult["IBLOCK_DESCRIPTION_TYPE"] == "text" ){?>
							<p><?=$arResult["IBLOCK_DESCRIPTION"]?></p>
						<?}else{?>
							<?=$arResult["IBLOCK_DESCRIPTION"]?>
						<?}
					}?>
				</div>
			</div>
			<div class="form-body">
				<?foreach( $arResult["QUESTIONS"] as $FIELD_SID => $arQuestion ){
					if( $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden' ){
						echo $arQuestion["HTML_CODE"];
					}else{?>
						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<?=$arQuestion["CAPTION"]?>
									<div class="input">
										<?=$arQuestion["HTML_CODE"]?>
									</div>
									<?if( !empty( $arQuestion["HINT"] ) ){?>
										<div class="hint"><?=$arQuestion["HINT"]?></div>
									<?}?>
								</div>
							</div>
						</div>
					<?}
				}?>
				<?if( $arResult["isUseCaptcha"] == "Y" ){?>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<?=$arResult["CAPTCHA_CAPTION"]?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group margin-bottom-30">
								<?=$arResult["CAPTCHA_IMAGE"]?>
								<span class="refresh"><span><?=GetMessage("REFRESH")?></span></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="input <?=$arResult["CAPTCHA_ERROR"] == "Y" ? "error" : ""?>">
									<?=$arResult["CAPTCHA_FIELD"]?>
								</div>
							</div>
						</div>
					</div>
				<?}?>
			</div>
			<div class="form-footer clearfix">
				<div class="pull-left required-fileds">
					<i class="star">*</i><?=GetMessage("FORM_REQUIRED_FILEDS")?>
				</div>
				<div class="pull-right">
					<?=$arResult["SUBMIT_BUTTON"]?>
				</div>
			</div>
		<?=$arResult["FORM_FOOTER"]?>
	<?}?>
</div>

<script>
	$(document).ready(function(){
		$('form[name="<?=$arResult["IBLOCK_CODE"]?>"]').validate({
			highlight: function( element ){
				$(element).parent().addClass('error');
			},
			unhighlight: function( element ){
				$(element).parent().removeClass('error');
			},
			submitHandler: function( form ){
				if( $('form[name="<?=$arResult["IBLOCK_CODE"]?>"]').valid() ){
					$(form).find('button[type="submit"]').attr("disabled", "disabled");
					form.submit();
				}
			},
			errorPlacement: function( error, element ){
				error.insertBefore(element);
			}
		});
		
		var base_mask = phone_mask.replace( /(\d)/g, '_' );
		
		$('form[name="<?=$arResult["IBLOCK_CODE"]?>"] input.phone').inputmask("mask", { "mask": phone_mask });
		$('form[name="<?=$arResult["IBLOCK_CODE"]?>"] input.phone').blur(function(){
			if( $(this).val() == base_mask || $(this).val() == '' ){
				if( $(this).hasClass('required') ){
					$(this).parent().find('div.error').html(BX.message("JS_REQUIRED"));
				}
			}
		});
		
		$('.jqmClose').closest('.jqmWindow').jqmAddClose('.jqmClose');
		
		$('.jqmWindow').scrollTop();
		
		$("input[type=file]").uniform({ fileButtonHtml: BX.message("JS_FILE_BUTTON_NAME"), fileDefaultHtml: BX.message("JS_FILE_DEFAULT") });
	});
</script>