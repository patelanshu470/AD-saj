
// converion
$('#demo_p, #original_price').on('keyup', function (e) {
    var original_p = parseFloat($('#original_price').val());
    var discount_price = parseFloat($('#demo_p').val());
    var deduce_amount = original_p * discount_price / 100;
    var final = original_p - deduce_amount;
    $('.selling_price').val(final.toFixed(2));
    var saved_amount = original_p - final;
    $('.saved_amount').val(saved_amount);
    // Calculate and display tax rate and tax amount
    var selling_price = parseFloat($('.selling_price').val());
    var tax_rate = selling_price > 1000 ? 12 : 5; // If selling_price is greater than 1000, tax rate is 12%, otherwise 5%
    $('.tax_rate').val(tax_rate + '%');
    var tax_amount = selling_price * (tax_rate / 100);
    $('.tax_amount').val(tax_amount.toFixed(2));
    // Calculate and display the sum of selling_price and tax_amount
    var final_amount = selling_price + tax_amount;
    $('.final_amount').val(final_amount.toFixed(2));
});

$('#selling_price').on('keyup', function (e) {
    var original_p = parseFloat($('#original_price').val());
    var selling_price = parseFloat($('#selling_price').val());
    var discount = (selling_price / original_p) * 100;
    $('#demo_p').val((100 - discount).toFixed(2));
    var saved_amount = original_p - selling_price;
    $('.saved_amount').val(saved_amount);
    // Calculate and display tax rate and tax amount
    var tax_rate = selling_price > 1000 ? 12 : 5; // If selling_price is greater than 1000, tax rate is 12%, otherwise 5%
    $('.tax_rate').val(tax_rate + '%');
    var tax_amount = selling_price * (tax_rate / 100);
    $('.tax_amount').val(tax_amount.toFixed(2));
    // Calculate and display the sum of selling_price and tax_amount
    var final_amount = selling_price + tax_amount;
    $('.final_amount').val(final_amount.toFixed(2));
});
// conversion end
// {{-- multi img  --}}
$(document).ready(function () {
    var fileArr = [];
    $("#images").change(function () {
        // check if fileArr length is greater than 0
        if (fileArr.length > 0) fileArr = [];
        $("#image_preview").html("");
        var total_file = document.getElementById("images").files;
        if (!total_file.length) return;
        for (var i = 0; i < total_file.length; i++) {
            if (total_file[i].size > 10485760) {
                return false;
            } else {
                fileArr.push(total_file[i]);
                $("#image_preview").append(
                    "<div class='img-div' id='img-div" +
                    i +
                    "'><img src='" +
                    URL.createObjectURL(event.target.files[i]) +
                    "' class='img-responsive image img-thumbnail' title='" +
                    total_file[i].name +
                    "'><div class='middle'><button id='action-icon' value='img-div" +
                    i +
                    "' class='btn btn-danger' role='" +
                    total_file[i].name +
                    "'><i class='fa fa-trash'></i></button></div></div>"
                );
            }
        }
    });

    $("body").on("click", "#action-icon", function (evt) {
        var divName = this.value;
        var fileName = $(this).attr("role");
        $(`#${divName}`).remove();

        for (var i = 0; i < fileArr.length; i++) {
            if (fileArr[i].name === fileName) {
                fileArr.splice(i, 1);
            }
        }
        document.getElementById("images").files = FileListItem(fileArr);
        evt.preventDefault();
    });

    function FileListItem(file) {
        file = [].slice.call(Array.isArray(file) ? file : arguments);
        for (var c, b = (c = file.length), d = !0; b-- && d;)
            d = file[b] instanceof File;
        if (!d)
            throw new TypeError(
                "expected argument to FileList is File or array of File objects"
            );
        for (b = new ClipboardEvent("").clipboardData || new DataTransfer(); c--;)
            b.items.add(file[c]);
        return b.files;
    }
});
{/* // {{-- end new  --}} */ }

// {{-- thumbnail with preview   --}}
function initImageUpload(box) {
    let uploadField = box.querySelector('.image-upload');

    uploadField.addEventListener('change', getFile);

    function getFile(e) {
        let file = e.currentTarget.files[0];
        checkType(file);
    }

    function previewImage(file) {
        let thumb = box.querySelector('.js--image-preview'),
            reader = new FileReader();

        reader.onload = function () {
            thumb.style.backgroundImage = 'url(' + reader.result + ')';
        }
        reader.readAsDataURL(file);
        thumb.className += ' js--no-default';
    }

    function checkType(file) {
        // let imageType = /image.*/;
        let imageType = /^image\/(png|jpeg)$/;

        if (!file.type.match(imageType)) {
            throw 'Datei ist kein Bild';
        } else if (!file) {
            throw 'Kein Bild gewählt';
        } else {
            previewImage(file);
        }
    }

}

// initialize box-scope
var boxes = document.querySelectorAll('.box');

for (let i = 0; i < boxes.length; i++) {
    let box = boxes[i];
    initDropEffect(box);
    initImageUpload(box);
}
/// drop-effect
function initDropEffect(box) {
    let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;

    // get clickable area for drop effect
    area = box.querySelector('.js--image-preview');
    area.addEventListener('click', fireRipple);

    function fireRipple(e) {
        area = e.currentTarget
        // create drop
        if (!drop) {
            drop = document.createElement('span');
            drop.className = 'drop';
            this.appendChild(drop);
        }
        // reset animate class
        drop.className = 'drop';

        // calculate dimensions of area (longest side)
        areaWidth = getComputedStyle(this, null).getPropertyValue("width");
        areaHeight = getComputedStyle(this, null).getPropertyValue("height");
        maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

        // set drop dimensions to fill area
        drop.style.width = maxDistance + 'px';
        drop.style.height = maxDistance + 'px';

        // calculate dimensions of drop
        dropWidth = getComputedStyle(this, null).getPropertyValue("width");
        dropHeight = getComputedStyle(this, null).getPropertyValue("height");

        // calculate relative coordinates of click
        // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
        x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10) / 2);
        y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10) / 2) - 30;

        // position drop and animate
        drop.style.top = y + 'px';
        drop.style.left = x + 'px';
        drop.className += ' animate';
        e.stopPropagation();

    }
}

