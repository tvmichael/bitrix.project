<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');


//ID товара (торговый каталог)
$productId = intval($_REQUEST['id']);
$quantity = 1;
$action = "KAPSULA2BASKET";

$result = 0;


if (CModule::IncludeModule("catalog"))
{
	echo '1';
    if (($action == "ADD2BASKET" || $action == "BUY") && $productId > 0)
    {
        Add2BasketByProductID(
                $productId,
                $quantity,
                array(
                	array("NAME" => 'Розмір', "CODE" =>'size', "VALUE" => 'L'),
                )
            );
        if ($action == "BUY")
            LocalRedirect("basket.php");
    }
}



print_r($id);
?>