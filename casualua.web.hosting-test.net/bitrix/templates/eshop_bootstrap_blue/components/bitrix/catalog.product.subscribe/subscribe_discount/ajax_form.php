<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');


$productId = 337;

?>


<?
$APPLICATION->IncludeComponent(
"bitrix:catalog.product.subscribe", 
"subscribe_discount", 
array(
	"BUTTON_CLASS" => "",
	"BUTTON_ID" => $productId,
	"CACHE_TIME" => "3600",
	"CACHE_TYPE" => "A",
	"PRODUCT_ID" => $productId,
	"COMPONENT_TEMPLATE" => "subscribe_discount"
),
false
);
?>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
?>