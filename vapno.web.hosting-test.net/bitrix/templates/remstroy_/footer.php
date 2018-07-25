  <?
  IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/footer.php");
              $arr_url = explode('/', str_replace ( SITE_DIR,"/", $APPLICATION->GetCurPage(false)));
              $url_2 = $arr_url[1];
              $url_3 = $arr_url[2];
              $url_4 = $arr_url[3];

		CModule::IncludeModule('iblock');
		$arSelect = Array("ID", "NAME", "PROPERTY_BG_PRIEM", "PROPERTY_BG_PRIEM", "PROPERTY_BG_CLIENTS", "PROPERTY_BG_ZAYAVKA", "PROPERTY_BG_AKCII");
		$arFilter = Array("IBLOCK_CODE"=>"samovar_remstroy_set_index", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
		
$element = $res->GetNextElement();
$arItem[]= $element->GetFields();

// echo "<pre>";
// print_r($arItem);
// echo "</pre>";

$bg_priem = CFile::GetPath($arItem[0]['PROPERTY_BG_PRIEM_VALUE']);
$bg_clients = CFile::GetPath($arItem[0]['PROPERTY_BG_CLIENTS_VALUE']);
$bg_zayavka = CFile::GetPath($arItem[0]['PROPERTY_BG_ZAYAVKA_VALUE']);
$bg_akcii = CFile::GetPath($arItem[0]['PROPERTY_BG_AKCII_VALUE']);
 
 ?>

  <?if($APPLICATION->GetCurPage(false) !== SITE_DIR): // Внутренняя?>

  		</div>
  	</div>
  </div>
</div>

<?endif?>


<?if($APPLICATION->GetCurPage(false) == SITE_DIR): // index?>

<!-- Слайдер  -->

<? if ($_SESSION['arr_set']['show_y_n_slider'] == 'y' ):?>


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
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "slider",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "samovar_remstroy_setup",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "NO_TEXT",
			1 => "LINK",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	),
	false
);?>
<!-- .Слайдер  -->
<?endif?>

<div class="row"></div>

<!-- Приемущества -->

<? if ($_SESSION['arr_set']['show_y_n_vid_d'] == 'y' ):?>

<?
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"nashi_osobennosty", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "nashi_osobennosty",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "samovar_remstroy_setup",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "TYPE",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	),
	false
);
?>

<?endif?>
<!-- .Приемущества -->

<!-- Услуги	 -->

<!--? if ($_SESSION['arr_set']['show_y_n_uslugi'] == 'y' ):?-->


<!--div class="uslugi_index">
	<div class="container">

				<div class="index_title">
					<h2>
							<?
							$APPLICATION->IncludeComponent("bitrix:main.include", "text", array(
	"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."/include/index/title_uslugi.php",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => "text"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);
								?>	
					</h2>
					<div>
							<?
							$APPLICATION->IncludeComponent("bitrix:main.include", "text", array(
	"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."/include/index/uslugi.php",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => "text"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);
								?>
					</div>
				</div>


<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"uslugi",
	Array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "samovar_remstroy_uslugi",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE"
	)
);?>

	</div>

</div-->

<!--?endif?-->
<!--. Услуги	 -->



<!-- Каталог	 -->
<? if ($_SESSION['arr_set']['show_y_n_catalog'] == 'y' ):?>

<div class="catalog_index">
	<div class="container">

				<div class="index_title">
					<h2>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_catalog.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
					</h2>
					<div>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/catalog.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>	
					</div>
				</div>

		<div class="row">

<?
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"index", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "samovar_remstroy_catalog",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "DESCRIPTION",
			1 => "PICTURE",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "PICTURE",
			2 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "1",
		"VIEW_MODE" => "LINE",
		"COMPONENT_TEMPLATE" => "index"
	),
	false
);
?>

	</div>
	</div>

</div>
<?endif?>
<!--. Каталог	 -->


<!-- Приемущества -->

<? if ($_SESSION['arr_set']['show_y_n_priem'] == 'y' ):?>

<div class="priem_plitki" style="background: url(<?=$bg_priem?>);">

	<div class="priem_plitki_bg_color b_color">

		<div class="container">
			<div class="row">

				<div class="index_title white">
					<h2>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_priem.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>						
					</h2>
					<div>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/priem.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>		
					</div>
				</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"nashi_priemushestva", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "nashi_priemushestva",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "11",
		"IBLOCK_TYPE" => "samovar_remstroy_setup",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "LINK",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	),
	false
);?>

			</div>
		</div>
	</div>
</div>
<?endif?>

<!-- .Приемущества -->

<!--  Последние работы	 -->

<? if ($_SESSION['arr_set']['show_y_n_projects'] == 'y' ):?>

<div class="works_last">
	<div class="container">

				<div class="index_title">
					<h2>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_last_works.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>
					</h2>
					<div>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/last_works.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>
								</div>
				</div>

		<div class="row" style="">

			<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"projects_index_slider", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "projects_index_slider",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "timestamp_x",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "samovar_remstroy_uslugi",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_LIMIT" => "5",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "4",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(
			0 => "PRICE",
			1 => "PRICE_OLD",
			2 => "H_S",
			3 => "H_ETAG",
			4 => "",
		),
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PARENT_NAME" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"VIEW_MODE" => "LINE"
	),
	false
);?>
	</div>
	</div>

</div>
<?endif?>
<!--  .Последние работы	 -->


<!--  Акции, обзоры, отзывы	 -->

<? if ($_SESSION['arr_set']['show_y_n_akcii'] == 'y' ):?>


<div class="index_obz_otz_akc">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="otz column">

						<h2>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_otzivi.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>
						</h2>

<?$APPLICATION->IncludeComponent(
	"api:reviews.recent", 
	".default", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_TIME" => "86400",
		"CACHE_TYPE" => "A",
		"COLOR" => "orange1",
		"DISPLAY_FIELDS" => array(
			0 => "TITLE",
			1 => "ANNOTATION",
		),
		"ELEMENT_ID" => "",
		"FOOTER_TITLE" => "",
		"FOOTER_URL" => "",
		"HEADER_TITLE" => "",
		"IBLOCK_ID" => "",
		"INCLUDE_CSS" => "Y",
		"ITEMS_LIMIT" => "5",
		"SECTION_ID" => "",
		"SORT_FIELD_1" => "ACTIVE_FROM",
		"SORT_FIELD_2" => "DATE_CREATE",
		"SORT_ORDER_1" => "DESC",
		"SORT_ORDER_2" => "DESC",
		"TEXT_LIMIT" => "150",
		"THEME" => "flat",
		"URL" => "",
		"USE_LINK" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);/**/?>


						<div class="more"><a href="<?=SITE_DIR?>kompaniya/otzyvy-klientov/"><span><?=getmessage('all_otzivi')?></span></a></div>
					</div>
				</div>

					<!-- Обзоры  -->

					<div class="col-md-4">
						<div class="obz column">
							<h2>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."/include/index/title_obzori.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>								
							</h2>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"content", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "10",
		"IBLOCK_TYPE" => "samovar_remstroy_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "2",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "content"
	),
	false
);?><br>

							<div class="more"><a href="<?=SITE_DIR?>content/"><span><?=getmessage('all_obzori')?></span></a></div>

						</div>
					</div>

					<!-- .Обзоры  -->

				<div class="col-md-4">
					<div class="akc column" style=" background: url(<?=$bg_akcii?>) no-repeat top center;">
									<div class="akc_gradient">
										<h2>
											<?
											$APPLICATION->IncludeComponent(
												"bitrix:main.include", 
												"text", 
												array(
													"AREA_FILE_SHOW" => "file",
													"PATH" => SITE_DIR."/include/index/title_akcii.php",
													"EDIT_TEMPLATE" => "",
													"COMPONENT_TEMPLATE" => "text"
													),
												false
												);
												?>													
										</h2>


<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"index_akcii", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "index_akcii",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "samovar_remstroy_about",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "3",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "SKIDKA",
			1 => "LINK",
			2 => "NAME_SHORT",
			3 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => ""
	),
	false
);?>


<div class="akc_text">
		<?
		$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	"text", 
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."/include/akcii/top_text.php",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => "text"
	),
	false
);
?>
</div>

			</div>

						<div class="more"><a href="<?=SITE_DIR?>akcii/"><span><?=getmessage('all_akcii')?></span></a> </div>

					</div>
				</div>
			</div>
		</div>
</div>


<script>
$(document).ready(function() {
setTimeout(function() {
var mainDivs = $(".column"); //Получаем все элементы с классом column
var maxHeight = 0;
for (var i = 0; i < mainDivs.length; ++i) {
if (maxHeight < $(mainDivs[i]).height()) { //Находим максимальную высоту
maxHeight = $(mainDivs[i]).height();
}
}
for (var i = 0; i < mainDivs.length; ++i) {
$(mainDivs[i]).height(maxHeight); //Устанавливаем всем элементам максимальную высоту
}
}, 1000);
});
	</script>


<?endif?>

<!--  .Акции, обзоры, отзывы	 -->


<!-- Наши клиенты -->

<? if ($_SESSION['arr_set']['show_y_n_clients'] == 'y' ):?>

<div class="index_clients" style=" background: url(<?=$bg_clients?>) center center; ">
	<div class="index_clients_bg">
		<div class="container">
			<div class="row">
				<div class="index_title white">
					<h2>
												<?
												$APPLICATION->IncludeComponent(
													"bitrix:main.include", 
													"text", 
													array(
														"AREA_FILE_SHOW" => "file",
														"PATH" => SITE_DIR."include/index/title_clients.php",
														"EDIT_TEMPLATE" => "",
														"COMPONENT_TEMPLATE" => "text"
														),
													false
													);
													?>						
					</h2>
					<div>

											<?
												$APPLICATION->IncludeComponent(
													"bitrix:main.include", 
													"text", 
													array(
														"AREA_FILE_SHOW" => "file",
														"PATH" => SITE_DIR."include/index/clients.php",
														"EDIT_TEMPLATE" => "",
														"COMPONENT_TEMPLATE" => "text"
														),
													false
													);
													?>

					</div>
				</div>


<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"partners", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "partners",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "13",
		"IBLOCK_TYPE" => "samovar_remstroy_about",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC"
	),
	false
);?>

			</div>
		</div>
	</div>
</div>
<?endif?>
<!-- .Наши клиенты -->

<div class="row"></div>


<!-- О компании -->

<? if ($_SESSION['arr_set']['show_y_n_about'] == 'y' ):?>


<div class="index_about">

	<div class="container">
		<div class="col-md-12 text-center">

			<div class="index_title">

				<h2>
												<?
												$APPLICATION->IncludeComponent(
													"bitrix:main.include", 
													"text", 
													array(
														"AREA_FILE_SHOW" => "file",
														"PATH" => SITE_DIR."include/index/title_about.php",
														"EDIT_TEMPLATE" => "",
														"COMPONENT_TEMPLATE" => "text"
														),
													false
													);
													?>
				</h2>
			</div>
												<?
												$APPLICATION->IncludeComponent(
													"bitrix:main.include", 
													"text", 
													array(
														"AREA_FILE_SHOW" => "file",
														"PATH" => SITE_DIR."include/index/about.php",
														"EDIT_TEMPLATE" => "",
														"COMPONENT_TEMPLATE" => "text"
														),
													false
													);
													?>
		</div>
	</div>



</div>

<?endif?>

<!-- .О компании -->

<div class="row"></div>

<?endif?>

<!-- Оставить заявку -->

<div class="index_zayavka" style=" background: url(<?=$bg_zayavka?>) center center;">
	<div class="index_clients_bg">
<!-- 		<div class="index_title white">
			<h2>Оставьте заявку прямо сейчас</h2>
		</div> -->

<div class="container">
	<!-- <div class="row"> -->
<?zapros_button($arResult['NAME'], 'form_zayavka_index', 'form_zayavka_index');?>	
</div>
	</div>
</div>


<!-- .Оставить заявку -->

<div class="row"></div>



<!-- Контакты -->

<? if ($_SESSION['arr_set']['show_y_n_contacts'] == 'y' ):?>


  <?if($APPLICATION->GetCurPage(false) == "/"): // Внутренняя?>

<div class="index_contacts" >

			<div class="map no_print">
     <?$APPLICATION->IncludeComponent(
	"bitrix:map.google.view", 
	".default", 
	array(
		"API_KEY" => "AIzaSyDD6ZreYmDa40AIW0XvyOhUQ9KRSCsofDM",
		"COMPONENT_TEMPLATE" => ".default",
		"CONTROLS" => array(
			0 => "SMALL_ZOOM_CONTROL",
		),
		"INIT_MAP_TYPE" => "ROADMAP",
		"MAP_DATA" => "a:3:{s:10:\"google_lat\";d:48.680904599918;s:10:\"google_lon\";d:26.584053899406;s:12:\"google_scale\";i:19;}",
		"MAP_HEIGHT" => "510",
		"MAP_ID" => "https://www.google.com/maps/place/Art+Vapno/@48.6807089,26.5838592,19.25z/data=!4m5!3m4!1s0x4733b87454e37f2f:0xd6ed3e82565cd7a7!8m2!3d48.6809519!4d26.5841289",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(
			0 => "ENABLE_DRAGGING",
		)
	),
	false
);?>  

			</div>

			<div class="container no_print" style="margin-top: -510px; ">
				<div class="row">

					<div class="col-md-4">
						<div style="height: 510px; display: table-cell; vertical-align: middle;">
							<div class="contacts_form">
									<h2>
										<?=getmessage('title_contacts')?>
									</h2>
									<table>
										<tr>
											<th><i class="fa fa-map-marker"></i></th>
											<td>							
												<?
												$APPLICATION->IncludeComponent(
													"bitrix:main.include", 
													"", 
													array(
														"AREA_FILE_SHOW" => "file",
														"PATH" => SITE_DIR."include/contacts/adress_contacts.php",
														"EDIT_TEMPLATE" => "",
														"COMPONENT_TEMPLATE" => "text"
														),
													false
													);
													?>
													</td>
										</tr>

										<tr>
											<th><i class="fa fa-mobile"></i></th>
											<td>
												
												<?
												$APPLICATION->IncludeComponent(
													"bitrix:main.include", 
													"", 
													array(
														"AREA_FILE_SHOW" => "file",
														"PATH" => SITE_DIR."include/contacts/tel_contacts.php",
														"EDIT_TEMPLATE" => "",
														"COMPONENT_TEMPLATE" => "text"
														),
													false
													);
													?>												
											</td>
										</tr>

										<tr>
											<th><i class="fa fa-envelope"></i></th>
											<td>
												<?
												$APPLICATION->IncludeComponent(
													"bitrix:main.include", 
													"", 
													array(
														"AREA_FILE_SHOW" => "file",
														"PATH" => SITE_DIR."include/contacts/mail_contacts.php",
														"EDIT_TEMPLATE" => "",
														"COMPONENT_TEMPLATE" => "text"
														),
													false
													);
													?>													
											</td>
										</tr>
									</table>
<? vopros_button('', 'index');?>	

							</div>
						</div>
					</div>

				</div>
			</div>
</div>

<?endif?>

<?endif?>

<!-- .Контакты -->



<!-- Подвал -->

<div  class="footer">

	<div class="container">
		<div class="row">


			<div class="col-md-3 logo">
					<div class="row">

						<div class="col-md-12 col-xs-6">

						<?
						$logo_file = file_get_contents($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/index_header_logo.php');
						?>              
						<a href="<?=SITE_DIR?>">
								<?if(trim($logo_file) !== ""):?>
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."/include/index_header_logo.php",
										"EDIT_TEMPLATE" => ""
										),
									false
									);?>
									<?else:?>
									<img src="<?=SITE_TEMPLATE_PATH?>/css/themes/<?=$_SESSION['arr_set']['color']?>/images/logo.png" alt="">
									<?endif?>
								<!-- </div> -->
							</a>

							</div>
						<div class="col-md-12 col-xs-6">
							<div class="copyr">
								
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/index/copyr.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>

							</div>
							<div class="samovar hidden-lg hidden-md hidden-sm hidden-xs"><?=getmessage('index_design_by')?></div>
						</div>
					</div>
			</div>


			<div class="col-md-6 text-center">

<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"bottom",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"COMPONENT_TEMPLATE" => "bottom",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => "",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "bottom",
		"USE_EXT" => "Y"
	)
);?>			

				<div class="contacts">
				<div class="tel"><strong>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/contacts/tel_contacts.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>					
				</strong></div>
				   <div class="call_back">
				   <div class="icon"><i class="fa fa-phone"></i></div><a href="" data-toggle="modal" data-target="#callback"><?=getmessage('index_callback')?></a></div>
				</div>
			</div>



			<div class="col-md-3 col-xs-12 social">

				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."/include/index/index_footer_social.php",
						"EDIT_TEMPLATE" => ""
						),
					false
					);?>			
			</div>

		</div>
		</div>
</div>

<div class="row"></div>

<!-- .Подвал -->


<?
include $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/form_callback.php'; // форма "заказать звонок "
?>
 

  <script src="<?=SITE_TEMPLATE_PATH?>/js/slider.min.js" type="text/javascript" charset="utf-8"></script>

  <script type="text/javascript" charset="utf-8">
  	$(document).on('ready', function() {
  		$('.catalog').slick({
  			dots: true,
  			infinite: false,
  			speed: 300,
  			slidesToShow: 4,
  			slidesToScroll: 4,
  			responsive: [
  			{
  				breakpoint: 1200,
  				settings: {
  					slidesToShow: 3,
  					slidesToScroll: 3,
  					infinite: true,
  					dots: true
  				}
  			},
  			{
  				breakpoint: 1024,
  				settings: {
  					slidesToShow: 2,
  					slidesToScroll: 2
  				}
  			},
  			{
  				breakpoint: 580,
  				settings: {
  					slidesToShow: 1,
  					slidesToScroll: 1
  				}
  			}
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
});

  		$('.protects_more').slick({
  			dots: true,
  			infinite: false,
  			speed: 300,
  			slidesToShow: 3,
  			slidesToScroll: 3,
  			responsive: [
  			{
  				breakpoint: 1200,
  				settings: {
  					slidesToShow: 3,
  					slidesToScroll: 3,
  					infinite: true,
  					dots: true
  				}
  			},
  			{
  				breakpoint: 1024,
  				settings: {
  					slidesToShow: 2,
  					slidesToScroll: 2
  				}
  			},
  			{
  				breakpoint: 580,
  				settings: {
  					slidesToShow: 1,
  					slidesToScroll: 1
  				}
  			}
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
});  		

  		$('.clients').slick({
  			dots: true,
  			infinite: false,
  			speed: 300,
  			slidesToShow: 6,
  			slidesToScroll: 6,
  			prevArrow: '<button type="button" class="slick-prev-white">Previous</button>',
  			nextArrow: '<button type="button" class="slick-next-white">next</button>',
  			dotsClass: 'slick-dots-white',
  			responsive: [
  			{
  				breakpoint: 1200,
  				settings: {
  					slidesToShow: 5,
  					slidesToScroll: 5,
  					infinite: true,
  					dots: true
  				}
  			},
  			{
  				breakpoint: 1024,
  				settings: {
  					slidesToShow: 4,
  					slidesToScroll: 4
  				}
  			},
  			{
  				breakpoint: 580,
  				settings: {
  					slidesToShow: 2,
  					slidesToScroll: 2
  				}
  			}
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
});
  	});


	</script>



</body>
</html>