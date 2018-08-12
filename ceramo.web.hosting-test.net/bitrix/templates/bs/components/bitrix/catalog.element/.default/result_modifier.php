<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult['ACTIVE_BADGE'] = [];

$arBadge = array(
	'DELIVERY'=>  false ,
	'CERTIFICATE' => false,
	'GIFT' =>  false,
	'STOCK'=> false,
	'DISCOUNT' => false,
);



$discountIterator = Bitrix\Sale\Internals\DiscountTable::getList ([            
    'select' => ['ID', 'XML_ID', 'ACTIVE_FROM', 'ACTIVE_TO', 'CONDITIONS_LIST', 'ACTIONS_LIST'],
    'filter' => ['ACTIVE' => 'Y'],  
]);
//$arResult['ACTIVE_BADGE'] = $discountIterator->fetch();
while ($discount = $discountIterator->fetch())
{		
	if (isset($discount['ACTIONS_LIST']['CHILDREN']['0']['CLASS_ID']))
		// ACTIONS_LIST
		if($discount['ACTIONS_LIST']['CHILDREN']['0']['CLASS_ID']=='GiftCondGroup' )
		{
			// CONDITIONS_LIST		
			if( is_array($discount['CONDITIONS_LIST']['CHILDREN']) )
			{
				foreach ($discount['CONDITIONS_LIST']['CHILDREN'] as $children) 
				{
					switch ($children['CHILDREN']['0']['CLASS_ID']) 
					{
				    case 'CondIBElement':
				        foreach ($children['CHILDREN']['0']['DATA']['value'] as $value) {
							if ($value == $arResult['ID']) 
								$arBadge['GIFT'] = true;
								//array_push($arBadge['GIFT'], $value);							
						}					
				        break;
				    case 'CondIBIBlock':
				        if ($children['CHILDREN']['0']['DATA']['value'] == $arResult['IBLOCK_ID']) 				        	
				        	$arBadge['GIFT'] = true;			        
				        break;			    
					}
				}			
			}
		}
		// ACTIONS_LIST
		elseif ( $discount['ACTIONS_LIST']['CHILDREN']['0']['CLASS_ID']=='ActSaleDelivery' ) 
		{
		
		}
	
	

}

$arResult['ACTIVE_BADGE'] = $arBadge;