<section class="section section-recommended">
    <a name="recommended" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header slider-header">
            <h2 class="section__title">Recommended</h2>
            <a class="section__btn link-btn" href="#">view all</a>
        </div>

        <div class="section-recommended__slider swiper-container">
            <div class="swiper-wrapper">
                @foreach($recommended as $item)
                    <div class="section-recommended__slide swiper-slide">
                        <img src="{{$item->firstImage}}" alt="slide image">
                    </div>
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