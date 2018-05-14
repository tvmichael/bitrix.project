<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true){
	die();
}
use Bitrix\Main,
	Bitrix\Main\Localization\Loc;
if(method_exists($this, 'setFrameMode')){
	$this->setFrameMode(true);
}
//$this->addExternalJS("/bitrix/components/h2o/buyoneclick/templates/.default/jquery.maskedinput.min.js");
Bitrix\Main\Loader::includeModule('highloadblock');
global $USER;
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$context = Main\Application::getInstance()->getContext();
$request = $context->getRequest();
$ajaxCall = $request->get('AJAX_CALL_BUY_ONE_CLICK');
$server = $context->getServer();
$arJSParams = array(
	"CONTAINER_ID" => "buy_one_click_ajaxwrap",
	"FORM_ID" => "buy_one_click_form",
	"ID" => $arResult['DATA']['ID'],
	"AJAX_ID" => $arResult['AJAX_ID'],
	"ID_FIELD_PHONE" => $arParams['ID_FIELD_PHONE'],
	"MASK_PHONE" => $arParams['MASK_PHONE'],
  'TREE_OFFERS' => $arResult['TREE_OFFERS'],
	'OFFERS_PROP' => $arResult['OFFERS_PROP'],
	'OFFERS_PRICE' => $arResult['OFFERS_PRICE'],
	'CURRENT_OFFER' => intval($arResult['CURRENT_OFFER_ID']),
);
?>

<div class="tab-container" style="display: none;">
	<div id="<?=$arJSParams['CONTAINER_ID']?>">
		<div class="h2o_component buy_one_click_container">
			<span class="h2o-popup-window-close-icon"></span>
			<div class="h2o_block_modal_wrap">
				<div class="h2o_block_modal"></div>
				<div class="cssload-loader">
					<div class="cssload-side"></div>
					<div class="cssload-side"></div>
					<div class="cssload-side"></div>
					<div class="cssload-side"></div>
					<div class="cssload-side"></div>
					<div class="cssload-side"></div>
					<div class="cssload-side"></div>
					<div class="cssload-side"></div>
				</div>
			</div>
			<div class="modal-body">
				<!-- buy_one_click 12345 -->
				<?
				/** Выводим фатальные ошибки */
				if(isset($arResult['FATAL_ERROR'])):?>
					<div class="modal-header">
						<span class="modal_title"><?=GetMessage("H2O_BUYONECLICK_FATAL_ERROR_TITLE")?></span>
					</div>
					<div class="modal-container">
						<p><?=GetMessage("H2O_BUYONECLICK_FATAL_ERROR_TEXT")?></p>
					</div>
				<? elseif($arResult['SUCCESS']):
					/**
					 * Если успешно добавили заказ
					 */
					include($server->getDocumentRoot().$templateFolder.'/success.php');
				else: ?>
					<form action="<?=POST_FORM_ACTION_URI?>" class="buy_one_click_form" method="post" id="<?=$arJSParams['FORM_ID']?>"
					      enctype="multipart/form-data">
						<input type="hidden" class="input_ajax_id" name="AJAX_CALL_BUY_ONE_CLICK"
						       value="<?=$arResult["AJAX_ID"]?>"/>
						<input type="hidden" name="buy_one_click" value="Y"/>
						<input type="hidden" name="H2O_B1C_ELEMENT_ID" value="<?=$arResult['ELEMENT_ID']?>"/>
						<? if(is_array($arResult['OFFERS']) && !empty($arResult['OFFERS']) && $arParams["SHOW_OFFERS_FIRST_STEP"] != 'Y'):
							/**
							 * Если у товара есть торговые предложения
							 */
							include($server->getDocumentRoot().$templateFolder.'/offers_step.php');
						else: ?>
							<?
							/**
							 * Выводим стартовую форму
							 */
							?>
							<div class="modal-header">
														<!--	Выводим название товара и цены товара или ТП	-->
								<div class="item_price">
								<?
									//отримуєм id товара цієї тп
									$IDItemParent = CCatalogSku::GetProductInfo($arResult["ELEMENT_ID"]);

									//отримуєм properti_name_lang товара цієї тп
									$db_props = CIBlockElement::GetProperty($IDItemParent["IBLOCK_ID"], $IDItemParent["ID"], "sort", "asc", Array("CODE"=>"name_".LANGUAGE_ID));
									    if ($ob = $db_props->GetNext())
											{
												echo '<div class="col-xs-12 modal_title modal_title-name">'.$ob["VALUE"].'</div>';

											}

									 
									?>
									
									<div class="col-xs-12 item_current_price text-right"
									     data-start-price="<?=$arResult['TITLE_MODAL']['PRICE']?>"
									     data-currency="<?=$arResult['TITLE_MODAL']['CURRENCY']?>">
										<?=$arResult['TITLE_MODAL']['FORMAT_PRICE']?>
									</div>
								</div>
								<br/>
								<span class="modal_title modal_title-tabl"><?=GetMessage("PERSONAL")?></span>
							</div>
							<div class="modal-container">
								<?include($server->getDocumentRoot().$templateFolder.'/print_fields.php');?>
								<? if(is_array($arResult['OFFERS']) && !empty($arResult['OFFERS'])): ?>
									<div class="modal-header">
										<span class="modal_title"><?=GetMessage("H2O_BUY_ONECLICK_OFFERS_TITLE")?></span>
									</div>
									<?include($server->getDocumentRoot().$templateFolder.'/offers_list.php');?>
								<? endif; ?>
								<? if($arParams['SHOW_QUANTITY'] && !$arParams['BUY_CURRENT_BASKET']): ?>
									<div class="form-row h2o-quantity-block">
										<div class="form-cell-3">
											<label
												for="quantity_b1c"><?=GetMessage('QUANTITY_LABEL');?>:</label>
										</div>
										<div class="form-cell-9">
                                            <span class="item_buttons_counter_block">
												<a href="#" class="button_set_quantity minus bx_bt_button_type_2 bx_small bx_fwb">-</a>
												<input id="quantity_b1c" type="text" class="tac transparent_input" value="<?=$arResult['QUANTITY']?>"
												       name="quantity_b1c"/>
												<a href="#" class="button_set_quantity plus bx_bt_button_type_2 bx_small bx_fwb">+</a>
											</span>
										</div>
									</div>
								<? endif; ?>

								<? if($arResult["SHOW_CAPTCHA"] == "Y"): ?>
									<div class="form-row">
										<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>"/>
										<div class="form-cell-3">
											<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="170" height="34"
											     alt="CAPTCHA"/>
											<span class="mf-req">*</span>
										</div>
										<div class="form-cell-9">
											<input type="text" id="individual_captha" name="captcha_word" size="30" maxlength="50" value=""/>
											<? if(strlen($arResult['ERRORS']["CAPTCHA"]) > 0){
												?>
												<small class="error"><?=$arResult['ERRORS']["CAPTCHA"]?></small>
											<? } ?>
										</div>
									</div>
								<? endif; ?>
								<?include($server->getDocumentRoot().$templateFolder.'/paysystem.php');?>
								<?include($server->getDocumentRoot().$templateFolder.'/delivery.php');?>

								<? if(is_array($arResult['ERROR_STRING']) && !empty($arResult['ERROR_STRING'])): ?>
									<? foreach($arResult['ERROR_STRING'] as $error){
										?>
										<small class="error"><?=$error?></small>
									<? } ?>
								<? endif; ?>
								<div class="clr"></div>
								<div class="form-row">
									<span class="form-helper"><sup>*</sup><?=GetMessage('REQUIRE');?></span>
									<?include($server->getDocumentRoot().$templateFolder.'/user_consent.php');?>
									<button class="button" id="h2o_preorder_button_submit"><img src="<?=$templateFolder;?>/images/order.png"><?=GetMessage("MAKE")?></button>
								</div>
							</div>
						<? endif; ?>
					</form>
				<? endif; ?>
			</div>
		</div>
		<script>
			
			if(typeof H2oBuyOneClick !== 'undefined'){
				console.log('H2oBuyOneClick::: if - undefined');
			  H2oBuyOneClick.reInit(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
			}
		</script>
	</div>
</div>
<?if($ajaxCall != $arResult['AJAX_ID'] && $ajaxCall != 'Y'):?>
<script>
	window.onload = function() {
		var H2oBuyOneClick = new JCH2oBuyOneClick(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
	};
</script>
<?endif;?>