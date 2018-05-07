<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<div>
<?

$APPLICATION->IncludeComponent(
	"bitrix:catalog.product.subscribe", 
	"subscribe_discount", 
	array(
		"BUTTON_CLASS" => "",
		"BUTTON_ID" => "",
		"CACHE_TIME" => "30",
		"CACHE_TYPE" => "A",
		"PRODUCT_ID" => "",
		"COMPONENT_TEMPLATE" => "subscribe_discount"
	),
	false
);

?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>