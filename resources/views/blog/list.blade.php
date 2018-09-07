@extends('layouts.default')

@php
    $title = 'blog';

    if (isset($tag))
        $title = $tag;

    if (isset($category))
        $title = $category;

    $title = ucfirst($title);
@endphp

@section('title', $title)
@section('page', 'blog')

@section('content')
    <div class="container">
        <div class="columns is-multiline">
            @include('blog.sidebar')

            <div class="column is-9">
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
                                    @include('blog.components.meta')
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
                                    <a href="{{ route('blog.tag', $tag->tag) }}" class="level-item">{{ $tag->tag }}</a>
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