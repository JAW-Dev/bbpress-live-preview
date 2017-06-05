var bbplp = (function($) {

  var bbpWrapper         = $('.bbp-the-content-wrapper'),
      bbpWrapperTextarea = $('.bbp-the-content-wrapper textarea'),
      wpEditorWrap       = $('.wp-editor-wrap'),
      el                 = $('#bbplp-preview-content'),
      elHeading          = $('#bbplp-heading'),
      elHidden           = $('#bbplp-preview-content:hidden'),
      toggleButtons      = $('#bbplp-preview-buttons'),
      writeButton        = $('#bbplp-button-write'),
      previewButton      = $('#bbplp-button-preview');

  function init() {
    _move();
    _styles();
    ajax();
    tinyMCEAjax();
   _toggle();
  }

  function _move() {
    elHeading.appendTo(bbpWrapper);
    el.appendTo(bbpWrapper);
  }

  function _styles() {
    if(bblpSettings.type === 'toggle' ) {
      _togleStyles();
    } else {
      _inlineStyles();
    }

  }

  function _inlineStyles() {
    toggleButtons.removeClass('bbplp-show');
    el.addClass('bbplp-type__inline');
    _autoSize();
  }

  function _togleStyles() {
    var bbpWrapperHeight;
    toggleButtons.addClass('bbplp-show');
    el.addClass('bbplp-type__toggle');
    bbpWrapper.css({
      'position': 'relative'
    });
    wpEditorWrap.css({
      'position': 'relative',
      'zIndex': 2
    });
    bbpWrapperTextarea.css({
      'position': 'relative',
      'zIndex': 2
    });
    _autoSize();
  }

  function _autoSize() {
    if(bblpSettings.size !== 'custom'){
      $(window).on('load', function() {
        bbpWrapperHeight = bbpWrapper.outerHeight();
        el.css({
          'height': bbpWrapperHeight
        });
      });
      $(window).on('resize', function() {
         bbpWrapperHeight = bbpWrapper.outerHeight();
         el.css({
          'height': bbpWrapperHeight
        });
      });
    }
  }

  function ajax() {
    bbpWrapperTextarea.bind( 'keyup.editor-focus input cut paste', function() {
      var content = $(this).val();
      _ajaxEvent(content);
    });
  }

  function tinyMCEAjax() {
    $('.quicktags-toolbar').on('click', '.ed_button', function(e) {
      setTimeout(function() {
        var content = bbpWrapperTextarea.val();
        _ajaxEvent(content);
      }, 10);
    });
  }

  function _ajaxEvent(content) {
    console.log(content);
    $.ajax({
      url: bblpSettings.ajaxurl,
      data: {
        action: 'preview_action',
        content: content
      },
      success: function(response) {
        el.html(response);
      },
      error: function(errorThrown) {
        el.html('Unable to render preview!');
      }
    });
  }

  function _toggle() {
    writeButton.on('click', function(e) {
      e.preventDefault();
      el.css({
        'position': 'absolute',
        'zIndex': 1
      });
      wpEditorWrap.css({
        'display': 'block'
      });
      bbpWrapperTextarea.css({
        'display': 'block'
      });
      if (!$(this).hasClass("active")) {
        $(this).addClass('active');
        previewButton.removeClass('active');
      }
    });
    previewButton.on('click', function(e) {
      e.preventDefault();
      el.css({
        'position': 'relative',
        'zIndex': 3
      });
      wpEditorWrap.css({
        'display': 'none'
      });
      bbpWrapperTextarea.css({
        'display': 'none'
      });
      if (!$(this).hasClass("active")) {
        $(this).addClass('active');
        writeButton.removeClass('active');
      }
    });
  }

  return {
    init: init,
    ajax: ajax
  };

})(jQuery);

bbplp.init();