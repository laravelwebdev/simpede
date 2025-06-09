
@extends('arsip.layout')
@section('table')
@include('arsip.search')
<table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
  <thead>
    <tr>
      <th>Rincian Output</th>
      <th>Komponen</th>
      <th>Akun</th>
      <th>Detail</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @forelse ( $data as $item )
    <tr>
      <td data-label="Rincian Output">{{ \App\Helpers\Helper::getDetailAnggaran($item->mak, 'ro', $tahun) }}</td>
      <td data-label="Komponen">{{ \App\Helpers\Helper::getDetailAnggaran($item->mak, 'komponen', $tahun) }}</td>
      <td data-label="Akun">{{ \App\Helpers\Helper::getDetailAnggaran($item->mak, 'akun', $tahun) }}</td>
      <td data-label="Detail">{{ $item->uraian }}</td>
      <td class="is-actions-cell">
        <div class="buttons is-right">
        <a href="{{ route('arsip-per-kak', ['token' => $token, 'coa' => $item->id]) }}">
          <button class="button is-outlined is-primary" type="button">
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>              
            </span>
          </button>
          </a>
        </div>
      </td>
    </tr>
      @empty
      <tr>
      <td colspan="5" class="has-text-centered">Tidak ada rincian output yang ditemukan.</td>
      </tr>
    @endforelse  
  </tbody>
</table>
@endsection

@section('script')
@include('arsip.search-script')
@endsection
