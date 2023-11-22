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
    <!-- Video Modal Style -->
    <style>
        .vid-wrapper {
        text-align: center;
        padding: 20px;
        }

        .vid {
        display: inline-block;
        vertical-align: top;
        position: relative;
        border: 1px solid;
        padding: 2px;
        cursor: pointer;
        }

        .vid::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        }

        h2.vid-head {
        font-size: 20px;
        color: #333;
        }

        /* Video Popup */
        .video-popup {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 998;
        background: rgba(0, 0, 0, .7);
        cursor: pointer;
        display: none !important;
        }

        .video-popup.show-video {
        display: flex !important;
        }

        .iframe-wrapper {
        position: relative;
        }

        .iframe-wrapper .close-video {
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        top: -20px;
        right: 0;
        background: url(https://image.flaticon.com/icons/svg/149/149690.svg) #fff;
        border-radius: 50%;
        background-size: cover;
        }
    </style>

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <div class="card-box mb-30">
                    <div class="row">
                        <div class="col-4">
                            <div class="pd-20">
                                <h4 class="text-blue h4">Return Orders</h4>
                            </div>
                        </div>
                        <div class="col-3">
                            <form action="{{ route('OrderReturn') }}" name="priceChange">
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
                                    <form action="{{ route('OrderReturn') }}" method="GET">
                                        <button onclick="location.href='{{route('OrderReturn')}}'" class="btn btn-secondary" type="button">Filters Reset</button>
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
                                    <th>Attach</th>
                                    <th>Product</th>
                                    <th>Customer Information</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $key => $orders)
                                    <tr>
                                        <td class="table-plus">{{ $key +1 }}</td>
                                        <td class="table-plus">
                                            <a href="{{ route('order_view',$orders->order_id) }}">
                                                <strong class="ml-3">#{{ $orders->orders->unique_id }}</strong>
                                                <br>
                                                ({{ date('d-m-Y', strtotime($orders->orders->created_at)) }})
                                            </a>
                                        </td>
                                        <td class="video">
                                            <video src="{{ asset('public/images/return/'.$orders->attach) }}" style="width: 50px"></video>
                                        </td>
                                        <td>
                                            {{ $orders->getOrderProduct->getproductsData->name }}
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
                                                ₹{{ $orders->getOrderProduct->total_price }}
                                            </td>
                                        @else
                                            <td>
                                                ${{ $orders->getOrderProduct->total_price }}
                                            </td>
                                        @endif
                                        <td>
                                            @if ($orders->status == "pending")
                                                <span class="badge badge-primary mb-1"> Pending</span>
                                            @endif
                                            @if ($orders->status == "accept")
                                                <span class="badge badge-success mb-1"> Accept</span>
                                            @endif
                                            @if ($orders->status == "reject")
                                                <span class="badge badge-danger mb-1"> Reject</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#view_return_order{{ $orders->id }}"><i class="icon-copy fa fa-eye" aria-hidden="true"></i>
                                                        View</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                    data-target="#status_return_order{{ $orders->id }}"><i class="icon-copy dw dw-edit2"></i>
                                                        Status</a>
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
    <div class="video-popup">
        <div class="iframe-wrapper"><iframe width="800" height="500" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <span class="close-video" style="text-align: center;"><span class="icon-copy ti-close"></span></span>
        </div>
    </div>

    @foreach ($order as $orders)
    <div class="modal fade bs-example-modal-lg" id="view_return_order{{ $orders->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Return Order ID #{{ $orders->order_id }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="" style="font-weight: bold">product name</label> <br>
                            <p>{{ $orders->getOrderProduct->getproductsData->name }}</p>
                        </div>
                        <div class="col-lg-4">
                            <label for="" style="font-weight: bold">Total Amount</label> <br>
                            @if ($orders->orders->country_type == "INR")
                                <p>₹{{ $orders->getOrderProduct->total_price }}</p>
                            @else
                                <p>${{ $orders->getOrderProduct->total_price }}</p>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="" style="font-weight: bold">Return Reason</label> <br>
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

@foreach ($order as $orders)
<div class="modal fade bs-example-modal-lg" id="status_return_order{{ $orders->id }}" tabindex="-1" role="dialog"
aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Order ID #{{ $orders->order_id }} Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            @if ($orders->status == "pending")
            <form action="{{ route('adminOrderReturnStore',$orders->id) }}" method="GET">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="" style="font-weight: bold">Status</label> <br>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="accept">Accept</option>
                                    <option value="reject">Reject</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group" id="reason_gourp" hidden>
                                <label for="" style="font-weight: bold">Reason</label> <br>
                                <textarea name="reject_reason" id="reason" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            @else
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6" style="text-align: center;">
                        <label for="" style="font-weight: bold">Status</label> <br>
                        <p> @if ($orders->status == "accept")
                            <span class="badge badge-success mb-1"> Accept</span>
                        @endif
                        @if ($orders->status == "reject")
                            <span class="badge badge-danger mb-1"> Reject</span>
                        @endif</p>
                    </div>
                    @if ($orders->reject_reason != null)
                    <div class="col-lg-6">
                        <label for="" style="font-weight: bold">Reject Reason</label> <br>
                        <p>{{ $orders->reject_reason }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            @endif
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
    <!-- Video Modal Script -->
<script>
    $(document).ready(function() {
        $('.video').on('click', function() {
        // get required DOM Elements
        var iframe_src = $(this).children('video').attr('src'),
                iframe = $('.video-popup'),
                iframe_video = $('.video-popup iframe'),
                close_btn = $('.close-video');
                iframe_src = iframe_src + '?autoplay=1&rel=0'; // for autoplaying the popup video

        // change the video source with the clicked one
        $(iframe_video).attr('src', iframe_src);
        $(iframe).fadeIn().addClass('show-video');

        // remove the video overlay when clicking outside the video
        $(document).on('click', function(e) {
            if($(iframe).is(e.target) || $(close_btn).is(e.target)) {
            $(iframe).removeClass('show-video');
            $(iframe_video).attr('src', '');
        }
		});
	});
});
</script>

<script>
    $(document).ready(function() {
        // Detect changes in the status select element
        $("#status").change(function() {
            var selectedOption = $(this).val();

            // Show or hide the reason textarea based on the selected option
            if (selectedOption === "reject") {
                $("#reason").removeAttr("hidden").attr("required", "required");
                $("#reason_gourp").removeAttr("hidden");
            } else {
                $("#reason").attr("hidden", "hidden").removeAttr("required");
                $("#reason_gourp").attr("hidden", "hidden");
            }
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



