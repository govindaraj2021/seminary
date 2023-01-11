<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // $this->middleware('auth');
    // }


    /**
     * Show the application dashboard Home Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        return view('admin.index', $data);
    }

}
