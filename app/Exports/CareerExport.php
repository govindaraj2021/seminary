<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class CareerExport implements FromView
{
  use Exportable;
  /**
  * @return \Illuminate\Support\Collection
  */
  public function __construct($career)
  {
    $this->career = $career;
  }

  public function view(): View
  {
    return view('exports.career', ['enquiries'=>$this->career]);
  }
}
