@extends('frontend.layouts.fullLayoutMaster')

@section('page-style')
    <style>
        .confirm-summary {
    margin-top: 60px;
}

.confirm-head h1 {
    color: #008000;
}

.confirm-text,
.confirm-head .d-flex {
    width: 70%;
    margin: 0 auto;
    justify-content: center;
}

.confirm-address i,
.confirm-head i {
    font-size: 23px;
    color: #ad9144;
}

@media only screen and (max-width: 768px) {
  /* For mobile phones: */
  img {
    width: 79px;
  }
  .row .image_tag{
    width: 35%;
  }
  .row .name_tag{
    width: 65%;
  }
}
@media only screen and (min-width: 768px) {
    img {
    width: 130px;
  }
}
    </style>
@endsection


@section('content')
    <main class="main">
        <div class="container">
            <div class="row gx-5">
                <div class="confirm-head text-center mt-4">
                    <h1 class="mb-3">Thank You!</h1>
                    <h4>Yor Order #{{ $order->unique_id }} has been placed!</h4>
                    <p class="confirm-text">
                        We sent an email to <b>{{ auth()->user()->email }}</b> with your order confirmation and receipt. if the
                        email hasn't arrived within two minute, please check your spam folder to see if the email was routed
                        there.
                    </p>
                    <div class="d-flex">
                        <i class="ri-time-line"></i>
                        <p>
                            <b class="ps-1">Time Placed :-</b> <span>{{date('d-m-Y h:i:s',strtotime($order->created_at))}}</span>
                        </p>
                    </div>
                </div>

                <div class="confirm-detail">
                    <div class="confirm-address m-3">
                        <div class="row">
                            <div class="col-sm-4 card p-3 mt-3">
                                <i class="ri-map-pin-line"></i>
                                <h5 class="mt-2">Shipping Details</h5>
                                <p class="m-0">{{$order->shipping_contact_name}}</p>
                                <p class="m-0">{{$shipping_address->street}}</p>
                                <p class="m-0">{{$shipping_address->landmark}}</p>
                                <p class="m-0">{{$shipping_address->city}}, {{$shipping_address->state}}, {{$shipping_address->pincode}}</p>
                                <p class="m-0">{{$order->country}}</p>
                                <p class="m-0">{{$order->shipping_contact_number}}</p>
                            </div>
                            <div class="col-sm-4 card p-3 mt-3">
                                <i class="ri-bill-line"></i>
                                <h5 class="mt-2">Billing Details</h5>
                                <p class="m-0">{{$order->billing_contact_name}}</p>
                                <p class="m-0">{{$billing_address->street}}</p>
                                <p class="m-0">{{$billing_address->landmark}}</p>
                                <p class="m-0">{{$billing_address->city}}, {{$billing_address->state}}, {{$billing_address->pincode}}</p>
                                <p class="m-0">{{$order->country}}</p>
                                <p class="m-0">{{$order->billing_contact_number}}</p>
                            </div>
                            <div class="col-sm-4 card p-3 mt-3">
                                @php
                                    $get_payment = App\Models\Payment::where('order_id',$order->id)->first();
                                @endphp
                                <i class="ri-truck-line"></i>
                                <h5 class="mt-2">Payment Method</h5>
                                <p>{{ucfirst($get_payment->payment_method)}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="confirm-list mt-5">
                        <div class="row">
                            <div class="col-md-8 mt-3">
                                <h4>Product List</h4>
                                <hr>
                                @foreach ($OrderProduct as $product)

                                <div class="card p-2 mt-3">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 image_tag">
                                            <img src="{{ URL::asset('public/images/product/'.$product->getproductsData->thumbnail)}}" >
                                        </div>
                                        @php
                                            $rating_count = App\Models\ProductReview::where('product_id',$product->getproductsData->id)->where('status',1)->count();
                                            $total_rating = App\Models\ProductReview::where('product_id',$product->getproductsData->id)->where('status',1)->sum('rating');
                                            if($rating_count != 0 || $total_rating != 0){
                                                $avg_rating = $total_rating/$rating_count;
                                            }
                                            else{
                                                $avg_rating = '0';
                                            }
                                        @endphp
                                        @php
                                            $avg_percentage = $avg_rating * 20;
                                        @endphp
                                        <div class="col-lg-6 col-md-6 name_tag">
                                            <p class="m-0">
                                                <a href="{{ route('user.shop-detail',$product->getproductsData->slug) }}"><b>{{ $product->getproductsData->name }}</b></a>
                                                <p class="font-xs">{{ $product->getproductsData->category->name }}/{{ $product->getproductsData->subcategory->name }}<br>
                                                </p>
                                                <div style="display: flex">
                                                    <div class="product-rate" style="display: flex;align-self: center;">
                                                        <div class="product-rating" style="width:{{ round($avg_percentage,1) }}%">
                                                        </div>
                                                    </div>
                                                    <span style="align-self: flex-end;padding-left: 5px;">
                                                        <span>{{ round($avg_rating,1) }}</span>
                                                    </span>
                                                </div>
                                            </p>
                                        </div>
                                        <div class="col-lg-3 col-md-8 text-end">
                                            <div class="d-flex">
                                                <div>
                                                    <p class="mb-1"><b>Price :</b></p>
                                                    <p class="mb-1"><b>Qty :</b></p>
                                                    <p class="mb-1"><b>Discount :</b></p>
                                                    <p class="mb-1"><b>Total :</b></p>
                                                </div>
                                                @if ($countryPrice == 'IN')
                                                    <div class="confirm-list ms-4">
                                                        <p class="mb-1"><b>₹{{ number_format($product->price, 2, '.', ',') }}</b></p>
                                                        <p class="mb-1 text-center"><b>{{ $product->quantity }}</b></p>
                                                        <p class="mb-1"><b>₹{{number_format($product->discount,2)}}</b></p>
                                                        <p class="mb-1"><b>₹{{ number_format($product->total_price, 2, '.', ',') }}</b></p>
                                                    </div>
                                                @else
                                                    <div class="confirm-list ms-4">
                                                        <p class="mb-1"><b>${{ number_format($product->price, 2, '.', ',') }}</b></p>
                                                        <p class="mb-1 text-center"><b>{{ $product->quantity }}</b></p>
                                                        <p class="mb-1"><b>${{number_format($product->discount,2)}}</b></p>
                                                        <p class="mb-1"><b>${{ number_format($product->total_price, 2, '.', ',') }}</b></p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-4">
                                <div class="card confirm-summary p-3">
                                    <h4 class="mb-0">Order Summary</h4>
                                    <hr>
                                    <div class="d-flex">
                                        <div>
                                            <p class="mb-0">Subtotal:</p>
                                            <p class="mb-0">Discount:</p>
                                        </div>
                                        @if ($countryPrice == 'IN')
                                            <div class="ms-auto">
                                                <p class="mb-0">₹{{ number_format($order->subtotal, 2, '.', ',') }}</p>
                                                <p class="mb-0">₹{{number_format($order->total_discount,2)}}</p>
                                            </div>
                                        @else
                                            <div class="ms-auto">
                                                <p class="mb-0">${{ number_format($order->subtotal, 2, '.', ',') }}</p>
                                                <p class="mb-0">${{number_format($order->total_discount,2)}}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="d-flex">
                                        <div>
                                            <p class="mb-0"><b>Total</b></p>
                                        </div>
                                        @if ($countryPrice == 'IN')
                                            <div class="ms-auto">
                                                <p class="mb-0"><b>₹{{ number_format($order->grand_total, 2, '.', ',') }}</b></p>
                                            </div>
                                        @else
                                            <div class="ms-auto">
                                                <p class="mb-0"><b>${{ number_format($order->grand_total, 2, '.', ',') }}</b></p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="others-options lg-none justify-content-center d-flex mt-5 mb-60">
                        <a href="{{ route('user.shop') }}" class="btn style2">CONTINUE SHOPPING</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
