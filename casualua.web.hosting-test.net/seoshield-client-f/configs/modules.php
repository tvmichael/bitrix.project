<?php
// модули которые необходимо включить (если раскомментить - то модуль включится)
// включенные модули приоритетней выключеных
$GLOBALS['SEOSHIELD_CONFIG']['enabled_modules']=array(
	// "add_to_ititle",
	// "add_to_noindex",
	// "api_generate_content",
	"generate_content",
	"genereate_meta",
	// "global_module",
	// "links_block",
	// "pages_adverts",
	// "redirect_301",
	// "replace_by_referer",
	// "rewrite_metric_access",
	// "replace_tag",
	// "run_404",
	// "seo_urls",
	"static_meta",
	// "add_static_pages",
);

// позволяем задать порядок загрузки модулей (надо указать имя модулей, без .php)
$GLOBALS['SEOSHIELD_CONFIG']['modules_ordering']=array(
	"add_static_pages",
	"redirect_301",
	"replace_by_referer",
	"genereate_meta",
	"generate_content",
	"global_module",
	"api_generate_content",
	"static_meta",
);

$GLOBALS['SEOSHIELD_CONFIG']['content_area_selector'] = array(
	array(
		'type' => 'regex',
		'pattern' => '#(<!--seo_text_start-->)(.*?)(<!--seo_text_end-->)#is',
	),
);