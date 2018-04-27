<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
 $lang='/'.LANGUAGE_ID.'/';
 
 if($arResult["PROPERTIES"]["name_".LANGUAGE_ID]["VALUE"]) $arResult["NAME"]=$arResult["PROPERTIES"]["name_".LANGUAGE_ID]["VALUE"];

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'REPORT_DISCOUNT' => $mainId.'_report_discount',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel',
	'HIT_LAST_SIZE' => $mainId.'_hit_last_size',
	'BTN_BUY_ONECLICK' => $mainId.'_buy_one_click'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);



$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];


$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers)
{
	$actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
		? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
		: reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['CATALOG_SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
?>

<?php
$fb_name = !empty($arResult["PROPERTIES"]["name_".LANGUAGE_ID]["VALUE"]) ? $arResult["PROPERTIES"]["name_".LANGUAGE_ID]["VALUE"] : '';

$ids_mas = explode('_', $itemIds['ID']);
?>
<script>
    fbq('track', 'ViewContent', {
        content_ids: '<?php echo $ids_mas[count($ids_mas)-1] ?>',
        content_name: '<?php echo $fb_name ?>',
        content_type: 'product',
        value: '<?php echo round($price['PRINT_RATIO_PRICE']) ?>',
        currency: 'UAH'
    });
    $(document).ready(function() {
        $(".product-item-detail-buy-button").on("mousedown", function (e) {
            fbq('track', 'AddToCart', {
                content_ids: '<?php echo $ids_mas[count($ids_mas) - 1] ?>',
                content_name: '<?php echo $fb_name ?>',
                content_type: 'product',
                value: '<?php echo round($price['PRINT_RATIO_PRICE']) ?>',
                currency: 'UAH'
            });
        });
    });
</script>


<div class="bx-catalog-element bx-<?=$arParams['TEMPLATE_THEME']?>" id="<?=$itemIds['ID']?>"
	itemscope itemtype="http://schema.org/Product">
	<div class="container-fluid">
		<div id="t_rozmir_pidpiska_window_overlay" class="overlay_popup"></div>
		<!--div id="t_rozmir_pidpiska_window"-->
		<div id="t_rozmir_pidpiska_window" class="col-xs-push-1 col-xs-10 col-sm-push-2 col-sm-8">	   		
			<!--table class="col-xs-push-1 col-xs-10 col-sm-push-2 col-sm-8 col-md-push-3 col-md-6 table-bordered table-striped"-->
			<table class="table-bordered table-striped">
				<tbody>
				<tr><th><?echo GetMessage("TABL_ROZM_Size");?></th><th><?echo GetMessage("TABL_ROZM_embroidery");?></th><th><?echo GetMessage("TABL_ROZM_circumference");?></th><th><?echo GetMessage("TABL_ROZM_Girth");?></th><th><?echo GetMessage("TABL_ROZM_Height");?></th></tr>
				<tr>
				<td>40/XXS</td>
				<td>78-81</td>
				<td>61-65</td>
				<td>87-91</td>
				<td>160-168</td>
				</tr>
				<tr>
				<td>42/XS</td>
				<td>82-85</td>
				<td>65-69</td>
				<td>91-95</td>
				<td>160-168</td>
				</tr>
				<tr>
				<td>44/S</td>
				<td>86-89</td>
				<td>70-73</td>
				<td>96-99</td>
				<td>168-176</td>
				</tr>
				<tr>
				<td>46/M</td>
				<td>90-93</td>
				<td>74-77</td>
				<td>100-102</td>
				<td>168-176</td>
				</tr>
				<tr>
				<td>48/L</td>
				<td>94-97</td>
				<td>78-81</td>
				<td>103-106</td>
				<td>168-176</td>
				</tr>
				<tr>
				<td>50/XL</td>
				<td>98-103</td>
				<td>82-85</td>
				<td>107-110</td>
				<td>168-176</td>
				</tr>
				</tbody>
			</table>
		</div>
	<?if ($arResult["PROPERTIES"]["LINK_YOUTUBE"]["VALUE"]) { ?>

		<div id="info-youtube_window" class="col-xs-push-1 col-xs-10 col-sm-push-2 col-sm-8">				   		
			<iframe src="<?=$arResult["PROPERTIES"]["LINK_YOUTUBE"]["VALUE"]?>?loop=1" frameborder="0" allowfullscreen style="width: 95%;min-height: 400px; margin: 1% 0 -1% 0;"></iframe>
		</div>
	<?}?>
		<div class="row">
			<!-- SLIDER CONTAINER -->
			<div class="col-xs-12 col-sm-8 cat_block-left_all">
				<div class="col-xs-12 col-sm-8 cat_block-left">					
					<div class="product-item-detail-slider-container" id="<?=$itemIds['BIG_SLIDER_ID']?>">
						<span class="product-item-detail-slider-close" data-entity="close-popup"></span>
						<div class="col-sm-3 cs-product-item-detail-slider-block hidden-xs">
							<?
							if ($showSliderControls)
							{
								if ($haveOffers)
								{
									foreach ($arResult['OFFERS'] as $keyOffer => $offer)
									{
										if (!isset($offer['MORE_PHOTO_COUNT']) || $offer['MORE_PHOTO_COUNT'] <= 0)
											continue;

										$strVisible = $arResult['OFFERS_SELECTED'] == $keyOffer ? '' : 'none';
										?>
										<!-- update- 1 -->
										<div class="product-item-detail-slider-controls-block cs-scrollbar-1" id="<?=$itemIds['SLIDER_CONT_OF_ID'].$offer['ID']?>" style="display: <?=$strVisible?>;">
											<?
											foreach ($offer['MORE_PHOTO'] as $keyPhoto => $photo)
											{
												?>
												<div class="product-item-detail-slider-controls-image<?=($keyPhoto == 0 ? ' active' : '')?>"
													data-entity="slider-control" data-value="<?=$offer['ID'].'_'.$photo['ID']?>">
													<img src="<?=$photo['SRC']?>">
												</div>
												<?
											}
											?>
										</div>
										<?
									}
								}
								else
								{
									?>
									<!-- update- 2 -->
									<div class="product-item-detail-slider-controls-block cs-scrollbar-1" id="<?=$itemIds['SLIDER_CONT_ID']?>">
										<?
										if (!empty($actualItem['MORE_PHOTO']))
										{
											foreach ($actualItem['MORE_PHOTO'] as $key => $photo)
											{
												?>
												<div class="product-item-detail-slider-controls-image<?=($key == 0 ? ' active' : '')?>"
													data-entity="slider-control" data-value="<?=$photo['ID']?>">
													<img src="<?=$photo['SRC']?>">
												</div>
												<?
											}
										}
										?>
									</div>
									<?
								}
							}
							?>
						</div>

						<div class="col-sm-9 cs-product-item-detail-slider-block">

							<div id="<?=$itemIds['HIT_LAST_SIZE'];?>">
							<? 
							$styleButtomPosition = 40;
							if ($arResult['PROPERTIES']['hit_sale']['VALUE'] == 'Y') 
							{
								?>
								<div class="cs-product-item-detail-slider-block-text" style="bottom: <?=$styleButtomPosition?>px;">
									<?echo $arResult['PROPERTIES']['hit_sale']['NAME'];?>
								</div>
								<?
								$styleButtomPosition = $styleButtomPosition + 40;
							}?>
							<?
							if ($haveOffers && !empty($arResult['OFFERS_PROP']))
								if( count($arResult['SKU_PROPS']['size']['VALUES']) <= 2 )
							{?>
								<div class="cs-product-item-detail-slider-block-text"  style="bottom: <?=$styleButtomPosition?>px;"><?=GetMessage('CT_BCE_LAST_SIZE_TEXT');?></div>
								<?
							}?>
							</div>

							<div class="product-item-detail-slider-block <?=($arParams['IMAGE_RESOLUTION'] === '1by1' ? 'product-item-detail-slider-block-square' : '')?> " data-entity="images-slider-block">
								<span class="product-item-detail-slider-left" data-entity="slider-control-left" style="display: none;"></span>
								<span class="product-item-detail-slider-right" data-entity="slider-control-right" style="display: none;"></span>
								<div class="product-item-label-text <?=$labelPositionClass?>" id="<?=$itemIds['STICKER_ID']?>"
									<?=(!$arResult['LABEL'] ? 'style="display: none;"' : '' )?>>
									<?
									if ($arResult['LABEL'] && !empty($arResult['LABEL_ARRAY_VALUE']))
									{
										foreach ($arResult['LABEL_ARRAY_VALUE'] as $code => $value)
										{
											?>
											<div<?=(!isset($arParams['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
												<span title="<?=$value?>"><?=$value?></span>
											</div>
											<?
										}
									}
									?>
							</div>
								<?
								if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
								{
									if ($haveOffers)
									{
										?>
										<div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DISCOUNT_PERCENT_ID']?>"
											style="display: none;">
										</div>
										<?
									}
									else
									{
										if ($price['DISCOUNT'] > 0)
										{
											?>
											<div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DISCOUNT_PERCENT_ID']?>"
												title="<?=-$price['PERCENT']?>%">
												<span><?=-$price['PERCENT']?>%</span>
											</div>
											<?
										}
									}
								}
								?>
								<!-- IMAGE CONTAINER -->
								<div class="product-item-detail-slider-images-container" data-entity="images-container">
									<?
									if (!empty($actualItem['MORE_PHOTO']))
									{
										foreach ($actualItem['MORE_PHOTO'] as $key => $photo)
										{
											?>
											<div class="product-item-detail-slider-image<?=($key == 0 ? ' active' : '')?>" data-entity="image" data-id="<?=$photo['ID']?>">
												<img src="<?=$photo['SRC']?>" alt="<?=$alt?>" title="<?=$title?>"<?=($key == 0 ? ' itemprop="image"' : '')?>>
											</div>
											<?
										}
									}

									if ($arParams['SLIDER_PROGRESS'] === 'Y')
									{
										?>
										<div class="product-item-detail-slider-progress-bar" data-entity="slider-progress-bar" style="width: 0;"></div>
										<?
									}
									?>
								</div>
							</div>
					</div>
				</div>				
			</div>	
			<!-- SLIDER CONTAINER - END -->			
				
			<div class="col-xs-12 col-sm-4 cat_block-center">
				<?
				if ($arParams['DISPLAY_NAME'] === 'Y')
				{
					?>
					<h1 class="detail-title">
						<?=$name?>
					</h1>
				<?}?>
				<div class="row">						
					<div class="product-item-detail-info-container">
						<?if ($arParams['SHOW_OLD_PRICE'] === 'Y')
							{?>
								<div class="<?=($showDiscount ? 'col-xs-6' : '')?> detail-price-old" id="<?=$itemIds['OLD_PRICE_ID']?>"
								style="display: <?=($showDiscount ? '' : 'none')?>;"><?=($showDiscount ? $price['PRINT_RATIO_BASE_PRICE'] : '')?>
								</div>
							<?
							}
							?>
							<div class="<?=($showDiscount ? 'col-xs-6' : 'col-xs-12')?> detail-price-current" id="<?=$itemIds['PRICE_ID']?>"><?=$price['PRINT_RATIO_PRICE']?>
							</div>
							<?/*
							if ($arParams['SHOW_OLD_PRICE'] === 'Y')
							{
								?>
								<!--div class="item_economy_price" id="<?=$itemIds['DISCOUNT_PRICE_ID']?>"
									style="display: <?=($showDiscount ? '' : 'none')?>;">
									<?
									if ($showDiscount)
									{
										echo Loc::getMessage('CT_BCE_CATALOG_ECONOMY_INFO2', array('#ECONOMY#' => $price['PRINT_RATIO_DISCOUNT']));
									}
									?>
								</div-->
								<?
							}
							*/?>
					</div>					
				</div>	


				<!-- OFFERS PROP -->
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="row">
							<div class="col-sm-12">
								<div class="product-item-detail-info-section">
									<?
									foreach ($arParams['PRODUCT_INFO_BLOCK_ORDER'] as $blockName)
									{
										switch ($blockName)
										{
											case 'sku':
												if ($haveOffers && !empty($arResult['OFFERS_PROP']))
												{
													?>
													<div id="<?=$itemIds['TREE_ID']?>">
														<?
														foreach ($arResult['SKU_PROPS'] as $skuProperty)
														{
															if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
																continue;

															$propertyId = $skuProperty['ID'];
															$skuProps[] = array(
																'ID' => $propertyId,
																'SHOW_MODE' => $skuProperty['SHOW_MODE'],
																'VALUES' => $skuProperty['VALUES'],
																'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
															);
															?>
															<div class="product-item-detail-info-container" data-entity="sku-line-block">
																<div class="product-item-detail-info-container-title"><?=GetMessage('SIZE_NAME')?></div>
																<!--div class="product-item-detail-info-container-title">
																<?//=htmlspecialcharsEx($skuProperty['NAME'])?></div-->
																<div class="product-item-scu-container">
																	<div class="product-item-scu-block">
																		<div class="product-item-scu-list">
																			<ul class="product-item-scu-item-list">
																				<?
																				foreach ($skuProperty['VALUES'] as &$value)
																				{
																					$value['NAME'] = htmlspecialcharsbx($value['NAME']);

																					if ($skuProperty['SHOW_MODE'] === 'PICT')
																					{
																						?>
																						<li class="product-item-scu-item-color-container" title="<?=$value['NAME']?>"
																							data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
																							data-onevalue="<?=$value['ID']?>">
																							<div class="product-item-scu-item-color-block">
																								<div class="product-item-scu-item-color" title="<?=$value['NAME']?>"
																									style="background-image: url(<?=$value['PICT']['SRC']?>);">
																								</div>
																							</div>
																						</li>
																						<?
																					}
																					else
																					{
																						?>
																						<li class="product-item-scu-item-text-container" title="<?=$value['NAME']?>"
																							data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
																							data-onevalue="<?=$value['ID']?>">
																							<div class="product-item-scu-item-text-block">
																								<div class="product-item-scu-item-text"><?=$value['NAME']?></div>
																							</div>
																						</li>
																						<?
																					}
																				}
																				?>
																			</ul>
																			<div style="clear: both;"></div>
																		</div>
																	</div>
																</div>
															</div>
															<?
														}
														?>
													</div>
													<div class="size">			     	
														<span class="sizes-table" id="t_rozmir_pidpiska_button"><?echo GetMessage("TABL_ROZM");?>															
														</span>
													</div>
													<?
												}

												break;
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>


				<!--BUY BUTTON -->
				<div class="row">
					<div data-entity="main-button-container">
						<div id="<?=$itemIds['BASKET_ACTIONS_ID']?>" class="<? echo $arResult["DISPLAY_PROPERTIES"]["komplekt"] ? 'cs-buy-button-disable' : ''; ?>" style="display: <?=($actualItem['CAN_BUY'] ? '' : 'none')?>;">
							<?
							if ($showAddBtn)
							{
								?>
								<div class="product-item-detail-info-container">
									<a class="btn product-item-detail-buy-button" id="<?=$itemIds['ADD_BASKET_LINK']?>"
										href="javascript:void(0);">
										<img src="<?=$templateFolder?>/images/basket.png">
										<span><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></span>
									</a>
								</div>
								<?
							}

							if ($showBuyBtn)
							{
								?>
								<div class="product-item-detail-info-container">
									<a class="btn <?=$buyButtonClassName?> product-item-detail-buy-button" id="<?=$itemIds['BUY_LINK']?>"
										href="javascript:void(0);">
										<span><?=$arParams['MESS_BTN_BUY']?></span>
									</a>
								</div>
								<?
							}
							?>
						</div>						
						
						<?
						if ($showSubscribe)
						{
							?>
							<div class="product-item-detail-info-container">							
								<?
								$APPLICATION->IncludeComponent(
									'bitrix:catalog.product.subscribe',
									'',
									array(
										'PRODUCT_ID' => $arResult['ID'],
										'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
										'BUTTON_CLASS' => 'btn btn-default product-item-detail-buy-button',
										'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
										'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
									),
									$component,
									array('HIDE_ICONS' => 'Y')
								);
								?>
							</div>
							<?
						}
						?>
						<div class="product-item-detail-info not_available">
							<div class="product-item-detail-buy-button" id="<?=$itemIds['NOT_AVAILABLE_MESS']?>"
								href="javascript:void(0)"
								rel="nofollow" style="display: <?=(!$actualItem['CAN_BUY'] ? '' : 'none')?>;">
								<?=$arParams['MESS_NOT_AVAILABLE']?>
							</div>
						</div>

					</div>
				</div>

				<!-- BUY ONE CLICK -->
				<?if ( $USER->IsAdmin() ) {?>
				<div class="row">
					<div data-entity="main-button-container">
						<div class="product-item-detail-info-container">
							<button class="bx_big bx_bt_button buy_one_click_popup" id="<?=$itemIds['BTN_BUY_ONECLICK'];?>" data-offer-id="">
								<img data-offer-id="" src="<?=$templateFolder;?>/images/order.png">
								<? echo GetMessage("BUY_ONE_CLICK");?>
							</button>
						</div>
					</div>
				</div>
				<?}?>

				<!-- DISCOUNT -->
				<div class="row">
					<div data-entity="main-button-container">
						<div class="product-item-detail-info-container">								
							<a class="btn product-item-detail-buy-button" id="<?=$itemIds['REPORT_DISCOUNT']?>"
								href="javascript:void(0);">
								<img src="<?=$templateFolder?>/images/heart.png">
								<span><?=GetMessage('CT_BCE_CATALOG_MESSAGE_BTN_DISCOUNT');?></span>
							</a>
						</div>
					</div>
				</div>

				<!-- INFO VIDEO -->
				<div class="video-youtube" id="info-youtube_button">
					<?if ($arResult["PROPERTIES"]["LINK_YOUTUBE"]["VALUE"]) { ?>
						<?=GetMessage('frame-youtube');?>
					<?}?>
					
				</div>		
				<!-- INFO SECTION -->
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="row">
							<div class="col-sm-12">
								<div class="product-item-detail-info-section">
									<?
									foreach ($arParams['PRODUCT_INFO_BLOCK_ORDER'] as $blockName)
									{
										switch ($blockName)
										{
											/*
											case 'sku':
												if ($haveOffers && !empty($arResult['OFFERS_PROP']))
												{
													?>
													<div id="<?=$itemIds['TREE_ID']?>">
														<?
														foreach ($arResult['SKU_PROPS'] as $skuProperty)
														{
															if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
																continue;

															$propertyId = $skuProperty['ID'];
															$skuProps[] = array(
																'ID' => $propertyId,
																'SHOW_MODE' => $skuProperty['SHOW_MODE'],
																'VALUES' => $skuProperty['VALUES'],
																'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
															);
															?>
															<div class="product-item-detail-info-container" data-entity="sku-line-block">
																<div class="product-item-detail-info-container-title"><?=GetMessage('SIZE_NAME')?></div>
																<!--div class="product-item-detail-info-container-title">
																<?//=htmlspecialcharsEx($skuProperty['NAME'])?></div-->
																<div class="product-item-scu-container">
																	<div class="product-item-scu-block">
																		<div class="product-item-scu-list">
																			<ul class="product-item-scu-item-list">
																				<?
																				foreach ($skuProperty['VALUES'] as &$value)
																				{
																					$value['NAME'] = htmlspecialcharsbx($value['NAME']);

																					if ($skuProperty['SHOW_MODE'] === 'PICT')
																					{
																						?>
																						<li class="product-item-scu-item-color-container" title="<?=$value['NAME']?>"
																							data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
																							data-onevalue="<?=$value['ID']?>">
																							<div class="product-item-scu-item-color-block">
																								<div class="product-item-scu-item-color" title="<?=$value['NAME']?>"
																									style="background-image: url(<?=$value['PICT']['SRC']?>);">
																								</div>
																							</div>
																						</li>
																						<?
																					}
																					else
																					{
																						?>
																						<li class="product-item-scu-item-text-container" title="<?=$value['NAME']?>"
																							data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
																							data-onevalue="<?=$value['ID']?>">
																							<div class="product-item-scu-item-text-block">
																								<div class="product-item-scu-item-text"><?=$value['NAME']?></div>
																							</div>
																						</li>
																						<?
																					}
																				}
																				?>
																			</ul>
																			<div style="clear: both;"></div>
																		</div>
																	</div>
																</div>
															</div>
															<?
														}
														?>
													</div>
													<?
												}												
												break;
											*/

											case 'props':
												if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
												{
													?>
													<div class="product-item-detail-info-container">
														<?
														if (!empty($arResult['DISPLAY_PROPERTIES']))
														{
															?>
															<dl class="product-item-detail-properties1">
																<?
																foreach ($arResult['DISPLAY_PROPERTIES'] as $property)
																{
																	if (isset($arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']]))
																	{
																		?>
																		<dt><?=$property['NAME']?></dt>
																		<dd><?=(is_array($property['DISPLAY_VALUE'])
																				? implode(' / ', $property['DISPLAY_VALUE'])
																				: $property['DISPLAY_VALUE'])?>
																		</dd>
																		<?
																	}
																}
																unset($property);
																?>
															</dl>
															<?
														}?>


														<?if ($arResult['SHOW_OFFERS_PROPS'])
														{
															?>
															<dl class="product-item-detail-properties2" id="<?=$itemIds['DISPLAY_MAIN_PROP_DIV']?>"></dl>
															<?
														}
														?>
													</div>
													<?
												}
												break;
										}
									}
									?>
								</div>
							</div>
							<div class="">
								<div class="product-item-detail-pay-block">
									<?
									foreach ($arParams['PRODUCT_PAY_BLOCK_ORDER'] as $blockName)
									{
										switch ($blockName)
										{
											case 'rating':
												if ($arParams['USE_VOTE_RATING'] === 'Y')
												{
													?>
													<div class="product-item-detail-info-container">
														<?
														$APPLICATION->IncludeComponent(
															'bitrix:iblock.vote',
															'stars',
															array(
																'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
																'IBLOCK_ID' => $arParams['IBLOCK_ID'],
																'ELEMENT_ID' => $arResult['ID'],
																'ELEMENT_CODE' => '',
																'MAX_VOTE' => '5',
																'VOTE_NAMES' => array('1', '2', '3', '4', '5'),
																'SET_STATUS_404' => 'N',
																'DISPLAY_AS_RATING' => $arParams['VOTE_DISPLAY_AS_RATING'],
																'CACHE_TYPE' => $arParams['CACHE_TYPE'],
																'CACHE_TIME' => $arParams['CACHE_TIME']
															),
															$component,
															array('HIDE_ICONS' => 'Y')
														);
														?>
													</div>
													<?
												}

												break;

											case 'price':
												?>

												<?
												break;

											case 'priceRanges':
												if ($arParams['USE_PRICE_COUNT'])
												{
													$showRanges = !$haveOffers && count($actualItem['ITEM_QUANTITY_RANGES']) > 1;
													$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';
													?>
													<div class="product-item-detail-info-container"
														<?=$showRanges ? '' : 'style="display: none;"'?>
														data-entity="price-ranges-block">
														<div class="product-item-detail-info-container-title">
															<?=$arParams['MESS_PRICE_RANGES_TITLE']?>
															<span data-entity="price-ranges-ratio-header">
																(<?=(Loc::getMessage(
																	'CT_BCE_CATALOG_RATIO_PRICE',
																	array('#RATIO#' => ($useRatio ? $measureRatio : '1').' '.$actualItem['ITEM_MEASURE']['TITLE'])
																))?>)
															</span>
														</div>
														<dl class="product-item-detail-properties3" data-entity="price-ranges-body">
															<?
															if ($showRanges)
															{
																foreach ($actualItem['ITEM_QUANTITY_RANGES'] as $range)
																{
																	if ($range['HASH'] !== 'ZERO-INF')
																	{
																		$itemPrice = false;

																		foreach ($arResult['ITEM_PRICES'] as $itemPrice)
																		{
																			if ($itemPrice['QUANTITY_HASH'] === $range['HASH'])
																			{
																				break;
																			}
																		}

																		if ($itemPrice)
																		{
																			?>
																			<dt>
																				<?
																				echo Loc::getMessage(
																						'CT_BCE_CATALOG_RANGE_FROM',
																						array('#FROM#' => $range['SORT_FROM'].' '.$actualItem['ITEM_MEASURE']['TITLE'])
																					).' ';

																				if (is_infinite($range['SORT_TO']))
																				{
																					echo Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
																				}
																				else
																				{
																					echo Loc::getMessage(
																						'CT_BCE_CATALOG_RANGE_TO',
																						array('#TO#' => $range['SORT_TO'].' '.$actualItem['ITEM_MEASURE']['TITLE'])
																					);
																				}
																				?>
																			</dt>
																			<dd><?=($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE'])?></dd>
																			<?
																		}
																	}
																}
															}
															?>
														</dl>
													</div>
													<?
													unset($showRanges, $useRatio, $itemPrice, $range);
												}

												break;

											case 'quantityLimit':
												if ($arParams['SHOW_MAX_QUANTITY'] !== 'N')
												{
													if ($haveOffers)
													{
														?>
														<div class="product-item-detail-info-container" id="<?=$itemIds['QUANTITY_LIMIT']?>" style="display: none;">
															<div class="product-item-detail-info-container-title">
																<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
																<span class="product-item-quantity" data-entity="quantity-limit-value"></span>
															</div>
														</div>
														<?
													}
													else
													{
														if (
															$measureRatio
															&& (float)$actualItem['CATALOG_QUANTITY'] > 0
															&& $actualItem['CATALOG_QUANTITY_TRACE'] === 'Y'
															&& $actualItem['CATALOG_CAN_BUY_ZERO'] === 'N'
														)
														{
															?>
															<div class="product-item-detail-info-container" id="<?=$itemIds['QUANTITY_LIMIT']?>">
																<div class="product-item-detail-info-container-title">
																	<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
																	<span class="product-item-quantity" data-entity="quantity-limit-value">
																		<?
																		if ($arParams['SHOW_MAX_QUANTITY'] === 'M')
																		{
																			if ((float)$actualItem['CATALOG_QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR'])
																			{
																				echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
																			}
																			else
																			{
																				echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
																			}
																		}
																		else
																		{
																			echo $actualItem['CATALOG_QUANTITY'].' '.$actualItem['ITEM_MEASURE']['TITLE'];
																		}
																		?>
																	</span>
																</div>
															</div>
															<?
														}
													}
												}

												break;

											case 'quantity':
												if ($arParams['USE_PRODUCT_QUANTITY'])
												{
													?>
													<div class="product-item-detail-info-container" style="<?=(!$actualItem['CAN_BUY'] ? 'display: none;' : '')?>"
														data-entity="quantity-block">
														<div class="product-item-detail-info-container-title"><?=Loc::getMessage('CATALOG_QUANTITY')?></div>
														<div class="product-item-amount">
															<div class="product-item-amount-field-container">
																<a class="product-item-amount-field-btn-minus" id="<?=$itemIds['QUANTITY_DOWN_ID']?>"
																	href="javascript:void(0)" rel="nofollow">
																</a>
																<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY_ID']?>" type="tel"
																	value="<?=$price['MIN_QUANTITY']?>">
																<a class="product-item-amount-field-btn-plus" id="<?=$itemIds['QUANTITY_UP_ID']?>"
																	href="javascript:void(0)" rel="nofollow">
																</a>
																<span class="product-item-amount-description-container">
																	<span id="<?=$itemIds['QUANTITY_MEASURE']?>">
																		<?=$actualItem['ITEM_MEASURE']['TITLE']?>
																	</span>
																	<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
																</span>
															</div>
														</div>
													</div>
													<?
												}

												break;

											case 'buttons':
												?>

												<?
												break;
										}
									}?>

									<?if ($arParams['DISPLAY_COMPARE'])
									{
										?>
										<div class="product-item-detail-compare-container">
											<div class="product-item-detail-compare">
												<div class="checkbox">
													<label id="<?=$itemIds['COMPARE_LINK']?>">
														<input type="checkbox" data-entity="compare-checkbox">
														<span data-entity="compare-title"><?=$arParams['MESS_BTN_COMPARE']?></span>
													</label>
												</div>
											</div>
										</div>
										<?
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- END INFO SECTION -->


			<?/*
			<!--div class="row">
				<div class="col-sm-8 col-md-9">
					<div class="row" id="<?/*=$itemIds['TABS_ID']?>">


						<div class="col-xs-12">
							<div class="product-item-detail-tabs-container">
								<ul class="product-item-detail-tabs-list">
									<?
									if ($showDescription)
									{
										?>
										<li class="product-item-detail-tab active" data-entity="tab" data-value="description">
											<a href="javascript:void(0);" class="product-item-detail-tab-link">
												<span><?=$arParams['MESS_DESCRIPTION_TAB']?></span>
											</a>
										</li>
										<?
									}

									if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
									{
										?>
										<li class="product-item-detail-tab" data-entity="tab" data-value="properties">
											<a href="javascript:void(0);" class="product-item-detail-tab-link">
												<span><?=$arParams['MESS_PROPERTIES_TAB']?></span>
											</a>
										</li>
										<?
									}

									if ($arParams['USE_COMMENTS'] === 'Y')
									{
										?>
										<li class="product-item-detail-tab" data-entity="tab" data-value="comments">
											<a href="javascript:void(0);" class="product-item-detail-tab-link">
												<span><?=$arParams['MESS_COMMENTS_TAB']?></span>
											</a>
										</li>
										<?
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 col-md-3">
					<div>
						<?
						if ($arParams['BRAND_USE'] === 'Y')
						{
							$APPLICATION->IncludeComponent(
								'bitrix:catalog.brandblock',
								'.default',
								array(
									'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
									'IBLOCK_ID' => $arParams['IBLOCK_ID'],
									'ELEMENT_ID' => $arResult['ID'],
									'ELEMENT_CODE' => '',
									'PROP_CODE' => $arParams['BRAND_PROP_CODE'],
									'CACHE_TYPE' => $arParams['CACHE_TYPE'],
									'CACHE_TIME' => $arParams['CACHE_TIME'],
									'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
									'WIDTH' => '',
									'HEIGHT' => ''
								),
								$component,
								array('HIDE_ICONS' => 'Y')
							);
						}
						?>
					</div>
				</div>
			</div-->
			<?/**/?>
		</div>
					<div class="row">
						<div class="col-xs-12 BLOCK_HARACTERISTIKI">
							<div class="product-item-detail">

								<?
								if($arResult["PROPERTIES"]["OPIS_".LANGUAGE_ID]["~VALUE"]["TEXT"])
									echo $arResult["PROPERTIES"]["OPIS_".LANGUAGE_ID]["~VALUE"]["TEXT"];?>
									<div class="seo_text col-xs-12">
									<!--seo_text_start-->
									<?php print $seo_text;?>
									<!--seo_text_end-->
									</div> 
							</div>
							<?
							if ($showDescription)
							{
								/*
								?>
								<div class="product-item-detail">
									<?
									if (
										$arResult['PREVIEW_TEXT'] != ''
										&& (
											$arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'S'
											|| ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'E' && $arResult['DETAIL_TEXT'] == '')
										)
									)
									{
										echo $arResult['PREVIEW_TEXT_TYPE'] === 'html' ? $arResult['PREVIEW_TEXT'] : '<p>'.$arResult['PREVIEW_TEXT'].'</p>';
									}

									if ($arResult['DETAIL_TEXT'] != '')
									{
										echo $arResult['DETAIL_TEXT_TYPE'] === 'html' ? $arResult['DETAIL_TEXT'] : '<p>'.$arResult['DETAIL_TEXT'].'</p>';
									}
									?>
								</div>
								<?
								*/
							}

							if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
							{
								/*
								?>
								<div class="product-item-detail-tab-content" data-entity="tab-container" data-value="properties">
									<?
									if (!empty($arResult['DISPLAY_PROPERTIES']))
									{
										?>
										<dl class="product-item-detail-properties4">
											<?
											foreach ($arResult['DISPLAY_PROPERTIES'] as $property)
											{
												?>
												<dt><?=$property['NAME']?></dt>
												<dd><?=(
													is_array($property['DISPLAY_VALUE'])
														? implode(' / ', $property['DISPLAY_VALUE'])
														: $property['DISPLAY_VALUE']
													)?>
												</dd>
												<?
											}
											unset($property);
											?>
										</dl>
										<?
									}

									if ($arResult['SHOW_OFFERS_PROPS'])
									{
										?>
										<dl class="product-item-detail-properties" id="<?=$itemIds['DISPLAY_PROP_DIV']?>"></dl>
										<?
									}
									?>
								</div>
								<?
								*/
							}

							if ($arParams['USE_COMMENTS'] === 'Y')
							{
								/*
								?>
								<div class="product-item-detail-tab-content" data-entity="tab-container" data-value="comments" style="display: none;">
									<?
									$componentCommentsParams = array(
										'ELEMENT_ID' => $arResult['ID'],
										'ELEMENT_CODE' => '',
										'IBLOCK_ID' => $arParams['IBLOCK_ID'],
										'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
										'URL_TO_COMMENT' => '',
										'WIDTH' => '',
										'COMMENTS_COUNT' => '5',
										'BLOG_USE' => $arParams['BLOG_USE'],
										'FB_USE' => $arParams['FB_USE'],
										'FB_APP_ID' => $arParams['FB_APP_ID'],
										'VK_USE' => $arParams['VK_USE'],
										'VK_API_ID' => $arParams['VK_API_ID'],
										'CACHE_TYPE' => $arParams['CACHE_TYPE'],
										'CACHE_TIME' => $arParams['CACHE_TIME'],
										'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
										'BLOG_TITLE' => '',
										'BLOG_URL' => $arParams['BLOG_URL'],
										'PATH_TO_SMILE' => '',
										'EMAIL_NOTIFY' => $arParams['BLOG_EMAIL_NOTIFY'],
										'AJAX_POST' => 'Y',
										'SHOW_SPAM' => 'Y',
										'SHOW_RATING' => 'N',
										'FB_TITLE' => '',
										'FB_USER_ADMIN_ID' => '',
										'FB_COLORSCHEME' => 'light',
										'FB_ORDER_BY' => 'reverse_time',
										'VK_TITLE' => '',
										'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME']
									);
									if(isset($arParams["USER_CONSENT"]))
										$componentCommentsParams["USER_CONSENT"] = $arParams["USER_CONSENT"];
									if(isset($arParams["USER_CONSENT_ID"]))
										$componentCommentsParams["USER_CONSENT_ID"] = $arParams["USER_CONSENT_ID"];
									if(isset($arParams["USER_CONSENT_IS_CHECKED"]))
										$componentCommentsParams["USER_CONSENT_IS_CHECKED"] = $arParams["USER_CONSENT_IS_CHECKED"];
									if(isset($arParams["USER_CONSENT_IS_LOADED"]))
										$componentCommentsParams["USER_CONSENT_IS_LOADED"] = $arParams["USER_CONSENT_IS_LOADED"];
									$APPLICATION->IncludeComponent(
										'bitrix:catalog.comments',
										'',
										$componentCommentsParams,
										$component,
										array('HIDE_ICONS' => 'Y')
									);
									?>
								</div>
								<?
								*/
							}
							?>
						</div>
					</div>

		<div class="col-xs-12 block-complect">
			<div class="row">
				<?
				if ($haveOffers)
				{
					if ($arResult['OFFER_GROUP'])
					{
						foreach ($arResult['OFFER_GROUP_VALUES'] as $offerId)
						{
							?>
							<span id="<?=$itemIds['OFFER_GROUP'].$offerId?>" style="display: none;">
								<?
								$APPLICATION->IncludeComponent(
									'bitrix:catalog.set.constructor',
									'.default',
									array(
										'IBLOCK_ID' => $arResult['OFFERS_IBLOCK'],
										'ELEMENT_ID' => $offerId,
										'PRICE_CODE' => $arParams['PRICE_CODE'],
										'BASKET_URL' => $arParams['BASKET_URL'],
										'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
										'CACHE_TYPE' => $arParams['CACHE_TYPE'],
										'CACHE_TIME' => $arParams['CACHE_TIME'],
										'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
										'TEMPLATE_THEME' => '', //$arParams['~TEMPLATE_THEME'],
										'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
										'CURRENCY_ID' => $arParams['CURRENCY_ID']
									),
									$component,
									array('HIDE_ICONS' => 'Y')
								);
								?>
							</span>
							<?
						}
					}
				}
				else
				{
					if ($arResult['MODULES']['catalog'] && $arResult['OFFER_GROUP'])
					{
						$APPLICATION->IncludeComponent(
							'bitrix:catalog.set.constructor',
							'.default',
							array(
								'IBLOCK_ID' => $arParams['IBLOCK_ID'],
								'ELEMENT_ID' => $arResult['ID'],
								'PRICE_CODE' => $arParams['PRICE_CODE'],
								'BASKET_URL' => $arParams['BASKET_URL'],
								'CACHE_TYPE' => $arParams['CACHE_TYPE'],
								'CACHE_TIME' => $arParams['CACHE_TIME'],
								'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
								'TEMPLATE_THEME' => '',//$arParams['~TEMPLATE_THEME'],
								'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
								'CURRENCY_ID' => $arParams['CURRENCY_ID']
							),
							$component,
							array('HIDE_ICONS' => 'Y')
						);
					}
				}
				?>
			</div>
		</div>
		

		<? /* BLOCK CAPSULA */
		if($USER->IsAdmin()) 
		{
			if ($arResult["DISPLAY_PROPERTIES"]["komplekt"])
			{
				$PROPS_KOMPLECT_EL = array();?>
				<div class="row" id="capsula">
					<div class="col-xs-12 capsula-zagolovok text-center">
						<?=GetMessage("MESS_OFFERS_CAPSULA_UMOVA")?>
					</div>
					<?foreach ($arResult['DISPLAY_PROPERTIES']['komplekt']['VALUE'] as $kompl_items)
					{
						$db_props = CIBlockElement::GetProperty($arResult["IBLOCK_ID"], $kompl_items, array("sort"=>"asc"), array("ACTIVE" => "Y"));
						while($ar_props = $db_props->Fetch()){
							$PROPS_KOMPLECT_EL[$kompl_items][$ar_props['CODE']] = $ar_props['VALUE'];
						}
						$db_props =  CIBlockElement::GetByID($kompl_items);
						if($ar_props = $db_props->GetNext()){
							$PROPS_KOMPLECT_EL[$kompl_items]['ID'] = $ar_props['ID'];
							$PROPS_KOMPLECT_EL[$kompl_items]['ACTIVE'] = $ar_props['ACTIVE'];
							$PROPS_KOMPLECT_EL[$kompl_items]['PREVIEW_PICTURE'] = $ar_props['PREVIEW_PICTURE'];
							$PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL'] = $ar_props['DETAIL_PAGE_URL'];
						}
						if($PROPS_KOMPLECT_EL[$kompl_items]['pictures']){
							$arFileTmp = CFile::ResizeImageGet(
									$PROPS_KOMPLECT_EL[$kompl_items]['pictures'],
									array("width" => 170, "height" => 230),
									BX_RESIZE_IMAGE_EXACT,
									true
								);
							$PROPS_KOMPLECT_EL[$kompl_items]['PREVIEW_PICTURE_SMALL']['SRC'] = $arFileTmp['src'];
							$PROPS_KOMPLECT_EL[$kompl_items]['PREVIEW_PICTURE_SMALL']['WIDTH'] = $arFileTmp['width'];
							$PROPS_KOMPLECT_EL[$kompl_items]['PREVIEW_PICTURE_SMALL']['HEIGHT'] = $arFileTmp['height'];
						} else {
							$arFileTmp = CFile::ResizeImageGet(
									$PROPS_KOMPLECT_EL[$kompl_items]['PREVIEW_PICTURE'],
									array("width" => 170, "height" => 230),
									BX_RESIZE_IMAGE_EXACT,
									true
								);
							$PROPS_KOMPLECT_EL[$kompl_items]['PREVIEW_PICTURE_SMALL']['SRC'] = $arFileTmp['src'];
							$PROPS_KOMPLECT_EL[$kompl_items]['PREVIEW_PICTURE_SMALL']['WIDTH'] = $arFileTmp['width'];
							$PROPS_KOMPLECT_EL[$kompl_items]['PREVIEW_PICTURE_SMALL']['HEIGHT'] = $arFileTmp['height'];
						}
						?>
						<?if (strpos($PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL'], $lang) === false)// перевіряємо чи є lang у адресі сторінки
						{

							if ((strpos($PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL'], '/ua/') === true)&&(LANGUAGE_ID !== "ua")){
								$PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL'] = str_replace ( '/ua/', '/'.LANGUAGE_ID.'/', $PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL']);
							}elseif ((strpos($PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL'], '/ru/') !== false)&&(LANGUAGE_ID !== "ru")){
								$PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL'] = str_replace ( '/ru/', '/'.LANGUAGE_ID.'/', $PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL']);
							}elseif ((strpos($PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL'], '/en/') !== false)&&(LANGUAGE_ID !== "en")){
								$PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL'] = str_replace ( '/en/', '/'.LANGUAGE_ID.'/', $PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL']);
							}
						}?>
					
						<?if ($PROPS_KOMPLECT_EL[$kompl_items]['ACTIVE'] == 'Y'){?>
							<div class="row tovar_capsuli" id="<?=$PROPS_KOMPLECT_EL[$kompl_items]['ID']?>">
								<div class="col-xs-2">
									<a  target="_blank" href="<?=$PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL']?>">
										<?if ($PROPS_KOMPLECT_EL[$kompl_items]['PREVIEW_PICTURE_SMALL']['SRC'] != ''){?>
											<img class="el_caps" alt="<?=$PROPS_KOMPLECT_EL[$kompl_items]['name_'.LANGUAGE_ID]?>" src="<?=$PROPS_KOMPLECT_EL[$kompl_items]['PREVIEW_PICTURE_SMALL']['SRC']?>" title="<?=$PROPS_KOMPLECT_EL[$kompl_items]['name_'.LANGUAGE_ID]?>">
										<?} else {?>
											<img class="el_caps" alt="<?=$PROPS_KOMPLECT_EL[$kompl_items]['name_'.LANGUAGE_ID]?>" src="<?=$templateFolder?>/images/no_photo.png" title="<?=$PROPS_KOMPLECT_EL[$kompl_items]['name_'.LANGUAGE_ID]?>">
											
										<?}?>
									</a>
								</div>
								<div class="col-xs-3 text-center">
									<a  target="_blank" href="<?=$PROPS_KOMPLECT_EL[$kompl_items]['DETAIL_PAGE_URL']?>">
										<?=$PROPS_KOMPLECT_EL[$kompl_items]['name_'.LANGUAGE_ID]?>
									</a>
								</div>
								<div class="col-xs-4">
									<?
									$resOffersList = CCatalogSKU::getOffersList(
											$PROPS_KOMPLECT_EL[$kompl_items]['ID'], 
											$arResult["IBLOCK_ID"], 
											array('ACTIVE' => 'Y'),
											array('ID', 'IBLOCK_ID'),
											array('ID' => array('46'))
									 );
									$PROPS_KOMPLECT_EL[$kompl_items]['OFFERS']=$resOffersList[$PROPS_KOMPLECT_EL[$kompl_items]['ID']];
									?>
									<ul class="product-item-scu-item-list">
										<?foreach ($resOffersList[$PROPS_KOMPLECT_EL[$kompl_items]['ID']] as $kompl_items_offer){
											$PROPS_KOMPLECT_EL[$kompl_items]['OFFERS'][$kompl_items_offer['ID']]['BASE_PRICE'] = CPrice::GetBasePrice($kompl_items_offer['ID']);
											//отримуєм ціну та кількість
											
						if(!$PROPS_KOMPLECT_EL[$kompl_items]['OFFERS'][$kompl_items_offer['ID']]['BASE_PRICE']['PRODUCT_QUANTITY'] || $PROPS_KOMPLECT_EL[$kompl_items]['OFFERS'][$kompl_items_offer['ID']]['BASE_PRICE']['PRODUCT_QUANTITY'] < 1){
							//якщо кількість тп меньше нуля	?>
							<li class="product-item-scu-item-text-container notallowed">
								<div class="product-item-scu-item-text-block">
									<div class="product-item-scu-item-text">
										<?=$kompl_items_offer['PROPERTIES']['size']['VALUE']?>
									</div>
								</div>	
							</li>
						<?} else {?>
							<li class="product-item-scu-item-text-container" title="<?=$kompl_items_offer['PROPERTIES']['size']['VALUE']?>">
								<div class="product-item-scu-item-text-block">
									<div class="product-item-scu-item-text" id="<?=$kompl_items_offer['ID']?>" data-quantiti="<?=$PROPS_KOMPLECT_EL[$kompl_items]['OFFERS'][$kompl_items_offer['ID']]['BASE_PRICE']['PRODUCT_QUANTITY']?>" data-price="<?=$PROPS_KOMPLECT_EL[$kompl_items]['OFFERS'][$kompl_items_offer['ID']]['BASE_PRICE']['PRICE']?>"><?=$kompl_items_offer['PROPERTIES']['size']['VALUE']?></div>
								</div>	
							</li>	
										
							<?	} //end перевірка на кількість
										}	//end foreach $kompl_items_offer
										?>
									</ul>
								</div>
								<div class="col-xs-3 text-center" data-price='price'>
								</div>
							</div>

						<?}?>
					<?}?>
				</div>

				<div class="row" id="pidsumok_capsula">
					<div class='col-xs-9 razom text-right'>
						<?=GetMessage("MESS_OFFERS_CAPSULA_PRICE")?>
					</div>
					<div class='col-xs-3 text-center' id='pidsumok_razom'>
						0 Грн.
					</div>
					<div class='col-xs-9 znizhka text-right'>
						<?=GetMessage("MESS_OFFERS_CAPSULA_ZNIZHKA")?>
					</div>
					<div class='col-xs-3 text-center' id='pidsumok_znizhka'>
						30 %						
					</div>
					<div class='col-xs-9 suma text-right'>
						<?=GetMessage("MESS_OFFERS_CAPSULA_SUMA")?>
					</div>
					<div class='col-xs-3 text-center' id='pidsumok_suma'>
						0 Грн.
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-5 col-md-4 pull-right">
						<div class="cs-buy-button-disable">
							<div class="product-item-detail-info-container">
								<a class="btn product-item-detail-buy-button" id="<?=$itemIds['ADD_BASKET_LINK'];?>"
									href="javascript:void(0);">
									<img src="<?=$templateFolder?>/images/basket.png">
									<span><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<?
				$currenciFormat = array_shift($arResult['CURRENCIES']);
		 		$currenciFormat = $currenciFormat['FORMAT']['FORMAT_STRING'];
		 		?>
			<?}?>
		<?}
		/* end block capsula */?>
		
	</div>

			
	<div class="col-xs-12 col-sm-4 cat_block-right">
				<div class="info-block">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"COMPOSITE_FRAME_MODE" => "A",
							"COMPOSITE_FRAME_TYPE" => "AUTO",
							"EDIT_TEMPLATE" => "",
							"PATH" => $lang."catalog/info.php"
						),
					false,
					Array(
						'ACTIVE_COMPONENT' => 'Y'
					)
					);?>
				</div>

				<?$APPLICATION->IncludeComponent(
					"api:reviews", 
					"detail_el_catalog", 
					array(
						"CACHE_TIME" => "31536000",
						"CACHE_TYPE" => "A",
						"COLOR" => "black1",
						"COMPONENT_TEMPLATE" => "detail_el_catalog",
						"DETAIL_HASH" => "",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"ELEMENT_ID" => $arResult["ID"],
						"EMAIL_TO" => "",
						"FORM_CITY_VIEW" => "N",
						"FORM_DELIVERY" => array(
						),
						"FORM_DISPLAY_FIELDS" => array(
							0 => "RATING",
							1 => "ANNOTATION",
							2 => "GUEST_NAME",
							3 => "GUEST_EMAIL",
						),
						"FORM_FORM_SUBTITLE" => "",
						"FORM_FORM_TITLE" => GetMessage("FORM_FORM_TITLE"),
						"FORM_MESS_ADD_REVIEW_ERROR" => GetMessage("FORM_MESS_ADD_REVIEW_ERROR"),
						"FORM_MESS_ADD_REVIEW_EVENT_TEXT" => GetMessage("FORM_MESS_ADD_REVIEW_EVENT_TEXT"),
						"FORM_MESS_ADD_REVIEW_EVENT_THEME" => GetMessage("FORM_MESS_ADD_REVIEW_EVENT_THEME"),
						"FORM_MESS_ADD_REVIEW_MODERATION" => GetMessage("FORM_MESS_ADD_REVIEW_MODERATION"),
						"FORM_MESS_ADD_REVIEW_VIZIBLE" => GetMessage("FORM_MESS_ADD_REVIEW_VIZIBLE"),
						"FORM_MESS_EULA" => GetMessage("FORM_MESS_EULA"),
						"FORM_MESS_EULA_CONFIRM" => GetMessage("FORM_MESS_EULA_CONFIRM"),
						"FORM_MESS_PRIVACY" => GetMessage("FORM_MESS_PRIVACY"),
						"FORM_MESS_PRIVACY_CONFIRM" => GetMessage("FORM_MESS_PRIVACY_CONFIRM"),
						"FORM_MESS_PRIVACY_LINK" => "",
						"FORM_MESS_STAR_RATING_1" => GetMessage("FORM_MESS_STAR_RATING_1"),
						"FORM_MESS_STAR_RATING_2" => GetMessage("FORM_MESS_STAR_RATING_2"),
						"FORM_MESS_STAR_RATING_3" => GetMessage("FORM_MESS_STAR_RATING_3"),
						"FORM_MESS_STAR_RATING_4" => GetMessage("FORM_MESS_STAR_RATING_4"),
						"FORM_MESS_STAR_RATING_5" => GetMessage("FORM_MESS_STAR_RATING_5"),
						"FORM_PREMODERATION" => "Y",
						"FORM_REQUIRED_FIELDS" => array(
							0 => "RATING",
							1 => "ANNOTATION",
							2 => "GUEST_NAME",
							3 => "GUEST_EMAIL",
						),
						"FORM_RULES_LINK" => "",
						"FORM_RULES_TEXT" => GetMessage("FORM_RULES_TEXT"),
						"FORM_SHOP_BTN_TEXT" => GetMessage("FORM_SHOP_BTN_TEXT"),
						"FORM_SHOP_TEXT" => "",
						"FORM_USE_EULA" => "N",
						"FORM_USE_PRIVACY" => "N",
						"IBLOCK_ID" => "",
						"INCLUDE_CSS" => "Y",
						"INCLUDE_JQUERY" => "N",
						"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
						"LIST_ITEMS_LIMIT" => "10",
						"LIST_MESS_ADD_UNSWER_EVENT_TEXT" => GetMessage("LIST_MESS_ADD_UNSWER_EVENT_TEXT"),
						"LIST_MESS_ADD_UNSWER_EVENT_THEME" => GetMessage("LIST_MESS_ADD_UNSWER_EVENT_THEME"),
						"LIST_MESS_HELPFUL_REVIEW" => GetMessage("LIST_MESS_HELPFUL_REVIEW"),
						"LIST_MESS_TRUE_BUYER" => GetMessage("LIST_MESS_TRUE_BUYER"),
						"LIST_SET_TITLE" => "N",
						"LIST_SHOP_NAME_REPLY" => GetMessage("LIST_SHOP_NAME_REPLY"),
						"LIST_SHOW_THUMBS" => "N",
						"LIST_SORT_FIELDS" => array(
						),
						"LIST_SORT_FIELD_1" => "ACTIVE_FROM",
						"LIST_SORT_FIELD_2" => "DATE_CREATE",
						"LIST_SORT_FIELD_3" => "ID",
						"LIST_SORT_ORDER_1" => "DESC",
						"LIST_SORT_ORDER_2" => "DESC",
						"LIST_SORT_ORDER_3" => "DESC",
						"MESSAGE_404" => "",
						"PAGER_DESC_NUMBERING" => "Y",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "31536000",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_THEME" => "blue",
						"PAGER_TITLE" => GetMessage("PAGER_TITLE"),
						"PICTURE" => array(
						),
						"RESIZE_PICTURE" => "48x48",
						"SECTION_ID" => "",
						"SEF_MODE" => "N",
						"SET_STATUS_404" => "N",
						"SHOP_NAME" => "",
						"SHOW_404" => "N",
						"STAT_MESS_CUSTOMER_RATING" => GetMessage("STAT_MESS_CUSTOMER_RATING"),
						"STAT_MESS_CUSTOMER_REVIEWS" => GetMessage("STAT_MESS_CUSTOMER_REVIEWS"),
						"STAT_MESS_TOTAL_RATING" => GetMessage("STAT_MESS_TOTAL_RATING"),
						"STAT_MIN_AVERAGE_RATING" => "5",
						"THEME" => "flat",
						"THUMBNAIL_HEIGHT" => "72",
						"THUMBNAIL_WIDTH" => "114",
						"UPLOAD_FILE_LIMIT" => "2",
						"UPLOAD_FILE_SIZE" => "1M",
						"UPLOAD_FILE_TYPE" => "jpg, gif, bmp, png, jpeg",
						"UPLOAD_VIDEO_LIMIT" => "1",
						"URL" => "",
						"USE_FORM_MESS_FIELD_PLACEHOLDER" => "Y",
						"USE_MESS_FIELD_NAME" => "Y",
						"USE_STAT" => "Y",
						"USE_SUBSCRIBE" => "N",
						"USE_USER" => "Y",
						"FORM_MESS_FIELD_PLACEHOLDER_RATING" => GetMessage("FORM_MESS_FIELD_PLACEHOLDER_RATING"),
						"FORM_MESS_FIELD_PLACEHOLDER_ORDER_ID" => "",
						"FORM_MESS_FIELD_PLACEHOLDER_TITLE" => GetMessage("FORM_MESS_FIELD_PLACEHOLDER_TITLE"),
						"FORM_MESS_FIELD_PLACEHOLDER_COMPANY" => "",
						"FORM_MESS_FIELD_PLACEHOLDER_WEBSITE" => "",
						"FORM_MESS_FIELD_PLACEHOLDER_ADVANTAGE" => GetMessage("FORM_MESS_FIELD_PLACEHOLDER_ADVANTAGE"),
						"FORM_MESS_FIELD_PLACEHOLDER_DISADVANTAGE" => GetMessage("FORM_MESS_FIELD_PLACEHOLDER_ANNOTATION"),
						"FORM_MESS_FIELD_PLACEHOLDER_ANNOTATION" => GetMessage("FORM_MESS_FIELD_PLACEHOLDER_ANNOTATION"),
						"FORM_MESS_FIELD_PLACEHOLDER_FILES" => "",
						"FORM_MESS_FIELD_PLACEHOLDER_VIDEOS" => "",
						"FORM_MESS_FIELD_PLACEHOLDER_DELIVERY" => "",
						"FORM_MESS_FIELD_PLACEHOLDER_GUEST_NAME" => GetMessage("FORM_MESS_FIELD_PLACEHOLDER_GUEST_NAME"),
						"FORM_MESS_FIELD_PLACEHOLDER_GUEST_EMAIL" => GetMessage("FORM_MESS_FIELD_PLACEHOLDER_GUEST_EMAIL"),
						"FORM_MESS_FIELD_PLACEHOLDER_GUEST_PHONE" => GetMessage("FORM_MESS_FIELD_PLACEHOLDER_GUEST_PHONE"),
						"FORM_MESS_FIELD_PLACEHOLDER_CITY" => "",
						"SUBSCRIBE_AJAX_URL" => "/bitrix/components/api/reviews.subscribe/ajax.php",
						"MESS_SUBSCRIBE_LINK" => GetMessage("MESS_SUBSCRIBE_LINK"),
						"MESS_SUBSCRIBE_FIELD_PLACEHOLDER" => GetMessage("MESS_SUBSCRIBE_FIELD_PLACEHOLDER"),
						"MESS_SUBSCRIBE_BUTTON_TEXT" => GetMessage("MESS_SUBSCRIBE_BUTTON_TEXT"),
						"MESS_SUBSCRIBE_SUBSCRIBE" => GetMessage("MESS_SUBSCRIBE_SUBSCRIBE"),
						"MESS_SUBSCRIBE_UNSUBSCRIBE" => GetMessage("MESS_SUBSCRIBE_UNSUBSCRIBE"),
						"MESS_SUBSCRIBE_ERROR" => GetMessage("MESS_SUBSCRIBE_ERROR"),
						"MESS_SUBSCRIBE_ERROR_EMAIL" => GetMessage("MESS_SUBSCRIBE_ERROR_EMAIL"),
						"MESS_SUBSCRIBE_ERROR_CHECK_EMAIL" => GetMessage("MESS_SUBSCRIBE_ERROR_CHECK_EMAIL"),
						"MESS_FIELD_NAME_RATING" => GetMessage("MESS_FIELD_NAME_RATING"),
						"MESS_FIELD_NAME_ORDER_ID" => GetMessage("MESS_FIELD_NAME_ORDER_ID"),
						"MESS_FIELD_NAME_TITLE" => GetMessage("MESS_FIELD_NAME_TITLE"),
						"MESS_FIELD_NAME_COMPANY" => GetMessage("MESS_FIELD_NAME_COMPANY"),
						"MESS_FIELD_NAME_WEBSITE" => "",
						"MESS_FIELD_NAME_ADVANTAGE" => GetMessage("MESS_FIELD_NAME_ADVANTAGE"),
						"MESS_FIELD_NAME_DISADVANTAGE" => GetMessage("MESS_FIELD_NAME_DISADVANTAGE"),
						"MESS_FIELD_NAME_ANNOTATION" => GetMessage("MESS_FIELD_NAME_ANNOTATION"),
						"MESS_FIELD_NAME_FILES" => "",
						"MESS_FIELD_NAME_VIDEOS" => "",
						"MESS_FIELD_NAME_DELIVERY" => "",
						"MESS_FIELD_NAME_GUEST_NAME" => "Имя гостя",
						"MESS_FIELD_NAME_GUEST_EMAIL" => "E-mail гостя",
						"MESS_FIELD_NAME_GUEST_PHONE" => "Телефон гостя",
						"MESS_FIELD_NAME_CITY" => "",
						"VARIABLE_ALIASES" => array(
							"review_id" => "review_id",
							"user_id" => "user_id",
						)
					),
					false
				);
				 ?>
					
		</div>
	
	</div>

			
		<div class="row">
			<div class="col-xs-12">
				<?
				if ($arResult['CATALOG'] && $actualItem['CAN_BUY'] && \Bitrix\Main\ModuleManager::isModuleInstalled('sale'))
				{
					$APPLICATION->IncludeComponent(
						'bitrix:sale.prediction.product.detail',
						'.default',
						array(
							'BUTTON_ID' => $showBuyBtn ? $itemIds['BUY_LINK'] : $itemIds['ADD_BASKET_LINK'],
							'POTENTIAL_PRODUCT_TO_BUY' => array(
								'ID' => isset($arResult['ID']) ? $arResult['ID'] : null,
								'MODULE' => isset($arResult['MODULE']) ? $arResult['MODULE'] : 'catalog',
								'PRODUCT_PROVIDER_CLASS' => isset($arResult['PRODUCT_PROVIDER_CLASS']) ? $arResult['PRODUCT_PROVIDER_CLASS'] : 'CCatalogProductProvider',
								'QUANTITY' => isset($arResult['QUANTITY']) ? $arResult['QUANTITY'] : null,
								'IBLOCK_ID' => isset($arResult['IBLOCK_ID']) ? $arResult['IBLOCK_ID'] : null,

								'PRIMARY_OFFER_ID' => isset($arResult['OFFERS'][0]['ID']) ? $arResult['OFFERS'][0]['ID'] : null,
								'SECTION' => array(
									'ID' => isset($arResult['SECTION']['ID']) ? $arResult['SECTION']['ID'] : null,
									'IBLOCK_ID' => isset($arResult['SECTION']['IBLOCK_ID']) ? $arResult['SECTION']['IBLOCK_ID'] : null,
									'LEFT_MARGIN' => isset($arResult['SECTION']['LEFT_MARGIN']) ? $arResult['SECTION']['LEFT_MARGIN'] : null,
									'RIGHT_MARGIN' => isset($arResult['SECTION']['RIGHT_MARGIN']) ? $arResult['SECTION']['RIGHT_MARGIN'] : null,
								),
							)
						),
						$component,
						array('HIDE_ICONS' => 'Y')
					);
				}

				if ($arResult['CATALOG'] && $arParams['USE_GIFTS_DETAIL'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled('sale'))
				{
					?>
					<div data-entity="parent-container">
						<?
						if (!isset($arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE']) || $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'] !== 'Y')
						{
							?>
							<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
								<?=($arParams['GIFTS_DETAIL_BLOCK_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_GIFT_BLOCK_TITLE_DEFAULT'))?>
							</div>
							<!-- update- 000 -->
							<?
						}

						CBitrixComponent::includeComponentClass('bitrix:sale.products.gift');
						$APPLICATION->IncludeComponent(
							'bitrix:sale.products.gift',
							'.default',
							array(
								'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
								'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],

								'PRODUCT_ROW_VARIANTS' => "",
								'PAGE_ELEMENT_COUNT' => 0,
								'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
									SaleProductsGiftComponent::predictRowVariants(
										$arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
										$arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT']
									)
								),
								'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],

								'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
								'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
								'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
								'PRODUCT_DISPLAY_MODE' => 'Y',
								'PRODUCT_BLOCKS_ORDER' => $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'],
								'SHOW_SLIDER' => $arParams['GIFTS_SHOW_SLIDER'],
								'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
								'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',

								'TEXT_LABEL_GIFT' => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],

								'LABEL_PROP_'.$arParams['IBLOCK_ID'] => array(),
								'LABEL_PROP_MOBILE_'.$arParams['IBLOCK_ID'] => array(),
								'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

								'ADD_TO_BASKET_ACTION' => (isset($arParams['ADD_TO_BASKET_ACTION']) ? $arParams['ADD_TO_BASKET_ACTION'] : ''),
								'MESS_BTN_BUY' => $arParams['~GIFTS_MESS_BTN_BUY'],
								'MESS_BTN_ADD_TO_BASKET' => $arParams['~GIFTS_MESS_BTN_BUY'],
								'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
								'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],

								'SHOW_PRODUCTS_'.$arParams['IBLOCK_ID'] => 'Y',
								'PROPERTY_CODE_'.$arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE'],
								'PROPERTY_CODE_MOBILE'.$arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE_MOBILE'],
								'PROPERTY_CODE_'.$arResult['OFFERS_IBLOCK'] => $arParams['OFFER_TREE_PROPS'],
								'OFFER_TREE_PROPS_'.$arResult['OFFERS_IBLOCK'] => $arParams['OFFER_TREE_PROPS'],
								'CART_PROPERTIES_'.$arResult['OFFERS_IBLOCK'] => $arParams['OFFERS_CART_PROPERTIES'],
								'ADDITIONAL_PICT_PROP_'.$arParams['IBLOCK_ID'] => (isset($arParams['ADD_PICT_PROP']) ? $arParams['ADD_PICT_PROP'] : ''),
								'ADDITIONAL_PICT_PROP_'.$arResult['OFFERS_IBLOCK'] => (isset($arParams['OFFER_ADD_PICT_PROP']) ? $arParams['OFFER_ADD_PICT_PROP'] : ''),

								'HIDE_NOT_AVAILABLE' => 'Y',
								'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',
								'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
								'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
								'PRICE_CODE' => $arParams['PRICE_CODE'],
								'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
								'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
								'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
								'BASKET_URL' => $arParams['BASKET_URL'],
								'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
								'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
								'PARTIAL_PRODUCT_PROPERTIES' => $arParams['PARTIAL_PRODUCT_PROPERTIES'],
								'USE_PRODUCT_QUANTITY' => 'N',
								'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
								'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
								'POTENTIAL_PRODUCT_TO_BUY' => array(
									'ID' => isset($arResult['ID']) ? $arResult['ID'] : null,
									'MODULE' => isset($arResult['MODULE']) ? $arResult['MODULE'] : 'catalog',
									'PRODUCT_PROVIDER_CLASS' => isset($arResult['PRODUCT_PROVIDER_CLASS']) ? $arResult['PRODUCT_PROVIDER_CLASS'] : 'CCatalogProductProvider',
									'QUANTITY' => isset($arResult['QUANTITY']) ? $arResult['QUANTITY'] : null,
									'IBLOCK_ID' => isset($arResult['IBLOCK_ID']) ? $arResult['IBLOCK_ID'] : null,

									'PRIMARY_OFFER_ID' => isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'])
										? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID']
										: null,
									'SECTION' => array(
										'ID' => isset($arResult['SECTION']['ID']) ? $arResult['SECTION']['ID'] : null,
										'IBLOCK_ID' => isset($arResult['SECTION']['IBLOCK_ID']) ? $arResult['SECTION']['IBLOCK_ID'] : null,
										'LEFT_MARGIN' => isset($arResult['SECTION']['LEFT_MARGIN']) ? $arResult['SECTION']['LEFT_MARGIN'] : null,
										'RIGHT_MARGIN' => isset($arResult['SECTION']['RIGHT_MARGIN']) ? $arResult['SECTION']['RIGHT_MARGIN'] : null,
									),
								),

								'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
								'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
								'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
							),
							$component,
							array('HIDE_ICONS' => 'Y')
						);
						?>
					</div>
					<?
				}

				if ($arResult['CATALOG'] && $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled('sale'))
				{
					?>
					<div data-entity="parent-container">
						<?
						if (!isset($arParams['GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE']) || $arParams['GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE'] !== 'Y')
						{
							?>
							<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
								<?=($arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_GIFTS_MAIN_BLOCK_TITLE_DEFAULT'))?>
							</div>
							<!-- update- 111 -->
							<?
						}

						$APPLICATION->IncludeComponent(
							'bitrix:sale.gift.main.products',
							'.default',
							array(
								'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
								'LINE_ELEMENT_COUNT' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
								'HIDE_BLOCK_TITLE' => 'Y',
								'BLOCK_TITLE' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],

								'OFFERS_FIELD_CODE' => $arParams['OFFERS_FIELD_CODE'],
								'OFFERS_PROPERTY_CODE' => $arParams['OFFERS_PROPERTY_CODE'],

								'AJAX_MODE' => $arParams['AJAX_MODE'],
								'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
								'IBLOCK_ID' => $arParams['IBLOCK_ID'],

								'ELEMENT_SORT_FIELD' => 'ID',
								'ELEMENT_SORT_ORDER' => 'DESC',
								//'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
								//'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],
								'FILTER_NAME' => 'searchFilter',
								'SECTION_URL' => $arParams['SECTION_URL'],
								'DETAIL_URL' => $arParams['DETAIL_URL'],
								'BASKET_URL' => $arParams['BASKET_URL'],
								'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
								'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
								'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],

								'CACHE_TYPE' => $arParams['CACHE_TYPE'],
								'CACHE_TIME' => $arParams['CACHE_TIME'],

								'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
								'SET_TITLE' => $arParams['SET_TITLE'],
								'PROPERTY_CODE' => $arParams['PROPERTY_CODE'],
								'PRICE_CODE' => $arParams['PRICE_CODE'],
								'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
								'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],

								'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
								'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
								'CURRENCY_ID' => $arParams['CURRENCY_ID'],
								'HIDE_NOT_AVAILABLE' => 'Y',
								'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',
								'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
								'PRODUCT_BLOCKS_ORDER' => $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'],

								'SHOW_SLIDER' => $arParams['GIFTS_SHOW_SLIDER'],
								'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
								'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',

								'ADD_PICT_PROP' => (isset($arParams['ADD_PICT_PROP']) ? $arParams['ADD_PICT_PROP'] : ''),
								'LABEL_PROP' => (isset($arParams['LABEL_PROP']) ? $arParams['LABEL_PROP'] : ''),
								'LABEL_PROP_MOBILE' => (isset($arParams['LABEL_PROP_MOBILE']) ? $arParams['LABEL_PROP_MOBILE'] : ''),
								'LABEL_PROP_POSITION' => (isset($arParams['LABEL_PROP_POSITION']) ? $arParams['LABEL_PROP_POSITION'] : ''),
								'OFFER_ADD_PICT_PROP' => (isset($arParams['OFFER_ADD_PICT_PROP']) ? $arParams['OFFER_ADD_PICT_PROP'] : ''),
								'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : ''),
								'SHOW_DISCOUNT_PERCENT' => (isset($arParams['SHOW_DISCOUNT_PERCENT']) ? $arParams['SHOW_DISCOUNT_PERCENT'] : ''),
								'DISCOUNT_PERCENT_POSITION' => (isset($arParams['DISCOUNT_PERCENT_POSITION']) ? $arParams['DISCOUNT_PERCENT_POSITION'] : ''),
								'SHOW_OLD_PRICE' => (isset($arParams['SHOW_OLD_PRICE']) ? $arParams['SHOW_OLD_PRICE'] : ''),
								'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
								'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
								'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
								'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
								'ADD_TO_BASKET_ACTION' => (isset($arParams['ADD_TO_BASKET_ACTION']) ? $arParams['ADD_TO_BASKET_ACTION'] : ''),
								'SHOW_CLOSE_POPUP' => (isset($arParams['SHOW_CLOSE_POPUP']) ? $arParams['SHOW_CLOSE_POPUP'] : ''),
								'DISPLAY_COMPARE' => (isset($arParams['DISPLAY_COMPARE']) ? $arParams['DISPLAY_COMPARE'] : ''),
								'COMPARE_PATH' => (isset($arParams['COMPARE_PATH']) ? $arParams['COMPARE_PATH'] : ''),
							)
							+ array(
								'OFFER_ID' => empty($arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'])
									? $arResult['ID']
									: $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'],
								'SECTION_ID' => $arResult['SECTION']['ID'],
								'ELEMENT_ID' => $arResult['ID'],

								'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
								'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
								'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
							),
							$component,
							array('HIDE_ICONS' => 'Y')
						);
						?>
					</div>
					<?
				}
				?>
			</div>

			
</div>
	<!--Small Card-->
	<?/*?>
	<!--div class="product-item-detail-short-card-fixed hidden-xs" id="<?=$itemIds['SMALL_CARD_PANEL_ID']?>">
		<div class="product-item-detail-short-card-content-container">
			<table>
				<tr>
					<td rowspan="2" class="product-item-detail-short-card-image">
						<img src="" style="height: 65px;" data-entity="panel-picture">
					</td>
					<td class="product-item-detail-short-title-container" data-entity="panel-title">
						<span class="product-item-detail-short-title-text"><?=$name?></span>
					</td>
					<td rowspan="2" class="product-item-detail-short-card-price">
						<?
						if ($arParams['SHOW_OLD_PRICE'] === 'Y')
						{
							?>
							<div class="product-item-detail-price-old" style="display: <?=($showDiscount ? '' : 'none')?>;"
								data-entity="panel-old-price">
								<?=($showDiscount ? $price['PRINT_RATIO_BASE_PRICE'] : '')?>
							</div>
							<?
						}
						?>
						<div class="product-item-detail-price-current" data-entity="panel-price">
							<?=$price['PRINT_RATIO_PRICE']?>
						</div>
					</td>
					<?
					if ($showAddBtn)
					{
						?>
						<td rowspan="2" class="product-item-detail-short-card-btn"
							style="display: <?=($actualItem['CAN_BUY'] ? '' : 'none')?>;"
							data-entity="panel-add-button">
							<a class="btn <?=$showButtonClassName?> product-item-detail-buy-button"
								id="<?=$itemIds['ADD_BASKET_LINK']?>"
								href="javascript:void(0);">
								<span><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></span>
							</a>
						</td>
						<?
					}

					if ($showBuyBtn)
					{
						?>
						<td rowspan="2" class="product-item-detail-short-card-btn"
							style="display: <?=($actualItem['CAN_BUY'] ? '' : 'none')?>;"
							data-entity="panel-buy-button">
							<a class="btn <?=$buyButtonClassName?> product-item-detail-buy-button" id="<?=$itemIds['BUY_LINK']?>"
								href="javascript:void(0);">
								<span><?=$arParams['MESS_BTN_BUY']?></span>
							</a>
						</td>
						<?
					}
					?>
					<td rowspan="2" class="product-item-detail-short-card-btn"
						style="display: <?=(!$actualItem['CAN_BUY'] ? '' : 'none')?>;"
						data-entity="panel-not-available-button">
						<a class="btn btn-link product-item-detail-buy-button" href="javascript:void(0)"
							rel="nofollow">
							<?=$arParams['MESS_NOT_AVAILABLE']?>
						</a>
					</td>
				</tr>
				<?
				if ($haveOffers)
				{
					?>
					<tr>
						<td>
							<div class="product-item-selected-scu-container" data-entity="panel-sku-container">
								<?
								$i = 0;

								foreach ($arResult['SKU_PROPS'] as $skuProperty)
								{
									if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
									{
										continue;
									}

									$propertyId = $skuProperty['ID'];

									foreach ($skuProperty['VALUES'] as $value)
									{
										$value['NAME'] = htmlspecialcharsbx($value['NAME']);
										if ($skuProperty['SHOW_MODE'] === 'PICT')
										{
											?>
											<div class="product-item-selected-scu product-item-selected-scu-color selected"
												title="<?=$value['NAME']?>"
												style="background-image: url(<?=$value['PICT']['SRC']?>); display: none;"
												data-sku-line="<?=$i?>"
												data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
												data-onevalue="<?=$value['ID']?>">
											</div>
											<?
										}
										else
										{
											?>
											<div class="product-item-selected-scu product-item-selected-scu-text selected"
												title="<?=$value['NAME']?>"
												style="display: none;"
												data-sku-line="<?=$i?>"
												data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
												data-onevalue="<?=$value['ID']?>">
												<?=$value['NAME']?>
											</div>
											<?
										}
									}

									$i++;
								}
								?>
							</div>
						</td>
					</tr>
					<?
				}
				?>
			</table>
		</div>
	</div-->
	<!--Top tabs-->
	<!--div class="product-item-detail-tabs-container-fixed hidden-xs" id="<?=$itemIds['TABS_PANEL_ID']?>">
		<ul class="product-item-detail-tabs-list">
			<?
			if ($showDescription)
			{
				?>
				<li class="product-item-detail-tab active" data-entity="tab" data-value="description">
					<a href="javascript:void(0);" class="product-item-detail-tab-link">
						<span><?=$arParams['MESS_DESCRIPTION_TAB']?></span>
					</a>
				</li>
				<?
			}

			if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
			{
				?>
				<li class="product-item-detail-tab" data-entity="tab" data-value="properties">
					<a href="javascript:void(0);" class="product-item-detail-tab-link">
						<span><?=$arParams['MESS_PROPERTIES_TAB']?></span>
					</a>
				</li>
				<?
			}

			if ($arParams['USE_COMMENTS'] === 'Y')
			{
				?>
				<li class="product-item-detail-tab" data-entity="tab" data-value="comments">
					<a href="javascript:void(0);" class="product-item-detail-tab-link">
						<span><?=$arParams['MESS_COMMENTS_TAB']?></span>
					</a>
				</li>
				<?
			}
			?>
		</ul>
	</div-->
	<?/**/?>

	<meta itemprop="name" content="<?=$name?>" />
	<meta itemprop="category" content="<?=$arResult['CATEGORY_PATH']?>" />
	<?
	if ($haveOffers)
	{
		foreach ($arResult['JS_OFFERS'] as $offer)
		{
			$currentOffersList = array();

			if (!empty($offer['TREE']) && is_array($offer['TREE']))
			{
				foreach ($offer['TREE'] as $propName => $skuId)
				{
					$propId = (int)substr($propName, 5);

					foreach ($skuProps as $prop)
					{
						if ($prop['ID'] == $propId)
						{
							foreach ($prop['VALUES'] as $propId => $propValue)
							{
								if ($propId == $skuId)
								{
									$currentOffersList[] = $propValue['NAME'];
									break;
								}
							}
						}
					}
				}
			}

			$offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];
			?>
			<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<meta itemprop="sku" content="<?=htmlspecialcharsbx(implode('/', $currentOffersList))?>" />
				<meta itemprop="price" content="<?=$offerPrice['RATIO_PRICE']?>" />
				<meta itemprop="priceCurrency" content="<?=$offerPrice['CURRENCY']?>" />
				<link itemprop="availability" href="http://schema.org/<?=($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
			</span>
			<?
		}

		unset($offerPrice, $currentOffersList);
	}
	else
	{
		?>
		<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<meta itemprop="price" content="<?=$price['RATIO_PRICE']?>" />
			<meta itemprop="priceCurrency" content="<?=$price['CURRENCY']?>" />
			<link itemprop="availability" href="http://schema.org/<?=($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
		</span>
		<?
	}
	?>
</div>

<?
// update- 
$recommendedList = array();
$recommendedId = $arResult['PROPERTIES']['RECOMMEND']['VALUE'];	
foreach ($recommendedId as $i => $id) {
	$arFilter = Array("IBLOCK_ID"=>$arResult['IBLOCK_ID'], "ID"=>$id);
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
	$res = CCatalogSKU::getOffersList( $id, $arResult['IBLOCK_ID'], array(), array(), array() );
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
	

if ($haveOffers)
{
	$offerIds = array();
	$offerCodes = array();

	$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

	foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer)
	{
		$offerIds[] = (int)$jsOffer['ID'];
		$offerCodes[] = $jsOffer['CODE'];

		$fullOffer = $arResult['OFFERS'][$ind];
		$measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

		$strAllProps = '';
		$strMainProps = '';
		$strPriceRangesRatio = '';
		$strPriceRanges = '';

		if ($arResult['SHOW_OFFERS_PROPS'])
		{
			if (!empty($jsOffer['DISPLAY_PROPERTIES']))
			{
				foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property)
				{
					$current = '<dt>'.$property['NAME'].'</dt><dd>'.(
						is_array($property['VALUE'])
							? implode(' / ', $property['VALUE'])
							: $property['VALUE']
						).'</dd>';
					$strAllProps .= $current;

					if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']]))
					{
						$strMainProps .= $current;
					}
				}

				unset($current);
			}
		}

		if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1)
		{
			$strPriceRangesRatio = '('.Loc::getMessage(
					'CT_BCE_CATALOG_RATIO_PRICE',
					array('#RATIO#' => ($useRatio
							? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
							: '1'
						).' '.$measureName)
				).')';

			foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range)
			{
				if ($range['HASH'] !== 'ZERO-INF')
				{
					$itemPrice = false;

					foreach ($jsOffer['ITEM_PRICES'] as $itemPrice)
					{
						if ($itemPrice['QUANTITY_HASH'] === $range['HASH'])
						{
							break;
						}
					}

					if ($itemPrice)
					{
						$strPriceRanges .= '<dt>'.Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_FROM',
								array('#FROM#' => $range['SORT_FROM'].' '.$measureName)
							).' ';

						if (is_infinite($range['SORT_TO']))
						{
							$strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
						}
						else
						{
							$strPriceRanges .= Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_TO',
								array('#TO#' => $range['SORT_TO'].' '.$measureName)
							);
						}

						$strPriceRanges .= '</dt><dd>'.($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']).'</dd>';
					}
				}
			}

			unset($range, $itemPrice);
		}

		$jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
		$jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
		$jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
		$jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
	}

	$templateData['OFFER_IDS'] = $offerIds;
	$templateData['OFFER_CODES'] = $offerCodes;
	unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'VISUAL' => $itemIds,
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'NAME' => $arResult['~NAME'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $skuProps,
		'BLOCKS_DATA' => array( // update- 
			'KAPSULA_URL' => $templateFolder."/ajax_kapsula.php",
			'RECOMMEND_LIST' => $recommendedList,
			'IMG_BASKET' => $templateFolder."/images/basket.png",
			'IMG_ORDER' => $templateFolder."/images/order-white.png",
			'INFO_TEXT' => $messageInfoText,
			'SUBSCRIBE_HEADER_TEXT' => GetMessage("BTN_MESSAGE_INFORM_DISCOUNT"),
			'CURRENCY' => $currenciFormat,
			'BTN_BUY_ONECLICK' => $itemIds['BTN_BUY_ONECLICK']
		)
	);
}
else
{
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties)
	{
		?>
		<div id="<?=$itemIds['BASKET_PROP_DIV']?>" style="display: none;">
			<?
			if (!empty($arResult['PRODUCT_PROPERTIES_FILL']))
			{
				foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo)
				{
					?>
					<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]" value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
					<?
					unset($arResult['PRODUCT_PROPERTIES'][$propId]);
				}
			}

			$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
			if (!$emptyProductProperties)
			{
				?>
				<table>
					<?
					foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo)
					{
						?>
						<tr>
							<td><?=$arResult['PROPERTIES'][$propId]['NAME']?></td>
							<td>
								<?
								if (
									$arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
									&& $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
								)
								{
									foreach ($propInfo['VALUES'] as $valueId => $value)
									{
										?>
										<label>
											<input type="radio" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]"
												value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? '"checked"' : '')?>>
											<?=$value?>
										</label>
										<br>
										<?
									}
								}
								else
								{
									?>
									<select name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]">
										<?
										foreach ($propInfo['VALUES'] as $valueId => $value)
										{
											?>
											<option value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? '"selected"' : '')?>>
												<?=$value?>
											</option>
											<?
										}
										?>
									</select>
									<?
								}
								?>
							</td>
						</tr>
						<?
					}
					?>
				</table>
				<?
			}
			?>
		</div>
		</div>
		<?
	}

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'VISUAL' => $itemIds,
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'PICT' => reset($arResult['MORE_PHOTO']),
			'NAME' => $arResult['~NAME'],
			'SUBSCRIPTION' => true,
			'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
			'ITEM_PRICES' => $arResult['ITEM_PRICES'],
			'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
			'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
			'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
			'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
			'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
			'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
			'SLIDER' => $arResult['MORE_PHOTO'],
			'CAN_BUY' => $arResult['CAN_BUY'],
			'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
			'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
			'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
			'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'EMPTY_PROPS' => $emptyProductProperties,
			'BASKET_URL' => $arParams['BASKET_URL'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		),
		'BLOCKS_DATA' => array( // update- 			
			'RECOMMEND_LIST' => $recommendedList,
			'IMG_BASKET' => $templateFolder."/images/basket.png",
			'IMG_ORDER' => $templateFolder."/images/order-white.png",
			'INFO_TEXT' => $messageInfoText,
			'SUBSCRIBE_HEADER_TEXT' => GetMessage("BTN_MESSAGE_INFORM_DISCOUNT"),
			'BTN_BUY_ONECLICK' => $itemIds['BTN_BUY_ONECLICK']			
		),
		'KAPSULA' => array(
			'CURRENCY' => $currenciFormat,
			'KAPSULA_URL' => $templateFolder."/ajax_kapsula.php",
			'ACTION' => 'KAPSULA2BASKET',
			'SID' => bitrix_sessid()
		)
	);
	unset($emptyProductProperties);
}

if ($arParams['DISPLAY_COMPARE'])
{
	$jsParams['COMPARE'] = array(
		'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
		'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
		'COMPARE_PATH' => $arParams['COMPARE_PATH']
	);
}
?>
<script>
	BX.message({
		PRODUCT_NAME: '<?=$arResult["NAME"]?>',
		ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
		BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		SITE_ID: '<?=SITE_ID?>',
		TITLE_DISCOUNT: '<?=GetMessage('CT_BCE_CATALOG_MESSAGE_BTN_DISCOUNT')?>'
	});

	var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>

<script type="text/javascript"> <?//для вікна "Таблиця розмірів"?>
	BX.bind( BX('t_rozmir_pidpiska_button'), 'click', function(){
		BX.style(BX('t_rozmir_pidpiska_window_overlay'), 'display', 'block');
		BX.style(BX('t_rozmir_pidpiska_window'), 'display', 'table');
		document.onmousewheel = document.onwheel = function(){ return false; };
	});	
	BX.bind( BX('t_rozmir_pidpiska_window_overlay'), 'click', function(){
		BX.style(BX('t_rozmir_pidpiska_window_overlay'), 'display', 'none');
		BX.style(BX('t_rozmir_pidpiska_window'), 'display', 'none');
		document.onmousewheel = document.onwheel = function(){ return true; };
	});	
</script>
<?if ($arResult["PROPERTIES"]["LINK_YOUTUBE"]["VALUE"]) { ?>
	<script type="text/javascript"> <?//для вікна "YOUTUBE"?>
		BX.bind( BX('info-youtube_button'), 'click', function(){
			BX.style(BX('t_rozmir_pidpiska_window_overlay'), 'display', 'block');
			BX.style(BX('info-youtube_window'), 'display', 'block');
			document.onmousewheel = document.onwheel = function(){ return false; };
		});	
		BX.bind( BX('t_rozmir_pidpiska_window_overlay'), 'click', function(){
			BX.style(BX('t_rozmir_pidpiska_window_overlay'), 'display', 'none');
			BX.style(BX('info-youtube_window'), 'display', 'none');
			document.onmousewheel = document.onwheel = function(){ return true; };
		});	
	</script>
<?}?>
<script type="text/javascript">
       window._pt_lt = new Date().getTime();
       window._pt_sp_2 = [];
       _pt_sp_2.push('setAccount,5ec5180e');
       var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
       (function() {
           var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
           atag.src = _protocol + 'cjs.ptengine.com/pta_en.js';
           var s = document.getElementsByTagName('script')[0];
           s.parentNode.insertBefore(atag, s);
       })();
</script>
<?

unset($actualItem, $itemIds, $jsParams);
?>
