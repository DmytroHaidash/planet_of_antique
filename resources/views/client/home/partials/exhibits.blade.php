<section class="section section-new mb-4">
    <a name="exhibits" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header slider-header">
            <h2 class="section__title">@lang('nav.exhibits')</h2>
            <a class="section__btn link-btn" href="{{route('client.exhibits.index')}}">@lang('common.view')</a>
        </div>

        <div class="section-exhibit__slider swiper-container">
            <div class="swiper-wrapper">
                @foreach($exhibits as $item)
                    <a href="{{ route('client.exhibits.show', $item) }}" class="section-exhibit__slide swiper-slide">
                        <img src="{{$item->firstImage}}" alt="slide image">
                    </a>
                @endforeach
            </div>
            <div class="slider__buttons-wrapper">
                <button class="swiper-button-prev section-exhibit__slider__button-prev">
                </button>

                <button class="swiper-button-next section-exhibit__slider__button-next">
                </button>
            </div>

        </div>
    </div>
</section>