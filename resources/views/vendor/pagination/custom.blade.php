@if ($paginator->hasPages())
    <nav class="flex justify-center space-x-2 mt-4">
        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 rounded bg-gray-300 text-gray-500 cursor-not-allowed">Sebelumnya</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 rounded bg-[#0F4696] text-white hover:bg-blue-700">Sebelumnya</a>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-500">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 rounded bg-[#0f4696] text-white font-bold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1 rounded bg-gray-200 text-[#0F4696] hover:bg-gray-300">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 rounded bg-[#0F4696] text-white hover:bg-blue-700">Berikutnya</a>
        @else
            <span class="px-3 py-1 rounded bg-gray-300 text-gray-500 cursor-not-allowed">Berikutnya</span>
        @endif
    </nav>
@endif
