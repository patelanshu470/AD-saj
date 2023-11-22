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
                    <span></span> Register
                    <span></span> Term & Conditions
                </div>
            </div>
        </div>
        <section class="hero-2 bg-green">
            <div class="hero-content">
                <div class="container">
                    <div class="text-center">
                        <h1 class="mb-20 wow fadeIn animated font-xxl fw-900 heading-text">
                            Terms & Conditions
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-border pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="page-content page-content--medium rte">
                        <div class="page" title="Terms and Condition">
                            <div class="section">
                                <div class="layoutArea">
                                    <div class="column">Welcome to Sajh Dhaj Ke. By accessing or using our website, you
                                        agree to comply with the following terms and conditions. Please read them carefully
                                        before using our website.</div><br>
                                        <ol class="column">
                                            <li><strong>Use of Website:&nbsp;</strong></li>
                                            <ul>
                                                <li>You may use our website only for lawful
                                                purposes and in accordance with these terms and conditions. You must not use our
                                                website in any way that may damage, disable, or impair the website or interfere with
                                                other users' use of the website.</li>
                                            </ul>
                                            <li><strong>Intellectual Property:&nbsp;</strong></li>
                                            <ul>
                                                <li>All content on our website, including
                                                text, graphics, logos, images, and software, is the property of Sajh Dhaj Ke or its
                                                suppliers and is protected by copyright and other intellectual property laws. You
                                                may not copy, reproduce, modify, distribute, or display any content from our website
                                                without our prior written consent.</li>
                                            </ul>
                                            <li><strong>Product Information:&nbsp;</strong></li>
                                            <ul>
                                                <li>We make every effort to provide accurate
                                                and up-to-date product information on our website. However, we do not guarantee that
                                                the information is error-free or complete. We reserve the right to modify, suspend,
                                                or discontinue any product at any time without prior notice.</li>
                                            </ul>
                                            <li><strong>Pricing and Payment:&nbsp;</strong></li>
                                            <ul>
                                                <li>All prices on our website are in Indian
                                                rupees (INR) and are subject to change without notice. We accept payment through
                                                various payment methods, including credit/debit cards, net banking, and cash on
                                                delivery (COD). We reserve the right to refuse or cancel any order for any reason,
                                                including suspicion of fraud or unauthorized activity.</li>
                                            </ul>
                                            <li><strong>Shipping and Delivery:&nbsp;</strong></li>
                                            <ul>
                                                <li>We ship our products across India.
                                                Please refer to our Shipping and Delivery Information for details on shipping times,
                                                fees, and policies.</li>
                                            </ul>
                                            <li><strong>Returns and Refunds:&nbsp;</strong></li>
                                            <ul>
                                                <li>We accept returns of unused and undamaged
                                                products within 3 days of delivery. Please refer to our Return Policy for details on
                                                the return process and eligibility criteria. We reserve the right to refuse any
                                                returns that do not meet our policy requirements.</li>
                                            </ul>
                                            <li><strong>Disclaimer of Warranties:&nbsp;</strong></li>
                                            <ul>
                                                <li>We make no representations or
                                                warranties of any kind, express or implied, about the completeness, accuracy,
                                                reliability, suitability, or availability of our website or the information,
                                                products, services, or related graphics on our website.</li>
                                            </ul>
                                            <li><strong>Limitation of Liability:&nbsp;</strong></li>
                                            <ul>
                                                <li>We shall not be liable for any
                                                direct, indirect, incidental, special, or consequential damages arising from the use
                                                of our website or the purchase or use of our products.</li>
                                            </ul>
                                            <li><strong>Governing Law and Jurisdiction:&nbsp;</strong></li>
                                            <ul>
                                                <li>These terms and conditions
                                                shall be governed by and construed in accordance with the laws of India. Any
                                                disputes arising from or related to these terms and conditions shall be subject to
                                                the exclusive jurisdiction of the courts in New Delhi, India.</li>
                                            </ul>
                                        </ol>
                                    <br>
                                    <div class="column">If you have any questions or concerns about our terms and
                                        conditions, please contact us. By using our website, you agree to comply with these
                                        terms and conditions.</div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
