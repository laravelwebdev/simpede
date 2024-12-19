
@extends('arsip.layout')
@section('table')
<table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
  <thead>
    <tr>
      <th>Nama File</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $data as $item )
    @php
          $arr = explode('/', $item);
          $filename = end($arr);
    @endphp
    <tr>
      <td data-label="Nama File"> {{ $filename }}</td>
      <td class="is-actions-cell">
        <div class="buttons is-right">
        <a target="_blank" href="{{ \Illuminate\Support\Facades\Storage::disk('arsip')->url($item) }}">
          <button class="button is-small is-primary" type="button">Link</button>
          </a>
        </div>
      </td>
    </tr>
    @endforeach      
  </tbody>
</table>
@endsection