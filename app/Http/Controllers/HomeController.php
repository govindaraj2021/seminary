<?php

namespace App\Http\Controllers;


use App\Model\Admin\Banner;
use App\Model\Admin\Topper;
use App\Model\Admin\News;
use App\Model\Admin\Testimonial;
use App\Model\Admin\Gallery;
use App\Model\Admin\Achiever;
use App\Model\Admin\PrincipalsMessage;
use App\Model\Admin\Page;

class HomeController extends Controller
{
    public function index(){
        $data= [];
        $data['banners'] = Banner::active()->orderBy('id', 'DESC')->get();
        $data['testimonials']=Testimonial::where('status',1)->orderBy('id', 'DESC')->get();
        $data['newses'] = News::where('status', 1)->orderBy('priority', 'asc')->take(5)->get();
        return view('home', $data);
    }
    public function page($url)
    {
        $pages = new Page;
        $url = strtolower($url);
        $page = $pages::where([
            ['url', 'LIKE', $url],
            ['status', 1]
        ])
            ->select('parent_id','url', 'name', 'page_title',  'description', 'meta_title', 'meta_keyword', 'meta_description', 'large_image')
            ->first();
        if (empty($page)) {
            abort(404);
        }
        $meta_data = $pages->getPageMeta($url);
        $data['page'] = $page;
        $data['meta_data'] = $meta_data;
        return view('page', $data);
    }



}