@extends('arsip.layout')
@section('table')
@include('arsip.search')
<table>
    <thead>
        <tr>
            <th>Kegiatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
        <tr>
            <td data-label="Kegiatan">{{ $item->rincian }}</td>
            <td class="actions">
                <a href="{{ route('daftar-file', ['token' => $token, 'kak' => $item->id_link]) }}" class="action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </a>
                <a href="{{ route('download-folder', ['token' => $token, 'kak' => $item->id_link]) }}" class="action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 13.5 3 3m0 0 3-3m-3 3v-6m1.06-4.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                    </svg>
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="2">Tidak ada rincian kegiatan yang ditemukan.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
@section('script')
@if(session('message') && session('type'))
<script>
    new CustomToast().show("{{ session('message') }}", "{{ session('type') }}", 10000);
</script>
@endif
@include('arsip.search-script')
@endsection