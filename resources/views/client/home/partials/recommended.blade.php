<section class="section section-recommended">
    <a name="recommended" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header slider-header">
            <h2 class="section__title">@lang('common.recommended')</h2>
            <a class="section__btn link-btn" href="{{route('client.catalog.recommended')}}">@lang('common.view')</a>
        </div>

        <div class="section-recommended__slider swiper-container">
            <div class="swiper-wrapper">
                @foreach($recommended as $item)
                    <a href="{{ route('client.catalog.show', $item) }}" class="section-recommended__slide swiper-slide">
                        <img src="{{$item->firstImage}}" alt="slide image">
                    </a>
                @endforeach
            </div>
            <div class="slider__buttons-wrapper">
                <button class="swiper-button-prev section-recommended__slider__button-prev">
                </button>


                <button class="swiper-button-next section-recommended__slider__button-next">
                </button>
            </div>
        </div>
    </div>
</section>