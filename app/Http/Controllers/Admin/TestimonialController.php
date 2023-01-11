<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
use Intervention\Image\ImageManagerStatic as InterImage;
use Illuminate\Support\Facades\Storage;
use App\Model\Admin\Testimonial;

use Illuminate\Validation\Rule;


class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $testimonial = new Testimonial();

        $testimoniales = $testimonial->get();


        $data['testimoniales'] = $testimoniales;


        return view('admin.testimonial.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.testimonial.create');
    }

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

        $testimonial = new Testimonial();
        if ($request->isMethod('post')) {

            $this->validate(
                $request,
                [
                    'name' => 'required| max:100',
                    'original_file' => 'mimes:jpeg,bmp,png',

                    'testimonial'=> Rule::requiredIf(function () use ($request) {
                        return ($request->is_video==0);
                    }),
                    'link'=> Rule::requiredIf(function () use ($request) {
                        return ($request->is_video==1);
                    }),




                ],
                [
                    'original_file.mimes' => 'The Image must be a file of type: jpeg, bmp, png.',
                    'name.required' => 'The name field is required'
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
                $img->resize(54,54);
                $img->save('storage/app/public/testimonial/' . $file_name);
                $data['photo'] = $file_name;

            }

            $data['name'] = $request->input('name');
            $slug = Str::slug( $request->input('name'), '-');
            $data['slug'] = $slug;
            $data['testimonial'] = $request->input('testimonial');
            $data['is_video']=$request->input('testimonial');       
            $data['link'] = $request->input('link');
            $data['status'] = 1;

            $data['created_by'] = Auth::id();
            $data['modified_by'] = Auth::id();

        }

        if ($testimonial->create($data)) {
            Session::flash('success', 'Guest book  created successfully');
            return redirect()->route('admin.testimonial.index');
        } else {
            Session::flash('error', 'Guest book  creation failed');
            return redirect()->back();
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\News  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $testimonial = new Testimonial;
        $data = [];


        $testimonial = $testimonial::find($id);

        if (empty($testimonial)) {
            Session::flash('error', 'There is no Guest book  in this instance');
            return redirect()->back();
        }
        $data['testimonial'] = $testimonial;
        $data['updating'] = true;
        return view('admin.testimonial.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\News  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        // dd($request);
        $data = [];

        $testimoniales = new Testimonial();

        $testimonial = $testimoniales->findorfail($id);


        $this->validate(
            $request,
            [
                'name' => 'required| max:100',
                // 'testimonial' => 'required',
                'original_file' => 'mimes:jpeg,bmp,png',



                'testimonial'=> Rule::requiredIf(function () use ($request) {
                    return ($request->is_video==0);
                }),
                'link'=> Rule::requiredIf(function () use ($request) {
                    return ($request->is_video==1);
                }),



            ],
            [
                'original_file.mimes' => 'The Image must be a file of type: jpeg, bmp, png.',
              
                'name.required' => 'The name field is required',

            ]
        );
        if($request->input('remove')=="yes")
        {
            $testimonial->photo ='';
        }
        
        $original_img = $request->file('original_file');

        if (!empty($request->file('original_file'))) {
            $file = $original_img->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $file_name = date('d-m-y-h-s') . '-' . $filename . '.' . $extension;
            $props = json_decode($request->input('thumbnail'), true);
            $img = InterImage::make($original_img);
            $img->crop((int)$props['width'], (int)$props['height'], (int)$props['x'], (int)$props['y']);
            $img->resize(54, 54);
            $img->save('storage/app/public/testimonial/' . $file_name);
            $data['gallery'] = $file_name;
            $testimonial->photo = $data['gallery'];
        }
    

        $testimonial->name = $request->input('name');
        $slug = Str::slug( $request->input('name'), '-');
        $testimonial->slug = $slug;
        $testimonial->link = $request->input('link');

        $testimonial->is_video=$request->input('is_video');  

        $testimonial->testimonial = $request->input('testimonial');
        $testimonial->modified_by = Auth::id();


        if ($testimonial->save()) {
            Session::flash('success', 'Guest book  edited  successfully');
            return redirect()->route('admin.testimonial.index');
        } else {
            Session::flash('error', 'Guest book  editing failed');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\News  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $banners = new Testimonial();

        $status=$banners->find($id);

        if($status['status']==1)
        {
            $status->status=0;

            if($status->save())
            {
               Session::flash('success','Guest book  disabled successfully ');
            }
        }
        else
        {
           $status->status=1;
            if($status->save())
            {
            Session::flash('success','Guest book  enabled successfully ');
            }
        }
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\News  $testimonial
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, $id = null)
    {
        $data = [];
        if (!$id) {
            return redirect()->back();
        }

        $banners = new Testimonial();

        $ar = explode(",", $id);

        foreach ($ar as $ar1) {
            $banner = $banners->findorfail($ar1);
            if (isset($banner->image)) {
                if (Storage::delete('public/testimonial/' . $banner->image));

            }
            if (isset($banner->file)) {
                if (Storage::delete('public/testimonial/' . $banner->file));

            }
            $banner->delete();

        }

        Session::flash('success', 'Guest book  deleted successfully');
        if ($request->ajax()) {
            return "AJAX";
        }
        return redirect()->back();


    }


    public function deleteimg(Request $request)
    {

     $id=$request->input('id');
     
        $banners= new Testimonial;
        $banner = $banners->findorfail($id);
        if(isset($banner->photo)){
            Storage::delete('public/testimonial/'.$banner->file);
                
            
            $banner->photo='';

                $banner->save();
     
        }
   
        Session::flash('success','File deleted successfully');  
        if($request->ajax()){
            return $banner;
        }
        return redirect()->back(); 
    }
}
