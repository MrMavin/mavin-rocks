<div class="sidebar column is-3">
    <h1 class="title">Categories</h1>
    <div class="categories">
        <ul>
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('blog.category', $category['slug']) }}" class="category">
                        {{ $category['name'] }}
                        <span class="count">
                            ({{ $category['articles_count'] }})
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <h1 class="title">Tags</h1>
    <div class="tags">
        @foreach($tags as $tag)
            <a href="{{ route('blog.tag', $tag['slug']) }}" class="tag">
                {{ $tag['tag'] }}
            </a>
        @endforeach
    </div>

    <h1 class="title">Recent posts</h1>
    <div class="latest">
        <ul>
            @foreach($latest as $article)
                <li>
                    <a href="{{ route('blog.article', $article['link']) }}">
                        {{ $article['title'] }}

                        <span class="date">
                        {{ $article['created_at'] }}
                    </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>