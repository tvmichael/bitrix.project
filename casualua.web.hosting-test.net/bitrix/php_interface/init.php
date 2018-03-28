<?

AddEventHandler("catalog", "OnDiscountAdd", Array("MyClassMessage", "MyMessage"));

class MyClassMessage
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
											sleep(10);
										}
									}
									
								}
								
					}	  
	  
	}
}



// UPDATE PRICE ===========================================================
AddEventHandler("catalog", "OnPriceAdd",  "Event_IBlockElementUpdateOrAddPrice");
AddEventHandler("catalog", "OnPriceUpdate", "Event_IBlockElementUpdateOrAddPrice");
function Event_IBlockElementUpdateOrAddPrice($id, $arFields) 
{
	global $USER;
	if ( $arFields['PRODUCT_ID'] > 0 )
	{
		$IBLOCK_ID = 5; // 1c_catalog -> Пакет предложений (Каталог) -> id=5
		$piResult = CCatalogSku::GetProductInfo( $arFields['PRODUCT_ID'], $IBLOCK_ID );
		$minmax = array();		
		array_push($minmax, $arFields['PRICE']);
		$res = CCatalogSKU::getOffersList( $piResult['ID'], $piResult['IBLOCK_ID'], array(), array(), array() );
		$rememberID = -1;
		$discount = array();

		foreach ($res[$piResult['ID']] as $idi) {
			$resP = CPrice::GetBasePrice($idi['ID'], false, false);				
	  		array_push($minmax, $resP['PRICE']);
			$rememberID = $resP['PRODUCT_ID'];
			$arDiscounts = CCatalogProduct::GetOptimalPrice($resP['PRODUCT_ID'], 1, $USER->GetUserGroupArray(), 'N', array(), 's1');	
			array_push($discount, $arDiscounts['DISCOUNT_PRICE']);
		}

		CIBlockElement::SetPropertyValues($piResult['ID'], $piResult['IBLOCK_ID'], min($minmax), 'MINIMUM_PRICE');
		CIBlockElement::SetPropertyValues($piResult['ID'], $piResult['IBLOCK_ID'], max($minmax), 'MAXIMUM_PRICE');		
		CIBlockElement::SetPropertyValues($piResult['ID'], $piResult['IBLOCK_ID'], min($discount), 'DISCOUNT_PRICE');
	}
}

AddEventHandler("catalog", "OnDiscountUpdate", "Event_IBlockElementDiscountUpdateOrAdd");
AddEventHandler("catalog", "OnDiscountAdd", "Event_IBlockElementDiscountUpdateOrAdd");
AddEventHandler("catalog", "OnDiscountDelete", "Event_IBlockElementDiscountUpdateOrAdd");
function Event_IBlockElementDiscountUpdateOrAdd($iDiscount, $arFields) {
	if( is_array($arFields['PRODUCT_IDS']) )
	{
		$ibBlock = 4; // 1c_catalog
		$minmax = array();
		foreach ($arFields['PRODUCT_IDS'] as $id) {
			$res = CCatalogSKU::getOffersList( $id, $ibBlock, array(), array(), array() );
			foreach ($res[$id] as $idOffers) {
				$resP = CPrice::GetBasePrice($idOffers['ID'], false, false);				
	  			array_push($minmax, $resP['PRICE']);
			}
			CIBlockElement::SetPropertyValues($id, $ibBlock, round(min($minmax) * $arFields['VALUE'] / 100, 2), 'DISCOUNT_PRICE');
		}
	}
}

AddEventHandler("iblock", "OnAfterIBlockElementAdd", "Event_IBlockElementProductAdd");
function Event_IBlockElementProductAdd(&$arFields) {
	$_SESSION['TEMP_OFFERS_LIST_ID_OPEN'] = false;
	if ( !isset($arFields['CODE']) && $arFields['ID'] > 0 ) {
		if ( !is_array($_SESSION['TEMP_OFFERS_LIST_ID']) ) $_SESSION['TEMP_OFFERS_LIST_ID'] = array();
		else 
		{ 
			array_push($_SESSION['TEMP_OFFERS_LIST_ID'], array( 'IBLOCK_ID'=> $arFields['IBLOCK_ID'], 'ID'=> $arFields['ID']));
			$_SESSION['TEMP_OFFERS_LIST_ID_OPEN'] = true;
		}
	}
}

AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "Event_IBlockElementUpdate");
function Event_IBlockElementUpdate(&$arFields) {
	// Bitrix\Main\Diag\Debug::writeToFile(array('OnAfterIBlockElementUpdate'=>$arFields), "", "/test/logname.log");
	global $USER;
	if ( $arFields['IBLOCK_ID'] == 4)
	{
		$minmax = array();
		$res = CCatalogSKU::getOffersList( $arFields['ID'], $arFields['IBLOCK_ID'], array(), array(), array() );
		$rememberID = -1;
		$discount = array();

		foreach ($res[$arFields['ID']] as $idi) {
			$resP = CPrice::GetBasePrice($idi['ID'], false, false);				
	  		array_push($minmax, $resP['PRICE']);
			$rememberID = $resP['PRODUCT_ID'];
			$arDiscounts = CCatalogProduct::GetOptimalPrice($resP['PRODUCT_ID'], 1, $USER->GetUserGroupArray(), 'N', array(), 's1');
			array_push($discount, $arDiscounts['DISCOUNT_PRICE']); 
		}
		
		CIBlockElement::SetPropertyValues($arFields['ID'], $arFields['IBLOCK_ID'], min($minmax), 'MINIMUM_PRICE');
		CIBlockElement::SetPropertyValues($arFields['ID'], $arFields['IBLOCK_ID'], max($minmax), 'MAXIMUM_PRICE');		
		CIBlockElement::SetPropertyValues($arFields['ID'], $arFields['IBLOCK_ID'], min($discount), 'DISCOUNT_PRICE');
	}
}



AddEventHandler("main", "OnEndBufferContent", "Event_ChangeMyContent");
function Event_ChangeMyContent(&$content)
{
	if(isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/bitrix/') === false && strpos($_SERVER['REQUEST_URI'], 'order/make') === false && $_SERVER['REQUEST_METHOD'] === 'GET')
		if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')) 
			if(file_exists($_SERVER['DOCUMENT_ROOT'].'seoshield-client-f/main.php'))
			{		
			    include_once($_SERVER['DOCUMENT_ROOT'].'seoshield-client-f/main.php');

			    if(function_exists('seo_shield_start_cms'))
			        seo_shield_start_cms();

			    if(function_exists('seo_shield_out_buffer'))
			        $content = seo_shield_out_buffer($content);
			}
}

?>