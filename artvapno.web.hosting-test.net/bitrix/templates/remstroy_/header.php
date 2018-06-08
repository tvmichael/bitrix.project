<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");

              $arr_url = explode('/', str_replace ( SITE_DIR,"/", $APPLICATION->GetCurPage(false)));
              $url_2 = $arr_url[1];
              $url_3 = $arr_url[2];
              $url_4 = $arr_url[3];

?>
<!DOCTYPE html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="/bitrix/js/main/jquery/jquery-2.1.3.min.min.js"></script>

	    <?$APPLICATION->ShowHead();?>
	    
	    <title><?$APPLICATION->ShowTitle();?></title>
	
	       <link rel="shortcut icon" type="image/x-icon" href="/favicon_remstroy.ico" />

	        <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-1.11.1.min.js"></script>
	        <script src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap.min.js"></script>
	
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/bootstrap.min.css" rel="stylesheet">
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/font-awesome.min.css" rel="stylesheet">
	
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/main.css" rel="stylesheet">
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/print.css" rel="stylesheet">
	
	        <link href="<?=SITE_TEMPLATE_PATH?>/fonts/fonts.css" rel="stylesheet">
	
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/media.css" rel="stylesheet">
	
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/slider.css" rel="stylesheet">
	        <link href="<?=SITE_TEMPLATE_PATH?>/css/slider_control.css" rel="stylesheet">
	
	        <script src="<?=SITE_TEMPLATE_PATH?>/js/jqBootstrapValidation-1.3.7.min.js" charset="utf-8"></script>

	        <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/panel.js"></script>
	        <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/panel_setup.css">

  <style type="text/css">

    html, body {
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
    }

    .slider {
        width: 100%;
        /*margin: 100px auto;*/
        margin: 0;
    }

    .slick-slide {
      margin: 0px 15px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slider_white .slick-prev
{
    left: 15px;
    background: url(pict/prev_white.png) no-repeat left center !important;
}
  </style>

      <script type="text/javascript">

      $(function() {
      $.fn.scrollToTop = function() {
        $(this).hide().removeAttr("href");
        if ($(window).scrollTop() >= "250") $(this).fadeIn("slow")
          var scrollDiv = $(this);
        $(window).scroll(function() {
          if ($(window).scrollTop() <= "250") $(scrollDiv).fadeOut("slow")
            else $(scrollDiv).fadeIn("slow")
          });

        $(this).click(function() {
          $("html, body").animate({scrollTop: 0}, "slow")
        })
        }
        });

    $(function() {
      $("#Go_Top").scrollToTop();
    });

  </script>  


</head>

<body>

<a class="go_top" href='#' id='Go_Top' style=" background: url(<?=SITE_TEMPLATE_PATH?>/pict/go_top.png);">
</a>


<?
include($_SERVER["DOCUMENT_ROOT"]."/include/content_zapros_button.php");
include($_SERVER["DOCUMENT_ROOT"]."/include/content_vopros_button.php");
?>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
<?
include $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/!panel.php'; // панель настройки сайта
?>
<link href="<?=SITE_TEMPLATE_PATH?>/css/themes/<?=$_SESSION['arr_set']['color']?>/style.css" rel="stylesheet">

<!-- шапка -->

<!-- <div class="mobile_top_menu_end_cart  visible-xs visible-sm" style="height: 45px ;padding: 8px 0; position: fixed !important; top: 0; width: 100%; z-index: 1000">
   <div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 reg_enter">

			</div>

		</div>
	</div>
</div> -->

<div class="visible-xs visible-sm no_print">

<?$APPLICATION->IncludeComponent(
  "bitrix:menu",
  "top_mobile",
  Array(
    "COMPONENT_TEMPLATE" => "top",
    "ROOT_MENU_TYPE" => "top",
    "MENU_CACHE_TYPE" => "N",
    "MENU_CACHE_TIME" => "3600",
    "MENU_CACHE_USE_GROUPS" => "Y",
    "MENU_CACHE_GET_VARS" => array(),
    "MAX_LEVEL" => "2",
    "CHILD_MENU_TYPE" => "top_submenu",
    "USE_EXT" => "N",
    "DELAY" => "N",
    "ALLOW_MULTI_SELECT" => "N",
  )
);?>	

<?

// $APPLICATION->IncludeComponent(
// 	"bitrix:menu", 
// 	"mobile", 
// 	array(
// 		"ROOT_MENU_TYPE" => "top",
// 		"MAX_LEVEL" => "2",
// 		"CHILD_MENU_TYPE" => "top_submenu",
// 		"USE_EXT" => "Y",
// 		"DELAY" => "N",
// 		"ALLOW_MULTI_SELECT" => "N",
// 		"MENU_CACHE_TYPE" => "N",
// 		"MENU_CACHE_TIME" => "3600",
// 		"MENU_CACHE_USE_GROUPS" => "Y",
// 		"MENU_CACHE_GET_VARS" => array(
// 		),
// 		"MENU_THEME" => "site",
// 		"COMPONENT_TEMPLATE" => "catalog"
// 	),
// 	false
// );



?>
</div>

<?if($url_2 !== 'cart'):?>
<div class="block_fixed">
<div class="cart_b" id="compare_list_count">
<? include $_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/_templates_show_cart.php'; // корзина ?>
</div>
</div>
<?endif?>

<div class="header">
	<div class="container">

		<div class="header_table">

				<div class="logo_cell">

					<div>
						<?
						$logo_file = file_get_contents($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/index_header_logo.php');
						?>    

						<a href="<?=SITE_DIR?>">
							<div class="logo" <?if(trim($logo_file) !== ""):?>style="background: none;"<?else:?>style="background: url(<?=SITE_TEMPLATE_PATH?>/css/themes/<?=$_SESSION['arr_set']['color']?>/images/logo.png) no-repeat; width:220px; height: 55px; "<?endif?>>
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
								</div>
							</a>
					</div>
				</div>
			<div class="form_regim_cell hidden-xs hidden-sm ">
				<div>
					<?
					$APPLICATION->IncludeComponent("bitrix:main.include", "text", Array(
						"AREA_FILE_SHOW" => "file",	
						"PATH" => SITE_DIR."include/contacts/regim_contacts.php",
						"EDIT_TEMPLATE" => "",
						"COMPONENT_TEMPLATE" => ".default"
						),
					false
					);
					?>
                   <br>
                   <?
                   $APPLICATION->IncludeComponent(
                   	"bitrix:main.include", 
                   	"text", 
                   	array(
                   		"AREA_FILE_SHOW" => "file",
                   		"PATH" => SITE_DIR."include/contacts/adress_contacts.php",
                   		"EDIT_TEMPLATE" => "",
                   		"COMPONENT_TEMPLATE" => "text"
                   		),
                   	false
                   	);
                   	?>
				</div>
			</div>

			<div class="contacts_cell">
				<div>
					<div class="tel">
						<strong>
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.include", 
								"text", 
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/contacts/tel_header.php",
									"EDIT_TEMPLATE" => "",
									"COMPONENT_TEMPLATE" => "text"
									),
								false
								);
								?>
						</strong>
					</div>
					<div class="call_back">
					<a href="" data-toggle="modal" data-target="#callback"><i class="fa fa-phone"></i> <span><?=getmessage('index_callback')?></span></a> </div>
					<div class="call_back"></div>
				</div>
			</div>

	 <?
	 $APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"site_search", 
	array(
		"CATEGORY_0" => array(
			0 => "no",
		),
		"CATEGORY_0_TITLE" => GetMessage("search_title_catalog"),
		"CATEGORY_0_iblock_shop_samovar_catalog" => array(
			0 => "1",
		),
		"CHECK_DATES" => "N",
		"COMPONENT_TEMPLATE" => "site_search",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "4",
		"ORDER" => "date",
		"PAGE" => "/search/",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "Y",
		"CONVERT_CURRENCY" => "N",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CATEGORY_1_TITLE" => GetMessage("search_title_content"),
		"CATEGORY_1" => array(
			0 => "no",
		),
		"CATEGORY_1_iblock_shop_samovar_content" => array(
			0 => "4",
		),
		"CATEGORY_0_iblock_samovar_remstroy_uslugi" => array(
			0 => "2",
			1 => "3",
			2 => "5",
		),
		"CATEGORY_1_iblock_samovar_remstroy_catalog" => array(
			0 => "1",
		),
		"CATEGORY_2_TITLE" => "",
		"CATEGORY_2" => array(
			0 => "no",
		),
		"CATEGORY_2_iblock_samovar_remstroy_content" => array(
			0 => "10",
		),
		"CATEGORY_3_TITLE" => "",
		"CATEGORY_3" => array(
			0 => "no",
		),
		"CATEGORY_3_iblock_samovar_remstroy_about" => array(
			0 => "all",
		)
	),
	false
);
?>	
		</div>
	</div>
</div>


<!-- .шапка -->

<!-- Верхнее меню -->
<div id="main_menu" class="default_main_menu">
	
	<div class="main_menu_gorizontal  hidden-xs hidden-sm">
		<div class="container">
	
			<div class="row">
				<div class="col-md-12">
					<?
					$APPLICATION->IncludeComponent(
		"bitrix:menu", 
		"top_multi", 
		array(
			"COMPONENT_TEMPLATE" => "top_multi",
			"ROOT_MENU_TYPE" => "top",
			"MENU_CACHE_TYPE" => "N",
			"MENU_CACHE_TIME" => "3600",
			"MENU_CACHE_USE_GROUPS" => "Y",
			"MENU_CACHE_GET_VARS" => array(
			),
			"MAX_LEVEL" => "3",
			"CHILD_MENU_TYPE" => "top_submenu",
			"USE_EXT" => "Y",
			"DELAY" => "N",
			"ALLOW_MULTI_SELECT" => "N",
			"MENU_THEME" => "site"
		),
		false
	);
	?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>

		$(document).ready(function(){

			var $total_price = $("#main_menu");

			$(window).scroll(function(){
				if ( $(this).scrollTop() > 100 && $total_price.hasClass("default_main_menu") ){
					$total_price.removeClass("default_main_menu").addClass("fixed_main_menu");
				} else if($(this).scrollTop() <= 100 && $total_price.hasClass("fixed_main_menu")) {
					$total_price.removeClass("fixed_main_menu").addClass("default_main_menu");
				}
        });//scroll
		});
	</script>

<!-- .Верхнее меню -->

  <?if($APPLICATION->GetCurPage(false) !== SITE_DIR): // Внутренняя?>

<div class="title_page_main">
  <div class="container">
  	<div class="row">

  	<div class="col-md-12">

      <?
      $APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"main",
	array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1",
		"COMPONENT_TEMPLATE" => "main"
	),
	false
);
?>
</div>

  		<div class="col-md-12">



<?//if (!($url_2 == 'catalog' && $url_4) || $APPLICATION->GetCurPage() == '/catalog/' || $url_4 == "filter"): ?>
<?if (true): ?>
      <!-- <div class="page-header"> -->

      <h1>
        <?if($url_3):?>
        <?$APPLICATION->ShowTitle()?>
        <?else:?>
        <?
        $sSectionName = "";
        $sPath = $_SERVER["DOCUMENT_ROOT"].$APPLICATION->GetCurDir().".section.php";
        include($sPath);
        echo $sSectionName;
        ?>

        <?if(isset($_GET['q'])):?>
				<?//$APPLICATION->AddChainItem(GetMessage('search_title'));?>
        		<?//=GetMessage('search_title')?> <span style="color:RED"><?=trim(htmlspecialcharsbx($_GET['q']))?></span>
		<?endif?>

        <?endif?>
      </h1>
 <!-- </div> -->
</div>





</div>
</div>
</div>


  <div class="container">
  	<div class="row">

  	<?if($url_2 == 'kompaniya'):?>
		



  			<div class="main">
  				<div class="col-md-3">
			
		<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left", 
	array(
		"ROOT_MENU_TYPE" => "top_submenu",
		"MENU_CACHE_TYPE" => "N",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left_submenu",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"COMPONENT_TEMPLATE" => "top_submenu",
		"MENU_CACHE_GET_VARS" => array(
		),
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>

		</div>	
  		<div class="col-md-9">

  	<?else:?>
  		<div class="col-md-12">
  			<div class="main">

  	<?endif?>		

<?endif?>
<?endif?>

