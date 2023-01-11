<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class AdmissionExport implements FromView
{
  use Exportable;
  /**
  * @return \Illuminate\Support\Collection
  */
  public function __construct($admission)
  {
    $this->admission = $admission;
  }

  public function view(): View
  {
    return view('exports.admission', ['admissions'=>$this->admission]);
  }
}
