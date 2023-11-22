@extends('backend.admin.admin_master')

@section('content')
<style>
    .revenue_cards{
        justify-content: center;
    display: flex;
    width: 70px;
    height: 102.7px;
    text-align: center;
    align-items: center;
    }
</style>
    <div class="main-container">
        <div class="pd-ltr-20">
                <div class="card-box height-100-p pd-20 mb-30">
                    <h2 class="h4">Total</h2>
                </div>
            <div class="row">
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-analytics-21" style="font-size: 38px;color: green;"></i></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0">
                                        ₹{{ number_format($total_INR, 2, '.', ',') }}
                                        <div class="weight-600 font-14">Total Revenue INR</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-box" style="font-size: 38px;color: #0014ff;"></i></div>
                            </div>
                            <div class="widget-data">
                                    <div class="h4 mb-0">{{ $total_order }}</div>
                                    <div class="weight-600 font-14">Total Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-cancel" style="font-size: 38px;color: red;"></i></div>
                            </div>
                            <div class="widget-data">
                                    <div class="h4 mb-0">{{ $total_orderCancel }}</div>
                                    <div class="weight-600 font-14">Total Canceled Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-repeat1" style="font-size: 38px;color: #8500ff;"></i></div>
                            </div>
                            <div class="widget-data">
                                    <div class="h4 mb-0">{{ $total_orderReturn }}</div>
                                    <div class="weight-600 font-14">Total Return Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-analytics-21" style="font-size: 38px;color: green;"></i></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0">${{ number_format($total_Dollar, 2, '.', ',') }}</div>
                                <div class="weight-600 font-14">Total Revenue Dollar</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-package" style="font-size: 38px;color: red;"></i></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0">{{ count($outofStock) }}</div>
                                <div class="weight-600 font-14">Out Of Stock</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-box height-100-p pd-20 mb-30">
                <h2 class="h4">Monthly</h2>

            </div>
            <div class="row">
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-analytics-21" style="font-size: 38px;color: green;"></i></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0">
                                        ₹{{ number_format($total_INR_Monthly, 2, '.', ',') }}
                                        <div class="weight-600 font-14">Total Revenue INR</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-box" style="font-size: 38px;color: #0014ff;"></i></div>
                            </div>
                            <div class="widget-data">
                                    <div class="h4 mb-0">{{ $total_order_Monthly }}</div>
                                    <div class="weight-600 font-14">Total Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-cancel" style="font-size: 38px;color: red;"></i></div>
                            </div>
                            <div class="widget-data">
                                    <div class="h4 mb-0">{{ $total_orderCancel_Monthly }}</div>
                                    <div class="weight-600 font-14">Total Canceled Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-repeat1" style="font-size: 38px;color: #8500ff;"></i></div>
                            </div>
                            <div class="widget-data">
                                    <div class="h4 mb-0">{{ $total_orderReturn_Monthly }}</div>
                                    <div class="weight-600 font-14">Total Return Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-analytics-21" style="font-size: 38px;color: green;"></i></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0">${{ number_format($total_Dollar_Monthly, 2, '.', ',') }}</div>
                                <div class="weight-600 font-14">Total Revenue Dollar</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-box height-100-p pd-20 mb-30">
                <h2 class="h4">Weekly</h2>
            </div>
            <div class="row">
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-analytics-21" style="font-size: 38px;color: green;"></i></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0">
                                        ₹{{ number_format($total_INR_Weekly, 2, '.', ',') }}
                                        <div class="weight-600 font-14">Total Revenue INR</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-box" style="font-size: 38px;color: #0014ff;"></i></div>
                            </div>
                            <div class="widget-data">
                                    <div class="h4 mb-0">{{ $total_order_Weekly }}</div>
                                    <div class="weight-600 font-14">Total Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-cancel" style="font-size: 38px;color: red;"></i></div>

                            </div>
                            <div class="widget-data">
                                    <div class="h4 mb-0">{{ $total_orderCancel_Weekly }}</div>
                                    <div class="weight-600 font-14">Total Canceled Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-repeat1" style="font-size: 38px;color: #8500ff;"></i></div>
                            </div>
                            <div class="widget-data">
                                    <div class="h4 mb-0">{{ $total_orderReturn_Weekly }}</div>
                                    <div class="weight-600 font-14">Total Return Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 mb-30">
                    <div class="card-box height-100-p widget-style1">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="progress-data">
                                <div id="" class="revenue_cards"><i class="icon-copy dw dw-analytics-21" style="font-size: 38px;color: green;"></i></div>
                            </div>
                            <div class="widget-data">
                                <div class="h4 mb-0">${{ number_format($total_Dollar_Weekly, 2, '.', ',') }}</div>
                                <div class="weight-600 font-14">Total Revenue Dollar</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($outofStock) > 0)
                <div class="card-box mb-30">
                    <h2 class="h4 pd-20">Out Of Stock Products</h2>
                    <table class="table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Status</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($outofStock as $outofStocks)
                            <tr>
                                <td class="table-plus">
                                    {{ $outofStocks->getProductInformation->unique_id }}
                                </td>
                                <td>
                                    <h5 class="font-14">{{ $outofStocks->getProductInformation->name }}</h5>

                                </td>
                                <td>{{ $outofStocks->getProductInformation->category->name }}</td>
                                <td>{{ $outofStocks->color }}</td>
                                <td>₹{{ number_format($outofStocks->getProductInformation->selling_price, 2, '.', ',') }}</td>
                                <td>{{ $outofStocks->quantity }}</td>
                                <td>{{ $outofStocks->getProductInformation->status }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                            <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
