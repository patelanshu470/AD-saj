@extends('frontend.layouts.fullLayoutMaster')



@section('page-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .error {
            color: #ea5455;
        }

        .cust_btn {
            width: 40%;
            outline: 0 !important;
            height: 45px;
            font-size: 16px;
            background-color: #751d1c !important;
            border: none;
            color: white;
            border-radius: 5px;

        }

        #payment_form {
            text-align: center;
        }

        .razorpay-payment-button {
            display: none;
        }

        .preloader {
            opacity: 90%;
        }

        .loader {
            margin-left: 40%;
        }
        @media only screen and (max-width: 480px)
        {
            .table td {
                display: table-cell;
                width: 100%;
                text-align: center;
            }
        }
        form .card-header{
            background-color: #f1e8e8 !important;
        }
        form .card-footer{
            background-color: #f1e8e8 !important;
        }
    </style>
@endsection


@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Checkout
                    <span></span> Payment
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">



            <div class="container-fluid">

                <div class="row " style="justify-content: center;">

                    @if (!empty($cartData) && count($cartData) > 0)

                        <div class="col-md-6">
                            <div class="order_review">
                                <div class="mb-20">
                                    <h4>Payment Details</h4>
                                </div>
                                <div class="table-responsive order_table text-center">
                                    <table class="table">

                                        @if (!empty($cartData) && count($cartData) > 0)
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Product</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cartData as $product)
                                                    <tr>
                                                        <td class="image product-thumbnail"><img
                                                                src="{{ URL::asset('public/images/product/' . $product->getCartInformation->thumbnail) }}"
                                                                alt="#"></td>
                                                        <td>
                                                            <h5><a
                                                                    href="{{ route('user.shop-detail',$product->getCartInformation->slug) }}">{{ Str::of($product->getCartInformation->name)->limit(30, '...') }}</a>
                                                            </h5>
                                                            @if ($countryPrice == 'IN')
                                                                <span class="product-qty">₹{{ $product->getCartInformation->selling_price }}
                                                                    x {{ $product->quantity }}</span>
                                                            @else
                                                                <span class="product-qty">${{ $product->getCartInformation->selling_price_dollar }}
                                                                    x {{ $product->quantity }}</span>
                                                            @endif
                                                        </td>
                                                        @if ($countryPrice == 'IN')
                                                            @php
                                                                $product_sub_total = $product->getCartInformation->selling_price * $product->quantity;
                                                            @endphp
                                                            <td>₹{{ number_format($product_sub_total, 2, '.', ',') }}</td>
                                                        @else
                                                            @php
                                                                $product_sub_total = $product->getCartInformation->selling_price_dollar * $product->quantity;
                                                            @endphp
                                                            <td>${{ number_format($product_sub_total, 2, '.', ',') }}</td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th>SubTotal</th>
                                                    @if ($countryPrice == 'IN')
                                                        <td class="product-subtotal" colspan="2">
                                                            ₹{{ number_format($cart_product_total, 2, '.', ',') }}</td>
                                                    @else
                                                        <td class="product-subtotal" colspan="2">
                                                            ${{ number_format($cart_product_total, 2, '.', ',') }}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th>Shipping</th>
                                                    <td colspan="2"><em>Free Shipping</em></td>
                                                </tr>
                                                <tr>
                                                    <th>Total</th>
                                                    @if ($countryPrice == 'IN')
                                                        <td colspan="2" class="product-subtotal"><span
                                                                class="font-xl text-brand fw-900">₹{{ number_format($cart_product_total, 2, '.', ',') }}</span>
                                                        </td>
                                                    @else
                                                        <td colspan="2" class="product-subtotal"><span
                                                            class="font-xl text-brand fw-900">${{ number_format($cart_product_total, 2, '.', ',') }}</span>
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        @endif
                                    </table>
                                </div>
                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                {{-- <form action="{{ route('phonePay') }}" id="payment_form"
                                    method="get"> --}}
                                    {{-- <input type="hidden" name="order_id" id="" value="{{ $order_id }}"> --}}
                                    {{-- <a href="{{ route('phonePay') }}">
                                        <button class="cust_btn" id="">
                                            <i class="fas fa-money-bill-wave"></i> Pay Now
                                        </button>
                                    </a> --}}
                                {{-- </form> --}}
                                {{-- <a href="{{ route('phonePay') }}">paye</a> --}}

                                @if ($countryPrice == 'IN')
                                <div style="text-align: center;">
                                    <a href="{{ route('phonePay',$order_id) }}">
                                        <button class="btn btn-primary">Pay Now</button>
                                    </a>
                                </div>
                                @else
                                    <form action="{{ route('razorpay.payment.store', $order_id) }}"  method="post" id="payment-form">
                                        @csrf
                                        <div class="form-group">
                                            <div class="card-header">
                                                <label for="card-element">
                                                    Enter your debit and credit card information
                                                </label>
                                            </div>
                                            <div class="card-body">
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>
                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>
                                                <input type="hidden" name="plan" value="" />
                                            </div>
                                        </div>
                                        <input type="text" name="payment_id" value="{{ $payment_id }}" hidden>
                                        <div class="card-footer">
                                            <button
                                            id="card-button"
                                            class="btn btn-dark"
                                            type="submit"
                                            data-secret="{{ $intent }}"
                                            > Pay </button>
                                        </div>
                                    </form>
                                @endif
                            </div>

                        </div>
                    @else
                        <div class="row">
                            <div class="col-lg-4 col-md-2">
                            </div>
                            <div class="col-lg-4 col-md-2 text-center">
                                <img src="{{ asset('public/frontend\assets\imgs\banner\empty_cart_red.jpg') }}" alt="">
                                <h3>Your Cart is Empty</h3>
                            </div>
                            <div class="col-lg-4 col-md-2">
                            </div>
                        </div>
                    @endif
                </div>


            </div>
        </section>
    </main>
@endsection
@section('page-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('public/frontend/validation/checkout.js') }}"></script>
    {{-- @if ($countryPrice == 'IN')
    <script  async>
        const loader = $('#preloader-active');
        const loaderText = loader.find('h5');
        loaderText.html('Loading<br>(Do not refresh page,if you had done payment)');
        // Function to show the preloader
        function showPreloader() {
            jQuery('#preloader-active').show();
        }

        // Function to hide the preloader
        function hidePreloader() {
            jQuery('#preloader-active').hide();
        }
        // Event listener for the 'Show Loader' button
        jQuery('.cust_btn').on('click', function() {
            showPreloader();
        });

        var options = {
        "key": '{{env("RAZORPAY_KEY")}}',
        "amount": "{{ $payment_amount }}",
        "name": "Sajh Dhaj ke",
        "description": "Payment for Clothes",
        "image": "{{asset('public/frontend/assets/imgs/logo_color.png')}}",
        "theme": {
            "color": "#cd4040" // new theme color
        },
        "handler": function(response) {
            // handle Razorpay payment success callback
            var payment_id = response.razorpay_payment_id;
            $('#rzp_payment_id').val(payment_id);
            $("#payment_form").submit();
        },
        "modal": {
            "ondismiss": function(){
                // handle Razorpay payment modal close by close button "X"
                hidePreloader()
                console.log('Razorpay payment popup closed by close button "X"');
            }
        }
    };
    var rzp = new Razorpay(options);
    document.getElementById('rzp-button').onclick = function(e){
        rzp.open();
        e.preventDefault();
    };

    rzp.on('razorpay_modal_closed', function(){
        // handle Razorpay payment modal close event
        console.log('Razorpay payment popup closed');
        hidePreloader()
    });
    </script>
    @else
    <script  async>
        const loader = $('#preloader-active');
        const loaderText = loader.find('h5');
        loaderText.html('Loading<br>(Do not refresh page,if you had done payment)');

        // Function to show the preloader
        function showPreloader() {
            jQuery('#preloader-active').show();
        }

        // Function to hide the preloader
        function hidePreloader() {
            jQuery('#preloader-active').hide();
        }
        // Event listener for the 'Show Loader' button
        jQuery('.cust_btn').on('click', function() {
            showPreloader();
        });

        var options = {
        "key": '{{env("RAZORPAY_KEY")}}',
        "amount": "{{ $payment_amount }}",
        "currency": "USD",
        "name": "Sajh Dhaj ke",
        "description": "Payment for Clothes",
        "image": "{{asset('public/frontend/assets/imgs/logo_color.png')}}",
        "theme": {
            "color": "#cd4040" // new theme color
        },
        "handler": function(response) {
            // handle Razorpay payment success callback
            var payment_id = response.razorpay_payment_id;
            $('#rzp_payment_id').val(payment_id);
            $("#payment_form").submit();
        },
        "modal": {
            "ondismiss": function(){
                // handle Razorpay payment modal close by close button "X"
                hidePreloader()
                console.log('Razorpay payment popup closed by close button "X"');
            }
        }
    };
    var rzp = new Razorpay(options);
    document.getElementById('rzp-button').onclick = function(e){
        rzp.open();
        e.preventDefault();
    };

    rzp.on('razorpay_modal_closed', function(){
        // handle Razorpay payment modal close event
        console.log('Razorpay payment popup closed');
        hidePreloader()
    });
    </script>
    @endif --}}
    @if ($countryPrice == 'IN')
    @else
    <script src="https://js.stripe.com/v3/"></script>
    <script>
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#333',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSize: '16px',
                    '::placeholder': {
                    color: '#999'
                    }
                },
                invalid: {
                    color: '#ff0000',
                    iconColor: '#ff0000'
                },
                header: {
                    backgroundColor: '#f1e8e8 !important' // Set the desired background color for the card header
                },
                footer: {
                    backgroundColor: '#f1e8e8 !important' // Set the desired background color for the card footer
                }
            };
            const stripe = Stripe('{{ $stripe_key }}', { locale: 'en' }); // Create a Stripe client.
            const elements = stripe.elements(); // Create an instance of Elements.
            const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
            cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.
            // Handle real-time validation errors from the card Element.
            cardElement.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.handleCardPayment(clientSecret, cardElement, {
                    payment_method_data: {
                        //billing_details: { name: cardHolderName.value }
                    }
                })
                .then(function(result) {
                    console.log(result);
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        console.log(result);
                        form.submit();
                    }
                });
            });
        </script>

    @endif
@endsection
