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
            background-color: #cd4040;
            color: #fff;
            font-size: 14px;
            font-weight: 400;
        }

        .order-sublist button {
            border: 1px solid #cd4040;
            border-radius: 8px;
            width: 100%;
            background-color: #ffffff;
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
            background: #cd4040;
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
            border: 1px solid #cd4040;
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
            background: #cd4040;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 0;
            left: 10%;
            width: 25px;
            height: 25px;
            z-index: 400;
            border: 1px solid #cd4040;
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

/* review css */

h1 {
  font-family: 'Fjalla One', sans-serif;
  margin-bottom: 0.15rem;
}

h2 {
  font-family: 'Cutive Mono', 'Courier New';
  font-size: 1rem;
  letter-spacing: 1px;
  margin-bottom: 4rem;
}

label {
  cursor: pointer;
}

svg {
  width: 3rem;
  height: 3rem;
  padding: 0.15rem;
}


/* hide radio buttons */

input[name="star"] {
  display: inline-block;
  width: 0;
  opacity: 0;
  margin-left: -2px;
}

/* hide source svg */

.star-source {
  width: 0;
  height: 0;
  visibility: hidden;
}


/* set initial color to transparent so fill is empty*/

.star {
  color: transparent;
  transition: color 0.2s ease-in-out;
}


/* set direction to row-reverse so 5th star is at the end and ~ can be used to fill all sibling stars that precede last starred element*/

.star-container {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
}

label:hover ~ label .star,
svg.star:hover,
input[name="star"]:focus ~ label .star,
input[name="star"]:checked ~ label .star {
  color: #ffa500;
}

input[name="star"]:checked + label .star {
  animation: starred 0.5s;
}

input[name="star"]:checked + label {
  animation: scaleup 1s;
}

@keyframes scaleup {
  from {
    transform: scale(1.2);
  }
  to {
    transform: scale(1);
  }
}

@keyframes starred {
  from {
    color: #cfb002;
  }
  to {
    color: #ffa500;
  }
}
.error {
    color: #ea5455;
}
.form-select:focus {
    outline: 0;
    box-shadow: none;
}
</style>

@endsection

@section('content')
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
                            <div class="col-md-4">
                                <div class="dashboard-menu pb-10">
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
                                            <div class="card-header">
                                                <h5 class="mb-0">Cancel Order #{{ $order->unique_id }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row"></div>
                                                <form method="POST" name="ProductReview" id="ProductReview" action="{{ route('storeOrderCancel') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                                <div class="card">
                                                                    <div class="row m-3">
                                                                        <div class="col-lg-4 col-md-12 p-0">
                                                                            <p><b style="font-weight: bolder;">Shipping Address</b></p>
                                                                            <p class="mb-0">{{ $order->shipping_contact_name }}</p>
                                                                            <p class="mb-0">{{ $shipping_address->street }},
                                                                                {{ $shipping_address->landmark }}</p>
                                                                            <p class="mb-0">{{ $shipping_address->city }},
                                                                                {{ $shipping_address->state }},
                                                                                {{ $shipping_address->pincode }}</p>
                                                                            <p class="mb-0">{{ $shipping_address->country }}</p>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-12 p-0">
                                                                            <p><b style="font-weight: bolder;">Payment Method</b></p>
                                                                            <p class="mb-0">{{ ucfirst($order->payment_method) }}</p>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-12 p-0">
                                                                            <p><b style="font-weight: bolder;">Order Summary</b></p>
                                                                            <div class="d-flex">
                                                                                <div>
                                                                                    <p class="mb-0">Subtotal:</p>
                                                                                    <p class="mb-0">Discount:</p>
                                                                                    <p class="mb-0"><b>Total:</b></p>
                                                                                </div>
                                                                                @if ($countryPrice == 'IN')
                                                                                    <div class="ms-auto">
                                                                                        <p class="mb-0">₹{{ number_format($order->subtotal, 2, '.', ',') }}</p>
                                                                                        <p class="mb-0">₹{{ $order->total_discount }}</p>
                                                                                        <p class="mb-0"><b style="font-weight: bolder;">₹{{ number_format($order->grand_total, 2, '.', ',') }}</b></p>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="ms-auto">
                                                                                        <p class="mb-0">${{ number_format($order->subtotal, 2, '.', ',') }}</p>
                                                                                        <p class="mb-0">${{ $order->total_discount }}</p>
                                                                                        <p class="mb-0"><b style="font-weight: bolder;">${{ number_format($order->grand_total, 2, '.', ',') }}</b></p>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Reason <span class="required">*</span></label>
                                                            <select name="description" id="" class="form-select">
                                                                <option value="" selected disabled>Select Canceled Reason</option>
                                                                <option value="Ordered by mistake">Ordered by mistake</option>
                                                                <option value="Incorrect item ordered">Incorrect item ordered</option>
                                                                <option value="Delivery date too late">Delivery Ddate Too Late</option>
                                                                <option value="Shipping or handling costs too high">Shipping or handling costs too high</option>
                                                                <option value="Concerns about product quality or safety">Concerns about product quality or safety</option>
                                                                <option value="Payment issues">Payment issues</option>
                                                                <option value="Shipping address incorrect or incomplete">Shipping address incorrect or incomplete</option>
                                                            </select>
                                                        </div>
                                                        <input type="text" value="{{ $order->id }}" name="order_id" hidden>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-fill-out submit"
                                                                name="submit" value="Submit">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
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

@endsection

@section('page-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="{{ asset('public/frontend/validation/profile.js') }}"></script>

@endsection
