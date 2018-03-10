<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?>
<?$APPLICATION->IncludeComponent(
	"arhicode:sale.order.ajax.mv", 
	//"bitrix:sale.order.ajax", 
	".default", Array(
	"PAY_FROM_ACCOUNT" => "N",	// Дозволити оплату з внутрішнього рахунку
		"COUNT_DELIVERY_TAX" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",	// Дозволити оплату з внутрішнього рахунку тільки в повному обсязі
		"ALLOW_AUTO_REGISTER" => "Y",	// Оформляти замовлення з автоматичною реєстрацією користувача
		"SEND_NEW_USER_NOTIFY" => "Y",	// Надсилати користувачеві лист, що він зареєстрований на сайті
		"DELIVERY_NO_AJAX" => "N",	// Коли розраховувати доставки з зовнішніми системами розрахунку
		"TEMPLATE_LOCATION" => "popup",	// Візуальний вигляд контрола вибору місцеположень
		"PROP_1" => "",
		"PATH_TO_BASKET" => "/personal/cart/",	// Шлях до сторінки кошика
		"PATH_TO_PERSONAL" => "/personal/order/",	// Шлях до сторінки персонального розділу
		"PATH_TO_PAYMENT" => "/personal/order/payment/",	// Сторінка підключення платіжної системи
		"PATH_TO_ORDER" => "/personal/order/make/",
		"SET_TITLE" => "Y",	// Встановлювати заголовок сторінки
		"SHOW_ACCOUNT_NUMBER" => "Y",
		"DELIVERY_NO_SESSION" => "Y",	// Перевіряти сесію при оформленні замовлення
		"COMPATIBLE_MODE" => "N",	// Режим сумісності для попереднього шаблону
		"BASKET_POSITION" => "before",	// Розташування списку товарів
		"BASKET_IMAGES_SCALING" => "adaptive",	// Режим відображення зображень товарів
		"SERVICES_IMAGES_SCALING" => "adaptive",	// Режим відображення допоміжних зображень
		"USER_CONSENT" => "N",	// Запитувати згоду
		"USER_CONSENT_ID" => "2",	// Угода
		"USER_CONSENT_IS_CHECKED" => "N",	// Галка за замовчуванням проставлена
		"USER_CONSENT_IS_LOADED" => "N",	// Завантажувати текст відразу
		"COMPONENT_TEMPLATE" => ".default",
		"ALLOW_APPEND_ORDER" => "Y",	// Дозволити оформляти замовлення на існуючого користувача
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",	// Відображення доставок з помилками розрахунку
		"SPOT_LOCATION_BY_GEOIP" => "Y",	// Визначати місце розташування покупця за IP-адресою
		"DELIVERY_TO_PAYSYSTEM" => "d2p",	// Послідовність оформлення
		"SHOW_VAT_PRICE" => "N",	// Показувати значення ПДВ
		"USE_PREPAYMENT" => "N",	// Використовувати передавторизацію для оформлення замовлення (PayPal Express Checkout)
		"USE_PRELOAD" => "Y",	// Автозаповнення оплати і доставки за попереднім замовленням
		"ALLOW_USER_PROFILES" => "Y",	// Дозволити використання профілів покупців
		"ALLOW_NEW_PROFILE" => "N",	// Дозволити безліч профілів покупців
		"TEMPLATE_THEME" => "site",	// Колірна тема
		"SHOW_ORDER_BUTTON" => "final_step",	// Відображати кнопку оформлення замовлення (для неавторизованих користувачів)
		"SHOW_TOTAL_ORDER_BUTTON" => "N",	// Відображати додаткову кнопку оформлення замовлення
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",	// Відображати назву в списку платіжних систем
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",	// Відображати назву в блоці інформації платіжної системи
		"SHOW_DELIVERY_LIST_NAMES" => "Y",	// Відображати назви в списку доставок
		"SHOW_DELIVERY_INFO_NAME" => "Y",	// Відображати назву в блоці інформації по доставці
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",	// Показувати назву батьківської доставки
		"SHOW_STORES_IMAGES" => "Y",	// Показувати зображення складів у вікні вибору пункту видачі
		"SKIP_USELESS_BLOCK" => "Y",	// Пропускати кроки, в яких один елемент для вибору
		"SHOW_BASKET_HEADERS" => "N",	// Показувати заголовки колонок списку товарів
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",	// Додаткові послуги, які будуть показані в пройденому (згорнутому) блоці
		"SHOW_COUPONS_BASKET" => "Y",	// Показувати поле введення купонів в блоці списку товарів
		"SHOW_COUPONS_DELIVERY" => "N",	// Показувати поле введення купонів в блоці доставки
		"SHOW_COUPONS_PAY_SYSTEM" => "N",	// Показувати поле введення купонів в блоці оплати
		"SHOW_NEAREST_PICKUP" => "N",	// Показувати найближчі пункти самовивозу
		"DELIVERIES_PER_PAGE" => "9",	// Кількість доставок на сторінці
		"PAY_SYSTEMS_PER_PAGE" => "9",	// Кількість платіжних систем на сторінці
		"PICKUPS_PER_PAGE" => "5",	// Кількість пунктів самовивозу на сторінці
		"SHOW_PICKUP_MAP" => "N",	// Показувати карту для доставок з самовивезенням
		"SHOW_MAP_IN_PROPS" => "N",	// Показувати карту в блоці властивостей замовлення
		"PICKUP_MAP_TYPE" => "google",	// Тип карт що використовуються
		"PROPS_FADE_LIST_1" => "",	// Властивості замовлення, які будуть показані в пройденому (згорнутому) блоці (Физическое лицо)[s1]
		"ACTION_VARIABLE" => "soa-action",	// Назва змінної, в якій передається дія
		"PATH_TO_AUTH" => "/auth/",	// Шлях до сторінки авторизації
		"DISABLE_BASKET_REDIRECT" => "N",	// Залишатися на сторінці оформлення замовлення, якщо список товарів порожній
		"PRODUCT_COLUMNS_VISIBLE" => array(	// Додаткові колонки таблиці товарів замовлення
			0 => "PREVIEW_PICTURE",
			1 => "PROPS",
		),
		"ADDITIONAL_PICT_PROP_4" => "-",	// Додаткова картинка [Каталог]
		"ADDITIONAL_PICT_PROP_5" => "-",	// Додаткова картинка [Пакет предложений (Каталог)]
		"PRODUCT_COLUMNS_HIDDEN" => "",	// Властивості товарів відображаються в згорнутому вигляді у списку товарів
		"USE_YM_GOALS" => "N",	// Використовувати цілі лічильника Яндекс.Метрики
		"USE_ENHANCED_ECOMMERCE" => "N",	// Надсилати дані електронної торгівлі в Google і Яндекс
		"USE_CUSTOM_MAIN_MESSAGES" => "N",	// Замінити стандартні фрази свої
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",	// Замінити стандартні фрази свої
		"USE_CUSTOM_ERROR_MESSAGES" => "N",	// Замінити стандартні фрази свої
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>