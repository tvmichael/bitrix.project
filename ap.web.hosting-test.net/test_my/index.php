<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");

if($USER->IsAuthorized()){
	if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);
};
if(!$USER->IsAuthorized()){?>
	<div id="user_authorization_form" style="display: none;">
		<div class="bx-system-auth-form">
			<h2>Пользователь с таким email уже существует</h2>			
			<div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.profile",
				"",
				Array(
					"CHECK_RIGHTS" => "N",
					"SEND_INFO" => "N",
					"SET_TITLE" => "Y",
					"USER_PROPERTY" => array(),
					"USER_PROPERTY_NAME" => ""
				)
			);?>
			</div>
		</div>		
	</div>
<?}?>


<?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	"visual4", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ADDITIONAL_PICT_PROP_4" => "-",
		"ADDITIONAL_PICT_PROP_75" => "-",
		"ADDITIONAL_PICT_PROP_79" => "-",
		"ALLOW_APPEND_ORDER" => "N",
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_NEW_PROFILE" => "N",
		"ALLOW_USER_PROFILES" => "N",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"BASKET_POSITION" => "after",
		"COMPATIBLE_MODE" => "Y",
		"DELIVERIES_PER_PAGE" => "9",
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "N",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_ORDER" => "",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_PERSONAL" => "/personal/order/",
		"PAY_FROM_ACCOUNT" => "N",
		"PAY_SYSTEMS_PER_PAGE" => "9",
		"PICKUPS_PER_PAGE" => "5",
		"PICKUP_MAP_TYPE" => "yandex",
		"PRODUCT_COLUMNS_HIDDEN" => "",
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "PROPS",
		),
		"PROPS_FADE_LIST_1" => "",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"SERVICES_IMAGES_SCALING" => "adaptive",
		"SET_TITLE" => "Y",
		"SHOW_BASKET_HEADERS" => "N",
		"SHOW_COUPONS_BASKET" => "Y",
		"SHOW_COUPONS_DELIVERY" => "Y",
		"SHOW_COUPONS_PAY_SYSTEM" => "Y",
		"SHOW_DELIVERY_INFO_NAME" => "Y",
		"SHOW_DELIVERY_LIST_NAMES" => "Y",
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",
		"SHOW_MAP_IN_PROPS" => "N",
		"SHOW_NEAREST_PICKUP" => "N",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"SHOW_ORDER_BUTTON" => "final_step",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_PICKUP_MAP" => "Y",
		"SHOW_STORES_IMAGES" => "Y",
		"SHOW_TOTAL_ORDER_BUTTON" => "N",
		"SHOW_VAT_PRICE" => "Y",
		"SKIP_USELESS_BLOCK" => "Y",
		"SPOT_LOCATION_BY_GEOIP" => "Y",
		"TEMPLATE_LOCATION" => "popup",
		"TEMPLATE_THEME" => "site",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
		"USE_CUSTOM_ERROR_MESSAGES" => "N",
		"USE_CUSTOM_MAIN_MESSAGES" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_PRELOAD" => "Y",
		"USE_PREPAYMENT" => "N",
		"USE_YM_GOALS" => "N",
		"COMPONENT_TEMPLATE" => "visual4"
	),
	false
);?>


	<!-- Если пользователь не зарегистрированн то проверяем Emai пользователя - если есть то откриваем окно регистрации.  ASDSA-00 -->
	<?if(!$USER->IsAuthorized()){?>
		<script type="text/javascript">		
			// out-of email input
	 		$('#ORDER_PROP_2').focusout(function(){
				var emailContainer = $('.order-input-edit:contains("E-Mail")')[0];
				var spanTag = $(emailContainer).children('span')[1];
				var authorizationForm = $('#user_authorization_form');
				var inputLogin = $("#user_authorization_form input[name='USER_LOGIN']")[0];
				var inputPass = $("#user_authorization_form input[name='USER_PASSWORD']")[0];
	 			var emailAddress = $(this).val(); 	
	 			emailAddress = emailAddress.replace(/\s/g, '');	 				 			

			  	// validate email address
			  	if (emailAddress !== '' ){
					function validateEmail(email) {
	 				    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    				return re.test(email);
					};					
					if (validateEmail(emailAddress)){
						$(spanTag).html('*');
			 			
						$.get("<?=$templateFolder;?>/json.php", { email: emailAddress} )
					  		.done(function( data ) {
					  			var veriFy = false;
					  			data = data.replace(/\s/g, '');
					    		var request = JSON.parse(data);
					    		if (request['Check'] == 'true') veriFy = true;
								// set user login
								$(inputLogin).val(request['Login']);

					    		// console.log('Email:'+ veriFy);
					    		if (veriFy){
									$(authorizationForm).show();
					    			$(inputPass).focus();
					    		};							  		
					  		})
					  		.fail(function(data) {
					    		console.log('Error:');
					  	});		  						  	
					} else {
						$(spanTag).html(' Неправильный формат');
					}		  		
			  	} else $(spanTag).html('*');
			
			});
		</script>
	<?};?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>