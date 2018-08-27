<div class="sidebar column is-3">
    <h1 class="title">Tags</h1>
    <div class="tags">
        @foreach($tags as $tag)
            <a href="{{ route('blog.tag', $tag['tag']) }}" class="tag">
                {{ $tag['tag'] }}
            </a>
        @endforeach
    </div>

    <h1 class="title">Recent posts</h1>
    <div class="latest">
        <ul>
            @foreach($latest as $article)
                <li>
                    <a href="{{ route('blog.article', get_article_url($article)) }}">
                        {{ $article['title'] }}
                    </a>
                    <span class="date">
                        {{ $article['created_at'] }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</div>