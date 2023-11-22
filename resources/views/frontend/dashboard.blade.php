@extends('frontend.layouts.fullLayoutMaster')

@section('page-style')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.1/swiper-bundle.css" integrity="sha512-LZuATklLAriQzj14UjkY1lvEvVJNOQLjuQ34tn7+/RU/mv0bgmkEyMROrbOoAIAAK80JE1rcm35kpHjaBvLNoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.3.1/swiper-bundle.min.js" integrity="sha512-c2sIYWk6Ikmd58ksT9Zuhn9A7vXm7g9mioknpzLY9bmXXqd/m+79em0QLOEo2w5Qz9MwpwinPCqjqbwJchyUyA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
.product-cart-wrap:hover .product-action-1 .active-wishlist{
    background-color: #751d1c;
    border: 1px solid transparent;
    color: #fff;
}
.view_more_hover{
    -webkit-transform: translateX(5px);
          transform: translateX(5px);
  -webkit-transition: 0.5s;
  transition: 0.5s;
}
/* .customer_highlights{
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    margin-right: 10px;
} */
.match-height > [class*=col] {
    display: flex;
    flex-flow: column;
}
.match-height > [class*=col] > .product-cart-wrap {
    flex: 1 1 auto;
}
/* .carausel-6-columns {
  display: flex;
  flex-wrap: wrap;
} */
/* .carausel-6-columns {
  display: flex;
  flex-wrap: wrap;
} */
.card-1 {
  flex: 1 0 auto;
}

/* Set a fixed height for the images inside each card */
.card-1 img {
  height: 100%;
  width: 100%;
  object-fit: cover;
}

.cust-highlight-img{
    height: 234px;
    border: none !important;
}

/* Set a fixed height for the card body */
/* .card-1 h5 {
  height: 50px;
} */

@media only screen and (max-width: 766px) {
    .slider-arrow .slider-btn.slider-prev{
        left: 0;
    }
    .cust-highlight-img{
        height: 155px;
        border: none !important;
    }

}
/* @media only screen and (min-width: 425px) and (min-height: 492px) {
    .slider-arrow .slider-btn.slider-next{
        right: 50px !important;
    }
} */
.product-cart-wrap.small:hover{
    /* -webkit-box-shadow: 0 0 20px rgba(0, 0, 0, 0.08); */
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
          border: 1px solid #d5abab;
}
/* .product-cart-wrap .product-img-action-wrap .product-img a img.default-img{
    height: 234px !important;
    object-fit:cover;
} */
.image_size{
    height: 410px;
}
/* review modal */
.modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        overflow: hidden !important;
    }
    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border-radius: 5px;
        width: 40%;
        min-height: 60%;
        margin-top: 5%;
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
    .modal-bottom{
        display: flex;
        position: absolute;
        bottom: 0;
        margin-bottom: 20px;
        border-top: 1px solid #c9c9c9;
        padding-top: 10px;
        width: 40%;
    }


@media only screen and (max-width: 766px) {
    .product-img-action-wrap{
        height: 176px;
    }
    .product-cart-wrap .product-content-wrap h2{
        font-size: 14px;
        font-weight: 400;
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
    .card-1{
        width: 166px;
    }
    .card-1 figure{
        height: 190px !important;
    }
    .carausel-6-columns .card-1 {
        width: 164px !important;
    }
    .review_slider{
        width: 160px !important;
    }
    .monthly_height_set{
        width: 163px !important;
    }
    /* .slick-list{
        overflow: hidden;
    } */
    .customer_highlights{
        width: 160px !important;
    }
    /* .customer_highlights .product-img-action-wrap .product-img{
        height: 400px !important;
    }
    .product-cart-wrap .product-img-action-wrap .product-img a img.home_highlight{
        height: 350px !important;
    } */
    .modal-content{
        width: 80%;
        margin-top: 2px !important;
        max-height: 99% !important;
    }
    .modal{
        padding-top: 0px !important;
    }
    .modal-bottom{
        display: flex;
        position: inherit;
        bottom: 0;
        margin-bottom: 20px;
        border-top: 1px solid #c9c9c9;
        padding-top: 10px;
        width: 100%;
    }
}
/* Next button */
.swiper-button-next {
  color: black; /* Change the color as per your preference */
}

/* Previous button */
.swiper-button-prev {
  color: black; /* Change the color as per your preference */
}
.highlights_modal{
    width: 22% !important;
}
/* .dot-style-1.dot-style-1-position-1 ul{
    display: none !important;
} */

.modal-target {
  width: 300px;
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

.modal-target:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  /* z-index: 1;  */
  /* padding-top: 100px;  */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.8); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-contents {
  margin: auto;
  display: block;
  width: 80%;
  opacity: 1 !important;
  max-width: 1200px;
  height: 95%;
    object-fit: contain;
}

/* Caption of Modal Image */
.modal-caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 1200px;
  text-align: center;
  color: white;
  font-weight: 700;
  font-size: 1em;
  margin-top: 32px;
}

/* Add Animation */
.modal-contents, .modal-caption {
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-atransform:scale(0)}
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.modal-close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.modal-close:hover,
.modal-close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
/* CSS for desktop view */
.home-slider {
    display: block;
}

.mobile-view {
    display: none;
}
/* Media query for mobile view */
@media (max-width: 768px) {
    .home-slider {
        display: none;
    }
    .mobile-view {
        display: block;
    }
}

</style>
@endsection

@section('content')
    <main class="main">
        <section class="home-slider position-relative">
            @if (count($sliders) > 0)
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($sliders as $slider)
                            <div class="swiper-slide slide_1">
                                <a href="{{ $slider->url }}">
                                    <img src="{{ asset('public/banner_images/slider/'.$slider->image) }}" alt="" class="desktop-img">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            @else
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slide_1">
                            <img src="{{ asset('public/frontend/assets/imgs/slider/1.png') }}" alt="" class="desktop-img">
                        </div>
                        <div class="swiper-slide slide_2">
                            <img src="{{ asset('public/frontend/assets/imgs/slider/2.png') }}" alt="" class="desktop-img">
                        </div>
                        <div class="swiper-slide slide_3">
                            <img src="{{ asset('public/frontend/assets/imgs/slider/3.png') }}" alt="" class="desktop-img">
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            @endif
        </section>

        <section class="home-slider position-relative mobile-view">
            @if (count($mobile_sliders) > 0)
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($mobile_sliders as $slider)
                            <div class="swiper-slide slide_1">
                                <a href="{{ $slider->url }}">
                                    <img src="{{ asset('public/banner_images/slider/'.$slider->image) }}" alt="" class="mobile-img">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            @else
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slide_1">
                            <img src="{{ asset('public/frontend/assets/imgs/slider/1.png') }}" alt="" class="mobile-img">
                        </div>
                        <div class="swiper-slide slide_2">
                            <img src="{{ asset('public/frontend/assets/imgs/slider/2.png') }}" alt="" class="mobile-img">
                        </div>
                        <div class="swiper-slide slide_3">
                            <img src="{{ asset('public/frontend/assets/imgs/slider/3.png') }}" alt="" class="mobile-img">
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            @endif
        </section>
        <!-- category section start -->
        <section class="popular-categories section-padding mb-25">
            <div class="container wow fadeIn animated">
                <div class="mb-45" style="text-align: center;">
                    <h4 class="" style="font-weight: bold;padding-bottom: 6px;color: #751d1c;">PREMIUM INDIAN TRADITIONAL FASHION, CLOTHING,  AND BRIDAL ACCESSORIES</h4>
                    <h6>Browse our range of categories to find your new indian traditional fashion obsession!</h6>
                </div>
                <h3 class="section-title mb-20"><span>Popular</span> Categories</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows">
                    </div>
                    <div class="carausel-6-columns" id="carausel-6-columns">
                        @foreach ($product_category as $product_categories)
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden" style="height: 220px;">
                                <a href="{{ route('user.subcategory',$product_categories->slug) }}"><img
                                        src="{{ asset('public/images/category/thumbnail/'.$product_categories->thumbnail) }}"
                                        alt=""></a>
                            </figure>
                            <h5 style="font-size: 17px;"><a href="{{ route('user.subcategory',$product_categories->slug) }}">{{ ucfirst($product_categories->name) }}</a></h5>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- category section end -->
        <!-- popular products start -->
        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                                type="button" role="tab" aria-controls="tab-one"
                                aria-selected="true">Featured</button>
                        </li>
                        @if (count($getpopularProduct)>3)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two"
                                type="button" role="tab" aria-controls="tab-two"
                                aria-selected="false">Popular</button>
                        </li>
                        @endif
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three"
                                type="button" role="tab" aria-controls="tab-three" aria-selected="false">New
                                added</button>
                        </li>
                    </ul>
                    <a href="{{ route('user.shop') }}" class="view-more d-none d-md-flex">View More<i
                            class="fi-rs-angle-double-small-right"></i></a>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4 match-height">
                            @foreach ($product as $products)
                            <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap image_size">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('user.shop-detail',$products->slug) }}">
                                                <img class="default-img home_feature" src="{{ URL::asset('public/images/product/'.$products->thumbnail)}}"
                                                    alt="">
                                                <img class="hover-img home_feature" src="{{ URL::asset('public/images/product/'.$products->thumbnail)}}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                             href="{{ route('user.shop-detail',$products->slug) }}"><i class="fi-rs-eye"></i></a>
                                            <a aria-label="@if (array_key_exists($products->id,$wishlist)){{'Removed To Wishlist'}}@else{{'Add To Wishlist'}} @endif" data-product_id="{{$products->id}}" class="action-btn hover-up  @if (array_key_exists($products->id,$wishlist)){{'active-wishlist remove-to-wishlist'}}@else{{'add-to-wishlist'}} @endif"
                                                href="javascript:void(0);" @if (array_key_exists($products->id,$wishlist)) data-wishlist_item_id="{{$wishlist[$products->id]}}" @endif><i class="fi-rs-heart"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @php
                                                $date = Carbon\Carbon::now()->subDays(10);
                                            @endphp
                                            @if ($products->created_at >= $date)
                                                <span class="new">New</span>
                                            @endif
                                        </div>
                                    </div>
                                    @php
                                        $rating_count = App\Models\ProductReview::where('product_id',$products->id)->where('status',1)->count();
                                        $total_rating = App\Models\ProductReview::where('product_id',$products->id)->where('status',1)->sum('rating');
                                        if($rating_count != 0 || $total_rating != 0){
                                            $avg_rating = $total_rating/$rating_count;
                                        }
                                        else{
                                            $avg_rating = '0';
                                        }
                                    @endphp
                                    @php
                                        $avg_percentage = $avg_rating * 20;
                                    @endphp
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="#">{{ $products->category->name }}</a>
                                        </div>
                                        <h2 class="title"><a href="{{ route('user.shop-detail',$products->slug) }}">{{ Str::of($products->name)->limit(45, '...') }}</a></h2>
                                        <div style="display: flex">
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
                                                <span>₹{{ $products->selling_price }} </span>
                                                <span class="old-price">₹{{ number_format($products->original_price, 2, '.', ',') }}</span>
                                            @else
                                            <span>${{ $products->selling_price_dollar }} </span>
                                            <span class="old-price">${{ number_format($products->original_price_dollar, 2, '.', ',') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab one (Featured)-->
                    <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                        <div class="row product-grid-4 match-height">
                            @foreach ($getpopularProduct as $popularProducts)
                            <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap image_size">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('user.shop-detail',$popularProducts->slug) }}">
                                                <img class="default-img home_popular" src="{{ URL::asset('public/images/product/'.$popularProducts->thumbnail)}}"
                                                    alt="">
                                                <img class="hover-img home_popular" src="{{ URL::asset('public/images/product/'.$popularProducts->thumbnail)}}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                             href="{{ route('user.shop-detail',$popularProducts->slug) }}"><i class="fi-rs-eye"></i></a>
                                            <a aria-label="@if (array_key_exists($popularProducts->id,$wishlist)){{'Removed To Wishlist'}}@else{{'Add To Wishlist'}} @endif" data-product_id="{{$popularProducts->id}}" class="action-btn hover-up  @if (array_key_exists($popularProducts->id,$wishlist)){{'active-wishlist remove-to-wishlist'}}@else{{'add-to-wishlist'}} @endif"
                                                href="javascript:void(0);" @if (array_key_exists($popularProducts->id,$wishlist)) data-wishlist_item_id="{{$wishlist[$popularProducts->id]}}" @endif><i class="fi-rs-heart"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="#">{{ $popularProducts->category->name }} </a>
                                        </div>
                                        <h2 class="title"><a href="{{ route('user.shop-detail',$popularProducts->slug) }}">{{ Str::of($popularProducts->name)->limit(45, '...') }}</a></h2>
                                        <div style="display: flex">
                                            <div class="product-rate" style="display: flex;align-self: center;">
                                                <div class="product-rating" style="width:@if ($popularProducts->ratings->isNotEmpty())
                                                    {{ $popularProducts->ratings->first()->average_rating * 20}}%
                                                  @else
                                                      0
                                                  @endif">
                                                </div>
                                            </div>
                                            <span style="align-self: flex-end;padding-left: 5px;">
                                                <span>@if ($popularProducts->ratings->isNotEmpty())
                                                    <span>{{ round($popularProducts->ratings->first()->average_rating,1) }}</span>
                                                @else
                                                <span> 0</span>
                                                @endif</span>
                                            </span>
                                        </div>
                                        <div class="product-price">
                                            @if ($countryPrice == 'IN')
                                                <span>₹{{ $products->selling_price }} </span>
                                                <span class="old-price">₹{{ number_format($products->original_price, 2, '.', ',') }}</span>
                                            @else
                                                <span>${{ $products->selling_price_dollar }} </span>
                                                <span class="old-price">${{ number_format($products->original_price_dollar, 2, '.', ',') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab two (Popular)-->
                    <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                        <div class="row product-grid-4 match-height">
                            @foreach ($newProduct as $newProducts)
                            <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap image_size">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('user.shop-detail',$newProducts->slug) }}">
                                                <img class="default-img home_newadded" src="{{ URL::asset('public/images/product/'.$newProducts->thumbnail)}}"
                                                    alt="">
                                                <img class="hover-img home_newadded" src="{{ URL::asset('public/images/product/'.$newProducts->thumbnail)}}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn hover-up"
                                             href="{{ route('user.shop-detail',$newProducts->slug) }}"><i class="fi-rs-eye"></i></a>
                                            <a aria-label="@if (array_key_exists($newProducts->id,$wishlist)){{'Removed To Wishlist'}}@else{{'Add To Wishlist'}} @endif" data-product_id="{{$newProducts->id}}" class="action-btn hover-up  @if (array_key_exists($newProducts->id,$wishlist)){{'active-wishlist remove-to-wishlist'}}@else{{'add-to-wishlist'}} @endif"
                                                href="javascript:void(0);" @if (array_key_exists($newProducts->id,$wishlist)) data-wishlist_item_id="{{$wishlist[$newProducts->id]}}" @endif><i class="fi-rs-heart"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @php
                                                $date = Carbon\Carbon::now()->subDays(10);
                                            @endphp
                                            @if ($newProducts->created_at >= $date)
                                                <span class="new">New</span>
                                            @endif
                                        </div>
                                    </div>
                                    @php
                                    $rating_count = App\Models\ProductReview::where('product_id',$newProducts->id)->where('status',1)->count();
                                    $total_rating = App\Models\ProductReview::where('product_id',$newProducts->id)->where('status',1)->sum('rating');
                                    if($rating_count != 0 || $total_rating != 0){
                                        $avg_rating = $total_rating/$rating_count;
                                    }
                                    else{
                                        $avg_rating = '0';
                                    }
                                @endphp
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="#">{{ $newProducts->category->name }}</a>
                                    </div>
                                    <h2 class="title"><a href="{{ route('user.shop-detail',$newProducts->slug) }}">{{ Str::of($newProducts->name)->limit(45, '...') }}</a></h2>
                                    @php
                                            $avg_percentage = $avg_rating * 20;
                                    @endphp
                                    <div style="display: flex">
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
                                            <span>₹{{ $products->selling_price }} </span>
                                            <span class="old-price">₹{{ number_format($products->original_price, 2, '.', ',') }}</span>
                                        @else
                                            <span>${{ $products->selling_price_dollar }} </span>
                                            <span class="old-price">${{ number_format($products->original_price_dollar, 2, '.', ',') }}</span>
                                        @endif
                                    </div>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab three (New added)-->
                </div>
                <!--End tab-content-->
            </div>
        </section>
        <!-- popular products end -->
        <section class="banner-2 section-padding pb-0">
            <div class="container">
                @if ($bigSell)
                    <div class="banner-img banner-big wow fadeIn animated f-none">
                        <a href="{{ $bigSell->url }}"><img src="{{ asset('public/banner_images/banner2/'.$bigSell->image) }}" alt=""></a>
                    </div>
                @else
                    <div class="banner-img banner-big wow fadeIn animated f-none">
                        <img src="{{ asset('public/frontend/assets/imgs/banner/banner2.png') }}" alt="">
                    </div>
                @endif
            </div>
        </section>
        <!--customer highlight section start -->
        <section class="section-padding">
            <div class="container wow fadeIn animated">
                <div class="mb-45" style="text-align: center;">
                    <h4 class="" style="font-weight: bold;padding-bottom: 6px;color: #751d1c;text-transform: uppercase;">Inspiring Stories, Captivating Images: Our Customers' Experiences</h4>
                </div>
                <div style="display: flex" class="justify-content-between">
                    <h3 class="section-title mb-20"><span>Customer</span> Highlights</h3>
                    <a href="{{ route('customerHighlights.images') }}" class="view-more d-none d-md-flex view_more_hover" style="font-family: 'Spartan', sans-serif;
                    font-size: 13px;
                    font-weight: 700;
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: flex;
                    border-bottom: 2px solid #d5abab;
                    margin-bottom: 20px;">View More<i class="fi-rs-angle-double-small-right" style="margin-top: 6px"></i></a>
                </div>
                <h3 class="section-title mb-20"><span></span> </h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows" style="top: -35px;">
                    </div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                        @foreach ($highlight_image as $highlight_images)
                        <div class="product-cart-wrap small hover-up customer_highlights" style="margin-right: 10px;margin-top: 13px;">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom cust-highlight-img">
                                    <a href="javascript:void(0)">
                                        <img class="default-img home_highlight modal-target"
                                            src="{{ URL::asset('public/images/highlights/images/'.$highlight_images->path)}}"
                                            alt="">
                                        <img class="hover-img home_highlight modal-target"
                                            src="{{ URL::asset('public/images/highlights/images/'.$highlight_images->path)}}"
                                            alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!--Start model-->
        @foreach ($highlight_image as $highlight_images)
        <div id="myImageModal{{ $highlight_images->id }}" class="modal">
            <div class="modal-contents highlights_modal">
                <span class="close" onclick="closeImageModal({{ $highlight_images->id }})" style="margin-bottom: 10px">&times;</span>
                <div class="row">
                        <img src="{{ URL::asset('public/images/highlights/images/'.$highlight_images->path)}}" alt="" width="50%" style="border-radius: 5px;">
                </div>
            </div>
        </div>
        @endforeach
          <div id="modal" class="modal">
            <span id="modal-close" class="modal-close">&times;</span>
            <img id="modal-content" class="modal-contents">
            <div id="modal-caption" class="modal-caption"></div>
          </div>
        <!--End model-->
        <!--customer highlight section end -->
        <section class="banners mb-15">
            <div class="container">
                @if (count($special_offer) > 0)
                    <div class="row">
                        @foreach ($special_offer as $special_offers)
                        <div class="col-lg-4 col-md-6">
                            <div class="banner-img wow fadeIn animated">
                                <a href="{{ $special_offers->url }}">
                                <img src="{{ asset('public/banner_images/banner3/'.$special_offers->image) }}" alt="">
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="banner-img wow fadeIn animated">
                                <img src="{{ asset('public/frontend/assets/imgs/banner/1.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="banner-img wow fadeIn animated">
                                <img src="{{ asset('public/frontend/assets/imgs/banner/2.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 d-md-none d-lg-flex">
                            <div class="banner-img wow fadeIn animated  mb-sm-0">
                                <img src="{{ asset('public/frontend/assets/imgs/banner/3.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <!--Review section Start -->
        <section class="section-padding">
            <div class="container wow fadeIn animated">
                <div class="mb-45" style="text-align: center;">
                    <h4 class="" style="font-weight: bold;padding-bottom: 6px;color: #751d1c;text-transform: uppercase;">Smiles and Stories: Customer Reviews with a Personal Touch</h4>
                </div>
                <div style="display: flex" class="justify-content-between">
                    <h3 class="section-title mb-20"><span>Customer</span> Review</h3>
                </div>
                <h3 class="section-title mb-20"><span></span> </h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows" style="top: -35px">
                    </div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-columns-2">
                        @foreach ($review as $reviews)
                        <div class="product-cart-wrap review_slider" style="margin-right: 10px;margin-top: 13px;" onclick="openModal({{ $reviews->id }})">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom" style="height: 234px;border: none">
                                    <a href="javascript:void(0)">
                                        <img class="default-img home_highlight"
                                            src="{{ URL::asset('public/images/review_image/'.$reviews->image)}}"
                                            alt="">
                                        <img class="hover-img home_highlight"
                                            src="{{ URL::asset('public/images/review_image/'.$reviews->image)}}"
                                            alt="">
                                    </a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                </div>
                                @php
                                    $percentage = ($reviews->rating / 5) * 100;
                                @endphp
                                <h6 class="title"><a href="javascirt:void(0)">{{ $reviews->user->first_name }} {{ $reviews->user->last_name }} <i class="fas fa-check-circle"></i></a></h6>
                                <div style="display: flex">
                                    <div class="product-rate" style="display: flex;align-self: center;">
                                        <div class="product-rating" style="width:{{ $percentage }}%">
                                        </div>
                                    </div>
                                    <span style="align-self: flex-end;padding-left: 5px;">
                                        <span>{{ $reviews->rating }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @foreach ($review as $reviews)
        <div id="myModal{{ $reviews->id }}" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal({{ $reviews->id }})" style="margin-bottom: 10px">&times;</span>
                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ URL::asset('public/images/review_image/'.$reviews->image) }}" alt="" width="300px" style="border-radius: 5px;">
                    </div>
                    <div class="col-lg-6">
                        <div class="thumb" style="display: flex">
                            <img src="{{ asset('public/frontend/assets/imgs/page/no_image.png') }}" alt="" style="width: 40px;border-radius: 50%;">
                            <h6 style="align-self:center;font-size: 16px;"><a href="#">{{ $reviews->user->first_name }} {{ $reviews->user->last_name }} <i class="fas fa-check-circle"></i></a></h6>
                        </div>
                        <div class="product-rate d-inline-block">
                            <div class="product-rating" style="width:{{ $percentage }}%">
                            </div>
                        </div> <br>
                        <p>{{ $reviews->description }}.</p>
                        <b>Reviewed on {{date('F j, Y',strtotime($reviews->created_at))}}</b>
                        <div class="modal-bottom">
                            <img src="{{ URL::asset('public/images/product/' . $reviews->product->thumbnail) }}" alt="" style="width: 85px;border-radius: 10px;">
                            <p style="margin-left: 10px;"> <span>{{ Str::of($reviews->product->name)->limit(35, '...') }}</span>
                                <span>
                                    <a href="{{ route('user.shop-detail', $reviews->product->slug) }}" style="padding: 6px 11px;
                                    background-color: rgba(0, 0, 0, 0.05); border-radius: 8px; margin-top:10px; display:inline-block;">
                                        <span><b>View Product</b></span>
                                    </a>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endforeach
        <!--Review section End -->

        <section class="bg-grey-9 section-padding">
            <div class="container pt-25 pb-25">
                <div class="heading-tab d-flex">
                    <div class="heading-tab-left wow fadeIn animated">
                        <h3 class="section-title mb-20"><span>Monthly</span> Best Sale</h3>
                    </div>
                    <div class="heading-tab-right wow fadeIn animated">
                        <ul class="nav nav-tabs right no-border" id="myTab-1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="nav-tab-one-1" data-bs-toggle="tab"
                                    data-bs-target="#tab-one-1" type="button" role="tab"
                                    aria-controls="tab-one" aria-selected="true">Featured</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nav-tab-two-1" data-bs-toggle="tab"
                                    data-bs-target="#tab-two-1" type="button" role="tab"
                                    aria-controls="tab-two" aria-selected="false">Popular</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nav-tab-three-1" data-bs-toggle="tab"
                                    data-bs-target="#tab-three-1" type="button" role="tab"
                                    aria-controls="tab-three" aria-selected="false">New added</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 d-none d-lg-flex">
                        @if ($monthly_sell)
                            <div class="banner-img style-2 wow fadeIn animated">
                                <a href="{{ $monthly_sell->url }}">
                                    <img src="{{ asset('public/banner_images/banner4/'.$monthly_sell->image) }}" alt="">
                                </a>

                            </div>
                        @else
                            <div class="banner-img style-2 wow fadeIn animated">
                                <img src="{{ asset('public/frontend/assets/imgs/banner/monthly-sale.png') }}" alt="">
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-9 col-md-12">
                        <div class="tab-content wow fadeIn animated" id="myTabContent-1">
                            <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel"
                                aria-labelledby="tab-one-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                        id="carausel-4-columns-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                        @if (count($MonthlyBestSell) > 0)
                                        @foreach ($MonthlyBestSell as $MonthlyBestSellings)
                                        @if ($MonthlyBestSellings->getproductsData != null)


                                        <div class="product-cart-wrap monthly_height_set">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom" style="height: 320px">
                                                    <a href="{{ route('user.shop-detail',$MonthlyBestSellings->getproductsData->slug)}}">
                                                        <img class="default-img monthly_featured" src="{{ URL::asset('public/images/product/'.$MonthlyBestSellings->getproductsData->thumbnail)}}"
                                                            alt="">
                                                        <img class="hover-img monthly_featured" src="{{ URL::asset('public/images/product/'.$MonthlyBestSellings->getproductsData->thumbnail)}}"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn hover-up"
                                                     href="{{ route('user.shop-detail',$MonthlyBestSellings->getproductsData->slug) }}"><i class="fi-rs-eye"></i></a>
                                                    <a aria-label="@if (array_key_exists($MonthlyBestSellings->getproductsData->id,$wishlist)){{'Removed To Wishlist'}}@else{{'Add To Wishlist'}} @endif" data-product_id="{{$MonthlyBestSellings->getproductsData->id}}" class="action-btn hover-up  @if (array_key_exists($MonthlyBestSellings->getproductsData->id,$wishlist)){{'active-wishlist remove-to-wishlist'}}@else{{'add-to-wishlist'}} @endif"
                                                        href="javascript:void(0);" @if (array_key_exists($MonthlyBestSellings->getproductsData->id,$wishlist)) data-wishlist_item_id="{{$wishlist[$MonthlyBestSellings->getproductsData->id]}}" @endif><i class="fi-rs-heart"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="best">Best Sell</span>
                                                </div>
                                            </div>
                                            @php
                                                $rating_count = App\Models\ProductReview::where('product_id',$MonthlyBestSellings->getproductsData->id)->where('status',1)->count();
                                                $total_rating = App\Models\ProductReview::where('product_id',$MonthlyBestSellings->getproductsData->id)->where('status',1)->sum('rating');
                                                if($rating_count != 0 || $total_rating != 0){
                                                    $avg_rating = $total_rating/$rating_count;
                                                }
                                                else{
                                                    $avg_rating = '0';
                                                }
                                            @endphp
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="javascript:void(0)">{{ $MonthlyBestSellings->getproductsData->category->name }}</a>
                                                </div>
                                                <h2 class="title"><a href="{{ route('user.shop-detail',$MonthlyBestSellings->getproductsData->slug) }}">{{ Str::of($MonthlyBestSellings->getproductsData->name)->limit(25, '...') }}</a></h2>
                                                @php
                                                    $avg_percentage = $avg_rating * 20;
                                                @endphp
                                                <div style="display: flex">
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
                                                        <span>₹{{ $MonthlyBestSellings->getproductsData->selling_price }}</span>
                                                        <span class="old-price">₹{{ number_format($MonthlyBestSellings->getproductsData->original_price, 2, '.', ',') }}</span>
                                                    @else
                                                        <span>${{ $MonthlyBestSellings->getproductsData->selling_price_dollar }}</span>
                                                        <span class="old-price">${{ number_format($MonthlyBestSellings->getproductsData->original_price_dollar, 2, '.', ',') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach

                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--End tab-pane-->
                            <div class="tab-pane fade" id="tab-two-1" role="tabpanel" aria-labelledby="tab-two-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                        id="carausel-4-columns-2-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-2">
                                        @foreach ($mergedQuery as $mergedQueries)
                                        <div class="product-cart-wrap monthly_height_set">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom" style="height: 320px">
                                                    <a href="{{ route('user.shop-detail',$mergedQueries->slug) }}">
                                                        <img class="default-img monthly_popular" src="{{ URL::asset('public/images/product/'.$mergedQueries->thumbnail)}}"
                                                            alt="">
                                                        <img class="hover-img monthly_popular" src="{{ URL::asset('public/images/product/'.$mergedQueries->thumbnail)}}"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn hover-up"
                                                     href="{{ route('user.shop-detail',$mergedQueries->slug) }}"><i class="fi-rs-eye"></i></a>
                                                    <a aria-label="@if (array_key_exists($mergedQueries->id,$wishlist)){{'Removed To Wishlist'}}@else{{'Add To Wishlist'}} @endif" data-product_id="{{$mergedQueries->id}}" class="action-btn hover-up  @if (array_key_exists($mergedQueries->id,$wishlist)){{'active-wishlist remove-to-wishlist'}}@else{{'add-to-wishlist'}} @endif"
                                                        href="javascript:void(0);" @if (array_key_exists($mergedQueries->id,$wishlist)) data-wishlist_item_id="{{$wishlist[$mergedQueries->id]}}" @endif><i class="fi-rs-heart"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="#">{{ $mergedQueries->category->name }} </a>
                                                </div>
                                                <h2 class="title"><a href="{{ route('user.shop-detail',$mergedQueries->slug) }}">{{ Str::of($mergedQueries->name)->limit(25, '...') }}</a></h2>
                                                <div style="display: flex">
                                                    <div class="product-rate" style="display: flex;align-self: center;">
                                                        <div class="product-rating" style="width:@if ($mergedQueries->ratings->isNotEmpty())
                                                            {{ $mergedQueries->ratings->first()->average_rating * 20}}%
                                                          @else
                                                              0
                                                          @endif">
                                                        </div>
                                                    </div>
                                                    <span style="align-self: flex-end;padding-left: 5px;">
                                                        <span>@if ($mergedQueries->ratings->isNotEmpty())
                                                            <span>{{ round($mergedQueries->ratings->first()->average_rating,1) }}</span>
                                                        @else
                                                        <span> 0</span>
                                                        @endif</span>
                                                    </span>
                                                </div>
                                                <div class="product-price">
                                                    @if ($countryPrice == 'IN')
                                                        <span>₹{{ $mergedQueries->selling_price }}</span>
                                                        <span class="old-price">₹{{ number_format($mergedQueries->original_price, 2, '.', ',') }}</span>
                                                    @else
                                                        <span>${{ $mergedQueries->selling_price_dollar }}</span>
                                                        <span class="old-price">${{ number_format($mergedQueries->original_price_dollar, 2, '.', ',') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-three-1" role="tabpanel"
                                aria-labelledby="tab-three-1">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                        id="carausel-4-columns-3-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-3">
                                        @foreach ($MonthlyBestSellNewProduct as $MonthlyBestSellNewProducts)
                                        <div class="product-cart-wrap monthly_height_set">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom" style="height: 320px">
                                                    <a href="{{ route('user.shop-detail',$MonthlyBestSellNewProducts->slug) }}">
                                                        <img class="default-img monthly_new_added" src="{{ URL::asset('public/images/product/'.$MonthlyBestSellNewProducts->thumbnail)}}"
                                                            alt="">
                                                        <img class="hover-img monthly_new_added" src="{{ URL::asset('public/images/product/'.$MonthlyBestSellNewProducts->thumbnail)}}"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn hover-up"
                                                     href="{{ route('user.shop-detail',$MonthlyBestSellNewProducts->slug) }}"><i class="fi-rs-eye"></i></a>
                                                    <a aria-label="@if (array_key_exists($MonthlyBestSellNewProducts->id,$wishlist)){{'Removed To Wishlist'}}@else{{'Add To Wishlist'}} @endif" data-product_id="{{$MonthlyBestSellNewProducts->id}}" class="action-btn hover-up  @if (array_key_exists($MonthlyBestSellNewProducts->id,$wishlist)){{'active-wishlist remove-to-wishlist'}}@else{{'add-to-wishlist'}} @endif"
                                                        href="javascript:void(0);" @if (array_key_exists($MonthlyBestSellNewProducts->id,$wishlist)) data-wishlist_item_id="{{$wishlist[$MonthlyBestSellNewProducts->id]}}" @endif><i class="fi-rs-heart"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                </div>
                                            </div>
                                            @php
                                            $rating_count = App\Models\ProductReview::where('product_id',$MonthlyBestSellNewProducts->id)->where('status',1)->count();
                                            $total_rating = App\Models\ProductReview::where('product_id',$MonthlyBestSellNewProducts->id)->where('status',1)->sum('rating');
                                            if($rating_count != 0 || $total_rating != 0){
                                                $avg_rating = $total_rating/$rating_count;
                                            }
                                            else{
                                                $avg_rating = '0';
                                            }
                                            @endphp
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a href="#">{{ $MonthlyBestSellNewProducts->category->name }}</a>
                                                </div>
                                                <h2 class="title"><a href="{{ route('user.shop-detail',$MonthlyBestSellNewProducts->slug) }}">{{ Str::of($MonthlyBestSellNewProducts->name)->limit(25, '...') }}</a></h2>
                                                @php
                                                    $avg_percentage = $avg_rating * 20;
                                                @endphp
                                                <div style="display: flex">
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
                                                        <span>₹{{ $MonthlyBestSellNewProducts->selling_price }} </span>
                                                        <span class="old-price">₹{{ number_format($MonthlyBestSellNewProducts->original_price, 2, '.', ',') }}</span>
                                                    @else
                                                        <span>${{ $MonthlyBestSellNewProducts->selling_price_dollar }} </span>
                                                        <span class="old-price">${{ number_format($MonthlyBestSellNewProducts->original_price_dollar, 2, '.', ',') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End tab-content-->
                    </div>
                    <!--End Col-lg-9-->
                </div>
            </div>
        </section>
        <section class="mb-50 pt-25">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if ($instabanner)
                        <a href="{{ $instabanner->url }}">
                            <div class="banner-bg wow fadeIn animated"
                            style="background-image: url('{{ asset('public/banner_images/banner5/'.$instabanner->image) }}');height:174px">
                        </div>
                    </a>
                        @else
                        <div class="banner-bg wow fadeIn animated"
                            style="background-image: url('{{ asset('public/frontend/assets/imgs/banner/banner5.png') }}');height:174px">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
          <!-- icons section start-->
          <section class="featured section-padding position-relative">
            <div class="container">
                <div class="row" style="justify-content: center;">
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up" style="background: #751d1c">
                            <img src="{{ asset('public/frontend/assets/imgs/theme/icons/2.png') }}" alt="">
                            <h4 class="bg-1">Free Shipping</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up" style="background: #751d1c">
                            <img src="{{ asset('public/frontend/assets/imgs/theme/icons/4.png') }}" alt="">
                            <h4 class="bg-3">100% Quality</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up" style="background: #751d1c">
                            <img src="{{ asset('public/frontend/assets/imgs/theme/icons/3.png') }}" alt="">
                            <h4 class="bg-2">Easy To Return</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up" style="background: #751d1c">
                            <img src="{{ asset('public/frontend/assets/imgs/theme/icons/5.png') }}" alt="">
                            <h4 class="bg-6">24/7 Support</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('page-script')
<script src="{{ asset('public/frontend/validation/global.js') }}"></script>
<script  async>
    var add_wishlist_url='{{route("wishlists.create")}}';
 </script>
<!-- Include matchHeight plugin file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
<script  async>
    // console.log($('.tab-pane.active .title').html());
    var $j = jQuery.noConflict();
    $j(function() {
        // $j('.tab-pane.active .title').matchHeight();
        $j('.title').matchHeight();
        $j('.monthly_height_set').matchHeight();
        $j('.card-1 h5').matchHeight();
    });
</script>
@foreach ($review as $reviews)
<script  async>
    function openModal(id) {
        // alert(id);
        document.getElementById('myModal'+ id).style.display = "block";
        document.body.style.overflow = "hidden";
    }

    function closeModal(id) {
        document.getElementById('myModal'+ id).style.display = "none";
        document.body.style.overflow = "";
    }
</script>
@endforeach
@foreach ($highlight_image as $highlight_images)
<script  async>
    function openImageModal(id) {
        document.getElementById('myImageModal'+ id).style.display = "block";
    }

    function closeImageModal(id) {
        document.getElementById('myImageModal'+ id).style.display = "none";
    }
</script>
@endforeach

<script  async>
    // Modal Setup
var modal = document.getElementById('modal');

var modalClose = document.getElementById('modal-close');
modalClose.addEventListener('click', function() {
modal.style.display = "none";
});

// global handler
document.addEventListener('click', function (e) {
if (e.target.className.indexOf('modal-target') !== -1) {
var img = e.target;
var modalImg = document.getElementById("modal-content");
var captionText = document.getElementById("modal-caption");
modal.style.display = "block";
modalImg.src = img.src;
captionText.innerHTML = img.alt;
}
});
</script>
<script  async>
$(document).ready(function() {
    $('.review_slider').removeAttr('style');
    // Add new CSS properties
    $('.review_slider').css({
    'margin-right': '10px',
    'margin-top': '13px',
    'width': '200px',
    });
});
</script>
<script  async>
    let swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        autoplay: {
            delay: 5000,
        },
        loop: true,
    });
</script>
@endsection
