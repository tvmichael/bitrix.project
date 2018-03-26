<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogProductsViewedComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

	if(LANGUAGE_ID === 'ru'){
		if (strpos($arResult['ITEM']['DETAIL_PAGE_URL'], "/ua/") !== false)
			$arResult['ITEM']['DETAIL_PAGE_URL']=str_replace("/ua/", "/ru/", $arResult['ITEM']['DETAIL_PAGE_URL']);
		
	}elseif(LANGUAGE_ID === 'en'){
		if (strpos($arResult['ITEM']['DETAIL_PAGE_URL'], "/ua/") !== false)
			$arResult['ITEM']['DETAIL_PAGE_URL']=str_replace("/ua/", "/en/", $arResult['ITEM']['DETAIL_PAGE_URL']);
		
	}

$this->setFrameMode(true);

$this->addExternalCss('/bitrix/templates/eshop_bootstrap_blue/components/bitrix/catalog.product.subscribe/subscribe_discount/style.css');

if (isset($arResult['ITEM']))
{

	$item = $arResult['ITEM'];
	$areaId = $arResult['AREA_ID'];
	$itemIds = array(
		'ID' => $areaId,
		'PICT' => $areaId.'_pict',
		'SECOND_PICT' => $areaId.'_secondpict',
		'PICT_SLIDER' => $areaId.'_pict_slider',
		'STICKER_ID' => $areaId.'_sticker',
		'SECOND_STICKER_ID' => $areaId.'_secondsticker',
		'PRODUCT_BLOCKS_ID' => $areaId.'_product_block_id', 		// update- 
		'PRODUCT_BLOCKS_BTN_ID' => $areaId.'_product_block_btn_id', // 
		'QUANTITY' => $areaId.'_quantity',
		'QUANTITY_DOWN' => $areaId.'_quant_down',
		'QUANTITY_UP' => $areaId.'_quant_up',
		'QUANTITY_MEASURE' => $areaId.'_quant_measure',
		'QUANTITY_LIMIT' => $areaId.'_quant_limit',
		'BUY_LINK' => $areaId.'_buy_link',
		'BUY_MODAL' => $areaId.'_buy_modal',
		'LINK_DISCOUNT' => $areaId.'_link_discount',
		'BASKET_ACTIONS' => $areaId.'_basket_actions',
		'NOT_AVAILABLE_MESS' => $areaId.'_not_avail',
		'SUBSCRIBE_LINK' => $areaId.'_subscribe',
		'COMPARE_LINK' => $areaId.'_compare_link',
		'PRICE' => $areaId.'_price',
		'PRICE_OLD' => $areaId.'_price_old',
		'PRICE_TOTAL' => $areaId.'_price_total',
		'DSC_PERC' => $areaId.'_dsc_perc',
		'SECOND_DSC_PERC' => $areaId.'_second_dsc_perc',
		'PROP_DIV' => $areaId.'_sku_tree',
		'PROP' => $areaId.'_prop_',
		'DISPLAY_PROP_DIV' => $areaId.'_sku_prop',
		'BASKET_PROP_DIV' => $areaId.'_basket_prop',
	);
	$obName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $areaId);
	$isBig = isset($arResult['BIG']) && $arResult['BIG'] === 'Y';
$myName = 'name_'.LANGUAGE_ID;
//if($USER->IsAdmin()) {echo '<pre>'; print_r($item['PROPERTIES'][$myName]['VALUE']); echo '</pre>';}
//if($USER->IsAdmin()) {echo '<pre>'; print_r($item['PROPERTIES']['$myName']['VALUE']); echo '</pre>';}
	$productTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $item['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $item['PROPERTIES'][$myName]['VALUE'];

	$imgTitle = isset($item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
		? $item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
		: $item['NAME'];

	$skuProps = array();

	$haveOffers = !empty($item['OFFERS']);
	if ($haveOffers)
	{
		$actualItem = isset($item['OFFERS'][$item['OFFERS_SELECTED']])
			? $item['OFFERS'][$item['OFFERS_SELECTED']]
			: reset($item['OFFERS']);
	}
	else
	{
		$actualItem = $item;
	}

	if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers)
	{
		$price = $item['ITEM_START_PRICE'];
		$minOffer = $item['OFFERS'][$item['ITEM_START_PRICE_SELECTED']];
		$measureRatio = $minOffer['ITEM_MEASURE_RATIOS'][$minOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
		$morePhoto = $item['MORE_PHOTO'];
	}
	else
	{
		$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
		$measureRatio = $price['MIN_QUANTITY'];
		$morePhoto = $actualItem['MORE_PHOTO'];
	}

	$showSlider = is_array($morePhoto) && count($morePhoto) > 1;
	$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($item['CATALOG_SUBSCRIBE'] === 'Y' || $haveOffers);

	$discountPositionClass = isset($arResult['BIG_DISCOUNT_PERCENT']) && $arResult['BIG_DISCOUNT_PERCENT'] === 'Y'
		? 'product-item-label-big'
		: 'product-item-label-small';
	$discountPositionClass .= $arParams['DISCOUNT_POSITION_CLASS'];

	$labelPositionClass = isset($arResult['BIG_LABEL']) && $arResult['BIG_LABEL'] === 'Y'
		? 'product-item-label-big'
		: 'product-item-label-small';
	$labelPositionClass .= $arParams['LABEL_POSITION_CLASS'];

	$buttonSizeClass = isset($arResult['BIG_BUTTONS']) && $arResult['BIG_BUTTONS'] === 'Y' ? 'btn-md' : 'btn-sm';

	// update- 
	$recommendedList = array();
	$recommendedId = $arResult['ITEM']['PROPERTIES']['RECOMMEND']['VALUE'];	
	foreach ($recommendedId as $i => $id) {
		$arFilter = Array("IBLOCK_ID"=>$arResult['ITEM']['IBLOCK_ID'], "ID"=>$id);
		$resId = CIBlockElement::GetList(array(), $arFilter, false, Array(), array());		
		while($ob = $resId->GetNextElement())
		{		
			$arFields = $ob->GetFields();

				if(LANGUAGE_ID === 'ru'){
					if (strpos($arFields['DETAIL_PAGE_URL'], "/ua/") !== false)
						$arFields['DETAIL_PAGE_URL']=str_replace("/ua/", "/ru/", $arFields['DETAIL_PAGE_URL']);
			
				}elseif(LANGUAGE_ID === 'en'){
					if (strpos($arFields['DETAIL_PAGE_URL'], "/ua/") !== false)
						$arFields['DETAIL_PAGE_URL']=str_replace("/ua/", "/en/", $arFields['DETAIL_PAGE_URL']);
				}

			$recommendedList[$i] = array(
		 		'ID' => $arFields['ID'],
		 		'NAME' => $arFields['NAME'],			 		
		 		'DETAIL_PAGE_URL' => $arFields['DETAIL_PAGE_URL'],
		 		'PREVIEW_PICTURE' => CFile::GetPath($arFields["PREVIEW_PICTURE"]),
		 		'DETAIL_PICTURE' => CFile::GetPath($arFields["DETAIL_PICTURE"]),
		 		'PRICE' => null
		 	);		 	
		}
		$res = CCatalogSKU::getOffersList( $id, $arResult['ITEM']['IBLOCK_ID'], array(), array(), array() );
		$offersId = reset($res[$id]);
		$arPrice = CCatalogProduct::GetOptimalPrice($offersId['ID'], 1, $USER->GetUserGroupArray(), 'N');
		$recommendedList[$i]['PRICE']  = array(
			'PRODUCT_ID' => $offersId['ID'],
			'PRICE' => $arPrice['RESULT_PRICE']['BASE_PRICE'],
			'CURRENCY' => $arPrice['RESULT_PRICE']['CURRENCY'],
			'DISCOUNT_PRICE' => $arPrice['RESULT_PRICE']['DISCOUNT_PRICE']
		);
	};

	$messageInfoText = array(
		'0' => GetMessage("CT_BCE_CATALOG_ADD_TO_BASKET_OK_AGREEMENT"),
		'1' => array(),
		'2' => array(
			'0' => GetMessage("CT_BCE_CATALOG_ADD_TO_BASKET_OK_AGREEMENT_5_PERSENT"),
			'1' => GetMessage("CT_BCE_CATALOG_ADD_TO_BASKET_OK_5_PERSENT"),		
		),
		'3' => array(
			'0' => GetMessage("CT_BCE_CATALOG_ADD_TO_BASKET_OK_AGREEMENT_7_PERSENT"),
			'1' => GetMessage("CT_BCE_CATALOG_ADD_TO_BASKET_OK_7_PERSENT"),		
		),
		'4' => array(
			'0' => GetMessage("CT_BCE_CATALOG_ADD_TO_BASKET_OK_AGREEMENT_10_PERSENT"),
			'1' => GetMessage("CT_BCE_CATALOG_ADD_TO_BASKET_OK_10_PERSENT"),		
		),
		'5' => array(
			'0' => GetMessage("CT_BCE_CATALOG_ADD_TO_BASKET_OK_AGREEMENT_15_PERSENT"),
			'1' => GetMessage("CT_BCE_CATALOG_ADD_TO_BASKET_OK_15_PERSENT"),		
		)
	);

	/* RESIZE IMAGE */
	$arFileTmp = CFile::ResizeImageGet(
    	$item['PREVIEW_PICTURE']['ID'],
    	array("width" => 370, "height" => 500),
    	BX_RESIZE_IMAGE_EXACT,
    	true
    );
    if ( isset($arFileTmp['src']) ){
		$item['PREVIEW_PICTURE']['SRC'] = $arFileTmp['src'];
		$item['PREVIEW_PICTURE']['WIDTH'] = $arFileTmp['width'];
		$item['PREVIEW_PICTURE']['HEIGHT'] = $arFileTmp['height'];

		$item['PRODUCT_PREVIEW']['SRC'] = $arFileTmp['src'];
		$item['PRODUCT_PREVIEW']['WIDTH'] = $arFileTmp['width'];
		$item['PRODUCT_PREVIEW']['HEIGHT'] = $arFileTmp['height'];
	}
	if ($item['SECOND_PICT'] && !empty($item['PREVIEW_PICTURE_SECOND']) )
	{
		$arFileTmp = CFile::ResizeImageGet(
    		$item['PREVIEW_PICTURE_SECOND']['ID'],
    		array("width" => 370, "height" => 500),
    		BX_RESIZE_IMAGE_EXACT,
    		true
    	);
    	$item['PREVIEW_PICTURE_SECOND']['SRC'] = $arFileTmp['src'];
		$item['PREVIEW_PICTURE_SECOND']['WIDTH'] = $arFileTmp['width'];
		$item['PREVIEW_PICTURE_SECOND']['HEIGHT'] = $arFileTmp['height'];
	}

	?>

	<!-- update- 18-02-01 catalog.item\default_arhicode\template -->
	<div class="product-item-container<?=(isset($arResult['SCALABLE']) && $arResult['SCALABLE'] === 'Y' ? ' product-item-scalable-card' : '')?>"
		id="<?=$areaId?>" data-entity="item">
		<?
		$documentRoot = Main\Application::getDocumentRoot();
		$templatePath = strtolower($arResult['TYPE']).'/template.php';
		$file = new Main\IO\File($documentRoot.$templateFolder.'/'.$templatePath);
		if ($file->isExists())
		{
			include($file->getPath());
		}

		if (!$haveOffers)
		{
			$jsParams = array(
				'PRODUCT_TYPE' => $item['CATALOG_TYPE'],
				'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
				'SHOW_ADD_BASKET_BTN' => false,
				'SHOW_BUY_BTN' => true,
				'SHOW_ABSENT' => true,
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
				'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
				'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
				'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
				'BIG_DATA' => $item['BIG_DATA'],
				'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
				'VIEW_MODE' => $arResult['TYPE'],
				'USE_SUBSCRIBE' => $showSubscribe,
				'PRODUCT' => array(
					'ID' => $item['ID'],
					'NAME' => $productTitle,
					'DETAIL_PAGE_URL' => $item['DETAIL_PAGE_URL'],
					'PICT' => $item['SECOND_PICT'] ? $item['PREVIEW_PICTURE_SECOND'] : $item['PREVIEW_PICTURE'],
					'CAN_BUY' => $item['CAN_BUY'],
					'CHECK_QUANTITY' => $item['CHECK_QUANTITY'],
					'MAX_QUANTITY' => $item['CATALOG_QUANTITY'],
					'STEP_QUANTITY' => $item['ITEM_MEASURE_RATIOS'][$item['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
					'QUANTITY_FLOAT' => is_float($item['ITEM_MEASURE_RATIOS'][$item['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
					'ITEM_PRICE_MODE' => $item['ITEM_PRICE_MODE'],
					'ITEM_PRICES' => $item['ITEM_PRICES'],
					'ITEM_PRICE_SELECTED' => $item['ITEM_PRICE_SELECTED'],
					'ITEM_QUANTITY_RANGES' => $item['ITEM_QUANTITY_RANGES'],
					'ITEM_QUANTITY_RANGE_SELECTED' => $item['ITEM_QUANTITY_RANGE_SELECTED'],
					'ITEM_MEASURE_RATIOS' => $item['ITEM_MEASURE_RATIOS'],
					'ITEM_MEASURE_RATIO_SELECTED' => $item['ITEM_MEASURE_RATIO_SELECTED'],
					'MORE_PHOTO' => $item['MORE_PHOTO'],
					'MORE_PHOTO_COUNT' => $item['MORE_PHOTO_COUNT']
				),
				'BASKET' => array(
					'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
					'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
					'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
					'EMPTY_PROPS' => empty($item['PRODUCT_PROPERTIES']),
					'BASKET_URL' => $arParams['~BASKET_URL'],
					'ADD_URL_TEMPLATE' => $arParams['~ADD_URL_TEMPLATE'],
					'BUY_URL_TEMPLATE' => $arParams['~BUY_URL_TEMPLATE']
				),
				'VISUAL' => array(
					'ID' => $itemIds['ID'],
					'PICT_ID' => $item['SECOND_PICT'] ? $itemIds['SECOND_PICT'] : $itemIds['PICT'],
					'PICT_SLIDER_ID' => $itemIds['PICT_SLIDER'],
					'QUANTITY_ID' => $itemIds['QUANTITY'],
					'QUANTITY_UP_ID' => $itemIds['QUANTITY_UP'],
					'QUANTITY_DOWN_ID' => $itemIds['QUANTITY_DOWN'],
					'PRICE_ID' => $itemIds['PRICE'],
					'PRICE_OLD_ID' => $itemIds['PRICE_OLD'],
					'PRICE_TOTAL_ID' => $itemIds['PRICE_TOTAL'],
					'BUY_ID' => $itemIds['BUY_LINK'],
					'BASKET_PROP_DIV' => $itemIds['BASKET_PROP_DIV'],
					'BASKET_ACTIONS_ID' => $itemIds['BASKET_ACTIONS'],
					'NOT_AVAILABLE_MESS' => $itemIds['NOT_AVAILABLE_MESS'],
					'COMPARE_LINK_ID' => $itemIds['COMPARE_LINK'],
					'SUBSCRIBE_ID' => $itemIds['SUBSCRIBE_LINK']
				),
				'BLOCKS_DATA' => array( // update- 
					'PRODUCT_BLOCKS_ID' => $itemIds['PRODUCT_BLOCKS_ID'],
					'PRODUCT_BLOCKS_BTN_ID' => $itemIds['PRODUCT_BLOCKS_BTN_ID'],
					'LINK_DISCOUNT' => $itemIds['LINK_DISCOUNT'],
					'RECOMMEND_LIST' => $recommendedList,
					'IMG_BASKET' => $templateFolder."/images/basket.png",
					'IMG_ORDER' => $templateFolder."/images/order.png",
					'INFO_TEXT' => $messageInfoText,
					'SUBSCRIBE_HEADER_TEXT' => GetMessage("BTN_MESSAGE_INFORM_DISCOUNT")
				)
			);
		}
		else
		{
			$jsParams = array(
				'PRODUCT_TYPE' => $item['CATALOG_TYPE'],
				'SHOW_QUANTITY' => false,
				'SHOW_ADD_BASKET_BTN' => false,
				'SHOW_BUY_BTN' => true,
				'SHOW_ABSENT' => true,
				'SHOW_SKU_PROPS' => false,
				'SECOND_PICT' => $item['SECOND_PICT'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
				'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
				'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
				'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
				'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
				'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
				'BIG_DATA' => $item['BIG_DATA'],
				'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
				'VIEW_MODE' => $arResult['TYPE'],
				'USE_SUBSCRIBE' => $showSubscribe,
				'DEFAULT_PICTURE' => array(
					'PICTURE' => $item['PRODUCT_PREVIEW'],
					'PICTURE_SECOND' => $item['PRODUCT_PREVIEW_SECOND']
				),
				'VISUAL' => array(
					'ID' => $itemIds['ID'],
					'PICT_ID' => $itemIds['PICT'],
					'SECOND_PICT_ID' => $itemIds['SECOND_PICT'],
					'PICT_SLIDER_ID' => $itemIds['PICT_SLIDER'],
					'QUANTITY_ID' => $itemIds['QUANTITY'],
					'QUANTITY_UP_ID' => $itemIds['QUANTITY_UP'],
					'QUANTITY_DOWN_ID' => $itemIds['QUANTITY_DOWN'],
					'QUANTITY_MEASURE' => $itemIds['QUANTITY_MEASURE'],
					'QUANTITY_LIMIT' => $itemIds['QUANTITY_LIMIT'],
					'PRICE_ID' => $itemIds['PRICE'],
					'PRICE_OLD_ID' => $itemIds['PRICE_OLD'],
					'PRICE_TOTAL_ID' => $itemIds['PRICE_TOTAL'],
					'TREE_ID' => $itemIds['PROP_DIV'],
					'TREE_ITEM_ID' => $itemIds['PROP'],
					'BUY_ID' => $itemIds['BUY_LINK'],
					'DSC_PERC' => $itemIds['DSC_PERC'],
					'SECOND_DSC_PERC' => $itemIds['SECOND_DSC_PERC'],
					'DISPLAY_PROP_DIV' => $itemIds['DISPLAY_PROP_DIV'],
					'BASKET_ACTIONS_ID' => $itemIds['BASKET_ACTIONS'],
					'NOT_AVAILABLE_MESS' => $itemIds['NOT_AVAILABLE_MESS'],
					'COMPARE_LINK_ID' => $itemIds['COMPARE_LINK'],
					'SUBSCRIBE_ID' => $itemIds['SUBSCRIBE_LINK']
				),
				'BASKET' => array(
					'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
					'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
					'SKU_PROPS' => $item['OFFERS_PROP_CODES'],
					'BASKET_URL' => $arParams['~BASKET_URL'],
					'ADD_URL_TEMPLATE' => $arParams['~ADD_URL_TEMPLATE'],
					'BUY_URL_TEMPLATE' => $arParams['~BUY_URL_TEMPLATE']
				),
				'PRODUCT' => array(
					'ID' => $item['ID'],
					'NAME' => $productTitle,
					'DETAIL_PAGE_URL' => $item['DETAIL_PAGE_URL'],
					'MORE_PHOTO' => $item['MORE_PHOTO'],
					'MORE_PHOTO_COUNT' => $item['MORE_PHOTO_COUNT']
				),
				'OFFERS' => array(),
				'OFFER_SELECTED' => 0,
				'TREE_PROPS' => array(),
				'BLOCKS_DATA' => array( // update- 
					'PRODUCT_BLOCKS_ID' => $itemIds['PRODUCT_BLOCKS_ID'],
					'PRODUCT_BLOCKS_BTN_ID' => $itemIds['PRODUCT_BLOCKS_BTN_ID'],
					'LINK_DISCOUNT' => $itemIds['LINK_DISCOUNT'],
					'RECOMMEND_LIST' => $recommendedList,
					'IMG_BASKET' => $templateFolder."/images/basket.png",
					'IMG_ORDER' => $templateFolder."/images/order.png",
					'INFO_TEXT' => $messageInfoText,
					'SUBSCRIBE_HEADER_TEXT' => GetMessage("BTN_MESSAGE_INFORM_DISCOUNT")
				)
			);
			
			/* RESIZE IMAGES */
			foreach ($item['JS_OFFERS'] as &$value_offers)
			{
				foreach ($value_offers['MORE_PHOTO'] as &$value_photo)
				{
					$arFileTmp = CFile::ResizeImageGet(
            			$value_photo['ID'],
            			array("width" => 370, "height" => 500),
            			BX_RESIZE_IMAGE_EXACT,
            			true
					);
					if ( isset($arFileTmp['src']) )
					{
						$value_photo['SRC'] = $arFileTmp['src'];
						$value_photo['WIDTH'] = $arFileTmp['width'];
						$value_photo['HEIGHT'] = $arFileTmp['height'];
					}
				}
			}
			/**/

			if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && !empty($item['OFFERS_PROP']))
			{
				$jsParams['SHOW_QUANTITY'] = $arParams['USE_PRODUCT_QUANTITY'];
				$jsParams['SHOW_SKU_PROPS'] = $item['OFFERS_PROPS_DISPLAY'];
				$jsParams['OFFERS'] = $item['JS_OFFERS'];
				$jsParams['OFFER_SELECTED'] = $item['OFFERS_SELECTED'];
				$jsParams['TREE_PROPS'] = $skuProps;
			}
		}

		if ($arParams['DISPLAY_COMPARE'])
		{
			$jsParams['COMPARE'] = array(
				'COMPARE_URL_TEMPLATE' => $arParams['~COMPARE_URL_TEMPLATE'],
				'COMPARE_DELETE_URL_TEMPLATE' => $arParams['~COMPARE_DELETE_URL_TEMPLATE'],
				'COMPARE_PATH' => $arParams['COMPARE_PATH']
			);
		}

		if ($item['BIG_DATA'])
		{
			$jsParams['PRODUCT']['RCM_ID'] = $item['RCM_ID'];
		}

		$jsParams['PRODUCT_DISPLAY_MODE'] = $arParams['PRODUCT_DISPLAY_MODE'];
		$jsParams['USE_ENHANCED_ECOMMERCE'] = $arParams['USE_ENHANCED_ECOMMERCE'];
		$jsParams['DATA_LAYER_NAME'] = $arParams['DATA_LAYER_NAME'];
		$jsParams['BRAND_PROPERTY'] = !empty($item['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
			? $item['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
			: null;

		$templateData = array(
			'JS_OBJ' => $obName,
			'ITEM' => array(
				'ID' => $item['ID'],
				'IBLOCK_ID' => $item['IBLOCK_ID'],
				'OFFERS_SELECTED' => $item['OFFERS_SELECTED'],
				'JS_OFFERS' => $item['JS_OFFERS']
			)
		);
		?>
		<script>
		  var <?=$obName?> = new JCCatalogItem(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
		</script>
	</div>
	<?
/*

if ( $USER->IsAdmin()  ) { 
	echo '<div class="col-md-12"><pre>'; 
	print_r($arParams);
	print_r($item);
	echo '</pre></div>'; 
};
/**/


	unset($item, $actualItem, $minOffer, $itemIds, $jsParams);
}?>