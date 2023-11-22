@extends('frontend.layouts.fullLayoutMaster')
@section('title') {{'Shop |'}} @endsection
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

        .pagination-area li.active span,
        .pagination-area li:hover span {
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

        .product-cart-wrap:hover .product-action-1 .active-wishlist {
            background-color: #751d1c;
            border: 1px solid transparent;
            color: #fff;
        }

        .sub-btn .active {
            color: #751d1c;
        }

        .dropdown-toggle.active::after {
            border-top: 0;
            border-right: .3em solid transparent;
            border-bottom: .3em solid;
            border-left: .3em solid transparent
        }
        .match-height > [class*=col] {
            display: flex;
            flex-flow: column;
        }
        .match-height > [class*=col] > .product-cart-wrap {
            flex: 1 1 auto;
        }
        .image_size{
            height: 410px;
        }
        .mobile_filter{
            display: none;
        }
        .filter_sidebar-visible{
            visibility: visible;
            opacity: 1;
            -webkit-transform: translate(0, 0);
            transform: translate(0, 0);
        }
        @media only screen and (max-width: 768px) {
            .mobile_filter{
                display: block;
            }
            .large_display-filter{
                display: none;
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
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                    <span></span> Shop
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> We found <strong class="text-brand">{{ count($product) }}</strong> items for you!</p>
                            </div>
                            <div class="sort-by-product-area">
                                <form method="GET" action="{{ route('user.shop') }}" id="sort_by_form">
                                    <div class="sort-by-cover">
                                        <div class="sort-by-product-wrap">
                                            <div class="sort-by">
                                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                            </div>
                                            <div class="sort-by-dropdown-wrap">
                                                <span> Price <i class="fi-rs-angle-small-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="sort-by-dropdown">
                                            <ul>
                                                <li class="sort1" id="sort1" value="low-to-high"><a href="#"
                                                        role="button">Price: Low to High</a></li>
                                                <li class="sort2" value="high-to-low"><a href="#"
                                                        role="button">Price: High to Low</a></li>
                                                <li class="sort3"><a href="#" role="button">Avg. Rating</a></li>
                                                <input type="text" value="" class="sort_get" name="sort_by" hidden>
                                                <button type="submit" id="sort_by_form_submit" hidden></button>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                                <div class="mobile_filter ml-5">
                                    <div class="sort-by-product-wrap filter_icon">
                                        <div class="sort-by">
                                            <span><i class="fa-solid fa-filter"></i>Filter</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3 match-height">
                            @foreach ($product as $products)
                                <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap image_size">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('user.shop-detail', $products->slug) }}">
                                                    <img class="default-img shop_products"
                                                        src="{{ URL::asset('public/images/product/' . $products->thumbnail) }}"
                                                        alt="">
                                                    <img class="hover-img shop_products"
                                                        src="{{ URL::asset('public/images/product/' . $products->thumbnail) }}"
                                                        alt="">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn hover-up"
                                                    href="{{ route('user.shop-detail', $products->slug) }}"><i
                                                        class="fi-rs-eye"></i></a>
                                                <a aria-label="@if (array_key_exists($products->id, $wishlist)) {{ 'Removed To Wishlist' }}@else{{ 'Add To Wishlist' }} @endif"
                                                    data-product_id="{{ $products->id }}"
                                                    class="action-btn hover-up  @if (array_key_exists($products->id, $wishlist)) {{ 'active-wishlist remove-to-wishlist' }}@else{{ 'add-to-wishlist' }} @endif"
                                                    href="javascript:void(0);"
                                                    @if (array_key_exists($products->id, $wishlist)) data-wishlist_item_id="{{ $wishlist[$products->id] }}" @endif><i
                                                        class="fi-rs-heart"></i></a>
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
                                            $rating_count = App\Models\ProductReview::where('product_id', $products->id)->where('status',1)->count();
                                            $total_rating = App\Models\ProductReview::where('product_id', $products->id)->where('status',1)->sum('rating');
                                            if ($rating_count != 0 || $total_rating != 0) {
                                                $avg_rating = $total_rating / $rating_count;
                                            } else {
                                                $avg_rating = '0';
                                            }
                                        @endphp
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{ route('user.subcategory',$products->category->slug) }}">{{ $products->category->name }}</a>
                                            </div>
                                            <h2 class="title"><a
                                                    href="{{ route('user.shop-detail', $products->slug) }}">{{ Str::of($products->name)->limit(45, '...') }}</a>
                                            </h2>
                                            @php
                                                $avg_percentage = $avg_rating * 20;
                                            @endphp
                                            <div style="display: flex">
                                                <div class="product-rate" style="display: flex;align-self: center;">
                                                    <div class="product-rating"
                                                        style="width:{{ round($avg_percentage, 1) }}%">
                                                    </div>
                                                </div>
                                                <span style="align-self: flex-end;padding-left: 5px;">
                                                    <span>{{ round($avg_rating, 1) }}</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                @if ($countryPrice == 'IN')
                                                    <span>₹{{ $products->selling_price }} </span>
                                                    <span
                                                        class="old-price">₹{{ number_format($products->original_price, 2, '.', ',') }}</span>
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
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            <nav aria-label="Page navigation example">
                                {{ $product->links('pagination::default') }}
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar large_display-filter">
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                            <ul class="categories">
                                @foreach ($product_category as $product_categories)
                                    @php
                                        $product_subcategory = App\Models\SubCategory::where('status', 1)
                                            ->where('category_id', $product_categories->id)
                                            ->get();
                                    @endphp
                                    <li class="dropdown">
                                        <a href="javascript:;" class="dropdown-toggle sub-btn" data-option="off">
                                            <span class="micon dw dw-delivery-truck-2"></span><span
                                                class="mtext">{{ ucfirst($product_categories->name) }}
                                                ({{ $product_categories->subcategory_count }})</span>
                                        </a>
                                        <ul class="submenu sub-menu" style="display: none;">
                                            @foreach ($product_subcategory as $product_subcategories)
                                                <li style="margin-left: 5px"><a
                                                        href="{{ route('user.shop-category', ['cat' => $product_categories->slug, 'subcat' => $product_subcategories->slug]) }}"><i
                                                            class="fi-rs-angle-double-small-right"
                                                            style="font-size: 10px"></i>
                                                        {{ ucfirst($product_subcategories->name) }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Fillter By Price -->
                        <form method="GET" action="{{ route('user.shop') }}" name="product_form">
                            <div class="sidebar-widget price_range range mb-30">
                                <div class="widget-header position-relative mb-20 pb-10">
                                    <h5 class="widget-title mb-10">Filter</h5>
                                    <div class="bt-1 border-color-1"></div>
                                </div>
                                <div class="price-filter">
                                    <label class="fw-900 pb-8">Price</label>
                                    <div class="price-filter-inner">
                                        <div id="slider-range"></div>
                                        <div class="price_slider_amount">
                                            <div class="label-input">
                                                <input type='hidden' name='price_min'
                                                    value='{{ request()->get(' price_min') }}'>
                                                <input type='hidden' name='price_max'
                                                    value='{{ request()->get(' price_max') }}'>
                                                <p class='current_price_filter'></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group">
                                    <div class="list-group-item mb-10 mt-10">
                                        <label class="fw-900">Color</label>
                                        <div class="custome-checkbox">
                                            @foreach ($color as $colors)
                                                <input class="form-check-input" type="checkbox" name="color"
                                                    id="exampleCheckbox{{ $colors['color'] }}"
                                                    value="{{ $colors['color'] }}"
                                                    {{ request()->get('color') == $colors['color'] ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="exampleCheckbox{{ $colors['color'] }}"><span>{{ ucfirst($colors['color']) }}
                                                    </span></label>
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>
                                    Fillter</button>
                            </div>
                        </form>
                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">New products</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @foreach ($new_product as $new_products)
                                <div class="single-post clearfix">
                                    <div class="image">
                                        <img src="{{ URL::asset('public/images/product/' . $new_products->thumbnail) }}"
                                            alt="#">
                                    </div>
                                    @php
                                        $rating_count = App\Models\ProductReview::where('product_id', $new_products->id)->where('status',1)->count();
                                        $total_rating = App\Models\ProductReview::where('product_id', $new_products->id)->where('status',1)->sum('rating');
                                        if ($rating_count != 0 || $total_rating != 0) {
                                            $avg_rating = $total_rating / $rating_count;
                                        } else {
                                            $avg_rating = '0';
                                        }
                                    @endphp
                                    <div class="content pt-10">
                                        <h5><a
                                                href="{{ route('user.shop-detail', $new_products->slug) }}">{{ Str::of($new_products->name)->limit(30, '...') }}</a>
                                        </h5>
                                        @if ($countryPrice == 'IN')
                                            <p class="price mb-0 mt-5">₹{{ $new_products->selling_price }}</p>
                                        @else
                                            <p class="price mb-0 mt-5">${{ $new_products->selling_price_dollar }}</p>
                                        @endif
                                        @php
                                            $avg_percentage = $avg_rating * 20;
                                        @endphp
                                        <div class="product-rate">
                                            <div class="product-rating" style="width:{{ round($avg_percentage, 1) }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if ($shopbanner)
                        <div class="banner-img wow fadeIn mb-45 animated d-lg-block d-none">
                            <a href="{{ $shopbanner->url }}">
                                <img src="{{ asset('public/banner_images/shop/'.$shopbanner->image) }}" alt="">
                            </a>
                        </div>
                        @else
                        <div class="banner-img wow fadeIn mb-45 animated d-lg-block d-none">
                            <img src="{{ asset('public/frontend/assets/imgs/banner/shop-sale.png') }}" alt="">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- mobiles filter sidebar... --}}
    <div class="mobile-header-actives mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{ route('user.dashboard') }}"><img src="{{ asset('public/images/logo/mobile_logo.png') }}" alt="logo"></a>
                </div>
                <div class="mobile-filter-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border" style="text-align: center;">
                    <h4><i class="fa-solid fa-filter"></i> Filters</h4>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">

                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children">
                            </li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Category</a>
                                <ul class="dropdown">
                                    @php
                                        $product_category = App\Models\ProductCategory::where('status',1)->get();
                                    @endphp
                                    @foreach ($product_category as $product_categories)
                                    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">{{ $product_categories->name }}</a>
                                        <ul class="dropdown">
                                            @php
                                                $product_subcategory = App\Models\SubCategory::where('status',1)->where('category_id',$product_categories->id)->get();
                                            @endphp
                                            @if (count($product_subcategory)>0)
                                            @foreach ($product_subcategory as $product_subcategories)
                                            <li><a href="{{ route('user.shop-category',['cat'=>$product_categories->slug,'subcat'=>$product_subcategories->slug]) }}"><i
                                                class="fi-rs-angle-double-small-right"
                                                style="font-size: 10px"></i> {{ ucfirst($product_subcategories->name) }}</a></li>
                                            @endforeach
                                            @else
                                            <li><a href="javascript:void(0)">SubCategory Not Found</a></li>
                                            @endif
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Price & Color</a>
                                <ul class="dropdown">
                                    <div class="primary-sidebar sticky-sidebar">
                                        <form method="GET" action="{{ route('user.shop') }}" name="product_form">
                                            <div class=" range mb-30">
                                                <div class="price-filter">
                                                    <label class="fw-900 pb-8">Price</label>
                                                    <div class="price-filter-inner">
                                                        <div id="slider-range-mobile"></div>
                                                        <div class="price_slider_amount">
                                                            <div class="label-input">
                                                                <input type='hidden' name='price_min'
                                                                    value='{{ request()->get(' price_min') }}'>
                                                                <input type='hidden' name='price_max'
                                                                    value='{{ request()->get(' price_max') }}'>
                                                                <p class='current_price_filter'></p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-group">
                                                    <div class="list-group-item mb-10 mt-10">
                                                        <label class="fw-900">Color</label>
                                                        <div class="custome-checkbox">
                                                            @foreach ($color as $colors)
                                                                <input class="form-check-input" type="checkbox" name="color"
                                                                    id="examplemobileCheckbox{{ $colors['color'] }}"
                                                                    value="{{ $colors['color'] }}"
                                                                    {{ request()->get('color') == $colors['color'] ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="examplemobileCheckbox{{ $colors['color'] }}"><span>{{ $colors['color'] }}
                                                                    </span></label>
                                                                <br>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>
                                                    Fillter</button>
                                            </div>
                                        </form>
                                    </div>
                                </ul>
                            </li>
                            <li>

                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script src="{{ asset('public/frontend/validation/global.js') }}"></script>

    <script  async>
        var current_min_price = "{{ request()->get('price_min') }}";
        var current_max_price = "{{ request()->get('price_max') }}";
        var min_price = "{{ $min_price }}";
        var max_price = "{{ $max_price }}";
        if (current_min_price != '' && current_min_price != undefined) {
            var min_val = current_min_price;
        } else {
            var min_val = min_price;
        }
        if (current_max_price != '' && current_max_price != undefined) {
            var max_val = current_max_price;
        } else {
            var max_val = max_price;
        }

        var country_select = "{{ $countryPrice }}";
        if (country_select == 'IN') {
            jQuery("#slider-range").slider({
                range: true,
                min: {{ $min_price }},
                max: {{ $max_price }},
                values: [min_val, max_val],
                slide: function(event, ui) {
                    jQuery(".current_price_filter").text("₹" + ui.values[0] + " - ₹" + ui.values[1]);
                    jQuery(document).find('input[name="price_min"]').val(ui.values[0]);
                    jQuery(document).find('input[name="price_max"]').val(ui.values[1]);
                }
            });
            $(".current_price_filter").text("₹" + $("#slider-range").slider("values", 0) +
            " - ₹" + $("#slider-range").slider("values", 1));
        } else {
            jQuery("#slider-range").slider({
                range: true,
                min: {{ $min_price }},
                max: {{ $max_price }},
                values: [min_val, max_val],
                slide: function(event, ui) {
                    jQuery(".current_price_filter").text("$" + ui.values[0] + " - $" + ui.values[1]);
                    jQuery(document).find('input[name="price_min"]').val(ui.values[0]);
                    jQuery(document).find('input[name="price_max"]').val(ui.values[1]);
                }
            });
            $(".current_price_filter").text("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1));
        }


        if (country_select == 'IN') {
            jQuery("#slider-range-mobile").slider({
                range: true,
                min: {{ $min_price }},
                max: {{ $max_price }},
                values: [min_val, max_val],
                slide: function(event, ui) {
                    jQuery(".current_price_filter").text("₹" + ui.values[0] + " - ₹" + ui.values[1]);
                    jQuery(document).find('input[name="price_min"]').val(ui.values[0]);
                    jQuery(document).find('input[name="price_max"]').val(ui.values[1]);
                }
            });
            $(".current_price_filter").text("₹" + $("#slider-range-mobile").slider("values", 0) +
                " - ₹" + $("#slider-range-mobile").slider("values", 1));

        } else {
            jQuery("#slider-range-mobile").slider({
            range: true,
            min: {{ $min_price }},
            max: {{ $max_price }},
            values: [min_val, max_val],
            slide: function(event, ui) {
                jQuery(".current_price_filter").text("$" + ui.values[0] + " - $" + ui.values[1]);
                jQuery(document).find('input[name="price_min"]').val(ui.values[0]);
                jQuery(document).find('input[name="price_max"]').val(ui.values[1]);
            }
        });
        $(".current_price_filter").text("$" + $("#slider-range-mobile").slider("values", 0) +
            " - $" + $("#slider-range-mobile").slider("values", 1));
        }
    </script>

    <script  async>
        jQuery(document).on('click', '.sort1', function() {
            $('.sort_get').val('low_to_high');
            $('#sort_by_form_submit').trigger('click');
        });
        jQuery(document).on('click', '.sort2', function() {
            $('.sort_get').val('high_to_low');
            $('#sort_by_form_submit').trigger('click');
        });
        jQuery(document).on('click', '.sort3', function() {
            $('.sort_get').val('rating');

        });
    </script>

    <script  async>
        var add_wishlist_url = '{{ route('wishlists.create') }}';
    </script>

    <script  async>
        $(document).ready(function() {
            //jquery for toggle sub menus
            $('.sub-btn').click(function() {
                $(this).next('.sub-menu').slideToggle();
                $(this).parent('li').addClass('show');
                if ($(this).data('option') == 'on') {
                    $(this).data('option', 'off');
                    $(this).parent('li').removeClass('show');
                    $(this).removeClass('active');
                    $(this).css('color', '');
                } else {
                    $(this).data('option', 'on');
                    $(this).parent('li').addClass('show');
                    $(this).addClass('active');
                    $(this).css('color', '#751d1c');
                    // Do something when data-option is not 'on'
                }
                $(this).find('.dropdown').toggleClass('rotate');
            });

            //jquery for expand and collapse the sidebar
            $('.menu-btn').click(function() {
                $('.dropdown').addClass('show');
                $('.menu-btn').css("visibility", "visible");
            });

            $('.close-btn').click(function() {
                $('.dropdown').removeClass('show');
                $('.menu-btn').css("visibility", "visible");
            });
        });



        // Loop through each element with the class "current_price_filter"
        var country_select = "{{ $countryPrice }}";
        if (country_select == 'IN') {
            $(".current_price_filter").each(function() {
                // Get the text of the element and replace the dollar sign with the rupee symbol
                var priceText = $(this).text().replace("$", "₹");
                // Set the new text of the element
                $(this).text(priceText);
            });
        } else {
            $(".current_price_filter").each(function() {
                // Get the text of the element and replace the dollar sign with the rupee symbol
                var priceText = $(this).text().replace("$", "$");
                // Set the new text of the element
                $(this).text(priceText);
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
    <script  async>
        var $j = jQuery.noConflict();
        $j(function() {
            $j('.title').matchHeight();
        });
    </script>

    {{-- filter sidebar... --}}
    <script  async>
        function mobileHeaderActive() {
        var navbarTrigger = $('.filter_icon'),
            endTrigger = $('.mobile-filter-close'),
            container = $('.mobile-header-actives'),
            wrapper4 = $('body');

        wrapper4.prepend('<div class="body-overlay-1"></div>');

        navbarTrigger.on('click', function(e) {
            e.preventDefault();
            container.addClass('filter_sidebar-visible');
            wrapper4.addClass('mobile-filter-active');
        });

        endTrigger.on('click', function() {
            container.removeClass('filter_sidebar-visible');
            wrapper4.removeClass('mobile-filter-active');
        });

        $('.body-overlay-1').on('click', function() {
            container.removeClass('sidebar-visible');
            wrapper4.removeClass('mobile-filter-active');
        });
    };
    mobileHeaderActive();
    </script>
    <script  async>
            $('.filter_icon').on('click', function(){
                $('body').css('overflow-y','hidden');
            });
            $('.mobile-filter-close').on('click', function(){
                $('body').css('overflow-y','');
            });
        </script>
@endsection
