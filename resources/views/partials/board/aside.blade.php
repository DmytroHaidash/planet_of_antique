<aside id="app-aside" data-simplebar>
    <nav>
        <ul class="list-unstyled mb-0 mh-100 accordion">
            @foreach(app('nav')->board() as $nav)
                <li id="submenu-heading-{{ $loop->iteration }}"
                    class="nav-item{{ $nav->match ? ' is-active' : '' }}">
                    @isset($nav->unread)
                        <div class="unread">{{ $nav->unread }}</div>
                    @endisset
                    @if (empty($nav->children))
                        <a href="{{$nav->route}}" class="d-flex align-items-center">
                            <i class="nav-icon {{ $nav->icon }} mr-3"></i>
                            {{ $nav->name }}
                        </a>
                    @else
                        <a data-toggle="collapse" href="#{{ Str::slug($nav->name) }}" role="button" aria-expanded="false"
                           aria-controls="{{ Str::slug($nav->name) }}" class="d-flex align-items-center">
                            <i class="nav-icon {{ $nav->icon }} mr-3"></i>
                            {{ $nav->name }}
                        </a>
                        <ul class="collapse list-unstyled submenu {{ app('router')->currentRouteNamed($nav->match) ? 'show' : '' }}"
                            id="{{ Str::slug($nav->name) }}">
                            @foreach($nav->children as $submenu)
                                <li class="submenu-item ">
                                    <a href="{{ $submenu->route }}" class="{{ $submenu->match ? ' is-active' : '' }}">
                                        {{ $submenu->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</aside>
