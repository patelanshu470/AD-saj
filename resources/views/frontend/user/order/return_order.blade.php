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
                                            <div class="card-header">
                                                <h5 class="mb-0">Return Order #{{ $product->order->unique_id }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row"></div>
                                                <form method="POST" name="ProductReview" id="ProductReview" action="{{ route('storeOrderReturn') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        @foreach ($OrderProduct as $product)
                                                    <div class="card mt-3">
                                                        <div class="order-list-detail">
                                                            <div class="row m-3">
                                                                <div class="col-xl-9 p-0">
                                                                    <h5 class="mb-3">Delivered <span>Sunday</span></h5>
                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <img
                                                                                src="{{ URL::asset('public/images/product/'.$product->getproductsData->thumbnail)}}">
                                                                        </div>
                                                                        <div class="col-9">
                                                                            <p class="mb-0">
                                                                                <b style="font-weight: bolder;">{{ $product->getproductsData->name }} x {{ $product->quantity }}</b>
                                                                            </p>
                                                                            <p class="mb-0">
                                                                                Return eligible through
                                                                                <span>{{ date('d, M Y', strtotime((new DateTime($product->orders->delivered_at))->format('Y-m-d').' +3 days')) }}</span>
                                                                            </p>
                                                                            @if ($countryPrice == 'IN')
                                                                                <p class="mb-0">
                                                                                    <span><b style="font-weight: bolder;">₹{{ number_format($product->total_price, 2, '.', ',') }}</b> </span>
                                                                                </p>
                                                                            @else
                                                                                <p class="mb-0">
                                                                                    <span><b style="font-weight: bolder;">${{ number_format($product->total_price, 2, '.', ',') }}</b> </span>
                                                                                </p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <div class="form-group col-md-12 pt-10">
                                                        <label>Attach <span class="required">*</span></label>
                                                        <input type="file" name="attach" class="form-control" accept="video/mp4, video/mpeg, video/ogg, video/webm" id="videoFile">
                                                    </div>
                                                        <div class="form-group col-md-12 pt-10">
                                                            <label>Reason <span class="required">*</span></label>
                                                            <select name="description" id="" class="form-select">
                                                                <option value="" selected disabled>Select Return Reason</option>
                                                                <option value="Dissatisfied with Quality">Dissatisfied with Quality</option>
                                                                <option value="Size or Fit Issues">Size or Fit Issues</option>
                                                                <option value="Wrong Product Received">Wrong Product Received</option>
                                                                <option value="Damaged or Defective Product">Damaged or Defective Product</option>
                                                            </select>
                                                        </div>
                                                        <input type="text" value="{{ $product->order_id }}" name="order_id" hidden>
                                                        <input type="text" value="{{ $product->id }}" name="order_product_id" hidden>
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

<script  async>
    $(document).ready(function() {
      $('#videoFile').change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var validVideoTypes = ['video/mp4', 'video/mpeg', 'video/ogg', 'video/webm'];

        if ($.inArray(fileType, validVideoTypes) === -1) {
          alert('Invalid file type. Please select a valid video file.');
          // Reset the file input
          $(this).val('');
        }
      });
    });
  </script>
@endsection
