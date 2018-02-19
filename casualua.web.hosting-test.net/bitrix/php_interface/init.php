<?
AddEventHandler("catalog", "OnDiscountAdd", Array("MyClass", "MyMessage"));
class MyClass
{
  function MyMessage($ID){

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
							while ($arProductDiscounts = $dbProductDiscounts->Fetch()) {
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

?>