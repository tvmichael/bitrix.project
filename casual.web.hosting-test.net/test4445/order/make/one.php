<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<div>
	<?
	$APPLICATION->IncludeComponent(
		"h2o:buyoneclick", 
		"default_old_basketajax", 
		array(
			"ADD_NOT_AUTH_TO_ONE_USER" => "N",
			"ALLOW_ORDER_FOR_EXISTING_EMAIL" => "Y",
			"BUY_CURRENT_BASKET" => "Y",
			"CACHE_TIME" => "8640",
			"CACHE_TYPE" => "N",
			"COMPOSITE_FRAME_MODE" => "A",
			"COMPOSITE_FRAME_TYPE" => "AUTO",
			"DEFAULT_DELIVERY" => "32",
			"DEFAULT_PAY_SYSTEM" => "10",
			"DELIVERY" => array(
				0 => "32",
			),
			"IBLOCK_ID" => "4",
			"IBLOCK_TYPE" => "1c_catalog",
			"ID_FIELD_PHONE" => array(
				0 => "individualPERSONAL_PHONE",
				1 => "",
			),
			"LIST_OFFERS_PROPERTY_CODE" => array(
				0 => "size",
				1 => "",
			),
			"MASK_PHONE" => "(999) 999-9999",
			"MODE_EXTENDED" => "Y",
			"NEW_USER_GROUP_ID" => array(
				0 => "6",
			),
			"NOT_AUTHORIZE_USER" => "Y",
			"OFFERS_SORT_BY" => "ACTIVE_FROM",
			"OFFERS_SORT_ORDER" => "DESC",
			"PATH_TO_PAYMENT" => "/personal/order/payment/",
			"PAY_SYSTEMS" => array(
				0 => "10",
			),
			"PERSON_TYPE_ID" => "1",
			"PRICE_CODE" => array(
				0 => "BASE",
			),
			"SEND_MAIL" => "N",
			"SEND_MAIL_REQ" => "N",
			"SHOW_DELIVERY" => "N",
			"SHOW_OFFERS_FIRST_STEP" => "N",
			"SHOW_PAY_SYSTEM" => "N",
			"SHOW_PROPERTIES" => array(
				0 => "1",
			),
			"SHOW_PROPERTIES_REQUIRED" => array(
				0 => "1",
			),
			"SHOW_QUANTITY" => "Y",
			"SHOW_USER_DESCRIPTION" => "Y",
			"SUCCESS_ADD_MESS" => "",
			"SUCCESS_HEAD_MESS" => "",
			"USER_CONSENT" => "N",
			"USER_CONSENT_ID" => "0",
			"USER_CONSENT_IS_CHECKED" => "N",
			"USER_CONSENT_IS_LOADED" => "N",
			"USER_DATA_FIELDS" => array(
				0 => "EMAIL",
				1 => "PERSONAL_PHONE",
			),
			"USER_DATA_FIELDS_REQUIRED" => array(
				0 => "PERSONAL_PHONE",
			),
			"USE_CAPTCHA" => "N",
			"USE_OLD_CLASS" => "N",
			"COMPONENT_TEMPLATE" => ".default"
		),
		false
	);/**/
	?>
</div>


<button class="buy_one_click_popup_order text-center col-xs-12 col-sm-6 col-lg-4 col-lg-push-4" data-ajax_id="">
	ONE
</button>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>