<section class="section section-new">
    <div class="content-wrapper">
        <div class="section__header slider-header">
            <h2 class="section__title ">@lang('common.new')</h2>
            <a class="section__btn link-btn" href="{{route('client.catalog.new')}}">@lang('common.view')</a>
        </div>

        <div class="section-new__slider swiper-container hidden xl:flex">
            <div class="swiper-wrapper">
                @foreach($new as $item)
                    <a href="{{ route('client.catalog.show', $item) }}"
                       class="section-new__slide swiper-slide slider-2">
                        <img src="{{$item->firstImage}}" alt="slide image" class="image">
                        <span class="popular-item__link-2">{{ $item->title }}</span>
                    </a>
                @endforeach
            </div>
            <div class="slider__buttons-wrapper">
                <button class="swiper-button-prev section-new__slider__button-prev">
                </button>

                <button class="swiper-button-next section-new__slider__button-next">
                </button>
            </div>
        </div>

        <div class="popular-section__item-row-wrapper xl:hidden">
            <a href="{{route('client.catalog.new')}}" class="popular-item"
               style="background-image: url({{$new_banner->image}});
                       background-size: cover;
                       background-repeat: no-repeat;
                       background-position: center;
                       margin: auto;">
            </a>
        </div>

    </div>
</section>