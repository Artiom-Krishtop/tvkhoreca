							<?if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") die();?>
							<?IncludeTemplateLangFile(__FILE__);?>
							<?if(CSite::InDir(SITE_DIR.'help/') || CSite::InDir(SITE_DIR.'company/') || CSite::InDir(SITE_DIR.'info/')):?>
								</div>
							<?endif;?>
			<?if(!$isFrontPage && !$isContactsPage):?>
							</div>
						</div>
					</section>
				</div>
			<?endif;?>
		</div><?// <div class="wrapper">?>
		<footer id="footer" <?=($isFrontPage ? 'class="main"' : '')?>>
			<div class="footer_inner">
				<div class="wrapper_inner">
					<!--<div class="footer_top">
						<div class="wrap_md">
							<div class="iblock sblock"><?/*$APPLICATION->IncludeComponent("bitrix:subscribe.form", "mshop", array(
                                    "AJAX_MODE" => "N",
                                    "SHOW_HIDDEN" => "N",
                                    "ALLOW_ANONYMOUS" => "Y",
                                    "SHOW_AUTH_LINKS" => "N",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "86400",
                                    "CACHE_NOTES" => "",
                                    "SET_TITLE" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "LK" => "Y",
                                    "COMPONENT_TEMPLATE" => "mshop",
                                    "USE_PERSONALIZATION" => "Y",
                                    "PAGE" => SITE_DIR."personal/subscribe/"
                                ), false, array("ACTIVE_COMPONENT" => "N"));*/?></div>
							<div class="iblock phones">
								<div class="wrap_md">
									<div class="empty_block iblock"></div>
									<div class="phone_block iblock">
                                        <span class="phone_wrap">
                                            <span class="icons"></span>
                                            <span><?/*$APPLICATION->IncludeFile(SITE_DIR."include/phone.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("PHONE")));*/?></span>
                                        </span>
                                        <span class="order_wrap_btn">
                                            <span class="callback_btn"><?/*=GetMessage('CALLBACK')*/?></span>
                                        </span> 
                                    </div>
								</div>
							</div>
						</div>
					</div>-->
					<div class="footer_bottom">
						<div class="wrap_md">
                            <div class="iblock phones">
                                <div class="wrap_md">
                                    <div class="phone_block iblock">
                                        <div class="phones-left">
                                            <?$APPLICATION->IncludeFile(SITE_DIR."include/phone.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("PHONE")));?>
                                           <!-- <div class="order_wrap_btn">
                                                <span class="callback_btn"><?=GetMessage('CALLBACK');?></span>
                                            </div> -->
                                        </div>
                                        <?$APPLICATION->IncludeFile(SITE_DIR."include/work-time.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("PHONE")));?>
                                    </div>
                                </div>
                            </div>

							<div class="iblock menu_block">
								<div class="wrap_md">
									<div class="iblock copy_block">
										<div class="copyright"><?$APPLICATION->IncludeFile(SITE_DIR."include/copyright.php", Array(), Array("MODE" => "html", "NAME"  => GetMessage("COPYRIGHT")));?></div>
                                     <!-- <div class="dev-logo"> <a href="https://unt.by" title="???????????????????? ?????????? ???? 1?? ??????????????">???????????????????? ??????????:<br><img src="<?=SITE_TEMPLATE_PATH?>/images/unt_logo.png" title="???????????????????? ?????????? Universal Technologies" alt="???????????????????? ???????????? ???? 1?? ?????????????? - Universal Technologies"></a></div> -->
										<span class="pay_system_icons">
											<?$APPLICATION->IncludeFile(SITE_DIR."include/pay_system_icons.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("PHONE")));?>
										</span>
									</div>
									<div class="iblock all_menu_block">
										<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_submenu_top", array(
											"ROOT_MENU_TYPE" => "bottom",
											"MENU_CACHE_TYPE" => "Y",
											"MENU_CACHE_TIME" => "86400",
											"MENU_CACHE_USE_GROUPS" => "N",
											"MENU_CACHE_GET_VARS" => array(),
											"MAX_LEVEL" => "1",
											"USE_EXT" => "N",
											"DELAY" => "N",
											"ALLOW_MULTI_SELECT" => "N"
											),false);?>
										<div class="wrap_md">
											<div class="iblock submenu_block">
												<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_submenu", array(
													"ROOT_MENU_TYPE" => "bottom_company",
													"MENU_CACHE_TYPE" => "Y",
													"MENU_CACHE_TIME" => "86400",
													"MENU_CACHE_USE_GROUPS" => "N",
													"MENU_CACHE_GET_VARS" => array(),
													"MAX_LEVEL" => "1",
													"USE_EXT" => "N",
													"DELAY" => "N",
													"ALLOW_MULTI_SELECT" => "N"
													),false);?>
											</div>
											<div class="iblock submenu_block">
												<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_submenu", array(
													"ROOT_MENU_TYPE" => "bottom_info",
													"MENU_CACHE_TYPE" => "Y",
													"MENU_CACHE_TIME" => "86400",
													"MENU_CACHE_USE_GROUPS" => "N",
													"MENU_CACHE_GET_VARS" => array(),
													"MAX_LEVEL" => "1",
													"USE_EXT" => "N",
													"DELAY" => "N",
													"ALLOW_MULTI_SELECT" => "N"
													),false);?>
											</div>
											<div class="iblock submenu_block">
												<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_submenu", array(
													"ROOT_MENU_TYPE" => "bottom_help",
													"MENU_CACHE_TYPE" => "Y",
													"MENU_CACHE_TIME" => "86400",
													"MENU_CACHE_USE_GROUPS" => "N",
													"MENU_CACHE_GET_VARS" => array(),
													"MAX_LEVEL" => "1",
													"USE_EXT" => "N",
													"DELAY" => "N",
													"ALLOW_MULTI_SELECT" => "N"
													),false);?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--<div class="iblock social_block">
								<div class="wrap_md">
									<div class="empty_block iblock"></div>
									<div class="social_wrapper iblock">
										<div class="social">
											<?/*include($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/social.info.mshop.default.php');*/?>
										</div>
									</div>
								</div>
								<div id="bx-composite-banner"></div>
							</div>-->
						</div>
					</div>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/bottom_include1.php", Array(), Array("MODE" => "text", "NAME" => GetMessage("ARBITRARY_1"))); ?>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/bottom_include2.php", Array(), Array("MODE" => "text", "NAME" => GetMessage("ARBITRARY_2"))); ?>
				</div>
			</div>
		</footer>
		<?
		if(!CSite::inDir(SITE_DIR."index.php")){
			if(strlen($APPLICATION->GetPageProperty('title')) > 1){
				$title = $APPLICATION->GetPageProperty('title');
			}
			else{
				$title = $APPLICATION->GetTitle();
			}
			$APPLICATION->SetPageProperty("title", $title.' - '.$arSite['SITE_NAME']);
		}
		else{
			if(strlen($APPLICATION->GetPageProperty('title')) > 1){
				$title =  $APPLICATION->GetPageProperty('title');
			}
			else{
				$title =  $APPLICATION->GetTitle();
			}
			if(!empty($title)){
				$APPLICATION->SetPageProperty("title", $title);
			}
			else{
				$APPLICATION->SetPageProperty("title", $arSite['SITE_NAME']);
			}
		}
		?>
		<div id="content_new"></div>
		<?$APPLICATION->IncludeFile(SITE_DIR.'local/includes/system/pixels_footer.php');?>
		<?if($isFrontPage):
		//$APPLICATION->AddHeadString('<link href="https://'.SITE_SERVER_NAME.'" rel="canonical" />',true);
		endif;?>
		<?
			$canonical = $APPLICATION->GetPageProperty("canonical");
			if(!$canonical && ERROR_404!='Y'){
				$siteProt = CMain::IsHTTPS() ? 'https' : 'http';
				$siteDomain = "://".SITE_SERVER_NAME;
				$siteUrl = $siteProt.$siteDomain;
				$APPLICATION->SetPageProperty("canonical", $siteUrl.$APPLICATION->sDirPath);
			}
		?>
	</body>
</html>