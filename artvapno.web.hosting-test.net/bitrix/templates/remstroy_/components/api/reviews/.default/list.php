<?php

use \Bitrix\Main\Page\Asset,
	 \Bitrix\Main\Page\AssetLocation,
	 Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/**
 * Bitrix vars
 *
 * @var CBitrixComponentTemplate $this
 * @var CBitrixComponent         $component
 *
 * @var array                    $arParams
 * @var array                    $arResult
 *
 * @var string                   $templateName
 * @var string                   $templateFile
 * @var string                   $templateFolder
 * @var array                    $templateData
 *
 * @var string                   $componentPath
 * @var string                   $parentTemplateFolder
 *
 * @var CDatabase                $DB
 * @var CUser                    $USER
 * @var CMain                    $APPLICATION
 */

Loc::loadMessages(__FILE__);

if(method_exists($this, 'setFrameMode'))
	$this->setFrameMode(true);

if($arParams['INCLUDE_CSS'] == 'Y') {
	$this->addExternalCss($templateFolder . '/theme/' . $arParams['THEME'] . '/style.css');
}

$stat_class = ($arParams['USE_STAT'] ? ' api-stat-on' : ' api-stat-off');
?>
	<script srs="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.3.min.js"></script>

	<?
	if ( $USER->IsAdmin() ) 
	{
		echo '<div class="col-md-12"><pre>';
		print_r($templateFolder);
		echo '</pre></div>';
		// 
		//$APPLICATION->AddHeadScript($templateFolder.'/api/reviews.form/.default/plugins/modal/api.modal.js');
	};
	?>

	<script type="text/javascript">
		/**
		 * $.fn.apiModal
		 */
		(function ($) {

			console.log('$.fn.apiModal');

			// настройки со значением по умолчанию
			var defaults = {
				id: ''
			};

			// публичные методы
			var methods = {

				// инициализация плагина
				init: function (params) {

					// актуальные настройки, будут индивидуальными при каждом запуске
					var options = $.extend({}, defaults, options, params);

					// инициализируем лишь единожды
					if (!this.data('apiModal')) {

						// закинем настройки в реестр data
						this.data('apiModal', options);

						// код плагина

						$(document).on('click', '.api-modal, .api-modal-close', function (e) {
							e.preventDefault();

							$('.api-modal .api-modal-dialog').css({
								'transform': 'translateY(-200px)',
								'-webkit-transform': 'translateY(-200px)'
							});
							$('.api-modal').animate({opacity: 0}, 300, function () {
								$(this).hide().removeClass('api-modal-open');
								$('html').removeClass('api-modal-active');
							});
						});


						$(document).on('click', '.api-modal .api-modal-dialog', function (e) {
							//e.preventDefault();
							e.stopPropagation();
						});
					}

					return this;
				},
				show: function (options) {
					$('html').addClass('api-modal-active');

					var modal =  $(options.id);
					var dialog =  $(options.id + ' .api-modal-dialog');

					dialog.removeAttr('style');
					modal.show().animate({opacity: 1}, 1, function () {

						var dh  = dialog.outerHeight(),
						    pad = parseInt(dialog.css('margin-top'), 10) + parseInt(dialog.css('margin-bottom'), 10);

						if ((dh + pad) < window.innerHeight) {
							dialog.css({top: (window.innerHeight - (dh + pad)) / 2});
						} else {
							dialog.css({top: ''});
						}

						modal.addClass('api-modal-open');
					});
				},
				resize: function () {

					var dialog = $('.api-modal .api-modal-dialog');

					$('.api-modal.api-modal-open').each(function () {
						var dh  = dialog.outerHeight(),
						    pad = parseInt(dialog.css('margin-top'), 10) + parseInt(dialog.css('margin-bottom'), 10);

						if ((dh + pad) < window.innerHeight) {
							dialog.animate({top: (window.innerHeight - (dh + pad)) / 2}, 100);
						} else {
							dialog.animate({top: ''}, 100);
						}
					});

					/*
					 var timeout;
					 var wait   = 150;

					 clearTimeout(timeout);
					timeout = setTimeout(function () {
						//Yeah buddy, light weight baby!!!
					}, wait);
					*/
				},
				alert: function (options) {

					/*
					$.fn.apiModal('alert',{
						type: 'success',
					  autoHide: true,
						modalId: modalId,
						message: data.MESSAGE
					});
					*/
					var dialogStyle = $(options.modalId + ' .api-modal-dialog').attr('style');

					var content = '' +
						 '<div class="api-modal-dialog api-alert" style="'+dialogStyle+'">' +
							 '<div class="api-modal-close"></div>' +
							 '<div class="api-alert-'+options.type+'">' +
								 '<span></span>' +
								 '<div class="api-alert-title">'+options.message+'</div>' +
							 '</div>' +
						 '</div>';

					$(options.modalId).html(content);
					$.fn.apiModal('resize');

					if(options.autoHide)
					{
						window.setTimeout(function(){
							$.fn.apiModal('hide', options);

							//TODO: say what?!
							$.fn.apiReviewsList('refresh');
						},options.autoHide);
					}
				},
				hide: function (options) {
					$(options.modalId).hide().removeClass('api-modal-open');
					$('html').removeClass('api-modal-active');
				}
			};

			$.fn.apiModal = function (method) {
				if (methods[method]) {
					// если запрашиваемый метод существует, мы его вызываем
					// все параметры, кроме имени метода прийдут в метод
					// this так же перекочует в метод
					return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
				} else if (typeof method === 'object' || !method) {
					// если первым параметром идет объект, либо совсем пусто
					// выполняем метод init
					return methods.init.apply(this, arguments);
				} else {
					// если ничего не получилось
					$.error('Error! Method "' + method + '" not found in plugin $.fn.apiModal');
				}
			};

			$(window).on('resize', function () {
				$.fn.apiModal('resize');
			});

			//$(window).trigger('resize');

			$.fn.apiModal('init');

		})(jQuery);
	</script>


	<div id="reviews" class="api-reviews <?=$stat_class?>" itemscope itemtype="http://schema.org/Product">
		<?
		$dynamicArea = new \Bitrix\Main\Page\FrameStatic("reviews");
		$dynamicArea->setAnimation(true);
		$dynamicArea->setStub('');
		$dynamicArea->setContainerID("reviews");
		$dynamicArea->startDynamicArea();
		?>
		<div class="api-block-top arbt-color-<?=$arParams['COLOR']?>">
			<div class="api-block-title">
				<div class="api-block-left">
					<?=($arParams['~STAT_MESS_CUSTOMER_REVIEWS'] ? $arParams['~STAT_MESS_CUSTOMER_REVIEWS'] : Loc::getMessage('API_REVIEWS_LIST_HEADER_TITLE'))?>
				</div>
				<? if($arParams['USE_SUBSCRIBE'] == 'Y'): ?>
					<div class="api-block-right">
						<?$APPLICATION->IncludeComponent(
							 'api:reviews.subscribe',
							 "",
							 array(
									'THEME'                  => $arParams['~THEME'],
									'COLOR'                  => $arParams['~COLOR'],
									'INCLUDE_CSS'            => $arParams['~INCLUDE_CSS'],
									'AJAX_URL'               => $arParams['~SUBSCRIBE_AJAX_URL'],
									'MESS_LINK'              => $arParams['~MESS_SUBSCRIBE_LINK'],
									'MESS_SUBSCRIBE'         => $arParams['~MESS_SUBSCRIBE_SUBSCRIBE'],
									'MESS_UNSUBSCRIBE'       => $arParams['~MESS_SUBSCRIBE_UNSUBSCRIBE'],
									'MESS_FIELD_PLACEHOLDER' => $arParams['~MESS_SUBSCRIBE_FIELD_PLACEHOLDER'],
									'MESS_BUTTON_TEXT'       => $arParams['~MESS_SUBSCRIBE_BUTTON_TEXT'],
									'MESS_ERROR'             => $arParams['~MESS_SUBSCRIBE_ERROR'],
									'MESS_ERROR_EMAIL'       => $arParams['~MESS_SUBSCRIBE_ERROR_EMAIL'],
									'MESS_ERROR_CHECK_EMAIL' => $arParams['~MESS_SUBSCRIBE_ERROR_CHECK_EMAIL'],
									'IBLOCK_ID'              => $arParams['~IBLOCK_ID'],
									'SECTION_ID'             => $arParams['~SECTION_ID'],
									'ELEMENT_ID'             => $arParams['~ELEMENT_ID'],
									'ORDER_ID'               => $arParams['~ORDER_ID'],
									'URL'                    => $arParams['~URL'],
							 ),
							 $component
						);?>
					</div>
				<? endif ?>
			</div>
			<div class="api-block-header">
				<? if($arParams['USE_STAT']): ?>
					<? $APPLICATION->IncludeComponent(
						 'api:reviews.stat',
						 "",
						 array(
								'THEME'                 => $arParams['~THEME'],
								'COLOR'                 => $arParams['~COLOR'],
								'MESS_TOTAL_RATING'     => $arParams['~STAT_MESS_TOTAL_RATING'],
								'MESS_CUSTOMER_RATING'  => $arParams['~STAT_MESS_CUSTOMER_RATING'],
								'MESS_CUSTOMER_REVIEWS' => $arParams['~STAT_MESS_CUSTOMER_REVIEWS'],
								'MIN_AVERAGE_RATING'    => $arParams['~STAT_MIN_AVERAGE_RATING'],
								'CACHE_TYPE'            => $arParams['~CACHE_TYPE'],
								'CACHE_TIME'            => $arParams['~CACHE_TIME'],
								'INCLUDE_CSS'           => $arParams['~INCLUDE_CSS'],
								'IBLOCK_ID'             => $arParams['~IBLOCK_ID'],
								'SECTION_ID'            => $arParams['~SECTION_ID'],
								'ELEMENT_ID'            => $arParams['~ELEMENT_ID'],
								'ORDER_ID'              => $arParams['~ORDER_ID'],
								'URL'                   => $arParams['~URL'],
						 ),
						 $component
					); ?>
				<? endif ?>
				<? $APPLICATION->IncludeComponent(
					 'api:reviews.form',
					 "",
					 array(
							'THEME'                               => $arParams['~THEME'],
							'COLOR'                               => $arParams['~COLOR'],
							'EMAIL_TO'                            => $arParams['~EMAIL_TO'],
							'SHOP_NAME'                           => $arParams['~SHOP_NAME'],
							'INCLUDE_CSS'                         => $arParams['~INCLUDE_CSS'],
							'INCLUDE_JQUERY'                      => $arParams['~INCLUDE_JQUERY'],
							'CACHE_TYPE'                          => $arParams['~CACHE_TYPE'],
							'CACHE_TIME'                          => $arParams['~CACHE_TIME'],
							'DISPLAY_FIELDS'                      => $arParams['~FORM_DISPLAY_FIELDS'],
							'REQUIRED_FIELDS'                     => $arParams['~FORM_REQUIRED_FIELDS'],
							'PREMODERATION'                       => $arParams['~FORM_PREMODERATION'],
							'DELIVERY'                            => $arParams['~FORM_DELIVERY'],
							'CITY_VIEW'                           => $arParams['~FORM_CITY_VIEW'],
							'USE_PLACEHOLDER'                     => $arParams['~FORM_USE_PLACEHOLDER'],
							'RULES_TEXT'                          => $arParams['~FORM_RULES_TEXT'],
							'RULES_LINK'                          => $arParams['~FORM_RULES_LINK'],
							'SHOP_TEXT'                           => $arParams['~FORM_SHOP_TEXT'],
							'SHOP_BTN_TEXT'                       => $arParams['~FORM_SHOP_BTN_TEXT'],
							'FORM_TITLE'                          => $arParams['~FORM_FORM_TITLE'],
							'FORM_SUBTITLE'                       => $arParams['~FORM_FORM_SUBTITLE'],
							'IBLOCK_ID'                           => $arParams['~IBLOCK_ID'],
							'SECTION_ID'                          => $arParams['~SECTION_ID'],
							'ELEMENT_ID'                          => $arParams['~ELEMENT_ID'],
							'ORDER_ID'                            => $arParams['~ORDER_ID'],
							'URL'                                 => $arParams['~URL'],
							'USE_SUBSCRIBE'                       => $arParams['~USE_SUBSCRIBE'],
							'MESS_ADD_REVIEW_VIZIBLE'             => $arParams['~FORM_MESS_ADD_REVIEW_VIZIBLE'],
							'MESS_ADD_REVIEW_MODERATION'          => $arParams['~FORM_MESS_ADD_REVIEW_MODERATION'],
							'MESS_ADD_REVIEW_ERROR'               => $arParams['~FORM_MESS_ADD_REVIEW_ERROR'],
							'MESS_ADD_REVIEW_EVENT_THEME'         => $arParams['~FORM_MESS_ADD_REVIEW_EVENT_THEME'],
							'MESS_ADD_REVIEW_EVENT_TEXT'          => $arParams['~FORM_MESS_ADD_REVIEW_EVENT_TEXT'],
							'MESS_STAR_RATING_1'                  => $arParams['~FORM_MESS_STAR_RATING_1'],
							'MESS_STAR_RATING_2'                  => $arParams['~FORM_MESS_STAR_RATING_2'],
							'MESS_STAR_RATING_3'                  => $arParams['~FORM_MESS_STAR_RATING_3'],
							'MESS_STAR_RATING_4'                  => $arParams['~FORM_MESS_STAR_RATING_4'],
							'MESS_STAR_RATING_5'                  => $arParams['~FORM_MESS_STAR_RATING_5'],
							'MESS_FIELD_PLACEHOLDER_RATING'       => $arParams['~FORM_MESS_FIELD_PLACEHOLDER_RATING'],
							'MESS_FIELD_PLACEHOLDER_ORDER_ID'     => $arParams['~FORM_MESS_FIELD_PLACEHOLDER_ORDER_ID'],
							'MESS_FIELD_PLACEHOLDER_TITLE'        => $arParams['~FORM_MESS_FIELD_PLACEHOLDER_TITLE'],
							'MESS_FIELD_PLACEHOLDER_ADVANTAGE'    => $arParams['~FORM_MESS_FIELD_PLACEHOLDER_ADVANTAGE'],
							'MESS_FIELD_PLACEHOLDER_DISADVANTAGE' => $arParams['~FORM_MESS_FIELD_PLACEHOLDER_DISADVANTAGE'],
							'MESS_FIELD_PLACEHOLDER_ANNOTATION'   => $arParams['~FORM_MESS_FIELD_PLACEHOLDER_ANNOTATION'],
							'MESS_FIELD_PLACEHOLDER_DELIVERY'     => $arParams['~FORM_MESS_FIELD_PLACEHOLDER_DELIVERY'],
							'MESS_FIELD_PLACEHOLDER_GUEST_NAME'   => $arParams['~FORM_MESS_FIELD_PLACEHOLDER_GUEST_NAME'],
							'MESS_FIELD_PLACEHOLDER_GUEST_EMAIL'  => $arParams['~FORM_MESS_FIELD_PLACEHOLDER_GUEST_EMAIL'],
							'MESS_FIELD_PLACEHOLDER_GUEST_PHONE'  => $arParams['~FORM_MESS_FIELD_PLACEHOLDER_GUEST_PHONE'],
							'MESS_FIELD_PLACEHOLDER_CITY'         => $arParams['~FORM_MESS_FIELD_PLACEHOLDER_CITY'],
							'MESS_FIELD_NAME_RATING'              => $arParams['~MESS_FIELD_NAME_RATING'],
							'MESS_FIELD_NAME_ORDER_ID'            => $arParams['~MESS_FIELD_NAME_ORDER_ID'],
							'MESS_FIELD_NAME_TITLE'               => $arParams['~MESS_FIELD_NAME_TITLE'],
							'MESS_FIELD_NAME_ADVANTAGE'           => $arParams['~MESS_FIELD_NAME_ADVANTAGE'],
							'MESS_FIELD_NAME_DISADVANTAGE'        => $arParams['~MESS_FIELD_NAME_DISADVANTAGE'],
							'MESS_FIELD_NAME_ANNOTATION'          => $arParams['~MESS_FIELD_NAME_ANNOTATION'],
							'MESS_FIELD_NAME_DELIVERY'            => $arParams['~MESS_FIELD_NAME_DELIVERY'],
							'MESS_FIELD_NAME_GUEST_NAME'          => $arParams['~MESS_FIELD_NAME_GUEST_NAME'],
							'MESS_FIELD_NAME_GUEST_EMAIL'         => $arParams['~MESS_FIELD_NAME_GUEST_EMAIL'],
							'MESS_FIELD_NAME_GUEST_PHONE'         => $arParams['~MESS_FIELD_NAME_GUEST_PHONE'],
							'MESS_FIELD_NAME_CITY'                => $arParams['~MESS_FIELD_NAME_CITY'],
							'MESS_FIELD_NAME_COMPANY'             => $arParams['~MESS_FIELD_NAME_COMPANY'],
							'MESS_FIELD_NAME_WEBSITE'             => $arParams['~MESS_FIELD_NAME_WEBSITE'],
							'MESS_FIELD_NAME_FILES'               => $arParams['~MESS_FIELD_NAME_FILES'],
							'MESS_FIELD_NAME_VIDEOS'              => $arParams['~MESS_FIELD_NAME_VIDEOS'],

							'USE_EULA'             => $arParams['~FORM_USE_EULA'],
							'MESS_EULA'            => $arParams['~FORM_MESS_EULA'],
							'MESS_EULA_CONFIRM'    => $arParams['~FORM_MESS_EULA_CONFIRM'],
							'USE_PRIVACY'          => $arParams['~FORM_USE_PRIVACY'],
							'MESS_PRIVACY'         => $arParams['~FORM_MESS_PRIVACY'],
							'MESS_PRIVACY_LINK'    => $arParams['~FORM_MESS_PRIVACY_LINK'],
							'MESS_PRIVACY_CONFIRM' => $arParams['~FORM_MESS_PRIVACY_CONFIRM'],

							'UPLOAD_FILE_TYPE'   => $arParams['~UPLOAD_FILE_TYPE'],
							'UPLOAD_FILE_SIZE'   => $arParams['~UPLOAD_FILE_SIZE'],
							'UPLOAD_FILE_LIMIT'  => $arParams['~UPLOAD_FILE_LIMIT'],
							'UPLOAD_VIDEO_LIMIT' => $arParams['~UPLOAD_VIDEO_LIMIT'],

							//'USE_LIST'    => $arParams['~USE_LIST'],
							'DETAIL_HASH'        => $arParams['~DETAIL_HASH'],
							'SEF_MODE'           => $arParams['~SEF_MODE'],
							'SEF_FOLDER'         => $arParams['~SEF_FOLDER'],
							'DETAIL_URL'         => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['detail'],
							'LIST_URL'           => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['list'],
					 ),
					 $component
				); ?>
			</div>
			<div class="api-block-sort">
				<? $APPLICATION->IncludeComponent(
					 'api:reviews.sort',
					 "",
					 array(
							'THEME'       => $arParams['~THEME'],
							'COLOR'       => $arParams['~COLOR'],
							'USE_STAT'    => $arParams['~USE_STAT'],
							'INCLUDE_CSS' => $arParams['~INCLUDE_CSS'],
							'SORT_FIELDS' => $arParams['~LIST_SORT_FIELDS'],
					 ),
					 $component
				); ?>
			</div>
		</div>
		<div class="api-block-content">
			<? $APPLICATION->IncludeComponent(
				 'api:reviews.list',
				 '',
				 array(
						'THEME'              => $arParams['~THEME'],
						'COLOR'              => $arParams['~COLOR'],
						'EMAIL_TO'           => $arParams['~EMAIL_TO'],
						'SHOP_NAME'          => $arParams['~SHOP_NAME'],
						'INCLUDE_CSS'        => $arParams['~INCLUDE_CSS'],
						'INCLUDE_JQUERY'     => $arParams['~INCLUDE_JQUERY'],
						'CACHE_TYPE'         => $arParams['~CACHE_TYPE'],
						'CACHE_TIME'         => $arParams['~CACHE_TIME'],
						'ITEMS_LIMIT'        => $arParams['~LIST_ITEMS_LIMIT'],
						'ACTIVE_DATE_FORMAT' => $arParams['~LIST_ACTIVE_DATE_FORMAT'],
						'SET_TITLE'          => $arParams['~LIST_SET_TITLE'],
						'SHOW_THUMBS'        => $arParams['~LIST_SHOW_THUMBS'],
						'ALLOW'              => $arParams['~LIST_ALLOW'],
						'SHOP_NAME_REPLY'    => $arParams['~LIST_SHOP_NAME_REPLY'],
						'IBLOCK_ID'          => $arParams['~IBLOCK_ID'],
						'SECTION_ID'         => $arParams['~SECTION_ID'],
						'ELEMENT_ID'         => $arParams['~ELEMENT_ID'],
						'ORDER_ID'           => $arParams['~ORDER_ID'],
						'URL'                => $arParams['~URL'],
						'PICTURE'            => $arParams['~PICTURE'],
						'RESIZE_PICTURE'     => $arParams['~RESIZE_PICTURE'],
						'USE_STAT'           => $arParams['~USE_STAT'],
						'USE_USER'           => $arParams['~USE_USER'],

						'SORT_FIELDS'  => $arParams['~LIST_SORT_FIELDS'],
						'SORT_FIELD_1' => $arParams['~LIST_SORT_FIELD_1'],
						'SORT_ORDER_1' => $arParams['~LIST_SORT_ORDER_1'],
						'SORT_FIELD_2' => $arParams['~LIST_SORT_FIELD_2'],
						'SORT_ORDER_2' => $arParams['~LIST_SORT_ORDER_2'],
						'SORT_FIELD_3' => $arParams['~LIST_SORT_FIELD_3'],
						'SORT_ORDER_3' => $arParams['~LIST_SORT_ORDER_3'],

						'MESS_ADD_UNSWER_EVENT_THEME'  => $arParams['~LIST_MESS_ADD_UNSWER_EVENT_THEME'],
						'MESS_ADD_UNSWER_EVENT_TEXT'   => $arParams['~LIST_MESS_ADD_UNSWER_EVENT_TEXT'],
						'MESS_TRUE_BUYER'              => $arParams['~LIST_MESS_TRUE_BUYER'],
						'MESS_HELPFUL_REVIEW'          => $arParams['~LIST_MESS_HELPFUL_REVIEW'],

						//new
						'USE_SUBSCRIBE'                => $arParams['~USE_SUBSCRIBE'],
						'DISPLAY_FIELDS'               => $arParams['~FORM_DISPLAY_FIELDS'],
						'MESS_FIELD_NAME_RATING'       => $arParams['MESS_FIELD_NAME_RATING'],
						'MESS_FIELD_NAME_ORDER_ID'     => $arParams['MESS_FIELD_NAME_ORDER_ID'],
						'MESS_FIELD_NAME_TITLE'        => $arParams['MESS_FIELD_NAME_TITLE'],
						'MESS_FIELD_NAME_ADVANTAGE'    => $arParams['MESS_FIELD_NAME_ADVANTAGE'],
						'MESS_FIELD_NAME_DISADVANTAGE' => $arParams['MESS_FIELD_NAME_DISADVANTAGE'],
						'MESS_FIELD_NAME_ANNOTATION'   => $arParams['MESS_FIELD_NAME_ANNOTATION'],
						'MESS_FIELD_NAME_DELIVERY'     => $arParams['MESS_FIELD_NAME_DELIVERY'],
						'MESS_FIELD_NAME_GUEST_NAME'   => $arParams['MESS_FIELD_NAME_GUEST_NAME'],
						'MESS_FIELD_NAME_GUEST_EMAIL'  => $arParams['MESS_FIELD_NAME_GUEST_EMAIL'],
						'MESS_FIELD_NAME_GUEST_PHONE'  => $arParams['MESS_FIELD_NAME_GUEST_PHONE'],
						'MESS_FIELD_NAME_CITY'         => $arParams['MESS_FIELD_NAME_CITY'],
						'MESS_FIELD_NAME_COMPANY'      => $arParams['~MESS_FIELD_NAME_COMPANY'],
						'MESS_FIELD_NAME_WEBSITE'      => $arParams['~MESS_FIELD_NAME_WEBSITE'],
						'MESS_FIELD_NAME_FILES'        => $arParams['~MESS_FIELD_NAME_FILES'],
						'MESS_FIELD_NAME_VIDEOS'       => $arParams['~MESS_FIELD_NAME_VIDEOS'],

						'THUMBNAIL_WIDTH'  => $arParams['~THUMBNAIL_WIDTH'],
						'THUMBNAIL_HEIGHT' => $arParams['~THUMBNAIL_HEIGHT'],

						'PAGER_THEME'                     => $arParams['~PAGER_THEME'],
						'DISPLAY_TOP_PAGER'               => $arParams['~DISPLAY_TOP_PAGER'],
						'DISPLAY_BOTTOM_PAGER'            => $arParams['~DISPLAY_BOTTOM_PAGER'],
						'PAGER_DESC_NUMBERING'            => $arParams['~PAGER_DESC_NUMBERING'],
						'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['~PAGER_DESC_NUMBERING_CACHE_TIME'],
						'PAGER_SHOW_ALL'                  => $arParams['~PAGER_SHOW_ALL'],
						'PAGER_SHOW_ALWAYS'               => $arParams['~PAGER_SHOW_ALWAYS'],
						'PAGER_TEMPLATE'                  => $arParams['~PAGER_TEMPLATE'],
						'PAGER_TITLE'                     => $arParams['~PAGER_TITLE'],

						'SET_STATUS_404' => $arParams['~SET_STATUS_404'],
						'SHOW_404'       => $arParams['~SHOW_404'],
						'FILE_404'       => $arParams['~FILE_404'],
						'MESSAGE_404'    => $arParams['~MESSAGE_404'],

						'COMPOSITE_FRAME_MODE' => $arParams['~COMPOSITE_FRAME_MODE'],
						'COMPOSITE_FRAME_TYPE' => $arParams['~COMPOSITE_FRAME_TYPE'],

						//'USE_LIST'    => $arParams['~USE_LIST'],
						'DETAIL_HASH'          => $arParams['~DETAIL_HASH'],
						'SEF_MODE'             => $arParams['~SEF_MODE'],
						'SEF_FOLDER'           => $arParams['~SEF_FOLDER'],
						'DETAIL_URL'           => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['detail'],
						'LIST_URL'             => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['list'],
						'USER_URL'             => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['user'],
				 ),
				 $component
			); ?>
		</div>
		<?
		$dynamicArea->finishDynamicArea();
		?>
	</div>
<?
ob_start();
?>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$.fn.apiReviews();
	});
</script>
<?
$html = ob_get_contents();
ob_end_clean();

Asset::getInstance()->addString($html, true, AssetLocation::AFTER_JS);
?>