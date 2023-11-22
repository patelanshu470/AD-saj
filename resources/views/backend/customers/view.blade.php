@extends('backend.admin.admin_master')

@section('content')
    <style>
        .card {
            position: relative;
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-direction: column;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0.0625rem solid #f4f4f4;
            border-radius: 0.75rem;
        }

        .card-header {
            padding: 1.3125rem 1.3125rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 0.0625rem solid rgba(231, 234, 243, 0.7);
        }

        .card-header:first-child {
            border-radius: 0.6875rem 0.6875rem 0 0;
        }
    </style>
    <div class="main-container">
        <div class="card-box mb-30">
            <div class="row">
                <div class="col-6">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Customer View</h4>
                    </div>
                </div>
            </div>

        </div>
        <div class=" mb-30">
            <div class="row" id="printableArea">
                <div class="col-lg-8 mb-3 mb-lg-0">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h5 class="card-header-title">Order List <span class="badge badge-soft-secondary"
                                    id="itemCount">{{ count($order) }}</span></h5>
                        </div>

                        <div class="table-responsive datatable-custom">
                            <div id="columnSearchDatatable_wrapper" class="dataTables_wrapper no-footer">
                                <table id="columnSearchDatatable"
                                    class="data-table table stripe hover nowrap">
                                    <thead class="thead-light">
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="columnSearchDatatable"
                                                rowspan="1" colspan="1"
                                                aria-label="SL: activate to sort column ascending"
                                                style="width: 39.3125px;">SL</th>
                                            <th class="text-center w-50p sorting" tabindex="0"
                                                aria-controls="columnSearchDatatable" rowspan="1" colspan="1"
                                                aria-label="Order ID: activate to sort column ascending"
                                                style="width: 391.562px;">Order ID</th>
                                            <th class="w-50p text-center sorting" tabindex="0"
                                                aria-controls="columnSearchDatatable" rowspan="1" colspan="1"
                                                aria-label="Total Amount: activate to sort column ascending"
                                                style="width: 403.125px;">Total Amount</th>
                                                <th class="text-center w-50p sorting" tabindex="0"
                                                aria-controls="columnSearchDatatable" rowspan="1" colspan="1"
                                                aria-label="Order ID: activate to sort column ascending"
                                                style="width: 391.562px;">Payment Status</th>
                                            <th class="text-center w-50p sorting" tabindex="0"
                                                aria-controls="columnSearchDatatable" rowspan="1" colspan="1"
                                                aria-label="Order ID: activate to sort column ascending"
                                                style="width: 391.562px;">Status</th>
                                            <th class="text-center w-100px sorting" tabindex="0"
                                                aria-controls="columnSearchDatatable" rowspan="1" colspan="1"
                                                aria-label="Action: activate to sort column ascending" style="width: 84px;">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="set-rows">
                                        @foreach ($order as $key => $orders)
                                        <tr role="row" class="odd">
                                            <td>{{ $key + 1 }}</td>
                                            <td class="table-column-pl-0 text-center">
                                                <a href="{{ route('order_view',$orders->id) }}" style="color: #1b00ff;">#{{ $orders->unique_id }}</a>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    ₹{{ $orders->grand_total }}
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($orders->payment_status == 'pending')
                                                    <span class="badge badge-info mb-1"> Pending</span>
                                                @endif
                                                @if ($orders->payment_status == 'captured')
                                                    <span class="badge badge-success mb-1">Captured</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
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
                                                <div class="btn--container justify-content-center">
                                                    <a class="btn btn-sm btn--warning btn-outline-primary action-btn"
                                                        href="{{ route('order_view',$orders->id) }}"
                                                        title="View"><i class="icon-copy fa fa-eye" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="page-area px-4 pb-3">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="hide-page">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-header-title">
                                <span class="card-header-icon">
                                    <i class="tio-user"></i>
                                </span>
                                <span>
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="media align-items-center customer--information-single" href="javascript:">
                                <div class="avatar avatar-circle">
                                    <img class="avatar-img"
                                        src="{{ asset('public/frontend/assets/imgs/page/no_image.png') }}"
                                        alt="Image Description" style="border-radius: 50%;width: 110px">
                                </div>
                                <div class="media-body">
                                    <ul class="list-unstyled m-0">
                                        <li class="pb-1">
                                            <i class="tio-email mr-2"></i>
                                            {{ $user->email }}
                                        </li>
                                        <li class="pb-1">
                                            <i class="tio-call-talking-quiet mr-2"></i>
                                            +91 {{ $user->phone_number }}
                                        </li>
                                        <li class="pb-1">
                                            <i class="tio-shopping-basket-outlined mr-2"></i>
                                            {{ count($order) }} Orders
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5>Contact Information</h5>
                            </div>
                        </div>
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
