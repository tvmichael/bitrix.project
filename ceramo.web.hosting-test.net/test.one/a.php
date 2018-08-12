<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><h2>A</h2>

<pre>
<?

$applyToDelivery = 'ToDelivery';
$applySimpleGift = 'SimpleGift';
$applyToBasket = 'ToBasket';
$conditionCondIBProp = 'CondIBProp:';

$count = 0;

// старий метод дістає всі правила корзини
$db_res = CSaleDiscount::GetList(
    array("SORT" => "ASC"),
    array("LID" => SITE_ID,  "ACTIVE" => "Y",),
    false,
    false,
    array()
);
while ($ar_res = $db_res->Fetch())
{
   	$arSaleDiscount = CSaleDiscount::GetByID($ar_res['ID']);

   	if (strpos($arSaleDiscount['APPLICATION'], $applyToDelivery) !== false )
   	{
		echo "<h3>$applyToDelivery: ".$arSaleDiscount['ID']."</h3>";		
	} 
	elseif (strpos($arSaleDiscount['APPLICATION'], $applySimpleGift) !== false ) 
	{
		echo "<h3>$applySimpleGift: ".$arSaleDiscount['ID']."</h3>";
	}
	elseif (strpos($arSaleDiscount['APPLICATION'], $applyToBasket) !== false ) 
	{
		echo "<h3>$applyToBasket: ".$arSaleDiscount['ID']."</h3>";
	}


	// parse 	
	$lastPos = 0;
	$positions = array();
	while (($lastPos = strpos($arSaleDiscount['CONDITIONS'], $conditionCondIBProp, $lastPos)) !== false ) {
	    $positions[] = $lastPos;
	    $lastPos = $lastPos + strlen($conditionCondIBProp);
	}

	$count++;
}

echo "<br>count= ".$count.'<br>';

?>
</pre>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>