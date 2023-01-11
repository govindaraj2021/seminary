<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{


    
    public function getById($id){
        return $this::where('id', $id)->first();
    }


    public function getAllPages()
    {
        return DB::table('page as p')
            ->leftJoin('position as pos', 'pos.id', 'p.position_id')
            ->select(
                'p.id as id', 'p.name as name', 'p.name as name', 'p.status as status',
                'pos.name as position_id'
            )
            ->where([
                ['p.status', '<', 2]
            ])
            // ->whereNotIn('p.url',['contact','#','news','packages','testimonials','photos','videos','experience/birds-and-animal-watching','experience/activity-and-adventures','experience/nearby-tourist-spots',
             ->whereNotIn('p.url',['contact','#','packages','photos','videos','experience/birds-and-animal-watching','experience/activity-and-adventures','experience/nearby-tourist-spots',
            'reservation','photos','videos'
            ])
            ->get();

    }

    public function getPageMeta($url){
        $res = DB::table('page as p')
            ->select(
                'p.meta_title as meta_title', 'p.meta_keyword as meta_keyword', 'p.meta_description as meta_description'
            )
            ->where([
                ['p.url', '=', $url]
            ])
            ->first();

        return $res;
    }

    public function modelGetByUrl($page_url_name){
       
        return DB::table('page')
        ->where('url','=',$page_url_name)
        ->select(
            'meta_description', 'meta_title', 'meta_keyword'
           
        )
        ->where([
            ['status_id', '<', 2]
        ])
        ->get();
    
    }


    protected $table ='page';
    protected $fillable = ['position_id', 'parent_id', 'name', 'page_title', 'subtitle','url', 'description', 'meta_title','meta_keyword', 'meta_description', 'status','priority','updated_at', 'created_by', 'modified_by','id','large_image'];

}
