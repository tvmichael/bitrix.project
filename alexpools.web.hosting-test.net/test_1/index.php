<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результат");
?>

<h2>РЕЗУЛЬТАТ</h2>
<?
$APPLICATION->IncludeComponent(
	"bitrix:form.result.view", 
	"template_arhicode",
	Array(
	"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
		"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_URL" => "result_edit.php",	// Страница редактирования результата
		"RESULT_ID" => "12",	// ID результата
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"SHOW_ADDITIONAL" => "N",	// Показать дополнительные поля веб-формы
		"SHOW_ANSWER_VALUE" => "N",	// Показать значение параметра ANSWER_VALUE
		"SHOW_STATUS" => "Y",	// Показать текущий статус результата
	),
	false
);
?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>