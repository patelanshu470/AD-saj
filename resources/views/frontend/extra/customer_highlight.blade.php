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
                    <span></span> Customer Highlight Policy
                </div>
            </div>
        </div>
        <section class="hero-2 bg-green">
            <div class="hero-content">
                <div class="container">
                    <div class="text-center">
                        <h1 class="mb-20 wow fadeIn animated font-xxl fw-900 heading-text">
                        Customer Highlight Policy
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-border pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="page-content page-content--medium rte">
                        <div class="page" title="Customer Highlight Policy">
                            <div class="section">
                                <div class="layoutArea">
                                    <div class="column">At Sajh Dhaj Ke, we value our customers and appreciate their trust in our brand. Our Customer Highlights 
                                        feature allows us to showcase photos and videos of customers wearing and using products they have purchased from our website. 
                                        Please carefully review our policy regarding the use of customer photos and videos:
                                    </div>
                                    <br>
                                    <ol class="column">
                                        <strong><li>Permission and Consent:</li></strong>
                                        <ul>
                                            <li>We always seek explicit permission and consent from our customers before using their photos and videos for the Customer Highlights feature.</li>
                                            <li>Prior to featuring any customer content, we ensure that the customer has provided consent through a designated opt-in process.</li>
                                        </ul>
                                        <strong><li>Ownership and Usage Rights:</li></strong>
                                        <ul>
                                            <li>By granting permission for the Customer Highlights feature, customers retain ownership of their content.</li>
                                            <li>However, customers grant Sajh Dhaj a non-exclusive, royalty-free, worldwide license to use, display, reproduce, and distribute their photos and videos for promotional purposes related to our products and services.</li>
                                        </ul>
                                        <strong><li>Prohibited Use of Customer Content:</li></strong>
                                        <ul>
                                            <li>It is strictly prohibited for any individual or entity to use customer photos and videos showcased in our Customer Highlights section for personal or commercial purposes without prior written consent from Sajh Dhaj ke.</li>
                                            <li>Unauthorized use, reproduction, distribution, or modification of customer content may result in legal action being taken against the infringing party.</li>
                                        </ul>
                                        <strong><li>Protection of Customer Privacy:</li></strong>
                                        <ul>
                                            <li>We respect our customers' privacy and take all necessary measures to protect their personal information.</li>
                                            <li>Customer photos and videos used for the Customer Highlights feature will be displayed in a manner that does not disclose sensitive personal information without the customer's explicit consent.</li>
                                        </ul>
                                        <strong><li>Request for Removal:</li></strong>
                                        <ul>
                                            <li>If a customer wishes to have their photo or video removed from the Customer Highlights feature, they can contact our customer support team.</li>
                                            <li>We will promptly review and respond to such requests, and the customer's content will be removed from the feature within a reasonable timeframe.</li>
                                        </ul>
                                        <strong><li>Changes to the Customer Highlights Feature Policy:</li></strong>
                                        <ul>
                                            <li>We reserve the right to modify or update our Customer Highlights feature policy at any time without prior notice.</li>
                                            <li>Any changes will be effective immediately upon posting the revised policy on our website.</li>
                                            <li>We appreciate the support and enthusiasm of our customers in sharing their experiences with our products. If you have any concerns or questions regarding the use of customer content or the Customer Highlights feature, please don't hesitate to contact our customer support team.</li>
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
