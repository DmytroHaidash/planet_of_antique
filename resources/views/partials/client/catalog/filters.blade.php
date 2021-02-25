<div class="flex flex-wrap justify-center">
    @if ($categories->count())
        @foreach($categories as $category)
            <a href="{{$search? '?search='.$search.'&' : '?'}}category={{ $category->slug }}"
               class="mx-px mb-1 ml-1 button-xs button-xs--primary{{ $search_category == $category->slug ? '-outline' : '' }}">
                {{ $category->title }}
            </a>
        @endforeach
        @if(request()->filled('category') || request()->filled('search'))
            <a href="{{ url()->current() }}" class="mx-px  py-1 button-xs button-xs--primary-outline">
                @lang('pages.catalog.filter.clear')
            </a>
        @endif
    @endif

</div>