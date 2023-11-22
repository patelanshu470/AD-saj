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
        .heading-text{
            font-family:"Playfair Display", serif;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                    <span></span> Shipping Policy
                </div>
            </div>
        </div>
        <section class="hero-2 bg-green">
            <div class="hero-content">
                <div class="container">
                    <div class="text-center">
                        <h1 class="mb-20 wow fadeIn animated font-xxl fw-900 heading-text">
                            Shipping Policy
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-border pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="page-content page-content--medium rte">
                        <div class="page" title="Shipping Policy">
                            <div class="section">
                                <div class="layoutArea">
                                    <div class="column">At Sajh Dhaj Ke, we strive to provide our customers with a
                                        hassle-free shopping experience. We offer fast and reliable shipping across India,
                                        so you can enjoy your new ethnic wear as soon as possible.</div>
                                    <br>
                                    <div class="column">
                                        <strong>Standard Shipping: 5-7 business days&nbsp;</strong>
                                    </div>
                                    <div class="column">
                                        <strong>Express Shipping: 2-3 business days&nbsp;</strong>
                                    </div>
                                    <br>
                                    <div class="column">
                                        Please note that the delivery times
                                        may vary depending on your location and the availability of the products. You will
                                        receive a tracking number once your order has been shipped, so you can keep an eye
                                        on your delivery status.
                                    </div>
                                    <br>
                                    <div class="column">
                                        We take great care in packaging your products to ensure they arrive in perfect
                                        condition. However, if you receive a damaged or defective product, please contact us
                                        within 48 hours of receiving your order, and we will be happy to assist you with a
                                        replacement or a refund.
                                    </div>
                                    <br>
                                    <div class="column">
                                        If you have any questions or concerns about your order or our shipping policy, please feel free to contact us. We are always here to help!.
                                    </div>
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
