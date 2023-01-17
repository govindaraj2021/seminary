<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Intervention\Image\ImageManagerStatic as InterImage;

use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Model\Admin\Gallery;
use Illuminate\Validation\Rule;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $galleries= Gallery::orderby('priority','asc');
        $data['galleries'] = $galleries->get();
        return view('admin.gallery.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[];
        // $categories = \DB::table('gallery_category')->where('status', 1)->get();
        // $data['categories'] = $categories;
        // $data['galleries'] = Gallery::orderby('id','DESC')->get();
    
        return view('admin.gallery.create',$data);
    }

    // public function create_video()
    // {
    //     return view('admin.gallery.create_video');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = [];

        $gallery = new Gallery();

        if ($request->isMethod('post')) {

            $this->validate(
                $request,
                [
                    'title' => 'required',
                    'priority'=>'required',
                    'original_file'=> Rule::requiredIf(function () use ($request) {
                        return ($request->is_video==1);
                    }),
                    'link'=> Rule::requiredIf(function () use ($request) {
                        return ($request->is_video==1);
                    }),
                    'gallery_status'   =>'required',
                ],
                [
                    'title.required' => 'Title field is required',
                    'original_file.required' => 'Image field is required',
                ]
            );


            if (!empty($request->file('original_file'))) {
                $original_img = $request->file('original_file');
                $file = $original_img->getClientOriginalName();
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                $file_name = date('d-m-y-h-s') . '-' . $filename . '.' . $extension;
                $props = json_decode($request->input('thumbnail'), true);
                $img = InterImage::make($original_img);
                $img->crop((int)$props['width'], (int)$props['height'], (int)$props['x'], (int)$props['y']);
                $img->resize(1000,700);
                $img->save('storage/app/public/gallery/' . $file_name);
                $data['large_image'] = $file_name;
            }
            // $data['description']=$request->input('description');
            $data['title'] = $request->input('title');
            // $data['gallery_category_id'] = $request->input('gallery_category_id');
            $data['link'] = $request->input('link');
            $data['gallery_status'] = $request->input('gallery_status');
            $data['created_by'] = Auth::id();
            $data['modified_by'] = Auth::id();
            $data['status'] = 1;

            if ($gallery->create($data)) {
                Session::flash('success', 'Gallery item added successfully');
                return redirect()->route('admin.gallery.index');
            } else {
                Session::flash('error', 'Gallery failed To create');
                return redirect()->back();
            }
        }


        Session::flash('error', 'Somthig Went worng can\'t store your file, please try again');
        return redirect()->back();
    }


    /**
     * List All gallery
     * @return all galler images
     */
    public function list()
    {
        $data = [];
        $gallery = new Gallery();
        $galleries = $gallery->all();
        $data['galleries'] = $galleries;
        return view('admin.gallery.list', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $gallery = new Gallery();
        $data['updating'] = true;
        $gallery = $gallery->find($id);
        $data['gallery'] = $gallery;
        return view('admin.gallery.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $data = [];
        $gallery = new Gallery();

        $data['updating'] = true;
        $gallery = $gallery->find($id);

        $this->validate(
            $request,
            [
                'title' => 'required',
                'original_file' => 'mimes:jpeg,bmp,png',
                'gallery_status'   =>'required',
                'priority'=>'required',
            ],
            [
                'title.required' => 'Photo title field is required',
                'original_file.required' => 'Image field is required',
            ]
        );


        $original_img = $request->file('original_file');

        if (!empty($request->file('original_file'))) {
            if (!$request->input('thumbnail')) { }
            $file = $original_img->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $file_name = date('d-m-y-h-s') . '-' . $filename . '.' . $extension;
            $props = json_decode($request->input('thumbnail'), true);
            $img = InterImage::make($original_img);
            $img->crop((int)$props['width'], (int)$props['height'], (int)$props['x'], (int)$props['y']);
            $img->resize(1000,700);
            $img->save('storage/app/public/gallery/' . $file_name);
            $gallery->large_image = $file_name;
        }
        $gallery->title = $request->input('title');
        $gallery->priority = $request->input('priority');
        $gallery->link = $request->input('link');
        $gallery->gallery_status = $request->input('gallery_status');
        $gallery->modified_by = Auth::id();
        if ($gallery->save()) {
            Session::flash('success', 'Gallery item updated successfully');
            return redirect()->route('admin.gallery.index');
        } else {
            Session::flash('error', 'Gallery Updated failed');
            return redirect()->back();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy(Request $request, $id = null)
    {
        $data = [];
        if (!$id) {
            return redirect()->back();
        }
        $galleryes = new Gallery();
        $ar = explode(",", $id);

        foreach ($ar as $ar1) {
            $gallery = $galleryes->findorfail($ar1);
            if (isset($gallery->large_image)) {
                Storage::delete('public/gallery/' . $gallery->large_image);
            }
            $gallery->delete();
        }
        Session::flash('success', 'Gallery item deleted successfully');
        if ($request->ajax()) {
            return "AJAX";
        }
        return redirect()->back();
    }
    /**
     * Add status Updates.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $banner = Gallery::find($id);

        if ($banner['status'] == 1) {
            $banner->status = 0;
            if ($banner->save()) {
                Session::flash('success', 'Gallery item disabled successfully');
            }
        } else {
            $banner->status = 1;
            if ($banner->save()) {
                Session::flash('success', 'Gallery item enabled successfully');
            }
        }
        return redirect()->route('admin.gallery.index');
    }

}
