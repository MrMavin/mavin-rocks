@if (!empty($filters))
    <div class="filters">
        <div class="content">
            <h1 class="title">
                Filters
            </h1>
            <h2 class="subtitle">
                @foreach($filters as $filter => $value)
                    @if ($filter == 'tag')
                        <span class="icon">
                             <i class="fas fa-fw fa-tag"></i>
                        </span>
                        {{ $value }}
                    @endif
                @endforeach
            </h2>
        </div>
    </div>
@endif