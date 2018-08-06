@extends('layouts.default')

@section('title', 'Blog')
@section('page', 'blog')

@section('content')
    <div class="container">
        <div class="columns is-multiline">
            @include('blog.sidebar')

            <div class="column is-8">
                @include('blog.components.filters')

                @foreach($articles as $article)
                    <div class="card articles">
                        @if ($article->image)
                            <a href="{{ route('blog.article', $article->link) }}" class="card-image">
                                <figure class="image is-16by9">
                                    <img src="{{ asset('/storage/blog/' . $article->id . '.jpg') }}"
                                         alt="{{ $article->title }}">
                                </figure>
                            </a>
                        @endif

                        <div class="card-content">
                            <div class="media">
                                <div class="media-content">
                                    <a href="{{ route('blog.article', $article->link) }}" class="title">
                                        {{ $article->title }}
                                    </a>
                                    <hr>
                                    <div class="level meta">
                                        <div class="level-left">
                                            <span class="level-item">
                                                By&nbsp;<a href="{{ route('page.about') }}">{{ config('me.nickname') }}</a>
                                            </span>
                                            <span class="level-item">
                                                <i class="fas fa-circle fa-xs"></i>
                                            </span>
                                            <span class="level-item">{{ $article->created }}</span>
                                        </div>
                                        <div class="level-right">
                                            <span class="level-item">
                                                <i class="fas fa-clock fa-xs"></i>&nbsp;{{ reading_time($article->content) }}
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="content">
                                {!! $article->excerpt !!}
                            </div>
                        </div>

                        <footer class="level tags">
                            <div class="level-left">
                            <span class="level-item">
                                <i class="fas fa-tags"></i>
                            </span>
                                @foreach($article->tags as $tag)
                                    <a href="{{ route('blog.tags', $tag->tag) }}" class="level-item">{{ $tag->tag }}</a>
                                @endforeach
                            </div>
                        </footer>

                        @php
                            $kind = 'empty';
                            if ($article->image)
                                $kind = 'image';
                        @endphp
                        <div class="footer-line {{ $kind }}"></div>
                    </div>
                @endforeach

                <div class="pagination">
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection