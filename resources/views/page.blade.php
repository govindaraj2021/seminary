@extends('layouts.main')
@section('title', title_case($page->page_title))
@section('content')


<div class="page-banner">

    @if (isset($page->large_image))
    <img src="{{ asset('storage/app/public/page/' . $page->large_image) }}" alt="Image Caption">
    @else
    <img src="{{ asset('assets/img/banner/inner-banner.jpg') }}" alt="Image Caption">
    @endif

</div>
<div class="page-path">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul>
                    <li>
                        <a href="{{route('index')}}">Home</a>
                    </li>
                    <li>{{ $page->name }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="theme-title title-center">&nbsp;</div>
            </div>
        </div>
    </div>
</div>

{!! $page->description !!}

@endsection