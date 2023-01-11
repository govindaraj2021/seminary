<?php

namespace App\View\Components;

use App\Model\Admin\Gallery as Galleries;
use Illuminate\View\Component;

class Gallery extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $galleries;

    public function __construct()
    {
        $this->galleries = Galleries::where('status', 1)->latest()->take(6)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.gallery');
    }
}
