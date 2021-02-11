<section class="section section-articles">
    <div class="content-wrapper">
        <div class="section__header central-header">
            <h2 class="section__title central-title">
                @lang('common.articles')
            </h2>
        </div>

        <div class="section-articles__articles-wrapper">
            @foreach($articles as $item)
                <article class="section-articles__article">
                    <a href="{{route('client.blog.show', $item)}}">
                    <img src="{{$item->image}}" alt="article image" class="article__img">

                    <h2 class="article__title">
                        {{$item->title}}
                    </h2>
                    @if($item->description)
                        <p class="article__paragraph">
                            {{$item->description}}
                        </p>
                    @endif
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>