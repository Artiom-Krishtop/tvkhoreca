<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Активность пользователей");
?>
	<div class="left_block">
		<?$APPLICATION->IncludeComponent("bitrix:menu", "left_menu", array(
			"ROOT_MENU_TYPE" => "left",
			"MENU_CACHE_TYPE" => "A",
			"MENU_CACHE_TIME" => "3600",
			"MENU_CACHE_USE_GROUPS" => "Y",
			"MENU_CACHE_GET_VARS" => array(
			),
			"MAX_LEVEL" => "1",
			"CHILD_MENU_TYPE" => "left",
			"USE_EXT" => "Y",
			"DELAY" => "N",
			"ALLOW_MULTI_SELECT" => "N"
			),
			false
		);?>	
	</div>
	<div class="right_block">
<?if(in_array("21", CUser::GetUserGroup($USER->GetID()))):
		$mfilter = array("GROUPS_ID" => array(20));
		$rsMangersList = CUser::GetList(($by="last_name"), ($order="desc"), $mfilter, array("FIELDS" => array("ID", "LOGIN", "NAME", "LAST_NAME"))); // выбираем пользователей
		while ($rsManger = $rsMangersList->Fetch()){
			$arMangersList[$rsManger['ID']] = $rsManger;
			$arManagersForFilter[] = $rsManger['ID'];
		}
		$_SESSION["managersid"] == array();
		if($_POST["usermanager"]){
			$_SESSION["managersid"] = $_POST["usermanager"];
			$filter = array("=UF_USER_MANAGER"=>$_SESSION["managersid"]);
		}else{
			//$filter= array("=UF_USER_MANAGER" => $arManagersForFilter);
		}
	else:
		$filter = array("=UF_USER_MANAGER"=>$USER->GetID());
	endif;
    //print_r($_POST);
	$rsUsers = CUser::GetList(($by="last_name"), ($order="desc"), $filter, array("FIELDS" => array("ID", "LOGIN", "NAME", "LAST_NAME"))); // выбираем пользователей
	while ($arUser = $rsUsers->Fetch()){
		$arUsers[$arUser['ID']] = $arUser;
	}
	$managerUsersCnt = $rsUsers->SelectedRowsCount();
	if($arUsers){
			if($_POST["userid"]){
				$usIdC = 1;
				$_SESSION["morderuserid"]["ID"] = array();
				foreach($_POST["userid"] as $key=>$id){
					$_SESSION["morderuserid"]["ID"][$id] = $id;
					if($usIdC==1){
						$_SESSION["morderuserid"]["VALUE"] = $id;
					}else{
						$_SESSION["morderuserid"]["VALUE"] .= '|'.$id;
					}
					$usIdC++;
				}
			}
			$date_from = "01.09.2016";
			$date_to = date('d.m.Y');
			if($_POST["date_from"] || $_POST["date_from_DAYS_TO_BACK"]>0){
				if($_POST["date_from_DAYS_TO_BACK"]>0){
					$_SESSION["date_from"] = (string) ((date('d.m.Y') - $_POST["date_from_DAYS_TO_BACK"]).".".date('Y'));
				}else{
					$_SESSION["date_from"] = htmlspecialchars($_POST["date_from"]);
				}
			}
			if($_POST["date_to"]){
				$_SESSION["date_to"] = htmlspecialchars($_POST["date_to"]);
			}
		?>
		<!--noindex-->
		<form name="FEEDBACK" action="" method="POST" enctype="multipart/form-data" novalidate="novalidate" id="target">
			<div class="form_body">
				<div class="form_left">
					<?if(in_array("21", CUser::GetUserGroup($USER->GetID()))):?>
					<div class="form-control">
						<label><span>Выбрать менеджера</span></label>
						<select required="" name="usermanager" size="<?=$managerUsersCnt?>">
							<?foreach($arMangersList as $id=>$arManager){?>
								<option value="<?=$id?>" <?if($_SESSION["managersid"]==$id || $_SESSION["managersid"] == array()) echo "selected";?>><?=$arManager["NAME"]." ".$arManager["LAST_NAME"]." (".$arManager["LOGIN"].")"?></option>
							<?}?>
						</select>
					</div>
					<?endif;?>
					<div class="form-control mltpl">
						<label><span>Выбрать пользователя</span></label>
						<select required="" name="userid[]" multiple size="<?=$managerUsersCnt?>">
							<?foreach($arUsers as $id=>$arUser){?>
								<option value="<?=$id?>" <?if($_SESSION["morderuserid"]["ID"][$id]==$id) echo "selected";?>><?=$arUser["NAME"]." ".$arUser["LAST_NAME"]." (".$arUser["LOGIN"].")"?></option>
							<?}?>
						</select>
					</div>
					<div class="form-control manager-table">
						<?	
							if($_SESSION["date_from"]){
								$date_from = htmlspecialchars($_SESSION["date_from"]);
							}
							if($_SESSION["date_to"]){
								$date_to = htmlspecialchars($_SESSION["date_to"]);
							}
						echo CalendarPeriod("date_from", $date_from, "date_to", $date_to, "FEEDBACK", "Y")?>
						<span class="button vbig_btn wides transparent" onclick="$('#target').submit();">Применить</span>
					</div>
				</div>
			</div>
		</form>
		<style>
			.form-control.manager-table .common_select, .form-control.manager-table #date_from,.form-control.manager-table #date_to{
				width:20% !important;
			}
			.form-control.manager-table .common_select{
				margin-right: 20px;
			}
			.form-control.manager-table a{
					margin-left: -22px;
					margin-bottom: -5px;
			}
			.form-control.manager-table span.button{
				margin-left: 25px;
			}
			.mltpl .ik_select_link,.mltpl .ik_select_dropdown{
				display: none !important;
			}
			.mltpl select{
				position: relative !important;
				margin: 0px;
				padding: 0px;
				top: 0px !important;
				left: 0px !important;
				display: block !important;
			}
		</style>
		<?
		if (CModule::IncludeModule("statistic") && CModule::IncludeModule("iblock") && $_SESSION["morderuserid"]){    
		$arFilter = Array(
			"SITE_ID"	=> 77,
			"URL"		=> "%/catalog/horeca/%",
			"URL_404"	=> "N",
			"USER"		=> $_SESSION["morderuserid"]["VALUE"],
			"USER_EXACT_MATCH" => "Y",
			"DATE_1"	=> $_SESSION["date_from"],
			"DATE_2"	=> $_SESSION["date_to"]
		);
		$rsData = CHit::GetList(($by = "s_date_hit"), ($order = "asc"), $arFilter, $is_filtered);
		$count = $rsData->SelectedRowsCount();
		$i=1;
		while ($ar = $rsData->Fetch())
		{	
			$arResult[$ar['USER_ID']]["NAME"] = $ar['USER_NAME']." (".$ar['LOGIN'].")";
			if(!$arResult[$ar['USER_ID']]["FIRST_VISIT"]){
				$arResult[$ar['USER_ID']]["FIRST_VISIT"] = $ar['DATE_HIT'];
			}
			//if($i==$count){
				$arResult[$ar['USER_ID']]["LAST_VISIT"] = $ar['DATE_HIT'];
			//}
			$pathUrl = str_replace("http://www.dev.tvk.by", "", $ar['URL']);
			$fullPathCode = str_replace("/", "-", $pathUrl);
			if(!$arResult[$ar['USER_ID']]['FULL_URL'][$fullPathCode]){
				$arResult[$ar['USER_ID']]['FULL_URL'][$fullPathCode] = $pathUrl;
				$arResult[$ar['USER_ID']]['URLS'][$fullPathCode] = explode("/", str_replace("http://www.dev.tvk.by/catalog/horeca/", "", $ar['URL']));
				array_pop($arResult[$ar['USER_ID']]['URLS'][$fullPathCode]);
				$arResult[$ar['USER_ID']]['COUNT_THIS'][$fullPathCode] = 1;
			}else{
				$arResult[$ar['USER_ID']]['COUNT_THIS'][$fullPathCode]++;
			}
			
			$i++;
			//echo "<pre>"; print_r($ar); echo "</pre>"; 
		}
		//echo "<pre>"; print_r($_SESSION["morderuserid"]); echo "</pre>"; 
		foreach($_SESSION["morderuserid"]["ID"] as $key=>$id){
			$arsessiedFilter = array(
			    "USER"		=> $id,
			);
			
			// получим список записей
			$rsSessia = CSession::GetList(
			    ($by = "s_id"), 
			    ($order = "desc"), 
			    $arsessiedFilter, 
			    $is_filtered
			);
			$arResult[$id]['VISIT_COUNT'] = $rsSessia->SelectedRowsCount();
			
			foreach($arResult[$id]['URLS'] as $sessiedId=>$pathData){
				if(count($pathData)>3){
					$elementID = array_pop($pathData);
					$res = CIBlockElement::GetByID($elementID);
					if($ar_res = $res->GetNext()){
					  	$arResult[$id]['SECTIONS'][$ar_res['IBLOCK_SECTION_ID']]['ELEMENTS'][$ar_res['ID']] = $ar_res;
					  	$arResult[$id]['SECTIONS'][$ar_res['IBLOCK_SECTION_ID']]['ELEMENTS'][$ar_res['ID']]['VIEWS'] = $arResult[$id]['COUNT_THIS'][$sessiedId];
					}
				}else{
					$sectCode = array_pop($pathData);
					$rsSections = CIBlockSection::GetList(array(),array('IBLOCK_ID' => 54, '=CODE' => $sectCode), false, array('ID','NAME'));
					if ($arSection = $rsSections->Fetch()){
						if(strstr($arResult[$id]['FULL_URL'][$sessiedId],"?",TRUE)){
							$arResult[$id]['SECTIONS'][$arSection['ID']]['DETAIL_PAGE_URL'] = strstr($arResult[$id]['FULL_URL'][$sessiedId],"?",TRUE);
						}else{
							$arResult[$id]['SECTIONS'][$arSection['ID']]['DETAIL_PAGE_URL'] = $arResult[$id]['FULL_URL'][$sessiedId];
						}
						$arResult[$id]['SECTIONS'][$arSection['ID']]['NAME'] = $arSection['NAME'];
					}
				}
			}
		}
		$z = 1;
		?>
		<div class="module-order-history">
			<table class="module-orders-list colored">
				<thead>
					<tr>
						<td>№ п/п</td>
						<td>№ Клиента</td>
						<td>Наименование клиента</td>
						<td>Дата первого <br>посещения клиента</td>
						<td>Дата последнего <br>посещения клиента</td>
						<td>Количество посещений</td>
						<td>Статистика по клиенту</td>
					</tr>
				</thead>
				<tbody>
					<?foreach($arResult as $id=>$statData){
						$n = 1;
					?>
						<tr class="tr-d">
							<td class="item-name-cell">
								<?=$z?>
							</td>
							<td class="date-cell"> <?=$id?></td>
							<td class="count-cell"><?=$statData['NAME']?></td>
							<td class="price-cell"><?=$statData['FIRST_VISIT']?></td>
							<td class="pay-status-cell">
								<?=$statData['LAST_VISIT']?>
							</td>
							<td><?=$statData['VISIT_COUNT']?></td>
							<td class="order-status-cell">
								<a class="item_name"><span class="name">Показать всю</span> <span class="icon opener_icon"><i></i></span></a>
								
								<span class="order-extra-properties">	
									, <span class="item">
										<?=GetMessage("STPOL_ORDER_DATE")?>: <?=$dateCreate?>,
									</span>
									<span class="item">
										<?=GetMessage("STPOL_ORDER_QUANTITY_2")?>:&nbsp;<?=count( $val["BASKET_ITEMS"] )?>,
									</span>
									<span class="item">
										<?=GetMessage("STPOL_ORDER_SUMM")?>:&nbsp;
										<?=$val["ORDER"]["FORMATED_PRICE"]?>
									</span>
									<span class="item"><?=GetMessage("STPOL_ORDER_PAY")?>:&nbsp; 
										<span class="pay-status-cell<?=$val["ORDER"]["PAYED"] == 'Y' ? ' payed' : ' not_payed'?>"><?=$val["ORDER"]["PAYED"] == 'Y' ? GetMessage("SPOL_T_PAYED") : GetMessage("SPOL_T_NOT_PAYED")?></span>,
									</span>
									<span class="item">
										<?=GetMessage("SPOL_T_STATUS")?>:&nbsp; 
										<?if( $val["ORDER"]["CANCELED"] == "Y" ){?><?=GetMessage("SPOL_T_CANCELED");?>
										<?}elseif( $val["ORDER"]["STATUS_ID"]){?><?=$arResult["INFO"]["STATUS"][$val["ORDER"]["STATUS_ID"]]["NAME"]?><?}?>
									</span>
								</span>
							</td>
						</tr>
						<tr class="drop">
							<td colspan="7" class="drop-cell wrap-all">
								<div class="drop-container">
									<table class="item-shell">
										<thead>
											<tr>
												<td class="name-th">№ п/п</td>
												<td class="name-th">Название</td>
												<td class="price-th">Путь</td>
												<td class="count-th">Количество элементов</td>
											</tr>
										</thead>
										<tbody>
											<?foreach($statData['SECTIONS'] as $sectionID=>$sectionData):?>
												<tr>
													<td  class="name-cell">
															<?=$n?>
													</td>
													<td  class="name-cell">
															<?=$sectionData["NAME"]?>
													</td>
													<td class="price-cell">
														<a href="<?=$sectionData["DETAIL_PAGE_URL"]?><?$elementCount = 0; if($sectionData["ELEMENTS"]){?>?<?
															$n2 = 1;
															$elementCount = count($sectionData["ELEMENTS"]);
															foreach($sectionData["ELEMENTS"] as $elementID=>$arElement){
																?>id[]=<?echo $elementID;
																if($elementCount!=$n2){
																	echo "&";	
																}
																$n2++;
															}
														}?>" target="_blank">Перейти</a>
													</td>
													<td class="count-cell"><?=$elementCount?></td>
												</tr>
												<?/*if($sectionData["ELEMENTS"]){?>
												<tr class="drop">
													<td colspan="6" class="drop-cell wrap-all">
														<div class="drop-container">
															<table class="item-shell">
																<thead>
																	<tr>
																		<td class="name-th">Название</td>
																		<td class="price-th">Путь</td>
																		<td class="count-th">Количество просмотров</td>
																	</tr>
																</thead>
																<tbody>
																	<?
																		$n2 = 1;
																		foreach($sectionData["ELEMENTS"] as $elementID=>$arElement){?>
																		<tr>
																		<td  class="name-cell">
																				<?=$n.'.'.$n2." ".$arElement["NAME"]?>
																		</td>
																		<td class="price-cell">
																			<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" target="_blank">Перейти</a>
																		</td>
																		<td class="count-cell"><?=$arElement['VIEWS']?></td>
																	</tr>
																	<?}?>
																</tbody>
															</table>
														</div>
													</td>
												</tr>
												<?}*/?>
											<?
											$n++;
											endforeach;?>						
										</tbody>
									</table>
								</div>
							</td>
						</tr>
					<?$z++;}?>
				</tbody>
			</table>
		
			<script>
				$('.tr-d td').on('click', function(e)
				{
					e.preventDefault();
					$(this).parents("tr").toggleClass("opened").next("tr.drop").find(".drop-cell").slideToggle(200).find(".drop-container").slideToggle(200);
				});
			</script>
		</div>
		<?
		}
		    //echo "<pre>"; print_r($arResult[12]); echo "</pre>";  
		?>
		<?}else{
			echo "У вас нет активных пользователей";
		}?>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>