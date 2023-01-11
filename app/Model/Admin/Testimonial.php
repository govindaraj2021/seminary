<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';
    protected $fillable = [
        'name', 'photo', 'slug','status', 'testimonial','link','created_by', 'modified_by'
    ];

}
