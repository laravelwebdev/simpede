@extends('arsip.layout')
@section('table')
<table class="table is-fullwidth is-striped is-hoverable is-fullwidth">
  <thead>
    <tr>
      <th>KRO</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ( $data as $item )
    <tr>
      <td data-label="KRO">{{ $item->KRO }}</td>
      <td class="is-actions-cell">
        <div class="buttons is-right">
          <a target="_blank" href="{{ route('arsip-per-detail', ['token' => $token , 'kro' => $item->KRO]) }}">
          <button class="button is-small is-primary" type="button">Link</button>
          </a>
        </div>
      </td>
    </tr>
    @endforeach      
  </tbody>
</table>
@endsection