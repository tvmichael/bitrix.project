<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><h2>C</h2>

<pre>
<?

/*
$resProducts =  Bitrix\Iblock\ElementTable::getList([
    'select' => ["*"],
    'filter' => [
        "IBLOCK_ID" => 14, // $arParams['IBLOCK_ID'],
        'ID' => 67056, //$arParams['PRODUCT_ID'],
        "ACTIVE" => "Y",
    ],
]);

while ($item = $resProducts->fetch()){
    print_r($item);
}

echo "<hr>";
$prop = CIBlockElement::GetByID(67056)->GetNextElement()->GetProperties();

print_r($prop);
*/





echo "<h2>PRICE</h2>";
//$ar_price = CCatalogProduct::GetOptimalPrice(67056, 1, $USER->GetUserGroupArray(), false, array(), SITE_ID);
//print_r($prop);
$dbPrice = CPrice::GetList(
        array("SORT" => "ASC"),
        array("PRODUCT_ID" => 67056),
        false,
        false,
        array("ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY")
    );
while ($arPrice = $dbPrice->Fetch())
{
    $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
            $arPrice["ID"],
            $USER->GetUserGroupArray(),
            "N",
            SITE_ID
        );
    $discountPrice = CCatalogProduct::CountPriceWithDiscount(
            $arPrice["PRICE"],
            $arPrice["CURRENCY"],
            $arDiscounts
        );
    $arPrice["DISCOUNT_PRICE"] = $discountPrice;


    print_r($arPrice);

}



?>  
</pre>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>