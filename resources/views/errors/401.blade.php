@extends('layouts.default')

@section('title', 'Unauthorized')
@section('page', 'error')

@push('meta')
    @php
        view()->share('description', 'You are not authorized to perform this request');
    @endphp
@endpush

@section('content')
    <section class="hero is-dark is-halfheight">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    403
                </h1>
                <h2 class="subtitle">
                    Unauthorized
                </h2>
                <p>
                    <a href="{{ route('auth.github') }}">Login</a>
                </p>
            </div>
        </div>
    </section>
@endsection