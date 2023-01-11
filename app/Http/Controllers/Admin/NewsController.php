<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;

use Intervention\Image\ImageManagerStatic as InterImage;
use Illuminate\Support\Facades\Storage;
use App\Model\Admin\News;
use Illuminate\Support\Str;



class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $news = new News();
        $newses = $news->orderBy('priority','asc')->get();
        $data['newses'] = $newses;
        
        return view('admin.news.list', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        $news = new News();
        if ($request->isMethod('post')) {

            $this->validate(
                $request,
                [
                    'title' => 'required|max:100',
                    'date' => 'required',
                    'description' => 'required',
                    'priority'=>'required'
                ],[
                    'original_file.image'=>'The image invalid format.',
                    'original_file.max'=>'The image may not be greater than 1mb.'
                ]
            );         

            $slug = Str::slug( $request->input('title'), '-');
            $data['slug'] = $slug;
            $data['title'] = $request->input('title');
            if (!empty($request->file('original_file'))) {
                $original_img = $request->file('original_file');        
                $file = $original_img->getClientOriginalName();        
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $extension = pathinfo($file, PATHINFO_EXTENSION);        
                $file_name = date('d-m-y-h-s') . '-' . $filename . '.' . $extension;        
                $props = json_decode($request->input('image_props'), true);        
                $img = InterImage::make($original_img);
                $img->crop((int)$props['width'], (int)$props['height'], (int)$props['x'], (int)$props['y']);
                $img->resize(800, 500);        
                $img->save('storage/app/public/news/' . $file_name);
                $data['large_image'] = $file_name;        
            }
            $data['priority'] = $request->input('priority');
            $data['description'] = $request->input('description');
            // $data['date'] = $request->input('date');

            $data['date'] = Carbon::createFromFormat('d/m/Y', $request->date); 

            // $data['flash_news'] = $request->input('flash_news');
            $data['status'] = 1;
            $data['created_by'] = Auth::id();
            $data['modified_by'] = Auth::id();
        }

        if ($news->create($data)) {
            Session::flash('success', 'News  created successfully');
            return redirect()->route('admin.news.index');
        } else {
            Session::flash('error', 'News creation failed');
            return redirect()->back();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Model\News  $news
     * @return \Illuminate\Http\Response
     */
    public function deleteimg(Request $request)
    {
        $id = $request->input('id');
        $banners = new News;
        $banner = $banners->findorfail($id);
        if (isset($banner->file)) {
            Storage::delete('public/news/' . $banner->file);
            $banner->file = '';
            $banner->save();
        }

        Session::flash('success', 'File deleted successfully');
        if ($request->ajax()) {
            return $banner;
        }
        return redirect()->back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = new News;
        $data = [];
        $news = $news::find($id);
        if (empty($news)) {
            Session::flash('error', 'There is no news in this instance');
            return redirect()->back();
        }
        $data['news'] = $news;
        $data['updating'] = true;
        return view('admin.news.create', $data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $data = [];
        $newses = new News();
        $news = $newses->findorfail($id);
        $this->validate(
            $request,
            [
                'title' => 'required',
                'date' => 'required',
                'priority'=>'required',
                'description' => 'required',
            ]           
        );       

        $slug = Str::slug( $request->input('title'), '-');
        $news->slug = $slug;

        $news->title = $request->input('title');
        if (!empty($request->file('original_file'))) {
            $original_img = $request->file('original_file');    
            $file = $original_img->getClientOriginalName();    
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);    
            $file_name = date('d-m-y-h-s') . '-' . $filename . '.' . $extension;    
            $props = json_decode($request->input('image_props'), true);    
            $img = InterImage::make($original_img);
            $img->crop((int)$props['width'], (int)$props['height'], (int)$props['x'], (int)$props['y']);
            $img->resize(800,500);    
            $img->save('storage/app/public/news/' . $file_name);
            $news->large_image = $file_name;    
        }

        $news->date = Carbon::createFromFormat('d/m/Y', $request->date); 


        $news->priority = $request->input('priority');
        $news->description = $request->input('description');
        // $news->video = $request->input('video');
        // $news->flash_news = $request->input('flash_news');
        $news->modified_by = Auth::id();

        if ($news->save()) {
            Session::flash('success', 'News updated  successfully');
            return redirect()->route('admin.news.index');
        } else {
            Session::flash('error', 'News updating failed');
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\News  $news
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $newses = new News();

        $status=$newses->find($id);

        if($status['status']==1)
        {
            $status->status=0;

            if($status->save())
            {
               Session::flash('success','News Disabled Successfully');  
            }
        }
        else
        {
           $status->status=1;
            if($status->save())
            {
            Session::flash('success','News Enabled Successfully');
            }
        } 
        

        return redirect()->back();
    }

    // public function flashnews($id)
    // {
    //     $newses = new News;
    //     $news = $newses->findorfail($id);
    //     $news->flash_news = !$news->flash_news;

    //     if ($news->save()) {
    //         Session::flash('success', 'Flash news status is successfully updated');
    //     } else {
    //         Session::flash('error', 'Something went  wrong');
    //     }
    //     return redirect()->route('admin.news.index');
    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $data = [];
        if (!$id) {
            return redirect()->back();
        }
        $banners = new News();
        $ar = explode(",", $id);

        foreach ($ar as $ar1) {
            $banner = $banners->findorfail($ar1);
            if (isset($banner->large_image)) {
                if (Storage::delete('public/news/' . $banner->large_image));
            }
            $banner->delete();
        }

        Session::flash('success', 'News deleted successfully');
        if ($request->ajax()) {
            return "AJAX";
        }
        return redirect()->back();  
    }
}
