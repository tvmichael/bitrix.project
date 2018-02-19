<?
AddEventHandler("catalog", "OnDiscountAdd", Array("MyClass", "MyMessage"));
/*
use Bitrix\Main,
	Bitrix\Main\Loader,
	Bitrix\Main\ModuleManager,
	Bitrix\Main\Config\Option,
	Bitrix\Main\Localization\Loc,
	Bitrix\Iblock,
	Bitrix\Catalog,
	Bitrix\Catalog\Product\Price,
	Bitrix\Sale\DiscountCouponsManager,
	Bitrix\Sale\Discount\Context,
	Bitrix\Sale\Order,
	Bitrix\Sale;
*/
AddEventHandler("iblock", "OnAfterIBlockElementUpdate",  Array("ClassChangeIBlockElement", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("ClassChangeIBlockElement", "OnAfterIBlockElementAddHandler"));



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

class ClassChangeIBlockElement
{
	public function OnBeforeIBlockElementUpdateHandler(&$arFields)
	{
		if($arFields["ID"] > 0)
		{
			$piResult = CCatalogSku::GetProductInfo(
    			$arFields['ID'],
    			$arFields['IBLOCK_ID']
  			);
			//$ID_BLOCK = '4'; // 1c_catalog
			Bitrix\Main\Diag\Debug::writeToFile($piResult, "", "/test/logname.log");
			$arSelectField = Array("ID");
			$arFilterField = Array("IBLOCK_ID" => $piResult['IBLOCK_ID'], "ID" => $piResult['ID']);
			$res = CIBlockElement::GetList( Array('ID'), $arFilterField, false, Array(), $arSelectField);
						
			
			while($ob = $res->GetNextElement()){
				$arFields = $ob->GetFields();	

								
			  	$masMinMax = $this->get_offer_min_max_price($piResult['IBLOCK_ID'], $piResult['ID'], $piResult['OFFER_IBLOCK_ID'], $arFields["ID"]);
			  	/*
			   	$MIN_PRICE  = min($masMinMax['minmax']);
			   	$MAX_PRICE  = max($masMinMax['minmax']);
			    $DISCOUNT_PRICE  = min($masMinMax['discount']);			    
			    CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array('MINIMUM_PRICE' => $MIN_PRICE));
			    CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array('MAXIMUM_PRICE' => $MAX_PRICE));
			    CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array('DISCOUNT_PRICE' => $DISCOUNT_PRICE));
			    /**/
			}
			/**/
		}

	}

	public function OnAfterIBlockElementAddHandler(&$arFields) 
	{
		$ar = array(
			'0'=> 'Add',
			'1'=>$arFields
		);
		Bitrix\Main\Diag\Debug::writeToFile($ar, "", "/test/logname.log");
	}	

	private function get_offer_min_max_price($ibId, $id, $ofbId, $ofId)
	{
		Bitrix\Main\Diag\Debug::writeToFile(array('bid'=>$ibId, 'id'=>$id, 'obid'=>$ofbId, 'oid'=>$ofId), "", "/test/logname.log");
	}
}
?>