<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("k");
?><h2>K</h2>
 <br>
 <?$APPLICATION->IncludeComponent(
	"mv:badge.check", 
	".default", 
	array(
		"BADGE_ARRAY" => $arResult,
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SHOW_BADGES" => "Y",
		"SHOW_BADGES_CERTIFICATE" => "Y",
		"SHOW_BADGES_DELIVERY" => "Y",
		"SHOW_BADGES_DISCOUNT" => "Y",
		"SHOW_BADGES_GIFT" => "Y",
		"SHOW_BADGES_STOCK" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>