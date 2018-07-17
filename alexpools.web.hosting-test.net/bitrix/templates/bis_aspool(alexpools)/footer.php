<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>		

<?if (strpos($APPLICATION->GetCurPage(),"catalog")):?>
		</div><!-- content END -->
		</section>
		<?else:?>
		</div>
		</section>
		<?endif;?>
	</div>
	</div>
</div>

<footer>
	<div id="footer-in">
		<div class="col-lg-2 col-md-3 col-sm-3">
			<div class="block block0">
					<div class="footer_logo"><a href="http://alexsauna.ru/"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo_footer.png" alt=""/></a></div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3">
			<div class="block block1">		
						<div class="f-contacts"><b>© &nbsp;ООО&nbsp;"Компания Алекспулс"</b></div>
					<div class="copy">
						<b>8 (495) 108-46-34<b></br>
						<b>sell@alexpools.ru<b>
					</div>		
			</div>
		</div>
	<div class="col-lg-3 col-md-3 col-sm-3">
		<div class="block block2">
				<ul id="f-menu" class="grid">
					<li class="item"><a href="/about/payment/">Оплата</a></li>
					<li class="item"><a href="/catalog/">Каталог</a></li>
					<li class="item"><a href="/sitemap/">Карта сайта</a></li>
					<li class="item"><a href="/about/delivery/">Доставка</a></li>
					<li class="item"><a href="/assistance/">Помощь</a></li>
					<li class="item"><a href="http://alexpools.ru/confidentiality/">Конфиденциальность</a></li>
					<!--li class="item"><a href="/about/contacts/">Контакты</a></li-->
				</ul>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3">
		<div class="block block3">
				<div id="f-cart">
					<div class="cart-header">Корзина товаров</div>
					<span id="cart_line2">
						<?
							$APPLICATION->IncludeComponent(
									"bitrix:sale.basket.basket.line", 
									".default", 
									array(
										"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
										"PATH_TO_PERSONAL" => SITE_DIR."personal/",
										"SHOW_PERSONAL_LINK" => "N",
										"COMPONENT_TEMPLATE" => ".default",
										"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
										"SHOW_NUM_PRODUCTS" => "Y",
										"SHOW_TOTAL_PRICE" => "Y",
										"SHOW_EMPTY_VALUES" => "N",
										"SHOW_AUTHOR" => "N",
										"PATH_TO_REGISTER" => SITE_DIR."login/",
										"PATH_TO_AUTHORIZE" => "",
										"PATH_TO_PROFILE" => SITE_DIR."personal/",
										"SHOW_PRODUCTS" => "N",
										"POSITION_FIXED" => "N",
										"HIDE_ON_BASKET_PAGES" => "Y",
										"BUY_URL_SIGN" => "action=ADD2BASKET"
									),
									false,
									array(
										"0" => ""
									)
								);
						?>
					</span>
					<a class="link-overlay" href="/personal/cart/"></a>
				</div>
		</div>
		<a href="#" id="to-top"><span>Наверх</span></a>
	</div>
</div>
</footer>

</div>
	<?/*
	<!--div style="clear: both;"></div-->
	<!--footer>	
		<div id="footer-in">			
			<div class="block block0">
				<div class="footer_logo"><a href="http://alexsauna.ru/"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo_footer.png" alt=""/></a></div>
			</div>
			<div class="block block1">
				<div class="copy"><b>© 2013&nbsp;&nbsp;ООО&nbsp;"Компания Алекспулс"</b></div>
				<div class="f-contacts">
					<b>Тел.:  (8442) 78-03-03<!--, <br />+7-902-652-50-50--><!--b>
				</div>
			</div>
			
			<div class="block block2">
				<ul id="f-menu" class="grid">
					<li class="item"><a href="/about/payment/">Оплата</a></li>
					<li class="item"><a href="/about/service.php">Расчет</a></li>
					<li class="item"><a href="/catalog/">Каталог</a></li>
					<li class="item"><a href="/about/delivery/">Доставка</a></li>
					<li class="item"><a href="/instructions/">Инструкции</a></li>
					<li class="item"><a href="/about/contacts/">Контакты</a></li>
				</ul>
			</div>
			
			<div class="block block3">
				<div id="f-cart">
					<div class="cart-header">Корзина товаров</div>
					<span id="cart_line2">
						<?
							$APPLICATION->IncludeComponent(
								"bitrix:sale.basket.basket.line", 
								".default", 
								array(
									"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
									"PATH_TO_PERSONAL" => SITE_DIR."personal/",
									"SHOW_PERSONAL_LINK" => "N",
									"COMPONENT_TEMPLATE" => ".default",
									"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
									"SHOW_NUM_PRODUCTS" => "Y",
									"SHOW_TOTAL_PRICE" => "Y",
									"SHOW_EMPTY_VALUES" => "N",
									"SHOW_AUTHOR" => "N",
									"PATH_TO_REGISTER" => SITE_DIR."login/",
									"PATH_TO_AUTHORIZE" => "",
									"PATH_TO_PROFILE" => SITE_DIR."personal/",
									"SHOW_PRODUCTS" => "N",
									"POSITION_FIXED" => "N",
									"HIDE_ON_BASKET_PAGES" => "Y",
									"BUY_URL_SIGN" => "action=ADD2BASKET"
								),
								false,
								array(
									"0" => ""
								)
							);
						?>
					</span>
					<a class="link-overlay" href="/personal/cart/"></a>
				</div>
			</div>
			
			<a href="#" id="to-top"><span>Наверх</span></a>
			
			<!--<div id="made-in">
				Сделано в<br/><a href="#">www.1pixel.su</a>
			</div>-->
		<!--/div>
	</footer-->
	*/?>
</div>

	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/css/style.css")?>" />	
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/css/respon.css")?>" />	
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colors.css")?>" />
	<?if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") && !strpos($_SERVER['HTTP_USER_AGENT'], "MSIE 10.0")):?>
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/ie.css")?>"/>
	<?endif?>
	<link href="<?=SITE_TEMPLATE_PATH?>/libs/jcarousel/jcarousel.css" rel="stylesheet" type="text/css"/>
	<link href="<?=SITE_TEMPLATE_PATH?>/js/fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css"/>

	<!-- Yandex.Metrika counter -->
    <?
	//$APPLICATION->ShowHeadStrings();
	$APPLICATION->ShowHeadScripts();
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/slides.min.jquery.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/script.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.carouFredSel-5.6.4-packed.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.cookie.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.slideViewerPro.1.5.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.timers.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/js_tab/jquery.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/scriptbreaker-multiple-accordion-1.js");
	if ($wizTemplateId == "eshop_horizontal"):
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/bx.topnav.js");
		$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/hnav.js");
	endif;
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/fancybox/jquery.fancybox-1.3.1.pack.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/menu_epool.js");
    //$APPLICATION->ShowCSS(true, true);
	?>

 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
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
		"COMPATIBLE_MODE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "79",
		"IBLOCK_TYPE" => "1c_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
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
		"PAGE_ELEMENT_COUNT" => "18",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array("Для интернет-магазина хим реаг (UDS)","Для интернет-магазина хим реаг (евро)","Для интернет-магазина хим реаг руб","Для интернет-магазина  руб","Для интернет-магазина (UDS)","Для интернет-магазина  (евро)"),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE" => array("",""),
		"PROPERTY_CODE_MOBILE" => array(),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "any_similar",
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>
	<script>jQuery.noConflict();</script>
	<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-3.1.0.min.js"></script>
	<script src='<?=SITE_TEMPLATE_PATH?>/js/jquery.slicknav.min.js' type='text/javascript'></script>
	<script>
		$(document).ready(function() {
			$('#top-menu').slicknav({
					label: 'Меню',
				prependTo:'#top-menu'
			}); 
			$('#menu_catalog').slicknav({
					label: 'Каталог'
			});  
		});
	</script>
	<script data-skip-moving="true">
	        (function(w,d,u){
	                var s=d.createElement('script');s.async=1;s.src=u+'?'+(Date.now()/60000|0);
	                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
	        })(window,document,'https://cdn.bitrix24.ru/b4284367/crm/site_button/loader_2_l7ylo0.js');
	</script>

<?
if ( $USER->IsAdmin() && $USER->GetID() == 212 ) 
{ 
echo '<div class="col-md-12"><pre>';
print_r(''); 
echo '</pre></div>'; 
};?>
</body>
</html>