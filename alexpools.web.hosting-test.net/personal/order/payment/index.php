<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Оплата заказа");
?>

<?
// в компонент добавлено скрипт для генерации перехода на сайт платежной системи 
$APPLICATION->IncludeComponent(
	"mv.payment:sale.order.payment",
	"",
	Array(
	)
);
?>


<?
/*
$APPLICATION->IncludeComponent(
	"bitrix:sale.order.payment",
	"",
	Array(
	)
);
/**/
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>