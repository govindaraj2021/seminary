<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as InterImage;
use App\Model\Admin\Company;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class CompanyController extends Controller
{


    private $imageWidth = 300;
    private $imageHieght = 78;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new Company();
        $companies = $company::first();
        
        if($companies)
            return redirect()->route('admin.company.edit', $companies->id);
        
        return view('admin.company.create');
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
        $company = new Company();

        $this->validate($request, $this->rules(),$this->vaidateMsg);

    	$data['name']=$request->input('name');
    	$data['site']=$request->input('site');
    	$data['email']=$request->input('email');
    	$data['phone']=$request->input('phone');
    	$data['address']=$request->input('address');
    	$data['editted_by']=Auth::id();
        
        if($request->hasFile('icon'))
        {

      
            try 
            {
                $image = $request->file('icon');

                $file = $image->getClientOriginalName();

                $filename = pathinfo($file, PATHINFO_FILENAME);
                $extension = pathinfo($file, PATHINFO_EXTENSION);

                $file_name=date('d-m-y-h-s').'-'. $filename . '.' . $extension;

           

                $path = Storage::putFileAs(
                    'public/company', $image, $file_name
                );

                // return $path;

                // $img->save('storage/app/public/client/'.$file_name);

                }
                catch (Exception $e) 
                {
                    Session::flash('error','Somthing Went wrong can\'t store your file, please try again'); 
                    return redirect()->back();
                }
    
                $data['icon'] = $file_name;
            
        }


    	
        if ($company->create($data)) 
        {
         Session::flash('success','Company created successfully');
        }
    	
    	return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $data = [];

        $company = new Company();
        $data['company'] = $company::first();
        $data['updating'] = true;

        return view('admin.company.create', $data);
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

        $cmpny = new Company();
        $cmpny = $cmpny::find($id);
        
        $this->validate($request, $this->rules());

    	$cmpny->name=  $request->name;
    	$cmpny->site=  $request->site;
    	$cmpny->email=  $request->email;
    	$cmpny->phone=  $request->phone;
        $cmpny->address=  $request->address;
        // return  $request->file('image');
        if($request->hasFile('image'))
        {
 
        try 
        {
            $image = $request->file('image');

            $file = $image->getClientOriginalName();

            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);

            $file_name=date('d-m-y-h-s').'-'. $filename . '.' . $extension;

       

            $path = Storage::putFileAs(
                'public/company', $image, $file_name
            );

            // return $path;

            // $img->save('storage/app/public/client/'.$file_name);

            }
            catch (Exception $e) 
            {
                Session::flash('error','Somthing Went wrong can\'t store your file, please try again'); 
                return redirect()->back();
            }

            $cmpny->logo = $file_name;
        
        }

    	
        if ($cmpny->save()) 
        {
         Session::flash('success','Company profile updated successfully');
        }
    	
    	return redirect()->route('admin.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function rules(){
        return [
            'name' => 'required',
            'site' => 'required',
            'email' => 'required | email',
            'phone' => 'numeric',
            'address' => 'required',
            'image' => ' mimes:jpeg,bmp,png'
        ];
    }
    
    public function vaidateMsg()
{
    return [
    ];
}
    public function cropImage($image, $props){

        $file = $image->getClientOriginalName();

        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        $file_name=date('d-m-y-h-s').'-'. $filename . '.' . $extension;

        $props = json_decode($props, true);


        $img = InterImage::make($image);
        $img->crop((int)$props['width'], (int)$props['height'], (int)$props['x'], (int)$props['y']);
        $img->resize($this->imageWidth, $this->imageHieght);

        $img->save('storage/app/public/company/'.$file_name);

        return $file_name;
    }
}
