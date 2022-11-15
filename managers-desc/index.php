<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetTitle("Кабинет менеджера");
	$_REQUEST["filter_history"] = "Y";
	if(!$USER->isAuthorized()){LocalRedirect(SITE_DIR.'auth');} else {
?>	<div class="left_block">
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
	<?
		$filter = array();
		$rsUsers = CUser::GetList(($by="last_name"), ($order="desc"), $filter, array("FIELDS" => array("ID", "LOGIN", "NAME", "LAST_NAME"))); // выбираем пользователей
		while ($arUser = $rsUsers->Fetch()){
			$arUsers[$arUser['ID']] = $arUser;
		}
		/*if($_POST["userdata"]){
			$_SESSION["morderuserid"] = $_POST["userdata"];
		}*/
		if($_POST["userdata"]){
			$usIdC = 1;
			$_SESSION["morderuserid"]["ID"] = array();
			foreach($_POST["userdata"] as $key=>$id){
				$_SESSION["morderuserid"]["ID"][$id] = $id;
				if($usIdC==1){
					$_SESSION["morderuserid"]["VALUE"] = $id;
				}else{
					$_SESSION["morderuserid"]["VALUE"] .= '|'.$id;
				}
				$usIdC++;
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
		}
	?>
	<!--noindex-->
	<form name="FEEDBACK" action="" method="POST" enctype="multipart/form-data" novalidate="novalidate" onsubmit="/*sendcalcdata(this); return false;*/" id="target">
		<div class="form_body">
			<div class="form_left">
				<div class="form-control mltpl">
					<label><span>Выбрать пользователя</span></label>
					<select class="common_select" data-sid="POST" required="" name="userdata[]" multiple onchange="submit();">
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
				font-size:12px;
			}
			/* tables */
			th span{
				border-bottom: 1px dashed #888888;
			}
		</style>
		<div class="module-order-history">
		<table class="tablesorter module-orders-list colored table-all-users" style="width:100%;" id="table-all-users">
			<thead>
				<tr>
					<th class="item-name-th"><span>Наименование клиента</span></th>
					<th class="date-th"><span>Количество заказов</span></th>
					<th class="count-th"><span>Общая сумма по заказам</span></th>
					<th class="price-th"><span>Общее количество товаров<br/> по всем заказам</span></th>
					<th> </th>
				</tr>
			</thead>
			<tbody>
		<?foreach($_SESSION["morderuserid"]["ID"] as $id=>$userId){?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:sale.personal.order", 
					"orders_for_managers", 
					array(
						"PROP_1" => array(
						),
						"PROP_3" => "",
						"PROP_2" => array(
						),
						"PROP_4" => "",
						"SEF_MODE" => "Y",
						"HISTORIC_STATUSES" => array(
							0 => "F",
							1 => "N",
							2 => "P",
						),
						"SEF_FOLDER" => "/personal/history-of-orders/",
						"ORDERS_PER_PAGE" => "20",
						"PATH_TO_PAYMENT" => "/order/payment/",
						"PATH_TO_BASKET" => "/basket/",
						"SET_TITLE" => "N",
						"SAVE_IN_SESSION" => "Y",
						"NAV_TEMPLATE" => "",
						"COMPONENT_TEMPLATE" => "orders_for_managers",
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"CACHE_GROUPS" => "Y",
						"CUSTOM_SELECT_PROPS" => array(
						),
						"USER_ID" => $userId,
						"COMPOSITE_FRAME_MODE" => "A",
						"COMPOSITE_FRAME_TYPE" => "AUTO",
						"SEF_URL_TEMPLATES" => array(
							"list" => "",
							"detail" => "order_detail.php?ID=#ID#",
							"cancel" => "order_cancel.php?ID=#ID#",
						),
						"VARIABLE_ALIASES" => array(
							"detail" => array(
								"ID" => "ID",
							),
							"cancel" => array(
								"ID" => "ID",
							),
						),
						"filter_date_from" => htmlspecialchars($_SESSION["date_from"]),
						"filter_date_to" => htmlspecialchars($_SESSION["date_to"]),
					),
					false
				);?>
		<?}?>
				</tbody>
	</table>
	</div>
	</div>
		<script>
		$('.tr-d td').on('click', function(e)
		{
			e.preventDefault();
			$(this).parents("tr").toggleClass("opened").next("tr.drop").children(".drop-cell").slideToggle(200).children(".drop-container").slideToggle(200);
		});
		</script>
		<script>
		$(document).ready(function()
		    { 
		        $("#table-all-users").tablesorter();
		    }
		);
		</script>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>