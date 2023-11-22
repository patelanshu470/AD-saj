<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderProduct;
use App\Models\VerificationCode;
use App\Models\Address;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\OrderCancel;
use App\Models\OrderReturn;
use Carbon\Carbon;
use App\Http\Controllers\frontend\AuthOtpController;
use Auth;
use Hash;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ImageCompressionTrait;


class ProfileController extends Controller
{
    use ImageCompressionTrait;

    public function index(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $orderData = Order::with('getOrderInformation')->where('user_id', $user_id)->where([['payment_status','<>','pending']])->orderBy('id','DESC')->paginate(12);
            if (request()->ajax()) {
                $view = view('frontend.user.order_ajax',compact('orderData'))->render();
                return response()->json(['html'=>$view,'page'=>$orderData->currentPage()]);
            }
        }
        $addresses = Address::where('user_id', $user_id)->where('addresable_type', 'App\Models\User')->get();
        $default_address_id=Auth::user()->default_address_id;
        $billing_address = Address::where('user_id', $user_id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('user_id', $user_id)->where('atype', 'shipping')->first();
        #Country Check
        $countryPrice = session()->get('processedData');
        return view('frontend.user.index',compact('orderData','billing_address','shipping_address','default_address_id','addresses','countryPrice'));
    }

    public function changePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        // old password match...
        if(!Hash::check($request->old_password, $user->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }
        // Update the new Password....
        $user->update([
            'password' => Hash::make($request->new_password),
            'confirm_password' => Hash::make($request->confirm_password)
        ]);
        return back()->with('success', 'Password Change Successfully');
    }

    public function editAccount(Request $request)
    {
        // if (auth()->user()->email == $request->email) {
        $environment = app()->environment();
        if ($environment == 'production' || $environment == 'staging') {
            $ip = $request->ip();
            $currentUserInfo = Location::get($ip);
            session()->put('processedData', $currentUserInfo->countryCode);
        }
        #Country Check
        $countryPrice = session()->get('processedData');
        $user = User::find(auth()->user()->id);
        if ($countryPrice == "IN") {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]);
        } else {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
            ]);
        }

        return back()->with('success', 'Update Account Successfully');
        // } else {
        //     return redirect()->route('user.otp.generate', ['email' => $request->email]);

        // }
    }

    public function generate(Request $request)
    {
        $verificationCode = $this->generateOtp($request->email);
        $message_otp = "Your OTP To Login is - ".$verificationCode->otp;

            //  if($this->isOnline()){
            $mail_data = [
                'recipient' => $request->email,
                'fromEmail' => 'support@sajhdhajke.com',
                'fromName' => "Sajh Dhaj Ke",
                'companyName' => 'Sajh Dhaj ke',
                'subject' => " verification",
                'otp' => $verificationCode->otp,
                // 'body' => $verificationCode->otp,
            ];
            \Mail::send('otp-mail',$mail_data,function($message) use ($mail_data){
                $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'],$mail_data['companyName'])
                ->subject($mail_data['subject']);
            });

            session(['updateemail' => $request->email]);

            return redirect()->route('user.otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message_otp);
        // }else {
        //         return "not connected";
        // }
        // return redirect()->route('user.otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message_otp);
    }

    public function isOnline($site = "https://youtube.com/")
    {
        if (@fopen($site,"r")) {
            return true;
        }else {
            return false;
        }
    }

    public function generateOtp($email)
    {
        $user = User::where('email', auth()->user()->email)->first();
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();
        $now = Carbon::now();
        if($verificationCode && $now->isBefore($verificationCode->expire_at)){
            return $verificationCode;
        }

        return VerificationCode::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(1)
        ]);
    }

    public function resend(Request $request,$no)
    {
        if($request->email){
            $email=$request->email;
        }else{
            $email=$no;
        }
        $id_get = User::where('email',$email)->first();
        $all_data = VerificationCode::where('user_id',auth()->user()->id)->first();
        $now = Carbon::now();
        if($now->isAfter($all_data->expire_at)){
            VerificationCode::where('user_id',auth()->user()->id)->delete();
        }
        $verificationCode = $this->generateOtp($email);
        $message = "Your OTP To Login is - ".$verificationCode->otp;

        if($this->isOnline()){
            $mail_data = [
                'recipient' => $email,
                'fromEmail' => 'support@sajhdhajke.com',
                'fromName' => "Sajh Dhaj Ke",
                'companyName' => 'Sajh Dhaj ke',
                'subject' => " verification",
                'otp' => $verificationCode->otp,
                // 'body' => $verificationCode->otp,
            ];
            \Mail::send('otp-mail',$mail_data,function($message) use ($mail_data){
                $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'],$mail_data['companyName'])
                ->subject($mail_data['subject']);
            });
            return redirect()->route('user.otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message);
        } else {
            return "not connected";
        }
        return redirect()->route('user.otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message);

    }

    public function verification($user_id)
    {
        // $request->session()->invalidate();
        $value = session('updateemail');
        return view('frontend.auth.otp-verification',compact('value'))->with([
            'user_id' => $user_id
        ]);
    }

    public function emailUpdateWithOtp(Request $request)
    {
        $value = session('updateemail');
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required'
        ]);

        $verificationCode   = VerificationCode::where('user_id', $request->user_id)->where('otp', $request->otp)->first();
        $now = Carbon::now();
        if (!$verificationCode) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }elseif($verificationCode && $now->isAfter($verificationCode->expire_at)){
            return redirect()->back()->with('error', 'Your OTP has been expired');
        }

        $user = User::whereId($request->user_id)->first();
        if($user){
            // Expire The OTP
            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);
            Auth::login($user);
            $accessToken = auth()->user()->createToken('authToken')->accessToken;
            $email_token = $accessToken->token;
          User::where('id',$user->id)->update(['email' => $value]);
            return redirect('/')->with('success', 'Your Email Is Update');
        }

        return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
    }

    public function orderView(Request $request,$order_id)
    {

        try {
            $order_id=decrypt($order_id);

              //  $order_id=decrypt($order_id);
      } catch (DecryptException $e) {
          throw new HttpResponseException(

              response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
          );
      }
        $user_id = Auth::user()->id;
        $order = Order::findOrfail($order_id);
        if ($order->user_id != $user_id) {
            return redirect()->route('user.dashboard')->with('error', 'Not Fount');
        }
        // $OrderProduct = OrderProduct::with('getproductsData')->where('order_id', $order_id)->orderBy('id', 'asc')->get();
        $OrderProduct = OrderProduct::with(['getproductsData' => function ($query) {
            $query->withTrashed();
        }])->where('order_id', $order_id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('order_id', $order_id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('order_id', $order_id)->where('atype', 'shipping')->first();
        #Country Check
        $countryPrice = session()->get('processedData');
        return view('frontend.user.order.view',compact('order', 'billing_address', 'shipping_address', 'OrderProduct','countryPrice'));
    }

    public function productReview($id)
    {


        try {
            $id=decrypt($id);
              //  $order_id=decrypt($order_id);
      } catch (DecryptException $e) {
          throw new HttpResponseException(

              response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
          );
      }
        $product = Product::find($id);
        $productReview = ProductReview::where('product_id',$id)->where('user_id',auth()->user()->id)->first();
        if ($productReview != null) {
            if ($id == $productReview->product_id && auth()->user()->id == $productReview->user_id) {
                return back()->with('error','You have already Review this Product');
            }
        }
        return view('frontend.user.order.product_review',compact('product'));
    }

    public function storeReview(Request $request)
    {
        $request->validate(
            [
                'star' => 'required',
                'description' => 'required',
            ],
            [
                'star.required' => trans('translation.required', ['name' => 'product']),
                'description.required' => trans('translation.required', ['name' => 'product id']),
            ]
        );
        $review = new ProductReview();
        $review->rating = $request->star;
        $review->description = $request->description;
        $review->product_id = $request->product_id;
        $review->user_id = Auth::user()->id;
        $review->save();

        if (isset($request->choose_file)) {
            $uploadFile = $request->choose_file;
            $review_image = $uploadFile->hashName();
            $path = $uploadFile-> move(public_path('images/review_image'), $review_image);
            // Compress the uploaded image
            $compressedPath = $this->compressImage($path);
            $review->image = basename($compressedPath);
            $review->save();
        }

        return redirect()->route('user.profile')->with('success','product review add successfully');
    }

    public function trackOrder(Request $request)
    {
        return redirect()->route('orderView',$request->order_id);
    }

    public function orderCancle($id)
    {


        try {
            $id=decrypt($id);
              //  $order_id=decrypt($order_id);
      } catch (DecryptException $e) {
          throw new HttpResponseException(

              response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
          );
      }
        $user_id = Auth::user()->id;
        $order = Order::findOrfail($id);
        if ($order->shipped_at != null) {
            return back()->with('error', 'This Order is Already Shipped.');
        }
        if ($order->user_id != $user_id) {
            return redirect()->route('user.dashboard')->with('error', 'Not Fount');
        }
        $ordercancel = OrderCancel::where('order_id',$order->id)->first();
        if ($ordercancel != null) {
            if ($order->id == $ordercancel->order_id) {
                return back()->with('error','This Order is already Canceled');
            }
        }
        $OrderProduct = OrderProduct::with('getproductsData')->where('order_id', $id)->orderBy('id', 'asc')->get();
        $billing_address = Address::where('order_id', $id)->where('atype', 'billing')->first();
        $shipping_address = Address::where('order_id', $id)->where('atype', 'shipping')->first();
        #Country Check
        $countryPrice = session()->get('processedData');
        return view('frontend.user.order.cancel_order',compact('order','billing_address','shipping_address','countryPrice'));
    }

    public function storeOrderCancel(Request $request)
    {

        $order = Order::findOrfail($request->order_id);
        $now = Carbon::now();
        $order->status = 4;
        $order->canceled_at = $now;
        $order->save();

        $orderCancel = new OrderCancel();
        $orderCancel->order_id = $request->order_id;
        $orderCancel->user_id = Auth::user()->id;
        $orderCancel->reason = $request->description;
        $orderCancel->save();

        return redirect()->route('orderView',encrypt($request->order_id))->with('success','Order Cancel successfully');
    }

    public function productReturn(Request $request,$id)
    {


        try {
            $id=decrypt($id);
              //  $order_id=decrypt($order_id);
      } catch (DecryptException $e) {
          throw new HttpResponseException(

              response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
          );
      }
        $product = OrderProduct::findOrfail($id);
        $orderReturn = OrderReturn::where('order_id',$product->order_id)->where('order_product_id',$product->id)->first();
        if ($orderReturn != null) {
            if ($product->order_id == $orderReturn->order_id && $product->id == $orderReturn->order_product_id) {
                return back()->with('error','This Order is already Return');
            }
        }
        $OrderProduct = OrderProduct::with('getproductsData')->where('id', $product->id)->orderBy('id', 'asc')->get();
        #Country Check
        $countryPrice = session()->get('processedData');
        return view('frontend.user.order.return_order',compact('product','OrderProduct','countryPrice'));
    }

    public function storeOrderReturn(Request $request)
    {
        if (isset($request->attach)) {
            $orderReturn = new OrderReturn();
            $uploadFile = $request->attach;
            $return_attach = $uploadFile->hashName();
            $path = $uploadFile-> move(public_path('images/return'), $return_attach);
            $orderReturn->attach = $return_attach;
            $orderReturn->order_id = $request->order_id;
            $orderReturn->order_product_id = $request->order_product_id;
            $orderReturn->user_id = Auth::user()->id;
            $orderReturn->reason = $request->description;
            $orderReturn->status = "pending";
            $orderReturn->save();

            $order = Order::where('id',$request->order_id)->first();
            $order->status = 6;
            $order->save();
        }

        return redirect()->route('orderView',encrypt($request->order_id))->with('success','Product return request successfully');
    }

    public function editReview($id)
    {
        try {
            $id=decrypt($id);
        } catch (DecryptException $e) {
            throw new HttpResponseException(

                response()->view('errors.404', [], Response::HTTP_NOT_FOUND)
            );
        }

        $product = Product::find($id);
        $productReview = ProductReview::where('product_id',$id)->where('user_id',auth()->user()->id)->first();
        return view('frontend.user.order.edit_product_review',compact('product','productReview'));
    }

    public function updateReview(Request $request)
    {
        $request->validate(
            [
                'star' => 'required',
                'description' => 'required',
            ],
            [
                'star.required' => trans('translation.required', ['name' => 'product']),
                'description.required' => trans('translation.required', ['name' => 'product id']),
            ]
        );
        $id = $request->review_id;
        $review = ProductReview::find($id);
        $review->rating = $request->star;
        $review->description = $request->description;
        $review->user_id = Auth::user()->id;
        $review->save();

        if (isset($request->choose_file)) {
            $uploadFile = $request->choose_file;
            $review_image = $uploadFile->hashName();
            $path = $uploadFile-> move(public_path('images/review_image'), $review_image);
            // Compress the uploaded image
            $compressedPath = $this->compressImage($path);
            $review->image = basename($compressedPath);
            $review->save();
        }

        return redirect()->route('user.profile')->with('success','product review Update successfully');
    }
}
