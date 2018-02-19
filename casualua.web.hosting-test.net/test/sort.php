<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Sort");
?>

<h2>SORT</h2>

<pre>
<?

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

print_r($USER->GetUserGroupArray());
echo "<br><hr>";

//$arIBlockType = CIBlockParameters::GetIBlockTypes(); // список усіх інфоблоків
//arIBlockType = Bitrix\Iblock\TypeTable::getList(array('select' => array('*')))->FetchAll();
//$arIBlockType = Bitrix\Iblock\TypeTable::getList(array('select' => array('*', 'LANG_MESSAGE')))->FetchAll();
//var_dump($arIBlockType);
$ID_BLOCK = '4'; 
$arSelect = Array("ID");
$arFilter = Array("IBLOCK_ID"=>$ID_BLOCK);
$res = CIBlockElement::GetList( Array('ID'), $arFilter, false, Array(), $arSelect);
while($ob = $res->GetNextElement()){
	$arFields = $ob->GetFields();
  	// print_r($arFields);
  	$masMinMax = get_offer_min_max_price($ID_BLOCK, $arFields['ID']);
   	$MIN_PRICE  = min($masMinMax);
   	$MAX_PRICE  = max($masMinMax);
	echo $arFields['ID'].' min= '.$MIN_PRICE.' max='.$MAX_PRICE.' - ';echo '<br>';
    //CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array('MINIMUM_PRICE' => $MIN_PRICE));
    //CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array('MAXIMUM_PRICE' => $MAX_PRICE));
}



function get_offer_min_max_price($IBLOCK_ID, $item_id)
{
	global $USER;
	$minmax = array();
	$res = CCatalogSKU::getOffersList(
	        $item_id,
	        $IBLOCK_ID, 
	        array(),
	        array(),
	        array() 
	    );
	//print_r($res);
	foreach ($res as $key => $value) {
		//echo "$key <<<<<< <br>";
		foreach ($value as $id) {
			print_r($id);
			// $resP = CPrice::GetBasePrice($id['ID'], false, false);
			
			$resP  = CCatalogProduct::GetOptimalPrice($id['ID'], 1, $USER->GetUserGroupArray(), 'N', array(), 's1');
			print_r($resP);
			//echo "<br>";
			//array_push($minmax, $resP['PRICE']);
		}		
	}
	return $minmax;
}

function get_offer_min_price($IBLOCK_ID, $item_id){
    $ret = 0;
    $arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);
    //print_r($arInfo);
    //echo "<hr>";
    if (is_array($arInfo)) {
			    
			$res = CIBlockElement::GetList(array("PRICE"=>"asc"), 
                                       array('IBLOCK_ID'=>$arInfo['IBLOCK_ID'], 'ACTIVE'=>'Y', 'PROPERTY_'.$arInfo['SKU_PROPERTY_ID'] => $item_id), 
                                       false, 
                                       false, 
                                       array('ID', 'NAME'))->GetNext();
        if ($res){
            $ret = GetCatalogProductPrice($res["ID"], 1);
            if ($ret['PRICE']){
                $ret = $ret['PRICE'];
            }
        }
    }
    return $ret;
}
function get_offer_max_price($IBLOCK_ID,$item_id){
    $ret = 0;
    $arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);   
    if (is_array($arInfo)) {
        $res = CIBlockElement::GetList(array("PRICE"=>"desc"), 
                                       array('IBLOCK_ID'=>$arInfo['IBLOCK_ID'], 'ACTIVE'=>'Y', 'PROPERTY_'.$arInfo['SKU_PROPERTY_ID'] => $item_id), 
                                       false, 
                                       false, 
                                       array('ID', 'NAME'))->GetNext();
        if ($res){
            $ret = GetCatalogProductPrice($res["ID"], 1);
            if ($ret['PRICE']){
                $ret = $ret['PRICE'];
            }
        }
    }
    return $ret;
}






?>
</pre>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>