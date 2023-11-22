<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Gallary;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SubCategory;
use Image;
use App\Traits\ImageCompressionTrait;

class ProductController extends Controller
{
    use ImageCompressionTrait;

    public function index(Request $request)
    {
        $data = Product::join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
            ->where([
                ['product_categories.status', '=', 1],
                ['sub_categories.status', '=', 1]
            ])
            ->select('products.*')
            ->orderBy('id', 'DESC')
            ->get();
        $category = ProductCategory::where('status', 1)->get();
        $subcategory = SubCategory::where('status', 1)->get();


        $result = Product::query();
        if ($request->category != '') {
            $result = $result->where('category_id', $request->input('category'));
        }
        if ($request->status != '') {
            $result = $result->where('status', $request->input('status'));
        }
        if ($request->product_id != '') {
            $result = $result->where('unique_id', $request->input('product_id'));
        }
        $data = $result->get();


        return view('backend.product.product', compact('data', 'category'));
    }
    public function addProductForm()
    {
        $cat = ProductCategory::where('status', 1)->get();
        $subcat = SubCategory::where('status', 1)->get();
        return view('backend.product.product_add', compact('cat', 'subcat'));
    }

    public function storeProduct(Request $request)
    {
        $data = new Product();
        a:
        $rand_no = rand(9999, 9999999);
        $created_name = 'SDK' . $rand_no;
        $check_name_available = DB::table('products')->where([
            ['unique_id', '=', $created_name]
        ])->get('id');
        if (!empty($check_name_available)) {
            $data->unique_id = $created_name;
        } else {
            goto a;
        }
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->sku = $request->sku;
        $data->hsn_code = $request->hsn_code;
        $data->color = $request->color;
        $data->category_id = $request->category;
        $data->status = $request->status;
        $data->description = $request->description;
        $data->original_price = $request->original_price;
        $data->discount = $request->discount;
        $data->selling_price = $request->final_amount;
        $data->discount_price = $request->discount_price;
        $data->tax_rate = $request->tax_rate;
        $data->tax_amount = $request->tax_amount;
        $data->subtotal = $request->selling_price;
        $data->original_price_dollar = $request->original_price_dollar;
        $data->discount_dollar = $request->discount_dollar;
        $data->selling_price_dollar = $request->final_amount_dollar;
        $data->discount_price_dollar = $request->discount_price_dollar;
        $data->tax_rate_dollar = $request->tax_rate_dollar;
        $data->tax_amount_dollar = $request->tax_amount_dollar;
        $data->subtotal_dollar = $request->selling_price_dollar;
        $data->subcategory_id = $request->subcategory;
        $data->is_varient = $request->is_varient;
        $data->set_to_all = $request->set_to_all;
        $data->varient_ids = ($request->varient_ids) ?  json_encode($request->varient_ids) : null;
        $data->save();
        #set to all
        if ($request->set_to_all and $request->varient_ids) {
            for ($i = 0; $i < count($request->varient_ids); $i++) {
                $allIds = $request->varient_ids;
                array_push($allIds, $data->id);
                $productId = $allIds[$i];
                $productData = Product::find($productId);
                $updatedIds = array_filter($allIds, function ($id) use ($productId) {
                    return $id != $productId;
                });
                $productData->varient_ids = count($updatedIds) > 0 ? json_encode(array_values($updatedIds)) : null;
                $productData->set_to_all = '1';
                $productData->is_varient = '1';

                $productData->save();
            }
        }
        if ($request->hasFile('thumbnail')) {
            $uploadFile = $request->file('thumbnail');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move(public_path('images/product'), $file_name);
            // Compress the uploaded image
            $compressedPath = $this->compressImage($path);
            // Update the data with the compressed image filename
            $data['thumbnail'] = basename($compressedPath);
            $data->save();
        }
        if ($request->hasFile('color_image')) {
            $uploadFile = $request->file('color_image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move(public_path('images/product_color'), $file_name);
            // Compress the uploaded image
            $compressedPath = $this->compressImage($path);
            // Update the data with the compressed image filename
            $data['color_image'] = basename($compressedPath);
            $data->save();
        }
        if ($request->has('gallary') && $data) {
            foreach ($request->gallary as $img) {
                $attachment = new Gallary();
                $uploadFile = $img;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/product'), $file_name);

                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);

                $attachment['path'] = basename($compressedPath);
                $attachment->product_id = $data->id;
                $attachment->save();
            }
        }
        return redirect()->route('product')->with('success', 'Product created successfully');
    }


    public function editProduct(Request $request, $id)
    {
        $datas = Product::find($id);
        $cat = ProductCategory::all();
        $quantity = ProductColor::where('product_id', $id)->get();
        $subcat = SubCategory::where('category_id', $datas->category_id)->where('status', 1)->get();
        $product = Product::where([['category_id', '=', $datas->category_id], ['subcategory_id', '=', $datas->subcategory_id], ['id', '<>', $id]])->get();
        $varients = [];
        if ($datas->varient_ids) {
            $varients = json_decode($datas->varient_ids);
        }
        return view('backend.product.product_edit', compact('cat', 'datas', 'quantity', 'subcat','product','varients'));
    }

    public function updateProduct(Request $request, $id)
    {
        $data = Product::find($id);
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->sku = $request->sku;
        $data->hsn_code = $request->hsn_code;
        $data->color = $request->color;
        $data->category_id = $request->category;
        $data->status = $request->status;
        $data->description = $request->description;
        $data->original_price = $request->original_price;
        $data->discount = $request->discount;
        $data->selling_price = $request->final_amount;
        $data->discount_price = $request->discount_price;
        $data->tax_rate = $request->tax_rate;
        $data->tax_amount = $request->tax_amount;
        $data->subtotal = $request->selling_price;
        $data->original_price_dollar = $request->original_price_dollar;
        $data->discount_dollar = $request->discount_dollar;
        $data->selling_price_dollar = $request->final_amount_dollar;
        $data->discount_price_dollar = $request->discount_price_dollar;
        $data->tax_rate_dollar = $request->tax_rate_dollar;
        $data->tax_amount_dollar = $request->tax_amount_dollar;
        $data->subtotal_dollar = $request->selling_price_dollar;
        $data->subcategory_id = $request->subcategory;
        $data->is_varient = $request->is_varient;
        $data->varient_ids = ($request->varient_ids) ?  json_encode($request->varient_ids) : null;
        $data->set_to_all = $request->set_to_all;
        if ($request->hasFile('thumbnail')) {
            $uploadFile = $request->file('thumbnail');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move(public_path('images/product'), $file_name);
            // Compress the uploaded image
            $compressedPath = $this->compressImage($path);
            // Remove the old image
            if ($data->thumbnail) {
                $oldImagePath = public_path('images/product') . '/' . $data->thumbnail;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $data['thumbnail'] = basename($compressedPath);
        }
        if ($request->hasFile('color_image')) {
            $uploadFile = $request->file('color_image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move(public_path('images/product_color'), $file_name);
            // Compress the uploaded image
            $compressedPath = $this->compressImage($path);
            // Remove the old image
            if ($data->color_image) {
                $oldImagePath = public_path('images/product_color') . '/' . $data->color_image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $data['thumbnail'] = basename($compressedPath);
        }
        $data->save();
        if ($request->set_to_all and $request->varient_ids) {
            for ($i = 0; $i < count($request->varient_ids); $i++) {
                $allIds = $request->varient_ids;
                array_push($allIds, $id);
                $productId = $allIds[$i];
                $productData = Product::find($productId);
                // Remove the product's own ID from the array
                $updatedIds = array_filter($allIds, function ($id) use ($productId) {
                    return $id != $productId;
                });
                // Update the product's varient_ids with the updated array
                $productData->varient_ids = count($updatedIds) > 0 ? json_encode(array_values($updatedIds)) : null;
                $productData->set_to_all = '1';
                $productData->is_varient = '1';
                $productData->save();
            }
        }
        if ($request->has('gallary') && $data) {
            foreach ($request->gallary as $img) {
                $attachment = new Gallary();
                $uploadFile = $img;
                $file_name = $uploadFile->hashName();
                $path = $uploadFile->move(public_path('images/product'), $file_name);
                // Compress the uploaded image
                $compressedPath = $this->compressImage($path);
                $attachment['path'] = basename($compressedPath);
                $attachment->product_id = $data->id;
                $attachment->save();
            }
        }

        return redirect()->route('product')->with('success', 'Product Updated successfully');
    }

    public function imgDelete($id)
    {

        $delete_img = Gallary::find($id);
        unlink('public/images/product/' . $delete_img->path);
        $delete_img->delete();
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
    public function productStatus(Request $request)
    {

        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();
        return response()->json([
            'success' => 'Product status has been updated successfully!'
        ]);
    }

    public function productVarient(Request $request)
    {
        $data['subcat'] = Product::where([["category_id", '=', $request->catId], ["subcategory_id", '=', $request->subCatId]])->get();
        return response()->json($data);
    }

    public function deleteProduct($id)
    {

        $data = Product::find($id);
        $data->delete();

        $attachment = Gallary::where([['product_id', '=', $id]])->get();
        foreach ($attachment as $d) {
            $del = Gallary::find($d->id);
            $del->delete();
        }
        $color = ProductColor::where('product_id', '=', $id)->get();
        foreach ($color as $colors) {
            $color_delete = ProductColor::find($colors->id);
            $color_delete->delete();
        }
        return redirect()->route('product')->with('success', 'Product deleted successfully');
    }

    public function removeQuantity(Request $request, $id)
    {
        $quantity = ProductColor::find($id);
        $del = $quantity->delete();
        if ($del) {
            return redirect()->back()->with('error', 'Color Deleted Successfully');
        } else {
            return false;
        }
    }

    public function CheckProduct()
    {
        // $data = DB::table('product_colors')
        // ->whereRaw('CAST(quantity AS SIGNED) < CAST(max_quantity AS SIGNED)')
        // ->first();

        $data = ProductColor::where('read_at', 0)->first();
        if (!$data == null) {
            $data_id = $data->getProductInformation->unique_id;
            $data_quantity = $data->quantity;
            $data_color = $data->color;
            return response()->json(['data_id' => $data_id, 'quantity' => $data_quantity, 'color' => $data_color]);
        }
    }

    public function fetchSubCat(Request $request)
    {
        $data['subcat'] = SubCategory::where("category_id", $request->catId)->where('status', 1)
            ->get(["name", "id"]);

        return response()->json($data);
    }

    public function fetchProduct(Request $request)
    {
        $product = Product::where('slug', '=', $request->slug)->first();

        return response()->json($product);
    }

    public function fetchSku(Request $request)
    {
        $product = Product::where('sku', '=', $request->sku)->first();

        return response()->json($product);
    }
}
