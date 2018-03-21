<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("personal.order.detail.mail");
?>
<div class="col-xs-12 col-sm-12 col-md-12">
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.detail.mail", 
	"en.sale.personal.order.detail.mail", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CUSTOM_SELECT_PROPS" => array(
			0 => "PICTURE",
			1 => "NAME",
			2 => "PRICE_FORMATED",
			3 => "QUANTITY",
		),
		"ID" => "73",
		"PATH_TO_CANCEL" => "/personal/cancel/ORDER_ID",
		"PATH_TO_LIST" => "personal/orders/ORDER_ID",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PICTURE_HEIGHT" => "110",
		"PICTURE_RESAMPLE_TYPE" => "0",
		"PICTURE_WIDTH" => "110",
		"PROP_1" => array(
		),
		"PROP_2" => array(
		),
		"PROP_3" => array(
		),
		"SHOW_ORDER_BASE" => "N",
		"SHOW_ORDER_BASKET" => "Y",
		"SHOW_ORDER_BUYER" => "Y",
		"SHOW_ORDER_DELIVERY" => "Y",
		"SHOW_ORDER_PARAMS" => "N",
		"SHOW_ORDER_PAYMENT" => "Y",
		"SHOW_ORDER_SUM" => "Y",
		"SHOW_ORDER_USER" => "N",
		"COMPONENT_TEMPLATE" => "ua.sale.personal.order.detail.mail"
	),
	false
);?>


</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>