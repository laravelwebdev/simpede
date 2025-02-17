<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arsip Dokumen - {{ $level }}</title>
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/toast.min.js') }}"></script>
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
/**
* Custom Simple Toast Stylesheet
* Developed by: oretnom23
* Please load this file with the CustomToast.js file and Google Icons
*/
.toast {
    position: fixed;
    top: 25px;
    right: 25px;
    width: 300px;
    background: #fff;
    padding: 0.5em 0.35em;
    border-left: 4px solid #b7b7b7;
    border-radius: 4px;
    box-shadow: -1px 1px 10px #00000057;
    z-index: 1023;
    animation: leftToRight .5s ease-in-out forwards;
    transform: translateX(110%);
    }
    .toast.closing{
    animation: RightToLeft .5s ease-in-out forwards;
    }
    .toast-progress {
    position: absolute;
    display: block;
    bottom: 0;
    left: 0;
    height: 4px;
    width: 100%;
    background: #b7b7b7;
    animation: Toastprogress 3s ease-in-out forwards;
    }
    @keyframes leftToRight {
    0%{
        transform: translateX(110%);
    }
    75%{
        transform: translateX(-10%);
    }
    100%{
        transform: translateX(0%);
    }
    }
    @keyframes RightToLeft {
    0%{
        transform: translateX(0%);
    }
    25%{
        transform: translateX(-10%);
    }
    100%{
        transform: translateX(110%);
    }
    }
    @keyframes Toastprogress {
    0%{
        width: 100%;
    }
    100%{
        width: 0%;
    }
    }
    button.toast-close-btn {
    outline: none;
    background: none;
    border: none;
    float: right;
    cursor: pointer;
    }
    button.toast-close-btn>span,
    button.toast-close-btn>i{
    font-size:1.2rem;
    color:#747474;
    font-weight: 500;
    }
    button.toast-close-btn:hover>span,
    button.toast-close-btn:hover>i{
    color:#585858;
    }
    .toast-content-wrapper {
    display: flex;
    /* margin-top: 1rem; */
    justify-content: space-evenly;
    align-items: start;
    }
    .toast-icon {
    padding: 0.35rem 0.5rem;
    }
    .toast-message {
    font-size: .9rem;
    color: #424242;
    padding: 0.15rem 0.5rem;
    }
   
    /* success toast */
    .toast.toast-success{
    border-color: #03e05f;
    }
    .toast.toast-success .toast-progress{
    background-color:  #088d3f;
    }
    .toast.toast-success .toast-icon>span,
    .toast.toast-success .toast-icon>i{
    color: #26c468;
    }
   
    /* danger toast */
    .toast.toast-danger{
    border-color: #ff3f3f;
    }
    .toast.toast-danger .toast-progress{
    background-color:  #d63030;
    }
    .toast.toast-danger .toast-icon>span,
    .toast.toast-danger .toast-icon>i{
    color: #ff3f3f;
    }
   
    /* info toast */
    .toast.toast-info{
    border-color: #5fbdfc;
    }
    .toast.toast-info .toast-progress{
    background-color:  #4b9fd8;
    }
    .toast.toast-info .toast-icon>span,
    .toast.toast-info .toast-icon>i{
    color: #5fbdfc;
    }
   
    /* warning toast */
    .toast.toast-warning{
    border-color: #c99e25;
    }
    .toast.toast-warning .toast-progress{
    background-color:  #bb9223;
    }
    .toast.toast-warning .toast-icon>span,
    .toast.toast-warning .toast-icon>i{
    color: #c99e25;
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
    @yield('script')
  </body>
</html>