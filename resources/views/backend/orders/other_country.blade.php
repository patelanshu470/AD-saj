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
        .btn-group form .btn{
            padding: 0 !important;
        }
    </style>
<style>
    .tooltips {
  position: relative;
  display: inline-block;
  /* border-bottom: 1px dotted black; */
}

.tooltips .tooltiptext {
  visibility: hidden;
  width: 420px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 0%;
  margin-left: -60px;
}

.tooltips .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: black transparent transparent transparent;
}

.tooltips:hover .tooltiptext {
  visibility: visible;
}
</style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="row">
                        <div class="col-1">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Orders In Other Country</h4>
                            </div>
                        </div>

                        <div class="btn-group mb-15 mt-15 ml-5">
                            <form action="{{ route('orders') }}" method="GET" class="btn btn-info">
                                <button name="status" class="btn text-white" type="submit" value="0" >Pending</button>
                            </form>
                            <form action="{{ route('orders') }}" method="GET" class="btn btn-success">
                                <button name="status" class="btn text-white" type="submit" value="1" >Confirm</button>
                            </form>
                            <form action="{{ route('orders') }}" method="GET" class="btn btn-warning">
                                <button name="status" class="btn text-white" type="submit" value="2">Shipped</button>
                            </form>
                            <form action="{{ route('orders') }}" method="GET" class="btn btn-primary">
                                <button name="status" class="btn text-white" type="submit" value="3">Delivered</button>
                            </form>
                            <form action="{{ route('orders') }}" method="GET" class="btn btn-danger">
                                <button name="status" class="btn text-white" type="submit" value="4">Canceled</button>
                            </form>
                        </div>

                        <div class="col-2">
                            <div class="mt-15">
                                <div>
                                    <form action="{{ route('orders') }}" method="GET">
                                        <button onclick="location.href='{{route('orders')}}'" class="btn btn-secondary" type="button">Filters Reset</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-20 ">
                        <table class="data-table table stripe hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order ID</th>
                                    <th>SKU</th>
                                    <th>Tracking ID</th>
                                    <th>Customer Information</th>
                                    <th>Total Amount</th>
                                    <th>Order Notes</th>
                                    <th>Order Status</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $key => $orders)
                                    <tr>
                                        <td class="table-plus">{{ $key +1 }}</td>
                                        <td class="table-plus">
                                            <a href="{{ route('order_view',$orders->id) }}">
                                                <strong class="ml-3">#{{ $orders->id }}</strong>
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
                                            {{ $orders->tracking_id }}
                                        </td>
                                        <td>
                                            <a class="text-body text-capitalize" href="#">
                                                <div class="customer--name">
                                                {{ $orders->user->first_name }} {{ $orders->user->last_name }}
                                                </div>
                                                <span class="phone">
                                                +91{{ $orders->user->phone_number }}
                                                </span>
                                                </a>
                                        </td>
                                        <td>
                                            ₹{{ $orders->grand_total }}
                                        </td>
                                        <td style="width: 15%;word-wrap: break-word">
                                            <div class="tooltips">{{ Str::of($orders->admin_order_note)->limit(30, '...') }}
                                                <span class="tooltiptext">{{ $orders->admin_order_note }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($orders->status == 0)
                                                <span class="badge badge-info mb-1"> Pending</span>
                                            @endif
                                            @if ($orders->status == 1)
                                                <span class="badge badge-success mb-1"> Confirmed</span>
                                            @endif
                                            @if ($orders->status == 2)
                                                <span class="badge badge-warning mb-1"> Shipped</span>
                                            @endif
                                            @if ($orders->status == 3)
                                                <span class="badge badge-primary mb-1"> Delivered</span>
                                            @endif
                                            @if ($orders->status == 4)
                                                <span class="badge badge-danger mb-1"> Canceled</span>
                                            @endif
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



