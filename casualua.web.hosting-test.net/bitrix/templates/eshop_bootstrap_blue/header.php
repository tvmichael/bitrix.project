<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>

<?
IncludeTemplateLangFile(__FILE__);
global $curPage;
$curPage = $APPLICATION->GetCurPage(false);?>
<?
	global $lang;
	$lang='/'.LANGUAGE_ID.'/';?>
<?if (strpos($curPage, $lang) === false)// перевіряємо чи є lang у адресі сторінки
{
	if (strpos($curPage, '/ua/') !== false){
		LocalRedirect($curPage."?lang=ua");
	}elseif (strpos($curPage, '/ru/') !== false){
		LocalRedirect($curPage."?lang=ru");
	}elseif (strpos($curPage, '/en/') !== false){
		LocalRedirect($curPage."?lang=en");
	}
}

if(($curPage==='/')||($curPage===$lang)){
	// визначаємо чи ми на головні
	global $home_page;
	$home_page=1;
}



?>

<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>

        <meta charset="UTF-8">
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">

		<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-TFHV6PR');</script>
		<!-- End Google Tag Manager -->
		
		<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-3.3.1.min.js"></script>
		
        <link href="//fonts.googleapis.com/css?family=Roboto:300,400,400i,700&amp;subset=cyrillic" rel="stylesheet">
        <link rel="shortcut" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />


		<?$APPLICATION->ShowHead();?>
		<title><? $APPLICATION->ShowTitle();?></title>



<?// $APPLICATION->ShowCSS();?>
<?// $APPLICATION->ShowHeadScripts();?>
<?// $APPLICATION->ShowHeadStrings();?>


</head>

<body class="<?=LANGUAGE_ID?>">

	<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TFHV6PR"height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

<? $APPLICATION->ShowPanel();?>







<div class="container-fluid header">        
    <div class="row">


	<div class="container header-top hidden-md hidden-lg">
	
	
	
	<div class="top-logo col-xs-4  col-sm-2">
		<?if ($home_page!==1){?>
		<a href="/<?=LANGUAGE_ID?>/" class="">
		<?}?>
			<img src="<?=SITE_TEMPLATE_PATH?>/images/logo_white.png">
		<?if ($home_page!==1){?>
		</a>
		<?}?>
	</div>
		<div class="row header-top-left hidden-xs col-sm-6">
		<div class="phone">
				<i class="fa fa-phone" aria-hidden="true"></i> 
				<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => $lang."telephone.php"
	)
);?>
		</div><div class="email">
				<span style="white-space: nowrap;"><i class="fa fa-at" aria-hidden="true"></i> 
				<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => $lang."email.php"
	)
);?>
				</span>			
			</div>
		</div>
		<div class="header-top-right col-xs-8 col-sm-4">
			<div class="links col-xs-11">
				<div class="login  col-xs-5">
			<?
global $USER;
$UrlProfile=$lang.'personal/';
$UrlAuth=$lang.'auth/';?>

<?

if ($USER->IsAuthorized()){ 
		if($curPage===$UrlProfile){?>
				<?echo $USER->GetLogin();?>
		<?}else{?>
			<a href="<?=$UrlProfile?>" title="<?=GetMessage('TITLE_PROFILE')?>">
				<?//echo $USER->GetLogin();?>
				<i class="fa fa-user"></i>
			</a> 
			<a href="?logout=yes"  title="<?=GetMessage('TITLE_LOGOUT')?>">
				<i class="fa fa-sign-out"></i>
			</a>
		<?}?>
	<?}else{ 		
		if($curPage===$UrlAuth){?>
				<?//=GetMessage('TITLE_LOGIN')?>
				<i class="fa fa-sign-in"></i>
		<?}else{?>
			<a href="<?=$UrlAuth?>" title="<?=GetMessage('TITLE_LOGIN')?>">
				<?//=GetMessage('TITLE_LOGIN')?>
				<i class="fa fa-sign-in"></i>
			</a>
		
		<?}?>
	<?} 
	?>
			</div>
            <div class=" last col-xs-7">
				<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"top", 
	array(
		"PATH_TO_BASKET" => SITE_DIR."ua/personal/cart/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"SHOW_PRODUCTS" => "N",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"COMPONENT_TEMPLATE" => "top",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"SHOW_EMPTY_VALUES" => "Y",
		"PATH_TO_AUTHORIZE" => SITE_DIR."auth/",
		"HIDE_ON_BASKET_PAGES" => "N"
	),
	false
);?>
			</div>
        </div>
            		<div class="col-xs-1 lang">
				<ul>

						<?
						 if(LANGUAGE_ID != 'ua') {?>
						<li role="menuitem" class="col-xs-12 lang_name"><a href="<?=str_replace($lang, "/ua/", $curPage)?>?lang=ua">UA</a></li>
										<?}else{?>
										<li class="select col-xs-12 lang_name" role="menuitem">UA</li>
										<?} ?>
										<? if(LANGUAGE_ID != 'en') {?>
						<li role="menuitem" class="col-xs-12 lang_name"><a href="<?=str_replace($lang, "/en/", $curPage)?>?lang=en">EN</a></li>
										<?}else{?>
										<li class="select col-xs-12 lang_name" role="menuitem">EN</li>
										<?} ?>
										<? if(LANGUAGE_ID != 'ru') {?>
						<li role="menuitem" class="col-xs-12 lang_name"><a href="<?=str_replace($lang, "/ru/", $curPage)?>?lang=ru">RU</a></li>
										<?}else{?>
										<li class="select col-xs-12 lang_name" role="menuitem">RU</li>
										<?} ?>
																<!--<li><a href="/auth/">Авторизуватись</a></li-->
				</ul>


			</div>


		</div>	
	</div>


						    

<!--end container hidden-md hidden-lg -->




<div class="container hidden-xs hidden-sm">

    <div class="row">
            <div class="hidden-xs hidden-sm col-md-5 contacts">

			<div class="col-md-5 tel"><i class="fa fa-phone" aria-hidden="true"></i> 		
				<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => $lang."telephone.php"
	)
);?></div>
               		 <div class="col-md-7 email"><span style="white-space: nowrap;"><i class="fa fa-at" aria-hidden="true"></i>		
				<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => $lang."email.php"
	)
);?></span>			
			</div>
		</div>
     
            <div class="col-xs-4 col-sm-3 col-md-2 top-logo">
                        <div class="hidden-xs hidden-sm col-md-12 ziro"></div>
                        <div class="xs-12 logo">
						<?if ($home_page!==1){?>
						<a href="/<?=LANGUAGE_ID?>/" class="header_a_logo">
						<?}?>
							<img src="<?=SITE_TEMPLATE_PATH?>/images/logo_casualua.png" >
						<?if ($home_page!==1){?>
						</a>
						<?}?>
						</div>
            </div>
        <div class="col-xs-8 col-sm-9 col-md-5 top-right">
            	<div class="col-xs-4 lang">
		<ul>

	<?
	 if(LANGUAGE_ID != 'ua') {?>
<li role="menuitem" class="col-xs-4 lang_name"><a href="<?=str_replace($lang, "/ua/", $curPage)?>?lang=ua">UKR</a></li>
										<?}else{?>
										<li  class="col-xs-4 lang_name select" role="menuitem">UKR</li>
										<?} ?>
										<? if(LANGUAGE_ID != 'en') {?>
<li role="menuitem" class="col-xs-4 lang_name"><a href="<?=str_replace($lang, "/en/", $curPage)?>?lang=en">ENG</a></li>
										<?}else{?>
										<li class="select col-xs-4 lang_name" role="menuitem">ENG</li>
										<?} ?>
										<? if(LANGUAGE_ID != 'ru') {?>
<li role="menuitem" class="col-xs-4 lang_name"><a href="<?=str_replace($lang, "/ru/", $curPage)?>?lang=ru">RUS</a></li>
										<?}else{?>
										<li class="select col-xs-4 lang_name" role="menuitem">RUS</li>
										<?} ?>
																<!--<li><a href="/auth/">Авторизуватись</a></li-->
		</ul>


		</div>
                <div class="col-xs-8">
                    <div class="col-xs-6 login">

<?

if ($USER->IsAuthorized()){ 
		if($curPage===$UrlProfile){?>
				<?echo $USER->GetLogin();?>
		<?}else{?>
			<a href="<?=$UrlProfile?>" title="<?=GetMessage('TITLE_PROFILE')?>">
				<?//echo $USER->GetLogin();?>
				<i class="fa fa-user"></i>
			</a> 
			<a href="?logout=yes"  title="<?=GetMessage('TITLE_LOGOUT')?>">
				<i class="fa fa-sign-out"></i>
			</a>
		<?}?>
	<?}else{ 		
		if($curPage===$UrlAuth){?>
				<?=GetMessage('TITLE_LOGIN')?>
		<?}else{?>
			<a href="<?=$UrlAuth?>" title="<?=GetMessage('TITLE_LOGIN')?>">
				<?=GetMessage('TITLE_LOGIN')?>
			</a>
		
		<?}?>
	<?} 
	?>
                    </div>
                    <div class="col-xs-6 basket">
                                        <?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"top", 
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
		"COMPONENT_TEMPLATE" => "top",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"SHOW_EMPTY_VALUES" => "Y",
		"PATH_TO_AUTHORIZE" => SITE_DIR."auth/",
		"HIDE_ON_BASKET_PAGES" => "N"
	),
	false
);?>

                    </div>
                    <div class="col-xs-12 poshuk">
                                    <?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"top_serch", 
	array(
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => SITE_DIR.LANGUAGE_ID."/catalog/",
		"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
		"CATEGORY_0" => array(
			0 => "iblock_1c_catalog",
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
		"CONVERT_CURRENCY" => "Y",
		"COMPONENT_TEMPLATE" => "top_serch",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "Y",
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"CURRENCY_ID" => "UAH",
		"CATEGORY_0_iblock_1c_catalog" => array(
			0 => "all",
		)
	),
	false
);?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end container hidden-xs hidden-sm-->
</div></div>
<!-- end container-fluid header -->


<div class="container-fluid workspice"> 
     
    <div class="row">
        <!-- TOP MENU --> 
        <div class="col-xs-12 top-menu <?if($curPage ==  '/'.LANGUAGE_ID.'/'){echo 'menu-home';}else{echo 'menu-otherpage';}?> menu_top_<?=LANGUAGE_ID?>">
            <?
            $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"catalog_horizontal", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_THEME" => "grey",
		"CACHE_SELECTED_ITEMS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "3",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "catalog_horizontal"
	),
	false
);
            ?>
        </div>

        <!-- SLIDER -->
        <? if( $curPage == '/'.LANGUAGE_ID.'/')
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


<div class="container">
        <div class="row">
						<?$APPLICATION->IncludeComponent(
	"bitrix:eshop.socnet.links", 
	"cos-fixed", 
	array(
		"FACEBOOK" => "https://www.facebook.com/casualua",
		"GOOGLE" => "",
		"INSTAGRAM" => "https://www.instagram.com/uacasual/",
		"TWITTER" => "https://www.youtube.com/channel/UC4FjqzWOzSVncOeDDDSsJKw",
		"VKONTAKTE" => "",
		"COMPONENT_TEMPLATE" => "cos-fixed"
	),
	false
);
/**/
?>        