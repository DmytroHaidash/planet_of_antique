<section class="section section-exhibits">
    <div class="content-wrapper">
        <div class="section__header slider-header">
            <h2 class="section__title">@lang('nav.exhibits')</h2>
            <a class="section__btn link-btn" href="{{route('client.exhibits.index')}}">@lang('common.view')</a>
        </div>

        <div class="section-exhibit__slider swiper-container hidden xl:flex">
            <div class="swiper-wrapper">
                @foreach($exhibits as $item)
                    <a href="{{ route('client.exhibits.show', $item) }}" class="section-exhibit__slide swiper-slide slider-2">
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
        <div class="popular-section__item-row-wrapper xl:hidden">
            <a href="{{route('client.exhibits.index')}}" class="popular-item"
               style="background-image: url({{$exhibits_banner->image}});
                       background-size: cover;
                       background-repeat: no-repeat;
                       background-position: center;
                       margin: auto;">
            </a>
        </div>
    </div>
</section>