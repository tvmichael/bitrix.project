<?
	$minmax = array();
	foreach ($_SESSION['TEMP_OFFERS_LIST_ID'] as $value) {
		$ar_res = CPrice::GetBasePrice($value['ID'], false, false);
		array_push($minmax, $ar_res['PRICE']);
	}
	$PROP['78']['n0']['VALUE'] = min($minmax);
	$PROP['80']['n0']['VALUE'] = max($minmax);
	$PROP['81']['n0']['VALUE'] = min($minmax);
 	$_SESSION['TEMP_OFFERS_LIST_ID'] = array();

?>