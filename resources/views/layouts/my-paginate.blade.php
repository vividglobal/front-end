@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())

                <li class="disabled cursor" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lt;</span>
                </li>
            @else
                <li class="cursor">
                    <a class="" href="{{!request ()-> is ('analysis/violation-by-brand') && !request ()-> is ('analysis/violation-by-code') ? \Request::url() : "javascript:void(0)" }}" rel="prev" aria-label="@lang('pagination.first')">&#60;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li class="cursor" ><a >{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="cursor">
                    <a id="next_page" href="{{!request ()-> is ('analysis/violation-by-brand') && !request ()-> is ('analysis/violation-by-code') ? \Request::url().'?page='.$paginator->lastPage() : 'javascript:void(0)'}}" rel="next" aria-label="@lang('pagination.next')">&gt;</a>
                </li>
            @else
                <li class="disabled cursor" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&gt;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif


