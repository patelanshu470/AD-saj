<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $environment = app()->environment();
        if ($environment == 'production' || $environment == 'staging') {
            $ip = $request->ip();
            $currentUserInfo = Location::get($ip);
            session()->put('processedData', $currentUserInfo->countryCode);
        }
        #Country Check
        $countryPrice = session()->get('processedData');
        return view('frontend.auth.login',compact('countryPrice'));
    }

    public function register(Request $request)
    {
        return view('frontend.auth.register');
    }

    public function forgotPassword()
    {
        return view('frontend.auth.forgot_password');
    }

    public function termCondition()
    {
        return view('frontend.auth.term_conditions');
    }
}
