@extends('backend.admin.admin_master')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <style>
        @import url(https://fonts.googleapis.com/icon?family=Material+Icons);
        @import url("https://fonts.googleapis.com/css?family=Raleway");
        .select2-selection {
            border-color: #ffffff !important;
        }

        .select2-container--below,
        .select2-container--default {
            border: 1px solid #e9ecef !important;
        }

        .select2-selection__choice__display {
            padding-left: 26px !important;
        }

        .select2-selection__choice__remove {
            margin-top: 0px !important;
            margin-left: 0px !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgba(18, 44, 242, 0.804) !important;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple{
            padding-bottom: 35px;
        }
        .select2-container {
            border-radius: 4px;
            padding-bottom: 5px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
            background-color: blue;
        }
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
    </style>
    <div class="main-container">
        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data"
                        id="product_add_form">
                        @csrf
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <!-- Form start -->
                <div class="card-box mb-30">
                    <div class="row">
                        <div class="col-6">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Add Product</h4>
                            </div>
                        </div>
                    </div>

                        <div class="pb-20">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="wrapper " style="display:grid;">
                                                <label>Thumbnail</label>
                                                <div class="box">
                                                    <div class="js--image-preview" id="set_thumbnail"></div>

                                                    <div class="upload-options">
                                                        <label>
                                                            <input type="file" class="image-upload" name="thumbnail"
                                                                accept="image/png,image/jpeg" />
                                                        </label>
                                                    </div>
                                                </div>
                                                <span class="error" id="thumbnail_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="wrapper " style="display:grid;">
                                                <label>Color Image</label>
                                                <div class="box">
                                                    <div class="js--image-preview" id="set_thumbnail"></div>

                                                    <div class="upload-options">
                                                        <label>
                                                            <input type="file" class="image-upload" name="color_image"
                                                                accept="image/png,image/jpeg" />
                                                        </label>
                                                    </div>
                                                </div>
                                                <label id="color_image-error" class="error" for="color_image"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" type="text" name="name"
                                                placeholder="Product name" id="name">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input class="form-control" type="text" name="slug" readonly
                                                placeholder="Product slug" id="slug">
                                            <p style="display: none;font-size: 14px;font-weight: 500"  class="error" id="email">This Slug Already Used</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Color</label>
                                            <input class="form-control" type="text" name="color" placeholder="Color Name" id="color">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="selectpicker form-control" name="category" id="category-dropdown"
                                                data-style="btn-outline-primary" data-size="5">
                                                @if (count($cat))
                                                    <option selected disabled>Select Category</option>
                                                    @foreach ($cat as $cats)
                                                        <option value="{{ $cats->id }}">{{ $cats->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option disabled>No Category available</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Sub-Category</label>
                                            <select class=" form-control" name="subcategory" id="subcategory-dropdown"
                                                data-style="btn-outline-primary" data-size="5" >
                                                <option selected disabled>Select SubCategory</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">HSN Code</label>
                                            <input type="text" class="form-control" name="hsn_code" id="hsn_code" required placeholder="Hsn Code">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">SKU</label>
                                            <input type="text" class="form-control" name="sku" id="sku" placeholder="Product SKU">
                                            <p style="display: none;font-size: 14px;font-weight: 500"  class="error" id="error_sku">This SKU Already Used</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Select Status</label>
                                            <select class="selectpicker form-control" name="status"
                                                data-style="btn-outline-primary" data-size="5">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label>Description</label>
                                        <textarea id="tiny" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="images">Images</label>
                                            <input type="file" name="gallary[]" id="images" multiple
                                                accept="image/png,image/jpeg" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <div id="image_preview" style="width:100%;">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Original Price ₹:</label>
                                            <input class="form-control" type="text" name="original_price"
                                                id="original_price" placeholder="Original Price">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Discount %:</label>
                                            <input id="demo_p" type="text" class="discount_p form-control" required
                                                name="discount">

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Sub Total ₹:</label>
                                            <input class="form-control selling_price" type="text" name="selling_price"
                                                id="selling_price" placeholder="Selling Price">
                                        </div>
                                        {{-- <input type="text" class="tax_rate">
                                        <input type="text" class="tax_amount">
                                        <input type="text" class="final_amount"> --}}
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Tax Rate %:</label>
                                            <input type="text" class="tax_rate form-control" name="tax_rate" readonly>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Tax Amount ₹:</label>
                                            <input type="text" class="tax_amount form-control" name="tax_amount" readonly>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Final Amount ₹:</label>
                                            <input type="text" class="final_amount form-control" name="final_amount" readonly>
                                        </div>
                                    </div>
                                    <input type="text" class="saved_amount" name="discount_price" hidden>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Original Price $:</label>
                                            <input class="form-control" type="text" name="original_price_dollar"
                                                id="original_price_dollar" placeholder="Original Price Dollar">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Discount %:</label>
                                            <input id="discount_dollar" type="text" required class="discount_d form-control"
                                                name="discount_dollar">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Selling Price $:</label>
                                            <input class="form-control selling_price_dollar" type="text" name="selling_price_dollar"
                                                id="selling_price_dollar" placeholder="Selling Price Dollar">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Tax Rate %:</label>
                                            <input type="text" class="tax_rate_dollar form-control" name="tax_rate_dollar" readonly>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Tax Amount $:</label>
                                            <input type="text" class="tax_amount_dollar form-control" name="tax_amount_dollar" readonly>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Final Amount $:</label>
                                            <input type="text" class="final_amount_dollar form-control" name="final_amount_dollar" readonly>
                                        </div>
                                    </div>
                                    <input type="text" class="saved_amount_dollar" name="discount_price_dollar" hidden>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <div class="col-lg-12 ">
            {{-- <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <span class="card-header-icon">
                            <i class="tio-canvas-text"></i>
                        </span>
                        <span>Product Colors</span>
                    </h5>
                </div>
                <div class="card-body pb-0">
                <div class="row g-2">
                    <div class="col-md-12">
                        <div id="add_new_option">
                            <div class="card view_new_option mb-2">
                                <div class="card-body " id="new_data_row">
                                    <div class="row g-2 mb-2">
                                        <div class="col-lg-3 col-md-6">
                                            <label for="">Color Name</label>
                                            <input required="" name="options[0][new_color_name]" class="form-control colorname" type="text">
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label for="">Image</label>
                                            <input required="" name="options[0][color_image]" class="form-control" type="file">
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label for="">URL</label>
                                            <input required="" name="options[0][color_producturl]" class="form-control" type="text">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="mt-2">
                            <a class="btn btn-outline-success" id="add_new_option_button">Add New Color</a>
                        </div> <br><br>
                    </div>
                </div>
                </div>
            </div> --}}
            <div class="card-box">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Product variations/Similar-Product</h5>
                    </div>
                    <div class="mb-4 row align-items-center">
                        <div class="col-md-9">
                            <div class="form-check user-checkbox ps-0">
                                <input class="checkbox_animated check-it" id="toggle-button"
                                    type="checkbox" autocomplete="off" value="1" name="is_varient"
                                    id="isVarient" id="flexCheckDefault">
                                <label class="form-label-title col-md-6 mb-0">Is this Product have
                                    Varient/Similar-Product?</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade " id="pills-home" role="tabpanel">
                                <div class="mb-4 row align-items-center">
                                    <div class="col-sm-6 ">
                                        <label class="form-label-title mb-0">Select-Product:</label>
                                        <select class="js-example-basic-multiple  product varient-id"
                                            name="varient_ids[]" multiple="multiple" style="width: 100%;" id="varientId">
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mt-4">
                                        <input class="checkbox_animated check-it" id="toggle-button"
                                            type="checkbox" autocomplete="off" value="1"
                                            name="set_to_all" id="flexCheckDefault">
                                        <label class="form-label-title col-md-6 mb-0">
                                            Set to all<span style="font-size: larger;"
                                                class="fa fa-question-circle ml-2" aria-hidden="true"
                                                data-toggle="tooltip"
                                                title=" By enabling this option, all the products you select will be added as variants or similar products to each and every product in the selection list. This association will create a connection between the chosen products, making them variants or suggesting them as similar options for users, thus enhancing the overall product selection experience"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button> --}}
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
    </form>
    </div>
    {{-- add column   attention:  --}}
    <script  async>
        // Add event listener for when color selection changes
        $('[name="color[]"]').on('change', function() {
            // Hide all quantity fields
            $('#quantity-fields input').hide();

            // Show quantity field for selected colors
            const selectedColors = $(this).val();
            selectedColors.forEach(color => {
                $(`[name="quantity[${color}]"]`).show();
            });
        });

    </script>

    {{-- end add column  --}}

    {{-- for selection jpeg,jpg,png only --}}
    <script  async>
        $(document).ready(function() {
            $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                var fileType = fileName.split('.').pop().toLowerCase();
                var allowedTypes = ['jpeg', 'jpg', 'png'];
                if ($.inArray(fileType, allowedTypes) === -1) {
                    alert('Please select a valid image file (JPEG/JPG/PNG).');
                    $(this).val('');
                    $('.js--image-preview.js--no-default').removeAttr('style');

                }
            });
        });
    </script>

<script  async>
    //   Category Dropdown Change Event
    $('#category-dropdown').on('change', function() {
        var catId = this.value;
        // $("#state-dropdown").html('');
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
            $('#subcategory-dropdown').on('change', function() {
                var subCatId = this.value;
                var catId = $('#category-dropdown').val();
                $.ajax({
                    url: "{{ route('product.varient') }}",
                    type: "GET",
                    data: {
                        catId: catId,
                        subCatId: subCatId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $.each(result.subcat, function(key, value) {
                            $(".varient-id").append('<option value="'+ value.id +'">' +'('+value.color+')'+' '+value.name +'</option>');
                        });
                    }
                });
            });
        });
</script>

    {{-- Html Editor  --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
    <script  async>
        $('textarea#tiny').tinymce({
            height: 300,
            Width: 300,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | removeformat | help'
        });
    </script>


    {{-- sweet alert  --}}
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script  async>
        function deleteRecord(id) {

            Swal.fire({
                title: 'Confirmation!',
                text: 'Are you sure you want to Delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: "No, cancel please!",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('del' + id).click();
                } else
                    return false;
            });
        }
    </script>

<script  async>
    $('#name').keyup(function() {
        var name = $(this).val();
        var final_name = name.toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
        $('#slug').val(final_name);
    });
</script>
<script>
    // tooltips
    $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        // end
        $(document).ready(function() {
            const toggleButton = $("#toggle-button");
            const generalTabContent = $("#pills-home");
            toggleButton.on("click", function() {
                generalTabContent.toggleClass("show active");
            });
        });
</script>
<script  async>
    $('#name,#slug').keyup(function () {
     var slug = $('#slug').val();
     $.ajax({
         url: "{{route('fetchProduct')}}",
         type: "get",
         data: {
             slug: slug,
             _token: '{{csrf_token()}}'
         },
         dataType: 'json',
         success: function (result) {
               if (result.name) {
                   $("#uname").val('');
                   $('#email').css('display', '');
                   $('button:submit').attr('disabled',true);
               } else {
                   $('#email').css('display', 'none');
                   $('button:submit').attr('disabled',false);
               }
               if (slug == '') {
                   $('#email').css('display', 'none');
                   $('button:submit').attr('disabled',false);
               }
         }
     });
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
    <script  async>
        $('#original_price').on('input', function (event) {
            this.value = this.value.replace(/[^0-9,+]/g, '');
        });
        $('#demo_p').on('input', function (event) {
            this.value = this.value.replace(/[^0-9,+]/g, '');
        });
        $('#selling_price').on('input', function (event) {
            this.value = this.value.replace(/[^0-9,+]/g, '');
        });
        $('.quantity').on('input', function (event) {
            this.value = this.value.replace(/[^0-9,+]/g, '');
        });
        $('.quantity1').on('input', function (event) {
            this.value = this.value.replace(/[^0-9,+]/g, '');
        });
    </script>
        <script  async>
            $(document).ready(function() {
            $('input[type="file"]').change(function(e) {
                var file = e.target.files[0];
                var fileName = file.name;
                var fileType = fileName.split('.').pop().toLowerCase();
                var allowedTypes = ['jpeg', 'jpg', 'png'];
                var maxSize = 10 * 1024 * 1024; // 10MB in bytes
                if ($.inArray(fileType, allowedTypes) === -1) {
                    alert('Please select a valid image file (JPEG/JPG/PNG).');
                    $(this).val('');
                     $('.js--image-preview').css('background-image',
                                'url({{ asset('public/no_img_back.jpg') }})');
                    // $('.js--image-preview.js--no-default').removeClass('style');
                    // $('.js--image-preview').removeClass('.js--no-default');

                } else if (file.size > maxSize) {
                    alert('Please select an image file smaller than 10MB.');
                    $(this).val('');
                    setTimeout( function(){
                        // $('.js--image-preview').css('background-image',
                        //             'url({{ asset('public/no_img_back.jpg') }})');
                        $('#set_thumbnail').removeClass('js--no-default');
                        $('.js--image-preview').removeAttr('style');
                    },2000);
                    // $('.js--image-preview').removeClass('.js--no-default');

                }
            });
        });
        </script>

<script  async>
    var uploadImg = document.getElementById('images');
    //uploadImg.files: FileList
    uploadImg.onchange = function(e) {
        for (var i = 0; i < uploadImg.files.length; i++) {
            var f = uploadImg.files[i];
            var ext = f.name.match(/\.(.+)$/)[1];
            var maxSize = 10 * 1024 * 1024; // 10MB in bytes
            if (f.size > maxSize) {
                alert('Please select an image file smaller than 10MB.');
                this.value='';
                $('#image_preview .img-div').remove();
            }
            // else {
            //     switch(ext) {
            //         case 'jpg':
            //         case 'jpeg':
            //         case 'png':
            //             break;
            //         default:
            //             this.value='';
            //     }
            // }
        }
    };
</script>

<script  async>
$('#sku').keyup(function () {
    var sku = $('#sku').val();
     $.ajax({
         url: "{{route('productSku')}}",
         type: "get",
         data: {
             sku: sku,
             _token: '{{csrf_token()}}'
         },
         dataType: 'json',
         success: function (result) {
               if (result.name) {
                   $('#error_sku').css('display', '');
                   $('button:submit').attr('disabled',true);
               } else {
                   $('#error_sku').css('display', 'none');
                   $('button:submit').attr('disabled',false);
               }
               if (sku == '') {
                   $('#error_sku').css('display', 'none');
                   $('button:submit').attr('disabled',false);
               }
         }
     });
});
</script>
<script  async>
    $("button[type='submit']").mouseover(function(){
        var sku = $("#error_sku").css("display");
          if(sku == 'block')
          {
            $('button:submit').attr('disabled',true);
          }
    });
</script>
<script  async>
    $("button[type='submit']").mouseover(function(){
        var slug = $("#email").css("display");
          if(slug == 'block')
          {
            $('button:submit').attr('disabled',true);
          }
    });
</script>
<!-- Discount in Dollar -->
<script>
    $('#discount_dollar,#original_price_dollar').on('keyup', function (e) {
    var original_p = parseFloat($('#original_price_dollar').val());
    var discount_price = parseFloat($('#discount_dollar').val());
    var deduce_amount = original_p * discount_price / 100;
    var final = original_p - deduce_amount;
    $('.selling_price_dollar').val(final.toFixed(2));
    var saved_amount = original_p - final;
    $('.saved_amount_dollar').val(saved_amount);
    // Calculate and display tax rate and tax amount
    var selling_price = parseFloat($('.selling_price_dollar').val());
    var tax_rate = selling_price > 1000 ? 12 : 5; // If selling_price is greater than 1000, tax rate is 12%, otherwise 5%
    $('.tax_rate_dollar').val(tax_rate + '%');
    var tax_amount = selling_price * (tax_rate / 100);
    $('.tax_amount_dollar').val(tax_amount.toFixed(2));
    // Calculate and display the sum of selling_price and tax_amount
    var final_amount = selling_price + tax_amount;
    $('.final_amount_dollar').val(final_amount.toFixed(2));
});

$('#selling_price_dollar').on('keyup', function (e) {
    var original_p = parseFloat($('#original_price_dollar').val());
    var selling_price = parseFloat($('#selling_price_dollar').val());
    var discount = (selling_price / original_p) * 100;
    $('#discount_dollar').val((100 - discount).toFixed(2));
    var saved_amount = original_p - selling_price;
    $('.saved_amount_dollar').val(saved_amount);
    // Calculate and display tax rate and tax amount
    var tax_rate = selling_price > 1000 ? 12 : 5; // If selling_price is greater than 1000, tax rate is 12%, otherwise 5%
    $('.tax_rate_dollar').val(tax_rate + '%');
    var tax_amount = selling_price * (tax_rate / 100);
    $('.tax_amount_dollar').val(tax_amount.toFixed(2));
    // Calculate and display the sum of selling_price and tax_amount
    var final_amount = selling_price + tax_amount;
    $('.final_amount_dollar').val(final_amount.toFixed(2));
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Initialize Select2 asynchronously -->
<script>
    jQuery(document).ready(function() {
        jQuery.getScript('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js')
        .done(function(script, textStatus) {
            jQuery('.js-example-basic-multiple').select2();
        })
        .fail(function(jqxhr, settings, exception) {
            console.error('Failed to load Select2:', exception);
        });
    });
</script>
@endsection
