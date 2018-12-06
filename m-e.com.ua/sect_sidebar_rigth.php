<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/* if ($APPLICATION->GetCurPage(true) != SITE_DIR."index.php"): */?>
<div data-mv="0" class="bx-sidebar-block hidden-xs">
	<!--div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 hidden-xs"-->
		<?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "catalog_vertical",
            array(
                "ROOT_MENU_TYPE" => "left",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "36000000",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_THEME" => "site",
                "CACHE_SELECTED_ITEMS" => "N",
                "MENU_CACHE_GET_VARS" => array(
                ),
                "MAX_LEVEL" => "3",
                "CHILD_MENU_TYPE" => "left",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N",
                "COMPONENT_TEMPLATE" => "catalog_vertical",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO"
            ),
            false
        );?>
	<!--/div-->
</div>
<?/* endif */?>