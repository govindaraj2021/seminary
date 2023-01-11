<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //

    public static function get()
    {
        return Company::first();
    }

    protected $table = 'company';
    protected $fillable = ['name', 'site', 'email', 'phone', 'address', 'logo','created_at','updated_at', 'editted_by'];

}