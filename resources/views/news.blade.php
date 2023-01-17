@extends('layouts.main')
@section('title', 'News')
@section('content')

    <section class="inner-banner">
        <div class="caption-wrapper">
            <div class="container">
                <div class="caption">
                    <h1>News</h1>
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
                        <li>News</li>
                    </ol>
                </div>
            </div>
        </div>
    </nav>
    <section class="news-listing">
        <div class="container">
            <div class="row card-row">
                @foreach ($newses as $news)
                    <div class="col-md-4">
                        <a href="{{ route('news.show', $news->slug) }}" class="news-card">
                            <div class="card-image">
                                <picture>
                                    @if (isset($news->large_image))
                                        <img src="{{ asset('storage/app/public/news/' . $news->large_image) }}"
                                            alt="Alphonsa English Medium School">
                                    @else
                                        <img src="{{ asset('assets/img/default-img/news-default.jpg') }}"
                                            alt="Image Caption">
                                    @endif
                                </picture>
                                <div class="news-date">
                                    <span class="month">{{ date('M ', strtotime($news->date)) }}</span>
                                    <span class="date">{{ date('d ', strtotime($news->date)) }}</span>
                                </div>
                            </div>
                            <div class="card-content">
                                <h4>{{ $news->title }}</h4>
                                <p>{!! $news->description !!}</p>
                                <button type="button" class="btn btn-link">Read More<i
                                        class="fa-solid fa-chevron-right"></i>
                                </button>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


@endsection
