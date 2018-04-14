<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Персональный раздел");
?><br>
<hr>
 <button id="send_button">send</button>
<div id="autorisation_form">
</div>
 <script type="text/javascript">
	$('#send_button').click(function(){
		console.log('send!!!');
		var emailAddress = 'tvmichael@meta.ua';
		$.get("/bitrix/templates/bis_aspool(alexpools)/components/bitrix/sale.order.ajax/visual3/json.php", { email: emailAddress} )
	  		.done(function( data ) {	  			
				$('#autorisation_form').html(data);
	  		})
	  		.fail(function(data) {
	    		console.log('Error:');
	  	});		  		  	
	});
</script> <br>
 <br>
 <?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	"mv.auth.form.order", 
	array(
		"FORGOT_PASSWORD_URL" => "",
		"PROFILE_URL" => "",
		"REGISTER_URL" => "/auth/",
		"SHOW_ERRORS" => "N",
		"COMPONENT_TEMPLATE" => "mv.auth.form.order"
	),
	false
);?>

<br>


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



<br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>