<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arUrls = Array(
	"delete" => $APPLICATION->GetCurPage()."?".$arParams["ACTION_VARIABLE"]."=delete&id=#ID#",
	"delay" => $APPLICATION->GetCurPage()."?".$arParams["ACTION_VARIABLE"]."=delay&id=#ID#",
	"add" => $APPLICATION->GetCurPage()."?".$arParams["ACTION_VARIABLE"]."=add&id=#ID#",
);

// tmv-20.05.18 Cкрипт для динамического ремаркетинга
$arDynamicRemarketing = array('updown' => '');
foreach ($arResult['GRID']['ROWS'] as $key => $value) 
{	
	$prop = CIBlockElement::GetByID($value['PRODUCT_ID'])->GetNextElement()->GetProperties();

	// получить категорию товара по ID	
	$categoryPath = '';	
	$rsElement = CIBlockElement::GetList(array(), array('ID' => $value['PRODUCT_ID']), false, false, array('IBLOCK_SECTION_ID'));
	if($arElement = $rsElement->Fetch())
	{	
		$i = 0;		
		$iBlockSectionId = $arElement["IBLOCK_SECTION_ID"];			
		while ($iBlockSectionId > 0 && $i < 10)
		{
			$res = CIBlockSection::GetByID($iBlockSectionId);
			if($ar_res = $res->GetNext())
			{				
				$categoryPath = $ar_res['NAME'].($i==0?'':'/').$categoryPath;
				$iBlockSectionId = $ar_res["IBLOCK_SECTION_ID"];				
			}    
			$i++;			
		}
	}
	$arDynamicRemarketing[$key] = array(
		"currencyCode" => $value['CURRENCY'],
		"id" => $value['PRODUCT_ID'],
		"name" => $value['NAME'],
		"price" => $value['PRICE'],
		"brand" => $prop['CML2_MANUFACTURER']['VALUE'],
		"category" => $categoryPath,
		"quantity" => $value['QUANTITY']
	);
}

$arBasketJSParams = array(
	'SALE_DELETE' => GetMessage("SALE_DELETE"),
	'SALE_DELAY' => GetMessage("SALE_DELAY"),
	'SALE_TYPE' => GetMessage("SALE_TYPE"),
	'TEMPLATE_FOLDER' => $templateFolder,
	'DELETE_URL' => $arUrls["delete"],
	'DELAY_URL' => $arUrls["delay"],
	'ADD_URL' => $arUrls["add"]
);
?>

<script type="text/javascript">
	var basketJSParams = <?=CUtil::PhpToJSObject($arBasketJSParams);?>;
	var dynamicRemarketingJSParams = <?=CUtil::PhpToJSObject($arDynamicRemarketing);?>;
</script>

<?
$APPLICATION->AddHeadScript($templateFolder."/script.js");

include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/functions.php");

if (strlen($arResult["ERROR_MESSAGE"]) <= 0)
{
	?>
	<div id="warning_message">
		<?
		if (is_array($arResult["WARNING_MESSAGE"]) && !empty($arResult["WARNING_MESSAGE"]))
		{
			foreach ($arResult["WARNING_MESSAGE"] as $v)
				echo ShowError($v);
		}
		?>
	</div>
	<?

	$normalCount = count($arResult["ITEMS"]["AnDelCanBuy"]);
	$normalHidden = ($normalCount == 0) ? "style=\"display:none\"" : "";

	$delayCount = count($arResult["ITEMS"]["DelDelCanBuy"]);
	$delayHidden = ($delayCount == 0) ? "style=\"display:none\"" : "";

	$subscribeCount = count($arResult["ITEMS"]["ProdSubscribe"]);
	$subscribeHidden = ($subscribeCount == 0) ? "style=\"display:none\"" : "";

	$naCount = count($arResult["ITEMS"]["nAnCanBuy"]);
	$naHidden = ($naCount == 0) ? "style=\"display:none\"" : "";

	?>
		<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="basket_form" id="basket_form">
			<div id="basket_form_container">
				<div class="bx_ordercart">
					<!-- <div class="bx_sort_container">
						<span><?=GetMessage("SALE_ITEMS")?></span>
						<a href="javascript:void(0)" id="basket_toolbar_button" class="current" onclick="showBasketItemsList()"><?=GetMessage("SALE_BASKET_ITEMS")?><div id="normal_count" class="flat" style="display:none">&nbsp;(<?=$normalCount?>)</div></a>
						<a href="javascript:void(0)" id="basket_toolbar_button_delayed" onclick="showBasketItemsList(2)" <?=$delayHidden?>><?=GetMessage("SALE_BASKET_ITEMS_DELAYED")?><div id="delay_count" class="flat">&nbsp;(<?=$delayCount?>)</div></a>
						<a href="javascript:void(0)" id="basket_toolbar_button_subscribed" onclick="showBasketItemsList(3)" <?=$subscribeHidden?>><?=GetMessage("SALE_BASKET_ITEMS_SUBSCRIBED")?><div id="subscribe_count" class="flat">&nbsp;(<?=$subscribeCount?>)</div></a>
						<a href="javascript:void(0)" id="basket_toolbar_button_not_available" onclick="showBasketItemsList(4)" <?=$naHidden?>><?=GetMessage("SALE_BASKET_ITEMS_NOT_AVAILABLE")?><div id="not_available_count" class="flat">&nbsp;(<?=$naCount?>)</div></a>
					</div> -->
					<?
					include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items.php");
					include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_delayed.php");
					include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_subscribed.php");
					include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items_not_available.php");
					?>
				</div>
			</div>
			<input type="hidden" name="BasketOrder" value="BasketOrder" />
			<!-- <input type="hidden" name="ajax_post" id="ajax_post" value="Y"> -->
		</form>
	<?
}
else
{
	/*ShowError($arResult["ERROR_MESSAGE"]);*/
	include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket_items.php");
}
?>

<?
/*
if($USER->IsAdmin() && $USER->GetID() == 126) 
{
	echo '<pre>'; 
	//print_r($arResult['GRID']['ROWS']);
	echo '</pre>';	
}
/**/
?>