<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><h2>Index</h2>


<pre>
<?

$ar = \Bitrix\Sale\Internals\DiscountGroupTable::getActiveDiscountByGroups(array(2));
print_r($ar);
echo "<br>Count=".count($ar)."<br>";


echo "<br>";
$n = 0;
$groupDiscountIterator = Bitrix\Sale\Internals\DiscountGroupTable::getList(array(
    //'select' => array('DISCOUNT_ID'),
    'filter' => array('=ACTIVE' => 'Y')
));
while ($groupDiscount = $groupDiscountIterator->fetch()) {
	//print_r( CCatalogDiscount::GetByID($groupDiscount['DISCOUNT_ID']) );
   	print_r($groupDiscount);
   	//print_r(CSaleDiscount::GetByID($groupDiscount['DISCOUNT_ID']) );
   	//print_r( CCatalogDiscount::GetByID($groupDiscount['DISCOUNT_ID']) );
   	//print_r( CCatalogDiscountCoupon::GetByID($groupDiscount['DISCOUNT_ID'])) ;
   	//echo "<br>";
    $n++;
}
echo "<br>Count=".$n."<br>";

//echo "<br>CCatalogDiscountCoupon::GetByID:";
//print_r( CCatalogDiscountCoupon::GetByID(77) );
//echo "<br>CCatalogDiscount::GetByID:";
//print_r( CCatalogDiscount::GetByID(77));



/*
echo "<p>calculateDeliveryPrice:</p>";
$element_id = 93897;
$deliveryId = 2;
$obBasket = \Bitrix\Sale\Basket::create(SITE_ID);
$obItem = $obBasket->createItem("catalog", $element_id);
$arProductFields = array(
    'NAME' => "Футболка Мужская Чистота",
    'PRICE' => 799.00,
    'CURRENCY' => 'UAN',
    'QUANTITY' => 1,
    'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
    'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
);
$obItem->setFields($arProductFields);
$obOrder = \Bitrix\Sale\Order::create(SITE_ID, 1);
$obOrder->setPersonTypeId(1);
$obOrder->setBasket($obBasket);
$obShipmentCollection = $obOrder->getShipmentCollection();
$obShipment = $obShipmentCollection->createItem(\Bitrix\Sale\Delivery\Services\Manager::getObjectById($deliveryId));
$shipmentItemCollection = $obShipment->getShipmentItemCollection();

echo "<hr><p>obShipment:</p>";
print_r($obShipment);
$arDelivery = \Bitrix\Sale\Delivery\Services\Manager::calculateDeliveryPrice($obShipment, $deliveryId);

echo "<p>arDelivery:</p>";
print_r($arDelivery);
*/


$n = 0;
echo '<br><hr>';
$db_res = CSaleDiscount::GetList(
    array("SORT" => "ASC"),
    array(
        "LID" => SITE_ID,
        "ACTIVE" => "Y",
    ),
    false,
    false,
    array()
);
while ($ar_res = $db_res->Fetch())
{
   print_r(CSaleDiscount::GetByID($ar_res['ID']) ); 
   $n++;
}
echo "<br>Count=".$n."<br>";

?>
</pre>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>