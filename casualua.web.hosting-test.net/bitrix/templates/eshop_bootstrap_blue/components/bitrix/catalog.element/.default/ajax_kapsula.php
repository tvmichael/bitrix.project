<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if($_REQUEST['action'] == 'KAPSULA2BASKET' && $_REQUEST['sid'] == bitrix_sessid() )
{
	if (CModule::IncludeModule("catalog"))
	{
		$quantity = 1;
		$result = array();
		$goods = $_REQUEST['goods'];	
		
		$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."lang/".LANGUAGE_ID."/template.php", Array(), Array());
			
		if ( is_array($goods) && count($goods) >= 7 )
			foreach ($goods as $key => $value) 
			{
				$productId = intval($value['id']);
				$size = $value['size'];
				
				$result[$key] =	Add2BasketByProductID(
	                $productId,
	                $quantity,
	                array(
	                	array("NAME" => $MESS["TABL_ROZM_Size"], "CODE" =>'size', "VALUE" => $size),
	                )
	            );
			}

		if(count($result) == count($goods))
			$request = array('STATUS' => "OK", 'MESSAGE' => $MESS["CT_BCE_CATALOG_ADD_TO_BASKET_OK"]);
		else
			$request = array('STATUS' => "ERROR", 'MESSAGE' => $MESS["CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR"]);
		
		echo json_encode($request, JSON_UNESCAPED_UNICODE);
	}
}	
else echo json_encode(array('STATUS' => "ERROR", 'MESSAGE' => 'ERROR:KAPSULA-SID'));


?>


	
