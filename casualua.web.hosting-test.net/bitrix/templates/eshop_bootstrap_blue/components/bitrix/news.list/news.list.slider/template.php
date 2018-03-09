<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'id' => $mainId.'_carusel',
    'video' => array(),
);
$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$carouselListCount = count($arResult["ITEMS"]);
?>

<div id="<?echo $itemIds['id'];?>" class="carousel slide cs-carusel" data-ride="carousel" data-interval="false">
	<!-- Indicators -->
	<div class="carousel-indicators">
		<?for ($i = 0; $i < $carouselListCount; $i++)
		{?>
			<span data-target="#<?echo $itemIds['id'];?>" data-slide-to="<? echo $i;?>" class="cs-carousel-indicators <?if($i == 0) echo 'active';?>"></span>
		<?};?>		
	</div>

	<!-- Wrapper for slides -->
	<div class="carousel-inner cs-height" role="listbox">

		<? foreach( $arResult["ITEMS"] as $i => $arItem ):

			if( strlen($arItem['PREVIEW_PICTURE']['SRC']) > 1):?>
				<div class="item <? if($i == 0) echo'active'; ?>" data-type="img">
    			    <img class="cs-inner-img" src="<? echo $arItem['PREVIEW_PICTURE']['SRC']; ?>" alt="<? echo $arItem['NAME']; ?>">
				</div>

			<? elseif (strlen($arItem['PROPERTIES']['SLIDER_YOUTUBE_LINK']['~VALUE']) > 1 ):?>
				<div class="item cs-inner-video <? if($i == 0) echo'active'; ?>" data-type="video">
                    <?                    
                    $url = $arItem['PROPERTIES']['SLIDER_YOUTUBE_LINK']['~VALUE'];
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                    $videoId = $matches[1];

                    $itemIds['video'][$i] = array(
                        'id' => $mainId.'_video'.$arItem['ID'],
                        'name' => $arItem['NAME'],
                        'src' => $arItem['PROPERTIES']['SLIDER_YOUTUBE_LINK']['~VALUE'],
                        'videoId' =>$videoId,
                    );
                    ?>
                    <div id="<? echo $itemIds['video'][$i]['id'];?>"></div>
				</div>
			<? endif; ?>

		<? endforeach; ?>
	</div>

	<!-- Controls -->
    <div class="cs-carousel-control">
        <a class="cs-carousel-control-button left " href="#<?echo $itemIds['id'];?>" role="button" data-slide="prev">
            <span class="fa fa-angle-left cs-text" aria-hidden="true"></span>
        </a>
        <a class="cs-carousel-control-button right " href="#<?echo $itemIds['id'];?>" role="button" data-slide="next">
            <span class="fa fa-angle-right cs-text" aria-hidden="true"></span>
        </a>
    </div>
</div>

<script>
    BX.ready(function(){
        var <?=$obName?> = new JSCarouselElement(<?=CUtil::PhpToJSObject($itemIds, false, true)?>);
    });
</script>
<? unset($itemIds); ?>






