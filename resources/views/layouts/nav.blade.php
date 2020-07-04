<nav class="navbar navbar-expand-md navbar-custom fixed-top navbar-fixed-top" role="navigation">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span class="code-light text-shadow">Game<span class="red">RangerZ</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            {{ __('Menu') }} <i class="fa fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @foreach($items as $item)
                    @if($item->children->count())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ url($item->url) }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $item->title }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($item->children as $subItem)
                                    @if($subItem->title == 'divider')
                                        <div class="dropdown-divider"></div>
                                    @else
                                        <a class="dropdown-item {!! url($subItem->link()) == url()->current() ? 'active' : '' !!}" target="{{ $subItem->target }}" href="{{ url($subItem->url) }}">{{ $subItem->title }} {!! url($subItem->link()) == url()->current() ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                                    @endif
                                @endforeach
                            </div>
                        </li>
                    @else
                        <li class="nav-item {!! url($item->link()) == url()->current() ? 'active' : '' !!}">
                            <a class="nav-link" target="{{ $item->target }}" href="{{ url($item->url) }}">{{ $item->title }} {!! url($item->link()) == url()->current() ? '<span class="sr-only">(current)</span>' : '' !!}</a>
                        </li>
                    @endif
                @endforeach
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
