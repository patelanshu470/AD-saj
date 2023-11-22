<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\ReviewController;
use App\Http\Controllers\backend\TransactionController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\AddressController;
use App\Http\Controllers\backend\CustomerHighlightsController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\backend\ReportController;
use App\Http\Controllers\backend\ContactUsController;
use App\Http\Controllers\backend\BannerController;

#frontend...
use App\Http\Middleware\OtpVerified;
use App\Http\Middleware\AdminDetailVerify;
use App\Http\Controllers\frontend\DashboardController as FrontDashboardController;
use App\Http\Controllers\frontend\AuthController as FrontAuthController;
use App\Http\Controllers\frontend\ProductController as FrontProductController;
use App\Http\Controllers\frontend\AuthOtpController;
use App\Http\Controllers\frontend\ProfileController as FrontProfileController;
use App\Http\Controllers\frontend\WishlistController as FrontWishlistController;
use App\Http\Controllers\frontend\CheckoutController as FrontCheckoutController;
use App\Http\Controllers\frontend\OrderController as FrontOrderController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\frontend\AddressController as FrontAddressController;
use App\Http\Controllers\frontend\CustomerHighlightsController as FrontCustomerHighlightsController;
use App\Http\Middleware\NoCache;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\frontend\ExtraController;
use App\Http\Controllers\PhonePayController;
use App\Http\Controllers\frontend\MobileOtpAuthController;


Auth::routes();
Route::prefix('admin')->group(function () {
    #Auth
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/', [LoginController::class, 'login']);

    #Admin Section
    // Route::middleware(['auth'])->group(function () {
        Route::post('product/store', [ProductController::class, 'storeProduct'])->name('product.store')->middleware('auth','admin');
        Route::post('product/update/{id}', [ProductController::class, 'updateProduct'])->name('product.update')->middleware('auth','admin');
        Route::group(['middleware' => ['auth','admin','XssSanitizer']], function () {
        #ajax route
        Route::get('new/order/fetch', [OrderController::class, 'CheckNewOrder'])->name('CheckNewOrder');
        Route::get('new/order/read', [OrderController::class, 'ReadNewOrder'])->name('ReadNewOrder');
        Route::get('product_colors/fetch', [ProductController::class, 'CheckProduct'])->name('CheckProduct');
        Route::middleware([AdminDetailVerify::class])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        #Category
        Route::get('category', [CategoryController::class, 'index'])->name('category');
        Route::post('category/add', [CategoryController::class, 'addCategory'])->name('category.add');
        Route::post('category/update/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
        Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');
        Route::post('category/status/change', [CategoryController::class, 'categoryStatus'])->name('category.status.change');
        #Product
        Route::get('product', [ProductController::class, 'index'])->name('product');
        Route::get('product/add/form', [ProductController::class, 'addProductForm'])->name('product.add.form');
        // Route::post('product/store', [ProductController::class, 'storeProduct'])->name('product.store');
        Route::get('product/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
        // Route::post('product/update/{id}', [ProductController::class, 'updateProduct'])->name('product.update');
        Route::get('product/image/{id}', [ProductController::class, 'imgDelete'])->name('product.image.del'); //Ajax Routes
        Route::get('product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');
        Route::post('product/status/change', [ProductController::class, 'productStatus'])->name('product.status.change'); //Ajax Routes
        Route::get('remove-quantity/{id}', [ProductController::class, 'removeQuantity'])->name('removeQuantity');
        Route::get('fetch-subcategory', [ProductController::class, 'fetchSubCat'])->name('fetchSubCat');
        Route::get('fetch-product', [ProductController::class, 'fetchProduct'])->name('fetchProduct');
        Route::get('fetch-sku',[ProductController::class,'fetchSku'])->name('productSku');
        Route::get('product/varient', [ProductController::class, 'productVarient'])->name('product.varient'); //ajax-route
        #Orders
        Route::get('orders', [OrderController::class, 'index'])->name('orders');
        Route::get('order-view/{id}', [OrderController::class, 'view'])->name('order_view');
        Route::get('order-invoice', [OrderController::class, 'invoice'])->name('order_invoice');
        Route::get('view-invoice', [OrderController::class, 'invoiceView'])->name('view_invoice');
        Route::get('download-invoice/{id}', [OrderController::class, 'generatePDF'])->name('download_invoice');
        Route::get('order-status', [OrderController::class, 'orderStatus'])->name('orderStatus');
        Route::get('order/user/canceled', [OrderController::class, 'OrderCanceled'])->name('OrderCanceled');
        Route::get('order/confirm', [OrderController::class, 'Confirmed'])->name('orderConfirm');
        Route::get('order/user/return', [OrderController::class, 'OrderReturn'])->name('OrderReturn');
        Route::get('order/delivered', [OrderController::class, 'Delivered'])->name('orderDelivered');
        Route::get('order/confirmation', [OrderController::class, 'orderConfirmation'])->name('orderConfirmation');
        Route::post('order/confirmation/status', [OrderController::class, 'orderConfirmationStatus'])->name('orderConfirmationStatus');
        Route::post('order-note/store', [OrderController::class, 'AdminOrderNote'])->name('adminOrderNote');
        Route::get('return-order-store/{id}',[OrderController::class, 'OrderReturnStore'])->name('adminOrderReturnStore');
        #Order label
        Route::get('order-label',[OrderController::class,'Orderlabel'])->name('Orderlabel');
        Route::get('order-label-download/{id}',[OrderController::class,'OrderlabelDownload'])->name('OrderlabelDownload');
        #Reviews
        Route::get('reviews', [ReviewController::class, 'index'])->name('reviews');
        Route::post('review/status/change', [ReviewController::class, 'reviewStatus'])->name('reviewStatus');
        #Customers
        Route::get('customers', [CustomerController::class, 'index'])->name('customers');
        Route::get('customer-view/{id}', [CustomerController::class, 'view'])->name('customerView');
        #Transactions
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions');
        #Admin Address
        Route::get('address', [AddressController::class, 'index'])->name('adminAddress');
        Route::post('address-create', [AddressController::class, 'create'])->name('adminAddressCreate');
        Route::post('address-edit', [AddressController::class, 'edit'])->name('adminAddressEdit');
        #Customer Highlights
        Route::get('customer-highlights',[CustomerHighlightsController::class,'index'])->name('customerHighlights');
        Route::get('customer-highlights-create',[CustomerHighlightsController::class,'create'])->name('customerHighlights.create');
        Route::post('customer-highlights-store',[CustomerHighlightsController::class,'store'])->name('customerHighlights.store');
        Route::get('customer-highlights-edit/{id}',[CustomerHighlightsController::class,'edit'])->name('customerHighlights.edit');
        Route::post('customer-highlights-update/{id}',[CustomerHighlightsController::class,'update'])->name('customerHighlights.update');
        Route::get('customer-highlights-destroy/{id}',[CustomerHighlightsController::class,'destroy'])->name('customerHighlights.destroy');
        #Sub Category
        Route::get('sub-category',[SubCategoryController::class,'index'])->name('subcategory');
        Route::post('sub-category/store',[SubCategoryController::class,'store'])->name('subcategory.store');
        Route::post('sub-category/update/{id}',[SubCategoryController::class,'update'])->name('subcategory.update');
        Route::get('sub-category/delete/{id}',[SubCategoryController::class,'delete'])->name('subcategory.delete');
        Route::post('sub-category/status/change', [SubCategoryController::class, 'subcategoryStatus'])->name('subcategory.status.change');
        #Report
        Route::get('report',[ReportController::class,'index'])->name('adminReport');
        Route::get('excel-report',[ReportController::class,'ExpotReport'])->name('ExpotReport');
        #Conatct Us
        Route::get('contact-us',[ContactUsController::class,'index'])->name('adminContactUs');
        #Banners
        Route::get('banner',[BannerController::class,'index'])->name('adminBanner');
        Route::post('store-slider',[BannerController::class,'slider'])->name('sliderStore');
        Route::post('store-mobile-slider',[BannerController::class,'mobileSlider'])->name('mobileSliderStore');
        Route::post('store-bigsell',[BannerController::class,'Bigsell'])->name('bigsellStore');
        Route::post('store-specialoffer',[BannerController::class,'specialOffer'])->name('specialOfferStore');
        Route::post('store-monthlysell',[BannerController::class,'Montlysell'])->name('monthlysellStore');
        Route::post('store-instabanner',[BannerController::class,'instabanner'])->name('instabannerStore');
        Route::post('store-shopbanner',[BannerController::class,'shopbanner'])->name('shopbannerStore');
    });
        #Setting
        Route::get('setting',[SettingController::class,'index'])->name('setting');
        Route::post('detail-create', [SettingController::class, 'createDetail'])->name('adminDetailCreate');
        Route::post('detail-edit', [SettingController::class, 'editDetail'])->name('adminDetailEdit');
        Route::post('social-create', [SettingController::class, 'createSocial'])->name('adminSocialCreate');
        Route::post('password-change', [SettingController::class, 'ChangePassword'])->name('adminChangePassword');
    });
});

// front-end...
Route::group(['middleware' => 'XssSanitizer'], function () {
    #forgot password..
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    #OTP
    Route::controller(AuthOtpController::class)->group(function () {
        Route::post('/check/user', 'checkUser')->name('check.user');
        Route::get('/otp/generate/{user_id}', 'generate')->name('otp.generate');
        Route::get('/otp/resend/{user_id}', 'resend')->name('otp.resend');
        Route::get('/otp/verification/{user_id}', 'verification')->name('otp.verification');
        Route::post('/otp/login', 'loginWithOtp')->name('otp.getlogin');
    });
    #Mobile OTP..
    Route::controller(MobileOtpAuthController::class)->group(function () {
        Route::post('/mobile/check/user', 'checkUser')->name('check.user.mobile');
        Route::get('/mobile/otp/generate/{user_id}', 'generate')->name('otp.generate.mobile');
        Route::get('/mobile/otp/resend/{user_id}', 'resend')->name('otp.resend.mobile');
        Route::get('/mobile/otp/verification/{user_id}', 'verification')->name('otp.verification.mobile');
        Route::post('/mobile/otp/login', 'loginWithOtp')->name('otp.getlogin.mobile');
    });
    #User Dashboard
    Route::get('/', [FrontDashboardController::class, 'index'])->name('user.dashboard');
    #User Auth
    Route::get('/auth', [FrontAuthController::class, 'login'])->name('user.login');
    Route::get('/user-register', [FrontAuthController::class, 'register'])->name('user.register');
    Route::get('/forgot-password', [FrontAuthController::class, 'forgotPassword'])->name('user.forgotPassword');
    Route::get('/term-conditions', [FrontAuthController::class, 'termCondition'])->name('user.termCondition');
    #User Product
    Route::get('/shop',[FrontProductController::class,'list'])->name('user.shop');
    Route::get('/category/{cat?}/{subcat?}/',[FrontProductController::class,'category'])->name('user.shop-category');
    Route::get('/shop-detail/{id}',[FrontProductController::class,'productDetails'])->name('user.shop-detail');
    Route::get('/subcategory/{name}',[FrontProductController::class,'subCategory'])->name('user.subcategory');
    #Highlights
    Route::get('/highlights/images', [FrontCustomerHighlightsController::class, 'Images'])->name('customerHighlights.images');
    Route::get('/highlights/videos', [FrontCustomerHighlightsController::class, 'Videos'])->name('customerHighlights.videos');
    Route::get('/load-more-data', [FrontCustomerHighlightsController::class,'loadMoreData'])->name('load-more-data');
    #policy and privacy
    Route::get('/privacy-policy',[ExtraController::class,'privacy'])->name('user.privacy');
    Route::get('/contact-us',[ExtraController::class,'contact'])->name('user.contact');
    Route::get('/about-us',[ExtraController::class,'about'])->name('user.about');
    Route::get('/shipping-policy',[ExtraController::class,'delivery'])->name('user.delivery');
    Route::get('/return-policy',[ExtraController::class,'return'])->name('user.return');
    Route::post('/store-contact-us',[ExtraController::class,'storeContactUs'])->name('user.storeContactUs');
    Route::get('/international-orders', [ExtraController::class,'internationalOrders'])->name('user.internationalOrders');
    Route::get('/cancel-policy', [ExtraController::class,'cancelPolicy'])->name('user.cancelPolicy');
    Route::get('/customer-highlight-policy', [ExtraController::class,'highlightPolicy'])->name('user.highlightPolicy');
    Route::post('/process-variable', [FrontDashboardController::class,'processVariable'])->name('user.processVariable');
    #Add to Cart
    Route::post('/add-cart', [FrontCheckoutController::class, 'addToCart'])->name('add-cart');
});
Route::group(['middleware' => ['no-cache','XssSanitizer']], function () {
    Route::middleware([OtpVerified::class])->group(function () {
        #Wishlist
        Route::resource('wishlists', FrontWishlistController::class);
        #User Profile
        Route::get('/user-profile', [FrontProfileController::class, 'index'])->name('user.profile');
        Route::post('/change-password', [FrontProfileController::class, 'changePassword'])->name('user.changePassword');
        Route::post('/edit-account', [FrontProfileController::class, 'editAccount'])->name('user.editAccount');
        Route::get('/otp/generates/{email}', [FrontProfileController::class, 'generate'])->name('user.otp.generate');
        Route::get('/otp/user-resend/{no}', [FrontProfileController::class, 'resend'])->name('otp.user_resend');
        Route::post('/otp/email/update', [FrontProfileController::class, 'emailUpdateWithOtp'])->name('user.otp.emailUpdate');
        Route::get('otp/verifications/{user_id}', [FrontProfileController::class, 'verification'])->name('user.otp.verification');
        Route::get('/view-order/{id}', [FrontProfileController::class, 'orderView'])->name('orderView');
        Route::get('/product-review/{id}', [FrontProfileController::class, 'productReview'])->name('productReview'); //e
        Route::post('/store-review', [FrontProfileController::class, 'storeReview'])->name('storeReview');
        Route::get('/edit-product-review/{id}', [FrontProfileController::class, 'editReview'])->name('editReview');
        Route::post('/update-review', [FrontProfileController::class, 'updateReview'])->name('updateReview');
        Route::post('order-tracking', [FrontProfileController::class, 'trackOrder'])->name('trackOrder');
        Route::get('/order-cancel/{id}', [FrontProfileController::class, 'orderCancle'])->name('orderCancle');  //e
        Route::post('/store/ordercancel', [FrontProfileController::class, 'storeOrderCancel'])->name('storeOrderCancel');
        Route::get('/product-return/{id}', [FrontProfileController::class, 'productReturn'])->name('productReturn'); //e
        Route::post('/store/orderreturn', [FrontProfileController::class, 'storeOrderReturn'])->name('storeOrderReturn');
        #User Address
        Route::get('/address/create', [FrontAddressController::class, 'create'])->name('user.address');
        Route::post('/address/store', [FrontAddressController::class, 'store'])->name('user.createAddress');
        Route::get('/address/edit/{id}', [FrontAddressController::class, 'edit'])->name('user.editAddress'); //e
        Route::post('/address/update/{id}', [FrontAddressController::class, 'update'])->name('user.updateAddress'); //e
        Route::get('/update-default-address', [FrontAddressController::class, 'UpdateDefaultAddress'])->name('user.update_default_address');
        Route::get('/delete-address/{id}', [FrontAddressController::class, 'delete'])->name('user.delete_address'); //e
        #Cart & Checkout

        Route::get('/cart', [FrontCheckoutController::class, 'cartIndex'])->name('user.cart');
        Route::get('/remove-cart/{id}', [FrontCheckoutController::class, 'removeToCart'])->name('user.remove-cart');  //e
        Route::get('/clear-cart', [FrontCheckoutController::class, 'clearCart'])->name('user.clear-cart');
        Route::get('/product-qty-inc', [FrontCheckoutController::class, 'qtyIncrement'])->name('user.product_qty_inc');
        Route::get('/checkout', [FrontCheckoutController::class, 'checkout'])->name('user.checkout');
        #Order
        Route::post('/add-order', [FrontOrderController::class, 'addOrder'])->name('user.addOrder');
        Route::get('/order-confirm/{order_id}', [FrontOrderController::class, 'orderConfirmIndex'])->name('order-confirm'); //ee
        Route::get('/order-mail', [FrontOrderController::class, 'OrderMail'])->name('orderMail');
        #payment
        Route::get('payment/page/{order_id}', [RazorpayPaymentController::class, 'index'])->name('razorpay.payment.page'); //e
        Route::post('payment/store/{order_id}', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store'); //e
        #PhonePay Payment
        Route::get('phonepe/{order_id}',[PhonePayController::class,'phonePe'])->name('phonePay');
        Route::post('phonepe-response',[PhonePayController::class,'response'])->name('response');
    });
});
