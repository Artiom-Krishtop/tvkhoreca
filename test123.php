<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Активность пользователей");
?>
<?
	$filter = array();
	$rsUsers = CUser::GetList(($by="last_name"), ($order="desc"), $filter, array("FIELDS" => array("ID", "LOGIN", "NAME", "LAST_NAME"))); // выбираем пользователей
	while ($arUser = $rsUsers->Fetch()){
		$arUsers[$arUser['ID']] = $arUser;
	}
	if(htmlspecialcharsEx($_POST["userid"])){
		$_SESSION["morderuserid"] = htmlspecialcharsEx($_POST["userid"]);
	}
	$date_from = "01.09.2016";
	$date_to = date('d.m.Y');
	if(htmlspecialcharsEx($_POST["date_from"])){
		$_SESSION["date_from"] = htmlspecialcharsEx($_POST["date_from"]);
	}
	if(htmlspecialcharsEx($_POST["date_to"])){
		$_SESSION["date_to"] = htmlspecialcharsEx($_POST["date_to"]);
	}
?>

<!--noindex-->
<form name="FEEDBACK" action="" method="POST" enctype="multipart/form-data" novalidate="novalidate" onsubmit="/*sendcalcdata(this); return false;*/">
	<div class="form_body">
		<div class="form_left">
			<div class="form-control">
				<label><span>Выбрать пользователя</span></label>
				<select class="common_select" data-sid="POST" required="" name="userid" onchange="">
					<?foreach($arUsers as $id=>$arUser){?>
						<option value="<?=$id?>" <?if(htmlspecialcharsEx($_SESSION["morderuserid"])==$id) echo "selected";?>><?=$arUser["NAME"]." ".$arUser["LAST_NAME"]." (".$arUser["LOGIN"].")"?></option>
					<?}?>
				</select>
			</div>
			<div class="form-control manager-table">
				<?	
					if($_SESSION["date_from"]){
						$date_from = htmlspecialcharsEx($_SESSION["date_from"]);
					}
					if($_SESSION["date_to"]){
						$date_to = htmlspecialcharsEx($_SESSION["date_to"]);
					}
				echo CalendarPeriod("date_from", $date_from, "date_to", $date_to, "FEEDBACK", "Y")?>
				<span class="button vbig_btn wides transparent" onclick="submit();">Применить</span>
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
</style>
<?
if (CModule::IncludeModule("statistic") && CModule::IncludeModule("iblock") && $_SESSION["morderuserid"]){
$arFilter = Array(
	"SITE_ID"	=> 77,
	"URL"		=> "%/catalog/horeca/%",
	"URL_404"	=> "N",
	"USER"		=> $_SESSION["morderuserid"],
	"DATE_1"	=> $_SESSION["date_from"],
	"DATE_2"	=> $_SESSION["date_to"]
);
$rsData = CHit::GetList(($by = "s_date_hit"), ($order = "asc"), $arFilter, $is_filtered);
$count = $rsData->SelectedRowsCount();
$i=1;
while ($ar = $rsData->Fetch())
{	
	$arResult[$ar['USER_ID']]["NAME"] = $ar['USER_NAME']." (".$ar['LOGIN'].")";
	if($i==1){
		$arResult[$ar['USER_ID']]["FIRST_VISIT"] = $ar['DATE_HIT'];
	}
	if($i==$count){
		$arResult[$ar['USER_ID']]["LAST_VISIT"] = $ar['DATE_HIT'];
	}
	$pathUrl = str_replace("http://www.dev.tvk.by", "", $ar['URL']);
	//if(!$arResult[$ar['USER_ID']]['FULL_URL'][$pathUrl]){
		$arResult[$ar['USER_ID']]['FULL_URL'][$pathUrl] = $pathUrl;
		$arResult[$ar['USER_ID']]['URLS'][$pathUrl] = explode("/", str_replace("http://www.dev.tvk.by/catalog/horeca/", "", $ar['URL']));
		array_pop($arResult[$ar['USER_ID']]['URLS'][$pathUrl]);
		//$arResult[$ar['USER_ID']]['FULL_URL'][$pathUrl]['COUNT'] = 1;
	/*}else{
		$arResult[$ar['USER_ID']]['FULL_URL'][$pathUrl]['COUNT']++;
	}*/
	
	$i++;
	//echo "<pre>"; print_r($ar); echo "</pre>"; 
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
				<td>Статистика по клиенту</td>
			</tr>
		</thead>
		<tbody>
			<?foreach($arResult as $id=>$statData){?>
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
									<?foreach($statData['URLS'] as $sessiedId=>$pathData):?>
										<?if(count($pathData)>3){
											$elementID = array_pop($pathData);
											$res = CIBlockElement::GetByID($elementID);
											if($ar_res = $res->GetNext())
											  	$dataForPath = $ar_res;
										}else{
											$sectCode = array_pop($pathData);
											$rsSections = CIBlockSection::GetList(array(),array('IBLOCK_ID' => 54, '=CODE' => $sectCode), false, array('ID','NAME'));
											if ($arSection = $rsSections->Fetch())
												$dataForPath = $arSection;
												$dataForPath["DETAIL_PAGE_URL"] = $statData['FULL_URL'][$sessiedId];
										}?>
										<tr>
											<td  class="name-cell">
													<?=$dataForPath["NAME"]?>
											</td>
											<td class="price-cell">
												<a href="<?=$dataForPath["DETAIL_PAGE_URL"]?>" target="_blank">Перейти</a>
											</td>
											<td class="count-cell"><?//=$statData['FULL_URL'][$sessiedId]['COUNT']?></td>
										</tr>
									<?endforeach;?>						
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>