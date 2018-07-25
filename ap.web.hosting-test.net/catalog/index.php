<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
$APPLICATION->SetPageProperty("description", "Интернет-магазин оборудования для бассейнов");
$APPLICATION->SetPageProperty("title", "Оборудование для бассейнов");
$APPLICATION->SetTitle("Оборудование для бассейнов");
$filterView = (COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID) == "eshop_adapt_vertical" ? "HORIZONTAL" : "VERTICAL");
$APPLICATION->SetAdditionalCSS('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css');
?>
<!-- Edit 27-11-2017 --> 
<!-- jQuery --> 
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.js"></script> 
<!-- Bootstrap JavaScript --> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">	
</script>

<div>
	<? $dir = $APPLICATION->GetCurDir(); ?>
	<?if($dir != "/catalog/"):?>&nbsp;
		<?
			$APPLICATION->IncludeComponent(
			"bitrix:catalog", 
			"arhi_cat", 
			array(
				"ACTION_VARIABLE" => "action",
				"ADD_ELEMENT_CHAIN" => "N",
				"ADD_PICT_PROP" => "MORE_PHOTO",
				"ADD_PROPERTIES_TO_BASKET" => "Y",
				"ADD_SECTIONS_CHAIN" => "Y",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"BASKET_URL" => "/personal/cart/",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_NOTES" => "",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"COMPATIBLE_MODE" => "Y",
				"COMPONENT_TEMPLATE" => "arhi_cat",
				"CONVERT_CURRENCY" => "Y",
				"CURRENCY_ID" => "RUB",
				"DETAIL_BACKGROUND_IMAGE" => "-",
				"DETAIL_BROWSER_TITLE" => "-",
				"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
				"DETAIL_META_DESCRIPTION" => "-",
				"DETAIL_META_KEYWORDS" => "-",
				"DETAIL_OFFERS_FIELD_CODE" => array(
					0 => "NAME",
					1 => "",
				),
				"DETAIL_OFFERS_PROPERTY_CODE" => array(
					0 => "",
					1 => "color",
					2 => "",
				),
				"DETAIL_PROPERTY_CODE" => array(
					0 => "CML2_ARTICLE",
					1 => "CML2_MANUFACTURER",
					2 => "STRANA2",
					3 => "VYSOTA_FILTRA2",
					4 => "VKHODNOE_NAPRYAZHENIE2",
					5 => "DIAMETR_FILTRA2",
					6 => "VKHODNOE_OTVERSTIE2",
					7 => "VYSOTA2",
					8 => "VYKHODNOE_NAPRYAZHENIE2",
					9 => "MASSA_NAPOLNITELYA2",
					10 => "VYKHODNOE_OTVERSTIE2",
					11 => "MATERIAL2",
					12 => "GLUBINA_BASSEYNA2",
					13 => "MOSHCHNOST_NASOSA2",
					14 => "DIAMETR2",
					15 => "NAPRYAZHENIE2",
					16 => "DLINA_KABELYA2",
					17 => "OBEM_BASSEYNA2",
					18 => "DLINNA2",
					19 => "PODSOEDINENIE2",
					20 => "DLINNA_ZONDA2",
					21 => "PODSOEDINENIE_VENTILYA2",
					22 => "PRIZVODITELNOST2",
					23 => "EMKOST2",
					24 => "KLAPAN2",
					25 => "KLASS_ZASHCHITY2",
					26 => "KOLICHESTVO_ELEMENTOV_NA_1_M2",
					27 => "KONSTRUKTSIYA2",
					28 => "MAKSIMALNYY_NAPOR2",
					29 => "MAKSIMALNYY_RASKHOD2",
					30 => "MATERIAL_KORPUSA2",
					31 => "MODEL2",
					32 => "MOSHCHNOST2",
					33 => "OBLITSOVKA_BASSEYNA2",
					34 => "OPRAVA2",
					35 => "PLOSHCHAD_OBRABOTKI2",
					36 => "PODKHODYASHCHIE_MODELI2",
					37 => "PREDNAZNACHENIE2",
					38 => "PREOBLADAYUSHCHIY_TSVET2",
					39 => "PRIMENENIE2",
					40 => "PROIZVODITELNOST2",
					41 => "PROPUSKNAYA_SPOSOBNOST2",
					42 => "RABOCHEE_DAVLENIE2",
					43 => "RASKHOD_VODY2",
					44 => "SECHENIE_KABELYA2",
					45 => "SILA_TOKA2",
					46 => "TEMPERATURNYY_DIAPAZON2",
					47 => "TIP2",
					48 => "TIP_BASSEYNA2",
					49 => "TIP_SOEDINENIYA2",
					50 => "TOLSHCHINA2",
					51 => "UGOL2",
					52 => "USTANOVOCHNYY_DIAMETR2",
					53 => "FORMA2",
					54 => "TSVET2",
					55 => "CHISLO_STUPENEY2",
					56 => "SHIRINA2",
					57 => "SHIRINA_IZLIVA2",
					58 => "KOLLICHESTVO_V_UPAKOVKE",
					59 => "ARTIKUL_MODEL2",
					60 => "NEWPRODUCT",
					61 => "MANUFACTURER",
					62 => "",
				),
				"DETAIL_SET_CANONICAL_URL" => "N",
				"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
				"DETAIL_SHOW_MAX_QUANTITY" => "N",
				"DETAIL_STRICT_SECTION_CHECK" => "N",
				"DETAIL_USE_COMMENTS" => "N",
				"DETAIL_USE_VOTE_RATING" => "N",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_FIELD2" => "sort",
				"ELEMENT_SORT_ORDER" => "asc",
				"ELEMENT_SORT_ORDER2" => "asc",
				"FILTER_FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"FILTER_NAME" => "",
				"FILTER_PRICE_CODE" => array(
					0 => "Для интернет-магазина хим реаг (UDS)",
					1 => "Для интернет-магазина хим реаг (евро)",
					2 => "Для интернет-магазина хим реаг руб",
					3 => "Для интернет-магазина  руб",
					4 => "Для интернет-магазина (UDS)",
					5 => "Для интернет-магазина  (евро)",
					6 => "BASE",
				),
				"FILTER_PROPERTY_CODE" => array(
					0 => "PROIZVODITEL",
					1 => "",
				),
				"FILTER_VIEW_MODE" => "HORIZONTAL",
				"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
				"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
				"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
				"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
				"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
				"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
				"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
				"GIFTS_MESS_BTN_BUY" => "Выбрать",
				"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
				"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
				"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "3",
				"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
				"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
				"GIFTS_SHOW_IMAGE" => "Y",
				"GIFTS_SHOW_NAME" => "Y",
				"GIFTS_SHOW_OLD_PRICE" => "Y",
				"HIDE_NOT_AVAILABLE" => "N",
				"HIDE_NOT_AVAILABLE_OFFERS" => "N",
				"IBLOCK_ID" => "79",
				"IBLOCK_TYPE" => "1c_catalog",
				"INCLUDE_SUBSECTIONS" => "A",
				"LABEL_PROP" => "-",
				"LINE_ELEMENT_COUNT" => "4",
				"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
				"LINK_IBLOCK_ID" => "80",
				"LINK_IBLOCK_TYPE" => "1c_catalog",
				"LINK_PROPERTY_SID" => "PROIZVODITEL_ATTR_E3",
				"LIST_BROWSER_TITLE" => "-",
				"LIST_META_DESCRIPTION" => "-",
				"LIST_META_KEYWORDS" => "-",
				"LIST_OFFERS_FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"LIST_OFFERS_LIMIT" => "5",
				"LIST_OFFERS_PROPERTY_CODE" => array(
					0 => "",
					1 => "",
				),
				"LIST_PROPERTY_CODE" => array(
					0 => "CML2_ARTICLE",
					1 => "CML2_MANUFACTURER",
					2 => "VYSOTA_FILTRA2",
					3 => "VKHODNOE_NAPRYAZHENIE2",
					4 => "DIAMETR_FILTRA2",
					5 => "VKHODNOE_OTVERSTIE2",
					6 => "VYSOTA2",
					7 => "VYKHODNOE_NAPRYAZHENIE2",
					8 => "MASSA_NAPOLNITELYA2",
					9 => "VYKHODNOE_OTVERSTIE2",
					10 => "MATERIAL2",
					11 => "GLUBINA_BASSEYNA2",
					12 => "MOSHCHNOST_NASOSA2",
					13 => "DIAMETR2",
					14 => "NAPRYAZHENIE2",
					15 => "DLINA_KABELYA2",
					16 => "OBEM_BASSEYNA2",
					17 => "DLINNA2",
					18 => "PODSOEDINENIE2",
					19 => "DLINNA_ZONDA2",
					20 => "PODSOEDINENIE_VENTILYA2",
					21 => "PRIZVODITELNOST2",
					22 => "EMKOST2",
					23 => "KLAPAN2",
					24 => "KLASS_ZASHCHITY2",
					25 => "KOLICHESTVO_ELEMENTOV_NA_1_M2",
					26 => "KOLLICHESTVO_V_UPAKOVKE2",
					27 => "KONSTRUKTSIYA2",
					28 => "MAKSIMALNYY_NAPOR2",
					29 => "MAKSIMALNYY_RASKHOD2",
					30 => "MATERIAL_KORPUSA2",
					31 => "MODEL2",
					32 => "MOSHCHNOST2",
					33 => "OBLITSOVKA_BASSEYNA2",
					34 => "OPRAVA2",
					35 => "PLOSHCHAD_OBRABOTKI2",
					36 => "PODKHODYASHCHIE_MODELI2",
					37 => "PREDNAZNACHENIE2",
					38 => "PREOBLADAYUSHCHIY_TSVET2",
					39 => "PRIMENENIE2",
					40 => "PROIZVODITELNOST2",
					41 => "PROPUSKNAYA_SPOSOBNOST2",
					42 => "RABOCHEE_DAVLENIE2",
					43 => "RASKHOD_VODY2",
					44 => "SECHENIE_KABELYA2",
					45 => "SILA_TOKA2",
					46 => "TEMPERATURNYY_DIAPAZON2",
					47 => "TIP2",
					48 => "TIP_BASSEYNA2",
					49 => "TIP_SOEDINENIYA2",
					50 => "TOLSHCHINA2",
					51 => "UGOL2",
					52 => "USTANOVOCHNYY_DIAMETR2",
					53 => "FORMA2",
					54 => "TSVET2",
					55 => "CHISLO_STUPENEY2",
					56 => "SHIRINA2",
					57 => "SHIRINA_IZLIVA2",
					58 => "AKTSIYA",
					59 => "ARTIKUL_MODEL2",
					60 => "SALELEADER",
					61 => "SPECIALOFFER",
					62 => "",
				),
				"MESSAGE_404" => "",
				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
				"MESS_BTN_BUY" => "Купить",
				"MESS_BTN_COMPARE" => "Сравнение",
				"MESS_BTN_DETAIL" => "Подробнее",
				"MESS_NOT_AVAILABLE" => "Нет в наличии",
				"OFFERS_CART_PROPERTIES" => array(
				),
				"OFFERS_SORT_FIELD" => "sort",
				"OFFERS_SORT_FIELD2" => "id",
				"OFFERS_SORT_ORDER" => "asc",
				"OFFERS_SORT_ORDER2" => "desc",
				"OFFER_ADD_PICT_PROP" => "-",
				"OFFER_TREE_PROPS" => array(
					0 => "",
					1 => "-",
					2 => "",
				),
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "arrows",
				"PAGER_TITLE" => "Товары",
				"PAGE_ELEMENT_COUNT" => "300",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PRICE_CODE" => array(
					0 => "Для интернет-магазина хим реаг (UDS)",
					1 => "Для интернет-магазина хим реаг (евро)",
					2 => "Для интернет-магазина хим реаг руб",
					3 => "Для интернет-магазина  руб",
					4 => "Для интернет-магазина (UDS)",
					5 => "Для интернет-магазина  (евро)",
					6 => "Для интернет-магазина опт хим реаг (UDS)",
					7 => "Для интернет-магазина опт хим реаг (евро)",
					8 => "Для интернет-магазина опт хим реаг руб",
					9 => "Для интернет-магазина опт (UDS)",
					10 => "Для интернет-магазина опт (евро)",
					11 => "Для интернет-магазина опт руб",
				),
				"PRICE_VAT_INCLUDE" => "Y",
				"PRICE_VAT_SHOW_VALUE" => "N",
				"PRODUCT_DISPLAY_MODE" => "N",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_PROPERTIES" => array(
				),
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"SECTIONS_SHOW_PARENT_NAME" => "Y",
				"SECTIONS_VIEW_MODE" => "LINE",
				"SECTION_BACKGROUND_IMAGE" => "-",
				"SECTION_COUNT_ELEMENTS" => "N",
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"SECTION_TOP_DEPTH" => "1",
				"SEF_FOLDER" => "/catalog/",
				"SEF_MODE" => "Y",
				"SET_LAST_MODIFIED" => "N",
				"SET_STATUS_404" => "Y",
				"SET_TITLE" => "Y",
				"SHOW_404" => "Y",
				"SHOW_DEACTIVATED" => "N",
				"SHOW_DISCOUNT_PERCENT" => "Y",
				"SHOW_OLD_PRICE" => "Y",
				"SHOW_PRICE_COUNT" => "1",
				"SHOW_TOP_ELEMENTS" => "N",
				"USER_CONSENT" => "N",
				"USER_CONSENT_ID" => "0",
				"USER_CONSENT_IS_CHECKED" => "Y",
				"USER_CONSENT_IS_LOADED" => "N",
				"USE_ALSO_BUY" => "N",
				"USE_COMPARE" => "N",
				"USE_ELEMENT_COUNTER" => "Y",
				"USE_FILTER" => "N",
				"USE_GIFTS_DETAIL" => "Y",
				"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
				"USE_GIFTS_SECTION" => "Y",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"USE_PRICE_COUNT" => "N",
				"USE_PRODUCT_QUANTITY" => "Y",
				"USE_REVIEW" => "N",
				"USE_STORE" => "N",
				"FILE_404" => "/404.php",
				"SEF_URL_TEMPLATES" => array(
					"sections" => "",
					"section" => "#SECTION_CODE#/",
					"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
					"compare" => "compare/",
					"smart_filter" => "#SECTION_ID#/filter/#SMART_FILTER_PATH#/apply/",
				)
			),
			false
			);
		?>

		<div style="display: none;">
		<?$APPLICATION->IncludeComponent(
			"altasib:feedback.form", 
			"template_arhicode", 
			array(
				"ACTIVE_ELEMENT" => "Y",
				"ADD_HREF_LINK" => "Y",
				"ALX_LINK_POPUP" => "Y",
				"ALX_LOAD_PAGE" => "N",
				"ALX_NAME_LINK" => "Нашли дешевле? Снизим цену!",
				"BBC_MAIL" => "",
				"CAPTCHA_TYPE" => "default",
				"CATEGORY_SELECT_NAME" => "Выберите категорию",
				"CHANGE_CAPTCHA" => "N",
				"CHECKBOX_TYPE" => "CHECKBOX",
				"CHECK_ERROR" => "Y",
				"COLOR_SCHEME" => "BRIGHT",
				"COLOR_THEME" => "",
				"EVENT_TYPE" => "ALX_FEEDBACK_FORM",
				"FB_TEXT_NAME" => "",
				"FB_TEXT_SOURCE" => "DETAIL_TEXT",
				"FORM_ID" => "1",
				"IBLOCK_ID" => "81",
				"IBLOCK_TYPE" => "altasib_feedback",
				"INPUT_APPEARENCE" => array(
					0 => "DEFAULT",
				),
				"JQUERY_EN" => "jquery",
				"LINK_SEND_MORE_TEXT" => "Отправить ещё одно сообщение",
				"LOCAL_REDIRECT_ENABLE" => "N",
				"MASKED_INPUT_PHONE" => array(
					0 => "PHONE",
				),
				"MESSAGE_OK" => "Ваше сообщение было успешно отправлено",
				"NAME_ELEMENT" => "ALX_DATE",
				"NOT_CAPTCHA_AUTH" => "Y",
				"POPUP_ANIMATION" => "0",
				"PROPERTY_FIELDS" => array(
					0 => "PHONE",
					1 => "FEEDBACK_TEXT",
				),
				"PROPERTY_FIELDS_REQUIRED" => array(
					0 => "PHONE",
					1 => "FEEDBACK_TEXT",
				),
				"PROPS_AUTOCOMPLETE_EMAIL" => array(
					0 => "EMAIL",
				),
				"PROPS_AUTOCOMPLETE_NAME" => array(
					0 => "FIO",
				),
				"PROPS_AUTOCOMPLETE_PERSONAL_PHONE" => array(
					0 => "PHONE",
				),
				"PROPS_AUTOCOMPLETE_VETO" => "N",
				"SECTION_FIELDS_ENABLE" => "N",
				"SECTION_MAIL_ALL" => "chuga_a@ukr.net",
				"SEND_IMMEDIATE" => "Y",
				"SEND_MAIL" => "N",
				"SHOW_LINK_TO_SEND_MORE" => "N",
				"SHOW_MESSAGE_LINK" => "Y",
				"USERMAIL_FROM" => "N",
				"USER_CONSENT" => "N",
				"USER_CONSENT_INPUT_LABEL" => "",
				"USE_CAPTCHA" => "Y",
				"WIDTH_FORM" => "50%",
				"COMPONENT_TEMPLATE" => "template_arhicode",
				"COLOR_OTHER" => "#009688",
				"USER_CONSENT_ID" => "0",
				"USER_CONSENT_IS_CHECKED" => "Y",
				"USER_CONSENT_IS_LOADED" => "N"
			),
			false
		);
		?>
		</div>
 	<?else: ?>&nbsp; 
		<?$APPLICATION->IncludeComponent(
			"bisexpert:owlslider",
			".default",
			Array(
				"AUTO_HEIGHT" => "Y",
				"AUTO_PLAY" => "Y",
				"AUTO_PLAY_SPEED" => "5000",
				"CACHE_TIME" => "3600",
				"CACHE_TYPE" => "A",
				"COMPONENT_TEMPLATE" => ".default",
				"COMPOSITE" => "Y",
				"COUNT" => "8",
				"DISABLE_LINK_DEV" => "N",
				"DRAG_BEFORE_ANIM_FINISH" => "Y",
				"ENABLE_JQUERY" => "Y",
				"ENABLE_OWL_CSS_AND_JS" => "Y",
				"HEIGHT_RESIZE" => "250",
				"IBLOCK_ID" => "88",
				"IBLOCK_TYPE" => "slider",
				"IMAGE_CENTER" => "Y",
				"INCLUDE_SUBSECTIONS" => "Y",
				"IS_PROPORTIONAL" => "N",
				"ITEMS_SCALE_UP" => "Y",
				"LINK_URL_PROPERTY_ID" => "0",
				"MAIN_TYPE" => "iblock",
				"MOUSE_DRAG" => "Y",
				"NAVIGATION" => "Y",
				"NAVIGATION_TYPE" => "arrows",
				"PAGINATION" => "Y",
				"PAGINATION_NUMBERS" => "N",
				"PAGINATION_SPEED" => "800",
				"RANDOM" => "N",
				"RANDOM_TRANSITION" => "N",
				"RESPONSIVE" => "Y",
				"REWIND_SPEED" => "1000",
				"SCROLL_COUNT" => "1",
				"SECTION_ID" => "0",
				"SHOW_DESCRIPTION_BLOCK" => "N",
				"SLIDE_SPEED" => "200",
				"SORT_DIR_1" => "asc",
				"SORT_DIR_2" => "asc",
				"SORT_FIELD_1" => "id",
				"SORT_FIELD_2" => "",
				"SPECIAL_CODE" => "unic",
				"STOP_ON_HOVER" => "Y",
				"TEXT_PROPERTY_ID" => "0",
				"TOUCH_DRAG" => "Y",
				"TRANSITION_TYPE_FOR_ONE_ITEM" => "default",
				"WIDTH_RESIZE" => "750"
			)
		);?> 
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"arhi_tree_BoBa",
			Array(
				"ADD_SECTIONS_CHAIN" => "Y",
				"CACHE_GROUPS" => "Y",
				"CACHE_NOTES" => "",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"COMPONENT_TEMPLATE" => "arhi_tree_BoBa",
				"COUNT_ELEMENTS" => "N",
				"IBLOCK_ID" => "79",
				"IBLOCK_TYPE" => "1c_catalog",
				"SECTION_CODE" => "",
				"SECTION_FIELDS" => array(0=>"",1=>"",),
				"SECTION_ID" => $_REQUEST["SECTION_ID"],
				"SECTION_URL" => "/catalog/#SECTION_CODE#/",
				"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
				"TOP_DEPTH" => "4"
			)
		);?> 
	<?endif;?>
</div>
<br>

<?
$dir_param = str_replace($dir, "", $APPLICATION->GetCurUri());
if ( $dir == "/catalog/" and $dir_param != '' and strpos($APPLICATION->GetCurUri(), '?') === false )
	Bitrix\Iblock\Component\Tools::process404( 'Страница не найдена', true, true, true, false );

//if(defined("ERROR_404") && ERROR_404 == "Y" && $APPLICATION->GetCurPage(true) !='/404.php')  LocalRedirect('/404.php');
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>