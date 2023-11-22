@extends('frontend.layouts.fullLayoutMaster')

@section('page-style')
    <style>
        .error{
            color: #ea5455;
        }
        #default_address_id {
            margin-top: -3px;
            margin-left: 0px;
            height: 20px;
            width: 20px;
            position: absolute;
            background-color: #d38c8c;
            border-radius: 50%;
        }
        @media only screen and (max-width: 768px) {
            table.table .all_orders tr td:first-child{
                border-top: 3px solid #d5cdcd;
            }
        }
        .iti{
            width: 100%;
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
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                                href="#dashboard" role="tab" aria-controls="dashboard"
                                                aria-selected="false"><i class="fi-rs-user mr-10"></i>Account Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password"
                                                role="tab" aria-controls="password" aria-selected="false"><i class="fa-solid fa-key mr-10"></i></i>Change Password</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                                role="tab" aria-controls="orders" aria-selected="false"><i
                                                    class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address"
                                                role="tab" aria-controls="address" aria-selected="true"><i
                                                    class="fi-rs-marker mr-10 "></i>My Address</a>
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
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                        aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">
                                                <h5 class="mb-0">Hello {{ auth()->user()->first_name }}! </h5>
                                                <div class="nav" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link mb-0 p-0" id="account-detail-tab" data-bs-toggle="tab"
                                                        href="#account-detail" role="tab" aria-controls="account-detail"
                                                        aria-selected="true"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                    </li>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="login-form-wrap">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <dl class="row mb-0">
                                                                <div class="col-sm-4 text-sm-right">
                                                                    <dt>Name:</dt>
                                                                </div>
                                                                <div class="col-sm-8 text-sm-left">
                                                                    <dd class="mb-1"><span
                                                                            class="label label-primary">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                                                                    </dd>
                                                                </div>
                                                            </dl>
                                                            <dl class="row mb-0">
                                                                <div class="col-sm-4 text-sm-right">
                                                                    <dt>Email:</dt>
                                                                </div>
                                                                <div class="col-sm-8 text-sm-left">
                                                                    <dd class="mb-1">
                                                                        <span
                                                                            class="label label-primary">{{ auth()->user()->email }}</span>
                                                                    </dd>
                                                                </div>
                                                            </dl>
                                                            <dl class="row mb-0">
                                                                <div class="col-sm-4 text-sm-right">
                                                                    <dt>Contact:</dt>
                                                                </div>
                                                                <div class="col-sm-8 text-sm-left">
                                                                    <dd class="mb-1">
                                                                        <span class="label label-primary">{{ auth()->user()->phone_number }}</span>
                                                                        <i class="ri-checkbox-circle-fill"
                                                                            style="color: #AD9144;"
                                                                            title="Mobile Verified"></i>
                                                                    </dd>
                                                                </div>
                                                            </dl>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="password" role="tabpanel"
                                    aria-labelledby="password-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Change Password</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" name="change_password" id="change_password" action="{{ route('user.changePassword') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Current Password <span class="required">*</span></label>
                                                        <input required="" class="form-control square"
                                                            name="old_password" type="password" id="old_password">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>New Password <span class="required">*</span></label>
                                                        <input required="" class="form-control square"
                                                            name="new_password" id="new_password" type="password">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Confirm Password <span class="required">*</span></label>
                                                        <input required="" class="form-control square"
                                                            name="confirm_password" type="password">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit"
                                                            name="submit" value="Submit">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel"
                                        aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Your Orders</h5>
                                            </div>
                                            <div class="card-body">
                                                @if (count($orderData) > 0)
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Order</th>
                                                                    <th>Date</th>
                                                                    <th>Status</th>
                                                                    <th>Total</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="all_orders">
                                                                @foreach ($orderData as $order)
                                                                    <tr>
                                                                        <td>#{{ $order->unique_id }}</td>
                                                                        <td>{{ date('F d, Y', strtotime($order->created_at)) }}
                                                                        </td>
                                                                        <td>@if ($order->status == 0)
                                                                            <span class=""> Pending</span>
                                                                        @endif
                                                                        @if ($order->status == 1)
                                                                            <span class=""> Confirmed</span>
                                                                        @endif
                                                                        @if ($order->status == 2)
                                                                            <span class=""> Shipped</span>
                                                                        @endif
                                                                        @if ($order->status == 3)
                                                                            <span class=""> Delivered</span>
                                                                        @endif
                                                                        @if ($order->status == 4)
                                                                            <span class=""> Canceled</span>
                                                                        @endif
                                                                    </td>
                                                                    @if ($countryPrice == 'IN')
                                                                        <td>₹{{ $order->grand_total }} for
                                                                            {{ count($order->getOrderInformation) }} item</td>
                                                                    @else
                                                                        <td>${{ $order->grand_total }} for
                                                                            {{ count($order->getOrderInformation) }} item</td>
                                                                    @endif

                                                                        <td><a href="{{ route('orderView',encrypt($order->id)) }}"
                                                                                class="btn-small d-block">View</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <input type="hidden" class="pagenum" value="{{$orderData->currentPage()  + 1}}" />
                                                    <div class="lode_more_loader" style="text-align: -webkit-center;">
                                                        <div class="loader">
                                                            <div class="bar bar1"></div>
                                                            <div class="bar bar2"></div>
                                                            <div class="bar bar3"></div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="alert alert-danger">
                                                        <div class="d-flex flex-column pe-0 pe-sm-10">
                                                            Your Order is currently empty
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="address" role="tabpanel"
                                        aria-labelledby="address-tab">
                                        @if (count($addresses) > 0)
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between" style="padding: 5px;">
                                                <h5 class="mb-0" style="align-self: center;
                                                margin-left: 10px;">Address</h5>
                                                <button onclick="location.href='{{route('user.address')}}'" class="btn" style="padding: 9px 15px;">Add Address</button>
                                            </div>
                                            <div class="row" style="margin-top: 10px;
                                            margin-bottom: 10px;
                                            margin-left: 1px;
                                            margin-right: 1px;">
                                                @foreach ($addresses as $user_addresses)
                                                <div class="col-lg-6" style="margin-bottom: 10px">
                                                    <div class="card mb-3 mb-lg-0">
                                                        <div class="card-header justify-content-between" style="display: flex">
                                                            <h5 class="mb-0"><input type="radio" value="{{ $user_addresses->id }}"
                                                                data-id="{{ $user_addresses->id }}" class="form-check-input"
                                                                name="default_address_chk" id="default_address_id" style="border-color: brown;"
                                                                @if ($user_addresses->id == $default_address_id) {{ "checked='checked" }} @endif >
                                                            <span class="checkmark"></span> <span style="margin-left: 25px">{{ $user_addresses->atype }}</span> </h5>
                                                            <a  onclick="deleteRecord({{ $user_addresses->id }})">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </a>
                                                            <a href="{{ route('user.delete_address',encrypt($user_addresses->id)) }}" style="display: none" id="del{{ $user_addresses->id }}">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </a>
                                                        </div>
                                                        <div class="card-body">
                                                            <address>{{ $user_addresses->street }}<br> {{ $user_addresses->landmark }},<br> {{ $user_addresses->city }}, {{ $user_addresses->pincode }},
                                                                <br>{{ ucfirst($user_addresses->state) }}
                                                            </address>
                                                            <p>{{ ucfirst($user_addresses->country) }}</p>
                                                            <a href="{{ route('user.editAddress',encrypt($user_addresses->id)) }}" class="btn-small">Edit</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @else
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">
                                                <h5 class="mb-0">Address</h5>
                                                <button onclick="location.href='{{route('user.address')}}'" class="btn" style="padding: 9px 15px;">Add Address</button>
                                            </div>
                                            <div class="card-body contact-from-area">
                                                <div class="alert alert-danger">
                                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                                        Address is currently empty
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                        aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Account Details</h5>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" name="edit_account" id="edit_account" action="{{ route('user.editAccount') }}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>First Name <span class="required">*</span></label>
                                                            <input required="" class="form-control square"
                                                                name="first_name" value="{{ auth()->user()->first_name }}" type="text">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Last Name <span class="required">*</span></label>
                                                            <input required="" class="form-control square"
                                                                name="last_name" value="{{ auth()->user()->last_name }}" type="text">
                                                        </div>
                                                        @if ($countryPrice == 'IN')
                                                            <div class="form-group col-md-12">
                                                                <label>Email Address <span class="required">*</span></label>
                                                                <input required="" class="form-control square"
                                                                    name="email" value="{{ auth()->user()->email }}" type="email">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Phone Number <span class="required">*</span></label>
                                                                <input required="" class="form-control square" id="phone_number"
                                                                    name="phone_number" value="{{ auth()->user()->phone_number }}" type="text" maxlength="10" readonly>
                                                            </div>
                                                        @else
                                                            <div class="form-group col-md-12">
                                                                <label>Email Address <span class="required">*</span></label>
                                                                <input required="" class="form-control square"
                                                                    name="email" value="{{ auth()->user()->email }}" type="email" readonly>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Phone Number <span class="required">*</span></label>
                                                                <input required="" class="form-control square" id="phone_number"
                                                                    name="phone_number" value="{{ auth()->user()->phone_number }}" type="text" maxlength="10">
                                                            </div>
                                                        @endif
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
<script  async>
    updatedefaultaddress = "{{ route('user.update_default_address') }}";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="{{ asset('public/frontend/validation/profile.js') }}"></script>

<script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script  async>
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


<script  async>
    $(window).scroll(function() {
       if ($(window).scrollTop() + $(window).height() + 600 >= $(document).height()) {
           var page = parseInt($('.pagenum').val());
           if (page != 0 || page != '0') {
               loadMoreOrder(page);
           }
       }
   });

   function loadMoreOrder(pagenum) {
       if (!jQuery(document).find('.lode_more_loader').hasClass('ajax-running')) {
           $('.pagenum').val(pagenum + 1);
           $.ajax({
                   url: '/user-profile?page=' + pagenum,
                   type: "get",
                   datatype: 'html',
                   beforeSend: function() {
                       jQuery(document).find('.lode_more_loader').addClass('ajax-running');
                       $('.load-more-btn').text('Loading....');
                       $('.lode_more_loader').show();
                   }
               })
               .done(function(data) {
                   if (data.html.length == 0) {
                       $('.invisible').removeClass('invisible');
                       $('.pagenum').val(0)
                       $('.lode_more_loader').hide();
                       return false;
                   } else {
                       $('.load-more-btn').text('Load more...');
                       $('.all_orders').append(data.html);
                       $('.lode_more_loader').hide();
                   }
                   jQuery(document).find('.lode_more_loader').removeClass('ajax-running');
               })
               .fail(function(jqXHR, ajaxOptions, thrownError) {
                   $('.lode_more_loader').hide();
                   $('.pagenum').val(0);
                   jQuery(document).find('.lode_more_loader').removeClass('ajax-running');
                   return false;
               });
       }
   }
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
@if ($countryPrice == 'IN')
    <script>
        var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
        separateDialCode: true,
        preferredCountries:["IN"],
        hiddenInput: "phone_number",
        utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
    });
    </script>
@else
    <script>
        var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
        separateDialCode: true,
        preferredCountries:["US"],
        hiddenInput: "phone_number",
        utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
    });
    </script>
@endif
@endsection
