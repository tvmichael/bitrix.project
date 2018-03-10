<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 * @var SaleOrderAjax $component
 */

// update- ********************************************************************************************
Bitrix\Main\Diag\Debug::writeToFile(array('N'=>'1', 'file'=>'result_modifer.php'), "", "/test/logname.log");

$component = $this->__component;
$component::scaleImages($arResult['JS_DATA'], $arParams['SERVICES_IMAGES_SCALING']);