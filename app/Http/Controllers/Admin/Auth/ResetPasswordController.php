<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
 use DB;

 use Hash;
 use Session;
use Illuminate\Http\Request;

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

    public function showResetForm(Request $request, $token = null)
    {

        $is_valid = false;
        $users = DB::table('password_resets')->get();

        foreach($users as $user){
            if(Hash::check($token, $user->token)){
                $is_valid = true;
                break;
            }
        }

        if(!$is_valid){
                Session::flash('message', 'This password reset link is expired !');
                Session::flash('alert-class', 'alert-danger'); 
                return redirect()->route('login');
        }

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
