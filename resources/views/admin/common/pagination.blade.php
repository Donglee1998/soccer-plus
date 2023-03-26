@if ($paginator->hasPages())
    <?php $records = request('records');?>
    <ul class="pager">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <li>
                <a class="fixRadius" href="{{ $paginator->previousPageUrl() }}">
                     戻る
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><strong>{{ $page }}</strong></li>
                    @else
                        <li class="link"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a class="fixRadius" href="{{ $paginator->nextPageUrl() }}">
                    次へ
                </a>
            </li>
        @endif
    </ul>
@endif
