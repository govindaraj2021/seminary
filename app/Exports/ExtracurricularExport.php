<?php

namespace App\Exports;

use App\Model\Admin\Curricular;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExtracurricularExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.extracurricular', [
            'enquiries' => Curricular::all()
        ]);
    }
    public function collection()
    {
        return Curricular::all();
    }
}
