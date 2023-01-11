@extends('layouts.main')
@section('title', 'News Detail')
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
            <a href="{{route('index')}}">Home</a>
          </li>
          <li>
            <a href="{{route('news')}}">news</a>
          </li>
          <li>News</li>
        </ol>
      </div>
    </div>
  </div>
</nav>
<section class="news-and-events">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus volutpat auctor nulla quis tempor.</h2>
        <div class="news-body">
          <div class="date">
            <i class="icon-calendar4-week"></i>
            <span>10-4-2021</span>
          </div>
          <div class="news-img">
            <img src="{{ asset('/storage/app/public/news/' . $newses->large_image) }}"
              alt="Good Shepherd Major Seminary">
          </div>
          {!!$newses->description!!}
        </div>
      </div>
      <div class="col-md-5">
        <a href="{{route('index')}}" class="btn btn-link">Back to all Blogs</a>
        <div class="related-news">
          <div class="title">
            <h4>Other Blogs</h4>
          </div>
          <div class="related-news-list">
            <ul class="card-row">
              <li>
                <a href="{{route('news.show',$news->slug)}}" class="thumbnail-card">
                  <div class="card-image">
                    <img src="uploads/news/news.jpg" alt="Good Shepherd Major Seminary">
                  </div>
                  <div class="card-body">
                    <div class="date">
                      <i class="icon-calendar4-week"></i>
                      <span>{{$news->date}}</span>
                    </div>
                    <div class="card-content">
                      <h5>{{$news->title}}</h5>
                      <button type="button" class="btn btn-link">Read More</button>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection