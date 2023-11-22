@extends('backend.admin.admin_master')
@section('content')
<style>
    .tooltips {
  position: relative;
  display: inline-block;
}
.tooltips .tooltiptext {
  visibility: hidden;
  width: 300px;
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
                        <div class="col-6">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Contact Us</h4>
                            </div>
                        </div>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                    <tr>
                                        <td class="table-plus"> {{ $datas->name }} </td>
                                        <td class="table-plus">{{ $datas->email }}</td>
                                        <td class="table-plus">{{ $datas->phone_number }}</td>
                                        <td class="table-plus">{{ date('d-M-y', strtotime($datas->created_at))}} </td>
                                        <td class="table-plus"><a class="dropdown-item" data-target="#category_edit{{ $datas->id }}"
                                            data-toggle="modal" style="color: blue;cursor: context-menu;"><i class="dw dw-eye"></i>
                                            View</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>@foreach ($data as $datas)
<div class="modal fade bs-example-modal-lg" id="category_edit{{ $datas->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">{{ $datas->name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p><b>Name:</b> {{ $datas->name }}</p>
                    <p><b>Email:</b> {{ $datas->email }}</p>
                    <p><b>Phone Number:</b> {{ $datas->phone_number }}</p>
                    <p><b>Message:</b> {{ $datas->message }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
</div>
@endforeach
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
