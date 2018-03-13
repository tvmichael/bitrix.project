<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?>
<!-- ASDSA-personal/order/ -->
<div class="personal-page-nav">
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<h2>Личная информация</h2>
	<ul class="lsnn">
		<li><a href="/personal/profile/">Изменить регистрационные данные</a></li>
	</ul>
	<h2>Заказы</h2>
	<ul class="lsnn">
		<li><a href="/personal/order/">Ознакомиться с состоянием заказов</a></li>
		<li><a href="/personal/cart/">Посмотреть содержимое корзины</a></li>
		<li><a href="/personal/order/?filter_history=Y">Посмотреть историю заказов</a></li>
	</ul>
	<h2>Подписка</h2>
	<ul class="lsnn">
		<li><a href="/subscribe/">Изменить подписку</a></li>
	</ul>
	 <?

if ( CSite::InGroup( array(8) ) ):
?>
	<h2>Оптовикам</h2>
	<ul class="lsnn">
		<li><a href="/wholesale/">Перейти</a></li>
	</ul>
	 <?
endif;
?>
</div></div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order",
	"template1",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ALLOW_INNER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "template1",
		"CUSTOM_SELECT_PROPS" => array(),
		"DETAIL_HIDE_USER_INFO" => array(0=>"EMAIL",),
		"HISTORIC_STATUSES" => array(0=>"F",),
		"NAV_TEMPLATE" => "arrows",
		"ONLY_INNER_FULL" => "N",
		"ORDERS_PER_PAGE" => "10",
		"ORDER_DEFAULT_SORT" => "DATE_INSERT",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_CATALOG" => "/catalog/",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PROP_1" => array(0=>"2",),
		"PROP_2" => array(0=>"8",1=>"9",2=>"10",3=>"11",4=>"12",5=>"13",6=>"14",7=>"15",8=>"16",9=>"17",10=>"18",11=>"19",12=>"21",),
		"RESTRICT_CHANGE_PAYSYSTEM" => array(0=>"0",),
		"SAVE_IN_SESSION" => "N",
		"SEF_FOLDER" => "/personal/order/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => array("list"=>"index.php","detail"=>"detail/#ID#/","cancel"=>"cancel/#ID#/",),
		"SET_TITLE" => "Y",
		"STATUS_COLOR_E" => "gray",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_P" => "yellow",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
		"STATUS_COLOR_S" => "gray",
		"STATUS_COLOR_SP" => "gray"
	)
);?>
</div>
<h2>Возможно Вам будет интересно</h2>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "79",
		"IBLOCK_TYPE" => "1c_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "18",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array("Для интернет-магазина хим реаг (UDS)","Для интернет-магазина хим реаг (евро)","Для интернет-магазина хим реаг руб","Для интернет-магазина  руб","Для интернет-магазина (UDS)","Для интернет-магазина  (евро)"),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE" => array("",""),
		"PROPERTY_CODE_MOBILE" => array(),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "bestsell",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SEF_MODE" => "N",
		"SEF_RULE" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "Y",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>