<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
					</div>
					<?if (!$needSidebar):?>
					<div class="sidebar col-md-3 col-sm-4">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "sect",
								"AREA_FILE_SUFFIX" => "sidebar",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_MODE" => "html",
							),
							false,
							Array('HIDE_ICONS' => 'Y')
						);?>
					</div><!--// sidebar -->
					<?endif?>
				</div><!--//row-->
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "bottom",
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					Array('HIDE_ICONS' => 'Y')
				);?>

			</div><!--//container bx-content-seection-->
</section>
		</div><!--//workarea-->

		<footer class="bx-footer">
			<div id="footer-in">
	<div class="col-lg-2 col-md-3 col-sm-3">
		<div class="block block0">
				<div class="footer_logo"><a href="http://alexsauna.ru/"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo_footer.png" alt=""/></a></div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-3">
		<div class="block block1">		
					<div class="f-contacts"><b>© 2013-2017&nbsp;&nbsp;ООО&nbsp;"Алекспулс"</b></div>
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
	"default_arhicode_bottom", 
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
		<div class="col-xs-12 hidden-lg hidden-md hidden-sm">
			<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "", array(
					"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
					"PATH_TO_PERSONAL" => SITE_DIR."personal/",
					"SHOW_PERSONAL_LINK" => "N",
					"SHOW_NUM_PRODUCTS" => "Y",
					"SHOW_TOTAL_PRICE" => "Y",
					"SHOW_PRODUCTS" => "N",
					"POSITION_FIXED" =>"Y",
					"POSITION_HORIZONTAL" => "center",
					"POSITION_VERTICAL" => "bottom",
					"SHOW_AUTHOR" => "Y",
					"PATH_TO_REGISTER" => SITE_DIR."login/",
					"PATH_TO_PROFILE" => SITE_DIR."personal/"
				),
				false,
				array()
			);?>
		</div>
	</div> <!-- //bx-wrapper -->
<?


$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/slides.min.jquery.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/script.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.carouFredSel-5.6.4-packed.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.cookie.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.slideViewerPro.1.5.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.timers.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/js_tab/jquery.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/scriptbreaker-multiple-accordion-1.js");
?>
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

<script>
	BX.ready(function(){
		var upButton = document.querySelector('[data-role="eshopUpButton"]');
		BX.bind(upButton, "click", function(){
			var windowScroll = BX.GetWindowScrollPos();
			(new BX.easing({
				duration : 500,
				start : { scroll : windowScroll.scrollTop },
				finish : { scroll : 0 },
				transition : BX.easing.makeEaseOut(BX.easing.transitions.quart),
				step : function(state){
					window.scrollTo(0, state.scroll);
				},
				complete: function() {
				}
			})).animate();
		})
	});
</script>
</body>
</html>