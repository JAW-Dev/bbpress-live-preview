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