@if ($paginator->hasPages())
    <nav class="d-flex justify-content-center mt-4">
        <ul class="pagination pagination-lg mb-0">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled mx-1" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link bg-light text-muted border-0 rounded-pill px-4 py-2">
                        ‹
                    </span>
                </li>
            @else
                <li class="page-item mx-1">
                    <a class="page-link text-success border-success rounded-pill px-4 py-2"
                       href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        ‹
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled mx-1" aria-disabled="true">
                        <span class="page-link bg-light text-muted border-0 rounded-pill px-4 py-2">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active mx-1" aria-current="page">
                                <span class="page-link bg-success border-success text-white rounded-pill px-4 py-2">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item mx-1">
                                <a class="page-link text-success border-success rounded-pill px-4 py-2" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item mx-1">
                    <a class="page-link text-success border-success rounded-pill px-4 py-2"
                       href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        ›
                    </a>
                </li>
            @else
                <li class="page-item disabled mx-1" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link bg-light text-muted border-0 rounded-pill px-4 py-2">
                        ›
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
