<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контактные данные компании ТВК: расположение, телефоны, e-mail. Контактные телефоны менеджеров отдела работы с предприятиями общепита для вопросов об оптовой закупке профессиональной посуды, предметов сервировки, кухонного и кондитерского инвентаря, оборудования, хозяйственно-бытовых товаров для ресторанов, кафе и других предприятий HoReCa. Форма обратной связи: напишите нам.");
$APPLICATION->SetPageProperty("title", "ЗАО ТВК на карте: адрес, телефон, e-mail, время работы, контактные телефоны менеджеров");
$APPLICATION->SetTitle("Контакты");
?><div class="wrapper_inner">
	<div class="store_description">
		<div class="store_property">
			<div class="title">
				 Компания&nbsp;«ТВК» находится по&nbsp;адресу:
			</div>
			<div class="value">
				 <?$APPLICATION->IncludeFile(SITE_DIR."include/address.php", Array(), Array("MODE" => "html", "NAME" => "Адрес"));?>
			</div>
		</div>
	</div>
</div>
<div class="contacts_map">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"map",
	Array(
		"API_KEY" => "AIzaSyCTTEzffmCg5cdHj-buOBQudckytUTM4Tc",
		"COMPONENT_TEMPLATE" => "map",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONTROLS" => array(0=>"SMALLZOOM",),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:53.877731564859495;s:10:\"yandex_lon\";d:27.584311169311015;s:12:\"yandex_scale\";i:15;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:27.584311169311;s:3:\"LAT\";d:53.877731564867;s:4:\"TEXT\";s:61:\"ЗАО «ТВК»###RN###Минск, ул. Ванеева, 48\";}}}",
		"MAP_HEIGHT" => "400",
		"MAP_ID" => "",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(0=>"ENABLE_DBLCLICK_ZOOM",1=>"ENABLE_DRAGGING",),
		"ZOOM_BLOCK" => array("POSITION"=>"right center",)
	)
);?>
</div>
<div class="wrapper_inner">
	<div class="contacts_left clearfix">
		<div class="store_description">
			<div class="store_property">
				<div class="title">
					 Телефон
				</div>
				<div class="value">
					 <?$APPLICATION->IncludeFile(SITE_DIR."include/phone_contacts.php", Array(), Array("MODE" => "html", "NAME" => "Телефон"));?>
				</div>
			</div>
			<div class="store_property">
				<div class="title">
					 Email
				</div>
				<div class="value">
					 <?$APPLICATION->IncludeFile(SITE_DIR."include/email.php", Array(), Array("MODE" => "html", "NAME" => "Email"));?>
				</div>
			</div>
			<div class="store_property">
				<div class="title">
					 Режим работы
				</div>
				<div class="value">
					 <?$APPLICATION->IncludeFile(SITE_DIR."include/schedule.php", Array(), Array("MODE" => "html", "NAME" => "Время работы"));?>
				</div>
			</div>
		</div>
	</div>
	<div class="contacts_right clearfix">
		<blockquote>
			 <?$APPLICATION->IncludeFile(SITE_DIR."include/contacts_text.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("CONTACTS_TEXT")));?>
		</blockquote>
		 <?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("form-feedback-block");?> <?$APPLICATION->IncludeComponent(
	"aspro:form.result.new", 
	"inline", 
	array(
		"CACHE_TIME" => "3600000",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "Y",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "?send=ok",
		"USE_EXTENDED_ERRORS" => "Y",
		"WEB_FORM_ID" => "5",
		"COMPONENT_TEMPLATE" => "inline",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?> <?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("form-feedback-block", "");?>
	</div>
</div>
<div class="wrapper_inner">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"staff", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "staff",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_PICTURE",
			2 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "50",
		"IBLOCK_TYPE" => "aspro_allcorp_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "1000",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "EMAIL",
			1 => "POST",
			2 => "PHONE",
			3 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
</div>
<div class="clearboth">
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>