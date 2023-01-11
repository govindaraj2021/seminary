<?php

namespace App\Exports;

use App\Model\Admin\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ContactExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.contact', [
            'enquiries' => Contact::all()
        ]);
    }
    public function collection()
    {
        return Contact::all();
    }
}
