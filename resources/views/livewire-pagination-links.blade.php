<div>
    <!-- PAGINADOR PARA LAS TABLAS EXISTENTES EN EL SOFTWARE -->
    @if ($paginator->hasPages())
        <ul class="flex items-center justify-center space-x-2 mt-4">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a href="javascript:;" class="px-3 py-1 bg-gray-200 text-gray-500 cursor-not-allowed rounded"><i
                            class="fa-solid fa-chevrons-left" style="color: #005eff;"></i></a>
                </li>
            @else
                <li class="page-item">
                    <a href="javascript:;" wire:click="previousPage" rel="prev"
                        class="px-3 py-1 bg-white text-gray-700 border border-gray-300 rounded hover:bg-gray-100"><i
                            class="fa-solid fa-chevrons-left outline-blue-900 hover:text-white "
                            style="color: #005eff;"></i></a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">
                        <a
                            class="px-3 py-1 bg-gray-200 text-gray-500 outline-blue-900  hover:text-white cursor-not-allowed rounded">{{ $element }}</a>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <a href="javascript:;" wire:click="gotoPage({{ $page }})"
                                    class="px-3 py-1 bg-blue-500 text-white border border-blue-500 rounded">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a href="javascript:;" wire:click="gotoPage({{ $page }})"
                                    class="px-3 py-1 bg-white text-gray-700 border border-gray-300 rounded hover:bg-gray-100">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a href="javascript:;" wire:click="nextPage"
                        class="px-3 py-1 bg-white text-gray-700 border border-gray-300 rounded hover:bg-gray-100"><i
                            class="fa-solid fa-chevrons-right" style="color: #3e00fa;"></i></a>
                </li>
            @else
                <li class="page-item disabled">
                    <a href="javascript:;" class="px-3 py-1 bg-gray-200 text-gray-500 cursor-not-allowed rounded"><i
                            class="fa-solid fa-chevrons-right" style="color: #3e00fa;"></i></a>
                </li>
            @endif
        </ul>
    @endif
</div>
