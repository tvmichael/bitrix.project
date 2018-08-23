<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("k");
?><h2>K</h2>
 <br>
 <?$APPLICATION->IncludeComponent(
	"mv:badge.check",
	"",
	Array(
		"BADGE_ARRAY" => $arResult,
		"BADGE_CATALOG" => "0",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SHOW_BADGES" => "Y",
		"SHOW_BADGES_CERTIFICATE" => "Y",
		"SHOW_BADGES_CERTIFICATE_IMG" => "certificate100.png",
		"SHOW_BADGES_DELIVERY" => "Y",
		"SHOW_BADGES_DELIVERY_IMG" => "delivery.png",
		"SHOW_BADGES_DISCOUNT" => "Y",
		"SHOW_BADGES_DISCOUNT_IMG" => "discount.png",
		"SHOW_BADGES_GIFT" => "Y",
		"SHOW_BADGES_GIFT_IMG" => "gift.png",
		"SHOW_BADGES_STOCK" => "Y",
		"SHOW_BADGES_STOCK_IMG" => "stock.png"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>