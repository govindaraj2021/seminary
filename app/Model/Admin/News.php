<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }

            /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getAll()
    {
        return $this::orderBy('id', 'DESC')->get();
    }
    
    protected $casts = [
        'date' => 'datetime:d/m/Y',
    ];
    public function images()
    {
        return $this->hasMany(NewsImage::class, 'page_id', 'id');
    }

    protected $table = 'news';
    protected $fillable = ['title','large_image','slug', 'priority','description', 'flash_news','date','video','status', 'created_at','updated_at', 'created_by', 'modified_by'];
}
