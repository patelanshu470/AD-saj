@extends('backend.admin.admin_master')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <style>
        @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
        @import url("https://fonts.googleapis.com/css?family=Raleway");
        .error {
            color: red;
        }
        .wrapper {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        .box {
            display: block;
            min-width: 300px;
            height: 300px;
            /* margin: 10px; */
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            overflow: hidden;
        }
        .upload-options {
            position: relative;
            height: 75px;
            background-color: rgb(18, 44, 242);
            cursor: pointer;
            overflow: hidden;
            text-align: center;
            transition: background-color ease-in-out 150ms;
        }
        .upload-options:hover {
            background-color: #4557b0;
        }
        .upload-options input {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
        .upload-options label {
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
            font-weight: 400;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            overflow: hidden;
        }
        .upload-options label::after {
            content: "add";
            font-family: "Material Icons";
            position: absolute;
            font-size: 2.5rem;
            color: #e6e6e6;
            top: calc(50% - 2.5rem);
            left: calc(50% - 1.25rem);
            z-index: 0;
        }
        .upload-options label span {
            display: inline-block;
            width: 50%;
            height: 100%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            vertical-align: middle;
            text-align: center;
        }
        .upload-options label span:hover i.material-icons {
            color: lightgray;
        }
        .js--image-preview {
            height: 225px;
            width: 100%;
            position: relative;
            overflow: hidden;
            background-image: url("");
            background-color: white;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .js--no-default {
            background-size: contain;
        }
        .js--image-preview::after {
            content: "photo_size_select_actual";
            font-family: "Material Icons";
            position: relative;
            font-size: 4.5em;
            color: #e6e6e6;
            top: calc(50% - 3rem);
            left: calc(50% - 2.25rem);
            z-index: 0;
        }
        .js--image-preview.js--no-default::after {
            display: none;
        }
        /* multi img  */
        .img-div {
            position: relative;
            height: 200px;
            width: auto;
            float: left;
            margin-right: 5px;
            margin-left: 5px;
            margin-bottom: 10px;
            margin-top: 10px;
        }
        .image {
            opacity: 1;
            display: block;
            height: 200px;
            width: 240px;
            object-fit: contain;
            /* width: 100%; */
            /* max-width: auto; */
            transition: 0.5s ease;
            backface-visibility: hidden;
        }
        .middle {
            transition: 0.5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }
        .img-div:hover .image {
            opacity: 0.3;
        }
        .img-div:hover .middle {
            opacity: 1;
        }
        #add_new_option_button:hover {
            color: #e6e6e6;
        }
        #new_data_row input[type="text"]{
            text-transform: lowercase;
        }
        video {
        border: 1px solid gainsboro;
        display: block;
        height: 250px;
        }
        .upload-options1 {
            position: relative;
            height: 75px;
            background-color: rgb(18, 44, 242);
            cursor: pointer;
            overflow: hidden;
            text-align: center;
            transition: background-color ease-in-out 150ms;
        }
        .upload-options1:hover {
            background-color: #4557b0;
        }
        .upload-options1 input {
            /* width: 0.1px;
            height: 0.1px; */
            opacity: 0;
            overflow: hidden;
            position: absolute;
            /* z-index: -1; */
        }
        .upload-options1 label {
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
            font-weight: 400;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            overflow: hidden;
        }
        .upload-options1 label::after {
            content: "add";
            font-family: "Material Icons";
            position: absolute;
            font-size: 2.5rem;
            color: #e6e6e6;
            top: calc(50% - 2.5rem);
            left: calc(50% - 1.25rem);
            z-index: 0;
        }
        .upload-options1 label span {
            display: inline-block;
            width: 50%;
            height: 100%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            vertical-align: middle;
            text-align: center;
        }
        .upload-options1 label span:hover i.material-icons {
            color: lightgray;
        }
    </style>
    <div class="main-container">
        <form method="POST" action="{{ route('customerHighlights.store') }}" enctype="multipart/form-data"
                        id="customer_highlight_create">
                        @csrf
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Form start -->
                <div class="card-box mb-30">
                    <div class="row">
                        <div class="col-6">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Add Customer Highlights</h4>
                            </div>
                        </div>
                    </div>

                        <div class="pb-20">
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-4" style="align-content: center">
                                        <div class="form-group">
                                            <div class="wrapper " style="display:grid;">
                                                <label for="">Image</label>
                                                <div class="box">
                                                    <div class="js--image-preview" id="set_thumbnail"></div>

                                                    <div class="upload-options">
                                                        <label>
                                                            <input type="file" class="image-upload" name="image" id="image"
                                                                accept="image/png,image/jpeg"/>
                                                        </label>
                                                    </div>
                                                </div>
                                                <span class="error" id="thumbnail_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select name="category" id="category-dropdown" class="form-control" required>
                                                <option value="" selected disabled>Select Category</option>
                                                @foreach ($product_category as $product_categories)
                                                    <option value="{{ $product_categories->id }}">{{ $product_categories->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Sub-Category</label>
                                            <select name="subcategory" id="subcategory-dropdown" class="form-control" required>
                                                <option value="" selected disabled>Select Sub-Category</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4" style="align-content: center">
                                        <div class="form-group">
                                            <div class="wrapper " style="display:grid;">
                                                <label for="">Video</label>
                                                <video id="video" width="300" height="300" controls></video>
                                                <div class="upload-options1">
                                                    <label for="">
                                                        <input id="file-input" type="file" name="video" accept="video/*">
                                                    </label>
                                                </div>
                                                <span class="error" id="thumbnail_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12" style="align-content: center">
                                <div class="form-group">
                                    <div class="col-6" style="align-content:center">
                                    <button type="submit" class="btn btn-success" id="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </form>
    </div>
<script>
    document.getElementById('customer_highlight_create').addEventListener('submit', function(event) {
  var imageFile = document.getElementById('imageFile');
  var videoFile = document.getElementById('videoFile');
  var fileError = document.getElementById('fileError');

  if (!imageFile.value && !videoFile.value) {
    fileError.textContent = 'Please select an image or a video file.';
    event.preventDefault();
  } else {
    fileError.textContent = '';
  }
});
</script>
    <script>
        const input = document.getElementById('file-input');
        const video = document.getElementById('video');
        const videoSource = document.createElement('source');
        input.addEventListener('change', function() {
        const files = this.files || [];
        if (!files.length) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            videoSource.setAttribute('src', e.target.result);
            video.appendChild(videoSource);
            video.load();
            video.play();
        };
        reader.onprogress = function (e) {
            console.log('progress: ', Math.round((e.loaded * 100) / e.total));
        };
        reader.readAsDataURL(files[0]);
        });
    </script>
    {{-- validation link  --}}
    <script src="{{ asset('public/validation/product/product.js') }}"></script>
    <!-- js -->
    <script src="{{ asset('public/vendors/scripts/core.js') }}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{ asset('public/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('public/vendors/scripts/datatable-setting.js') }}"></script>
    <script>
        $(document).ready(function() {
          $("#customer_highlight_create").submit(function(event) {
            if ($("#image").val() == "" && $("#file-input").val() == "") {
              alert("Please select at least one image or video.");
              event.preventDefault();
            } else if ($("#requiredField").val() == "") {
              alert("Please fill in the required field.");
              event.preventDefault();
            }
          });
        });
        </script>
<script>
    //   Category Dropdown Change Event
    $('#category-dropdown').on('change', function() {
        var catId = this.value;
        $.ajax({
            url: "{{ route('fetchSubCat') }}",
            type: "GET",
            data: {
                catId: catId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                $('#subcategory-dropdown').html('<option value="" disabled selected>Select SubCategory</option>');
                $.each(result.subcat, function(key, value) {
                    $("#subcategory-dropdown").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
    $('#image').change(function(e) {
        var file = e.target.files[0];
        var fileName = file.name;
        var fileType = fileName.split('.').pop().toLowerCase();
        var allowedTypes = ['jpeg', 'jpg', 'png'];
        var maxSize = 10 * 1024 * 1024; // 10MB in bytes
        if ($.inArray(fileType, allowedTypes) === -1) {
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $(this).val('');
        } else if (file.size > maxSize) {
            alert('Please select an image file smaller than 10MB.');
            $(this).val('');
            setTimeout( function(){
                $('#set_thumbnail').removeClass('js--no-default');
                $('.js--image-preview').removeAttr('style');
            },2000);
        }
    });
});
</script>
@endsection
