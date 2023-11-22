<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\CustomerHighlights;
use Image;
use App\Traits\ImageCompressionTrait;

class CategoryController extends Controller
{
    use ImageCompressionTrait;

    public function index()
    {
        $data = ProductCategory::all();
        return view('backend.category.category', compact('data'));
    }

    public function addCategory(Request $request)
    {
        // dd($request->thumbnail->hashName());
        // $x = 1;
        // if ($request->thumbnail) {
        //     $uploadFile = $request->file('thumbnail');
        //     $file_name = $uploadFile->hashName();
        //     $img = \Image::make($uploadFile);
        //     $img->save(\public_path($file_name),$x);
        //     return back();
        // }
        $check = ProductCategory::where('name', 'like', $request->name)->get()->first();
        if ($check) {
            return redirect()->route('category')->with('error', 'Category already exists');
        } else {
            $data = new ProductCategory();
            $data->name = $request->name;
            $data->slug = $request->slug;
            $data->status = $request->status;
            $data->save();

            if ($request->thumbnail) {
                $uploadFile = $request->file('thumbnail');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/category/thumbnail'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                // Update the data with the compressed image filename
                $data['thumbnail'] = basename($compressedPath);
                $data->save();
            }

            if ($request->background_image) {
                $uploadFile = $request->file('background_image');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/category/background_image'), $file_name);
                // Compress the uploaded background image
                $compressedPath = $this->compressImage($path);
                // Update the data with the compressed background image filename
                $data['background_image'] = basename($compressedPath);
                $data->save();
            }
            return redirect()->route('category')->with('success', 'Category created successfully');
        }
    }
    public function updateCategory(Request $request, $id)
    {
        $check = ProductCategory::where([['name', 'like', $request->name], ['id', '<>', $id]])->get()->first();
        if ($check) {
            return redirect()->route('category')->with('error', 'Category already exists');
        } else {
            $data = ProductCategory::find($id);
            $data->name = $request->name;
            $data->slug = $request->slug;
            $data->status = $request->status;
            $data->save();

            if ($request->thumbnail) {
                $uploadFile = $request->file('thumbnail');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/category/thumbnail'), $file_name);
                // Remove the old thumbnail image
                if ($data->thumbnail) {
                    $oldImagePath = public_path('images/category/thumbnail') . '/' . $data->thumbnail;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $data['thumbnail'] = $file_name;
                $data->save();
            }

            if ($request->background_image) {
                $uploadFile = $request->file('background_image');
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/category/background_image'), $file_name);
                // Remove the old thumbnail image
                if ($data->background_image) {
                    $oldImagePath = public_path('images/category/background_image') . '/' . $data->background_image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $data['background_image'] = $file_name;
                $data->save();
            }
            return redirect()->route('category')->with('success', 'Category updated successfully');
        }
    }

    public function deleteCategory($id)
    {
        $data = ProductCategory::find($id);
        $data->delete();
        SubCategory::where('category_id',$id)->delete();
        Product::where('category_id',$id)->delete();
        CustomerHighlights::where('category_id',$id)->delete();

        return redirect()->route('category')->with('success', 'Category deleted successfully');
    }

    public function categoryStatus(Request $request)
    {

        $product = ProductCategory::find($request->cat_id);
        $product->status = $request->status;
        $product->save();
        return response()->json([
            'success' => 'Category status has been updated successfully!'
        ]);
    }
}
