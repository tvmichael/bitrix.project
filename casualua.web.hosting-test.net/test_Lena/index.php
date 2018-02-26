<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->IncludeComponent("bitrix:catalog.product.subscribe", "subscribe_discount", Array(
	"BUTTON_CLASS" => "",	// CSS класс кнопки подписки
		"BUTTON_ID" => "336",	// ID кнопки подписки
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"PRODUCT_ID" => "336",	// ID товара
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>