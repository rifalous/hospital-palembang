@if ($paginator->hasPages())
    <div class="shop_page_nav d-flex flex-row">
        @if ($paginator->onFirstPage())
            <div class="page_prev d-flex flex-column align-items-center justify-content-center disabled"><i class="fas fa-chevron-left"></i></div>
        @else
        <a href="{{ $paginator->previousPageUrl() }}"><div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div></a>
        @endif

        <ul class="page_nav d-flex flex-row">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><a href="#">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="#">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                           
                    @endforeach
                @endif
            @endforeach
        </ul>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"><div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div></a>
        @else
            <div class="page_next d-flex flex-column align-items-center justify-content-center disabled"><i class="fas fa-chevron-right"></i></div>
        @endif
    </div>
@endif