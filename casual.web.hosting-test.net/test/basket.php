<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("basket");
?>

<h2>ADD TO BASKET</h2>
Product
<button id="cs_add">ADD</button>

<script type="text/javascript">

	$("#cs_add").click(function(){
		console.log('ADD');

		var basketData = { id: "889"};

		$.get( "ajax_basket.php", basketData )
		  	.done(function( data ) {
		    	console.log(data);
		});


	});

</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>