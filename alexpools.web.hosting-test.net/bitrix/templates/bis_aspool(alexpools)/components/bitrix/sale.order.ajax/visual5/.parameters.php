<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"ALLOW_NEW_PROFILE" => array(
		"NAME"=>GetMessage("T_ALLOW_NEW_PROFILE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT"=>"Y",
		"PARENT" => "BASE",
	),
	"PATH_TO_ORDER" => Array(
		"NAME" => GetMessage("PATH_TO_ORDER"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"COLS" => 25,
		"PARENT" => "ADDITIONAL_SETTINGS"
	),
);

?>