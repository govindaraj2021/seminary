<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Model\Admin\News as Newses;


class News extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $newses;

    public function __construct()
    {

      
        $this->newses=Newses::where('status',1)->orderBy('priority','ASC')->get();
    
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.news');
    }
}
