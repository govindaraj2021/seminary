<div class="col-md-12">
    <h4 class="title color-danger">
        <span>News & Events</span>
    </h4>
    <div class="vertical-slider">
        @foreach ($newses as $news)
            <div class="slider-item">
                <a href="{{ route('news', $news->slug) }}" class="news-card sliding-news">
                    <div class="day">
                        <span class="month">{{ date('M ', strtotime($news->date)) }}</span>
                        <span class="date">{{ date('d ', strtotime($news->date)) }}</span>
                    </div>
                    <div class="img-holder">
                        <picture>
                            @if(isset( $news->large_image))
                            <img src="{{ asset('/storage/app/public/news/' . $news->large_image) }}"
                                alt="Image Caption">
                            @else
                            <img src="{{ asset('assets/img/default-img/default-img.jpg') }}"
                                alt="Image Caption">
                            @endif 
                        </picture>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <h3>{{ $news->title }}</h3>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <a href="{{ route('news') }}" class="btn btn-primary btn-square-primary">View All</a>
</div>
