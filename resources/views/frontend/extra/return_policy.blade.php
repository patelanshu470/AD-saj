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
                    <span></span> Return Policy
                </div>
            </div>
        </div>
        <section class="hero-2 bg-green">
            <div class="hero-content">
                <div class="container">
                    <div class="text-center">
                        <h1 class="mb-20 wow fadeIn animated font-xxl fw-900 heading-text">
                            Return Policy
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-border pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="page-content page-content--medium rte">
                        <div class="page" title="Return Policy">
                            <div class="section">
                                <div class="layoutArea">
                                <div class="column">At Sajh Dhaj Ke, we want you to have a seamless shopping experience, and we understand that occasionally you 
                                        may need to return a product. Please carefully review our return policy outlined below:
                                    </div>
                                    <br>
                                    <ol class="column">
                                        <strong><li>Return Process:</li></strong>
                                        To initiate a return, please follow these steps:
                                        <ul>
                                            <li>Log in to your account on our website.</li>
                                            <li>Go to the "My Account" section.</li>
                                            <li>Click on the "My Orders" tab to access your order history.</li>
                                            <li>Locate the specific order containing the item you wish to return.</li>
                                            <li>Click on the "Action" tab and select the product you want to return.</li>
                                            <li>Select the reason for the return from the available options.</li>
                                            <li>Attach an unboxing video that clearly shows the condition of the product.</li>
                                            <li>Ensure that all tags and packaging materials are intact, as products without their original tags may not be eligible for return.</li>
                                        </ul>
                                        <strong><li>Unboxing Video Requirement:</li></strong>
                                        <ul>
                                            <li>We require customers to make an unboxing video upon receiving their parcel.</li>
                                            <li>This video serves as valuable evidence in case you need to return the item.</li>
                                            <li>Please ensure that the unboxing video captures the product's condition and packaging.</li>
                                        </ul>
                                        <strong><li>Return Evaluation and Refund Process:</li></strong>
                                        <ul>
                                            <li>Once you have submitted the return request with the attached unboxing video, our customer service team will review your request.</li>
                                            <li>Our team will carefully evaluate the video and other relevant details provided.</li>
                                            <li>If the return request is validated, and all conditions are met, we will initiate the refund process.</li>
                                            <li>Refunds are typically processed within 5-7 business days after the return request is approved.</li>
                                        </ul>
                                        <strong><li>Customer Support and Assistance:</li></strong>
                                        <ul>
                                            <li>If you encounter any difficulties or have questions regarding the return process, please contact our customer support team.</li>
                                            <li>Our dedicated representatives are available to assist you and address any concerns you may have.</li>
                                        </ul>
                                        <strong><li>Exceptions and Non-Returnable Items:</li></strong>
                                        <ul>
                                            <li>Some items may not be eligible for return due to hygiene reasons, customization, or other specific circumstances.</li>
                                            <li>Any exceptions to our return policy will be clearly communicated on the product pages or during the checkout process.</li>
                                        </ul>
                                        <strong><li>Changes to the Return Policy:</li></strong>
                                        <ul>
                                            <li>We reserve the right to modify or update our return policy at any time without prior notice.</li>
                                            <li>Any changes will be effective immediately upon posting the revised policy on our website.</li>
                                            <li>We value your satisfaction and aim to provide you with exceptional service. If you have any further questions or require assistance with your return, please don't hesitate to contact our customer support team.</li>
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
