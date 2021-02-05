<section class="section section-popular">
    <a name="catalog" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header central-header">
            <h2 class="section__title central-title">Popular-sections</h2>
        </div>

        <div class="popular-section__item-row-wrapper">
            @foreach($popular as $item)
                <a href="{{route('client.catalog.index', ['category' => $item->slug])}}" class="popular-item" style="background-image: url({{$item->image}});
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-position: center;
                        margin: auto;">
                    <span class="popular-item__link">{{ $item->title }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>