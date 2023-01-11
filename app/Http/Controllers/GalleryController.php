<?php

namespace App\Http\Controllers;
use App\Model\Admin\Gallery;
// use App\Model\Admin\Video;
use App\Model\Admin\Page;
class GalleryController extends Controller
{
    public function photo(){
        $data = [];
        $data['page'] = Page::where('status',1)->where('url',basename(url()->current()))->select('large_image')->orderBy('id', 'desc')->first();
        $data['gallery'] = Gallery::where('status', 1)->where('gallery_status',0)->orderBy('priority', 'asc')->paginate(6);
        return view('photo-gallery', $data);
    }

    public function video(){
        $data = [];
        $data['page'] = Page::where('status',1)->where('url',basename(url()->current()))->select('large_image')->orderBy('id', 'desc')->first();
        $data['gallery'] = Gallery::where('status',1)->where('gallery_status',1)->orderby('priority', 'asc')->paginate(6);
        return view('video-gallery',$data);
    }
}