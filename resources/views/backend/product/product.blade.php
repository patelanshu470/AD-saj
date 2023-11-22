@extends('backend.admin.admin_master')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="card-body">
                        <form action="{{ route('product') }}" method="GET">
                            <div class="row mb-2">
                                <div class="col-3 ml-3">
                                    @if ( request('product_id'))
                                    <input type="text" placeholder="ID" name="product_id" value="{{ request('product_id') }}" class="form-control">

                                    @else

                                    <input type="text" placeholder="ID" name="product_id" class="form-control">
                                    @endif
                                </div>
                                <div class="col-3">
                                    <select name="category" id="" class="form-control">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach ($category as $productCategory)
                                            <option value="{{ $productCategory->id }}" @if(request()->get('category')== $productCategory->id) selected="selected" @endif>{{ $productCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select name="status" id="" class="form-control">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="1" @if(request()->get('status')=='1') selected="selected" @endif>Active</option>
                                        <option value="0"  @if(request()->get('status')=='0') selected="selected" @endif>Inactive</option>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <input type="submit" class="btn btn-primary" value="Search">
                                </div>
                                <div class="col-1">
                                    <input onclick="location.href='{{route('product')}}'" type="button" class="btn btn-secondary" value="Reset">
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
                                <h4 class="text-blue h4">Product</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pd-20">
                                <div style=" float: right;">
                                    <a class="btn btn-primary" href="{{ route('product.add.form') }}">
                                        +Add</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Category</th>
                                    <th>Color</th>
                                    <th>Discount</th>
                                    <th>Selling Price</th>
                                    <th>Selling Price Dollar</th>
                                    <th>Status</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data) > 0)
                                    @foreach ($data as $datas)
                                        @php
                                            $find_color = App\Models\ProductColor::where('product_id',$datas->id)->get();
                                        @endphp
                                        <tr>
                                            <td class="table-plus">{{ $datas->unique_id }}</td>
                                            <td class="table-plus d-flex  align-items-center ">
                                                <img style="object-fit:contain;border-radius:5px;" src="{{ URL::asset('public/images/product/'.$datas->thumbnail)}}" alt="" width="60" height="52">
                                               <span class="p-2">{{ $datas->name }}</span>
                                            </td>
                                            <td class="table-plus">
                                                {{ $datas->sku }}
                                            </td>
                                            <td class="table-plus">{{ $datas->category->name }}</td>
                                            <td class="table-plus">
                                            @foreach ($find_color as $c_name)
                                                    {{ $c_name->color }},
                                            @endforeach
                                        </td>
                                            <td class="table-plus">{{ $datas->discount }}%</td>
                                            <td class="table-plus">₹{{ number_format($datas->selling_price, 2, '.', ',') }}</td>
                                            <td class="table-plus">${{ number_format($datas->selling_price_dollar, 2, '.', ',') }}</td>
                                            <td>

                                                    <input type="checkbox" class="switch-btn checkbox status-checkbox" id="{{ $datas->id }}"
                                                        {{ $datas->status == 1 ? 'checked' : '' }} data-size="small" data-color="#0099ff"
                                                        data-product-id="{{ $datas->id }}">
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                        href="#" role="button" data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        <a class="dropdown-item" href="{{route('product.edit',$datas->id)}}"><i class="dw dw-edit2"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item"
                                                            onclick="deleteRecord({{ $datas->id }})"><i
                                                                class="dw dw-delete-3"></i>
                                                            Delete</a>
                                                        <a href="{{ route('product.delete', $datas->id) }}"
                                                            id="del{{ $datas->id }}" style="display: none"><i
                                                                class="far fa-trash-alt text-danger"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script  async>
    $(document).ready(function() {
        $('.status-checkbox').change(function() {
            var productId = $(this).data('product-id');
            var status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('product.status.change') }}",
                method: "POST",
                data: {
                    product_id: productId,
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


    <script src="{{ asset('public/vendors/scripts/script.min.js') }}"></script>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
@endsection
