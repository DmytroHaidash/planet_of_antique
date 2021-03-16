<section class="section section-information">
    <a name="customers" class="anchor"></a>
    <div class="content-wrapper">
        <div class="section__header central-header">
            <h2 class="section__title central-title">@lang('common.information.title')</h2>
        </div>

        <div class="section-information__wrapper">
            <a href="/sellers" class="section-information__link-wrapper" style="background-image: url(../../img/content-part/castle-1.png)">
                <p class="section-information__link">@lang('common.information.sellers')</p>
                {{--<div class="section-information__link-background"></div>--}}
            </a>

            <a href="/buyers" class="section-information__link-wrapper" style="background-image: url(../../img/content-part/castle-2.png)">
                <p  class="section-information__link">@lang('common.information.buyers')</p>
                {{--<div class="section-information__link-background"></div>--}}
            </a>

        </div>
        @guest
        <a class="link-btn create-link" href="/story">@lang('common.information.btn')</a>
            @endguest
    </div>
</section>