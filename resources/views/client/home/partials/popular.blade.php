<section class="section section-popular">
    <a name="catalog" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header central-header">
            <h2 class="section__title central-title">Popular-sections</h2>
        </div>

        <div class="popular-section__item-row-wrapper">
            @foreach($popular as $item)
                <div class="popular-item" style="background-image: url({{$item->image}})">
                    <a href="#" class="popular-item__link">{{ $item->title }}</a>
                </div>
            @endforeach
        </div>
    </div>
</section>