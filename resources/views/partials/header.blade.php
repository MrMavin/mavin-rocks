<nav id="navigation" class="navbar closed" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item logo" href="{{ route('page.home') }}">
                @include('partials.logo')
            </a>
            <a role="button" class="navbar-burger">
                <i class="fa-fw fas fa-2x fa-bars show-open"></i>
                <i class="fa-fw fas fa-2x fa-times show-close"></i>
            </a>
        </div>
        <div class="navbar-menu">
            @if (\Auth::check())
                <div class="navbar-start">
                    <a href="{{ route('admin.index') }}" class="navbar-item" target="_blank">
                        Admin
                    </a>
                </div>
            @endif
            <div class="navbar-end">
                <a href="{{ route('page.home') }}" id="nav-home" class="navbar-item {{ is_active('home') }}">
                    Home
                </a>
                <a href="{{ route('page.about') }}" id="nav-about" class="navbar-item {{ is_active('about') }}">
                    Me
                </a>
                <a href="{{ route('page.skills') }}" id="nav-skills" class="navbar-item {{ is_active('skills') }}">
                    Skills
                </a>
                <a href="{{ route('blog.list') }}" id="nav-blog" class="navbar-item {{ is_active('blog') }}">
                    Blog
                </a>
            </div>
        </div>
    </div>
</nav>