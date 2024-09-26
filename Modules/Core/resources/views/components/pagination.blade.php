@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination tp-pagination">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled page-item"><span class="page-link">Previous</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled page-item"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        {{-- Show first 3 and last 3 pages if total pages exceed 8 --}}
                        @if ($paginator->lastPage() > 8)
                            @if ($page == 1 || $page == $paginator->lastPage() || ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 1))
                                @if ($page == $paginator->currentPage())
                                    <li class="active page-item"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @elseif ($page == 2 || $page == $paginator->lastPage() - 1)
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                
                            @endif
                        @else
                            {{-- Less than 8 pages: display normally --}}
                            @if ($page == $paginator->currentPage())
                                <li class="active page-item"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
            @else
                <li class="disabled page-item"><span class="page-link">Next</span></li>
            @endif
        </ul>
    </nav>
@endif

