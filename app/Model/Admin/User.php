<?php

namespace App\Model\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use DB;

class User extends Authenticatable
{
    use Notifiable;

    public static function getAllUsers()
    {
        return DB::table('users as u')
                        ->leftJoin('usergroup as g', 'g.id', 'u.user_group_id')
                        ->select(
                            'u.id as id', 'u.name as name', 'u.status as status','u.person_name',
                            'g.name as group_name'
                        )
                        ->where('u.status', '<', 2)
                        ->get();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','person_name', 'password', 'user_group_id', 'phone', 'icon', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


}
