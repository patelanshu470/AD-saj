@extends('frontend.layouts.fullLayoutMaster')

@section('page-style')
<style>
    body{
        overflow-x: hidden !important;
    }
    .slick-track{
        height: 800px;
    }
    .zoomWindow{
        height: 800px;
    }
    .slider-nav-thumbnails{
        height: 160px;
    }
    .product-extra-link2 .active-wishlist{
        background-color: #751d1c;
        border: 1px solid transparent;
        color: #fff;
    }
    .slick-track{
        margin-left: 0;
    }
    .slick-slide{
        height: 0;
    }
    .color_images .slick-track{
        height: 100px;
    }
    .color_images {
        height: 100%;
    }
    .view_review_image{
        width: 100px;
    border: 2px #333;
    /* margin-bottom: 20px; */
    margin-bottom: 0;
    }
    .slick-list .draggable{
        height: 200px;
    }
    .slider-nav-thumbnails .slick-list .slick-track{
        height: 200px;
    }
    .product-cart-wrap:hover .product-action-1 .active-wishlist{
    background-color: #751d1c;
    border: 1px solid transparent;
    color: #fff;
}
.color_class_div{
    width: 500px;
}
#color_add_class{
    width: 500px;
}
.accordion-button:not(.collapsed) {
    color: #751d1c;
    background-color: #f1e8e8;
}
.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

.accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}
.accordion-button:focus {
    border-color: #751d1c;
    box-shadow: none;
}
.title-detail{
    font-weight:500;
    line-height:43px;
    font-size: 36px;
}
</style>
{{-- modal css... --}}
<style>
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }
    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border-radius: 5px;
        width: 40%;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .active_select_image {
        border: double;
        border-color: brown;
    }
    .slider-nav-thumbnails .slick-list .slick-track .slick-slide img{
        height: 160px;
    }
    .image-slider{
        height: 800px;
        width: 640px;
        object-fit: contain;
        background-color: #fff;
    }
    @media only screen and (max-width: 768px) {
    /* For mobile phones: */
        .slick-list .slick-slide{
            width: 90px;
        }
        .draggable {
            height: 410px;
        }
        .slider-nav-thumbnails .slick-list.draggable{
            height: 100% !important;
        }
        .zoomContainer{
            height: 410px;
            /* position: inherit !important; */
            left: 0 !important;
        }
        .zoomWindowContainer div{
            height: 410px;
        }
        .slider-nav-thumbnails .slick-list .slick-track .slick-slide img{
            width: 95px;
            height: 80px;
        }
        #color_add_class{
            width: 250px;
        }
        .color_class_div{
            width: 250px;
        }
        .modal-content{
            width: 80%;
        }
        .detail-gallery .slick-slider.slider-nav-thumbnails{
            height: 92px;
        }
        .image-slider
        {
            height: 410px;
            width: 520px;
            object-fit: contain;
            background-color: #fff;
        }

        .product-img-action-wrap{
                height: 155px;
            }
        .product-cart-wrap .product-content-wrap h2{
            font-size: 14px;
            font-weight: 500;
        }
        .product-cart-wrap .product-content-wrap .product-price span{
            font-size: 13px;
            font-weight: bold;
            color: #751d1c;
        }
        .product-cart-wrap .product-content-wrap .product-price span.old-price{
            font-size: 11px;
            font-weight: 400;
            color: #90908e;
            margin: 0 0 0 7px;
            text-decoration: line-through;
        }
        .title-detail{
            line-height: 30px;
            font-size: 24px;
        }
    }
    .match-height > [class*=col] {
        display: flex;
        flex-flow: column;
    }
    .match-height > [class*=col] > .product-cart-wrap {
        flex: 1 1 auto;
    }
    .left_button_set .slider-btn.slider-prev {
        right: 62px;
        left: revert;
    }

/* @media only screen and (max-width: 1024px) {
    .slider-nav-thumbnails .slick-list .slick-track .slick-slide img{
        height: 122px;
    }
} */
@media only screen and (min-width: 1024px) and (max-width: 1024px) {
    .slider-nav-thumbnails .slick-list .slick-track .slick-slide img{
        height: 122px;
    }
    .detail-gallery .slick-slider.slider-nav-thumbnails{
        height: 122px;
    }
}

.share-container {
  position: relative;
  display: inline-block;
}

.share-options {
  display: none;
  position: absolute;
  top: -226%;
  left: 0;
  background-color: #f9f9f9;
  padding: 8px;
  border-radius: 4px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  z-index: 1;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease;
}

.share-options.active {
  display: block;
  opacity: 1;
  pointer-events: auto;
}

.social-media-list {
  list-style-type: none;
  padding: 0;
  margin: 0;
  display: flex;
}

.detail-extralink{
    margin-top: 50px !important;
}

.social-media-list li {
  display: inline-block;
  margin-right: 13px;
}

.social-media-list li:last-child {
  margin-right: 0;
}

.social-media-list a {
  color: #333;
  text-decoration: none;
}

.social-media-list a:hover {
  color: #000;
}

.fab {
    font-size: 20px;
}

.social-media-list a {
  color: #333;
  text-decoration: none;
  transition: color 0.3s ease;
}

.social-media-list a:hover {
  color: #000;
}

/* Add custom color for each social media icon when hovered */
.social-media-list a:hover .fa-whatsapp {
  color: #25d366; /* Green color for WhatsApp */
}

.social-media-list a:hover .fa-instagram {
  color: #e4405f; /* Pink color for Instagram */
}

.social-media-list a:hover .fa-facebook {
  color: #3b5998; /* Blue color for Facebook */
}

.social-media-list a:hover .fa-twitter {
  color: #1da1f2; /* Blue color for Twitter */
}

.social-media-list a:hover .fa-pinterest {
  color: #bd081c; /* Red color for Pinterest */
}
</style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                    <span></span> <a href="{{ route('user.shop') }}">Shop</a>
                    <span></span> Details
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider">
                                            <figure class="border-radius-10">
                                                <img src="{{ URL::asset('public/images/product/'.$product->thumbnail)}}" alt="product image">
                                            </figure>

                                        @if (isset($product->getProductGallary) && !empty($product->getProductGallary) && count($product->getProductGallary) > 0)
                                        @foreach ($product->getProductGallary as $gallary)
                                        <figure class="border-radius-10">
                                            <img src="{{ URL::asset('public/images/product/'.$gallary->path)}}" alt="product image">
                                        </figure>
                                        @endforeach
                                        @endif

                                        {{-- @if (isset($product->getProductInformation) && !empty($product->getProductInformation) && count($product->getProductInformation) > 0)
                                        @foreach ($product->getProductInformation as $attach)
                                        <figure class="border-radius-10">
                                            <img src="{{ URL::asset('public/images/documents/'.$attach->image)}}" alt="product image">
                                        </figure>
                                        @endforeach
                                        @endif --}}
                                        </div>
                                        <!-- THUMBNAILS -->
                                        <div class="slider-nav-thumbnails pl-15 pr-15">
                                            <div><img src="{{ URL::asset('public/images/product/'.$product->thumbnail)}}" alt="product image" style=""></div>
                                            @foreach ($product->getProductGallary as $gallary)
                                            <div><img src="{{ URL::asset('public/images/product/'.$gallary->path)}}" alt="product image" style=""></div>
                                            @endforeach
                                            {{-- @foreach ($product->getProductInformation as $attach)
                                            <div id="click_image_get{{ $attach->id }}" style="width: 86px"><img src="{{ URL::asset('public/images/documents/'.$attach->image)}}" alt="product image" style=""></div>
                                            @endforeach --}}
                                        </div>
                                    </div>
                                    <!-- End Gallery -->
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{ $product->name }}</h2>
                                        <div class="product-detail-rating">
                                            <div class="pro-details-brand">
                                                <span> Category: <a href="{{ route('user.subcategory',$product->category->slug) }}">{{ $product->category->name }}</a></span>
                                            </div>
                                            <div class="product-rate-cover text-end">
                                                        @php
                                                            $avg_percentage = $avg_rating * 20;
                                                        @endphp
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:{{ $avg_percentage }}%">
                                                    </div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> ({{ count($ProductReview) }} reviews)</span>
                                            </div>
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                @if ($countryPrice == 'IN')
                                                    <ins><span class="text-brand">₹{{ $product->selling_price }}</span></ins>
                                                    <ins><span class="old-price font-md ml-15">₹{{ number_format($product->original_price, 2, '.', ',') }}</span></ins>
                                                @else
                                                    <ins><span class="text-brand">${{ $product->selling_price_dollar }}</span></ins>
                                                    <ins><span class="old-price font-md ml-15">${{ number_format($product->original_price_dollar, 2, '.', ',') }}</span></ins>
                                                @endif
                                                <span class="save-price  font-md color3 ml-15">{{ $product->discount }}% Off</span>
                                                <span class="font-small ml-15 text-muted">MRP (Inclusive of all taxes)</span>
                                            </div>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                        <div class="color_class_div">
                                            <strong class="mr-10">Select Colors:</strong><span class="color_name"></span>
                                        <div style="display: -webkit-box;
                                            display: -webkit-flex;
                                            display: flex;
                                            -webkit-flex-direction: row;
                                            flex-direction: row;
                                            flex-wrap: wrap;" id="color_add_class">
                                            @if (!$varient == null)
                                                @foreach ($varient as $var)
                                                <div style="margin-left: 5px;"><a href="{{ route('user.shop-detail', $var->slug) }}"><img src="{{ URL::asset('public/images/product_color/'.$var->color_image)}}" alt="product image" style="height: 100px;" class="color_click_image" data-color="{{ $var->id }}" data-color_name="{{ $var->color }}" id="color_click_image{{ $var->id }}"></a></div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <span id="color-error" style="display: none; color: #ea5455">The color field is required.</span>
                                    </div>
                                        <span id="color-error" style="display: none; color: #ea5455">The color field is required.</span>
                                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        <div class="detail-extralink">
                                            {{-- <div class="detail-qty border radius"> --}}
                                                <div class="share-container">

                                                    <div class="share-options" id="shareOptions">
                                                      <ul class="social-media-list">
                                                        <li><a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}"><i class="fab fa-whatsapp"></i></a></li>
                                                        <li><a href="https://www.instagram.com/sharer.php?u={{ urlencode(url()->current()) }}"><i class="fab fa-instagram"></i></a></li>
                                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"><i class="fab fa-facebook"></i></a></li>
                                                        <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}"><i class="fab fa-twitter"></i></a></li>
                                                        <li><a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}"><i class="fab fa-pinterest"></i></a></li>
                                                      </ul>
                                                    </div>
                                                  </div>
                                            {{-- </div> --}}
                                            <div class="detail-qty border radius" style="display: none;">
                                                <a href="#" class="qty-down"><i
                                                        class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val">1</span>
                                                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                            <div class="product-extra-link2">
                                                <a href="javascript:void(0)" class="share-button" id="shareButton"><i class="fi fi-rs-share" style="font-size: 20px;"></i></a>
                                                <button type="submit" class="button button-add-to-cart" data-product_id="{{ $product->id }}">Add to
                                                    Cart</button>
                                                <a aria-label="Add To Wishlist" data-product_id="{{$product->id}}" class="action-btn hover-up @if (array_key_exists($product->id,$wishlist)){{'active-wishlist remove-to-wishlist'}}@else{{'add-to-wishlist'}} @endif"
                                                    href="javascript:void(0);" @if (array_key_exists($product->id,$wishlist))
                                                    data-wishlist_item_id="{{$wishlist[$product->id]}}" @endif><i class="fi-rs-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="pb-2 pt-10" style="display: flex;flex-wrap: wrap;">
                                            <a class="flex items-center space-x-2 mb-3 w-1/2 md:pr-4" href="javascript:void(0)" style="display: flex;
                                            width: 50%;">
                                                <svg class="flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="11.9989" cy="11.9989" r="10.4091" stroke="#223330"></circle>
                                                    <path d="M15.8182 6.54688H17.4545L7.63636 17.456H6L15.8182 6.54688Z" fill="#223330"></path>
                                                    <circle cx="8.72869" cy="8.72869" r="1.68182" stroke="#223330"></circle>
                                                    <circle cx="15.2717" cy="15.2717" r="1.68182" stroke="#223330"></circle>
                                                </svg>
                                                <span class="primary-color leading-18 text-15 md:text-sm font-normal hover:text-red" style="margin-left: 8px;color:black">100% Purchase Protection</span>
                                            </a>
                                                    <a class="flex items-center space-x-2 mb-3 w-1/2" href="javascript:void(0)" style="display: flex;
                                                    width: 50%;">
                                                    <svg class="flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="11.9989" cy="11.9989" r="10.4091" stroke="#223330"></circle>
                                                        <path d="M4.15234 9.33594L6.35473 12.326L9.78286 10.5769" stroke="#223330" stroke-miterlimit="10"></path>
                                                        <path d="M6.4375 12.0011C6.4375 8.92841 8.92841 6.4375 12.0011 6.4375C15.0739 6.4375 17.5648 8.92841 17.5648 12.0011C17.5648 15.0739 15.0739 17.5648 12.0011 17.5648" stroke="#223330" stroke-linejoin="round"></path>
                                                    </svg>
                                                    <span class="primary-color leading-18 text-15 md:text-sm font-normal hover:text-red other-msg" style="margin-left: 8px;color:black">
                                                        Easy to Resturn 3 Days ( india ).            </span>
                                                    <span class="primary-color leading-18 text-15 md:text-sm font-normal hover:text-red non-rtn" style="display:none;">This product is not returnable</span>
                                                </a>
                                                <a class="flex items-center space-x-2 mb-3 w-1/2 md:pr-4" href="javascript:void(0)" style="display: flex;
                                                width: 50%;">
                                                <svg class="flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="11.9989" cy="11.9989" r="10.4091" stroke="#223330"></circle>
                                                    <path d="M14.0197 9.20548L14.1353 9.52383L14.4738 9.53457L19.0167 9.67866C19.4856 9.69354 19.6777 10.2879 19.3061 10.5744L15.7219 13.3382L15.4516 13.5466L15.5473 13.8743L16.8142 18.2129C16.9453 18.6621 16.4427 19.0292 16.0547 18.7677L12.2813 16.2239L12.0018 16.0355L11.7223 16.2239L7.94884 18.7677C7.56083 19.0292 7.05824 18.6621 7.1894 18.2129L8.45628 13.8743L8.55196 13.5466L8.28164 13.3382L4.69742 10.5744C4.32587 10.2879 4.51795 9.69354 4.98689 9.67866L9.52976 9.53457L9.86828 9.52383L9.98388 9.20548L11.5318 4.94273C11.6913 4.50361 12.3123 4.50361 12.4718 4.94273L14.0197 9.20548Z" stroke="#223330"></path>
                                                </svg>
                                                <span class="primary-color leading-18 text-15 md:text-sm font-normal hover:text-red" style="margin-left: 8px;color:black">Assured Quality</span>
                                            </a>
                                            <a class="flex items-center space-x-2 mb-3 w-1/2" href="javascript:void(0)" style="display: flex;
                                            width: 50%;">
                                                <svg class="flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="3.5" y="5.5" width="17" height="15" fill="" stroke="#223330"></rect>
                                                    <rect x="2.5" y="3.5" width="19" height="6" fill="" stroke="#223330"></rect>
                                                    <line x1="14" y1="17.5" x2="18" y2="17.5" stroke="#223330"></line>
                                                </svg>
                                                <span class="primary-color leading-18 text-15 md:text-sm font-normal hover:text-red" style="margin-left: 8px;color:black">Free shipping world wide</span>
                                            </a>
                                        </div>
                                        <div class="short-desc mb-30">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Shipping & Returns
                                                    </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        We offer a hassle-free exchange and returns policy for our products, allowing you to request a return or exchange within 48 hours of delivery.
                                                        To be eligible for a return or exchange, the items must be in their original condition with all tags intact. We kindly ask that you ensure the
                                                        product is unused, undamaged, and in its original packaging.
                                                        <br>
                                                        <a href="{{route('user.return')}}">Read More</a>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        FAQs
                                                    </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <strong>How To Track The Order Once Shipped?</strong><br>
                                                            After placing your order, you will receive an email containing the tracking details. This email will provide you with a tracking number that you
                                                            can use to monitor the progress of your shipment. To track your order, simply visit the courier's website and enter the tracking number in the
                                                            designated tracking section.
                                                            <br>
                                                            <br>
                                                        <strong>Will I Receive A Quality Product?</strong><br>
                                                            We uphold stringent quality and design standards for every Sajh Dhaj Ke product we offer. We are committed to delivering
                                                            the best possible products to our valued customers.
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="product-meta font-xs color-grey mt-50">
                                        </ul>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10 m-auto entry-main-content">
                                    <h2 class="section-title style-1 mb-30">Description</h2>
                                    <div class="description mb-50">
                                        <?php echo $product->description ?>
                                    </div>
                                    <h3 class="section-title style-1 mb-30 mt-30">Reviews ({{ count($ProductReview) }})</h3>
                                    <!--Comments-->
                                    <div class="comments-area style-2">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                    @foreach ($ProductReview as $review)
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset('public/frontend/assets/imgs/page/no_image.png') }}" alt="">
                                                                <h6><a href="#">{{ $review->user->first_name }} {{ $review->user->last_name }} <i class="fas fa-check-circle" style="color: #2a2a2a;"></i></a></h6>
                                                                <p class="font-xxs">Since 2023</p>
                                                            </div>
                                                            <div class="desc">
                                                                @php
                                                                    $rating = $review->rating;
                                                                    $percentage = $rating * 20;
                                                                @endphp
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width:{{ $percentage }}%">
                                                                    </div>
                                                                </div>
                                                                <p>{{ $review->description }}.</p>
                                                                @if (isset($review->image))
                                                                <div class="view_review_image">
                                                                    <img src="{{ asset('public/images/review_image/'.$review->image) }}" style="width: 200px;" alt="" onclick="openModal({{ $review->id }})">
                                                                </div>
                                                                @endif

                                                                <div id="myModal{{ $review->id }}" class="modal">
                                                                    <div class="modal-content">
                                                                        <span class="close" onclick="closeModal({{ $review->id }})" style="margin-bottom: 10px">&times;</span>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <img src="{{ URL::asset('public/images/review_image/'.$review->image) }}" alt="" width="300px">
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="thumb" style="display: flex">
                                                                                    <img src="{{ asset('public/frontend/assets/imgs/page/no_image.png') }}" alt="" style="width: 40px">
                                                                                    <h6 style="align-self:center"><a href="#">{{ $review->user->first_name }} {{ $review->user->last_name }} <i class="fas fa-check-circle"></i></a></h6>
                                                                                </div>
                                                                                <div class="product-rate d-inline-block">
                                                                                    <div class="product-rating" style="width:{{ $percentage }}%">
                                                                                    </div>
                                                                                </div> <br>
                                                                                <p>{{ $review->description }}.</p>
                                                                                <b>Reviewed on {{date('F j, Y \a\t g:i a',strtotime($review->created_at))}}</b>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="font-xs mr-30">{{date('F j, Y \a\t g:i a',strtotime($review->created_at))}}
                                                                           </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        @php
                                                            $avg_percentage = $avg_rating * 20;
                                                        @endphp
                                                        <div class="product-rating" style="width:{{ $avg_percentage }}%">
                                                        </div>
                                                    </div>
                                                    <h6>{{ round($avg_rating,1) }} out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                        @php
                                                            $five_percentage_avg = $five_avg_rating * 20;
                                                        @endphp
                                                    <div class="progress-bar" role="progressbar" style="width: {{ round($five_percentage_avg,2) }}%;"
                                                        aria-valuenow="{{ round($five_percentage_avg,2) }}" aria-valuemin="0" aria-valuemax="100">{{ round($five_percentage_avg,1) }}%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                        @php
                                                            $four_percentage_avg = $four_avg_rating * 25;
                                                        @endphp
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $four_percentage_avg }}%;"
                                                        aria-valuenow="{{ $four_percentage_avg }}" aria-valuemin="0" aria-valuemax="100">{{ round($four_percentage_avg,1) }}%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                        @php
                                                            $three_percentage_avg = $three_avg_rating * 33.33;
                                                        @endphp
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $three_percentage_avg }}%;"
                                                        aria-valuenow="{{ $three_percentage_avg }}" aria-valuemin="0" aria-valuemax="100">{{ round($three_percentage_avg,1) }}%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                        @php
                                                            $two_percentage_avg = $two_avg_rating * 50;
                                                        @endphp
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $two_percentage_avg }}%;"
                                                        aria-valuenow="{{ $two_percentage_avg }}" aria-valuemin="0" aria-valuemax="100">{{ round($two_percentage_avg,1) }}%
                                                    </div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                        @php
                                                            $one_percentage_avg = $one_avg_rating * 20;
                                                        @endphp
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $one_percentage_avg }}%;"
                                                        aria-valuenow="{{ $one_percentage_avg }}" aria-valuemin="0" aria-valuemax="100">{{ round($one_percentage_avg,1) }}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-60 ">
                                <div class="col-12">
                                    <h3 class="section-title style-1 mb-30">Related products</h3>
                                </div>
                                <div class="col-12">
                                        <div class="carausel-4-columns-cover position-relative">
                                            <div class="slider-arrow slider-arrow-3 carausel-4-columns-arrow left_button_set" id="carausel-4-columns-arrows" style="top: 10%;">
                                            </div>
                                            <div class="carausel-4-columns" id="carausel-4-columns" style="height: 550px">
                                        @foreach ($category_product as $category_products)
                                        <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                                            <div class="product-cart-wrap hover-up product_card_height_set" style="margin-top: 10px;">
                                                <div class="product-img-action-wrap" style="padding: 10px">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{ route('user.shop-detail',$category_products->slug) }}" tabindex="0">
                                                            <img class="default-img related-product"
                                                                src="{{ URL::asset('public/images/product/'.$category_products->thumbnail)}}" alt="">
                                                            <img class="hover-img related-product" src="{{ URL::asset('public/images/product/'.$category_products->thumbnail)}}"
                                                                alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">
                                                        <a aria-label="Quick view" class="action-btn hover-up"
                                                        href="{{ route('user.shop-detail',$category_products->slug) }}"><i class="fi-rs-eye"></i></a>
                                                        <a aria-label="@if (array_key_exists($category_products->id,$wishlist)){{'Removed To Wishlist'}}@else{{'Add To Wishlist'}} @endif" data-product_id="{{$category_products->id}}" class="action-btn hover-up  @if (array_key_exists($category_products->id,$wishlist)){{'active-wishlist remove-to-wishlist'}}@else{{'add-to-wishlist'}} @endif"
                                                            href="javascript:void(0);" @if (array_key_exists($category_products->id,$wishlist)) data-wishlist_item_id="{{$wishlist[$category_products->id]}}" @endif><i class="fi-rs-heart"></i></a>
                                                    </div>
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                    </div>
                                                </div>
                                                @php
                                                    $rating_count = App\Models\ProductReview::where('product_id',$category_products->id)->where('status',1)->count();
                                                    $total_rating = App\Models\ProductReview::where('product_id',$category_products->id)->where('status',1)->sum('rating');
                                                    if($rating_count != 0 || $total_rating != 0){
                                                        $avg_rating = $total_rating/$rating_count;
                                                    }
                                                    else{
                                                        $avg_rating = '0';
                                                    }
                                                @endphp
                                                <div class="product-content-wrap">
                                                    <h2 class="title mt-15"><a href="{{ route('user.shop-detail',$category_products->slug) }}" tabindex="0">{{ Str::of($category_products->name)->limit(45, '...') }}</a></h2>
                                                    @php
                                                        $avg_percentage = $avg_rating * 20;
                                                    @endphp
                                                    <div style="display: flex;">
                                                        <div class="product-rate" style="display: flex;align-self: center;">
                                                            <div class="product-rating" style="width:{{ round($avg_percentage,1) }}%">
                                                            </div>
                                                        </div>
                                                        <span style="align-self: flex-end;padding-left: 5px;">
                                                            <span>{{ round($avg_rating,1) }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="product-price">
                                                        @if ($countryPrice == 'IN')
                                                            <span>₹{{ $category_products->selling_price }} </span>
                                                            <span class="old-price">₹{{ number_format($category_products->original_price, 2, '.', ',') }}</span>
                                                        @else
                                                            <span>${{ $category_products->selling_price_dollar }} </span>
                                                            <span class="old-price">${{ number_format($category_products->original_price_dollar, 2, '.', ',') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
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
<script src="{{ asset('public/frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/slick.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/wow.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/jquery-ui.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/magnific-popup.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/waypoints.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/counterup.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/images-loaded.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/isotope.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('public/frontend/assets/js/shopd134.js') }}?v=3.4"></script>
<script src="{{ asset('public/frontend/validation/global.js') }}"></script>
<script  async>
    var add_wishlist_url='{{route("wishlists.create")}}';
 </script>

 <script  async>
    $('.color_click_image').click(function(){
        var qtyval = 1;
            $('.qty-up').on('click', function (event) {
                event.preventDefault();
                if (qtyval < 5) {
                qtyval = qtyval + 1;
                $(this).prev().text(qtyval);
            }
            });
            $('.qty-down').on('click', function (event) {
                event.preventDefault();
                qtyval = qtyval - 1;
                if (qtyval > 1) {
                    $(this).next().text(qtyval);
                } else {
                    qtyval = 1;
                    $(this).next().text(qtyval);
                }
            });
    });
 </script>

 <script  async>
    $('.color_click').click(function(){
        var color_id = jQuery(this).data('color');
        $('#color_click_image'+color_id).trigger('click');
    });
    $('.color_click_image').click(function(){
        $("#color_add_class img").removeClass("active_select_image");
        var color_name = jQuery(this).data('color_name');
        var fetchId = jQuery(this).data('color');
        $('.color_name').text(color_name);
        $("#color_click_image"+fetchId).addClass("active_select_image");
        $('#click_image_get'+fetchId).trigger('click');
    });
 </script>
<script  async>
    const images = document.querySelectorAll('.product-image-slider img');
    const div = document.querySelector('.product-image-slider');
    images.forEach(img => {
            $('.product-image-slider img').addClass('image-slider');
    });
 </script>
@foreach ($ProductReview as $review)
<script  async>
    function openModal(id) {
        document.getElementById('myModal'+ id).style.display = "block";
    }
    function closeModal(id) {
        document.getElementById('myModal'+ id).style.display = "none";
    }
</script>
@endforeach
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
<script  async>
    var $j = jQuery.noConflict();
    $j(function() {
        $j('.title').matchHeight();
        $j('.product_card_height_set').matchHeight();
    });
</script>
<script>
    const shareButton = document.getElementById('shareButton');
    const shareOptions = document.getElementById('shareOptions');
    shareButton.addEventListener('click', () => {
        shareOptions.classList.toggle('active');
    });
    document.addEventListener('click', (event) => {
        if (!shareButton.contains(event.target) && !shareOptions.contains(event.target)) {
            shareOptions.classList.remove('active');
        }
    });
</script>
@endsection
