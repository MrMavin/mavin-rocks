@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="pagination">
        <ul class="pagination-list">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="pagination-link is-disabled">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            @if ($page == $paginator->currentPage())
                                <span class="pagination-link is-current">{{ $page }}</span>
                            @else
                                <a class="pagination-link" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif