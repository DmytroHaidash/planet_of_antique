<section class="section section-sellers">
    <a name="sellers" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header slider-header">
            <h2 class="section__title">Sellers</h2>
            <a class="section__btn link-btn" href="#">view all</a>
        </div>

        <div class="section-sellers__slider swiper-container">
            <div class="swiper-wrapper">
                @foreach($sellers as $item)
                    <div class="section-sellers__slide swiper-slide">
                        <img src="{{$item->logo}}" alt="slide image">
                    </div>
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