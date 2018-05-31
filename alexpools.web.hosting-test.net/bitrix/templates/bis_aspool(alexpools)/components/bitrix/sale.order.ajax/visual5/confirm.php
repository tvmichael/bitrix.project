<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
	#submit_block {display:none !important;}
</style>
<div class="notetext">
	<?
	if (!empty($arResult["ORDER"]))
	{
		?>
		<h3><?=GetMessage("SOA_TEMPL_ORDER_COMPLETE")?></h3>

		<p> 
			<?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER_ID"]))?>
			<br />
			<?= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?>
		</p>

		<? /* if ($arResult["ORDER"]["STATUS_ID"]=="E") 
		{ ?>
			<p>
				<?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER_ID"]))?>
				<br />
				<?= GetMessage("SOA_TEMPL_ORDER_OBES")?>
			</p>
			 <? 
		} else 
		{ ?> 		
			<p> 
				<?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER_ID"]))?>
				<br />
				<?= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?>
			</p>
		 <?} */ ?>
		
		<?
		/*
		if ($arResult["ORDER"]["STATUS_ID"] == "E") 
		{?>
			<p>Оплата заказа производится после уточнения с менеджером</p><? 
		} 
		else 
		/**/	
		{
			/* подключаем оплату даже если статус Е*/?> 
			<!--Платежная система если все норм -->
			<? 
			if (!empty($arResult["PAY_SYSTEM"]))
			{
				?>
				<p><?=GetMessage("SOA_TEMPL_PAY")?>: <?= $arResult["PAY_SYSTEM"]["NAME"] ?></p><br />
				<?
				if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
				{	
					if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
					{
						?>						
						<script language="JavaScript">
							window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?= $arResult["ORDER_ID"] ?>');
						</script>
						<p><?=GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$arResult["ORDER_ID"])) ?></p>
						<?
					}
				}
							
				else
				{
					if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0)
					{
						include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
						//include($arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$arResult["ORDER_ID"]);
					}
				}
			} ?>
			<!--Платежная система если все норм -->		
		<?} // подключаем оплату даже если статус Е ?>

		<?// tmv-20.05.18 Cкрипт для динамического ремаркетинга. Данные о транзакции -  После успешного оформления заказа ?>
		<script type="text/javascript">
			<?
			$arDynamicRemarketingProducts = array();		
			foreach ($arResult["BASKET_ITEMS"] as $key => $value)
			{
				$brand = CIBlockElement::GetByID($value['PRODUCT_ID'])->GetNextElement()->GetProperties();					
				$categoryPath = '';
				$rsElement = CIBlockElement::GetList(array(), array('ID' => $value['PRODUCT_ID']), false, false, array('IBLOCK_SECTION_ID'));
				if($arElement = $rsElement->Fetch())
				{	
					$i = 0;		
					$iBlockSectionId = $arElement["IBLOCK_SECTION_ID"];			
					while ($iBlockSectionId > 0 && $i < 10)
					{
						$res = CIBlockSection::GetByID($iBlockSectionId);
						if($ar_res = $res->GetNext())
						{				
							$categoryPath = $ar_res['NAME'].($i==0?'':'/').$categoryPath;
							$iBlockSectionId = $ar_res["IBLOCK_SECTION_ID"];				
						}    
						$i++;			
					}
				}
				$arDynamicRemarketingProducts[$key] = array(
					"id" => $value['PRODUCT_ID'],
			        "name" => $value['NAME'],
			        "price" => $value['PRICE'],
			        "brand" => $brand['CML2_MANUFACTURER']['VALUE'],
			        "category" => $categoryPath,
			        "quantity" => $value['QUANTITY']
				);
			}
			?>

			var dynamicRemarketingJSParams = <?=CUtil::PhpToJSObject($arDynamicRemarketingProducts);?>;
			var dataLayer = window.dataLayer = window.dataLayer || [];

			dataLayer.push({
				'event': 'purchase',
				'ecommerce': {
					'currencyCode': '<?echo $arResult['ORDER']['CURRENCY'];?>',
					'purchase': {
						'actionField': {
							'id': '<?echo $arResult['ORDER_ID'];?>',
							'affiliation': 'alexpools',
							'revenue': '<?echo $arResult['ORDER_TOTAL_PRICE'];?>',
							'tax': '<?echo $arResult['ORDER']['TAX_VALUE'];?>',
							'shipping': '<?echo $arResult['ORDER']['PRICE_DELIVERY'];?>',
							'coupon': ''
						},
						'products': dynamicRemarketingJSParams
						}
				}
			});

			//console.log(dataLayer);
		</script>		
		<?
	}
	else
	{
		?>
		<p>
			<b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br />
			<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ORDER_ID"]))?>
			<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
		</p>
		<?
	}?>

	<?/*
	<div id="get-payment"></div>
	<script>
	$.get('<?=$arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$arResult["ORDER_ID"];?>', function(res){$('#get-payment').html(res);});
	</script>
	*/?>

</div>

<?
if($USER->IsAdmin() && $USER->GetID() == 212) 
{
	//echo '<pre>'; 
	//echo "<hr>";
	//echo "<h2>CONFIRM</h2>";
	//echo "<hr>";
	//print_r($arResult);	
	//echo '</pre>';
}
?>