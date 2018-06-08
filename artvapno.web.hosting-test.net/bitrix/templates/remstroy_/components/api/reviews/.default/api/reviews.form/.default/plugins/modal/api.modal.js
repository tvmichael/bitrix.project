/**
 * $.fn.apiModal
 */
(function ($) {

	//console.log('$.fn.apiModal - /remstroy_/components/api/reviews/.default/api/reviews.form/.default/plugins/modal/api.modal.js');

	// настройки со значением по умолчанию
	var defaults = {
		id: ''
	};

	// публичные методы
	var methods = {

		// инициализация плагина
		init: function (params) {

			//console.log('$.fn.apiModal:init');
			//console.log(params);

			// актуальные настройки, будут индивидуальными при каждом запуске
			var options = $.extend({}, defaults, options, params);

			// инициализируем лишь единожды
			if (!this.data('apiModal')) {

				// закинем настройки в реестр data
				this.data('apiModal', options);

				// код плагина

				$(document).on('click', '.api_modal, .api_modal_close', function (e) {
					e.preventDefault();

					$('.api_modal .api_modal_dialog').css({
						'transform': 'translateY(-200px)',
						'-webkit-transform': 'translateY(-200px)'
					});
					$('.api_modal').animate({opacity: 0}, 300, function () {
						$(this).hide().removeClass('api_modal_open');
						$('html').removeClass('api_modal_active');
					});
				});


				$(document).on('click', '.api_modal .api_modal_dialog', function (e) {
					//e.preventDefault();
					e.stopPropagation();
				});
			}

			return this;
		},
		show: function (options) {

			//console.log('$.fn.apiModal:show');
			//console.log(options);

			$('html').addClass('api_modal_active');

			var modal =  $(options.id);
			var dialog =  $(options.id + ' .api_modal_dialog');
			//var dialog =  $('.api_modal_dialog');

			//console.log(modal);
			//console.log(dialog);


			dialog.removeAttr('style');
			modal.show().animate({opacity: 1}, 1, function () {

				var dh  = dialog.outerHeight(),
				    pad = parseInt(dialog.css('margin_top'), 10) + parseInt(dialog.css('margin_bottom'), 10);

				if ((dh + pad) < window.innerHeight) {
					dialog.css({top: (window.innerHeight - (dh + pad)) / 2});
				} else {
					dialog.css({top: ''});
				}

				//dialog.css({opacity: 1});

				modal.addClass('api_modal_open');
			});
		},
		resize: function () {

			//console.log('$.fn.apiModal: resize');

			var dialog = $('.api_modal .api_modal_dialog');

			//console.log(dialog);

			$('.api_modal.api_modal_open').each(function () {
				var dh  = dialog.outerHeight(),
				    pad = parseInt(dialog.css('margin_top'), 10) + parseInt(dialog.css('margin_bottom'), 10);

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
			var dialogStyle = $(options.modalId + ' .api_modal_dialog').attr('style');

			var content = '' +
				 '<div class="api_modal_dialog api_alert" style="'+dialogStyle+'">' +
					 '<div class="api_modal_close"></div>' +
					 '<div class="api_alert_'+options.type+'">' +
						 '<span></span>' +
						 '<div class="api_alert_title">'+options.message+'</div>' +
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
			$(options.modalId).hide().removeClass('api_modal_open');
			$('html').removeClass('api_modal_active');
		}
	};

	$.fn.apiModal = function (method) {

		//console.log('$.fn.apiModal:function');
		//console.log(method);

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