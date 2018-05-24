<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Результат");
?>
<h2>РЕЗУЛЬТАТ</h2>

<?
if($USER->IsAdmin() && $USER->GetID() == 126) 
{
	echo '<pre>'; 	
	//print_r($categoryPath);
		




	echo '</pre>';
}
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>