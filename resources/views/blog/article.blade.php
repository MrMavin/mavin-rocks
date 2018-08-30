@extends('layouts.default')

@section('title', $article->title)
@section('page', 'blog article')

@push('meta')
    @php
        view()->share('description', $article->excerpt);
        if ($article->image)
            view()->share('image', asset('/storage/blog/' . $article->id . '.jpg'));
    @endphp
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ $article->created_at->format('c') }}">
    <meta property="article:modified_time" content="{{ $article->updated_at->format('c') }}">
    <meta property="article:author" content="{{ config('me.nickname') }}">
    @foreach($article->tags as $tag)
        <meta property="article:tag" content="{{ $tag->tag }}">
    @endforeach
@endpush

@section('content')
    <div class="container">
        <div class="columns is-multiline">
            @include('blog.sidebar')

            <div class="column is-9">
                <div class="article">
                    <h1 class="title">
                        {{ $article->title }}
                    </h1>
                    <hr>
                    @include('blog.components.meta')
                    <hr>
                    @if ($article->image)
                        <figure class="lead-image image is-16by9">
                            <img src="{{ asset('/storage/blog/' . $article->id . '.jpg') }}" alt="{{ $article->title }}">
                        </figure>
                    @endif
                    <div class="content">
                        {!! $article->content !!}
                    </div>
                    <footer class="level tags">
                        <div class="level-left">
                            <span class="level-item">
                                <i class="fas fa-tags"></i>
                            </span>
                            @foreach($article->tags as $tag)
                                <span class="level-item">{{ $tag->tag }}</span>
                            @endforeach
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
@endsection