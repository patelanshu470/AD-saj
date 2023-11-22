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

{/* // initialize box-scope */ }
var boxes = document.querySelectorAll('.box');

for (let i = 0; i < boxes.length; i++) {
    let box = boxes[i];
    initDropEffect(box);
    initImageUpload(box);
}
{/* /// drop-effect */ }
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



$(document).ready(function() {
    // Function to validate the form
    function validateForm() {
        var imageSelected = $('#special_offer1').val();
        var linkValue = $('#special_link1').val();

        if (imageSelected === '' && linkValue === '') {
            $('#special_link-1').text('Please select an image and enter a link.');
            return false;
        } else if (imageSelected === '') {
            $('#special_link-1').text('Please select an image.');
            return false;
        } else if (linkValue === '') {
            $('#special_link-1').text('Please enter a link.');
            return false;
        } else {
            $('#special_link-1').text('');
            return true;
        }
    }

    // Attach submit event to the form
    $('#specialOfferForm').submit(function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});

$(document).ready(function() {
    // Function to validate the form
    function validateForm() {
        var imageSelected = $('#special_offer2').val();
        var linkValue = $('#special_link2').val();

        if (imageSelected === '' && linkValue === '') {
            $('#special_link-2').text('Please select an image and enter a link.');
            return false;
        } else if (imageSelected === '') {
            $('#special_link-2').text('Please select an image.');
            return false;
        } else if (linkValue === '') {
            $('#special_link-2').text('Please enter a link.');
            return false;
        } else {
            $('#special_link-2').text('');
            return true;
        }
    }

    // Attach submit event to the form
    $('#specialOfferForm').submit(function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});

$(document).ready(function() {
    // Function to validate the form
    function validateForm() {
        var imageSelected = $('#special_offer3').val();
        var linkValue = $('#special_link3').val();

        if (imageSelected === '' && linkValue === '') {
            $('#special_link-3').text('Please select an image and enter a link.');
            return false;
        } else if (imageSelected === '') {
            $('#special_link-3').text('Please select an image.');
            return false;
        } else if (linkValue === '') {
            $('#special_link-3').text('Please enter a link.');
            return false;
        } else {
            $('#special_link-3').text('');
            return true;
        }
    }

    // Attach submit event to the form
    $('#specialOfferForm').submit(function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});