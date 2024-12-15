<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arsip Dokumen - {{ $level }}</title>
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
    <style type="text/css">
      h1.title, h3.subtitle {
      text-align: center;
      }
      h1.title {
      font-weight: 900;
      }
      .is-main h1.title {
      font-size: 3rem;
      }
      .is-main h3.subtitle {
      font-size: 2rem;
      }
    </style>
  </head>
  <body>
    <section class="hero is-light">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">Arsip Dokumen Tahun Anggaran {{ $tahun }}</h1>
          <h3 class="subtitle">Per {{ $level }}</h3>
        </div>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="b-table has-pagination">
          <div class="table-wrapper has-mobile-cards">
            @yield('table')
          </div>
          {{ $data->links('arsip.pagination') }}
        </div>
      </div>
    </section>
  </body>
</html>