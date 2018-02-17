<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<?IncludeTemplateLangFile(__FILE__);
$curPage = $APPLICATION->GetCurPage(false);?>
<?
global $cur_lang;
$cur_lang = strtolower(LANGUAGE_ID);
?>
<?
$GLOBALS['arrFilterLANG'] = array("PROPERTY_SITELANG_VALUE"=>$cur_lang);
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700&amp;subset=cyrillic" rel="stylesheet">
    <link rel="shortcut" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
    <?$APPLICATION->ShowHead();?>
    <?$APPLICATION->SetAdditionalCSS("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");?>
    <title><? $APPLICATION->ShowTitle();?></title>





<?/* $APPLICATION->ShowCSS();*/?>
<?// $APPLICATION->ShowHeadScripts();?>
<?// $APPLICATION->ShowHeadStrings();?>



</head>

<body class="<?=LANGUAGE_ID?>">

<? $APPLICATION->ShowPanel();?>






<div class="container header">

    <div class="row">
            <div class="hidden-xs hidden-sm col-md-5 contacts">
                <div class="col-md-6 tel">1111111111111</div>
                <div class="col-md-6 email">11111@11111111.23</div>
            </div>
            <div class="col-xs-4 col-sm-3 col-md-2 top-logo">
                        <div class="hidden-xs hidden-sm col-md-12 ziro"></div>
                        <div class="xs-12 logo"><img src="http://fakeimg.pl/85x85/00CED1/FFF/?text=img+placeholder"></div>
            </div>
        <div class="col-xs-8 col-sm-9 col-md-5 top-right">
            	<div class="col-xs-4 lang">
		<ul>

	<?$lang='/'.LANGUAGE_ID.'/';
	 if(LANGUAGE_ID != 'ua') {?>
<li role="menuitem"><a href="<?=str_replace($lang, "/ua/", $curPage)?>?lang=ua">UKR</a></li>
										<?}else{?>
										<li class="select" role="menuitem">UKR</li>
										<?} ?>
										<? if(LANGUAGE_ID != 'en') {?>
<li role="menuitem"><a href="<?=str_replace($lang, "/en/", $curPage)?>?lang=en">ENG</a></li>
										<?}else{?>
										<li class="select" role="menuitem">ENG</li>
										<?} ?>
										<? if(LANGUAGE_ID != 'ru') {?>
<li role="menuitem"><a href="<?=str_replace($lang, "/ru/", $curPage)?>?lang=ru">RUS</a></li>
										<?}else{?>
										<li class="select" role="menuitem">RUS</li>
										<?} ?>
																<!--<li><a href="/auth/">Авторизуватись</a></li-->
		</ul>


		</div>
                <div class="col-xs-8">
                    <div class="col-xs-6 login">
<?
global $USER;
if ($USER->IsAuthorized()){ ?>
		вхід
		<?//echo GetMessage("вхід");?>
	<?}else{ ?>
		мій кабінет
		<?//echo GetMessage("miy_kabinet");?>
	<?} 
	?>
                    </div>
                    <div class="col-xs-6 basket">
                                        <?$APPLICATION->IncludeComponent(
                                                "bitrix:sale.basket.basket.line",
                                                ".default",
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
                                                        "COMPONENT_TEMPLATE" => ".default",
                                                        "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                                                        "SHOW_EMPTY_VALUES" => "Y",
                                                        "PATH_TO_AUTHORIZE" => "",
                                                        "HIDE_ON_BASKET_PAGES" => "Y"
                                                ),
                                                false
                                        );?>

                    </div>
                    <div class="col-xs-12 poshuk">
                                    <?$APPLICATION->IncludeComponent("bitrix:search.title", "visual", array(
                                                        "NUM_CATEGORIES" => "1",
                                                        "TOP_COUNT" => "5",
                                                        "CHECK_DATES" => "N",
                                                        "SHOW_OTHERS" => "N",
                                                        "PAGE" => SITE_DIR.LANGUAGE_ID."/catalog/",
                                                        "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS") ,
                                                        "CATEGORY_0" => array(
                                                                0 => "iblock_catalog",
                                                        ),
                                                        "CATEGORY_0_iblock_catalog" => array(
                                                                0 => "all",
                                                        ),
                                                        "CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
                                                        "SHOW_INPUT" => "Y",
                                                        "INPUT_ID" => "title-search-input",
                                                        "CONTAINER_ID" => "search",
                                                        "PRICE_CODE" => array(
                                                                0 => "BASE",
                                                        ),
                                                        "SHOW_PREVIEW" => "Y",
                                                        "PREVIEW_WIDTH" => "75",
                                                        "PREVIEW_HEIGHT" => "75",
                                                        "CONVERT_CURRENCY" => "Y"
                                                ),
                                                false
                                    );?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">        
    <div class="row">
        <!-- TOP MENU --> 
        <div class="col-xs-12 top-menu <?if($curPage ==  '/'.LANGUAGE_ID.'/'){echo 'menu-home';}else{echo 'menu-otherpage';}?>">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:menu", 
                "catalog_horizontal", 
                array(
                    "ROOT_MENU_TYPE" => "left",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_TIME" => "36000000",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_THEME" => "site",
                    "CACHE_SELECTED_ITEMS" => "N",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MAX_LEVEL" => "3",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "Y",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                ),
                false
            );
            ?>
        </div>

        <!-- SLIDER -->
        <? if (true) // ( $curPage == '/'.LANGUAGE_ID.'/') 
        {?>
            <div class="col-xs-12 top-slider">
                <?if (IsModuleInstalled("advertising")):?>
                    <?
                    $APPLICATION->IncludeComponent("bitrix:news.list", "news.list.slider", Array(
                    	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показу дати
                    		"ADD_SECTIONS_CHAIN" => "N",	// Включати розділ у ланцюжок навігації
                    		"AJAX_MODE" => "N",	// Увімкнути режим AJAX
                    		"AJAX_OPTION_ADDITIONAL" => "",	// Додатковий ідентифікатор
                    		"AJAX_OPTION_HISTORY" => "N",	// Увімкнути емуляцію навігації браузера
                    		"AJAX_OPTION_JUMP" => "N",	// Увімкнути прокручування до початку компонента!
                    		"AJAX_OPTION_STYLE" => "Y",	// Увімкнути підвантаження стилів
                    		"CACHE_FILTER" => "N",	// Кешувати при встановленому фільтрі
                    		"CACHE_GROUPS" => "Y",	// Враховувати права доступу
                    		"CACHE_TIME" => "36000000",	// Час кешування, сек.
                    		"CACHE_TYPE" => "A",	// Тип кешування
                    		"CHECK_DATES" => "Y",	// Показувати тільки активні на даний момент елементи
                    		"DETAIL_URL" => "",	// URL сторінки детального перегляду (за умовчанням — з налаштувань інфоблоку)
                    		"DISPLAY_BOTTOM_PAGER" => "N",	// Виводити під списком
                    		"DISPLAY_DATE" => "N",	// Виводити дату елемента
                    		"DISPLAY_NAME" => "N",	// Виводити назву елемента
                    		"DISPLAY_PICTURE" => "Y",	// Виводити зображення для анонсу
                    		"DISPLAY_PREVIEW_TEXT" => "N",	// Виводити текст анонсу
                    		"DISPLAY_TOP_PAGER" => "N",	// Виводити над списком
                    		"FIELD_CODE" => array(	// Поля
                    			0 => "",
                    			1 => "",
                    		),
                    		"FILTER_NAME" => "",	// Фільтр
                    		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Приховувати посилання, якщо немає детального опису
                    		"IBLOCK_ID" => "6",	// Код інформаційного блоку
                    		"IBLOCK_TYPE" => "news",	// Тип інформаційного блоку (використовується тільки для перевірки)
                    		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включати інфоблок у ланцюжок навігації
                    		"INCLUDE_SUBSECTIONS" => "N",	// Показувати елементи підрозділів розділу
                    		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
                    		"NEWS_COUNT" => "20",	// Кількість новин на сторінці
                    		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                    		"PAGER_DESC_NUMBERING" => "N",	// Використовувати зворотню навігацію
                    		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Час кешування сторінок для зворотньої навігації
                    		"PAGER_SHOW_ALL" => "N",	// Показувати посилання «Усі»
                    		"PAGER_SHOW_ALWAYS" => "N",	// Виводити завжди
                    		"PAGER_TEMPLATE" => ".default",	// Шаблон посторінковою навігації
                    		"PAGER_TITLE" => "Новости",	// Назва категорій
                    		"PARENT_SECTION" => "",	// ID розділу
                    		"PARENT_SECTION_CODE" => "",	// Код розділу
                    		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальна довжина анонсу для виведення (лише для типу текст)
                    		"PROPERTY_CODE" => array(	// Властивості
                    			0 => "YOUTUBE_LINK",
                    			1 => "",
                    		),
                    		"SET_BROWSER_TITLE" => "N",	// Встановлювати заголовок вікна браузера
                    		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                    		"SET_META_DESCRIPTION" => "N",	// Встановлювати опис сторінки
                    		"SET_META_KEYWORDS" => "N",	// Встановлювати ключові слова сторінки
                    		"SET_STATUS_404" => "N",	// Устанавливать статус 404
                    		"SET_TITLE" => "N",	// Встановлювати заголовок сторінки
                    		"SHOW_404" => "N",	// Показ специальной страницы
                    		"SORT_BY1" => "ACTIVE_FROM",	// Поле для другого сортування новин
                    		"SORT_BY2" => "SORT",	// Поле для другого сортування новин
                    		"SORT_ORDER1" => "DESC",	// Напрямок для другого сортування новин
                    		"SORT_ORDER2" => "ASC",	// Напрямок для другого сортування новин
                    		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
                    	),
                    	false
                    );
                    ?>
                <?endif?>
            </div>
        <?} // end if $curPage ?>        
    </div>
</div>

<div class="container">
        <div class="row">
                