<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\User;
use DB;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::USER;

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('frontend.auth.reset_password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
      {
        // dd($request->all());
        //   $request->validate([
        //     'token' => 'required',
        //     'email' => 'required|email',
        //     'password' => ['required'],
        //   ]);
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email])->first();
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
          $check_password = User::where('email',$request->email)->first();
          if (Hash::check($request->password, $check_password->password)) {
            // The old and new passwords are the same
            // Return a response indicating that the new password must be different
            return back()->with('error', 'The new password must be different.');
        }
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return redirect('/user-login')->with('success', 'Your password has been changed!');
      }
}
