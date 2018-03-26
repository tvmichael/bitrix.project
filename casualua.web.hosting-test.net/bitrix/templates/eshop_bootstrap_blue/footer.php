        <button onclick="topFunction()" id="buttonup"><i class="fa fa-arrow-circle-o-up"></i></button>
		</div>
</div>

<?
	$footerId =  uniqid();
	$footerIds = array(
		'PB' => 'p_'.$footerId.'_pidpiska_button',
		'PW_O' => 'p_'.$footerId.'_pidpiska_window_overlay',
		'PW' => 'p_'.$footerId.'_pidpiska_window',
	);
?>

<!-- вспливаюче вікно на підписку -->
<div id="<?=$footerIds['PW_O'];?>" class="overlay_popup"></div>
<div id="<?=$footerIds['PW'];?>" class="popup-footer">
	<div class="object">
	<?$APPLICATION->IncludeComponent(
		"bitrix:sender.subscribe",
		"footer",
		Array(

		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "36000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "footer",
		"CONFIRMATION" => "N",
		"HIDE_MAILINGS" => "Y",
		"SET_TITLE" => "N",
		"SHOW_HIDDEN" => "N",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_PERSONALIZATION" => "Y"
		)
	);?>
	</div>
</div>
<!-- end вспливаюче вікно на підписку--> 

</div>
<?if ($home_page===1){?>
 <?$APPLICATION->IncludeComponent(
	"zaiv:instagramgallerylite", 
	"golovna", 
	array(
		"ADD_JQUERY" => "N",
		"ADD_PLUGIN" => "N",
		"CACHE_TIME" => "3000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "golovna",
		"MEDIA_COUNT" => "4",
		"NOINDEX_LINKS" => "N",
		"NOINDEX_WIDGET" => "N",
		"PLUGIN_TYPE" => "MAGNIFICPOPUP",
		"SHOW_TYPE" => "INSTAGRAM",
		"USERNAME" => "uacasual",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
<?}?>
<div class="container-fluid footer">
<div class="container">
        <div class="row">

                <div class="col-xs-12 col-sm-push-6 col-sm-6 col-md-4 col-md-push-4 footer_center">
                        <div class="col-xs-12 menu-footer">
						<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"footer",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"COMPONENT_TEMPLATE" => ".default",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => "",
		"MENU_CACHE_TIME" => "36000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "bottom",
		"USE_EXT" => "N"
	)
);?>
						</div>

<div class="col-xs-12">
	<button id="<?=$footerIds['PB'];?>" class="pidpiska show_popup blue_btn" rel="popup1"><?echo GetMessage("pidpiska_button");?></button>	
</div>

                        <div class="col-xs-12 soc">
						<?$APPLICATION->IncludeComponent(
	"bitrix:eshop.socnet.links", 
	"soc-footer", 
	array(
		"FACEBOOK" => "https://www.facebook.com/casualua",
		"GOOGLE" => "",
		"INSTAGRAM" => "https://www.instagram.com/uacasual/",
		"TWITTER" => "https://www.youtube.com/channel/UC4FjqzWOzSVncOeDDDSsJKw",
		"VKONTAKTE" => "",
		"COMPONENT_TEMPLATE" => "soc-footer"
	),
	false
);?>
						</div>
                </div>
		<div class="col-xs-12 col-sm-pull-6 col-sm-6 col-md-4 col-md-pull-4 footer_left">
            <div class="col-xs-12  logo-footer">
				<?if ($home_page!==1){?>
						<a href="/<?=LANGUAGE_ID?>/" class="footer_a_logo">
						<?}?>
							<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => $lang."footer_logo.php"
	)
);?>
						<?if ($home_page!==1){?>
						</a>
						<?}?>
						</div>
                        <div class="col-xs-12 footer-adress">
						<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => $lang."footer-adress.php"
	)
);?>
						</div>
                        <div class="col-xs-6 col-md-12 footer-grafic">
												<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => $lang."footer-grafic.php"
	)
);?>
				</div>
                        <div class="col-xs-6 col-md-12 footer-tel">
						<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => $lang."footer-tel.php"
	)
);?>
<?
// установка временной зоны по умолчанию. Доступно начиная с версии PHP 5.1
date_default_timezone_set('UTC');
// запамятовуєм значення числа, місяця та обєднуєм їх
$nowY=date("Y");
?>

</div>
<div class="copy col-xs-12"><i class="fa fa-copyright"></i>&nbsp;<nobr>2014–<?=$nowY?></nobr>, <?echo GetMessage("footer-ruls")?>
</div>
 
                </div>
                <div class="hidden-xs hidden-sm col-md-4 footer_right">
                        <div class="col-xs-12 menu-tree">
						<?
            $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"footer_catalog", 
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
		"COMPONENT_TEMPLATE" => "footer_catalog"
	),
	false
);
            ?></div>
                </div>

        </div>

</div>
</div>


    
    <script src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap.min.js"></script>
	
<?/*if (($curPage == "/personal/order/make/") || ($curPage == $lang."personal/order/make/")){// маска телефона потрібна лише при оформленні замовлення?>	
	<script>
     		 document.addEventListener("DOMContentLoaded", function () {
       		 var phoneMask = new IMask(document.getElementById('soa-property-3'), {
        		  mask: '+{38}(000)000-00-00'
       		 });
     	 });
	 </script>
<?}*/?>	 
	<script type="text/javascript"><?//для вікна "ПІДПИСАТИСЬ НА РОЗСИЛКУ"?>
		BX.bind( BX('<?=$footerIds['PB'];?>'), 'click', function(){
			BX.style(BX('<?=$footerIds['PW_O'];?>'), 'display', 'block');
			BX.style(BX('<?=$footerIds['PW'];?>'), 'display', 'block');
			document.onmousewheel = document.onwheel = function(){ return false; };
		});	
		BX.bind( BX('<?=$footerIds['PW_O'];?>'), 'click', function(){
			BX.style(BX('<?=$footerIds['PW_O'];?>'), 'display', 'none');
			BX.style(BX('<?=$footerIds['PW'];?>'), 'display', 'none');
			document.onmousewheel = document.onwheel = function(){ return true; };
		});	
	</script>

	<script>
		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
			if (document.body.scrollTop > 520 || document.documentElement.scrollTop > 520) {
				document.getElementById("buttonup").style.display = "block";
			} else {
				document.getElementById("buttonup").style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script>
<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-70377942-1', 'auto');
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="//www.googletagmanager.com/gtag/js?id=UA-70377942-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-70377942-1');
</script>
<!-- Global Site Tag (gtag.js) - Google Analytics -->
</body>
</html>


