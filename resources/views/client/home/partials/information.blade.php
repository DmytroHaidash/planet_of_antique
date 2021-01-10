<section class="section section-information">
    <a name="customers" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header central-header">
            <h2 class="section__title central-title">Information</h2>
        </div>

        <div class="section-information__wrapper">
            <a href="/sellers" class="section-information__link-wrapper">
                <p class="section-information__link">for sellers</p>
                <div class="section-information__link-background"></div>
            </a>

            <a href="/buyers" class="section-information__link-wrapper">
                <p  class="section-information__link">for buyers</p>
                <div class="section-information__link-background"></div>
            </a>

        </div>
        @guest
        <a class="link-btn create-link" href="{{route('register')}}">creative your store in 10 minutes</a>
            @endguest
    </div>
</section>