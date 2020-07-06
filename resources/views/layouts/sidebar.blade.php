<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{route('dashboard')}}"><span class="code-light white text-shadow">Game<span
                    class="red">RangerZ</span></span></a>
        <a class="sidebar-brand brand-logo-mini" href="{{route('dashboard')}}"><span
                class="code-light white text-shadow">G<span class="red">R</span></span></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{Auth::user()->avatar}}" alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{Auth::user()->username}}</h5>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        @foreach($items as $item)
            @if($item->children->count())
                <li class="nav-item menu-items">
                    <a class="nav-link" href="#{{$item->title}}" data-toggle="collapse" aria-expanded="false"
                       aria-controls="{{$item->title}}">
                        <span class="menu-icon">
                            <i class="mdi {{ $item->icon_class }}"></i>
                        </span>
                        <span class="menu-title">{{ $item->title }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="{{$item->title}}">
                        <ul class="nav flex-column sub-menu">
                            @foreach($item->children as $subItem)
                                @if($subItem->title == 'divider')
                                    <div class="dropdown-divider"></div>
                                @else
                                    <li class="nav-item"><a
                                            class="nav-link" {!! url($subItem->link()) == url()->current() ? 'active' : '' !!}
                                        " target="{{ $subItem->target }}" href="{{ url($subItem->url) }}
                                        ">{{ $subItem->title }} {!! url($subItem->link()) == url()->current() ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
            @else
                <li class="nav-item {!! url($item->link()) == url()->current() ? 'active' : '' !!}">
                    <a class="nav-link" target="{{ $item->target }}" href="{{ url($item->url) }}">
                        <span class="menu-icon">
                            <i class="mdi {{ $item->icon_class }}"></i>
                        </span>
                        <span class="menu-title">{{ $item->title }}</span>
                        {!! url($item->link()) == url()->current() ? '<span class="sr-only">(current)</span>' : '' !!}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
