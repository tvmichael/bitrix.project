<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<div onclick="badge-container">
	<?if($arParams['SHOW_BADGES'] == 'Y'):?>

		<?/*
		// GIFT
		if ( count(getGiftIds($arResult['ID'])) >= 1 || count($arResult['ACTIVE_BADGE']['GIFT']) > 0):
		?>
			<div class='product-bx-gift'>
				<img src='<?=$templateFolder.'/images/gift.png';?>'>
			</div>
		<? endif; ?>
		<?
		// DELIVERY
		if ( count($arResult['ACTIVE_BADGE']['DELIVERY']) > 0 ):
		?>
			<div class='product-bx-delivery'>
				<img src='<?=$templateFolder.'/images/delivery.png';?>'>
			</div>
		<? endif; ?>
		<?
		// CERTIFICATE
		if ( count($arResult['ACTIVE_BADGE']['CERTIFICATE']) > 100 ):
		?>
			<div class='product-bx-certificate'>
				<img src='<?=$templateFolder.'/images/certificate.png';?>'>
			</div>
		<? endif; */?>

	<?endif;?>
</div>


<pre>
<?
//print_r($arParams);
//echo "<hr>";
//print_r($arResult);
?>
</pre>