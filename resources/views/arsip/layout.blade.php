<!DOCTYPE html>
<html lang="en" data-theme="light">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arsip Dokumen - {{ $level }}</title>
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toasr.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/toast.min.js') }}"></script>
  </head>
  <body class="has-navbar-fixed-bottom">    
        <nav class="navbar is-transparent">
          <div class="container">
            <div class="navbar-brand">
              <a href="{{ route('welcome') }}"class="navbar-item">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" style="max-height: 3rem;">
              </a>
              <span class="navbar-item" style="position:absolute;right:5px;top:5px">
                <div class="container has-text-centered">
                  <div class="control has-text-right">
                    <span id="theme-toggle" class="icon">
                      <span class="icon">
                        <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path id="sun-icon"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                          <path id="moon-icon"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                          <path id="system-icon"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25"  />
                        </svg>
                      </span>
                    </span>
                  </div>
                </div> 
              </span>
            </div>
          </div>
        </nav> 
   
    <section class="hero is-small has-text-centered">
      <div class="hero-body">
        <p class="title is-4">Arsip Dokumen Tahun Anggaran {{ $tahun }}</p>
        <p class="subtitle">Per {{ $level }}</p>
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
    <footer class="footer pt-1 pb-1">
      <div class="has-text-centered">
        <p class="is-size-7">
          Sistem Integrasi Pekerjaan dan Dokumentasi secara Elektronik
          &middot; v.{{ $version }}
        </p>
        <p class="is-size-7">
          Copyright &copy; 2021 -
          <span id="copyright">
            <script>
              document
                .getElementById("copyright")
                .appendChild(
                  document.createTextNode(new Date().getFullYear()),
                );
            </script>
          </span>
          <a href="{{ config('satker.website') }}" target="_blank">
            {{ $satker }}
          </a>
        </p>
      </div>
    </footer>
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