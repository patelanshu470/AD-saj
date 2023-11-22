@extends('frontend.layouts.fullLayoutMaster')


@section('content')
<style>
.side-line {
    border-right: 1px solid #e2e9e1;
    margin: 10px 0;
}
p {
    font-size: 0.879rem;
    color: black;
}
.bg-green {
  background-color: #f1e8e8;
}
.error {
    color: #ea5455;
}
</style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                    <span></span> Contact Us
                </div>
            </div>
        </div>
        <section class="hero-2 bg-green">
            <div class="hero-content">
                <div class="container">
                    <div class="text-center">
                        <h4 class="text-brand mb-20">Get in touch</h4>
                        <h1 class="mb-20 wow fadeIn animated font-xxl fw-900">
                            Let's Talk About <br>Your <span class="">Idea</span>
                        </h1>
                        <p class="wow fadeIn animated">
                            <a class="btn btn-brand btn-lg font-weight-bold text-white border-radius-5 btn-shadow-brand hover-up mb-10"
                                href="{{ route('user.about') }}">About Us</a>
                            <a
                                class="btn btn-outline btn-lg btn-brand-outline font-weight-bold text-brand bg-white text-hover-white ml-15 border-radius-5 btn-shadow-brand hover-up mb-10">Support
                                Center</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-border pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto" style="border-color: #e2e9e1;
                    border-style: solid;
                    border-width: 1px;
                    border-radius: 10px;">
                        <div class="row" style="display: flex;
                        justify-content: center;">
                        <div class="col-lg-5 side-line">
                            <div class="widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h3 class="mb-30">Get in touch</h3>
                                </div>
                                <p>
                                    We value your feedback and welcome your questions and comments. Here are the ways you can get in touch with us:
                                </p>
                                <div style="display:flex;">
                                    <i class="fa-regular fa-envelope" style="align-self: center;
                                    font-size: 29px;
                                    padding-right: 15px;color: black"></i>
                                    <p>
                                        You can email us at <a href="mailto:support@sajhdhajke.com" target="_blank">support@sajhdhajke.com</a>. We strive to respond to all emails within 24-48 hours.
                                    </p>
                                </div>
                                <div style="display:flex;margin-top:30px;">
                                    <i class="fa-solid fa-phone" style="align-self: center;
                                    font-size: 29px;
                                    padding-right: 15px;color: black"></i>
                                    @if ($address)
                                    @php
                                        $formattedPhoneNumber = substr_replace($address->phone_number, ' ', 0, 0); // Add a space after the country code
                                        $formattedPhoneNumber = substr_replace($formattedPhoneNumber, ' ', 6, 0); // Add a dash after the first five digits
                                    @endphp
                                        <p>
                                            You can call us at <a href="tel:{{ $address->phone_number }}">+91-{{ $formattedPhoneNumber }}
                                            </a>. Our customer service representatives are available Monday to Saturday, 10am to 6pm IST.
                                        </p>
                                    @else
                                        <p>
                                            You can call us at <a href="tel:+918160055855">+91 81600 55855
                                            </a>. Our customer service representatives are available Monday to Saturday, 10am to 6pm IST.
                                        </p>
                                    @endif
                                </div>
                                <div style="display:flex;margin-top:30px;">
                                    <i class="fa-brands fa-rocketchat" style="align-self: center;
                                    font-size: 29px;
                                    padding-right: 15px;color: black"></i>
                                    <p>
                                        You can chat with us live by clicking the chat icon in the bottom right corner of our website. Our chat service is available Monday to Saturday, 10am to 6pm IST.
                                    </p>
                                </div>
                                <div style="display:flex;margin-top:30px;">
                                    <i class="fa-regular fa-paper-plane" style="align-self: center;
                                    font-size: 29px;
                                    padding-right: 15px;color: black"></i>
                                    <p>
                                        You can send us mail at the following address: <a href="mailto:support@sajhdhajke.com" target="_blank">support@sajhdhajke.com</a>
                                    </p>
                                </div>
                                <div style="display:flex;margin-top:30px;">
                                    <i class="fa-solid fa-shop" style="align-self: center;
                                    font-size: 27px;
                                    padding-right: 15px;color: black"></i>
                                    <div>
                                        <b style="font-size: 20px;color: black">Sajh Dhaj Ke</b>
                                        @if ($address)
                                            <p>{{ ucfirst($address->street) }}, {{ ucfirst($address->landmark) }} <br>
                                                {{ ucfirst($address->area) }}, {{ ucfirst($address->city) }}<br>
                                                {{ ucfirst($address->state) }}, {{ ucfirst($address->country) }}<br>
                                                PIN - {{ $address->pincode }}
                                            </p>
                                        @else
                                            <p>1234, ABC Building <br>
                                                XYZ Street,Surat<br>
                                                Gujrat, India<br>
                                                PIN - 110001
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                            <div class="col-lg-5">
                                <div class="widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Contact Us</h3>
                                        </div>
                                        <form method="POST" action="{{ route('user.storeContactUs') }}" id="contact-us-form">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text"  class="" name="name" placeholder="Full Name">
                                            </div>
                                           <div class="form-group">
                                                <input type="email"  class="" name="email" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <input type="text"  class="" id="phone_number" name="phone_number" placeholder="Phone Number" maxlength="10">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="message" id="" rows="10" class="" placeholder="Write A Message"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Send Message</button>
                                            </div>
                                        </form>
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

<script  async>
    jQuery.validator.addMethod("email", function(value, element) {
    if (/^([a-zA-Z0-9_\.\-])+\@(gmail\.com)$/.test(value)) {
        return true;
    } else {
        return false;
    }
}, "Please enter a valid Email.");
$('#contact-us-form').validate({
    rules: {
        name: {
        required: true,
      },
      email: {
        required: true,
        email : true,
      },
      phone_number: {
        required: true,
      },
      message: {
        required: true,

      }
},
messages: {
    name: {
        required: "This Name field is required",
    },
    email: {
        required: "This Email field is required",
    },
    phone_number: {
        required: "This Phone number field is required",
    },
    message: {
        required: "This Message field is required",
    },
},
});
</script>
<script  async>
    $('#phone_number').on('input', function (event) {
        this.value = this.value.replace(/[^0-9,+]/g, '');
    });
</script>
@endsection
