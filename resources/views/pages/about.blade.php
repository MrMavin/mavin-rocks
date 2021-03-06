@extends('layouts.default')

@section('title', 'About')
@section('page', 'about')

@push('meta')
    @php
        view()->share('description', "As a programmer I've got many years of experience. I'm very passionate about what I do and I'm very committed on following my objectives. As a person, I'm always looking to grow and to follow my hobbies.");
    @endphp
    <meta property="og:type" content="profile">
    <meta property="profile:first_name" content="{{ config('me.name') }}">
    <meta property="profile:last_name" content="{{ config('me.surname') }}">
    <meta property="profile:username" content="{{ config('me.nickname') }}">
    <meta property="profile:gender" content="{{ config('me.gender') }}">
@endpush

@section('content')
    <div class="background">
        <div class="container sr-p">
            <div class="columns">
                <div class="column is-half bg-grey-dark" id="developer">
                    <section class="hero">
                        <div class="hero-body">
                            <div class="content">
                                {!! parsedown('pages.about.developer', true) !!}
                            </div>
                        </div>
                    </section>
                </div>
                <div class="column is-half bg-black-ter" id="person">
                    <section class="hero">
                        <div class="hero-body">
                            <div class="content">
                                {!! parsedown('pages.about.person', true) !!}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-black-bis">
        <div class="container sr-p">
            <div class="columns is-centered" id="hobbies">
                <div class="column is-half">
                    <section class="hero">
                        <div class="hero-body">
                            <div class="content">
                                {!! parsedown('pages.about.hobbies', true) !!}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection