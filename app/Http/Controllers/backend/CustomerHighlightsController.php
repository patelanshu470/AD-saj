<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use App\Models\CustomerHighlights;
use Image;
use App\Traits\ImageCompressionTrait;


class CustomerHighlightsController extends Controller
{
    use ImageCompressionTrait;

    public function index()
    {
        $highlight_image = CustomerHighlights::where('ch_type','image')->get();
        $highlight_video = CustomerHighlights::where('ch_type','video')->get();
        return view('backend.customer_highlights.index',compact('highlight_image','highlight_video'));
    }

    public function create()
    {
         $product_category = ProductCategory::where('status',1)->get();
         $product_subcategory = SubCategory::where('status',1)->get();
        return view('backend.customer_highlights.create',compact('product_category','product_subcategory'));
    }

    public function store(Request $request)
    {
        if (isset($request->image)) {
            $highlights = new CustomerHighlights();
            $uploadFile = $request->file('image');
            $highlights_image = $uploadFile->hashName();
            $path = $uploadFile->move(public_path('images/highlights/images'), $highlights_image);
            // Compress the uploaded image
            $compressedPath = $this->compressImage($path);
            $highlights->path = basename($compressedPath);
            $highlights->category_id = $request->category;
            $highlights->subcategory_id = $request->subcategory;
            $highlights->ch_type = 'image';
            $highlights->save();
        }

        if (isset($request->video)) {
            $highlights = new CustomerHighlights();
            $uploadFile = $request->video;
            $highlights_video = $uploadFile->hashName();
            $path = $uploadFile-> move(public_path('images/highlights/videos'), $highlights_video);
            $highlights->path = $highlights_video;
            $highlights->category_id = $request->category;
            $highlights->subcategory_id = $request->subcategory;
            $highlights->ch_type = 'video';
            $highlights->save();
        }

        return redirect()->route('customerHighlights')->with('success', 'Highlight Created successfully');
    }

    public function edit($id)
    {
        $highlights = CustomerHighlights::findOrFail($id);
        $product_category = ProductCategory::where('status',1)->get();
        return view('backend.customer_highlights.edit',compact('product_category','highlights'));
    }

    public function update(Request $request,$id)
    {
        $highlights = CustomerHighlights::findOrFail($id);
        $highlights->category_id = $request->category;
        $highlights->save();
        if (isset($request->image)) {
            $uploadFile = $request->image;
            $highlights_image = $uploadFile->hashName();
            $path = $uploadFile-> move(public_path('images/highlights/images'), $highlights_image);
            $highlights->path = $highlights_image;
            $highlights->category_id = $request->category;
            $highlights->ch_type = 'image';
            $highlights->save();
        }

        if (isset($request->video)) {
            $uploadFile = $request->video;
            $highlights_video = $uploadFile->hashName();
            $path = $uploadFile-> move(public_path('images/highlights/videos'), $highlights_video);
            $highlights->path = $highlights_video;
            $highlights->category_id = $request->category;
            $highlights->ch_type = 'video';
            $highlights->save();
        }

        return redirect()->route('customerHighlights')->with('success', 'Highlight Update successfully');
    }

    public function destroy($id)
    {
        $highlights = CustomerHighlights::findOrFail($id);
        if ($highlights->ch_type == 'image') {
            unlink('images/highlights/images/'.$highlights->path);
        }
        if ($highlights->ch_type == 'video') {
            unlink('images/highlights/videos/'.$highlights->path);
        }
        $highlights->delete();

        return redirect()->route('customerHighlights')->with('success', 'CustomerHighlights deleted successfully');
    }
}
