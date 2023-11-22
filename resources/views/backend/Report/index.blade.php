@extends('backend.admin.admin_master')

@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="row">
                    <div class="col-6">
                        <div class="pd-20">
                            <h4 class="text-blue h4">Export Excel</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('ExpotReport') }}" method="GET">
                        <div class="row mb-2">
                            <div class="col-3">
                                <select name="month" id="" class="form-control">
                                    <option value="" selected disabled>Select Month</option>
                                    <option value="1" {{ request()->get('month') == 1 ? 'selected' : '' }}>January</option>
                                    <option value="2" {{ request()->get('month') == 2 ? 'selected' : '' }}>February</option>
                                    <option value="3" {{ request()->get('month') == 3 ? 'selected' : '' }}>March</option>
                                    <option value="4" {{ request()->get('month') == 4 ? 'selected' : '' }}>April</option>
                                    <option value="5" {{ request()->get('month') == 5 ? 'selected' : '' }}>May</option>
                                    <option value="6" {{ request()->get('month') == 6 ? 'selected' : '' }}>June</option>
                                    <option value="7" {{ request()->get('month') == 7 ? 'selected' : '' }}>July</option>
                                    <option value="8" {{ request()->get('month') == 8 ? 'selected' : '' }}>August</option>
                                    <option value="9" {{ request()->get('month') == 9 ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ request()->get('month') == 10 ? 'selected' : '' }}>October</option>
                                    <option value="11" {{ request()->get('month') == 11 ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ request()->get('month') == 12 ? 'selected' : '' }}>December</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="order_type" id="" class="form-control">
                                    <option value="" selected disabled>Order Type</option>
                                    <option value="order" {{ request()->get('order_type') == 'order' ? 'selected' : '' }}>Order</option>
                                    <option value="return" {{ request()->get('order_type') == 'return' ? 'selected' : '' }}>Return</option>
                                    <option value="cancled" {{ request()->get('order_type') == 'cancled' ? 'selected' : '' }}>Cancled</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="price_type" id="" class="form-control">
                                    <option value="" selected disabled>Order Price</option>
                                    <option value="INR">INR</option>
                                    <option value="Dollar">Dollar</option>
                                </select>
                            </div>
                            <div class="col-1">
                                <input type="submit" class="btn btn-primary" value="Export">
                            </div>
                            <div class="col-1">
                                <input onclick="location.href='{{route('adminReport')}}'" type="button" class="btn btn-secondary" value="Reset">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-box mb-30">
                <div class="row">
                    <div class="col-6">
                        <div class="pd-20">
                            <h4 class="text-blue h4">Filters</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('adminReport') }}" method="GET">
                        <div class="row mb-2">
                            <div class="col-3">
                                <select name="month" id="" class="form-control">
                                    <option value="" selected disabled>Select Month</option>
                                    <option value="1" {{ request()->get('month') == 1 ? 'selected' : '' }}>January</option>
                                    <option value="2" {{ request()->get('month') == 2 ? 'selected' : '' }}>February</option>
                                    <option value="3" {{ request()->get('month') == 3 ? 'selected' : '' }}>March</option>
                                    <option value="4" {{ request()->get('month') == 4 ? 'selected' : '' }}>April</option>
                                    <option value="5" {{ request()->get('month') == 5 ? 'selected' : '' }}>May</option>
                                    <option value="6" {{ request()->get('month') == 6 ? 'selected' : '' }}>June</option>
                                    <option value="7" {{ request()->get('month') == 7 ? 'selected' : '' }}>July</option>
                                    <option value="8" {{ request()->get('month') == 8 ? 'selected' : '' }}>August</option>
                                    <option value="9" {{ request()->get('month') == 9 ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ request()->get('month') == 10 ? 'selected' : '' }}>October</option>
                                    <option value="11" {{ request()->get('month') == 11 ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ request()->get('month') == 12 ? 'selected' : '' }}>December</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="order_type" id="" class="form-control">
                                    <option value="" selected disabled>Order Type</option>
                                    <option value="order" {{ request()->get('order_type') == 'order' ? 'selected' : '' }}>Order</option>
                                    <option value="return" {{ request()->get('order_type') == 'return' ? 'selected' : '' }}>Return</option>
                                    <option value="cancled" {{ request()->get('order_type') == 'cancled' ? 'selected' : '' }}>Cancled</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="price_type" id="" class="form-control">
                                    <option value="" selected disabled>Order Price</option>
                                    <option value="INR" {{ request()->get('price_type') == 'INR' ? 'selected' : '' }}>INR</option>
                                    <option value="Dollar" {{ request()->get('price_type') == 'Dollar' ? 'selected' : '' }}>Dollar</option>
                                </select>
                            </div>
                            <div class="col-1">
                                <input type="submit" class="btn btn-primary" value="Search">
                            </div>
                            <div class="col-1">
                                <input onclick="location.href='{{route('adminReport')}}'" type="button" class="btn btn-secondary" value="Reset">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-box mb-30">
                    <div class="row">
                        <div class="col-6">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Product Selling Reports</h4>
                            </div>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>Order_Date</th>
                                    <th>Order_ID</th>
                                    <th>State</th>
                                    <th>PinCode</th>
                                    <th>Bayer State</th>
                                    <th>Bayer Pin</th>
                                    <th>GST</th>
                                    <th>HSN Code</th>
                                    <th>GST Amount</th>
                                    <th>GST Rate</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($MonthlySellReport as $datas)
                                    @foreach ($datas->getOrderInformation as $orders)
                                        <tr>
                                            <td class="table-plus">
                                                {{ date('d-m-Y',strtotime($datas->created_at)) }}
                                            </td>
                                            <td class="table-plus">{{ $datas->unique_id }}</td>
                                            <td class="table-plus">Gujarat</td>
                                            <td class="table-plus">395006</td>
                                            <td class="table-plus">{{ $datas->address[0]->state }}</td>
                                            <td class="table-plus">{{ $datas->address[0]->pincode }}</td>
                                            <td class="table-plus">24JBUPS5657B1Z1</td>
                                            <td class="table-plus">{{ $orders->getproductsData->hsn_code }}</td>
                                            @if ($datas->country_type == "INR")
                                                <td class="table-plus">₹{{ $orders->getproductsData->tax_amount }}</td>
                                            @else
                                                <td class="table-plus">${{ $orders->getproductsData->tax_amount }}</td>
                                            @endif
                                            <td class="table-plus">{{ $orders->getproductsData->tax_rate }}</td>
                                            @if ($datas->country_type == "INR")
                                                <td class="table-plus"> ₹{{ $orders->total_price }}</td>
                                            @else
                                                <td class="table-plus">${{ $orders->total_price }}</td>
                                            @endif
                                            <td class="table-plus">{{ $orders->quantity }}</td>
                                            <td class="table-plus">
                                                @if ($datas->status == 0)
                                                    <span class="badge badge-info mb-1"> Pending</span>
                                                @endif
                                                @if ($datas->status == 1)
                                                    <span class="badge badge-success mb-1"> Confirmed</span>
                                                @endif
                                                @if ($datas->status == 2)
                                                    <span class="badge badge-warning mb-1"> Shipped</span>
                                                @endif
                                                @if ($datas->status == 3)
                                                    <span class="badge badge-primary mb-1"> Delivered</span>
                                                @endif
                                                @if ($datas->status == 4)
                                                    <span class="badge badge-danger mb-1"> Canceled</span>
                                                @endif
                                                @if ($datas->status == 5)
                                                    <span class="badge badge-secondary mb-1"> Packed</span>
                                                @endif
                                                @if ($datas->status == 6)
                                                    <span class="badge badge-warning mb-1"> Return</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>

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
@endsection
