<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');



if (isset($_REQUEST['subscriptionWindowId']))
{
	?>
	<div>
		<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/components/bitrix/catalog.product.subscribe/subscribe_discount/style.css">
		<div id="<?=$_REQUEST['subscriptionWindowId']?>">
			<div class="cs-modal-subscription-window">
			  	<div class="cs-modal-subscription-container">
			  		
			  		<div class="cs-modal-subscription-main">
			  			<div class="row">
			  				<div class="col-md-6 col-md-offset-3 cs-modal-subscription-inner">
			  					<h3>Підписатися:<?=getMessage('CPST_SUBSCRIBE_BUTTON_NAME');?></h3>
								<div class="cs-modal-subscription-clone"></div>

			  				</div>
			  				
			  			</div>	  				  		
			  		</div>
			  		
			  	</div>
			</div>
		</div>
		<script type="text/javascript">
			$('#<?=$_REQUEST['subscriptionWindowId']?> .row').click(function(){
				//$('#<?=$_REQUEST['subscriptionWindowId']?>').modal('hide');
			});
			$('#<?=$_REQUEST['subscriptionWindowId']?>').on('show.bs.modal', function (e) {
				$('#<?=$_REQUEST['subscriptionWindowId']?> .cs-modal-subscription-window').css("display", "table");	  
			});
			$('#<?=$_REQUEST['subscriptionWindowId']?>').on('hidden.bs.modal', function (e) {
				$('#<?=$_REQUEST['subscriptionWindowId']?> .cs-modal-subscription-window').css("display", "none");	  
			});
		</script>
	</div>
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