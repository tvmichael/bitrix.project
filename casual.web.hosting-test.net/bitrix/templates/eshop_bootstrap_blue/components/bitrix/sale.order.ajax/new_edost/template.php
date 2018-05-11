<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->SetAdditionalCSS($templateFolder."/style_cart.css");
$APPLICATION->SetAdditionalCSS($templateFolder."/style.css");

CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));
?>

<a name="order_form"></a>

<div id="order_form_div" class="order-checkout">
<NOSCRIPT>
	<div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
</NOSCRIPT>

<?
if (!function_exists("getColumnName"))
{
	function getColumnName($arHeader)
	{
		return (strlen($arHeader["name"]) > 0) ? $arHeader["name"] : GetMessage("SALE_".$arHeader["id"]);
	}
}

if (!function_exists("cmpBySort"))
{
	function cmpBySort($array1, $array2)
	{
		if (!isset($array1["SORT"]) || !isset($array2["SORT"]))
			return -1;

		if ($array1["SORT"] > $array2["SORT"])
			return 1;

		if ($array1["SORT"] < $array2["SORT"])
			return -1;

		if ($array1["SORT"] == $array2["SORT"])
			return 0;
	}
}
?>

<div class="bx_order_make">
	<?
	if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
	{
		if(!empty($arResult["ERROR"]))
		{
			foreach($arResult["ERROR"] as $v)
				echo ShowError($v);
		}
		elseif(!empty($arResult["OK_MESSAGE"]))
		{
			foreach($arResult["OK_MESSAGE"] as $v)
				echo ShowNote($v);
		}

		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
	}
	else
	{
		if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
		{
			if(strlen($arResult["REDIRECT_URL"]) > 0)
			{
				?>
				<script type="text/javascript">
				window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';

				</script>
				<?
				die();
			}
			else
			{
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
			}
		}
		else
		{
			?>
			<script type="text/javascript">
			var npRememberCity = '',
				npCountLoad = 0;

			function submitForm(val)
			{
				if(val != 'Y')
					BX('confirmorder').value = 'N';

				var orderForm = BX('ORDER_FORM');

				var idCity = '#ORDER_PROP_6_val',			// id - інпут для вибора міст 
					idPostOfficeInput = '#ORDER_PROP_55',	// id - інпут для вибора офіca
					idPostOffice = '#input-text-datalist';	// привязано до id - ORDER_PROP_55
					idDeliveryInput = '#ID_DELIVERY_ID_3';		// самовивіз

				$(idPostOffice).html('');
				npCountLoad = 0;
				
				BX.ajax.submitComponentForm(orderForm, 'order_form_content', true);
				BX.submit(orderForm);

				BX.addCustomEvent('onAjaxSuccess', afterFormReload);
				function afterFormReload() 
				{
					if (npCountLoad > 0) return;
					npCountLoad++;			

					var i, cityName, CityRef, lang = '';

					var postOffice = "";
					var city = '' || $(idCity).val();
										
					var xxx = npRememberCity != city;
					console.log('>>>'+npRememberCity+' = '+city +' :'+ xxx);
					if (npRememberCity == '')
						npRememberCity = city;
					else					
						if (npRememberCity != city) 
						{
							npRememberCity = city;
							$(idPostOfficeInput).val('');
						}
					
					city = city.split(',');

					if (Array.isArray(city))
					{						
						cityName = city[0];
						var settings = {
							"async": true,
							"crossDomain": true,
							"url": "https://api.novaposhta.ua/v2.0/json/",
							"method": "POST",
							"headers": {"content-type": "application/json",},
							"processData": false,
							"data": "{\r\n\"apiKey\": \"b2444b86ad7faff76b9a69dc6eb37c7d\",\r\n \"modelName\": \"Address\",\r\n \"calledMethod\": \"getWarehouses\",\r\n \"methodProperties\": {\r\n \"CityName\": \""+cityName+"\" \r\n }\r\n}"
						}

						$.ajax(settings).done(function(response){
							if (response.errors.length == 0)
							{
								if (response.data.length > 0)
									for (var i = 0; i < response.data.length; i++) 
									{
										var lang ="<? if (LANGUAGE_ID == 'ru') echo "Ru";?>";
										postOffice = postOffice + "<option>" + response.data[i]['Description' + lang] + "</option>";

										if ( $(idDeliveryInput).attr('checked') != 'checked' )
											$(idPostOfficeInput).prop( "disabled", false );
									}
								else
								{
									$(idPostOfficeInput).attr( "placeholder", '<?=GetMessage('INPUP_SCLAD_NP_MISSING');?>');
									$(idPostOfficeInput).prop( "disabled", true );
								}	
							}
							$(idPostOffice).html(postOffice);
						});		
					}

					if ( $(idDeliveryInput).attr('checked') == 'checked' )
					{						
						$(idPostOfficeInput).attr( "placeholder", '<?=GetMessage('INPUP_SCLAD_NP_PICKUP');?>');
						$(idPostOfficeInput).attr('disabled','disabled');
						$(idPostOfficeInput).val('');						
					}
				}

				return true;
			}

			function SetContact(profileId)
			{
				BX("profile_change").value = "Y";
				submitForm();
			}
			</script>
			<?if($_POST["is_ajax_post"] != "Y")
			{
				?><form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
				<?=bitrix_sessid_post()?>
				<div id="order_form_content">
				<?
			}
			else
			{
				$APPLICATION->RestartBuffer();
			}
			if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
			{
				foreach($arResult["ERROR"] as $v)
					echo ShowError($v);

				?>
				<script type="text/javascript">
					top.BX.scrollToNode(top.BX('ORDER_FORM'));
				</script>
				<?
			}

			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
			if ($arParams["DELIVERY_TO_PAYSYSTEM"] == "p2d")
			{
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
			}
			else
			{
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
			}

			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");

			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
			if(strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
				echo $arResult["PREPAY_ADIT_FIELDS"];
			?>
			</div>
			</div>
			</div>

			<?if($_POST["is_ajax_post"] != "Y")
			{
				?>
					<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
					<input type="hidden" name="profile_change" id="profile_change" value="N">
					<input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">


<?
					if (isset($arParams['USER_CONSENT']) && $arParams['USER_CONSENT'] === 'Y') {
						$APPLICATION->IncludeComponent(
							'bitrix:main.userconsent.request',
							'',
							array(
								'ID' => $arParams['USER_CONSENT_ID'],
								'IS_CHECKED' => $arParams['USER_CONSENT_IS_CHECKED'],
								'IS_LOADED' => $arParams['USER_CONSENT_IS_LOADED'],
								'AUTO_SAVE' => 'N',
//								'SUBMIT_EVENT_NAME' => 'bx-soa-order-save',
								'REPLACE' => array(
									'button_caption' => GetMessage('SOA_TEMPL_BUTTON'),
									'fields' => $arResult['USER_CONSENT_PROPERTY_DATA'],
								),
							)
						);
					}
?>



					<div class="bx_ordercart_order_pay_center"><a href="javascript:void();" onClick="submitForm('Y'); return false;" class="checkout"><?=GetMessage("SOA_TEMPL_BUTTON")?></a></div>
				</form>
				<?
				if($arParams["DELIVERY_NO_AJAX"] == "N")
				{
					$APPLICATION->AddHeadScript("/bitrix/js/main/cphttprequest.js");
					$APPLICATION->AddHeadScript("/bitrix/components/bitrix/sale.ajax.delivery.calculator/templates/.default/proceed.js");
				}
			}
			else
			{
				?>
					<script type="text/javascript">
						top.BX('confirmorder').value = 'Y';
						top.BX('profile_change').value = 'N';
					</script>
				<?
				die();
			}
		}
	}
	?>
	</div>
</div>