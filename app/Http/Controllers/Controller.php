<?php

namespace App\Http\Controllers;

use App\Model\Admin\News;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // public function __construct()
    // { 
    //     $news_slider = News::active()->orderBy('id', 'DESC')->get();
    //     View::share('news_slider', $news_slider);
    // }
}
