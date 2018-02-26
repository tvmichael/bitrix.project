<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");


?>
<button id="xxx000">Компонент</button>
<div id="xxx111"></div>
<script src="<?=SITE_TEMPLATE_PATH?>/components/bitrix/catalog.product.subscribe/subscribe_discount/script.js"></script>
<script type="text/javascript">
	$('#xxx000').click(function (argument) {
		$.get( "/bitrix/templates/eshop_bootstrap_blue/components/bitrix/catalog.product.subscribe/subscribe_discount/ajax_form.php", function( data ) {
		  $( "#xxx111" ).html( data );		  
		});
	})
</script>




<hr>
<div>
<?
/*
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
*/
?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>