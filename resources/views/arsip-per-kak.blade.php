
@extends('arsip.layout')
@section('table')
<table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
  <thead>
    <tr>
      <th>Rincian Kegiatan</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $data as $item )
    <tr>
      <td data-label="Rincian Kegiatan">{{ $item->rincian }}</td>
      <td class="is-actions-cell">
        <div class="buttons is-right">
        <a target="_blank" href="{{ route('daftar-file', ['token' => $token, 'kak' => $item->id]) }}">
          <button class="button is-small is-primary" type="button">Link</button>
          </a>
        </div>
      </td>
    </tr>
    @endforeach      
  </tbody>
</table>
@endsection