<style>
    @media screen and (max-width: 1024px) {
        #pagination-custom {
            justify-content: center !important;
        }
    }

    @media screen and (max-width: 768px) {
        #pagination-custom {
            justify-content: flex-end !important;
        }
    }
</style>

@if ($paginator->hasPages())
    <nav class="mt-3 shop-pages d-flex justify-content-between align-items-center" role="navigation"
        aria-label="Pagination">


        <!-- Showing Results -->
        <div class="small text-muted">
            {!! __('Showing') !!}
            <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
            {!! __('of') !!}
            <span class="fw-semibold">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </div>

        <div class="d-flex align-items-center" id="pagination-custom">
            <!-- PREV Button -->
            @if (!$paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}" class="mx-2 page-link d-inline-flex align-items-center">
                    <svg class="me-1" width="7" height="11" viewBox="0 0 7 11"
                        xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_sm" />
                    </svg>
                    <span class="fw-medium">PREV</span>
                </a>
            @endif

            <!-- Pagination Links -->
            <ul class="mx-2 mb-0 pagination">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li class="page-item {{ $paginator->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                    @endif
                @endforeach
            </ul>

            <!-- NEXT Button -->
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="mx-2 page-link d-inline-flex align-items-center">
                    <span class="fw-medium me-1">NEXT</span>
                    <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_sm" />
                    </svg>
                </a>
            @endif
        </div>

    </nav>
@endif
