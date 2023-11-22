<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\CustomerHighlights;
use App\Traits\ImageCompressionTrait;



class SubCategoryController extends Controller
{
    use ImageCompressionTrait;

    public function index(Request $request)
    {
        $product_category = ProductCategory::where('status',1)->get();
        $result = SubCategory::query();
        if ($request->input('name') != '') {
            $result = $result->where('name','like','%'.$request->input('name').'%');
        }
        if ($request->input('category') != '') {
            $result = $result->where('category_id',$request->input('category'));
        }
        if ($request->input('status') != '') {
            $result = $result->where('status',$request->input('status'));
        }
        $data = $result->with('category')->whereHas('category', function($query){
            $query->where('status', 1);
        })->get();
        return view('backend.sub_category.index',compact('product_category','data'));
    }

    public function store(Request $request)
    {
        $check = SubCategory::where('name', 'like', $request->name)->where('category_id',$request->category_id)->get()->first();
        $check_slug = SubCategory::where('slug', 'like', $request->slug)->first();
        if ($check_slug) {
            return redirect()->route('subcategory')->with('error', 'This Slug already exists');
        }
        if ($check) {
            return redirect()->route('subcategory')->with('error', 'SubCategory already exists');
        } else {
            $data = new SubCategory();
            $data->name = $request->name;
            $data->slug = $request->slug;
            $data->category_id = $request->category_id;
            $data->status = $request->status;
            $data->save();

            if ($request->hasFile('thumbnail')) {
                $uploadFile = $request->file('thumbnail');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/subcategory/thumbnail'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                $data['thumbnail'] = basename($compressedPath);
                $data->save();
            }
            return redirect()->route('subcategory')->with('success', 'SubCategory created successfully');
        }
    }

    public function update(Request $request,$id)
    {
        $check = SubCategory::where([['name', 'like', $request->name], ['category_id',$request->category_id], ['id', '<>', $id]])->get()->first();
        $check_slug = SubCategory::where([['slug', 'like', $request->slug], ['id', '<>', $id]])->get()->first();
        if ($check_slug) {
            return redirect()->route('subcategory')->with('error', 'This Slug already exists');
        }
        if ($check) {
            return redirect()->route('subcategory')->with('error', 'SubCategory already exists');
        } else {
            $data = SubCategory::find($id);
            $data->name = $request->name;
            $data->slug = $request->slug;
            $data->status = $request->status;
            $data->category_id = $request->category_id;
            $data->save();

            if ($request->hasFile('thumbnail')) {
                $uploadFile = $request->file('thumbnail');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/subcategory/thumbnail'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                $data['thumbnail'] = basename($compressedPath);
                $data->save();
            }
            return redirect()->route('subcategory')->with('success', 'SubCategory updated successfully');
        }
    }

    public function delete($id)
    {
        $data = SubCategory::find($id);
        $data->delete();
        Product::where('subcategory_id',$id)->delete();
        CustomerHighlights::where('subcategory_id',$id)->delete();
        return redirect()->route('subcategory')->with('error', 'SubCategory Deleted successfully');
    }

    public function subcategoryStatus(Request $request)
    {

        $subcategory = SubCategory::find($request->cat_id);
        $subcategory->status = $request->status;
        $subcategory->save();
        return response()->json([
            'success' => 'SubCategory status has been updated successfully!'
        ]);
    }
}
