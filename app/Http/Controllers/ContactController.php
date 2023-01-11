<?php

namespace App\Http\Controllers;

use App\Mail\Contact as AppContact;
use App\Model\Admin\Company;
use App\Model\Admin\Contact;
use App\Model\Admin\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $data = [];
        $data['page'] = Page::where('status', 1)->where('url', basename(url()->current()))->select('large_image')->orderBy('id', 'desc')->first();
        return view('contact-us',$data);
    }

    public function send(Request $request)
    {
        $data = [];
        $contact = new Contact;
        if ($request->isMethod('post')) {
            $request->validate(
                [
                    'name' => 'required | max:50',
                    'message' => 'max:500',
                    'phone' => 'required|max:14',
                    'g-recaptcha-response' => 'required|captcha'
                ]
            );
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['message'] =  $request->message;
            if ($contact->create($data)) {
                $this->sendmailC($data);
                return 1;
            }
            return redirect()->back();
        }

        return view('contact-us', $data);
    }


    public function sendmailC($data = null)
    {
        $company_email = Company::get()->email;
        Mail::to("$company_email")->send(new AppContact($data));
    }
}
