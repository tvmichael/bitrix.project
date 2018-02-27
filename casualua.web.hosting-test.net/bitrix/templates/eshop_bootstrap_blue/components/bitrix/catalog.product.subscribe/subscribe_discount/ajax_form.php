<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');



if (isset($_REQUEST['subscriptionWindowId']))
{
	?>
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/components/bitrix/catalog.product.subscribe/subscribe_discount/style.css">
	<div id="<?=$_REQUEST['subscriptionWindowId']?>" class="cs-modal-subscription-window">
	  	<div class="cs-modal-subscription-container">
	  		<div class="cs-modal-subscription-header">
	  			<h2>1</h2>
	  		</div>
	  		<div class="cs-modal-subscription-main">
	  			<h2>1</h2>
	  		</div>
	  		<div class="cs-modal-subscription-footer">
	  			<h2>1</h2>
	  		</div>
	  	</div>
	</div>
	<script type="text/javascript">
		$('#<?=$_REQUEST['subscriptionWindowId']?>').modal('show');
	</script>
	<?
}
elseif (isset($_REQUEST['productId']))
{
	$productId = intval($_REQUEST['productId']);
	?>
	<script src="<?=SITE_TEMPLATE_PATH?>/components/bitrix/catalog.product.subscribe/subscribe_discount/script.js"></script>
	<?	
	if ($productId > 0)
	{
		if ($USER->IsAuthorized())
		{

		}
		else
		{

		}
	}
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
?>


	<?
	/*
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
	*/
	?>