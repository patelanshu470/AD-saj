<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Address;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Razorpay\Api\Errors\SignatureVerificationError;
use Ixudra\Curl\Facades\Curl;


class RazorpayPaymentController extends Controller
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


    public function index($order_id)
    {
        //   $order_id =decrypt($order_id);
        try {
            $order_id = decrypt($order_id);
        } catch (DecryptException $e) {
            throw new HttpResponseException(

                response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
            );
        }
        //  $order_id=encrypt($order_id);
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
            foreach ($cartData as $cartDatas) {
                $product_sub_total =  $cartDatas->getCartInformation->selling_price * $cartDatas->quantity;
                $sum[] = $product_sub_total;
            }
            $cart_product_total = array_sum($sum);
        } else {
            $sum = [];
            foreach ($cartData as $cartDatas) {
                $product_sub_total =  $cartDatas->getCartInformation->selling_price_dollar * $cartDatas->quantity;
                $sum[] = $product_sub_total;
            }
            $cart_product_total = array_sum($sum);
        }



        #getting amount from controller
        $user_id = Auth::user()->id;
        $cartData = Cart::join('products', 'carts.product_id', '=', 'products.id')->with('getCartInformation')->where('products.status', '1')->whereNull('products.deleted_at')->where('carts.user_id', $user_id)->orderBy('carts.id', 'asc')->select('carts.*')->get();
        // $address = Address::where('order_id',$order_id)->where('atype','shipping')->where('user_id',$user_id)->first();
        if (!empty($cartData->toArray())) {
            $cartData = $cartData;
        } else {
            $cartData = array();
        }
        if ($countryPrice == 'IN') {
            $sum = [];
            foreach ($cartData as $cartDatas) {
                $product_sub_total =  $cartDatas->getCartInformation->selling_price * $cartDatas->quantity;
                $sum[] = $product_sub_total;
            }
            $cart_product_total = array_sum($sum);
            $payment_amount = $cart_product_total * 100;
        } else {
            $sum = [];
            foreach ($cartData as $cartDatas) {
                $product_sub_total =  $cartDatas->getCartInformation->selling_price_dollar * $cartDatas->quantity;
                $sum[] = $product_sub_total;
            }
            $cart_product_total = array_sum($sum);
            $payment_amount = $cart_product_total * 100;
        }

        if ($countryPrice == 'IN') {
            return view('frontend.checkout.payment', compact('cartData', 'cart_product_total', 'order_id', 'payment_amount','countryPrice'));
        } else {
            #Stripe Integration
            $address = Address::where('order_id',$order_id)->where('atype','billing')->first();
            $order = Order::findOrFail($order_id);
            $environment = app()->environment();
            if ($environment == 'local' || $environment == 'staging') {
                \Stripe\Stripe::setApiKey(env('TEST_STRIPE_SECRET'));
            } else {
                \Stripe\Stripe::setApiKey(env('PROD_STRIPE_SECRET'));
            }
            $payment_intent = \Stripe\PaymentIntent::create([
                'description' => 'Software development services',
                'shipping' => [
                'name' => $order->billing_contact_name,
                'address' => [
                    'line1' => $address->street .''. $address->landmark,
                    'postal_code' => $address->pincode,
                    'city' => $address->city,
                    'state' => $address->state,
                    'country' => $address->country,
                ],
                ],
                'amount' => $payment_amount,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);
            $intent = $payment_intent->client_secret;
            $payment_id = $payment_intent->id;
            $environment = app()->environment();
            if ($environment == 'local' || $environment == 'staging') {
                $stripe_key = env('TEST_STRIPE_KEY');
            } else {
                $stripe_key = env('PROD_STRIPE_KEY');
            }
            return view('frontend.checkout.payment', compact('cartData', 'cart_product_total', 'order_id', 'payment_amount','countryPrice','intent','stripe_key','payment_id'));
        }
    }


    public function store(Request $request, $order_id)
    {

        // dd($order);
        #Empty Cart Error Handling
        $user_id = Auth::user()->id;
        $cartData = Cart::with('getCartInformation')
        ->where('user_id', $user_id)
        ->orderBy('id', 'asc')
        ->get();

        if (empty($cartData) or count($cartData) == 0) {
            return redirect()->back()
                ->with('error', 'Something went wrong ,try to refresh the page');
        }
        $input = $request->all();
        // $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $environment = app()->environment();
        if ($environment == 'local' || $environment == 'staging') {
            \Stripe\Stripe::setApiKey(env('TEST_STRIPE_SECRET'));
        } else {
            \Stripe\Stripe::setApiKey(env('PROD_STRIPE_SECRET'));
        }

        try {
            $paymentIntent = \Stripe\PaymentIntent::retrieve($request->payment_id);
            // Handle the payment data as needed
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle any errors from Stripe
            return response()->json(['error' => $e->getMessage()], 500);
        }
        if ($paymentIntent['status'] == "succeeded") {

            $this->clearCart();

            $this->storePaymentStatus($input['payment_id'], $order_id);

            return redirect()->route('order-confirm', encrypt($order_id))
                ->with('success', 'Payment is Successfull');
        } else {
            return redirect()->back()
                ->with('error', 'Payment failed');
        }
    }

    public function storePaymentStatus($payment_id, $order_id)
    {
        $environment = app()->environment();
        if ($environment == 'local' || $environment == 'staging') {
            \Stripe\Stripe::setApiKey(env('TEST_STRIPE_SECRET'));
        } else {
            \Stripe\Stripe::setApiKey(env('PROD_STRIPE_SECRET'));
        }

        try {
            $payment = \Stripe\PaymentIntent::retrieve($payment_id);
            // Handle the payment data as needed
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle any errors from Stripe
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // $payment = $api->payment->fetch($payment_id);
        if ($payment_id or $payment['status']) {
            #store payment in database
            $paymentData = new Payment();
            $paymentData->payment_id = $payment_id;
            $paymentData->payment_method = 'Card';

            $order = Order::findOrFail($order_id);
            $order->payment_status = 'captured';
            $order->save();
            $paymentData->amount = $order->grand_total;

            $paymentData->order_id = $order_id;
            $paymentData->payment_status = 'captured';
            $paymentData->save();
        }
    }
}
