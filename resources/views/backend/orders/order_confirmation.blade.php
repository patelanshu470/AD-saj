@extends('backend.admin.admin_master')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <style>
        #hexcolor,
        #colorpicker,
        #hexcolor_edit,
        #colorpicker_edit {
            display: block;
            width: 50%;
            float: left;
            height: 80px;
        }

        #view_color {
            display: block;
            width: 40px;
            float: left;
            height: 40px;
        }

        .error {
            color: red;
        }
    </style>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="row">
                        <div class="col-4">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Orders Confirmations</h4>
                            </div>
                        </div>
                        <div class="col-3">
                            <form action="{{ route('orderConfirmation') }}" name="priceChange">
                                <select name="price_type" id="price_type" class="form-control mt-15">
                                    <option value="" selected disabled>Select Price Type</option>
                                    <option value="INR" @if(request()->get('price_type')=='INR') selected="selected" @endif>INR</option>
                                    <option value="Dollar"  @if(request()->get('price_type')=='Dollar') selected="selected" @endif>Dollar</option>
                                </select>
                                <input type="submit" id="priceChangeSubmit" hidden>
                            </form>
                        </div>
                        <div class="col-2">
                            <div class="mt-15">
                                <div>
                                    <form action="{{ route('orderConfirmation') }}" method="GET">
                                        <button onclick="location.href='{{route('orderConfirmation')}}'" class="btn btn-secondary" type="button">Filters Reset</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order ID</th>
                                    <th>SKU</th>
                                    <th>Customer Information</th>
                                    <th>Total Amount</th>
                                    <th>Call Status</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $key => $orders)
                                    <tr>
                                        <td class="table-plus">{{ $key +1 }}</td>
                                        <td class="table-plus">
                                            <a href="{{ route('order_view',$orders->id) }}">
                                                <strong class="">#{{ $orders->unique_id }}</strong>
                                                <br>
                                                ({{ date('d-m-Y', strtotime($orders->created_at)) }})
                                            </a>
                                        </td>
                                        <td>
                                            @php
                                                $OrderProduct = App\Models\OrderProduct::with(['getproductsData' => function ($query) {
                                                    $query->withTrashed();
                                                }])->where('order_id', $orders->id)->orderBy('id', 'asc')->get();
                                                // dd($OrderProduct);
                                            @endphp
                                            @foreach ($OrderProduct as $OrderProducts)
                                                {{ $OrderProducts->getproductsData->sku }},
                                            @endforeach
                                        </td>
                                        <td>
                                            <a class="text-body text-capitalize" href="#">
                                                <div class="customer--name">
                                                {{ $orders->billing_contact_name }}
                                                </div>
                                                <span class="phone">
                                                +91{{ $orders->billing_contact_number }}
                                                </span>
                                                </a>
                                        </td>
                                        @if ($orders->country_type == "INR")
                                            <td>
                                                ₹{{ $orders->grand_total }}
                                            </td>
                                        @else
                                            <td>
                                                ${{ $orders->grand_total }}
                                            </td>
                                        @endif
                                        <td>
                                            <input type="checkbox" class="switch-btn checkbox status-checkbox"
                                            id="{{ $orders->id }}" {{ $orders->call_at == 1 ? 'checked' : '' }}
                                            data-size="small" data-color="#0099ff"
                                            data-order-id="{{ $orders->id }}">
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="{{ route('order_view',$orders->id) }}"><i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                                        View</a>
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
    <script>
        $(document).ready(function() {
            $('.status-checkbox').change(function() {
                var ordreID = $(this).data('order-id');
                var status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('orderConfirmationStatus') }}",
                    method: "POST",
                    data: {
                        order_id: ordreID,
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
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
     <script>
        $(document).ready(function() {
            $('#price_type').on('change', function() {
                $('#priceChangeSubmit').click();
            });
        });
    </script>
    <script src="{{ asset('public/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/vendors/scripts/datatable-setting.js') }}"></script>
@endsection
