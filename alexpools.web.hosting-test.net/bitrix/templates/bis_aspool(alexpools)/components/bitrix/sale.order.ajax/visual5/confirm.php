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
		
		<?if ($arResult["ORDER"]["STATUS_ID"]=="E") { ?><p><?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER_ID"]))?>
			<br /><br /><?= GetMessage("SOA_TEMPL_ORDER_OBES")?></p> <? } else { ?> 
		
		<p> <?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER_ID"]))?><br /><br />
			<?= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?></p>
		
		 <?}?>
		
		<?if ($arResult["ORDER"]["STATUS_ID"]=="E") { ?><p>Оплата заказа производится после уточнения с менеджером</p><? } else { /* подключаем оплату даже если статус Е*/?> 
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
		<? } // подключаем оплату даже если статус Е ?>


		<?// tmv-20.05.18 Cкрипт для динамического ремаркетинга. Данные о транзакции -  После успешного оформления заказа ?>
		<script type="text/javascript">
			console.log('id='+ <? echo $arResult['ORDER']['ID'];?>);
			console.log('affiliation='+ '<? echo 'alexpools';?>');
			console.log('revenue='+ <? echo $arResult['ORDER']['PRICE'];?>);
			console.log('tax='+ <? echo $arResult['ORDER']['TAX_VALUE'];?>);
			console.log('shipping='+ <? echo $arResult['ORDER']['PRICE_DELIVERY'];?>);

			console.log('Данные о транзакции -  После успешного оформления заказа');
		</script>		
		<?
	}
	else
	{?>
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
