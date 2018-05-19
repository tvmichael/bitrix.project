<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2><?=GetMessage("SOA_TEMPL_SUM_TITLE")?></h2>
<div style="overflow-x:auto;">
<table class="equipment" rules="rows">
    <thead>
        <tr>
			<td align="center">Код</td>
            <td align="center"><?=GetMessage("SOA_TEMPL_SUM_NAME")?></td>
            <td align="center"><?/* =GetMessage("SOA_TEMPL_SUM_PROPS") */?></td>
            <td align="center"><?/* =GetMessage("SOA_TEMPL_SUM_DISCOUNT") */?></td>
            <td align="center"><?/* =GetMessage("SOA_TEMPL_SUM_WEIGHT") */?></td>
			<td align="center"><?=GetMessage("SOA_TEMPL_SUM_PRICE")?></td>
            <td align="center"><?=GetMessage("SOA_TEMPL_SUM_QUANTITY")?></td>
            <td align="center">Сумма</td>
        </tr>
    </thead>
	<?
	foreach($arResult["BASKET_ITEMS"] as $arBasketItems)
	{
		?>
		<tr>
			<td align="center"><?
            //Вывод артикла не работает, но оставил
                /*$arSelect = Array();
                $arFilter = Array("IBLOCK_ID"=>41, "ID"=>$arBasketItems["PRODUCT_ID"]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9999), $arSelect);
                $ob = $res->GetNextElement();
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                echo $arProps["CML2_ARTICLE"]["VALUE"];*/
            ?>
			<?=$arBasketItems["PROPERTY_CML2_ARTICLE_VALUE"]?>
			</td>
			<td align="center"><?=$arBasketItems["NAME"]?></td>
			<td align="center">
				<?
				foreach($arBasketItems["PROPS"] as $val)
				{
					echo $val["NAME"].": ".$val["VALUE"]."<br />";
				}
				?>
			</td>
			<td align="center"><?/* =$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"] */?></td>
			<td align="center"><?/* =$arBasketItems["WEIGHT_FORMATED"] */?></td>
			<td align="center"><?=$arBasketItems["PRICE_FORMATED"]?></td>
			<td align="center"><?=$arBasketItems["QUANTITY"]?></td>
			<td align="center"><?
			$summ=$arBasketItems["PRICE"]*$arBasketItems["QUANTITY"];
			echo number_format($summ, 0, ',', ' ');
			
			?>&nbsp; руб.</td>
		</tr>
		<?
	}
	?>
</table>
</div>

<table class="myorders_itog">
<!--	<tr>
		<td><?//=GetMessage("SOA_TEMPL_SUM_WEIGHT_SUM")?></td>
		<td><?//=$arResult["ORDER_WEIGHT_FORMATED"]?></td>
	</tr>
-->
	<tr>
		<td><?/*=GetMessage("SOA_TEMPL_SUM_SUMMARY") */?></td>
		<td><?/*=$arResult["ORDER_PRICE_FORMATED"] */?></td>
	</tr>
	<?
	if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
	{
		?>
		<tr>
			<td><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?><?if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0):?> (<?echo $arResult["DISCOUNT_PERCENT_FORMATED"];?>)<?endif;?>:</td>
			<td><?echo $arResult["DISCOUNT_PRICE_FORMATED"]?>
			</td>
		</tr>
		<?
	}
	if(!empty($arResult["arTaxList"]) /* && $arResult["PERSON_TYPE"]["ID"] !== "1" */)
	{
		foreach($arResult["arTaxList"] as $val)
		{
			?>
			<tr>
				<td><?=$val["NAME"]?> <?=$val["VALUE_FORMATED"]?>:</td>
				<td><?=$val["VALUE_MONEY_FORMATED"]?></td>
			</tr>
			<?
		}
	}
	if (doubleval($arResult["DELIVERY_PRICE"]) > 0)
	{
		?>
		<tr>
			<td><?=GetMessage("SOA_TEMPL_SUM_DELIVERY")?></td>
			<td><?=$arResult["DELIVERY_PRICE_FORMATED"]?></td>
		</tr>
		<?
	}
	?>
	<tr>
		<td><?=GetMessage("SOA_TEMPL_SUM_IT")?></td>
		<td><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></td>
	</tr>
	<?
	if (strlen($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0)
	{
		?>
		<tr>
			<td><?=GetMessage("SOA_TEMPL_SUM_PAYED")?></td>
			<td><?=$arResult["PAYED_FROM_ACCOUNT_FORMATED"]?></td>
		</tr>
		<?
	}
	?>
</table>


<h2><?=GetMessage("SOA_TEMPL_SUM_ADIT_INFO")?></h2>
<textarea class="texta-adap" name="ORDER_DESCRIPTION"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>

