@extends('frontend.layouts.fullLayoutMaster')

@section('page-style')
    <style>
        .error{
            color: #ea5455;
        }
        #default_address_id {
            margin-top: 0px;
            margin-left: 0px;
            height: 20px;
            width: 20px;
            position: absolute;
            background-color: #fff4e7;
            border-radius: 50%;
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
                                            <a class="nav-link " id="dashboard-tab" href="{{ route('user.profile') }}"><i class="fi-rs-user mr-10"></i>Account Details</a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link active" id="address-tab" data-bs-toggle="tab" href="#address"
                                                role="tab" aria-controls="address" aria-selected="true"><i
                                                    class="fi-rs-marker mr-10"></i>My Address</a>
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
                                    <div class="tab-pane fade active show" id="password" role="tabpanel"
                                    aria-labelledby="password-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Create Address</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" name="createAddress" id="createAddress" action="{{ route('user.createAddress') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <span class="myarrow">
                                                                <input list="atypes" name="atype" required="" id="atype" class="form-control @error('atype') is-invalid @enderror"
                                                                placeholder="{{__('Address Type')}}" value='{{old('atype')}}'>
                                                            </span>
                                                            <datalist id="atypes">
                                                                <option value="home">
                                                                <option value="work">
                                                                <option value="office">
                                                            </datalist>
                                                            @error('atype')
                                                            <span class="invalid-feedback" role="alert" style="display: block">
                                                                {{ $message }}
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Street <span class="required">*</span></label>
                                                        <input required="" class="form-control square"
                                                            name="street" type="text">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Landmark <span class="required">*</span></label>
                                                        <input required="" class="form-control square"
                                                            name="landmark" id="landmark" type="text">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>City <span class="required">*</span></label>
                                                        <input required="" class="form-control square"
                                                            name="city" type="text">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Pincode <span class="required">*</span></label>
                                                        <input required="" class="form-control square"
                                                            name="pincode" type="number">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>State <span class="required">*</span></label>
                                                        <input required="" class="form-control square"
                                                            name="state" type="text">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Country <span class="required">*</span></label>
                                                        <input required="" class="form-control square"
                                                            name="country" type="text">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <div class="checkbox">
                                                        <div class="custome-checkbox">
                                                            <input class="form-check-input" type="checkbox" name="default_address_id" id="default_address_id" value="yes">
                                                            <label class="form-check-label label_info" data-bs-toggle="collapse" data-target="#collapseAddress" href="#collapseAddress" aria-controls="collapseAddress" for="default_address_id"><span>Use as my default address</span></label>
                                                        </div>
                                                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script  async>
        $('#adminAddressCreate').validate({
            rules: {
                street: {
                    required: true,
                },
                landmark: {
                    required: true,
                },
                pincode: {
                    required: true,
                },
                city: {
                    required: true,
                },
            },
            messages: {
                street: {
                    required: "This street field is required",
                },
                landmark: {
                    required: "This landmark field is required",
                },
                pincode: {
                    required: "This pincode field is required",
                },
                city: {
                    required: "This city field is required",
                },
            }
        });
    </script>
@endsection
