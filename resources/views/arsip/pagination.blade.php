@if ($paginator->hasPages())
<div class="pagination">
    {{-- Tombol Halaman Pertama & Sebelumnya --}}
    @if ($paginator->onFirstPage())
        <span class="disabled">«</span>
        <span class="disabled">‹</span>
    @else
        <a href="{{ $paginator->url(1) }}">«</a>
        <a href="{{ $paginator->previousPageUrl() }}">‹</a>
    @endif

    {{-- Nomor Halaman --}}
    @foreach ($elements as $element)
        {{-- Ellipsis --}}
        @if (is_string($element))
            <span class="ellipsis">{{ $element }}</span>
        @endif

        {{-- Link Halaman --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Tombol Halaman Berikutnya & Terakhir --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}">›</a>
        <a href="{{ $paginator->url($paginator->lastPage()) }}">»</a>
    @else
        <span class="disabled">›</span>
        <span class="disabled">»</span>
    @endif
</div>
@endif
