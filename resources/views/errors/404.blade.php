@extends('layouts.default')

@section('title', 'Page not found')
@section('page', 'error')

@push('meta')
    @php
        view()->share('description', 'Page not found');
    @endphp
@endpush

@section('content')
    <section class="hero is-dark is-halfheight">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    404
                </h1>
                <h2 class="subtitle">
                    Page not found
                </h2>
                <p>
                    <a href="{{ route('page.home') }}">Go back home</a>
                </p>
            </div>
        </div>
    </section>
@endsection