<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
?>

<div class="text-center">
	<div class="bx-404-block">
		<h2>Страница не найдена <b>404<b></h2>
	</div>
	<p>Неправильно набран адрес,<br>
	или такой страницы на сайте больше не существует.</p>
	<p>Вернитесь на главную или воспользуйтесь картой сайта.</p>
</div>

<br>
<?
$APPLICATION->IncludeComponent("bitrix:main.map", "", Array(
	"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"LEVEL" => "0",	// Максимальный уровень вложенности (0 - без вложенности)
		"COL_NUM" => "2",	// Количество колонок
		"SHOW_DESCRIPTION" => "Y",	// Показывать описания
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>