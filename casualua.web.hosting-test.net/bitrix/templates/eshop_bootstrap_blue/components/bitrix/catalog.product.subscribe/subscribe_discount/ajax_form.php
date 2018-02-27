<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');


if (isset($_REQUEST['productId']))
{
	$productId = intval($_REQUEST['productId']);
	$btnId = $_REQUEST['btnId'];
	
	?>
	<script src="<?=SITE_TEMPLATE_PATH?>/components/bitrix/catalog.product.subscribe/subscribe_discount/script.js"></script>
	<div>
		<?	
		$APPLICATION->IncludeComponent(
		"bitrix:catalog.product.subscribe", 
		"subscribe_discount", 
		array(
			"BUTTON_CLASS" => "",
			"BUTTON_ID" => $btnId,
			"CACHE_TIME" => "3600",
			"CACHE_TYPE" => "A",
			"PRODUCT_ID" => $productId,
			"COMPONENT_TEMPLATE" => "subscribe_discount"
		),
		false
		);
		?>
	</div>
	<?
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
?>
