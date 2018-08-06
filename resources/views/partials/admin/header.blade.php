<nav id="navigation" class="navbar admin" role="navigation" aria-label="navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('admin.index') }}">
                Admin Panel
            </a>
        </div>
        <div class="navbar-menu">
            <div class="navbar-start">
                <a href="{{ route('page.home') }}" class="navbar-item" target="_blank">
                    Site
                </a>
            </div>
            <div class="navbar-end">
                <a href="{{ route('admin.blog.article.list') }}" class="navbar-item {{ is_active('admin.blog') }}">
                    Blog
                </a>
            </div>
        </div>
    </div>
</nav>