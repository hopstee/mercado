@if ($paginator->hasPages())
    <ul class="pagination justify-content-between align-items-center" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link mob-page previous-page"></span>
                <!-- <span class="page-link">@lang('pagination.previous')</span> -->
            </li>
        @else
            <li class="page-item">
                <a class="page-link mob-page previous-page" href="{{ $paginator->previousPageUrl() }}" rel="prev"></a>
                <!-- <a class="page-link btn-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a> -->
            </li>
        @endif

        <li class="page-item">
            <span style="color: #90A4AE;font-size: 14px;">Page {{$paginator->currentPage()}} of {{$paginator->lastPage()}}</span>
        </li>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link mob-page next-page" href="{{ $paginator->nextPageUrl() }}" rel="next"></a>
                <!-- <a class="page-link next-page btn-primary" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a> -->
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link mob-page next-page"></span>
                <!-- <span class="page-link next-page">@lang('pagination.next')</span> -->
            </li>
        @endif
    </ul>
@endif
