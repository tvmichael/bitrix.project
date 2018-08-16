<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><h2>C</h2>


<pre>
<?

function GET_SALE_FILTER(){
  global $DB;
 
  $arDiscountElementID = array();
  $dbProductDiscounts = CCatalogDiscount::GetList(
     array("SORT" => "ASC"),
     array(
        "ACTIVE" => "Y",
        "!>ACTIVE_FROM" => $DB->FormatDate(date("Y-m-d H:i:s"),
              "YYYY-MM-DD HH:MI:SS",
              CSite::GetDateFormat("FULL")),
        "!<active_to" ==""> $DB->FormatDate(date("Y-m-d H:i:s"),
              "YYYY-MM-DD HH:MI:SS",
              CSite::GetDateFormat("FULL")),
     ),
     false,
     false,
     array(
        "ID", "SITE_ID", "ACTIVE", "ACTIVE_FROM", "ACTIVE_TO",
        "RENEWAL", "NAME", "SORT", "MAX_DISCOUNT", "VALUE_TYPE",
        "VALUE", "CURRENCY", "PRODUCT_ID"
     )
  );
  while ($arProductDiscounts = $dbProductDiscounts->Fetch())
  {
     if($res = CCatalogDiscount::GetDiscountProductsList(array(), array(">=DISCOUNT_ID" => $arProductDiscounts['ID']), false, false, array()) )
     {
        while($ob = $res->GetNext()){
           if(!in_array($ob["PRODUCT_ID"],$arDiscountElementID))
              $arDiscountElementID[] = $ob["PRODUCT_ID"];
        }
      }
  }
 
  return $arDiscountElementID;
 
}

print_r( GET_SALE_FILTER());




// ---------------------------------------
$arr = \Bitrix\Sale\Internals\DiscountGroupTable::getActiveDiscountByGroups(array(2));
print_r( $arr);


foreach ($arr as $key => $value) {
  $res = CCatalogDiscount::GetDiscountProductsList(array(), array("=DISCOUNT_ID" => $value), false, false, array());
  //echo "<br><h2>".$value.'</h2>';
  //print_r( $res );  
  while($ob = $res->GetNext() )
  {
    //echo "<br><h2>".'---'.'</h2>';
    //print_r( $ob );  
    // if(!in_array($ob["PRODUCT_ID"],$arDiscountElementID)) $arDiscountElementID[] = $ob["PRODUCT_ID"];
  }  
  
}


echo "<hr>";
$dbProductDiscounts = CCatalogDiscount::GetList(
    array("SORT" => "ASC"),
    array(
            // "+PRODUCT_ID" => $PRODUCT_ID,
            // "ACTIVE" => "Y",
            // "COUPON" => ""
        ),
    false,
    false,
    array()
    );
while ($arProductDiscounts = $dbProductDiscounts->Fetch())
{
    print_r($arProductDiscounts);
}


?>
</pre>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>