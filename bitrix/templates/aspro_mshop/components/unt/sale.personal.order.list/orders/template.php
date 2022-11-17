<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	if (!function_exists("formatPrice"))
	{
		function formatPrice ($price, $currencyCode)
		{
			if (!$price&&$currencyCode)
			{
				$currency = CCurrencyLang::GetCurrencyFormat($currencyCode, LANGUAGE_ID);
				return substr($currency["FORMAT_STRING"], strrpos($currency["FORMAT_STRING"], ' '));
			}
			elseif ($price&&!$currencyCode) { return number_format( $price, 2, ',', ' '); }
			elseif ($price&&$currencyCode)
			{
				$currency = CCurrencyLang::GetCurrencyFormat($currencyCode, LANGUAGE_ID);
				return number_format( $price, 2, ',', ' ' ).substr($currency["FORMAT_STRING"], strrpos($currency["FORMAT_STRING"], ' '));
			}
		}
	}	
?>
<?
echo "<pre>";
//print_r($arParams['USER_ID']);
echo "</pre>";
?>
<?if($arResult["USER_STAT"]):?>
			<tr class="tr-d user-node-tr-td-table-all-users" id="user-node-<?=$arResult["USER_STAT"]['USER_INFO']['ID']?>">
				<td class="item-name-th"><span><?=$arResult["USER_STAT"]['USER_INFO']['NAME']." ".$arResult["USER_STAT"]['USER_INFO']["LAST_NAME"]?></</td>
				<td class="date-th"><?=$arResult["USER_STAT"]["ORDER_COUNT"]?></td>
				<td class="count-th"><?=$arResult["USER_STAT"]["FULL_COAST"]?></td>
				<td class="price-th"><?=$arResult["USER_STAT"]["FULL_ITEMS"]?></td>
				<td><a class="item_name"><span class="name">Подробнее</span> <span class="icon opener_icon"><i></i></span></a></td>
			</tr>
			<tr class="drop drop-for-user-node-<?=$arResult["USER_STAT"]['USER_INFO']['ID']?>">
				<td colspan="5" class="drop-cell wrap-all">
					<div class="drop-container">
<?endif;?>
<?if (count($arResult["ORDERS"])):?>
	<br/>
	<?if(!empty($arResult['ERRORS']['NONFATAL'])):?>

		<?foreach($arResult['ERRORS']['NONFATAL'] as $error):?>
			<?=ShowError($error)?>
		<?endforeach?>

	<?endif?>
	<table class="module-orders-list table-all-orders colored table-num-<?=$arParams['USER_ID']?>" id="order-table-<?=$arParams['USER_ID']?>" style="width:100%;">
		<thead>
			<tr>
				<th class="item-name-th"><span><?=GetMessage("STPOL_ORDER_NUMBER")?></span></th>
				<th class="date-th"><span><?=GetMessage("STPOL_ORDER_DATE")?></span></th>
				<th class="count-th"><span><?=GetMessage("STPOL_ORDER_QUANTITY")?></span></th>
				<th class="price-th"><span><?=GetMessage("STPOL_ORDER_SUMM")?></span></th>
				<th class="pay-status-th"><span><?=GetMessage("STPOL_ORDER_PAY")?></span></th>
				<th class="order-status-th"><span><?=GetMessage("SPOL_T_STATUS")?></span></th>
			</tr>
		</thead>
		<tbody>
		<?foreach( $arResult["ORDERS"] as $val ){?>
			<?$summ = 0;
			foreach( $val["BASKET_ITEMS"] as $vval ){		
				$summ += $vval["PRICE"] * $vval["QUANTITY"];
			}

			$dateCreate = false;
			if($val["ORDER"]["DATE_INSERT_FORMAT"]){
				$arDateCreated = explode(' ', $val["ORDER"]["DATE_INSERT_FORMAT"]);
				$dateCreate = $arDateCreated[0];
			}
			else{
				$dateCreate = $val["ORDER"]["DATE_INSERT_FORMATED"];
			}
			?>
			
				<tr class="tr-d user-node-tr-td-order-table-<?=$arParams['USER_ID']?> user-node-order-table-<?=$arParams['USER_ID']?>" id="user-node-order-table-<?=$val["ORDER"]['ID']?>">
					<td class="item-name-cell">
						<a class="item_name"><span class="icon opener_icon"><i></i></span><span class="name"><?=GetMessage("STPOL_ORDER")?><?=$val["ORDER"]["ACCOUNT_NUMBER"]?></span></a>
						
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
					<td class="date-cell"><?=$dateCreate?></td>
					<td class="count-cell"><?=count( $val["BASKET_ITEMS"] )?></td>
					<td class="price-cell"><?=$val["ORDER"]["PRICE"]?></td>
					<td class="pay-status-cell<?=$val["ORDER"]["PAYED"] == 'Y' ? ' payed' : ' not_payed'?>">
						<?=$val["ORDER"]["PAYED"] == 'Y' ? GetMessage("SPOL_T_PAYED") : GetMessage("SPOL_T_NOT_PAYED")?>
					</td>
					<td class="order-status-cell">
						<?if( $val["ORDER"]["CANCELED"] == "Y" ){?><span class="status canceled"><?=GetMessage("SPOL_T_CANCELED");?></span>
						<?}elseif( $val["ORDER"]["STATUS_ID"] == 'F' ){?><span class="status delivered"><?=$arResult["INFO"]["STATUS"][$val["ORDER"]["STATUS_ID"]]["NAME"]?></span>
						<?}else{?><span class="status in-process"><?=$arResult["INFO"]["STATUS"][$val["ORDER"]["STATUS_ID"]]["NAME"]?></span><?}?>
					</td>
				</tr>
				<tr class="drop drop-for-user-node-order-table-<?=$val["ORDER"]['ID']?>">
					<td colspan="6" class="drop-cell wrap-all">
						<div class="drop-container">
							<?if($val["ORDER"]["PAYED"] != 'Y' && $val["ORDER"]["CANCELED"] != 'Y' && intval( $val["ORDER"]["PAY_SYSTEM_ID"] ) > 0 ):?>
								<?$arPaySysAction = CSalePaySystemAction::GetList( array(), array( "PAY_SYSTEM_ID" => $val["ORDER"]["PAY_SYSTEM_ID"] ), false, false, array("NAME", "ACTION_FILE", "NEW_WINDOW", "PARAMS", "ENCODING") )->GetNext();?>
								<?if(strlen($arPaySysAction["ACTION_FILE"] && $arPaySysAction["NEW_WINDOW"] == "Y")):?>
									<div class="not-payed">
										<div class="wrap_md">
											<div class="iblock text">
												<span><?=GetMessage("STPOL_ORDER_NOT_PAYD")?></span>
											</div>
											<div class="iblock pays">
												<!--noindex-->
													<a href="<?=htmlspecialcharsbx( $arParams["PATH_TO_PAYMENT"] ).'?ORDER_ID='.$val["ORDER"]["ID"];?>" target="_blank" class="button pay_btn"><span><?=GetMessage("SPOL_T_ORDER_PAY");?></span></a>
												<!--/noindex-->
											</div>
										</div>
									</div>
								<?endif;?>
							<?endif;?>
							<table class="item-shell" id="basket-table-<?=$val["ORDER"]['ID']?>">
								<thead>
									<tr>
										<th class="name-th"><span><?=GetMessage("SPOL_T_PRODUCT")?></span></th>
										<th class="name-th"><span>Категория</span></th>
										<th class="price-th"><span><?=GetMessage("SPOL_T_PRICE")?></span></th>
										<th class="count-th"><span><?=GetMessage("STPOL_ORDER_QUANTITY")?></span></th>
										<th class="summ-th"><span><?=GetMessage("STPOL_ORDER_SUMM")?></span></th>
									</tr>
								</thead>
								<tbody>								
									<?foreach( $val["BASKET_ITEMS"] as $vval ):?>
										<tr class="tr-d user-node-tr-td-basket-table-<?=$val["ORDER"]['ID']?> user-node-basket-table-<?=$val["ORDER"]['ID']?>">
											<td  class="name-cell">
												<a href="<?=$vval["DETAIL_PAGE_URL"]?>"><?=$vval["NAME"]?></a>
												<div class="item-extra-properties">	
													<?=formatPrice($vval["PRICE"], $vval["CURRENCY"]);?> &times; <?=$vval["QUANTITY"]?>
												</div>
											</td>
											<td class="price-cell">
												<?=$vval['PRODUCT_SECTION']?>
											</td>
											<td class="price-cell">
												<?=formatPrice($vval["PRICE"], $vval["CURRENCY"]);?>
											</td>
											<td class="count-cell"><?=$vval["QUANTITY"]?>&nbsp;<?=GetMessage("UNIT");?></td>
											<td class="summ-cell">
												<?=formatPrice($vval["PRICE"]*$vval["QUANTITY"], $vval["CURRENCY"]);?>
											</td>
										</tr>
									<?endforeach;?>
								</tbody>
							</table>
								<script>
									$(document).ready(function()
									    { 
									        $("#basket-table-<?=$val["ORDER"]['ID']?>").tablesorter();
									    }
									);
								</script>
							<?if(2==1){?><div class="result-row">
								<div class="result">
								
									<table cellspacing="0" cellpadding="0" border="0">
										<?if( intval( $val["ORDER"]["PRICE_DELIVERY"] ) > 0 ){?>
											<tr class="order_property d">
												<td class="name"><?=GetMessage("SPOL_T_DELIVERY")?>:</td>
												<td class="r"><?=formatPrice($val["ORDER"]["PRICE_DELIVERY"], $vval["CURRENCY"]);?></td>
											</tr>
										<?}?>
										<tr class="order_property price">
												<td class="name"><?=GetMessage("STPOL_ORDER_TO_AMOUNT")?>:</td>
												<td class="r"><?=$val["ORDER"]["FORMATED_PRICE"]?></td>
										</tr>
									</table>
								</div>
								<!--noindex-->
									<a href="<?=$val["ORDER"]["URL_TO_DETAIL"]?>" class="button msmall"><span><?=GetMessage("SPOL_T_DETAIL")?></span></a>
									<a href="<?=$val["ORDER"]["URL_TO_COPY"]?>" class="button msmall"><span><?=GetMessage("SPOL_T_COPY_ORDER_DESCR")?></span></a>
									<?if( $val["ORDER"]["CAN_CANCEL"] == "Y" ){?>
										<a href="<?=$val["ORDER"]["URL_TO_CANCEL"]?>" class="button msmall transparent"><span><?=GetMessage("SPOL_T_DELETE_DESCR")?></span></a>
									<?}?>
								<!--/noindex-->
							</div><?}?>
						</div>
					</td>
				</tr>
		<?}?>
		</tbody>
	</table>
					</div>
				</td>
			</tr>

	<?if( strlen($arResult["NAV_STRING"]) > 0 ):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
	<script>
		$(document).ready(function()
		    { 
		        $("#order-table-<?=$arParams['USER_ID']?>").tablesorter();
		    }
		);
	</script>
<?else:?>
	<script>$(".module-order-history .tabs").hide();</script>
	<div class="empty_history">
		<p><?=GetMessage("NO_ORDERS")?></p><br />
		<form action="<?=SITE_DIR?>catalog/">
			<button class="button msmall"><?=GetMessage("TO_CATALOG")?></button>
		</form>
	</div>
<?endif;?>