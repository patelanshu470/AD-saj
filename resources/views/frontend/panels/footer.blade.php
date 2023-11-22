<footer class="main" style="background: #751d1c;">
    @php
        $setting =  App\Models\Setting::first();
    @endphp
    <section class="section-padding footer-mid" style="background: #751d1c;">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget-about font-md mb-md-5 mb-lg-0">
                        <div class="logo logo-width-1 wow fadeIn animated">
                            <a href="javascript:void(0)"><img src="{{ asset('public/images/logo/logo.png') }}" alt="logo"></a>
                        </div>
                        <h5 class="mt-20 mb-10 fw-600 wow fadeIn animated" style="color: #FCDC6E">Contact</h5>
                        <p class="wow fadeIn animated" style="color: #fff">
                            @if ($setting)
                                <strong>Address: </strong>{{ ucfirst($setting->street) }}, {{ ucfirst($setting->landmark) }}, {{ ucfirst($setting->city) }} {{ $setting->pincode }}
                            @else
                                <strong>Address: </strong>Surat, Gujrat
                            @endif
                        </p>
                        <p class="wow fadeIn animated" style="color: #fff">
                            @if ($setting)
                                @php
                                    $formattedPhoneNumber = substr_replace($setting->phone_number, ' ', 0, 0); // Add a space after the country code
                                    $formattedPhoneNumber = substr_replace($formattedPhoneNumber, ' ', 6, 0); // Add a dash after the first five digits
                                @endphp
                                <strong>Phone: </strong>(+91) {{ $formattedPhoneNumber }}
                            @else
                                <strong>Phone: </strong>(+91) 81600 55855
                            @endif
                        </p>
                        <p class="wow fadeIn animated" style="color: #fff">
                        @if($setting)
                            <strong>Email: </strong> {{$setting->email}}
                        @else
                            <strong>Email: </strong> support@sajhdhajke.com
                        @endif
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="widget-title wow fadeIn animated" style="color: #FCDC6E">Policies</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                        <li><a href="{{ route('user.delivery') }}">Shipping Policy</a></li>
                        <li><a href="{{ route('user.privacy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('user.termCondition') }}">Terms &amp; Conditions</a></li>
                        <li><a href="{{ route('user.return') }}">Return Policy</a></li>
                        <li><a href="{{ route('user.internationalOrders') }}">International Orders</a></li>
                        <li><a href="{{ route('user.cancelPolicy') }}">Cancellation Policy</a></li>
                        <li><a href="{{ route('user.highlightPolicy') }}">Customer Highlight Policy</a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-3">
                    <h5 class="widget-title wow fadeIn animated" style="color: #FCDC6E">About</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="{{ route('user.about') }}">About Us</a></li>
                        <li><a href="{{ route('user.contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('user.profile') }}">Account Detail</a></li>
                        <li><a href="{{ route('user.cart') }}">Shopping Bag</a></li>
                        <li><a href="{{ route('wishlists.index') }}">My Wishlist</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="widget-title wow fadeIn animated" style="color: #FCDC6E">Follow Us</h5>
                    <div class="row">
                        <div class="col-md-8 col-lg-12">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @if ($setting != null)
                                <a href="{{ $setting->facebook_url }}" target="_blank" class="social-button"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="{{ $setting->twitter_url }}" target="_blank" class="social-button"><i class="fa-brands fa-twitter"></i></a>
                                <a href="{{ $setting->instagram_url }}" target="_blank" class="social-button"><i class="fa-brands fa-instagram"></i></a>
                                <a href="{{ $setting->linkedin_url }}" target="_blank" class="social-button"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="{{ $setting->youtube_url }}" target="_blank" class="social-button"><i class="fa-brands fa-youtube"></i></a>
                            @else
                                <a href="https://www.facebook.com/" target="_blank" class="social-button"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="https://twitter.com/i/flow/login" target="_blank" class="social-button"><i class="fa-brands fa-twitter"></i></a>
                                <a href="https://www.instagram.com/" target="_blank" class="social-button"><i class="fa-brands fa-instagram"></i></a>
                                <a href="https://in.linkedin.com/" target="_blank" class="social-button"><i class="fa-solid fa-envelope"></i></a>
                                <a href="https://www.youtube.com/" target="_blank" class="social-button"><i class="fa-brands fa-youtube"></i></a>
                            @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                            <h5 class="mt-20 mb-10 fw-600 wow fadeIn animated" style="color: #FCDC6E">Secured Payment Gateways</h5>
                            <img class="wow fadeIn animated" src="{{ asset('public/frontend/assets/imgs/theme/payment-method.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <p class="wow fadeIn animated" style="color: #fff;margin-top: 30px;">
                    <strong>We Ship Across the World  </strong>United States, United Kingdom, Canada, Australia, India
            </p>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-6">
                <p class="float-md-left font-sm mb-0" style="color: #fff">&copy; 2023, <strong class="" style="color: #FCDC6E">Sajh Dhaj ke</strong> - All rights reserved </p>
            </div>
            <div class="col-lg-6">
                <p class="text-lg-end text-start font-sm mb-0" style="color: #fff">
                    Developed by <a href="https://vacuity.in/" target="_blank" style="color: #FCDC6E">Vacuity PVT LTD</a>. All rights reserved
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="{{ asset('public/frontend/assets/imgs/theme/Loader.gif') }}" alt="" width="150">
            </div>
        </div>
    </div>
</div>
