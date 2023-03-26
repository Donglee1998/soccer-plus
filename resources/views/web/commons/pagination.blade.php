@if ($paginator->hasPages())
    <?php $records = request('records');?>
    <ul class="pager">
        {{-- Previous Page Link --}}
            <span class="pagerOlderLink">
                @if (!$paginator->onFirstPage())
                    <a class="btnPagerCmn active" href="{{ $paginator->previousPageUrl() }}">
                @else
                    <a class="btnPagerCmn" href="{{ $paginator->previousPageUrl() }}">
                @endif
                    <svg class="iconArrow">
                        <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_prev" />
                    </svg>
                    前へ
                </a>
            </span>
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                <div class="pagerPagination">
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a class="active" href="{{ $url }}">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                </div>

                <span class="pagerPaginationSP">
                    <span>{{ $paginator->currentPage() }}</span> / <span>{{ $paginator->lastPage() }}</span>
                </span>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        <span class="pagerNewerLink">
                @if ($paginator->hasMorePages())
                    <a class="btnPagerCmn active" href="{{ $paginator->nextPageUrl() }}">
                @else
                    <a class="btnPagerCmn" href="{{ $paginator->nextPageUrl() }}">
                @endif
                次へ
                <svg class="iconArrow">
                    <use xlink:href="/assets/img/svg/symbol-defs.svg#icon_next" />
                </svg>
            </a>
        </span>
    </ul>
@endif