<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
$wizTemplateId = COption::GetOptionString("main", "wizard_template_id", "eshop_vertical", SITE_ID);
//CUtil::InitJSCore();
//CJSCore::Init(array("fx"));

$curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	
<!--link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/css/style.css")?>" />	
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/css/respon.css")?>" /-->
<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/style_wholesale.css")?>" />	
	
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<?$APPLICATION->ShowHeadStrings();?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
	<?/*<link href="<?=SITE_TEMPLATE_PATH?>/template_styles.css" rel="stylesheet" type="text/css"/>*/?>
	<?//$APPLICATION->ShowHead();
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";
	$APPLICATION->ShowCSS();
	$APPLICATION->ShowMeta("robots", false, true);
	$APPLICATION->ShowMeta("keywords", false, true);
	$APPLICATION->ShowMeta("description", false, true);
	?>
	
	
	<title><?$APPLICATION->ShowTitle()?></title>
	<script type="text/javascript">if (document.documentElement) { document.documentElement.id = "js" }</script>
</head>
<body>
<?
function ShowTitleOrHeader()
{
	global $APPLICATION;
	if ($APPLICATION->GetPageProperty("ADDITIONAL_TITLE"))
		return $APPLICATION->GetPageProperty("ADDITIONAL_TITLE");
	else
		return $APPLICATION->GetTitle(false);
}
?>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<?$page = $APPLICATION->GetCurPage();?>
<div id="container">
	<div> 
		<header>
	<div class="logoBlock">
			<a id="logo" href="/catalog/"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png" height="62x" alt=""/></a>
		<div class="search">
<div class="phone"><span>8(495)</span> 108-49-34</div><div class="pool_calculation"><a href="/pool_calculation/">Расчет бассейна</a></div>
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
							$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", ".default", array(
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

<div class = "log"><?if($USER->IsAuthorized()): // Если пользователь авторизован, то даем информацию?><?$APPLICATION->IncludeComponent(
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
);?><?endif;?></div>
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
<div class="body_cont" <?if($dir == "/catalog/"): echo 'style="margin-top: 20px;"'; endif;?>>
			<div class="kroshka">
			 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	".default", 
	array(
		"START_FROM" => "1",
		"PATH" => "",
		"SITE_ID" => "-"
	),
	false
);?>
			</div>
		<?if (strpos($APPLICATION->GetCurPage(),"pools")):?>
		<section class="clearfix">
			<aside id="column-l">
				<a href="/pools/"><img src="<?=SITE_TEMPLATE_PATH?>/img/logo_compass.png"/></a>
				<?$APPLICATION->IncludeComponent("bitrix:menu", "bis_tree", array(
					"ROOT_MENU_TYPE" => "left_compass",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MAX_LEVEL" => "3",
					"CHILD_MENU_TYPE" => "podmenu_left_compass",
					"USE_EXT" => "Y",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N"
					),
					false
				);?>
				<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/viewed.products.php"));?>
			</aside>
			<div class="content">
			<?endif;?>
		<?if (strpos($APPLICATION->GetCurPage(),"catalog")):?>
		<section class="clearfix">
			<aside id="column-l">
				<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"arhi_tree", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
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
			<div class="content">
			<?elseif (strpos($APPLICATION->GetCurPage(),"paying")):?>
		<section class="clearfix">
			<aside id="column-l">
				<?$APPLICATION->IncludeComponent("bitrix:menu", "arhi_tree", array(
					"ROOT_MENU_TYPE" => "left",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "N",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MAX_LEVEL" => "4",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "Y",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N"
					),
					false
				);?>
				<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/viewed.products.php"));?>
			</aside>	
<div class="content">
			<!--?elseif (strpos($APPLICATION->GetCurPage(),"wholesale")):?>
		<section class="clearfix">
			<aside id="column-l"-->
				<!--?$APPLICATION->IncludeComponent("bitrix:menu", "arhi_tree", array(
					"ROOT_MENU_TYPE" => "left",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "N",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MAX_LEVEL" => "4",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "Y",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N"
					),
					false
				);?-->
				<!--?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/viewed.products.php"));?>
			</aside>	
			<div class="content"-->
			<?elseif (strpos($APPLICATION->GetCurPage(),"deliver")):?>
		<section class="clearfix">
			<aside id="column-l">
				<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"arhi_tree", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
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
			<div class="content">
			<?elseif (strpos($APPLICATION->GetCurPage(),"best_price")):?>
		<section class="clearfix">
			<aside id="column-l">
				<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"arhi_tree", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "4",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
				<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/viewed.products.php"));?>
			</aside>
				<div class="content">
			<?elseif (strpos($APPLICATION->GetCurPage(),"repayment")):?>
		<section class="clearfix">
			<aside id="column-l">
				<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"arhi_tree", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "4",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
				<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/viewed.products.php"));?>
			</aside>
<div class="content">
			<?elseif (strpos($APPLICATION->GetCurPage(),"articles")):?>
		<section class="clearfix">
			<aside id="column-l">
				<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"arhi_tree", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "4",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
				<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/viewed.products.php"));?>
			</aside>

<div class="content">
			<?elseif (strpos($APPLICATION->GetCurPage(),"cooperation")):?>
		<section class="clearfix">
			<aside id="column-l">
				<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"arhi_tree", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "4",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
				<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/viewed.products.php"));?>
			</aside>
			
			<div class="content">
			<?elseif (strpos($APPLICATION->GetCurPage(),"calculation")):?>
		<section class="clearfix">
			<aside id="column-l">
				<?$APPLICATION->IncludeComponent("bitrix:menu", "arhi_tree", array(
					"ROOT_MENU_TYPE" => "left",
					"MENU_CACHE_TYPE" => "N",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "N",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MAX_LEVEL" => "4",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "Y",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N"
					),
					false
				);?>
				<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/viewed.products.php"));?>
			</aside>			
			<div class="content">
		<?else:?>
		<section class="clearfix">
		<div class="onecolumn">
		<?endif;?>
		<?if ($page=="/about/" || strpos($APPLICATION->GetCurPage(),"news")):?>
			<div class="img-title clearfix">
				<span class="t-img" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/img/t-img-about.png);"></span>
				<h1>О компании</h1>
			</div>
		<?elseif ($page=="/about/contacts/"):?>
			<div class="img-title clearfix">
				<span class="t-img" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/img/t-img-contacts.png);"></span>
				<h1>Контактная информация</h1>
			</div>
		<?endif;?>
		<?if ($page=="/gallery/" || strpos($APPLICATION->GetCurPage(),"gallery")):?>
			<div class="img-title clearfix">
				<h1><?$APPLICATION->ShowTitle()?></h1>
			</div>
		<?endif;?>