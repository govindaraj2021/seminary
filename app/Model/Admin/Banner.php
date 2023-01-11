<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    
    public function getAll()
    {
        return $this::get();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getAllById($id)
    {
        return $this::where('id', '=', $id)->get();
    }

    public function updateTitle($title, $page_id)
    {
        $this::where('page_id', $page_id)
                ->update(['title' => $title]);

        return true;
    }

    protected $table ='banner';
    protected $fillable = ['id', 'name', 'button_link','large_image','large_image_mobile','description', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'];

}
