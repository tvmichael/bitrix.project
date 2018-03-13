<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	"visual3", 
	array(
		"PAY_FROM_ACCOUNT" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"COUNT_DELIVERY_TAX" => "N",
		"ALLOW_AUTO_REGISTER" => "Y",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "N",
		"TEMPLATE_LOCATION" => "popup",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"USE_PREPAYMENT" => "N",
		"PROP_1" => "",
		"PROP_2" => "",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_PERSONAL" => "/personal/order/",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_AUTH" => "/auth/",
		"SET_TITLE" => "Y",
		"PRODUCT_COLUMNS" => array(
			0 => "PROPERTY_CML2_ARTICLE",
		),
		"PATH_TO_ORDER" => "",
		"DISABLE_BASKET_REDIRECT" => "Y",
		"ALLOW_NEW_PROFILE" => "N",
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "N",
		"COMPONENT_TEMPLATE" => "visual3",
		"COMPATIBLE_MODE" => "Y",
		"USE_PRELOAD" => "Y",
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PRICE_FORMATED",
			1 => "PROPERTY_CML2_ARTICLE",
		),
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ADDITIONAL_PICT_PROP_4" => "-",
		"ADDITIONAL_PICT_PROP_75" => "-",
		"ADDITIONAL_PICT_PROP_79" => "-",
		"BASKET_IMAGES_SCALING" => "standard",
		"ALLOW_APPEND_ORDER" => "N",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"SHOW_VAT_PRICE" => "Y",
		"ACTION_VARIABLE" => "action"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>