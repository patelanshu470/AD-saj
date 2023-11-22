$.validator.addMethod("notEqual", function(value, element, param) {
    return this.optional(element) || value !== $(param).val();
  }, "Old password and new password must be different");

$('#change_password').validate({
    rules: {
    old_password: {
        required: true,
        required: true,
    },
    new_password: {
        required: true,
        required: true,
        minlength: 8,
        notEqual: "#old_password"
    },
    confirm_password: {
        required: true,
        minlength: 8,
        equalTo: "#new_password",
    },
},
messages: {
    old_password: {
        required: "This old Password field is required",
    },
    new_password: {
        required: "This new password field is required",
        minlength: "Enter at least 8 characters",
    },
    confirm_password: {
        required: "This confirm password field is required",
        minlength: "Enter at least 8 characters",
        equalTo: "The password and its confirm are not the same",
    },
},
});

jQuery.validator.addMethod("email", function(value, element) {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid Email.");
$('#edit_account').validate({
    rules: {
        first_name: {
        required: true,
      },
      last_name: {
        required: true,
      },
      email: {
        required: true,
        email : true
      },
      phone_number: {
        minlength: 10,
        required: true,

      }
},
messages: {
    first_name: {
        required: "This First Name field is required",
    },
    last_name: {
        required: "This Last Name field is required",
    },
    email: {
        required: "This Email field is required",
    },
},
});


$('#ProductReview').validate({
    rules: {
    star: {
        required: true,
        required: true,
    },
    description: {
        required: true,
        required: true,
    },
    attach: {
        required: true,
    }
},
messages: {
    star: {
        required: "This Star field is required",
    },
    description: {
        required: "This field is required",
    },
    attach: {
        required: "This field is required",
    }
},
});


jQuery(document).on('change', 'input[name="default_address_chk"]', function() {
    // alert('f');
    var status = $(this).prop('checked') == true ? 1 : 0;
    var address_id = $(this).data('id');
    // alert(user_id);
    toastr.options = {
      "closeButton": true,
      "newestOnTop": true,
      "positionClass": "toast-top-right"
    };

    $.ajax({
        type: "GET",
        dataType: "json",
        url: updatedefaultaddress,
        data: {'status': status, 'address_id': address_id},
        success: function(data){
            if (data.success) {
                toastr.success(data.success);
            }
            if (data.error) {
                toastr.error(data.error);
            }
        }
    });
});
