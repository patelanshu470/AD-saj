jQuery(document).ready(function() {
    var base_url = config.data.base_url;
jQuery(document).on('click', '.add-to-wishlist', function() {
    var product_id = jQuery(this).data('product_id');
    var click = jQuery(this);
    // alert(product_id);
    // if (product_id != '' && product_id != null && product_id != undefined) {
        jQuery.ajax({
            url: add_wishlist_url,
            method: 'GET',
            data: {
                product_id: product_id,
                _token: '{{csrf_token()}}'
            },

            dataType: 'json',
            // cache: false,
            beforeSend: function(data) {
                jQuery(document).find('#preloader-active').show();
            },
            success: function(data) {
                if (data.result == 'success') {
                    click.attr('data-wishlist_item_id', data.wishlist_item_id);
                    click.attr('aria-label', 'Removed To Wishlist');
                    click.addClass('active-wishlist');
                    click.addClass('remove-to-wishlist').removeClass('add-to-wishlist');
                    $('#wishlist_total').text(data.wishlist_total);
                    toastr.success(data.message);
                    jQuery(document).find('#preloader-active').hide();
                } else {
                    toastr.error(data.message);
                }
                jQuery(document).find('#preloader-active').hide();

            },
            complete: function(data) {
                click.trigger('change');
                jQuery(document).find('#preloader-active').hide();
            },
            error: function(data, textStatus, xhr) {
                if (textStatus == 'parsererror') {
                    jQuery(document).find('#preloader-active').removeClass('loader-ajax').hide();
                    toastr.error('Login To Your Account');
                    window.location.href = base_url +  '/auth';
                    if (data.responseJSON.message == 'Unauthenticated.') {
                        window.location.href = config.data.base_url + '/login?wishlist=false';
                    } else {
                        toastr.error(data.responseJSON.message);
                    }
                }
                jQuery(document).find('.loader').removeClass('loader-ajax').hide();
            },
        });
    // }
});

jQuery(document).on('click', 'a.remove-to-wishlist', function() {
    // var add_type = jQuery(this).data('add_type');
    var click = jQuery(this);
    var product_id = jQuery(this).data('product_id');
    var wishlist_item_id = jQuery(this).attr('data-wishlist_item_id');
    // if (wishlist_item_id != '' && wishlist_item_id != null && wishlist_item_id != undefined) {
        jQuery.ajax({
            url: base_url + '/wishlists/' + wishlist_item_id,
            method: 'GET',
            data: ({ wishlist_item_id: wishlist_item_id, product_id: product_id }),
            dataType: 'json',
            // cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            beforeSend: function(data) {
                jQuery(document).find('#preloader-active').show();
            },
            success: function(data) {
                if (data.result == 'success') {
                    click.removeAttr('data-wishlist_item_id');
                    click.attr('aria-label', 'Add To Wishlist');
                    click.removeClass('active-wishlist');
                    click.removeClass('remove-to-wishlist').addClass('add-to-wishlist');
                    $('#wishlist_total').text(data.wishlist_total);
                    toastr.error(data.message);
                    // if (add_type == 'detail') {
                    //     click.text('Add To Wishlist')
                    // }
                jQuery(document).find('#preloader-active').hide();

                } else {
                    toastr.error(data.message);
                }
                jQuery(document).find('#preloader-active').hide();
            },
            complete: function(data) {
                click.trigger('change');
                jQuery(document).find('#preloader-active').hide();
            },
            error: function(data, textStatus, xhr) {
                if (textStatus == 'error') {
                    if (data.responseJSON.message == 'Unauthenticated.') {
                        window.location.href = config.data.base_url + '/login';
                    } else {
                        toastr.error(data.message);
                    }
                }
                jQuery(document).find('#preloader-active').hide();
            },
        });
    // }
})

jQuery(document).on('click', '.button-add-to-cart', function() {

    var product_id = jQuery(this).data('product_id');
    // var color_id = jQuery(document).find('.active_select_image').data('color');
    var quantity = jQuery(document).find('.qty-val').text();
    // if ((color_id == '' || color_id == undefined || color_id == null) ) {
    //     error = 1;
    //     $('#color-error').show();
    // } else {
    //     error = 0;
    //     $('#color-error').hide();
    // }
    // if (error == 1) {
    //     return false;
    // } else {
        jQuery.ajax({
            url: base_url + '/add-cart',
            method: 'POST',
            data: ({ product_id: product_id, quantity: quantity}),
            dataType: 'json',
            cache: false,
            headers: {
                'X-CSRF-TOKEN': config.data.csrf
            },
            beforeSend: function(data) {
                jQuery(document).find('#preloader-active').addClass('loader-ajax').show();
            },
            success: function(data) {
                if (data.result == 'success') {
                    $('#cart_total').text(data.cart_total);
                    $("#cart-dropdown-model ul").html(data.item_html);
                    $("#shopping-cart-total").html(data.cart_product_total);
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            },
            complete: function(data) {
                jQuery(document).find('#preloader-active').removeClass('loader-ajax').hide();
            },
            error: function(data, textStatus, xhr) {
                if (textStatus == 'error') {
                    jQuery(document).find('#preloader-active').removeClass('loader-ajax').hide();
                    window.location.href = base_url +  '/auth';
                    toastr.error('Login To Your Account');
                    if (data.responseJSON.message == 'Unauthenticated.') {
                        window.location.href = config.data.base_url + '/auth?cart=false';
                    } else {
                        toastr.error(data.responseJSON.message);
                    }
                    jQuery(document).find('#preloader-active').removeClass('loader-ajax').hide();
                }
            },
        });
    // }

})
});
