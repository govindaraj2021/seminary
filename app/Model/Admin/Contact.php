<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    public function getAll($page_id)
    {
        return $this::where('page_id', '=', $page_id)->get();
    }

    public function getById($id){
        return $this::find($id);
    }
    public static function getByPageId($id){
        return Page::where('id','=',$id)->first();
    }
    public function getByPermission($permission_id, $page_id){
        return $this::where([
                ['page_id', '=', $page_id],
                ['permission_id', '=', $permission_id]
            ])->get();
    }

    public function isExist($page_id, $permission_id){
        return $this::where([
            ['page_id', '=', $page_id],
            ['permission_id', '=', $permission_id]
        ])->exists();
    }
    protected $table = 'contact';
    protected $fillable = ['name' ,'phone','product_name','pet_id','type','email', 'subject', 'date','message', 'created_at', 'updated_at','page_id','permission_id'];

}
