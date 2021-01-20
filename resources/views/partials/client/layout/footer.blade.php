<footer class="footer">
    <div class="content-wrapper">
        <nav class="footer__main-nav">
            <a href="#main" class="logo-link">{{config('app.name')}}</a>
            @if(app('settings')->facebook || app('settings')->youtube || app('settings')->instagram ||app('settings')->pinterest)
                <div class="social-links-wrapper">
                    <h2 class="section__title central-title">
                        @lang('common.footer.follow')
                    </h2>
                    <ul class="social-links-list">
                        @if(app('settings')->facebook)
                            <a href="{{app('settings')->facebook}}">
                                <li class="social-links__item icon bg-facebook"></li>
                            </a>
                        @endif
                        @if(app('settings')->youtube)
                            <a href="{{app('settings')->youtube}}">
                                <li class="social-links__item icon bg-youtube"></li>
                            </a>
                        @endif
                        @if(app('settings')->instagram)
                            <a href="{{app('settings')->instagram}}">
                                <li class="social-links__item icon bg-instagram"></li>
                            </a>
                        @endif
                        @if(app('settings')->pinterest)
                            <a href="{{app('settings')->pinterest}}">
                                <li class="social-links__item icon bg-pinterest"></li>
                            </a>
                        @endif
                    </ul>
                </div>
            @endif
        </nav>

        <nav class="footer__sub-nav">
            <ul class="sub-nav-list">
                <li class="sub-nav-list__item">
                    <ul class="sub-nav-list__main-links-list">
                        <li class="main-link-list__item">
                            <a href="/sellers">@lang('nav.sellers')</a>
                        </li>
                        <li class="main-link-list__item">
                            <a href="/buyers">@lang('nav.buyers')</a>
                        </li>
                        <li class="main-link-list__item">
                            <a href="/about">@lang('pages.about.title')</a>
                        </li>
                        <li class="main-link-list__item">
                            <a href="/contacts">@lang('pages.contacts.title')</a>
                        </li>
                    </ul>
                </li>

                <li class="sub-nav-list__item">
                    <ul class="sub-nav-list__site-links-list">
                        <li class="site-link-list__item"><a href="{{route('client.catalog.index')}}">@lang('pages.catalog.title')</a></li>
                        <li class="site-link-list__item"><a href="{{route('client.catalog.new')}}">@lang('pages.new.title')</a></li>
                        <li class="site-link-list__item"><a href="{{route('client.catalog.recommended')}}">@lang('pages.recommended.title')</a></li>
                        <li class="site-link-list__item"><a href="#sellers">@lang('pages.sellers.title')</a></li>
                    </ul>
                </li>

                <li class="sub-nav-list__item">
                    <a name="contacts"></a>
                    <ul class="sub-nav-list__contacts-links-list">
                        @if(app('settings')->whatsapp)
                            <li class="site-link-list__item">
                                <a href="wa.me0/{{app('settings')->whatsapp}}">whatsapp {{app('settings')->whatsapp}}</a>
                            </li>
                        @endif
                        @if(app('settings')->email)
                            <li class="site-link-list__item">
                                <a href="mailto:{{app('settings')->email}}">{{app('settings')->email}}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>

        <p>@lang('common.footer.copy')</p>
    </div>
</footer>