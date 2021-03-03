<section class="section section-sellers">
    <a name="sellers" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header slider-header">
            <h2 class="section__title">@lang('common.sellers')</h2>
            <a class="section__btn link-btn" href="{{route('client.shops.index')}}">@lang('common.view')</a>
        </div>

        <div class="section-sellers__slider swiper-container">
            <div class="swiper-wrapper">
                @foreach($sellers as $item)
                    <a href="{{route('client.shops.show', $item)}}" class="section-sellers__slide swiper-slide-2">
                        <img src="{{$item->logo}}" alt="slide image">
                    </a>
                @endforeach
            </div>
            <div class="slider__buttons-wrapper">
                <button class="swiper-button-prev section-sellers__slider__button-prev">
                </button>

                <button class="swiper-button-next section-sellers__slider__button-next">
                </button>
            </div>
        </div>
    </div>
</section>