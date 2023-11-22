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
                                <h4 class="text-blue h4">Canceled Orders</h4>
                            </div>
                        </div>
                        <div class="col-3">
                            <form action="{{ route('OrderCanceled') }}" name="priceChange">
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
                                    <form action="{{ route('OrderCanceled') }}" method="GET">
                                        <button onclick="location.href='{{route('OrderCanceled')}}'" class="btn btn-secondary" type="button">Filters Reset</button>
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
                                    <th>Customer Information</th>
                                    <th>Total Amount</th>
                                    <th>Cancel Reason</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($order) > 0)
                                    @foreach ($order as $key => $orders)
                                        <tr>
                                            <td class="table-plus">{{ $key + 1 }}</td>
                                            <td class="table-plus">
                                                <a href="{{ route('order_view',$orders->orders->id) }}">
                                                    <strong class="ml-3">#{{ $orders->orders->unique_id }}</strong>
                                                    <br>
                                                    ({{ date('d-m-Y', strtotime($orders->orders->created_at)) }})
                                                </a>
                                            </td>
                                            <td>
                                                <a class="text-body text-capitalize" href="#">
                                                    <div class="customer--name">
                                                        {{ $orders->orders->billing_contact_name }}
                                                    </div>
                                                    <span class="phone">
                                                        +91{{ $orders->orders->billing_contact_number }}
                                                    </span>
                                                </a>
                                            </td>
                                            @if ($orders->orders->country_type == "INR")
                                                <td>
                                                    ₹{{ $orders->orders->grand_total }}
                                                </td>
                                            @else
                                                <td>
                                                    ${{ $orders->orders->grand_total }}
                                                </td>
                                            @endif
                                            <td>
                                                {{ $orders->reason }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                        href="#" role="button" data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        <a class="dropdown-item" href="{{ route('order_view',$orders->orders->id) }}"><i
                                                                class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                                            View</a>
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

    @foreach ($order as $orders)
        <div class="modal fade bs-example-modal-lg" id="view_return_order{{ $orders->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Canceled Order ID #{{ $orders->order_id }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    @php
                        $getOrderProduct = App\Models\OrderProduct::where('order_id', $orders->order_id)->get();
                        // dd($getOrderProduct);
                    @endphp
                    <div class="modal-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="40%">Product</th>
                                        <th width="10%">Color</th>
                                        <th width="20%">Price</th>
                                        <th width="10%">Quantity</th>
                                        <th width="20%" class="text-end">Total</th>
                                    </tr>
                                </thead>
                                @foreach ($getOrderProduct as $getOrderProducts)
                                    <tbody>
                                        <tr>
                                            <td>{{ $getOrderProducts->color->color }}</td>
                                            <td>₹{{ $getOrderProducts->price }}</td>
                                            <td>{{ $getOrderProducts->quantity }}</td>
                                            <td>₹{{ $getOrderProducts->total_price }}</td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="" style="font-weight: bold">Canceled Reason</label> <br>
                                <p>{{ $orders->reason }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

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
