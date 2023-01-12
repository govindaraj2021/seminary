@extends('layouts.main')
@section('content')
    <section class="banner">
        <div class="swiper-container hero-slider">
            <div class="hero-banner swiper-wrapper">

                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <div class="banner-inner-item">
                            <div class="caption-wrapper">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="caption">
                                                <div class="banner-animate first small-caption">Welcome to</div>
                                                <h1 class="banner-animate second">{{ $banner->title }}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="banner-bg">
                                <picture>
                                    <source media="(max-width:767px)"
                                        srcset="{{ asset('storage/app/public/banner/' . $banner->large_image_mobile) }}"
                                        type="image/jpeg">
                                    <img src="{{ asset('storage/app/public/banner/' . $banner->large_image) }}"
                                        alt="Image Caption">
                                </picture>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <section class="flash-news-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flash-news-title">Flash News</div>
                    <div class="marquee flash-news">
                    {{-- <a href="{{route('news',$news->slug)}}">{{$news->title}}</a> --}}
                        <div class="news-reel"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h6>ABOUT US</h6>
                        <h2>Good Shepherd Major Seminary</h2>
                    </div>
                    <div class="image-content-wrapper">
                        <div class="about-content">
                            <div class="image-holder">
                                <picture>
                                    <source srcset="./assets/img/about/about.webp" type="image/webp">
                                    <source srcset="./assets/img/about/about.jpg" type="image/jpeg">
                                    <img src="./assets/img/about/about.jpg" alt="Image Caption">
                                </picture>
                            </div>
                            <p>
                                <strong>Good Shepherd Major Seminary</strong> is the third major seminary of the
                                Syro-Malabar Church. It was canonically erected at Kunnoth, Iritty, North Kerala, India, by
                                the Synod of the Church on 1st September 2000 (Synodal Decree no. 2336/2000). The seminary
                                was inaugurated on 16th June 2001. Even though India, particularly Kerala, had been the land
                                of the Syro-Malabar Church, the Muslim invasion of the 18th century and certain actions of
                                the Portuguese missionaries had reduced the area of the church to the southern part of
                                Kerala.
                            </p>
                            <a href="{{route('page','about-us')}}" class="btn btn-primary">Read More</a>
                        </div>
                        <div class="transparent-image">
                            <picture>
                                <source srcset="./assets/img/about/god.webp" type="image/webp">
                                <source srcset="./assets/img/about/god.png" type="image/png">
                                <img src="./assets/img/about/god.png" alt="Image Caption">
                            </picture>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="explore-our-institution">
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-md-12">
                    <div class="title text-center">
                        <h6>Institution</h6>
                        <h2>Explore Our Institution</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="#" class="simple-card">
                        <div class="card-image">
                            <picture>
                                <source srcset="./assets/img/institution/synodal-commission.webp" type="image/webp">
                                <source srcset="./assets/img/institution/synodal-commission.jpg" type="image/jpeg">
                                <img src="./assets/img/institution/synodal-commission.jpg" alt="Image Caption">
                            </picture>
                            <span class="card-title">
                                <h4>Synodal Commission</h4>
                            </span>
                        </div>
                        <div class="card-content">
                            <h4>Synodal Commission</h4>
                            <button type="button" class="btn btn-primary">Read More</button>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="simple-card">
                        <div class="card-image">
                            <picture>
                                <source srcset="./assets/img/institution/governing-bodies.webp" type="image/webp">
                                <source srcset="./assets/img/institution/governing-bodies.jpg" type="image/jpeg">
                                <img src="./assets/img/institution/governing-bodies.jpg" alt="Image Caption">
                            </picture>
                            <span class="card-title">
                                <h4>Governing Bodies</h4>
                            </span>
                        </div>
                        <div class="card-content">
                            <h4>Governing Bodies</h4>
                            <button type="button" class="btn btn-primary">Read More</button>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="simple-card">
                        <div class="card-image">
                            <picture>
                                <source srcset="./assets/img/institution/curriculum.webp" type="image/webp">
                                <source srcset="./assets/img/institution/curriculum.jpg" type="image/jpeg">
                                <img src="./assets/img/institution/curriculum.jpg" alt="Image Caption">
                            </picture>
                            <span class="card-title">
                                <h4>Curriculum</h4>
                            </span>
                        </div>
                        <div class="card-content">
                            <h4>Curriculum</h4>
                            <button type="button" class="btn btn-primary">Read More</button>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="simple-card">
                        <div class="card-image">
                            <picture>
                                <source srcset="./assets/img/institution/publications.webp" type="image/webp">
                                <source srcset="./assets/img/institution/publications.jpg" type="image/jpeg">
                                <img src="./assets/img/institution/publications.jpg" alt="Image Caption">
                            </picture>
                            <span class="card-title">
                                <h4>Publications</h4>
                            </span>
                        </div>
                        <div class="card-content">
                            <h4>Publications</h4>
                            <button type="button" class="btn btn-primary">Read More</button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="history-seminary">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="bg-floating-image">
                        <picture>
                            <source srcset="./assets/img/history/history-bg.webp" type="image/webp">
                            <source srcset="./assets/img/history/history-bg.jpg" type="image/jpeg">
                            <img src="./assets/img/history/history-bg.jpg" alt="Image Caption">
                        </picture>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content">
                        <div class="title">
                            <h6>History</h6>
                            <h2>History Of The Seminary</h2>
                        </div>
                        <p>
                            <strong>Good Shepherd Major Seminary</strong> is the third major seminary of the Syro-Malabar
                            Church. It was canonically erected at Kunnoth, Iritty, North Kerala, India, by the Synod of the
                            Church on 1st September 2000 (Synodal Decree no. 2336/2000). The seminary was inaugurated on
                            16th June 2001. Even though India, particularly Kerala, had been the land of the Syro-Malabar
                            Church, the Muslim invasion of the 18th century and certain actions of the Portuguese
                            missionaries had reduced the area of the church to the southern part of Kerala.
                        </p>
                        <a href="#" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-60 discover-activities">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title text-center">
                        <h6>Activities</h6>
                        <h2>Discover Our Activities</h2>
                    </div>
                </div>
            </div>
            <div class="row card-row">
                <div class="col-md-3">
                    <a href="#" class="card">
                        <div class="card-image">
                            <picture>
                                <source srcset="./assets/img/discover-our-activities/formation.webp" type="image/webp">
                                <source srcset="./assets/img/discover-our-activities/formation.jpg" type="image/jpeg">
                                <img src="./assets/img/discover-our-activities/formation.jpg" alt="Image Caption">
                            </picture>
                        </div>
                        <div class="card-content">
                            <span class="card-icon">
                                <i class="fa-solid fa-users"></i>
                            </span>
                            <h4>Formation</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="card">
                        <div class="card-image">
                            <picture>
                                <source srcset="./assets/img/discover-our-activities/arts-sports.webp" type="image/webp">
                                <source srcset="./assets/img/discover-our-activities/arts-sports.jpg" type="image/jpeg">
                                <img src="./assets/img/discover-our-activities/arts-sports.jpg" alt="Image Caption">
                            </picture>
                        </div>
                        <div class="card-content">
                            <span class="card-icon">
                                <i class="fa-solid fa-baseball-ball"></i>
                            </span>
                            <h4>Arts & Sports</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="card">
                        <div class="card-image">
                            <picture>
                                <source srcset="./assets/img/discover-our-activities/cultural-activities.webp"
                                    type="image/webp">
                                <source srcset="./assets/img/discover-our-activities/cultural-activities.jpg"
                                    type="image/jpeg">
                                <img src="./assets/img/discover-our-activities/cultural-activities.jpg"
                                    alt="Image Caption">
                            </picture>
                        </div>
                        <div class="card-content">
                            <span class="card-icon">
                                <i class="fa-solid fa-music"></i>
                            </span>
                            <h4>Cultural Activities</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="card">
                        <div class="card-image">
                            <picture>
                                <source srcset="./assets/img/discover-our-activities/social-ministry.webp"
                                    type="image/webp">
                                <source srcset="./assets/img/discover-our-activities/social-ministry.jpg"
                                    type="image/jpeg">
                                <img src="./assets/img/discover-our-activities/social-ministry.jpg" alt="Image Caption">
                            </picture>
                        </div>
                        <div class="card-content">
                            <span class="card-icon">
                                <i class="fa-solid fa-chair-office"></i>
                            </span>
                            <h4>Social Ministry</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="#" class="card">
                        <div class="card-image">
                            <picture>
                                <source srcset="./assets/img/discover-our-activities/jesus-fraternity.webp"
                                    type="image/webp">
                                <source srcset="./assets/img/discover-our-activities/jesus-fraternity.jpg"
                                    type="image/jpeg">
                                <img src="./assets/img/discover-our-activities/jesus-fraternity.jpg" alt="Image Caption">
                            </picture>
                        </div>
                        <div class="card-content">
                            <span class="card-icon">
                                <i class="fa-sharp fa-solid fa-cross"></i>
                            </span>
                            <h4>Jesus Fraternity</h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="#" class="card">
                        <div class="card-image">
                            <picture>
                                <source srcset="./assets/img/discover-our-activities/media-ministry.webp"
                                    type="image/webp">
                                <source srcset="./assets/img/discover-our-activities/media-ministry.jpg"
                                    type="image/jpeg">
                                <img src="./assets/img/discover-our-activities/media-ministry.jpg" alt="Image Caption">
                            </picture>
                        </div>
                        <div class="card-content">
                            <span class="card-icon">
                                <i class="fa-duotone fa-play"></i>
                            </span>
                            <h4>Media Ministry</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="gallery-section pb-60">
        <div class="container">
            <div class="row gallery-row">
                
                <div class="col-md-6">
                    <div class="title d-flex">
                        <h2>
                            <i class="fa-solid fa-films"></i>Videos
                        </h2>
                        <a href="{{route('video-gallery')}}" class="btn btn-link">VIEW ALL</a>
                    </div>
                   {{-- <a data-fancybox="video-gallery" href="https://www.youtube.com/watch?v={{ $video->link }}"
                        data-caption="First Video" class="video-card">
                        <div class="card-image">
                            <img src="https://img.youtube.com/vi/{{ $video->link }}/hqdefault.jpg" alt="Image Caption">
                            <span class="card-icon">
                                <i class="fa-duotone fa-play"></i>
                            </span>
                        </div>
                    </a> --}}
                </div>

                <div class="col-md-6">
                    <div class="title d-flex">
                        <h2>
                            <i class="fa-solid fa-images"></i>Photos
                        </h2>
                        <a href="{{route('photo-gallery')}}" class="btn btn-link">VIEW ALL</a>
                    </div>
                    <div class="row gallery-card-row">


                        {{-- @foreach($gallery as $photo)
                        <div class="col-md-4">
                            <a href="{{ asset('storage/app/public/gallery/' . $photo->large_image) }}" data-fancybox="gallery"
                                data-caption="First image" class="gallery-card">
                                <div class="card-image">
                                    <picture>
                                       
                                        <img src="{{ asset('storage/app/public/gallery/' . $photo->large_image) }}" alt="Image Caption">
                                    </picture>
                                    <span class="card-icon">
                                        <i class="fa-solid fa-plus"></i>
                                    </span>
                                </div>
                            </a>
                        </div>

                        @endforeach --}}


                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title text-center">
                        <h6>News & Events</h6>
                        <h2>Latest News And Upcoming Events</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="news-slider">
                        @foreach($newses as $news)
                        <div class="news-slider-item">
                            <a href="#" class="news-card">
                                <div class="card-image">
                                    <picture>
                                       {{-- <source srcset="uploads/home/news/news-01.webp" type="image/webp">--}}
                                        {{--<source srcset="uploads/home/news/news-01.jpg" type="image/jpeg">--}}
                                        <img src="{{ asset('storage/app/public/news/' . $news->large_image) }}"
                                        alt="Image Caption">
                                        
                                    </picture>
                                    <div class="news-date">
                                        <span class="month">{{ date('M ', strtotime($news->date)) }}</span>
                                        <span class="date">{{ date('d ', strtotime($news->date)) }}</span>
                                    </div> 
                                </div>
                                <div class="card-content">
                                    <h4>{{$news->title}}</h4>
                                    <p>{{$news->description}}</p>
                                    <button type="button" class="btn btn-link">Read More<i
                                            class="fa-solid fa-chevron-right"></i>
                                    </button>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="cta-group share-option">
        <div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style">
            <ul>
                <li>
                    <a class="a2a_button_facebook" target="_blank"></a>
                </li>
                <li>
                    <a class="a2a_button_twitter" target="_blank"></a>
                </li>
                <li>
                    <a class="a2a_button_linkedin" target="_blank"></a>
                </li>
            </ul>
        </div>
        <button type="button" class="share-btn" title="Share">
            <i class="fa-solid fa-share"></i>
        </button>
    </div>
    <div class="cta-group whatsapp-backto-top" title="Whatsapp">
        <a href="https://wa.me/91000000000?text=Hello%20!" title="Whatsapp" target="_blank" class="btn-whatsapp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <button type="button" class="btn-back-to-top back-to-top" title="Back to Top">
            <i class="fa-solid fa-chevron-up"></i>
        </button>
    </div>
    <ul class="click-to-connect">
        <li>
            <a href="tel:0091 0 490-2493850">
                <i class="fas fa-phone"></i>Click to Call
            </a>
        </li>
        <li>
            <a href="mailto:gshepherdkunnoth@yahoo.com">
                <i class="far fa-envelope"></i>Send Email
            </a>
        </li>
    </ul>
@endsection
