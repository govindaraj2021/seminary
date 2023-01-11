<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as InterImage;
use App\Model\Admin\User;
use Session;
use Storage;
use App\Model\Admin\Usergroup;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [];

        $users = User::getAllUsers();

        $data['users'] = $users;

        return view('admin.user.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [];

        $usergroup = new Usergroup();    
        $usergroups = $usergroup->getActive();

        $data['usergroups'] = $usergroups;

        return view('admin.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user = new User();

        $this->validate($request, [
            'usergroup' => 'required',
            'name' => 'required | unique:users,name',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required | min:8',
            'person_name'=>'required',
            'image' => 'required|image',
            'image_props' => 'required'
        ], [
            'phone.numeric' => 'Enter the  valid phone number',
            'name.required' => 'Username is required',
            'person_name.required' => 'The Full name is required',
        ]);

        $data['user_group_id'] = $request->input('usergroup');
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['phone'] = $request->input('phone');
        $data['password'] = bcrypt($request->input('password'));
    	// data['->']icon=$request->input('icon');
        $data['status'] = '1';
        $data['person_name'] = $request->input('person_name');

       /* if($request->hasFile('icon'))
        {
            $image=$request->file('icon');
            echo $image;
        }exit;*/


        if ($request->hasFile('image')) {
            if (empty($request->input('image_props'))) {
                Session::flash('error', 'Somthing Went wrong can\'t store your file, please try again');
                return redirect()->back();
            }
            try {
                $image = $request->file('image');

                $file = $image->getClientOriginalName();

                $filename = pathinfo($file, PATHINFO_FILENAME);
                $extension = pathinfo($file, PATHINFO_EXTENSION);

                $file_name = date('d-m-y-h-s') . '-' . $filename . '.' . $extension;

                $props = json_decode($request->input('image_props'), true);


                $img = InterImage::make($image);
                $img->crop((int)$props['width'], (int)$props['height'], (int)$props['x'], (int)$props['y']);
                $img->resize(122, 54);
                $img->save('storage/app/public/profile/' . $file_name);

            } catch (Exception $e) {
                Session::flash('error', 'Somthing Went wrong can\'t store your file, please try again');
                return redirect()->back();
            }

            $data['icon'] = $file_name;

        }



        if ($user->create($data)) {
            Session::flash('success', 'User created successfully');
            redirect()->route('admin.user.index');
        }

        return redirect()->route('admin.user.index');

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
        $data = [];
        $users = new User;

        $user = $users->findOrFail($id);

        $usergroup = Usergroup::get();
        $data['user'] = $user;
        $data['updating'] = true;
        $data['usergroups'] = $usergroup;

        return view('admin.user.create', $data);
    }

    public function profile($id)
    {
        $data = [];
        
        $users = new User;
        
        //$user = $users->findOrFail($id);
        $user = $users->find($id);
        $usergroup = Usergroup::get();
        $data['user'] = $user;
        $data['updating'] = true;
        $data['usergroups'] = $usergroup;

        //return $data;
        return view('admin.user.profile', $data);
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
        //
        $data = [];
        $users = new User;

          

        $user = $users->findOrFail($id);

        if ($request->isMethod('PUT')) {
            $this->validate($request, [
                'usergroup' => 'required',
                'phone' => 'numeric',
                'image' => 'image',
                'password' => 'min:8',
                'email' => 'required',
                'person_name'=>'required',
            ], [
                'phone.numeric' => 'Enter the valid phone numbre',
                'person_name.required' => 'The full name field is required',
            ]);

            $user->user_group_id = $request->input('usergroup');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->person_name = $request->input('person_name');



            if (!empty($request->input('password')))
                $user->password = Hash::make($request->input('password'));

            if ($request->hasFile('image')) {
                try {
                    if (!empty($user->icon)) {
                        Storage::delete('public/profile/' . $user->icon);
                    }

                    $image = $request->file('image');

                    $file = $image->getClientOriginalName();

                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);

                    $file_name = date('d-m-y-h-s') . '-' . $filename . '.' . $extension;

                    $props = json_decode($request->input('image_props'), true);


                    $img = InterImage::make($image);
                    $img->crop((int)$props['width'], (int)$props['height'], (int)$props['x'], (int)$props['y']);
                    $img->resize(200, 200);
                    $img->save('storage/app/public/profile/' . $file_name);


                } catch (Exception $e) {
                    Session::flash('error', 'Somthing Went wrong can\'t store your file, please try again');
                    return redirect()->back();
                }

                $user->icon = $file_name;

            }


            if ($user->save()) {
                Session::flash('success', 'User Updated successfully');
            }

            //return redirect()->route('admin.user.index');
            if($request['profile']=="Yes")
            {
                return redirect()->route('admin.user.profile', ['id' => $id]);    
            }
            else
            {
                return redirect()->route('admin.user.index');    
            }
            

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $user=new User();
    //     $status=$user->find($id);
    //     try {
    //         Storage::delete('public/profile/'.$status->icon);
    //         if($status->delete())
    //         {
    //             Session::flash('success','User deleted successfully');  
    //         }
            
    //     } catch (Exception $e) {
            
    //     }

    //     return redirect()->route('admin.user.index');
    // }
    public function destroy(Request $request, $id = null)
    {
        $data = [];
        if (!$id) {
            return redirect()->back();
        }

        $users = new User();

 
    //    if(is_array($id)) {
        $ar = explode(",", $id);

        foreach ($ar as $ar1) {
            $user = $users->findorfail($ar1);
            if (isset($user->icon)) {
                Storage::delete('public/profile/' . $user->icon);
            }
            $user->delete();

        }

        Session::flash('success', 'User account deleted successfully');
        if ($request->ajax()) {
            return "AJAX";
        }
        return redirect()->back();
   
    // }
    // $banner = $banners->findorfail($id);
    //     try {
    //         Storage::delete('public/banner/'.$banner->banner);
    //         if($banner->delete())
    //         {
    //             Session::flash('success','Banner Image deleted successfully');  
    //         }
            
    //     } catch (Exception $e) {
            
    //     }

    //     return redirect()->back();
    }
    public function status($id)
    {
        $user = new User();
        $status = $user->find($id);
        if ($status['status'] == 1) {
            $status->status = 0;
            if ($status->save()) {
                Session::flash('success', 'User Disabled successfully');
            }
        } else {
            $status->status = 1;
            if ($status->save()) {
                Session::flash('success', 'User Enabled successfully');
            }
        }


        return redirect()->route('admin.user.index');
    }
}
