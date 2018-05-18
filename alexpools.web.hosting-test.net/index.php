<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Интернет-магазин \"Бассейн\"");
$APPLICATION->SetTitle("Интернет-магазин \"Бассейн\"");
?>
<? header( 'Location: /catalog/', true, 303 );?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>