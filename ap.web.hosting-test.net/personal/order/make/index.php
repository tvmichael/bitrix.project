<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?>

<!-- ASDSA-/personal/order/make/index -->
<?
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
	"visual3", 
	array(
		"PAY_FROM_ACCOUNT" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"COUNT_DELIVERY_TAX" => "N",
		"ALLOW_AUTO_REGISTER" => "Y",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "N",
		"TEMPLATE_LOCATION" => "popup",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"USE_PREPAYMENT" => "N",
		"PROP_1" => "",
		"PROP_2" => "",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_PERSONAL" => "/personal/order/",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_AUTH" => "/auth/",
		"SET_TITLE" => "Y",
		"PRODUCT_COLUMNS" => array(
			0 => "PROPERTY_CML2_ARTICLE",
		),
		"PATH_TO_ORDER" => "",
		"DISABLE_BASKET_REDIRECT" => "Y",
		"ALLOW_NEW_PROFILE" => "N",
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "N",
		"COMPONENT_TEMPLATE" => "visual3",
		"COMPATIBLE_MODE" => "Y",
		"USE_PRELOAD" => "Y",
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PRICE_FORMATED",
			1 => "PROPERTY_CML2_ARTICLE",
		),
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ADDITIONAL_PICT_PROP_4" => "-",
		"ADDITIONAL_PICT_PROP_75" => "-",
		"ADDITIONAL_PICT_PROP_79" => "-",
		"BASKET_IMAGES_SCALING" => "standard",
		"ALLOW_APPEND_ORDER" => "N",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"SHOW_VAT_PRICE" => "Y",
		"ACTION_VARIABLE" => "action"
	),
	false
);?>

	<!-- Если пользователь не зарегистрированн то проверяем Emai пользователя - если есть то откриваем окно регистрации.  ASDSA-00 -->

	<? // if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';};  ?>
	<? // if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult["USER_VALS"]); echo '</pre>';};  ?>
	<? // echo '<div style="display: none;">ASDSA-11<pre>'; print_r($arResult); echo '</pre></div>'; ?>

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