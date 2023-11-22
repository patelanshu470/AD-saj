@extends('backend.admin.admin_master')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="card-box mb-30">
                    <div class="row">
                        <div class="col-6">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Customer Highlights</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pd-20">
                                <div style=" float: right;">
                                    <a class="btn btn-primary" href="{{ route('customerHighlights.create') }}">
                                        +Add</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <div class="pb-20 pt-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($highlight_image as $key => $highlights)
                                    <tr>
                                        <td class="table-plus">{{ $key + 1 }}</td>
                                        <td class="table-plus">
                                            <img style="object-fit:contain;border-radius:5px;" src="{{ URL::asset('public/images/highlights/images/'.$highlights->path)}}" alt="" width="60" height="52">
                                        </td>
                                        <td>{{ $highlights->category->name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        <a class="dropdown-item"
                                                        onclick="deleteRecord({{ $highlights->id }})"><i
                                                            class="dw dw-delete-3"></i>
                                                        Delete</a>
                                                    <a href="{{ route('customerHighlights.destroy', $highlights->id) }}"
                                                        id="del{{ $highlights->id }}" style="display: none"><i
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
                <div class="card-box mb-30">
                    <div class="pb-20 pt-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Video</th>
                                    <th>Category</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($highlight_video as $key => $highlights)
                                    <tr>
                                        <td class="table-plus">{{ $key + 1 }}</td>
                                        <td class="table-plus">
                                            <video style="object-fit:contain;border-radius:25px;" src="{{ URL::asset('public/images/highlights/videos/'.$highlights->path)}}"  alt="" width="80" height="80"></video>
                                        </td>
                                        <td>{{ $highlights->category->name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                        <a class="dropdown-item"
                                                        onclick="deleteRecord({{ $highlights->id }})"><i
                                                            class="dw dw-delete-3"></i>
                                                        Delete</a>
                                                    <a href="{{ route('customerHighlights.destroy', $highlights->id) }}"
                                                        id="del{{ $highlights->id }}" style="display: none"><i
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
    {{-- sweet alert  --}}
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
