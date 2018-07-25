<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результат");
?>
<h2>РЕЗУЛЬТАТ</h2>

<?
if($USER->IsAdmin() && $USER->GetID() == 212) 
{


$ORDER_ID = 240;
if (!($arOrder = CSaleOrder::GetByID($ORDER_ID)))
{
   echo "Заказ с кодом ".$ORDER_ID." не найден";
}
else
{
	echo "<h2>240</h2>";
	echo '<pre>'; 		
   	print_r($arOrder);
	echo '</pre>';
}




$PRODUCT_ID = 29678;

echo "<h2>КОЛИЧЕСТВО</h2>";
$ID = $PRODUCT_ID;
$ar_res = CCatalogProduct::GetByID($ID);
echo "<br>Товар с кодом ".$ID." имеет следующие параметры:<pre>";
print_r($ar_res);
echo "</pre>";

$PRODUCT_ID = 28570;

echo "<h2>КОЛИЧЕСТВО</h2>";
$ID = $PRODUCT_ID;
$ar_res = CCatalogProduct::GetByID($ID);
echo "<br>Товар с кодом ".$ID." имеет следующие параметры:<pre>";
print_r($ar_res);
echo "</pre>";


}
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>