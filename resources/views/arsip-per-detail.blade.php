
@extends('arsip.layout')
@section('table')
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
          <button class="button is-small is-primary" type="button">Link</button>
          </a>
        </div>
      </td>
    </tr>
    @endforeach      
  </tbody>
</table>
@endsection
