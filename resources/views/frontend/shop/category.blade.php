@extends('frontend.layouts.fullLayoutMaster')

@section('page-style')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<style>
    .pagination-area li {
  margin: 0 5px;
}
.pagination-area li:first-child {
  margin-left: 0;
}

.pagination-area li.active span, .pagination-area li:hover span {
  color: #fff;
  background: #751d1c;
}

.pagination-area span {
  border: 0;
  padding: 0 10px;
  -webkit-box-shadow: none;
          box-shadow: none;
  outline: 0;
  width: 34px;
  height: 34px;
  display: block;
  border-radius: 4px;
  color: #696969;
  line-height: 34px;
  text-align: center;
  font-weight: 700;
}

.pagination-area span {
  background-color: transparent;
  color: #4f5d77;
  letter-spacing: 2px;
}

.pagination li {
    border: 0;
  padding: 0 10px;
  -webkit-box-shadow: none;
  box-shadow: none;
  outline: 0;
  /* width: 34px; */
  height: 34px;
  display: block;
  border-radius: 4px;
  color: #696969;
  line-height: 34px;
  text-align: center;
  font-weight: 700;
}
.product-cart-wrap:hover .product-action-1 .active-wishlist{
    background-color: #751d1c;
    border: 1px solid transparent;
    color: #fff;
}
.match-height > [class*=col] {
    display: flex;
    flex-flow: column;
}
.match-height > [class*=col] > .product-cart-wrap {
    flex: 1 1 auto;
}
</style>
@endsection

@section('content')

<style>
    .bg-square1 {
            width: 100%;
            height: 100%;
    position: absolute;
    /* left: auto; */
    top: 0;
    left: 0;
    /* right: 0%; */
    /* bottom: auto; */
    /* max-height: 70%; */
    /* max-width: 100%; */
    /* min-width: 300px; */
    /* background-color: #f3fbf5; */
    z-index: -1;
    /* overflow: hidden; */
    /* max-height: 1200px; */
    /* height: 1011px; */
    background-image: url({{ asset('public/images/category/background_image/'.$category_name->background_image) }});
    opacity: 0.3;

}
.image_size{
    height: 410px;
}
/* .full_width_background {

    background: url({{ asset('public/images/category/background_image/'.$category_name->background_image) }});

} */
/* .product-cart-wrap{
    background-color: #f2e5dd;
}
.product-cart-wrap .product-img-action-wrap {
    background-color: #f2e5dd;
} */
@media only screen and (max-width: 768px) {
    .product-img-action-wrap{
        height: 200px;
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
}
    </style>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                    <span></span> <a href="{{ route('user.shop') }}" rel="nofollow">Shop</a>
                    <span></span> {{ $category_name->name }}
                    <span></span> {{ $subcategory->name }}
                </div>
            </div>
        </div>
        <section class="full_width_background" style="position: relative">
            <div class="bg-square1"></div>
            <div class="container pt-50 pb-50">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p style="font-weight: bold"> We found <strong class="text-brand">{{ count($product) }}</strong> items for you!</p>
                            </div>
                        </div>
                        <div class="row product-grid-3 match-height">
                            @if (count($product) > 0)
                            @foreach ($product as $products)
                            <div class="col-lg-3 col-md-4 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap image_size">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('user.shop-detail',$products->slug) }}">
                                                <img class="default-img subcategory_img"
                                                    src="{{ URL::asset('public/images/product/'.$products->thumbnail)}}"
                                                    alt="">
                                                <img class="hover-img subcategory_img"
                                                    src="{{ URL::asset('public/images/product/'.$products->thumbnail)}}"
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
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <!-- <a href="#">{{ $products->category->name }}<i class="fa-solid fa-greater-than" style="font-size: 8px; margin-left: 5px; margin-right: 3px;"></i> {{ $subcategory->name }}</a> -->
                                        </div>
                                        <h2 class="title"><a href="{{ route('user.shop-detail',$products->slug) }}">{{ Str::of($products->name)->limit(45, '...') }}</a></h2>
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
                            @else
                            <div class="col-lg-4 col-md-4">
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-content-wrap">
                                        <h2 class="mt-3" style="text-align: center;"><a href="#">Product Not Found</a></h2>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            <nav aria-label="Page navigation example">
                                {{ $product->links("pagination::default") }}
                            </nav>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
<script  async>
    var $j = jQuery.noConflict();
    $j(function() {
        $j('.title').matchHeight();
    });
</script>
@endsection
