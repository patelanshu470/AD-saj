<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\VerificationCode;
use Auth;
use Session;
use App\Models\Cart;
use GuzzleHttp\Client;
use App\Models\OtpAttempt;

class MobileOtpAuthController extends Controller
{
    public function checkUser(Request $request)
    {
        $user = User::where('phone_number',$request->phone_number)->first();
        if ($user) {
            return redirect()->route('otp.generate.mobile',$user->id);
        } else {
            $user = User::create([
                'phone_number' => '+91'.$request->phone_number
            ]);
            return redirect()->route('otp.generate.mobile',$user->id);
        }
    }

    public function login(Request $request)
    {
        $value = session('phone_number');
        return view('frontend.auth.otp-login',compact('value'));
    }

    public function generate(Request $request,$user_id)
    {
        $user = User::where('id',$user_id)->first();
        $otpAttempts = $this->otpAttempts($user);
        if($otpAttempts != null){
            if ($otpAttempts['result'] === 'yes') {
                $remainingTime = $otpAttempts['remainingTime'];
                return redirect()->back()->with('success', 'Too many OTP attempts. Try again after ' . gmdate("i:s", $remainingTime));
            }
        }
        $verificationCode = $this->generateOtp($user->phone_number);
        $message_otp = "Your OTP To Login is - ".$verificationCode->otp;
        $environment = app()->environment();
        if ($environment == 'local' || $environment == 'staging') {
            return redirect()->route('otp.verification.mobile', ['user_id' => $verificationCode->user_id])->with('success',  $message_otp);
        } else {
            $client = new Client();
            $mobile = '91'. $user->phone_number;
            if($user->first_name == null){
                $name = 'SDK User';
            }
            else{
                $name = ucfirst(trans($user->first_name));
            }
            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => json_encode([
                    'template_id' => '64c88f1ad6fc05128f3a5582',
                    'sender' => 'SDKIND',
                    'mobiles' => $mobile,
                    'name' => $name,
                    'otp' => $verificationCode->otp,
                ]),
                'headers' => [
                    'accept' => 'application/json',
                    'authkey' => '400995AES5H0fBYB164c89161P1',
                    'content-type' => 'application/json',
                ],
            ]);
            return redirect()->route('otp.verification.mobile', ['user_id' => $verificationCode->user_id]);
        }
    }

    public function resend(Request $request,$user_id)
    {
        if($request->phone_number){
            $phone_number=$request->phone_number;
        }else{
            $phone_number=$user_id;
        }
        $user = User::where('id',$user_id)->first();
        $all_data = VerificationCode::where('user_id',$user_id)->first();
        $now = Carbon::now();
        $verificationCode = $this->generateOtp($user->phone_number);
        $otpAttempts = $this->otpAttempts($user);
        if($otpAttempts != null){
            if ($otpAttempts['result'] === 'yes') {
                $remainingTime = $otpAttempts['remainingTime'];
                return redirect()->back()->with('success', 'Too many OTP attempts. Try again after ' . gmdate("i:s", $remainingTime));
            }
        }
        $message = "Your OTP To Login is - ".$verificationCode->otp;
        $environment = app()->environment();
        if ($environment == 'local' || $environment == 'staging') {
            return redirect()->route('otp.verification.mobile', ['user_id' => $verificationCode->user_id])->with('success',  $message);
        } else {
            $client = new Client();
            $mobile = '91'. $user->phone_number;
            if($user->first_name == null){
                $name = 'SDK User';
            }
            else{
                $name = ucfirst(trans($user->first_name));
            }
            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => json_encode([
                    'template_id' => '64c88f1ad6fc05128f3a5582',
                    'sender' => 'SDKIND',
                    'mobiles' => $mobile,
                    'name' => $name,
                    'otp' => $verificationCode->otp,
                ]),
                'headers' => [
                    'accept' => 'application/json',
                    'authkey' => '400995AES5H0fBYB164c89161P1',
                    'content-type' => 'application/json',
                ],
            ]);
            return redirect()->route('otp.verification.mobile', ['user_id' => $verificationCode->user_id]);
        }
    }

    public function generateOtp($phone_number)
    {
        $user = User::where('phone_number', $phone_number)->first();
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();
        $now = Carbon::now();
        if($verificationCode && $now->isBefore($verificationCode->expire_at)){
            return $verificationCode;
        }
        return VerificationCode::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(2)
        ]);
    }

    public function verification($user_id)
    {
        return view('frontend.auth.otp-mobile-verification')->with([
            'user_id' => $user_id
        ]);
    }

    public function loginWithOtp(Request $request)
    {
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
            User::where('id',$user->id)->update(['remember_token' => $email_token,'email_verified_at' => $now]);
            $session_data = SESSION::get('cart_data');
            if (!empty($session_data) && $session_data!=null && $session_data) {
                Cart::create([
                    'product_id' => $session_data['product_id'],
                    'quantity' => $session_data['quantity'],
                    'user_id' => auth()->user()->id,
                ]);
            }
            return redirect('/')->with('success','Hi Welcome Back !');
        }
        return redirect()->route('otp.login.mobile')->with('error', 'Your Otp is not correct');
    }
    public function otpAttempts($user){
        // Check if user has exceeded OTP attempts
        $otpAttempts = OtpAttempt::where('user_id', $user->id)->orderByDesc('created_at')->first();
        $maxAttempts = 3; // You can adjust this limit as per your requirements
        if ($otpAttempts && $otpAttempts->attempts >= $maxAttempts) {
            // User exceeded the OTP attempts limit, lock them out for 15 minutes (900 seconds)
            $lockoutDuration = 900;
            $remainingTime = strtotime($otpAttempts->created_at) + $lockoutDuration - time();
            if ($remainingTime > 0) {
                return ['result' => 'yes', 'remainingTime' => $remainingTime];
                 // return response()->json(['message' => 'Too many OTP attempts. Try again after ' . gmdate("i:s", $remainingTime)], 429);
             } else {
                 // Reset attempts after the lockout duration has passed
                 OtpAttempt::where('user_id', $user->id)->delete();
             }
         } else {
             // Save the new OTP attempt
             if ($otpAttempts) {
                 OtpAttempt::where('user_id', $user->id)->increment('attempts');
             } else {
                 OtpAttempt::insert([
                     'user_id' => $user->id,
                     'attempts' => 1,
                     'created_at' => now(),
                     'updated_at' => now(),
                 ]);
             }
         }
    }
}
