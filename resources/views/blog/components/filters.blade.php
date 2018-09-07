@if (!empty($tag) || !empty($category))
    <div class="filters">
        <div class="content">
            <h1 class="title">
                Filter
            </h1>
            <h2 class="subtitle">
                @if (!empty($tag))
                    <span class="icon">
                        <i class="fas fa-fw fa-tag"></i>
                    </span>
                    #{{ $tag->tag }}
                @elseif (!empty($category))
                    <span class="icon">
                        <i class="fas fa-fw fa-list"></i>
                    </span>
                    {{ $category->name }}
                @endif

            </h2>
        </div>
    </div>
@endif
