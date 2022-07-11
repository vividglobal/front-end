@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())

                <li class="disabled cursor" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lt;</span>
                </li>
            @else
                <li>
                    <a class="page-link" href="{{ \Request::url() }}" rel="prev" aria-label="@lang('pagination.first')">&#60;</a>
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
                            <li class="active"><span>{{ $page }}</span></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <li><a href="{{ $url }}"  id="div-mobile">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <li class="disabled" id="div-mobile"><span><i class="fa fa-ellipsis-h"></i></span></li>
                        @else
                            <li class="cursor" id="div-pc" ><a >{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="cursor">
                    <a id="next_page" href="{{ \Request::url().'?page='.$paginator->lastPage() }}" rel="next" aria-label="@lang('pagination.next')">&gt;</a>
                </li>
            @else
                <li class="disabled cursor" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&gt;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif


