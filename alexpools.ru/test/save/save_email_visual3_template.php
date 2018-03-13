<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?/* if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';} */?>
<?/*<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.maskedinput.js"></script> */?>
<a name="order_fform"></a>
<div id="order_form_div" class="order-checkout">
<NOSCRIPT>
 <div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
</NOSCRIPT>
<script>
	function CheckSubmitForm() {
		val = ($('input#agree').attr('checked')==undefined) ? $('input#agree').prop('checked') : $('input#agree').attr('checked');
		if (val) {submitForm('Y')}else{alert('Согласен (-на) с тем, что оставленная мной информация может быть использована <br> компанией ООО «Компания Алекспулс» для обработки моего запроса. <br> Ознакомлен с условиями оплаты и доставки и согласен с ними')}
	}
</script>

<?
if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
{
	if(!empty($arResult["ERROR"]))
	{
		echo '<div class="errortext"><ul>';
		foreach($arResult["ERROR"] as $v)
			echo "<li>".$v."</li>";
		echo "</ul></div>";
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
	if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y")
	{
		if (!isset($arResult["ORDER"])) $arResult["ORDER"] = CSaleOrder::GetByID($arResult["ORDER_ID"]);
		if((strlen($arResult["REDIRECT_URL"]) > 0) && (($arResult["ORDER"]["STATUS_ID"]!="E")))	//if(strlen($arResult["REDIRECT_URL"]) > 0)
		{
			?>
			<script>
			<!--
			window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			//-->
			</script>
			<?
			die();
		}
		else
			include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
	}
	else
	{
		?>
		<script>
		function submitForm(val)
		{
			if(val != 'Y') 
				BX('confirmorder').value = 'N';
			
			var orderForm = BX('ORDER_FORM');
			
			BX.ajax.submitComponentForm(orderForm, 'order_form_content', true);
			BX.submit(orderForm);
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
			?><form action="" method="POST" name="ORDER_FORM" id="ORDER_FORM">
			<div id="order_form_content" class="myorders">
			<?
		}
		else
		{
			$APPLICATION->RestartBuffer();
		}
		?>
		<?=bitrix_sessid_post()?>
		<?
		if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
		{
			if(!empty($arResult["ERROR"]))
			{
				echo '<div class="errortext"><ul>';
				foreach($arResult["ERROR"] as $v)
					echo "<li>".$v."</li>";
				echo "</ul></div>";
			}
			?>
			<script>
				top.BX.scrollToNode(top.BX('ORDER_FORM'));
			</script>
			<?
		}
		?>
		<?
		if(count($arResult["PERSON_TYPE"]) > 1)
		{
			?>
				<h2><?=GetMessage("SOA_TEMPL_PERSON_TYPE")?></h2>

				<table>
						<tr>
					<?
					foreach($arResult["PERSON_TYPE"] as $v)
					{
						?>
							<td style="padding:10px 5px 10px 0;"><input type="radio" id="PERSON_TYPE_<?=$v["ID"]?>" name="PERSON_TYPE" value="<?= $v["ID"] ?>"<?if ($v["CHECKED"]=="Y") echo " checked=\"checked\"";?> onclick="submitForm()"></td>
							<td style="width:50%; padding:10px 5px 10px 0;"><label for="PERSON_TYPE_<?=$v["ID"]?>"><?=$v["NAME"] ?></label></td>
						<?
					}
					?>
						</tr>
				</table> 
				<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>">
			<?
		}
		else
		{
			if(IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0)
			{
				?>  
				<input type="hidden" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
				<input type="hidden" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>">
				<?
			}
			else
			{
				foreach($arResult["PERSON_TYPE"] as $v)
				{
					?>
					<input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>">
					<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>">
					<?
				}
			}
		}

		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
		?>			
		<?
		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
		?>
		<?
		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
		?>			
		<?
		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");
		?>
		<?if($_POST["is_ajax_post"] != "Y")
		{
			?>
				</div>
				<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
				<input type="hidden" name="profile_change" id="profile_change" value="N">
				<input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
				<br /><br />
			<!--   
		<input name="ids" type="checkbox" value="1" onclick="checkAvail(this)"> Я ознакомлен с условиями доставки и согласен и ними<br> 

				<script type="text/javascript"> 
					checkobj = 0;
				
					function checkAvail(obj){ 
						if(obj.checked) checkobj++; 
							else checkobj--; 
						if (checkobj<=0) document.form_del.elements['submit'].disabled = true; 
							else document.form_del.elements['submit'].disabled = false; 
					} 
				</script>
			-->
				<?//if(isset($_POST["is_ajax_post"])) :?>
					<div id="submit_block" align="right">
					<span>Согласен (-на) с тем, что оставленная мной информация может быть использована <br> компанией ООО «Компания Алекспулс» для обработки моего запроса. <br> Ознакомлен с условиями оплаты и доставки и согласен с ними &nbsp;</span><input type="checkbox" id="agree"/><br><input type="button" onclick="CheckSubmitForm();" value="<?=GetMessage("SOA_TEMPL_BUTTON")?>" class="arhi_sect_basc arhi_sect_basc-adapt" style="width:180px;">
						
					<?// if($USER->IsAdmin()) {echo '<pre>'; print_r($arResult); echo '</pre>';}?>
						
					</div>
				<?//endif;?>
				
			</form>
			<?if($arParams["DELIVERY_NO_AJAX"] == "N"):?>
				<script language="JavaScript" src="/bitrix/js/main/cphttprequest.js"></script>
				<script language="JavaScript" src="/bitrix/components/bitrix/sale.ajax.delivery.calculator/templates/.default/proceed.js"></script>
			<?endif;?>
			<?
		}
		else
		{
			?>
			
			
			<script language="JavaScript" src="<?=$templateFolder;?>/jquery.maskedinput.js"></script>
			<script>
				top.BX('confirmorder').value = 'Y';
				top.BX('profile_change').value = 'N';
				
				$("#ORDER_PROP_3").attr("placeholder","+7 ___ ___ ____");
				$('#ORDER_PROP_3').mask('+79999999999');
				$("#ORDER_PROP_14").attr("placeholder","+7 ___ ___ ____");
				$('#ORDER_PROP_14').mask('+79999999999');
				
			</script>

			<?
			die();
		}
		?>
		
		<script language="JavaScript" src="<?=$templateFolder;?>/jquery.maskedinput.js"></script>
		<script>
			function make_phone() {
				$("#ORDER_PROP_3").attr("placeholder","+7 ___ ___ ____");
				$('#ORDER_PROP_3').mask('+79999999999');
				$("#ORDER_PROP_14").attr("placeholder","+7 ___ ___ ____");
				$('#ORDER_PROP_14').mask('+79999999999');
			}
			make_phone();
		</script>

		<?
	}
}
?>
</div>
