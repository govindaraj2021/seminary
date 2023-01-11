<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Freshbitsweb\Laratables\Laratables; //datatable

use App\Model\Admin\Usergroup; // user group model
use App\Model\Admin\Menu;
use App\Model\Admin\UserRight;
use DB;

class UsergroupController extends Controller
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
        $usergroup = new Usergroup;

        $usergroups = $usergroup->getAll();

        $data['usergroups'] = $usergroups;

        return view('admin.usergroup.list', $data);
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

        return view('admin.usergroup.index', $data);
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
        $usergroup = new Usergroup;
        $request->validate([
            'name' => 'required|unique:usergroup',
        ]);

        $data['name'] = $request->input('name');

        if ($usergroup->create($data)) {
            Session::flash('success', 'Usergroup created successfully');
        }

        return redirect()->route('admin.usergroup.create');

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
        $updating = true;
        $usergroup = new Usergroup;

        $data['usergroup'] = $usergroup->getById($id);
        $data['updating'] = $updating;

        return view('admin.usergroup.index', $data);
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
        $usergroup = new Usergroup;
        $usergroup = $usergroup->getById($id);

        if ($request->isMethod('PUT')) {
            $request->validate([
                'name' => 'required|unique:usergroup,name,'.$id.',id',
            ]);

            $usergroup->name = $request->input('name');

            if ($usergroup->save()) {
                Session::flash('success', 'Usergroup updated successfully');
            } else {
                Session::flash('error', 'Usergroup updation faild');
            }

        }

        return redirect()->route('admin.usergroup.index');
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
        $usergroup = new Usergroup();
        $status = $usergroup->getById($id);
        $is_exists_users = $status->modelIsUsersExist($id);
        if ($is_exists_users == true) {
            Session::flash('error', 'Cant Delete ! User Exists Under This Group');

        } else {





            $status->delete();
            Session::flash('success', 'Usergroup deleted successfully');




        }



        return redirect()->route('admin.usergroup.index');

    }

    public function status($id)
    {
        $usergroup = new Usergroup();

        $status = $usergroup->getById($id);

        if ($status['status'] == 1) {
            $status->status = 0;
            if ($status->save()) {
                Session::flash('success', 'Usergroup Disabled successfully');
            }
        } else {
            $status->status = 1;
            if ($status->save()) {
                Session::flash('success', 'Usergroup Enabled successfully');
            }
        }


        return redirect()->route('admin.usergroup.index');
    }

    public function permission($id, Request $request)
    {

        $menu = new Menu;
        $data = [];

        $menus = $menu->getMenus();

        if ($request->isMethod('post')) {
            $user_right = new UserRight();
            $permissions = $request->input('menu_id') ? $request->input('menu_id') : [];

            foreach ($menus as $m) {
                $flag = 1;

                foreach ($permissions as $permission) {

                    if ($m->id == $permission) {
                        if ($menu->hasPermission($id, $permission)) {
                            DB::table('user_rights')
                                ->where([
                                    ['group_id', '=', $id],
                                    ['menu_id', '=', $permission]
                                ])
                                ->update(['permission' => 1]);
                            $flag = 0;
                            break;
                        } else {

                            $data['group_id'] = $id;
                            $data['menu_id'] = $permission;
                            $data['permission'] = 1;
                            $user_right->create($data);
                            $flag = 0;
                            break;
                        }
                    }

                }
                if ($flag) {
                    if ($menu->hasPermission($id, $m->id)) {
                        DB::table('user_rights')
                            ->where([
                                ['group_id', '=', $id],
                                ['menu_id', '=', $m->id]
                            ])
                            ->update(['permission' => 0]);
                        $flag = 0;
                    } else {
                        $data['group_id'] = $id;
                        $data['menu_id'] = $m->id;
                        $data['permission'] = 0;
                        $user_right->create($data);
                        $flag = 0;
                    }
                }
                Session::flash('success', 'User group permission successfully Updated');
                // return redirect()->route('admin.usergroup.index');
            }
        }



        $user_rights = $menu->getUserRightsByUsergroup($id);

        $data['group_id'] = $id;
        $data['menus'] = $menus;
        $data['user_rights'] = $user_rights;

        // return $data;

        return view('admin.usergroup.user-right', $data);
        // return redirect()->route('admin.usergroup.index');
    }
}
