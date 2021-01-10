<section class="section section-new">
    <a name="new" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header slider-header">
            <h2 class="section__title ">New</h2>
            <a class="section__btn link-btn" href="#">view all</a>
        </div>

        <div class="section-new__slider swiper-container">
            <div class="swiper-wrapper">
                @foreach($new as $item)
                    <div class="section-new__slide swiper-slide">
                        <img src="{{$item->firstImage}}" alt="slide image">
                    </div>
                @endforeach
            </div>
            <div class="slider__buttons-wrapper">
                <button class="swiper-button-prev section-new__slider__button-prev">
                </button>

                <button class="swiper-button-next section-new__slider__button-next">
                </button>
            </div>

        </div>
    </div>
</section>