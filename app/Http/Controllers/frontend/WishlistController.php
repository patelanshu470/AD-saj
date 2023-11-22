<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Session;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $Wishlist=Wishlist::with('getWishlistInformation')->where('user_id', $user_id)->orderBy('id', 'desc')->get();
        foreach ($Wishlist as $productss) {
            if ($productss->getWishlistInformation == null) {
                $remove_cart = Wishlist::where('id',$productss->id)->delete();
                return redirect()->back()->with('error','Some Disabled products have been removed from the Wishlist');
            }
        }
        if (!empty($Wishlist->toArray())) {
            $Wishlist=$Wishlist;
        } else {
            $Wishlist=array();
        }
        $product=$Wishlist;
        #Country Check
        $countryPrice = session()->get('processedData');
        return view('frontend.user.wishlists.index',compact('product','countryPrice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $request->validate(
                [
                    'product_id' => 'required',
                ],
                [
                    'product_id.required'=>trans('required', ['name' => 'product id']),
                    'product_id.unique'=>trans('already_added_wishlist', ['name' => 'product']),
                ]
            );
            $product_id = $request->product_id;
            $product=Product::find($product_id);
            if ($product==null) {
                return response()->json([
                        'result' => 'fail',
                        'message'=>trans('record_not_found')
                    ], 422);
            }
            if (!Auth::check()) {
                Session::put('wishlist_data', ['product_id'=>$request->product_id]);
                Session::save();
                abort(response()->json([
                'success' => 'false',
                'message' => 'Unauthenticated.','session'=>Session::get('wishlist_data')], 401));
            }
            $user_id = Auth::user()->id;
            $data=['product_id'=>$product_id,'user_id'=>$user_id];
            $Wishlist=Wishlist::where('product_id', $product_id)->where('user_id', $user_id)->first();
            if ($Wishlist!=null) {
                $result = $Wishlist->save();
                $wishlist_item_id=$Wishlist->id;
                return json_encode(['result' => 'fail',
                'message' =>trans('already_added_wishlist', ['name' => $product->name]),'product_id'=>$product_id,'wishlist_item_id'=>$wishlist_item_id]);
            } else {
                //create
                $result = Wishlist::create($data);
                if ($result) {
                    $wishlist_item_id=$result->id;
                    $wishlist_total = Wishlist::where('user_id',$user_id)->count();
                    return json_encode(['result' => 'success',
                    'message' =>trans('Product Added to wishlist', ['name' => $product->name]),'product_id'=>$product_id,'wishlist_item_id'=>$wishlist_item_id,'wishlist_total'=>$wishlist_total]);
                } else {
                    return json_encode(['result' => 'fail', 'message' => trans('error')]);
                }
            }
        } else {
            abort('401');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $data = Wishlist::find($id);
            if($data!=null)
            {
                $product_id=$data->product_id;
                $delete = $data->delete();
                if ($delete) {
                    $wishlist_total = Wishlist::where('user_id',$user_id)->count();
                    $product=Product::find($product_id);
                    if ($request->ajax()) {
                        return json_encode(['result' => 'success',
                            'message' =>trans('Product Removed to wishlist', ['name' => $product->name]),'wishlist_total'=>$wishlist_total]);
                    }
                    else
                    {
                        return redirect()->route('wishlists.index')
                            ->with('success', trans('Product Removed to wishlist', ['name' => $product->name]));
                    }

                } else {
                    if ($request->ajax()) {
                        return json_encode(['result' => 'error',
                        'message' =>trans('error')]);
                    }
                    else
                    {
                        return redirect()->route('wishlists.index')
                            ->with('error', trans('error'));
                    }
                }
            }
            else{
                if ($request->ajax()) {
                    return json_encode(['result' => 'error',
                    'message' =>trans('record_not_found')]);
                }
                else
                {
                    return redirect()->route('wishlists.index')
                ->with('error', trans('record_not_found'));
                }
            }
        } else {
            abort(response()->json([
                'success' => 'false',
                'message' => 'Unauthenticated.',], 401));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd('e');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if (Auth::check()) {
            $customer_id = Auth::user()->id;
            $data = Wishlist::find($id);
            if($data!=null)
            {
                $product_id=$data->product_id;
                $delete = $data->delete();
                if ($delete) {
                    $product=Product::find($product_id);
                    if ($request->ajax()) {
                        return json_encode(['result' => 'error',
                            'message' =>trans('Product Removed to Wishlist', ['name' => $product->name])]);
                    }
                    else
                    {
                        return redirect()->route('wishlists.index')
                            ->with('error', trans('Product Removed to Wishlist', ['name' => $product->name]));
                    }

                } else {
                    if ($request->ajax()) {
                        return json_encode(['result' => 'error',
                        'message' =>trans('error')]);
                    }
                    else
                    {
                        return redirect()->route('wishlists.index')
                            ->with('error', trans('error'));
                    }
                }
            }
            else{
                if ($request->ajax()) {
                    return json_encode(['result' => 'error',
                    'message' =>trans('record_not_found')]);
                }
                else
                {
                    return redirect()->route('wishlists.index')
                ->with('error', trans('record_not_found'));
                }
            }
        } else {
            abort(response()->json([
                'success' => 'false',
                'message' => 'Unauthenticated.',], 401));
        }
    }
}
