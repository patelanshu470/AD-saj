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
        .checked {
        color: orange;
    }
    </style>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <form method="GET" action="{{ route('reviews') }}">
                    <div class="row">
                        <div class="col-2">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Reviews</h4>
                            </div>
                        </div>
                            <div class="col-3">
                                <div class="pd-20">
                                    <div style="">
                                        <select name="rating" id="" class="form-control">
                                            <option value="" selected disabled>Select Rating</option>
                                            <option value="1">1 Star</option>
                                            <option value="2">2 Star</option>
                                            <option value="3">3 Star</option>
                                            <option value="4">4 Star</option>
                                            <option value="5">5 Star</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 pr-0 pl-0">
                                <div class="pd-20">
                                    <div style=" float: right;">
                                        <input class="btn btn-primary" type="submit" style=" float:right;" value="Search">
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="pd-20 pl-0">
                                    <div style="">
                                        <button onclick="location.href='{{route('reviews')}}'" type="button" class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </form>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>User</th>
                                    <th>Image</th>
                                    <th>Review</th>
                                    <th>Rating</th>
                                    <th class="datatable-nosort">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productReview as $key => $reviews)
                                    <tr>
                                        <td class="table-plus" width="5%">{{ $key + 1 }}</td>
                                        <td width="25%">{{ Str::of($reviews->product->name)->limit(30, '...') }}</td>
                                        <td class="table-plus" width="10%">{{ $reviews->user->first_name }} {{ $reviews->user->last_name }}</td>
                                        <td >
                                            @if (isset($reviews->image))
                                                <img src="{{ asset('public/images/review_image/'.$reviews->image) }}" alt="" width="120" data-toggle="modal"
                                                data-target="#review_image_view{{ $reviews->id }}">
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td>{{ Str::of($reviews->description)->limit(30, '...') }}</td>
                                        <td>
                                            @if ($reviews->rating == 1)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                            @endif
                                            @if ($reviews->rating == 2)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                            @endif
                                            @if ($reviews->rating == 3)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                                <span class="fa fa-star "></span>
                                            @endif
                                            @if ($reviews->rating == 4)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star "></span>
                                            @endif
                                            @if ($reviews->rating == 5)
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="checkbox" class="switch-btn checkbox status-checkbox"
                                                id="{{ $reviews->id }}" {{ $reviews->status == 1 ? 'checked' : '' }}
                                                data-size="small" data-color="#0099ff"
                                                data-product-id="{{ $reviews->id }}">
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

    @foreach ($productReview as $reviews)
    <div class="modal fade bs-example-modal-lg" id="review_image_view{{ $reviews->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <form action="{{ route('category.add') }}" method="post" id="cat_add_modal">
        @csrf

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Review Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <img src="{{ asset('public/images/review_image/'.$reviews->image) }}" alt="" width="500">
                        </div>
                        <div class="col-lg-4">
                            <div class="thumb" style="display: flex">
                                <img src="{{ asset('public/frontend/assets/imgs/page/no_image.png') }}" alt="" style="width: 40px;border-radius: 50%;margin-right: 5px;">
                                <h6 style="align-self:center"><a href="#">{{ $reviews->user->first_name }} {{ $reviews->user->last_name }}</a></h6>
                            </div>
                            <div style="margin-left: 6px">
                                @if ($reviews->rating == 1)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                @endif
                                @if ($reviews->rating == 2)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                @endif
                                @if ($reviews->rating == 3)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                    <span class="fa fa-star "></span>
                                @endif
                                @if ($reviews->rating == 4)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star "></span>
                                @endif
                                @if ($reviews->rating == 5)
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                @endif
                            </div>
                            <p>{{ $reviews->description }}</p>
                            <div>
                                <h6>{{ $reviews->product->name }}</h6>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endforeach

    <script  async>
        $(document).ready(function() {
            $('.status-checkbox').change(function() {
                var reviewID = $(this).data('product-id');
                var status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('reviewStatus') }}",
                    method: "POST",
                    data: {
                        review_id: reviewID,
                        status: status,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        }
                        if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                });
            });
        });
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
