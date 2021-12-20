jQuery(function() {

	// Admin options toggles
	jQuery('.r34nono-options-toggle').each(function() {
		var fn = jQuery(this).data('fn');
		if (jQuery('input[name="' + fn + '"][value="1"]').prop('checked')) {
			jQuery(this).show();
		}
		else {
			jQuery(this).hide();
		}
	});
	jQuery('form.r34nono-admin input[type=radio]').on('change', function() {
		var this_wrapper = jQuery(this).closest('tr');
		var this_options = this_wrapper.find('.r34nono-options-toggle');
		if (this_options.length > 0) {
			if (jQuery(this).val() == 1) {
				this_options.slideDown();
			}
			else {
				this_options.slideUp();
			}
		}
	});

});