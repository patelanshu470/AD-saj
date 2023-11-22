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

class AuthOtpController extends Controller
{
    public function checkUser(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if ($user) {
            return redirect()->route('otp.generate',$user->id);
        } else {
            $request->validate([
                'email' => 'required|email',
            ]);
            $user = User::create([
                'email' => $request->email
            ]);
            return redirect()->route('otp.generate',$user->id);
        }
    }

    public function login(Request $request)
    {
        $value = session('email');
        return view('frontend.auth.otp-login',compact('value'));
    }

    public function generate(Request $request,$user_id)
    {
        $user = User::where('id',$user_id)->first();
        $verificationCode = $this->generateOtp($user->email);
        $message_otp = "Your OTP To Login is - ".$verificationCode->otp;
        if($this->isOnline()){
            $mail_data = [
                'recipient' => $user->email,
                'fromEmail' => 'support@sajhdhajke.com',
                'fromName' => "Sajh Dhaj Ke",
                'companyName' => 'Sajh Dhaj Ke',
                'subject' => "Your One-Time Password (OTP)",
                'otp' => $verificationCode->otp,
            ];
            \Mail::send('otp-mail',$mail_data,function($message) use ($mail_data){
                $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'],$mail_data['companyName'])
                ->subject($mail_data['subject']);
            });
            $environment = app()->environment();
            if ($environment == 'local' || $environment == 'staging') {
                return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message_otp);
            } else {
                return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id]);
            }
        }else {
                return "not connected";
            }
            $environment = app()->environment();
            if ($environment == 'local' || $environment == 'staging') {
                return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message_otp);
            } else {
                return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id]);
            }
    }

    public function resend(Request $request,$user_id)
    {
        if($request->email){
            $email=$request->email;
        }else{
            $email=$user_id;
        }
        $user = User::where('id',$user_id)->first();
        $all_data = VerificationCode::where('user_id',$user_id)->first();
        $now = Carbon::now();
        if($now->isAfter($all_data->expire_at)){
            VerificationCode::where('user_id',$user_id)->delete();
        }
        $verificationCode = $this->generateOtp($user->email);
        $message = "Your OTP To Login is - ".$verificationCode->otp;
        if($this->isOnline()){
            $mail_data = [
                'recipient' => $user->email,
                'fromEmail' => 'support@sajhdhajke.com',
                'fromName' => "Sajh Dhaj Ke",
                'companyName' => 'Sajh Dhaj Ke',
                'subject' => "Your One-Time Password (OTP)",
                'otp' => $verificationCode->otp,
            ];
            \Mail::send('otp-mail',$mail_data,function($message) use ($mail_data){
                $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'],$mail_data['companyName'])
                ->subject($mail_data['subject']);
            });
            $environment = app()->environment();
            if ($environment == 'local' || $environment == 'staging') {
                return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message);
            } else {
                return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id]);
            }

        } else {
            return "not connected";
        }
        $environment = app()->environment();
        if ($environment == 'local' || $environment == 'staging') {
            return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message);
        } else {
            return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id]);
        }


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
        $user = User::where('email', $email)->first();
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
        return view('frontend.auth.otp-verification')->with([
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

        return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
    }
}
