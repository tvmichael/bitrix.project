<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);
$theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
?>
<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<meta name="google-site-verification" content="WdE1BJz4wttpWO5M8spMFJ4GTUvBFjtz4vMzK3DDICA" />
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	<?$APPLICATION->ShowHead();?>
	<?
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/colors.css", true);
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/font-awesome.css");
	?>
	<title><?$APPLICATION->ShowTitle()?></title>
	<!-- Facebook Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '181866349139621');
	  fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	  src="https://www.facebook.com/tr?id=181866349139621&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120566019-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-120566019-1');
	</script>
</head>

<body class="bx-background-image bx-theme-<?=$theme?>" <?=$APPLICATION->ShowProperty("backgroundImage")?>>
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	<?$APPLICATION->IncludeComponent("bitrix:eshop.banner", "", array(),
		false,
		array(
		"ACTIVE_COMPONENT" => "N"
		)
	);?>

	<div class="bx-wrapper" id="bx_eshop_wrap">
		<!-- HEADER -->
		<header class="bx-header">
			<div class="bx-header-section"><!--div class="bx-header-section container"-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="bx-header-container">
                            <div class="bx-inc-orginfo-mobile">
                                <div class="bx-inc-orginfo-block">
                                    <i class="fa fa-phone"></i>
                                    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?>
                                </div>
                                <div class="bx-inc-orginfo-block">
                                    <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/schedule.php"), false);?>
                                </div>
                            </div>
                            <div class="bx-menu-header">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "horizontal_multilevel",
                                    array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "bottom",
                                        "COMPONENT_TEMPLATE" => "horizontal_multilevel",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "2",
                                        "MENU_CACHE_GET_VARS" => array(
                                        ),
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_TYPE" => "N",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "MENU_THEME" => "site",
                                        "ROOT_MENU_TYPE" => "bottom",
                                        "USE_EXT" => "N"
                                    ),
                                    false
                                );?>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="bx-header-section-content"> <!--div class="bx-header-section container"-->
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
						<div class="bx-logo">
							<a class="bx-logo-block hidden-xs" href="<?=SITE_DIR?>">
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."/include/company_logo.php"), false);?>
							</a>
							<a class="bx-logo-block hidden-lg hidden-md hidden-sm text-center" href="<?=SITE_DIR?>">
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."/include/company_logo_mobile.php"), false);?>
							</a>
						</div>
					</div>

					<div class="col-lg-3 col-md-4 hidden-sm hidden-xs">
						<div class="bx-inc-orginfo">
							<span class="bx-inc-orginfo-phone">
								<i class="fa fa-phone"></i>
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?>
							</span>
						</div>
						<div class="bx-worktime">
							<div class="bx-worktime-prop">
								<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/schedule.php"), false);?>
							</div>
						</div>
					</div>				

					<div class="col-lg-4 col-md-3 col-sm-5 col-xs-12">
						<?$APPLICATION->IncludeComponent(
							"bitrix:search.title", 
							"visual", 
							array(
								"NUM_CATEGORIES" => "1",
								"TOP_COUNT" => "5",
								"CHECK_DATES" => "N",
								"SHOW_OTHERS" => "N",
								"PAGE" => "#SITE_DIR#search/index.php",
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
									0 => "Гурт",
									1 => "Гурт1",
									2 => "Пром_Vip100",
									3 => "Partner",
									4 => "Vip",
								),
								"SHOW_PREVIEW" => "Y",
								"PREVIEW_WIDTH" => "75",
								"PREVIEW_HEIGHT" => "75",
								"CONVERT_CURRENCY" => "N",
								"COMPONENT_TEMPLATE" => "visual",
								"ORDER" => "date",
								"USE_LANGUAGE_GUESS" => "Y",
								"PRICE_VAT_INCLUDE" => "Y",
								"PREVIEW_TRUNCATE_LEN" => "",
								"CATEGORY_0_iblock_1c_catalog" => array(
									0 => "6",
								)
							),
							false
						);?>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-5">
						<div class="bx-header-basket">
							<?$APPLICATION->IncludeComponent(
                                "bitrix:sale.basket.basket.line",
                                "template_mv",
                                array(
                                    "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                                    "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                                    "SHOW_PERSONAL_LINK" => "N",
                                    "SHOW_NUM_PRODUCTS" => "Y",
                                    "SHOW_TOTAL_PRICE" => "Y",
                                    "SHOW_PRODUCTS" => "Y",
                                    "POSITION_FIXED" => "N",
                                    "SHOW_AUTHOR" => "Y",
                                    "PATH_TO_REGISTER" => SITE_DIR."login/",
                                    "PATH_TO_PROFILE" => SITE_DIR."personal/",
                                    "COMPONENT_TEMPLATE" => "template_mv",
                                    "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                                    "SHOW_EMPTY_VALUES" => "Y",
                                    "PATH_TO_AUTHORIZE" => SITE_DIR."login/",
                                    "SHOW_REGISTRATION" => "Y",
                                    "SHOW_DELAY" => "N",
                                    "SHOW_NOTAVAIL" => "N",
                                    "SHOW_IMAGE" => "Y",
                                    "SHOW_PRICE" => "Y",
                                    "SHOW_SUMMARY" => "Y",
                                    "POSITION_HORIZONTAL" => "right",
                                    "POSITION_VERTICAL" => "top",
                                    "HIDE_ON_BASKET_PAGES" => "Y",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    "MAX_IMAGE_SIZE" => "70"
                                ),
                                false
                            );?>
						</div>
					</div>
				</div>



				<div class="row">
					<div class="hidden-lg hidden-md hidden-sm col-xs-12">
						<? // Mobile version
						$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"catalog_horizontal", 
							array(
								"ROOT_MENU_TYPE" => "left",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "36000000",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_THEME" => "site",
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
						);?>
					</div>
				</div>			

				<?if ($curPage != SITE_DIR."index.php"):?>
					<div class="row">
						<div class="col-lg-12" id="navigation">
							<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
									"START_FROM" => "0",
									"PATH" => "",
									"SITE_ID" => "-"
								),
								false,
								Array('HIDE_ICONS' => 'Y')
							);?>
						</div>
					</div>
					<h1 class="bx-title dbg_title" id="pagetitle"><?=$APPLICATION->ShowTitle(false);?></h1>
				<?endif?>
				
				<div class="col-lg-12">
					<?//if ($curPage == SITE_DIR."index.php"):?>
					    <?//if(IsModuleInstalled("advertising")):?>
							<?
                            //    $APPLICATION->IncludeComponent(
                            //        "bitrix:advertising.banner",
                            //        "bootstrap",
                            //        Array(
                            //            "BS_ARROW_NAV" => "Y",
                            //            "BS_BULLET_NAV" => "Y",
                            //            "BS_CYCLING" => "N",
                            //            "BS_EFFECT" => "fade",
                            //            "BS_HIDE_FOR_PHONES" => "Y",
                            //            "BS_HIDE_FOR_TABLETS" => "N",
                            //            "BS_KEYBOARD" => "Y",
                            //            "BS_PAUSE" => "Y",
                            //            "BS_WRAP" => "Y",
                            //            "CACHE_TIME" => "36000000",
                            //            "CACHE_TYPE" => "A",
                            //            "COMPONENT_TEMPLATE" => "bootstrap",
                            //            "DEFAULT_TEMPLATE" => "-",
                            //            "NOINDEX" => "Y",
                            //            "QUANTITY" => "3",
                            //            "TYPE" => "MAIN"
                            //        ),
                            //    false,
                            //    Array(
                            //        'ACTIVE_COMPONENT' => 'Y'
                            //    )
                            //    );
							?>
                        <?//endif?>
					<?//endif?>
				</div>
			</div>
		</header>


		<!-- WORKAREA -->
		<div class="workarea">
			<div class="bx-content-seection"><!--div class="container bx-content-seection"-->
				<div class="row">
				<?/* $needSidebar = preg_match("~^".SITE_DIR."(catalog|personal\/cart|personal\/order\/make)/~", $curPage); */?>
				<?$needSidebarRigth = preg_match("~^".SITE_DIR."(catalog|personal\/)/~", $curPage)|| $GLOBALS['APPLICATION']->GetCurPage(false) === '/';?>
					<? if ($needSidebarRigth): ?>
						<div class="sidebar col-md-3 col-sm-4">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "sect",
									"AREA_FILE_SUFFIX" => "sidebar_rigth",
									"AREA_FILE_RECURSIVE" => "Y",
									"EDIT_MODE" => "html",
								),
								false,
								Array('HIDE_ICONS' => 'Y')
							);?>
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "sect",
									"AREA_FILE_SUFFIX" => "sidebar_catalog",
									"AREA_FILE_RECURSIVE" => "Y",
									"EDIT_MODE" => "html",
								),
								false,
								Array('HIDE_ICONS' => 'N')
							);?>
						</div><!--// sidebar -->
					<?endif?>
				<div class="bx-content <?=(!$needSidebarRigth ? "col-xs-12" : "col-md-9 col-sm-8")?>">