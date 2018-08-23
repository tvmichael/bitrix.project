<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


/* 
$arResult['ACTIVE_BADGE'] = [];

$arBadge = array(
	'DELIVERY'=> [],
	'CERTIFICATE' => [],
	'GIFT' =>  [],
	'STOCK'=> [],
	'DISCOUNT' => [],
	'INFO' => [],
);

// $conditionLogic = array('Equal'=>'=','Not'=>'!','Great'=>'>','Less'=>'<','EqGr'=>'>=','EqLs'=>'<=');

$discountIterator = Bitrix\Sale\Internals\DiscountTable::getList ([            
    'select' => ['ID', 'XML_ID', 'ACTIVE_FROM', 'ACTIVE_TO', 'CONDITIONS_LIST', 'ACTIONS_LIST', 'USE_COUPONS'],
    'filter' => ['ACTIVE' => 'Y'],  
]);

// проходимо всі активні правила
while ($discount = $discountIterator->fetch()) 
{		
	// перебираємо всі дії для поточного правила
	foreach ($discount['ACTIONS_LIST']['CHILDREN'] as $actionsList) 
	{	
		// ACTIONS_LIST  // змінити вартість доставки
		if ( $actionsList['CLASS_ID']=='ActSaleDelivery' ) 
		{
			// CONDITIONS_LIST
			if( is_array($discount['CONDITIONS_LIST']['CHILDREN']) )
			{
				// може бути умова ('або'-'і') виконані всі або лише одна
				$orAnd = 0;
				$orAndCount = 0;
				if ($discount['CONDITIONS_LIST']['DATA']['All'] == 'AND' &&
					$discount['CONDITIONS_LIST']['DATA']['True'] == 'True')
					$orAnd = count($discount['CONDITIONS_LIST']['CHILDREN']);

				// перебираємо масив умов
				foreach ($discount['CONDITIONS_LIST']['CHILDREN'] as $conditions) 
				{
					if ( is_array($conditions['CHILDREN']) )
						foreach ( $conditions['CHILDREN'] as $children)
						{							
							switch ($children['CLASS_ID']) 
							{
						    case 'CondIBElement': // товар
						    	$i = 0;
						        foreach ($children['DATA']['value'] as $value) {
									if ($value == $arResult['ID'] && $children['DATA']['logic'] == 'Equal'){
						        		array_push($arBadge['DELIVERY'], $value);
						        		$i++;
									}		        	
								}
								if ($i > 0 ) $orAndCount ++;
						        break;
						    case 'CondIBIBlock': // інфоблок
						        if ($children['DATA']['value'] == $arResult['IBLOCK_ID'] && $children['DATA']['logic'] == 'Equal') {
						        	array_push($arBadge['DELIVERY'], $children['DATA']['value']);
						        	$orAndCount ++;
						        }
						        break;
						    case 'CondIBSection': // секція
								if ($children['DATA']['value'] == $arResult['SECTION']['IBLOCK_SECTION_ID'] && $children['DATA']['logic'] == 'Equal'){
									array_push($arBadge['DELIVERY'], $children['DATA']['value']);
									$orAndCount ++;
								}
						    	break;
						    case 'CondIBCode': //символьний код
								if ($children['DATA']['value'] == $arResult['CODE'] && $children['DATA']['logic'] == 'Equal') {
									array_push($arBadge['DELIVERY'], $children['DATA']['value']);
									$orAndCount ++;
								}
						    	break;
						    case 'CondBsktFldPrice': // ціна
						    	switch ($children['DATA']['logic'])
						    	{
						    	 	case 'Great':
						    	 		if ( $arResult['MIN_PRICE']['DISCOUNT_VALUE'] > $children['DATA']['value']){
											array_push($arBadge['DELIVERY'], $children['DATA']['value']);
											$orAndCount ++;
						    	 		}
						    	 		break;
						    	 	case 'Equal':
						    	 		if ( $arResult['MIN_PRICE']['DISCOUNT_VALUE'] == $children['DATA']['value']){
											array_push($arBadge['DELIVERY'], $children['DATA']['value']);
											$orAndCount ++;
						    	 		}
						    	 		break;
						    	 	case 'Less':
						    	 		if ( $arResult['MIN_PRICE']['DISCOUNT_VALUE'] < $children['DATA']['value']){
											array_push($arBadge['DELIVERY'], $children['DATA']['value']);
											$orAndCount ++;
						    	 		}
						    	 		break;
						    	 }									
						    	break;
						    default:
						    	$property = explode(":", $children['CLASS_ID']);
						    	if( is_array($property) && count($property) == 3 )
						    	{
						    		$db_props = CIBlockElement::GetProperty($property[1], $arResult['ID'], array("sort" => "asc"), Array('ID'=>$property[2]));
									while ($props = $db_props->GetNext())
									{										
										if($props['VALUE'] == $children['DATA']['value'] && $children['DATA']['logic'] == 'Equal') {
											//$arBadge['DELIVERY'] = $value;
											array_push($arBadge['DELIVERY'], $children['DATA']['value']);
											$orAndCount ++;
										}
									}						    		
						    	}
							}
						}
				}

				if( $orAnd!=0 && $orAnd == $orAndCount)
					array_push($arBadge['DELIVERY'], $orAnd.'-Equal-'.$orAndCount );
				elseif($orAnd!=0) $arBadge['DELIVERY']=[];	


				array_push($arBadge['INFO'], $actionsList['DATA']['Type']);								
			}			
		}
		// ACTIONS_LIST
		elseif ( $actionsList['CLASS_ID']=='ActSaleDelivery' || $actionsList['CLASS_ID']=='GiftCondGroup' )
		{
			// CONDITIONS_LIST		
			if( is_array($discount['CONDITIONS_LIST']['CHILDREN']) )
			{
				foreach ($discount['CONDITIONS_LIST']['CHILDREN'] as $conditions) 
				{
					switch ($conditions['CHILDREN']['0']['CLASS_ID']) 
					{
				    case 'CondIBElement':
				        foreach ($conditions['CHILDREN']['0']['DATA']['value'] as $value) {
							if ($value == $arResult['ID']) 
								//$arBadge['GIFT'] = $value;
								array_push($arBadge['GIFT'], $value);							
						}					
				        break;
				    case 'CondIBIBlock':
				        if ($conditions['CHILDREN']['0']['DATA']['value'] == $arResult['IBLOCK_ID']) 	
				        	//$arBadge['GIFT'] = $value;			        
				        	array_push($arBadge['GIFT'], $value);
				        break;			    
					}
				}			
			}
		}

	//array_push($arBadge['INFO'], $discount['ID']);
	} // end foreach:



	//$result = array_filter($arResult, create_function($arResult, $discount['UNPACK']) );
	//array_push($arBadge['DISCOUNT'], $result);
}

$arResult['ACTIVE_BADGE'] = $arBadge;

*/
