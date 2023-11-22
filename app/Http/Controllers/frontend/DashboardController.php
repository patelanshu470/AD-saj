<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductReview;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\CustomerHighlights;
use Carbon\Carbon;
use App\Models\Banner;
use Stevebauman\Location\Facades\Location;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $environment = app()->environment();
        if ($environment == 'production' || $environment == 'staging') {
            $ip = $request->ip();
            $currentUserInfo = Location::get($ip);
            session()->put('processedData', $currentUserInfo->countryCode);
        }
        #all Products
        $product = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->where([['product_categories.status','=',1],['sub_categories.status', '=', 1]])->where([['products.status','=',1]])
        ->select('products.*')->inRandomOrder()->limit(8)->get();
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $wishlist = Wishlist::where('user_id', $user_id)->pluck('id', 'product_id')->toArray();
        } else {
            $wishlist = array();
        }
        $popularProduct = Product::withCount('ratings')
        ->orderByDesc('ratings_count')
        ->with(['ratings' => function ($query) {
            $query->select('product_id', DB::raw('AVG(rating) as average_rating'))
                ->groupBy('product_id')
                ->havingRaw('AVG(rating) > 3');
        }])
        ->whereHas('ratings', function ($query) {
            $query->havingRaw('COUNT(*) > 1');
        })
        ->limit(8)
        ->get();
       $getpopularProduct = $popularProduct->map(function ($productdd) {
            $highestRated = $productdd->ratings->sortByDesc('average_rating')->first();
            $productdd->highest_rating = $highestRated ? $highestRated->average_rating : null;
            return $productdd;
        })->sortByDesc('highest_rating');
        #New Products
        $newProduct = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->where([['product_categories.status','=',1],['sub_categories.status', '=', 1]])->where([['products.status','=',1]])
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->select('products.*')->latest()->take(8)->get();
        #Product Category
        $product_category = ProductCategory::where('status',1)->get();
        #Monthly Best Sell
        $month = Carbon::now()->startOfMonth();
        $MonthlyBestSell = OrderProduct::with('getproductsData')->join('products', 'order_products.product_id', '=', 'products.id')
        ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->select('products.id', 'products.name', 'order_products.product_id', DB::raw('MAX(products.unique_id) as unique_id'), DB::raw('SUM(order_products.quantity) as total_quantity'))
        ->whereRaw('MONTH(order_products.created_at) = ?', [date('m', strtotime($month))])
        ->where('product_categories.status', 1)
        ->where('sub_categories.status', 1)
        ->groupBy('products.id', 'products.name', 'order_products.product_id')
        ->orderByDesc('total_quantity')
        ->get();
        #Monthly best selling popular products..
        $productIds = $getpopularProduct->pluck('id')->merge($MonthlyBestSell->pluck('id'))->unique()->values();
        $mergedQuery = Product::whereIn('products.id', $productIds)
        ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->where('product_categories.status', 1)
        ->where('sub_categories.status', 1)
        ->withCount('ratings')
        ->with(['ratings' => function ($query) {
            $query->select('product_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('product_id')
            ->havingRaw('AVG(rating) > 3');
        }])
        ->whereHas('ratings', function ($query) {
            $query->havingRaw('COUNT(*) > 1');
        })
        ->get();
        #Monthly best selling New products..
        $productIdsda = $newProduct->pluck('id')->merge($MonthlyBestSell->pluck('id'))->unique()->values();
        $MonthlyBestSellNewProduct = Product::whereIn('id', $productIdsda)->get();
        #Highlights Images
        $highlight_image = CustomerHighlights::join('product_categories', 'customer_highlights.category_id', '=', 'product_categories.id')->join('sub_categories', 'customer_highlights.subcategory_id', '=', 'sub_categories.id')->where('customer_highlights.ch_type','image')->where([['product_categories.status','=',1],['sub_categories.status', '=', 1]])->get();
        #Review
        $review = ProductReview::whereIn('rating', [4, 5])->whereNotNull('image')->get();
        #Country Check
        $countryPrice = session()->get('processedData');
        #Banners
        $sliders = Banner::where('type','slider')->get();
        $mobile_sliders = Banner::where('type','mobile_slider')->get();
        $bigSell = Banner::where('type','bigsell')->first();
        $special_offer = Banner::where('type','special_offer')->get();
        $monthly_sell = Banner::where('type','monthlysell')->first();
        $instabanner = Banner::where('type','instabanner')->first();
        return view('frontend.dashboard',compact('product','wishlist','popularProduct','newProduct','product_category','MonthlyBestSell','mergedQuery','MonthlyBestSellNewProduct','getpopularProduct','highlight_image','review','countryPrice','sliders','bigSell','special_offer','monthly_sell','instabanner','mobile_sliders'));
    }

    public function processVariable(Request $request)
    {
        $phpVariable = $request->input('myVariable');
        $processedData = $phpVariable;
        session()->put('processedData', $processedData);

        return response()->json(['message' => 'Variable processed successfully']);
    }
}
