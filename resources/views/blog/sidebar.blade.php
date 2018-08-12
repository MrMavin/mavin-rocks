<div class="sidebar column is-4">
    <h1 class="title">Tags</h1>
    <div class="tags">
        @foreach($tags as $tag)
            <a href="{{ route('blog.tag', $tag['tag']) }}" class="tag">
                {{ $tag['tag'] }} ({{ $tag['articles_count'] }})
            </a>
        @endforeach
    </div>
</div>