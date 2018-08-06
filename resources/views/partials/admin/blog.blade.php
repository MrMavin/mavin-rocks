<aside class="menu">
    <p class="menu-label">
        Articles
    </p>
    <ul class="menu-list">
        <li>
            <a href="{{ route('admin.blog.article.list') }}" class="{{ is_active('article.list') }}">
                <span class="icon">
                  <i class="fas fa-list"></i>
                </span>
                List
            </a>
        </li>
        <li>
            <a href="{{ route('admin.blog.article.create') }}" class="{{ is_active('article.create') }}">
                <span class="icon align-right">
                  <i class="fas fa-plus-circle"></i>
                </span>
                New
            </a>
        </li>
    </ul>
</aside>