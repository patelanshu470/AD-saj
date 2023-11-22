<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductReview;
use App\Models\Wishlist;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\Models\Banner;
use Stevebauman\Location\Facades\Location;

class ProductController extends Controller
{
    public function list(Request $request)
    {
        $environment = app()->environment();
        if ($environment == 'production' || $environment == 'staging') {
            $ip = $request->ip();
            $currentUserInfo = Location::get($ip);
            session()->put('processedData', $currentUserInfo->countryCode);
        }
        #Country Check
        $countryPrice = session()->get('processedData');
        $query = Product::query();
        $product_category = ProductCategory::where('status', 1)->get();
        $product_category->loadCount(['subcategory' => function ($query) {
            $query->where('status', 1);
        }]);
        $product_category = $product_category->map(function ($category) {
            $category->subcategory_count = $category->subcategory_count ?? 0;
            return $category;
        });
        if ($countryPrice == 'IN') {
            $min_price = floor(Product::min(Product::raw('selling_price')));
        } else {
            $min_price = floor(Product::min(Product::raw('selling_price_dollar')));
        }
        if ($countryPrice == 'IN') {
            # maximum product price get...
            $product_max_price =  Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
            ->where([
                ['product_categories.status', '=', 1],
                ['sub_categories.status', '=', 1]
            ])->where([['products.status', '=', 1]])
            ->orderBy(DB::raw('CAST(selling_price AS DECIMAL(10,2))'), 'desc')
            ->select('products.*')->first();
            $max_price = $product_max_price->selling_price;
            # minimum product price get...
            $product_min_price =  Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
            ->where([
                ['product_categories.status', '=', 1],
                ['sub_categories.status', '=', 1]
            ])->where([['products.status', '=', 1]])
            ->orderBy(DB::raw('CAST(selling_price AS DECIMAL(10,2))'), 'asc')
            ->select('products.*')->first();
            $min_price = $product_min_price->selling_price;
        } else {
            $product_max_price =  Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
            ->where([
                ['product_categories.status', '=', 1],
                ['sub_categories.status', '=', 1]
            ])->where([['products.status', '=', 1]])
            ->orderBy(DB::raw('CAST(selling_price_dollar AS DECIMAL(10,2))'), 'desc')
            ->select('products.*')->first();
            $max_price = $product_max_price->selling_price_dollar;
            # minimum product price get...
            $product_min_price =  Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
            ->where([
                ['product_categories.status', '=', 1],
                ['sub_categories.status', '=', 1]
            ])->where([['products.status', '=', 1]])
            ->orderBy(DB::raw('CAST(selling_price_dollar AS DECIMAL(10,2))'), 'asc')
            ->select('products.*')->first();
            $min_price = $product_min_price->selling_price_dollar;
        }
        if ($countryPrice == 'IN') {
            if ($request->input('price_min') != '' && $request->input('price_max') != '') {
                $query = $query->whereBetween(Product::raw('CAST(selling_price AS DECIMAL(10,2))'), [$request->input('price_min'), $request->input('price_max')]);
            }
        } else {
            if ($request->input('price_min') != '' && $request->input('price_max') != '') {
                $query = $query->whereBetween(Product::raw('CAST(selling_price_dollar AS DECIMAL(10,2))'), [$request->input('price_min'), $request->input('price_max')]);
            }
        }
        if ($request->input('color') != '') {
            $pb = ProductColor::select('product_id')->where('color', '=', $request->input('color'))->pluck('product_id')->toArray();
            $query = $query->where(function ($q) use ($pb) {
                $q->orWhere(function ($q) use ($pb) {
                    $q->whereIn('products.id', $pb);
                });
            });
        }
        if ($countryPrice == 'IN') {
            if ($request->input('sort_by') != '') {
                if ($request->input('sort_by') == 'low_to_high') {
                    $query = $query->orderBy(DB::raw('CAST(selling_price AS DECIMAL(10,2))'), 'asc');
                } elseif ($request->input('sort_by') == 'high_to_low') {
                    $query = $query->orderBy(DB::raw('CAST(selling_price AS DECIMAL(10,2))'), 'desc');
                } else {
                    $query = $query->orderBy('products.id', 'DESC');
                }
            }
        } else {
            if ($request->input('sort_by') != '') {
                if ($request->input('sort_by') == 'low_to_high') {
                    $query = $query->orderBy(DB::raw('CAST(selling_price_dollar AS DECIMAL(10,2))'), 'asc');
                } elseif ($request->input('sort_by') == 'high_to_low') {
                    $query = $query->orderBy(DB::raw('CAST(selling_price_dollar AS DECIMAL(10,2))'), 'desc');
                } else {
                    $query = $query->orderBy('products.id', 'DESC');
                }
            }
        }
        if ($request->input('product_name_search') != '') {
            $query = $query->where('products.name', 'LIKE', "%$request->product_name_search%");
        }
        $product = $query->join('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
        ->where([
            ['product_categories.status', '=', 1],
            ['sub_categories.status', '=', 1]
        ])->where([['products.status', '=', 1]])
        ->select('products.*')->paginate(12);
        $color = ProductColor::select('color')->distinct()->get();
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $wishlist = Wishlist::where('user_id', $user_id)->pluck('id', 'product_id')->toArray();
        } else {
            $wishlist = array();
        }
        $new_product = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
            ->where([
                ['product_categories.status', '=', 1],
                ['sub_categories.status', '=', 1]
            ])->where([['products.status', '=', 1]])
            ->select('products.*')->latest()->take(3)->get();
        $shopbanner = Banner::where('type','shopbanner')->first();

        return view('frontend.shop.list', compact('product_category', 'product', 'min_price', 'max_price', 'color', 'new_product', 'wishlist','countryPrice','shopbanner'));
    }

    public function category(Request $request, $cat, $subcat)
    {
        $subcategory = SubCategory::where('slug',$subcat)->firstOrFail();
        $category_name = ProductCategory::where('slug',$cat)->firstOrFail();
        $product = Product::where([['status',1],['subcategory_id',$subcategory->id],['category_id',$category_name->id]])->paginate(12);
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $wishlist = Wishlist::where('user_id', $user_id)->pluck('id', 'product_id')->toArray();
        } else {
            $wishlist = array();
        }
        #Country Check
        $countryPrice = session()->get('processedData');
        return view('frontend.shop.category', compact('product', 'wishlist', 'category_name', 'subcategory','countryPrice'));
    }

    public function subCategory(Request $request, $name)
    {
        $category_name = ProductCategory::where('slug',$name)->firstOrFail();
        $subCategory = SubCategory::where('category_id',$category_name->id)->where('status',1)->get();
        return view('frontend.shop.subcategory',compact('subCategory','category_name'));
    }

    public function productDetails($id)
    {
        $find_product = Product::where('slug',$id)->firstOrFail();
        $product = Product::with('getProductInformation')->where('id',$find_product->id)->firstOrFail();
        $category_product = Product::where([['category_id',$product->category_id],['id','<>',$find_product->id]])->where('status',1)->get();
        $active=$product->status;
        if ($active!=false) {
            if (Auth::check()) {
                $user_id = Auth::user()->id;
                $wishlist = Wishlist::where('user_id', $user_id)->pluck('id', 'product_id')->toArray();
            } else {
                $wishlist = array();
            }
        }
        $ProductReview = ProductReview::where('product_id', $find_product->id)->where('status',1)->get();

        $rating_count = ProductReview::where('product_id', $find_product->id)->where('status',1)->count();
        $total_rating = ProductReview::where('product_id', $find_product->id)->where('status',1)->sum('rating');
        if ($rating_count != 0 || $total_rating != 0) {
            $avg_rating = $total_rating / $rating_count;
        } else {
            $avg_rating = '0';
        }
        // five star rating...
        $five_rating_count = ProductReview::where('product_id', $find_product->id)->where('status',1)->count();
        $five_total_rating = ProductReview::where([['product_id', $find_product->id], ['rating', 5]])->where('status',1)->sum('rating');
        if ($five_rating_count != 0 || $five_total_rating != 0) {
            $five_avg_rating = $five_total_rating / $five_rating_count;
        } else {
            $five_avg_rating = '0';
        }
        // four star rating...
        $four_rating_count = ProductReview::where('product_id', $find_product->id)->where('status',1)->count();
        $four_total_rating = ProductReview::where([['product_id', $find_product->id], ['rating', 4]])->where('status',1)->sum('rating');
        if ($four_rating_count != 0 || $four_total_rating != 0) {
            $four_avg_rating = $four_total_rating / $four_rating_count;
        } else {
            $four_avg_rating = '0';
        }
        // three star rating...
        $three_rating_count = ProductReview::where('product_id', $find_product->id)->where('status',1)->count();
        $three_total_rating = ProductReview::where([['product_id', $find_product->id], ['rating', 3]])->where('status',1)->sum('rating');
        if ($three_rating_count != 0 || $three_total_rating != 0) {
            $three_avg_rating = $three_total_rating / $three_rating_count;
        } else {
            $three_avg_rating = '0';
        }
        // two star rating...
        $two_rating_count = ProductReview::where('product_id', $find_product->id)->where('status',1)->count();
        $two_total_rating = ProductReview::where([['product_id', $find_product->id], ['rating', 2]])->where('status',1)->sum('rating');
        if ($two_rating_count != 0 || $two_total_rating != 0) {
            $two_avg_rating = $two_total_rating / $two_rating_count;
        } else {
            $two_avg_rating = '0';
        }
        // one star rating...
        $one_rating_count = ProductReview::where('product_id', $find_product->id)->where('status',1)->count();
        $one_total_rating = ProductReview::where([['product_id', $find_product->id], ['rating', 1]])->where('status',1)->sum('rating');
        if ($one_rating_count != 0 || $one_total_rating != 0) {
            $one_avg_rating = $one_total_rating / $one_rating_count;
        } else {
            $one_avg_rating = '0';
        }
        $varient = null;
        if ($product->varient_ids) {
            $varients = json_decode($product->varient_ids);
            foreach ($varients as $var) {
                $varient[] = Product::find($var);
            }
        }
        #Country Check
        $countryPrice = session()->get('processedData');
        return view('frontend.shop.detail', compact('product', 'category_product', 'wishlist', 'ProductReview', 'avg_rating', 'five_avg_rating', 'four_avg_rating', 'three_avg_rating', 'two_avg_rating', 'one_avg_rating','varient','countryPrice'));
    }

    // public function FetchQuantity(Request $request)
    // {
    //     $get_quantity = ProductColor::where('id', $request->fetchId)->first();
    //     $data = $get_quantity->quantity;
    //     return response()->json($data);
    // }
}
