@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">« Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">« Previous</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next »</a>
        @else
            <span class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">Next »</span>
        @endif

        <br>
        <span>
            Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
        </span>

        {{-- Total Books Information --}}
        <br>
        <span>
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </span>
    </div>
@endif
