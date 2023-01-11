<?php

namespace App\Http\Controllers;

use App\Model\Admin\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\Testimonial as AppTestimonial;
use App\Model\Admin\Testimonial;
use Illuminate\Support\Facades\Auth;
use App\Model\Admin\Company;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class TestimonialController extends Controller
{
    public function index(){
        $data = [];
        $data['page'] = Page::where('status',1)->where('url',basename(url()->current()))->select('large_image')->orderBy('id', 'desc')->first();
         $data['testimonials'] = Testimonial::where('status', 1)->orderBy('id', 'DESC')->paginate(6);

        return view('testimonial', $data);
    }


    public function send(Request $request){
    
        $data = [];
        $testimonial= new Testimonial;
        if ($request->isMethod('post')) {
            $request->validate(
                [
                    'name' => 'required | max:255',
                    'testimonial' => 'max:500',
                    'g-recaptcha-response' => 'required|captcha'
                ]
            );
            $original_img = $request->file('photo');
            if ($request->hasFile('photo')) {
                $file1 = $original_img->getClientOriginalName();
                $file_name1 = date('d-m-y-h-s') . '-' . $file1;
                $request->file('photo')->move("storage/app/public/testimonial/", $file_name1);
                $data['photo'] = $file_name1;
            }
            $data['name'] = $request->input('name');
            $data['testimonial'] = $request->input('testimonial');
            $data['is_video'] = 0;
            $data['status'] = 0;
            $data['created_by'] = Auth::id();
            $data['modified_by'] = Auth::id();
            $data['email'] = "nomail@gmail.com";

            if ($testimonial->create($data)) {
               
                $this->sendmailC($data);
                return 1;
            }
            return redirect()->back();
        }

        return view('testimonial', $data);
    }

    public function sendmailC($data = null)
    {
        $company_email = Company::get()->email;
        Mail::to($company_email)->send(new AppTestimonial($data));
    }





}