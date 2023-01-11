@extends('layouts.main')
@section('title', 'Photo Gallery')
@section('content')
    <section class="inner-banner">
        <div class="caption-wrapper">
            <div class="container">
                <div class="caption">
                    <h1>Gallery</h1>
                </div>
            </div>
        </div>
        <div class="banner-bg">
            <picture>
                @if (isset($page->large_image))
                    <img src="{{ asset('storage/app/public/page/' . $page->large_image) }}" alt="Image Caption">
                @else
                    <img src="{{ asset('assets/img/banner/default-banner.jpg') }}" alt="Image Caption">
                @endif
            </picture>
        </div>
        <div class="banner-log">
            <img src="./assets/img/label-icons/holy-cross.svg" alt="Holy Cross">
        </div>
    </section>
    <nav class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('index') }}">Home</a>
                        </li>
                        <li>Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <section class="gallery-listing">
        <div class="container">
            <div class="cta-wrap mb-3 text-end">
                <a href="{{ route('video-gallery') }}" class="btn btn-link">Video Gallery</a>
            </div>
            <div class="row card-row">
                @foreach ($gallery as $photo)
                    <div class="col-md-3">
                        <a href="{{ asset('storage/app/public/gallery/' . $photo->large_image) }}" data-fancybox="gallery"
                            data-caption="First image" class="gallery-card">
                            <div class="card-image">
                                <picture>
                                    <img src="{{ asset('storage/app/public/gallery/' . $photo->large_image) }}"
                                        alt="Image Caption">
                                </picture>
                                <span class="card-icon">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
