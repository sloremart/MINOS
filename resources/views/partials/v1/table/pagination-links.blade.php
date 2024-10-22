<div class="relative">
    @if ($paginator->hasPages())
        <nav aria-label="Page navigation example" class="relative z-10">
            <ul class="flex items-center space-x-2 text-sm">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed">
                            &lsaquo;
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                                class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 relative z-20">
                            &lsaquo;
                        </button>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-500 rounded relative z-20">
                                {{ $element }}
                            </span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded relative z-20">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <button type="button" class="inline-flex items-center px-3 py-1 bg-white text-blue-500 border border-gray-300 rounded hover:bg-gray-100 relative z-20"
                                            wire:click="gotoPage({{ $page }})">
                                        {{ $page }}
                                    </button>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                                class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 relative z-20">
                            &rsaquo;
                        </button>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="inline-flex items-center px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed relative z-20">
                            &rsaquo;
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
