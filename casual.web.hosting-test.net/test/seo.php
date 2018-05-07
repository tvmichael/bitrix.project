<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("SEO");
?>
<h2>JS</h2>

<script type="text/javascript">
	var thisX = document.createElement('div');
	thisX.id = 'dx-001';
	thisX.innerHTML = '<h3>X-X</h3>';

	$('body').append(thisX);


</script>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>


