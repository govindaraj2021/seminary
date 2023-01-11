<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class Menu extends Model
{

    // generation menu 
    public static function getAllMenus()
    {


        $menus = DB::table('menu as m')
                        ->leftJoin('menu as child_menu', function($join){
                            $join->on('child_menu.parent_id', '=','m.id')
                                ->where('child_menu.parent_id', '>', 0);
                        })
                        ->leftJoin('user_rights as r', function ($join){
                            $join->on('r.menu_id', '=','m.id')
                                 ->where([
                                     ['r.group_id', '=', Session::get('user_id')],
                                     ['r.permission', '=', 1]
                                 ]);
                        })
                        ->select(
                                'm.name as parent_menu', 'm.id as parent_id', 'm.url as parent_url', 'm.icon_class as parent_icon',  
                                'child_menu.id as child_id','child_menu.name as child_menu', 'child_menu.url as child_url', 'child_menu.icon_class as child_icon'
                            )
                        ->where([
                            ['m.parent_id', '=', 0],
                            ['m.status', '=', 1 ]
                        ])
                        ->orderby('m.priority')
                        ->get();
        return $menus;
    }

   
    public static function findSubMenu($page)
    {
        $page_sub_menu = DB::table('page as p')
                    ->where([
                        ['parent_id','=', $page->id],
                        ['status', '=', 1],
                    ])
                    ->select('id','name','url')
                    ->orderBy('priority')
                    ->get();

        return $page_sub_menu;
    }

    public static function getFrontendNavMenu()
    {
        $page_menus = DB::table('page as p')
                    ->where([
                        ['position_id', '=', 1],
                        ['status', '=', 1],
                        ['parent_id', '=', 0],
                    ])
                    ->select('id','name','url')
                    ->orderBy('priority')
                    ->get();

        foreach($page_menus as $key => $page_menu) {
            $page_menus[$key]->submenus = static::findSubMenu($page_menu);
        }
        return $page_menus;
    }
    public static function getFrontendFooterNavMenu()
    {
        $page_menu = DB::table('page as p')
                    ->where([
                        ['position_id', '=', 2],
                        ['status', '=', 1],
                        ['parent_id', '=', 0],
                       
                    ])
                    ->whereNotIn('url',['achievements','csr-activities','news'])
                    ->select('id','name','url')
                    ->orderBy('priority')
                    ->get();

        return $page_menu;
    }

    public static function getAllParentMenus()
    {

        $user = Auth::user();

        return DB::table('menu as m')
                    ->leftJoin('user_rights as r', function ($join){
                        $join->on('r.menu_id', '=','m.id')
                            ->where([
                                ['r.permission', '=', 1]
                            ]);
                    })
                    ->select(
                        'm.*',
                        'r.group_id'
                        )
                    ->where([
                        ['m.parent_id', '=', 0],
                        ['r.group_id', '=', $user->user_group_id]
                    ])

                    // menu hide company profile start 
                    ->where([
                        ['m.id', '!=', 10]
                    ])
                    // menu hide company profile end 

                    ->orWhere([
                            ['permission_applicable', '=', 0]
                        ])
                    ->orderBy('m.priority')
                    ->distinct()
                    ->get();
    }

    public static function getAllSubMenus()
    {
        

        return DB::table('menu as m')
                    ->leftJoin('user_rights as r', function ($join){
                        $join->on('r.menu_id', '=','m.id')
                            ->where([
                                ['r.permission', '=', 1]
                            ]);
                    })
                    ->select(
                        'm.*',
                        'r.group_id'
                        )
                    ->where('m.parent_id', '>', 0)
                    ->orderBy('m.priority')
                    ->get();
    }

    //for comapny details
    public static function company()
    {
        return DB::table('company')
                        ->first();
    }

    public function getMenus()
    { 
        return $menus = DB::table('menu as m')
                        ->select(
                            'm.name','m.id'
                        )
                        ->where([
                            ['m.parent_id', '=', 0],
                            ['m.permission_applicable', '=', 1]])
                            ->orderBy('priority','asc')
                        ->get();
    }

    public function getUserRightsByUsergroup($usergroup_id)
    {
        return DB::table('menu as m')
                        ->leftJoin('user_rights as r', 'r.menu_id', 'm.id')
                        ->select(
                            'm.name', 'm.id',
                            'r.permission'
                        )
                        ->where([
                            ['r.group_id', '=', $usergroup_id],
                            ['r.permission', '=', 1]
                        ])
                        ->get();
    }

    public function hasPermission($user_group_id, $menu_id)
    {
        return $menu = DB::table('user_rights')
                        ->where([
                            ['group_id', '=', $user_group_id],
                            ['menu_id', '=', $menu_id]
                        ])
                        ->select('permission')
                        ->first();
    }

    public static function getUserHasRight($route_name)
    {
        $route_name_ex = explode('.', $route_name);
        // return $route_name;
        $group_id = Auth::user()->user_group_id;

        if(count($route_name_ex) > 1 )
        {
            //child routes
            $permission = DB::table('menu as m')
                ->leftJoin('user_rights as r', function ($join) use ($group_id){
                    $join->on('r.menu_id', '=','m.parent_id')
                        ->where([
                            ['r.permission', '=', 1],
                            ['r.group_id', '=', $group_id]
                        ]);
                })
                ->select('m.*', 'r.group_id as g_id', 'r.menu_id as m_id')
                ->where([
                        ['url', '=', $route_name],
                        ['r.group_id', '=', $group_id]
                    ])
                ->get();

        }else{
            //parent routes
            $permission = DB::table('menu as m')
                ->leftjoin('user_rights as r', function ($join) use ($group_id){
                    $join->on('r.menu_id', '=','m.id')
                        ->where([
                            ['r.permission', '=', 1],
                            ['r.group_id', '=', $group_id]
                        ]);
                })
                ->select('m.*', 'r.group_id as g_id', 'r.menu_id as m_id')
                ->where([
                    ['url', '=', $route_name],
                    ])
                ->Orwhere([
                    ['permission_applicable', '!=', 1],
                    ])
                ->get();
        }

        return $permission;

        if(!empty($permission[0]))
        {
            return true;
        }else
        {
            return false;
        }

    }

    protected $table='menu';
}
