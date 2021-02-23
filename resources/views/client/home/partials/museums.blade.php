<section class="section section-sellers">
    <a name="museums" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header slider-header">
            <h2 class="section__title">@lang('nav.museums')</h2>
            <a class="section__btn link-btn" href="{{route('client.museums.index')}}">@lang('common.view')</a>
        </div>

        <div class="section-museums__slider swiper-container">
            <div class="swiper-wrapper">
                @foreach($museums as $item)
                    <a href="{{route('client.museums.show', $item)}}" class="section-museums__slide swiper-slide">
                        <img src="{{$item->logo}}" alt="slide image">
                    </a>
                @endforeach
            </div>
            <div class="slider__buttons-wrapper">
                <button class="swiper-button-prev section-museums__slider__button-prev">
                </button>

                <button class="swiper-button-next section-museums__slider__button-next">
                </button>
            </div>
        </div>
    </div>
</section>