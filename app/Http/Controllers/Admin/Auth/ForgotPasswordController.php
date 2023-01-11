<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Http\Request;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    // public function sendsResetLinkEmail(Request $request)
    // {

    //     if($request->has('email'))
    //     {
    //     $this->validateEmail($request);

    //     // We will send the password reset link to this user. Once we have attempted
    //     // to send the link, we will examine the response then see the message we
    //     // need to show to the user. Finally, we'll send out a proper response.
    //     $response = $this->broker()->sendResetLink(
    //         $this->credentials($request)
    //     );

    //     return $response == Password::RESET_LINK_SENT
    //                 ? $this->sendResetLinkResponse($request, $response)
    //                 : $this->sendResetLinkFailedResponse($request, $response);
    // }
    // }

    // public function showLinkRequestForm()
    // {
    //     return view('auth.passwords.email');
    // }
    // public function sendResetLinkEmail(Request $request)
    // {
    //     $this->validate($request, ['email' => 'required|email']);
    //     $user_check = User::where('email', $request->email)->first();
    
    //     if (!$user_check->activated) {
    //         return back()->with('status', 'Your account is not activated. Please activate it first.');
    //     } else {
    //         $response = $this->broker()->sendResetLink(
    //             $request->only('email')
    //         );
    
    //         if ($response === Password::RESET_LINK_SENT) {
    //             return back()->with('status', trans($response));
    //         }
    
    //         return back()->withErrors(
    //             ['email' => trans($response)]
    //         );
    //     }
    // } 

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
