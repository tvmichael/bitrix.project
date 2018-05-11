<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");
?>
	<?
	$bHideProps = false;
	$arResult["ORDER_PROP"]["USER_PROFILES"]=''; //що позбутись виводу профілів замовлень
	if (!empty($arResult["ORDER_PROP"]["USER_PROFILES"])):
	?>
	<div class="section">
	<h4><?=GetMessage("SOA_TEMPL_PROP_INFO")?></h4>
	<?
		if ($arParams["ALLOW_NEW_PROFILE"] == "Y"):
	?>
		<div class="bx_block r1x3">
			<?=GetMessage("SOA_TEMPL_PROP_CHOOSE")?>
		</div>
		<div class="bx_block r3x1">
			<select name="PROFILE_ID" id="ID_PROFILE_ID" onChange="SetContact(this.value)">
				<option value="0"><?=GetMessage("SOA_TEMPL_PROP_NEW_PROFILE")?></option>
				<?
				foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $arUserProfiles)
				{
					if ($arUserProfiles["CHECKED"]=="Y")
						$bHideProps = true;
					?>
					<option value="<?= $arUserProfiles["ID"] ?>"<?if ($arUserProfiles["CHECKED"]=="Y") echo " selected";?>><?=$arUserProfiles["NAME"]?></option>
					<?
				}
				?>
			</select>
			<div style="clear: both;"></div>
		</div>
		<?
		else:
		?>
		<div class="bx_block r1x3">
			<?=GetMessage("SOA_TEMPL_EXISTING_PROFILE")?>
		</div>
		<div class="bx_block r3x1">
				<?
				if (count($arResult["ORDER_PROP"]["USER_PROFILES"]) == 1)
				{
					foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $arUserProfiles)
					{
						echo "<strong>".$arUserProfiles["NAME"]."</strong>";
						?>
						<input type="hidden" name="PROFILE_ID" id="ID_PROFILE_ID" value="<?=$arUserProfiles["ID"]?>" />
						<?
					}
				}
				else
				{
					?>
					<select name="PROFILE_ID" id="ID_PROFILE_ID" onChange="SetContact(this.value)">
						<?
						foreach($arResult["ORDER_PROP"]["USER_PROFILES"] as $arUserProfiles)
						{
							if ($arUserProfiles["CHECKED"]=="Y")
								$bHideProps = true;
							?>
							<option value="<?= $arUserProfiles["ID"] ?>"<?if ($arUserProfiles["CHECKED"]=="Y") echo " selected";?>><?=$arUserProfiles["NAME"]?></option>
							<?
						}
						?>
					</select>
					<?
				}
				?>
			<div style="clear: both;"></div>
		</div>
	<?
		endif;?>
		</div>
	<?endif;
	?>


<br/>
<div class="bx_section">
	<h4>
		<?=GetMessage("SOA_TEMPL_BUYER_INFO")?>
		<?
		if ($bHideProps && $_POST["showProps"] != "Y"):
		?>
			<a href="#" class="slide" onclick="fGetBuyerProps(this); return false;">
				<?=GetMessage('SOA_TEMPL_BUYER_SHOW');?>
			</a>
		<?
		elseif ($bHideProps && $_POST["showProps"] == "Y"):
		?>
			<a href="#" class="slide" onclick="fGetBuyerProps(this); return false;">
				<?=GetMessage('SOA_TEMPL_BUYER_HIDE');?>
			</a>
		<?
		endif;
		?>
		<input type="hidden" name="showProps" id="showProps" value="N" />
	</h4>

	<div id="sale_order_props" <?=($bHideProps && $_POST["showProps"] != "Y")?"style='display:none;'":''?>>		
		<? 
		PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"]);
		PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"]);
		?>
	</div>
</div>

<script type="text/javascript">	
	function fGetBuyerProps(el)
	{
		var show = '<?=GetMessageJS('SOA_TEMPL_BUYER_SHOW')?>';
		var hide = '<?=GetMessageJS('SOA_TEMPL_BUYER_HIDE')?>';
		var status = BX('sale_order_props').style.display;
		var startVal = 0;
		var startHeight = 0;
		var endVal = 0;
		var endHeight = 0;
		var pFormCont = BX('sale_order_props');
		pFormCont.style.display = "block";
		pFormCont.style.overflow = "hidden";
		pFormCont.style.height = 0;
		var display = "";

		if (status == 'none')
		{
			el.text = '<?=GetMessageJS('SOA_TEMPL_BUYER_HIDE');?>';

			startVal = 0;
			startHeight = 0;
			endVal = 100;
			endHeight = pFormCont.scrollHeight;
			display = 'block';
			BX('showProps').value = "Y";
			el.innerHTML = hide;
		}
		else
		{
			el.text = '<?=GetMessageJS('SOA_TEMPL_BUYER_SHOW');?>';

			startVal = 100;
			startHeight = pFormCont.scrollHeight;
			endVal = 0;
			endHeight = 0;
			display = 'none';
			BX('showProps').value = "N";
			pFormCont.style.height = startHeight+'px';
			el.innerHTML = show;
		}

		(new BX.easing({
			duration : 700,
			start : { opacity : startVal, height : startHeight},
			finish : { opacity: endVal, height : endHeight},
			transition : BX.easing.makeEaseOut(BX.easing.transitions.quart),
			step : function(state){
				pFormCont.style.height = state.height + "px";
				pFormCont.style.opacity = state.opacity / 100;
			},
			complete : function(){
					BX('sale_order_props').style.display = display;
					BX('sale_order_props').style.height = '';
			}
		})).animate();
	}
	/**/
</script>

<div style="display:none;">
<?
	$APPLICATION->IncludeComponent(
		"bitrix:sale.ajax.locations",
		// update- 
		'quick_popup',
		$arParams["TEMPLATE_LOCATION"],
		array(
			"AJAX_CALL" => "N",
			"COUNTRY_INPUT_NAME" => "COUNTRY_tmp",
			"REGION_INPUT_NAME" => "REGION_tmp",
			"CITY_INPUT_NAME" => "tmp",
			"CITY_OUT_LOCATION" => "Y",
			"LOCATION_VALUE" => "",
			"ONCITYCHANGE" => "submitForm()",
		),
		null,
		array('HIDE_ICONS' => 'Y')
	);/**/
?>
</div>
<?
$jsParams = array(
	'CITY_ID' => $arResult["ORDER_PROP"]["USER_PROPS_Y"][6]['FIELD_NAME'].'_val',
	'STORAGE_ID' => $arResult["ORDER_PROP"]["USER_PROPS_Y"][55]['FIELD_NAME'],
	'LANG' => 'ua'
);
?>

<script type="text/javascript">
	;(function (window)
	{
		window.JSNovaPoshta = function (arParams)
		{
			//console.log('JSNovaPoshta');
			//console.log(arParams);
			this.cityID = arParams.CITY_ID;
			this.storageID = arParams.STORAGE_ID;
			
			this.availableCity = [];
			this.availableCityResponse = [];

			this.availablePostOffice = [];

			this.lang = arParams.LANG; 

			this.init();
		}

		window.JSNovaPoshta.prototype = {
			init: function()
			{
				// city
				this.city = document.getElementById(this.cityID);
				this.city.value = '';

				$(this.city).autocomplete({ source: this.availableCity});

				$(this.city).keyup(this.cityKeyUp.bind(this));

				var self = this;
				$(this.city).blur(function(){		
					self.cityGetWarehouseTypes();
				});
				$('#ui-id-1').click(function(){		
					self.cityGetWarehouseTypes();
				});

				// postOffice 
				this.postOffice = document.getElementById(this.storageID);
				this.postOffice.value = '';

				//$(this.postOffice).autocomplete({ source: this.availablePostOffice });
				this.inputDataList = document.getElementById('input-text-datalist');

				$(this.postOffice).click(function(e){ console.log(e)});

				console.log(this);
			},

			cityKeyUp: function(e)
			{
				var cityName = e.target.value;		
				var self = this;	

				//console.log(this);
				console.log(e);
				console.log(e.target.value);
					
					if (cityName != '')
					{
					
						var settings = {
							"async": true,
							"crossDomain": true,
							"url": "https://api.novaposhta.ua/v2.0/json/",
							"method": "POST",
							"headers": {"content-type": "application/json",},
							"processData": false,
							"data": "{\r\n\"apiKey\": \"b2444b86ad7faff76b9a69dc6eb37c7d\",\r\n \"modelName\": \"Address\",\r\n \"calledMethod\": \"searchSettlements\",\r\n \"methodProperties\": {\r\n \"CityName\": \""+cityName+"\",\r\n \"Limit\": 10,\r\n \"Language\":\""+this.lang+"\" \r\n }\r\n}"
						}

						$.ajax(settings).done(function (response) 
						{
							console.log(response);		

							var i;						
							self.availableCityResponse = response;

							if (response.errorCodes.length == 0)
								for (i = 0; i < response.data[0].Addresses.length; i++)
								{
									self.availableCity[i] = response.data[0].Addresses[i].Present;
								}						
						});					
						
						if (e.keyCode == 13) { this.cityGetWarehouseTypes(); }
					}
			},

			cityGetWarehouseTypes: function()
			{
				console.log($(this.city).val());
				console.log(this.availableCity);
				var i;
							
				if (this.availableCityResponse.errorCodes.length == 0)
				for(i = 0; i < this.availableCityResponse.data[0].Addresses.length; i++ )
				{
					if (this.city.value == this.availableCityResponse.data[0].Addresses[i].Present )					
					{					
						console.log(this.availableCityResponse.data[0].Addresses[i]);
						this.postOfficeGetWarehouses(this.availableCityResponse.data[0].Addresses[i].Ref);
					}
					console.log(i);				
				}
				
			},

			postOfficeGetWarehouses: function(CityRef)
			{			
				var settings = {
					"async": true,
					"crossDomain": true,
					"url": "https://api.novaposhta.ua/v2.0/json/",
					"method": "POST",
					"headers": {"content-type": "application/json",},
					"processData": false,
					"data": "{\r\n\"apiKey\": \"b2444b86ad7faff76b9a69dc6eb37c7d\",\r\n \"modelName\": \"Address\",\r\n \"calledMethod\": \"getWarehouses\",\r\n \"methodProperties\": {\r\n \"SettlementRef\": \""+CityRef+"\" \r\n }\r\n}"
				}

				$.ajax(settings).done(this.setPostOffice.bind(this));
			},

			setPostOffice: function(response)
			{
				var i, optionList = '';

				console.log(response);
				if (response.errorCodes.length == 0)
				{	
					for (i = 0; i < response.data.length; i++) {
						this.availablePostOffice[i] = response.data[i].Description;
						optionList = optionList + "<option value='" + response.data[i].Description + "'>";
						this.inputDataList.innerHTML = optionList;
					}

					if (this.postOffice.value == ''){
						this.postOffice.value = response.data[0].Description;
					}
				}
			}
		}

	})(window);
	
	 var csNovaPoshta = new JSNovaPoshta(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>