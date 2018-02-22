<?
AddEventHandler("catalog", "OnDiscountAdd", Array("MyClass", "MyMessage"));

class MyClass
{
	function MyMessage($ID)
	{
		//AddMessage2Log($ID, "my_module_id");

	  	//mail('chuga_a@ukr.net', 'Discount', $ID);
	  	//получаем все товары данной скидки
		$dbProductDiscounts = CCatalogDiscount::GetList(
					    array("SORT" => "ASC"),
					    array("ACTIVE" => "Y", "ID" => $ID),
					    false,
					    false,
					    array("ID", "ACTIVE_FROM", "PRODUCT_ID")
					    );
					while ($arProductDiscounts = $dbProductDiscounts->Fetch()) 
					{
								$akcii_arr[] = $arProductDiscounts["PRODUCT_ID"];
								
								//получаем url товара
								$res = CIBlockElement::GetByID( $arProductDiscounts["PRODUCT_ID"]);
								if($ar_res = $res->GetNext())
								  $itemUrl = str_replace('/ua/', '', $ar_res['DETAIL_PAGE_URL']);
						//получаем всех подписчиков на товар и отправляем письмо
						global $DB;
						$arMail = Array();
								$tableName = \Bitrix\Catalog\SubscribeTable::getTableName();
								$results = $DB->Query("SELECT `USER_CONTACT` FROM `" . $tableName . "` WHERE `ITEM_ID`='".$arProductDiscounts["PRODUCT_ID"]."'");
								while ($row = $results->Fetch()) {
									$arMail[] = $row["USER_CONTACT"];
				
									//send mail
									if (!empty($arMail))
									{
										//$eventName = "SALE_SUBSCRIBE_PRODUCT";

										$eventName = "SALE_SUBSCRIBE_DISCOUNT_PRODUCT";
										$event = new CEvent;
				
										foreach ($arMail as $personType => $mail)
										{
											$checkMail = strtolower($mail);
											if (isset($sendEmailList[$checkMail]))
												continue;
											
				
											$arFields = array(
												"EMAIL" => $mail,
												"USER_NAME" => '',
												"NAME" => '',
												"PAGE_URL" => 'http://1167340.casualua.web.hosting-test.net/ua/sale/',
												"DEFAULT_EMAIL_FROM" => COption::GetOptionString("sale", "order_email", "order@".$_SERVER["SERVER_NAME"]),
											);
				
											$event->Send($eventName, "s1", $arFields, "Y");

											$sendEmailList[$checkMail] = true;
											$myMess = $sendEmailList[$checkMail];
											//mail('chuga_a@ukr.net', 'Discount', $myMess);
										}
									}
									
								}
								
					}	  
	  
	}
}













// =============================================================================================================================
// UPDATE MIN-MAX PRICE  
AddEventHandler("iblock", "OnAfterIBlockElementUpdate",  Array("ClassChangeIBlockElement", "OnAfterIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("ClassChangeIBlockElement", "OnAfterIBlockElementAddHandler"));

/*
AddEventHandler("catalog", "OnPriceAdd", "IBlockElementAfterSaveHandler");
AddEventHandler("catalog", "OnPriceUpdate", "IBlockElementAfterSaveHandler");
AddEventHandler("catalog", "OnProductUpdate", "IBlockElementAfterSaveHandler");

function BXIBlockAfterSave($arFields) {
   IBlockElementAfterSaveHandler($arFields);
}
function IBlockElementAfterSaveHandler($id, $arFields){
	//Bitrix\Main\Diag\Debug::writeToFile(array('i9'=>$id), "", "/test/logname.log");
	//Bitrix\Main\Diag\Debug::writeToFile(array('a9'=>$arFields), "", "/test/logname.log");	
	
	if (is_array($id)) { //isset($arFields['PRODUCT_ID'])
    	$arDiscounts = CCatalogDiscount::GetDiscountByPrice( $id['ID'], $USER->GetUserGroupArray(), "N", 's1' );
    	//$discountPrice = CCatalogProduct::CountPriceWithDiscount( $arPrice["PRICE"], $arPrice["CURRENCY"], $arDiscounts );
		//Bitrix\Main\Diag\Debug::writeToFile(array('M__OnPriceUpdate'=>$arFields), "", "/test/logname.log");
		//$piResult = CCatalogSku::GetProductInfo( $id['ID'], 5 );
		//$xxx = GetOfferMinMaxPriceAndDiscount($piResult['IBLOCK_ID'], $piResult['ID']);
		Bitrix\Main\Diag\Debug::writeToFile(array('MMM'=>$arDiscounts), "", "/test/logname.log");
	}
}
/**/

// -----------------------------------------------------------------------
function GetOfferMinMaxPriceAndDiscount($ibId, $id)
{
	global $USER;
	$minmax = array();
  	$discount = array();
	$res = CCatalogSKU::getOffersList( $id, $ibId, array(), array(), array() );

	foreach ($res[$id] as $idi) {
		//$resPx = CPrice::GetBasePrice($idi['ID'], false, false);	
		//Bitrix\Main\Diag\Debug::writeToFile($resPx, "", "/test/logname.log");		
		$resP = CCatalogProduct::GetOptimalPrice($idi['ID'], 1, $USER->GetUserGroupArray(), 'N', array());    
		//Bitrix\Main\Diag\Debug::writeToFile($resP, "", "/test/logname.log");		
  		array_push($minmax, $resP['RESULT_PRICE']['BASE_PRICE']);
  		array_push($discount, $resP['RESULT_PRICE']['DISCOUNT_PRICE'] );
	}	
	return array('minmax' => $minmax, 'discount'=>$discount);
}

class ClassChangeIBlockElement
{

	public function OnBeforePriceUpdateHandler(&$id, &$arFields){
		
	}

	public function OnAfterIBlockElementUpdateHandler(&$arFields)
	{		
			
		if( $arFields["ID"] > 0 )
		{
			$masMinMax = array();
			$piResult = CCatalogSku::GetProductInfo(
    			$arFields['ID'],
    			$arFields['IBLOCK_ID']
  			);		
		//$ID_BLOCK = '4'; // 1c_catalog		
		$masMinMax = GetOfferMinMaxPriceAndDiscount($piResult['IBLOCK_ID'], $piResult['ID']);		
		$MIN_PRICE  = min($masMinMax['minmax']);
		$MAX_PRICE  = max($masMinMax['minmax']);
		$DISCOUNT_PRICE  = min($masMinMax['discount']);	

		CIBlockElement::SetPropertyValues($piResult['ID'], $piResult['IBLOCK_ID'], $MIN_PRICE, 'MINIMUM_PRICE');
	    CIBlockElement::SetPropertyValues($piResult['ID'], $piResult['IBLOCK_ID'], $MAX_PRICE, 'MAXIMUM_PRICE');
	    CIBlockElement::SetPropertyValues($piResult['ID'], $piResult['IBLOCK_ID'], $DISCOUNT_PRICE, 'DISCOUNT_PRICE');		
		}
	}

	public function OnAfterIBlockElementAddHandler(&$arFields) 
	{
		if( $arFields["ID"] > 0 )
		{
			$masMinMax = array();
			$piResult = CCatalogSku::GetProductInfo(
    			$arFields['ID'],
    			$arFields['IBLOCK_ID']
  			);		
		//$ID_BLOCK = '4'; // 1c_catalog	
		$masMinMax = GetOfferMinMaxPriceAndDiscount($piResult['IBLOCK_ID'], $piResult['ID']);				
		$MIN_PRICE  = min($masMinMax['minmax']);
		$MAX_PRICE  = max($masMinMax['minmax']);
		$DISCOUNT_PRICE  = min($masMinMax['discount']);	

		CIBlockElement::SetPropertyValues($piResult['ID'], $piResult['IBLOCK_ID'], $MIN_PRICE, 'MINIMUM_PRICE');
	    CIBlockElement::SetPropertyValues($piResult['ID'], $piResult['IBLOCK_ID'], $MAX_PRICE, 'MAXIMUM_PRICE');
	    CIBlockElement::SetPropertyValues($piResult['ID'], $piResult['IBLOCK_ID'], $DISCOUNT_PRICE, 'DISCOUNT_PRICE');		
		}
	}
}


?>