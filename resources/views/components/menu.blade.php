@if (isset($menu))
    <div class="col-md-12">
        <div class="side-menu-wrap">
            <h4 class="title color-danger">
                <span>
                    {{ $menu->name }}
                </span>
            </h4>
            <ul class="side-menu">
                @if (isset($submenu))
                    @foreach ($submenu as $item)
                        <li @if (Request::path() == $item->url) class="active" @endif>
                            <a href="{{ route('page', $item->url) }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@endif
