<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Model\Admin\Page;

class Menu extends Component
{

    /**
     * The alert type.
     *
     * @var string
     */

    public $menu;
    public $submenu;

    public function __construct()
    {
        $page = Page::select('parent_id')->where('status', 1)->where('url', basename(request()->path()))->first();
        if ($page) {
            $this->menu = Page::where('status', 1)->where('id', $page->parent_id)->first();
            $this->submenu = Page::where('status', 1)->where('parent_id', $page->parent_id)->where('parent_id','!=',0)->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu');
    }
}
