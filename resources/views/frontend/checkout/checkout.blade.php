@extends('frontend.layouts.fullLayoutMaster')

@section('page-style')
    <style>
        .error {
            color: #ea5455;
        }
        button.submit, button[type='submit'] {
  font-size: 15px;
  font-weight: 500;
  padding: 12px 40px;
  color: #751d1c;
  border: none;
  background-color: #751d1c;
  border: 1px solid #751d1c;
  border-radius: 5px;
}

button.submit:hover, button[type='submit']:hover {
  background-color: #751d1c !important;
  color: #ffffff;
}
#scrollUp i{
    padding-top: 10;
}
.sticky-white-bg{
    padding-bottom: 8px;
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
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <form method="POST" action="{{ route('user.addOrder') }}" name='order-form' id="order-form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-25">
                                <h4>Billing Details</h4>
                            </div>
                            <div class="form-group">
                                @if (auth()->user()->first_name != null)
                                    <input type="text" required="" name="billing_contact_name"
                                        value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}"
                                        placeholder="First name *" readonly>
                                @endif
                            </div>
                            @if (auth()->user()->first_name == null)
                            <div class="" style="display: flex">
                                <div class="form-group col-lg-6 col-md-12">
                                    <input type="text" required="" name="first_name"
                                    placeholder="First name *">
                                </div>
                                <div class="form-group col-lg-6 col-md-12">
                                    <input type="text" required="" name="last_name"
                                    placeholder="Last name *">
                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                @if (auth()->user()->phone_number != null)
                                    <input required="" type="text" name="billing_contact_number"
                                        value="{{ auth()->user()->phone_number }}" placeholder="Phone *" maxlength="10"
                                        id="billing_contact_number" readonly>
                                @else
                                    <input required="" type="text" name="billing_contact_number" placeholder="Phone *" maxlength="10"
                                    id="billing_contact_number">
                                @endif
                            </div>
                            <div class="form-group">
                                @if (auth()->user()->email != null)
                                    <input required="" type="text" name="billing_contact_email" required readonly
                                    value="{{ auth()->user()->email }}" placeholder="Email address *">
                                @else
                                    <input required="" type="text" name="billing_contact_email"
                                        value="{{ auth()->user()->email }}" placeholder="Email address *">
                                @endif
                            </div>
                            <div class="form-group">
                            <?php
                                $select = '';
                                if (old('billing_country') == '' && isset($default_address->country)) {
                                    $billing_country_address = $default_address->country;
                                } else {
                                    $billing_country_address = '';
                                }
                                ?>
                                <input required="" type="text" value="{{ $billing_country_address }}" name="billing_country"
                                    placeholder="Country*">
                            </div>
                            <div class="form-group">
                            <?php
                                $select = '';
                                if (old('billing_state') == '' && isset($default_address->state)) {
                                    $billing_state_address = $default_address->state;
                                } else {
                                    $billing_state_address = '';
                                }
                                ?>
                                <input required="" type="text" value="{{ $billing_state_address }}" name="billing_state"
                                    placeholder="State*">
                            </div>
                            <div class="form-group">
                                <?php
                                $select = '';
                                if (old('billing_city') == '' && isset($default_address->city)) {
                                    $billing_city_address = $default_address->city;
                                } else {
                                    $billing_city_address = '';
                                }
                                ?>
                                <input required="" type="text" value="{{ $billing_city_address }}" name="billing_city"
                                    placeholder="City / Town *">
                            </div>
                            <div class="form-group">
                                <?php
                                $select = '';
                                if (old('billing_street_address') == '' && isset($default_address->street)) {
                                    $billing_street_address = $default_address->street;
                                } else {
                                    $billing_street_address = '';
                                }
                                ?>
                                <input type="text" name="billing_street_address" value="{{ $billing_street_address }}"
                                    required="" placeholder="Street *">
                            </div>
                            <div class="form-group">
                                <?php
                                $select = '';
                                if (old('billing_landmark') == '' && isset($default_address->landmark)) {
                                    $billing_landmark_address = $default_address->landmark;
                                } else {
                                    $billing_landmark_address = '';
                                }
                                ?>
                                <input type="text" name="billing_landmark" value="{{ $billing_landmark_address }}"
                                    required="" placeholder="Landmark *">
                            </div>

                            <div class="form-group">
                                <?php
                                $select = '';
                                if (old('billing_pincode') == '' && isset($default_address->pincode)) {
                                    $billing_pincode_address = $default_address->pincode;
                                } else {
                                    $billing_pincode_address = '';
                                }
                                ?>
                                <input required="" type="text" name="billing_pincode"
                                    value="{{ $billing_pincode_address }}" id="billing_pincode" placeholder="Pincode *"
                                    maxlength="6">
                            </div>
                            <div class="ship_detail">
                                <div class="form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="ship_to_different_address"
                                                id="differentaddress" value="yes">
                                            <label class="form-check-label label_info" data-bs-toggle="collapse"
                                                data-target="#collapseAddress" href="#collapseAddress"
                                                aria-controls="collapseAddress" for="differentaddress"><span>Ship to a
                                                    different address?</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseAddress" class="different_address collapse in">
                                    <div class="form-group">
                                        @if (auth()->user()->first_name != null)
                                            <input type="text" name="shipping_contact_name"
                                                value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}"
                                                placeholder="First name *" readonly>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        @if (auth()->user()->phone_number != null)
                                            <input type="text" name="shipping_contact_number" maxlength="10" readonly
                                                id="shipping_contact_number" value="{{ auth()->user()->phone_number }}"
                                                placeholder="Phone *">
                                        @else
                                            <input type="text" name="shipping_contact_number" maxlength="10"
                                                id="shipping_contact_number" value=""
                                                placeholder="Phone *" required>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        @if (auth()->user()->email != null)
                                            <input type="text" name="shipping_contact_email" readonly
                                            value="{{ auth()->user()->email }}" placeholder="Email address *">
                                        @else
                                            <input type="text" name="shipping_contact_email" required
                                                value="{{ auth()->user()->email }}" placeholder="Email address *">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                    <?php
                                        $select = '';
                                        if (old('shipping_country') == '' && isset($default_address->country)) {
                                            $shipping_country_address = $default_address->country;
                                        } else {
                                            $shipping_country_address = '';
                                        }
                                        ?>
                                        <input type="text" name="shipping_country" value="{{ $shipping_country_address }}"
                                            placeholder="Country *">
                                    </div>
                                    <div class="form-group">
                                    <?php
                                        $select = '';
                                        if (old('shipping_state') == '' && isset($default_address->state)) {
                                            $shipping_state_address = $default_address->state;
                                        } else {
                                            $shipping_state_address = '';
                                        }
                                        ?>
                                        <input type="text" name="shipping_state" value="{{ $shipping_state_address }}"
                                            placeholder="State *">
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $select = '';
                                        if (old('shipping_city') == '' && isset($default_address->city)) {
                                            $shipping_city_address = $default_address->city;
                                        } else {
                                            $shipping_city_address = '';
                                        }
                                        ?>
                                        <input type="text" name="shipping_city" value="{{ $shipping_city_address }}"
                                            placeholder="City / Town *">
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $select = '';
                                        if (old('shipping_street_address') == '' && isset($default_address->street)) {
                                            $shipping_street_address = $default_address->street;
                                        } else {
                                            $shipping_street_address = '';
                                        }
                                        ?>
                                        <input type="text" name="shipping_street_address"
                                            value="{{ $shipping_street_address }}" placeholder="Street *">
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        $select = '';
                                        if (old('shipping_landmark_address') == '' && isset($default_address->landmark)) {
                                            $shipping_landmark_address = $default_address->landmark;
                                        } else {
                                            $shipping_landmark_address = '';
                                        }
                                        ?>
                                        <input type="text" name="shipping_landmark"
                                            value="{{ $shipping_landmark_address }}" placeholder="Landmark *">
                                    </div>

                                    <div class="form-group">
                                        <?php
                                        $select = '';
                                        if (old('shipping_pincode_address') == '' && isset($default_address->pincode)) {
                                            $shipping_pincode_address = $default_address->pincode;
                                        } else {
                                            $shipping_pincode_address = '';
                                        }
                                        ?>
                                        <input type="text" name="shipping_pincode"
                                            value="{{ $shipping_pincode_address }}" id="shipping_pincode" maxlength="6"
                                            placeholder="Pincode *">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-20">
                                <h5>Additional information</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="5" placeholder="Order notes" name="order_note">{{ old('order_note') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-outline">Place Order</button>

                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
<script  async>
    // alert(window.location.href);
    // window.onload = function() {

    //     if ({{ empty($cartData) || count($cartData) < 0 ? 'true' : 'false' }}) {
    //         window.location.href = "{{ route('user.dashboard') }}";
    //     }
    // }
</script>
@section('page-script')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>



    <script  async>
        $('#billing_contact_number').on('input', function(event) {
            this.value = this.value.replace(/[^0-9,+]/g, '');
        });
    </script>
    <script  async>
        $('#shipping_contact_number').on('input', function(event) {
            this.value = this.value.replace(/[^0-9,+]/g, '');
        });
    </script>
    <script  async>
        $('#billing_pincode').on('input', function(event) {
            this.value = this.value.replace(/[^0-9,+]/g, '');
        });
    </script>
    <script  async>
        $('#shipping_pincode').on('input', function(event) {
            this.value = this.value.replace(/[^0-9,+]/g, '');
        });
    </script>
    <script  async>
        jQuery.validator.addMethod("email", function(value, element) {
            if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
                return true;
            } else {
                return false;
            }
        }, "Please enter a valid Email.");
    </script>
    <script src="{{ asset('public/frontend/validation/checkout.js') }}"></script>


@endsection
