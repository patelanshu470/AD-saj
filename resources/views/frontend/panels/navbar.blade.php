<header class="header-area header-style-5 header-height-2">
    <style>
   .logo {
    display: block;
}

/* Styles for the mobile logo */
.mobile-logo {
    display: none;
}


/* Media query for screens smaller than 768px (typical mobile devices) */
@media screen and (max-width: 767px) {
    /* Hide the regular logo */
    .logo {
        display: none;
    }

    /* Show the mobile logo */
    .mobile-logo {
        display: block;
    }
    .mobile-logo {
        display: flex;
        width: 100%;
    }
}

/* Media query for screens larger than 767px */
@media screen and (min-width: 768px) {
    /* Show the regular logo */
    .logo {
        display: block;
    }

    /* Hide the mobile logo */
    .mobile-logo {
        display: none;
    }
}
    </style>
    <div class="header-bottom  sticky-white-bg ">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo" >
                    <a href="{{ route('user.dashboard') }}"><img src="{{ asset('public/images/logo/small_logo1.png') }}" alt="logo" style="width: 230px; margin-top: 5px;"></a>
                </div>
                <div class="mobile-logo">
                    <div class="header-action-icon d-block d-lg-none" style="align-self: center">
                        <div class="burger-icon">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                    <a href="{{ route('user.dashboard') }}" style="width: 100%;text-align: center;"><img src="{{ asset('public/images/logo/small_mobile_logo.png') }}" alt="logo" style="width: 145px; margin-top: 5px;"></a>
                </div>
                <div class="main-menu main-menu-grow main-menu-padding-1 main-menu-lh-1 main-menu-mrg-1 hm3-menu-padding d-none d-lg-block hover-boder">
                    <nav>
                        <ul>
                            <li><a class="{{ Route::currentRouteName() === 'user.dashboard' ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Home</a>
                            </li>
                            <li><a class="{{ Route::currentRouteName() === 'user.shop' ? 'active' : '' }}
                                {{ Route::currentRouteName() === 'user.cart' ? 'active' : '' }}
                                {{ Route::currentRouteName() === 'user.shop-detail' ? 'active' : '' }}" href="{{ route('user.shop') }}">Shop</a>
                            </li>
                            @php
                                $product_category = App\Models\ProductCategory::where('status',1)->get();
                            @endphp
                            <li><a href="#" class="{{ Route::currentRouteName() === 'user.shop-category' ? 'active' : '' }}">Category <i class="fi-rs-angle-down"></i></a>
                                <ul class="sub-menu">
                                    @foreach ($product_category as $product_categories)
                                    @php
                                        $product_subcategory = App\Models\SubCategory::where('status',1)->where('category_id',$product_categories->id)->get();
                                    @endphp
                                        <li><a href="{{ route('user.subcategory',$product_categories->slug) }}">{{ ucfirst($product_categories->name) }} <i class="fi-rs-angle-right"></i></a>
                                            <ul class="level-menu level-menu-modify">
                                                @if (count($product_subcategory)>0)
                                                @foreach ($product_subcategory as $product_subcategories)
                                                <li><a href="{{ route('user.shop-category',['cat'=>$product_categories->slug,'subcat'=>$product_subcategories->slug]) }}">{{ ucfirst($product_subcategories->name) }}</a></li>
                                                @endforeach
                                                @else
                                                <li><a href="javascript:void(0)">SubCategory Not Found</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="#" class="{{ Route::currentRouteName() === 'customerHighlights.images' ? 'active' : '' }}">Highlights <i class="fi-rs-angle-down"></i></a>
                                <ul class="sub-menu">
                                        <li><a href="{{ route('customerHighlights.images') }}">Images</a></li>
                                        <li><a href="{{ route('customerHighlights.videos') }}">Videos</a></li>
                                </ul>
                            </li>
                            @if (auth()->user())
                            <li><a class="{{ Route::currentRouteName() === 'user.profile' ? 'active' : '' }}" href="{{ route('user.profile') }}">My Account </a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('user.contact') }}">Contact</a>
                            </li>

                        </ul>
                    </nav>
                </div>
                <div class="header-action-right">
                    <div class="search-style-2">
                        <form action="{{ route('user.shop') }}">
                            <input type="text" name="product_name_search" placeholder="Search for items…">
                        </form>
                    </div>
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            @if (auth()->user())
                            @php
                                $count_wishlist = App\Models\Wishlist::where('user_id',auth()->user()->id)->count();
                            @endphp
                                <a href="{{ route('wishlists.index') }}">
                                   <img alt="Wishlist" src="{{ asset('public/frontend/assets/imgs/theme/icons/wishlist.png') }}">
                                    <span class="pro-count blue" id="wishlist_total">{{ $count_wishlist }}</span>
                                </a>
                            @else
                                <a href="{{ route('wishlists.index') }}">
                                   <img alt="Wishlist" src="{{ asset('public/frontend/assets/imgs/theme/icons/wishlist.png') }}">
                                    <span class="pro-count blue" id="wishlist_total">0</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            @endif
                        </div>
                        <style>
                            @media only screen and (max-width: 768px) {
                                .header-action-2 .header-action-icon-2:hover .cart-dropdown-wrap{
                                    display: none;
                                }
                            }
                        </style>
                        <div class="header-action-icon-2">
                            @if (auth()->user())
                                @php
                                    $count_cartData = App\Models\Cart::join('products', 'carts.product_id', '=', 'products.id')->where('products.status', '1')->whereNull('products.deleted_at')->where('carts.user_id',auth()->user()->id)->select('carts.*')->count();
                                @endphp
                                <a class="mini-cart-icon" href="{{ route('user.cart') }}">
                                    <img alt="Cart" src="{{ asset('public/frontend/assets/imgs/theme/icons/shop-bag.png') }}">
                                    <span class="pro-count blue" id="cart_total">{{ $count_cartData }}</span>
                                </a>
                            @else
                                <a class="mini-cart-icon" href="{{ route('user.cart') }}">
                                    <img alt="Cart" src="{{ asset('public/frontend/assets/imgs/theme/icons/shop-bag.png') }}">
                                    <span class="pro-count blue">0</span>
                                </a>
                            @endif
                            @if (auth()->user())
                            @php
                                $user_id = Auth::user()->id;
                                $cartData = App\Models\Cart::join('products', 'carts.product_id', '=', 'products.id')->with('getCartInformation')->where('carts.user_id', $user_id)->where('products.status', '1')->whereNull('products.deleted_at')->select('carts.*')->get();
                                // dd($cartData);
                                #Country Check
                                $countryPrice = session()->get('processedData');
                                if (!empty($cartData->toArray())) {
                                    $cartData = $cartData;
                                } else {
                                    $cartData = array();
                                }
                                if ($countryPrice == 'IN') {
                                    $sum = [];
                                    foreach ($cartData as $cartDatas) {
                                        $product_sub_total =  $cartDatas->getCartInformation->selling_price * $cartDatas->quantity;
                                        $sum[] = $product_sub_total;
                                    }
                                    $cart_product_total = array_sum($sum);
                                } else {
                                    $sum = [];
                                    foreach ($cartData as $cartDatas) {
                                        $product_sub_total =  $cartDatas->getCartInformation->selling_price_dollar * $cartDatas->quantity;
                                        $sum[] = $product_sub_total;
                                    }
                                    $cart_product_total = array_sum($sum);
                                }

                            @endphp
                                <div class="cart-dropdown-wrap cart-dropdown-hm2" id="cart-dropdown-model">
                                    <ul>
                                        @if ($cartData == null)
                                            <li>
                                                <div class="row">
                                                    <div class="col-lg-1 shopping-cart-title"></div>
                                                    <div class="col-lg-10 shopping-cart-title">
                                                        <a href="#"><img alt="Empty Cart" src="{{ asset('public/frontend\assets\imgs\banner\empty_cart_red.png') }}" style="width: 600px"></a>

                                                    </div>
                                                    <h4 class="text-center">Your Cart is Empty</h4>
                                                    <div class="col-lg-3 shopping-cart-title"></div>
                                                </div>
                                            </li>
                                        @endif
                                        @foreach ($cartData as $cartProduct)
                                        <li>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 shopping-cart-img">
                                                    <a href="#"><img alt="Color Image" src="{{ URL::asset('public/images/product/'.$cartProduct->getCartInformation->thumbnail)}}"></a>
                                                </div>
                                                <div class="col-lg-8 col-md-4 shopping-cart-title">
                                                    <h4><a href="#">{{ Str::of($cartProduct->getCartInformation->name)->limit(35, '...') }}</a></h4>
                                                    @if ($countryPrice == 'IN')
                                                        <h3><span>{{ $cartProduct->quantity }} × </span>₹{{ $cartProduct->getCartInformation->selling_price }}</h3>
                                                    @else
                                                        <h3><span>{{ $cartProduct->quantity }} × </span>${{ $cartProduct->getCartInformation->selling_price_dollar }}</h3>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total" id="shopping-cart-total">
                                            @if ($countryPrice == 'IN')
                                                <h4>Total <span>₹{{ $cart_product_total }}.00</span></h4>
                                            @else
                                                <h4>Total <span>${{ $cart_product_total }}.00</span></h4>
                                            @endif
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('user.cart') }}">View cart</a>
                                            <a href="{{ route('user.checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if (auth()->user())
                            <div class="header-action-icon-2" id="logout_mob">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();logout();">
                                    <i class="fas fa-sign-out-alt" style="color: #ffffff;font-size:30px"></i>
                                </a>
                            </div>
                            <script  async>
                                function logout() {
                                    Swal.fire({
                                       title: 'Confirmation!',
                                       text: 'Are you sure, you want to Logout?',
                                       icon: 'warning',
                                       showCancelButton: true,
                                       confirmButtonColor: "#751d1c",
                                       confirmButtonText: 'Yes!',
                                       cancelButtonText: "No, cancel please!",
                                   }).then((result) => {
                                       if (result.isConfirmed) {
                                           document.getElementById('logout-form').submit();
                                       } else
                                           return false;
                                   });
                                }
                            </script>

                            <style> .swal2-styled.swal2-default-outline:focus {
                                box-shadow: 0 0 0 3px #c9b2b1;
                            }
                            .swal2-styled.swal2-confirm:focus {
                                box-shadow: 0 0 0 3px #c9b2b1;
                            }</style>

                        @else
                            <div class="header-action-icon-2">
                                <a href="{{ route('user.login') }}">
                                    <img alt="User" src="{{ asset('public/frontend/assets/imgs/theme/icons/user.png') }}">
                                </a>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<style>
    .mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area .mobile-menu-wrap nav .mobile-menu li .active {
        color: #cd4040;
    }

</style>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ route('user.dashboard') }}"><img src="{{ asset('public/images/logo/mobile_logo.png') }}" alt="logo"></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{ route('user.shop') }}">
                    <input type="text" name="product_name_search" placeholder="Search for items…">
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">

                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><a class="{{ Route::currentRouteName() === 'user.dashboard' ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="menu-item-has-children"><a class="{{ Route::currentRouteName() === 'user.shop' ? 'active' : '' }}
                            {{ Route::currentRouteName() === 'user.shop-category' ? 'active' : '' }}
                            {{ Route::currentRouteName() === 'user.cart' ? 'active' : '' }}
                            {{ Route::currentRouteName() === 'user.shop-detail' ? 'active' : '' }}" href="{{ route('user.shop') }}">shop</a>
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
                                        <li><a href="{{ route('user.shop-category',['cat'=>$product_categories->slug,'subcat'=>$product_subcategories->slug]) }}">{{ ucfirst($product_subcategories->name) }}</a></li>
                                        @endforeach
                                        @else
                                        <li><a href="javascript:void(0)">SubCategory Not Found</a></li>
                                        @endif
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Highlights</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('customerHighlights.images') }}">Images</a></li>
                                <li><a href="{{ route('customerHighlights.videos') }}">Videos</a></li>
                            </ul>
                        </li>
                        @if (auth()->user())
                        <li class="menu-item-has-children"><a class="{{ Route::currentRouteName() === 'user.profile' ? 'active' : '' }}" href="{{ route('user.profile') }}">My Account </a>
                        </li>
                        @endif
                        <li class="menu-item-has-children"><a href="https://www.dtdc.in/tracking.asp" target="_blank">Tracking order</a></li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap mobile-header-border">
                <div class="single-mobile-header-info mt-30">
                    <a  href="{{route('user.contact')}}"> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    @if (auth()->user())
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{__('Logout')}}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            @else
                        <a href="{{ route('user.login') }}">Log In / Sign Up</a>
                            @endif
                </div>
                <div class="single-mobile-header-info">
                    <a href="#">+91 81600 55855 </a>
                </div>
            </div>
        </div>
    </div>
</div>

