<!DOCTYPE html>
<html lang="en" data-theme="light">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arsip Dokumen - {{ $level }}</title>
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/toast.min.js') }}"></script>
    <style type="text/css">
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
    <section class="section">      
        <div class="container has-text-centered">
          <div class="control has-text-right">
            <button id="theme-toggle" class="button is-small is-light">
              <span class="icon">
                <svg id="theme-icon" class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path id="sun-icon"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                  <path id="moon-icon"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                  <path id="system-icon"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25"  />
                </svg>
              </span>
            </button>
          </div>
          <h1 class="title">Arsip Dokumen Tahun Anggaran {{ $tahun }}</h1>
          <h3 class="subtitle">Per {{ $level }}</h3>
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
    <script>
      const themeToggle = document.getElementById('theme-toggle');
      const sunIcon = document.getElementById('sun-icon');
      const moonIcon = document.getElementById('moon-icon');
      const systemIcon = document.getElementById('system-icon');

      const updateThemeIcon = (theme) => {
        sunIcon.classList.add('is-hidden');
        moonIcon.classList.add('is-hidden');
        systemIcon.classList.add('is-hidden');
        if (theme === 'light') {
          sunIcon.classList.remove('is-hidden');
        } else if (theme === 'dark') {
          moonIcon.classList.remove('is-hidden');
        } else {
          systemIcon.classList.remove('is-hidden');
        }
      };

      themeToggle.addEventListener('click', () => {
        let theme = localStorage.getItem('novaTheme') || 'system';
        if (theme === 'light') {
          theme = 'dark';
        } else if (theme === 'dark') {
          theme = 'system';
        } else {
          theme = 'light';
        }       
        updateThemeIcon(theme);
        if (theme === 'system') {
          localStorage.removeItem('novaTheme');
          theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        } else {
          localStorage.setItem('novaTheme', theme);
        }
        document.documentElement.setAttribute('data-theme', theme);
      });

      // Initialize theme on page load
      const initTheme = () => {
        let theme = localStorage.getItem('novaTheme') || 'system';
        updateThemeIcon(theme);
        if (theme === 'system') {
          theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }
        document.documentElement.setAttribute('data-theme', theme);
      };

      // Listen for system theme changes
      window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        if (!localStorage.getItem('novaTheme')) {
          const newTheme = e.matches ? 'dark' : 'light';
          document.documentElement.setAttribute('data-theme', newTheme);         
        }
      });
      
      initTheme();
    </script>
  </body>
</html>