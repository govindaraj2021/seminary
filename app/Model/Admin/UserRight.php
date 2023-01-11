<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

use DB;
use Auth;

class UserRight extends Model
{
    //
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

    protected $table = 'user_rights';
    protected $fillable = ['group_id', 'menu_id', 'permission','created_at', 'updated_at'];
}
