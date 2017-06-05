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