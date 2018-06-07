<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
					</div>
					<?if ($needSidebar):?>
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
		</div><!--//workarea-->

	<div class="row">
		<!--div class="bottom_wrap"-->
			<!--div class="bottom_wrap_container"-->
			<div class="container">
				<div class="row bx_footer_bottom">
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="bottom_container_six">
								<div class="bx_inc_about_footer">
									<!--?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/delivery.php"), false);?-->
								</div>
							</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="bottom_container_seven">
								<div class="bx_inc_about_footer">
									<!--?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/tel_email.php"), false);?-->
								</div>				
							</div>
					</div>
				</div>
				<div class = "row">
						<!--div class="bottom_container_one"-->
						<div class = "col-lg-2 col-md-2 col-sm-2 col-xs-6">
							<div class="bx_inc_about_footer">
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/need_help.php"), false);?>
							</div>
						</div>

						<!--div class="bottom_container_two"-->
						<div class = "col-lg-2 col-md-2 col-sm-2 col-xs-6">
							<div class="bx_inc_about_footer">
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/orders_shipping.php"), false);?>
							</div>				
						</div>

						<!--div class="bottom_container_tre"-->
						<div class = "col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-top: -10px;">
							<div class="bx_inc_social_footer">
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/social_network.php"), false);?>
							</div>
						</div>

						<!--div class="bottom_container_four"-->
						<div class = "col-lg-4 col-md-4 col-sm-12 col-xs-12">
<div class="bottom_container_seven">
								<div class="bx_inc_about_footer">
									<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/tel_email.php"), false);?>
								</div>				
							</div>
							<div class="bx_inc_about_footer">
								<!--?$APPLICATION->IncludeComponent("bitrix:main.include", "", array(
	"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/subscription.php"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?-->
							</div>
						</div>
				</div>				

			</div>
		<!--/div-->  <!-- //bottom_wrap -->
	</div>
	<footer class="backgr-fone-color">
	<!--div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12"-->
		<div class="footer_wrap_container">
				<div class="bottom_container_five">
					<div class="bx_inc_social_footer">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/payment_systems.php"), false);?>
					</div>
				</div>
				<div class="footer_container_two">
					<div class="bx_inc_menu_footer">
						<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu", array(
							"ROOT_MENU_TYPE" => "bottom",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(
							),
						),
						false
					);?>
					</div>
				</div>
				<div class="copyright"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/copyright.php"), false);?></div>

		</div>  <!-- //footer_wrap -->
	<!--/div-->
	</footer>


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
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter45514830 = new Ya.Metrika({
                    id:45514830,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    ecommerce:"dataLayer"
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/45514830" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>