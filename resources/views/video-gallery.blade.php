@extends('layouts.main')
@section('title', 'Video Gallery')
@section('content')

    <section class="inner-banner">
        <div class="caption-wrapper">
            <div class="container">
                <div class="caption">
                    <h1>Video Gallery</h1>
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
                        <li>Video Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <section class="gallery-listing">
        <div class="container">
            <div class="cta-wrap mb-3 text-end">
                <a href="{{ route('photo-gallery') }}" class="btn btn-link">Photo Gallery</a>
            </div>
            <div class="row card-row">
                @foreach ($gallery as $video)
                    <div class="col-md-4">
                        <a data-fancybox="video-gallery" href="https://www.youtube.com/watch?v={{ $video->link }}"
                            data-caption="First Video" class="video-card">
                            <div class="card-image">
                                <img src="https://img.youtube.com/vi/{{ $video->link }}/hqdefault.jpg" alt="Image Caption">
                                <span class="card-icon">
                                    <i class="fa-duotone fa-play"></i>
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
                @if (empty($video))
                    Sorry! Currently, we don't have any updates. Please check back later
                @endif
                <div class="d-flex justify-content-center mt-4">
                    {!! $gallery->links() !!}
                </div>
            </div>
        </div>
    </section>

    @endforeach
