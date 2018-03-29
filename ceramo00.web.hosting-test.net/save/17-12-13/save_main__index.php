<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Інтернет-магазин \"Ceramo\"");
?><?if (IsModuleInstalled("advertising")):?> <?$APPLICATION->IncludeComponent(
	"bitrix:advertising.banner",
	"bootstrap",
	Array(
		"BS_ARROW_NAV" => "Y",
		"BS_BULLET_NAV" => "Y",
		"BS_CYCLING" => "N",
		"BS_EFFECT" => "fade",
		"BS_HIDE_FOR_PHONES" => "Y",
		"BS_HIDE_FOR_TABLETS" => "N",
		"BS_KEYBOARD" => "Y",
		"BS_PAUSE" => "Y",
		"BS_WRAP" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "bootstrap",
		"NOINDEX" => "Y",
		"QUANTITY" => "3",
		"TYPE" => "MAIN"
	)
);?> <?endif?>
<h2>Найкраща ціна</h2>
 <?if ($_GET["viewList"] == "viewList_list")
{
$PRODUCT_ROW_VARIANTS = "[{'VARIANT':'9','BIG_DATA':false}]";
}
if ($_GET["viewList"] == "viewList_table")
{
$PRODUCT_ROW_VARIANTS = "[{'VARIANT':'2','BIG_DATA':false}]";
}
?> Відображення: <a href="?viewList=viewList_table">Плитка</a> | <a href="?viewList=viewList_list">Список</a>
<?if ($_GET["sort"] == "price asc")
{
$ELEMENT_SORT_FIELD = "catalog_PRICE_1";
$ELEMENT_SORT_ORDER = "asc";
}
 if ($_GET["sort"] == "price")
{
$ELEMENT_SORT_FIELD = "catalog_PRICE_1";
$ELEMENT_SORT_ORDER = "desc";
}
if ($_GET["sort"] == "name")
{
$ELEMENT_SORT_FIELD = "name";
$ELEMENT_SORT_ORDER = "desc";
}

if ($_GET["sort"] == "name asc")
{
$ELEMENT_SORT_FIELD = "name";
$ELEMENT_SORT_ORDER = "asc";
}
?>Сортувати по: <a href="?sort=price asc">ціні (зростання)</a> | <a href="?sort=price">ціні (спадання)</a> | <a href="?sort=name asc">назві (А-Я)</a> | <a href="?sort=name">назві (Я-А)</a>
<?if ($_GET["name"] == "name_3")
{
$PAGE_ELEMENT_COUNT = 3;
}
if ($_GET["name"] == "name_6")
{
$PAGE_ELEMENT_COUNT = 6;
}
if ($_GET["name"] == "name_9")
{
$PAGE_ELEMENT_COUNT = 9;
}
?> Виводити по: <a href="?name=name_3">3</a> | <a href="?name=name_6">6</a> | <a href="?name=name_9">9</a>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"template1",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_PATH" => "",
		"COMPATIBLE_MODE" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:14:1033\",\"DATA\":{\"logic\":\"Equal\",\"value\":8296}}]}",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => $ELEMENT_SORT_FIELD,
		"ELEMENT_SORT_FIELD2" => $ELEMENT_SORT_FIELD,
		"ELEMENT_SORT_ORDER" => $ELEMENT_SORT_ORDER,
		"ELEMENT_SORT_ORDER2" => $ELEMENT_SORT_ORDER,
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "14",
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_TYPE_ID" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(),
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купити",
		"MESS_BTN_COMPARE" => "Порівняння",
		"MESS_BTN_DETAIL" => "Докладніше",
		"MESS_BTN_SUBSCRIBE" => "Підписатися",
		"MESS_NOT_AVAILABLE" => "Немає в наявності",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => array(),
		"OFFERS_FIELD_CODE" => array("",""),
		"OFFERS_LIMIT" => "5",
		"OFFERS_PROPERTY_CODE" => array("","COLOR_REF","SIZES_SHOES","SIZES_CLOTHES",""),
		"OFFERS_SORT_FIELD" => $ELEMENT_SORT_FIELD,
		"OFFERS_SORT_FIELD2" => $ELEMENT_SORT_FIELD,
		"OFFERS_SORT_ORDER" => $ELEMENT_SORT_ORDER,
		"OFFERS_SORT_ORDER2" => $ELEMENT_SORT_ORDER,
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => array(),
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "round",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "12",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array("Підбір по ціні"),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array("MARKY_1"),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_ROW_VARIANTS" => $PRODUCT_ROW_VARIANTS,
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array("",""),
		"PROPERTY_CODE_MOBILE" => array(),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "site",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>