@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row justify-between items-center mt-6 space-y-4 sm:space-y-0">
        <!-- Results Information -->
        <span>
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </span>

        <!-- Pagination Links -->
        <nav role="navigation" aria-label="Pagination" class="flex justify-end items-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-100">
                    Previous
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-4 py-2">{{ $element }}</span>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 bg-gray-200 border border-gray-300 rounded-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-100">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-100">
                    Next
                </a>
            @else
                <span class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                    Next
                </span>
            @endif
        </nav>
    </div>
@endif
