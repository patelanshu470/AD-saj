@extends('backend.admin.admin_master')

@section('content')
<link href="{{ asset('public/order/css/main.css') }}" rel="stylesheet" type="text/css" />
<style>
#swal2-input{
    width: 95%;
}
.text-muted {
  color: #adb5bd !important;
}
body{
    background: #f8f9fa;
}
.sidebar-menu .dropdown-toggle:after {
    position: absolute;
    right: 15px;
    font-size: 18px;
    top: 30%;
}
.dropdown-toggle:after{
    position: absolute;
  top: 27%;
  color: #adb5bd;
}
.user-info-dropdown{
    margin-right: 20px;
}
.dropdown-menu-icon-list .dropdown-item i{
    position: initial;
    align-self: self-end;
}
</style>
<div class="main-container" style="background: #f8f9fa">
<section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">Order detail</h2>
                    <p>Details for Order ID: #{{ $order->unique_id }}</p>
                </div>
            </div>
            <div class="card">
                <header class="card-header" style="background: #fff;padding: 1.3rem 1.3rem;">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                            <span>
                                <i class="material-icons md-calendar_today"></i> <b>{{ date('d-m-Y, g:i A', strtotime($order->created_at)) }}</b>
                            </span> <br>
                            <small class="text-muted">Order ID: #{{ $order->unique_id }}</small>
                        </div>
                        <div class="col-lg-6 col-md-6 ms-auto text-md-end"  style="text-align: end">
                            <select class="form-select d-inline-block mb-lg-0 mb-15 mw-200 status" data-order_id={{ $order->id }} {{($order->delivered_at != null) ? 'disabled' : ''}} {{($order->canceled_at != null) ? 'disabled' : ''}}>
                                <option selected disabled>Change status</option>
                                <option value="4" {{($order->status == 4) ? 'Selected' : ''}} {{($order->shipped_at != null) ? 'disabled' : ''}}>Cancel</option>
                                <option value="1" {{($order->status == 1) ? 'Selected' : ''}} {{($order->shipped_at != null) ? 'disabled' : ''}} {{($order->status == 5) ? 'disabled' : ''}}>Confirmed</option>
                                <option value="5" {{($order->status == 5) ? 'Selected' : ''}} {{($order->confirmed_at == null) ? 'disabled' : ''}} {{($order->shipped_at != null) ? 'disabled' : ''}}>Packed</option>
                                <option value="2" {{($order->status == 2) ? 'Selected' : ''}} {{($order->confirmed_at == null) ? 'disabled' : ''}}>Shipped</option>
                                <option value="3" {{($order->status == 3) ? 'Selected' : ''}} {{($order->shipped_at == null) ? 'disabled' : ''}}>Delivered</option>
                            </select>
                            <a class="btn btn-secondary print ms-2" href="{{ route('download_invoice',$order->id) }}" style="margin-left: 0.5rem" title="Invoice Download"><i class="fa fa-download"></i></a>
                            <a class="btn btn-secondary print ms-2" href="{{ route('OrderlabelDownload',$order->id) }}" target="_blank" style="margin-left: 0.5rem;font-size: initial;" title="Shipping Label" onclick="window.open(this.href).print(); return false"><i class="fa fa-print"></i></a>
                        </div>
                    </div>
                </header> <!-- card-header end// -->
                <div class="card-body">
                    <div class="row mb-50 mt-20 order-info-wrap">
                        <div class="col-md-4">
                            <article class="icontext align-items-start">
                                <span class="icon icon-sm rounded-circle bg-primary-light">
                                    <i class="text-white material-icons md-person" style="padding-bottom: 5px;"></i>
                                </span>
                                <div class="text">
                                    <h6 class="mb-1">Customer</h6>
                                    <p class="mb-1">
                                        {{ $order->billing_contact_name }} <br> {{ $order->user->email }} <br> +91{{ $order->billing_contact_number }}
                                    </p>
                                </div>
                            </article>
                        </div> <!-- col// -->
                        <div class="col-md-4">
                            <article class="icontext align-items-start">
                                <span class="icon icon-sm rounded-circle bg-primary-light">
                                    <i class="text-white  material-icons md-local_shipping" style="padding-bottom: 5px;"></i>
                                </span>
                                <div class="text">
                                    <h6 class="mb-1">Order info</h6>
                                    <p class="mb-1">
                                        Shipping: DTDC <br> Pay method: {{ ucfirst($payment_id_get->payment_method) }} <br>
                                    </p>
                                </div>
                            </article>
                        </div> <!-- col// -->
                        <div class="col-md-4">
                            <article class="icontext align-items-start">
                                <span class="icon icon-sm rounded-circle bg-primary-light">
                                    <i class="text-white  material-icons md-place" style="padding-bottom: 5px;"></i>
                                </span>
                                <div class="text">
                                    <h6 class="mb-1">Deliver to</h6>
                                    <p class="mb-1">
                                        City: {{$shipping_address->city}}, {{$shipping_address->country}} <br>{{$shipping_address->street}}, {{$shipping_address->landmark}},<br> {{$shipping_address->pincode}}.
                                    </p>
                                </div>
                            </article>
                        </div> <!-- col// -->
                    </div> <!-- row // -->
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="40%">Product</th>
                                            <th width="20%">Unit Price</th>
                                            <th width="10%">Quantity</th>
                                            <th width="20%" class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($OrderProduct as $product)

                                        <tr>
                                            <td>
                                                <a class="itemside" href="#">
                                                    <div class="left">
                                                        <img src="{{ URL::asset('public/images/product/'.$product->getproductsData->thumbnail)}}"  class="img-xs" alt="Item" style="object-fit: contain;">
                                                    </div>
                                                    <div class="info"> {{ $product->getproductsData->name }} </div>
                                                </a>
                                            </td>
                                            @if ($order->country_type == "INR")
                                                <td class="ml-10 pl-20"> ₹{{ number_format($product->price, 2, '.', ',') }} </td>
                                            @else
                                                <td class="ml-10 pl-20"> ${{ number_format($product->price, 2, '.', ',') }} </td>
                                            @endif
                                            <td class="ml-10 pl-20"> {{ $product->quantity }} </td>
                                            @if ($order->country_type == "INR")
                                                <td class="text-end"> ₹{{ number_format($product->total_price, 2, '.', ',') }} </td>
                                            @else
                                                <td class="text-end"> ${{ number_format($product->total_price, 2, '.', ',') }} </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">
                                                <dt class="text-muted">Order Note:</dt>
                                                {{ $order->order_note }}
                                            </td>
                                            <td colspan="3">
                                                <article class="float-end">
                                                    <dl class="dlist">
                                                        <dt>Subtotal:</dt>
                                                        @if ($order->country_type == "INR")
                                                            <dd>₹{{ number_format($order->subtotal, 2, '.', ',') }}</dd>
                                                        @else
                                                            <dd>${{ number_format($order->subtotal, 2, '.', ',') }}</dd>
                                                        @endif
                                                    </dl>
                                                    <dl class="dlist">
                                                        <dt>Shipping cost:</dt>
                                                        <dd>Free Shipping</dd>
                                                    </dl>
                                                    <dl class="dlist">
                                                        <dt>Grand total:</dt>
                                                        @if ($order->country_type == "INR")
                                                            <dd> <b class="h5">₹{{ number_format($order->grand_total, 2, '.', ',') }}</b> </dd>
                                                        @else
                                                            <dd> <b class="h5">${{ number_format($order->grand_total, 2, '.', ',') }}</b> </dd>
                                                        @endif
                                                    </dl>
                                                    <dl class="dlist">
                                                        <dt class="text-muted">Status:</dt>
                                                        <dd>
                                                            <span class="badge rounded-pill alert-success text-success">{{ $order->payment_method }}</span>
                                                        </dd>
                                                    </dl>
                                                </article>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> <!-- table-responsive// -->
                        </div> <!-- col// -->
                        <div class="col-lg-1"></div>
                        <div class="col-lg-4">
                            {{-- @if ($payment->method == 'card')
                            <div class="box shadow-sm bg-light">
                                <div style="display: flex;
                                justify-content: space-between;">
                                    <h6 class="mb-15">Payment info</h6>
                                    <h6 class="mb-15">Pay method: {{ ucfirst($payment->method) }}</h6>
                                </div>
                                <p>
                                    <img src="" class="border" height="20"><i class="fa fa-cc-mastercard" aria-hidden="true"></i> {{ $payment->card->network }} **** **** {{ $payment->card->last4 }} <br>
                                    Card Holder name: {{ $order->user->first_name }} {{ $order->user->last_name }} <br>
                                    Phone: +91 {{ $order->user->phone_number }}
                                </p>
                            </div>
                            @endif
                            @if ($payment->method == 'netbanking')
                            <div class="box shadow-sm bg-light">
                                <div style="display: flex;
                                justify-content: space-between;">
                                    <h6 class="mb-15">Payment info</h6>
                                    <h6 class="mb-15">Pay method: {{ ucfirst($payment->method) }}</h6>
                                </div>
                                <p>
                                    @if (is_object($payment->bank))
                                        <img src="" class="border" height="20"><i class="fa fa-cc-mastercard" aria-hidden="true"></i> Netbanking {{ $payment->bank->name }} <br>
                                    @else
                                        Bank information not available <br>
                                    @endif
                                    Bank Holder name: {{ $order->user->first_name }} {{ $order->user->last_name }} <br>
                                    Phone: +91 {{ $order->user->phone_number }}
                                </p>
                            </div>
                            @endif
                            @if ($payment->method == 'wallet')
                                <div class="box shadow-sm bg-light">
                                    <div style="display: flex;
                                    justify-content: space-between;">
                                        <h6 class="mb-15">Payment info</h6>
                                        <h6 class="mb-15">Pay method: {{ ucfirst($payment->method) }}</h6>
                                    </div>
                                    <p>
                                        @if (is_object($payment->wallet))
                                            <img src="" class="border" height="20"><i class="fa fa-cc-mastercard" aria-hidden="true"></i> Netbanking {{ $payment->wallet->name }} <br>
                                        @else
                                        Wallet information not available <br>
                                        @endif
                                        Bank Holder name: {{ $order->user->first_name }} {{ $order->user->last_name }} <br>
                                        Phone: +91 {{ $order->user->phone_number }}
                                    </p>
                                </div>
                            @endif --}}

                            <div class="h-25 pt-4">
                                @if ($order->admin_order_note != null)
                                <form method="POST" action="{{ route('adminOrderNote') }}">
                                    @csrf
                                        <div class="mb-3">
                                            <label>Notes</label>
                                            <textarea class="form-control" name="notes" id="notes" placeholder="Type some note">{{ $order->admin_order_note }}</textarea>
                                            <input type="text" name="order_id" value="{{ $order->id }}" hidden>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save note</button>
                                    </form>

                                @else
                                <form method="POST" action="{{ route('adminOrderNote') }}">
                                @csrf
                                    <div class="mb-3">
                                        <label>Notes</label>
                                        <textarea class="form-control" name="notes" id="notes" placeholder="Type some note"></textarea>
                                        <input type="text" name="order_id" value="{{ $order->id }}" hidden>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save note</button>
                                </form>

                                @endif
                            </div>
                        </div> <!-- col// -->
                    </div>
                </div> <!-- card-body end// -->
            </div> <!-- card end// -->
        </section>
</div>
<div id="preloader-active" style="display: none;">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <h5 class="mb-10">Now Loading</h5>
                <div class="loader">
                    <div class="bar bar1"></div>
                    <div class="bar bar2"></div>
                    <div class="bar bar3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="{{ route('orderConfirmation') }}" style="display: none;" id="order_confirm_id"></a>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('change', '.status', function() {
        var statuss = this.value;
        var check_order_status = {{ $order->call_at }};
        if (statuss == 1 && check_order_status == 0 ) {
        //    var statusName = "Confirmed";
            Swal.fire({
                title: 'Not Confirmation!',
                text: 'This Order Is Not Call to Confirmation',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'Click, Go to Confirmation',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('order_confirm_id').click();
                } else
                    return false;
            });
        }

        if (statuss == 1 && check_order_status == 1) {
            // sdfdsfs
           var statusName = "Confirmed";

            Swal.fire({
                title: 'Confirmation!',
                text: 'Are you sure you want to '+statusName+' Order',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: "No, cancel please!",
            }).then((result) => {
                if (result.isConfirmed) {
            var status = this.value;
            var order_id = $(this).data('order_id');
            // alert(order_id);

            toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
            };

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('orderStatus') }}",
                data: {'status': status, 'order_id': order_id},
                beforeSend: function(data) {
                    jQuery(document).find('.pre-loader').show();
                },
                success: function(data){
                    if (data.success) {
                        jQuery(document).find('.pre-loader').hide();
                        toastr.success(data.success);
                        $('select.status option:eq(3)').removeAttr('disabled');
                    }
                    if (data.error) {
                        jQuery(document).find('.pre-loader').hide();
                        toastr.error(data.error);
                    }
                }
            });
        } else
                return false;
        });
        }
        if (statuss == 2) {
           var statusName = "Shipped";
           Swal.fire({
            title: 'Confirmation!',
            text: 'Are you sure you want to '+statusName+' Order',
            input: 'text',
            inputLabel: 'Tracker ID',
            inputValue: '',
            inputPlaceholder: 'Enter Order Tracker ID',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!',
            cancelButtonText: "No, cancel please!",
            inputValidator: (value) => {
                if (!value) {
                    return 'Please enter Order Tracker ID'
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
        var status = this.value;
        var order_id = $(this).data('order_id');
        var inputVal = result.value;

        toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ route('orderStatus') }}",
            data: {'status': status, 'order_id': order_id, 'tracking_id': inputVal},
            beforeSend: function(data) {
                jQuery(document).find('.pre-loader').show();
            },
            success: function(data){
                if (data.success) {
                    jQuery(document).find('.pre-loader').hide();
                    toastr.success(data.success);
                    $('select.status option:eq(5)').removeAttr('disabled');
                    $('select.status option:eq(1)').attr("disabled", true);
                    $('select.status option:eq(2)').attr("disabled", true);
                    $('select.status option:eq(3)').attr("disabled", true);
                }
                if (data.error) {
                    jQuery(document).find('.pre-loader').hide();
                    toastr.error(data.error);
                }
            }
        });
    } else
            return false;
    });
        }
        if (statuss == 3) {
           var statusName = "Delivered";
            Swal.fire({
                title: 'Confirmation!',
                text: 'Are you sure you want to '+statusName+' Order',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: "No, cancel please!",
            }).then((result) => {
                if (result.isConfirmed) {
            var status = this.value;
            var order_id = $(this).data('order_id');
            toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
            };

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('orderStatus') }}",
                data: {'status': status, 'order_id': order_id},
                beforeSend: function(data) {
                    jQuery(document).find('.pre-loader').show();
                },
                success: function(data){
                    if (data.success) {
                        jQuery(document).find('.pre-loader').hide();
                        toastr.success(data.success);
                        $('.status').attr("disabled", true);
                    }
                    if (data.error) {
                        jQuery(document).find('.pre-loader').hide();
                        toastr.error(data.error);
                    }
                }
            });
        } else
                return false;
        });
        }
        if (statuss == 4) {
           var statusName = "Cancaled";
           Swal.fire({
            title: 'Confirmation!',
            text: 'Are you sure you want to '+statusName+' Order',
            input: 'text',
            inputLabel: 'Cancaled Reason',
            inputValue: '',
            inputPlaceholder: 'Enter your Canceled Reason',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!',
            cancelButtonText: "No, cancel please!",
            inputValidator: (value) => {
                if (!value) {
                    return 'Please enter Canceled Reason'
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
        var status = this.value;
        var order_id = $(this).data('order_id');
        var inputVal = result.value;
        // alert(order_id);

        toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-right"
        };

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ route('orderStatus') }}",
            data: {'status': status, 'order_id': order_id, 'canceled_reason': inputVal},
            beforeSend: function(data) {
                jQuery(document).find('.pre-loader').show();
            },
            success: function(data){
                if (data.success) {
                    jQuery(document).find('.pre-loader').hide();
                    toastr.success(data.success);
                    $('.status').attr("disabled", true);
                }
                if (data.error) {
                    jQuery(document).find('.pre-loader').hide();
                    toastr.error(data.error);
                }
            }
        });
    } else
            return false;
    });
        }

        if (statuss == 5) {
           var statusName = "Packed";
            Swal.fire({
                title: 'Confirmation!',
                text: 'Are you sure you want to Packed Order',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes!',
                cancelButtonText: "No, cancel please!",
            }).then((result) => {
                if (result.isConfirmed) {
            var status = this.value;
            var order_id = $(this).data('order_id');
            toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
            };

            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('orderStatus') }}",
                data: {'status': status, 'order_id': order_id},
                beforeSend: function(data) {
                    jQuery(document).find('.pre-loader').show();
                },
                success: function(data){
                    if (data.success) {
                        jQuery(document).find('.pre-loader').hide();
                        toastr.success(data.success);
                        $('select.status option:eq(2)').attr("disabled", true);
                        $('select.status option:eq(4)').removeAttr('disabled');
                    }
                    if (data.error) {
                        jQuery(document).find('.pre-loader').hide();
                        toastr.error(data.error);
                    }
                }
            });
        } else
                return false;
        });
        }

    });
</script>

<script  async>
    $('.user-info-dropdown').click(function(){
        $(this).children('div').addClass('show');
        $('.dropdown-menu-icon-list').addClass('show');
        if ($(this).children('div').data('option') === 'on') {
            $(this).children('div').data('option', 'off');
            $(this).children('div').removeClass('show');
            $('.dropdown-menu-icon-list').removeClass('show');
        } else {
            $(this).children('div').data('option', 'on');
            $(this).children('div').addClass('show');
            $('.dropdown-menu-icon-list').addClass('show');
        // Do something when data-option is not 'on'
        }
    });
</script>
@endsection
