<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

 
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
    'select' => ['ID', 'XML_ID', 'ACTIVE_FROM', 'ACTIVE_TO', 'UNPACK', 'CONDITIONS_LIST', 'ACTIONS_LIST'],
    'filter' => ['ACTIVE' => 'Y'],  
]);

while ($discount = $discountIterator->fetch())
{		
	foreach ($discount['ACTIONS_LIST']['CHILDREN'] as $actions) 
	{	
		// ACTIONS_LIST			
		if ( $actions['CLASS_ID']=='GiftCondGroup' )
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
		// ACTIONS_LIST
		elseif ( $actions['CLASS_ID']=='ActSaleDelivery' )
		{
			// CONDITIONS_LIST		
			if( is_array($discount['CONDITIONS_LIST']['CHILDREN']) )
			{
				foreach ($discount['CONDITIONS_LIST']['CHILDREN'] as $conditions) 
				{
					if ( is_array($conditions['CHILDREN']) )
						foreach ( $conditions['CHILDREN'] as $children)
						{							
							switch ($children['CLASS_ID']) 
							{
						    case 'CondIBElement': // товар
						        foreach ($children['DATA']['value'] as $value) {
									if ($value == $arResult['ID'] && $children['DATA']['logic'] == 'Equal')
										//$arBadge['DELIVERY'] = $value;
						        		array_push($arBadge['DELIVERY'], $value);
								}					
						        break;
						    case 'CondIBIBlock': // інфоблок
						        if ($children['DATA']['value'] == $arResult['IBLOCK_ID'] && $children['DATA']['logic'] == 'Equal')
						        {
						        	//$arBadge['DELIVERY'] = $value;
						        	array_push($arBadge['DELIVERY'], $children['DATA']['value']);
						        }
						        break;
						    case 'CondIBSection': // секція
								if ($children['DATA']['value'] == $arResult['SECTION']['IBLOCK_SECTION_ID'] && $children['DATA']['logic'] == 'Equal')
									//$arBadge['DELIVERY'] = $value;
									array_push($arBadge['DELIVERY'], $children['DATA']['value']);
						    	break;
						    case 'CondIBCode': //символьний код
								if ($children['DATA']['value'] == $arResult['CODE'] && $children['DATA']['logic'] == 'Equal')
									//$arBadge['DELIVERY'] = $value;
									array_push($arBadge['DELIVERY'], $children['DATA']['value']);
						    	break;
						    default:
						    	$property = explode(":", $children['CLASS_ID']);
						    	if( is_array($property) && count($property) == 3 )
						    	{
						    		$db_props = CIBlockElement::GetProperty($property[1], $arResult['ID'], array("sort" => "asc"), Array('ID'=>$property[2]));
									while ($props = $db_props->GetNext())
									{										
										if($props['VALUE'] == $children['DATA']['value'] && $children['DATA']['logic'] == 'Equal')
											//$arBadge['DELIVERY'] = $value;
											array_push($arBadge['DELIVERY'], $children['DATA']['value']);
									}
						    		
						    	}
							}
						}				
					//array_push($arBadge['INFO'], $conditions['CHILDREN']);
				}
			}
		}
		// ACTIONS_LIST
		elseif ( $actions['CLASS_ID']=='ActSaleBsktGrp' )
		{
			//$arBadge['DISCOUNT'] = true;
			//array_push($arBadge['DISCOUNT'], true);


			

		}

	//array_push($arBadge['INFO'], $discount['ID']);
	} // end foreach:



	//$result = array_filter($arResult, create_function($arResult, $discount['UNPACK']) );
	//array_push($arBadge['DISCOUNT'], $result);
}

$arResult['ACTIVE_BADGE'] = $arBadge;