<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Address;
use Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderProduct;
use Mail;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use DB;

class OrderController extends Controller
{

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
        if ($cartData == '[]' || $cartData == NULL) {
            return redirect()->route('user.cart');
        }
    }

    public function addOrder(Request $request)
    {
        #Country Check
        $countryPrice = session()->get('processedData');
        $user_id = Auth::user()->id;
        $cartData = Cart::join('products', 'carts.product_id', '=', 'products.id')->with('getCartInformation')->where('products.status', '1')->whereNull('products.deleted_at')->where('carts.user_id', $user_id)->orderBy('carts.id', 'asc')->select('carts.*')->get();
        if (!empty($cartData->toArray())) {
            $cartData = $cartData;
        } else {
            $cartData = array();
        }
        if ($countryPrice == 'IN') {
            $sum = [];
            $total_product_discount = [];
            $product_sub_total = [];
            foreach ($cartData as $cartDatas) {
                $product_grand_total =  $cartDatas->getCartInformation->selling_price * $cartDatas->quantity;
                $sum[] = $product_grand_total;
                $total_product_discount[] = $cartDatas->getCartInformation->discount_price * $cartDatas->quantity;
                $product_sub_total[] =  $cartDatas->getCartInformation->original_price * $cartDatas->quantity;
            }
        } else {
            $sum = [];
            $total_product_discount = [];
            $product_sub_total = [];
            foreach ($cartData as $cartDatas) {
                $product_grand_total =  $cartDatas->getCartInformation->selling_price_dollar * $cartDatas->quantity;
                $sum[] = $product_grand_total;
                $total_product_discount[] = $cartDatas->getCartInformation->discount_price_dollar * $cartDatas->quantity;
                $product_sub_total[] =  $cartDatas->getCartInformation->original_price_dollar * $cartDatas->quantity;
            }
        }
        $cart_product_total = array_sum($sum);
        $total_discount = array_sum($total_product_discount);
        $sub_total = array_sum($product_sub_total);

        if (auth()->user()->first_name == null) {
            $user = User::findOrfail($user_id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone_number = $request->billing_contact_number;
            $user->email = $request->billing_contact_email;
            $user->save();
        }

        if (isset($request->ship_to_different_address) && $request->ship_to_different_address != '' && $request->ship_to_different_address == 'yes') {
            if (auth()->user()->first_name == null) {
                $shipping_contact_name = $request->first_name .''. $request->last_name;
            } else {
                $shipping_contact_name = $request->shipping_contact_name;
            }
            $shipping_contact_email = $request->shipping_contact_email;
            $shipping_contact_number = $request->shipping_contact_number;
        } else {
            if (auth()->user()->first_name == null) {
                $shipping_contact_name = $request->first_name .''. $request->last_name;
            } else {
                $shipping_contact_name = $request->billing_contact_name;
            }
            $shipping_contact_email = $request->billing_contact_email;
            $shipping_contact_number = $request->billing_contact_number;
        }

        if (auth()->user()->first_name == null) {
            $billing_contact_name = $request->first_name .''. $request->last_name;
        } else {
            $billing_contact_name = $request->billing_contact_name;
        }

        if ($countryPrice == 'IN') {
            $order_data = [
                'user_id' => $user_id,
                'subtotal' => $sub_total,
                'total_discount' => $total_discount,
                'grand_total' => $cart_product_total,
                'payment_method' => "online",
                'billing_contact_name' => $billing_contact_name,
                'billing_contact_email' => $request->billing_contact_email,
                'billing_contact_number' => $request->billing_contact_number,
                'shipping_contact_name' => $shipping_contact_name,
                'shipping_contact_email' => $shipping_contact_email,
                'shipping_contact_number' => $shipping_contact_number,
                'order_note' => $request->order_note,
                'payment_status' => "pending",
                'country_type' => "INR",
            ];
        } else {
            $order_data = [
                'user_id' => $user_id,
                'subtotal' => $sub_total,
                'total_discount' => $total_discount,
                'grand_total' => $cart_product_total,
                'payment_method' => "online",
                'billing_contact_name' => $billing_contact_name,
                'billing_contact_email' => $request->billing_contact_email,
                'billing_contact_number' => $request->billing_contact_number,
                'shipping_contact_name' => $shipping_contact_name,
                'shipping_contact_email' => $shipping_contact_email,
                'shipping_contact_number' => $shipping_contact_number,
                'order_note' => $request->order_note,
                'payment_status' => "pending",
                'country_type' => "Dollar",
            ];
        }
        a:
        $rand_no = rand(10000, 99999);
        $created_name = 'SDKO' . $rand_no;
        $check_name_available = DB::table('orders')->where([
            ['unique_id', '=', $created_name]
        ])->get('id');
        if (!empty($check_name_available)) {
            $order_data['unique_id'] = $created_name;
        } else {
            goto a;
        }

        $order = Order::create($order_data);
        if ($order) {
            $order_id = $order->id;
            //cart add
            if (!empty($cartData) && count($cartData) > 0) {
                $order_items = [];
                foreach ($cartData as $product) {
                    if ($countryPrice == 'IN') {
                        $total_price =  $product->getCartInformation->selling_price * $product->quantity;
                        $total_discount_price = $product->getCartInformation->discount_price * $product->quantity;
                    } else {
                        $total_price =  $product->getCartInformation->selling_price_dollar * $product->quantity;
                        $total_discount_price = $product->getCartInformation->discount_price_dollar * $product->quantity;
                    }

                    if ($countryPrice == 'IN') {
                        $order_items[] = [
                            'order_id' => $order_id,
                            'product_id' => $product->product_id,
                            'quantity' => $product->quantity,
                            'price' => $product->getCartInformation->selling_price,
                            'original_price' => $product->getCartInformation->original_price,
                            'discount' => $total_discount_price,
                            'total_price' => $total_price,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                    } else {
                        $order_items[] = [
                            'order_id' => $order_id,
                            'product_id' => $product->product_id,
                            'quantity' => $product->quantity,
                            'price' => $product->getCartInformation->selling_price_dollar,
                            'original_price' => $product->getCartInformation->original_price_dollar,
                            'discount' => $total_discount_price,
                            'total_price' => $total_price,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                    }

                }
            }
            if (!empty($order_items)) {
                $order_products = OrderProduct::insert($order_items);
            } else {
                $order_products = true;
            }
            $address_billing = new Address();
            $address_billing->atype = 'billing';
            $address_billing->user_id = Auth::user()->id;
            $address_billing->order_id = $order_id;
            $address_billing->street = $request->billing_street_address;
            $address_billing->landmark = $request->billing_landmark;
            $address_billing->city = $request->billing_city;
            $address_billing->state = $request->billing_state;
            $address_billing->country = $request->billing_country;
            $address_billing->pincode = $request->billing_pincode;
            $address_billing->save();

            $address_shipping = new Address();
            $address_shipping->atype = 'shipping';
            if (isset($request->ship_to_different_address) && $request->ship_to_different_address != '' && $request->ship_to_different_address == 'yes') {
                $address_shipping->street = $request->shipping_street_address;
                $address_shipping->landmark = $request->shipping_landmark;
                $address_shipping->city = $request->shipping_city;
                $address_shipping->user_id = Auth::user()->id;
                $address_shipping->order_id = $order_id;
                $address_shipping->state = $request->shipping_state;
                $address_shipping->country = $request->shipping_country;
                $address_shipping->pincode = $request->shipping_pincode;
            } else {
                $address_shipping->street = $request->billing_street_address;
                $address_shipping->landmark = $request->billing_landmark;
                $address_shipping->user_id = Auth::user()->id;
                $address_shipping->order_id = $order_id;
                $address_shipping->city = $request->billing_city;
                $address_shipping->state = $request->billing_state;;
                $address_shipping->country = $request->billing_country;
                $address_shipping->pincode = $request->billing_pincode;
            }
            $address_shipping->save();

            if ($order_products && $order) {
                #now redirecting to payment page
                return redirect()->route('razorpay.payment.page',encrypt($order_id));
            } else {
                return redirect()->back()->with('error', 'Error');
            }
        }
    }

    public function orderConfirmIndex(Request $request, $order_id)
    {
        try {
            $order_id= decrypt($order_id);
        } catch (DecryptException $e) {
            throw new HttpResponseException(
                response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
            );
        }

        #Country Check
        $countryPrice = session()->get('processedData');
        $user_id = Auth::user()->id;
        $order = Order::findOrfail($order_id);
        if ($order->user_id != $user_id) {
            return redirect()->route('user.dashboard')->with('error', 'Not Fount');
        }
        $this->OrderMail($request);
        $OrderProduct = OrderProduct::with('getproductsData')->where('order_id', $order_id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('order_id', $order_id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('order_id', $order_id)->where('atype', 'shipping')->first();
        return view('frontend.checkout.order-confirm', compact('order', 'billing_address', 'shipping_address', 'OrderProduct','countryPrice'));
    }

    public function OrderMail()
    {
        $order = Order::where([['user_id',auth()->user()->id],['payment_status','<>','pending']])->latest()->first();
        $data = array('tomail'=>$order->billing_contact_email,'tonamemail'=>$order->billing_contact_name);
        if($order){
            Mail::send('frontend.checkout.ordermail', $data, function($message)use ($data) {
                $message->to($data['tomail'], 'rk')->subject
                   ('Your Sajh Dhaj Ke Order Confirmation');
                $message->from('support@sajhdhajke.com','Sajh Dhaj ke');
             });
        }
        return view('frontend.checkout.ordermail');
    }
}
