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
                    401
                </h1>
                <h2 class="subtitle">
                    Unauthorized
                </h2>
                <h3 class="info">
                    {{ $exception->getMessage() }}
                </h3>
            </div>
        </div>
    </section>
@endsection