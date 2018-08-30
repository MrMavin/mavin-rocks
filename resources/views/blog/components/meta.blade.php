<div class="level meta">
    <div class="level-left">
        <span class="level-item">
            By&nbsp;<a href="{{ route('page.about') }}">{{ config('me.nickname') }}</a>
        </span>
        <span class="level-item">{{ $article->created }}</span>
        @if ($article->category)
            <span class="level-item">{{ $article->category->name }}</span>
        @endif
    </div>
    <div class="level-right">
        <span class="level-item">
            {{ reading_time($article->content) }} read
        </span>
    </div>
</div>