<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результат");
?>
<h2>РЕЗУЛЬТАТ</h2>

<?
if($USER->IsAdmin() && $USER->GetID() == 126) 
{
	echo '<pre>'; 

	$product_id = 28849;


	$prop = CIBlockElement::GetByID($product_id)->GetNextElement()->GetProperties();
	print_r($prop['CML2_MANUFACTURER']['VALUE']);
	echo "<br><hr>";
	



	// получить категорию товара по ID	
	$categoryPath = '';	
	$rsElement = CIBlockElement::GetList(array(), array('ID' => $product_id), false, false, array('IBLOCK_SECTION_ID'));
	if($arElement = $rsElement->Fetch())
	{	
		$i = 0;		
		$iBlockSectionId = $arElement["IBLOCK_SECTION_ID"];
		echo "<br>".$i.' - '.$iBlockSectionId;
		while ($iBlockSectionId > 0 && $i < 10)
		{
			$res = CIBlockSection::GetByID($iBlockSectionId);
			if($ar_res = $res->GetNext())
			{				
				$categoryPath = $ar_res['NAME'].($i==0?'':'/').$categoryPath;
				$iBlockSectionId = $ar_res["IBLOCK_SECTION_ID"];				
			}    
			$i++;			
		}
	}



/*
	   print_r($arElement);
	   echo "<br>";

	   $res = CIBlockSection::GetByID($arElement["IBLOCK_SECTION_ID"]);
			if($ar_res = $res->GetNext())
			{
				print_r($ar_res);

				
				$res1 = CIBlockSection::GetByID($ar_res["IBLOCK_SECTION_ID"]);
				if($ar_res1 = $res1->GetNext())
				{
					print_r($ar_res1);					


					$res2 = CIBlockSection::GetByID($ar_res1["IBLOCK_SECTION_ID"]);
					if($ar_res2 = $res2->GetNext())
					{
						print_r($ar_res2);					
						echo '<br> >= '.$ar_res2['NAME'];
					}


					echo '<br> >= '.$ar_res1['NAME'];
				}


				echo '<br> >= '.$ar_res['NAME'];
			}
		/**/

	
	print_r($categoryPath);
		








	echo '</pre>';
		/*
		
         	"currencyCode" => $arResult['MIN_PRICE']['CURRENCY'],
		    "id" => $arResult['ID'],
			"name" => $arResult['NAME'],
			"price" => $arResult['MIN_PRICE']['DISCOUNT_VALUE'],
			"brand" => $arResult['DISPLAY_PROPERTIES']['CML2_MANUFACTURER']['VALUE'],
			"category" => $arResult['CATEGORY_PATH'] 
       	
       	/**/
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>