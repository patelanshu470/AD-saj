<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;

class ReviewController extends Controller
{
    public function index(Request $request){

        $productReview = ProductReview::join('products', 'product_reviews.product_id', '=', 'products.id')
        ->where('products.status', '1')
        ->whereNull('products.deleted_at')
        ->select('product_reviews.*')
        ->get();
        // dd($productReview);

        if ($request->input('rating') != '') {
            $productReview = ProductReview::where('rating',$request->input('rating'))->get();

        }
        return view('backend.reviews.reviews',compact('productReview'));
    }

    public function reviewStatus(Request $request)
    {
        $productreview = ProductReview::find($request->review_id);
        $productreview->status = $request->status;
        $productreview->save();

        if ($request->status == 1) {
            return response()->json(['success'=>'Review Activate.']);
        }
        if ($request->status == 0) {
            return response()->json(['error'=>'Review Deactivate.']);
        }
    }
}
