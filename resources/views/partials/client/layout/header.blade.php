<header class="header">
    <div class="content-wrapper">
        <nav class="main-nav">
            <div class="main-nav__menu-wrapper">
                <a href="/" class="logo-link">{{config('app.name')}}</a>

                <div class="main-nav__menu">
                    <div class="customers-link">
                        <a href="/sellers" class="link">@lang('nav.sellers')</a> /
                        <a href="/buyers" class="link">@lang('nav.buyers')</a>
                    </div>
                    <form action="{{ route('client.search.index') }}" method="get" class="search-label"
                          style="display: inline-flex">
                        <input type="text" class="search-input" name="search"
                               placeholder="...">
                        <a class="search-btn mt-1 d-none" onclick="toggleSearch()">
                            <svg width="24" height="24" fill="#000">
                                <use xlink:href="#close"></use>
                            </svg>
                        </a>
                        <button class="search-btn mt-1 d-none">@lang('nav.search')</button>
                    </form>
                    <button class="search-btn icon bg-search" onclick="toggleSearch()"></button>
                </div>
            </div>

            <ul class="main-nav__links-list">
                <li class="main-nav__link-item about-link">
                    <a href="/about" class="link ">@lang('pages.about.title')</a>
                </li>

                <li class="main-nav__link-item contacts-link">
                    <a href="/contacts" class="link ">@lang('pages.contacts.title')</a>
                </li>

                <li class="main-nav__link-item authorization-link">
                    @guest
                        <a href="{{route('login')}}" class="link">@lang('auth.login')</a> / <a
                                href="{{route('register')}}"
                                class="link">@lang('auth.register')</a>
                    @else
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            @lang('auth.logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </li>
            </ul>

        </nav>

        <nav class="sub-nav">
            <button class="link-menu-btn" id="menu-btn" onclick="toggleMenu(event)">&#8801</button>
            <ul class="link-menu" id="link-menu">
                <li class="link"><a href="{{route('client.catalog.index')}}">@lang('pages.catalog.title')</a></li>
                <li class="link"><a href="{{route('client.shops.index')}}">@lang('pages.sellers.title')</a></li>
                <li class="link"><a href="{{route('client.catalog.recommended')}}">@lang('pages.recommended.title')</a>
                </li>
                <li class="link"><a
                            href="{{route('client.catalog.new')}}">@lang('pages.new.title')</a></li>
                <li class="link"><a href="{{route('client.blog.index')}}">@lang('nav.blog')</a></li>
                <li class="link hidden lg:inline-block">
                    <a href="#">@lang('nav.categories')
                        <svg width="12" height="11" class="fill-current ml-2 -mt-px inline-flex">
                            <use xlink:href="#caret"></use>
                        </svg>
                    </a>
                    <div class="submenu leading-tight" style="display: none">
                        <div class="close">
                            <svg width="24" height="24" fill="#000">
                                <use xlink:href="#close"></use>
                            </svg>
                        </div>
                        <ul class="list-reset lg:flex  lg:flex-wrap text-center">
                            @foreach(app('categories') as $category)
                                <li class="mb-3 lg:w-1/3">
                                    <a href="{{route('client.catalog.index', ['category' => $category->slug])}}"
                                       class="font-bold">{{ $category->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="link"><a href="{{route('client.museums.index')}}">@lang('nav.museums')</a></li>
                <li class="link"><a href="{{route('client.exhibits.index')}}">@lang('nav.exhibits')</a></li>
            </ul>
            @if(Auth::user() && !Auth::user()->hasRole('client'))
                <a href="{{route('board.shops.index')}}" class="link store-link">@lang('nav.shop')</a>
                @if(Auth::user()->hasRole('admin'))
                    <a href="{{route('admin.shops.index')}}" class="link store-link">@lang('nav.admin')</a>
                @endif
            @else
                <p class="store-title">
                    @lang('nav.create.title')
                    <a href="/story" class="link">@lang('nav.create.store')</a>

                    / <a href="/new-museum" class="link">@lang('nav.create.museum')</a>
                </p>
            @endif
        </nav>
    </div>
</header>