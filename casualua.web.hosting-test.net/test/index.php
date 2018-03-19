<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("personal.order.detail.mail");
?>
<div class="col-xs-12 col-sm-12 col-md-12">
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.detail.mail", 
	"ua.sale.personal.order.detail.mail", 
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показу дати
		"CACHE_TIME" => "3600",	// Час кешування, сек.
		"CACHE_TYPE" => "A",	// Тип кешування
		"CUSTOM_SELECT_PROPS" => array(	// Виведені колонки складу замовлення
			0 => "PICTURE",
			1 => "NAME",
			2 => "DISCOUNT_PRICE_PERCENT_FORMATED",
			3 => "PRICE_FORMATED",
			4 => "QUANTITY",
		),
		"ID" => "66",	// Ідентифікатор замовлення
		"PATH_TO_CANCEL" => "/personal/cancel/ORDER_ID",	// Сторінка скасування замовлення
		"PATH_TO_LIST" => "personal/orders/ORDER_ID",	// Сторінка зі списком замовлень
		"PATH_TO_PAYMENT" => "/personal/order/payment/",	// Сторінка підключення платіжної системи
		"PICTURE_HEIGHT" => "110",	// Обмеження по висоті для анонсна зображення, px
		"PICTURE_RESAMPLE_TYPE" => "0",	// Тип масштабування
		"PICTURE_WIDTH" => "110",	// Обмеження по ширині для анонсна зображення, px
		"PROP_1" => "",	// Не показувати властивості для типу платника "Фізична особа" (s1)
		"PROP_2" => "",	// Не показувати властивості для типу платника "Юридична особа" (s1)
		"PROP_3" => "",	// Не показувати властивості для типу платника "Фізична особа підприємець" (s1)
		"SHOW_ORDER_BASE" => "Y",	// Показувати загальні дані замовлення
		"SHOW_ORDER_BASKET" => "Y",	// Показувати склад замовлення
		"SHOW_ORDER_BUYER" => "Y",	// Показувати особисті дані
		"SHOW_ORDER_DELIVERY" => "Y",	// Показувати дані для доставки
		"SHOW_ORDER_PARAMS" => "Y",	// Показувати параметри замовлення
		"SHOW_ORDER_PAYMENT" => "Y",	// Показувати параметри доставки та оплати
		"SHOW_ORDER_SUM" => "Y",	// Показувати підсумкову суму
		"SHOW_ORDER_USER" => "N",	// Показувати дані облікового запису
	),
	false
);?>


</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>