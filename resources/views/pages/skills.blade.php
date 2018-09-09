@extends('layouts.default')

@section('title', 'Skills')
@section('page', 'skills')

@push('meta')
    @php
        view()->share('description', 'My competences vary through back-end and front-end programming and system administration. I know many technologies, programs, techniques and languages that help me to provide valuable applications and services.');
    @endphp
@endpush

@php
    function printSkillLevel($skill)
    {
        $icons = ['far fa-star', 'fas fa-star-half-alt', 'fas fa-star'];

        $level = intval(substr($skill, 0, 1));
        $skill = substr($skill, 1);
        $icon = isset($icons[$level - 1]) ? $icons[$level - 1] : 0;

        return "<i class=\"fa-fw $icon\"></i> $skill";
    }
@endphp

@section('content')
    <section class="hero info sr">
        <div class="hero-body">
            <div class="container">
                <div class="section">
                    <h1><i class="fa-fw fas fa-info-circle"></i> My skills</h1>
                    <hr>
                    <div class="columns is-multiline">
                        <div class="column is-12-touch is-6-desktop">
                            <ul>
                                <li>
                                    <strong>Categories</strong>
                                </li>
                                <li>
                                    <i class="fa-fw fas fa-cog"></i>&nbsp;<span class="color-red">Back-end programming</span>
                                </li>
                                <li>
                                    <i class="fa-fw fas fa-desktop"></i>&nbsp;<span class="color-green">Front-end presentation</span>
                                </li>
                                <li>
                                    <i class="fa-fw fas fa-server"></i>&nbsp;<span
                                            class="color-orange">System administration</span>
                                </li>
                            </ul>
                        </div>
                        <div class="column is-12-touch is-6-desktop">
                            <ul>
                                <li>
                                    <strong>Experience level</strong>
                                </li>
                                <li>
                                    <i class="fa-fw far fas fa-star"></i> Expert, high confidence
                                </li>
                                <li>
                                    <i class="fa-fw fas fa-star-half-alt"></i> Experienced, medium confidence
                                </li>
                                <li>
                                    <i class="fa-fw far fa-star"></i> Intermediate, need review, medium/low confidence
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="hero backend sr">
        <div class="hero-body">
            <div class="container">
                <div class="section">
                    <h1><i class="fa-fw fas fa-cog"></i> Back-end</h1>
                    <hr>
                </div>
                <div class="columns is-multiline">
					<?php
					$backend = [
						[
							'icon' => 'fas fa-file-code',
							'title' => 'Languages',
							'skills' => '3PHP,1Java'
                        ],
						[
							'icon' => 'fab fa-laravel',
							'title' => 'Frameworks',
							'skills' => '3Laravel,3Lumen (API),1CodeIgniter,1Grav,1OctoberCMS,1Wordpress'
						],
						[
							'icon' => 'fas fa-download',
							'title' => 'Software',
							'skills' => '3phpStorm,2Vagrant,2Slack,2Postman'
						],
						[
							'icon' => 'fas fa-cubes',
							'title' => 'Packages',
							'skills' => '3Composer,3npm'
						],
						[
							'icon' => 'fas fa-code-branch',
							'title' => 'VCS',
							'skills' => '3Git,3GitHub,2GitLab'
						]
					];
					?>

                    @each('pages.skills.card', $backend, 'set')
                </div>
            </div>
        </div>
    </section>

    <section class="hero frontend sr">
        <div class="hero-body">
            <div class="container">
                <div class="section">
                    <h1><i class="fa-fw fas fa-desktop"></i> Front-end</h1>
                    <hr>
                </div>
                <div class="columns is-multiline">
					<?php
					$frontend = [
						[
							'icon' => 'fab fa-html5',
							'title' => 'Presentation',
							'skills' => '3HTML 5,3CSS 3,3Sass/Scss,2Less,1PUG,1HAML'
						],
						[
							'icon' => 'fab fa-uikit',
							'title' => 'Frameworks',
							'skills' => '3Bulma,2Semantic-UI,2Bootstrap,2UI-Kit,1Foundation'
						],
						[
							'icon' => 'fab fa-js',
							'title' => 'Javascript',
							'skills' => '3ES6,3jQuery,2React,2Webpack'
						],
						[
							'icon' => 'fas fa-plus-square',
							'title' => 'Misc',
							'skills' => '3Responsiveness,3Usability,2SEO,2i18n'
						]
					];
					?>

                    @each('pages.skills.card', $frontend, 'set')
                </div>
            </div>
        </div>
    </section>

    <section class="hero sysadmin sr">
        <div class="hero-body">
            <div class="container">
                <div class="section">
                    <h1><i class="fa-fw fas fa-server"></i> System Administration</h1>
                    <hr>
                </div>
                <div class="columns is-multiline">
					<?php
					$sysadmin = [
						[
							'icon' => 'fab fa-linux',
							'title' => 'GNU/Linux',
							'skills' => '3Fedora,3Debian,3Ubuntu,2ArchLinux'
						],
						[
							'icon' => 'fas fa-database',
							'title' => 'Databases',
							'skills' => '3Mysql,3MariaDB,3redis'
						],
						[
							'icon' => 'fas fa-server',
							'title' => 'Servers',
							'skills' => '3NGINX,2SSL/TLS,2HTTPv2,1HHVM,1Apache'
						],
                        [
							'icon' => 'fas fa-wrench',
							'title' => 'DevOps',
							'skills' => '3Docker,3Hosting,3Backups,3Deployment,3Management,2Testing'
						],
						[
							'icon' => 'fas fa-plus-square',
							'title' => 'Misc',
							'skills' => '3Terminal,3DigitalOcean,3PGP,2AWS,2Blockchain,2Tor'
						]
					];
					?>

                    @each('pages.skills.card', $sysadmin, 'set')
                </div>
            </div>
        </div>
    </section>
@endsection