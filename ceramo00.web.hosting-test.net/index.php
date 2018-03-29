<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Інтернет-магазин \"Ceramo\"");
?>

<?if (IsModuleInstalled("advertising")):?> <?$APPLICATION->IncludeComponent(
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

<? // --- БЛОК СОРУВАННЯ - Початок--- ?>
<div class="col-xs-12">
	<?
	// --------------------------------------------------------------
	// сортування за зростанням-спаданням ціни і за алфавітом
	//
		$arSortFields = array(
						//"SHOWS" => array(
						//"ORDER"=> "DESC",
						//"CODE" => "SHOWS",
						//"NAME" => GetMessage("CATALOG_SORT_FIELD_SHOWS")
						//),
			"NAME_ARC" => array( // параметр в url
				"ORDER"=> "ASC", //в возрастающем порядке
				"CODE" => "NAME", // Код поля для сортировки
				"NAME" => GetMessage("CATALOG_SORT_FIELD_NAME_ASC") // имя для вывода в публичной части, редактировать в (/lang/ru/section.php)
			),
			"NAME_DESC" => array( // параметр в url
				"ORDER"=> "DESC", //в возрастающем порядке
				"CODE" => "NAME", // Код поля для сортировки
				"NAME" => GetMessage("CATALOG_SORT_FIELD_NAME_DESC") // имя для вывода в публичной части, редактировать в (/lang/ru/section.php)
			),
			"PRICE_ASC"=> array(
				"ORDER"=> "ASC",
				"CODE" => "PROPERTY_MINIMUM_PRICE",  // изменен для сортировки по ТП
				"NAME" => GetMessage("CATALOG_SORT_FIELD_PRICE_ASC")
			),
			"PRICE_DESC" => array(
				"ORDER"=> "DESC",
				"CODE" => "PROPERTY_MAXIMUM_PRICE", // изменен для сортировки по ТП
				"NAME" => GetMessage("CATALOG_SORT_FIELD_PRICE_DESC")
			)
		);
		$rsMinPriceProperty = CIBlock::GetProperties($arParams["IBLOCK_ID"], Array(), Array("CODE" => "MINIMUM_PRICE"));
		if($rsMinPriceProperty->SelectedRowsCount() == 0)
		{
			$arSortFields["PRICE_ASC"] = array(
				"ORDER"=> "ASC",
				"CODE" => "catalog_PRICE_1",
				"NAME" => GetMessage("CATALOG_SORT_FIELD_PRICE_ASC")
			);
			$arSortFields["PRICE_DESC"] = array(
				"ORDER"=> "DESC",
				"CODE" => "catalog_PRICE_1",
				"NAME" => GetMessage("CATALOG_SORT_FIELD_PRICE_DESC")
			);
		}		
		if(!empty($_REQUEST["SORT_FIELD"]) && !empty($arSortFields[$_REQUEST["SORT_FIELD"]]))
		{
			setcookie("CATALOG_SORT_FIELD", $_REQUEST["SORT_FIELD"], time() + 60 * 60 * 24 * 30 * 12 * 2, "/");
			$ELEMENT_SORT_FIELD =  $arSortFields[$_REQUEST["SORT_FIELD"]]["CODE"];
			$ELEMENT_SORT_ORDER = $arSortFields[$_REQUEST["SORT_FIELD"]]["ORDER"];
			$arSortFields[$_REQUEST["SORT_FIELD"]]["SELECTED"] = "Y";

		}
		elseif(!empty($_COOKIE["CATALOG_SORT_FIELD"]) && !empty($arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]))
		{ // COOKIE
			$ELEMENT_SORT_FIELD = $arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["CODE"];
			$ELEMENT_SORT_ORDER = $arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["ORDER"];
			$arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["SELECTED"] = "Y";
		}
		else {
			//$ELEMENT_SORT_FIELD = $arSortFields["PRICE_ASC"]]["CODE"];
			//$ELEMENT_SORT_ORDER = $arSortFields["PRICE_ASC"]]["ORDER"];
			//$arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["SELECTED"] = "Y";
		}
	?>

	<?
	// --------------------------------------------------------------
	// кількість елементів що виводиться на сторніці
	// 
		$arSortProductNumber = array(
			"20" => array("NAME" => "twenty"), 
			"50" => array("NAME" => "fifty"), 
			"75" => array("NAME" => "seventy_five"),
			"100" => array("NAME" => "hundred")
		);
		if(!empty($_REQUEST["SORT_TO"]) && $arSortProductNumber[$_REQUEST["SORT_TO"]])
		{
			setcookie("CATALOG_SORT_TO", $_REQUEST["SORT_TO"], time() + 60 * 60 * 24 * 30 * 12 * 2, "/");
			$arSortProductNumber[$_REQUEST["SORT_TO"]]["SELECTED"] = "Y";
			$PAGE_ELEMENT_COUNT = $_REQUEST["SORT_TO"];
		}
		elseif (!empty($_COOKIE["CATALOG_SORT_TO"]) && $arSortProductNumber[$_COOKIE["CATALOG_SORT_TO"]])
		{
			$arSortProductNumber[$_COOKIE["CATALOG_SORT_TO"]]["SELECTED"] = "Y";
			$PAGE_ELEMENT_COUNT = $_COOKIE["CATALOG_SORT_TO"];
		}
		else
		{
			$PAGE_ELEMENT_COUNT = 20;
		}
	?>

	<?
	// --------------------------------------------------------------
	// Відобоаження елементів каталогу у вигляді -  блоків або списку
	//
		$arTemplates = array(
			"SQUARES" => array(
				"CLASS" => "squares"
			),
			"LINE" => array(
				"CLASS" => "line"
			)	
		);		
		if(!empty($_REQUEST["VIEW"]) && $arTemplates[$_REQUEST["VIEW"]]){
			setcookie("CATALOG_VIEW", $_REQUEST["VIEW"], time() + 60 * 60 * 24 * 30 * 12 * 2);
			$arTemplates[$_REQUEST["VIEW"]]["SELECTED"] = "Y";
			$arParams["CATALOG_TEMPLATE"] = $_REQUEST["VIEW"];

			if($arParams["CATALOG_TEMPLATE"] == "LINE")
			{
				$PRODUCT_ROW_VARIANTS = "[{'VARIANT':'9','BIG_DATA':false}]";
				$arParams["CATALOG_TEMPLATE"] = $arParams['LIST_PRODUCT_ROW_VARIANTS'];
			}
			else
			{
				$PRODUCT_ROW_VARIANTS = "[{'VARIANT':'2','BIG_DATA':false}]";
				$arParams["CATALOG_TEMPLATE"] = $arParams['LIST_PRODUCT_ROW_VARIANTS'];
			}
		}
		elseif (!empty($_COOKIE["CATALOG_VIEW"]) && $arTemplates[$_COOKIE["CATALOG_VIEW"]])
		{
			$arTemplates[$_COOKIE["CATALOG_VIEW"]]["SELECTED"] = "Y";
			$arParams["CATALOG_TEMPLATE"] = $_COOKIE["CATALOG_VIEW"];

			if($arParams["CATALOG_TEMPLATE"] == "LINE"){
				$PRODUCT_ROW_VARIANTS = "[{'VARIANT':'9','BIG_DATA':false}]";
				$arParams["CATALOG_TEMPLATE"] = $arParams['LIST_PRODUCT_ROW_VARIANTS'];
			}
			else
			{
				$PRODUCT_ROW_VARIANTS = "[{'VARIANT':'2','BIG_DATA':false}]";
				$arParams["CATALOG_TEMPLATE"] = $arParams['LIST_PRODUCT_ROW_VARIANTS'];
			}
		}
		else
		{
			$arTemplates[key($arTemplates)]["SELECTED"] = "Y";
			$arParams["CATALOG_TEMPLATE"] = $arTemplates[key($arTemplates)];
			if($arParams["CATALOG_TEMPLATE"] == "LINE")
			{
				$PRODUCT_ROW_VARIANTS = "[{'VARIANT':'9','BIG_DATA':false}]";
			}
			else
			{
				$PRODUCT_ROW_VARIANTS = "[{'VARIANT':'2','BIG_DATA':false}]";				
			}
		}
	?>

	<div id="catalogLine">

		<?if(!empty($arTemplates)):?>
			<div class="column">
				<div class="label">
					<?=GetMessage("CATALOG_VIEW_LABEL");?>
				</div>
				<div class="viewList">
					<?foreach ($arTemplates as $arTemplatesCode => $arNextTemplate):?>
						<div class="element">
							<?php echo "<!--"; print_r($arTemplatesCode);  echo " -->";?>
							<a<?if($arNextTemplate["SELECTED"] != "Y"):?> href="<?=$APPLICATION->GetCurPageParam("VIEW=".$arTemplatesCode, array("VIEW"));?>"<?endif;?> class="<?=$arNextTemplate["CLASS"]?><?if($arNextTemplate["SELECTED"] == "Y"):?> selected<?endif;?>">								
							</a>

						</div>
					<?endforeach;?>
				</div>
			</div>
		<?endif;?>

		<div class="column_one">
		<?if(!empty($arSortFields)):?>
			<div class="column">
				<div class="label">
					<?=GetMessage("CATALOG_SORT_LABEL");?>
				</div>
				<div class="sortFields" id="selectSortParams">
					<div class="dropdown">
					<button class="btn sv-view-n dropdown-toggle" type="button" data-toggle="dropdown">
								<?=GetMessage("CATALOG_SORT_LABEL"); echo ' '.$arSortFields[$_REQUEST["SORT_FIELD"]]["NAME"];?>
							<span class="caret"></span></button>
					<ul class="dropdown-menu">
	
						<?foreach ($arSortFields as $arSortFieldCode => $arSortField):?>
						<li class="element">
							<a<?if($arSortField["SELECTED"] != "Y"):?> href="<?=$APPLICATION->GetCurPageParam("SORT_FIELD=".$arSortFieldCode, array("SORT_FIELD"));?>"<?endif;?> class="<?if($arSortField["SELECTED"] == "Y"):?>selected<?endif;?>"><?=$arSortField["NAME"]?></a>
						</li>
						<?endforeach;?>
					</ul>
					</div>
				</div>
			</div>
		<?endif;?>

		<?if(!empty($arSortProductNumber)):?>
			<div class="column">
				<div class="label">
					<?=GetMessage("CATALOG_SORT_TO_LABEL");?>
				</div>
				<div class="countElements" id="selectCountElements">

					<div class="dropdown">
						<button class="btn sv-view-n dropdown-toggle" type="button" data-toggle="dropdown">
							<?=GetMessage("CATALOG_SORT_TO_LABEL"); echo ' '.$_REQUEST["SORT_TO"];?>
						<span class="caret"></span></button>
						<ul class="dropdown-menu">

							<?foreach ($arSortProductNumber as $arSortNumberElementId => $arSortNumberElement):?>
							<li class="element">
								<a<?if($arSortNumberElement["SELECTED"] != "Y"):?> href="<?=$APPLICATION->GetCurPageParam("SORT_TO=".$arSortNumberElementId, array("SORT_TO"));?>"<?endif;?> class="<?=$arSortNumberElement["NAME"]?><?if($arSortNumberElement["SELECTED"] == "Y"):?>selected<?endif;?>"><?=$arSortNumberElementId?></a>
							</li>
							<?endforeach;?>
						</ul>
					</div>

				</div>
			</div>
		<?endif;?>
	</div>

</div>
<? // --- БЛОК СОРУВАННЯ - Кінець --- ?>


<? // if($USER->IsAdmin()) { echo '<pre>'; print_r($ELEMENT_SORT_FIELD); print_r($ELEMENT_SORT_ORDER);print_r($PAGE_ELEMENT_COUNT); echo '</pre>'; };  ?>


<?
$APPLICATION->IncludeComponent(
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
		"PAGE_ELEMENT_COUNT" => $PAGE_ELEMENT_COUNT,
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
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>