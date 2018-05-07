<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

Bitrix\Main\Diag\Debug::writeToFile(array('post'=>$_POST), "save", "/test/logname.log");
Bitrix\Main\Diag\Debug::writeToFile(array('files'=>$_FILES), "save", "/test/logname.log");
Bitrix\Main\Diag\Debug::writeToFile(array('prop'=>$PROP), "save", "/test/logname.log");

$PROP['78']['n0']['VALUE'] = 777;
$PROP['80']['n0']['VALUE'] = 888;
$PROP['81']['n0']['VALUE'] = 999;
?>
