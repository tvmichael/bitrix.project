<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\IO,
    Bitrix\Main\Application;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
 ?>

<div class="bx-badge-container">
	<div class="bx-badge-inner">
		<?if($arParams['SHOW_BADGES'] == 'Y'):?>

			<?
			// DELIVERY
			if ( count($arResult['DELIVERY']) > 0 && $arParams['SHOW_BADGES_DELIVERY'] == 'Y' ):
			?>
				<div class='bx-badge-delivery'>
					<img src='<?=($templateFolder.'/images/'.$arParams['SHOW_BADGES_DELIVERY_IMG']);?>'>
				</div>
			<? endif; ?>

			<?
			// CERTIFICATE
			if ( count($arResult['CERTIFICATE']) > 0 && $arParams['SHOW_BADGES_CERTIFICATE'] == 'Y' ):
				$images = $arParams['SHOW_BADGES_CERTIFICATE_IMG'];
				$price = 0;

				foreach ($arResult['CERTIFICATE'] as $value) {
					if (isset($value['SHORT_DESCRIPTION_STRUCTURE']['VALUE']))
						if( $value['SHORT_DESCRIPTION_STRUCTURE']['VALUE'] > $price && $value['SHORT_DESCRIPTION_STRUCTURE']['VALUE_TYPE']=='F' )
							$price = $value['SHORT_DESCRIPTION_STRUCTURE']['VALUE'];
				}
				if ($price > 0 ):
					$images = explode('.', $images);
					if (count($images) == 2){
						$images = $images[0].$price.'.'.$images[1];
					}				
					$file = $templateFolder.'/images/'.$images;
					?>

					<div class='bx-badge-certificate'>
						<img src='<?=$file;?>'>
					</div>
				<? endif; ?>
			<? endif; ?>

			<?
			// STOCK
			if ( count($arResult['STOCK']) > 0 && $arParams['SHOW_BADGES_STOCK'] == 'Y' ):
			?>
				<div class='bx-badge-stock'>
					<img src='<?=($templateFolder.'/images/'.$arParams['SHOW_BADGES_STOCK_IMG']);?>'>
				</div>
			<? endif; ?>

			<?
			// DISCOUNT
			if ( count($arResult['DISCOUNT']) > 0 && $arParams['SHOW_BADGES_DISCOUNT'] == 'Y' ):
			?>
				<div class='bx-badge-discount'>
					<img src='<?=($templateFolder.'/images/'.$arParams['SHOW_BADGES_DISCOUNT_IMG']);?>'>
				</div>
			<? endif;?>

			<?
			// GIFT
			if ( count($arResult['GIFT']) > 0 && $arParams['SHOW_BADGES_GIFT'] == 'Y'):
			?>
				<div class='bx-badge-gift'>
					<img src='<?=($templateFolder.'/images/'.$arParams['SHOW_BADGES_GIFT_IMG']);?>'>
				</div>
			<? endif;?>

		<?endif;?>
	</div>
</div>




<?
if ( $USER->IsAdmin() && $USER->GetID() == 106 && false )
{?>
<pre style="position: absolute; z-index: 500;">
<?
echo "Params:<br>";
print_r($arParams);
echo "<hr>";
echo "Result:<br>";
print_r($arResult);
?>
</pre>
<?};
/**/
?>