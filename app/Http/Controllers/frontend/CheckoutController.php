<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Address;
use App\Models\Cart;
use Session;
use URL;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;


class CheckoutController extends Controller
{
    public function cartIndex()
    {
        $user_id = Auth::user()->id;
        $cartData = Cart::join('products', 'carts.product_id', '=', 'products.id')->with('getCartInformation')->where('products.status', '1')->whereNull('products.deleted_at')->where('carts.user_id', $user_id)->orderBy('carts.id', 'asc')->select('carts.*')->get();
        #Country Check
        $countryPrice = session()->get('processedData');
        if (!empty($cartData->toArray())) {
            $cartData = $cartData;
        } else {
            $cartData = array();
        }

        $sum = [];
        if ($countryPrice == 'IN') {
            foreach ($cartData as $cartDatas) {
                $product_sub_total =  $cartDatas->getCartInformation->selling_price * $cartDatas->quantity;
                $sum[] = $product_sub_total;
            }
            $cart_product_total = array_sum($sum);
        } else {
            foreach ($cartData as $cartDatas) {
                $product_sub_total =  $cartDatas->getCartInformation->selling_price_dollar * $cartDatas->quantity;
                $sum[] = $product_sub_total;
            }
            $cart_product_total = array_sum($sum);
        }


        return view('frontend.checkout.cart',compact('cartData','cart_product_total','countryPrice'));
    }

    public function addToCart(Request $request)
    {
        if ($request->ajax()) {
            $request->validate(
                [
                    'product_id' => 'required',
                    'quantity' => 'required|numeric|integer|gt:0',
                ],
                [
                    'product_id.required' => trans('translation.required', ['name' => 'product id']),
                    'product_id.unique' => trans('translation.already_added', ['name' => 'product']),
                    ]
                );
            if (!Auth::check()) {
                Session::put('cart_data', ['product_id' => $request->product_id, 'quantity' => $request->quantity]);
                Session::save();
                abort(response()->json([
                    'success' => 'false',
                    'message' => 'Unauthenticated.', 'session' => Session::get('cart_data')
                ], 401));
            }
            $user = User::where('id',Auth::user()->id)->first();
            $cart_product_quantity = Cart::where([['product_id',$request->product_id],['user_id',auth()->user()->id]])->first();
            if ($cart_product_quantity) {
                $total_color_quantity = $cart_product_quantity->quantity + $request->quantity;
                if ($total_color_quantity > 5) {
                    return json_encode(['result' => 'quantity', 'message' => trans('Sorry, You have Max only 5 Quantity Buy.')]);
                }
            }
            $product_id = $request->product_id;
            $qty = $request->quantity;
            $product = Product::find($product_id);

            $user_id = Auth::user()->id;
            $data = ['product_id' => $product_id, 'quantity' => $qty];
            $CartData = Cart::where('product_id', $product_id)->where('user_id', $user_id);
                $CartData = $CartData->first();
            if ($CartData != null) {
                return json_encode(['result' => 'quantity', 'message' => trans('Sorry, This product added in cart.')]);
            } else {
                //create
                $user = auth()->user()->id;
                $CartData = new Cart();
                $CartData->product_id = $product_id;
                $CartData->quantity = $qty;
                $CartData->user_id = $user;
               $result = $CartData->save();
            }
            if ($result) {
                #Country Check
                $countryPrice = session()->get('processedData');
                if ($countryPrice == 'IN') {
                    $cart_total = Cart::join('products', 'carts.product_id', '=', 'products.id')->where('carts.user_id',auth()->user()->id)->where('products.status', '1')->whereNull('products.deleted_at')->select('carts.*')->count();
                    $cartItem = Cart::join('products', 'carts.product_id', '=', 'products.id')->with('getCartInformation')->where('products.status', '1')->whereNull('products.deleted_at')->where('carts.user_id', $user_id)->orderBy('carts.id', 'asc')->select('carts.*')->get();
                    $item_html = '';
                    foreach ($cartItem as $cartProduct) {
                    $item_html .= '<li>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 shopping-cart-img">
                                    <a href="#"><img alt="Color Image" src="'.URL::asset('public/images/product/'.$cartProduct->getCartInformation->thumbnail).'"></a>
                                </div>
                                <div class="col-lg-8 col-md-4 shopping-cart-title">
                                    <h4><a href="#">'.$cartProduct->getCartInformation->name.'</a></h4>
                                    <h3><span>'.$cartProduct->quantity.' × </span>₹'.$cartProduct->getCartInformation->selling_price.'</h3>
                                </div>
                            </div>
                        </li>';
                    }

                    $sum = [];
                    foreach ($cartItem as $cartDatas) {
                        $product_sub_total =  $cartDatas->getCartInformation->selling_price * $cartDatas->quantity;
                        $sum[] = $product_sub_total;
                    }
                    $cart_product_total = array_sum($sum);
                    $CartProductTotal = '';
                    $CartProductTotal = '<h4>Total <span>₹'.$cart_product_total.'.00</span></h4>';
                } else {
                    $cart_total = Cart::join('products', 'carts.product_id', '=', 'products.id')->where('carts.user_id',auth()->user()->id)->where('products.status', '1')->whereNull('products.deleted_at')->select('carts.*')->count();
                    $cartItem = Cart::join('products', 'carts.product_id', '=', 'products.id')->with('getCartInformation')->where('products.status', '1')->whereNull('products.deleted_at')->where('carts.user_id', $user_id)->orderBy('carts.id', 'asc')->select('carts.*')->get();
                    $item_html = '';
                    foreach ($cartItem as $cartProduct) {
                    $item_html .= '<li>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 shopping-cart-img">
                                    <a href="#"><img alt="Color Image" src="'.URL::asset('public/images/product/'.$cartProduct->getCartInformation->thumbnail).'"></a>
                                </div>
                                <div class="col-lg-8 col-md-4 shopping-cart-title">
                                    <h4><a href="#">'.$cartProduct->getCartInformation->name.'</a></h4>
                                    <h3><span>'.$cartProduct->quantity.' × </span>₹'.$cartProduct->getCartInformation->selling_price_dollar.'</h3>
                                </div>
                            </div>
                        </li>';
                    }

                    $sum = [];
                    foreach ($cartItem as $cartDatas) {
                        $product_sub_total =  $cartDatas->getCartInformation->selling_price_dollar * $cartDatas->quantity;
                        $sum[] = $product_sub_total;
                    }
                    $cart_product_total = array_sum($sum);
                    $CartProductTotal = '';
                    $CartProductTotal = '<h4>Total <span>$'.$cart_product_total.'.00</span></h4>';
                }

                return json_encode([
                    'result' => 'success',
                    'message' => trans('Product Added to Cart', ['name' => $product->name]), 'product_id' => $product_id,'cart_total'=>$cart_total,'item_html'=>$item_html,'cart_product_total'=>$CartProductTotal
                ]);
            } else {
                return json_encode(['result' => 'fail', 'message' => trans('translation.error')]);
            }
        } else {
            abort('401');
        }
    }

    public function removeToCart(Request $request,$id)
    {

        try {
            $id=decrypt($id);
              //  $order_id=decrypt($order_id);
      } catch (DecryptException $e) {
          throw new HttpResponseException(

              response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
          );
      }

        if (Auth::check()) {
            $user_id = Auth::user()->id;
                $data = Cart::find($id);
                if ($data) {
                    $result = $data->delete();
                    if ($result) {
                        return back()->with('error', 'Product Removed Cart');
                    } else {
                        return back(['result' => 'fail', 'message' => trans('translation.error')]);
                    }
                } else {
                    return back()->with('error', 'Item Not Found');
                }
        }

    }

    public function clearCart()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $data = Cart::where('user_id', $user_id);
            $result = $data->delete();
            if ($result) {
                return redirect()->route('user.cart')
                    ->with('success', trans('Cart Cleared'));
            }
        } else {
            abort(response()->json([
                'success' => 'false',
                'message' => 'Unauthenticated.',
            ], 401));
        }
        $cartData = Cart::where('user_id', $user_id)->get();
        if($cartData == '[]' || $cartData == NULL){
            return redirect()->route('user.cart');
        }
    }

    public function qtyIncrement(Request $request)
    {
        if (Auth::check()) {
            if ($request->checktype == 'Increment') {
                $check_product = Cart::where([['id',$request->id],['user_id',Auth::user()->id]])->first();
                $id = $check_product->id;
                $cart = Cart::find($id);
                // $product_color = ProductColor::find($cart->color_id);
                // if ($request->quantity > $product_color->quantity) {
                //     return json_encode(['result' => 'quantity', 'message' => trans('Sorry, the requested quantity is not available in stock.')]);
                // }
                $result = $cart->update([
                        'quantity' => $check_product->quantity + 1,
                ]);
                if ($result) {
                    #Country Check
                    $countryPrice = session()->get('processedData');
                    if ($countryPrice == 'IN') {
                        $cartData = Cart::with('getCartInformation')->where('user_id', Auth::user()->id)->orderBy('id', 'asc')->get();
                        foreach ($cartData as $cartDatas) {
                            $product_sub_total =  $cartDatas->getCartInformation->selling_price * $cartDatas->quantity;
                            $sum[] = $product_sub_total;
                            $all_product_discount_total[] =  $cartDatas->getCartInformation->discount_price * $cartDatas->quantity;
                        }
                    } else {
                        $cartData = Cart::with('getCartInformation')->where('user_id', Auth::user()->id)->orderBy('id', 'asc')->get();
                        foreach ($cartData as $cartDatas) {
                            $product_sub_total =  $cartDatas->getCartInformation->selling_price_dollar * $cartDatas->quantity;
                            $sum[] = $product_sub_total;
                            $all_product_discount_total[] =  $cartDatas->getCartInformation->discount_price_dollar * $cartDatas->quantity;
                        }
                    }

                    $cart_product_total['total_value'] = array_sum($sum);
                    $cart_product_total['total_discount'] = array_sum($all_product_discount_total);
                    return response()->json($cart_product_total);
                }
            } else {
                $check_product = Cart::where([['id',$request->id],['user_id',Auth::user()->id]])->first();
                $id = $check_product->id;
                $cart = Cart::find($id);
                if ($cart->quantity > 1) {
                    $result = $cart->update([
                            'quantity' => $check_product->quantity - 1,
                    ]);
                    if ($result) {
                        #Country Check
                        $countryPrice = session()->get('processedData');
                        if ($countryPrice == 'IN') {
                            $cartData = Cart::with('getCartInformation')->where('user_id', Auth::user()->id)->orderBy('id', 'asc')->get();
                            foreach ($cartData as $cartDatas) {
                                $product_sub_total =  $cartDatas->getCartInformation->selling_price * $cartDatas->quantity;
                                $sum[] = $product_sub_total;
                                $all_product_discount_total[] =  $cartDatas->getCartInformation->discount_price * $cartDatas->quantity;
                            }
                        } else {
                            $cartData = Cart::with('getCartInformation')->where('user_id', Auth::user()->id)->orderBy('id', 'asc')->get();
                            foreach ($cartData as $cartDatas) {
                                $product_sub_total =  $cartDatas->getCartInformation->selling_price_dollar * $cartDatas->quantity;
                                $sum[] = $product_sub_total;
                                $all_product_discount_total[] =  $cartDatas->getCartInformation->discount_price_dollar * $cartDatas->quantity;
                            }
                        }

                        $cart_product_total['total_value'] = array_sum($sum);
                        $cart_product_total['total_discount'] = array_sum($all_product_discount_total);
                        return response()->json($cart_product_total);
                    }
                }
            }
        } else {
            abort(response()->json([
                'success' => 'false',
                'message' => 'Unauthenticated.',
            ], 401));
        }
    }

    public function checkout(Request $request)
    {
        $user_id = Auth::user()->id;
        $cartData = Cart::join('products', 'carts.product_id', '=', 'products.id')->with('getCartInformation')->where('products.status', '1')->whereNull('products.deleted_at')->where('carts.user_id', $user_id)->orderBy('carts.id', 'asc')->select('carts.*')->get();
        // foreach ($cartData as $product) {
        //     $OutOfStock = $product->color->quantity;
        //     if ($OutOfStock == 0) {
        //         $remove_cart = Cart::where('id',$product->id)->delete();
        //         return redirect()->route('user.cart')->with('error','Some out of stock products have been removed from the cart');
        //     }
        // }
        if (count($cartData) > 0) {
            if (!empty($cartData->toArray())) {
                $cartData = $cartData;
            } else {
                $cartData = array();
            }

            $sum = [];
            foreach ($cartData as $cartDatas) {
                $product_sub_total =  $cartDatas->getCartInformation->selling_price * $cartDatas->quantity;
                $sum[] = $product_sub_total;
            }
            $cart_product_total = array_sum($sum);
            $billing_address = Address::where('user_id', $user_id)->where('atype', 'billing')->first();
            $shipping_address = Address::where('user_id', $user_id)->where('atype', 'shipping')->first();
            $default_address_id=Auth::user()->default_address_id;
            $default_address = Address::find($default_address_id);
            return view('frontend.checkout.checkout',compact('cartData','cart_product_total','billing_address','shipping_address','default_address'));
        } else {
            return back()->with('error', 'Your Cart is Empty');
        }
    }
}
