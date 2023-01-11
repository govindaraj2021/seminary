<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Admin\News;
use App\Model\Admin\Page;

class NewsController extends Controller{

    public function index()
    {
        $data=[];
        $data['page'] = Page::where('status',1)->where('url',basename(url()->current()))->select('large_image')->orderBy('id', 'desc')->first();
        $data['newses'] = News::where('status', 1)->orderBy('priority', 'asc')->paginate(6);
        return view('news',$data);
    }
    public function details($slug){
        $data=[];
        $newses = News::where('status', 1)->where('slug', $slug)->first();
        $latest_news = News::Active()->orderBy('id', 'DESC')->whereNotIn('slug', [$slug])->take(3)->get();
        $data['page'] = Page::where('status',1)->where('url',basename(url()->current()))->select('large_image')->orderBy('id', 'desc')->first();
        $data['newses'] = $newses;
        $data['latest_news'] = $latest_news;
        if (empty($newses)) {
            return abort(404);
        }
        return view('news-details',$data);
    }
}
