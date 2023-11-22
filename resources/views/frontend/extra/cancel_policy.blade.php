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
        }
        ol{
            list-style: number;
            padding-left: 20px;
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
                    <span></span> Cancellation Policy
                </div>
            </div>
        </div>
        <section class="hero-2 bg-green">
            <div class="hero-content">
                <div class="container">
                    <div class="text-center">
                        <h1 class="mb-20 wow fadeIn animated font-xxl fw-900 heading-text">
                            Cancellation Policy
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-border pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="page-content page-content--medium rte">
                        <div class="page" title="Cancellation Policy">
                            <div class="section">
                                <div class="layoutArea">
                                    <div class="column">At Sajh Dhaj Ke, we understand that circumstances may arise where you need to cancel your 
                                        order. We strive to provide a seamless cancellation process for our customers. Please carefully review our cancellation 
                                        policy outlined below:
                                    </div>
                                    <br>
                                    <ol class="column">
                                        <strong><li>Order Cancellation Process:</li></strong>
                                        To cancel your order, please follow these steps:
                                        <ul>
                                            <li>Log in to your account on our website.</li>
                                            <li>Go to the "My Account" section.</li>
                                            <li>Click on the "Order" tab to view your order history.</li>
                                            <li>Check the status of your order.</li>
                                            <li>If the order status is "Confirmed," you can proceed with the cancellation request.</li>
                                            <li>If the order status is "Shipped," unfortunately, the order cannot be canceled.</li>
                                        </ul>
                                        <strong><li>Contacting Customer Care:</li></strong>
                                        <ul>
                                            <li>If you need assistance with canceling your order or have any related queries, our dedicated customer care team is here to help.</li>
                                            <li>You can reach our customer care representatives by calling our helpline at +91 81600 55855.</li>
                                            <li>Our customer care team will guide you through the cancellation process and address any concerns you may have.</li>
                                        </ul>
                                        <strong><li>Refunds and Order Status Updates:</li></strong>
                                        <ul>
                                            <li>Once your cancellation request is successfully processed, we will initiate the refund as per our refund policy, which may vary depending on the payment method and financial institution.</li>
                                            <li>You will receive updates regarding the cancellation and refund status via email or notification within your account.</li>
                                        </ul>
                                        <strong><li>Exceptions and Non-Cancelable Orders:</li></strong>
                                        <ul>
                                            <li>Please note that certain products or services may be non-cancelable or non-refundable. Any such exceptions will be clearly communicated on the respective product pages or during the checkout process.</li>
                                        </ul>
                                        <strong><li>Changes to the Cancellation Policy:</li></strong>
                                        <ul>
                                            <li>We reserve the right to modify or update our cancellation policy at any time without prior notice. Any changes will be effective immediately upon posting the revised policy on our website.</li>
                                            <li>If you have any further questions or require additional assistance, please don't hesitate to contact our customer care team. We are committed to providing you with exceptional service and support throughout your shopping experience.</li>
                                        </ul>
                                    </ol>
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
