<div class="col-md-12">
    <h4 class="title color-danger">
        <span>Our Gallery</span>
    </h4>
    <div class="row card-row space-0">
        @foreach ($galleries as $item)
            <div class="col-md-4">
                <a href="{{ asset('storage/app/public/gallery/' . $item->large_image) }}" data-fancybox="gallery" class="gallery-card">
                    <div class="card-image">
                        <picture>
                            <img src="{{ asset('storage/app/public/gallery/' . $item->large_image) }}" alt="Alphonsa English Medium School">
                        </picture>
                    </div>
                    <div class="ovarlay">
                        <i class="fa-solid fa-expand-wide"></i>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <a href="{{route('gallery')}}" class="btn btn-primary btn-square-primary mt-4">View All</a>
</div>
