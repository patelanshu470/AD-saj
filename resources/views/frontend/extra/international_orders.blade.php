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
                    <span></span> International Orders
                </div>
            </div>
        </div>
        <section class="hero-2 bg-green">
            <div class="hero-content">
                <div class="container">
                    <div class="text-center">
                        <h1 class="mb-20 wow fadeIn animated font-xxl fw-900 heading-text">
                            International Orders
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-border pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="page-content page-content--medium rte">
                        <div class="page" title="International Orders">
                            <div class="section">
                                <div class="layoutArea">
                                    <div class="column">We ship across the globe via DHL.</div>
                                    <br>
                                    <div class="column">
                                        For International Orders, you can easily pay through your Debit/Credit cards or PayPal (available under Wallets). You can also pay through Bank Transfer by reaching out to us.
                                    </div>
                                    <div class="column">
                                        We charge International Shipping based on your location and order. 
                                        Shipping charges are automatically added to your order at the time of checkout. 
                                        No cancellation requests are accepted once the order is placed.
                                        We usually dispatch the products within 2-4 working days. 
                                    </div>
                                    <br>
                                    <div class="column">
                                        Products usually take 3-5 days to reach you after the dispatch, depending on your order. We ship via DHL.
                                        We try to dispatch the order as soon as possible but there may be a slight delay because of unavoidable circumstances. In case of delay (product not dispatched within estimated time period), you can contact us.
                                        Once your order is shipped, you will be contacted by DHL on the email and phone number provided while placing the order. 
                                    </div>
                                    <br>
                                    <div class="column">
                                    For any other queries, please email us on <strong>support@sajhdhajke.in</strong> and one of our team members will get in touch with you within <strong>24 hours.</strong> Please note our office timings are <strong>MON-SAT 9AM-5PM ONLY.</strong>
                                    </div>
                                    <br>
                                    <div class="column">
                                        No exchange / return is applicable on international orders. For any size related queries please feel free to contact us before you place an order.
                                        International Orders are dispatched as soon as all the products in your order are ready with us. We don't dispatch incomplete orders.
                                    </div>
                                    <br>
                                    <div class="column">
                                    *As the recipient, you are liable for all import duties, customs, VAT and any other local sales taxes levied by the country we are shipping to; payment of these might be required to release your order from customs on arrival.
                                    </div>
                                    <br>
                                    <div class="column">
                                    Our delivery partners are authorized to deposit duties on behalf of the customer and the customer can then directly clear these with the delivery partners on receiving the packet.
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <ul></ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
