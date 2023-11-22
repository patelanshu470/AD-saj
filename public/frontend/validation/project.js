jQuery(document).on('click', '#apply_filter', function() {
    jQuery(document).find('form[name="product_form"]').submit();
    jQuery(document).find('#preloader-active.preloader').show();
});
