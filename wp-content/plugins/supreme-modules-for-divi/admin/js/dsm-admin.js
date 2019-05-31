(function($) {
    $(
        function() {
            $('select[name="dsm-header-footer-meta-box-options"]').change(function() {
            	if ($('select[name="dsm-header-footer-meta-box-options"]').val() == '404') {
            		$('.dsm-conditional-meta-box-options').css("display", "none");
            		$('.dsm-css-classes-meta-box-options').css("display", "none");
            	} else {
            		$('.dsm-conditional-meta-box-options').css("display", "block");
            		$('.dsm-css-classes-meta-box-options').css("display", "block");
            	}
                if ($('select[name="dsm-header-footer-meta-box-options"]').val() == 'top_header' || $('select[name="dsm-header-footer-meta-box-options"]').val() == '404') {
                    $('.dsm-remove-default-footer-meta-box-options').css("display", "none");
                } else {
                    $('.dsm-remove-default-footer-meta-box-options').css("display", "block");
                }
            });
        }
    )

}(jQuery));