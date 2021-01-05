<header class="header">
    <div class="content-wrapper">
        <nav class="main-nav">
            <div class="main-nav__menu-wrapper">
                <a href="/" class="logo-link">{{config('app.name')}}</a>

                <div class="main-nav__menu">
                    <a href="#customers" class="link customers-link">Sellers / Buyers</a>
                    <form action="{{ route('client.search.index') }}" method="get" class="search-label" style="display: inline-flex">
                        <input type="text" class="search-input"
                                                           placeholder="...">
                        <button class="search-btn d-none">Search</button>
                    </form>
                    <button class="search-btn icon bg-search" onclick="toggleSearch()"></button>
                </div>
            </div>

            <ul class="main-nav__links-list">
                <li class="main-nav__link-item about-link">
                    <a href="/about" class="link ">About</a>
                </li>

                <li class="main-nav__link-item contacts-link">
                    <a href="/contacts" class="link ">Contacts</a>
                </li>

                <li class="main-nav__link-item authorization-link">
                    @guest
                        <a href="{{route('login')}}" class="link">login</a> / <a href="{{route('register')}}"
                                                                                 class="link">registration</a>
                    @else
                        <a>{{auth()->user()->name}}</a>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
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
                <li class="link"><a href="#catalog">catalog</a></li>
                <li class="link"><a href="#sellers">sellers</a></li>
                <li class="link"><a href="#recommended">recommended</a></li>
                <li class="link"><a href="#new">new</a></li>
            </ul>
            <a href="" class="link store-link">create your store</a>
        </nav>
    </div>
</header>