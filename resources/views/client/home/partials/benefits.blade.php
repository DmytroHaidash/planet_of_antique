<section class="section section-benefits">
    <a name="benefits" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header central-header">
            <h2 class="section__title central-title">
                Benefits
            </h2>
        </div>

        <div class="section-benefits__benefits-wrapper">
            @foreach($benefits as $item)
            <div class="section-benefits__benefit-item">
                <div class="benefit-item__icon icon bg-clock" style="background-image: url({{$item->image}});
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-position: center;">
                </div>

                <p class="benefit-item__paragraph">
                  {{ $item->title }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</section>