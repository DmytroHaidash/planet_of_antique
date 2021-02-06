<section class="main-slider__section swiper-container">
    <a name="main" class="anchor"></a>

    <div class="main-slider__wrapper swiper-wrapper">
        @foreach($banners as $banner)
            <div class="main-slider__slide main-slide swiper-slide"
                 style="background-image: url({{$banner->getFirstMediaUrl('banner', 'banner')}});
                         ">
                @if($banner->title || $banner->description || $banner->url)
                    <article class="main-slide__article">
                        @if($banner->title)
                            <h2 class="main-slide__title">
                                {{$banner->title}}
                            </h2>
                        @endif
                        @if($banner->description)
                            <p class="main-slide__paragraph">
                                {{ $banner->description }}
                            </p>
                        @endif
                        @if($banner->url)
                            <a class="main-slide__link-btn link-btn" href="{{$banner->url}}">shop now</a>
                        @endif
                    </article>
                @endif
            </div>
        @endforeach
    </div>
    <button class="swiper-button-prev main-slider__button-prev"></button>

    <button class="swiper-button-next main-slider__button-next"></button>

    <div class="swiper-pagination"></div>
</section>