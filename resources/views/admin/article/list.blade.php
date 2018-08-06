@extends('layouts.admin')

@section('title', 'Articles')

@section('content')
    <div class="list-articles">
        @includeWhen(session('notification'), 'common.notification', session('notification'))

        @foreach($articles as $article)
            <article class="media">
                <!--
                <div class="media-left">
                    <i class="fa-3x fas fa-video"></i>
                </div>
                -->
                <div class="media-content">
                    <div class="content">
                        <p class="is-marginless">
                            <a href="{{ route('admin.blog.article.edit', $article->id) }}">
                                <strong>{{ $article->title }}</strong>
                            </a>
                            <small>{{ $article->created }}</small>
                        </p>
                        <p class="@if (!$article->published) unpublished @endif">
                            {{ str_limit(strip_tags($article->excerpt), 255) }}
                        </p>
                    </div>
                </div>
            </article>
        @endforeach

        <hr>

        {{ $articles->links() }}
    </div>
@endsection