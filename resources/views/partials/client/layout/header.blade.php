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
                        <input type="text" class="search-input"
                               placeholder="...">
                        <button class="search-btn d-none">@lang('nav.search')</button>
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
                        <a>{{auth()->user()->name}}</a>
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
            <button class="link-menu-btn" onclick="toggleMenu(event)">&#8801</button>
            <ul class="link-menu" id="link-menu">
                <li class="link"><a href="{{route('client.catalog.index')}}">@lang('pages.catalog.title')</a></li>
                <li class="link"><a href="#sellers">@lang('pages.sellers.title')</a></li>
                <li class="link"><a href="{{route('client.catalog.recommended')}}">@lang('pages.recommended.title')</a></li>
                <li class="link"><a href="{{route('client.catalog.new')}}">@lang('pages.new.title')</a></li>
                <li class="link"><a href="{{route('client.blog.index')}}">@lang('nav.blog')</a></li>
            </ul>
            @guest
                <a href="{{route('register')}}" class="link store-link">@lang('nav.create')</a>
            @endguest
        </nav>
    </div>
</header>