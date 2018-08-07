@extends('layouts.default')

@section('title', 'Home')
@section('page', 'home')

@push('meta')
    @php
        view()->share('description', 'I am Mavin, a full stack web developer and aspirant blogger from Italy. Have a look at my personal website and portfolio to discover more about my skills, me and my hobbies.');
        view()->share('image', asset(mix('images/lead.jpg')))
    @endphp
    <meta property="og:type" content="website">
@endpush

@section('content')
    {{-- Keep inline style. Otherwise Barba.js won't correctly load the image (TODO: barba refresh styles) --}}
    <section class="hero welcome is-halfheight sr-c" style="background: url('{{ mix('images/lead.jpg') }}') no-repeat left top; background-size: cover;">
        <div class="hero-body">
            <div class="container">
                <h1 class="is-uppercase">
                    <span class="color-red">Ma</span>rragony
                </h1>
                <h2 class="is-uppercase">
                    <span class="color-red">Vin</span>cenzo
                </h2>
                <p>
                    <i class="fas fa-code"></i> Full Stack Web Developer / <i class="fas fa-newspaper"></i> Blogger
                </p>
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
                        TL;DR I'm a programmer. Always looking for new challenges and growth paths.
                    </h2>
                    <hr>
                </div>
                <div class="columns">
                    @php
                        $cards = [
                            [
                                'icon' => 'code',
                                'title' => 'Programmer',
                                'text' => "Discover me as an experienced and passionate programmer"
                            ], [
                                'icon' => 'user',
                                'title' => 'Person',
                                'text' => "Read my story, my personality, my interests and my future plans"
                            ], [
                                'icon' => 'book',
                                'title' => 'Hobbies',
                                'text' => "Learn about my free time and how my side activities helps me grow"
                            ],
                        ];
                    @endphp

                    @foreach($cards as $card)
                        <div class="column is-flex {{ strtolower($card['title']) }}">
                            <a href="{{ route('page.about') }}" class="card">
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
                                'description' => 'Up to php7.2 and latest standards. HHVM user'
                            ],[
                                'kind' => 'backend',
                                'icon' => 'exchange-alt fas',
                                'name' => 'APIs',
                                'description' => 'Very experienced in building APIs'
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
                                'description' => "Experienced in ES6 and JQuery. Thinking about the next framework to learn"
                            ],[
                                'kind' => 'frontend',
                                'icon' => 'mobile-alt fas',
                                'name' => 'Responsiveness',
                                'description' => 'Mobile, tablet and desktop design to provide a fluid experience'
                            ],[
                                'kind' => 'sysadmin',
                                'icon' => 'linux fab',
                                'name' => 'GNU/Linux',
                                'description' => 'Proud Fedora Linux user since 5 years now. SysAdmin skills included'
                            ],[
                                'kind' => 'sysadmin',
                                'icon' => 'database fas',
                                'name' => 'Databases',
                                'description' => 'MySQL, MariaDB, redis. Learning non relational databases'
                            ],[
                                'kind' => 'sysadmin',
                                'icon' => 'git fab',
                                'name' => 'Git',
                                'description' => 'Version control systems, working with many people on a single project'
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