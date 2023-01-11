<?php

namespace App\View\Components\Admin;

use App\Model\Admin\Categories;
use App\Model\Admin\UserRight;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\View\Component;

class Menubar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    /**
     * The alert type.
     *
     * @var string
     */
    public $company_profile;

    public function __construct()
    {
        $user_id = Auth::user()->user_group_id;

        $this->company_profile =  $data['company_profile'] = UserRight::where('permission', 1)->where('menu_id', 10)->where('group_id', $user_id)->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.menubar');
    }
}
