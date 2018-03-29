<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(false);
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">

<head>
        <meta charset="UTF-8">
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />

		
<title><? $APPLICATION->ShowTitle(false); ?></title>
<?if ($curPage == '/'){?>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/paralacs.css">
<?}else{?>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/not-main.css">
<?}?>
<?$APPLICATION->ShowHead();?>
<title><?$APPLICATION->ShowTitle()?></title>
<?$APPLICATION->ShowMeta("keywords")?>
<?$APPLICATION->ShowMeta("description")?>
<?

$APPLICATION->ShowPanel();
?>



    </head>
<body class="main <?if ($curPage == '/'){ echo "main-page";}?>">
<div  class="container-fluid" id="bg-header"></div>
<div class="page_overlay js-preload-overlay"></div>
<div class="container-fluid">


<!-- header-menu-->
<?if ($curPage == '/'){?>
	<div class="header-menu motopress-wrapper header">

			<div class="container">
		
				<div class="row">
<?}?>

<nav class="main_nav">
    <div class="main_nav__contaner row">
	<div class="span5 col-xs-6 col-sm-6 col-md-2 col-lg-3" >
		<!-- BEGIN LOGO -->
		<div class="logo pull-left">
			<div class="logo_h logo_h__txt"><a href="/" title="" class="logo_link">
				<img alt="Ceramo" src="<?=SITE_TEMPLATE_PATH?>/img/CR_logo.png" class="logo_img">
				<br/>Ceramo
			</a></div>
		</div>
		<!-- END LOGO -->		
	</div>

	<div class="main_nav__links_box  col-xs-6 col-sm-6 col-md-10 col-lg-9">
		<div class='row'>
			<div class='block_tel  hidden-xs hidden-sm col-md-5 col-lg-4'>
				<div class='nav_tel'>
					<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_TEMPLATE_PATH.'/inc/tel.php'
					)
					);?>
				</div>
				<div class='nav_tel2'>
					<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_TEMPLATE_PATH.'/inc/tel2.php'
					)
					);?>
				</div>
			</div>
			<div class='block_grafik  hidden-xs hidden-sm col-md-5 col-lg-5'>
					<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_TEMPLATE_PATH.'/inc/grafik.php'
					)
					);?>
			</div>


			<div class='block_tel_afterm  col-xs-12 col-sm-12 hidden-md hidden-lg'>
				<div class='nav_tel'>
					<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_TEMPLATE_PATH.'/inc/tel.php'
					)
					);?>
				</div>
				<div class='nav_tel2'>
					<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => SITE_TEMPLATE_PATH.'/inc/tel2.php'
					)
					);?>
				</div>
			</div>
		</div>
 <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_menu_mob", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "top_menu_mob"
	),
	false
);?>
<span class="row bascet_top_m">  <!--class='hidden-md hidden-lg'-->
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"bascet_head", 
	array(
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"SHOW_PRODUCTS" => "N",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"COMPONENT_TEMPLATE" => "bascet_head",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"SHOW_EMPTY_VALUES" => "N",
		"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_AUTHORIZE" => ""
	),
	false
);?>
</span>
<span class='hidden-xs hidden-sm'>
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	".default", 
	array(
		"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "Y",
		"POSITION_HORIZONTAL" => "right",
		"POSITION_VERTICAL" => "top",
		"SHOW_AUTHOR" => "Y",
		"SHOW_DELAY" => "Y",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_IMAGE" => "Y",
		"SHOW_NOTAVAIL" => "Y",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "Y",
		"SHOW_PRICE" => "Y",
		"SHOW_PRODUCTS" => "Y",
		"SHOW_SUBSCRIBE" => "N",
		"SHOW_SUMMARY" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
</span>
			</div>


    </div>

</nav>
<?if ($curPage == '/'){ ?>
				</div>


			</div>

		</div>
<?}?>
<!--end header-menu-->
                            




<?if ($curPage == '/'){?>
<div id="scroll-animate">
  <div id="scroll-animate-main">
    <div class="wrapper-parallax">
<?}?>



<?if ($curPage == '/'){?>
      <header>
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"slider", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "slider",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "18",
		"IBLOCK_TYPE" => "slider",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "слайд",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			
			0 => "lg",
			1 => "md",
			2 => "xs",
			3 => "sm",
			
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "TIMESTAMP_X",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
      </header>
<?}?>



<section class="content">

<div class='row'>
<?$APPLICATION->IncludeComponent("bitrix:search.title", "find_c", Array(
	"NUM_CATEGORIES" => "1",	// Кількість категорій пошуку
		"TOP_COUNT" => "5",	// Кількість результатів у кожній категорії
		"CHECK_DATES" => "N",	// Шукати тільки в активних за датою документах
		"SHOW_OTHERS" => "N",	// Показувати категорію «інше»
		"PAGE" => SITE_DIR."catalog/",	// Сторінка видачі результатів пошуку (доступний макрос #SITE_DIR#)
		"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),	// Назва категорії
		"CATEGORY_0" => array(	// Обмеження області пошуку
			0 => "iblock_1c_catalog",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "all",
		),
		"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
		"SHOW_INPUT" => "Y",	// Показувати форму вводу пошукового запиту
		"INPUT_ID" => "title-search-input",	// ID рядка вводу пошукового запиту
		"CONTAINER_ID" => "search",	// ID контейнера, по ширині якого будуть виводитися результати
		"PRICE_CODE" => array(	// Тип ціни
			0 => "BASE",
		),
		"SHOW_PREVIEW" => "Y",	// Показати картинку
		"PREVIEW_WIDTH" => "75",	// Ширина картинки
		"PREVIEW_HEIGHT" => "75",	// Висота картинки
		"CONVERT_CURRENCY" => "Y",	// Показувати ціни в одній валюті
		"COMPONENT_TEMPLATE" => "visual",
		"ORDER" => "date",	// Сортування результатів
		"USE_LANGUAGE_GUESS" => "Y",	// Увімкнути автовизначення розкладки клавіатури
		"PRICE_VAT_INCLUDE" => "Y",	// Включати ПДВ в ціну
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальна довжина анонса для виведення
		"CURRENCY_ID" => "UAH",	// Валюта, в яку будуть сконвертовані ціни
		"CATEGORY_0_iblock_1c_catalog" => array(	// Шукати в інформаційних блоках типу "iblock_1c_catalog"
			0 => "all",
		)
	),
	false
);?>
		</div>
		<div class='row'>
			<div class='case-workspace col-xs-12 col-sm-12'>
			<?php

			  if((stristr($curPage, '/catalog/') === FALSE) || (strlen($curPage)<=9)) {//     echo '"/catalog/" не найдена в строке';
			?>
					<!--div class='case-banner hidden-xs hidden-sm'-->

					<div class='hidden-xs col-md-3 col-sm-4'>
						<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "inc_baner",
		"EDIT_TEMPLATE" => "",
		"PATH" => SITE_TEMPLATE_PATH."/inc/case-banner.php",
		"COMPONENT_TEMPLATE" => ".default",
		"AREA_FILE_RECURSIVE" => "Y"
	),
	false
);?></div>
					<!--div class='case-content col-xs-12 col-sm-12'-->
					<div class='col-md-9 col-sm-8 col-xs-12'>							
							
 				<? }else{?>
					<div class='col-xs-12 col-sm-12'>
				<?}?>

