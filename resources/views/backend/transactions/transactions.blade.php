@extends('backend.admin.admin_master')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="row">
                        <div class="col-6">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Transactions</h4>
                            </div>
                        </div>


                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order ID</th>
                                    <th>Payment ID</th>
                                    <th>Customer Information</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $datas)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="table-plus">
                                            <a href="{{ route('order_view',$datas->order->unique_id) }}">
                                                <strong class="ml-3">#{{ $datas->order->unique_id }}</strong>
                                            </a>
                                        </td>

                                        <td class="table-plus">{{ $datas->payment_id }}</td>
                                        <td>
                                            <a class="text-body text-capitalize" href="#">
                                                <div class="customer--name">
                                                {{ $datas->order->billing_contact_name }}
                                                </div>
                                                <span class="phone">
                                                {{ $datas->order->billing_contact_number }}
                                                </span>
                                                </a>
                                        </td>
                                        <td class="table-plus">₹{{ $datas->amount }}.00</td>
                                        <td class="table-plus">{{ $datas->payment_method }}</td>
                                        @if ($datas->payment_status == 'authorized')
                                            <td class="table-plus">
                                                <span class="badge badge-warning" style="font-size: 12px">Authorized</span>
                                            </td>
                                        @elseif($datas->payment_status == 'captured')
                                            <td class="table-plus">
                                                <span class="badge badge-success" style="font-size: 12px">Captured</span>
                                            </td>
                                        @elseif($datas->payment_status == 'failed')
                                            <td class="table-plus">
                                                <span class="badge badge-danger" style="font-size: 12px">Failed</span>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
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
@endsection
