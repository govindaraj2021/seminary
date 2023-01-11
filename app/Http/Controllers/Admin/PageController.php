<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Hash;

use App\Model\Admin\Menu;
use App\Model\Admin\Position;
use App\Model\Admin\Page;
use Intervention\Image\ImageManagerStatic as InterImage;



class PageController extends Controller
{

    public function create()
    {
        $data = [];

        $data['pages'] = Menu::getFrontendNavMenu();
        $data['position'] = Position::all();
       

        return view('admin.page.create', $data);
    }

    public function store(Request $request)
    {
        $data = [];
        $page = new Page();

        $this->validate($request, [
            'position' => 'required',
            'page_title' => 'required',
            'name' => 'required',
            'url' => 'required',
            'priority' => 'sometimes|nullable|integer',
        ]);


        if (!empty($request->file('original_file'))) {
            $original_img = $request->file('original_file');
            $file = $original_img->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $file_name = date('d-m-y-h-s') . '-' . $filename . '.' . $extension;
            $props = json_decode($request->input('thumbnail'), true);
            $img = InterImage::make($original_img);
            $img->crop((int)$props['width'], (int)$props['height'], (int)$props['x'], (int)$props['y']);
            $img->resize(1600, 300);
            $img->save('storage/app/public/page/' . $file_name);
            $data['large_image'] = $file_name;
        }
        $data['position_id'] = $request->input('position');
        $data['parent_id'] = $request->input('parent_id');
        $data['name'] = $request->input('name');
        $data['page_title'] = $request->input('page_title');
        $data['url'] = strtolower($request->input('url'));
        $data['description'] = $request->input('description');
        $data['meta_title'] = $request->input('meta_title');
        $data['meta_keyword'] = $request->input('meta_keyword');
        $data['meta_description'] = $request->input('meta_description');
        $data['priority'] = $request->input('priority');
        $data['status'] = '1';
        if ($page->create($data)) {
            Session::flash('success', 'Page created successfully');
        }

        return redirect()->route('admin.page.create');
    }


    public function index()
    {
        $data = [];
        $page = new Page;

        $pages = $page->getAllPages();

        $data['pages'] = $pages;
        return view('admin.page.list', $data);
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
        $page = new Page;
        $pages = $page->getById($id);
        $position = Position::all();
        $data['updating'] = true;
        $data['position'] = $position;
        $data['pages'] = Menu::getFrontendNavMenu();
        $data['page'] = $pages;
        return view('admin.page.create', $data);
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
        $pages = new Page;
        $page = $pages->findOrFail($id);
        $this->validate(
            $request,
            [
                'position' => 'required',
                'page_title' => 'required',
                'name' => 'required',
                'url' => 'required',
                'priority' => 'sometimes|nullable|integer',
            ],
            [
                'url.regex' => 'only contain alphabets and hyphen'
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
            $img->resize(1600, 300);
            $img->save('storage/app/public/page/' . $file_name);
            $page->large_image = $file_name;
        }



        $page->position_id = $request->input('position');
        $page->parent_id = $request->input('parent_id');
        $page->name = $request->input('name');
        $page->page_title = $request->input('page_title');
        $page->url = strtolower($request->input('url'));
        $page->description = $request->input('description');
        $page->meta_title = $request->input('meta_title');
        $page->meta_keyword = $request->input('meta_keyword');
        $page->meta_description = $request->input('meta_description');
        $page->priority = $request->input('priority');
        $page->status = '1';

        $position = Position::all();


        if ($page->save()) {
            Session::flash('success', 'Page updated successfully');
            redirect()->route('admin.page.index');
        } else {
            return $request;
        }


        return redirect()->route('admin.page.index');
    }

    public function status($id)
    {
        $page = new Page();
        $status = $page->find($id);
        if ($status['status'] == 1) {
            $status->status = 0;
            if ($status->save()) {
                Session::flash('success', 'Page Disabled successfully');
            }
        } else {
            $status->status = 1;
            if ($status->save()) {
                Session::flash('success', 'Page Enabled successfully');
            }
        }


        return redirect()->route('admin.page.index');
    }


    public function destroy(Request $request, $id = null)
    {

        $data = [];
        if (!$id) {
            return redirect()->back();
        }

        $pages = new Page();


        //    if(is_array($id)) {
        $ar = explode(",", $id);

        foreach ($ar as $ar1) {
            $page = $pages->findorfail($ar1);

            $page->delete();
            Session::flash('success', 'page deleted successfully');
        }


        if ($request->ajax()) {
            return "AJAX";
        }
        return redirect()->back();
    }
}
