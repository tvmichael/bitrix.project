<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новинки");
?>

<!-- FILTER -->
<?
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/filter.css");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/filter.js');
?>
<div class="col-md-12 cs-filter-main-container">
	<?
	// SESSION
	if(!isset($_SESSION['BX_FILTER_DATA'])){
		$_SESSION['BX_FILTER_DATA'] = array();
		$_SESSION['BX_FILTER_DATA']['PRICE_SORT'] = 'LTH';
		$_SESSION['BX_FILTER_DATA']['LTH'] = GetMessage('SF_PRICE_SORT_LTH');
		$_SESSION['BX_FILTER_DATA']['HTL'] = GetMessage('SF_PRICE_SORT_HTL');
		$_SESSION['BX_FILTER_DATA']['SIZE_SORT'] = 'ALL';
		$_SESSION['BX_FILTER_DATA']['LANG'] = LANGUAGE_ID;
	}
	if($_SESSION['BX_FILTER_DATA']['LANG'] != LANGUAGE_ID){		
		$_SESSION['BX_FILTER_DATA']['LTH'] = GetMessage('SF_PRICE_SORT_LTH');
		$_SESSION['BX_FILTER_DATA']['HTL'] = GetMessage('SF_PRICE_SORT_HTL');
		$_SESSION['BX_FILTER_DATA']['LANG'] = LANGUAGE_ID;
	}

	// PRICE
	if ( isset($_REQUEST['PRICE_SORT']) && in_array($_REQUEST['PRICE_SORT'],  array('LTH', 'HTL')) ) 
	{
		$sortPriceMetod = $_REQUEST['PRICE_SORT'];
		$_SESSION['BX_FILTER_DATA']['PRICE_SORT'] = $sortPriceMetod;
	}
	elseif(isset($_SESSION['BX_FILTER_DATA'])) $sortPriceMetod = $_SESSION['BX_FILTER_DATA']['PRICE_SORT'];
		else $sortPriceMetod = 'LTH';

	switch ($sortPriceMetod) 
	{
		case "HTL":
			$elementSortField ='PROPERTY_MAXIMUM_PRICE'; 
			$elementSortOrder = 'desc';
		break;
		case "LTH": 
			$elementSortField ='PROPERTY_DISCOUNT_PRICE'; 
			$elementSortOrder = 'asc';
		break;
	}

	// SIZE
	$sortSizeArray = array();
	$sortSizeArray[] = 'ALL';
	$property_enums = CIBlockPropertyEnum::GetList(Array("property_sort"=>"DESC"), Array("IBLOCK_ID"=>5, "CODE"=>"size"));
	while($enum_fields = $property_enums->GetNext())
		$sortSizeArray[] = $enum_fields["VALUE"];

	if (isset($_REQUEST['SIZE_SORT']) && in_array($_REQUEST['SIZE_SORT'],  $sortSizeArray) ) 
	{
		$sortSizeMetod = $_REQUEST['SIZE_SORT'];
		$_SESSION['BX_FILTER_DATA']['SIZE_SORT'] = $sortSizeMetod;
	}
	elseif(isset($_SESSION['BX_FILTER_DATA'])) $sortSizeMetod = $_SESSION['BX_FILTER_DATA']['SIZE_SORT'];
		else $sortSizeMetod = 'ALL';

	if ($sortSizeMetod == 'ALL') $arrFilter['OFFERS'] = Array();		
	else $arrFilter['OFFERS'] = Array("PROPERTY_size_VALUE"=>$sortSizeMetod);
	
	// JS
	$jsDataFilter = array();
	$jsDataFilter['SIZE_SORT'] = $sortSizeMetod;
	$jsDataFilter['PRICE_SORT'] = $sortPriceMetod;


	if ( $USER->IsAdmin() && $USER->GetID() == 6 ) { 
	//echo '<div class="col-md-12"><pre>'; 
	//print_r(SITE_TEMPLATE_PATH."/css/filter.css");
	//print_r($_SESSION['BX_FILTER_DATA']);
	//print_r($_REQUEST);
	//print_r($sortSizeMetod);
	//print_r($sortSizeArray);
	//echo '</pre></div>'; 
	};

	?>
	<div class="col-xs-4 col-sm-6 text-right">
		<div class="cs-filter-block">
			<div class="cs-filter-block-title"><? echo GetMessage('SF_SIZE_TITLE');?></div>

			<div class="cs-filter-block-sort" onclick="mSimpleFilterN.popup(this, 'size')">
				<div class="cs-filter-block-select">
					<div><?echo $sortSizeMetod == 'ALL'? GetMessage('SF_SIZE_SORT_ALL') : $sortSizeMetod;?></div>
					<img src="<?echo SITE_TEMPLATE_PATH;?>/images/up-down-16-v.png">
				</div>
				
				<div data-role="dropdownContent" style="display: none;">				
					<?
					foreach ($sortSizeArray as $value) 
					{
						if ($value == 'ALL')
						{
							?>
							<div data-request="SIZE_SORT" data-sort="ALL"><?echo GetMessage('SF_SIZE_SORT_ALL');?></div>
							<?
						}
						else 
						{
							?>
							<div data-request="SIZE_SORT" data-sort="<?echo $value;?>"><?echo $value;?></div> 	
					  		<?
						}					
					}
					?>
				</div>

			</div>	
		</div>
	</div>
	<div class="col-xs-8 col-sm-6 text-left">		
		<div class="cs-filter-block">
			<div class="cs-filter-block-title"><?echo GetMessage('SF_PRICE_TITLE');?></div>

			<div class="cs-filter-block-sort" onclick="mSimpleFilterN.popup(this, 'price')">
				<div class="cs-filter-block-select">
					<div><?echo $_SESSION['BX_FILTER_DATA'][$sortPriceMetod];?></div>
					<img src="<?echo SITE_TEMPLATE_PATH;?>/images/up-down-16-v.png">
				</div>
				<div data-role="dropdownContent" style="display: none;">
					<div data-request="PRICE_SORT" data-sort="LTH"><?echo GetMessage('SF_PRICE_SORT_LTH');?></div>
					<div data-request="PRICE_SORT" data-sort="HTL"><?echo GetMessage('SF_PRICE_SORT_HTL');?></div>
				</div>

			</div>	
		</div>
	</div>
</div>

<script type="text/javascript">
	var mSimpleFilterN = new JSmSimpleFilterSelectDropDownItem(<?=CUtil::PhpToJSObject($jsDataFilter);?>);
</script>
<!-- FILTER END -->


<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	".default", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "pictures",
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
		"CACHE_TIME" => "3600000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "UAH",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:4:76\",\"DATA\":{\"logic\":\"Equal\",\"value\":30}}]}",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => $elementSortField,
		"ELEMENT_SORT_FIELD2" => $elementSortField,
		"ELEMENT_SORT_ORDER" => $elementSortOrder,
		"ELEMENT_SORT_ORDER2" => $elementSortOrder,
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => 'arrFilter',
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_TYPE_ID" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(
		),
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В кошик",
		"MESS_BTN_BUY" => "Купити",
		"MESS_BTN_DETAIL" => "Докладніше",
		"MESS_BTN_LAZY_LOAD" => "Завантажити ще",
		"MESS_BTN_SUBSCRIBE" => "Підписатися",
		"MESS_NOT_AVAILABLE" => "Немає в наявності",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => array(
			0 => "size",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		"OFFERS_PROPERTY_CODE" => array(
			0 => "size",
			1 => "COLOR_REF",
			2 => "SIZES_SHOES",
			3 => "SIZES_CLOTHES",
			4 => "",
		),
		"OFFERS_SORT_FIELD" => $elementSortField,
		"OFFERS_SORT_FIELD2" => $elementSortField,
		"OFFERS_SORT_ORDER" => $elementSortOrder,
		"OFFERS_SORT_ORDER2" => $elementSortOrder,
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => array(
			0 => "size",
		),
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "arhicode",
		"PAGER_TITLE" => "Товари",
		"PAGE_ELEMENT_COUNT" => "6",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "sku,props,price,quantityLimit,quantity,buttons,compare",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "NEWPRODUCT",
			2 => "",
		),
		"PROPERTY_CODE_MOBILE" => array(
		),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SEF_RULE" => "#SECTION_CODE_PATH#",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "2000",
		"SLIDER_PROGRESS" => "Y",
		"TEMPLATE_THEME" => "site",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>