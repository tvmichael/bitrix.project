<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><h2>B</h2>

<pre style="position: absolute; left: -200px;">
<?

$discountIterator = Bitrix\Sale\Internals\DiscountTable::getList ([            
            //'select' => ['ID', 'XML_ID', 'ACTIVE_FROM', 'ACTIVE_TO', 'CONDITIONS_LIST', 'ACTIONS_LIST'],
            'filter' => ['ACTIVE' => 'Y'],  
        ]);
while ($discount = $discountIterator->fetch()){
   
   if ($discount['ID'] == 83 || $discount['ID'] == 84 ){
      echo '<h3 style="color:red;">'.$discount['ID'].'</h3>';
      print_r($discount);
      //var_dump($discount);
   }
   //print_r($discount['CONDITIONS_LIST']);
   //print_r($discount['ACTIONS_LIST']);
   
   //var_dump($discount['ACTIVE_FROM']);   
   //if( gettype($discount['ACTIVE_FROM']) == 'object'  )
   //echo '<br>'.$discount['ACTIVE_FROM']->toString();

   
}



// значення властивостей товару де: ( - id розділу,  - id конткретного товару,  -id властивості)
$db_props = CIBlockElement::GetProperty(14, 95119, array("sort" => "asc"), Array());
while ($ob = $db_props->GetNext())
{
 // print_r($ob);
}

?>
</pre>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>