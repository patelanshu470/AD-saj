<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerHighlights;

class CustomerHighlightsController extends Controller
{
    public function Images()
    {
        $image_highlight = CustomerHighlights::join('product_categories', 'customer_highlights.category_id', '=', 'product_categories.id')
        ->join('sub_categories', 'customer_highlights.subcategory_id', '=', 'sub_categories.id')->where('customer_highlights.ch_type','image')->where([['product_categories.status','=',1],['sub_categories.status', '=', 1]])->paginate(8);
        if (request()->ajax()) {
    		$view = view('frontend.customer_highlights.ajaximage',compact('image_highlight'))->render();
            return response()->json(['html'=>$view,'page'=>$image_highlight->currentPage()]);
        }
        return view('frontend.customer_highlights.images',compact('image_highlight'));
    }

    public function Videos()
    {
        $video_highlight = CustomerHighlights::join('product_categories', 'customer_highlights.category_id', '=', 'product_categories.id')
        ->join('sub_categories', 'customer_highlights.subcategory_id', '=', 'sub_categories.id')->where('customer_highlights.ch_type','video')->where([['product_categories.status','=',1],['sub_categories.status', '=', 1]])->paginate(12);
        if (request()->ajax()) {
    		$view = view('frontend.customer_highlights.ajaxvideo',compact('video_highlight'))->render();
            return response()->json(['html'=>$view,'page'=>$video_highlight->currentPage()]);
        }
        return view('frontend.customer_highlights.videos',compact('video_highlight'));
    }
}
