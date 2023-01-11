<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use App\Model\Admin\Usergroup;

class AuthCheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        //If the status is not approved redirect to login 


        if (Auth::check() && Auth::user()->status != '1' || Auth::check() &&  Usergroup::where('id', Auth::user()->user_group_id)->first()->status != '1') {

            Auth::logout();
            Session::flash('message', 'Login Failed!');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('login');
        }

        return $response;
    }
}
