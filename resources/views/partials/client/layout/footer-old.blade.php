<footer class="pt-10 pb-4 overflow-hidden">
    <div class="container">
        <div class="logo-decoration inset-x-0 mx-auto">
            <a href="{{ url('/') }}" class="inline-flex mt-2">
                <p>Antique planet</p>
            </a>
        </div>

        <div class="mt-8 flex flex-wrap justify-center -mx-8">
            @foreach(app('nav')->footer() as $footer_el)
                <div class="px-8 w-full md:w-1/2 lg:w-1/4 max-w-xs mb-8">
                    <h5 class="font-bold mb-3 text-lg">
                        @if ($footer_el->link)
                            <a href="{{ $footer_el->link }}">{{ $footer_el->name }}</a>
                        @else
                            {{ $footer_el->name }}
                        @endif
                    </h5>
                    @if ($footer_el->children)
                        <ul class="list-reset">
                            @foreach($footer_el->children as $child)
                                <li>
                                    <a href="{{ $child->link }}">{{ $child->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>

        <hr class="border-b border-white opacity-25 my-4">

        <div class="text-center text-sm">
            &copy; {{ date('Y') }} {{ config('app.name') }}
        </div>
    </div>
</footer>



