@if ($paginator->hasPages())

   <nav>
                              <ul>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="#" class="page-link"><i class="fa-regular fa-arrow-left"></i></a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev" aria-label="@lang('pagination.previous')"><i class="fa-regular fa-arrow-left"></i></a>
            </li>
        @endif


        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="current" aria-current="page">
                            <a href="{{ $url }}" class="page-link current">{{ $page }}</a>
                        </li>
                    @else
                        <li><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next" aria-label="@lang('pagination.next')"><i class="fa-regular fa-arrow-right"></i></a>
            </li>
        @else
            <li class="disabled"  aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="#" class="page-link"><i class="fa-regular fa-arrow-right"></i></a>
            </li>
        @endif
    </ul>
   </nav>
@endif
