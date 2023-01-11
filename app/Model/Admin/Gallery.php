<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery'; 
    protected $fillable = ['title','large_image','link','gallery_status','description', 'priority', 'status','created_at', 'created_by','updated_at', 'modified_by'];
}
