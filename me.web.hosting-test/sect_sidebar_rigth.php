<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/* if ($APPLICATION->GetCurPage(true) != SITE_DIR."index.php"): */?>
<div class="bx-sidebar-block hidden-xs">

    <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "catalog_vertical_mv",
        array(
            "ROOT_MENU_TYPE" => "left",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_TIME" => "36000000",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_THEME" => "black",
            "CACHE_SELECTED_ITEMS" => "N",
            "MENU_CACHE_GET_VARS" => array(
            ),
            "MAX_LEVEL" => "3",
            "CHILD_MENU_TYPE" => "left",
            "USE_EXT" => "Y",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "N",
            "COMPONENT_TEMPLATE" => "catalog_vertical_mv",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO"
        ),
        false
    );?>

</div>
<?/* endif */?>