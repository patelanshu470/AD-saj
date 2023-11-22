<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Session;
use App\Models\Cart;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        if (auth()->user()->is_admin == 1) {
            return redirect()->route('dashboard');
        }
        if (auth()->user()->is_admin == 0 && auth()->user()->email_verified_at == Null) {
            // dd($request->email);
            $request->session()->invalidate();
            session(['email' => $request->email]);
            return redirect()->route('otp.login');
        } else {
            $session_data = SESSION::get('cart_data');
            if (!empty($session_data) && $session_data!=null && $session_data) {
                Cart::create([
                    'product_id' => $session_data['product_id'],
                    'quantity' => $session_data['quantity'],
                    'user_id' => auth()->user()->id,
                ]);
            }
            return redirect()->route('user.dashboard')->with('success','Hi '.auth()->user()->first_name.' Login Successfully');
        }
        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }
    public function logout(Request $request)
    {
        if (auth()->user()->is_admin == 0) {
            $this->guard()->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            if ($response = $this->loggedOut($request)) {
                return $response;
            }

            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('auth');
        }
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('admin/');
    }
}
