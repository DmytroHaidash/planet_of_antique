<section class="section section-help">
    <div class="content-wrapper">
        <div class="section__header central-header">
            <h2 class="section__title central-title">
                @lang('common.help.title')
            </h2>
        </div>

        <div class="section-help__helps-wrapper">
            <button class="section-help__help-item modal-button" data-modal-opened="supportMessage">
                <span class="help-item__img icon bg-message"></span>
                <span class="help-item__paragraph">
                            @lang('common.help.message')
                        </span>
            </button>

            <a href="#" class="section-help__help-item">
                <span class="help-item__img icon bg-chat"></span>
                <span class="help-item__paragraph">
                            @lang('common.help.chat')
                        </span>
            </a>

            <a href="#" class="section-help__help-item">
                <span class="help-item__img icon bg-whatsapp"></span>
                <span class="help-item__paragraph">
                            @lang('common.help.whats_app')
                        </span>
            </a>

            <a href="/faq" class="section-help__help-item">
                <span class="help-item__img icon bg-faq"></span>
                <span class="help-item__paragraph">
                            @lang('common.help.faq')
                        </span>
            </a>
        </div>
    </div>
</section>