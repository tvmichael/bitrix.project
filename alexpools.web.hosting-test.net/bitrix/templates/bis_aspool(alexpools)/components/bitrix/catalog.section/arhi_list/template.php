<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';}?>

<div class="catalog-section">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<p><?=$arResult["NAV_STRING"]?></p>
<?endif?>
<script>
function buy_item(item_id) {
	var qua=parseInt($("#form_add_"+item_id+" input[name=quantity]").val());
	var old_qua=parseInt($("#form_add_"+item_id+" input[name=old_value]").val());
	var step2=$("#form_add_"+item_id+" input[name=actionADD2BASKET]").hasClass('ittem_added');

	str_query='';
	flag=false;
	if ($("#form_add_"+item_id+" input[name=actionADD2BASKET]").hasClass('ittem_added')) {
		if (qua==old_qua) {
			$("#form_add_"+item_id+" input[name=quantity]").val(1+qua);
			qua=1;str_query='action=add&';
		}
		else if (qua==0) {
			str_query='action=delete&';
			flag=true;
		}
		else {
			str_query='action=update&';
		}
	}
	if (qua==0) {
		qua=1;
		$("#form_add_"+item_id+" input[name=quantity]").val(1);
	}
	str_query+='id='+item_id+'&quantity='+qua;

	$.ajax({url: '/include/change_basket.php',type:'POST',data: str_query,
		success: function(res) {
			if (flag) {
				$("#form_add_"+item_id+" input[name=actionADD2BASKET]").val('Купить');
				$("#form_add_"+item_id+" input[name=actionADD2BASKET]").removeClass('ittem_added');
			}
			else {
				$("#form_add_"+item_id+" input[name=actionADD2BASKET]").val('В корзине');
				$("#form_add_"+item_id+" input[name=actionADD2BASKET]").addClass('ittem_added');
			}
			$("#form_add_"+item_id+" input[name=old_value]").val($("#form_add_"+item_id+" input[name=quantity]").val());
			$('#cart_line').html(res);$('#cart_line2').html(res);

			setDynamicRemarketing(item_id, qua);
		}
	});
}
</script>


<!--<div class="sort">Сортировать по цене: <a href="<?=$APPLICATION->GetCurPageParam ('sort=price&order=desc', array('sort', 'order'))?>" >Цена по убыванию</a> | <a href="<?=$APPLICATION->GetCurPageParam ('sort=price&order=asc', array('sort', 'order'))?>" >Цена по возрастанию</a></div>-->


<p class="sort-block"><span class="sort-title">Сортировать по:</span> 

<a style="padding-right: 20px;" class="sort-name" <?if ($_GET["sort"] == "name"):?> class="actived" <?endif;?> href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=name&method=asc"> 
Названию 
</a> 

<a style="padding-right: 20px;" class="sort-price-up" <?if ($_GET["sort"] == "catalog_PRICE_4"):?> class="actived" <?endif;?> href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=catalog_PRICE_4&method=asc"> 
Цена по возростанию
</a>
<a style="padding-right: 20px;" class="sort-price-dwn" <?if ($_GET["sort"] == "catalog_PRICE_4"):?> class="actived" <?endif;?> href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=catalog_PRICE_4&method=desc"> 
Цена по убыванию
</a>

<!-- a <?if ($_GET["sort"] == "timestamp_x"):?> class="actived" <?endif;?> href="<?=$arResult["SECTION_PAGE_URL"]?>?sort=timestamp_x&method=desc"> 
Новые поступления 
</a --> 

</p>
<!-- FILTER -->

<div id="filter-place"></div>
<!-- FILTER -->

<? 
$arDynamicRemarketing = array(); 
$categoryPath = '';	
$cml2_manufacrurer_remember = '';
$mainId = $this->GetEditAreaId($arResult['ID']);
?>

<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		<?
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		
		$mainId_a = $mainId.'_'.$arElement['ID'].'_a';
		$mainId_img = $mainId.'_'.$arElement['ID'].'_img';

		// получить категорию товара по ID товара
		if($cml2_manufacrurer_remember != $arElement['PROPERTIES']['CML2_MANUFACTURER']['VALUE'])
		{
			$categoryPath = '';
			$rsElement = CIBlockElement::GetList(array(), array('ID'=>$arElement['ID']), false, false, array('IBLOCK_SECTION_ID'));
			if($arElementId = $rsElement->Fetch())
			{	
				$i = 0;		
				$iBlockSectionId = $arElementId["IBLOCK_SECTION_ID"];			
				while ($iBlockSectionId > 0 && $i < 10)
				{
					$res = CIBlockSection::GetByID($iBlockSectionId);
					if($ar_res = $res->GetNext())
					{				
						$categoryPath = $ar_res['NAME'].($i==0?'':'/').$categoryPath;
						$iBlockSectionId = $ar_res["IBLOCK_SECTION_ID"];				
					}    
					$i++;			
				}
			}
			$cml2_manufacrurer_remember = $arElement['PROPERTIES']['CML2_MANUFACTURER']['VALUE'];
		}
		$arDynamicRemarketing[$arElement['ID']] = array(
			"currencyCode" => $arElement['MIN_PRICE']['CURRENCY'],
			'id' => $arElement['ID'],
	        "name" => $arElement['NAME'],
	        "price" => $arElement['MIN_PRICE']['DISCOUNT_VALUE'],
	        "brand" => $arElement['PROPERTIES']['CML2_MANUFACTURER']['VALUE'],
	        "category" => $categoryPath,
	        "quantity" => 1,
	      	'position' => ($cell+1),
	      	'id_a' => $mainId_a,
	      	'id_img' => $mainId_img,
		);
		?>

		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
		<td>
		<?endif;?>

		<table  width="100%" cellspacing="0" cellpadding="0" onmouseover="TdHover(this,&quot;подробнее о товаре...&quot;)" onmouseout="TdNoHover(this,&quot;&quot;)" class="">
   
				<tr>
					<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
						<td style="width: 120px"><div class="framing" style="padding: 12px 0px 12px 0px; width: 120px; height: 90px">
						<a id="<?=$mainId_img;?>" href="javascript:void(0)" data-href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="100%" height="100%" alt="<?=$arElement["PREVIEW_TEXT"]?>" title="<?=$arElement["PREVIEW_TEXT"]?>" /></a>
						</div></td>
					<?elseif(is_array($arElement["DETAIL_PICTURE"])):?>
					<td style="width: 120px"> <div class="framing" style="padding: 12px 0px 12px 0px; width: 100px; /*height: 75px*/">
						<a id="<?=$mainId_img;?>" href="javascript:void(0)" data-href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["DETAIL_PICTURE"]["SRC"]?>" width="100%" height="100%" alt="<?=$arElement["PREVIEW_TEXT"]?>" title="<?=$arElement["PREVIEW_TEXT"]?>" /></a>
						</div></td>
					<?else:?>
					<td style="width: 120px"> <div class="framing" style="padding: 12px 0px 12px 0px; width: 100px; /*height: 75px*/">
						<a href="#"><img border="0" src="/bitrix/templates/bis/images/no-photo.png" width="100%" height="100%" alt="" title="Фотография не доступна" /></a>
						</div></td>
					<?endif?>
					<td  style="vertical-align: top; width: 480px">
						<a id="<?=$mainId_a;?>" style="font-size: 14px" href="javascript:void(0)" data-href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["PREVIEW_TEXT"]?></a><br /><br />
						<?foreach($arElement["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
						 <?if($arProperty["DISPLAY_VALUE"]!=""):?>
						 <?if($arProperty["DISPLAY_VALUE"]!="-"):?>
                           <!-- Add Matrix -->
                           <? if($arProperty["CODE"]!="CML2_ARTICLE"): // не выводить артикл?>
  							<?=$arProperty["NAME"]?>:&nbsp;<?
  								if(is_array($arProperty["DISPLAY_VALUE"])){
  									echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);}
  								else{
  									echo $arProperty["DISPLAY_VALUE"];}?><br />
                          <?else://вывести артикл с боку
                            $PROPERTY_ARTICLE_NAME=$arProperty["NAME"];
                            $PROPERTY_ARTICLE=$arProperty["DISPLAY_VALUE"];
                          ?>
						  <?endif;?>
  						  <?endif;?>
						<?endif;?>
							<?endforeach?>
						<br />
						<?/* =$arElement["PREVIEW_TEXT"] */?>
					</td>
				<td style="vertical-align:top; padding: 0 7px; border-left: 1px dashed #ccc" > <!--ТРЕТИЙ СТОЛБИК НАЧАЛО-->
				<?foreach($arElement["PRODUCT_PROPERTIES"] as $pid => $product_property):?>

						<!-- Вывод свойств-->
						<!--<div class="FORM">

								<?echo $arElement["PROPERTIES"][$pid]["NAME"]?>:
								<?if(
									$arElement["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L"
									&& $arElement["PROPERTIES"][$pid]["LIST_TYPE"] == "C"
								):?>
									<?foreach($product_property["VALUES"] as $k => $v):?>
										<label><input type="radio" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]" value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"checked"'?>><?echo $v?></label><br>
									<?endforeach;?>
								<?else:?>
									<select name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
										<?foreach($product_property["VALUES"] as $k => $v):?>
											<option value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"selected"'?>><?echo $v?></option>
										<?endforeach;?>
									</select>
								<?endif;?>
							</div>   -->
							<!-- Вывод свойств-->
						<?endforeach;?>


				<div class="PRICES">
                <div class="catalog-article"><? echo $PROPERTY_ARTICLE_NAME ?>&nbsp;:&nbsp;<? echo $PROPERTY_ARTICLE ?></div>    <!-- Add Matrix -->
				<?if(is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"])):?>
				<?foreach($arElement["OFFERS"] as $arOffer):?>
					<?foreach($arParams["OFFERS_FIELD_CODE"] as $field_code):?>
						<small><?echo GetMessage("IBLOCK_FIELD_".$field_code)?>:&nbsp;<?
								echo $arOffer[$field_code];?></small><br />
					<?endforeach;?>
					<?foreach($arOffer["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
						<small><?=$arProperty["NAME"]?>:&nbsp;<?
							if(is_array($arProperty["DISPLAY_VALUE"]))
								echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
							else
								echo $arProperty["DISPLAY_VALUE"];?></small><br />
					<?endforeach?>
					<div class="PRICES">
					<?foreach($arOffer["PRICES"] as $code=>$arPrice):?>
						<?if($arPrice["CAN_ACCESS"]):?>
							<p><?/* =$arResult["PRICES"][$code]["TITLE"]; */?><!--:&nbsp;&nbsp; -->
							<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
								<s><span style="color:red;"><?=$arPrice["PRINT_VALUE"]?></span></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
							<?else:?>
								<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span>
							<?endif?>
							</p>
						<?endif;?>
					<?endforeach;?>
					<p>
					<?if($arParams["DISPLAY_COMPARE"]):?>
						<noindex>
						<a href="<?echo $arOffer["COMPARE_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_COMPARE")?></a>&nbsp;
						</noindex>
					<?endif?>
					<?if($arOffer["CAN_BUY"]):?>
						<?if($arParams["USE_PRODUCT_QUANTITY"]):?>
							<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">

							<table border="0" cellspacing="0" cellpadding="2">
								<tr valign="top">
									<td><?echo GetMessage("CT_BCS_QUANTITY")?>:</td>
									<td>
										<input type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" size="5">
									</td>
								</tr>
							</table>
							<input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY">
							<input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arOffer["ID"]?>">
							<!-- <input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>"> -->
							<input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<? echo GetMessage("CATALOG_BUY")/* echo GetMessage("CATALOG_ADD") */?>">
							</form>
						<?else:?>
							<noindex>
							<a href="<?echo $arOffer["BUY_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_BUY")?></a>
							&nbsp;<a href="<?echo $arOffer["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?></a>
							</noindex>
						<?endif;?>
					<?elseif(count($arResult["PRICES"]) > 0):?>
						<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
						<?$APPLICATION->IncludeComponent("bitrix:sale.notice.product", ".default", array(
							"NOTIFY_ID" => $arOffer['ID'],
							"NOTIFY_URL" => htmlspecialcharsback($arOffer["SUBSCRIBE_URL"]),
							"NOTIFY_USE_CAPTHA" => "N"
							),
							$component
						);?>
					<?endif?>
					</p>
						<?endforeach;?>
					<?else:?>

						<?
						if(CSite::InGroup(array(8))):
						$isopt = "Y";
						endif;
						//if($USER->IsAdmin()) {echo '<pre>'; print_r($arPrice['PRICE_ID']); echo '</pre>';}
						 ?>
						<?if($isopt == "Y"):?>
					<?
					$myPriceItem = 0;
					$allPriceItem = 0;
					?>
						<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
						<!--       ЦЕНА ТОВАРА          -->
							<?if($arPrice["CAN_ACCESS"]):?>
								
								<?if($arPrice['PRICE_ID'] < '10'):?>
									<?$allPriceItem = $arPrice["PRINT_VALUE"];?>
								<?else:?>
									<?$myPriceItem = $arPrice["PRINT_VALUE"];?>
								<?endif;?>
							<?endif;?>
						<?endforeach;?>
						<p>
								<?if($myPriceItem != 0):?>
									<s><span><?=$allPriceItem?></span></s> 
									<span class="catalog-price_1"><?=$myPriceItem?></span>
								<?else:?>
									<span class="catalog-price"><?=$allPriceItem?></span>
								<?endif;?>
						</p>
					<?else:?>
						<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
						<!--       ЦЕНА ТОВАРА          -->
							<?if($arPrice["CAN_ACCESS"]):?>
								<p>
								<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
									<s><span><?=$arPrice["PRINT_VALUE"]?></span></s> 
									<span class="catalog-price_1"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
								<?else:?>
									<span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span><?endif;?>
								</p>
							<?endif;?>
						<?endforeach;?>									
					<?endif;?>
					</div>
				<!-- Конец блока цена -->
				<?if(is_array($arElement["PRICE_MATRIX"])):?>
					<table cellpadding="0" cellspacing="0" border="0" width="100%" class="data-table">
					<thead>
					<tr>
						<?if(count($arElement["PRICE_MATRIX"]["ROWS"]) >= 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
							<td valign="top" nowrap><?= GetMessage("CATALOG_QUANTITY") ?></td>
						<?endif?>
						<?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
							<td valign="top" nowrap><?= $arType["NAME_LANG"] ?></td>
						<?endforeach?>
					</tr>
					</thead>
					<?foreach ($arElement["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity):?>
					<tr>
						<?if(count($arElement["PRICE_MATRIX"]["ROWS"]) > 1 || count($arElement["PRICE_MATRIX"]["ROWS"]) == 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)):?>
							<th nowrap><?
								if (IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
									echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
								elseif (IntVal($arQuantity["QUANTITY_FROM"]) > 0)
									echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
								elseif (IntVal($arQuantity["QUANTITY_TO"]) > 0)
									echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
							?></th>
						<?endif?>
						<?foreach($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType):?>
							<td><?
								if($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"]):?>
								<s><span style="color:red;"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"])?></span></s><span class="catalog-price"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);?></span>
								<?else:?>
									<span class="catalog-price"><?=FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]);?></span>
								<?endif?>&nbsp;
							</td>
						<?endforeach?>
					</tr>
					<?endforeach?>
					</table><br />
				<?endif?>
				<?if($arParams["DISPLAY_COMPARE"]):?>
					<noindex>
					<a href="<?echo $arElement["COMPARE_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_COMPARE")?></a>&nbsp;
					</noindex>
				<?endif?>
				<?if($arElement["CAN_BUY"]):?>
					<?if($arParams["USE_PRODUCT_QUANTITY"] || count($arElement["PRODUCT_PROPERTIES"])):?>
						<form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" id="form_add_<?echo $arElement["ID"]?>">
                        <?foreach($arElement["PRODUCT_PROPERTIES"] as $pid => $product_property):?>

						 <!--Вывод свойств-->


								<?echo $arElement["PROPERTIES"][$pid]["NAME"]?>:
								<?if(
									$arElement["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L"
									&& $arElement["PROPERTIES"][$pid]["LIST_TYPE"] == "C"
								):?>
									<?foreach($product_property["VALUES"] as $k => $v):?>
										<label><input type="radio" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]" value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"checked"'?>><?echo $v?></label><br>
									<?endforeach;?>
								<?else:?>
									<select name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
										<?foreach($product_property["VALUES"] as $k => $v):?>
											<option value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"selected"'?>><?echo $v?></option>
										<?endforeach;?>
									</select>
								<?endif;?>

							<!-- Вывод свойств-->
						<?endforeach;?>
						<div class="KOL_TOV">
							<!-- Количество товаров-->
									<?if($arParams["USE_PRODUCT_QUANTITY"]):?>
											<input type="text" name="<?echo $arParams["PRODUCT_QUANTITY_VARIABLE"]?>" value="1" size="1" class="sect_qual">	
											<input type="hidden" name="old_value" value="1" size="1">	
									<?endif;?>
							<!-- Количество товаров-->
							</div>



						<div><input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="BUY"></div>
						<div><input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arElement["ID"]?>"></div>
						<div><!-- <input type="submit" name="<?echo $arParams["ACTION_VARIABLE"]."BUY"?>" value="<?echo GetMessage("CATALOG_BUY")?>"> --></div>
						<div style="margin-top: -30px; margin-left: 60px;">
						<input type="button" onclick="buy_item(<?echo $arElement["ID"]?>)" class="arhi_sect_basc_s" name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" value="<?echo GetMessage("CATALOG_BUY")/* echo GetMessage("CATALOG_ADD") */?>"></div>
						</form>
					<?else:?>
						<noindex>
						<a href="<?echo $arElement["BUY_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_BUY")?></a>&nbsp;<a href="<?echo $arElement["ADD_URL"]?>" rel="nofollow"><?echo GetMessage("CATALOG_ADD")?></a>
						</noindex>
					<?endif;?>
				<?elseif((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"])):?>
					<?=GetMessage("CATALOG_NOT_AVAILABLE")?>
					<?$APPLICATION->IncludeComponent("bitrix:sale.notice.product", ".default", array(
							"NOTIFY_ID" => $arElement['ID'],
							"NOTIFY_URL" => htmlspecialcharsback($arElement["SUBSCRIBE_URL"]),
							"NOTIFY_USE_CAPTHA" => "N"
							),
							$component
						);?>
				<?endif?>
			<?endif?>
		</div>

				<?$cell++;
				if($cell%$arParams["LINE_ELEMENT_COUNT"] == 0):?>
			</td>
		<?endif?>
</td>
</tr>
	</table>
		<?endforeach; // foreach($arResult["ITEMS"] as $arElement):?>

		<?if($cell%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
			<?while(($cell++)%$arParams["LINE_ELEMENT_COUNT"] != 0):?>
				<td>&nbsp;</td>
			<?endwhile;?>
			</tr>
		<?endif?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

<script type="text/javascript">
	// tmv-20.05.18 Remarketing. Cкрипт для динамического ремаркетинга. Данные о покупке товара
	var dynamicRemarketingJSParams = <?=CUtil::PhpToJSObject($arDynamicRemarketing);?>;
	var dataLayer = window.dataLayer = window.dataLayer || [];
	var dynamicRemarketingList = '<?echo '';?>';
	
	// добавление товара в корзину
	function setDynamicRemarketing(id, quantity)
	{
		dynamicRemarketingJSParams[id].quantity = quantity;			
		dataLayer.push({
		  	"event": "addToCart",
		  	"ecommerce": {
		    	"currencyCode": dynamicRemarketingJSParams[id].currencyCode,
		    	"add": {
		      		"products": [{
		        		"id": dynamicRemarketingJSParams[id].id,
		        		"name": dynamicRemarketingJSParams[id].name,
		        		"price": dynamicRemarketingJSParams[id].price,
		        		"brand": dynamicRemarketingJSParams[id].brand,
		        		"category": dynamicRemarketingJSParams[id].category,
		        		"quantity": dynamicRemarketingJSParams[id].quantity
		      		}]
		    	}
		  	}
		});
	}
		
	var i, products = [];

	// клик на товаре
	function obRemarketingLink(element)
	{
		var currentElement = null, id;
		
		if (element.target.tagName == 'IMG')
			currentElement = element.target.parentNode;
		else if (element.target.tagName == 'A')
			currentElement = element.target;

		if (currentElement.tagName == 'A')
		{
			id = currentElement.id;
			id = id.split('_');
			id = id[3];

			if (id > 0)
			dataLayer.push({
	            'event': 'productClick',
	            'ecommerce': {
	                'currencyCode': dynamicRemarketingJSParams[id].currencyCode,
	                'click': {
	                    'actionField': {
	                            'list': 'Лучшие цены',
	                            'action': 'click'
	                    },
	                    'products': [{
	                        'id': dynamicRemarketingJSParams[id].id,
	                        'name': dynamicRemarketingJSParams[id].name,
	                        'price': dynamicRemarketingJSParams[id].price,
	                        'brand': dynamicRemarketingJSParams[id].brand,
	                        'category': dynamicRemarketingJSParams[id].category,
	                        'quantity': 1
	                    }]
	                }
	            }
	        });
			
		}

        location.href = currentElement.getAttribute('data-href');
	}

	// Данные о просмотре товара в списке
	for (i in dynamicRemarketingJSParams) 
	{
		products.push({
			'id': dynamicRemarketingJSParams[i].id,
			'name': dynamicRemarketingJSParams[i].name,
			'price': dynamicRemarketingJSParams[i].price,
			'brand': dynamicRemarketingJSParams[i].brand,
			'category': dynamicRemarketingJSParams[i].category,
			'position': dynamicRemarketingJSParams[i].position,
			'list': 'Лучшие цены',
		});

        BX.bind(BX(dynamicRemarketingJSParams[i].id_a), 'click', obRemarketingLink);
        BX.bind(BX(dynamicRemarketingJSParams[i].id_img), 'click', obRemarketingLink);
	}
	
	dataLayer.push({
	  	"event": "impressions",
	  	"ecommerce": {
	    	"currencyCode": 'RUB',
	    	"impressions": products
	  	}
	});	

	//console.log(dataLayer);
</script>




<?
if($USER->IsAdmin() && $USER->GetID() == 126) 
{
	echo '<div><pre>'; 
	//print_r($arResult["ITEMS"]);
	//print_r($APPLICATION->arAdditionalChain);
	//print_r($arResult);
	//$APPLICATION->ShowNavChain();
	//echo '</pre></div>';
}
?>