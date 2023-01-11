@extends('admin.layouts.main') 
@section('title','Contact Enquiry')



@section('content')
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            {{-- <a href="{{ route('admin.page.index', $page_id) }}" class="btn btn-primary">Page List</a> --}} {{-- <a href="{{ route('admin.contact.list', ['page_id' => $page_id,'permission_id' => $permission_id]) }}"
                class="btn btn-primary">Add New</a> --}}
            <a href="{{ URL::previous() }}" class="btn btn-primary">
      <span>back</span>
            </a>
        </div>

        <h2 class="panel-title">Contact Enquiry</h2>

    </header>
    <div class="panel-body">

        <div class="row ">
            <div class="col-lg-12 alg_center">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="for-code"><strong>Name : </strong></label> {{ $enquiry->name }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="for-code"><strong>Email : </strong></label> @if($enquiry->email){{ $enquiry->email }} @else Not Provided @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="for-code"><strong>Phone : </strong></label> {{ $enquiry->phone }}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="for-code"><strong>Message : </strong></label> {{ $enquiry->message }}
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection