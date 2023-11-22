@extends('frontend.layouts.fullLayoutMaster')

@section('page-style')
    <style>
        #default_address_id {
            margin-top: 5px;
            margin-left: 10px;
            height: 20px;
            width: 20px;
            position: absolute;
            background-color: #fff4e7;
            border-radius: 50%;
        }

        .order-list-main .default-address-header {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .default-address-header {
            font-size: 16px;
        }

        .default-address-header {
            background-color: #751d1c;
            color: #fff;
            font-size: 14px;
            font-weight: 400;
        }

        .order-sublist button {
            border: 1px solid #751d1c;
            border-radius: 8px;
            width: 100%;
            background-color: #ffffff;
            padding: 3px;
            font-size: 13px;
            margin: 5px;
        }

        .order-sublist .btn {
            border: 1px solid #751d1c;
            border-radius: 8px;
            width: 100%;
            background-color: #751d1c;
            padding: 3px;
            font-size: 13px;
            margin: 5px;
        }

        img {
            max-width: 100%;
            height: auto
        }

        .order-list .d-flex {
            justify-content: space-between;
            margin: 10px;
        }

        .login-form-wrap {
            padding: 30px;
            background-color: #f9f9f9;
            margin-bottom: 25px
        }

        .order-detail-head .side-line {
            border-right: 1px solid #666;
        }

        ul.timeline {
            list-style-type: none;
            position: relative;
            text-align: center;
            justify-content: space-around;
        }

        ul.timeline:before {
            content: " ";
            background: #751d1c;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 90%;
            height: 2px;
            z-index: 400;
        }

        ul.timeline>li {
            margin: 20px 0;
        }

        ul.timeline>li:before {
            content: "";
            background: #fff;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            left: 36%;
            top: -10%;
            width: 25px;
            height: 25px;
            z-index: 400;
            border: 1px solid #751d1c;
        }

        ul.timeline>li.order:before {
            left: 10%;
        }

        ul.timeline>li.shiping:before {
            left: 33%;
        }

        ul.timeline>li.out-delivery:before {
            left: 60%;
        }

        ul.timeline>li.delivery:before {
            left: 86%;
        }

        ul.timeline>li.active:before {
            content: "";
            background: #751d1c;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 0;
            left: 10%;
            width: 25px;
            height: 25px;
            z-index: 400;
            border: 1px solid #751d1c;
        }

        ul.timeline>li.order.active:before {
            left: 10%;
        }

        ul.timeline>li.shiping.active:before {
            left: 33%;
        }

        ul.timeline>li.out-delivery.active:before {
            left: 60%;
        }

        ul.timeline>li.delivery.active:before {
            left: 86%;
        }

        .order_canceled_css .btn {
            border: 1px solid #751d1c;
            border-radius: 8px;
            width: 100%;
            padding: 3px;
            font-size: 13px;
            margin: 5px;
            background: #751d1c;
            color: #ffffff;
            height: 30px;
        }

        .order_canceled_css button {
            border: 1px solid #751d1c;
            border-radius: 8px;
            width: 100%;
            padding: 3px;
            font-size: 13px;
            margin: 5px;
            color: black;
        }

        .order_invoice_download button {
            border: 1px solid #751d1c;
            border-radius: 8px;
            width: 100%;
            padding: 3px;
            font-size: 13px;
            margin: 5px;
        }
    </style>
    <STYLE>
        .rightbox {
            padding: 0em 34rem 0em 0em;
            height: 100%;
        }

        .rb-container {
            font-family: "PT Sans", sans-serif;
            width: 50%;
            margin: auto;
            display: block;
            position: relative;
        }

        .rb-container ul.rb {
            margin: 2.5em 0;
            padding: 0;
            display: inline-block;
            width: 470px;

        }

        .rb-container ul.rb li {
            list-style: none;
            margin: auto;
            margin-left: 3em;
            min-height: 50px;
            border-left: 1px dashed #751d1c;
            padding: 0 0 50px 30px;
            position: relative;
        }

        .rb-container ul.rb li:last-child {
            border-left: 0;
        }

        .rb-container ul.rb li::before {
            position: absolute;
            left: -11px;
            top: -5px;
            content: " ";
            border: 8px solid #751d1c;
            border-radius: 500%;
            background: #ffff;
            height: 20px;
            width: 20px;
            transition: all 500ms ease-in-out;
        }

        .rb-container ul.rb li:hover::before {
            border-color: #232931;
            transition: all 1000ms ease-in-out;
        }

        ul.rb li .timestamp {
            color: #751d1c;
            position: relative;
            width: 100px;
            font-size: 12px;
        }

        .item-title {
            color: #232931;
        }
    </STYLE>
@endsection

@section('content')
    <style>
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        .return_product_css {
            width: 40%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @media only screen and (max-width: 768px) {

            /* For mobile phones: */
            .order_card_header {
                justify-content: end;
            }

            .rightbox {
                padding: 0;
                padding-right: 149px;
            }

            .tracking_button {
                border: 1px solid #751d1c;
                border-radius: 8px;
                width: 50%;
                padding: 3px;
                font-size: 13px;
                margin: 5px;
                background: #751d1c;
                color: #ffffff;
                font-size: 13px;
                height: 40px;
            }

            .modal-content {
                width: 100%;
            }

            .order_invoice_download {
                /* align-self: center; */
                /* padding: 0 70px; */
                /* margin: 0px 33px; */
                padding-right: 15px;
                margin-left: 47px;
                /* margin-right: 49px; */
            }

            .rb-container ul.rb {
                margin: 2.5em 0;
                padding: 0;
                display: inline-block;
                width: 200px !important;

            }
            .rb-container ul.rb li {
                margin-left: 0px;
            }
            .headings{
                padding-top: 20px;
            }
            .order_canceled_css.order_canceled_css.ps-3{
                padding-left: 3rem !important;
            }

        }

        @media only screen and (min-width: 768px) {
            .tracking_button {
                border: 1px solid #751d1c;
                border-radius: 8px;
                width: 17%;
                padding: 3px;
                font-size: 13px;
                margin: 5px;
                background: #751d1c;
                color: #ffffff;
                font-size: 13px;
                height: 40px;
            }

            .order_invoice_download {
                margin-bottom: 0 !important;
                padding-right: 13px !important;
                padding-left: 12px !important;
            }
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                    <span></span>My Account
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-4 pb-10">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link " id="dashboard-tab" href="{{ route('user.profile') }}"><i
                                                    class="fi-rs-user mr-10"></i>Account Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                                role="tab" aria-controls="orders" aria-selected="false"><i
                                                    class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"><i
                                                    class="fi-rs-sign-out mr-10"></i>Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content dashboard-content">
                                    <div class="tab-pane fade active show" id="orders" role="tabpanel"
                                        aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header"
                                                style="display: flex;
                                            justify-content: space-between;">
                                                <h5 class="mb-0">Your Orders</h5>
                                                <h5 class="mb-0">#{{ $order->unique_id }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="login-form-wrap">
                                                    <div class="order-detail-head p-2">
                                                        <div class="d-flex order_card_header" style="flex-wrap: wrap;">
                                                            <p class="side-line pe-3 mb-0">
                                                                {!! __('Orderd on <span>:date</span>', ['date' => date('d, M Y', strtotime($order->created_at))]) !!}
                                                            </p>
                                                            <div class="order_canceled_css ps-3 side-line pe-3">
                                                                @if ($order->status == 2 || $order->status == 3)
                                                                    <button>Cancel Order</button>
                                                                @else
                                                                    @php
                                                                        $ordercancel = App\Models\OrderCancel::where('order_id', $order->id)->first();
                                                                    @endphp
                                                                    @if ($ordercancel != null)
                                                                        @if ($order->id == $ordercancel->order_id)
                                                                            <button class="btn"
                                                                                onclick="openModal(1)">Cancel Order</button>
                                                                            <div id="myModal1" class="modal">
                                                                                <div class="modal-content">
                                                                                    <span class="close"
                                                                                        onclick="closeModal(1)">&times;</span>
                                                                                    <span
                                                                                        style="align-self: center;color: #751d1c;">This
                                                                                        Order is already Canceled</span>
                                                                                    <div class="card">
                                                                                        <div class="row m-3">
                                                                                            <div
                                                                                                class="col-lg-4 col-md-12 p-0">
                                                                                                <p><b
                                                                                                        style="font-weight: bolder;">Shipping
                                                                                                        Address</b></p>
                                                                                                <p class="mb-0">
                                                                                                    {{ $order->shipping_contact_name }}
                                                                                                </p>
                                                                                                <p class="mb-0">
                                                                                                    {{ $shipping_address->street }},
                                                                                                    {{ $shipping_address->landmark }}
                                                                                                </p>
                                                                                                <p class="mb-0">
                                                                                                    {{ $shipping_address->city }},
                                                                                                    {{ $shipping_address->state }},
                                                                                                    {{ $shipping_address->pincode }}
                                                                                                </p>
                                                                                                <p class="mb-0">
                                                                                                    {{ $shipping_address->country }}
                                                                                                </p>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-lg-4 col-md-12 p-0">
                                                                                                @php
                                                                                                    $get_payment = App\Models\Payment::where('order_id', $order->id)->first();
                                                                                                @endphp
                                                                                                <p><b
                                                                                                        style="font-weight: bolder;">Payment
                                                                                                        Method</b></p>
                                                                                                <p class="mb-0">
                                                                                                    {{ ucfirst($get_payment->payment_method) }}
                                                                                                </p>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-lg-4 col-md-12 p-0">
                                                                                                <p><b
                                                                                                        style="font-weight: bolder;">Order
                                                                                                        Summary</b></p>
                                                                                                <div class="d-flex">
                                                                                                    <div>
                                                                                                        <p class="mb-0">
                                                                                                            Subtotal:</p>
                                                                                                        <p class="mb-0">
                                                                                                            Discount:</p>
                                                                                                        <p class="mb-0">
                                                                                                            <b>Total:</b>
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    @if ($countryPrice == 'IN')
                                                                                                        <div
                                                                                                            class="ms-auto">
                                                                                                            <p
                                                                                                                class="mb-0">
                                                                                                                ₹{{ number_format($order->subtotal, 2, '.', ',') }}
                                                                                                            </p>
                                                                                                            <p
                                                                                                                class="mb-0">
                                                                                                                {{ $order->total_discount }}
                                                                                                            </p>
                                                                                                            <p
                                                                                                                class="mb-0">
                                                                                                                <b
                                                                                                                    style="font-weight: bolder;">₹{{ number_format($order->grand_total, 2, '.', ',') }}</b>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    @else
                                                                                                        <div
                                                                                                            class="ms-auto">
                                                                                                            <p
                                                                                                                class="mb-0">
                                                                                                                ${{ number_format($order->subtotal, 2, '.', ',') }}
                                                                                                            </p>
                                                                                                            <p
                                                                                                                class="mb-0">
                                                                                                                {{ $order->total_discount }}
                                                                                                            </p>
                                                                                                            <p
                                                                                                                class="mb-0">
                                                                                                                <b
                                                                                                                    style="font-weight: bolder;">${{ number_format($order->grand_total, 2, '.', ',') }}</b>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <hr
                                                                                            style="margin: 10px;border: 1px solid #e2e9e1;">
                                                                                        <div class="row m-3">
                                                                                            <div
                                                                                                class="col-lg-12 col-md-12 p-0">
                                                                                                <p><b
                                                                                                        style="font-weight: bolder;">Canceled
                                                                                                        Reason</b></p>
                                                                                                <span>{{ $ordercancel->reason }}</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @else
                                                                        <button class="btn"
                                                                            onclick="location.href='{{ route('orderCancle', encrypt($order->id)) }}'">Cancel
                                                                            Order</button>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            @if ($order->status == 2)
                                                                <p class="order_canceled_css mb-0 ps-3 side-line pe-3">
                                                                    <button class="btn"
                                                                        onclick="openOrderTrackModal()">Track Order</button>
                                                                <div id="trackmodal" class="modal">
                                                                    <div class="modal-content">
                                                                        <span class="close"
                                                                            onclick="closeOrderTrackModal()">&times;</span>
                                                                        <span
                                                                            style="align-self: center;color: #751d1c;font-weight: bold">Order
                                                                            Tracking</span>
                                                                        <div class="card">
                                                                            <div class="row m-3">
                                                                                <div class="col-lg-12 col-md-12 p-0">
                                                                                    <p>To track your order please Copy
                                                                                        Tracking Id And Open The link and
                                                                                        past and press "Track" button.</p>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-text"
                                                                                            style="background: #fff;min-width: 150px;max-width: 100%;"
                                                                                            id="traking_id">{{ $order->tracking_id }}</span>
                                                                                        <button
                                                                                            class="btn btn-outline-secondary"
                                                                                            type="button"
                                                                                            onclick="copyToClipboard('#traking_id')">
                                                                                            <i
                                                                                                class="fa-regular fa-copy"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                    <button class="tracking_button"
                                                                                        style="">
                                                                                        <a href="https://www.dtdc.in/tracking.asp"
                                                                                            target="_blank"
                                                                                            style="color: #fff">Open
                                                                                            Link</a>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </p>
                                                            @else
                                                                <p class="order_canceled_css mb-0 ps-3 side-line pe-3">
                                                                    <button>Track Order</button>
                                                                </p>
                                                            @endif
                                                            @if ($order->status == 3)
                                                                <p class="order_invoice_download order_canceled_css mb-0 side-line" style="">
                                                                    <a href="{{ route('download_invoice',$order->id) }}">
                                                                        <button class="btn">Download Invoice</button>
                                                                    </a>
                                                                </p>
                                                            @else
                                                                <p class="order_invoice_download mb-0 side-line"
                                                                    style="">
                                                                    <button>Download Invoice</button>
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="order-detail-bill">
                                                        <div class="card">
                                                            <div class="row m-3">
                                                                <div class="col-lg-4 col-md-12 p-0">
                                                                    <p><b style="font-weight: bolder;">Shipping Address</b>
                                                                    </p>
                                                                    <p class="mb-0">{{ $order->shipping_contact_name }}
                                                                    </p>
                                                                    <p class="mb-0">{{ $shipping_address->street }},
                                                                        {{ $shipping_address->landmark }}</p>
                                                                    <p class="mb-0">{{ $shipping_address->city }},
                                                                        {{ $shipping_address->state }},
                                                                        {{ $shipping_address->pincode }}</p>
                                                                    <p class="mb-0">{{ $shipping_address->country }}</p>
                                                                </div>
                                                                <div class="col-lg-4 col-md-12 p-0">
                                                                    <p class="headings"><b style="font-weight: bolder;">Payment Method</b>
                                                                    </p>
                                                                    @php
                                                                        $get_payment = App\Models\Payment::where('order_id', $order->id)->first();
                                                                    @endphp
                                                                    <p class="mb-0">
                                                                        {{ ucfirst($get_payment->payment_method) }}</p>
                                                                </div>
                                                                <div class="col-lg-4 col-md-12 p-0">
                                                                    <p class="headings"><b style="font-weight: bolder;">Order Summary</b>
                                                                    </p>
                                                                    <div class="d-flex">
                                                                        <div>
                                                                            <p class="mb-0">Subtotal:</p>
                                                                            <p class="mb-0">Discount:</p>
                                                                            <p class="mb-0"><b>Total:</b></p>
                                                                        </div>
                                                                        @if ($countryPrice == 'IN')
                                                                            <div class="ms-auto">
                                                                                <p class="mb-0">
                                                                                    ₹{{ number_format($order->subtotal, 2, '.', ',') }}
                                                                                </p>
                                                                                <p class="mb-0">
                                                                                    ₹{{ $order->total_discount }}</p>
                                                                                <p class="mb-0"><b
                                                                                        style="font-weight: bolder;">₹{{ number_format($order->grand_total, 2, '.', ',') }}</b>
                                                                                </p>
                                                                            </div>
                                                                        @else
                                                                            <div class="ms-auto">
                                                                                <p class="mb-0">
                                                                                    ${{ number_format($order->subtotal, 2, '.', ',') }}
                                                                                </p>
                                                                                <p class="mb-0">
                                                                                    ${{ $order->total_discount }}</p>
                                                                                <p class="mb-0"><b
                                                                                        style="font-weight: bolder;">${{ number_format($order->grand_total, 2, '.', ',') }}</b>
                                                                                </p>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @foreach ($OrderProduct as $product)
                                                        <div class="card mt-3">
                                                            <div class="order-list-detail">
                                                                <div class="row m-3">
                                                                    <div class="col-xl-9 p-0">
                                                                        <h5 class="mb-3">Delivered <span>Sunday</span>
                                                                        </h5>
                                                                        <div class="row">
                                                                            <div class="col-3">
                                                                                <img
                                                                                    src="{{ URL::asset('public/images/product/' . $product->getproductsData->thumbnail) }}">
                                                                            </div>
                                                                            <div class="col-9">
                                                                                <p class="mb-0">
                                                                                    <b style="font-weight: bolder;">{{ $product->getproductsData->name }}
                                                                                        x {{ $product->quantity }}</b>
                                                                                </p>
                                                                                <p class="mb-0">
                                                                                    Return eligible through
                                                                                    <span>{{ date('d, M Y', strtotime((new DateTime($order->delivered_at))->format('Y-m-d') . ' +3 days')) }}</span>
                                                                                </p>
                                                                                @if ($countryPrice == 'IN')
                                                                                    <p class="mb-0">
                                                                                        <span><b
                                                                                                style="font-weight: bolder;">₹{{ number_format($product->total_price, 2, '.', ',') }}</b>
                                                                                        </span>
                                                                                    </p>
                                                                                @else
                                                                                    <p class="mb-0">
                                                                                        <span><b
                                                                                                style="font-weight: bolder;">${{ number_format($product->total_price, 2, '.', ',') }}</b>
                                                                                        </span>
                                                                                    </p>
                                                                                @endif
                                                                                @php
                                                                                    $rating_count = App\Models\ProductReview::where('product_id', $product->getproductsData->id)->where('status',1)->count();
                                                                                    $total_rating = App\Models\ProductReview::where('product_id', $product->getproductsData->id)->where('status',1)->sum('rating');
                                                                                    if ($rating_count != 0 || $total_rating != 0) {
                                                                                        $avg_rating = $total_rating / $rating_count;
                                                                                    } else {
                                                                                        $avg_rating = '0';
                                                                                    }
                                                                                @endphp
                                                                                @php
                                                                                    $avg_percentage = $avg_rating * 20;
                                                                                @endphp
                                                                                <div style="display: flex">
                                                                                    <div class="product-rate"
                                                                                        style="display: flex;align-self: center;">
                                                                                        <div class="product-rating"
                                                                                            style="width:{{ round($avg_percentage, 1) }}%">
                                                                                        </div>
                                                                                    </div>
                                                                                    <span
                                                                                        style="align-self: flex-end;padding-left: 5px;">
                                                                                        <span>{{ round($avg_rating, 1) }}</span>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3">
                                                                        <div class="order-sublist">
                                                                            @if ($countryPrice == 'IN')
                                                                            @if ($order->status == 3)

                                                                                    @if (time() > strtotime($order->delivered_at . ' +3 days'))
                                                                                        @php
                                                                                            $product_return = App\Models\OrderReturn::where('order_id', $order->id)
                                                                                                ->where('order_product_id', $product->id)
                                                                                                ->first();
                                                                                        @endphp
                                                                                        @if ($product_return != null)
                                                                                            <button class="btn"
                                                                                                onclick="openReturnProductModal({{ $product_return->id }})">Return
                                                                                                items</button>
                                                                                            {{-- return product modal... --}}
                                                                                            <div id="returnProductModal{{ $product_return->id }}"
                                                                                                class="modal">
                                                                                                <div
                                                                                                    class="modal-content return_product_css">
                                                                                                    <span class="close"
                                                                                                        onclick="closeReturnProductModal({{ $product_return->id }})">&times;</span>
                                                                                                    <span
                                                                                                        style="align-self: center;color: #751d1c;">This
                                                                                                        Product is already
                                                                                                        Returned.</span>
                                                                                                    <div class="card">
                                                                                                        <div
                                                                                                            class="row m-3">
                                                                                                            <div
                                                                                                                class="col-lg-4 col-md-12 p-0">
                                                                                                                <img src="{{ URL::asset('public/images/product/' . $product->getproductsData->thumbnail) }}"
                                                                                                                    style="width: 200px">
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-lg-4 col-md-12">
                                                                                                                <b
                                                                                                                    style="font-weight: bolder;">{{ $product->getproductsData->name }}
                                                                                                                    x
                                                                                                                    {{ $product->quantity }}</b>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-lg-4 col-md-12">
                                                                                                                <p><b
                                                                                                                        style="font-weight: bolder;">Order
                                                                                                                        Summary</b>
                                                                                                                </p>
                                                                                                                <div
                                                                                                                    class="d-flex">
                                                                                                                    <div>
                                                                                                                        <p
                                                                                                                            class="mb-0">
                                                                                                                            <b>Total:</b>
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                    @if ($countryPrice == 'IN')
                                                                                                                        <div
                                                                                                                            class="ms-auto">
                                                                                                                            <p
                                                                                                                                class="mb-0">
                                                                                                                                <b
                                                                                                                                    style="font-weight: bolder;">₹{{ number_format($product->total_price, 2, '.', ',') }}</b>
                                                                                                                            </p>
                                                                                                                        </div>
                                                                                                                    @else
                                                                                                                        <div
                                                                                                                            class="ms-auto">
                                                                                                                            <p
                                                                                                                                class="mb-0">
                                                                                                                                <b
                                                                                                                                    style="font-weight: bolder;">${{ number_format($product->total_price, 2, '.', ',') }}</b>
                                                                                                                            </p>
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <hr
                                                                                                            style="margin: 10px;border: 1px solid #e2e9e1;">
                                                                                                        <div
                                                                                                            class="row m-3">
                                                                                                            <div
                                                                                                                class="col-lg-12 col-md-12 p-0">
                                                                                                                <p><b
                                                                                                                        style="font-weight: bolder;">Canceled
                                                                                                                        Reason</b>
                                                                                                                </p>
                                                                                                                <span>{{ $product_return->reason }}</span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <hr
                                                                                                            style="margin: 10px;border: 1px solid #e2e9e1;">
                                                                                                        <div
                                                                                                            class="row m-3">
                                                                                                            <div
                                                                                                                class="col-lg-6 col-md-12 p-0">
                                                                                                                <p><b
                                                                                                                        style="font-weight: bolder;">Status</b>
                                                                                                                </p>
                                                                                                                @if ($product_return->status == 'pending')
                                                                                                                    <span
                                                                                                                        class="badge badge-primary mb-1"
                                                                                                                        style="background-color: blue;width: 80px;
                                                                                                                                height: 29px;
                                                                                                                                display: inline-flex;
                                                                                                                                align-items: center;
                                                                                                                                justify-content: center;
                                                                                                                                font-size: 13px;">
                                                                                                                        Pending</span>
                                                                                                                @endif
                                                                                                                @if ($product_return->status == 'accept')
                                                                                                                    <span
                                                                                                                        class="badge badge-success mb-1"
                                                                                                                        style="background-color: green;width: 80px;
                                                                                                                                height: 29px;
                                                                                                                                display: inline-flex;
                                                                                                                                align-items: center;
                                                                                                                                justify-content: center;
                                                                                                                                font-size: 13px;">
                                                                                                                        Accept</span>
                                                                                                                @endif
                                                                                                                @if ($product_return->status == 'reject')
                                                                                                                    <span
                                                                                                                        class="badge badge-danger mb-1"
                                                                                                                        style="background-color: red;width: 80px;
                                                                                                                                height: 29px;
                                                                                                                                display: inline-flex;
                                                                                                                                align-items: center;
                                                                                                                                justify-content: center;
                                                                                                                                font-size: 13px;">
                                                                                                                        Reject</span>
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            @if ($product_return->status == 'reject')
                                                                                                                <div
                                                                                                                    class="col-lg-6 col-md-12 p-0">
                                                                                                                    <p><b
                                                                                                                            style="font-weight: bolder;">Reject
                                                                                                                            Reason</b>
                                                                                                                    </p>
                                                                                                                    <span>{{ $product_return->reject_reason }}</span>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <button>Return items</button>
                                                                                        @endif
                                                                                    @else
                                                                                        @php
                                                                                            $product_return = App\Models\OrderReturn::where('order_id', $order->id)
                                                                                                ->where('order_product_id', $product->id)
                                                                                                ->first();
                                                                                        @endphp
                                                                                        @if ($product_return != null)
                                                                                            <button class="btn"
                                                                                                onclick="openReturnProductModal({{ $product_return->id }})">Return
                                                                                                items</button>
                                                                                            {{-- return product modal... --}}
                                                                                            <div id="returnProductModal{{ $product_return->id }}"
                                                                                                class="modal">
                                                                                                <div
                                                                                                    class="modal-content return_product_css">
                                                                                                    <span class="close"
                                                                                                        onclick="closeReturnProductModal({{ $product_return->id }})">&times;</span>
                                                                                                    <span
                                                                                                        style="align-self: center;color: #751d1c;">This
                                                                                                        Product is already
                                                                                                        Returned.</span>
                                                                                                    <div class="card">
                                                                                                        <div
                                                                                                            class="row m-3">
                                                                                                            <div
                                                                                                                class="col-lg-4 col-md-12 p-0">
                                                                                                                <img src="{{ URL::asset('public/images/product/' . $product->getproductsData->thumbnail) }}"
                                                                                                                    style="width: 200px">
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-lg-4 col-md-12">
                                                                                                                <b
                                                                                                                    style="font-weight: bolder;">{{ $product->getproductsData->name }}
                                                                                                                    x
                                                                                                                    {{ $product->quantity }}</b>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="col-lg-4 col-md-12">
                                                                                                                <p><b
                                                                                                                        style="font-weight: bolder;">Order
                                                                                                                        Summary</b>
                                                                                                                </p>
                                                                                                                <div
                                                                                                                    class="d-flex">
                                                                                                                    <div>
                                                                                                                        <p
                                                                                                                            class="mb-0">
                                                                                                                            <b>Total:</b>
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                    @if ($countryPrice == 'IN')
                                                                                                                        <div
                                                                                                                            class="ms-auto">
                                                                                                                            <p
                                                                                                                                class="mb-0">
                                                                                                                                <b
                                                                                                                                    style="font-weight: bolder;">₹{{ number_format($product->total_price, 2, '.', ',') }}</b>
                                                                                                                            </p>
                                                                                                                        </div>
                                                                                                                    @else
                                                                                                                        <div
                                                                                                                            class="ms-auto">
                                                                                                                            <p
                                                                                                                                class="mb-0">
                                                                                                                                <b
                                                                                                                                    style="font-weight: bolder;">${{ number_format($product->total_price, 2, '.', ',') }}</b>
                                                                                                                            </p>
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <hr
                                                                                                            style="margin: 10px;border: 1px solid #e2e9e1;">
                                                                                                        <div
                                                                                                            class="row m-3">
                                                                                                            <div
                                                                                                                class="col-lg-12 col-md-12 p-0">
                                                                                                                <p><b
                                                                                                                        style="font-weight: bolder;">Canceled
                                                                                                                        Reason</b>
                                                                                                                </p>
                                                                                                                <span>{{ $product_return->reason }}</span>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <hr
                                                                                                            style="margin: 10px;border: 1px solid #e2e9e1;">
                                                                                                        <div
                                                                                                            class="row m-3">
                                                                                                            <div
                                                                                                                class="col-lg-6 col-md-12 p-0">
                                                                                                                <p><b
                                                                                                                        style="font-weight: bolder;">Status</b>
                                                                                                                </p>
                                                                                                                @if ($product_return->status == 'pending')
                                                                                                                    <span
                                                                                                                        class="badge badge-primary mb-1"
                                                                                                                        style="background-color: blue;width: 80px;
                                                                                                                                height: 29px;
                                                                                                                                display: inline-flex;
                                                                                                                                align-items: center;
                                                                                                                                justify-content: center;
                                                                                                                                font-size: 13px;">
                                                                                                                        Pending</span>
                                                                                                                @endif
                                                                                                                @if ($product_return->status == 'accept')
                                                                                                                    <span
                                                                                                                        class="badge badge-success mb-1"
                                                                                                                        style="background-color: green;width: 80px;
                                                                                                                                height: 29px;
                                                                                                                                display: inline-flex;
                                                                                                                                align-items: center;
                                                                                                                                justify-content: center;
                                                                                                                                font-size: 13px;">
                                                                                                                        Accept</span>
                                                                                                                @endif
                                                                                                                @if ($product_return->status == 'reject')
                                                                                                                    <span
                                                                                                                        class="badge badge-danger mb-1"
                                                                                                                        style="background-color: red;width: 80px;
                                                                                                                                height: 29px;
                                                                                                                                display: inline-flex;
                                                                                                                                align-items: center;
                                                                                                                                justify-content: center;
                                                                                                                                font-size: 13px;">
                                                                                                                        Reject</span>
                                                                                                                @endif
                                                                                                            </div>
                                                                                                            @if ($product_return->status == 'reject')
                                                                                                                <div
                                                                                                                    class="col-lg-6 col-md-12 p-0">
                                                                                                                    <p><b
                                                                                                                            style="font-weight: bolder;">Reject
                                                                                                                            Reason</b>
                                                                                                                    </p>
                                                                                                                    <span>{{ $product_return->reject_reason }}</span>
                                                                                                                </div>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            <button class="btn"
                                                                                                onclick="location.href='{{ route('productReturn', encrypt($product->id)) }}'">Request
                                                                                                To Return</button>
                                                                                        @endif
                                                                                    @endif
                                                                                @else
                                                                                    <button>Request To Return</button>
                                                                                @endif
                                                                                @endif
                                                                                @if ($order->status == 3)
                                                                                    @php
                                                                                        $check_product_review = App\Models\ProductReview::where('user_id',auth()->user()->id)->where('product_id',$product->getproductsData->id)->first();
                                                                                    @endphp
                                                                                    @if ($check_product_review)
                                                                                    <button class="btn"
                                                                                        onclick="location.href='{{ route('editReview', encrypt($product->getproductsData->id)) }}'">Edit
                                                                                        a product review</button>
                                                                                    @else
                                                                                        <button class="btn"
                                                                                        onclick="location.href='{{ route('productReview', encrypt($product->getproductsData->id)) }}'">Write
                                                                                        a product review</button>
                                                                                    @endif
                                                                                @else
                                                                                    <button>Write a product review</button>
                                                                                @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="card mt-3">
                                                        <div class="p-3">
                                                            <span
                                                                style="font-size: 14px;font-family: Spartan, sans-serif;color: #222222;font-weight: 600;
                                                             line-height: 1.2;">Order
                                                                Tracker</span>: <span> &nbsp; Each step of the way, we
                                                                strive to provide exceptional service and ensure your
                                                                shopping experience with Sajh Dhaj Ke is delightful. Should
                                                                you require any further assistance or have any questions,
                                                                our dedicated team is available to assist you.</span>
                                                        </div>
                                                        <div class="rightbox">
                                                            <div class="rb-container">
                                                                <ul class="rb">
                                                                    <li class="rb-item" ng-repeat="itembx">
                                                                        <div class="timestamp">
                                                                            {{ date('d, M Y', strtotime($order->created_at)) }}<br>
                                                                            {{ date('g:i A', strtotime($order->created_at)) }}
                                                                        </div>
                                                                        <div class="item-title"><span
                                                                                style="font-family: Spartan, sans-serif;color: #222222;font-weight: 600;line-height: 1.2;
                                                                    font-size: 13px;">Orderd:</span>
                                                                            <span>Thank you for your order! We truly
                                                                                appreciate your trust in Sajh Dhaj Ke. Our
                                                                                team is working diligently to process and
                                                                                prepare your items for shipment. If you have
                                                                                any questions or need any assistance
                                                                                regarding your order, please don't hesitate
                                                                                to reach out to us.</span></div>

                                                                    </li>
                                                                    @if ($order->status == 1 || $order->confirmed_at != null)
                                                                        <li class="rb-item" ng-repeat="itembx">
                                                                            <div class="timestamp">
                                                                                {{ date('d, M Y', strtotime($order->confirmed_at)) }}<br>
                                                                                {{ date('g:i A', strtotime($order->confirmed_at)) }}
                                                                            </div>
                                                                            <div class="item-title"><span
                                                                                    style="font-family: Spartan, sans-serif;color: #222222;font-weight: 600;line-height: 1.2;
                                                                    font-size: 13px;">Confirmed:</span>
                                                                                <span> Congratulations! Your order has been
                                                                                    confirmed. We will dispatch it as soon
                                                                                    as possible. If you have any queries or
                                                                                    questions, please feel free to contact
                                                                                    us.</span></div>
                                                                        </li>
                                                                    @endif
                                                                    @if ($order->status == 2 || $order->shipped_at != null)
                                                                        <li class="rb-item" ng-repeat="itembx">
                                                                            <div class="timestamp">
                                                                                {{ date('d, M Y', strtotime($order->shipped_at)) }}<br>
                                                                                {{ date('g:i A', strtotime($order->shipped_at)) }}
                                                                            </div>
                                                                            <div class="item-title"><span
                                                                                    style="font-family: Spartan, sans-serif;color: #222222;font-weight: 600;line-height: 1.2;
                                                                    font-size: 13px;">Shipped:</span>
                                                                                <span> Great news! Your order has been
                                                                                    shipped. It's on its way to you. Keep an
                                                                                    eye out for the tracking information we
                                                                                    provided. If you have any further
                                                                                    inquiries, our customer support team is
                                                                                    here to assist you.</span></div>
                                                                        </li>
                                                                    @endif
                                                                    @if ($order->status == 3)
                                                                        <li class="rb-item" ng-repeat="itembx">
                                                                            <div class="timestamp">
                                                                                {{ date('d, M Y', strtotime($order->delivered_at)) }}<br>
                                                                                {{ date('g:i A', strtotime($order->delivered_at)) }}
                                                                            </div>
                                                                            <div class="item-title"><span
                                                                                    style="font-family: Spartan, sans-serif;color: #222222;font-weight: 600;line-height: 1.2;
                                                                    font-size: 13px;">Delivered:</span>
                                                                                <span>Hooray! Your order has been
                                                                                    successfully delivered. We hope you love
                                                                                    your new purchase. If you have any
                                                                                    feedback or need assistance, don't
                                                                                    hesitate to reach out to us. We value
                                                                                    your satisfaction and are always ready
                                                                                    to help.</span>
                                                                            </div>
                                                                        </li>
                                                                    @else
                                                                        @if ($order->status == 4)
                                                                            <li class="rb-item" ng-repeat="itembx">
                                                                                @php
                                                                                    $ordercancel = App\Models\OrderCancel::where('order_id', $order->id)->first();
                                                                                @endphp
                                                                                <div class="timestamp">
                                                                                    {{ date('d, M Y', strtotime($order->canceled_at)) }}<br>
                                                                                    {{ date('g:i A', strtotime($order->canceled_at)) }}
                                                                                </div>
                                                                                <div class="item-title"><span
                                                                                        style="font-family: Spartan, sans-serif;color: #222222;font-weight: 600;line-height: 1.2;
                                                                        font-size: 13px;">Order
                                                                                        is Canceled:</span> <span>We regret
                                                                                        to inform you that your order has
                                                                                        been canceled from
                                                                                        @if ($ordercancel->user_id == 1)
                                                                                            the Sajh Dhaj Ke Admin side
                                                                                        @else
                                                                                            You
                                                                                        @endif . If you have any
                                                                                        questions or concerns regarding the
                                                                                        cancellation, please feel free to
                                                                                        contact us. Our customer support
                                                                                        team is here to assist you and
                                                                                        address any inquiries you may have.
                                                                                        We apologize for any inconvenience
                                                                                        caused and appreciate your
                                                                                        understanding. Thank you for
                                                                                        considering Sajh Dhaj Ke for your
                                                                                        South-Asian fashion needs.</span>
                                                                                </div>
                                                                            </li>
                                                                        @else
                                                                            <li class="rb-item" ng-repeat="itembx">
                                                                                <div class="timestamp">
                                                                                    {{ date('d, M Y', strtotime((new DateTime($order->confirmed_at))->format('Y-m-d') . ' +5 days')) }}<br>
                                                                                    7:00 PM
                                                                                </div>
                                                                                <div class="item-title"><span
                                                                                        style="font-family: Spartan, sans-serif;color: #222222;font-weight: 600;line-height: 1.2;
                                                                    font-size: 13px;">Delivered
                                                                                        On:</span> <span>We are delighted to
                                                                                        notify you that your item has been
                                                                                        successfully delivered within the
                                                                                        estimated timeframe of 5-7 days,
                                                                                        depending on your order date. We
                                                                                        hope it arrived in a timely manner
                                                                                        and meets your expectations. Should
                                                                                        you have any questions or concerns,
                                                                                        please do not hesitate to contact
                                                                                        us. Our dedicated team is available
                                                                                        to assist you. Thank you for
                                                                                        choosing Sajh Dhaj Ke for your
                                                                                        South-Asian fashion needs.</span>
                                                                                </div>
                                                                            </li>
                                                                        @endif
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script  async>
        function openModal(id) {
            document.getElementById('myModal' + id).style.display = "block";
        }

        function closeModal(id) {
            document.getElementById('myModal' + id).style.display = "none";
        }
    </script>

    <script  async>
        function openReturnProductModal(id) {
            document.getElementById('returnProductModal' + id).style.display = "block";
        }

        function closeReturnProductModal(id) {
            document.getElementById('returnProductModal' + id).style.display = "none";
        }
    </script>

    <script  async>
        function openOrderTrackModal(id) {
            document.getElementById('trackmodal').style.display = "block";
        }

        function closeOrderTrackModal(id) {
            document.getElementById('trackmodal').style.display = "none";
        }
    </script>

    <script  async>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();

            toastr.success('Tracking ID is Copied.');
        }
    </script>
@endsection
