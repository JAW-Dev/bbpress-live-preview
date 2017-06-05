(function($) {
	$('.bbplp-color-picker').wpColorPicker();
})(jQuery);
(function() {
	var bbplpAddClass = (function($) {
		var bbplpFormTable        = $('form .form-table'),
				bbplpFormHeading      = $('form h2');

		function init() {
			_addClass();
		}

		function _addClass() {
			bbplpFormTable.eq(1).addClass('bbplp-field-toggle bbplp-hide');
			bbplpFormHeading.eq(1).addClass('bbplp-field-toggle bbplp-hide');
		}

		return {
			init: init
		};

	})(jQuery);

	bbplpAddClass.init();

	var bbplpEnableToggle = (function($) {

		var bbplpCSSCheckbox      = $('#bbplp_settings-use_default'),
				bbplpToggleFieldClass = $('.bbplp-field-toggle'),
				bbplpCheckboxLable    = $('.bbplp-checkbox-label');

		function init() {
			_toggle();
		}

		function _toggle() {
			_showHide();
			bbplpCSSCheckbox.on('change', function() {
				_showHide();
			});
		}

		function _showHide() {
			if(bbplpCSSCheckbox.is(':checked')){
				bbplpToggleFieldClass.removeClass('bbplp-hide');
				bbplpToggleFieldClass.addClass('bbplp-show');
				bbplpCheckboxLable.text('Enabled');
			} else {
				bbplpToggleFieldClass.addClass('bbplp-hide');
				bbplpToggleFieldClass.removeClass('bbplp-show');
				bbplpCheckboxLable.text('Disabled');
			}
		}

		return {
			init: init
		};

	})(jQuery);

	bbplpEnableToggle.init();

})();
(function() {

	var bbplpSizeToggle = (function($) {

		var bbplpSizeType   = $('.bbplp-preview-type input'),
				bbplpSizeMatch  = $('#bbplp-settings-preview-match-1'),
				bbplpSizeCustom = $('#bbplp-settings-preview-match-2'),
				bbplpSizeHeight = $('#bbplp_settings-preview_height'),
				bbplpSizeWidth  = $('#bbplp_settings-preview_width');

		function init() {
			_toggle();
		}

		function _toggle() {
			_showHide();
			bbplpSizeType.on('change', function() {
				_showHide();
			});

		}

		function _showHide() {
			if(bbplpSizeMatch.is(':checked')){
				bbplpSizeHeight.prop('disabled', true);
				bbplpSizeWidth.prop('disabled', true);
			} else {
				bbplpSizeHeight.prop('disabled', false);
				bbplpSizeWidth.prop('disabled', false);
			}
		}

		return {
			init: init
		};

	})(jQuery);

	bbplpSizeToggle.init();

})();