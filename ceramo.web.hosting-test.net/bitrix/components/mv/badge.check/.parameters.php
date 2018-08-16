<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\IO,
    Bitrix\Main\Application;

$dir = new IO\Directory(Application::getDocumentRoot().$componentPath.'/images/');
$files = $dir->getChildren();
$arFile = [];
foreach ($files as $f) {
    $arFile[$f->getName()] = $f->getName();
}

$arComponentParameters = array(
    "GROUPS" => array(
        "SETTINGS" => array(
            "NAME" => "Перелік пікторграм для показу",
            "SORT" => "200",
        ),
    ),
    "PARAMETERS" => array(
        "SHOW_BADGES" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("MS_SHOW_BADGES"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),        
        "SHOW_BADGES" => array(
            "PARENT" => "BASE",
            "NAME" => "Показувати пікторграми",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),

        // 
        "SHOW_BADGES_DELIVERY" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Доставки",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),
        "SHOW_BADGES_DELIVERY_IMG" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Зображення доставки",
            "TYPE" => "LIST",
            "VALUES" => $arFile,
        ),

        "SHOW_BADGES_CERTIFICATE" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Сертифікату",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),
        "SHOW_BADGES_CERTIFICATE_IMG" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Зображення сертифікату",
            "TYPE" => "LIST",
            "VALUES" => $arFile,
        ),

        "SHOW_BADGES_STOCK" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Акції",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),
        "SHOW_BADGES_STOCK_IMG" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Зображення акції",
            "TYPE" => "LIST",
            "VALUES" => $arFile,
        ),

        "SHOW_BADGES_DISCOUNT" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Знижки",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),
        "SHOW_BADGES_DISCOUNT_IMG" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Зображення знижки",
            "TYPE" => "LIST",
            "VALUES" => $arFile,
        ),

        "SHOW_BADGES_GIFT" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Подарка",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),        
        "SHOW_BADGES_GIFT_IMG" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Зображення подарка",
            "TYPE" => "LIST",
            "VALUES" => $arFile,
        ),

        //
        "BADGE_ARRAY" =>array(
            "PARENT"=>"DATA_SOURCE",
            "NAME" => GetMessage("MS_BADGE_ARRAY"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => '={$arResult}',
            "VALUES"=> '',
        ),
    ),

);
?>