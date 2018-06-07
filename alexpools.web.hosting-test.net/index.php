<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Интернет-магазин \"Бассейн\"");
$APPLICATION->SetTitle("Интернет-магазин \"Бассейн\"");
?>

<?if(defined("ERROR_404") && ERROR_404 == "Y" && $APPLICATION->GetCurPage(true) !='/404.php')  LocalRedirect('/404.php');?>

<? header( 'Location: /catalog/', true, 303 );?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>