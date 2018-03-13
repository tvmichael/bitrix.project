<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("tempmvedit");
// $APPLICATION->AddHeadScript($APPLICATION->GetTemplatePath().'components/bitrix/catalog/arhi_cat_mv/bitrix/catalog.element/visual/js/main.js');
// $APPLICATION->AddHeadScript($APPLICATION->GetTemplatePath().'components/bitrix/catalog/arhi_cat_mv/bitrix/catalog.element/visual/js/pgwslider.min.js');
// $APPLICATION->SetAdditionalCSS($APPLICATION->GetTemplatePath().'components/bitrix/catalog/arhi_cat_mv/bitrix/catalog.element/visual/js/pgwslider.min.css');
$APPLICATION->SetAdditionalCSS('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css');
?>

<!-- ASDSA-00 -->
<!-- jQuery -->
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?
//echo SITE_TEMPLATE_PATH;
// текущая страница:
//echo '<br>DIR: '.$templateFolder;
//echo '<br>DIR: '.$templateFile;
//echo '<br>:'.$APPLICATION->GetTemplatePath().'components/bitrix/catalog/arhi_cat_mv/bitrix/catalog.element/visual/js/main.js';
//echo "<br>:/bitrix/templates/bis_aspool(alexpools)/components/bitrix/catalog/arhi_cat_mv/bitrix/catalog.element/visual/js/main.js";
?>

<h1 style="font-size: 26px; color: red; margin: 10px; padding: 10px; text-align: center; border-bottom: 2px solid gray;">
DONT WORK :( 
</h1>


<?
$APPLICATION->IncludeComponent("bitrix:catalog", "arhi_cat_mv", Array(
	"ACTION_VARIABLE" => "action",	// Название переменной, в которой передается действие
		"ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
		"ADD_PICT_PROP" => "MORE_PHOTO",	// Дополнительная картинка основного товара
		"ADD_PROPERTIES_TO_BASKET" => "Y",	// Добавлять в корзину свойства товаров и предложений
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"BASKET_URL" => "/personal/basket.php",	// URL, ведущий на страницу с корзиной покупателя
		"BIG_DATA_RCM_TYPE" => "personal",
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"COMMON_ADD_TO_BASKET_ACTION" => "ADD",
		"COMMON_SHOW_CLOSE_POPUP" => "N",
		"COMPATIBLE_MODE" => "Y",	// Включить режим совместимости
		"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
		"DETAIL_ADD_TO_BASKET_ACTION" => array(
			0 => "BUY",
		),
		"DETAIL_ADD_TO_BASKET_ACTION_PRIMARY" => array(
			0 => "BUY",
		),
		"DETAIL_BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
		"DETAIL_BRAND_USE" => "N",
		"DETAIL_BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",	// Использовать код группы из переменной, если не задан раздел элемента
		"DETAIL_DETAIL_PICTURE_MODE" => array(
			0 => "POPUP",
		),
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"DETAIL_IMAGE_RESOLUTION" => "16by9",
		"DETAIL_MAIN_BLOCK_PROPERTY_CODE" => "",
		"DETAIL_META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
		"DETAIL_META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
		"DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
		"DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
		"DETAIL_PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "",
		),
		"DETAIL_SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",	// Включить сохранение информации о просмотре товара на детальной странице для старых шаблонов
		"DETAIL_SHOW_POPULAR" => "Y",
		"DETAIL_SHOW_SLIDER" => "Y",
		"DETAIL_SHOW_VIEWED" => "Y",
		"DETAIL_SLIDER_INTERVAL" => "5000",
		"DETAIL_SLIDER_PROGRESS" => "N",
		"DETAIL_STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для детального показа элемента
		"DETAIL_USE_COMMENTS" => "N",	// Включить отзывы о товаре
		"DETAIL_USE_VOTE_RATING" => "N",	// Включить рейтинг товара
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",	// Не подключать js-библиотеки в компоненте
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"ELEMENT_SORT_FIELD" => "sort",	// По какому полю сортируем товары в разделе
		"ELEMENT_SORT_FIELD2" => "id",	// Поле для второй сортировки товаров в разделе
		"ELEMENT_SORT_ORDER" => "asc",	// Порядок сортировки товаров в разделе
		"ELEMENT_SORT_ORDER2" => "desc",	// Порядок второй сортировки товаров в разделе
		"FILTER_HIDE_ON_MOBILE" => "N",
		"FILTER_VIEW_MODE" => "VERTICAL",	// Вид отображения умного фильтра
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",	// Текст заголовка "Подарки" в детальном просмотре
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",	// Скрыть заголовок "Подарки" в детальном просмотре
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",	// Количество элементов в блоке "Подарки" в строке в детальном просмотре
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",	// Текст метки "Подарка" в детальном просмотре
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",	// Текст заголовка "Товары к подарку"
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",	// Скрыть заголовок "Товары к подарку" в детальном просмотре
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",	// Количество элементов в блоке "Товары к подарку" в строке в детальном просмотре
		"GIFTS_MESS_BTN_BUY" => "Выбрать",	// Текст кнопки "Выбрать"
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",	// Текст заголовка "Подарки" в списке
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",	// Скрыть заголовок "Подарки" в списке
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "4",	// Количество элементов в блоке "Подарки" строке в списке
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",	// Текст метки "Подарка" в списке
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",	// Показывать процент скидки
		"GIFTS_SHOW_IMAGE" => "Y",	// Показывать изображение
		"GIFTS_SHOW_NAME" => "Y",	// Показывать название
		"GIFTS_SHOW_OLD_PRICE" => "Y",	// Показывать старую цену
		"HIDE_NOT_AVAILABLE" => "N",	// Недоступные товары
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",	// Недоступные торговые предложения
		"IBLOCK_ID" => "79",	// Инфоблок
		"IBLOCK_TYPE" => "1c_catalog",	// Тип инфоблока
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"INSTANT_RELOAD" => "N",
		"LABEL_PROP" => "-",	// Свойство меток товара
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",	// Количество элементов, выводимых в одной строке таблицы
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",	// URL на страницу, где будет показан список связанных элементов
		"LINK_IBLOCK_ID" => "",	// ID инфоблока, элементы которого связаны с текущим элементом
		"LINK_IBLOCK_TYPE" => "",	// Тип инфоблока, элементы которого связаны с текущим элементом
		"LINK_PROPERTY_SID" => "",	// Свойство, в котором хранится связь
		"LIST_BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства раздела
		"LIST_ENLARGE_PRODUCT" => "STRICT",
		"LIST_META_DESCRIPTION" => "-",	// Установить описание страницы из свойства раздела
		"LIST_META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства раздела
		"LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"LIST_PROPERTY_CODE" => array(	// Свойства
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE_MOBILE" => "",
		"LIST_SHOW_SLIDER" => "Y",
		"LIST_SLIDER_INTERVAL" => "3000",
		"LIST_SLIDER_PROGRESS" => "N",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",	// Текст кнопки "Добавить в корзину"
		"MESS_BTN_BUY" => "Купить",	// Текст кнопки "Купить"
		"MESS_BTN_COMPARE" => "Сравнение",	// Текст кнопки "Сравнение"
		"MESS_BTN_DETAIL" => "Подробнее",	// Текст кнопки "Подробнее"
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_COMMENTS_TAB" => "Комментарии",
		"MESS_DESCRIPTION_TAB" => "Описание",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",	// Сообщение об отсутствии товара
		"MESS_PRICE_RANGES_TITLE" => "Цены",
		"MESS_PROPERTIES_TAB" => "Характеристики",
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Товары",	// Название категорий
		"PAGE_ELEMENT_COUNT" => "30",	// Количество элементов на странице
		"PARTIAL_PRODUCT_PROPERTIES" => "N",	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
		"PRICE_CODE" => "",	// Тип цены
		"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
		"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
		"PRODUCT_ID_VARIABLE" => "id",	// Название переменной, в которой передается код товара для покупки
		"PRODUCT_PROPERTIES" => "",	// Характеристики товара, добавляемые в корзину
		"PRODUCT_PROPS_VARIABLE" => "prop",	// Название переменной, в которой передаются характеристики товара
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// Название переменной, в которой передается количество товара
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SEARCH_CHECK_DATES" => "Y",
		"SEARCH_NO_WORD_LOGIC" => "Y",
		"SEARCH_PAGE_RESULT_COUNT" => "50",
		"SEARCH_RESTART" => "N",
		"SEARCH_USE_LANGUAGE_GUESS" => "Y",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
		"SECTIONS_VIEW_MODE" => "LINE",	// Вид списка подразделов
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"SECTION_BACKGROUND_IMAGE" => "-",	// Установить фоновую картинку для шаблона из свойства
		"SECTION_COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
		"SECTION_ID_VARIABLE" => "SECTION_ID",	// Название переменной, в которой передается код группы
		"SECTION_TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SHOW_DEACTIVATED" => "N",	// Показывать деактивированные товары
		"SHOW_DISCOUNT_PERCENT" => "N",	// Показывать процент скидки
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",	// Показывать старую цену
		"SHOW_PRICE_COUNT" => "1",	// Выводить цены для количества
		"SHOW_TOP_ELEMENTS" => "N",	// Выводить топ элементов
		"SIDEBAR_DETAIL_SHOW" => "N",
		"SIDEBAR_PATH" => "",
		"SIDEBAR_SECTION_SHOW" => "Y",
		"TEMPLATE_THEME" => "blue",
		"TOP_ADD_TO_BASKET_ACTION" => "ADD",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "desc",
		"TOP_ENLARGE_PRODUCT" => "STRICT",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"TOP_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"TOP_PROPERTY_CODE_MOBILE" => "",
		"TOP_SHOW_SLIDER" => "Y",
		"TOP_SLIDER_INTERVAL" => "3000",
		"TOP_SLIDER_PROGRESS" => "N",
		"TOP_VIEW_MODE" => "SECTION",
		"USER_CONSENT" => "N",	// Запрашивать согласие
		"USER_CONSENT_ID" => "0",	// Соглашение
		"USER_CONSENT_IS_CHECKED" => "Y",	// Галка по умолчанию проставлена
		"USER_CONSENT_IS_LOADED" => "N",	// Загружать текст сразу
		"USE_BIG_DATA" => "Y",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
		"USE_COMPARE" => "N",	// Разрешить сравнение товаров
		"USE_ELEMENT_COUNTER" => "Y",	// Использовать счетчик просмотров
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_FILTER" => "N",	// Показывать фильтр
		"USE_GIFTS_DETAIL" => "Y",	// Показывать блок "Подарки" в детальном просмотре
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",	// Показывать блок "Товары к подарку" в детальном просмотре
		"USE_GIFTS_SECTION" => "Y",	// Показывать блок "Подарки" в списке
		"USE_MAIN_ELEMENT_SECTION" => "N",	// Использовать основной раздел для показа элемента
		"USE_PRICE_COUNT" => "N",	// Использовать вывод цен с диапазонами
		"USE_PRODUCT_QUANTITY" => "N",	// Разрешить указание количества товара
		"USE_REVIEW" => "N",	// Разрешить отзывы
		"USE_SALE_BESTSELLERS" => "Y",
		"USE_STORE" => "N",	// Показывать блок "Количество товара на складе"
		"COMPONENT_TEMPLATE" => "arhi_cat",
		"DETAIL_SHOW_MAX_QUANTITY" => "N",	// Показывать общее количество товара
		"USE_ALSO_BUY" => "N",	// Показывать блок "С этим товаром покупают"
		"VARIABLE_ALIASES" => array(
			"ELEMENT_ID" => "ELEMENT_ID",
			"SECTION_ID" => "SECTION_ID",
		)
	),
	false
);
?>





<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>