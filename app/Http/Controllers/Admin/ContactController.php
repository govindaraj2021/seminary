<?php

namespace App\Http\Controllers\Admin;
use App\Exports\ContactExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\Controller;
use App\Model\Admin\Contact;
use Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $contacts = new Contact();
        $contact = $contacts::orderBy('id', 'DESC')->get();
        $data['contacts'] = $contact;
        return view('admin.contact.list', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $enquiry = Contact::find($id);
        $enquiry->seen = 1;
        $enquiry->save();

        $data['enquiry'] = $enquiry;

        return view('admin.contact.show', $data);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(Request $request, $id = null)
    {
        $data = [];
        if (!$id) {
            return redirect()->back();
        }
        $contacts = new Contact();
        $ar = explode(",", $id);

        foreach ($ar as $ar1) {
            $contact = $contacts->findorfail($ar1);

            $contact->delete();
        }

        Session::flash('success', 'Enquiry deleted successfully');
        if ($request->ajax()) {
            return "AJAX";
        }
        return redirect()->back();
    }
    // public function export() 
    // {
    //     return Excel::download(new ContactExport, 'contact.xlsx');
    // }
}