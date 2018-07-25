<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IS_SEF" => "Y",
		"SEF_BASE_URL" => "/catalog/",
		"SECTION_PAGE_URL" => "#SECTION_CODE#/",
		"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "79",
		"DEPTH_LEVEL" => "4",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?> <? 
/*
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if (!function_exists("GetTreeRecursive")) //Include from main.map component
{
$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:eshop.menu.sections", "", array(
	"IBLOCK_TYPE_ID" => "catalog",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000"
	),
	false,
	Array('HIDE_ICONS' => 'Y')
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
}
*/
?>