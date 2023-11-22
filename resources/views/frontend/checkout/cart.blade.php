@extends('frontend.layouts.fullLayoutMaster')

@section('content')
<style>
    table td.out-of-stock {
  position: relative; /* Required for absolute positioning */
}

table td.out-of-stock::after {
  content: "Out of Stock";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(245, 236, 236, 0.5);
  color: black;
  display: flex;
  justify-content: center;
  align-items: center;
  font-weight: bold;
  font-size: 16px;
}

@media only screen and (max-width: 768px) {
    .checkout_button{
        width: 100%;
    }
    table.clean tbody tr td:first-child{
        border-top: 3px solid #e2e9e1;
    }
}
</style>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Your Cart
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (!empty($cartData) && count($cartData) > 0)
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartData as $product)
                                <tr>
                                    <td class="image product-thumbnail "><img src="{{ URL::asset('public/images/product/'.$product->getCartInformation->thumbnail)}}" alt="#"></td>
                                    <td class="product-des product-name">
                                        <h5 class="product-name"><a href="{{ route('user.shop-detail',$product->getCartInformation->slug) }}">{{ Str::of($product->getCartInformation->name)->limit(40, '...') }}</a></h5>
                                        <p class="font-xs">{{ $product->getCartInformation->category->name }}/{{ $product->getCartInformation->subcategory->name }}<br>
                                        </p>
                                    </td>
                                    @if ($countryPrice == 'IN')
                                        <td class="price" data-title="Price"><span>₹{{ $product->getCartInformation->original_price }} </span></td>
                                    @else
                                        <td class="price" data-title="Price"><span>${{ $product->getCartInformation->original_price_dollar }} </span></td>
                                    @endif
                                    @if ($countryPrice == 'IN')
                                        <td class="text-center" data-title="Quantity">
                                            <div class="detail-qty border radius  m-auto">
                                                <span class="qty-val{{ $product->id }}">{{ $product->quantity }}</span>
                                            </div>
                                        </td>
                                    @else
                                        <td class="text-center" data-title="Quantity">
                                            <div class="detail-qty border radius  m-auto">
                                                <span class="qty-val{{ $product->id }}">{{ $product->quantity }}</span>
                                            </div>
                                        </td>
                                    @endif
                                    @if ($countryPrice == 'IN')
                                        <td data-title="Discount">
                                            @php
                                                $product_discount_total =  $product->getCartInformation->discount_price * $product->quantity;
                                                $all_product_discount_total[] =  $product->getCartInformation->discount_price * $product->quantity;
                                            @endphp
                                            <span>₹<span class="product_total_discount{{ $product->id }}">{{ number_format($product_discount_total, 2, '.', ',') }}</span></span>
                                        </td>
                                    @else
                                        <td data-title="Discount">
                                            @php
                                                $product_discount_total =  $product->getCartInformation->discount_price_dollar * $product->quantity;
                                                $all_product_discount_total[] =  $product->getCartInformation->discount_price_dollar * $product->quantity;
                                            @endphp
                                            <span>$<span class="product_total_discount{{ $product->id }}">{{ number_format($product_discount_total, 2, '.', ',') }}</span></span>
                                        </td>
                                    @endif
                                    @if ($countryPrice == 'IN')
                                        <td class="text-right" data-title="Subtotal">
                                            @php
                                            $product_sub_total =  $product->getCartInformation->selling_price * $product->quantity;
                                            @endphp
                                            <span>₹<span id="single_product_price{{ $product->id }}">{{ number_format($product_sub_total, 2, '.', ',') }}</span></span>
                                        </td>
                                    @else
                                        <td class="text-right" data-title="Subtotal">
                                            @php
                                            $product_sub_total =  $product->getCartInformation->selling_price_dollar * $product->quantity;
                                            @endphp
                                            <span>$<span id="single_product_price{{ $product->id }}">{{ number_format($product_sub_total, 2, '.', ',') }}</span></span>
                                        </td>
                                    @endif
                                    <td class="action" data-title="Remove"><a href="{{ route('user.remove-cart',encrypt($product->id)) }}" class="text-muted"><i class="fi-rs-trash"></i></a></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="8" class="text-end">
                                        <a href="{{ route('user.clear-cart') }}" class="text-muted"> <i class="fi-rs-cross-small"></i> Clear Cart</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                            @else
                            <div class="row">
                                <div class="col-lg-4 col-md-2">
                                </div>
                                    <div class="col-lg-4 col-md-2 text-center">
                                        <img src="{{ asset('public/frontend\assets\imgs\banner\empty_cart_red.png') }}" alt="" >
                                    <h3>Your Cart is Empty</h3>
                                </div>
                                <div class="col-lg-4 col-md-2">
                                </div>
                            </div>
                    </div>
                    <div class="cart-action text-center mt-15">
                        <a class="btn " href="{{ route('user.shop') }}"><i class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                    </div>
                    @endif
                    @if (!empty($cartData) && count($cartData) > 0)
                    <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                    <div class="mb-50" style="padding: 0;">
                        <div class="col-lg-6 col-md-12"></div>
                        <div class="col-lg-6 col-md-12">
                            <div class="border p-md-4 p-30 border-radius cart-totals">
                                <div class="heading_s1 mb-3">
                                    <h4>Cart Totals</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    @if ($countryPrice == 'IN')
                                                        <td class="cart_total_amount"><span class="font-lg fw-900 text-brand" id="cart_product_subtotal">₹{{ number_format($cart_product_total, 2, '.', ',') }}</span></td>
                                                    @else
                                                        <td class="cart_total_amount"><span class="font-lg fw-900 text-brand" id="cart_product_subtotal">${{ number_format($cart_product_total, 2, '.', ',') }}</span></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Shipping</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Free Shipping</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    @if ($countryPrice == 'IN')
                                                        <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand" id="cart_product_total">₹{{ number_format($cart_product_total, 2, '.', ',') }}</span></strong></td>
                                                    @else
                                                        <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand" id="cart_product_total">${{ number_format($cart_product_total, 2, '.', ',') }}</span></strong></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Save Money</td>
                                                    @if ($countryPrice == 'IN')
                                                        <td class="cart_total_amount font-xl fw-900 text-brand"> <i class="ti-gift mr-5"></i> <span style="color: green" id="cart_product_total_discount">₹{{ number_format(array_sum($all_product_discount_total), 2, '.', ',') }}</span> </td>
                                                    @else
                                                        <td class="cart_total_amount font-xl fw-900 text-brand"> <i class="ti-gift mr-5"></i> <span style="color: green" id="cart_product_total_discount">${{ number_format(array_sum($all_product_discount_total), 2, '.', ',') }}</span> </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ route('user.checkout') }}" class="btn checkout_button"> <i class="fi-rs-box-alt mr-10"></i> Proceed To CheckOut</a>
                                </div>
                            </div>
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('page-script')

<script src="{{ asset('public/frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
@foreach ($cartData as $product)
    <script  async>

            $('.qty-up{{ $product->id }}').on('click', function (event) {
                var qtyval = $('.qty-val{{ $product->id }}').text();
                event.preventDefault();
                qtyval = parseInt(qtyval) + 1;
                if (qtyval < 6) {
                    $(this).prev().text(qtyval);
                }
            });
            $('.qty-down{{ $product->id }}').on('click', function (event) {
                var qtyval = $('.qty-val{{ $product->id }}').text();
                event.preventDefault();
                qtyval = parseInt(qtyval) - 1;
                if (qtyval > 1) {
                    $(this).next().text(qtyval);
                } else {
                    qtyval = 1;
                    $(this).next().text(qtyval);
                }
            });
    </script>

    <script  async>
        $('.qty-up{{ $product->id }}').on('click', function(event){
            var qtyval = $('.qty-val{{ $product->id }}').text();
            qtyval = parseInt(qtyval);
            if (qtyval < 5) {
                var pro_id = $(this).attr('product_id');
                var product_price = $(this).attr('product_price');
                var checkType = $(this).attr('checkType');
                var total = $('#single_product_price'+ pro_id).text();
                var product_plus = product_price*1;
                var final=product_plus+parseInt(total);
                $('#single_product_price'+ pro_id).text(final.toFixed(2));
                var product_discount_price = $(this).attr('product_discount_price');
                var get_discount = $('.product_total_discount'+ pro_id).text();
                var total_product_discount = parseFloat(get_discount) + parseFloat(product_discount_price);
                $('.product_total_discount'+ pro_id).text(total_product_discount.toFixed(2));
                var quantity = $('.qty-val{{ $product->id }}').text();
                // alert(quantity);
                $.ajax({
                    type: "GET",
                    url: "{{ route('user.product_qty_inc') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": pro_id,
                        "checktype": checkType,
                        "quantity": quantity
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.result) {
                            toastr.error(data.message);
                        } else {
                            // alert(data.total_discount);
                            $('#cart_product_subtotal').text('₹' + data.total_value.toFixed(2));
                            $('#cart_product_total').text('₹' + data.total_value.toFixed(2));
                            $('#cart_product_total_discount').text('₹' + data.total_discount.toFixed(2));
                        }
                    }
                });
            }
        });
    </script>

    <script  async>
        $('.qty-down{{ $product->id }}').on('click', function(){
        var pro_id = $(this).attr('product_id');
        var quantity = $('.qty-val{{ $product->id }}').text();
        var checkType = $(this).attr('checkType');
        if (parseInt(quantity) > 1 || parseInt(quantity) == 1) {
            var quantity = parseInt(quantity);
            var product_price = $(this).attr('product_price');
            var final=product_price*quantity;
            $('#single_product_price'+ pro_id).text(final.toFixed(2));
            var product_discount_price = $(this).attr('product_discount_price');
            var get_discount = $('.product_total_discount'+ pro_id).text();
            var total_product_discount = parseFloat(get_discount) - parseFloat(product_discount_price);
            $('.product_total_discount'+ pro_id).text(total_product_discount.toFixed(2));
            $.ajax({
                type: "GET",
                url: "{{ route('user.product_qty_inc') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": pro_id,
                    "checktype": checkType
                },
                dataType: 'json',
                success: function(data) {
                    $('#cart_product_subtotal').text('₹' + data.total_value.toFixed(2));
                    $('#cart_product_total').text('₹' + data.total_value.toFixed(2));
                    $('#cart_product_total_discount').text('₹' + data.total_discount.toFixed(2));
                }

            });
        }
    });
    </script>

@endforeach


@endsection
