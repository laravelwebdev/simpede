
@extends('arsip.layout')
@section('table')
<div class="field is-grouped is-grouped-multiline">
  <div class="control">
    <input id="input-cari" class="input is-primary" type="text" placeholder="Cari Akun" />
  </div>
  <div class="control">
    <button id="tombol-cari" class="button is-primary is-light">
      <span class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.4-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
        </svg>
      </span>
    </button>
  </div>
</div>
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
    @foreach ( $data as $item )
    <tr>
      <td data-label="Rincian Output">{{ \App\Helpers\Helper::getDetailAnggaran($item->mak, 'ro', $tahun) }}</td>
      <td data-label="Komponen">{{ \App\Helpers\Helper::getDetailAnggaran($item->mak, 'komponen', $tahun) }}</td>
      <td data-label="Akun">{{ \App\Helpers\Helper::getDetailAnggaran($item->mak, 'akun', $tahun) }}</td>
      <td data-label="Detail">{{ $item->uraian }}</td>
      <td class="is-actions-cell">
        <div class="buttons is-right">
        <a target="_blank" href="{{ route('arsip-per-kak', ['token' => $token, 'coa' => $item->id]) }}">
          <button class="button is-small is-primary" type="button">
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
    @endforeach      
  </tbody>
</table>
@endsection

@section('script')
<script>
document.getElementById('tombol-cari').addEventListener('click', function() {
  var akun = document.getElementById('input-cari').value;
  var url = new URL(window.location.href);
  url.searchParams.set('akun', akun);
  url.searchParams.delete('page');
  window.location.href = url.toString();
});

document.getElementById('input-cari').addEventListener('keypress', function(event) {
  if (event.key === 'Enter') {
    var akun = document.getElementById('input-cari').value;
    var url = new URL(window.location.href);
    url.searchParams.set('akun', akun);
    url.searchParams.delete('page');
    window.location.href = url.toString();
  }
});

document.addEventListener('DOMContentLoaded', function() {
  var urlParams = new URLSearchParams(window.location.search);
  var akun = urlParams.get('akun');
  if (akun) {
    document.getElementById('input-cari').value = akun;
  }
});
</script>
@endsection
