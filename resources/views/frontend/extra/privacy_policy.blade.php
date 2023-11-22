@extends('frontend.layouts.fullLayoutMaster')


@section('content')
    <style>
        .hero-2 {
            padding: 94px 0 63px;
            min-height: 265px;
        }

        .bg-green {
            background-color: #f1e8e8;
        }

        div .column {
            text-align: justify;
            color:#000000;
            font-family: "New York", "Iowan Old Style", "Apple Garamond", Baskerville, "Times New Roman", "Droid Serif", Times, "Source Serif Pro", serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 16px !important;
            font-style:normal;
            font-weight:400;
        }
        strong{
            font-weight:700 !important;
        }
        ul {
            list-style: square;
            padding-left: 40px;
            font-size: 16px
        }
        ol{
            list-style: number;
            padding-left: 20px;
            font-size: 16px
        }
        li{
            padding-top:5px;
        }
        .heading-text{
            font-family:"Playfair Display", serif;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                    <span></span> Privacy Policy
                </div>
            </div>
        </div>
        <section class="hero-2 bg-green">
            <div class="hero-content">
                <div class="container">
                    <div class="text-center">
                        <h1 class="mb-20 wow fadeIn animated font-xxl fw-900 heading-text">
                            Privacy Policy 
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-border pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="page-content page-content--medium rte">
                        <div class="page" title="Privacy Policy">
                            <div class="section">
                                <div class="layoutArea">
                                    <div class="column">At Sajh Dhaj Ke, we take your privacy seriously. We are committed to
                                        protecting your personal information and ensuring that your shopping experience with
                                        us is safe and secure. This privacy policy outlines how we collect, use, and protect
                                        your personal information.</div>
                                    <br>
                                    <ol class="column">
                                        <li><strong>Collection of Information:</strong></li>
                                        <ul>
                                            <li>We collect personal information
                                            such as your name, address, email address, and phone number when you place an order
                                            on our website. We may also collect non-personal information such as your IP address
                                            and browsing behavior.</li>
                                        </ul>
                                        <li><strong>Use of Information:</strong></li>
                                        <ul>
                                            <li>We use your personal information to
                                            process your orders, provide customer service, and send you promotional offers and
                                            updates about our products and services. We may also use your information to improve
                                            our website and customer experience.</li>
                                        </ul>
                                        <li><strong>Protection of Information:</strong></li>
                                        <ul>
                                            <li>We take appropriate security
                                            measures to protect your personal information from unauthorized access, disclosure,
                                            alteration, or destruction. We use industry-standard encryption technologies to
                                            protect your data during transmission and storage.</li>
                                        </ul>
                                        <li><strong>Sharing of Information:</strong></li>
                                        <ul>
                                            <li>We do not sell, rent, or share your
                                            personal information with third parties, except as necessary to process your orders
                                            or comply with legal obligations.</li>
                                        </ul>
                                        <li><strong>Cookies:</strong></li>
                                        <ul>
                                            <li>We use cookies to improve your browsing experience
                                            and personalize your interactions with our website. Cookies are small data files
                                            that are stored on your device when you visit our website. You can disable cookies
                                            in your browser settings, but this may affect your ability to use our website.</li>
                                        </ul>
                                        <li><strong>Third-Party Websites:</strong></li>
                                        <ul>
                                            <li>Our website may contain links to
                                            third-party websites that are not under our control. We are not responsible for the
                                            privacy practices of these websites and encourage you to read their privacy
                                            policies.</li>
                                        </ul>
                                   
                                        <li><strong>Changes to Privacy Policy:</strong></li>
                                        <ul>
                                            <li>We may update this privacy policy
                                            from time to time. We will notify you of any changes by posting the updated policy
                                            on our website.</li>    
                                        </ul>
                                    </ol>
                                    <br>
                                    <div class="column">If you have any questions or concerns about our privacy policy,
                                                please contact us. We are committed to protecting your privacy and ensuring a safe
                                                and secure shopping experience with Sajh Dhaj Ke.</div>
                                    <div class="column pt-3"><strong>*This Website SajhDhajke.com is Proprietorship By Dhanak (Registration Number : 24JBUPS5657B1Z1)</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
