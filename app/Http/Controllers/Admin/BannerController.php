<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as InterImage;
use App\Model\Admin\Banner;
use Session;
use Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $banner = new Banner();
        $banners = $banner->orderBy('id', 'DESC')->get();
        $data['banners'] = $banners;
        return view('admin.banner.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $banners = new Banner();
        $data['banner'] = $banners;
        return view('admin.banner.create', $data);
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
        $banner = new Banner();
        $this->validate(
            $request,
            [
                'original_file' => 'required|image',
                'original_file_mobile' => 'required|image',
                'name' => 'required'
            ],
            [
                'original_file.required' => 'The banner image field is required.',
                'original_file_mobile.required' => 'The  Mobile banner image field is required.',
                'name.required' => 'Title field is required.'
            ]
        );

        if (!empty($request->file('original_file'))) {
            $original_img = $request->file('original_file');
            $file = $original_img->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $filename = $this->clean($filename);
            $file_name = date('d-m-y-h-s') . '-' . $filename . '.' . $extension;
            $props = json_decode($request->input('image_props'), true);
            $img = InterImage::make($original_img);
            $img->crop((int) $props['width'], (int) $props['height'], (int) $props['x'], (int) $props['y']);
            $img->resize(1920, 1080);
            $img->save('storage/app/public/banner/' . $file_name);
            $data['large_image'] = $file_name;
        }

        if (!empty($request->file('original_file_mobile'))) {
            $original_img = $request->file('original_file_mobile');
            $file = $original_img->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $filename = $this->clean($filename);
            $file_name = date('d-m-y-h-s') . '-mobile' . $filename . '.' . $extension;
            $props = json_decode($request->input('image_props_mobile'), true);
            $img = InterImage::make($original_img);
            $img->crop((int) $props['width'], (int) $props['height'], (int) $props['x'], (int) $props['y']);
            $img->resize(375, 700);
            $img->save('storage/app/public/banner/' . $file_name);
            $data['large_image_mobile'] = $file_name;
        }
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        if ($banner->create($data)) {
            Session::flash('success', 'Banner created successfully');
            return redirect()->route('admin.banner.index');
        }
        Session::flash('error', 'Somthing Went to wrong');
        return redirect()->back();
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
        $banners = new Banner();
        $banner = $banners->findOrFail($id);
        $data['banner'] = $banner;
        $data['updating'] = true;
        return view('admin.banner.create', $data);
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
        $banners = new Banner();
        $banner = $banners->findOrFail($id);
        $this->validate(
            $request,
            [
                'name' => 'required'
            ],
            ['original_file.required' => 'The banner image field is required.', 'original_file_mobile.required' => 'The Mobile banner image  field is required.', 'name.required' => 'Title field is required']
        );

        if (!empty($request->file('original_file'))) {
            $original_img = $request->file('original_file');
            $file = $original_img->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $filename = $this->clean($filename);
            $file_name = date('d-m-y-h-s') . '-' . $filename . '.' . $extension;
            $props = json_decode($request->input('image_props'), true);
            $img = InterImage::make($original_img);
            $img->crop((int) $props['width'], (int) $props['height'], (int) $props['x'], (int) $props['y']);
            $img->resize(1920, 1080);
            $img->save('storage/app/public/banner/' . $file_name);
            $banner->large_image = $file_name;
        }
        if (!empty($request->file('original_file_mobile'))) {
            $original_img = $request->file('original_file_mobile');
            $file = $original_img->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $filename = $this->clean($filename);
            $file_name = date('d-m-y-h-s') . '-mobile' . $filename . '.' . $extension;
            $props = json_decode($request->input('image_props_mobile'), true);
            $img = InterImage::make($original_img);
            $img->crop((int) $props['width'], (int) $props['height'], (int) $props['x'], (int) $props['y']);
            $img->resize(375, 700);
            $img->save('storage/app/public/banner/' . $file_name);
            $banner->large_image_mobile = $file_name;
        }
        $banner->name = $request->input('name');
        $banner->description = $request->input('description');
        if ($banner->save()) {
            Session::flash('success', 'Banner Updated successfully');
            return redirect()->route('admin.banner.index');
        }
        return redirect()->back();
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
        $banners = new Banner();
        $ar = explode(",", $id);
        foreach ($ar as $ar1) {
            $banner = $banners->findorfail($ar1);
            if (isset($banner->large_image)) {
                Storage::delete('public/banner/' . $banner->large_image);
            }
            $banner->delete();
        }
        Session::flash('success', 'Banner deleted successfully');
        if ($request->ajax()) {
            return "AJAX";
        }
        return redirect()->back();
    }

    public function status($id)
    {
        $banners = new Banner();
        $status = $banners->find($id);
        if ($status['status'] == 1) {
            $status->status = 0;
            if ($status->save()) {
                Session::flash('success', 'Banner disabled successfully');
            }
        } else {
            $status->status = 1;
            if ($status->save()) {
                Session::flash('success', 'Banner enabled successfully');
            }
        }
        return redirect()->back();
    }

    public function rules()
    {
        return [
            'banner' => 'required',
            'banner.*' => 'mimes:jpeg,bmp,png',
            'props' => 'required',
        ];
    }

    public function cropImage($image, $props)
    {
        $file = $image->getClientOriginalName();
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $file_name = date('d-m-y-h-s') . '-' . $filename . '.' . $extension;
        $props = json_decode($props, true);
        $img = InterImage::make($image);
        $img->crop((int) $props['width'], (int) $props['height'], (int) $props['x'], (int) $props['y']);
        $img->resize($this->imageWidth, $this->imageHieght);
        $img->save('storage/app/public/banner/' . $file_name);
        return $file_name;
    }

    function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}