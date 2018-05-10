<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->SetAdditionalCSS($templateFolder."/style_cart.css");
$APPLICATION->SetAdditionalCSS($templateFolder."/style.css");

$APPLICATION->SetAdditionalCSS("/bitrix/js/main/jquery/jquery-2.1.3.min.js.pagespeed.jm.i6FmF6RqXu.js";

$APPLICATION->SetAdditionalCSS($templateFolder."/jquery-ui.css");
$APPLICATION->AddHeadScript($templateFolder."/jquery-ui.js");

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
		<div class="cs-h2o">
			<?
			$APPLICATION->IncludeComponent(
				"h2o:buyoneclick", 
				"default_old_basketajax", 
				array(
					"ADD_NOT_AUTH_TO_ONE_USER" => "N",
					"ALLOW_ORDER_FOR_EXISTING_EMAIL" => "Y",
					"BUY_CURRENT_BASKET" => "Y",
					"CACHE_TIME" => "86400",
					"CACHE_TYPE" => "N",
					"COMPOSITE_FRAME_MODE" => "A",
					"COMPOSITE_FRAME_TYPE" => "AUTO",
					"DEFAULT_DELIVERY" => "3",
					"DEFAULT_PAY_SYSTEM" => "1",
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
						0 => "",
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
					),
					"SHOW_PROPERTIES_REQUIRED" => array(
					),
					"SHOW_QUANTITY" => "N",
					"SHOW_USER_DESCRIPTION" => "Y",
					"SUCCESS_ADD_MESS" => "",
					"SUCCESS_HEAD_MESS" => "",
					"USER_CONSENT" => "N",
					"USER_CONSENT_ID" => "0",
					"USER_CONSENT_IS_CHECKED" => "N",
					"USER_CONSENT_IS_LOADED" => "N",
					"USER_DATA_FIELDS" => array(
						0 => "NAME",
						1 => "EMAIL",
						2 => "PERSONAL_PHONE",
					),
					"USER_DATA_FIELDS_REQUIRED" => array(
						0 => "NAME",
						1 => "PERSONAL_PHONE",
					),
					"USE_CAPTCHA" => "N",
					"USE_OLD_CLASS" => "N",
					"COMPONENT_TEMPLATE" => "default_old_basketajax"
				),
				false
			);?>
		</div>
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
			function submitForm(val)
			{
				if(val != 'Y')
					BX('confirmorder').value = 'N';

				var orderForm = BX('ORDER_FORM');

				console.log('orderForm------------------------------------------------------');
				console.log(orderForm);

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
								//'SUBMIT_EVENT_NAME' => 'bx-soa-order-save',
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