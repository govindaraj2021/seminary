<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Usergroup extends Model
{
    //
    protected $table = 'usergroup';
    protected $fillable = ['name', 'status', 'created_at', 'updated_at'];

    public function getAll()
    {
        return $this::where('status', '<>', 2)->get();
    }
    public function getActive()
    {
        return $this::where('status', '=', 1)->get();
    }
    public function modelIsUsersExist($id)
    {
        $exists = User::where(['user_group_id' => $id])->exists();

        if ($exists) {
            return true;
        } else {
            return false;
        }
    }
    public function getById($id)
    {
        return $this::findorfail($id);
    }
}
