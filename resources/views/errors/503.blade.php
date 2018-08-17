@extends('layouts.default')

@section('title', 'Page not found')
@section('page', 'error')

@push('meta')
    @php
        view()->share('description', 'Maintenance mode');
    @endphp
@endpush

@section('content')
    <section class="hero is-dark is-halfheight">
        <div class="hero-body">
            <div class="container">
                <h1 class="title small">
                    Maintenance mode
                </h1>
                <h2 class="subtitle small">
                    Getting back shortly
                </h2>
            </div>
        </div>
    </section>
@endsection