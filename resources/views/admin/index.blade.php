@extends('admin.layouts.main')

@section('title', 'Dashboard')


@section('content')


<div class="container">

  <div class="row">
    <div class="col-md-12">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading v_blue"> USER INFORMATION </div>
          <div class="panel-body">
            <table width="auto" border="0" class="table">
              {{-- <tr>
                <td class="home1">Username</td>
                <td class="dot1"> : </td>
                <td class="home2">{{
                  Auth::user()->name
                  }}</td>
              </tr> --}}
              <tr>
                <td class="home1"> Name</td>
                <td class="dot1"> : </td>
                <td class="home2">{{
                  Auth::user()->person_name
                  }}</td>
              <tr>
                <td class="home1">Phone</td>
                <td class="dot1"> : </td>
                <td class="home2">{{ Auth::user()->phone }}</td>
              </tr>
              <tr>
                <td class="home1">Email</td>
                <td class="dot1"> : </td>
                <td class="home2">{{ Auth::user()->email }}</td>
              </tr>
              </tr>

            </table>
            {{-- @foreach($users as $user)
            <ul>
              <li>name:{{ $user->name }}</li>
              <li>email:{{ $user->email }}</li>
            </ul>
            @endforeach --}}


            <div id="morris-line-chart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">

      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading ">Things to take care while using the website backend</div>
          <div class="panel-body">
            {{-- <p>For any queries contact <a href="http://sesametechnologies.net" target="_blank"><span
                  class="link1">Sesame Technologies Pvt. Ltd.</span></a><br> --}}
              <br> <span class="hd2">Please follow below listed instructions while uploading data :-</span> <br>
              Please use RGB images only.<br>
              Avoid use of special characters like " ' ( ) ; / \ : , etc.<br>
              Please try to upload images with the mentioned sizes and formats .<br>
              Otherwise it may cause site distortion.<br>
              For better performance use Mozilla Firefox.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading ">Contact Information</div>
          <div class="panel-body">
            <p><span class="hd">Sesame Technologies Private Limited.</span><br>
              {{-- Empora Gemz, Road, Kozhikode Bypass, Thondayad,<br> --}}
              #1712, 7th Floor, HiLITE Business Park, NH Bypass Road,<br>
              Kozhikode, Kerala 673014.<br>
              LandLine : +91 495 4017115<br>
              Mobile :+91 9072991155, +91 9349138146<br>
              Email : websupport@sesametechnologies.net<br>
              www.sesametechnologies.net</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection