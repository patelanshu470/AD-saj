<div class="left-side-bar">
    <div class="brand-logo mt-5 mb-4">
        <a href="" style="justify-content: center;">
            <img src="{{asset('public/images/logo/logo.png')}}" alt="" class="dark-logo">
            <img src="{{asset('public/images/logo/logo.png')}}" alt="" class="light-logo" style="max-width: 71px;padding-bottom: 20px">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll" style="overflow: scroll;">
        <div class="sidebar-menu" style="margin-bottom: 50px;">
            <ul id="accordion-menu">
                <li>
                    <a href="{{route('dashboard')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">
                        <span class="micon dw dw-home"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle sub-btn" data-option="off">
                        <span class="micon dw dw-list"></span><span class="mtext">Category</span>
                    </a>
                    <ul class="submenu sub-menu" style="display: none;">
                        <li>
                            <a href="{{route('category')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'category' ? 'active' : '' }}">
                                <span class="mtext">Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('subcategory')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'subcategory' ? 'active' : '' }}">
                                <span class="mtext">Sub Category</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('adminBanner')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'adminBanner' ? 'active' : '' }}">
                        <span class="micon dw dw-image1"></span><span class="mtext">Banners</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('product')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'product' ? 'active' : '' }}
                    {{ Route::currentRouteName() === 'product.add.form' ? 'active' : '' }}
                    {{ Route::currentRouteName() === 'product.edit' ? 'active' : '' }}">
                        <span class="micon dw dw-shop"></span><span class="mtext">Product</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle sub-btn" data-option="off">
                        <span class="micon dw dw-delivery-truck-2" ></span><span class="mtext">Orders</span>
                    </a>
                    <ul class="submenu sub-menu" style="display: none;">
                        <li>
                            <a href="{{route('orders')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'orders' ? 'active' : '' }}">
                             All Orders
                            </a>
                        </li>
                        <li>
                            <a href="{{route('orderConfirmation')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'orderConfirmation' ? 'active' : '' }}">
                                Orders Confirmation
                            </a>
                        </li>
                        <li>
                            <a href="{{route('OrderCanceled')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'OrderCanceled' ? 'active' : '' }}">
                                Orders Canceled
                            </a>
                        </li>
                        <li>
                            <a href="{{route('OrderReturn')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'OrderReturn' ? 'active' : '' }}">
                                Orders Return
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('reviews')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'reviews' ? 'active' : '' }}">
                        <span class="micon dw dw-happy"></span><span class="mtext">Reviews</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle sub-btn" data-option="off">
                        <span class="micon dw dw-user-2"></span><span class="mtext">Customer</span>
                    </a>
                    <ul class="submenu sub-menu" style="display: none;">
                        <li>
                            <a href="{{route('customers')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'customers' ? 'active' : '' }}">
                                <span class="mtext">Customers</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('customerHighlights')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'customerHighlights' ? 'active' : '' }}">
                                <span class="mtext">Customer Highlights</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('transactions')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'transactions' ? 'active' : '' }}">
                        <span class="micon dw dw-money-2"></span><span class="mtext">Transactions</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('adminReport')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'adminReport' ? 'active' : '' }}">
                        <span class="micon dw dw-analytics-3"></span><span class="mtext">Report</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('adminContactUs')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'adminContactUs' ? 'active' : '' }}">
                        <span class="micon dw dw-book2"></span><span class="mtext">Contact Us</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('setting')}}" class="dropdown-toggle no-arrow {{ Route::currentRouteName() === 'setting' ? 'active' : '' }}">
                        <i class="micon dw dw-settings2" aria-hidden="true"></i><span class="mtext">Setting</span>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-toggle no-arrow" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="micon dw dw-logout"></span><span class="mtext">LogOut</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

