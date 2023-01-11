<?php

namespace App\View\Components;

use App\Model\Admin\News;
use Illuminate\View\Component;

class FlashNews extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $flash_news;

    public function __construct()
    {
        $this->flash_news = News::where('status', 1)->where('flash_news',1)->orderby('priority','asc')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.flash-news');
    }
}
