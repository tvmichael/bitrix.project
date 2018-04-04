<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/style.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/respon.css")?>" />
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/jquery.jscrollpane.css")?>" />
	<?$APPLICATION->ShowHead();?>
	<?
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/colors.css", true);
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/font-awesome.css");
	?>
	<title><?$APPLICATION->ShowTitle()?></title>
</head>

<body class="bx-background-image bx-theme-<?=$theme?>" <?=$APPLICATION->ShowProperty("backgroundImage")?>>
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	<?$APPLICATION->IncludeComponent("bitrix:eshop.banner", "", array());?>
	<div class="bx-wrapper" id="bx_eshop_wrap">
		<header class="header">
			<div class="logoBlock">
				<a id="logo" href="/catalog/"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo-alex.png" style="height: 62px;" alt=""/></a>
				<div class="search">
					<div class="phone"></div>
					<div class="pool_calculation"><a href="/pool_calculation/">Расчет бассейна</a>
					</div>
					<?$APPLICATION->IncludeComponent(
						"bitrix:search.title", 
						"visual_Lena", 
						array(
							"NUM_CATEGORIES" => "3",
							"TOP_COUNT" => "10",
							"ORDER" => "date",
							"USE_LANGUAGE_GUESS" => "N",
							"CHECK_DATES" => "Y",
							"SHOW_OTHERS" => "Y",
							"PAGE" => "#SITE_DIR#search/index.php",
							"CATEGORY_OTHERS_TITLE" => "Прочее",
							"CATEGORY_0_TITLE" => "Новости",
							"CATEGORY_0" => array(
								0 => "iblock_news",
							),
							"CATEGORY_0_iblock_news" => array(
								0 => "1",
							),
							"CATEGORY_1_TITLE" => "Форумы",
							"CATEGORY_1" => array(
								0 => "forum",
							),
							"CATEGORY_1_forum" => array(
								0 => "all",
							),
							"CATEGORY_2_TITLE" => "Каталоги",
							"CATEGORY_2" => array(
								0 => "iblock_1c_catalog",
							),
							"CATEGORY_2_iblock_1c_catalog" => array(
								0 => "79",
							),
							"SHOW_INPUT" => "Y",
							"INPUT_ID" => "title-search-input",
							"CONTAINER_ID" => "title-search",
							"PRICE_CODE" => array(
							),
							"PRICE_VAT_INCLUDE" => "Y",
							"PREVIEW_TRUNCATE_LEN" => "150",
							"SHOW_PREVIEW" => "Y",
							"PREVIEW_WIDTH" => "75",
							"PREVIEW_HEIGHT" => "75",
							"CONVERT_CURRENCY" => "Y",
							"CURRENCY_ID" => "RUB",
							"COMPONENT_TEMPLATE" => "visual_Lena",
							"CATEGORY_2_iblock_offers" => array(
								0 => "all",
							),
							"CATEGORY_0_iblock_1c_catalog" => array(
								0 => "79",
							)
						),
						false
					);?>
				</div>

				<div class="top-cart">
					<div class="cart-header">Корзина товаров</div>
						<span id="cart_line">
							<?
								$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "default_arhicode", array(
								"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
								"PATH_TO_PERSONAL" => SITE_DIR."personal/",
								"SHOW_PERSONAL_LINK" => "N"
								),
								false,
								Array('')
								);
							?>
						</span>
						<?//$APPLICATION->ShowProperty("CATALOG_COMPARE_LIST", "");?>
					<a class="link-overlay" href="/personal/cart/"></a>					
				</div>

				<div class = "log">
					<?if($USER->IsAuthorized()): // Если пользователь авторизован, то даем информацию?><?$APPLICATION->IncludeComponent(
						"bitrix:main.user.link",
						"",
						Array(
							"CACHE_TIME" => "7200",
							"CACHE_TYPE" => "A",
							"ID" => $USER->GetID(),
							"NAME_TEMPLATE" => "#NAME# #LAST_NAME#",
							"SHOW_LOGIN" => "Y",
							"THUMBNAIL_LIST_SIZE" => "30",
							"USE_THUMBNAIL_LIST" => "N"
						)
					);?>
					<?endif;?>				
				</div>
			</div>
			<?$dir = $APPLICATION->GetCurDir();?> <?if($dir == "/catalog/"):?>
			<div class="maker">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include", 
					".default", 
					array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "logos",
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_TEMPLATE" => "standard.php"
					),
					false
				);?>
			</div>
			<?endif;?>
			<div class="top_menu_main">
				<?$APPLICATION->IncludeComponent(
				"bitrix:menu", 
				"bis_horizontal_menu", 
				array(
					"ROOT_MENU_TYPE" => "top",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MAX_LEVEL" => "2",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "N",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N",
					"COMPONENT_TEMPLATE" => "bis_horizontal_menu"
				),
				false
				);
				?>
			</div>
		</header>

		<div class="workarea">
			<div class="kroshka col-sm-10 col-sm-offset-1">
					 <?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb", 
					".default", 
					array(
						"START_FROM" => "1",
						"PATH" => "",
						"SITE_ID" => "s2",
						"COMPONENT_TEMPLATE" => ".default"
					),
					false
				);?>
			</div>		
		
			<section class="clearfix">
				<div class="bx-content col-md-2 col-sm-3 col-sm-offset-1">
					<aside id="column-l">
						<?$APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"arhi_tree", 
						array(
							"ROOT_MENU_TYPE" => "left",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "N",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MAX_LEVEL" => "4",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "Y",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N",
							"COMPONENT_TEMPLATE" => "arhi_tree"
						),
						false
					);?>
						<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/viewed.products.php"));?>
					</aside>
				</div>						
					

				<div class="container bx-content-seection">
					<div class="row">
					<?$needSidebar = preg_match("~^".SITE_DIR."(catalog|personal\/cart|personal\/order\/make)/~", $curPage);?>
						<div class="bx-content <?=($needSidebar ? "col-xs-12" : "col-md-10 col-sm-8")?>">