<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? /* if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult["ORDER_PROP"]["USER_PROFILES"]); echo '</pre>';} */ ?>
<?// if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult["ORDER_PROP"]); echo '</pre>';}  ?>
<?// if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';};  ?>

<?function PrintPropsFormMy($arSource=Array(), $locationTemplate = ".default")
{
		
	if (!empty($arSource))
	{
		?>
		<div class="col-md-6 col-xs-12 order-input-profile-info">
			<div class='col-md-6'>
			<?
			// update- 15-01-18 
			$countProperies = 0;
			foreach($arSource as $arProperties)
			{
				if ($arProperties["PERSON_TYPE_ID"]=="1") 
				{
					$w = "order-input_my";
				}
				else {
					$w = "order-input1_my";
				}?>

				<div class="<?=$w?>">
				<?if($arProperties["ID"] != "1" && ($arProperties["ID"] == "7" || $arProperties["ID"] == "3"))
					{
						?>
							<span class="order_prop_name">
							<?echo $arProperties["NAME"];
							if($arProperties["REQUIED_FORMATED"]=="Y")
							{
								?>									
								</span>
								<span class="star">:</span>
								<?
								echo "<!-- $countProperies -->";
								if($countProperies==3){ echo'<br>';};
							}
					}
					if($arProperties["ID"] == "1")
					{
						?>
						<input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" value="">
						<input type="radio" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="1" checked="" onclick="submitForm();">
						<span><?=$arProperties["VALUE"]?></span><br>					
						<?
					}
					elseif($arProperties["ID"] == "7" || $arProperties["ID"] == "3")
					{
						?>									
						<span><?=$arProperties["VALUE"]?></span>					
						<?
					}
					
				?>
				</div>
				<?;	
				$countProperies ++;
				if ($countProperies == 3) 
				{
					?>
				</div>
				<div class="col-md-6 order-input-left-line">
					<?					
				}
			}
			?>
				<div class='<?=$w;?>'><a class='edit-order-info'>Редактировать</a></div>
			</div>
		</div>
		<?	
		return true;
	}
	return false;
}
?>

<?function PrintPropsForm($arSource=Array(), $locationTemplate = ".default")
{		
	if (!empty($arSource))
	{
		?>
		<div class="container">
			<div class="row order-input-profile-info-edit">                                       
				<!-- table -->
				<?
				$i=1;				
				foreach($arSource as $arProperties)
				{
					?>     
					<?if($i==1) {print "<div class='col-md-4'>";}?> 
					<? if ($arProperties["PERSON_TYPE_ID"]=="1") {
					$w = "order-input-edit";
					}
					else {
					$w = "order-input1-edit";
					}

					?>
					<div class="col-md-12 <?=$w?>">
								<span class="order_prop_name"><?echo $arProperties["NAME"];
								if($arProperties["REQUIED_FORMATED"]=="Y")
								{
									?></span><span class="star">*</span><?
								}?><br>
						
						
						<?
						if($arProperties["TYPE"] == "CHECKBOX")
						{
							?>

							<input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" value="">
							<input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>
							<?
						}
						elseif($arProperties["TYPE"] == "TEXT")
						{
							?>
							<!-- ASDSA-input i=<?=$i;?> -->
							<input type="text" maxlength="250" class="input_text_style" size="<?=$arProperties["SIZE1"]?>" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>">
							<br><br>
							<?
						}
						elseif($arProperties["TYPE"] == "SELECT")
						{
							?>
							<select name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
							<?
							foreach($arProperties["VARIANTS"] as $arVariants)
							{
								?>
								<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
								<?
							}
							?>
							</select>
							<br><br>
							<?
						}
						elseif ($arProperties["TYPE"] == "MULTISELECT")
						{
							?>
							<select multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
							<?
							foreach($arProperties["VARIANTS"] as $arVariants)
							{
								?>
								<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
								<?
							}
							?>
							</select>
							<br><br>
							<?
						}
						elseif ($arProperties["TYPE"] == "TEXTAREA")
						{
							?>
							<textarea rows="<?=$arProperties["SIZE2"]?>" cols="<?=$arProperties["SIZE1"]?>" style="width:307px; height:80px;" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["VALUE"]?></textarea>
							<br><br>
							<?
						}
						elseif ($arProperties["TYPE"] == "LOCATION")
						{
							$location_field=$arProperties["FIELD_NAME"];
							$value = 0;
							foreach ($arProperties["VARIANTS"] as $arVariant)
							{
								if ($arVariant["SELECTED"] == "Y")
								{
									$value = $arVariant["ID"];
									break;
								}
							}

							$GLOBALS["APPLICATION"]->IncludeComponent(
								"bitrix:sale.ajax.locations",
								$locationTemplate,
								array(
									"AJAX_CALL" => "N",
									"COUNTRY_INPUT_NAME" => "COUNTRY_".$arProperties["FIELD_NAME"],
									"REGION_INPUT_NAME" => "REGION_".$arProperties["FIELD_NAME"],
									"CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
									"CITY_OUT_LOCATION" => "Y",
									"LOCATION_VALUE" => $value,
									"ORDER_PROPS_ID" => $arProperties["ID"],
									"ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
									"SIZE1" => $arProperties["SIZE1"],
								),
								$component,
								array('HIDE_ICONS' => 'N')
							);
							?><br><br><?
						}
						elseif ($arProperties["TYPE"] == "RADIO")
						{
							foreach($arProperties["VARIANTS"] as $arVariants)
							{
								?>
								<input type="radio" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>" value="<?=$arVariants["VALUE"]?>"<?if($arVariants["CHECKED"] == "Y") echo " checked";?>> <label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"><?=$arVariants["NAME"]?></label><br />
								<br><br>
								<?
							}
						}

						if (strlen($arProperties["DESCRIPTION"]) > 0)
						{
							?><br /><small><?echo $arProperties["DESCRIPTION"] ?></small><?
						}
						?>
						</td>
					<?
					$i++; 					
					if ($arProperties["PERSON_TYPE_ID"]=="1") 
					{
						print "</div>";
					}
					if($i==4) 
					{
						print "</div>"; 
						print "<div class='col-md-6'>"; 
						// $i=1;
					}
				}
				?>
				<?if($i==2) {print "<!-- td></td></tr-- >";}?>
				</div>
				<!-- /table -->
				<!-- div class='<?=$w?>'><a class='save-order-info'>Сохранить</a></div -->
			</div>
		</div>
		<?
		return true;
	}
	return false;
}
?>

<br>
<h2><?=GetMessage("SOA_TEMPL_PROP_INFO")?></h2>

<?
if(!empty($arResult["ORDER_PROP"]["USER_PROFILES"]))
{
	?>
	<?=GetMessage("SOA_TEMPL_PROP_PROFILE")?><br />
	
	<br />
	
	<?
}
?>

<?
PrintPropsFormMy($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"]);
PrintPropsFormMy($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"]);
PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"]);
PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"]);
?>

<script type="text/javascript">		
	function propsUserEditForm (){
		var userAuthorized = <? if($USER->IsAuthorized()) echo 'true'; else echo 'false'; ?>;
		var userProfile = document.getElementsByClassName('order-input-profile-info')[0];
		var userProfileInput = document.getElementsByClassName('order-input-profile-info-edit')[0];		
		var editOrderInfo = userProfile.getElementsByClassName('edit-order-info')[0];
		var userInfoInput = userProfileInput.getElementsByClassName('order-input-edit');
		// check user
		if (userAuthorized ){
			userInfoInput[2].style.display = 'none';
			userProfileInput.style.display = 'none';
		} else {
			userProfile.style.display = 'none';
		}
		// edit user information
		editOrderInfo.onclick = function(e){
			userProfile.style.display = 'none';
 			userProfileInput.style.display = 'block';
		};
	};
	try {
   		propsUserEditForm();
	}
	catch(err) {
	   console.log( 'propsUserEditForm - function error: ' + err );
	}	
</script>