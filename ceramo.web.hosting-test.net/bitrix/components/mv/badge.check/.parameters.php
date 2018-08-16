<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// CModule::IncludeModule("iblock");
// $dbIBlockType = CIBlockType::GetList(
//     array("sort" => "asc"),
//     array("ACTIVE" => "Y")
// );
// while ($arIBlockType = $dbIBlockType->Fetch())
// {
//     if ($arIBlockTypeLang = CIBlockType::GetByIDLang($arIBlockType["ID"], LANGUAGE_ID))
//         $arIblockType[$arIBlockType["ID"]] = "[".$arIBlockType["ID"]."] ".$arIBlockTypeLang["NAME"];
// }

//Bitrix\Main\Diag\Debug::writeToFile(array('R' => $arResult, 'P'=>$arParams ),"","/test.one/log.txt");

$arIblockType = array('catalog.element', 'catalog.section');
//$arIblockArray = array('catalog.element'=>'={$arResult}', 'catalog.section'=>'={$arItem}');

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

        "SHOW_BADGES_DELIVERY" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Доставки",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),
        "SHOW_BADGES_CERTIFICATE" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Сертифікату",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),
        "SHOW_BADGES_STOCK" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Акції",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),
        "SHOW_BADGES_DISCOUNT" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Знижки",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),
        "SHOW_BADGES_GIFT" => array(
            "PARENT" => "SETTINGS",
            "NAME" => "Подарка",
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'Y',
        ),

        "BADGE_ELEMENT" =>array(
            "PARENT"=>"DATA_SOURCE",
            "NAME" => "Базовий елемент",
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "DEFAULT" => "catalog.element",
            "VALUES" => $arIblockType,
            "REFRESH" => "Y",

        ),
        "BADGE_ARRAY" =>array(
            "PARENT"=>"DATA_SOURCE",
            "NAME" => "Масив даних",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "DEFAULT" => '={$arResult}',
            "VALUES"=> '={$arResult}',
        ),
        "CACHE_TIME" => array(),
    ),
);
?>