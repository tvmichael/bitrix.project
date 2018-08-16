----------------
ACTIONS_LIST 
---------------------------------------------------------
подарок             -   [CLASS_ID] => GiftCondGroup

                            GifterCondIBElement - товар id
                            GifterCondIBSection - розділ id


знижка на доставку  -   [CLASS_ID] => ActSaleDelivery


знижка товару       -   [CLASS_ID] => ActSaleBsktGrp




----------------
CONDITIONS_LIST
---------------------------------------------------------
товари              -   [CLASS_ID] => CondBsktProductGroup 
                        
                            параметри в кошику: 
                                CondBsktFldProduct - товар в кошику id
                                CondBsktFldName - назва товару в кошику
                                BX:CondBsktProp - властивість товару в кошику

                            поля та характеристики товру:
                                CondIBElement - товар id ( слід врахувати, може бути - [value] => Array )
                                CondIBIBlock - інфоблок id
                                CondIBSection - розділ id
                                CondIBCode - символьний код 
                                CondIBXmlID - зовнішній код 







<?
// подарок (товар 96349) - без додаткових умов / не вказано для якого товару, чи розділу
Array
(
    [ID] => 81
    [XML_ID] => TEST
    [LID] => s1
    [NAME] => Тестове правило
    [PRICE_FROM] => 
    [PRICE_TO] => 
    [CURRENCY] => UAH
    [DISCOUNT_VALUE] => 0.00
    [DISCOUNT_TYPE] => P
    [ACTIVE] => Y
    [SORT] => 100
    [ACTIVE_FROM] => Bitrix\Main\Type\DateTime Object
        (
            [value:protected] => DateTime Object
                (
                    [date] => 2018-08-01 15:49:00.000000
                    [timezone_type] => 3
                    [timezone] => Europe/Kiev
                )

        )

    [ACTIVE_TO] => Bitrix\Main\Type\DateTime Object
        (
            [value:protected] => DateTime Object
                (
                    [date] => 2018-08-31 15:49:00.000000
                    [timezone_type] => 3
                    [timezone] => Europe/Kiev
                )

        )

    [TIMESTAMP_X] => Bitrix\Main\Type\DateTime Object
        (
            [value:protected] => DateTime Object
                (
                    [date] => 2018-08-12 15:53:54.000000
                    [timezone_type] => 3
                    [timezone] => Europe/Kiev
                )

        )

    [MODIFIED_BY] => 106
    [DATE_CREATE] => Bitrix\Main\Type\DateTime Object
        (
            [value:protected] => DateTime Object
                (
                    [date] => 2018-08-12 15:50:41.000000
                    [timezone_type] => 3
                    [timezone] => Europe/Kiev
                )

        )

    [CREATED_BY] => 106
    [PRIORITY] => 1
    [LAST_DISCOUNT] => N
    [LAST_LEVEL_DISCOUNT] => N
    [VERSION] => 3
    [CONDITIONS_LIST] => Array
        (
            [CLASS_ID] => CondGroup
            [DATA] => Array
                (
                    [All] => AND
                    [True] => True
                )

            [CHILDREN] => Array
                (
                )

        )

    [UNPACK] => function($arOrder){return ((1 == 1)); };
    [ACTIONS_LIST] => Array
        (
            [CLASS_ID] => CondGroup
            [DATA] => Array
                (
                    [All] => AND
                )

            [CHILDREN] => Array
                (
                    [0] => Array
                        (
                            [CLASS_ID] => GiftCondGroup
                            [DATA] => Array
                                (
                                    [All] => AND
                                )

                            [CHILDREN] => Array
                                (
                                    [0] => Array
                                        (
                                            [CLASS_ID] => GifterCondIBElement
                                            [DATA] => Array
                                                (
                                                    [Type] => one
                                                    [Value] => Array
                                                        (
                                                            [0] => 96349
                                                        )

                                                )

                                        )

                                )

                        )

                )

        )

    [APPLICATION] => function (&$arOrder){\Bitrix\Sale\Discount\Actions::applySimpleGift($arOrder, CCatalogGifterProduct::GenerateApplyCallableFilter('GifterCondIBElement', array(96349), 'one'));};
    [PREDICTION_TEXT] => 
    [PREDICTIONS_APP] => 
    [PREDICTIONS_LIST] => 
    [USE_COUPONS] => N
    [EXECUTE_MODULE] => all
    [EXECUTE_MODE] => 0
    [HAS_INDEX] => N
    [PRESET_ID] => 
    [SHORT_DESCRIPTION_STRUCTURE] => 
)

?>