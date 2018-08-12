<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
?><h2>E</h2>

<pre>
<?

$discountIterator = Bitrix\Sale\Internals\DiscountTable::getList ([            
            'select' => ['ID', 'XML_ID', 'ACTIVE_FROM', 'ACTIVE_TO', 'CONDITIONS_LIST', 'ACTIONS_LIST'],
            'filter' => ['ACTIVE' => 'Y'],  
        ]);
while ($discount = $discountIterator->fetch())
{
   echo '<h3 style="color:red;">'.$discount['ID'].'</h3>';
   //print_r($discount);
   //var_dump($discount['ACTIVE_FROM']);
   //if( gettype($discount['ACTIVE_FROM']) == 'object'  )
   //echo '<br>'.$discount['ACTIVE_FROM']->toString();

    //foreach ($discount['ACTIONS_LIST']['CHILDREN'] as $key => $children) {
 	
		//if( $discount['ACTIONS_LIST']['CHILDREN'] )

		//print_r($discount['ACTIONS_LIST']['CHILDREN'][0]['CHILDREN']);

 	//}

	if($discount['ACTIONS_LIST']['CHILDREN'][0]['CLASS_ID'] == 'ActSaleDelivery')
	{
		print_r($discount['CONDITIONS_LIST']);
		echo "<br>-------<br>";
		foreach ($discount['CONDITIONS_LIST']['CHILDREN'] as $key => $value) {
			print_r($value);
		}		
	}

}



?>
</pre>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>