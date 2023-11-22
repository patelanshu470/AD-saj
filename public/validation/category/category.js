$("#cat_add_modal").validate({
    rules: {
        name: {
            required: true,
        },
        thumbnail: {
            required: true,
        },
        background_image: {
            required: true,
        },
        status: {
            required: true,
            number: true,
        },

    },

    messages: {
        name: {
            required: "This name field is required",
        },
        thumbnail: {
            required: "This thumbnail field is required",
        },
        background_image: {
            required: "This background image field is required",
        },
        status: {
            required: "This status field is required",
        },

    },

    submitHandler: function (form) {
        form.submit();
    }
});
function readURL(input, previewId) {
    if (input.files && input.files[0]) {
        var maxSize = 10 * 1024 * 1024; // 10MB in bytes
        if (input.files[0].size <= maxSize) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#' + previewId).css('background-image', 'url(' + e.target.result + ')');
                $('#' + previewId).hide();
                $('#' + previewId).fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            // Display default image if selected image is too large
            $('#' + previewId).css('background-image', 'url({{ asset("no_img_back.jpg") }})');
            $('#' + previewId).hide();
            $('#' + previewId).fadeIn(650);
        }
    }
}
$("#imageUpload").change(function () {
    readURL(this, 'imagePreview');
});
$("#imageUpload_bg").change(function () {
    readURL(this, 'imagePreview_bg');
});
// </script>




// image required validation
$(document).ready(function() {
    // Click real submit button on duplicate submit button click
    $('#dublicate_submit').on('click', function() {

        var fileInput = $('#imageUpload_bg');
        var fileInput_thumbnail = $('#imageUpload');
        var realSubmitBtn = $('#real_submit_btn');

        if (!fileInput.val()) {
            $('.error').text("This field is required");
            e.preventDefault(); // Stop form submission
        } else if (!fileInput_thumbnail.val()) {
            $('.error_thumnail').text("This field is required");
            e.preventDefault(); // Stop form submission
        } else {
            $('.error').text("");

            // alert("submit");
            $('#real_btn').click();
        }

    });
});
