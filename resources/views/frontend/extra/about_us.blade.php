@extends('frontend.layouts.fullLayoutMaster')


@section('content')
    <style>
        .hero-2 {
            padding: 94px 0 63px;
            min-height: 420px;
        }

        .bg-green {
            background-color: #f1e8e8;
        }

        @media screen and (min-width: 741px) {
            .section__header {
                margin-bottom: min(40px, var(--vertical-breather));
            }

            .section__footer {
                margin-top: min(40px, var(--vertical-breather));
            }
        }

        .section__header {
            max-width: 1000px;
            margin-bottom: min(32px, var(--vertical-breather));
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        .match-height > [class*=col] {
            display: flex;
            flex-flow: column;
        }
        .match-height > [class*=col] > .card {
            flex: 1 1 auto;
        }
        .match-heights > [class*=col] {
            display: flex;
            flex-flow: column;
        }
        .match-heights > [class*=col] > .item {
            flex: 1 1 auto;
        }
        ol, ul {
        list-style: auto;
        }

        h2,
        h3,
        h4,
        h5,
        h6 {}

        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            outline: none;
        }

        a,
        a:active,
        a:focus {
            color: #333;
            text-decoration: none;
            transition-timing-function: ease-in-out;
            -ms-transition-timing-function: ease-in-out;
            -moz-transition-timing-function: ease-in-out;
            -webkit-transition-timing-function: ease-in-out;
            -o-transition-timing-function: ease-in-out;
            transition-duration: .2s;
            -ms-transition-duration: .2s;
            -moz-transition-duration: .2s;
            -webkit-transition-duration: .2s;
            -o-transition-duration: .2s;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        span,
        a,
        a:hover {
            display: inline-block;
            text-decoration: none;
            color: inherit;
        }

        .section-head {
            margin-bottom: 60px;
        }

        .section-head h4 {
            position: relative;
            padding: 0;
            color: #751d1c;
            line-height: 1;
            letter-spacing: 0.3px;
            font-size: 34px;
            font-weight: 700;
            text-align: center;
            text-transform: none;
            margin-bottom: 30px;
        }

        .section-head h4:before {
            content: '';
            width: 60px;
            height: 3px;
            background: #751d1c;
            position: absolute;
            left: 0px;
            bottom: -10px;
            right: 0;
            margin: 0 auto;
        }

        .section-head h4 span {
            font-weight: 700;
            padding-bottom: 5px;
            color: #2f2f2f
        }

        p.service_text {
            color: #cccccc !important;
            font-size: 16px;
            line-height: 28px;
            text-align: center;
        }

        .section-head p,
        p.awesome_line {
            color: #818181;
            font-size: 16px;
            line-height: 28px;
            text-align: center;
        }

        .extra-text {
            font-size: 34px;
            font-weight: 700;
            color: #2f2f2f;
            margin-bottom: 25px;
            position: relative;
            text-transform: none;
        }

        .extra-text::before {
            content: '';
            width: 60px;
            height: 3px;
            background: #751d1c;
            position: absolute;
            left: 0px;
            bottom: -10px;
            right: 0;
            margin: 0 auto;
        }

        .extra-text span {
            font-weight: 700;
            color: #751d1c;
        }

        .item {
            background: #fff;
            text-align: center;
            padding: 30px 25px;
            -webkit-box-shadow: 0 0px 25px rgba(0, 0, 0, 0.07);
            box-shadow: 0 0px 25px rgba(0, 0, 0, 0.07);
            border-radius: 20px;
            border: 1px solid rgba(0, 0, 0, 0.07);
            margin-bottom: 30px;
            -webkit-transition: all .5s ease 0;
            transition: all .5s ease 0;
            transition: all 0.5s ease 0s;
        }

        .item:hover {
            background: #751d1c;
            box-shadow: 0 8px 20px 0px rgba(0, 0, 0, 0.2);
            -webkit-transition: all .5s ease 0;
            transition: all .5s ease 0;
            transition: all 0.5s ease 0s;
        }

        .item:hover .item,
        .item:hover span.icon {
            background: #fff;
            border-radius: 10px;
            -webkit-transition: all .5s ease 0;
            transition: all .5s ease 0;
            transition: all 0.5s ease 0s;
        }

        .item:hover h6,
        .item:hover p {
            color: #fff;
            -webkit-transition: all .5s ease 0;
            transition: all .5s ease 0;
            transition: all 0.5s ease 0s;
        }

        .item .icon {
            font-size: 65px;
            margin-bottom: 25px;
            color: #751d1c;
            width: 90px;
            height: 90px;
            line-height: 96px;
            border-radius: 50px;
        }

        .item .icon img{
            width: 55px;
        }

        .item .feature_box_col_one {
            background: rgba(247, 198, 5, 0.20);
            color: #751d1c
        }

        .item .feature_box_col_two {
            background: rgba(255, 77, 28, 0.15);
            color: #751d1c
        }

        .item .feature_box_col_three {
            background: rgba(0, 147, 38, 0.15);
            color: #751d1c
        }

        .item .feature_box_col_four {
            background: rgba(0, 108, 255, 0.15);
            color: #751d1c
        }

        .item .feature_box_col_five {
            background: rgba(146, 39, 255, 0.15);
            color: #751d1c
        }

        .item .feature_box_col_six {
            background: rgba(23, 39, 246, 0.15);
            color: #751d1c
        }

        .item p {
            font-size: 15px;
            line-height: 26px;
        }

        .item h6 {
            margin-bottom: 20px;
            color: #2f2f2f;
        }

        .mission p {
            margin-bottom: 10px;
            font-size: 15px;
            line-height: 28px;
            font-weight: 500;
        }

        .mission i {
            display: inline-block;
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            background: #751d1c;
            border-radius: 50%;
            color: #fff;
            font-size: 25px;
        }

        .mission .small-text {
            margin-left: 10px;
            font-size: 13px;
            color: #666;
        }

        .skills {
            padding-top: 0px;
        }

        .skills .prog-item {
            margin-bottom: 25px;
        }

        .skills .prog-item:last-child {
            margin-bottom: 0;
        }

        .skills .prog-item p {
            font-weight: 500;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .skills .prog-item .skills-progress {
            width: 100%;
            height: 10px;
            background: #e0e0e0;
            border-radius: 20px;
            position: relative;
        }

        .skills .prog-item .skills-progress span {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            background: #751d1c;
            width: 10%;
            border-radius: 10px;
            -webkit-transition: all 1s;
            transition: all 1s;
        }

        .skills .prog-item .skills-progress span:after {
            content: attr(data-value);
            position: absolute;
            top: -5px;
            right: 0;
            font-size: 10px;
            font-weight: 600;
            color: #fff;
            background: rgba(0, 0, 0, 0.9);
            padding: 3px 7px;
            border-radius: 30px;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                    <span></span> About Us
                </div>
            </div>
        </div>
        <section class="hero-2 bg-green">
            <div class="hero-content">
                <div class="container">
                    <div class="text-center">
                        <h1 class="mb-20 wow fadeIn animated font-xxl fw-900">
                            About Us<span class=""></span>
                        </h1>
                        <p class="w-50 m-auto mb-50 wow fadeIn animated">Everything you need to know about Sajh Dhaj Ke…</p>
                        <p class="wow fadeIn animated">
                            <a class="btn btn-brand btn-lg font-weight-bold text-white border-radius-5 btn-shadow-brand hover-up mb-10"
                                href="{{ route('user.contact') }}">Contact Us</a>
                            <a
                                class="btn btn-outline btn-lg btn-brand-outline font-weight-bold text-brand bg-white text-hover-white ml-15 border-radius-5 btn-shadow-brand hover-up mb-10">Support
                                Center</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-border pt-50 pb-50" style="border-bottom: 0;">
            <div class="container">
                <div class="row">
                    <div id="shopify-section-template--18168772428056__0fab783d-980b-4b07-b87f-fd6fafd06fee"
                        class="shopify-section shopify-section--custom-html">
                        <style>
                            #shopify-section-template--18168772428056__0fab783d-980b-4b07-b87f-fd6fafd06fee {
                                --heading-color: 177, 60, 68;
                                --text-color: 177, 60, 68;

                                --section-background: 255, 249, 245;
                            }
                        </style>

                        <section class="section ">
                            <div class="container">
                                <div class="section__color-wrapper section__color-wrapper--boxed">
                                    <div class=" ">
                                        <header class="section-head text-container">
                                            <h4><span></span> About</h4>
                                        </header>
                                        <div class="html">
                                            <p style="text-align: justify;padding-bottom: 10px;">Welcome to Sajh Dhaj Ke, your ultimate
                                                destination
                                                for premium quality wedding dupattas and salwar kamiz. We specialize in
                                                crafting exquisite ethnic wear that is perfect for special occasions like
                                                weddings, engagements, and other festivities.
                                            </p>
                                            <p style="text-align: justify;padding-bottom: 10px;">At Sajh Dhaj Ke, we believe that fashion should
                                                be
                                                an extension of your personality, and that's why we offer a wide range of
                                                styles, designs, and colors to suit your taste and preferences. Our
                                                collection is carefully curated and features the latest trends in ethnic
                                                wear, ensuring that you always look your best, no matter the occasion.
                                            </p>
                                            <p style="text-align: justify;padding-bottom: 10px;">Our team of skilled artisans takes great pride
                                                in
                                                creating each piece with utmost care and attention to detail. From the
                                                finest fabrics to intricate embellishments, every aspect of our products is
                                                designed to reflect the beauty and grandeur of Indian weddings and
                                                traditions.
                                            </p>
                                            <p style="text-align: justify;padding-bottom: 10px;">We are committed to providing our customers with
                                                the best possible shopping experience, and that's why we offer fast and
                                                reliable shipping, easy returns, and exceptional customer service. Whether
                                                you're looking for a stunning bridal dupatta or a stylish salwar kamiz, we
                                                have something for everyone.
                                            </p>
                                            <p style="">Thank you for choosing Sajh Dhaj Ke. We look
                                                forward to helping you find your perfect wedding ensemble.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </section>
        <section class="section-border pt-50 pb-50" style="border-top: 0;border-bottom: 0;">
            <div class="container">
                <div class="row match-height">
                    <div class="col-lg-12">
                        <div class="card section__color-wrapper section__color-wrapper--boxed"
                            style="padding: 17px;background: #f1e8e8;border-radius: 1.25rem;">
                            <div class=" vertical-breather">
                                <header class="section-head text-container">
                                    <h4><span>Our</span> Vision</h4>
                                </header>
                                <div class="html">
                                    <p style="text-align: justify">Our vision is to establish ourselves as the premier
                                        Indian
                                        fashion brand, known for our exceptional quality, unique designs, and unwavering
                                        commitment to celebrating Indian heritage and culture.
                                        <br><br>
                                        We believe that fashion is a reflection of one's individuality and culture, and we
                                        aim to empower our customers to express their unique style and identity through our
                                        products. Our focus on providing the best quality fabrics and materials, combined
                                        with our passion for innovation and creativity, ensures that our customers receive
                                        truly unique and exceptional pieces that they will cherish for years to come.
                                        <br><br>
                                        At the heart of our vision is our commitment to supporting and promoting Indian
                                        heritage and culture. We believe that our rich cultural traditions and artistic
                                        heritage should be celebrated and preserved, and we are dedicated to playing a role
                                        in promoting Indian craftsmanship, artistry, and creativity.
                                        <br><br>
                                        Through our products and services, we strive to inspire and educate people about the
                                        beauty and richness of Indian culture. We hope to be a brand that not only provides
                                        exquisite fashion, but also fosters a deeper appreciation for Indian culture, and
                                        encourages people to embrace and celebrate their own cultural heritage.
                                        <br><br>
                                        Overall, our vision is to be the go-to destination for anyone seeking the finest
                                        Indian fashion, while also promoting and supporting the vibrant and diverse culture
                                        of India.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="feat bg-gray pb-5" style="padding-top: 39px;">
            <div class="container">
                <div class="row match-heights">
                    <div class="section-head col-sm-12">
                        <h4><span>Why Choose</span> Us?</h4>
                        <p>At Sajh Dhaj Ke, we're dedicated to providing the best possible shopping experience for our
                            customers. Here are just a few reasons why you should choose us for your clothing needs:</p>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="item"> <span class="icon feature_box_col_one"><img src="{{ asset('public/frontend/assets/imgs/icon/Quality-Selection.png') }}" alt=""></span>
                            <h6>Quality Selection</h6>
                            <p>We offer a curated collection of premium South-Asian fashion, clothing, jewellery, and accessories. Our products are carefully chosen for their exceptional quality, ensuring you receive the best of the best.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="item"> <span class="icon feature_box_col_two"><img src="{{ asset('public/frontend/assets/imgs/icon/Cultural-Authenticity.png') }}" alt=""></span>
                            <h6>Cultural Authenticity</h6>
                            <p>We celebrate the rich cultural heritage of South Asia through our offerings. Each item embodies the essence of traditional craftsmanship and contemporary designs, allowing you to embrace your roots in style.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="item"> <span class="icon feature_box_col_three"><img src="{{ asset('public/frontend/assets/imgs/icon/Superior-Customer-Service.png') }}" alt=""></span>
                            <h6>Superior Customer Service</h6>
                            <p>Our dedicated customer service team is committed to providing you with a seamless shopping experience. We are always available to address your queries, assist with orders, and ensure your satisfaction every step of the way.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="item"> <span class="icon feature_box_col_four"><img src="{{ asset('public/frontend/assets/imgs/icon/Secure-Transactions.png') }}" alt=""></span>
                            <h6>Secure Transactions</h6>
                            <p>Your security is our priority. We provide a secure online platform for your transactions, safeguarding your personal information and ensuring a worry-free shopping experience.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="item"> <span class="icon feature_box_col_five"><img src="{{ asset('public/frontend/assets/imgs/icon/Fast-Reliable-Shipping.png') }}" alt=""></span>
                            <h6>Fast and Reliable Shipping</h6>
                            <p>We understand the excitement of receiving your order promptly. That's why we prioritize fast and reliable shipping, ensuring your items reach you in a timely manner, no matter where you are.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="item"> <span class="icon feature_box_col_six"><img src="{{ asset('public/frontend/assets/imgs/icon/Unparalleled-Value.png') }}" alt=""></span>
                            <h6>Unparalleled Value</h6>
                            <p> We strive to offer exceptional value for your money. From competitive pricing to exclusive deals and promotions, we aim to make your South-Asian fashion shopping experience with us worthwhile.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section-border pt-50 pb-50" style="border-top: 0;">
            <div class="container">
                <div class="row match-height">
                    <div class="col-lg-12">
                        <div class="card section__color-wrapper section__color-wrapper--boxed"
                            style="padding: 17px;background: #f1e8e8;border-radius: 1.25rem;">
                            <div class=" vertical-breather">
                                <header class=" section-head text-container">
                                    <h4><span>Our</span> Mission</h4>
                                </header>
                                <div class="html">
                                    <p style="text-align: justify;">Our mission is to provide our customers with the best
                                        quality, unique, and stylish Indian fashion products while also promoting and
                                        preserving Indian heritage and culture.
                                        <br><br>
                                        To achieve this mission, we are committed to the following:
                                        <br>
                                        <ol style="padding-left: 34px;font-size: 1rem;color: #465b52;">
                                            <li><strong>Providing the Best Quality Products: </strong>We aim to offer our customers the best quality
                                                products by carefully sourcing our materials and working with skilled artisans who
                                                use traditional techniques to create exquisite pieces.
                                            </li>
                                            <li><strong>Creating Unique and Stylish Designs: </strong> We strive to create unique and stylish designs
                                                that reflect the beauty and richness of Indian culture while also incorporating
                                                modern trends and styles.
                                            </li>
                                            <li><strong>Celebrating Indian Heritage and Culture: </strong> We are dedicated to promoting and
                                                preserving Indian heritage and culture by showcasing traditional craftsmanship,
                                                textiles, and design techniques in our products.
                                            </li>
                                            <li>
                                                <strong>Delivering Exceptional Customer Service: </strong> We believe that our customers are at the
                                                heart of our business, and we are committed to delivering exceptional customer
                                                service that exceeds their expectations.
                                            </li>
                                            <li>
                                                <strong>Fostering Sustainability: </strong> We are committed to minimizing our environmental impact
                                                and promoting sustainable practices throughout our supply chain.
                                            </li>
                                        </ol>
                                        <br>
                                        <p>Overall, our mission is to create a brand that not only provides exquisite fashion
                                            products but also fosters a deeper appreciation for Indian heritage and culture
                                            while delivering exceptional service and promoting sustainability.</p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
