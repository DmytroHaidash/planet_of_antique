<article class="teaser post-teaser w-1/2 lg:w-1/3">
    <figure class="lozad teaser__thumbnail"
            data-background-image="{{ $museum->logo }}"></figure>

    <a class="teaser__link p-6" href="{{ route('client.museums.show', $museum) }}">
        <div class="teaser__title">
            <h4 class="text-xl title title--striped">
                <span>{{ $museum->title }} </span>
            </h4>
        </div>
    </a>
</article>
