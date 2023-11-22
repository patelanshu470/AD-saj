@extends('backend.admin.admin_master')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <style>
        .error {
            color: red;
        }

             /*img preview */

             body {
            background: whitesmoke;
            font-family: "Open Sans", sans-serif;
        }

        .container {
            max-width: 960px;
            margin: 30px auto;
            padding: 20px;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            margin: 20px 0 20px;
        }

        h1 small {
            display: block;
            font-size: 15px;
            padding-top: 8px;
            color: gray;
        }

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input+label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #ffffff;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input+label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input+label:after {
            content: "\f040";
            font-family: "FontAwesome";
            color: #757575;
            position: absolute;
            top: 5px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }


        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border: 6px solid #f8f8f8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload .avatar-preview>div {
            width: 100%;
            height: 100%;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            object-fit: cover;
            aspect-ratio: 1;
        }

        /* end  */
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- filters... --}}
                <div class="card-box mb-30">
                    <div class="card-body">
                        <form action="{{ route('subcategory') }}" method="GET">
                            <div class="row mb-2">
                                <div class="col-3 ml-3">
                                    @if ( request('name'))
                                        <input type="text" placeholder="Name" name="name" value="{{ request('name') }}" class="form-control">
                                    @else
                                        <input type="text" placeholder="Name" name="name" class="form-control">
                                    @endif
                                </div>
                                <div class="col-3">
                                    <select name="category" id="" class="form-control">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach ($product_category as $productCategory)
                                            <option value="{{ $productCategory->id }}" @if(request()->get('category')== $productCategory->id) selected="selected" @endif>{{ $productCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select name="status" id="" class="form-control">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="1" @if(request()->get('status')=='1') selected="selected" @endif>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <input type="submit" class="btn btn-primary" value="Search">
                                </div>
                                <div class="col-1">
                                    <input onclick="location.href='{{route('subcategory')}}'" type="button" class="btn btn-secondary" value="Reset">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="row">
                        <div class="col-6">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Sub-Category</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pd-20">
                                <div style=" float: right;">
                                    <input class="btn btn-primary" type="button" data-toggle="modal"
                                        data-target="#category_add" style=" float:right;" value="+Add">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                    <tr>
                                        <td class="table-plus d-flex" style="align-items-center">
                                            <img src="{{ asset('public/images/subcategory/thumbnail/' . $datas->thumbnail) }}"
                                                alt="" style="width: 120px">
                                            <span class="p-2" style="align-self: center;">{{ $datas->name }}</span>
                                        </td>
                                        <td class="table-plus">
                                            {{ $datas->category->name }}
                                        </td>
                                        <td>

                                            <input type="checkbox" class="switch-btn checkbox status-checkbox"
                                                id="{{ $datas->id }}" {{ $datas->status == 1 ? 'checked' : '' }}
                                                data-size="small" data-color="#0099ff"
                                                data-product-id="{{ $datas->id }}">
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" data-target="#category_edit{{ $datas->id }}"
                                                        data-toggle="modal"><i class="dw dw-edit2"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item"
                                                        onclick="deleteRecord({{ $datas->id }})"><i
                                                            class="dw dw-delete-3"></i>
                                                        Delete</a>
                                                    <a href="{{ route('subcategory.delete', $datas->id) }}"
                                                        id="del{{ $datas->id }}" style="display: none"><i
                                                            class="far fa-trash-alt text-danger"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- add model --}}
    <div class="modal fade bs-example-modal-lg" id="category_add" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <form action="{{ route('subcategory.store') }}" method="post" id="cat_add_modal" enctype="multipart/form-data">
            @csrf

            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Add Sub-Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-body">

                        <div class="col ">
                            <div class="form-group">
                                <label><strong>Thumbnail</strong></label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg"
                                            name="thumbnail" />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview"
                                            style="background-image:url('{{ asset('public/no_img_back.jpg') }}');">
                                        </div>
                                    </div>
                                    <span class="error mt-3"></span>
                                </div>

                            </div>
                        </div>


                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" placeholder="Name" id="name">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input class="form-control" readonly type="text" name="slug" placeholder="Slug name"
                                id="slug">
                        </div>
                        {{-- original  --}}
                        <div class="form-group">
                            <label>Category</label>
                            <select class="selectpicker form-control" name="category_id" data-style="btn-outline-primary"
                                data-size="5">
                                @foreach ($product_category as $product_categories)
                                    <option value="{{ $product_categories->id }}">{{ $product_categories->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Single Select</label>
                            <select class="selectpicker form-control" name="status" data-style="btn-outline-primary"
                                data-size="5">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="real_btn" hidden class="btn btn-success"></button>
                        <button type="button" id="dublicate_submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- edit model  --}}
    @foreach ($data as $datas)
        <div class="modal fade bs-example-modal-lg" id="category_edit{{ $datas->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <form action="{{ route('subcategory.update', $datas->id) }}" method="post"
                id="cat_edit_form{{ $datas->id }}" enctype="multipart/form-data">
                @csrf

                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Update Sub-Category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">


                            <div class="form-group">
                                <label><strong>Thumbnail</strong></label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload_edit{{ $datas->id }}"
                                            accept=".png, .jpg, .jpeg" name="thumbnail" />
                                        <label for="imageUpload_edit{{ $datas->id }}"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview_edit{{ $datas->id }}"
                                            style="background-image:url('{{ asset('public/images/subcategory/thumbnail/' . $datas->thumbnail) }}');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $datas->name }}"
                                    placeholder="SubCategory name" onkeyup="createSlug({{ $datas->id }})"
                                    id="name{{ $datas->id }}">
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input class="form-control" value="{{ $datas->slug }}" readonly type="text"
                                    name="slug" placeholder="Slug name" id="slug{{ $datas->id }}">
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select class="selectpicker form-control" name="category_id"
                                    data-style="btn-outline-primary" data-size="5">
                                    @foreach ($product_category as $product_categories)
                                        <option value="{{ $product_categories->id }}"
                                            {{ $product_categories->id == $datas->category_id ? 'selected' : '' }}>
                                            {{ $product_categories->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Single Select</label>
                                <select class="selectpicker form-control" name="status" data-style="btn-outline-primary"
                                    data-size="5">
                                    <option {{ $datas->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $datas->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach


    {{-- edit form validation  --}}
    @foreach ($data as $datas)
        <script  async>
            $("#cat_edit_form{{ $datas->id }}").validate({
                rules: {
                    name: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "This name field is required",
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        </script>

        {{-- edit image validation... --}}
        <script  async>
            $(document).ready(function() {
                var expectedWidth = 1920;
                var expectedHeight = 572;
                var fileInput = $('#background_image_edit{{ $datas->id }}');

                fileInput.change(function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function() {
                        var image = new Image();
                        image.onload = function() {
                            var actualWidth = this.width;
                            var actualHeight = this.height;
                            if (actualWidth === expectedWidth && actualHeight === expectedHeight) {
                                // image size is valid
                                console.log('Image size is valid');
                            } else {
                                // image size is not valid
                                alert('Error: Invalid image size. Expected ' + expectedWidth + 'x' +
                                    expectedHeight + ' pixels.');
                                fileInput.val(''); // clear the file input
                            }
                        };
                        image.src = reader.result;
                    };
                    reader.readAsDataURL(file);
                });
            });
        </script>
    @endforeach
    {{-- valid end  --}}

    <script  async>
        $(document).ready(function() {
            $('.status-checkbox').change(function() {
                var catId = $(this).data('product-id');
                var status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('subcategory.status.change') }}",
                    method: "POST",
                    data: {
                        cat_id: catId,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        }
                    },
                });
            });
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
        $(document).ready(function() {
            var expectedWidth = 1920;
            var expectedHeight = 572;
            var fileInput = $('#background_image');

            fileInput.change(function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function() {
                    var image = new Image();
                    image.onload = function() {
                        var actualWidth = this.width;
                        var actualHeight = this.height;
                        if (actualWidth === expectedWidth && actualHeight === expectedHeight) {
                            // image size is valid
                            console.log('Image size is valid');
                        } else {
                            // image size is not valid
                            alert('Error: Invalid image size. Expected ' + expectedWidth + 'x' +
                                expectedHeight + ' pixels.');
                            fileInput.val(''); // clear the file input
                        }
                    };
                    image.src = reader.result;
                };
                reader.readAsDataURL(file);
            });
        });
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

    <script  async>
        function createSlug(id) {
            var name = $('#name' + id).val(); // assuming the input has an ID of 'input{id}'
            var final_name = name.toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
            $('#slug' + id).val(final_name);
        }
    </script>

    {{-- preview image in add form --}}
    <script  async>
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
        $("#imageUpload").change(function() {
            readURL(this, 'imagePreview');
        });
        $("#imageUpload_bg").change(function() {
            readURL(this, 'imagePreview_bg');
        });
    </script>

    {{-- preview image in edit form --}}
    <script  async>
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
    </script>
    @foreach ($data as $datas)
        <script  async>
            $("#imageUpload_edit{{ $datas->id }}").change(function() {
                // alert("safd");
                readURL(this, 'imagePreview_edit{{ $datas->id }}');
            });
        </script>
    @endforeach

    {{-- background image validation --}}
    <script  async>
        $(document).ready(function() {
            // Click real submit button on duplicate submit button click
            $('#dublicate_submit').on('click', function() {

                var fileInput_thumbnail = $('#imageUpload');
                var realSubmitBtn = $('#real_submit_btn');

                if (!fileInput_thumbnail.val()) {

                    $('.error').text("This field is required");
                    e.preventDefault(); // Stop form submission
                } else {
                    $('.error').text(" ");
                    $('#real_btn').click();
                }

            });
        });
    </script>



    {{-- validation  --}}
    <script src="{{ asset('public/validation/category/category.js') }}"></script>
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
                // $('.js--image-preview.js--no-default').removeAttr('style');
            } else if (file.size > maxSize) {
                alert('Please select an image file smaller than 10MB.');
                $(this).val('');
                $('#imagePreview').css('background-image',
                                'url({{ asset('public/no_img_back.jpg') }})');
                // $('#imagePreview').removeAttr('style');
            }
        });
    });
    </script>
@endsection
