$('#order-form').validate({
    rules: {
        billing_contact_name: {
            required: true,
        },
        first_name: {
            required: true,
        },
        last_name: {
            required: true,
        },
        shipping_contact_name: {
            required: true,
        },
        billing_contact_number: {
            required: true,
        },
        shipping_contact_number: {
            required: true,
        },
        billing_contact_email: {
            required: true,
            email: true
        },
        shipping_contact_email: {
            required: true,
            email: true
        },
        billing_street_address: {
            required: true,
        },
        shipping_street: {
            required: true,
        },
        billing_landmark: {
            required: true,
        },
        shipping_landmark: {
            required: true,
        },
        billing_country: {
            required: true,
        },
        shipping_country: {
            required: true,
        },
        billing_state: {
            required: true,
        },
        shipping_state: {
            required: true,
        },
        billing_city: {
            required: true,
        },
        shipping_city: {
            required: true,
        },
        billing_pincode: {
            required: true,
        },
        shipping_pincode: {
            required: true,
        },
        payment_method: {
            required: true,
        }
    },
    messages: {
        billing_contact_name: {
            required: "This Name field is required",
        },
        shipping_name: {
            required: "This Name field is required",
        },
        billing_contact_number: {
            required: "This mobile number field is required",
        },
        shipping_contact_number: {
            required: "This mobile number field is required",
        },
        billing_contact_email: {
            required: "This email field is required",
        },
        shipping_contact_email: {
            required: "This email field is required",
        },
        billing_street_address: {
            required: "This street field is required",
        },
        shipping_street: {
            required: "This street field is required",
        },
        billing_landmark: {
            required: "This landmark field is required",
        },
        shipping_landmark: {
            required: "This landmark field is required",
        },
        billing_pincode: {
            required: "This pincode field is required",
        },
        shipping_pincode: {
            required: "This pincode field is required",
        },
        billing_country: {
            required: "This country field is required",
        },
        shipping_country: {
            required: "This country field is required",
        },
        billing_state: {
            required: "This state field is required",
        },
        shipping_state: {
            required: "This state field is required",
        },
        billing_city: {
            required: "This city field is required",
        },
        shipping_city: {
            required: "This city field is required",
        },
        payment_method: {
            required: "The payment method field is required",
        },
    },
})



$(document).ready(function () {
    console.log("Navigation type:", window.performance.navigation.type);

    // Reload the page if it was accessed via the back button
    if (window.performance.navigation.type === 2) {
        location.reload(true);
    }

});


$(document).ready(function () {
    //to disable the entire page
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
});


document.addEventListener('contextmenu', (e) => e.preventDefault());
function ctrlShiftKey(e, keyCode) {
    return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
}
document.onkeydown = (e) => {
    if (
        event.keyCode === 123 ||
        ctrlShiftKey(e, 'I') ||
        ctrlShiftKey(e, 'J') ||
        ctrlShiftKey(e, 'C') ||
        (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
    )
        return false;
};
