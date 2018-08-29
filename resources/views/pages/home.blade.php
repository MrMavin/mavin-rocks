@extends('layouts.default')

@section('title', 'Home')
@section('page', 'home')

@push('meta')
    @php
        view()->share('description', 'I am Mavin, a full stack web developer and aspirant blogger from Italy. Have a look at my personal website and portfolio to discover more about my skills, me and my hobbies.');
        view()->share('image', asset('/images/lead.jpg'))
    @endphp
    <meta property="og:type" content="website">
@endpush

@section('content')
    <section class="hero welcome is-halfheight sr-c">
        <div class="hero-body">
            <div class="container">
                <div class="title is-uppercase">
                    <span class="color-red">Ma</span>rragony
                </div>
                <div class="subtitle is-uppercase">
                    <span class="color-red">Vin</span>cenzo
                </div>
                <p>
                    <span id="typed"></span>
                </p>
                <div id="typed-strings" class="display-none">
                    <p>Full Stack Web Developer</p>
                    <p>System Administrator</p>
                    <p>Blogger</p>
                </div>
            </div>
        </div>
        <div class="arrow black-ter"></div>
    </section>

    <section class="hero who is-medium sr">
        <div class="hero-body">
            <div class="container">
                <div class="section">
                    <h1>About me</h1>
                    <h2>
                        TL;DR I'm a developer. Following my objectives and getting things done to achieve my long term goals.
                    </h2>
                    <hr>
                </div>
                <div class="columns">
                    @php
                        $cards = [
                            [
                                'icon' => 'code',
                                'title' => 'Developer',
                                'text' => "Discover me as an experienced developer with years of experience in the field"
                            ], [
                                'icon' => 'user',
                                'title' => 'Person',
                                'text' => "Read about me and my ideas. Understanding my culture will help you to know you I am"
                            ], [
                                'icon' => 'book',
                                'title' => 'Hobbies',
                                'text' => "Learn about how I spend my free time and what I like to do when I'm not coding"
                            ],
                        ];
                    @endphp

                    @foreach($cards as $card)
                        <div class="column is-flex {{ strtolower($card['title']) }}">
                            <a href="{{ route('page.about') }}" class="card" data-scroll="{{ strtolower($card['title']) }}">
                                <div class="card-content">
                                    <div class="content">
                                        <i class="fas fa-fw fa-5x fa-{{ $card['icon'] }}"></i>
                                        <h1>{{ $card['title'] }}</h1>
                                        <p>{{ $card['text'] }}</p>
                                    </div>
                                </div>
                            </a>
                            <div class="footer-line"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="arrow black-bis"></div>
    </section>

    <section class="hero what is-medium sr">
        <div class="hero-body">
            <div class="container">
                <div class="section">
                    <h1>Skills</h1>
                    <h2>
                        TL;DR <span class="color-red">Back-end</span> programming,
                        <span class="color-green">front-end</span> styling and
                        <span class="color-orange">system administration</span>
                    </h2>
                    <hr>
                </div>
                <div class="columns is-multiline sr-col">
                    @php
                        $skills = [
                            [
                                'kind' => 'backend',
                                'icon' => 'laravel fab',
                                'name' => 'Frameworks',
                                'description' => 'Laravel, Lumen, Grav, OctoberCMS, CodeIgniter'
                            ],[
                                'kind' => 'backend',
                                'icon' => 'php fab',
                                'name' => 'php',
                                'description' => 'Up to php7.2 and latest PSR standards'
                            ],[
                                'kind' => 'backend',
                                'icon' => 'exchange-alt fas',
                                'name' => 'APIs',
                                'description' => 'Experienced in writing APIs to make apps communicate'
                            ],[
                                'kind' => 'frontend',
                                'icon' => 'html5 fab',
                                'name' => 'HTML5 / CSS 3',
                                'description' => 'Including template engines, generators and preprocessors'
                            ],[
                                'kind' => 'frontend',
                                'icon' => 'sass fab',
                                'name' => 'SASS / SCSS',
                                'description' => 'Cleanliness and organization is a must. My favourite css extension'
                            ],[
                                'kind' => 'frontend',
                                'icon' => 'js fab',
                                'name' => 'JavaScript',
                                'description' => "Strong knowledge in ES6. React user"
                            ],[
                                'kind' => 'frontend',
                                'icon' => 'mobile-alt fas',
                                'name' => 'Responsiveness',
                                'description' => 'Mobile, tablet and desktop design to provide a fluid experience'
                            ],[
                                'kind' => 'sysadmin',
                                'icon' => 'linux fab',
                                'name' => 'GNU/Linux',
                                'description' => 'Proud Fedora Linux user since 5 years now. Ready to manage your server'
                            ],[
                                'kind' => 'sysadmin',
                                'icon' => 'database fas',
                                'name' => 'Databases',
                                'description' => 'Storing using MariaDB, caching with redis. Learning non relational databases'
                            ],[
                                'kind' => 'sysadmin',
                                'icon' => 'git fab',
                                'name' => 'Git',
                                'description' => 'Version control systems, working and issuing with many people on a single project'
                            ],[
                                'kind' => 'sysadmin',
                                'icon' => 'wrench fas',
                                'name' => 'DevOps',
                                'description' => 'Hosting, testing, backups, deployment, configurations, maintenance'
                            ]
                        ];
                    @endphp

                    @foreach($skills as $skill)
                        <div class="column is-2-fullhd is-3-widescreen is-4-desktop is-4-tablet is-12-mobile">
                            <div class="content {{ $skill['kind'] }}">
                                <i class="fa-fw fa-5x fa-{{ $skill['icon'] }}"></i>
                                <h3>{{ $skill['name'] }}</h3>
                                <p>{{ $skill['description'] }}</p>
                            </div>
                        </div>
                    @endforeach

                    <a href="{{ route('page.skills') }}"
                       class="column is-2-fullhd is-3-widescreen is-4-desktop is-4-tablet is-12-mobile">
                        <div class="content more">
                            <i class="fa-fw fa-5x fa-ellipsis-h fas"></i>
                            <h3>Many more</h3>
                            <p>Click here to discover all my skills...</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection