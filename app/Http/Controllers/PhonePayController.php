<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Razorpay\Api\Errors\SignatureVerificationError;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\URL;
use DB;

class PhonePayController extends Controller
{
    public function phonePe($order_id)
    {
        // dd($order_id);
        // try {
        //     $order_id = decrypt($order_id);
        // } catch (DecryptException $e) {
        //     throw new HttpResponseException(

        //         response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
        //     );
        // }
        //  $order_id=encrypt($order_id);
        $client = new Client();

        #Country Check
        $countryPrice = session()->get('processedData');

        $user_id = Auth::user()->id;
        $cartData = Cart::join('products', 'carts.product_id', '=', 'products.id')->with('getCartInformation')->where('products.status', '1')->whereNull('products.deleted_at')->where('carts.user_id', $user_id)->orderBy('carts.id', 'asc')->select('carts.*')->get();
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



        #getting amount from controller
        $user_id = Auth::user()->id;
        $cartData = Cart::join('products', 'carts.product_id', '=', 'products.id')->with('getCartInformation')->where('products.status', '1')->whereNull('products.deleted_at')->where('carts.user_id', $user_id)->orderBy('carts.id', 'asc')->select('carts.*')->get();

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
        $payment_amount = $cart_product_total * 100;

        $timestamp = time();
        $randomNumber = mt_rand(100000, 999999); // Adjust the range as needed
        do {
            $merchantTransactionId = 'MT' . $timestamp . $randomNumber;
        } while (DB::table('payments')->where('payment_id', $merchantTransactionId)->exists());
        // return $merchantTransactionId;
        $merchantUserId = 'MUID' . $timestamp . $randomNumber;
        $environment = app()->environment();
        if ($environment == 'local' || $environment == 'staging') {
            #phonepay payment
            $data = array(
                'merchantId' => env('TEST_PHONEPAY_MERCHAND_ID'),
                'merchantTransactionId' => $merchantTransactionId,
                'merchantUserId' => $merchantUserId,
                'amount' => $payment_amount,
                'redirectUrl' => URL::to('phonepe-response'),
                'redirectMode' => 'POST',
                'callbackUrl' => URL::to('phonepe-response'),
                'mobileNumber' => '9999999999',
                'paymentInstrument' => array(
                    'type' => 'PAY_PAGE',
                ),
            );
        } else {
            #phonepay payment
            $data = array(
                'merchantId' => env('PROD_PHONEPAY_MERCHAND_ID'),
                'merchantTransactionId' => $merchantTransactionId,
                'merchantUserId' => $merchantUserId,
                'amount' => $payment_amount,
                'redirectUrl' => URL::to('phonepe-response'),
                'redirectMode' => 'POST',
                'callbackUrl' => URL::to('phonepe-response'),
                'mobileNumber' => '7568252974',
                'paymentInstrument' => array(
                    'type' => 'PAY_PAGE',
                ),
            );
        }

        $encode = base64_encode(json_encode($data));
        $environment = app()->environment();
        if ($environment == 'local' || $environment == 'staging') {
            $saltKey = env('TEST_PHONEPAY_SALT_KEY');
        } else {
            $saltKey = env('PROD_PHONEPAY_SALT_KEY');
        }
        $saltIndex = 1;
        $string = $encode . '/pg/v1/pay' . $saltKey;
        $sha256 = hash('sha256', $string);
        $finalXHeader = $sha256 . '###' . $saltIndex;
        $client = new Client();

        if ($environment == 'local' || $environment == 'staging') {
            $response = $client->post(env('TEST_PAY_LINK'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-VERIFY' => $finalXHeader,
                ],
                'json' => ['request' => $encode],
                'http_errors' => false,
                'cookies' => false,
                'verify' => false,
            ]);
        } else {
            $response = $client->post(env('PROD_PAY_LINK'), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-VERIFY' => $finalXHeader,
                ],
                'json' => ['request' => $encode],
                'http_errors' => false,
                'cookies' => false,
                'verify' => false,
            ]);
        }
        $rData = json_decode($response->getBody()->getContents());
        return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);

    }

    public function response(Request $request)
    {
        $input = $request->all();
        if($input == []){
            return redirect()->back();
        }
        $order = Order::where('user_id', auth()->user()->id)->latest()->first();
        $environment = app()->environment();
        if ($environment == 'local' || $environment == 'staging') {
            $saltKey = env('TEST_PHONEPAY_SALT_KEY');
        } else {
            $saltKey = env('PROD_PHONEPAY_SALT_KEY');
        }
        $saltIndex = 1;
        $finalXHeader = hash('sha256', '/pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId'] . $saltKey) . '###' . $saltIndex;
        $client = new Client();

        if ($environment == 'local' || $environment == 'staging') {
            $response = $client->get(env('TEST_STATUS_LINK') . $input['merchantId'] . '/' . $input['transactionId'], [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                    'X-VERIFY' => $finalXHeader,
                    'X-MERCHANT-ID' => $input['transactionId'],
                ],
            ]);
        } else {
            $response = $client->get(env('PROD_STATUS_LINK') . $input['merchantId'] . '/' . $input['transactionId'], [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                    'X-VERIFY' => $finalXHeader,
                    'X-MERCHANT-ID' => $input['transactionId'],
                ],
            ]);
        }

        $responseData = json_decode($response->getBody()->getContents());
        // dd($responseData);
        $transactionID = $responseData->data->merchantTransactionId;
        $paymentMethod = $responseData->data->paymentInstrument->type;
        if($responseData->code == 'PAYMENT_SUCCESS'){
            $this->clearCart();
            $this->storePaymentStatus($order->id,$transactionID,$paymentMethod);
            return redirect()->route('order-confirm', encrypt($order->id))
                ->with('success', 'Payment is Successful');
        }
        else{
            return redirect()->route('user.dashboard')
                ->with('error', 'Payment is Failed');
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
        if ($cartData == '[]' || $cartData == NULL) {
            return redirect()->route('user.cart');
        }
    }

    public function storePaymentStatus($order_id,$transactionID,$paymentMethod)
    {

        $paymentData = new Payment();
        $paymentData->payment_id = $transactionID;
        $paymentData->payment_method = $paymentMethod;


        $order = Order::findOrFail($order_id);
        $order->payment_status = 'captured';
        $order->save();
        $paymentData->amount = $order->grand_total;

        $paymentData->order_id = $order_id;
        $paymentData->payment_status = 'captured';
        $paymentData->save();
    }
}
